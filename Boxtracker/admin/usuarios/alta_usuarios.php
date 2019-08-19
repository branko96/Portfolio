<?php 

include_once("../../BACKEND/model/Usuario.php");

session_start();

include_once("../../BACKEND/datos/conexion.php");

include_once("../../BACKEND/controller/UsuariosController.php");

include_once("../FormulariosController.php");

$usuariosCont=new UsuariosController($basedatos,$servidor,$usuario,$paswd);

$ctrlForm=new FormulariosController();
if (isset($_SESSION['user'])) {
  $id_user=$_SESSION['user']->getId();
  $usuarios=$usuariosCont->DevolverUsuarios($id_user);
}

//var_dump($usuarios);



$permisos_todos=$usuariosCont->DevolverPermisos_vigentes();

$modulos_todos=$usuariosCont->DevolverModulos();

?>

<!--<!DOCTYPE html>

<html>

<head>

	<title>Usuarios - Alta</title> -->



	<?php// include_once "header.php";?>

	<!-- Switchery

    <link href="../../vendors/switchery/dist/switchery.min.css" rel="stylesheet"> -->

    

<!--</head>

<body class="nav-md">

<?php// include_once "menu.php";?>

<div class="right_col" role="main">

    <div class="page-title">

        <div class="title_left">

            <h3>Usuarios <small>Alta</small></h3>

        </div>

    </div>

	<div class="clearfix"></div>

	<div class="row">

    	<div class="col-md-12">

    		<div class="x_panel">-->

                  <div class="x_title col-sm-12">

                    <h2>Alta de Usuarios</h2>

                    <!-- <button type="button" class="btn btn-success btn-alta-user" data-toggle="modal" data-target="#modal_alta_usuario">Nuevo Usuario</button> -->

                    <a style="float:right;" class="btn-floating btn-large btn-primary btn-alta-user" data-toggle="modal" data-target="#modal_alta_usuario"><i class="fa fa-plus"></i></a>

                    <div class="clearfix"></div>

                  </div>

                  <div class="x_content" id="div_tabla_usuarios">

                    <?php if(count($usuarios)>0){ ?>

                    <table id="tabla_usuarios" class="table table-striped nowrap" style="width: 100%;">

                      <thead>

                        <tr>

                          <th style="width: 20%">Nombre</th>

                          <th>Apellido</th>

                          <th>Dni</th>

                          <th>Email</th>

                          <th>Teléfono</th>

                        </tr>

                      </thead>

                      <tbody>

                        <?php foreach ($usuarios as $key => $usuario) { ?>

                        <tr>

                          <td><a><?= $usuario->getNombre() ?></a></td>

                          <td><?= $usuario->getApellido() ?></td>

                          <td><?= $usuario->getDni() ?></td>

                          <td><?= $usuario->getEmail() ?></td>

                          <td><?= $usuario->getTelefono() ?></td>

                        </tr>

                        <?php } ?>

                        

                      </tbody>

                    </table>

                    <!-- end users list -->

                    <?php }else{

                      echo "No posee hijos.";

                    } ?>

                  </div>

               <!-- </div>

              </div>-->

      <!--      </div>

    	</div>

   	</div>

</div>-->



<link rel="stylesheet" type="text/css" href="css/boton_add.css">


<div id="modal_alta_usuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content row">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Nuevo Usuario</h4>
      </div>
      <div class="modal-body">
      	<div class="container">
      		<div class="col-sm-12">
      			<form id="nuevo_usuario">
              			<input type="hidden" name="op" value="alta">
    					<div id="datos_personales">
    				      	   <input type="hidden" name="user_padre" value="<?= $_SESSION['user']->getId() ?>">
    				      		<div class="form-group">
    				      			<label for="nombre_u" class="form-label">Nombre</label>
    				      			<input type="text" name="nombre_u" id="nombre_u" maxlength="10" class="form-control" required>
    				      		</div>
    				      		<div class="form-group">
    				      			<label for="apellido_u" class="form-label">Apellido</label>
    				      			<input type="text" name="apellido_u" id="apellido_u" maxlength="20" class="form-control" required>
    				      		</div>
    				      		<div class="form-group">
    				      			<label for="dni_u" class="form-label">Dni</label>
    				      			<input type="text" name="dni_u" id="dni_u" maxlength="10" class="form-control" required>
    				      		</div>
    				      		<div class="form-group">
    				      			<label for="tel_u" class="form-label">Teléfono</label>
    				      			<input type="text" name="tel_u" id="tel_u" maxlength="15" class="form-control" required>
    				      		</div>
    				      		<div class="form-group">
    				      			<label for="email_u" class="form-label">Email</label>
    				      			<input type="email" name="email_u" id="email_u" maxlength="30" class="form-control" required>
                        			<div id="emailOK"></div>
    				      		</div>
    				      		<!--<div class="form-group">
    				      			<label for="pass_u" class="form-label">Contraseña</label>
    				      			<input type="text" name="pass_u" id="pass_u" maxlength="20" class="form-control" required>
    				      		</div>-->
    				      		<div class="form-group text-center ">
    				      			<button type="button" class="btn btn-primary btn-siguiente">Siguiente</button>
    				      		</div>
    				   	</div>
				   	<div id="permisos_user" hidden>
                <div class="div_permisos_contenedor">
		              <div class="form-group row">
		              <?php 
		                  if (count($modulos_todos)>0) {
		                  	$permisos_activos=$usuariosCont->DevolverPermisos_activos($id_user);
		                    foreach ($modulos_todos as $key => $modulo) {
		                      $id_mod=$modulo["id_modulo"];
		                      $nombre=$modulo["descripcion"];
                          $icono=$modulo["icono"];
		                      $ctrlForm->mostrar_permisos_modulo2($key,$id_mod,$nombre,$permisos_todos,$permisos_activos);
		                    }
		                  }
		              ?>
		              </div>
				   		   </div>
                 <div class="form-group col-sm-12 text-center div_submit">
                  <button type="button" class="btn btn-primary btn_atras">Atrás</button>
                  <button type="submit" class="btn btn-success">Guardar</button>
                </div>
				   	</div>
            
				   	</form>
            <div id="cargando" style="display: none;">
              <center><img src="img/cargando2.gif"></center>
            </div>
				   	<div id="respuesta_alta"></div>
		</div>
      </div>
    </div>
  </div>
</div>
</div>
<!--</div>
</div>-->

<?php// include_once "footer.php";?>
<script src="js/alta_usuarios.js"></script>
<!--<script src="js/index.js"></script>
<script src="../../vendors/switchery/dist/switchery.min.js"></script>
</body>
</html>-->