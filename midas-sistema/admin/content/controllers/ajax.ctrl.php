<?php 
	session_start();
	require_once("../database.php");
	switch ($_POST['action']) {
		case 'BONUS':
			# acumula puntos por juego
			require_once('../models/compras.mod.php');
			break;

		case 'LISTAR_SOCIOS':
			# lista los socios de un club
			require_once('../models/listarSocios.mod.php');
			break;
		
		default:
			# code...
			break;
	}
 ?>