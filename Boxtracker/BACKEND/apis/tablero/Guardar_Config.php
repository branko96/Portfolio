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
		$body = json_decode(file_get_contents("php://input"), true);

		//Cuando son uno o varios parametros
		//$body=$_POST; 
		//var_dump($body);
		$id_tablero=$body['id_tablero'];
		$paleta=$body['color'];
		$tamanio=$body['tamanio'];
		$escritorio=1;
		$herramientas2=$body['herramientas'];
		$nombre_herramienta='grafico';
	//LLAMO A LA FUNCION CON LOS PARAMETROS
		$rta=$tableroController->GuardarConfig($id_tablero, $paleta, $tamanio, $herramientas2, $escritorio, $nombre_herramienta);

	//IMPRIMO RESPUESTA

		print(json_encode($rta->getJson()));
}

?>

