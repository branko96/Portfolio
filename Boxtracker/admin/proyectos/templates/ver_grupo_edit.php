<?php
/// DEBERIA USAR LA NUEVA LIBRERIA PHP
include_once('../../lib_front/lib_php.php');
include_once("../../../BACKEND/model/Usuario.php");
session_start();
if (isset($_SESSION['user'])) {
  $id_user=$_SESSION['user']->getId();
}

$id_grupo=$_POST['id_grupo'];
$grupo=traer_grupo($id_grupo)->mensaje;
//var_dump($grupo);
?>
<form id="form_editar_grupo">
	      <div class="modal-header text-center">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Edición Grupo - <?php echo $grupo->nombre;?></h4>
	      </div>
	      <div class="modal-body">
	      	<input type="hidden" name="fk_grupo" value="<?php echo $id_grupo;?>">
	      	<input type="hidden" name="id_usuario" value="<?php echo $id_user;?>">
	       		<div class="form-group">
	       			<label>Nombre</label>
	       			<input type="text" name="nombre" max-lenght="25" value="<?= $grupo->nombre ?>" class="form-control" required>
	       		</div>
	       		<div class="form-group">
	       			<label>Miembros</label>
	       			<div>
	       				<label><input type="checkbox" id="seleccionar_todos2" value="1"> Seleccionar Todos </label>
	       			</div>
	       			<?php
						$posibles_miembros=traer_posibles_miembros($id_user);
						//var_dump($sucursales);
						$miembros_selected=$grupo->miembros;
						if ($posibles_miembros->id_respuesta == '1' && count($posibles_miembros->mensaje)>0) {
							echo armar_combo_miembros($posibles_miembros->mensaje,'miembros[]','select_miembros',$miembros_selected);
						}else{
							echo "<select data-placeholder='Miembros' id='miembros' name='miembros[]' required></select>";
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
	        <div id="rta_editar" style="margin-top: 1rem;"></div>
	      </div>
      </form>

 <?php
function armar_combo_miembros($array,$nombre_combo,$id,$miembros_selected){
	$select='<select data-placeholder="Miembros" name="'.$nombre_combo.'" id="'.$id.'" multiple required>';
	if ($array != false && count($array)>0) {
		foreach ($array as $fila) {
			$selected='';
			if (count($miembros_selected)>0) {
				foreach ($miembros_selected as $miembro) {
					if ($miembro == $fila->id) {
						$selected='selected';
					}
				}
			}
			$select.='<option '.$selected.' value="'.$fila->id.'">'.$fila->nombre.' '.$fila->apellido.'</option>';
		}
	}
	$select.='</select>';
	return $select;
}
function traer_grupo($id_grupo){
	$lib_php = new lib_php();
	$server="http://" . $_SERVER["SERVER_NAME"];
	$url=$server."/boxtracker1/BACKEND/apis/proyectos/VerGrupo.php?id_grupo=".$id_grupo;
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