<?php

include_once("../../BACKEND/model/Usuario.php");

session_start();
?>
<!DOCTYPE html>

<html>

<head>

	<title>Tableros</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/loadingfy.css">
  <link rel="stylesheet" type="text/css" href="css/boton_add.css">
  <link rel="stylesheet" type="text/css" href="css/transicion_vue.css">
  <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap-treeview.min.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap_treeview.css"> -->
  <link rel="stylesheet" type="text/css" href="css/card-counter.css">
  <link rel="stylesheet" type="text/css" href="css/notifIt.min.css">
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<?php include_once "header.php";?>
 

	

</head>

<body class="nav-md">

<?php include_once "menu.php";?>

<div class="right_col" role="main">

	<div class="page-title">

        <div class="title_left">

            <h3>Tableros </h3>

        </div>

    </div>

	<div class="clearfix"></div>

	<div class="row">

      <div class="col-md-12">

        <div class="x_panel">

          <!-- <div class="x_title text-center"></div> -->

          <div class="x_content">
            
            
            <div id="contenedor_herramientas"></div>

          </div>

        </div>

      </div>

    </div>

</div>

<div id="loading" hidden>
  <div id="loading-center">
    <div id="loading-center-absolute">
      <div class="object" id="object_one"></div>
      <div class="object" id="object_two"></div>
      <div class="object" id="object_three"></div>
      <div class="object" id="object_four"></div>
      <div class="object" id="object_five"></div>
      <div class="object" id="object_six"></div>
    </div>
  </div>

</div>


<?php include_once "footer.php";?>





<!-- <script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.js' type='text/javascript'></script> -->
<script src="js/vue.js"></script>
<script src="js/vue-resource.min.js"></script>
<script src="js/notifIt.min.js"></script>

<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script src="js/index.js"></script>

<!-- <script src="js/index_controller.js"></script> -->

</body>

</html>