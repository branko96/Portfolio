<?php
require_once("../database.php");

session_start();

$db=new database();
$idClub=$_SESSION['club']['id'];
$db->conectar();
$query="SELECT * FROM `em_socios` WHERE `club` = '$idClub' AND `sexo` = 'M' ";
$query2="SELECT * FROM `em_socios` WHERE `club` = '$idClub' AND `sexo` = 'F' ";

$sexoSocio['M']= $db->queryCount($query);
$sexoSocio['F']= $db->queryCount($query2);


$sexo_json=json_encode($sexoSocio);

echo $sexo_json;
 ?>