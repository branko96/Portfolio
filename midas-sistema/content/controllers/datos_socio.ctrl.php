<?php
if(!empty($_POST))
{
	$action=$_POST['action'];
	switch ($action) {
		case 'verificar':
		    require_once("../models/datos_socio.mod.php");
		    if(!empty($result))
		    	require_once("../views/result_socio.tpl.php");
			
			break;
		
		default:
			# code...
			break;
	}
	

}
?>