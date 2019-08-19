<?php
/**
* BookMedik
* @author evilnapsis
* @url http://evilnapsis.com/about/
**/

if(count($_GET)>0){
	$user = new PacientData();
	$user->nombre = $_GET["nombre"];
	$user->apellido = $_GET["apellido"];

	/*$user->gender = $_POST["gender"];
	$user->day_of_birth = $_POST["day_of_birth"];
	
	$user->sick = $_POST["sick"];
	$user->medicaments = $_POST["medicaments"];
	$user->alergy = $_POST["alergy"];*/
	

	$user->email = $_GET["email"];
	$user->telefono = $_GET["telefono"];
    $user->dni = $_GET["dni"];
	$user->add();

//print "<script>window.location='index.php?view=pacients';</script>";


    echo "Cliente agregado exitosamente!";
}else{
    echo "ERROR";
}


?>