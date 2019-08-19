<?php
class UserData {
	public static $tablename = "usuarios";

	public function UserData(){
		$this->nombre = "";
		$this->apellido = "";
		$this->email = "";
		$this->password = "";
		$this->es_activo = "0";
		$this->es_admin = "0";
		$this->fecha_creacion = "NOW()";
        $this->id_barbero = "0";

    }

	public function add(){
		$sql = "insert into ".self::$tablename." (nombre,apellido,email,password,es_activo,es_admin,fecha_creacion,id_barbero) ";
		$sql .= "value (\"$this->nombre\",\"$this->apellido\",\"$this->email\",\"$this->password\",$this->es_activo,$this->es_admin,$this->fecha_creacion,$this->id_barbero)";
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

// partiendo de que ya tenemos creado un objecto UserData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set nombre=\"$this->nombre\",apellido=\"$this->apellido\",email=\"$this->email\",es_activo=$this->es_activo,es_admin=$this->es_admin where id=$this->id";
		Executor::doit($sql);
	}

	public function update_passwd(){
		$sql = "update ".self::$tablename." set password=\"$this->password\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new UserData());
	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by fecha_creacion desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where title like '%$q%' or content like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserData());
	}


}

?>