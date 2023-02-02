<?php

//AUN EN DESARROLLO - LOS CORREOS SE ENVIAN, AUN FALTAN AJUSTES DE CONFIGURACIÓN

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$body = json_decode(file_get_contents("php://input"), true);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
/* require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php'; */

if(!empty($body)){
    $name = $body['name'];
    $subject = $body['subject'];
    $email = $body['email'];
    $message = $body['message'];
}

$email_admin = "pedromedina@axolotlsystemscompany.com"; //email del administrador del correo
$pass_admin = "RedRobin97"; //contraseña del correo administrador
$name_admin = "Pedro Medina"; //nombre del administrador del correo

$mail = new PHPMailer(true);


try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.titan.email';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $email_admin;                     //SMTP username
    $mail->Password   = $pass_admin;                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress($email_admin, $name);
/*     $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
    $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com'); */

    //Attachments
    /* $mail->addAttachment('/var/tmp/file.tar.gz');         
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');     */

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
/*     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; */

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



?>