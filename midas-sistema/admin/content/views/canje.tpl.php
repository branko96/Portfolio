<!-- canje.tpl -->
<form class="form-horizontal" method="POST" action="index.php" >
   <div class="form-group">
      <label class="col-md-4 control-label" for="radios">Dato de Socio</label>
      <div class="col-md-4">
      <div class="radio">
        <label>
          <input type="radio" name="radios" id="radios" value="1" class="radios" >
          DNI
        </label>
     </div>
    
      <div class="radio">
        <label>
          <input type="radio" name="radios" id="radios" class="radios" value="2" checked="checked">
          Nº Tarjeta
        </label>
     </div>
      </div>
   </div>
   <div class="form-group wrapSocio">
        <label class="col-md-4 control-label" for="nombre">Nº de Socio</label>  
        <div class="col-md-4">
           <input id="socio" name="socio" type="text" placeholder="Nº Socio" class="form-control input-md" required="">
           <div id="existe"></div> 
        </div>
    </div>
    <input type="hidden" name="action" value="canje" />
     <div class="form-group">
        <label class="col-md-4 control-label" for="btn_enviar"></label>
        <div class="col-md-4">
           <button id="btn_enviar" name="btn_enviar" disabled="true" class="btn btn-primary">Aceptar</button>
        </div>
    </div>

</form>