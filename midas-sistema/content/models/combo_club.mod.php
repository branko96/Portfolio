<?php
require_once("../admin/content/database.php");
$db=new database();
$db->conectar();
$query="select * from em_club order by nombreClub";
$clubes=$db->query($query);
?>