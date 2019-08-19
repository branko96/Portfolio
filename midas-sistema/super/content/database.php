<?php
/**
* 
*/


require_once(dirname(__FILE__)."/config.php");

class database
{
	private $server;
	private $user;
	private $pass;
	private $bd;
	private $con;
	
	function database()
	{
		/*asigno datos de config a la conexion*/
		$this->server= server;
		$this->user=user;
		$this->pass=pass;
		$this->bd=bd;
	}
	function conectar()
    {
       $this->con= mysqli_connect($this->server,$this->user,$this->pass,$this->bd);
       mysqli_set_charset($this->con, "utf8");
    }
	/*function conectar()
	{
      $this->con= mysqli_connect($this->server,$this->user,$this->pass,$this->bd) or die("error de conexión");
	}*/
	function query($query)
	{
		$result= mysqli_query($this->con,$query);
		return $result;
	}

	function query2($query)
	{
		$result= mysqli_query($this->con,$query);

		if ($result){
			$error=null;
		}else{
			$GLOBALS['error'] =(mysqli_error($this->con));
			$result=0;
		}

		return $result;
	}

	function queryList($query)
	{
      $list = array();
      

		$result = $this->query($query);

		while ( $row = mysqli_fetch_assoc ( $result))
			array_push( $list, $row );

		return $list;

	}



	function deleteRow($table,$key)
	{
		$query="delete from $table where $key";
		return $this->query($query);

	}
	function insertRow( $table,$values) {

		$query = "INSERT INTO $table SET $values";

		return( $this->query($query) or die(mysqli_error($this->con)) );

	}

	function insertarFila( $table,$values) {

		$query = "INSERT INTO $table SET $values";
		return( $this->query2($query));
		
	}

	function updateRow ($table, $values,$key) {
		
		$query = "UPDATE $table SET $values WHERE $key";

		return( $this->query($query) or die(mysqli_error($this->con)));
	
	}

	function affected_row(){
		return mysqli_affected_rows($this->con);
	}

	function queryCount($sql) {

		return mysqli_num_rows( $this->query($sql)); 

	}
	function queryItem($table,$key) {
        $query="select * from $table where $key";
		return mysqli_fetch_assoc( $this->query($query)); 

	}
	function queryAssoc($sql) {

		return mysqli_fetch_assoc($this->query($sql)) or die(mysqli_error($this->con)); 

	}
	function lastId()
	{
		return mysqli_insert_id($this->con);
	}

	public function paginador($criterio)
        { 
            
            

            @$pagina=$_GET["pag"];

            $registros=12; //nº de registros que se van a mostrar

            if(!$pagina){ //si no se le envio el nº de pagina toma por defecto los siguientes:
                $inicio = 0;
                $pagina = 1;
            }
            else{
                $inicio=($pagina - 1)*$registros;
            }

            $this->conectar();
            $result = $this->query($criterio); //devuelve un arreglo con todos los elementos de una fila
             

            while ($reg=mysqli_fetch_array($result))
            {
                // Asignamos los datos a la variable $row
                $this->row[] = $reg;
            }

            $total_registros= count($this->row);//devuelve el nº total de filas en la base de datos
           

            $total_paginas=ceil($total_registros/$registros); //calcula el total de paginas segun los registros mostrados en las mismas
            
          
            $result = $this->query($criterio." LIMIT $inicio, $registros");
            
            while ($newReg=mysqli_fetch_array($result))
            {
               
                $this->newRow[] = $newReg;
            }

            $obj=array(
                "total_registros" => $total_registros,
                "total_paginas"   => $total_paginas,
                "pagina"          => $pagina,
                "result"          => $this->newRow,
                );

            return $obj;

        }//end paginador


        Public function actualizar_datos_login($myusername,$mypassword){

        	$sql="SELECT * FROM em_members  m INNER JOIN em_club c ON c.idClub = m.club LEFT JOIN em_config cf ON cf.club=c.idClub
				WHERE m.username='$myusername' AND m.password='$mypassword'";

				$db=new database;
				$db->conectar();
				$infoLog=$db->querylist($sql);

				$_SESSION['login']=$infoLog[0];
        }
	
}
?>