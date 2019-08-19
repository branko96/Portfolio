<?php
if (isset($_GET['a'])){
	$accion=$_GET['a'];
	switch ($accion) {
		case 1:
			include('content/views/alta_club.html');
			break;
		case 2:
			include('content/views/insertado.html');
			include('content/views/alta_club.html');
			break;
		
		default:
			# code...
			break;
	}
}




?>