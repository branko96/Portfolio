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

?>

<!DOCTYPE html>

<html>

<head>

	<title>Usuarios - Listado</title>



	<?php include_once "header.php";?>

	<!-- Switchery -->

    <link href="../../vendors/switchery/dist/switchery.min.css" rel="stylesheet">

    <style type="text/css">

      .btn-alta-user{

        float: right;

      }

      .div_submit{

        margin-top: 2rem;

      }

      .btn-app{
          height: 110px !important;
          min-width: 152px !important;
          padding: 2rem !important;
          font-size: 23px !important;
      }
      .btn.btn-app>.badge{
        font-size: 18px !important;
      }
      .btn.btn-app>.fa {
          font-size: 40px !important;
      }
      .modal-dialog {
          width: 715px;
      }
      .sw-disabled:hover{
      	cursor: not-allowed;
      }
      .permisos{
  	    padding: 5px;
	    border: 1px solid;
	    border-radius: 10px;
      }
      .div_permisos_contenedor{
        margin-top: 4rem;
        min-height: 150px;
      }

    </style>

</head>

<body class="nav-md">

<?php include_once "menu.php";?>

<div class="right_col" role="main">

    <div class="page-title">

        <div class="title_left">

            <h3>Usuarios <small>App</small></h3>

        </div>

    </div>

	<div class="clearfix"></div>

	<div class="row">

    	<div class="col-md-12">

    		<div class="x_panel" id="contenedor_herramientas">

               <!--   <div class="x_title col-sm-12">

                    <h2>Listado Usuarios</h2>


                    <div class="clearfix"></div>

                  </div>
                  <div class="x_content" id="div_tabla_usuarios">

                    <?php// if(count($usuarios)>0){ ?>

                    <table id="tabla_usuarios" class="table table-striped projects">

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

                        <?php// foreach ($usuarios as $key => $usuario) { ?>

                        <tr>

                          <td><a><?php// $usuario->getNombre() ?></a></td>

                          <td><?php// $usuario->getApellido() ?></td>

                          <td><?php// $usuario->getDni() ?></td>

                          <td><?php// $usuario->getEmail() ?></td>

                          <td><?php// $usuario->getTelefono() ?></td>


                        </tr>

                        <?php// } ?>

                        

                      </tbody>

                    </table>

                    <?php/* }else{

                      echo "No posee hijos.";

                    }*/ ?>

                  </div>-->

                </div>

              </div>

            </div>

    	</div>
</div>
  

<?php include_once "footer.php";?>
<script src="../../vendors/switchery/dist/switchery.min.js"></script>
</body>
</html>