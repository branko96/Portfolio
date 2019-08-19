<?php
   
   $mensaje = $_POST['mensaje'];
   $mensaje .= "\n------------------------------------------------------------";
   $mensaje .= "\nNombre...: ". $_POST['nombre'];
   $mensaje .= "\nTelefono.: ". $_POST['telefono'];
   $mensaje .= "\nE-mail...: ". $_POST['email'];
   // Email Destino
   $destino = "ventas@servipetrobahia.com";
   $remitente = $_POST['email'];
   $asunto = "Mensaje enviado desde la web por: ".$_POST['nombre'];
   @mail($destino, $asunto,  utf8_decode($mensaje), "FROM: $remitente");
   // El mensaje que se mostrará al confirmar el envío
   echo "<i class='fa fa-check-square-o'></i> Mensaje enviado! Gracias por contactarnos."; 
?>