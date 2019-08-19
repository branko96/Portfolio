<?php 
include_once("../BACKEND/model/Usuario.php");
include_once('lib_front/lib_php.php');
session_start();


//var_dump($_SESSION);

//echo $_SESSION['user']->getNombre(); 

$id_user=$_SESSION['user']->getId();


function verificar_modulo($id_user, $id_modulo){
	$lib_php = new lib_php();
	$server="http://" . $_SERVER["SERVER_NAME"];
	$url = $server."/boxtracker1/BACKEND/apis/proyectos/TraerPermisos.php?id_usuario=".$id_user."&id_modulo=".$id_modulo;
	$rta=$lib_php->llamar_api_get($url);
	return $rta;
	  
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	

    <title>Boxtracker Panel 12 </title>


	
    <?php include("header.php");?>

    <style type="text/css">
      .btn-app{
        height: 130px !important;
        min-width: 180px !important;
        padding: 3rem !important;
        font-size: 25px !important;
      }
      .btn.btn-app>.badge{
        font-size: 18px !important;
      }
      .btn.btn-app>.fa {
          font-size: 40px !important;
      }

    </style>
  </head>

  <body class="nav-md">
        <?php require("menu.php");?>

        

        <!-- page content -->
        <div class="right_col" role="main">
          
          <div class="page-title">
              <div class="text-center">
                  <h3>Inicio</h3>
              </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-12 text-center">
                  </div>
                  <!--<div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                  </div>-->
                </div>
                <div class="row" id="apps"> 
                  <center>
                  	<?php $mod_usuarios=verificar_modulo($id_user,1);
                  		if ($mod_usuarios->id_respuesta == 1) { ?>
		                    <a class="btn btn-app" id="btn_users_app">
		                        <i class="fa fa-users"></i> Usuarios
		                    </a>
	                <?php } 
	                 	$mod_proyectos=verificar_modulo($id_user,3);
                  		if ($mod_proyectos->id_respuesta == 1) { ?>
		                    <a class="btn btn-app" id="btn_proyect_app">
		                        <i class="fa fa-th-list"></i> Proyectos
		                    </a>
               		<?php } 
	                 	$mod_proyectos=verificar_modulo($id_user,2);
                  		if ($mod_proyectos->id_respuesta == 1) { ?>
		                    <a class="btn btn-app" id="btn_tablero_app">
		                        <i class="fa fa-pencil-square-o"></i> Tablero
		                    </a>
		            <?php } ?>
                  </center>
                </div>

                
                

                <div class="clearfix"></div>
              </div>
            </div>

          </div>



            
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

       <?php include("footer.php");?>
    <!-- js aplicacion -->
    <script src="js/index.js"></script>

	
  </body>
</html>
