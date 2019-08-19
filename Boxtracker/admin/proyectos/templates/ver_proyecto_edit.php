<?php
/// DEBERIA USAR LA NUEVA LIBRERIA PHP
include_once('../../lib_front/lib_php.php');
include_once("../../../BACKEND/model/Usuario.php");
session_start();
if (isset($_SESSION['user'])) {
  $id_user=$_SESSION['user']->getId();
}

$id_proyect=$_POST['id_proyect'];
$proyecto=traer_proyecto($id_proyect)->mensaje;
?>
<form id="form_editar_proyecto">
	      <div class="modal-header text-center">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Edicion Proyecto - <?php echo $proyecto->nombre;?></h4>
	      </div>
	      <div class="modal-body">
	      	<input type="hidden" name="id_proyect" value="<?php echo $proyecto->id;?>">
	      	<input type="hidden" name="estado" value="1">
	       		<div class="form-group">
	       			<label>Nombre</label>
	       			<input type="text" name="nombre" max-lenght="25" class="form-control" value="<?= $proyecto->nombre ?>" required>
	       		</div>
	       		<div class="form-group">
	       			<label>Descripcion</label>
	       			<textarea name="descripcion" class="form-control" required><?= $proyecto->descripcion ?></textarea>
	       		</div>
	       		<div class="form-group">
	       			<label>Pais</label>
	       			<input type="text" name="pais" max-lenght="25" value="<?= $proyecto->pais ?>" class="form-control" required>
	       		</div>
	       		<div class="form-group">
	       			<label>Ciudad</label>
	       			<input type="text" name="ciudad" max-lenght="25" value="<?= $proyecto->ciudad ?>" class="form-control" required>
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
							echo armar_combo_grupos($grupos->mensaje,'id_group','select_grupos',$proyecto->id_group);
						}else{
							echo "<select id='select_grupos' name='id_group' required></select>";
						}
					?>
	       		</div>
	       		<div class="form-group">
	       			<label>Estado</label>
	       			<?php
						$estados=traer_estados();
						//var_dump($sucursales);
						if ($estados->id_respuesta == '1' && count($estados->mensaje)>0) {
							echo armar_combo_estados($estados->mensaje,'estado','estado',$proyecto->estado);
						}else{
							echo "<select id='estado' name='estado' required></select>";
						}
					?>
	       		</div>

	      </div>
	      <div class="modal-footer text-center" style="text-align: center !important;">
	      	<button type="submit" class="btn btn-success">Guardar</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        <div id="rta_editar" style="margin-top: 1rem;"></div>
	      </div>
      </form>

 <?php
 function armar_combo_grupos($array,$nombre_combo,$id, $grupo_selected){
	$select='<select name="'.$nombre_combo.'" id="'.$id.'" required>';
	if ($array != false && count($array)>0) {
		$select.='<option value="0">Grupos</option>';
		foreach ($array as $fila) {
			if ($fila->id == $grupo_selected) {
				$select.='<option value="'.$fila->id.'" selected>'.$fila->nombre.'</option>';
			}else{
				$select.='<option value="'.$fila->id.'">'.$fila->nombre.'</option>';
			}
			
		}
	}
	$select.='</select>';
	return $select;
}
function armar_combo_estados($array,$nombre_combo,$id, $estado_selected){
	$select='<select name="'.$nombre_combo.'" id="'.$id.'" required>';
	if ($array != false && count($array)>0) {
		$select.='<option value="0">Estados</option>';
		foreach ($array as $fila) {
			if ($fila->id_respuesta == $estado_selected) {
				$select.='<option value="'.$fila->id_respuesta.'" selected>'.$fila->mensaje.'</option>';
			}else{
				$select.='<option value="'.$fila->id_respuesta.'">'.$fila->mensaje.'</option>';
			}
			
		}
	}
	$select.='</select>';
	return $select;
}
function traer_proyecto($id_proyect){
	$lib_php = new lib_php();
	$server="http://" . $_SERVER["SERVER_NAME"];
	$url=$server."/boxtracker1/BACKEND/apis/proyectos/VerProyecto.php?id_proyect=".$id_proyect;
	$rta=$lib_php->llamar_api_get($url);

	return $rta;
	 
}
function traer_grupos_user($id_user){
	$lib_php = new lib_php();
	$server="http://" . $_SERVER["SERVER_NAME"];
	$url = $server."/boxtracker1/BACKEND/apis/proyectos/traer_gruposUser.php?id_usuario=".$id_user;
	$rta=$lib_php->llamar_api_get($url);
	return $rta;
	  
}

function traer_estados(){
	$lib_php = new lib_php();
	$server="http://" . $_SERVER["SERVER_NAME"];
	$url = $server."/boxtracker1/BACKEND/apis/proyectos/TraerEstados.php";
	$rta=$lib_php->llamar_api_get($url);
	return $rta;
	  
}
?>