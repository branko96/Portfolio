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

<!--<!DOCTYPE html>

<html>

<head>

	<title>Usuarios - Listado</title>-->



	<?php// include_once "header.php";?>

	<!-- Switchery 

    <link href="../../vendors/switchery/dist/switchery.min.css" rel="stylesheet">-->

    
    <style type="text/css">
      td.details-control {
          background: url('img/details_open.png') no-repeat center center;
          cursor: pointer;
      }
      tr.shown td.details-control {
          background: url('img/details_close.png') no-repeat center center;
      }
      td.nohijos{
        display: none;
      }

      .col-medium {
        width: 100px !important;
      }
      .col-long {
        width: 180px !important;
      }

    </style>

<!--</head>

<body class="nav-md">

<?php// include_once "menu.php";?>

<div class="right_col" role="main">
      <div class="page-title">

        <div class="title_left">

            <h3>Usuarios <small>App</small></h3>

      </div>

    </div>

	<div class="clearfix"></div>

	<div class="row">

    	<div class="col-md-12">

    		<div class="x_panel" id="contenedor_herramientas">-->

                  <div class="x_title col-sm-12">

                    <h2>Listado Usuarios</h2>


                    <div class="clearfix"></div>

                  </div>
                  <div class="x_content" id="div_tabla_usuarios">

                    <?php if(count($usuarios)>0){ ?>

                    <table id="tabla_usuarios" class="table table-striped nowrap" style="width: 100%;">

                      <thead>

                        <tr>
                          <th></th>

                          <th style="width: 20%">Nombre</th>

                          <th>Apellido</th>

                          <th>Dni</th>

                          <th>Email</th>

                          <th>Teléfono</th>
                          

                        </tr>

                      </thead>

                      <tbody>

                        <?php foreach ($usuarios as $key => $usuario) { 
                          $id_hijo=$usuario->getId();
                          $rta=$usuariosCont->SaberPadre($id_hijo);
                          ?>

                        <tr>
                          <?php if($usuariosCont->SaberPadre($id_hijo)){ echo "<td data-id='".$id_hijo."'' class='details-control'></td>";}else{echo "<td></td>";}?>
                          <td><?= $usuario->getNombre() ?></td>

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

           
   <!--      </div>

              </div>

            </div>
	</div>

   	</div>

</div>







</div>
</div>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">-->
<script src="js/listado.js"></script>
<?php// include_once "footer.php";?>
<!--<script src="js/index.js"></script>
<script src="../../vendors/switchery/dist/switchery.min.js"></script>
</body>
</html>-->