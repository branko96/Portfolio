<?php
header('Access-Control-Allow-Origin: *');
// require_once 'controller/Database.php';
// require_once 'model/MedicData.php';

//defino controladora

$BarberosController= new MedicData();

//comprobar metodo

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

	//OBTENGO DATOS ENVIADOS
	  	//Solamente cuando es json

		//$body = json_decode(file_get_contents("php://input"), true);

		//Cuando son uno o varios parametros

		//$body=$_GET; 

	//LLAMO A LA FUNCION CON LOS PARAMETROS

	$rta=$BarberosController->getAll();

	//IMPRIMO RESPUESTA

	print(json_encode($rta));

}

?>
