$(function(){

	

$("#btn_users_app").click(function(){

	$("#apps").hide().fadeIn().html("<center><img src='../img/loading.gif' id='cargando'></center>");

	setTimeout(function() {

        window.location="usuarios/index.php";

     },1750);

});

$("#btn_proyect_app").click(function(){

	$("#apps").hide().fadeIn().html("<center><img src='../img/loading.gif' id='cargando'></center>");

	setTimeout(function() {

        window.location="proyectos/index.php";

    },1750);

});


$("#btn_tablero_app").click(function(){

	$("#apps").hide().fadeIn().html("<center><img src='../img/loading.gif' id='cargando'></center>");

	setTimeout(function() {

        window.location="tablero/index.php";

    },1750);

});



});