<?php

//AUN EN DESARROLLO - LOS CORREOS SE ENVIAN, AUN FALTAN AJUSTES DE CONFIGURACIÓN

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$body = json_decode(file_get_contents("php://input"), true);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


if(!empty($body)){
    $name = $body['name'];
    $subject = $body['subject'];
    $email = $body['email'];
    $message = $body['message'];
}

$email_admin = "pedromedina@axolotlsystemscompany.com"; //email de la landing page ejemplo: info@correo.com
$pass_admin = "RedRobin97"; //contraseña del email
$name_admin = "Pedro Medina"; //nombre del usuario del email

$mail = new PHPMailer(true);


try {
    //Server settings
    $mail->SMTPDebug = 0;                      //DEBUG 0 es deshabilitado - 1 es para habilitarlo
    $mail->isSMTP();                                            //SMTP
    $mail->Host       = 'smtp.titan.email';                     //definir servidor SMTP
    $mail->SMTPAuth   = true;                                   //Habilitar la autentificación SMTP
    $mail->Username   = $email_admin;                     //SMTP Usuario
    $mail->Password   = $pass_admin;                               //SMTP Password
    $mail->SMTPSecure = 'ssl';            //si se usa SSL añadirlo como un string 
    $mail->Port       = 465;                                    //puerto TCP

    //EMAIL
    $mail->setFrom($email_admin, $name); //email de la landing page
    $mail->addAddress($email_admin, $name); //direccion(es) a donde se enviarán los correos


    //Content
    $mail->isHTML(true);                                  //Envia el correo en formato HMTL
    $mail->Subject = $subject;
    $mail->Body    ="Contactar a: ".$name."<br>"."Acerca de: ".$subject."<br>"."Correo: ".$email . "<br>".$message;

    $mail->send();
    echo 'Mensaje Enviado';
} catch (Exception $e) {
    echo "No se pudo enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
}



?>