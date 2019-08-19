<?php

if(count($_POST)>0){
	$user = PacientData::getById($_POST["id"]);
	$user->nombre = $_POST["nombre"];
	$user->apellido = $_POST["apellido"];
	$user->email = $_POST["email"];
	$user->telefono = $_POST["telefono"];
    $user->dni = $_POST["dni"];
	$user->update();

Core::alert("Actualizado exitosamente!");
print "<script>window.location='index.php?view=pacients';</script>";


}


?>