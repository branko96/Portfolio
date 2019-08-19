<?php
class ReservationData {
	public static $tablename = "agenda";
    public static $tablenameServicios = "servicios";


    public function ReservationData(){
		$this->nombre = "";
		$this->apellido = "";
		$this->telefono = "";
		$this->email = "";


        $this->usuario_id = "";
        $this->notas = "";
        $this->fecha = "";
        $this->hora = "";
		$this->fecha_reserva = "NOW()";
        $this->cliente_id = "";
        $this->barbero_id = "";
        $this->precio="";
        $this->estado_id = "";
        $this->estado_pago_id = "";
        $this->servicio_id = "";
        $this->endturno = "";
        $this->inactivo="";
        $this->activo="";
        $this->forma_pago="";
	}

	public function getPacient(){ return PacientData::getById($this->cliente_id); }
	public function getMedic(){ return MedicData::getById($this->barbero_id); }
	public function getStatus(){ return StatusData::getById($this->estado_id); }
	public function getPayment(){ return PaymentData::getById($this->estado_pago_id); }
    public function getservicio(){ return CategoryData::getById($this->servicio_id); }



    public function add(){
        $sql = "insert into agenda (notas,fecha,hora,fecha_reserva,cliente_id,usuario_id,barbero_id,precio,estado_pago_id,estado_id,servicio_id,endturno)";
        $sql .= "VALUES (\"$this->notas\",\"$this->fecha\",\"$this->hora\",\"$this->fecha_reserva\",\"$this->cliente_id\",\"$this->usuario_id\",\"$this->barbero_id\",\"$this->precio\",\"$this->estado_pago_id\",\"$this->estado_id\",\"$this->servicio_id\",\"$this->endturno\")";
        return Executor::doit($sql);
    }

    public function add_Inactivo(){
        $sql = "insert into agenda (notas,fecha,hora,fecha_reserva,cliente_id,usuario_id,barbero_id,precio,estado_pago_id,estado_id,servicio_id,endturno,inactivo)";
        $sql .= "VALUES (\"$this->notas\",\"$this->fecha\",\"$this->hora\",\"$this->fecha_reserva\",\"$this->cliente_id\",\"$this->usuario_id\",\"$this->barbero_id\",\"$this->precio\",\"$this->estado_pago_id\",\"$this->estado_id\",\"$this->servicio_id\",\"$this->endturno\",\"$this->inactivo\")";
         // var_dump($sql);
        return Executor::doit($sql);
    }

