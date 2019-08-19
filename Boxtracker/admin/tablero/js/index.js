var ruta = 'http://'+window.location.host;
$(function(){
	var cargando='<div class="text-center" style="height:15rem;"><center><img src="../../img/loading.gif" /></center></div>';
	$( "#contenedor_herramientas" ).html(cargando);
	setTimeout(function(){  
		var ruta_predeterminada=$(".menu_herramientas:first").children("a").data('ruta');
		$("#contenedor_herramientas").load(ruta_predeterminada).show("slow");
	}, 1000);
	
	$(".menu_herramientas").click(function(e){
		e.preventDefault();
		$("#loading").show("fast");
		$( "#contenedor_herramientas" ).html(cargando);
		
		var ruta=$("a", this).data('ruta');
		$('.menu_herramientas').removeClass("current-page");
		$(this).addClass("current-page");
		//console.log(ruta);
		/*$("#contenedor_herramientas").html("").load(ruta, function(){
            $(this).fadeIn('slow');
        });*/
        
        $.post( ruta, function( data ) {
        	setTimeout(function(){ 
        		$("#contenedor_herramientas" ).html(data).show('slow');
        		$("#loading").hide("fast");
        	}, 1000);
		});
        //$("#contenedor_herramientas").html("").load(ruta);
	});


	
	
});