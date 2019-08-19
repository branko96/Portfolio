<form id="ModificarSocio" class="form-horizontal" method="POST" action="index.php">
  <fieldset>

  <!-- Form Name -->
  <legend>Modificar Socio</legend>
  <?php  ?>
  <div class="form-group">
      <label class="col-md-4 control-label">Tipo Socio</label>

      <div class="col-md-2 selectContainer">
          <select class="form-control" name="tipoSocio">
              <?php if ($_SESSION['login']['categorizarSocio'] == 'categoria'){ ?>
                  <option value='A' <?php if ($socio[0]['tipoCliente']== 'A')echo 'selected' ?>>A</option>
                  <option value='B'<?php if ($socio[0]['tipoCliente']== 'B')echo 'selected' ?>>B</option>
                <?php } ?>
                  <option value='C' <?php if ($socio[0]['tipoCliente']== 'C')echo 'selected' ?>>C</option>
               
          </select>
      </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="nombre">Nombre del Socio</label>  
    <div class="col-md-4">
    <input id="nombre" name="nombre" value="<?php echo $socio[0]['nombre'];?>" type="text" placeholder="Nombre y Apellido" class="form-control input-md" required="">
    <span class="help-block">Ingrese nombre y apellido del socio</span>  
    </div>
  </div>
  <input type="hidden" name="action" value="GS"/>
  <input type="hidden" name="idSocio" value="<?php echo $socio[0]['idSocios'];?>"/>
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="nTarjeta">Nº Tajeta</label>  
    <div class="col-md-4">
    <input id="nTarjeta" name="nTarjeta" value="<?php echo $socio[0]['nTarjeta'];?>" type="text" placeholder="Nº de Tarjeta" class="form-control input-md" required="">
      
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-4 control-label" for="nombre">Fecha Nac.</label>  
    <div class="col-md-4">
    <input id="fNac" value="<?= $fechaNacimiento ?>" name="fNac" type="text" placeholder="Fecha Nac." data-date-format="dd-mm-yyyy" class="form-control input-md" required="">
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-4 control-label" for="nombre">Nº celular</label>  
    <div class="col-md-4">
    <input id="Ncelular" value="<?php echo $socio[0]['celular']?>" name="Ncelular" type="text" placeholder="Nº celular"  class="form-control input-md " >
    </div>
  </div>
  <!-- Multiple Radios -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="sexo">Sexo</label>
    <div class="col-md-4">
    <div class="radio">
      <label for="sexo-0">

        <input type="radio" name="sexo" id="sexo-0" value="M" <?php if($socio[0]['sexo']=='M'){;?> checked="checked" <?php };?>>
        Masculino
      </label>
    </div>
    <div class="radio">
      <label for="sexo-1">
        <input type="radio" name="sexo" id="sexo-1" value="F" <?php if($socio[0]['sexo']=='F'){;?> checked="checked" <?php };?>>
        Femenino
      </label>
    </div>
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="mail">E-Mail</label>  
    <div class="col-md-4">
    <input id="mail" name="mail" value="<?php echo $socio[0]['email'];?>" type="text" placeholder="e-mail" class="form-control input-md" required="">
      
    </div>
  </div>

  <!-- Select Basic -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="tDocumento">Tipo de Documento</label>
    <div class="col-md-4">
      <select id="tDocumento" name="tDocumento" class="form-control">
        <option value="1">DNI</option>
        <option  value="2">CUIT</option>
      </select>
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="nDocumento">Nº de Documento</label>  
    <div class="col-md-4">
    <input id="nDocumento" name="nDocumento" value="<?php echo $socio[0]['nDocumento'];?>" type="text" placeholder="Nº " class="form-control input-md" required="">
      
    </div>
  </div>


  <div class="form-group">
    <label class="col-md-4 control-label" for="socio">Recomendado por</label>  
    <div class="col-md-4">
      <input type="text" name="recomendante" class="form-control tt-query" id="recomendante" value="" spellcheck="false" dir="auto" style="position: relative; vertical-align: top; background-color: transparent;">
      <input type="text" id="idRecomendante" name="idRecomendante" value="<?= $socio[0]['recomendado_por'] ?>" hidden>
    </div>
  </div>

  <!-- Button -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="btn_enviar"></label>
    <div class="col-md-4">
      <button id="btn_enviar" name="btn_enviar" class="btn btn-primary">Guardar cambios</button>
    </div>
  </div>

  </fieldset>
</form>