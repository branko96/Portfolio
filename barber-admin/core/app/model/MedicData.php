<?php
class MedicData {
	public static $tablename = "barberos";
	public function MedicData(){
        $this->nombre = "";
        $this->apellido = "";
		$this->email = "";
        $this->telefono = "";
        $this->imagen = "";
		$this->password = "";
		$this->es_activo = "0";
		$this->fecha_creacion = "NOW()";
		$this->categoria_id= "";
	}

	public function getCategory(){ return CategoryData::getById($this->categoria_id); }

	public function add(){
		$sql = "insert into ".self::$tablename." (nombre,apellido,email,telefono,imagen,es_activo,fecha_creacion,categoria_id)";
		$sql .= "value ($this->nombre\",\"$this->apellido\",\"$this->email\",\"$this->telefono\",\"$this->imagen\",\"$this->fecha_creacion\",$this->categoria_id)";
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

// partiendo de que ya tenemos creado un objecto MedicData previamente utilizamos el contexto
	public function update_active(){
		$sql = "update ".self::$tablename." set last_active_at=NOW() where id=$this->id";
		Executor::doit($sql);
	}


	public function update(){
		$sql = "update ".self::$tablename." set nombre=\"$this->nombre\",apellido=\"$this->apellido\",phone=\"$this->phone\",email=\"$this->email\",categoria_id=$this->categoria_id where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new MedicData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by fecha_creacion desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new MedicData());
	}

	public static function getAllActive(){
		$sql = "select * from client where last_active_at>=date_sub(NOW(),interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new MedicData());
	}

	public static function getAllUnActive(){
		$sql = "select * from client where last_active_at<=date_sub(NOW(),interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new MedicData());
	}


	public function getUnreads(){ return MessageData::getUnreadsByClientId($this->id); }


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where title like '%$q%' or email like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new MedicData());
	}


}

?>