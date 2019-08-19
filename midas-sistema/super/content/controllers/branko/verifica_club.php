<?php

require_once('../../conexion.php');
require_once('../../consultas.php');
$consultas=new consultas();
$nombre_club=$_POST['nombre'];
$resultado=$consultas->verificar_nombre_club($nombre_club);

if ($resultado== true){
	echo "1";
}else{
	echo "0";
}


?>