<?php
function calc_tiempo($hora_i,$duracion) {
    return date('H:i', strtotime($hora_i) + $duracion);
}

$horarios_todos = array();
array_push($horarios_todos, '10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30');

//var_dump($horarios_todos);

$horarios_disponibles=[];

foreach ($horarios_todos as $key => $horario) {
  //var_dump($horario):
  if ($_POST['servicio_id']==1) {
  		$rx = ReservationData::getRepeated($_POST['barbero_id'],$_POST["fecha"],$horario);

		if($rx==null){ //no existe turno		
			if (count($horarios_todos) > $key+1) {	
  			$hora_i=calc_tiempo($horario,60);
	  		$hora_f=calc_tiempo($horarios_todos[$key+1],-60);
	  			$rx1 = ReservationData::getRepeated_end($_POST['barbero_id'],$_POST["fecha"],$hora_i,$hora_f);
	  			//var_dump($rx1);
					if($rx1==null){ //no existe turno
						array_push($horarios_disponibles, $horario);	
					}
			}
		}

	}else{
		//caso ocupado1
		if (count($horarios_todos) > $key+2) {
			//$rx2 = ReservationData::getRepeated($_POST['barbero_id'],$_POST["fecha"],$horarios_todos[$key+1]);
			$hora_i=calc_tiempo($horario,60);
			$rx2 = ReservationData::getRepeated_end($_POST['barbero_id'],$_POST["fecha"],$hora_i,$horarios_todos[$key+2]);
			
			//var_dump($hora_i);
			// var_dump($horarios_todos[$key+1]);

			// var_dump($rx2);
			if ($rx2==null) {
				//si es null podemos guardar el servicio de 1 hora
				array_push($horarios_disponibles, $horario);	
			}else{
				//ocupado2

			}
		}
	}
//echo "<br>"; var_dump($horarios_disponibles);
}
echo json_encode($horarios_disponibles);
?>