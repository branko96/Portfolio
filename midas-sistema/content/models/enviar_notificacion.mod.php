<?php
//Almacenando los valores recibidos
$sAsunto = "Canje Realizado";
if(isset($email_socio)){
	$sPara   = "gestion@mds360.club,".$email_admin.",".$email_socio;  
}else{

	$sPara   = "gestion@mds360.club,".$email_admin;
}


@$remitente='gestion@mds360.club';
$nombre=$datos_socio->nombre;
$dni=$datos_socio->nDocumento;
$tarjeta=$datos_socio->nTarjeta;
$club_nombre=$datos_socio->nombreClub;
$puntosActuales= (float)$puntosAcumulados - (float)$puntosPremio;
$premio_titulo=$_POST['premio_titulo'];
$premio_detalle=$_POST['premio_detalle'];

$bHayFicheros = 0;
$sCabeceraTexto = "";
$sAdjuntos = "";

$sCabeceras = "From:".$remitente."\n";
$sCabeceras .= "MIME-version: 1.0\n";

@$sTexto .= "

-------------------------------------------------------
               		COMUNIDAD MIDAS
-------------------------------------------------------
<p>Se ha realizado un nuevo CANJE</p><br>
<p><strong>Datos del Socio</strong><p><br>";

$sTexto .= "<b>NOMBRE: </b>" . $nombre . " <br>";
$sTexto .= "<b>DNI: </b>" . $dni ." <br>";
$sTexto .= "<b>CLUB: </b>" . $club_nombre . " <br>";
$sTexto .= "<b>Nº TARJETA: </b>" .$tarjeta."<br>";
$sTexto .= "<b>email socio: </b>" .$email_socio."<br>";
$sTexto .= "<b>email administrador: </b>" .$email_admin."<br>";


$sTexto .= "
-------------------------------------------------------
<p><strong>Datos de la Operación</strong><p> <br>";

$sTexto .= "<b>FECHA:</b>". date('d/m/Y', time())."<br>";
$sTexto .= "<b>PREMIO:</b>".$premio_titulo."<br>";
$sTexto .= "<b>DETALLE DEL PREMIO:</b>".$premio_detalle."<br>";
$sTexto .= "<b>PUNTOS DESCONTADOS: </b>" . $puntosPremio . " <br>";
$sTexto .= "<b>PUNTOS A LA FECHA: </b>" . $puntosActuales ." <br>";
$sTexto .= "<b>ID MOVIMIENTO: </b>" .$last_id."<br>";


if ($bHayFicheros == 0)
{
$bHayFicheros = 1;
$sCabeceras .= "Content-type: multipart/mixed;";
$sCabeceras .= "boundary=\"--_Separador-de-mensajes_--\"\n";

$sCabeceraTexto = "----_Separador-de-mensajes_--\n";
$sCabeceraTexto .= "Content-type: text/html;charset=iso-8859-1\n";
$sCabeceraTexto .= "Content-transfer-encoding: 7BIT\n";

$sTexto = $sCabeceraTexto.$sTexto;
}
if (@$_FILES['adjunto']['size'] > 0)
{
$sAdjuntos .= "\n\n----_Separador-de-mensajes_--\n";
$sAdjuntos .= "Content-type: ".$_FILES['adjunto']['type'].";name=\"".$_FILES['adjunto']['name']."\"\n";;
$sAdjuntos .= "Content-Transfer-Encoding: BASE64\n";
$sAdjuntos .= "Content-disposition: attachment;filename=\"".$_FILES['adjunto']['name']."\"\n\n";

$oFichero = fopen($_FILES['adjunto']["tmp_name"], 'r');
$sContenido = fread($oFichero, filesize($_FILES['adjunto']["tmp_name"]));
$sAdjuntos .= chunk_split(base64_encode($sContenido));
fclose($oFichero);
}

if ($bHayFicheros){
$sTexto .= $sAdjuntos."\n\n----_Separador-de-mensajes_----\n";	
}

if ( !@mail($sPara, $sAsunto,utf8_decode($sTexto), $sCabeceras))
	$result="Error al enviar EMAIL";


?>