<?php

function loadBBDD($rol) {
    /*
     * Devuelve el puntero a la conexión a la BBDD
     */
    try {
        $res = leer_config(dirname(__FILE__) . "/config/configuracion.xml", dirname(__FILE__) . "/config/configuracion.xsd", $rol);
        $bd = new PDO($res[0], $res[1], $res[2]);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $bd;
    } catch (\Exception $e) {
        echo $e->getMessage();
        exit();
    }
}

function leer_config($fichero_config_BBDD, $esquema, $rol) {
    /*
     * $fichero_config_BBDD es la ruta del fichero con los datos de conexión a la BBDD
     * $esquema es la ruta del fichero XSD para validar la estructura del fichero anterior
     * Si el fichero de configuración existe y es válido, devuelve un array con tres
     * valores: la cadena de conexión, el nombre de usuario y la clave.
     * Si no encuentra el fichero o no es válido, lanza una excepción.
     */

    $config = new DOMDocument();
    $config->load($fichero_config_BBDD);
    $res = $config->schemaValidate($esquema);
    if ($res === FALSE) {
        throw new InvalidArgumentException("Revise el fichero de configuración");
    }
    $datos = simplexml_load_file($fichero_config_BBDD);
    $usu = $datos->xpath("//usuario");
    $clave = $datos->xpath("//clave");
    $cad = sprintf("mysql:dbname=%s;host=%s;", "kanewokaurestaurant", "localhost");
    $resul = [];
    $resul[] = $cad;
    foreach ($datos as $dato) {


        if ($dato->rol == $rol) {
            $resul[] = $dato->nombre;
            $resul[] = $dato->password;
        }
    }

    return $resul;
}

function loadPass($nombre) {
    /*
     *  Recupera la contraseña encriptada de la BBDD cuyo usuario (a través del
     *  parámetro nombre) es la dirección de correo del usuario que va a realizar el pedido
     */
    $bd = loadBBDD("admin");
    $ins = "select contrasenha from usuarios where email= '$nombre'";
    $stmt = $bd->query($ins);
    $resul = $stmt->fetch();
    $devol = false;
    if ($resul !== false) {
        $devol = $resul['contrasenha'];
    }
    return $devol;
}

//Metodo para logearse en la pagina,en este metodo se recibe el email y la password y buscan en la BBDD si existe el usuario
function comprobar_usuario($nombre, $clave) {

    /*
     * Comprueba los datos que recibe del formulario del login. Si los datos son correctos
     * devuelve un array con dos campos: codRes (el código del restaurante) y correo 
     * con su correo. En caso de error devuelve false
     */
    $devol = FALSE;
    $bd = loadBBDD("admin");
    $hash = loadPass($nombre);
    if (password_verify($clave, $hash)) {
        $ins = "select codigo, email,rol from usuarios where email = '$nombre' ";
        $resul = $bd->query($ins);
        if ($resul->rowCount() === 1) {
            $devol = $resul->fetch();
        }
    }
    return $devol;
}

//metodo para registrar los datos de un usuario en la BBDD
function anadir_nuevoUsuario($new_user,$pass_hash) {
    try {
        $pass_hash = password_hash($new_user['pwd1'], PASSWORD_DEFAULT);
        $code = null;
        $pdo = loadBBDD('admin');
        $pdo->beginTransaction();

        $sql = "INSERT INTO usuarios (codigo, nombre, email,contrasenha,telefono,rol) values(?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute(array(
                    $code,
                    $new_user['usuario'],
                    $new_user['email'],
                    $pass_hash,
                    $new_user['telefono'],
                    end($new_user)
                        )
                )
        ) {
            echo "Usuario registrado con exito<br>";
        } else {
            throw new PDOException();
        }
        $pdo->commit();
        //}
    } catch (\Exception $ex) {
        $pdo->rollBack();
        echo $ex->getMessage();
        echo "Se ha producido un error, no se han conseguido registrar el usuario";
    } finally {

        $stmt = null;
        $pdo = null;
    }
}

