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
		$id_user=$body['id_user'];
		$nombre=$body['nombre'];
		$idproyecto=$body['idproyecto'];
		$herramientas2=$body['herramientas'];

		
	//LLAMO A LA FUNCION CON LOS PARAMETROS
		$rta=$tableroController->Guardar_Config_Plantilla($id_user, $nombre, $idproyecto, $herramientas2);

	//IMPRIMO RESPUESTA

		print(json_encode($rta->getJson()));
}

?>

