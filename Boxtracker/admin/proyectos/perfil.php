<?php

include_once("../../BACKEND/model/Usuario.php");

session_start();

include_once("../../BACKEND/datos/conexion.php");

include_once("../../BACKEND/controller/UsuariosController.php");



$usuariosCont=new UsuariosController($basedatos,$servidor,$usuario,$paswd);





$usuario1=$_SESSION['user'];



$user_id=$usuario1->getId();

//var_dump($user_id);

$usuario1=$usuariosCont->VerUsuario($user_id);

?>



<!DOCTYPE html>

<html>

<head>

	<title>Mi Perfil</title>

	<?php include_once "header.php";?>

	<style type="text/css">

   .btn-file {

    position: relative;

    overflow: hidden;

    }

    .btn-file input[type=file] {

        position: absolute;

        top: 0;

        right: 0;

        min-width: 100%;

        min-height: 100%;

        font-size: 100px;

        text-align: right;

        filter: alpha(opacity=0);

        opacity: 0;

        outline: none;

        background: white;

        cursor: inherit;

        display: block;

    } 

    .foto_user{

      width: 150px;

      height: 150px;

      border-radius: 10px;

    }

  </style>

</head>

<body class="nav-md">

<?php include_once "menu.php";?>

<div class="right_col" role="main">

	<div class="page-title">

        <div class="title_left">

            <h3>Mi Perfil </h3>

        </div>

    </div>

	<div class="clearfix"></div>

	<div class="row">

      <div class="col-md-12">

        <div class="x_panel">

          <div class="x_title text-center">

            <h2>Edición de datos personales</h2>

            

            <div class="clearfix"></div>

          </div>

          <div class="x_content">

            <br />

           

            <?php if(is_object($usuario1)){ ?>

            <form id="form_editar_perfil" class="form-horizontal form-label-left">

              <div class="form-group row">

                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Foto Perfil </label>

                  <div class="col-md-9 col-sm-9 col-xs-12">

                    <div>

                        <img class="foto_user" src="<?= $usuario1->getFoto() ?>">

                        <label class="btn btn-primary" for="foto_perfil">

                            <input id="foto_perfil" accept=".png, .jpg" name="foto_u" type="file" style="display: none;" onchange="$('#nombre_imagen').html(this.files[0].name); readURL(this);">

                            Cambiar Imagen

                        </label>

                        <span class='label label-success' id="nombre_imagen"></span>

                    </div>

                 </div>

              </div>

          		<div class="form-group">

          		    <input type="hidden" name="op" value="editar_perfil">

                  <input type="hidden" name="id_user" value="<?= $usuario1->getId() ?>">

                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_u">Nombre <span class="required">*</span></label>

                  <div class="col-md-6 col-sm-6 col-xs-12">

	                  <input type="text" name="nombre_u" class="form-control col-md-7 col-xs-12" id="nombre_u" value="<?= $usuario1->getNombre() ?>" required>

	               </div>

                  

                </div>

          		<div class="form-group">

                  <label for="apellido_u" class="control-label col-md-3 col-sm-3 col-xs-12">Apellido <span class="required">*</span></label>

                  <div class="col-md-6 col-sm-6 col-xs-12">

	                  <input type="text" name="apellido_u" class="form-control col-md-7 col-xs-12" id="apellido_u" value="<?= $usuario1->getApellido() ?>" required>

	                </div>

                </div>

          		<div class="form-group">

                  <label for="dni_u" class="control-label col-md-3 col-sm-3 col-xs-12">Dni <span class="required">*</span></label>

                  <div class="col-md-6 col-sm-6 col-xs-12">

                    <input type="text" name="dni_u" class="form-control col-md-7 col-xs-12" maxlength="8" id="dni_u" value="<?= $usuario1->getDni() ?>" required>

                  </div>

              </div>

          		<div class="form-group">

                  <label for="tel_u" class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono <span class="required">*</span></label>

                  <div class="col-md-6 col-sm-6 col-xs-12">

                    <input type="text" name="tel_u" class="form-control col-md-7 col-xs-12" id="tel_u" value="<?= $usuario1->getTelefono() ?>" required>

                  </div>

              </div>

                <div class="ln_solid"></div>

              	<div class="form-group text-center">

                  <a href="index.php" id="btn-atras" class="btn btn-primary">Cancelar</a>

                    <button type="submit" id="btn-guardar" disabled class="btn btn-success">Guardar</button>

                </div>

                            

          	</form>



          	<div id="respuesta"></div>

          	<?php } ?>

          </div>

        </div>

      </div>

    </div>

</div>



<?php include_once "footer.php";?>

<script src="js/perfil.js"></script>

</body>

</html>