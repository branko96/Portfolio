<?php
/**
* BookMedik
* @author evilnapsis
**/

if(count($_POST)>0){
	$user = new CategoryData();
	$user->nombre = $_POST["nombre"];
    $user->importe = $_POST["importe"];
    $user->tiempo = $_POST["tiempo"];
	$user->add();

print "<script>window.location='index.php?view=categories';</script>";


}


?>