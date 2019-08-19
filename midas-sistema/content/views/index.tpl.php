<div class="col-md-12">

  <div class="row">
    <div class="col-md-6">
     <!--  <?php
        //incluyo el combo de clubes
        require_once("../content/models/combo_club.mod.php");
        require_once("../content/views/combo_club.tpl.php");
      ?> -->
    </div>
    <?php if (!empty($_SESSION)){ ?>
     <div class="col-md-3 col-md-offset-3">
        <div class="alert alert-warning" role="alert">
          <p>BIENVENIDO <strong><?= $_SESSION['socio']['nombre']?></strong></p>
          <p><?= $datos_club[0]['sistemaValores'] ?> ACUMULADOS: <strong><?= $_SESSION['socio']['puntosAcumulados']?></strong></p>
          <textarea style="display:none" id="datos_socio" name="datos_socio"><?= json_encode($_SESSION['socio']) ?></textarea>
        </div>
      </div>
    <?php } ?>
  </div>
	<div class="row">
    <?php 

      if ($hayDatos > 0){

        require_once("../content/views/vistaGralPremios.tpl.php");
      }else{

        echo "EL CLUB NO DISPONE DE PREMIOS PARA CANJEAR";
      } 

    ?>
  </div>
</div>