<?php
  session_start();
  require'../admin/content/config.php';
  if($_SERVER['HTTP_HOST'] == 'localhost'){
    $subdirectorio= explode ('\\',getcwd());  //traigo el nombre del subdirectorio en el que estoy trabajando

  }else{
    $subdirectorio= explode ('/',getcwd());  //traigo el nombre del subdirectorio en el que estoy trabajando
  }
    $subdominio = array_pop($subdirectorio);

  
  $urlCSS=route.'/css/'.$subdominio.'.css';
  $urlLogo='../admin/img/'.$subdominio.'.png';
  $urlCSS2=route."/css/estilosgenerales_admin.css";


  require_once('../super/content/conexion.php');
require_once('../super/content/consultas.php');
$consultas=new consultas(); 
$clubid=$consultas->traer_id_club($subdominio);
$pref=$consultas->consultar_pref_club($clubid);

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
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?php echo $urlCSS2 ?>">
        <link rel="stylesheet" href="<?= route ?>/plugins/jquery-confirm-master/jquery-confirm.min.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="../js/vendor/bootstrap.min.js"></script>
        <script src="../js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <script src="<?= route ?>/plugins/jquery-confirm-master/jquery-confirm.min.js"></script>
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
            <a class="navbar-brand" href="index.php"><img id="logo" src="../admin/logos-clubs/<?php echo $logoo;?>" class="img-responsive" alt=""></a>
          </div>
         
          <!-- Agrupar los enlaces de navegación, los formularios y cualquier
               otro elemento que se pueda ocultar al minimizar la barra -->
          <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
               <!-- <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>
                  Socios <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="index.php?opc=altaSocio">Alta</a></li>
                   <li class="divider"></li>
                  <li><a href="index.php?opc=bajaSocio">Baja</a></li>
                   <li class="divider"></li>
                  <li><a href="index.php?opc=modificarSocio">Modificación</a></li>
                  
                </ul>
              </li> -->

              <li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Inicio</a></li>
<!--               <li><a href="index.php?opc=canje"><span class="glyphicon glyphicon-save"></span>Quien sabe</a></li>
              <li><a href="reportes"><span class="glyphicon glyphicon-list-alt"></span>Seguro te la comes</a></li> -->
            </ul>

            <ul class="nav navbar-nav navbar-right">             
            <?php if (empty($_SESSION)){ ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>
                  Ingreso Socios <b class="caret"></b>
                </a>
                <ul id="login" class="dropdown-menu">
                  <form  method="post" action="../content/checklogin.php" role="form">
                      <fieldset>
                          
                          <div class="form-group ">
                            <label for="nDocumento">Nº DNI:</label>
                            <input class="form-control " placeholder="Número de DNI" id="nDocumento" name="nDocumento" type="text" value="" required>
                            <input class="form-control " id="subdominio" name="subdominio" type="hidden" value="<?= $subdominio?>">

                          </div>
                         <!-- Change this to a button or input when using this as a form -->
                          <button type="submit" class="btn btn-sm btn-success btn-block">Ingresar</button>
                      </fieldset>
                  </form>
                </ul>
              </li>   
              <?php }else{ ?> 
              <li><a href="../content/logout.php"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Cerrar Sesión</a></li>
              <?php } ?>
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