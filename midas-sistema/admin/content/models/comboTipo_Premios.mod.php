<?php
require_once("content/database.php");
$db=new database();
$db->conectar();
$query="select * from em_catpremios";
$categorias=$db->query($query);
$query="select categoria from em_precat";
$catPremio=$db->query($query);
?>