<?php
if(isset($_POST['socio']))
{
  require_once("content/database.php");
    $socio=$_POST['socio'];
    $club_socio=$_SESSION['club']['id']; //el club al cual pertenece

    $db=new database();
    $db->conectar();
    if($_POST['radios']==2)
      $query="SELECT * from em_socios where nTarjeta='$socio' AND club='$club_socio'";
    else
      $query="SELECT * from em_socios where nDocumento='$socio' AND club='$club_socio'";
  $data=$db->queryList($query);
  
  $puntos=$data[0]['puntosAcumulados'];
  $idSocios=$data[0]['idSocios'];

  $query="SELECT a.*,(SELECT b.imgUrl from em_imagenes b where b.idPremios=a.idpremios) as url from em_premios a where a.puntos<=$puntos and a.visibilidad=1 and a.stock > 0 and a.club='$club_socio'";
 
 
    $premios= $db->queryList($query);

}
?>