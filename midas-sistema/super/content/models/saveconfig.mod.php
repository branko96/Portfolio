<?php 

	
	//creo un array multidimensional con los datos del juego

    $idClub=$_SESSION['club']['id'];

	$datos['check']=$_POST['check'];
	$datos['campo']=$_POST['campo'];
	$valorCliente=$_POST['valorCliente'];
	$email=$_POST['email'];
	$inputMinimo=$_POST['inputMinimo'];
	$sistemaValores=$_POST['sistemaValores'];
	$herencia=json_encode($_POST['herencia']);


	if(empty($_POST['categorizarSocio'])){
			$categorizarSocio='off';
		}else{$categorizarSocio=$_POST['categorizarSocio'];}



	if($_POST['idConfig']!=0){
		//si existe la fila del club en la bdd entonces la modifico
				
		$datosJson= json_encode($datos);
		
		/*	resultado del json
			{"check":{"3":"on","6":"on","9":"on","12":"on","15":"on","18":"on","21":"on","24":"on","27":"on","30":"on"},"campo":{"1":"100","2":"25","3":"PREMIO","4":"250","5":"10","6":"PREMIO","7":"50","8":"2","9":"PREMIO","10":"45","11":"70","12":"PREMIO","13":"20","14":"25","15":"PREMIO","16":"20","17":"150","18":"PREMIO","19":"5","20":"200","21":"PREMIO","22":"60","23":"10","24":"PREMIO","25":"30","26":"15","27":"PREMIO","28":"20","29":"40","30":"PREMIO"}}

			
		*/
		$db=new database();
 		$db->conectar();
 		$table="em_config";
 		$values=" inputMinimo='$inputMinimo',sistemaValores='$sistemaValores',categorizarSocio='$categorizarSocio',email='$email',juego='$datosJson',herencia='$herencia'";
		$key= " club='$idClub'";
		$result_AP =$db->updateRow($table,$values,$key);


		if($result_AP){

			for ($i="A"; $i <= "C"; $i++) { 

				# recorro el array de valores para los tipos de cliente...
				$table="em_tipo_cliente";
				$values=" valor='$valorCliente[$i]'";
				$key= " club='$idClub' AND tipo='$i'";
				$result_AP =$db->updateRow($table,$values,$key);
				
			}
		}


	}else{
		//si no existe en la tabla creo una nueva fila con los valores


		//datos por defecto
		$datosJson='{"check":{"1":"on","6":"on","9":"on","12":"on","21":"on","24":"on","27":"on"},"campo":{"1":"PREMIO","2":"25","3":"","4":"250","5":"10","6":"PREMIO","7":"50","8":"15","9":"PREMIO","10":"45","11":"70","12":"PREMIO","13":"20","14":"25","15":"","16":"20","17":"150","18":"","19":"15","20":"200","21":"PREMIO ","22":"60","23":"","24":"30","25":"","26":"15","27":"PREMIO","28":"20","29":"40","30":""}}';


		$db=new database();
 		$db->conectar();
 	 	$table="em_config";
 		$values="club='$idClub',inputMinimo='$inputMinimo',sistemaValores='$sistemaValores',categorizarSocio='$categorizarSocio',email='$email',juego='$datosJson'";

		$result_AP =$db->insertRow($table,$values);

		if($result_AP){

			for ($i="A"; $i <= "C"; $i++) { 
				$tipoCliente=$i;
				# recorro el array de valores para los tipos de cliente...
				$table="em_tipo_cliente";
				$values=" club='$idClub',tipo='$tipoCliente',valor='$valorCliente[$i]'";
				$result_AP =$db->insertRow($table,$values);
			
			}
		}


	}


	$db->actualizar_datos_login($myusername=$_SESSION['user'],$mypassword=$_SESSION['password']);
	

 ?>