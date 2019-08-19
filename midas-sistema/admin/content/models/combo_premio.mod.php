<?php
require_once("content/database.php");
$db=new database();
$club=$_SESSION['club']['id'];
$db->conectar();
$query="select idpremios,titulo from em_premios where club='$club' order by titulo";
return $db->query($query);
?>