<?php
class consultas{
	
    function crear_club($nombre, $sub){
    	 $conexion = new conexion();
    	 $pdoQuery = "INSERT INTO em_club (nombreClub, subdominio) VALUES (:cname,:subdom)";
        $pdoResult = $conexion->prepare($pdoQuery);
        $pdoResult->bindParam(':cname', $nombre, PDO::PARAM_STR);
        $pdoResult->bindParam(':subdom', $sub, PDO::PARAM_STR);
        $pdoExec = $pdoResult->execute();
         $id_club=$conexion->lastInsertId();
        if($pdoExec)
        {
           return $id_club;
        }else{
            echo 'Data Not Inserted';
        }
    }

    ///crear usuario para el club nuevo
    function insertar_user_club($user, $pass, $id_club,$estado){

        $encrypted_password=md5($pass);
         $conexion = new conexion();
         $pdoQuery = "INSERT INTO em_members (username, password, club, estado) VALUES (:user_name,:user_pass, :club, :user_estado)";
        $pdoResult = $conexion->prepare($pdoQuery);
        $pdoResult->bindParam(':user_name', $user, PDO::PARAM_STR);
        $pdoResult->bindParam(':user_pass', $encrypted_password);
        $pdoResult->bindParam(':club', $id_club);
        $pdoResult->bindParam(':user_estado', $estado);
        $pdoExec = $pdoResult->execute();
            // check if mysql insert query successful
        if($pdoExec)
        {
            echo 'Data Inserted';
        }else{
            echo 'Data Not Inserted';
        }
    }

    function insertar_pref_club($id_club, $color,$logoname){

         $conexion = new conexion();
         $pdoQuery = "INSERT INTO preferencias_club (id_club, color_panel, nombre_logo) VALUES (:idclub,:color, :nombrelogo)";
        $pdoResult = $conexion->prepare($pdoQuery);
        $pdoResult->bindParam(':idclub', $id_club);
        $pdoResult->bindParam(':color', $color, PDO::PARAM_STR);
        $pdoResult->bindParam(':nombrelogo', $logoname, PDO::PARAM_STR);
        $pdoExec = $pdoResult->execute();
            // check if mysql insert query successful
        if($pdoExec)
        {
            echo 'Data Insertedd';
        }else{
            echo 'Data Not Inserted';
        }
    }

function consultar_pref_club($id_club){

         $conexion = new conexion();
         $pdoQuery = "SELECT * FROM preferencias_club WHERE id_club= :idclub";
        $pdoResult = $conexion->prepare($pdoQuery);
        $pdoResult->bindParam(':idclub', $id_club);
        $pdoResult->execute();
            // check if mysql insert query successful
        if($pdoResult)
        {
            $resultado=$pdoResult->fetchAll();
        }else{
            $resultado=false;
        }
        return $resultado;
    }

    function verificar_nombre_club($nombre){

         $conexion = new conexion();
         $pdoQuery = "SELECT * FROM em_club WHERE nombreClub= :nombree";
        $pdoResult = $conexion->prepare($pdoQuery);
        $pdoResult->bindParam(':nombree', $nombre, PDO::PARAM_STR);
        $pdoResult->execute();
        $number_of_rows = $pdoResult->fetchColumn();
        
        if($number_of_rows > 0)
        {
            $resultado=true;

        }else{
            $resultado=false;
        }
        return $resultado;
    }
    function verificar_subdominio_club($subdom){

         $conexion = new conexion();
         $pdoQuery = "SELECT * FROM em_club WHERE subdominio= :subdomm";
        $pdoResult = $conexion->prepare($pdoQuery);
        $pdoResult->bindParam(':subdomm', $subdom, PDO::PARAM_STR);
        $pdoResult->execute();
        $number_of_rows = $pdoResult->fetchColumn();
        
        if($number_of_rows > 0)
        {
            $resultado=true;

        }else{
            $resultado=false;
        }
        return $resultado;
    }

    

    function traer_id_club($subdom){

         $conexion = new conexion();
         $pdoQuery = "SELECT * FROM em_club WHERE subdominio= :subdomm";
        $pdoResult = $conexion->prepare($pdoQuery);
        $pdoResult->bindParam(':subdomm', $subdom, PDO::PARAM_STR);
        $pdoResult->execute();
        $resultado=$pdoResult->fetchAll();
        
        if($pdoResult)
        {
            $res=$resultado[0]['idclub'];

        }else{
            $res=false;
        }
        return $res;
    }


}
?>