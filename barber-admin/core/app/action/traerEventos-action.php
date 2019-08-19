<?php
$thejson=null;
$events = ReservationData::getEvery($_SESSION["barbero"]);
//var_dump($events);
if (count($events)>0) {
    foreach ($events as $event) {
        $cliente=PacientData::getById($event->cliente_id);
        $servicio=CategoryData::getById($event->servicio_id);
        $servnom=$servicio->nombre;
        if ($event->cliente_id==0){
            $nombrecliente="Inactivo";
        }else {
            $nombrecliente = $cliente->nombre;
            $apellidocliente=$cliente->apellido;
            $telcliente=$cliente->telefono;
        }

        if ($event->estado_pago_id == 2){
            $color='green';
        }elseif($event->estado_pago_id == 3){
            $color='red';
        }elseif($event->inactivo == 1){
            $color='gray';
        }else{
            $color='';
        }
        if(($event->inactivo == 1)){
            $thejson[] = array("color" => $color,"start" => $event->fecha . "T" . $event->hora,"event_id"=>$event->id,
                "title"=>$servnom.'<br>'.$nombrecliente,"end"=> $event->fecha . "T" . $event->endturno);
        }else {
            $thejson[] = array("color" => $color, "start" => $event->fecha . "T" . $event->hora, "event_id" => $event->id,
                "title"=>$servnom.'<br>'.$nombrecliente.'  '.$apellidocliente.' <br> Teléfono: '.$telcliente, "end"=> $event->fecha . "T" . $event->endturno);
        }
    }

}
echo json_encode($thejson,JSON_UNESCAPED_UNICODE);