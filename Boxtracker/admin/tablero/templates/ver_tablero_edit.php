<?php
/// DEBERIA USAR LA NUEVA LIBRERIA PHP
include_once('../../lib_front/lib_php.php');
include_once("../../../BACKEND/model/Usuario.php");
session_start();
if (isset($_SESSION['user'])) {
  $id_user=$_SESSION['user']->getId();
}

$id_tablero=$_GET['id_tablero'];
$tablero=traer_tablero($id_tablero)->mensaje;
//var_dump($tablero);
?>
<div id="content">
 <form id="form_edicion_tablero" @submit.prevent="editar_tablero" method="POST" class="col-sm-10 col-sm-offset-1">
  <input type="hidden" name="estado" value="<?= $tablero->estado?>">
  <input type="hidden" name="visible" value="<?= $tablero->visible?>">
   <input type="hidden" name="id_tablero" value="<?= $tablero->id?>">
  <div class="form-group">
    <label>Nombre Tablero</label>
    <input type="text" maxlength="30" class="form-control" name="nombre_tablero" value="<?= $tablero->nombre_tablero?>">
  </div>
  <div class="form-group">
    <label>Tipo Período</label>
    <?php //echo $tablero->getTipo_periodo();?>
    <select name="tipo_periodo" class="form-control" required>
    	<option value="1">Días</option>
    	<option value="2">Semanas</option>
    	<option value="3">Quincenas</option>
    	<option value="4">Meses</option>
    </select>
  </div>
  <div class="form-group">
    <label>Cantidad Períodos</label>
    <input type="number" maxlength="1000" class="form-control" name="cant_periodos" value="<?= $tablero->cant_periodos?>" min="1">
  </div>
  <div class="form-group text-center">
  	<button type="submit" class="btn btn-success">Guardar</button>
  </div>
</form>
</div>
<script src="js/edit_tablero.js"></script>

 <?php

function traer_tablero($id_tablero){
	$lib_php = new lib_php();
	$server="http://" . $_SERVER["SERVER_NAME"];
	$url=$server."/boxtracker1/BACKEND/apis/tablero/VerTablero.php?id_tablero=".$id_tablero;
	$rta=$lib_php->llamar_api_get($url);

	return $rta;
	 
}
?>