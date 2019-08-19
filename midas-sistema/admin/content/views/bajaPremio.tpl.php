<form class="form-horizontal" method="POST" action="index.php">
  <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Título</label>  
            <div class="col-md-4">
              <?php require_once("content/views/combo_premio.tpl.php");?>
            </div>
          </div>
           <input type="hidden" name="action" value="BP" /> <!--baja premio-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="btn_bajaSocio"></label>
             <div class="col-md-4">
                <button id="btn_bajaSocio" name="btn_bajaSocio" class="btn btn-warning">Eliminar Premio</button>
             </div>
          </div>  
</form>