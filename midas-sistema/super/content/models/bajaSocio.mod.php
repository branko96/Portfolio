<?php
if(isset($_POST['socio']))
	$numero=$_POST['socio'];
if($_POST['radios']==1)

   $query="DELETE from em_socios where nDocumento='$numero' limit 1";
else
   $query="DELETE from em_socios where nTarjeta='$numero' limit 1";

$db=new database();
$db->conectar();
$result_B=$db->query2($query);

?>