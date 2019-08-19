var ruta = 'http://'+window.location.host;

Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MM/DD/YYYY')
  }
});

var vm2=new Vue({
	el: '#main_crear',
	data: {
		//vista
		vista_tableros:false,
		show_alta_tableros: false,
		show_form_edicion:false,
		listahorizontal: true,
		showModal: false,
		vista_config_tablero: false,
		finalizados:false,
		form_edicion_html:"",

		//ids
		id_usuario:0,
		idusuario_creador:0,
		id_proyecto:0,
		tablero_creado: 0,
		filtros_cant:0,
		id_color:1,
		color_elegido:'grey',
		tamaño_elegido:'1',

		//arrays - objetos
		tableros: [],
		layout: [],
		finales_herramientas:{id_tablero:0,herramientas:[]},
		plantillas:[],
		herramientas:[],
		tamanios_tableros:[],
		colores_tableros:[],

		//auxiliares
		tamanio_herramienta:null,
		herramientas_ids:[],
		nombre_herramienta:null,
		color2:'white',
		maxRows:14,
		nombre_proyecto:''
	},
	methods:{
		cargar_colores_tamanios(){
			this.$http.get(ruta+"/boxtracker1/BACKEND/apis/tablero/TraerColoryTam.php")
			.then((respuesta) =>{
				console.log(respuesta);
				if (respuesta.body.id_respuesta == "1") {
					this.tamanios_tableros=respuesta.body.mensaje.tamanios;
					this.colores_tableros=respuesta.body.mensaje.colores;
				}else{
					console.log("error al cargar colores y tamaños");
				}
			});
		},
		traer_herramientas(){
			this.$http.get(ruta+"/boxtracker1/BACKEND/apis/tablero/Traer_Herramientas.php")
			.then((respuesta) =>{
				if (respuesta.body.id_respuesta == "1") {
					this.herramientas=respuesta.body.mensaje;
				}else{
					console.log("error al cargar herramientas");
				}
			});

		},
		traer_plantillas(){
			this.$http.get(ruta+"/boxtracker1/BACKEND/apis/tablero/Traer_Plantilla.php?id_user="+this.id_usuario)
			.then((respuesta) =>{
				if (respuesta.body.id_respuesta == "1") {
					this.plantillas=respuesta.body.mensaje;
				}else{
					console.log("error al cargar plantillas");
				}
			});

		},
		guardar_tablero(){
			this.finales_herramientas.herramientas=this.layout;
			this.finales_herramientas.id_tablero=this.tablero_creado;
			this.finales_herramientas.id_color=this.id_color;
			this.finales_herramientas.tamanio=this.tamaño_elegido;
			var datos=this.finales_herramientas;
			this.$http.post(ruta+"/boxtracker1/BACKEND/apis/tablero/Guardar_Config.php",JSON.stringify(datos))
			.then((respuesta) =>{
				console.log(respuesta);
				if (respuesta.body.id_respuesta == "1") {
					notif({
	                  msg: respuesta.body.mensaje,
	                  type: "success",
	                  position: "center"
	                });
	                //oculto configuracion y muestro el alta
	                this.vista_config_tablero=false;
	                this.showModal=false;
	                this.tableros=[];
	                this.show_alta_tableros=false;
	                //las herramientas las vacio
	                this.layout=[];
	                
				}else{
					notif({
	                  msg: respuesta.body.mensaje,
	                  type: "error",
	                  position: "center"
	                });
				}
			});
		},
		aplicar_plantilla(id_plantilla,nombre_plantilla){
			var vm2=this;
			$.confirm({
			    title: 'Quieres aplicar la plantilla '+nombre_plantilla+' ?',
			    buttons:{
			    	Aplicar:function(){
			    		var datos = new FormData();
						datos.append("idplantillas",id_plantilla);
						vm2.$http.post(ruta+"/boxtracker1/BACKEND/apis/tablero/Ver_Template.php",datos)
						.then((respuesta) =>{
							
							var rta=respuesta.body.mensaje;
							if (respuesta.body.id_respuesta == "1") {
								vm2.ingresar_plantilla(respuesta.body.mensaje);
								//var plantilla_herramientas=respuesta.body.mensaje;

								
							}else{
								notif({
				                  msg: respuesta.body.mensaje,
				                  type: "error",
				                  position: "center"
				                });
							}
						});
						


			    	},
			    	cancelar: function (){

			    	}
			    }
			});
			
		},
		cargar_herramienta_plantilla(x,y,id_herramienta,i){
			var datos = new FormData();
		 	datos.append("idherramientas_tablero",id_herramienta);
			vm2.$http.post(ruta+"/boxtracker1/BACKEND/apis/tablero/Ver_Herramienta.php",datos)
			.then((respuesta) =>{
				//console.log(respuesta);
				
				//console.log(x,y,id_herramienta);
				if (respuesta.body.id_respuesta == "1") {
					//var nombre_herramienta=respuesta.body.mensaje.nombre;
					var tamanio_red1=respuesta.body.mensaje.tamanio_red;
				 	//console.log(tamanio_red1,x,y,nombre_herramienta,id_herramienta);
					var elem1=cargar_tamaño_herramienta(tamanio_red1,x,y,i,id_herramienta);
					//console.log(elem1);
					vm2.layout.push(elem1);

				}
			});
		},
		ingresar_plantilla(plantilla_herramientas){
			if (plantilla_herramientas.length>0) {
				vm2.layout=[];
				for (i in plantilla_herramientas) {
					var y=parseInt(plantilla_herramientas[i].coor_y);
					var x=parseInt(plantilla_herramientas[i].coor_x);
					var id_herramienta=plantilla_herramientas[i].id_herramienta;
					var nombre_herramienta=plantilla_herramientas[i].nombre_herramienta;
					vm2.cargar_herramienta_plantilla(x,y,id_herramienta,nombre_herramienta);
				}

				notif({
                  msg: 'Plantilla Aplicada correctamente',
                  type: "success",
                  position: "center"
                });
			}else{
				notif({
                  msg: 'La plantilla no posee herramientas guardadas',
                  type: "error",
                  position: "center"
                });
			}
		},
		guardar_plantilla(){
			var vm1=this;
			$.confirm({
			    title: 'Atención!',
			    content: '' +
			    '<form action="" class="formName">' +
			    '<div class="form-group">' +
			    '<label>Ingrese un Nombre para la Plantilla</label>' +
			    '<input type="text" placeholder="Nombre Plantilla" class="name form-control" required />' +
			    '</div>' +
			    '</form>',
			    buttons: {
			        formSubmit: {
			            text: 'Guardar',
			            btnClass: 'btn-blue',
			            action: function () {
			                var name = this.$content.find('.name').val();
			                if(!name){
			                    $.alert('Ingrese un nombre válido');
			                    return false;
			                }else{
				                var datos={nombre:name,id_user:vm1.id_usuario,idproyecto:vm1.id_proyecto, herramientas:vm1.layout};
				                vm1.$http.post(ruta+"/boxtracker1/BACKEND/apis/tablero/Guardar_Config_Plantilla.php",JSON.stringify(datos))
								.then((respuesta) =>{
									//console.log(respuesta);
									if (respuesta.body.id_respuesta == "1") {
										notif({
						                  msg: respuesta.body.mensaje,
						                  type: "success",
						                  position: "center"
						                });
						                vm1.traer_plantillas();
									}else{
										notif({
						                  msg: respuesta.body.mensaje,
						                  type: "error",
						                  position: "center"
						                });
									}
								});
							}
			            }
			        },
			        cancelar: function () {
			            //close
			        },
			    },
			    onContentReady: function () {
			        // bind to events
			        var jc = this;
			        this.$content.find('form').on('submit', function (e) {
			            // if the user submits the form by pressing enter in the field.
			            e.preventDefault();
			            jc.$$formSubmit.trigger('click'); // reference the button and click it
			        });
			    }
			});
		},
		handleDrop(event,id_herramienta) {
			//console.log(event);
		  //ev.preventDefault();
		  var y=Math.round(event.y/100);
		  var x=Math.round(event.x/100);
		  if (x<0) { x=0;}
		  if (y<0) { y=0;}
		  //var data = ev.dataTransfer.getData("text");
		 // var elem={"x":x,"y":y,"w":2,"h":2,"i":"19"};
			var datos = new FormData();
		 	datos.append("idherramientas_tablero",id_herramienta);
		 	this.$http.post(ruta+"/boxtracker1/BACKEND/apis/tablero/Ver_Herramienta.php",datos)
			.then((respuesta) =>{
				console.log(respuesta);
				var nombre=respuesta.body.mensaje.nombre;

				var existe=this.layout.filter(item => item.i == nombre);
				if (respuesta.body.mensaje.idherramientas_tablero != 2) {
					// NO es filtro
					
					if(existe.length == 0){
						var elem=cargar_tamaño_herramienta(respuesta.body.mensaje.tamanio_red,x,y,nombre,id_herramienta);
						this.layout.push(elem);
						this.herramientas_ids.push(id_herramienta);
					}else{
						notif({
		                  msg: "Ya existe la herramienta "+nombre+ " dentro del tablero",
		                  type: "error",
		                  position: "center"
		                });
					}
				}else{
					//  es filtro
					var nombre_nuevo="";
	                if (existe.length >0) {
	                	this.filtros_cant=this.filtros_cant+1;
						nombre_nuevo=nombre+" "+this.filtros_cant;
					}else{
						nombre_nuevo=nombre;
					}
						var elem=cargar_tamaño_herramienta(respuesta.body.mensaje.tamanio_red,x,y,nombre_nuevo,id_herramienta);
						this.layout.push(elem);
						this.herramientas_ids.push(id_herramienta);

				}
			});
		},
		eliminar_herramienta(val) {
			//console.log(val.id);
			//this.herramientas_ids = this.herramientas_ids.filter(function (item) { console.log(item);return (item !== val.id);});
	        this.layout = this.layout.filter(item => item.i !== val.i);
	    },
		nueva_herramienta(id_herramienta){
		 	var datos = new FormData();
		 	datos.append("idherramientas_tablero",id_herramienta);
		 	this.$http.post(ruta+"/boxtracker1/BACKEND/apis/tablero/Ver_Herramienta.php",datos)
			.then((respuesta) =>{
				console.log(respuesta);
				var nombre=respuesta.body.mensaje.nombre;

				var existe=this.layout.filter(item => item.i == nombre);
				if (respuesta.body.mensaje.idherramientas_tablero != 2) {
					// NO es filtro
					
					if(existe.length == 0){
						var elem=cargar_tamaño_herramienta(respuesta.body.mensaje.tamanio_red,0,0,nombre,id_herramienta);
						this.layout.push(elem);
						this.herramientas_ids.push(id_herramienta);
					}else{
						notif({
		                  msg: "Ya existe la herramienta "+nombre+ " dentro del tablero",
		                  type: "error",
		                  position: "center"
		                });
					}
				}else{
					//  es filtro
					var nombre_nuevo="";
	                if (existe.length >0) {
	                	this.filtros_cant=this.filtros_cant+1;
						nombre_nuevo=nombre+" "+this.filtros_cant;
					}else{
						nombre_nuevo=nombre;
					}
						var elem=cargar_tamaño_herramienta(respuesta.body.mensaje.tamanio_red,0,0,nombre_nuevo,id_herramienta);
						this.layout.push(elem);
						this.herramientas_ids.push(id_herramienta);


				}
			});
		},
		foco_nombre: function(e){
			$("#nombre_tablero").focus();
		},
		cambiar_color:function(e){
			if (this.finalizados) {
				$(".ver_finalizados").html('<i class="fa fa-eye-slash"></i>');
          		$(".ver_finalizados").css('color','red');
			}else{
				$(".ver_finalizados").html('<i class="fa fa-eye"></i>');
          		$(".ver_finalizados").css('color','#5A738E');
			}
			
		},
		crear_tablero: function(e) {
			//console.log($("#form_alta_tablero").serialize());
			var form=$("#form_alta_tablero");
			var formdata = form.serializeArray();
			var data = new FormData();
			$(formdata ).each(function(index, obj){
			   // data[obj.name] = obj.value;
			   data.append(obj.name,obj.value);
			});
			
			this.$http.post(ruta+"/boxtracker1/BACKEND/apis/tablero/Alta_tablero.php",data)
			.then((respuesta) =>{

				if (respuesta.body.id_respuesta != -1) {
					this.tablero_creado=respuesta.body.id_respuesta;
					notif({
	                  msg: respuesta.body.mensaje,
	                  type: "success",
	                  position: "center"
	                });
	                this.vista_config_tablero=true;
	               
	                $("#form_alta_tablero")[0].reset();
	                
   					

				}else{
					notif({
	                  msg: respuesta.body.mensaje,
	                  type: "error",
	                  position: "center"
	                });

				}
				//this.cargarProyecto(this.id_proyecto);
			}, (error) => {
			   // console.log(error);
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
				//console.log(respuesta);
				//$("#div_form_edicion").html(respuesta);
				this.form_edicion_html=respuesta.body;
				this.show_form_edicion=true;
				this.show_alta_tableros=false;
			});
		},
		cargarProyecto(id,$event){
			//console.log(id);
			// this.vista_tableros=true;
			// this.showModal=false;
			// this.listahorizontal=true;
			//console.log($event.target);
			efecto_proyecto_elegido($event.target);
			this.show_alta_tableros=true;
			this.showModal=true;
			this.id_proyecto=id;
			this.nombre_proyecto=$($event.target).text();
			// this.$http.get(ruta+"/boxtracker1/BACKEND/apis/tablero/Traer_tablero_proyectos.php?id_proyecto="+id)
			// .then((respuesta) =>{
			// 	//console.log(respuesta);
			// 	if (respuesta.body.id_respuesta != "-1") {
			// 		this.tableros=respuesta.body.mensaje;
			// 	}else{
			// 		this.tableros=[];
			// 	}
			// 	this.showModal = true;
			// 	//setTimeout(function () {  }.bind(this), 100);
			// });
			
		},
		arbol2($event){
			//console.log($event);
			var elem=$event.target;
			elem.parentElement.querySelector(".nested").classList.toggle("active");
	    	elem.classList.toggle("caret-down");
		},
		drop_colores($event,color){
			//console.log(color);
			this.color_elegido=color.color1;
			this.id_color=color.idcolores_tablero;
			this.color2=color.color4;
			var icono=$($event.target).find("div.color_tablero").clone();
			var icon=icono[0];
			//console.log(icono);
			$("#btn_drop_colores").html(icon);
		},
		drop_tamaños($event,tamanio){
			this.tamaño_elegido=tamanio.idtamanios_tableros;
			var icono=$($event.target).find("div").clone();
			var icon=icono[0];
			//console.log(icono);
			$("#btn_drop_tamaños").html(icono);
		}
	},
	mounted(){
		this.id_usuario=$("#idusuario").val();
		this.traer_plantillas();
		this.traer_herramientas();
		this.cargar_colores_tamanios();
		
	}
});

