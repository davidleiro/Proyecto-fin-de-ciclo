<?php
session_start();
require './bd.php';
require 'correo.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $datos_reserva = $_POST;
    $id_usuario = getIdUsuario();

 
   $email = $_SESSION['usuario'];
   
    $reservar = nueva_reserva($datos_reserva, $id_usuario['codigo']);
    $correo= enviar_email($email[email]);
}
?>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kanewokau Japanese Restaurant</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="icon" type="image/png" href="images/Japan.png">
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <div class="row">
        <img id="logo" class="col-2" src="images/Japan.png" alt="">
        <header class="col-8">
            <p id="restName">Kanewokau</p>
            <p id="restDescript">Japanese Restaurant</p>
        </header>
    </div>

    <body>
        <span class="info">
<?php
if (isset($_SESSION['usuario'])) {
    $usu = $_SESSION['usuario'];

    echo "Bienvenid@ al Japanese Restaurant Kanewokau  <a href='cuenta.php' class='cuenta'> $usu[email] </a>";
}
?>

        </span>
        <ul class="circulos3">
            <li><a href="reservas.php"><span>Reservar</span></a></li>
            <li><a href="chefs.php"><span>Nuestros chefs</span></a></li>
            <li><a href="index.php"><span>Principal</span></a></li>
            <li><a href="login.php"><span>Login</span></a></li>
            <li><a href="registro.php"><span>Registro</span></a></li>
            <li><a href="#"><span>Menú</span></a></li>

        </ul>
<?php
if (isset($_SESSION['rol'])) {

    $usu = $_SESSION['rol'];

    if ($usu == 1) {
        echo "<a href='admin.php'>ADMIN</a>";
    }
}
?>

        <br><br><br>
        <br><br><br>
        <h1>Haz tu reserva ya!</h1>
        <h2>Y disfruta de los mejores platos de nuestro restaurante</h2>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label>Fecha:</label>
            <input type="datetime-local" name="fecha" id="fecha"><br>
            <label>Numero de comensales:</label>
            <input type="number" name="comensales" id="comensales" ><br>
            <input type="submit" name="enviar" id="enviar" value="Enviar">

        </form>

<?php
echo $reservar;
?>


        <br><br><br>
        <br><br><br>

        <footer class="bg-dark">
            <div class="container">
                <div class="row">
                    <div class="ent mt-5 mb-5 col-12">
                        <img src="./images/Japan.png" alt="" class="logo-footer" />
                        <p class="direccion-footer">Plaza de España, 21 36215 Vigo, Pontevedra Spain</p>
                        <p>
                            Tel. 986 04 18 05 Email.
                            <span class="email-footer">info@kanewokau.com</span>
                        </p>
                    </div>
                    <div class="col-12">
                        <div class="social-buttons">
                            <a href="#" target="blank_" class="social-buttons__button social-button social-button--facebook">
                                <span class="social-button__inner">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" class="svg-inline--fa fa-facebook-f fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></svg>
                                </span>
                            </a>
                            <a href="#" target="blank_" class="social-buttons__button social-button social-button--twitter">
                                <span class="social-button__inner">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter" class="svg-inline--fa fa-twitter fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg>
                                </span>
                            </a>
                            <a href="#" target="blank_" class="social-buttons__button social-button social-button--instagram">
                                <span class="social-button__inner">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" class="svg-inline--fa fa-instagram fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg>
                                </span>
                            </a>
                            <a href="#" target="blank_" class="social-buttons__button social-button social-button--youtube">
                                <span class="social-button__inner">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="youtube" class="svg-inline--fa fa-youtube fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path></svg>
                                </span>
                            </a>
                            <a href="#" target="blank_" class="social-buttons__button social-button social-button--pinterest">
                                <span class="social-button__inner">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="pinterest-p" class="svg-inline--fa fa-pinterest-p fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z"></path></svg>
                                </span>
                            </a>
                        </div>

                    </div>

                    </footer>


                    <br><br><br><br>   <br><br><br><br>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                    crossorigin="anonymous"></script>
                    </body>

                    </html>