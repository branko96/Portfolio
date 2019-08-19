
<form class="form-horizontal" method="POST" action="index.php" autocomplete="off">
          <fieldset>

          <!-- Form Name -->
          <legend>Alta de Socios</legend>

          <!-- Text input-->
          <div class="form-group">
              <label class="col-md-4 control-label">Tipo Socio</label>
              <div class="col-md-2 selectContainer">
                  <select class="form-control" name="tipoSocio">
                      <?php if ($_SESSION['login']['categorizarSocio'] == 'categoria'){ ?>
                          <option value='A' >A</option>
                          <option value='B'>B</option>
                        <?php } ?>
                          <option value='C' selected="">C</option>
                       
                  </select>
              </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Nombre del Socio</label>  
            <div class="col-md-4">
            <input id="nombre" name="nombre" type="text" placeholder="Nombre y Apellido" class="form-control input-md" required="">
            <span class="help-block">Ingrese nombre y apellido del socio</span>  
            </div>
          </div>
          <input type="hidden" name="action" value="A"/>
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="nTarjeta">Nº Tajeta</label>  
            <div class="col-md-4">
            <input id="socio" name="nTarjeta" type="text" placeholder="Numero" class="form-control input-md" required="">
              
            </div>
          </div>

         
         <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Fecha Nac.</label>  
            <div class="col-md-4">
            <!-- <input id="fNac" name="fNac" type="text" placeholder="Fecha Nac." data-date-format="dd-mm-yyyy" class="form-control input-md datepicker" required=""> -->
            <input id="fNac" name="fNac" type="text" placeholder="DD-MM-YYYY" required pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Nº celular</label>  
            <div class="col-md-4">
            <input id="Ncelular" name="Ncelular" type="text" placeholder="Nº celular"  class="form-control input-md " required="">
            </div>
          </div>
        

          <!-- Multiple Radios -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="sexo">Sexo</label>
            <div class="col-md-4">
            <div class="radio">
              <label for="sexo-0">
                <input type="radio" name="sexo" id="sexo-0" value="M" checked="checked">
                Masculino
              </label>
            </div>
            <div class="radio">
              <label for="sexo-1">
                <input type="radio" name="sexo" id="sexo-1" value="F">
                Femenino
              </label>
            </div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="mail">E-Mail</label>  
            <div class="col-md-4">
            <input id="mail" name="mail" type="text" placeholder="e-mail" class="form-control input-md" required="">
              
            </div>
          </div>

          <!-- Select Basic -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="tDocumento">Tipo de Documento</label>
            <div class="col-md-4">
              <select id="tDocumento" name="tDocumento" class="form-control">
                <option value="1">DNI</option>
                <option value="2">CUIT</option>
              </select>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="nDocumento">Nº de Documento</label>  
            <div class="col-md-4">
            <input id="nDocumento" name="nDocumento" type="text" placeholder="Nº " class="form-control input-md" required="">
              
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="socio">Recomendado por</label>  
            <div class="col-md-4">
              <input type="text" name="recomendante" class="form-control tt-query" id="recomendante"  spellcheck="false" dir="auto" style="position: relative; vertical-align: top; background-color: transparent;">
              <input type="text" id="idRecomendante" name="idRecomendante" value="" hidden></input>
            </div>
          </div>

          <!-- Button -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="btn_enviar"></label>
            <div class="col-md-4">
              <button id="btn_enviar" name="btn_enviar" class="btn btn-primary">Crear Socio</button>
            </div>
          </div>

          </fieldset>
</form>


