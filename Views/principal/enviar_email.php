<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Repositories\ProductosRepository;
$productos = ProductosRepository::inicio(); 

require 'PHPMailer/Exception.php';
require 'PHPMailer/OAuthTokenProvider.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
//Load Composer's autoloader
//require './vendor/autoload.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'hypemarketspain@gmail.com';                     //SMTP username
    $mail->Password   = 'wcekidaxlwqpsjql';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('hypemarketspain@gmail.com', 'Hype Market');
    $mail->addAddress($_SESSION['usuarioa'][3]);     //Add a recipient
    $mail->addAddress('hypemarketspain@gmail.com');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Confirmacion pedido '.$id_pedido;
    $mensaje = '';
    $mensaje = 'Buenas '.$_SESSION['usuarioa'][1].'<br>El pedido realizado contiene: <br>El total del pedido es: €'.$_SESSION['precio'].'<br>';
    if (isset($_SESSION['carrito'])) foreach ($_SESSION['carrito'] as $nombre => $valor){
        foreach ($productos as $p){
            if ($nombre == $p->getId() && $valor != 0){
                $mensaje .= 'Producto: '.$p->getNombre(). 'Cantidad: '. $_SESSION['carrito'][$nombre].'<br>';
            }
        }
    }

    
    $mail->Body    =  $mensaje;    
    
    
    $mail->send();
    echo 'El mensaje de Buenpito se envió correctamente';
} catch (Exception $e) {
    echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
}
