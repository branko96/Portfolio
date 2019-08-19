<?php

require_once('../../conexion.php');
require_once('../../consultas.php');
$consultas=new consultas();
$subdominio_club=$_POST['sub'];
$resultado=$consultas->verificar_subdominio_club($subdominio_club);

if ($resultado== true){
	echo "1";
}else{
	echo "0";
}


?>