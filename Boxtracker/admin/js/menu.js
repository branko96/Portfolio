$(function(){
	$('#cerrar-sesion').on("click", function(){
		$.confirm({
		    title: 'Cierre de Sesión',
		    content: 'Deseas Cerrar la Sesión actual?',
		    buttons: {
		        confirmar: function () {
		            var parametros="";
			    	$.ajax({
						url: "cerrar_sesion.php",
						type: 'post',
						data: parametros,
						success: function(data) {
							$.alert('Sesión cerrada!');
				            setTimeout(function() {
								window.location='../index.php'; 
							},800);	                		
						}						                	
					
					});
		        },
		        cancelar: function () {
		           
		        },
		        
		    }
		});
		
	});
});