function efecto_proyecto_elegido(elegido){
	var proyectos=$(".proyectos");
	$.each(proyectos,function(item,index){
		if ($(this).hasClass("elegido")) {
			$(this).removeClass("elegido");
		}
	});
	$(elegido).addClass("elegido");
}
function arboless(){
	$('#tree1').treed({openedClass : 'glyphicon-folder-open', closedClass : 'glyphicon-folder-close'});
	$('#tree2').treed({openedClass : 'glyphicon-folder-open', closedClass : 'glyphicon-folder-close'});
}
function arboles(){
	// console.log("si");
	// $('#tree1').treed({openedClass : 'glyphicon-folder-open', closedClass : 'glyphicon-folder-close'});
	// $('#tree2').treed({openedClass : 'glyphicon-folder-open', closedClass : 'glyphicon-folder-close'});
	var toggler = document.getElementsByClassName("caret");
	var i;

	for (i = 0; i < toggler.length; i++) {
	  toggler[i].addEventListener("click", function() {
	    this.parentElement.querySelector(".nested").classList.toggle("active");
	    this.classList.toggle("caret-down");
	  });
	}
}
function cargar_tamaño_herramienta(tamanio,x,y,nombre_nuevo,id_herramienta){
	var elem={};
	if (tamanio == 1) {
	 elem={"x":x,"y":y,"w":2,"h":2,"i":nombre_nuevo,"id":id_herramienta};
	}
	if (tamanio == 2) {
		 elem={"x":x,"y":y,"w":4,"h":2,"i":nombre_nuevo,"id":id_herramienta};
	}
	if (tamanio == 3) {
		 elem={"x":x,"y":y,"w":4,"h":5,"i":nombre_nuevo,"id":id_herramienta};
	}
	if (tamanio == 4) {
		 elem={"x":x,"y":y,"w":5,"h":2,"i":nombre_nuevo,"id":id_herramienta};
	}
	return elem;
}
function eliminar_herramienta2(){
	$('.brick .delete').click(function(e){
   		e.preventDefault();
   		e.stopPropagation();
   		$this = $(this);
      	$this.closest('.brick').remove();
      	return $('.gridly').gridly('layout');
   	});
}

function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  //ev.dataTransfer.setData("text", ev.target.id);
  var dragIcon = document.createElement('div');
  dragIcon.setAttribute("class", "brick small");
  dragIcon.setAttribute("id","div2");
  console.log(dragIcon);
  dragIcon.textNode = "Dragging";
  dragIcon.style.position = "absolute";
  dragIcon.style.top = "-1000px";
  document.body.appendChild(dragIcon);
 // dragIcon.append='<a class="delete" href="#">&times;</a>';
  ev.dataTransfer.setDragImage(dragIcon,50,50);
}





            
