
var ruta = 'http://'+window.location.host;
var vm2=new Vue({
	el: '#main_editar',
	data: {
		showModal: false,
		tableros: [],
		vista_tableros:false,
		show_alta_tableros: false,
		show_form_edicion:false,
		listahorizontal: true,
		idusuario_creador:0,
		id_proyecto:0,
		finalizados:false,
		form_edicion_tablero:{
			nombre_tablero:"",
			id:0,
			estado:""
		}
	},
	methods:{
		cambiar_color:function(e){
			if (this.finalizados) {
				$(".ver_finalizados").html('<i class="fa fa-eye-slash"></i>');
          		$(".ver_finalizados").css('color','red');
			}else{
				$(".ver_finalizados").html('<i class="fa fa-eye"></i>');
          		$(".ver_finalizados").css('color','#5A738E');
			}
			
		},
		ver_tablero_editar(id){
			this.show_form_edicion=false;
			this.$http.get("/boxtracker1/BACKEND/apis/tablero/VerTablero.php?id_tablero="+id)
			.then((respuesta) =>{
				console.log(respuesta);
				//$("#div_form_edicion").html(respuesta);
				this.form_edicion_tablero=respuesta.body.mensaje;
				var self = this;
				setTimeout(function () { self.show_form_edicion=true; } , 300);
			});
		},
		cargarTableros(id){
			//console.log(id);
			this.listahorizontal=true;
			this.id_proyecto=id;
			this.$http.get(ruta+"/boxtracker1/BACKEND/apis/tablero/Traer_tablero_proyectos.php?id_proyecto="+id)
			.then((respuesta) =>{
				console.log(respuesta);
				if (respuesta.body.id_respuesta == "1") {
					this.tableros=respuesta.body.mensaje;
				}else{
					this.tableros=[];
				}
				this.showModal = true;
				//setTimeout(function () {  }.bind(this), 100);
			});
			
		},
		editar_tablero: function(e) {
			//console.log($("#form_alta_tablero").serialize());
			var form=$("#form_edicion_tablero");
			var formdata = form.serializeArray();
			var data = new FormData();
			$(formdata ).each(function(index, obj){
			   // data[obj.name] = obj.value;
			   data.append(obj.name,obj.value);
			});
			console.log(data);
			this.$http.post(ruta+"/boxtracker1/BACKEND/apis/tablero/Editar_tablero.php",data)
			.then((respuesta) =>{
				if (respuesta.body.id_respuesta == "1") {
					notif({
	                  msg: respuesta.body.mensaje,
	                  type: "success",
	                  position: "center"
	                });
	                $("#form_edicion_tablero")[0].reset();
				}else{
					notif({
	                  msg: respuesta.body.mensaje,
	                  type: "error",
	                  position: "center"
	                });

				}
				
				// if (respuesta.body.id_respuesta == "1") {
				// 	this.tableros=respuesta.body.mensaje;
				// }else{
				// 	this.tableros=[];
				// }
				this.cargarTableros(this.id_proyecto);
			}, (error) => {
			    console.log(error);
			    notif({
                  msg:error,
                  type: "error",
                  position: "center"
                });
			  });
		},
	}
});


function abrir_modal_config(){
	$("#modal_config").modal("show");

	$("#tabs").hide();
  //  $("#tabs").tabs();
    $("#widget1, #widget2, #widget3").draggable({
        snap: ".gridcell",
        snapTolerance: 25,
        revert: "invalid",
        helper: "clone",
        drag: function (event, ui) {
            $("#tabs").hide();
        }
    });
    $("#grid").droppable({
        accept: (".widget1, .widget2, .widget3"),
        drop: function(event, ui) {
            if (!$(ui.draggable).hasClass('item')) {
                $(ui.draggable).data('cloned', true); // not yet used
                $(this).append($(ui.helper).clone());
                $(this).children('.ui-draggable').addClass("item");
                $(".item").removeClass("ui-draggable");
                $(".item").draggable({
                    drag: function (event, ui) {
                        $("#tabs").hide();
                    },
                    snap: ".gridcell",
                    snapTolerance: 25,
                    revert: function (event, ui) {
                        if(!event) {
                            $("#tabs").hide();
                            $("#tabs").prependTo("body");
                            $(this).fadeOut("normal",function() { $(this).remove(); });
                            $("#tabs").hide();
                            return !event;
                        }
                    },
                });
                $(".item").removeClass("ui-draggable-dragging");
                
                // START DEV
                // stacking fix attempt
                if($(ui.droppable).find('.ui-draggable')) {
                    console.log('prevent stacking test');
                };
                // END DEV
            };
            //$("#grid .item").hoverStuff();
        },
    });
    // $.fn.hoverStuff = function() {
    //     $("#grid .item").hover (
    //         function() {
    //                 hoveredItem=$(this);
    //                 $("#tabs").appendTo(this);
    //                 $("#tabs").css('left', '50px');
    //                 if ($(this).hasClass('widget1')) {
    //                     $("#tabs-1").html('widget1');
    //                 } else if($(this).hasClass('widget2')) {
    //                     $("#tabs-1").html('widget2');
    //                     $("#tabs").css('left', '100px');
    //                 } else if($(this).hasClass('widget3')) {
    //                     $("#tabs-1").html('widget3');
    //                 } else {
    //                     $("#tabs-1").html('default... if you see this, something has gone wrong');
    //                 }
    //                 $("#tabs").show();
    //                 $("#buttonColour").on("click", function(event) {
    //                     hoveredItem.css('background', 'red');
    //                 });
    //         },
    //         function() {
    //                 $("#tabs").hide();
    //                 $('#tabs').prependTo('body');
    //         }
    //     );
    // }
}

