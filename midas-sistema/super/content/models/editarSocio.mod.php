<?php

$numero=$_POST['socio'];
$club=$club['id'];

if($_POST['radios']==1){
	
   $query="SELECT * from em_socios WHERE nDocumento='$numero' AND club='$club'limit 1";
}else{
	
   $query="SELECT * from em_socios WHERE nTarjeta='$numero' AND club='$club' limit 1";
}

$db=new database();
$db->conectar();
$result_E=$db->queryList($query);
return $result_E; //retorna los datos del socio a modificar


?>