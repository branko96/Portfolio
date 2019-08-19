  <?php 
          foreach ($premios['result'] as $key ) {
            if($key['url']=='')
                $url="../admin/content/uploads/no-image.jpg";
            else
                $url="../admin/content/uploads/".$key['url'];
                if (!file_exists($url))
                  $url="../admin/content/uploads/no-image.jpg";
                
            ?>
            <!--bucle de imagenes-->
          <div class="col-xs-12 col-sm-4 col-md-3">
            <div class="productbox">
              <figure class="imgthumb" style="background-image:url('<?php echo $url;?>') ">
                <!-- <img class="img-responsive" src="<?php echo $url;?>"> -->
              </figure>
              <div class="caption">
                <h5><?php echo $key['titulo'];?></h5>
                <h4><?php 
                     if($datos_club[0]['sistemaValores'] == 'PUNTOS'){
                      echo $key['puntos']." PUNTOS";
                     }else{
                       echo "$ ".$key['puntos'];
                     }
                  
                  ?> </h4>              
                 <h5>Club: <?php echo $key['nombreClub'];?></h5>
              </div>
              <div class="wrap_canje">
                <?php if (!empty($_SESSION)){ ?>
                  <button type="button" class="btn-canje btn btn-warning" data-id="<?php echo $key['idpremios'];?>" data-puntos="<?php echo $key['puntos'];?>" data-titulo="<?php echo $key['titulo'];?>" data-detalle="<?php echo $key['detalle'];?>">CANJEAR</button>
                <?php } ?>
              </div>
            </div>
          </div>
          <?php }
          
          //pongo los numeros de pagina
        $total_registros=$premios['total_registros'];
        $total_paginas=$premios['total_paginas'];
        $pagina=$premios['pagina'];
        echo"<div class='paginacion col-sm-12'>";
                  if(($pagina - 1) > 0) {
                          echo "<a class='alert-warning' href=\"index.php?club=".$idClub."&pag=".($pagina-1)."\">< Anterior</a> ";
                  }

                  for ($i=1; $i<=$total_paginas; $i++){
                          if ($pagina == $i)
                                  echo "<b class='alert-warning'>".$pagina."</b> ";
                          else
                                  echo "<a class='alert-warning' href=\"index.php?club=".$idClub."&pag=$i\">$i</a>";
                  }

                  if(($pagina + 1)<=$total_paginas) {
                          echo "<a class='alert-warning' href=\"index.php?club=".$idClub."&pag=".($pagina+1). "\">Siguiente ></a>";
                  }
              echo"</div>";