<?php
require 'bd.php';
session_start();

// if (isset($_SESSION['usuario'])) {
//     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//         if ($_POST['inputPassword3'] == $_POST['inputPassword4']) {
//             $new_user = $_POST;
//             $prueba=anadir_nuevoUsuario($new_user);
//             echo $prueba;
//         } else {
//             $flag = true;
//         }
//     }

if (isset($_POST['submit'])) {
    if ($_POST['pwd2'] == $_POST['pwd1']) {
        $new_user = $_POST;
        $pass_hash=$_POST['pwd1'];
        echo $_POST['telefono'];
        $rol = 0;
        array_push($new_user, $rol);
        $prueba = anadir_nuevoUsuario($new_user,$pass_hash);
        echo $prueba;
    }
} else {
    // header("Location:index.php");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <link rel="stylesheet" href="css/registro.css">
    </head>
    <body>
        <?php
        if (isset($flag)) {
            echo "<h2> Las contraseñas no coinciden.</h2>";
        }
        ?>

        <div class="container h-100">
            <div class="d-flex justify-content-center h-100">
                <div class="user_card">
                    <div class="d-flex justify-content-center">
                        <div class="brand_logo_container">
                            <img src="images/Japan.png" class="brand_logo" alt="Logo">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center form_container">

                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="usuario" class="form-control input_user" value="" placeholder="username">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" name="pwd1" class="form-control input_pass" value="" placeholder="password">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="password" name="pwd2" class="form-control input_user" value="" placeholder="repeat password">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control input_user" value="" placeholder="email">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="telefono" class="form-control input_user" value="" placeholder="telefono">
                            </div>
                            <div class="d-flex justify-content-center mt-3 login_container">
                                <input type="submit" name="submit" class="btn login_btn" value="Registro"></input>
                            </div>
                        </form>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-center links">
                            ¿Ya tienes cuenta? <a href="login.php" class="ml-2">Haz login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
