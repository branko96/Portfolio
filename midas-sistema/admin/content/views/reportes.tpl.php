
<div id="reporteGeneral" class="form-group">
      <legend><span class="glyphicon glyphicon-list-alt"></span> Reportes</legend>
     <!-- <div class="col-md-6">
     	<h2>Compras Mensuales</h2>
     	<div class="alert alert-info" role="alert">Ejemplo gráfico: En desarrollo para futuras versiones del sistema</div>
     		
		<canvas id="comprasMensuales" height="450" width="600"></canvas>
		
     </div> -->
     <div class="col-md-6">
	     <div class="alert alert-warning" role="alert">TOTAL DE SOCIOS: <strong><?= $numSocio ?></strong></div>
	     
	     <div id="canvas-holder" >
         <div class="panel panel-primary">
            <div class="panel-heading">Datos Demográficos</div>
            <div class="panel-body">
                <div class="col-md-3">
                    <p><div class="icon-M"></div>Hombres</p>
                    <p><div class="icon-F"></div>Mujeres</p>
                </div>
                <canvas id="sexoSocios" width="300" height="300" />
            
            </div>
        </div>

    	<div id="chartjs-tooltip"></div>
        
        </div>
            
     	<nav class="col-md-12">
     		<ul>
     			<li><a href="exportarSocio.php" title=""> <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Exportar Socios</a></li>
                <li><a href="#" title="" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Exportar Movimientos</a></li>
     		</ul>
     	</nav>
     
     </div>

      	
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Período</h4>
      </div>
      <div class="modal-body">
          <form method="POST" action="exportarMovimientos.php">
            <fieldset>
            <!-- Text input-->
            <div class="form-group">
              <div class="col-md-6">
              desde<input id="desde" name="desde" type="date" placeholder="dd/mm/aaaa" class="form-control input-md fecha">
              </div>

               <div class="col-md-6">
              hasta<input id="hasta" name="hasta" type="date" placeholder="dd/mm/aaaa" class="form-control input-md fecha">
                
              </div>
            </div>

            </fieldset>
        
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <button type="submit" class="btn btn-primary">Consultar</button>
      </div>
      </form>
    </div>
  </div>
</div>