var ruta = 'http://'+window.location.host;
$(function(){

	borrar_proyecto();
	ver_proyecto();

	$("#grupos").select2({width:'100%',placeholder:{id: '0',text:'Grupos'}});

	$("#tabla_proyectos").DataTable({
    	 "language": {
            "url": "js/Spanish.json"
            //"url": "cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        }
    });

    $("#tabla_proyectos2").DataTable({
    	 "language": {
            "url": "js/Spanish.json"
            //"url": "cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        }
    });

    $('[data-toggle="tooltip"]').tooltip();
    
    ver_finalizados();
    
});

function cargar_grilla_proyectos(){
	$("#div_tabla").html(""); 
	var id_user=$("#id_user").val();
	$.ajax({
		url: ruta+"/boxtracker1/BACKEND/apis/proyectos/Proyect_idcreador.php",
		type: 'GET',
		data: {id_creador:id_user},
		dataType: 'JSON',
		success: function(data) {

			if (data.mensaje.length > 0 && data.id_respuesta == "1") {
		        console.log(data.mensaje);
		      	var body="";
			    var titulo="";
			    $.each(data.mensaje, function(i, item) {
			        body+='<tr>';
			        body+='<td>'+item.nombre+'</td>';
			        body+='<td>'+item.descripcion+'</td>';
			        body+='<td>'+item.id_group+'</td>';
			        body+='<td><button type="button" class="btn btn-danger btn-xs">'+item.estado+'</button></td>';
			        body+='<td>'+
        			'<a href="#" data-id="'+item.id+'" class="btn btn-success btn-xs btn-editar"><i class="fa fa-pencil"></i> Editar </a>'+
        			'<a href="#" data-id="'+item.id+'" class="btn btn-danger btn-xs btn-borrar"><i class="fa fa-trash-o"></i> Finalizar </a></td>';
			        body+='</tr>';
			    });
			    var tabla ='<table id="tabla_proyectos" class="table table-striped projects">'+
						    '<thead><tr>'+
						    '<th>Nombre Proyecto</th><th>Descripción</th><th>Grupo</th><th>Estado</th><th>Acciones</th>'+
						    '</tr></thead>'+
						    '<tbody>'+body+'</tbody></table>';
				var tabla2=traer_proyectos_finalizados();
		       	$('#div_tabla').hide().fadeIn().html('<div id="tabla1">'+tabla+'</div>'+'<div id="tabla2" hidden>'+tabla2+'</div>');
		        $("#tabla_proyectos").DataTable({
		        	 "language": {
			            "url": "js/Spanish.json"
			            //"url": "cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
			        }
		        });

		        $("#tabla_proyectos2").DataTable({
		        	 "language": {
			            "url": "js/Spanish.json"
			            //"url": "cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
			        }
		        });
		        borrar_proyecto();
		        ver_proyecto();

		        ver_finalizados();
		    }else{
		        var mensaje="No existen proyectos creados";
		        var rta='<div style="padding:20px; font-size:20px;" class="alert alert-success text-center col-sm-6 col-sm-offset-3"><strong>'+mensaje+'</strong></div>';
		         $('#div_tabla').hide().fadeIn().html(rta);
		    }

		}						                	
	});
}
function traer_proyectos_finalizados(){
	var id_user=$("#id_user").val();
	var rta=null;
	$.ajax({
		url: ruta+"/boxtracker1/BACKEND/apis/proyectos/Proyectos_finalizados.php",
		type: 'GET',
		data: {id_creador:id_user},
		dataType: 'JSON',
		async: false,
		success: function(data) {

			if (data.mensaje.length > 0 && data.id_respuesta == "1") {
		        console.log(data.mensaje);
		      	var body="";
			    var titulo="";
			    $.each(data.mensaje, function(i, item) {
			        body+='<tr>';
			        body+='<td>'+item.nombre+'</td>';
			        body+='<td>'+item.descripcion+'</td>';
			        body+='<td>'+item.id_group+'</td>';
			        body+='<td><button type="button" class="btn btn-danger btn-xs">'+item.estado+'</button></td>';
			        body+='<td>'+
        			'<a href="#" data-id="'+item.id+'" class="btn btn-info btn-xs btn-editar"><i class="fa fa-pencil"></i> Editar </a>';
			        body+='</tr>';
			    });
			    var tabla ='<table id="tabla_proyectos2" class="table table-striped projects">'+
						    '<thead><tr>'+
						    '<th>Nombre Proyecto</th><th>Descripción</th><th>Grupo</th><th>Estado</th><th>Acciones</th>'+
						    '</tr></thead>'+
						    '<tbody>'+body+'</tbody></table>';
				 rta=tabla;
		    }else{
		        var mensaje="No existen proyectos finalizados";
		         rta='<div style="padding:20px; font-size:20px;" class="alert alert-success text-center col-sm-6 col-sm-offset-3"><strong>'+mensaje+'</strong></div>';
		        
		    }

		    

		}						                	
	});

	return rta;
}
function ver_finalizados(){
	var vista=1;
    $("#ver_finalizados").click(function(){
    	if (vista == 1) {
    		$("#ver_finalizados").html('<i class="fa fa-eye-slash"></i>');
    		$("#ver_finalizados").css('color','red');
    		$("#tabla1").hide("slow");
    		$("#tabla2").show("fast");
    		vista=2;
    	}else{
    		$("#ver_finalizados").html('<i class="fa fa-eye"></i>');
    		$("#ver_finalizados").css('color','#5A738E');
    		$("#tabla2").hide("slow");
    		$("#tabla1").show("fast");
    		vista=1;
    	}
    });
}
function ver_proyecto(){
	$(".btn-editar").click(function(){
    	var id_proyecto=$(this).data("id");
    	$.ajax({
			url: "templates/ver_proyecto_edit.php",
			type: 'POST',
			data: {id_proyect:id_proyecto},
			success: function(data) {
				$("#div_form_editar").html(data);
				$("#modal_editar_proyecto").modal("show");
				editar_proyecto();
				$("#select_grupos").select2({width:'100%',placeholder:{id: '0',text:'Grupos'}});
				$("#estado").select2({width:'100%'});
			}
		});
    });
	
}
function editar_proyecto(){
	$("#form_editar_proyecto").submit(function(e){
		e.preventDefault();
		e.stopImmediatePropagation();
		var parametros =$(this).serialize();
		console.log(parametros);
		var form=$(this);
		$.ajax({
			url: ruta+"/boxtracker1/BACKEND/apis/proyectos/modif_proyecto.php",
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
				cargar_grilla_proyectos();
				setTimeout(function(){ $('#rta_editar').html(''); $('#modal_editar_proyecto').modal('hide'); }, 1800);
			}
		});
	});
}

function borrar_proyecto(){
	$(".btn-borrar").click(function(){
		var id_proyecto=$(this).data("id");
		$.confirm({
		    title: 'Finalizar Proyecto',
		    content: 'Deseas finalizar este proyecto?',
		    buttons: {
		        confirmar: function () {
					$.ajax({
						url: ruta+"/boxtracker1/BACKEND/apis/proyectos/baja_proyecto.php",
						type: 'GET',
						data: {id_proyect:id_proyecto},
						dataType: 'JSON',
						success: function(data) {
							console.log(data);
							if (data.id_respuesta == "1") {
								$.alert('Proyecto finalizado correctamente');
								cargar_grilla_proyectos();
							}else{
								$.alert('Fallo finalización de Proyecto');
							}

						}
					});
				},
				cancelar: function () {
		           
		        }
		    }
		});
	});

	$("#alta_proyecto").click(function(){
		$("#modal_alta_proyecto").modal("show");
	});

	$("#form_alta_proyecto").submit(function(e){
		e.preventDefault();
		e.stopImmediatePropagation();
		var parametros = new FormData(this);
		//console.log(parametros);
		var form=$(this);
		$.ajax({
			url: ruta+"/boxtracker1/BACKEND/apis/proyectos/alta_proyecto.php",
			type: 'POST',
			data: parametros,
			dataType: 'JSON',
			contentType: false,
		    processData: false,
			success: function(data) {
				//console.log(data);
				if(data.id_respuesta == "1"){
					var rta='<div class="alert alert-success text-center col-sm-6 col-sm-offset-3">'+data.mensaje+'</div>';
				}else{
					var rta='<div class="alert alert-danger text-center col-sm-6 col-sm-offset-3">'+data.mensaje+'</div>';
				}
				$("#rta_alta").html(rta);
				form[0].reset();
				cargar_grilla_proyectos();
				setTimeout(function(){ $('#rta_alta').html(''); $('#modal_alta_proyecto').modal('hide'); }, 2300);
			}
		});
	});
}