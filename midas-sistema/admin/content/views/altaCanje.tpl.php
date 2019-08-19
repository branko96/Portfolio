<!-- altaCanje.tpl.php -->
<div class="container">
  <form class="form-horizontal" method="POST" action="index.php" autocomplete="off" >
 
        <!--<div class="form-group">
            <label class="col-md-4 control-label" for="btn_enviar">Premios disponibles</label>
            <div class="col-md-4">
               <select class="form-control" name="premio">
                 <?php
                   //foreach ($premios as $key => $value) {;?>
                     <option value="<?php //echo $value['idpremios']?>"><?php //echo $value['titulo'];?></option>
                   <?php //};?>
                 
               </select>
            </div>
        </div>-->

        <input type="hidden" name="action" value="AC" />
         
        <input type="hidden" name="socio" value="<?php echo $idSocios;?>" />
        <input type="hidden" id="acumulados" name="acumulados" value="<?php echo $puntos;?>" /> 
        <div class="col-md-3 col-md-offset-9">
          <div class="alert alert-warning" role="alert">
            <p>SOCIO: <strong><?= $data[0]['nombre'];?></strong></p>
            <p><?= $_SESSION['login']['sistemaValores'] ?> ACUMULADOS: <strong><?= $puntos?></strong></p>
          </div>
        </div>
        <div class="row">
          <?php 
          $url='';
          $suma=0; //variabla que va sumando los puntos
          foreach ($premios as $key => $value) {
            if($key['url']=='')
                $url="content/uploads/no-image.jpg";
            else
                $url="content/uploads/".$key['url'];
                if (!file_exists($url))
                  $url="content/uploads/no-image.jpg";
            ?>
            <!--bucle de imagenes-->
          <div class="col-xs-12 col-sm-4 col-md-3">

            <div class="productbox">
              <figure class="imgthumb" style="background-image:url('<?php echo $url;?>') ">
                <!-- <img class="img-responsive" src="<?php echo $url;?>"> -->
              </figure>
              <div class="caption">
                <h5><?php echo $value['titulo'];?></h5>   
                <h4><?php
                 
                    if($_SESSION['login']['sistemaValores'] == 'PUNTOS'){
                      echo $value['puntos'].' PUNTOS';
                    }else{
                      echo "$ ".$value['puntos'];
                      } ?>

                </h4>
              </div>
              <div class="wrap_canje">
                  Seleccionar ITEM
                  <input type="checkbox" id="<?php echo $value['idpremios'];?>" name="premios[]" value='<?php echo $value['puntos'];?>' />
              </div >
            </div>
          </div>
          <?php };?>
       </div>
       <div class="form-group">
            <div class="">
               <button id="btn_enviar" name="btn_enviar" class="btn btn-primary" disabled="true">Canjear</button>
            </div>
        </div>

    </form>
</div>