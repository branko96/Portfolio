var vm=new Vue({
	el: 'main',
	data: {
		nuevaTarea: null,
		tareas:[
			'Hacer la compra', 
			'Aprender Vue y Firebase',
			'Ir al Gimnasio',
		],
	},
	methods:{
		agregarTarea() {
			// THIS HACE REFERENCIA A LA INSTANCIA VUE
			this.tareas.push(this.nuevaTarea);
			this.nuevaTarea=null;
		}
	}
});

// $(function(){
// 	$("#form_nueva_tarea").submit(function(e){
// 		e.preventDefault();
// 		var tarea=$("#input_tarea").val();
// 		vm.tareas.push(tarea);
// 		$("#input_tarea").val("")
// 	});
// });