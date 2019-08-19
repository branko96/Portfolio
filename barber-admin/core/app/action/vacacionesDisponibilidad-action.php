<?php
$respuesta=null;
$rta = ReservationData::DisponibilidadVacaciones($_SESSION["barbero"],$_GET["fecha"],$_GET["hora"]);
//var_dump($rta);
if (count($rta)>0){
    $respuesta[]=array($rta);
}
echo json_encode($respuesta);

?>