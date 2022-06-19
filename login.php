<?php
require 'bd.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usu = comprobar_usuario($_POST['usuario'], $_POST['clave']);
    if ($usu === false) {
        $err = true;
        $usuario = $_POST['usuario'];
    } else {
        session_start();
   
       $_SESSION['usuario'] = $usu; //array de dos elementos
        $_SESSION['rol']=$usu['rol'];
        if ($usu['rol']==1) {
            header("Location:admin.php");
        } else {
            header("Location:index.php");
        }
     
     
      
        return;
    }
}
        if (isset($err) and $err == true) {
            echo "<p> Revise usuario y contraseña</p>";
        }
        ?>

        <!-- <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
            <label for = "usuario">Usuario</label> 
            <input value = "<?php if (isset($usuario)) {
            echo $usuario;
        } ?>"
                   id = "usuario" name = "usuario" type = "text">		
            <label for = "clave">Clave</label> 
            <input id = "clave" name = "clave" type = "password">					
            <input type = "submit">
        </form>
    </div> -->

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html>
    
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="images/Japan.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="usuario" class="form-control input_user" value="<?php if (isset($usuario)) {
            echo $usuario;
        } ?>" placeholder="username">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="clave" class="form-control input_pass" value="" placeholder="password">
						</div>
						<div class="form-group">
							<!-- <div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Recuerdame</label>
							</div> -->
						</div>
							<div class="d-flex justify-content-center mt-3 login_container">
                                                            <button type="submit" name="button" class="btn login_btn">Login</button>
				   </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
