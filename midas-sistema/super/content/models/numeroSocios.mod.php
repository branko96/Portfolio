<?php 

	$db=new database();
	$idClub=$_SESSION['club']['id'];
	$db->conectar();

	$query="SELECT * FROM `em_socios` WHERE `club` = '$idClub' ";
	$numSocio= $db->queryCount($query);
	return $numSocio;

?>