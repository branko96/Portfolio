<?php
include dirname(__FILE__). "/PHPMailer/PHPMailer/PHPMailer.php";
include dirname(__FILE__). "/PHPMailer/PHPMailer/SMTP.php";

$destino=$_POST["email"];

$smtpHost = "c1531094.ferozo.com";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "no-reply@c1531094.ferozo.com";  // Mi cuenta de correo
$smtpClave = "xW4JLrTBYu";  // Mi contraseña

$the_subject = "Cambio Pass Dani Barbers";
$address_to = $destino;
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
$phpmailer->Body = '<a href="http://danientraigasbarbers.com/barber-admin/core/app/view/updatepass-view.php/?emai='. $destino.'">CLCK AQUI PARA CAMBIAR CONTRASEÑA</a>';
$phpmailer->IsHTML(true);
$enviado=$phpmailer->Send();

if(!$enviado) {
	echo "Error: " . $phpmailer->ErrorInfo;
}else{
	echo "Enviado!";
}

?>