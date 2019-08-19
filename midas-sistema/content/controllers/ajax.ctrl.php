<?php
    require_once("../../admin/content/database.php");
    $db=new database();
    $db->conectar();
    $action= $_POST['action'];
    $model=$_POST['model'];

 switch ($action) {
    case 'canjear-premio':
        $sector_user= true; // variable que indica es el modulo es llamado desde el fronted USUARIO
        $datos_socio= json_decode($_POST['datos_socio']);
        $socio=$datos_socio->idSocios;
        if (!empty($datos_socio->email))
            $email_socio=$datos_socio->email;
        $email_admin=$datos_socio->email_admin;
        $premios=$_POST['premios'];
        $puntosPremio=$_POST['puntosPremio'];
        $idClub=$datos_socio->club;
        $puntosAcumulados=$datos_socio->puntosAcumulados;

        if((float)$puntosAcumulados >= (float)$puntosPremio){

     		require_once("../../admin/content/models/".$model.".mod.php");

            if($result_AC)
                session_start();
                $_SESSION['socio']['puntosAcumulados']= $valor;
                require_once("../../content/models/enviar_notificacion.mod.php");

        }else{

            $result_AC = false;
        }

        echo $result_AC; //imprimo el resultado del modelo para que se vea en ajax
 		
 		break;

 	default:
 		# code...
 		break;
 }
?>