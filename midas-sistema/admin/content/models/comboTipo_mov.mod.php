<?php
require_once("content/database.php");
$db=new database();
$db->conectar();
$query="select * from em_tipomovimiento order by tipo";
return $db->query($query);
?>