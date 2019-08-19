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
<style type="text/css">
	.slide-fade-enter-active {
  transition: all .3s ease;
}
.slide-fade-leave-active {
  transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
</style>
<link rel="stylesheet" type="text/css" href="css/transicion_vue.css">
<div id="main_editar">
<div class="x_title">
  <div class="col-sm-8">
    <h2>Edición de Tablero</h2>
    <a class="ver_finalizados" data-toggle="tooltip" data-placement="top" title="Proyectos Finalizados" @click="finalizados= !finalizados;cambiar_color();" style="text-align:center;"><i class="fa fa-eye"></i></a>
  </div>
  <div class="col-sm-4">
    <button class="btn-horizontal btn btn-success" v-if="tableros.length > 1" @click="listahorizontal= !listahorizontal"><i class="fa fa-list-ol"></i></button>
  </div>
<div class="clearfix"></div> 
</div>
<div class="x_content">

<div class="row">
<div class="col-sm-4">
  <transition name="fade">
    
  <div id="tabla1" class="" v-show="!finalizados">
    <p>Proyectos Vigentes</p>
  <?php if(count($proyectos->mensaje)>0){
    ?>

    <!-- <button type="button" data-toggle="modal" data-target="#modal_config" class="btn btn-floating" role="modal"></button> -->
    
    <ul id="tree1">
        <li><a href="#">Mis Proyectos</a>
          <ul>
    <?php 
      foreach ($proyectos->mensaje as $proyecto) {
    ?>
        <li><a class="ver_tableros" @click="cargarTableros(<?php echo $proyecto->id; ?>)"><?php echo $proyecto->nombre; ?></a></li>

    <?php } ?>
      </ul>
    </li>
  </ul>

    <?php

    }else{
      echo "<h2>No tienes Proyectos Asignados</h2>";
    } ?>
</div>
</transition>
<transition name="fade">
<div id="tabla2" v-show="finalizados" class="">

  <p>Proyectos Finalizados</p>
  <?php if(count($proyectos_finalizados->mensaje)>0){ ?>

      <ul id="tree2">
        <li><a href="#">Mis Proyectos (finalizados)</a>
          <ul>

    <?php
      foreach ($proyectos_finalizados->mensaje as $proyecto) {
    ?>

      <li><a class="ver_tableros" @click="cargarTableros(<?php echo $proyecto->id; ?>)"><?php echo $proyecto->nombre; ?></a></li>
    <?php } ?>
    </ul>
    </li>
  </ul>
    <?php

    }else{
      echo "<h2>No tienes Proyectos Finalizados</h2>";
    } ?>
</div>
</transition>
</div>
<transition name="fade">
<div id="tableros" class="col-sm-8" v-show="showModal">
  <div class="text-center col-sm-12">
   <!--  <button type="button" @click="show_alta_tableros= !show_alta_tableros;show_form_edicion=false;" class=" btn-verde btn-floating btn-large"><i class="glyphicon glyphicon-plus"></i></button> -->

  </div>
<transition name="fade" mode="in-out">
<template v-if="show_form_edicion" >
  <div class="col-sm-12">
  <div class="panel panel-success">
    <div class="panel-heading text-center">Editar Tablero</div>
    <div class="panel-body">
      	<div id="div_form_edicion">
      		<form id="form_edicion_tablero" @submit.prevent="editar_tablero" method="POST" class="col-sm-10 col-sm-offset-1">
						  <input type="hidden" name="estado" v-model="form_edicion_tablero.estado" value="">
						  <input type="hidden" name="visible" v-model="form_edicion_tablero.visible" value="">
						   <input type="hidden" name="id_tablero" v-model="form_edicion_tablero.id" value="">
						  <div class="form-group">
						    <label>Nombre Tablero</label>
						    <input type="text" maxlength="30" class="form-control" name="nombre_tablero" v-model="form_edicion_tablero.nombre_tablero" value="">
						  </div>
						  <div class="form-group">
						    <label>Tipo Período</label>
						    <?php //echo $tablero->getTipo_periodo();?>
						    <select name="tipo_periodo" v-model="form_edicion_tablero.tipo_periodo" class="form-control" required>
						    	<option :selected="form_edicion_tablero.tipo_periodo == 1 ? true : false" value="1">Días</option>
						    	<option :selected="form_edicion_tablero.tipo_periodo == 2 ? true : false" value="2">Semanas</option>
						    	<option :selected="form_edicion_tablero.tipo_periodo == 3 ? true : false" value="3">Quincenas</option>
						    	<option :selected="form_edicion_tablero.tipo_periodo == 4 ? true : false" value="4">Meses</option>
						    </select>
						  </div>
						  <div class="form-group">
						    <label>Cantidad Períodos</label>
						    <input type="number" maxlength="1000" class="form-control" name="cant_periodos" v-model="form_edicion_tablero.cant_periodos" value="" min="1">
						  </div>
						  <div class="form-group text-center">
						  	<button type="submit" class="btn btn-success">Guardar</button>
						  </div>
			   </form>
      	</div>
      </div>
    </div>
  </div>
</template>
</transition>
<template  v-if="tableros.length > 0">
  <template v-if="listahorizontal">
        <div class="list-group col-sm-12 text-center" style="margin-top: 3rem;">
          	<div class="col-sm-6 tableros" v-for="tablero in tableros">
        		<div class="card-counter primary">
                    <div class="col-sm-3">
                      <a class=""><i class="fa fa-pencil editar_tablero" @click="ver_tablero_editar(tablero.id)"></i></a>
                    </div>
                    <div class="col-sm-9">
                      <span class="count-numbers">{{tablero.nombre_tablero}}</span>
                      <span class="count-name">{{tablero.cant_periodos}} <span v-if="tablero.tipo_periodo == 1">Días</span><span v-else-if="tablero.tipo_periodo == 2">Semanas</span><span v-else-if="tablero.tipo_periodo == 3">Quincenas</span><span v-else-if="tablero.tipo_periodo == 4">Meses</span></span>
                    </div>
                </div>  
            </div>
        </div>
        <!-- </div> -->
    </template>
    <template v-else>
      <div class="list-group col-sm-6 col-sm-offset-3 text-center">
           <a class=" tableros" v-for="tablero in tableros">
              <div class="list-group-item">
                  <span class="">{{tablero.nombre_tablero}}</span>
                  <span class="badge">{{tablero.cant_periodos}} <span v-if="tablero.tipo_periodo == 1">Días</span><span v-else-if="tablero.tipo_periodo == 2">Semanas</span><span v-else-if="tablero.tipo_periodo == 3">Quincenas</span><span v-else-if="tablero.tipo_periodo == 4">Meses</span></span>
              </div>  
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
</transition>

                       
<!-- 	                	<template  v-if="tableros.length > 0">
	                		<template v-if="listahorizontal">
		                		<div class="list-group col-sm-8 col-sm-offset-2 text-center" style="margin-top: 3rem;">
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
                            	<div class="list-group list-group-horizontal col-sm-12 text-center" style="margin-top: 3rem;">
                                    <a class="list-group-item tableros" v-for="tablero in tableros">
                                    	<span class="glyphicon glyphicon-tasks"></span>
                                    	<h4 class="list-group-item-heading">{{tablero.nombre_tablero}}</h4>
											<p class="list-group-item-text"><span class="badge">{{tablero.cant_periodos}}</span> Dias</p>
                                    	  
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
    </template>  -->

</div>
</div>
</div>
<script type="text/javascript" src="js/vue.js"></script>
<script src="js/vue-resource.min.js"></script>
<script src="js/editar_tablero.js"></script>
<script src="js/treeview.js"></script>
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