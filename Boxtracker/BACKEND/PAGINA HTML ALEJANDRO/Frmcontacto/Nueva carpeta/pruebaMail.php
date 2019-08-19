<?php
	$to = "matias.yacante@paradigma.com.ar";
	$subject = "Correo de prueba";
	$message = "Este es sólo un mensaje de prueba.";
	$from = "correo@natatoriobarlovento.com.ar";
	$headers = "From:" . $from;
	mail($to,$subject,$message,$headers);
	echo "Correo enviado desde correo@natatoriobarlovento.com.ar";
?>