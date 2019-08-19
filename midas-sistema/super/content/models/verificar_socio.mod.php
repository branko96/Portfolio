<?php
require_once("../database.php");
session_start();
$socio=$_POST['socio'];
$tipo=$_POST['tipo'];// se refiere al tipo de busqueda 1- dni 2-tarjeta

$db=new database();
$idclub=$_SESSION['club']['id'];
$db->conectar();

if($tipo==1)
	$query="SELECT * FROM em_socios s LEFT JOIN em_tipo_cliente tp ON s.club=tp.club LEFT JOIN em_config cf ON s.club=cf.club WHERE s.nDocumento='$socio' AND s.club='$idclub' AND s.club=tp.club";  
if($tipo==2)
	$query="SELECT * FROM em_socios s LEFT JOIN em_tipo_cliente tp ON s.club=tp.club LEFT JOIN em_config cf ON s.club=cf.club WHERE s.nTarjeta='$socio' AND s.club='$idclub' AND s.club=tp.club";   

	         
	$result=$db->queryList($query);
 	
 return $result;
 ?>