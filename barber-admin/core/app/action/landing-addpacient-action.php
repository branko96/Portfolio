<?php

	$user = new PacientData();
	$user->telefono = $_POST["telefono"];
	$user->nombre = $_POST["nombre"];
	$user->apellido = $_POST["apellido"];
	$user->email = $_POST["email"];

	$user->addclient_landing($_POST['nombre'],$_POST['apellido'],$_POST['email'],$_POST['telefono']);
	$newuser=$user->getByTel($user->telefono);

echo json_encode($newuser);



?>