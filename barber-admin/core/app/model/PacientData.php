<?php
class PacientData {
	public static $tablename = "clientes";
	public function PacientData(){
		$this->nombre = "";
		$this->apellido = "";
		$this->telefono = "";
		$this->email = "";
        $this->dni = "";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (nombre,apellido,email,telefono,dni) ";
		$sql .= "value (\"$this->nombre\",\"$this->apellido\",\"$this->email\",\"$this->telefono\",\"$this->dni\")";
		Executor::doit($sql);	
	}

	public function addclient_landing($nombre,$apellido,$email,$telefono){
		$sql = "insert into ".self::$tablename." (nombre,apellido,email,telefono) ";
		$sql .= "value (\"$this->nombre\",\"$this->apellido\",\"$this->email\",\"$this->telefono\")";
		Executor::doit($sql);	
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto PacientData previamente utilizamos el contexto
/*	public function update_active(){
		$sql = "update ".self::$tablename." set last_active_at=NOW() where id=$this->id";
		Executor::doit($sql);
	}*/


	public function update(){
		$sql = "update ".self::$tablename." set nombre=\"$this->nombre\",apellido=\"$this->apellido\",email=\"$this->email\",telefono=\"$this->telefono\",dni=\"$this->dni\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PacientData());
	}

		public static function getByTel($telefono){
		$sql = "select * from ".self::$tablename." where telefono=$telefono";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PacientData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by id desc ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PacientData());
	}

	/*public static function getAllActive(){
		$sql = "select * from client where last_active_at>=date_sub(NOW(),interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PacientData());
	}

	public static function getAllUnActive(){
		$sql = "select * from client where last_active_at<=date_sub(NOW(),interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PacientData());
	}*/


	public function getUnreads(){ return MessageData::getUnreadsByClientId($this->id); }


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where nombre like '%$q%' or email like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PacientData());
	}


}

?>