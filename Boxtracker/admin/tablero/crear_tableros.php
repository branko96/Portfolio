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
<!-- <link rel="stylesheet" type="text/css" href="css/tree.css"> -->
<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> -->
<div id="main_crear">
  <input type="hidden" name="idusuario" id="idusuario" value="<?php echo $id_user;?>">
<div class="x_title" >
<div class="col-sm-8">
  <h2>Alta de Tablero</h2>
  <!-- <button type="button" class="btn btn-success" @click="arboless">Arbol</button> -->
  <a class="ver_finalizados" data-toggle="tooltip" data-placement="top" title="Proyectos Finalizados" @click="finalizados= !finalizados;cambiar_color();" style="text-align:center;"><i class="fa fa-eye"></i></a>
</div>
<div class="col-sm-4" style="display: flex;">
  <button type="button" v-show="vista_tableros" @click="show_alta_tableros= !show_alta_tableros;show_form_edicion=false;foco_nombre();" class=" btn-verde btn-floating btn-large"><i class="glyphicon glyphicon-plus"></i></button>
    <button class="btn-horizontal btn btn-success" v-if="tableros.length > 1" @click="listahorizontal= !listahorizontal"><i class="fa fa-list-ol"></i></button>
  <template v-if="vista_config_tablero">
      <div class="row">
          <div class="col-sm-6 text-center">
            <h2>Tamaño</h2>
            <hr>
            <div class="btn-group">
              <button type="button" id="btn_drop_tamaños" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-file"></i><!--
                <span class="sr-only">Toggle Dropdown</span> -->
              </button>
              <ul class="dropdown-menu drop_tamaños" role="menu">
                <li v-for="tamanio in tamanios_tableros">
                  <a @click="drop_tamaños($event,tamanio)" href="#">
                    <center>
                      <div v-if="tamanio.idtamanios_tableros == 1" id="tam_a4"></div>
                      <div v-else-if="tamanio.idtamanios_tableros == 2" id="tam_a3"></div>
                      <div v-else-if="tamanio.idtamanios_tableros == 3" id="tam_vertical"></div>
                      <div v-else-if="tamanio.idtamanios_tableros == 4" id="tam_horizontal"></div>
                    </center>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6 text-center">
            <h2 style="width: 100%;">Color</h2>
              <hr>
            <div class="btn-group">
              <button type="button" id="btn_drop_colores" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-file"></i>
              </button>
              <ul class="dropdown-menu drop_colores" role="menu">
                <li v-for="color in colores_tableros">
                  <a @click="drop_colores($event,color)" href="#">
                    <div class="colores">
                      <div class="color_tablero" v-bind:style="{ 'background-color': color.color1}"></div>
                      <div class="color_tablero" v-bind:style="{ 'background-color': color.color2}"></div>
                      <div class="color_tablero" v-bind:style="{ 'background-color': color.color3}"></div>
                      <div class="color_tablero" v-bind:style="{ 'background-color': color.color4}"></div>
                    </div>
                  </a>
              </ul>
            </div>
          </div>
      </div>
  </template>

   <!--  <button type="button" class="btn btn-success" @click="boton();" id="boton">boton</button> -->
</div>
<div class="clearfix"></div> 
</div>
<div class="x_content">

<div class="row">
<template v-if="!vista_config_tablero">
	<div class="col-sm-12">
  <transition name="fade">
    
  <div id="tabla1" class="" v-show="!finalizados">
    <p>Proyectos Vigentes</p>
  <?php if(count($proyectos->mensaje)>0){
  	?>
    
  	<!-- <ul id="tree1">
      <li><span class="caret" @click="arbol2($event)">Proyectos</span>
        <ul class="nested">
  	<?php 
      //foreach ($proyectos->mensaje as $proyecto) {
    ?>
        <li><a class="ver_tableros" @click="cargarTableros(<?php// echo $proyecto->id; ?>)"><?php //echo $proyecto->nombre; ?></a></li>
  <?php //} ?>
    	</ul>
    </li>
	</ul> -->
		<div id="vigentes_proyectos">
	  	<?php 
	      foreach ($proyectos->mensaje as $proyecto) {
	    ?>
	        <div class="proyectos" @click="cargarProyecto(<?php echo $proyecto->id; ?>,$event)"><?php echo $proyecto->nombre; ?></div>
	  <?php } ?>
		</div>
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



  	<?php
      foreach ($proyectos_finalizados->mensaje as $proyecto) {
    ?>
    	<div class="proyectos" @click="cargarProyecto(<?php echo $proyecto->id; ?>,$event)"><?php echo $proyecto->nombre; ?></a></div>
    <?php } ?>

    <?php

    }else{
      echo "<h2>No tienes Proyectos Finalizados</h2>";
    } ?>
