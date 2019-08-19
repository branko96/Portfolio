<?php
session_start();
// ---
// la tarea de este archivo es eliminar todo rastro de cookie

// -- eliminamos el usuario
if(isset($_COOKIE['user_id'])){
	unset($_COOKIE['user_id']);
    setcookie("user_id", "", 1);
}

session_destroy();
// v0 29 jul 2013
//estemos donde estemos nos redirije al index
print "<script>window.location='index.php';</script>";
?>
