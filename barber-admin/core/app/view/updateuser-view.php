<?php

if(count($_POST)>0){
	$es_admin=0;
	if(isset($_POST["es_admin"])){$es_admin=1;}
	$es_activo=0;
	if(isset($_POST["es_activo"])){$es_activo=1;}
	$user = UserData::getById($_POST["usuario_id"]);
	$user->nombre = $_POST["nombre"];
	$user->apellido = $_POST["apellido"];
	//$user->username = $_POST["username"];
	$user->email = $_POST["email"];
	$user->es_admin=$es_admin;
	$user->es_activo=$es_activo;
	$user->update();
	var_dump($es_activo);
	if($_POST["password"]!=""){
		$user->password = sha1(md5($_POST["password"]));
		$user->update_passwd();
print "<script>alert('Se ha actualizado el password');</script>";

	}

print "<script>window.location='index.php?view=users';</script>";


}


?>