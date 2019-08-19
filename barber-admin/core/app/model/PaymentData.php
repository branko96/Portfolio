<?php
class PaymentData {
	public static $tablename = "estado_pago";


	public function PaymentData(){
		$this->estado = "";
	}

	public function add(){
		$sql = "insert into estado_pago (estado) ";
		$sql .= "value (\"$this->estado\")";
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

// partiendo de que ya tenemos creado un objecto PaymentData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set estado=\"$this->estado\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PaymentData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new PaymentData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where estado like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PaymentData());
	}


}

?>