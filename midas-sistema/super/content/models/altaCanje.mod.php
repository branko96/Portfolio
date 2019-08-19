<?php
 if(!empty($_POST['premios']))
 {
 	
 	$db=new database();
 	$db->conectar();
 	
 	if(!isset($sector_user)){ //pregunto si el modulo es llamado desde el sector USUARIOS o desde el ADMIN

	 	$club=$_SESSION['club'];
		$idClub=$club['id'];
	 	$socio=$_POST['socio'];
	 	$premios=$_POST['premios'];
 	}
 	
 	
 	$date= date("Y/m/d");
    
 	//recorro los premios que selecciono
 	for($i=0;$i<count($premios);$i++) {
 		$value= $premios[$i];
 		$query="SELECT puntos from em_premios where idpremios=".$value; //selecciono los puntos que vale el premio
 		$valor=$db->queryList($query);
 		$valor= $valor[0]['puntos']; //valor tiene los puntos

 		$values=" tipoMovimiento=1,fecha='$date',puntosSuma='-$valor',socio='$socio',club='$idClub',premio='$value',hora=TIME(NOW())";
 	    
 	    //INSERTO EL MOVIMIENTO
 	   $result_AC= $db->insertRow("em_movimientos",$values);
 	   $last_id=$db->lastId();

 	   //si inserto el movimiento bien, descuento 
 	   if($result_AC) 
 	   {

 		$key=" idSocios='$socio'";
 		$values=" puntosAcumulados= puntosAcumulados-'$valor'"; //resto los puntos al socio
 		$db->updateRow("em_socios",$values,$key); 
 		//disminuye el stock
         $table="em_premios";
         $values="stock=stock-1";
         $key="idpremios=".$value;
         $db->updateRow("em_premios",$values,$key);

         //actualizo los puntos diarios
		$query="SELECT puntosAcumulados from em_socios where idSocios='$socio'";
	    $valor=$db->queryList($query);
	    $valor= $valor[0]['puntosAcumulados']; //valor tiene los puntosAcumulados
	   
	    $values=" puntosTotalDiario= $valor";
	    $table=" em_movimientos";
	    $key=" idcompras='$last_id'";
	    $db->updateRow($table,$values,$key);
       //---------------//


 	   }

 	}  
 	 
 }
 //var_dump($_POST);
 return $result_AC;  
?>