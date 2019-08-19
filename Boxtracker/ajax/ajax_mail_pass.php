<?php 
include ("../BACKEND/datos/conexion.php");
session_start();

	include("../BACKEND/controller/UsuariosController.php");
	$uc = new UsuariosController($basedatos,$servidor,$usuario,$paswd);
	$mail=$_POST['email'];
	$existe_mail=$uc->ValidarMail($mail);
	if($existe_mail != false){
		$id_user=$existe_mail->getId();
		$nombre=$existe_mail->getNombre();
		$activo=$uc->usuario_activo($id_user);
		if($activo){
			$rta=$uc->Olvide_password($mail,$id_user, $nombre);
		
			$mensaje= "Te enviamos un email a ".$mail.", verifica tu correo y segui los pasos para restablecer tu contraseña";
				
			$status=1;
		}else{
			$mensaje="El usuario no esta dado de alta";
				
			$status=0;
		}

		
	}else{
			$mensaje="No existe el email";
				
			$status=0;
		}

$arr = array(

  'estado'=>$status,

  'mensaje'=>$mensaje

);
 	echo json_encode($arr);

?>