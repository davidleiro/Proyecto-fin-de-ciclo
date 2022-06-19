<?php
namespace LoginYRegistro;

require_once '../bd.php';

class clase_login {

    function newUsu() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $obj = new BD();
            $user = $obj->comprobar_usuario($_POST['name'], $_POST['password']); //Devuelve false si no es un usuario correcto
            if ($user) {
                session_start();
//Guardamos en variable de sesión el rol y el usuario
                $_SESSION['usuario'] = $user[0];
                $_SESSION['rol'] = $user[1];
                
                if ($user[1] == 1) {
                    header("Location: admin.php");
                } else {
                    header("Location: ../index.php");
                }
            } else {
//Variable de tipo bandera para volver al formulario a pedir los datos pq el login no es correcto
                $error = true;
            }
        }
    }

}

?>