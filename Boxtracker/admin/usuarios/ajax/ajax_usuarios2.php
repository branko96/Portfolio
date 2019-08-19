<?php
include_once("../../../BACKEND/datos/conexion.php");
include_once("../../../BACKEND/controller/UsuariosController.php");
$usuariosCont=new UsuariosController($basedatos,$servidor,$usuario,$paswd);
$objDatos = json_decode(file_get_contents("php://input"));
echo $objDatos->op;
$id_user=10;
//$usuario=$usuariosCont->VerUsuario($id_user);
//echo json_encode($usuario->getJson(), JSON_PRETTY_PRINT);
?>