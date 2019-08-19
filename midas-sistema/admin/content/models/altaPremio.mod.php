<?php
require_once("content/database.php");
$titulo=$_POST['titulo'];
$detalle=$_POST['detalle'];
$fdesde=$_POST['fDesde'];	
$fhasta=$_POST['fHasta'];
$stock=$_POST['stock'];	
$tipo=$_POST['selectTipo'];
if($_POST['visibilidad']=='on'){
	$visib='1';
}
else{
	$visib='0';
}

$puntos=$_POST['puntos'];	
$club=$_SESSION['club'];
$idClub=$club['id'];	
$db=new database();
$db->conectar();
$table='em_premios';
$values=" titulo='$titulo',detalle='$detalle',fechaDesde='$fdesde',fechaHasta='$fhasta',stock='$stock',puntos='$puntos',club='$idClub',visibilidad='$visib'";
$result_AP =$db->insertRow($table,$values);
if($result_AP)
{
	$lastId=$db->lastId(); //trae el ultimo id insertado
	$table='em_imagenes';
	foreach($_FILES['img']['tmp_name']  as $indice =>$file)  //inserta img y la guarda en uploads
    {
    	 if(!empty($file))
	    {
	    	$original= $_FILES['img']['tmp_name'][$indice];
	    	$nombre_final=$idClub.time().$indice.".jpg"; //seteo el club por si se pisan las imagenes
	    	$values="idPremios='$lastId',imgUrl='$nombre_final'";
            $db->insertRow($table,$values);
	    	$destino="content/uploads/$nombre_final";
	    	move_uploaded_file($original,$destino);
	    }
    }
    //------------------------------------------------------------------
    //recorro las categorias del premio para guardar
    $table="em_precat";
    foreach ($_POST['selectTipo'] as $key => $value) 
    {
 	   if(!empty($value))
 	   {
 	   	$values="categoria='$value',premio='$lastId'";
 	   	 $db->insertRow($table,$values);
 	   }
 	
    }
}
return $result_AP;
?>