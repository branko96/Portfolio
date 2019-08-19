<?php
/**
* 
*/
class conexion extends PDO
{
	
	public function __construct()
	{
		try{
				$usuario="root";
				$password="";
			//    $conn = new PDO('mysql:host=localhost;dbname=midasmkt_bdd', $usuario, $password);
			//
			  //  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			     parent::__construct('mysql:host=localhost;dbname=midasmkt_bdd', $usuario, $password);
			}catch(PDOException $e){
			    echo "ERROR: " . $e->getMessage();
			}
	}
}

?>
