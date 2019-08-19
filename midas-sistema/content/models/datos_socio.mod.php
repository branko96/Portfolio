<?php
if(!empty($_POST))
{
	require_once("../../admin/content/database.php");
	$dni=$_POST['dni'];
	$tarj=$_POST['tarj'];
	$db=new database();
	$db->conectar();
	$key=" nDocumento='$dni' and nTarjeta='$tarj'";
	$result= $db->queryItem('em_socios',$key);
}
?>