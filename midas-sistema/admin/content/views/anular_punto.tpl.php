<?php 



?>

 <style type="text/css">
 	.panel{
 		margin-bottom: 60px;
 	}
 	.result{
		margin-top: 300px;
		
	}
 </style>

	<div class="col-sm-offset-2 panel panel-default col-sm-8">
      <div class="panel-heading text-center"> <h3>Búsqueda Socio</h3> </div>
      	<div class="panel-body">
			<form class="form-horizontal">
				<div class="form-group">
				    <label class="control-label col-sm-4" for="socio">Socio</label>
				    <div class="col-sm-6"> 
				    	<input type="text" class="form-control" id="socio" placeholder="Ingrese DNI del socio">
				    </div>
			  	</div>
			  	<div class="col-sm-offset-5 col-sm-8">
			  		<button type="button" id="btn-buscar" class="btn btn-default">Buscar</button>
				</div>
			</form>
		</div>

    </div>

    <div id="resultado_busqueda" class="result text-center"></div>	



<script type="text/javascript">
	$(document).ready(function() {
		$('#btn-buscar').click(function() {
			var valor=$("#socio").val();
			if(valor != ""){
				$.ajax({
					    type: 'POST', 
					    url: 'content/controllers/branko/buscar_socio.php',
					    data: {'dni' : valor},       
					    success: function(datos){
					      $("#resultado_busqueda").html(datos);


					       
					    }
					  });
			}else{
				alert('Debe ingresar un DNI de un socio!');
			}

		});

		

	});
</script>