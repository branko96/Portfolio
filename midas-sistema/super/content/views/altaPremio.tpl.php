<form class="form-horizontal" method="POST" action="index.php" enctype="multipart/form-data" >
          <fieldset>

          <!-- Form Name -->
          <legend>Alta de Premio</legend>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Título</label>  
            <div class="col-md-4">
            <input id="nombre" name="titulo" type="text" placeholder="Título" class="form-control input-md" required="">
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
            <input id="nombre" name="fDesde" type="text" placeholder="Fecha desde" data-date-format="dd-mm-yyyy" class="form-control input-md datepicker" required="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Fecha hasta</label>  
            <div class="col-md-4">
            <input id="nombre" name="fHasta" type="text" placeholder="Fecha hasta" data-date-format="dd-mm-yyyy" class="form-control input-md datepicker" required="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Stock</label>  
            <div class="col-md-4">
            <input id="nombre" name="stock" type="text" placeholder="Stock" class="form-control input-md" required="">
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
              <input id="puntos" name="puntos" type="text" class="form-control input-md" aria-describedby="basic-addon1" >
            </div>

          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Imagen</label>  
            <div class="col-md-4">
            <input id="img" name="img[]" type="file"  class="form-control input-md" style="height: auto">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Visibilidad</label>  
            <div class="col-md-4">
            <input id="visibilidad" name="visibilidad" type="checkbox" checked>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Detalle</label>  
            <div class="col-md-4">
             <textarea name="detalle"  placeholder="Detalle" rows="6" class="form-control input-md"></textarea>
            </div>
          </div>
         
           
          <!-- Button -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="btn_enviar"></label>
            <div class="col-md-4">
              <button id="btn_enviar" name="btn_enviar" class="btn btn-primary">Crear Premio</button>
            </div>
          </div>

          </fieldset>
</form>