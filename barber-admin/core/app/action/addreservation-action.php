<?php
/**
* BookMedik
* @author evilnapsis
**/
$servicio=CategoryData::getById($_GET["servicio_id"]);
$duracion=$servicio->tiempo;
$precio=$servicio->importe;
function calc_tiempo($hora_i,$duracion) {
    return date('H:i', strtotime($hora_i) + $duracion);
}
//var_dump($_POST);

date_default_timezone_set('America/Argentina/Buenos_Aires');
$datetime=date("Y-m-d h:i:s");
$rx = ReservationData::getRepeated($_SESSION['barbero'],$_GET["fecha"],$_GET["hora"]);
if($rx==null){
$r = new ReservationData();
$r->notas = $_GET["notas"];
$r->fecha = $_GET["fecha"];
$r->end_fecha = $_GET["fecha"];
$r->hora = $_GET["hora"];
$r->fecha_reserva = $datetime;
$r->endturno=calc_tiempo($_GET["hora"],$duracion);
$r->cliente_id = $_GET["cliente_id"];
$r->usuario_id = $_COOKIE["user_id"];
$r->barbero_id = $_SESSION["barbero"];
$r->servicio_id = $_GET["servicio_id"];

$r->precio = 0;

$r->estado_pago_id = $_GET["estado_pago_id"];
$r->estado_id = $_GET["estado_id"];
$r->add();




    echo "Agregado exitosamente!";
}else{
    echo "Error al agregar, Turno Repetido!";
}
//Core::redir("./index.php?view=reservations");
?>
