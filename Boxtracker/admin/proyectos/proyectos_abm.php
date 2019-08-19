<?php 
include_once("../../BACKEND/model/Usuario.php");
session_start();
if (isset($_SESSION['user'])) {
  $id_user=$_SESSION['user']->getId();
}


$proyectos=traer_proyectos($id_user);
//var_dump($proyectos);
$body='';
if ($proyectos->id_respuesta == "1" && count($proyectos->mensaje)>0) {
	foreach ($proyectos->mensaje as $proyecto) {
		$body.='<tr>';
        $body.='<td>'.$proyecto->nombre.'</td>';
        $body.='<td>'.$proyecto->descripcion.'</td>';
        $body.='<td>'.$proyecto->id_group.'</td>';
        $body.='<td><button type="button" class="btn btn-danger btn-xs">'.$proyecto->estado.'</button></td>';
        $body.='<td>
        	<a href="#" data-id="'.$proyecto->id.'" class="btn btn-success btn-xs btn-editar"><i class="fa fa-pencil"></i> Editar </a>
        	<a href="#" data-id="'.$proyecto->id.'" class="btn btn-danger btn-xs btn-borrar"><i class="fa fa-trash-o"></i> Finalizar </a></td>';
        $body.='</tr>';
	}

	 $tabla ='<table id="tabla_proyectos" class="table table-striped projects">'.
						    '<thead><tr>'.
						    '<th>Nombre Proyecto</th><th>Descripción</th><th>Grupo</th><th>Estado</th><th>Acciones</th>'.
						    '</tr></thead>'.
						    '<tbody>'.$body.'</tbody></table>';
}else{
	 $tabla='<div style="padding:20px; font-size:20px;" class="alert alert-success text-center col-sm-6 col-sm-offset-3"><strong>No tienes proyectos asignados</strong></div>';
}
//FINALIZADOS
$body="";
$proyectos_finalizados=traer_proyectos_finalizados($id_user);
if ($proyectos_finalizados->id_respuesta == "1" && count($proyectos_finalizados->mensaje)>0) {
	foreach ($proyectos_finalizados->mensaje as $proyecto) {
		$body.='<tr>';
        $body.='<td>'.$proyecto->nombre.'</td>';
        $body.='<td>'.$proyecto->descripcion.'</td>';
        $body.='<td>'.$proyecto->id_group.'</td>';
        $body.='<td><button type="button" class="btn btn-danger btn-xs">'.$proyecto->estado.'</button></td>';
        $body.='<td>
        	<a href="#" data-id="'.$proyecto->id.'" class="btn btn-success btn-xs btn-editar"><i class="fa fa-pencil"></i> Editar </a>';
        $body.='</tr>';
	}

	 $tabla_finalizados ='<table id="tabla_proyectos2" class="table table-striped projects">'.
						    '<thead><tr>'.
						    '<th>Nombre Proyecto</th><th>Descripción</th><th>Grupo</th><th>Estado</th><th>Acciones</th>'.
						    '</tr></thead>'.
						    '<tbody>'.$body.'</tbody></table>';
}else{
	 $tabla_finalizados='<div style="padding:20px; font-size:20px;" class="alert alert-success text-center col-sm-6 col-sm-offset-3"><strong>No tienes proyectos finalizados</strong></div>';
}
echo '<div class="x_title">
                    <h2>Proyectos</h2>
                    <a id="ver_finalizados" data-toggle="tooltip" data-placement="top" title="Proyectos Finalizados" style="text-align:center;"><i class="fa fa-eye"></i></a>
                    <a id="alta_proyecto" style="float:right;" class="btn-floating btn-large btn-primary"><i class="glyphicon glyphicon-plus"></i></a>';


echo '<div class="clearfix"></div>
                  </div>
                  <div class="x_content" id="div_tabla">';
echo '<div id="tabla1">';
echo $tabla;
echo '</div>';

echo '<div id="tabla2" hidden>';
echo $tabla_finalizados;
echo '</div></div></div>';

?>
<link rel="stylesheet" type="text/css" href="css/boton_add.css">
<style type="text/css">
	#ver_finalizados{
		cursor: pointer;
		width: 20px;   
		font-size: 23px;
	    margin: 50px;
	    margin-top: 1rem;
	}
	#ver_finalizados:hover{
		color:grey;
	}
