<?php
if(isset($_POST['selectPremio']))
{
    $numero=$_POST['selectPremio'];
	$db=new database();
	$db->conectar();
	$key="idpremios='$numero'";
	$table="em_premios";
	$result_BP=$db->deleteRow($table,$key);
	return $result_BP;
}
?>