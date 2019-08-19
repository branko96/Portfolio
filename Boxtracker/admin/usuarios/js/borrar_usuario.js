$(function(){
	borrar_user("");
	$("#tabla_usuarios").DataTable({
		"language":{
			"url":"http://boxtracker.net/boxtracker1/vendors/datatables.net/Spanish-DATATABLE.json"
		}
	});
	$("#form_asignar_hijos").submit(function(e){
		e.preventDefault();
		var valor=$("#asignar_a").val();
		//console.log(valor);
		var padre_asignado=0;
		if (valor == "1") {
			padre_asignado=$("#id_user").val();
		}else{
			if ($("#hermanos").val() != "0") {
				padre_asignado=$("#hermanos").val();
			}else{
				$.alert('Debe elegir un usuario!');
			}
		}
		if (padre_asignado != "0") {
			var padre_actual=$("#padre_actual").val();
			enganchar_padre(padre_actual,padre_asignado);
		}

	});
	
});

function borrar_user(tipo){
	$(".borrar_user"+tipo).click(function(){
		var id_user=$(this).data("pkuser");
		$.confirm({
		    title: 'Eliminar Usuario',
		    content: 'Deseas borrar este usuario?',
		    buttons: {
		        confirmar: function () {
				    	$.ajax({
							url: "ajax/ajax_usuarios.php",
							type: 'post',
							data: {op:'borrar', id_user: id_user},
							dataType: 'json',
							success: function(data) {
								console.log(data);
								if (data.codigo == 1) {
									//no tiene hijos
									$.alert('Usuario eliminado!');     
									cargar_grilla_users();
								}else{
									//tiene hijos
									var cant_hijos=data.tiene;
									var hijos_nombre="";
									if (cant_hijos>1) {
										hijos_nombre="hijos";
									}else{
										hijos_nombre="hijo";
									}
									$.confirm({
									    title: 'Atención!',
									    content: 'Este usuario posee '+cant_hijos+' '+hijos_nombre+', deseas eliminarlos o asignarlos a otro usuario?',
									    buttons: {
									        eliminar: function () {
									        	eliminar_hijos(id_user);
									        },
									        asignar: function(){
									        	$("#modal_asignar_padre").modal("show");
									        	$("#padre_anterior").val(id_user);
									        	traer_comboshermanos_padre(id_user);
									        },
									        cancelar: function () {
		           
		        							}
		        						}
									});
								}
								    		
							}						                	
						
						});
		        },
		        cancelar: function () {
		           
		        },
		        
		    }
		});
	});
}
function cargar_grilla_users(){
	$("#div_tabla_usuarios").html(""); 
	var btn='borrar';
	$.ajax({
		url: "ajax/ajax_usuarios.php",
		type: 'post',
		data: {op:'listar', tipo:btn},
		success: function(data) {
			$("#div_tabla_usuarios").html(data);  
			 borrar_user("2"); 
			$("#tabla_usuarios2").DataTable({
				"language":{
					"url":"http://boxtracker.net/boxtracker1/vendors/datatables.net/Spanish-DATATABLE.json"
				}
			});

		}						                	
	
	});
}
function traer_comboshermanos_padre(id_user){
	$("#div_combos").html("");
	$.ajax({
		url: "ajax/ajax_usuarios.php",
		type: 'post',
		data: {op:'cbm_hermanos_padre', id_user:id_user},
		success: function(data) {
			$("#div_combos").html(data);  
			$("#hermanos").select2({
				placeholder: {
					id: '0',
					text: 'Hermanos'
				}
			});
			$("#padre").select2();
			radios_dinamicos();
		}						                	
	
	});
	
}
function eliminar_hijos(id_user){
	$.ajax({
		url: "ajax/ajax_usuarios.php",
		type: 'post',
		data: {op:'eliminar_hijos', id_user:id_user},
		success: function(data) {
			console.log(data);
			$.alert('El usuario y sus hijos fueron eliminados!'); 
			cargar_grilla_users();
		}						                	
	
	});
}
function radios_dinamicos(){
	$('input').on('ifChecked', function(event){
		var valor=$(this).val();
		//console.log(valor);
		$("#asignar_a").val(valor);
		if (valor == 1) {
			//console.log("selecciono padre");
			//$("#hermanos_radio").prop("checked",false);
			//$("#hermanos").val("");
			$("#hermanos").parent().parent().css("opacity", 0.5);
			$("#padre").parent().parent().css("opacity", 1);
			$("#hermanos").prop("disabled",true);
			$("#padre").prop("disabled",false);
		}else{
			//console.log("selecciono hermanos");
			//$("#padre_radio").prop("checked",false);
			//$("#padre").val("");
			$("#hermanos").parent().parent().css("opacity", 1);
			$("#padre").parent().parent().css("opacity", 0.5);
			$("#padre").prop("disabled",true);
			$("#hermanos").prop("disabled",false);
		}
	});

	if ($("input.flat")[0]) {
        $(document).ready(function () {
            $('input.flat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });
    }
}
function enganchar_padre(padre_actual,padre_asignado){
	$.ajax({
		url: "ajax/ajax_usuarios.php",
		type: 'post',
		data: {op:'enganchar_padre', id_padre_actual:padre_actual, id_padre_asignado:padre_asignado},
		success: function(data) {
			$.alert('Los hijos del usuario eliminado fueron asignados al nuevo padre'); 
			$("#modal_asignar_padre").modal("hide");
			cargar_grilla_users();
		}						                	
	
	});
}