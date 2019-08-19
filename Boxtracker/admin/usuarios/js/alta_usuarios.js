$(function(){

var elem = document.querySelectorAll('.js-switch1');
var swit=[];
for (var i of elem) {
	var s=new Switchery(i);
 	 swit.push(s);
}
//LLAMADO DE FUNCIONES

habilitar_modulo();
habilitar_todo();
//////////////////
var table=$("#tabla_usuarios").DataTable({
	"language":{
		"url":"http://boxtracker.net/boxtracker1/vendors/datatables.net/Spanish-DATATABLE.json"
	},
    responsive: true
});
$(".btn-siguiente").click(function(){
	var nombre=$("#nombre_u").val();
	var apellido=$("#apellido_u").val();
	var email=$("#email_u").val();
	var dni=$("#dni_u").val();
	var tel=$("#tel_u").val();
	if (nombre != "" && apellido != "" && email != "" && dni != "" && tel != "") {
		$("#datos_personales").hide();
		$("#permisos_user").show();
	}else{
		$.alert("Complete los datos");
	}
});
$(".btn_atras").click(function(){
	$("#permisos_user").hide();
	$("#datos_personales").show();
});
$("#email_u").keypress(function(e) {
    if(e.which == 13) {
      e.preventDefault();
    }
});
$("#email_u").focusout(function(){
	 campo = $(this).val();
    valido = $("#emailOK");
        
    emailRegex = /^(?:[^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*|"[^\n"]+")@(?:[^<>()[\].,;:\s@"]+\.)+[^<>()[\]\.,;:\s@"]{2,63}$/i;
    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
    if (emailRegex.test(campo)) {
      valido.text("Email Correcto");
      valido.css("color", "#5cb85c");
      $(".btn-siguiente").attr('disabled', false);
      $(".btn-siguiente").focus();
    } else {
    	$(".btn-siguiente").attr('disabled', true);
    	$(this).focus();
      valido.text("Email Incorrecto");
      valido.css("color", "#d9534f"); 
    }
    
    valido.css("font-weight", "bold");
    valido.css("margin-top", "1rem");
});

$("#nuevo_usuario").submit(function(e){
		e.preventDefault();
		e.stopImmediatePropagation();
		var form =$(this);
		var params=$(this).serialize();
		//$(this).find('input').removeAttr("disabled");

		$("#respuesta_alta").html(""); 
		$("#cargando").show();
		$.ajax({
			url: "ajax/ajax_usuarios.php",
			type: 'post',
			data: params,
			success: function(data) {
				$("#respuesta_alta").html(data); 
				//console.log(data);
				$("#cargando").hide();
				cargar_grilla_users(); 
				setTimeout(function(){
					$("#respuesta_alta").html("");
					$(".permisos").hide(); 
					form[0].reset();
					for (var f of swit) {
						
						f.handleOnchange(false);
					}
					$("#emailOK").text("");
					$("#permisos_user").hide();
					$("#datos_personales").show();
					$("#modal_alta_usuario").modal("hide");
				},1500);
			}						                	
		
		});
});

});
function cargar_grilla_users(){
	$("#div_tabla_usuarios").html(""); 
	var btn='alta';
	$.ajax({
		url: "ajax/ajax_usuarios.php",
		type: 'post',
		data: {op:'listar', tipo:btn},
		success: function(data) {
			$("#div_tabla_usuarios").html(data);    
			var table=$("#tabla_usuarios2").DataTable({
				"language":{
					"url":"http://boxtracker.net/boxtracker1/vendors/datatables.net/Spanish-DATATABLE.json"
				},
        		responsive: true
			});

		}						                	
	
	});
}

function habilitar_todo(){
	var clickCheckbox = document.querySelectorAll('.habilitar_todo');

		for (var i of clickCheckbox) {
			i.addEventListener('click', function() {
			  //alert(i.checked);
			  
			  var permisos_div_padre= $(this).parent().parent().parent().find("div .permisos");
			  //console.log(permisos_div_padre.prevObject[0].nextSibling);
			  var permisos_div=permisos_div_padre.prevObject[0].nextSibling;
			  //console.log(this.checked);
			  if(this.checked){
			  	
			  	var elem2 = permisos_div.querySelectorAll('.js-switch1');
			  	//console.log(elem2);
			  	for (var f of elem2) {
					setSwitchery(f, true);
				}
				setTimeout(function(){permisos_div.style.display = 'none';},600);

			  }else{
			  	permisos_div.style.display = 'block';
			  }
			});
		}

}
function habilitar_modulo(){
	var clickCheckbox1 = document.querySelectorAll('.habilitar_modulo');
	for (var e of clickCheckbox1) {
		e.addEventListener('click', function() {
		  //alert(i.checked);
		  
		  var permisos_div= $(this).parent().parent().parent().parent().parent();
		  
		  var check_habilitar_todo=$(this).parent().parent().parent().siblings();

		  var div_permisos=$(this).parent().parent().parent().siblings("div.permisos");
		  //console.log(check_habilitar_todo);

		  // traigo check habilitar todo
		  var habilita_todo=check_habilitar_todo[0].querySelector('.js-switch1');
		  // traigo los check permisos
		  var elem3 = permisos_div[0].querySelectorAll('.js-switch1');
		  
		  if(this.checked){
		  	permisos_div[0].style.opacity = 1;
		  	check_habilitar_todo[0].style.display='block';
		  	//habilitar check habilitar todo
		  		//setSwitchery(habilita_todo, true);
		  	//habilito todos los permisos
			  	for (var f of elem3) {
					setSwitchery(f, true);
				}

		  }else{
		  	permisos_div[0].style.opacity = 0.6;
		  	check_habilitar_todo[0].style.display='none';
		  	//deshabilito check habilitar todo
		  		//setSwitchery(habilita_todo, false);
		  	//deshabilito todos los permisos
			  	for (var f of elem3) {
					setSwitchery(f, false);
				}
		  }
		  div_permisos[0].style.display='none';
		});
	}
}
function setSwitchery(switchElement, checkedBool) {
        if (checkedBool && !switchElement.checked) { // switch on if not on
            $(switchElement).trigger('click').attr("checked", "checked");
        } else if (!checkedBool && switchElement.checked) { // switch off if not off
            $(switchElement).trigger('click').removeAttr("checked");
        }
    }