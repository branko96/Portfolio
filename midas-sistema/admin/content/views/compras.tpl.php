<form class="form-horizontal" method="POST" action="index.php" autocomplete="off">
<legend>Ingreso de Compra</legend>
  <div class="form-group">
      <label class="col-md-4 control-label" for="radios">Dato de Socio</label>
      <div class="col-md-4">
      <div class="radio">
        <label>
          <input type="radio" name="radios" id="radios" value="1" class="radios">
          DNI
        </label>
     </div>
     <input type="hidden" name="action" value="B" />
      <div class="radio">
        <label>
          <input type="radio" name="radios" id="radios" class="radios" value="2" checked="checked">
          Nº Tarjeta
        </label>
     </div>
      </div>
   </div>
   <div class="form-group wrapSocio">
        <label class="col-md-4 control-label" for="puntos"> Nº de Socio</label>
        <div class="col-md-4">
           <input id="socio" name="socio" type="text" placeholder="Nº de Socio" class="form-control input-md" required="">
           <div id="existe"></div>  
        </div>
    </div> 
    <div class="form-group">
        <label class="col-md-4 control-label" for="importe">Importe</label>
        <div class="col-md-4">
           <input id="importe" name="importe" type="text" placeholder="Importe" class="form-control input-md" maxlength="4" required="">
        </div>
    </div> 
    <input type="hidden" name="action" value="addCompra" />    
   <div class="form-group">

        <label class="col-md-4 control-label" for="puntos">Suma</label>
        <div class="col-md-4">
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">
            <?php if($_SESSION['login']['sistemaValores'] == 'PUNTOS'){
                echo "PUNTOS";
              }else{ echo"$";} ?>

            </span>
            <input id="puntos" name="puntos" type="text" class="form-control input-md" aria-describedby="basic-addon1" readonly="">
          </div>
          <!-- <input id="puntos" name="puntos" type="text" placeholder="Puntos Suma" class="form-control input-md" readonly=""> -->
          <input id="inputMinimo" name="inputMinimo" type="number" value="<?= $_SESSION['login']['inputMinimo'] ?>" readonly hidden> 
        </div>
    </div> 

    <div class="form-group">
        <label class="col-md-4 control-label" for="btn_enviar"></label>
        <div class="col-md-4">
           <button id="btn_enviar" disabled="true" name="btn_enviar" class="btn btn-primary">Registrar</button>
        </div>
    </div>
    
</form>