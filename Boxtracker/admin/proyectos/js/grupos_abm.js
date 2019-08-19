var ruta = 'http://'+window.location.host;
$(function(){

	borrar_grupo();
	ver_grupo();
	ver_miembros_grupo();
	ver_proyectos_grupo();
	$("#tabla_grupos").DataTable({
    	 "language": {
            "url": "js/Spanish.json"
        },
        "columnDefs": [
		    { className: "text-center", "targets": [ 0 , 1] }
		  ]
    });

	$("#miembros").select2({
		multiple: true,
		 width: '100%',
		minimumResultsForSearch: -1,
	    placeholder: function(){
	        $(this).data('placeholder');
	    }
	});
	$("#seleccionar_todos").click(function(){
		//console.log($(this).is(':checked'));
	    if($(this).is(':checked') ){
	        $("#miembros > option").prop("selected",true).trigger('change');
	    }else{
	        $("#miembros > option").removeAttr("selected").trigger('change');
	    }
	});
});

function cargar_grilla_grupos(){
	$("#div_tabla").html(""); 
	var id_user=$("#id_user").val();
	$.ajax({
		url: ruta+"/boxtracker1/BACKEND/apis/proyectos/traer_gruposUser.php",
		type: 'GET',
		data: {id_usuario:id_user},
		dataType: 'JSON',
		success: function(data) {

			if (data.mensaje.length > 0 && data.id_respuesta == "1") {
		        //console.log(data.mensaje);
		      	var body="";
			    var titulo="";
			    $.each(data.mensaje, function(i, item) {
			        body+='<tr>';
			        body+='<td>'+item.nombre+'</td>';
			        body+='<td>'+
			        '<a href="#" data-id="'+item.id+'" data-nombre="'+item.nombre+'" class="btn btn-success btn-xs btn-vermiembros"><i class="fa fa-user"></i> Ver Miembros </a>'+
        			'<a href="#" data-id="'+item.id+'" data-nombre="'+item.nombre+'" class="btn btn-success btn-xs btn-verproyectos"><i class="fa fa-building-o"></i> Ver Proyectos </a>'+
        			'<a href="#" data-id="'+item.id+'" class="btn btn-success btn-xs btn-editar"><i class="fa fa-pencil"></i> Editar </a>'+
        			'<a href="#" data-id="'+item.id+'" class="btn btn-danger btn-xs btn-borrar"><i class="fa fa-trash-o"></i> Eliminar </a></td>';
			        body+='</tr>';
			    });
			    var tabla ='<table id="tabla_grupos" class="table table-striped projects">'+
						    '<thead><tr>'+
						    '<th>Nombre Grupo</th><th>Acciones</th>'+
						    '</tr></thead>'+
						    '<tbody>'+body+'</tbody></table>';
		       	$('#div_tabla').hide().fadeIn().html(tabla);
		        $("#tabla_grupos").DataTable({
		        	 "language": {
			            "url": "js/Spanish.json"
			            //"url": "cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
			        },
			        "columnDefs": [
					    { className: "text-center", "targets": [ 0 , 1] }
					  ]
		        });
		        borrar_grupo();
		        ver_grupo();
		        ver_miembros_grupo();
		        ver_proyectos_grupo();
		    }else{
		        var mensaje="No existen grupos creados";
		        var rta='<div style="padding:20px; font-size:20px;" class="alert alert-success text-center col-sm-6 col-sm-offset-3"><strong>'+mensaje+'</strong></div>';
		         $('#div_tabla').hide().fadeIn().html(rta);
		    }

		}						                	
	});
}

function ver_grupo(){
	$(".btn-editar").click(function(){
    	var id_grupo=$(this).data("id");
    	$.ajax({
			url: "templates/ver_grupo_edit.php",
			type: 'POST',
			data: {id_grupo:id_grupo},
			success: function(data) {
				$("#div_form_editar").html(data);
				$("#modal_editar_grupo").modal("show");
				editar_grupo();
				$("#select_miembros").select2({
					multiple: true,
					 width: '100%',
					minimumResultsForSearch: -1,
				    placeholder: function(){
				        $(this).data('placeholder');
				    }
				});

				$("#seleccionar_todos2").click(function(){
					//console.log($(this).is(':checked'));
				    if($(this).is(':checked') ){
				        $("#select_miembros > option").prop("selected",true).trigger('change');
				    }else{
				        $("#select_miembros > option").removeAttr("selected").trigger('change');
				    }
				});
			}
		});
    });
}

