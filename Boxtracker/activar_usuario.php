<?php 

$id_user=$_GET["token"];

if (isset($id_user)) {
	

?>
<!DOCTYPE html>
<html>
<head>
	<title>Activación de Cuenta</title>
	<link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
	<!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/activar_usuario.js"></script>
    <style type="text/css">
    	body{
    		 background: linear-gradient(to right, #314A53, #65787E) !important;
    	}
    </style>
</head>

<body>
	<h2 class="text-center" style="color: #fff;">Activación de Cuenta BoxTracker</h2>
<div class="container" style="margin-top: 6%;">
	<div class="col-sm-8 col-sm-offset-2">
	<div class="panel panel-primary">
	  <div class="panel-heading text-center"><h3>Para activar su cuenta, primero debe crear una contraseña</h3></div>
	  <div class="panel-body">
	  	<div class="col-sm-8 col-sm-offset-2">
			<form id="form_crear_contraseña">
				<input type="hidden" name="id_user" value="<?= $id_user ?>" required>
				<div class="form-group text-left"><small>La contraseña debe tener entre 6 y 16 caracteres</small> </div>
				<div class="form-group">
					<label>Contraseña</label>
					<input type="password" name="pass1" id="pass1" maxlength="16" class="form-control" required>
				</div>
				<div class="form-group">
					<span class="label label-danger" id="label_error" style="display: none;">Las contraseñas no coinciden</span>
				</div>
				<div class="form-group">
					<label>Confirme Contraseña</label>
					<input type="password" name="pass2" id="pass2" maxlength="16" class="form-control" required>
				</div>
				<div class="form-group text-center">
					<button type="submit" class="btn btn-success">Activar Mi Cuenta</button>
				</div>
			</form>
			<div id="cargando" style="display: none;">
	            <center>
	                <img src="img/loading.gif" style="width: 50px;">
	            </center>
	        </div>
	        <div class="col-sm-12">
	            <div id="resultado"></div>
	        </div>
		</div>
		</div>
	</div>
	</div>
</div>
</body>
</html>

<?php } ?>