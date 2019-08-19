<?php 
	require_once("content/database.php");


	switch (@$model) {
		case 'exportarSocio':

				// $sql = "SELECT * FROM em_socios s INNER JOIN em_club c ON c.idClub = s.club ";
				// require_once("content/models/exportar.mod.php");
			break;
		
		default:
			# code...
				require_once("content/models/numeroSocios.mod.php");
				require("content/views/reportes.tpl.php");
			break;
	}


?>