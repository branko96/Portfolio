$(function(){
	ajustar_menu();



$('#cerrar-sesion1').on("click", function(){
	$.confirm({
	    title: 'Cierre de Sesión',
	    content: 'Deseas Cerrar la Sesión actual?',
	    buttons: {
	        confirmar: function () {
	            var parametros="";
			    	$.ajax({
						url: "../cerrar_sesion.php",
						type: 'post',
						data: parametros,
						success: function(data) {
							$.alert('Sesión cerrada!');
							            setTimeout(function() {
											window.location='../../index.php'; 
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

$(window).resize(function(){
	ajustar_menu();
});
function ajustar_menu(){
       if ($(window).width() <= 990) {  

              // is mobile device
              $("body").addClass("nav-sm");
              $("body").removeClass("nav-md");

       }else{
       		$("body").addClass("nav-md");
              $("body").removeClass("nav-sm");
       }     

}