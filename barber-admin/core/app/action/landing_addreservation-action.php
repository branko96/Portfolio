<?php
/**
* BookMedik
* @author evilnapsis
**/
$servicio=CategoryData::getById($_POST["servicio_id"]);
$duracion=$servicio->tiempo;
$precio=$servicio->importe;
function calc_tiempo($hora_i,$duracion) {
    return date('H:i', strtotime($hora_i) + $duracion);
}

date_default_timezone_set('America/Argentina/Buenos_Aires');
$datetime=date("Y-m-d h:i:s");
$rx = ReservationData::getRepeated($_POST['barbero_id'],$_POST["fecha"],$_POST["hora"]);
if($rx==null){
$r = new ReservationData();
// $r->notas = $_GET["notas"];
$r->fecha = $_POST["fecha"];
$r->end_fecha = $_POST["fecha"];
$r->hora = $_POST["hora"];
$r->fecha_reserva = $datetime;
$r->endturno=calc_tiempo($_POST["hora"],$duracion);
$r->cliente_id = $_POST["cliente_id"];
$r->usuario_id = 18;
$r->barbero_id = $_POST["barbero_id"];
$r->servicio_id = $_POST["servicio_id"];

$r->precio = 0;

$r->estado_pago_id = $_POST["estado_pago_id"];
$r->estado_id = $_POST["estado_id"];
$r->add();




    echo "Agregado exitosamente!";
}else{
    echo "Error al agregar, Turno Repetido!";
}
//Core::redir("./index.php?view=reservations");
?>
