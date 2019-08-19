<?php 

//FIJAS
include("../../controller/TableroController.php");

header('Access-Control-Allow-Origin: *');

//defino controladora

$tableroController= new TableroController();

//comprobar metodo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//OBTENGO DATOS ENVIADOS

	   	//Solamente cuando es json
		//$body = json_decode(file_get_contents("php://input"), true);

		//Cuando son uno o varios parametros
		$body=$_POST; 
		//var_dump($body);

	//LLAMO A LA FUNCION CON LOS PARAMETROS
		$rta=$tableroController->VerHerramienta($body['idherramientas_tablero']);

	//IMPRIMO RESPUESTA

		print(json_encode($rta->getJson()));
}

?>