</style>
<div id="modal_alta_proyecto" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_alta_proyecto" enctype="multipart/form-data">
	      <div class="modal-header text-center">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Alta Proyecto</h4>
	      </div>
	      <div class="modal-body">
	      	<input type="hidden" name="id_creador" value="<?php echo $id_user;?>">
	      	<input type="hidden" name="estado" value="1">
	       		<div class="form-group">
	       			<label>Nombre</label>
	       			<input type="text" name="nombre" max-lenght="25" class="form-control" required>
	       		</div>
	       		<div class="form-group">
	       			<label>Descripcion</label>
	       			<textarea name="descripcion" class="form-control" required></textarea>
	       		</div>
	       		<div class="form-group">
	       			<label>Pais</label>
	       			<input type="text" name="pais" max-lenght="25" class="form-control" required>
	       		</div>
	       		<div class="form-group">
	       			<label>Ciudad</label>
	       			<input type="text" name="ciudad" max-lenght="25" class="form-control" required>
	       		</div>
	       		
	       		<div class="form-group">
	       			<label>Grupo</label>
	                <!-- <select id="grupos" class="form-control" name="id_group" required>
	                  <option value="1">Constructora</option>
	                  <option value="2">Obras Centro</option>
	                </select>  -->
	                <?php
						$grupos=traer_grupos_user($id_user);
						//var_dump($sucursales);
						if ($grupos->id_respuesta == '1' && count($grupos->mensaje)>0) {
							echo armar_combo_grupos($grupos->mensaje,'id_group','grupos');
						}else{
							echo "<select id='grupos' name='id_group' required></select>";
						}
					?>
	       		</div>
	       		<div class="form-group">
	       			<label>Imagen Proyecto</label>
	       			<input type="file" name="foto_proyecto" class="form-control">
	       		</div>

	      </div>
	      <div class="modal-footer text-center" style="text-align: center !important;">
	      	<button type="submit" class="btn btn-success">Guardar</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <div id="rta_alta" style="margin-top: 1rem;"></div>
	      </div>
      </form>
    </div>

  </div>
</div>


<div id="modal_editar_proyecto" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" id="div_form_editar">
      
    </div>

  </div>
</div>
<script src="js/proyectos_abm.js"></script>
<?php
function armar_combo_grupos($array,$nombre_combo,$id){
	$select='<select name="'.$nombre_combo.'" id="'.$id.'" required>';
	if ($array != false && count($array)>0) {
		$select.='<option value="0">Grupos</option>';
		foreach ($array as $fila) {
			$select.='<option value="'.$fila->id.'">'.$fila->nombre.'</option>';
		}
	}
	$select.='</select>';
	return $select;
}

function traer_proyectos($id_user){
	$curl = curl_init();
	$uri="http://" . $_SERVER["SERVER_NAME"];
	curl_setopt_array($curl, array(
	  CURLOPT_URL => $uri."/boxtracker1/BACKEND/apis/proyectos/Proyect_idcreador.php?id_creador=".$id_user,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
	    "Cache-Control: no-cache",
	    "Postman-Token: 9fc5a6b2-409f-414b-ba52-09ad9c6a196a"
	  ),
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
		if ($err) {
		  $r= "cURL Error #:" . $err;
		} else {
		  $r=json_decode($response);
		}
	return $r;
}

function traer_grupos_user($id_user){
	$curl = curl_init();
	$uri="http://" . $_SERVER["SERVER_NAME"];
	curl_setopt_array($curl, array(
	  CURLOPT_URL => $uri."/boxtracker1/BACKEND/apis/proyectos/traer_gruposUser.php?id_usuario=".$id_user,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
	    "Cache-Control: no-cache",
	    "Postman-Token: 9fc5a6b2-409f-414b-ba52-09ad9c6a196a"
	  ),
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
		if ($err) {
		  $r= "cURL Error #:" . $err;
		} else {
		  $r=json_decode($response);
		}
	return $r;
}


function traer_proyectos_finalizados($id_user){
	$curl = curl_init();
	$uri="http://" . $_SERVER["SERVER_NAME"];
	curl_setopt_array($curl, array(
	  CURLOPT_URL => $uri."/boxtracker1/BACKEND/apis/proyectos/Proyectos_finalizados.php?id_creador=".$id_user,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
	    "Cache-Control: no-cache",
	    "Postman-Token: 9fc5a6b2-409f-414b-ba52-09ad9c6a196a"
	  ),
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
		if ($err) {
		  $r= "cURL Error #:" . $err;
		} else {
		  $r=json_decode($response);
		}
	return $r;
}
?>
