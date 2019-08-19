new Vue({
	el: 'main',
	data: {
		mensaje: 'holamundo',
		dias:['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'],
		tareas:[
			{ nombre: 'Hacer la compra', prioridad:'baja' },
			{ nombre: 'Aprender Vue y Firebase', prioridad:'alta' },
			{ nombre: 'Ir al Gimnasio', prioridad:'alta' },
		],
		persona:{
			nombre:'Juan',
			profesion: 'Dev',
			ciudad: 'Valencia',
		},
	},
});