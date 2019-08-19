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

	<title>Usuarios - Editar</title>



	<?php// include_once "header.php";?>-->

	<!-- Switchery

    <link href="../../vendors/switchery/dist/switchery.min.css" rel="stylesheet"> -->

    <link rel="stylesheet" type="text/css" href="css/estilos_usuarios.css">

<!--</head>

<body class="nav-md">

<?php// include_once "menu.php";?>

<div class="right_col" role="main">

    <div class="page-title">

        <div class="title_left">

            <h3>Usuarios <small>Editar</small></h3>

        </div>

    </div>

	<div class="clearfix"></div>

	<div class="row">

    	<div class="col-md-12">

    		<div class="x_panel">-->

                  <div class="x_title col-sm-12">

                    <h2>Editar Usuarios</h2>


                    <div class="clearfix"></div>

                  </div>

                  <div class="x_content" id="div_tabla_usuarios">

                    <?php if(count($usuarios)>0){ ?>

                    <table id="tabla_usuarios" class="table table-striped nowrap">

                      <thead>

                        <tr>

                          <th style="width: 20%">Nombre</th>

                          <th>Apellido</th>

                          <th>Dni</th>

                          <th>Email</th>

                          <th>Teléfono</th>

                          <th style="width: 20%">Acción</th>

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

                          <td>

                            <!--<a href="#" data-pkUser="<?php //$usuario->getId() ?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Ver </a>-->
                            <center>
                              <a href="#" data-pkUser="<?= $usuario->getId() ?>" class="btn btn-success btn-xs editar_user"><i class="fa fa-pencil"></i> Editar </a>
                            </center>
                            

                           <!-- <a href="#" data-pkUser="<?//= $usuario->getId() ?>" class="btn btn-danger btn-xs borrar_user"><i class="fa fa-trash-o"></i> Borrar </a>-->

                          </td>

                        </tr>

                        <?php } ?>

                        

                      </tbody>

                    </table>

                    <!-- end users list -->

                    <?php }else{

                      echo "No posee hijos.";

                    } ?>

                  </div>

 <!--               </div>

              </div>

            </div>

    	</div>

   	</div>

</div>-->



<!-- MODAL EDITAR USER-->

<div id="modal_editar_usuario" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

    <div class="modal-content row">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title text-center">Editar Usuario</h4>

      </div>

      <div class="modal-body">

      	<div id="div_form_editarU"></div>

        <div id="respuesta_editar"></div>

      </div>

    </div>



  </div>

</div>


<script src="js/editar_usuarios.js"></script>

<!--</div>
</div>

<?php// include_once "footer.php";?>

<script src="../../vendors/switchery/dist/switchery.min.js"></script>
</body>
</html>-->