<?php
	//este controlador es llamado por ajax por eso uso ../ dado que se ejecuta en la localización del archivo mismo
	// Tambien lo llamo desde php asi que voy a mezclar las llamadas con ../ (ajax) y sin ../ (local)
   if(!empty($_POST))
    {
	  @$action=$_POST['action'];

		switch ($action) {
			case 'validar_socio': //verificar_socio.mod.php
				 require_once("../models/verificar_socio.mod.php");
				 if(!empty($result)){
				 	if(isset($_POST['emisor_consulta'])){ //emisor_consulta viene desde la llamada del validacion del juego
				 		echo $result[0]['idSocios'];
				 	}else{
				 		//la uso para mostrar los datos en compras.tpl
				 		require_once("../views/verificar_socio.tpl.php");
				 	}
				}
				break;

			case 'sexoSocio': //verificar_socio.mod.php
			 require_once("../models/sexoSocio.mod.php");
			 		
			break;

			case 'E':
				$socio=require_once("content/models/editarSocio.mod.php");
				$fechaNacimiento = date('d-m-Y',strtotime($socio[0]['fNacimiento']));
				require_once("content/views/editarSocio.tpl.php"); 
			break;
			
			default:
				# code...
				break;
		}
	}
?>