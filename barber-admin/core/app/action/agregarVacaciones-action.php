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
$rx = ReservationData::DisponibilidadVacaciones($_GET["barbero_id"],$_GET["fecha"],$_GET["hora"]);
//var_dump($rx);

if($rx==null){
    $fechaaamostar = $_GET["fecha"];
    if(strtotime($_GET["endfecha"]) < strtotime($_GET["fecha"])){
        echo "La fecha final de sus vacaciones debe ser mayor que la de inicio";
    }else {
        while (strtotime($_GET["endfecha"]) >= strtotime($_GET["fecha"])) {
            if (strtotime($_GET["endfecha"]) != strtotime($fechaaamostar)) {
                $r = new ReservationData();
                $r->notas = $_GET["notas"];
                $r->fecha = $fechaaamostar;
                $r->hora = $_GET["hora"];
                $r->fecha_reserva = $datetime;
                $r->endturno = $_GET["hora_fin"];
                $r->cliente_id = $_GET["cliente_id"];
                $r->usuario_id = $_COOKIE["user_id"];
                $r->barbero_id = $_GET["barbero_id"];
                $r->servicio_id = $_GET["servicio_id"];
                $r->inactivo = "1";
                $r->precio = "0";

                $r->estado_pago_id = $_GET["estado_pago_id"];
                $r->estado_id = $_GET["estado_id"];
                $r->add_Vacaciones();

                //echo "$fechaaamostar";
                $fechaaamostar = date("Y-m-d", strtotime($fechaaamostar . " + 1 day"));
            } else {
                $r = new ReservationData();
                $r->notas = $_GET["notas"];
                $r->fecha = $fechaaamostar;
                $r->hora = $_GET["hora"];
                $r->fecha_reserva = $datetime;
                $r->endturno = $_GET["hora_fin"];
                $r->cliente_id = $_GET["cliente_id"];
                $r->usuario_id = $_SESSION["user_id"];
                $r->barbero_id = $_GET["barbero_id"];
                $r->servicio_id = $_GET["servicio_id"];
                $r->inactivo = "1";
                $r->precio = "0";

                $r->estado_pago_id = $_GET["estado_pago_id"];
                $r->estado_id = $_GET["estado_id"];
                $r->add_Vacaciones();
                //echo "$fechaaamostar";
                break;
            }
        }
        echo "Vacaciones cargadas correctamente!";
    }

}else{
    echo "No se pudo agregar las vacaciones ya que se encuentran turnos o vacaciones registrados en este periodo!";
}
//Core::redir("./index.php?view=reservations");
?>
