<?php
include_once("../../BACKEND/model/Usuario.php");
include_once('../lib_front/lib_php.php');
session_start();
if (isset($_SESSION['user'])) {
  $id_user=$_SESSION['user']->getId();
}
$proyectos=traer_proyectos($id_user);
$proyectos_finalizados=traer_proyectos_finalizados($id_user);
?>
<div class="x_title">
<h2>Importar...</h2>

<a class="ver_finalizados" data-toggle="tooltip" data-placement="top" title="Proyectos Finalizados" @click="finalizados= !finalizados;cambiar_color();" style="text-align:center;"><i class="fa fa-eye"></i></a>
<div class="clearfix"></div> 
</div>
<div class="x_content">

<div class="row">

  
  <div id="tabla1">
    <p>Proyectos Vigentes</p>
  <?php if(count($proyectos->mensaje)>0){
      foreach ($proyectos->mensaje as $proyecto) {
    ?>
        <!-- empieza proyecto -->
        <div class="col-md-55">
          <div class="thumbnail">
            <div class="image view view-first">
              <img style="width: 100%; display: block;" src="<?php echo $proyecto->imagen; ?>" alt="image">
              <div class="mask no-caption">
                <div class="tools tools-bottom">
                  <a class="btn_modal_tableros" @click="cargarTableros(<?php echo $proyecto->id; ?>)"><i class="fa fa-list-ol"></i></a>
                  <!-- <a href=""><i class="fa fa-pencil"></i></a> -->
                </div>
              </div>
            </div>
            <div class="caption">
              <p><strong><?php echo $proyecto->nombre; ?></strong>
              </p>
              <p><?php echo $proyecto->descripcion; ?></p>
            </div>
          </div>
        </div>
        <!-- termina proyecto -->
    <?php } 

    }else{
      echo "<h2>No tienes Proyectos Asignados</h2>";
    } ?>
  </div>
<div id="tabla2" hidden>
   <p>Proyectos Finalizados</p>
  <?php if(count($proyectos_finalizados->mensaje)>0){
      foreach ($proyectos_finalizados->mensaje as $proyecto) {
    ?>
        <!-- empieza proyecto -->
        <div class="col-md-55">
          <div class="thumbnail">
            <div class="image view view-first">
              <img style="width: 100%; display: block;" src="<?php echo $proyecto->imagen; ?>" alt="image">
              <div class="mask no-caption">
                <div class="tools tools-bottom">
                  <a class="btn_modal_tableros"><i class="fa fa-list-ol"></i></a>
                  <!-- <a href=""><i class="fa fa-pencil"></i></a> -->
                </div>
              </div>
            </div>
            <div class="caption">
              <p><strong><?php echo $proyecto->nombre; ?></strong>
              </p>
              <p><?php echo $proyecto->descripcion; ?></p>
            </div>
          </div>
        </div>
        <!-- termina proyecto -->
    <?php } 

    }else{
      echo "<h2>No tienes Proyectos Finalizados</h2>";
    } ?>
