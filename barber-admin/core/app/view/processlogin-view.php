<?php

// define('LBROOT',getcwd()); // LegoBox Root ... the server root
// include("core/controller/Database.php");

if(Session::getUID()=="") {
$user = $_POST['mail'];
$pass = sha1(md5($_POST['password']));

$base = new Database();
$con = $base->connect();
 $sql = "select * from usuarios where (email= \"".$user."\" or nombre= \"".$user."\") and password= \"".$pass."\" and es_activo=1";
 //var_dump($sql);
$query = $con->query($sql);
$found = false;
$userid = null;
//var_dump($query);
while($r = $query->fetch_array()){
	$found = true ;
	$userid = $r['id'];
	$_SESSION['id_barbero_us']=$r['id_barbero'];
}

if($found==true) {
//	print $_SESSION['id_barbero_us'];
	//$_SESSION['user_id']=$userid ;
    setcookie('user_id',$userid,time()+10800);
//	setcookie('userid',$userid);
//	print $_SESSION['userid'];
	print "Cargando ... $user";
	print "<script>window.location='index.php?view=home';</script>";
}else {
	print "<script>window.location='index.php?view=login';</script>";
}

}else{
	print "<script>window.location='index.php?view=home';</script>";
	
}
?>