</div>
</transition>
</div>
<transition name="fade">
<div id="tableros" class="col-sm-12" v-show="showModal">
  <div class="text-center col-sm-12">
    <!-- <button type="button" @click="show_alta_tableros= !show_alta_tableros;show_form_edicion=false;" class=" btn-verde btn-floating btn-large"><i class="glyphicon glyphicon-plus"></i></button>
    <button class="btn-horizontal btn btn-success" v-if="tableros.length > 1" @click="listahorizontal= !listahorizontal"><i class="fa fa-list-ol"></i></button> -->
  </div>
<template id="div_alta_tablero" v-if="show_alta_tableros" >
  <h1 class="text-center" v-if="nombre_proyecto != ''">Proyecto elegido: {{nombre_proyecto}}</h1>
  <hr>
  <div class="col-sm-8 col-sm-offset-2">
  <div class="panel panel-primary">
    <div class="panel-heading text-center">Crear Nuevo Tablero</div>
    <div class="panel-body">
    <form id="form_alta_tablero" @submit.prevent="crear_tablero" method="POST" class="col-sm-10 col-sm-offset-1">
        <input type="hidden" name="id_proyecto" v-model="id_proyecto" value="0">
        <input type="hidden" name="idusuario_creador" value="<?php echo $id_user;?>">
        <input type="hidden" name="estado" value="1">
        <input type="hidden" name="visible" value="1">
        <div class="form-group">
          <label>Nombre Tablero</label>
          <input type="text" maxlength="30" autocomplete="off" class="form-control" id="nombre_tablero" name="nombre_tablero">
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
        	<button type="submit" class="btn btn-success">Siguiente</button>
        </div>
    </form>
  </div>
  </div>
  </div>
</template>
<template  v-if="tableros.length > 0">
	<template v-if="listahorizontal">
            <div class="list-tableros col-sm-12 text-center" style="margin-top: 3rem;">
            	<div class=" tableros" v-for="tablero in tableros">
    				<div class="">
                        <div class="col-sm-12">
                          <div class="">{{tablero.nombre_tablero}}</div>
                          <div class="">{{tablero.cant_periodos}} <span v-if="tablero.tipo_periodo == 1">Días</span><span v-else-if="tablero.tipo_periodo == 2">Semanas</span><span v-else-if="tablero.tipo_periodo == 3">Quincenas</span><span v-else-if="tablero.tipo_periodo == 4">Meses</span></div>
                        </div>
                  	</div>  
                </div>
            </div>
        <!-- </div> -->
    </template>
    <template v-else>
    	<div class="list-group col-sm-8 col-sm-offset-2 text-center">
    		<a class="tableros">
    			<div class="list-group-item active">
    				<div class="row text-center">
    					<div class="col-sm-6">Nombre</div>
    					<div class="col-sm-3 fecha_creado">Fecha Creación </div>
    					<div class="col-sm-3"> <span class="badge">Períodos</span></div>
    				</div>
    			</div>
    		</a>
            <a class=" tableros" v-for="tablero in tableros">
            	<div class="list-group-item">
        			<div class="row text-center">
        				<div class="col-sm-6">{{tablero.nombre_tablero}}</div>
	                  	<div class="col-sm-3 fecha_creado">{{tablero.fecha_creacion | formatDate}}</div>
	                  	<div class="col-sm-3">
	                  		<span class="badge">{{tablero.cant_periodos}} <span v-if="tablero.tipo_periodo == 1">Días</span><span v-else-if="tablero.tipo_periodo == 2">Semanas</span><span v-else-if="tablero.tipo_periodo == 3">Quincenas</span><span v-else-if="tablero.tipo_periodo == 4">Meses</span></span>
	                  	</div>
        			</div>
                  

            	</div>  
            </a>
        </div>
    </template>
</template>
<!-- <template v-else>
    <div class="col-sm-12" >
    	<div class="alert alert-warning text-center" style="margin-top: 2rem;">
    		No Hay tableros para este proyecto
    	</div>
    </div>