//metodo que carga la informacion del usuario que esta actualmente con sesion iniciada
function cargar_info_usuario() {

    $usu = $_SESSION['usuario'];

    try {

        $pdo = loadBBDD("estandar");
        $sql = "SELECT nombre,email,contrasenha,telefono FROM usuarios WHERE email=?";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute(array($usu['email']))) {
            $fila = $stmt->fetch();
            return $fila;
        }
    } catch (\PDOException $exc) {
        echo $exc->getMessage();
    } finally {

        $pdo = null;
        $stmt = null;
    }
}

function modif_info_usuario($newInfo, $pass) {

    $usu = $_SESSION["usuario"];

    try {
        $pdo = loadBBDD("estandar");
        $sql = "UPDATE usuarios SET nombre=?,contrasenha=?,telefono=? WHERE email=?";

        $stmt = $pdo->prepare($sql);

        $resultado = $stmt->execute(array(
            $newInfo['Nombre'],
            $pass,
            $newInfo['Telefono'],
            $usu['email']
        ));

        if ($resultado === true) {
            $count = $stmt->rowCount();
            echo "Se ha actualizado" . $count . "datos";
            header("refresh:4,cuenta.php");
            exit();
        } else {

            echo "Se ha producido un error en la actualizacion";
        }
    } catch (\PDOException $exc) {
        echo $exc->getMessage();
    } finally {

        $pdo = null;
        $stmt = null;
    }
}

function anhadir_chef($nombre, $apellido1, $apellido2,  $nacionalidad, $sexo, $descripcion) {


    try {

        $pdo = loadBBDD("admin");
        $sql = "INSERT INTO chefs(nombre,descripcion,apellido1,apellido2,sexo,nacionalidad) VALUES(:nombre,:descripcion,:apellido1,:apellido2,:sexo,:nacionalidad)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":apellido1", $apellido1);
        $stmt->bindParam(":apellido2", $apellido2);
        $stmt->bindParam(":sexo", $sexo);
        $stmt->bindParam(":nacionalidad", $nacionalidad);

        $stmt->execute();
        echo "Se ha introducido el chef con éxito";
    } catch (\PDOException $exc) {

        echo $exc->getMessage();
        echo "Se ha producido un error, no se han conseguido registrar el usuario";
    } finally {

        $pdo = null;
        $stmt = null;
    }
}

function modif_chefs($id, $nombre, $apellido1, $apellido2, $nacionalidad, $sexo, $descripcion) {

    try {
        $pdo = loadBBDD("admin");
        $sql = "UPDATE chefs SET nombre=?,descripcion=?,apellido1=?,apellido2=?,sexo=?,nacionalidad=? WHERE id=?";

        $stmt = $pdo->prepare($sql);
        $resultado = $stmt->execute(array($nombre, $descripcion, $apellido1, $apellido2, $sexo,$nacionalidad, $id));

        if ($resultado === true) {
            $count = $stmt->rowCount();
            header("refresh: 4,admin.php");
            echo "Se han modificado " . $count . " datos del chef con éxito";
        }
    } catch (\PDOException $exc) {
        echo $exc->getMessage();
        echo "Se ha producido un error, no se han conseguido modificar el chef";
    } finally {
        $pdo = null;
        $stmt = null;
    }
}

function eliminar_chefs($id) {


    try {
        $pdo = loadBBDD("admin");
        $sql = "DELETE FROM chefs WHERE id=?";
        $stmt = $pdo->prepare($sql);

        $resultado = $stmt->execute(array($id));

        if ($resultado === true) {
            $count = $stmt->rowCount();

            echo "Se ha borrado " . $count . " los datos del chefs co éxito";
        }
    } catch (\PDOException $exc) {
        echo $exc->getMessage();
        echo "Se ha producido un error, no se han conseguido borrar el chef";
    } finally {
        $pdo = null;
        $stmt = null;
    }
}

