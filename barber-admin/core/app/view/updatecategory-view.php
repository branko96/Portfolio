<?php

if(count($_POST)>0){
	$user = CategoryData::getById($_POST["id"]);
    $user->nombre = $_POST["nombre"];
    $user->importe = $_POST["importe"];
    $user->tiempo = $_POST["tiempo"];

	$user->update();

    Core::alert("Actualizado exitosamente!");
print "<script>window.location='index.php?view=categories';</script>";


}


?>