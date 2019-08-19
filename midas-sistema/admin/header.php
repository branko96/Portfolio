<?php
  session_start();
  if (!isset($_SESSION['user'])){
   header("location:login.html");   
  }

  require'content/config.php';
  $club=$_SESSION['club'];
  $urlCSS=route.'/css/'.$club['subdominio'].'.css';
  $urlCSS2=route."/css/estilosgenerales_admin.css";
  $urlLogo=route.'/img/'.$club['subdominio'].'.png';

  //divido la url en modulos
  $url= (isset ($_GET['url'])) ? $_GET['url'] : "";
  $url=explode("/",$url);

  $views=$url[(count($url)-1)];
  //si no encuentra url amigable EJ: /juego, busca la variable EJ: opc=compra
  if($url[0] == ''){
    $url=explode("=",$_SERVER["REQUEST_URI"]);
    if (!empty($url[1]))$views=$url[1];
    
  }

require_once('../super/content/conexion.php');
require_once('../super/content/consultas.php');
$consultas=new consultas(); 

$pref=$consultas->consultar_pref_club($club['id']);

foreach ($pref as $key => $preff) {
 $color= $preff['color_panel'];
 $logoo= $preff['nombre_logo'];
}

  
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="es"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="es"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="es"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html">
        <title></title>
        <meta name="description" content="">
        <link rel="stylesheet" href="<?php echo route ?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo route ?>/css/datepicker.css">
        <link rel="stylesheet" href="<?php echo route ?>/css/bootstrap-theme.min.css">
        <!-- MI CSS BRANKO -->
        <link rel="stylesheet" href="<?php echo $urlCSS2 ?>">
        <link rel="stylesheet" href="<?php echo route ?>/css/main.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="<?php echo route ?>/js/vendor/bootstrap.min.js"></script>
        <script src="<?php echo route ?>/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo route ?>/js/Chart.min.js"></script>
        <?php if (($views == 'altaSocio')or($views == 'editarsocio')){ ?>
          <link rel="stylesheet" href="<?php echo route ?>/plugins/typeahead/typeahead.css">
          <script type="text/javascript" src="<?= route ?>/plugins/typeahead/typeahead.min.js"></script> <!-- AutoComplete -->
        <?php } ?>
        <?php if($views =='reportes'){?>
          <script src="<?php echo route ?>/js/reportes.js"></script>
        <?php }?>
        <?php if($views =='juego'){?>
          <link rel="stylesheet" href="<?php echo route ?>/js/juego/juego.css" type="text/css">
          <script type="text/javascript" src="<?php echo route ?>/js/juego/Winwheel.js"></script>
          <script src="<?php echo route ?>/js/juego/TweenMax.min.js"></script>
        <?php }?>
        <script src="<?php echo route ?>/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <script type="text/javascript">
            window.smartlook||(function(d) {
            var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
            var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
            c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
            })(document);
            smartlook('init', '0013adbd63213cc5ff435e8c7dbf4e0ab615fbd0');
        </script>

        <link rel="stylesheet" type="text/css" href="<?php echo route ?>/plugins/DataTable/datatables.min.css"/>
 
<script type="text/javascript" src="<?php echo route ?>/plugins/DataTable/datatables.min.js"></script>

        <script type="text/javascript">
          var route='<?= route ?>';


        </script>
    </head>
    </head>

  <body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <div id="wrapper">
      <header id="header"> 
        <nav id="mi_navbar" class="navbar navbar-default container" role="navigation">
          <!-- El logotipo y el icono que despliega el menú se agrupan
               para mostrarlos mejor en los dispositivos móviles -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target=".navbar-ex1-collapse">
              <span class="sr-only">Desplegar navegación</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= route ?>/index.php"><img id="logoo" src="logos-clubs/<?php echo $logoo;?>" class="img-responsive" alt=""></a>
          </div>
         
          <!-- Agrupar los enlaces de navegación, los formularios y cualquier
               otro elemento que se pueda ocultar al minimizar la barra -->
          <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>
                  Socios <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="<?= route ?>/index.php?opc=altaSocio">Alta</a></li>
                  <!--  <li class="divider"></li>
                  <li><a href="index.php?opc=bajaSocio">Baja</a></li> -->
                   <li class="divider"></li>
                  <li><a href="<?= route ?>/index.php?opc=modificarSocio">Modificación</a></li>
                  
                </ul>
              </li>
               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-gift"></span>
                  Premios <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="<?= route ?>/index.php?opc=altaPremio">Alta</a></li>
                   <li class="divider"></li>
                  <li><a href="<?= route ?>/index.php?opc=modificarPremio">Modificación</a></li>
                </ul>
              </li>
               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span>
                  Compras <b class="caret"></b>
                </a>
               <ul class="dropdown-menu">
                  <li><a href="<?= route ?>/index.php?opc=compra">Cargar Compras</a></li>
                  <li><a href="<?= route ?>/index.php?opc=anular_punto">Anular Puntos</a></li>
                </ul>
                  
                 <!-- <a href="<?//= route ?>/index.php?opc=compra"><span class="glyphicon glyphicon-shopping-cart"></span>Ver Compras</a>-->

               </li>
              <li><a href="<?= route ?>/index.php?opc=canje"><span class="glyphicon glyphicon-save"></span>Canje</a></li>
              <li><a href="<?= route ?>/reportes"><span class="glyphicon glyphicon-list-alt"></span>Reportes</a></li>
              <li><a href="<?= route ?>/juego"><span class="glyphicon glyphicon-record"></span>Juego</a></li>
              
            </ul>
            <ul class="nav navbar-nav navbar-right">
       
              <li class="nav-date"><span class="glyphicon glyphicon-calendar"></span><?= date("d/m/y"); ?></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="<?= route ?>/config">Configuración</a></li>
                  <!-- <li><a href="#">Acción #2</a></li>
                  <li><a href="#">Acción #3</a></li> -->
                  <li class="divider"></li>
                  <li><a href="<?= route ?>/content/logout.php"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Cerrar Sesión</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header><!-- /header -->


      <script type="text/javascript">
          $(document).ready(function() {
            var color="<?php echo $color;?>";
              $('#header').css("background-color", color);
              $('#mi_navbar').css("background-color", color);
              $('#footer').css("background-color", color);
          });

      </script>
