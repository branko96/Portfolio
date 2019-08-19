<p><?= $result[0]['nombre'];?><p>

<?php

if($_SESSION['login']['categorizarSocio'] == 'categoria'){ 
	foreach ($result as $login ) {
		if($login['tipoCliente'] == $login['tipo'])$tipoDefault=$login['valor'];
	}?>
	
	<p>Socio: <?= $result[0]['tipoCliente'];?><p>
	<?php 
}else{ 

	if($_SESSION['login']['categorizarSocio'] == 'herencia'){ 
		
		$herencia=json_decode($result[0]['herencia']);
		$tipoDefault=$herencia[0];

	}else{

		$tipoDefault=$result[2]['valor'];
	}


}?>

<p> <?= $_SESSION['login']['sistemaValores'].": ". $result[0]['puntosAcumulados'];?><p>
<input id="puntosXinput" name="puntosXinput" type="number" value="<?= $tipoDefault;?>" readonly hidden >
<input id="idSocio" name="idSocio" type="number" value="<?= $result[0]['idSocios'];?>" readonly hidden > 

