var ruta = 'http://'+window.location.host;

var vm=new Vue({
	el: 'main',
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
		crear_tablero: function(e) {
			//console.log($("#form_alta_tablero").serialize());
			var form=$("#form_alta_tablero");
			var formdata = form.serializeArray();
			var data = new FormData();
			$(formdata ).each(function(index, obj){
			   // data[obj.name] = obj.value;
			   data.append(obj.name,obj.value);
			});
			console.log(data);
			this.$http.post(ruta+"/boxtracker1/BACKEND/apis/tablero/Alta_tablero.php",data)
			.then((respuesta) =>{
				if (respuesta.body.id_respuesta == "1") {
					notif({
	                  msg: respuesta.body.mensaje,
	                  type: "success",
	                  position: "center"
	                });
	                $("#form_alta_tablero")[0].reset();
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
		ver_tablero_editar(id){
			this.$http.get("templates/ver_tablero_edit.php?id_tablero="+id)
			.then((respuesta) =>{
				console.log(respuesta);
				//$("#div_form_edicion").html(respuesta);
				this.form_edicion_html=respuesta.body;
				this.show_form_edicion=true;
				this.show_alta_tableros=false;
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
			
		}
	}
});
