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

	<title>Usuarios - Eliminar</title>-->



	<?php// include_once "header.php";?>

	<!-- Switchery -->

    <link href="../../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <style type="text/css">
	    #form_asignar_hijos{
	    	margin-top: 3rem;
	    }
	    #btn-asignar{
	    	margin-top: 1rem;
	    }
      #hermanos,#padre{
        margin-top: 4rem;
      }
      .iradio_flat-green{
          margin-bottom: 10px;
      }
      .labels_radio{
        font-size: 15px;
        padding: 8px;
      }
      .radio_asignar label{
            padding: 0;
      }
      #div_combos{
        margin-top: 2rem;
        margin-bottom: 2rem;
      }
    </style>
    

<!--</head>

<body class="nav-md">

<?php// include_once "menu.php";?>

<div class="right_col" role="main">

    <div class="page-title">

        <div class="title_left">

            <h3>Usuarios <small>Eliminar</small></h3>

        </div>

    </div>

	<div class="clearfix"></div>

	<div class="row">

    	<div class="col-md-12">

    		<div class="x_panel">-->

                  <div class="x_title col-sm-12">

                    <h2>Eliminar Usuarios</h2>


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

                            <center>
                              <a href="#" data-pkUser="<?= $usuario->getId() ?>" class="btn btn-danger btn-xs borrar_user"><i class="fa fa-trash-o"></i> Borrar </a>
                            </center>
                            

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

                </div>

              </div>

            </div>

    	</div>

   <!--	</div>

</div>






</div>
</div>-->

<div id="modal_asignar_padre" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content row">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Asignacion de hijos</h4>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="col-sm-12">
            <form id="form_asignar_hijos">
              <input type="hidden" name="padre_anterior" id="padre_anterior" required>
              <input type="hidden" name="id_user" id="id_user" value="<?php echo $id_user;?>" required>
             
              <div class="col-sm-8 col-sm-offset-2" style="min-height: 200px;">
                <div class="form-group row">
                  <div id="div_combos"></div>
                    
                <div class="form-group text-center col-sm-12">
                    <button type="submit" id="btn-asignar" class="btn btn-primary">Asignar Padre</button>
                </div>
              </div>
            </form>
            <div id="cargando" style="display: none;">
              <center><img src="img/cargando2.gif"></center>
            </div>
            <div id="respuesta_asignar" class="col-sm-12"></div>
    </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php// include_once "footer.php";?>
<!-- iCheck -->
    <script src="../../vendors/iCheck/icheck.min.js"></script>

<script src="js/borrar_usuario.js"></script>
<!--<script src="../../vendors/switchery/dist/switchery.min.js"></script>
</body>
</html>-->