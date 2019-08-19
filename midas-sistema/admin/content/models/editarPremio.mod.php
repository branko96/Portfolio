<?php
require_once("content/database.php");
$numero=$_POST['selectPremio'];
$bd=new database();
$bd->conectar();
$query="SELECT a.*,(select b.imgUrl from em_imagenes b where a.idpremios=b.idPremios) as img from em_premios a  where a.idpremios='$numero'";
$data= $bd->queryList($query);
return $data;
?>