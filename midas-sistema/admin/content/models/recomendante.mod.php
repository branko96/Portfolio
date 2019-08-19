<?php 
	/* LUEGO de recomendante.mod.php vuelvo a llamar a compras.mod pero modifico los valores de $_POST 
	   para que funcione con los del recomendante
	   $recomendante = es el id del recomendante que se obtiene en la primera ejecución de compras.mod.php en index.ctrl.php linea 119
	*/ 
	

	
	$inputMinimo=$_POST['inputMinimo'];

	$puntos= round($importe * $puntosXinput / $inputMinimo);
	
	$_POST['puntos']=$puntos; //Reemplazo el valor de los puntos de la primera llamada por los puntos nuevos del recomendante
	$_POST['idSocio']=$idRecomendante; //el id del socio anterior lo reemplazo por el id del recomendante si existe
	$_POST['tipo']=5; // tipo de movimiento es herencia

	// echo"recomendante.mod.php"."<br>";//borrar;
	// echo "id recomendante".$_POST['idSocio']."<br>";//borrar
	// echo "importe".$importe."<br>";//borrar
	// echo "puntosXinput".$puntosXinput."<br>";//borrar
	// echo "inputMinimo".$inputMinimo."<br>";//borrar
	// echo "puntos".$_POST['puntos']."<br>";//borrar
	// echo "tipo".$_POST['tipo']."<br>";//borrar

?>