$(function(){
	abrir_modal_editar("");
	$("#tabla_usuarios").DataTable({
		"language":{
			"url":"http://boxtracker.net/boxtracker1/vendors/datatables.net/Spanish-DATATABLE.json"
		}
	});
});
function abrir_modal_editar(tipo){
	$(".editar_user"+tipo).click(function(){
		$("#respuesta_editar").html("");
		var id_user=$(this).data("pkuser");
		$("#div_form_editarU").html(""); 
		$("#modal_editar_usuario").modal("show");
		$.ajax({
			url: "ajax/ajax_usuarios.php",
			type: 'post',
			data: {op:'form_editar_usuario', id_user:id_user},
			success: function(data) {
				$("#div_form_editarU").html(data); 
				var elem = document.querySelectorAll('.js-switch2');
				//var init = new Switchery(document.querySelectorall('.js-switch2'));
				    
				for (var e of elem) {
				  var init = new Switchery(e);
				}
				habilitar_modulo();
				habilitar_todo();

				editar_user();  
			}						                	

		});
	});
}

function editar_user(){
	$("#form_editar_usuario").submit(function(e){
		e.preventDefault();
		e.stopImmediatePropagation();
		var params=$(this).serialize();
		$("#respuesta_editar").html(""); 
		$.ajax({
			url: "ajax/ajax_usuarios.php",
			type: 'post',
			data: params,
			success: function(data) {
				$("#respuesta_editar").html(data); 
				setTimeout(function(){
					$("#modal_editar_usuario").modal("hide");
				},1000);
				cargar_grilla_users();      		
			}						                	
		
		});
});
}
function cargar_grilla_users(){
	$("#div_tabla_usuarios").html(""); 
	var btn='editar';
	$.ajax({
		url: "ajax/ajax_usuarios.php",
		type: 'post',
		data: {op:'listar', tipo:btn},
		success: function(data) {
			$("#div_tabla_usuarios").html(data);    
			 editar_user();
			 abrir_modal_editar("2"); 
			$("#tabla_usuarios2").DataTable({
				"language":{
					"url":"http://boxtracker.net/boxtracker1/vendors/datatables.net/Spanish-DATATABLE.json"
				}
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
			  	
			  	var elem2 = permisos_div.querySelectorAll('.js-switch2');
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
		  var habilita_todo=check_habilitar_todo[0].querySelector('.js-switch2');
		  // traigo los check permisos
		  var elem3 = permisos_div[0].querySelectorAll('.js-switch2');
		  
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