$(function(){



$(".menu_herramientas").click(function(e){
		e.preventDefault();
		var ruta=$("a", this).data('ruta');
		$('.menu_herramientas').removeClass("current-page");
		$(this).addClass("current-page");
		//console.log(ruta);
		/*$("#contenedor_herramientas").html("").load(ruta, function(){
            $(this).fadeIn('slow');
        });*/
        $( "#contenedor_herramientas" ).html("");
        $.post( ruta, function( data ) {
		  $( "#contenedor_herramientas" ).html(data).show('slow');
		});
        //$("#contenedor_herramientas").html("").load(ruta);
	});

var ruta_predeterminada=$(".menu_herramientas:first").children("a").data('ruta');
$("#contenedor_herramientas").load(ruta_predeterminada).show("slow");





/*

var clickCheckbox = document.querySelectorAll('.habilitar_todo');

for (var i of clickCheckbox) {
	i.addEventListener('click', function() {
	  //alert(i.checked);
	  
	  var permisos_div_padre= $(this).parent().parent().parent().find("div .permisos");
	  //console.log(permisos_div_padre.prevObject[0].nextSibling);
	  var permisos_div=permisos_div_padre.prevObject[0].nextSibling;
	  //console.log(this.checked);
	  if(this.checked){
	  	permisos_div.style.display = 'none';
	  }else{
	  	permisos_div.style.display = 'block';
	  }
	});
}

var clickCheckbox1 = document.querySelectorAll('.habilitar_modulo');

for (var e of clickCheckbox1) {
	e.addEventListener('click', function() {
	  //alert(i.checked);
	  
	  var permisos_div= $(this).parent().parent().parent().parent().parent();
	  
	  var check_habilitar_todo=$(this).parent().parent().parent().siblings();

	  var div_permisos=$(this).parent().parent().parent().siblings("div.permisos");
	  console.log(div_permisos);
	  if(this.checked){
	  	permisos_div[0].style.opacity = 1;
	  	check_habilitar_todo[0].style.display='block';

	  }else{
	  	permisos_div[0].style.opacity = 0.6;
	  	check_habilitar_todo[0].style.display='none';
	  	div_permisos[0].style.display='none';
	  }
	});
}
*/
});

function changeSwitchery(switch_elem, checked) {
for (var i = 0; i > switch_elem.length; i++) {
  if ($(switch_elem)[i].checked){ // it's already on so 
            $(switch_elem)[i].trigger('click').removeAttr("checked"); // turn it off
        }else{ // otherwise 
            // nothing, already off
        }
}
}

