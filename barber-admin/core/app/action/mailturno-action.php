<?php

/**
 * @version 1.0
 */
//$reserv=ReservationData::getById($_GET["id"]);
include dirname(__FILE__) . "/../PHPMailer/PHPMailer/PHPMailer.php";
include dirname(__FILE__) . "/../PHPMailer/PHPMailer/SMTP.php";

$cliente=PacientData::getById($_GET["cliente_id"]);
$email=$cliente->email;
$nombre=$cliente->nombre;
$apellido=$cliente->apellido;

// Valores enviados desde el formulario
if ( $email==='' ) {
    echo "Error envio email, el cliente no tiene un mail asignado  ";
}
$mensaje='Hola: '.$nombre.' '.$apellido.'!, Te enviamos la Informacion de tu turno:'.PHP_EOL.
          ''.PHP_EOL.
         'Fecha del turno: '.$_GET["fecha"].PHP_EOL.
         'Horario del turno'.$_GET["hora"];

$smtpHost = "c1531094.ferozo.com";  // Dominio alternativo brindado en el email de alta
$smtpUsuario = "no-reply@c1531094.ferozo.com";  // Mi cuenta de correo
$smtpClave = "xW4JLrTBYu";  // Mi contraseña

// Datos de la cuenta de correo utilizada para enviar vía SMTP
$the_subject = "Confirmacion turno Dani Entraigas Barbers";
$address_to = $email;
$from_name = "Dani Barbers";
$phpmailer = new PHPMailer \ PHPMailer \ PHPMailer ();
// ---------- datos de la cuenta de Gmail -------------------------------
$phpmailer->Username = $smtpUsuario;
$phpmailer->Password = $smtpClave;
//-----------------------------------------------------------------------
// $phpmailer->SMTPDebug = 1;
$phpmailer->SMTPSecure = 'ssl';
$phpmailer->Host = $smtpHost; // GMail
$phpmailer->Port = 465;
$phpmailer->IsSMTP(); // use SMTP
$phpmailer->SMTPAuth = true;
$phpmailer->setFrom($phpmailer->Username,$from_name);
$phpmailer->AddAddress($address_to); // recipients email
$phpmailer->Subject = $the_subject;
$phpmailer->Body = '<a >'.$mensaje.'</a>';
$phpmailer->IsHTML(true);
$enviado=$phpmailer->Send();


if($enviado){
    echo "Email de confirmacion de turno fue enviado a ".$nombre." ".$apellido;
} else {
    echo "Error al enviar el mail, intente de nuevo.".$phpmailer->ErrorInfo;

}