<?php
$servicio=CategoryData::getById($_POST["servicio_id"]);
//$reservation = ReservationData::getById($_POST["id"]);

$serv = CategoryData::getAll();

function calc_tiempo($hora_i,$duracion) {
    return date('H:i', strtotime($hora_i) + $duracion);
}

$rta = ReservationData::DisponibilidadTurno($_POST["barbero_id"],$_POST["fecha"],$_POST["hora"],calc_tiempo($_POST["hora"],3599));
//var_dump($rta);
if ($_POST["hora"]=="19:30"){
    foreach ($serv as $p):
        if ($p->tiempo == 1800) {
            echo '<option value="' . $p->id . '" ' . (($p->id == $servicio->id) ? 'selected="selected"' : "") . '>' . $p->nombre . '</option>';
        }
    endforeach;
}else {
    if ($rta != null) {
        foreach ($serv as $p):
            if ($p->tiempo == 1800) {
                echo '<option value="' . $p->id . '" ' . (($p->id == $servicio->id) ? 'selected="selected"' : "") . '>' . $p->nombre . '</option>';
            }
        endforeach;
    } else {
        if (($rta != null) and (($rta->tiempo)) == 3600) {
            foreach ($serv as $p):
                echo '<option value="' . $p->id . '" ' . (($p->id == $servicio->id) ? 'selected="selected"' : "") . '>' . $p->nombre . '</option>';
            endforeach;
        } else {
            if ($rta == null) {
                foreach ($serv as $p):
                    echo '<option value="' . $p->id . '" ' . (($p->id == $servicio->id) ? 'selected="selected"' : "") . '>' . $p->nombre . '</option>';
                endforeach;
            }
        }

    }
}

?>