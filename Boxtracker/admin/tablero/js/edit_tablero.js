

var ruta = 'http://'+window.location.host;
var vm3=new Vue({
	el: '#content',
	data: {
		showModal: false,
		tableros: [],
		vista_tableros:false,
		show_alta_tableros: false,
		show_form_edicion:false,
		listahorizontal: true,
		idusuario_creador:0,
		id_proyecto:0,
		form_edicion_html:""
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
