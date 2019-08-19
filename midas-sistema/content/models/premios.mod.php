<?php

//echo $_GET['club'];

if(isset($_GET['club']))
{
	
	  if($_GET['club']=='todos')
	  {

	   $query="SELECT a.*,(select c.nombreClub from em_club c where a.club=c.idclub) as nombreClub,(select b.imgUrl from em_imagenes b where b.idPremios=a.idpremios) as url from em_premios a where  a.fechaHasta<= CURDATE() and a.stock>0 and a.visibilidad=1";	
	   $club=$_GET['club'];
	  }
	  else
	  {
	  	$query="SELECT a.*,(select c.nombreClub from em_club c where a.club=c.idclub) as nombreClub,(select b.imgUrl from em_imagenes b where b.idPremios=a.idpremios) as url from em_premios a  where a.fechaHasta<= CURDATE() and club='$_GET[club]' and a.stock>0 and a.visibilidad=1";
	  	$club=$_GET['club'];
	  }
}
else
{

  $query="SELECT a.*,(select c.nombreClub from em_club c where a.club=c.idclub) as nombreClub,(select b.imgUrl from em_imagenes b where b.idPremios=a.idpremios) as url from em_premios a  where a.fechaHasta<=CURDATE() and club='$idClub' and a.stock>0 and a.visibilidad=1 ORDER BY a.titulo ASC";
  ;
}

$hayDatos=$db->queryCount($query);

if ($hayDatos > 0) $premios=$db->paginador($query);


?>