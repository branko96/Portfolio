<?php
/**
* BookMedik
* @author evilnapsis
* @url http://evilnapsis.com/about/
**/

if(count($_POST)>0){
	$es_admin=0;
	$es_activo=1;
	if(isset($_POST["es_admin"])){$es_admin=1;}
	$user = new UserData();
	$user->nombre = $_POST["nombre"];
	$user->apellido = $_POST["apellido"];
	$user->email = $_POST["email"];
	$user->es_admin=$es_admin;
	$user->es_activo=$es_activo;
	$user->password = sha1(md5($_POST["password"]));
	$user->add();

print "<script>window.location='index.php?view=users';</script>";


}


?>