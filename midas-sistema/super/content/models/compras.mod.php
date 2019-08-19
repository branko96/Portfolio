<?php
/*
	este modulo lo uso cuando hago una COMPRA, acumulo puntos por el JUEGO y en HERENCIA
	por eso el tipo de movimiento puede ser uno de estos 3 y el importe NULL.
*/
$db=new database();
$db->conectar();

$idClub=$_SESSION['club']['id'];

if(isset($_POST['puntos']))
{
	$puntos=htmlspecialchars($_POST['puntos']);
}

if(isset($_POST['idSocio'])) //$_POST['socio'] hace referencia al id del socio
{
	
	$socio=htmlspecialchars($_POST['idSocio']);
	
	$query="SELECT idSocios, recomendado_por from em_socios where idSocios='$socio' AND club='$idClub'";

	$result=$db->queryList($query);
	if($result){
		// busco el recomendante
		$idRecomendante=$result[0]['recomendado_por'];

	}
}


if(isset($_POST['tipo'])){
	$tipoMov=$_POST['tipo'];
}else{
	$tipoMov='3';
}

if(isset($_POST['importe']))
{
	$importe=htmlspecialchars($_POST['importe']);
}else{
	$importe = NULL;
}

$date=date("Y/m/d");
$table="em_movimientos";
$values="tipoMovimiento=$tipoMov,club='$idClub',socio='$socio',importe='$importe',fecha='$date',hora=TIME(NOW()),puntosSuma='$puntos'";

$ingresar_compra= $db->insertarFila($table,$values);


if($ingresar_compra)
{

	$last_id=$db->lastId(); //obtengo el id que se inserto
	//echo $last_id;
    
	$table=" em_socios";
	$values=" puntosAcumulados= puntosAcumulados + '$puntos'";
	$key=" idSocios='$socio'";
	$db->updateRow($table,$values,$key);

	//actualizo los puntos diarios
	$query="select puntosAcumulados from em_socios where idSocios='$socio'";
    $valor=$db->queryList($query);
    $valor= $valor[0]['puntosAcumulados']; //valor tiene los puntosAcumulados al dia de la fecha y al momento de la operacion
    //echo $valor;
    $values=" puntosTotalDiario= $valor";
    $table=" em_movimientos";
    $key=" idcompras='$last_id'";
    $db->updateRow($table,$values,$key);
    //---------------//
}
return $ingresar_compra;
?>