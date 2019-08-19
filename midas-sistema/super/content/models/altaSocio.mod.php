<?php

	$tipoSocio=$_POST['tipoSocio'];
	$nombre=$_POST['nombre'];
	$tarjeta=$_POST['nTarjeta'];
	$celular=$_POST['Ncelular'];
	$fNac=date('Y-m-d',strtotime($_POST['fNac']));
	$club=$_SESSION['club'];
	$idClub=$club['id'];
	$nclub= $idClub;
	$sexo=$_POST['sexo'];
	$mail=$_POST['mail'];
	$tDocumento=$_POST['tDocumento'];
	$nDocumento=$_POST['nDocumento'];
	$idRecomendante=$_POST['idRecomendante'];

	$db=new database();
	$db->conectar();

	$table='em_socios';
	$key=" nTarjeta='$tarjeta' AND club='$nclub'";
	$validar=$db->queryItem($table,$key);
	$result_A=NULL;
	if($validar['nTarjeta'] == ''){

		$values="tipoCliente='$tipoSocio', nombre='$nombre',club='$nclub',nTarjeta='$tarjeta',sexo='$sexo',email='$mail',nDocumento='$nDocumento',tDocumento='$tDocumento',fNacimiento='$fNac',celular='$celular',recomendado_por='$idRecomendante'";
		$result_A= $db->insertRow($table,$values);
		$lastId=$db->lastId();
		if($result_A){ //inserto el movimiento

			$date= date("Y/m/d");
			$table='em_movimientos';
			$values=" club='$nclub',socio='$lastId',fecha='$date',tipoMovimiento=2,hora=TIME(NOW())";
			$db->insertRow($table,$values);
			
		}

		

	}//ENDIF

	return $result_A;

  ?>
