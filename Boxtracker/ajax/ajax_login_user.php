<?php 
include ("../BACKEND/datos/conexion.php");
session_start();

	include("../BACKEND/controller/UsuariosController.php");
	$uc = new UsuariosController($basedatos,$servidor,$usuario,$paswd);
	$user=$_POST['email'];
	$contraseña=$_POST['pass'];
	$rta=$uc->login($user,$contraseña);
	if($rta != false){
		$nombre= $rta->getNombre();

		
		$_SESSION['user']=$rta;
		/*

		ACA SE GUARDAN LOS DATOS EN SESION
		*/
		
		$mensaje= "Bienvenido ".$nombre;
			$div_mensaje= '<div class="alert alert-success text-center col-sm-6 col-sm-offset-3">

				'.$mensaje.'</div>';
			$status=1;

	}else{
		$mensaje="Usuario y/o contraseña incorrectos";
			$div_mensaje= '<div class="alert alert-danger text-center col-sm-6 col-sm-offset-3">

			'.$mensaje.'</div>';
		$status=0;
	}

$arr = array(

  'estado'=>$status,

  'mensaje'=>$mensaje

);
 	echo json_encode($arr);

?>