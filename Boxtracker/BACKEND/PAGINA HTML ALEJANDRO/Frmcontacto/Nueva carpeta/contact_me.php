<?php
// Comprobar si los campos están vacíos pasaban
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No hay argumentos proporcionados!";
	return false;
   }
	
$name = $_POST['name'];
$telefono = $_POST['telefono'];
$email_address = $_POST['email'];
$message = $_POST['message'];
	
// Crear cuerpo del correo electrónico y enviarlo
$to = 'matias.yacante@paradigma.com.ar'; // Email donde se recibiran los mensajes
$email_subject = utf8_decode("» Mensaje enviado por:  $name");
$email_body = utf8_decode("» Usted recibio un nuevo mensaje. \n\n".
				  "» Detalles del Mensaje:\n \n» Nombre: $name \n".
				  "» Teléfono: $telefono\n» Email: $email_address\n» Mensaje: \n $message");
$headers = "From: info@natatoriobarlovento.com.ar\n";
$headers .= "Reply-To: $email_address";	
mail($to,$email_subject,$email_body,$headers);
return true;			
?>