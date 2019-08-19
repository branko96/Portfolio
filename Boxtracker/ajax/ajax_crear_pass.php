<?php 
include ("../BACKEND/datos/conexion.php");
session_start();

	include("../BACKEND/controller/UsuariosController.php");
	$uc = new UsuariosController($basedatos,$servidor,$usuario,$paswd);
	$id_user=$_POST['id_user'];
	$contraseña=$_POST['pass1'];
	$rta=$uc->Crear_password($id_user,$contraseña);
	if($rta != false){
		$mensaje= "Cuenta activada, en segundos sera redirigido al sistema";
			$div_mensaje= '<div class="alert alert-success text-center">

				'.$mensaje.'</div>';
			$status=1;

	}else{
		$mensaje="No se ha podido activar su cuenta";
			$div_mensaje= '<div class="alert alert-danger text-center">

			'.$mensaje.'</div>';
		$status=0;
	}

$arr = array(

  'estado'=>$status,

  'mensaje'=>$div_mensaje

);
 	echo json_encode($arr);

?>