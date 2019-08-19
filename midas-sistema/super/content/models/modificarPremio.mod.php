<?php
	require_once("content/database.php");
	$id=$_POST['id'];
	$titulo=$_POST['titulo'];
	$detalle=$_POST['detalle'];
	$fdesde=$_POST['fDesde'];	
	$fhasta=$_POST['fHasta'];
	$stock=$_POST['stock'];	
	$club=$_SESSION['club'];
    $idClub=$club['id'];	
	$puntos=$_POST['puntos'];

	if($_POST['visibilidad']=='on'){
		$visib='1';
	}
	else{
		$visib='0';
	}

	$db=new database();
	$db->conectar();
	$key="idpremios='$id'";
	$table='em_premios';

	$values=" titulo='$titulo',detalle='$detalle',fechaDesde='$fdesde',fechaHasta='$fhasta',stock='$stock',puntos='$puntos',visibilidad='$visib'";
	$result_GP =$db->updateRow($table,$values,$key);
	if($result_GP)
	{   //gestiono la imagen
		if(!empty($_FILES['img']['tmp_name']))
		{
		     $key="idPremios='$id'";
		     $img=$db->queryItem('em_imagenes',$key); //trae el nombre de la img actual si hay
		     // var_dump($img);
		     $destino="content/uploads/"; 
		     $original= $_FILES['img']['tmp_name'];

			  if(!empty($img['imgUrl']))
			  { 
			  	$nombre_final=$img['imgUrl'];
			  	$destino=$destino.$img['imgUrl'];
			  	
			  }
			  else
			  {
	            $nombre_final=$idClub.time().".jpg";
	            $destino=$destino.$nombre_final;
	            $values="idPremios='$id',imgUrl='$nombre_final'";
	            $db->insertRow('em_imagenes',$values);
	            // echo "chau";

	          }
	          move_uploaded_file($original,$destino);
		}
		
	  
		//------------------------------------------------------------------
	    //recorro las categorias del premio para guardar
	    $table="em_precat";
	    $key="premio='$id'";
	    $db->deleteRow($table,$key); //primero elimino los items
	    foreach ($_POST['selectTipo'] as $key => $value) 
	    {
	 	   if(!empty($value))
	 	   {
	 	   	$values="categoria='$value',premio='$id'";
	 	   	 $db->insertRow($table,$values);
	 	   }
	 	
	    }
	}
	return $result_GP;
?>