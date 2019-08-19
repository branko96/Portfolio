<?php
class consultas{
	
   function buscar_socio($dni){
    $conexion = new conexion();
         $pdoQuery = "SELECT * FROM em_socios WHERE nDocumento= :doc";
        $pdoResult = $conexion->prepare($pdoQuery);
        $pdoResult->bindParam(':doc', $dni);
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


   function traer_movimientos($id_socio){
     $conexion = new conexion();
         $pdoQuery = "SELECT * FROM em_movimientos WHERE socio= :socio  ORDER BY fecha DESC";
        $pdoResult = $conexion->prepare($pdoQuery);
        $pdoResult->bindParam(':socio', $id_socio);
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
   function traer_nombre_movimiento($id_mov){
        $conexion = new conexion();
         $pdoQuery = "SELECT * FROM em_tipomovimiento WHERE idtipoMovimiento= :idmov";
        $pdoResult = $conexion->prepare($pdoQuery);
        $pdoResult->bindParam(':idmov', $id_mov);
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
   function anular($id_mov,$idsocio){
         $conexion = new conexion();
         $pdoQuery = "INSERT INTO em_anulados (id_movimiento, id_socio) VALUES (:idmov, :idsocio)";
        $pdoResult = $conexion->prepare($pdoQuery);
        $pdoResult->bindParam(':idmov', $id_mov);
        $pdoResult->bindParam(':idsocio', $idsocio);
        $pdoResult->execute();
            // check if mysql insert query successful
        if($pdoResult)
        {
            $resultado=true;
        }else{
            $resultado=false;
        }
        return $resultado;

   }
   function esta_anulado($idmovimiento,$id_socio){
    $conexion = new conexion();
         $pdoQuery = "SELECT * FROM em_anulados WHERE id_movimiento= :id_movim and id_socio= :socio";
        $pdoResult = $conexion->prepare($pdoQuery);
        $pdoResult->bindParam(':id_movim', $idmovimiento);
        $pdoResult->bindParam(':socio', $id_socio);
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

}
?>