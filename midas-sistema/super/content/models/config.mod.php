<?php 

	$db=new database();
	$db->conectar();
	$club=$_SESSION['club'];
	$idClub=$club['id'];
	$query="SELECT cf.id AS idMember, cf.club, cf.sistemaValores, cf.categorizarSocio, cf.inputMinimo, cf.email, cf.juego,cf.herencia, tp.id AS idTipoCliente, tp.tipo, tp.valor FROM em_config cf LEFT JOIN em_tipo_cliente tp ON cf.club=tp.club WHERE cf.club='$idClub' ";           
	$config=$db->queryList($query);

	if(empty($config)){
		//si no recibo valores SETEO a NULL los campos
		$config[0]['inputMinimo']=0;
		$config[0]['club']=0;
	}

	foreach ($config as $key ) {
		# code...
		$tipo=$key['tipo'];

		$valorCliente[$tipo]=$key['valor'];
		
	}


	$datosJson= json_decode($config[0]['juego'], true);

	if($config[0]['herencia'] != '') $herencia= json_decode($config[0]['herencia'], true);


 ?>