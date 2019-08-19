<?php

require_once '../admin/content/database.php';
session_start();
// username and password sent from form 
$nTarjeta=$_POST['nTarjeta']; 
$nDocumento=$_POST['nDocumento'];
$subdominio=$_POST['subdominio']; 



$sql="SELECT s.*, c.*,cf.email AS email_admin FROM em_socios  s
		JOIN em_club c ON c.idClub = s.club JOIN em_config cf ON cf.club=s.club
		WHERE nDocumento='$nDocumento' AND c.subdominio='$subdominio'";

$login = new database();

$login->conectar(); 

$count=$login->querylist($sql);


// If result matched $myusername and $mypassword, table row must be 1 row
if($count){

// Register $myusername, $mypassword and redirect to file "login_success.php"


$_SESSION['socio']=$count[0];


header("location:../".$_SESSION['socio']['subdominio']."/index.php");
}
else {
header('Location: ' . $_SERVER['HTTP_REFERER'].'?Error=true');

}


?>