    public function add_Vacaciones(){
        $sql = "insert into agenda (notas,fecha,hora,fecha_reserva,cliente_id,usuario_id,barbero_id,precio,estado_pago_id,estado_id,servicio_id,endturno,inactivo)";
        $sql .= "VALUES (\"$this->notas\",\"$this->fecha\",\"$this->hora\",\"$this->fecha_reserva\",\"$this->cliente_id\",\"$this->usuario_id\",\"$this->barbero_id\",\"$this->precio\",\"$this->estado_pago_id\",\"$this->estado_id\",\"$this->servicio_id\",\"$this->endturno\",\"$this->inactivo\")";
         //var_dump($sql);
        return Executor::doit($sql);
    }

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		//var_dump($sql);
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto ReservationData previamente utilizamos el contexto
	public function update(){
	    //var_dump($this);
		$sql = "update ".self::$tablename." set notas=\"$this->notas\",estado_pago_id=\"$this->estado_pago_id\",servicio_id=\"$this->servicio_id\",endturno=\"$this->endturno\",precio=\"$this->precio\",forma_pago=\"$this->forma_pago\" where id=$this->id";
		//var_dump($sql);
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ReservationData());
	}

	public static function getRepeated($barbero_id,$fecha,$hora){
		$sql = "select * from ".self::$tablename." where barbero_id=$barbero_id and fecha=\"$fecha\" and hora=\"$hora\"";
		//var_dump($sql);
		$query = Executor::doit($sql);
		return Model::one($query[0],new ReservationData());
	}

	public static function getRepeated_end($barbero_id,$fecha,$hora_ini,$endturno){
		$sql = "select * from ".self::$tablename." where barbero_id=$barbero_id and fecha=\"$fecha\" and ((hora between \"$hora_ini\" and \"$endturno\") or (endturno between \"$hora_ini\" and \"$endturno\"))";
		//var_dump($sql);
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}

    public static function DisponibilidadTurno($barbero_id,$fecha,$hora,$finHora){
        $sql = "select agenda.id,fecha,hora,barbero_id,servicios.nombre,servicios.importe,servicios.tiempo from ".self::$tablename." INNER JOIN servicios ON ".self::$tablename.".servicio_id=".self::$tablenameServicios.".id where barbero_id=$barbero_id and fecha=\"$fecha\" and (hora>\"$hora\") and (hora between \"$hora\" and \"$finHora\")";
        //var_dump($sql);
        $query = Executor::doit($sql);
        return Model::one($query[0],new ReservationData());
    }

    public static function DisponibilidadTurno_HoraMedia($barbero_id,$fecha,$hora,$finHora){
        $sql = "select agenda.id,fecha,hora,barbero_id,servicios.nombre,servicios.importe,servicios.tiempo from ".self::$tablename." INNER JOIN servicios ON ".self::$tablename.".servicio_id=".self::$tablenameServicios.".id where barbero_id=$barbero_id and fecha=\"$fecha\" and (hora>\"$hora\") and (hora between \"$hora\" and \"$finHora\")";
        //var_dump($sql);
        $query = Executor::doit($sql);
        return Model::one($query[0],new ReservationData());
    }

    public static function DisponibilidadNuevoTurno($barbero_id,$fecha,$hora,$finHora){
        $sql = "select * from ".self::$tablename." where barbero_id=$barbero_id and fecha=\"$fecha\" and (hora between \"$hora\" and \"$finHora\")";
        //$sql= "select * from agenda where barbero_id=1 and fecha='2019-05-14' and (hora between '11:30' and '12:30') and (endturno between '11:30' and '12:30')";

        //var_dump($sql);
        $query = Executor::doit($sql);
        return Model::one($query[0],new ReservationData());
    }

    public static function DisponibilidadNuevoTurnoHoraMedia($barbero_id,$fecha,$hora,$finHora){
        $sql = "select * from ".self::$tablename." where barbero_id=$barbero_id and fecha=\"$fecha\" and (hora between \"$hora\" and \"$finHora\")";
        //$sql= "select * from agenda where barbero_id=1 and fecha='2019-05-14' and (hora between '11:30' and '12:30') and (endturno between '11:30' and '12:30')";

        //var_dump($sql);
        $query = Executor::doit($sql);
        return Model::one($query[0],new ReservationData());
    }

    public static function Verificarhorarios($barbero_id,$fecha){
        $sql = "select * from ".self::$tablename." where barbero_id=$barbero_id and fecha=\"$fecha\" ";
      
        $query = Executor::doit($sql);
        return Model::many($query[0],new ReservationData());
    }


    public static function DisponibilidadVacaciones($barbero_id,$fecha,$hora){
        //$sql = "select * from ".self::$tablename." where barbero_id=$barbero_id and fecha=\"$fecha\" and (endturno<=\"$hora\") and (hora<=\"$hora\")";
        $sql = "select * from ".self::$tablename." where barbero_id=$barbero_id and fecha=\"$fecha\"";
        //var_dump($sql);
        $query = Executor::doit($sql);
        return Model::many($query[0],new ReservationData());
    }

	public static function getByMail($mail){
		$sql = "select * from ".self::$tablename." where mail=\"$mail\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ReservationData());
	}

	public static function getEvery($barbero_id){
		$sql = "select * from ".self::$tablename." where barbero_id=\"$barbero_id\"";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." where date(fecha)>=date(NOW()) order by fecha";
        //print $sql;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}

	public static function getAllPendings(){
		$sql = "select * from ".self::$tablename." where (fecha)>=date(NOW()) and estado_id=1 and estado_pago_id=1 order by fecha";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}

    public static function buscarTurnos(){
        $sql = "select * from ".self::$tablename." order by id asc ";
        $query = Executor::doit($sql);
        return Model::many($query[0],new PacientData());
    }

	public static function getAllByPacientId($id){
		$sql = "select * from ".self::$tablename." where cliente_id=$id order by fecha";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}

	public static function getAllByMedicId($id){
		$sql = "select * from ".self::$tablename." where barbero_id=$id order by fecha";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}

	public static function getOld(){
		$sql = "select * from ".self::$tablename." where date(fecha)<date(NOW()) order by fecha";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where notas like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservationData());
	}


}

?>