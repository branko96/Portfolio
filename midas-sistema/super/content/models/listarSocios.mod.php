<?php 

require_once("../database.php");

$db=new database();
$idclub=$_SESSION['club']['id'];
$db->conectar();

$query="SELECT * FROM em_socios  WHERE club='$idclub' ORDER BY nombre ASC";

$data=$db->queryList($query);
echo json_encode($data);

?>