function chefs($datos) {

    try {

        $resultado = "";
        $pdo = loadBBDD("admin");

        $sql = "SELECT * FROM chefs";

        if (!empty($_POST["buscar"])) {

            $sql .= " WHERE nombre like ? ";
            $nombre = $_POST["buscar"];
        }

        if (!empty($_POST["orden"])) {

            $sql .= " ORDER BY " . $_POST["orden"] . " " . $_POST["senso"];
        } else {

            $sql .= " ORDER BY nombre ";
        }
      

        $stmt = $pdo->prepare($sql);
        //$stmt->bindParam(1, $nombre);

        $stmt->execute();
        while ($fila = $stmt->fetch()) {
            //$count = $stmt->rowCount();
            $resultado .= "<tr><td>" . $fila['nombre'] . "</td><td>" . $fila['apellido1'] . " " . $fila['apellido2'] . "</td><td>" . $fila['sexo'] . "</td><td>" . $fila['nacionalidad'] . "</td><td>" . $fila['descripcion'] . "</td></tr><br>";
        }

        return $resultado;
    } catch (\PDOException $exc) {
        echo $exc->getMessage();
    } finally {

        $pdo = null;
        $stmt = null;
    }
}

function nueva_reserva($datos_reserva, $idUsuario) {

    try {

        $pdo = loadBBDD("admin");
        $pdo->beginTransaction();
        $sql = "INSERT INTO reservas(idReserva,idUsuario,fecha_reserva,comensales) VALUES(?,?,?,?)";
        $code = null;
        $stmt = $pdo->prepare($sql);

        $parametro = array($code,
            $idUsuario,
            $datos_reserva['fecha'],
            $datos_reserva['comensales']);
        if ($stmt->execute($parametro)) {


            echo "<p style='background-color:green'>Se ha realizado la reserva con éxito!</p>";
        } else {

            throw new PDOException();
        }


        $pdo->commit();
    } catch (\Exception $exc) {
        $pdo->rollBack();
        echo $exc->getMessage();
    } finally {

        $pdo = null;
        $stmt = null;
    }
}

function getIdUsuario() {
    $usu = $_SESSION['usuario'];
    try {

        $pdo = loadBBDD("admin");

        $sql = "SELECT codigo FROM usuarios WHERE email=?";

        $stmt = $pdo->prepare($sql);

        if ($stmt->execute(array($usu['email']))) {

            $fila = $stmt->fetch();
            return $fila;
        }
    } catch (\Exception $exc) {
        echo $exc->getMessage();
    } finally {
        $pdo = null;
        $stmt = null;
    }
}

function mostrar_reservas() {

    try {
        $pdo = loadBBDD("admin");
        $result = "";

        $sql = "SELECT * FROM reservas";

        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        while ($fila = $stmt->fetch()) {

            $fila['idReserva'];
            $result .= "<tr><td>" . $fila['idReserva'] . " </td><td><a href=info_usuario.php?idUsuario=" . $fila['idUsuario'] . ">" . $fila['idUsuario'] . "</a></td><td>" . $fila['fecha_reserva'] . "</td><td>" . $fila['comensales'] . "</td><td><button type='button' class='btn btn-light'><a href=borrado.php?id=" . $fila['idReserva'] . ">Borrar</a></button></td></tr><br>";
        }

        return $result;
    } catch (\Exception $exc) {
        echo $exc->getMessage();
    }
}

function borrar_reserva($id) {

    try {

        $pdo = loadBBDD("admin");

        $pdo->beginTransaction();
        $sql = "DELETE FROM reservas WHERE idReserva=?";

        $stmt = $pdo->prepare($sql);

        if ($stmt->execute(array($id))) {
            header("refresh: 4,reservas_admin.php");
            echo "<p><p style='background-color:green'>Se ha borrado la reserva con éxito!</p></p>";
            ;
        } else {

            throw new PDOException();
        }


        $pdo->commit();
    } catch (\Exception $exc) {
        $pdo->rollBack();
        echo $exc->getMessage();
    }
}

function cargar_idUsuario_($id) {


    try {

        $pdo = loadBBDD("admin");
        $sql = "SELECT nombre,email,telefono FROM usuarios WHERE codigo=?";

        $result = "";
        $stmt = $pdo->prepare($sql);

        $stmt->execute(array($id));

        while ($fila = $stmt->fetch()) {

            $result .= "<h1>Usuario con id:" . $id . "</h1><br>"
                    . "<ul>"
                    . "<li>Nombre:" . $fila["nombre"] . "</li>"
                    . "<li>Email:" . $fila["email"] . "</li>"
                    . "<li>Telefono:" . $fila["telefono"] . "</li>"
                    . "</ul>";
        }

        return $result;
    } catch (\Exception $exc) {
        echo $exc->getMessage();
    }
}

?>
    