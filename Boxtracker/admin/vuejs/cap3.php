<!DOCTYPE html>

<html>

<head>

	<title>Vue.js</title>





</head>

<body>

	<main>

		<h1 v-if="conectado">Estoy conectado</h1>

		<h2 v-if="edad < 18">No puedes entrar</h2>

		<h3 v-else-if="edad > 200"> Eres inmortal</h3>

		<h3 v-else> puedes entrar</h3>



		<template v-if="conectado">

			<h1>Bienvenido Juan</h1>

			<ul>

				<li><a href="#">Mis cursos</a></li>

				<li><a href="#">Mensajes</a></li>

				<li><a href="#">Salir</a></li>

			</ul>

		</template>



		<pre>{{$data}}</pre>

	</main>

	<script type="text/javascript" src="js/vue.js"></script>

	<script type="text/javascript" src="js/main2.js"></script>

</body>

</html>




<?php







?>