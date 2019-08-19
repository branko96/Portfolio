<?php 
include("verificar_login.php");




include_once("../../BACKEND/datos/conexion.php");



include_once("../../BACKEND/controller/UsuariosController.php");



$usuariosCont=new UsuariosController($basedatos,$servidor,$usuario,$paswd);

include_once("../FormulariosController.php");

$ctrlForm=new FormulariosController();



if (isset($_SESSION['user'])) {

$id_modulo=2;

$id_user=$_SESSION['user']->getId();

$menu_todos=$usuariosCont->traer_menu_modulo($id_modulo);

$permisos_user=$usuariosCont->DevolverPermisos_usuario($id_user);
}
?>
<div class="container body">
      <div class="main_container">
<div class="col-md-3 menu_fixed left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><img src="../images/logo_herradura_blanca.png" style="width: 50px;"> <span>boxTracker</span></a>
            </div>
            <div class="clearfix"></div>
            <!-- menu profile quick info 
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php //$_SESSION['user']->getFoto() ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2><?php //if(isset($_SESSION['user'])){echo $_SESSION['user']->getNombre();} ?></h2>
              </div>
            </div>-->
            <!-- /menu profile quick info -->
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                 <!-- <li><a href="index.php"><span><i class="fa fa-home"></i> Inicio </span></a>-->
                   <!-- <ul class="nav child_menu">
                      <li><a href="../index.php">Panel</a></li>
                      <li><a href="../projects.php">Proyectos</a></li>
                    </ul>-->
                 <!-- </li>-->
                  <!--<li><a href="../index.php"><span><i class="fa fa-home"></i> Volver A Mis Apps </span></a></li>-->
                    <?= $ctrlForm->mostrar_menu($permisos_user,$menu_todos) ?>
                    <li style="position: absolute;bottom: 20px;"><a style="color:white;" href="../index.php"><div style="display: inline-flex;"><i class="fa fa-home"></i> <div class="nombre_menu">Volver A Inicio</div></div></a></li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>
  <!-- top navigation -->
        <div class="top_nav navbar-fixed-top">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <div id="buscador_principal" class="col-sm-3 form-group"> 
              	<input type="text" placeholder="Buscar... " class="form-control"> 
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

                    <img src="<?= $_SESSION['user']->getFoto() ?>" alt="">
                    <span class="nombre_user"><?php echo $_SESSION['user']->getNombre()." ".$_SESSION['user']->getApellido();?></span>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="perfil.php"> Perfil</a></li>
                    <li><a href="perfil.php"><i class="fa fa-wrench pull-right"></i> Configurar Tablero</a></li>
                    <!--<li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Configuración</span>
                      </a>
                    </li>-->
                    <li><a href="#" id="cerrar-sesion1"><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->