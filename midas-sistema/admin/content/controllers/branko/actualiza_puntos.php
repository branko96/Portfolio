<?php

require_once('../../conexion.php');
require_once('../../consultas.php');
$consultas=new consultas();
$dni=$_POST['dni'];
$puntos_a_actualizar=$_POST['puntos'];

$result=$consultas->buscar_socio($dni);

if($result != false){
	
	$id_socio=$result[0]['idSocios'];
	$nombre=$result[0]['nombre'];
	$movimientos=$consultas->traer_movimientos($id_socio);
	$puntos_socio=$result[0]['puntosAcumulados'];
	$movimientos_tabla='<input type="hidden" name="dni_socio" id="dni_socio" value="'.$dni.'"><div id="tabla_mov"><h1>Socio: '.$nombre.'</h1> <h2>Puntos Acumulados: '.$puntos_socio.'</h2><table id="movimientos" class="display dataTable" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Movimiento</th>
                <th>Puntos</th>
                <th>Importe</th>
                <th>Fecha</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>';
        if ($movimientos != false){
	        foreach ($movimientos as $key => $mov) {
	        	$movimiento=$consultas->traer_nombre_movimiento($mov["tipoMovimiento"]);
	        	if($mov["puntosSuma"]== null){
	        		$puntos_suma=0;
	        	}else{
	        		$puntos_suma=$mov["puntosSuma"];
	        	}
	        	if($mov["importe"]== null){
	        		$importe=0;
	        	}else{
	        		$importe=$mov["importe"];
	        	}
	        	$movimientos_tabla.='<tr>
                <td>'.$movimiento[0]['tipo'].'</td>
                <td>'.$puntos_suma.'</td>
                <td>$'.$importe.'</td>
                <td>'.$mov["fecha"].'</td>
                <td>';
                if($mov["puntosSuma"]>0){
                	$result= $puntos_socio - $mov["puntosSuma"];
                }else{
                	$puntos_a_restar=$mov["puntosSuma"]*-1;
                	$result= $puntos_socio + $puntos_a_restar;
                }
                
                if($result> 0 || $mov["puntosSuma"] == null){
                $movimientos_tabla.='<button class="btn btn-danger btn-anular" value="'.$result.'"><span class="glyphicon glyphicon-remove-sign"></span> Anular</button>';
                }else{
                $movimientos_tabla.='<span>No se anula</span>';	
                }
                //$movimientos_tabla.=$puntos_socio;	
                $movimientos_tabla.='</td>
            	</tr>';
	        }
	    }else{
	    	$movimientos_tabla.='<tr><td>No hay Movimientos del socio '.$id_socio.' </td></tr>';
	    }
            
           $movimientos_tabla.='</tbody>
    							</table></div>';
    	echo $movimientos_tabla;
}

?>
<script type="text/javascript">
        $(document).ready(function() {
            $("#movimientos").DataTable();

        });
        </script>