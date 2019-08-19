<?php
   
   $mensaje = $_POST['mensaje'];
   $mensaje .= "\n------------------------------------------------------------";
   $mensaje .= "\nNombre...: ". $_POST['nombre'];
   $mensaje .= "\nE-mail...: ". $_POST['email'];
   // Email Destino
   $destino = "mr_7300@hotmail.com";
   $remitente = $_POST['email'];
   $asunto = "Mensaje enviado desde la web por: ".$_POST['nombre'];
   if(@mail($destino, $asunto,  utf8_decode($mensaje), "FROM: $remitente")){echo"entre";}else{echo"no entre";}
   
?>