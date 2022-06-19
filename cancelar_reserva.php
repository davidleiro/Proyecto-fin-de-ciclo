
<?php

use PHPMailer\PHPMailer\PHPMailer;

require "./vendor/autoload.php";

function enviar_email_cancelacion($email) {
    /*
     * La función nos debe devolver un boolean para cuando hagamos la transacción,
     * sólo introducimos el nuevo usuario de la base de datos si se ha podido enviar 
     * el email.
     */
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;

// Introducir usuario de google
    $mail->Username = 'david.leiro.fernandez@gmail.com';
// Introducir clave
    $mail->Password = "Nok-nag7";
    //Introducir quien lo envía
    $mail->SetFrom('correo_electrónico', 'Nombre del que lo envía');
// asunto
    $mail->Subject = "Alta de usuario en la aplicación.";
// Cuerpo del mensaje
    $mail->MsgHTML(" <h1>Estimado client@ " . $email . ":<br> </h1>"
            . "<h2>Su reserva se ha cancalado debido al aforo de nuestras intalaciones o que no estaran nuestras instalaciones abiertas</h2><br>"
            . "<h2>Disculpe las molestias,un saludo</h2>");
// Destinatario
    $address = $email;
    $mail->AddAddress($address);
// Enviar
    $resul = $mail->Send();
    return $resul;
}
?>



?>

