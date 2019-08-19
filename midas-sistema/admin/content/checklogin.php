<?php

require_once 'database.php';
session_start();
// username and password sent from form 
$myusername=$_POST['user']; 
$mypassword=$_POST['pass']; 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
// $myusername = mysqli_real_escape_string($myusername);
// $mypassword = mysqli_real_escape_string($mypassword);
$encrypted_mypassword=md5($mypassword);
// $sql="SELECT * FROM em_members  m INNER JOIN em_club c ON c.idClub = m.club
// 		WHERE username='$myusername' and password='$encrypted_mypassword'";

$sql="SELECT * FROM em_members  m INNER JOIN em_club c ON c.idClub = m.club LEFT JOIN em_config cf ON cf.club=c.idClub
	WHERE m.username='$myusername' AND m.password='$encrypted_mypassword'";

$login = new database();

$login->conectar(); 

$infoLog=$login->querylist($sql);


// If result matched $myusername and $mypassword, table row must be 1 row
if($infoLog){

	if($infoLog[0]['estado']){

		// Register $myusername, $mypassword and redirect to file "login_success.php"
		$_SESSION['login']=$infoLog[0];
		$_SESSION['user']=$myusername;
		$_SESSION['password']=$encrypted_mypassword;
		$club['id']=$infoLog[0]['idclub'];
		$club['subdominio']=$infoLog[0]['subdominio'];

		$_SESSION['club']=$club;

		header("location:../index.php");
		
	}else{

		header("location:../suspension.html");
	}
}
else {
echo "Nombre de Usuario o Password incorrecto";
}


?>