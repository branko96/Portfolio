<form class="form-horizontal" method="POST" action="socio/editarsocio">
<fieldset>

<!-- Form Name -->
<legend>Modificar Socio</legend>

<!-- Multiple Radios -->
<div class="form-group">
      <label class="col-md-4 control-label" for="radios">Dato de Socio</label>
      <div class="col-md-4">
      <div class="radio">
        <label>
          <input type="radio" name="radios" id="radios" value="1" class="radios" >
          DNI
        </label>
     </div>
     <input type="hidden" name="action" value="E">
      <div class="radio">
        <label>
          <input type="radio" name="radios" id="radios" class="radios" value="2" checked="checked">
          Nº Tarjeta
        </label>
     </div>
      </div>
   </div>

<!-- Text input-->
<div class="form-group wrapSocio">
  <label class="col-md-4 control-label" for="socio">Nº</label>  
  <div class="col-md-4">
  <input id="socio" name="socio" type="text" placeholder="Numero" class="form-control input-md" required="">
  <div id="existe"></div> 
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="btn_bajaSocio"></label>
  <div class="col-md-4">
    <button id="btn_enviar" name="btn_enviar" disabled="true" class="btn btn-warning">Editar campos</button>
  </div>
</div>

</fieldset>
</form>