<!-- editarPremio.tpl -->
<?php require_once("content/models/editarPremio.mod.php");?>
<form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="index.php">
          <fieldset>

          <!-- Form Name -->
          <legend>Modificar Premio</legend>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Título</label>  
            <div class="col-md-4">
            <input id="nombre" name="titulo" value="<?php echo $data[0]['titulo'];?>" type="text" placeholder="Título" class="form-control input-md" required="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Tipo</label>  
            <div class="col-md-4" >
              <?php require_once("content/views/comboTipo_Premios.tpl.php");?> <!--incluyo categorias premios--> 
            </div>
          </div>
          <input type="hidden" name="action" value="AP"/>
           <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Fecha desde</label>  
            <div class="col-md-4">
            <input id="nombre" name="fDesde" type="text" placeholder="Fecha desde" class="form-control input-md datepicker" value="<?php echo $data[0]['fechaDesde'];?>" required="">
            </div>
          </div>
          <label class="col-md-4 control-label" for="nombre">Fecha hasta</label>
          <div class="form-group">
                <div class="col-md-4">
                    <input id="nombre" class='datepicker form-control input-md' name="fHasta" type="text" value="<?php echo $data[0]['fechaHasta'];?>"  placeholder="Fecha hasta" class="form-control input-md" required="">
                </div>
            </div>
        
        
          <input type="hidden" name="action" value="GP"/>
          <input type="hidden" name="id" value="<?php echo $data[0]['idpremios'];?>"/>
          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Stock</label>  
            <div class="col-md-4">
            <input id="nombre" name="stock" type="text" value="<?php echo $data[0]['stock'];?>"  placeholder="Stock" class="form-control input-md" required="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Valor por canje</label>  

            <div class="col-md-4 input-group" style="padding: 5px">
              <span class="input-group-addon" id="basic-addon1">
              <?php if($_SESSION['login']['sistemaValores'] == 'PUNTOS'){
                  echo "PUNTOS";
                }else{ echo"$";} ?>

              </span>
              <input id="puntos" name="puntos" type="text" class="form-control input-md" aria-describedby="basic-addon1" value="<?php echo $data[0]['puntos'];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Visibilidad</label>  
            <div class="col-md-4">
            <input id="visibilidad" name="visibilidad" type="checkbox" <?php if($data[0]['visibilidad']=='1'){echo 'checked';}?> >
            </div>
          </div> 
          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Detalle</label>  
            <div class="col-md-4">
             <textarea name="detalle"  placeholder="Detalle" rows="6" class="form-control input-md"><?php echo $data[0]['detalle'];?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Imagen</label>  
            <div class="col-md-4">
            <input id="img" name="img" type="file"  class="form-control input-md" style="height: auto">
            <?php if($data[0]['img']!='') {?>
            <img src="content/uploads/<?php echo $data[0]['img'] ?>" class="img-responsive">
            <?php }?>
            </div>
          </div>
           <!-- Button -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="btn_enviar"></label>
            <div class="col-md-4">
              <button id="btn_enviar" name="btn_enviar" class="btn btn-primary">Guardar Cambios</button>
            </div>
          </div>
 
          </fieldset>
</form>