<?php
$servicio=CategoryData::getById($_GET["servicio_id"]);
$duracion=$servicio->tiempo;
$precio=$servicio->importe;
function calc_tiempo($hora_i,$duracion) {
    return date('H:i', strtotime($hora_i) + $duracion);
}

$rx = ReservationData::getRepeated($_SESSION["barbero"],$_GET["fecha"],$_GET["hora"]);

//var_dump($rx);
if($rx!=null){

    $reserva = ReservationData::getById($_GET["id"]);
    $reserva->notas = $_GET["notas"];

    $answer = $_GET['forma_pago'];

    if ($answer == "tarjeta") {
        $reserva->forma_pago="tarjeta";
    }elseif ($answer=="efectivo"){
        $reserva->forma_pago="efectivo";
    }


    $reserva->estado_pago_id = $_GET["estado_pago_id"];
    $reserva->servicio_id = $_GET["servicio_id"];
   // $user->estado_id = $_GET["estado_id"];
    $reserva->precio=$_GET["precio"];
    $reserva->endturno=calc_tiempo($_GET["hora"],$duracion);
    //var_dump($reserva);
    $reserva->update();

    echo "Actualizado exitosamente!";
}else{
    echo "Error al actualizar!";
}
//Core::alert("Actualizado exitosamente!");
//print "<script>window.location='index.php?view=home';</script>";



    ?>