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
<link rel="stylesheet" type="text/css" href="css/transicion_vue.css">
<div id="listar_main">
<div class="x_title" >
  <div class="col-sm-8">
    <h2>Ver Tableros por proyecto</h2>
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

        
        <!-- empieza proyecto
        <div class="col-md-55">
          <div class="thumbnail">
            <div class="image view view-first">
              <img style="width: 100%; display: block;" src="<?php //echo $proyecto->imagen; ?>" alt="image">
              <div class="mask no-caption">
                <div class="tools tools-bottom">
                    <a class="btn_modal_tableros" @click="cargarTableros(<?php// echo $proyecto->id; ?>)"><i class="fa fa-list-ol"></i></a>
                </div>
              </div>
            </div>
            <div class="caption">
              <p><strong><?php// echo $proyecto->nombre; ?></strong>
              </p>
              <p><?php// echo $proyecto->descripcion; ?></p>
            </div>
          </div>
        </div>
         termina proyecto -->
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
        <!-- empieza proyecto 
        <div class="col-md-55">
          <div class="thumbnail">
            <div class="image view view-first">
              <img style="width: 100%; display: block;" src="<?php //echo $proyecto->imagen; ?>" alt="image">
              <div class="mask no-caption">
                <div class="tools tools-bottom">
                  <a class="btn_modal_tableros"><i class="fa fa-list-ol"></i></a>
                </div>
              </div>
            </div>
            <div class="caption">
              <p><strong><?php// echo $proyecto->nombre; ?></strong>
              </p>
              <p><?php// echo $proyecto->descripcion; ?></p>
            </div>
          </div>
        </div>
         termina proyecto -->
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
    <!-- <button type="button" @click="show_alta_tableros= !show_alta_tableros;show_form_edicion=false;" class=" btn-verde btn-floating btn-large"><i class="glyphicon glyphicon-plus"></i></button> -->
    
  </div>

<template  v-if="tableros.length > 0">
  <template v-if="listahorizontal">
    <!--<div class="list-group col-sm-8 col-sm-offset-2 text-center">
             <div class="list-group-item tableros" v-for="tablero in tableros">
                <div class="col-sm-12">
                    <div class="col-sm-2">
                      <span class="glyphicon glyphicon-tasks"></span>
                    </div>
                    <div class="col-sm-7">
                      <h4 class="list-group-item-heading">{{tablero.nombre_tablero}}</h4>
                    </div>
                    <div class="col-sm-3">
                      <p class="list-group-item-text"><span class="badge">{{tablero.cant_periodos}}</span> Dias</p>
                    </div>
                </div>
            </div> -->
       <div class="list-group col-sm-12 text-center" style="margin-top: 3rem;">
              <div class="col-sm-6 tableros" v-for="tablero in tableros">
            <div class="card-counter primary">
                        <div class="col-sm-3">
                          <i class="fa fa-code-fork"></i>
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
      <div class="list-group list-group-horizontal col-sm-12 text-center">
          <div class="list-group col-sm-6 col-sm-offset-3 text-center">
            <a class=" tableros" v-for="tablero in tableros">
              <div class="list-group-item">
                  <span class="">{{tablero.nombre_tablero}}</span>
                  <span class="badge">{{tablero.cant_periodos}} <span v-if="tablero.tipo_periodo == 1">Días</span><span v-else-if="tablero.tipo_periodo == 2">Semanas</span><span v-else-if="tablero.tipo_periodo == 3">Quincenas</span><span v-else-if="tablero.tipo_periodo == 4">Meses</span></span>
              </div>  
            </a>
        </div>
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

</div>
</div>
</div>

<script type="text/javascript" src="js/vue.js"></script>
<script src="js/vue-resource.min.js"></script>
<script src="js/listar_tablero.js"></script>
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