</div>
     <template v-if="showModal">

	    <transition name="modal">
	      <div class="modal-mask">
	        <div class="modal-wrapper">
	          <div class="modal-dialog">
	            <div class="modal-content">
	              <div class="modal-header text-center">
	                <button type="button" class="close" @click="showModal=false; show_alta_tableros=false;">
	                  <span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title">Tableros del proyecto</h4>
	              </div>
	              <div class="modal-body ">
	              	<div class="row">
	                <div id="tableros" class="col-sm-12">
                          <div class="text-center col-sm-12">
                            <button type="button" @click="show_alta_tableros= !show_alta_tableros;show_form_edicion=false;" class=" btn-verde btn-floating btn-large"><i class="glyphicon glyphicon-plus"></i></button>
                            <button class="btn-horizontal btn btn-success" v-if="tableros.length > 1" @click="listahorizontal= !listahorizontal"><i class="fa fa-list-ol"></i></button>
                          </div>
                        <template v-if="show_form_edicion">
                        	<div id="div_form_edicion" v-html="form_edicion_html"></div>
                        </template>
                        <template id="div_alta_tablero" v-if="show_alta_tableros" >
                          <form id="form_alta_tablero" @submit.prevent="crear_tablero" method="POST" class="col-sm-10 col-sm-offset-1">
                              <input type="hidden" name="id_proyecto" v-model="id_proyecto" value="0">
                              <input type="hidden" name="idusuario_creador" value="<?php echo $id_user;?>">
                              <input type="hidden" name="estado" value="1">
                              <input type="hidden" name="visible" value="1">
                              <div class="form-group">
                                <label>Nombre Tablero</label>
                                <input type="text" maxlength="30" class="form-control" name="nombre_tablero">
                              </div>
                              <div class="form-group">
                                <label>Tipo Período</label>
                                <select name="tipo_periodo" class="form-control" required>
                                	<option value="1">Días</option>
                                	<option value="2">Semanas</option>
                                	<option value="3">Quincenas</option>
                                	<option value="4">Meses</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Cantidad Períodos</label>
                                <input type="number" maxlength="1000" class="form-control" name="cant_periodos" value="1" min="1">
                              </div>
                              <div class="form-group text-center">
                              	<button type="submit" class="btn btn-success">Guardar</button>
                              </div>
                          </form>
                        </template>
	                	<template  v-if="tableros.length > 0">
	                		<template v-if="listahorizontal">
		                		<div class="list-group col-sm-8 col-sm-offset-2 text-center">
                                    <div class="list-group-item tableros" v-for="tablero in tableros">
                                    		<div class="col-sm-12">
	                                    		<div class="col-sm-2">
	                                    			<span class="glyphicon glyphicon-tasks"></span>
	                                    		</div>
	                                    		<div class="col-sm-6">
	                                    			<h4 class="list-group-item-heading">{{tablero.nombre_tablero}}</h4>
	                                    		</div>
	                                    		<div class="col-sm-2">
	                                    			<p class="list-group-item-text"><span class="badge">{{tablero.cant_periodos}}</span> Dias</p>
	                                    		</div>
	                                    		<div class="col-sm-2">
	                                    			<a class="btn"><i class="fa fa-pencil editar_tablero" @click="ver_tablero_editar(tablero.id)"></i></a>
	                                    		</div>
                                    		</div>
                                    </div>
                                </div>
                            </template>
                            <template v-else>
                            	<div class="list-group list-group-horizontal col-sm-12 text-center">
                                    <a class="list-group-item tableros" v-for="tablero in tableros">
                                    	<span class="glyphicon glyphicon-tasks"></span>
                                    	<h4 class="list-group-item-heading">{{tablero.nombre_tablero}}</h4>
											<p class="list-group-item-text"><span class="badge">{{tablero.cant_periodos}}</span> Dias</p>
                                    	   <!-- <span class="badge">25</span> -->
                                    </a>
                                </div>
                            </template>
                        </template>
                        <template v-else>
                            <div class="col-sm-12" >
                            	<div class="alert alert-warning text-center" style="margin-top: 2rem;">
                            		No Hay tableros para este proyecto
                            	</div>
                            </div>
                        </template>
                        
        			</div>
        			</div>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	      </div>
	    </transition>
    </template> 

</div>
</div>

<?php

function traer_proyectos($id_user){
  $lib_php = new lib_php();
  $server="http://" . $_SERVER["SERVER_NAME"];
  $url=$server."/boxtracker1/BACKEND/apis/tablero/Traer_Allproyects.php?id_creador=".$id_user;
  $rta=$lib_php->llamar_api_get($url);

  return $rta;
}
function traer_proyectos_finalizados($id_user){
  $lib_php = new lib_php();
  $server="http://" . $_SERVER["SERVER_NAME"];
  $url=$server."/boxtracker1/BACKEND/apis/tablero/traer_finalizados.php?id_creador=".$id_user;
  $rta=$lib_php->llamar_api_get($url);

  return $rta;
}
?>