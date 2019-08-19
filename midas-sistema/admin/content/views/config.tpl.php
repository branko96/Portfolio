<!-- config.tpl -->
<form id="config" class="form-horizontal" method="POST" action="config" >
 <!-- Form Name -->
   
  <section class="row">
    <div class="form-group">
      <div class="col-md-6">       
        <legend><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>Sistema de valores</legend>
        <div class="radio col-md-12">
          <label class="col-md-4"><input type="radio" name="sistemaValores" value="PUNTOS" 
          <?php if ((!isset($config[0]['sistemaValores'])) OR ($config[0]['sistemaValores']) != 'PESOS') echo 'checked'; ?>>Sistema de puntos</label>
          <div class="alert alert-info col-md-7" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Define las operaciones como puntos</div>
        </div>

        <div class="radio col-md-12">
          <label class="col-md-4"><input type="radio" name="sistemaValores" value="PESOS" 
          <?php if ((isset($config[0]['sistemaValores'])) AND ($config[0]['sistemaValores']) == 'PESOS') echo 'checked'; ?>>Cartera digital</label>
          <div class="alert alert-info col-md-7" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Define las operaciones como porcentajes</div>
        </div>
      </div> 

      <div class="col-md-6">
        <legend><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Socios</legend>

        <div class="row">
          <div class="radio col-md-4">
          <label ><input type="radio" id="radioNinguno" name="categorizarSocio" value="off"<?php if (@$config[0]['categorizarSocio'] == 'off') echo 'checked'; ?>>Ninguno</label></div>
          <div class="alert alert-info col-md-7" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Desactiva categoría o herencia de puntos</div>

          <div class="radio col-md-4">
          <label ><input type="radio" id="radioCategoria" name="categorizarSocio" value="categoria"<?php if (@$config[0]['categorizarSocio'] == 'categoria') echo 'checked'; ?>>Categorizar por Tipos</label></div>
          <div class="alert alert-info col-md-7" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Habilita uso de tipo de socio A B C</div>

          <div class="radio col-md-4">
          <label ><input type="radio" id="radioHerencia" name="categorizarSocio" value="herencia"<?php if (@$config[0]['categorizarSocio'] == 'herencia') echo 'checked'; ?>>Herencia de puntos</label></div>
          <div class="alert alert-info col-md-7" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Habilita uso de herencia de puntos</div>  
        </div>

        <div class="row">
          <div class="col-md-4">
            <label class="control-label" for="inputMinimo">Mínimo Imputable</label>  
            <input id="inputMinimo" name="inputMinimo" type="number" placeholder="Valor en pesos" class="form-control input-md" value="<?= $config[0]['inputMinimo'] ?>" required="" <?php if (@$config[0]['categorizarSocio'] == 'herencia') echo 'readonly'; ?>> 
          </div>   
        </div>

        <div class="row">
          <div class="class-tipo-cliente col-md-4" >
            <label class="control-label" for="inputMinimo">Socio A</label>
            <input name="valorCliente[A]" type="number" placeholder="Puntos que suma" class="form-control input-md" value="<?php if(isset($valorCliente['A'])) echo $valorCliente['A']; ?>" >
          </div>
          <div class="class-tipo-cliente col-md-4">
            <label class="control-label" for="inputMinimo">Socio B</label>
            <input name="valorCliente[B]" type="number" placeholder="Puntos que suma" class="form-control input-md" value="<?php if(isset($valorCliente['B'])) echo $valorCliente['B']; ?>" > 
          </div>
          <div class="class-cliente-c col-md-4" style="<?php if (@$config[0]['categorizarSocio'] == 'herencia') echo 'display: none'; ?>">
            <label class="control-label" >Socio C</label>
            <input  name="valorCliente[C]" type="number" placeholder="Puntos que suma" class="form-control input-md" value="<?php if(isset($valorCliente['C'])) echo $valorCliente['C']; ?>" > 
          </div>    
        </div> 

        <div class="row class-herencia-cliente" style="<?php if (@$config[0]['categorizarSocio'] == 'herencia'){ echo 'display: block';}else{echo 'display: none';} ?>">
          <div class=" col-md-4">
            <label class="control-label" >Inicial</label>
            <input name="herencia[0]" type="number" placeholder="% que suma" class="form-control input-md" value="<?php if(isset($herencia[0])) echo $herencia[0]; ?>" >
          </div>
          <div class=" col-md-4">
            <label class="control-label">Nivel 1</label>
            <input name="herencia[1]" type="number" placeholder="% que suma" class="form-control input-md" value="<?php if(isset($herencia[1])) echo $herencia[1]; ?>" > 
          </div>
          <div class="col-md-4">
            <label class="control-label" >Nivel 2</label>
            <input  name="herencia[2]" type="number" placeholder="% que suma" class="form-control input-md" value="<?php if(isset($herencia[2])) echo $herencia[2]; ?>" > 
          </div>    
        </div> 
      </div>
    </div>  
  </section>

  <section class="row">
    <legend><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>Configuración de notificaciones via e-mail</legend>
    <div class="col-md-4">
      <label class="control-label" for="puntosXinput">Email</label>  
      <textarea name="email" style="width: 100%" ><?php if(isset($config[0]['email'])) echo $config[0]['email']; ?></textarea>
    </div>
    <div class="alert alert-info col-md-4 col-md-offset-1" role="alert">
      <p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Puede escribir uno o varios correos para enviar notificaciones de canjes.</p>
      <p></p>
      <b>SEPARE LOS CORREOS POR COMA</b>
      <p>Ej: admin@midasmkt.com.ar<strong>,</strong> user@midasmkt.com.ar</p>
    </div>
  </section>

  <section class="row">
    <legend><span class="glyphicon glyphicon-record" aria-hidden="true"></span>Configuración de Juego Rueda de la fortuna</legend>
    <div class="form-group">
        <div class="row">
          <div class="alert alert-info col-md-4 col-md-offset-4" role="alert">
            <p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Usted puede completar TODOS o ALGUNOS campos, puede escribir el DETALLE del premio o los PUNTOS a acumular</p>
            <p></p>
            <b>TILDE el cuadrado para seleccionar la función PREMIO</b>
            <p></p>
          </div>
        </div>
                                                        
        <div class="col-md-6">
          <label class="col-md-4 control-label" for="puntosXinput">Campo 1</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-1" name="check[1]"  type="checkbox" class="checkBox" <?php if(isset($datosJson['check'][1])){echo 'checked';} ?>>
              </span>
              <input type="text" name="campo[1]" class="form-control" value="<?php if(isset($datosJson['campo'][1])){echo $datosJson['campo'][1];} ?>" placeholder="DETALLE o PUNTOS" >
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 2</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-2" name="check[2]" type="checkbox" >
              </span>
              <input type="text" name="campo[2]" class="form-control" value="<?php if(isset($datosJson['campo'][2])){echo $datosJson['campo'][2];} ?>" placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 3</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-3" name="check[3]" type="checkbox"  <?php if(isset($datosJson['check']['3'])){echo 'checked';}?> >
              </span>
              <input type="text" name="campo[3]" class="form-control" value="<?php if(isset($datosJson['campo'][3])){echo $datosJson['campo'][3];} ?>" placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 4</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-4" name="check[4]" type="checkbox" <?php if(isset($datosJson['check']['4'])){echo 'checked';}?> >
              </span>
              <input type="text" name="campo[4]" class="form-control" value="<?php if(isset($datosJson['campo'][4])){echo $datosJson['campo'][4];} ?>" placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 5</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-5" name="check[5]" type="checkbox" <?php if(isset($datosJson['check']['5'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[5]"class="form-control" value="<?php if(isset($datosJson['campo'][5])){echo $datosJson['campo'][5];} ?>" placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 6</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-6" name="check[6]" type="checkbox" <?php if(isset($datosJson['check']['6'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[6]"class="form-control" value="<?php if(isset($datosJson['campo'][6])){echo $datosJson['campo'][6];} ?>" placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 7</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-" name="check[7]"  type="checkbox" <?php if(isset($datosJson['check']['7'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[7]" class="form-control" value="<?php if(isset($datosJson['campo'][7])){echo $datosJson['campo'][7];} ?>" placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 8</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-" name="check[8]"  type="checkbox" <?php if(isset($datosJson['check']['8'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[8]" class="form-control" value="<?php if(isset($datosJson['campo'][8])){echo $datosJson['campo'][8];} ?>" placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 9</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-" name="check[9]" type="checkbox" <?php if(isset($datosJson['check']['9'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[9]"class="form-control" value="<?php if(isset($datosJson['campo'][9])){echo $datosJson['campo'][9];} ?>" placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 10</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-10" name="check[10]" type="checkbox" <?php if(isset($datosJson['check']['10'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[10]" class="form-control"value="<?php if(isset($datosJson['campo'][10])){echo $datosJson['campo'][10];} ?>"  placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 11</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-11" name="check[11]" type="checkbox" <?php if(isset($datosJson['check']['11'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[11]" class="form-control"value="<?php if(isset($datosJson['campo'][11])){echo $datosJson['campo'][11];} ?>"  placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 12</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-12" name="check[12]" type="checkbox" <?php if(isset($datosJson['check']['12'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[12]" class="form-control"value="<?php if(isset($datosJson['campo'][12])){echo $datosJson['campo'][12];} ?>"  placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 13</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-13" name="check[13]" type="checkbox" <?php if(isset($datosJson['check']['13'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[13]" class="form-control"value="<?php if(isset($datosJson['campo'][13])){echo $datosJson['campo'][13];} ?>"  placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 14</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-14" name="check[14]" type="checkbox" <?php if(isset($datosJson['check']['14'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[14]"class="form-control" value="<?php if(isset($datosJson['campo'][14])){echo $datosJson['campo'][14];} ?>" placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 15</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-15" name="check[15]"  type="checkbox" <?php if(isset($datosJson['check']['15'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[15]"class="form-control" value="<?php if(isset($datosJson['campo'][15])){echo $datosJson['campo'][15];} ?>" placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
        </div>

        <div class="col-md-6">
                    <label class="col-md-4 control-label" for="puntosXinput">Campo 16</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-16" name="check[16]" type="checkbox" <?php if(isset($datosJson['check']['16'])){echo 'checked';}?>>
              </span>
              <input type="text"name="campo[16]" class="form-control"value="<?php if(isset($datosJson['campo'][16])){echo $datosJson['campo'][16];} ?>"  placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 17</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-17" name="check[17]" type="checkbox" <?php if(isset($datosJson['check']['17'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[17]"class="form-control" value="<?php if(isset($datosJson['campo'][17])){echo $datosJson['campo'][17];} ?>" placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 18</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-18" name="check[18]" type="checkbox" <?php if(isset($datosJson['check']['18'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[18]" class="form-control"value="<?php if(isset($datosJson['campo'][18])){echo $datosJson['campo'][18];} ?>"  placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 19</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-19" name="check[19]"  type="checkbox" <?php if(isset($datosJson['check']['19'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[19]" class="form-control"value="<?php if(isset($datosJson['campo'][19])){echo $datosJson['campo'][19];} ?>"  placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 20</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-20" name="check[20]"  type="checkbox" <?php if(isset($datosJson['check']['20'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[20]" class="form-control"value="<?php if(isset($datosJson['campo'][20])){echo $datosJson['campo'][20];} ?>"  placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 21</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-21" name="check[21]"  type="checkbox" <?php if(isset($datosJson['check']['21'])){echo 'checked';}?>>
              </span>
              <input type="text"name="campo[21]" class="form-control"value="<?php if(isset($datosJson['campo'][21])){echo $datosJson['campo'][21];} ?>"  placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 22</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-22" name="check[22]" type="checkbox" <?php if(isset($datosJson['check']['22'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[22]"class="form-control" value="<?php if(isset($datosJson['campo'][22])){echo $datosJson['campo'][22];} ?>" placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 23</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-23" name="check[23]" type="checkbox" <?php if(isset($datosJson['check']['23'])){echo 'checked';}?>>
              </span>
              <input type="text"name="campo[23]" class="form-control"value="<?php if(isset($datosJson['campo'][23])){echo $datosJson['campo'][23];} ?>"  placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 24</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-24" name="check[24]" type="checkbox" <?php if(isset($datosJson['check']['24'])){echo 'checked';}?>>
              </span>
              <input type="text"name="campo[24]" class="form-control"value="<?php if(isset($datosJson['campo'][25])){echo $datosJson['campo'][25];} ?>"  placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 25</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-25" name="check[25]" type="checkbox" <?php if(isset($datosJson['check']['25'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[25]"class="form-control" value="<?php if(isset($datosJson['campo'][25])){echo $datosJson['campo'][25];} ?>" placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 26</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-26" name="check[26]" type="checkbox" <?php if(isset($datosJson['check']['26'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[26]" class="form-control"value="<?php if(isset($datosJson['campo'][26])){echo $datosJson['campo'][26];} ?>"  placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 27</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-27" name="check[27]" type="checkbox" <?php if(isset($datosJson['check']['27'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[27]" class="form-control"value="<?php if(isset($datosJson['campo'][27])){echo $datosJson['campo'][27];} ?>"  placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 28</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-28" name="check[28]" type="checkbox" <?php if(isset($datosJson['check']['28'])){echo 'checked';}?>>
              </span>
              <input type="text"name="campo[28]" class="form-control"value="<?php if(isset($datosJson['campo'][28])){echo $datosJson['campo'][28];} ?>"  placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 29</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-29" name="check[29]"  type="checkbox" <?php if(isset($datosJson['check']['29'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[29]"class="form-control" value="<?php if(isset($datosJson['campo'][29])){echo $datosJson['campo'][29];} ?>" placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->

          <label class="col-md-4 control-label" for="puntosXinput">Campo 30</label>  
          <div class="col-md-7">
            <div class="input-group">
              <span class="input-group-addon">
                <input id="check-30" name="check[30]" type="checkbox" <?php if(isset($datosJson['check']['30'])){echo 'checked';}?>>
              </span>
              <input type="text" name="campo[30]"class="form-control" value="<?php if(isset($datosJson['campo'][30])){echo $datosJson['campo'][30];} ?>" placeholder="DETALLE o PUNTOS">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
        </div>
    </div>

   <input type="number" id="idConfig" name="idConfig" value="<?= $config[0]['club'] ?>" hidden >
    <div class="form-group">
        <div class="col-md-4 col-md-offset-4">
           <button id="btn_enviar" name="btn_enviar" class="btn btn-primary">Aceptar</button>
        </div>
    </div>
  </section>
    

</form>

<script>

  $('.checkBox').on('click',function(){

    nombreCheck=($(this).attr("name"));
    nombreCampo= nombreCheck.replace("check","campo");
    campo=$("input[name='"+nombreCampo+"']");

    if ($(this).is(':checked') ) {
      // alert("activo y el campo a modificar es "+ nombreCampo);
      campo.val('');
          
      campo.attr({
        onkeypress: '',
        placeholder : 'Ingrese SOLO TEXTO',
        
      });
    
    }else{
      
      campo.val('');  
      campo.attr({
        onkeypress: 'return valida(event)',
        placeholder : 'Ingrese SOLO NÚMEROS',
        
      });
    }
    // campo = document.getElementsByTagName('campo[1]');
    // campo.setAttribute('onkeypress="return valida(event)"');
  });



  function valida(e){
      tecla = (document.all) ? e.keyCode : e.which;

      //Tecla de retroceso para borrar, siempre la permite
      if (tecla==8){
          return true;
      }
          
      // Patron de entrada, en este caso solo acepta numeros
      patron =/[0-9]/;
      tecla_final = String.fromCharCode(tecla);
      return patron.test(tecla_final);
  }
</script>