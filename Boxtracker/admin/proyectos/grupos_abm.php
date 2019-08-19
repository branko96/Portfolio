<?php 
include_once("../../BACKEND/model/Usuario.php");
include_once('../lib_front/lib_php.php');
session_start();
if (isset($_SESSION['user'])) {
  $id_user=$_SESSION['user']->getId();
}


$grupos=traer_grupos_user($id_user);
//var_dump($grupos);
$body='';
if ($grupos->id_respuesta == "1" && count($grupos->mensaje)>0) {
	foreach ($grupos->mensaje as $grupo) {
		$body.='<tr>';
        $body.='<td>'.$grupo->nombre.'</td>';
        $body.='<td>
        	<a href="#" data-id="'.$grupo->id.'" data-nombre="'.$grupo->nombre.'" class="btn btn-success btn-xs btn-vermiembros"><i class="fa fa-user"></i> Ver Miembros </a>
        	<a href="#" data-id="'.$grupo->id.'" data-nombre="'.$grupo->nombre.'" class="btn btn-success btn-xs btn-verproyectos"><i class="fa fa-building-o"></i> Ver Proyectos </a>
        	<a href="#" data-id="'.$grupo->id.'" class="btn btn-success btn-xs btn-editar"><i class="fa fa-pencil"></i> Editar </a>
        	<a href="#" data-id="'.$grupo->id.'" class="btn btn-danger btn-xs btn-borrar"><i class="fa fa-trash-o"></i> Eliminar </a></td>';
        $body.='</tr>';
	}

	 $tabla ='<table id="tabla_grupos" class="table table-striped projects">'.
						    '<thead><tr>'.
						    '<th>Nombre Grupo</th><th>Acciones</th>'.
						    '</tr></thead>'.
						    '<tbody>'.$body.'</tbody></table>';
}else{
	 $tabla='<div style="padding:20px; font-size:20px;" class="alert alert-success text-center col-sm-6 col-sm-offset-3"><strong>No perteneces a ningún grupo</strong></div>';
}
echo '<div class="x_title">
                    <h2>Grupos</h2> <a id="alta_grupo" style="float:right;" class="btn-floating btn-large btn-primary"><i class="glyphicon glyphicon-plus"></i></a>';


echo '<div class="clearfix"></div>
                  </div>
                  <div class="x_content" ><div class=" col-sm-12" id="div_tabla">';
echo $tabla;

echo '</div></div></div>';
?>  
<link rel="stylesheet" type="text/css" href="css/boton_add.css">

<div id="modal_alta_grupo" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_alta_grupo">
	      <div class="modal-header text-center">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Alta Grupo</h4>
	      </div>
	      <div class="modal-body">
	      	<input type="hidden" name="id_usuario" value="<?php echo $id_user;?>">
	       		<div class="form-group">
	       			<label>Nombre</label>
	       			<input type="text" name="nombre" max-lenght="25" class="form-control" required>
	       		</div>
	       		<div class="form-group">
	       			<label>Miembros</label>
	       			<div>
	       			<label><input type="checkbox" id="seleccionar_todos" value="1"> Seleccionar Todos </label>
	       			</div>
	       			<?php
						$posibles_miembros=traer_posibles_miembros($id_user);
						//var_dump($sucursales);
						if ($posibles_miembros->id_respuesta == '1' && count($posibles_miembros->mensaje)>0) {
							echo armar_combo_miembros($posibles_miembros->mensaje,'miembros[]','miembros');
						}else{
							echo "<select data-placeholder='Miembros' id='miembros' name='miembros[]'></select>";
						}
					?>
	                <!-- <select id="miembros" multiple class="form-control" name="miembros[]" required>
	                  <option value="2">Pepe</option>
	                  <option value="3">Tito</option>
	                </select>  -->
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

<div id="modal_editar_grupo" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" id="div_form_editar">
      
    </div>
  </div>
</div>

<div id="modal_ver_miembros" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header text-center">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title" id="nombre_grupo_miembros"></h4>
	    </div>
      	<div id="div_miembros_grupo" style="padding: 20px;min-height: 300px;" class=""></div>
    	<div class="modal-footer text-center" style="text-align: center !important;">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	    </div>
    </div>
  </div>
</div>

<div id="modal_ver_proyectos" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header text-center">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title" id="nombre_grupo_proyectos"></h4>
	    </div>
      	<div id="div_proyectos_grupo" style="padding: 20px;min-height: 300px;" class=""></div>
    	<div class="modal-footer text-center" style="text-align: center !important;">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	    </div>
    </div>
  </div>
</div>

<div id="modal_asignar_grupo" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header text-center">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Asignacion de Proyectos a Grupo</h4>
	    </div>
	    <div class="modal-body row">
		    <div id="div_grupos" style="" class="col-sm-12 row">
		    </div>
	    </div>
    	<div class="modal-footer text-center" style="text-align: center !important;">
    		<div>
    			<button type="button" class="btn btn-success" id="btn_asignar_grupo">Asignar</button>
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    		</div>
    		
	        <div id="rta_asign" style=""></div>
	    </div>
    </div>
  </div>
</div>
<script src="js/grupos_abm.js"></script>
<?php
function armar_combo_miembros($array,$nombre_combo,$id){
	$select='<select data-placeholder="Miembros" name="'.$nombre_combo.'" id="'.$id.'" multiple >';
	if ($array != false && count($array)>0) {
		foreach ($array as $fila) {
			$select.='<option value="'.$fila->id.'">'.$fila->nombre.' '.$fila->apellido.'</option>';
		}
	}
	$select.='</select>';
	return $select;
}
function traer_grupos_user($id_user){
	$lib_php = new lib_php();
	$server="http://" . $_SERVER["SERVER_NAME"];
	$url = $server."/boxtracker1/BACKEND/apis/proyectos/traer_gruposUser.php?id_usuario=".$id_user;
	$rta=$lib_php->llamar_api_get($url);
	return $rta;
	  
}
function traer_posibles_miembros($id_user){
	$lib_php = new lib_php();
	$server="http://" . $_SERVER["SERVER_NAME"];
	$url = $server."/boxtracker1/BACKEND/apis/proyectos/Traerposible_miembros.php?id_padre=".$id_user;
	$rta=$lib_php->llamar_api_get($url);
	return $rta;
	  
}

?>