</template> -->
</div>
</transition>
</template>
<template v-if="vista_config_tablero">
  <div class="row">
    <div class="tablero_contenedor">
    	
      <div class="" id="grilla" >
      	   <grid-layout
            @drop.prevent="drop"
            :layout.sync="layout"
            :col-num="12"
            :row-height="30"
            :is-draggable="true"
            :is-resizable="false"
            :is-mirrored="false"
            :vertical-compact="false"
            :margin="[10, 10]"
            :use-css-transforms="true"
            :max-rows="maxRows"
            >
              <div v-show="!layout.length>0" style="margin-top: 25%;">
                <h3 class="text-center">Arrastre sus herramientas hacia el tablero</h3>
                <hr>
              </div>
                <grid-item v-for="item in layout"
                           :x="item.x"
                           :y="item.y"
                           :w="item.w"
                           :h="item.h"
                           :i="item.i"
                           :id="item.id" :style="{'color': color_elegido, 'backgroundColor': color2}">
                    {{item.i}}
                    <a href="#" class="delete close" aria-label="Close" :style="{'color': color_elegido}" @click="eliminar_herramienta(item)"><span aria-hidden="true">&times;</span></a>
                </grid-item>
            </grid-layout>
      </div>
      <div id="herramientas">
        <div v-show="plantillas.length>0 && plantillas.length <= 5">
      	   <button type="button" v-for="plantilla in plantillas" @click="aplicar_plantilla(plantilla.idplantillas,plantilla.nombre)" class="btn btn-primary plantilla">{{plantilla.nombre}}</button>
        </div>
      	<div v-show="plantillas.length > 5" class="dropdown">
    		  <button class="btn btn-primary plantilla" type="button" id="menu1" data-toggle="dropdown">PLANTILLAS
    		  <span class="caret"></span></button>
  		    <ul id="herramientas_dropdown" class="dropdown-menu" role="menu" aria-labelledby="menu1">
            <li role="presentation" v-for="plantilla in plantillas"><a role="menuitem" tabindex="-1"  @click="aplicar_plantilla(plantilla.idplantillas,plantilla.nombre)">{{plantilla.nombre}}</a></li>
      		</ul>
  		  </div>

        <div v-show="herramientas.length>0 && herramientas.length <= 10">
            <button draggable="true" v-for="herramienta in herramientas" @dragover.prevent @dragend="handleDrop($event,herramienta.idherramientas_tablero)" ondragstart="drag(event)" type="button" @click="nueva_herramienta(herramienta.idherramientas_tablero);" class="btn btn-success herramienta">{{herramienta.nombre}}</button>
        </div>
        <div v-show="herramientas.length > 10" class="dropdown">
          <button class="btn btn-success plantilla" type="button" id="menu1" data-toggle="dropdown">HERRAMIENTAS
          <span class="caret"></span></button>
          <ul id="plantillas_dropdown" class="dropdown-menu" role="menu" aria-labelledby="menu1">
            <li role="presentation" v-for="herramienta in herramientas"><a role="menuitem" tabindex="-1"  @click="nueva_herramienta(herramienta.idherramientas_tablero);">{{herramienta.nombre}}</a></li>
          </ul>
        </div>

        <!-- //echo '<button draggable="true" @dragover.prevent @dragend="handleDrop($event, '.$herramienta->idherramientas_tablero.')" ondragstart="drag(event)" type="button" @click="nueva_herramienta('.$herramienta->idherramientas_tablero.');" class="btn btn-success herramienta">'.$herramienta->nombre.'</button>'; -->       
      </div>

    </div>
      <div class="col-sm-12 text-center form-group" style="margin-top: 3rem;">
          <button type="button" id="btn_guardar_config" v-if="layout.length>0" @click="guardar_tablero" class="btn btn-success">Guardar</button>
          <button type="button" v-else disabled class="btn btn-success">Guardar</button>
          <button type="button" v-if="layout.length >0" @click="guardar_plantilla" class="btn btn-primary">Guardar Como Plantilla</button>
          <button type="button" v-else disabled class="btn btn-primary">Guardar Como Plantilla</button>

      </div>
  </div>
<!-- 	 <input type="hidden" name="guardado_tablero" id="guardado" value="2"> -->
</template>
</div>
</div>
</div>

<script type="text/javascript" src="js/vue.js"></script>
<script src="js/vue-resource.min.js"></script>
<script src="js/vue-grid-layout.umd.min.js"></script>
<script src="js/vue.drag-and-drop.js"></script>
<script src="js/crear_tablero.js"></script>
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

function traer_herramientas(){
  $lib_php = new lib_php();
  $server="http://" . $_SERVER["SERVER_NAME"];
  $url=$server."/boxtracker1/BACKEND/apis/tablero/Traer_Herramientas.php";
  $rta=$lib_php->llamar_api_get($url);

  return $rta;
}

function traer_plantillas($id_user){
  $lib_php = new lib_php();
  $server="http://" . $_SERVER["SERVER_NAME"];
  $url=$server."/boxtracker1/BACKEND/apis/tablero/Traer_Plantilla.php?id_user=".$id_user;
  //var_dump($url);
  $rta=$lib_php->llamar_api_get($url);

  return $rta;
}
?>