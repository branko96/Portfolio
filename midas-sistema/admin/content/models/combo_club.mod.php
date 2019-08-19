<?php
require_once("content/database.php");
$db=new database();
$db->conectar();
$query="select idSocios";
return $db->query($query);
?>