<?php

$serv = CategoryData::getAll();

function calc_tiempo($hora_i,$duracion) {
    return date('H:i', strtotime($hora_i) + $duracion);
}

$rta = ReservationData::DisponibilidadNuevoTurno($_SESSION["barbero"],$_GET["fecha"],$_GET["hora"],calc_tiempo($_GET["hora"],3599));
$rta_horaMedia = ReservationData::DisponibilidadNuevoTurnoHoraMedia($_SESSION["barbero"],$_GET["fecha"],$_GET["hora"],calc_tiempo($_GET["hora"],5399));
//var_dump($rta);


if ($_GET["hora"]=="19:30"){
    foreach ($serv as $p):
        if ($p->tiempo == 1800) {
            echo '<option value="' . $p->id . '">' . $p->nombre . '</option>';
        }
    endforeach;
}else {
    if ($_GET["hora"] == "19:00") {
        foreach ($serv as $p):
            if (($p->tiempo == 1800) || ($p->tiempo == 3600)) {
                echo '<option value="' . $p->id . '">' . $p->nombre . '</option>';
            }
        endforeach;
    } else {
        if ($rta != null) {
            foreach ($serv as $p):
                if ($p->tiempo == 1800) {
                    echo '<option value="' . $p->id . '">' . $p->nombre . '</option>';
                }
            endforeach;
        } else {
            if ($rta_horaMedia==null){
                foreach ($serv as $p):
                        echo '<option value="' . $p->id . '">' . $p->nombre . '</option>';
                endforeach;
            }else {
                foreach ($serv as $p):
                    if (($p->tiempo == 1800) || ($p->tiempo == 3600)) {
                        echo '<option value="' . $p->id . '">' . $p->nombre . '</option>';
                    }
                endforeach;
            }
        }
    }
}

?>