function editar_grupo(){
	$("#form_editar_grupo").submit(function(e){
		e.preventDefault();
		e.stopImmediatePropagation();
		var parametros =$(this).serialize();
		//console.log(parametros);
		var form=$(this);
		$.ajax({
			url: ruta+"/boxtracker1/BACKEND/apis/proyectos/edit_grupo.php",
			type: 'POST',
			data: parametros,
			dataType: 'JSON',
			success: function(data) {
				if(data.id_respuesta == "1"){
					var rta='<div class="alert alert-success text-center col-sm-6 col-sm-offset-3">'+data.mensaje+'</div>';
				}else{
					var rta='<div class="alert alert-danger text-center col-sm-6 col-sm-offset-3">'+data.mensaje+'</div>';
				}
				$("#rta_editar").html(rta);
				form[0].reset();
				cargar_grilla_grupos();
				setTimeout(function(){ $('#rta_editar').html(''); $('#modal_editar_grupo').modal('hide'); }, 1800);
			}
		});
	});
}
function borrar_grupo(){
	$(".btn-borrar").click(function(){
		var id_grupo=$(this).data("id");
		//console.log(verificar_proyectos(id_grupo));
		if (!verificar_proyectos(id_grupo)) {
			$.confirm({
			    title: 'Eliminar Grupo',
			    content: 'Deseas borrar este Grupo?',
			    buttons: {
		        confirmar: function () {
					$.ajax({
						url: ruta+"/boxtracker1/BACKEND/apis/proyectos/baja_grupo.php",
						type: 'GET',
						data: {idproyectos_grupos:id_grupo},
						dataType: 'JSON',
						success: function(data) {
							//console.log(data);
							if (data.id_respuesta == "1") {
								$.alert('Grupo Eliminado correctamente');
								cargar_grilla_grupos();
							}else{
								$.alert('Fallo eliminación de Grupo');
							}

						}
					});
				},
				cancelar: function () {
		           
		        }
		    }
			});
		}else{
			$.confirm({
			    title: 'Asignar Grupo',
			    content: 'El grupo que deseas borrar posee proyectos, debes asignarlos a otro grupo.',
			    buttons: {
		        asignar: function () {
					var id_user=$("#id_user").val();
					$.ajax({
						url: ruta+"/boxtracker1/BACKEND/apis/proyectos/traer_gruposUserAsign.php",
						type: 'GET',
						data: {id_usuario:id_user,fk_grupo:id_grupo},
						dataType: 'JSON',
						success: function(data) {
							if (data.id_respuesta == "1") {
								$("#modal_asignar_grupo").modal("show");
								if (data.mensaje.length > 0) {
									var select_grupos= '<div class="col-sm-8 col-sm-offset-2 form-group"><select id="select_grupos"><option value="0">Grupo</option>';
									$.each(data.mensaje, function(i, item) {
										select_grupos+='<option value="'+item.id+'">'+item.nombre+'</option>';
									});
									select_grupos+='</select>';

								}else{
									var select_grupos= '<select id="select_grupos"><option value="0">Grupos</option></select></div>';
								}
								$("#div_grupos").html(select_grupos);
								$("#select_grupos").select2({
									multiple: false,
									 width: '100%',
								    placeholder:{
								        id: '0',
								        text: 'Grupo'
								    }
								});
								asignar_grupo(id_grupo);
							}else{
								$.alert('Fallo la asignación del Grupo');
							}

						}
					});
				},
				cancelar: function () {
		           
		        }
		    }
			});
		}
	});

	$("#alta_grupo").click(function(){
		$("#modal_alta_grupo").modal("show");
	});

	$("#form_alta_grupo").submit(function(e){
		e.preventDefault();
		e.stopImmediatePropagation();
		var parametros =$(this).serialize();
		//console.log(parametros);
		var form=$(this);
		$.ajax({
			url: ruta+"/boxtracker1/BACKEND/apis/proyectos/alta_grupo.php",
			type: 'POST',
			data: parametros,
			dataType: 'JSON',
			success: function(data) {
				//console.log(data);
				if(data.id_respuesta == "1"){
					var rta='<div class="alert alert-success text-center col-sm-6 col-sm-offset-3">'+data.mensaje+'</div>';
				}else{
					var rta='<div class="alert alert-danger text-center col-sm-6 col-sm-offset-3">'+data.mensaje+'</div>';
				}
				$("#rta_alta").html(rta);
				form[0].reset();
				cargar_grilla_grupos();
				setTimeout(function(){ $('#rta_alta').html(''); $('#modal_alta_grupo').modal('hide');$('#miembros').val('').trigger('change'); }, 2300);
			}
		});
	});
}
function ver_miembros_grupo(){
	$(".btn-vermiembros").click(function(){
		var id_grupo=$(this).data("id");
		var nombre_grupo=$(this).data("nombre");
		$("#modal_ver_miembros").modal("show");
    	$.ajax({
			url: ruta+"/boxtracker1/BACKEND/apis/proyectos/Vermiembros_grupo.php",
			type: 'POST',
			data: {id_grupo:id_grupo},
			dataType: 'json',
			success: function(data) {
				if (data.id_respuesta == "1" && data.mensaje.length > 0) {
					var miembros='<div class="col-sm-8 col-sm-offset-2"><ul class="list-group text-center">';
					$.each(data.mensaje, function(i, item) {
						if (i == 0) {
							miembros+='<li class="list-group-item active">'+item.mensaje+'</li>';
						}else{
							miembros+='<li class="list-group-item">'+item.mensaje+'</li>';
						}
					});
					miembros+="</ul></div>";
					$("#nombre_grupo_miembros").html("Miembros del grupo: "+nombre_grupo);
					$("#div_miembros_grupo").html(miembros);
				}else{
					var rta='<div class="alert alert-success text-center col-sm-6 col-sm-offset-3">'+data.mensaje+'</div>';
					$("#div_miembros_grupo").html(rta);
				}
				
			}
		});

	});
}
function ver_proyectos_grupo(){
	$(".btn-verproyectos").click(function(){
		var id_grupo=$(this).data("id");
		var nombre_grupo=$(this).data("nombre");
		$("#modal_ver_proyectos").modal("show");
    	$.ajax({
			url: ruta+"/boxtracker1/BACKEND/apis/proyectos/Proyect_group.php",
			type: 'GET',
			data: {id_group:id_grupo},
			dataType: 'json',
			success: function(data) {
				if (data.id_respuesta == "1" && data.mensaje.length > 0) {
					var proyectos='<div class="col-sm-8 col-sm-offset-2"><ul class="list-group text-center">';
					$.each(data.mensaje, function(i, item) {
						if (item.estado == "5") {
							proyectos+='<li class="list-group-item list-group-item-danger">'+item.nombre+'</li>';
						}else{
							proyectos+='<li class="list-group-item list-group-item-success">'+item.nombre+'</li>';
						}
					});
					proyectos+="</ul></div>";
					$("#nombre_grupo_proyectos").html("Proyectos del grupo: "+nombre_grupo);
					$("#div_proyectos_grupo").html(proyectos);
				}else{
					var rta='<div class="alert alert-success text-center col-sm-6 col-sm-offset-3">'+data.mensaje+'</div>';
					$("#div_proyectos_grupo").html(rta);
				}
				
			}
		});

	});
}
function verificar_proyectos(id_grupo){
	var rta=null;
	$.ajax({
		url: ruta+"/boxtracker1/BACKEND/apis/proyectos/Proyect_group.php",
		type: 'GET',
		data: {id_group:id_grupo},
		dataType: 'JSON',
		success: function(data) {
			//console.log(data);
			if (data.id_respuesta == "1") {
				rta = true;
			}else{
				rta = false;
			}
			
		},
		async: false
	});
	return rta;
}
function asignar_grupo(id_grupoViejo){
	$("#btn_asignar_grupo").click(function(){
		var id_grupoNuevo=$("#select_grupos").val();
		if (id_grupoNuevo != 0) {
			$.ajax({
				url: ruta+"/boxtracker1/BACKEND/apis/proyectos/AsignarProyecto_grupo.php",
				type: 'POST',
				data: {id_grupoViejo:id_grupoViejo,id_grupoNuevo:id_grupoNuevo},
				dataType: 'JSON',
				success: function(data) {
					//console.log(data);
					if (data.id_respuesta == "1") {
						var rta='<div class="alert alert-success text-center col-sm-6 col-sm-offset-3">'+data.mensaje+'</div>';
					}else{
						var rta='<div class="alert alert-danger text-center col-sm-6 col-sm-offset-3">'+data.mensaje+'</div>';
					}
					$("#rta_asign").html(rta);

					setTimeout(function(){ $('#rta_asign').html(''); $('#modal_asignar_grupo').modal('hide'); }, 1800);
				}
			});
		}else{
			$.alert('Seleccione un grupo');
		}
	});
}