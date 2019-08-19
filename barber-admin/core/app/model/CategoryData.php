<?php
class CategoryData {
	public static $tablename = "servicios";


	public function CategoryData(){
		$this->nombre = "";
		$this->importe = "";
		$this->tiempo = "";

	}

	public function add(){
		$sql = "insert into servicios (nombre,importe,tiempo) ";
		$sql .= "value (\"$this->nombre\",\"$this->importe\",\"$this->tiempo\")";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto CategoryData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set nombre=\"$this->nombre\",importe=\"$this->importe\",tiempo=\"$this->tiempo\" where id=$this->id";
		Executor::doit($sql);

	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);

		return Model::one($query[0],new CategoryData());

	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new CategoryData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CategoryData());
	}


}

?>