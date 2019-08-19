<?php
	$idSocio=$_POST['idSocio'];
	$tipoSocio=$_POST['tipoSocio'];
	$nombre=$_POST['nombre'];
	$tarjeta=$_POST['nTarjeta'];
	$club=$_SESSION['club'];
	$idClub=$club['id'];
	$nclub=$idClub;
	$fechaNacimiento = date('Y-m-d',strtotime($_POST['fNac']));
	$telefono=$_POST['Ncelular'];
	$sexo=$_POST['sexo'];
	$mail=$_POST['mail'];
	$tDocumento=$_POST['tDocumento'];
	$nDocumento=$_POST['nDocumento'];
	$idRecomendante=$_POST['idRecomendante'];

	$db=new database();
	$db->conectar();
	$values=" tipoCliente='$tipoSocio',nombre='$nombre',club='$nclub',sexo='$sexo',email='$mail',tDocumento='$tDocumento',nDocumento='$nDocumento',fNacimiento='$fechaNacimiento',celular='$telefono',ntarjeta='$tarjeta',recomendado_por='$idRecomendante'";
	$table='em_socios';
	$key="idSocios='$idSocio'";
	
	$result_GS= $db->updateRow($table,$values,$key);
	return $result_GS;
?>