<?php
	include_once dirname(__FILE__). '/../datos/DbTableros.php';
	include_once dirname(__FILE__). '/../model/Proyect.php';
	include_once dirname(__FILE__). '/../model/Tablero.php';
	include_once dirname(__FILE__). '/../model/Grupo.php';
	include_once dirname(__FILE__). '/../model/Respuesta.php';
	include_once dirname(__FILE__). '/../model/Usuario.php';
	include_once dirname(__FILE__). '/../controller/UsuariosController.php';

	class TableroController{
		private $db;	

		//Constructor//

		public function __construct()
		{	
			include_once dirname(__FILE__).'/../datos/conexion.php';
			$this->db = new DbTableros();	
			$this->usuariosCont = new UsuariosController($basedatos,$servidor,$usuario,$paswd);
		}

		//******************* Metodos *********************//

		public function Traer_allProyects($id_creador){
		//En esta funcion se selecciona el proyecto segun lo que se reciba como parametro de id de creador	
			$query = sprintf("SELECT boxtracker_01.proyectos.* FROM boxtracker_01.proyectos INNER join boxtracker_01.miembros_grupo ON boxtracker_01.proyectos.id_group = boxtracker_01.miembros_grupo.fk_grupo WHERE boxtracker_01.proyectos.estado <> 5 and boxtracker_01.miembros_grupo.fk_usuario = %d ;",$id_creador);

			$result = $this->db->getData($query);

		   //El resultado se guarda en una variable y luego se hace una verificación. Si el resultado es mayor a 0 se crea un nuevo objeto proyecto y así retorna a la función principal o quien la llame.	

			if(!$result) {
				$respuesta =  new Respuesta(-1,'No se ha encontrado ningun proyecto de ese usuario.'); 
				return $respuesta;
			}else{
					$proyectos = [];
				for($i=0; $i< count($result);$i++){						
					array_push($proyectos, new Proyect($result[$i]['id_proyect'],$result[$i]['nombre'],$result[$i]['pais'],$result[$i]['ciudad'],$result[$i]['fecha_creacion'],$result[$i]['descripcion'],$result[$i]['id_group'],$result[$i]['id_creador'],$result[$i]['estado'],$result[$i]['imagen']));	
				}	
					$respuesta =  new Respuesta(1,$proyectos);
					return $respuesta;
			}				

		}

			public function Traer_tablero_proyectos($id_proyecto){
			$query = sprintf("SELECT boxtracker_01.tablero_proyectos.* FROM boxtracker_01.tablero_proyectos WHERE boxtracker_01.tablero_proyectos.id_proyecto= %d ;",$id_proyecto);

			$result = $this->db->getData($query);

			if(!$result) {
				$respuesta =  new Respuesta(-1,'No se ha encontrado ningun tablero asociado.'); 
				return $respuesta;
			}else{
					$tableros = [];
				for($i=0; $i< count($result);$i++){						
					array_push($tableros, new Tablero($result[$i]['id_tablero'],$result[$i]['id_proyecto'],$result[$i]['idusuario_creador'],$result[$i]['nombre_tablero'],$result[$i]['fecha_creacion'],$result[$i]['tipo_periodo'],$result[$i]['cant_periodos'],$result[$i]['paleta_color'],$result[$i]['tamanio'],$result[$i]['estado'],$result[$i]['visible']));	
				}	
					$respuesta =  new Respuesta(1,$tableros);
					return $respuesta;
			}				

			}
			public function AltaTablero($id_proyecto,$idusuario_creador,$nombre_tablero,$fecha_creacion,$tipo_periodo,$cant_periodos,$status,$visible){	

			$query = sprintf("INSERT INTO tablero_proyectos (id_proyecto,idusuario_creador,nombre_tablero,fecha_creacion,tipo_periodo,cant_periodos,paleta_color,tamanio,estado,visible) VALUES (%d,%d,'%s','%s','%s',%d,%d,%d,%d,%d)", $id_proyecto,$idusuario_creador,$nombre_tablero,$fecha_creacion,$tipo_periodo,$cant_periodos,0,0,$status,$visible);

			$result = $this->db->execute($query);
			$id_tablero = $this->db->lastid();
			//var_dump($status);

			if(count($result)>0){ //si la variable result es mayor a 0 significa que el proyecto fue creado y se da un aviso.
				$respuesta =  new Respuesta($id_tablero,'tablero creado correctamente');
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'Error, el tablero no se ha podido grabar');
					return $respuesta;
			}
		}	

		public function EditarTablero($id_tablero,$nombre_tablero,$tipo_periodo,$cant_periodos,$paleta_color,$tamanio,$estado,$visible){	
			$query = sprintf("UPDATE tablero_proyectos SET nombre_tablero = '%s',tipo_periodo = '%s',cant_periodos = %d,paleta_color = %d,tamanio = %d,estado = %d,visible = %d WHERE id_tablero = %d ;", $nombre_tablero,$tipo_periodo,$cant_periodos,$estado,$visible,$id_tablero);

			$result = $this->db->execute($query);

			if(count($result)>0){ //si la variable result es mayor a 0 significa que el proyecto fue editado y se da un aviso.
				$respuesta =  new Respuesta(1,'tablero editado con exito!');
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'Error, el tablero no se ha podido grabar');
					return $respuesta;
			}
		}	

		public function VerTablero($id_tablero){
			$query = sprintf("SELECT * FROM tablero_proyectos WHERE id_tablero = %d",$id_tablero);
			$result = $this->db->getData($query);
		//El resultado se guarda en una variable y luego se hace una verificación. Si el resultado es mayor a 0 se crea un nuevo objeto tablero y así retorna a la función principal o quien la llame.
				
			if(!$result) {

				$respuesta =  new Respuesta(-1,'No se ha encontrado el tablero'); 
				return $respuesta;
			}else{
					$tablero =  new Tablero($result[0]['id_tablero'],$result[0]['id_proyecto'],$result[0]['idusuario_creador'],$result[0]['nombre_tablero'],$result[0]['fecha_creacion'],$result[0]['tipo_periodo'],$result[0]['cant_periodos'],$result[0]['paleta_color'],$result[0]['tamanio'],$result[0]['estado'],$result[0]['visible']);

					$respuesta =  new Respuesta(1,$tablero);

					return $respuesta;
			}	
			
			}

			public function VerHerramienta($id_herramienta){
			$query = sprintf("SELECT * FROM herramientas_tablero WHERE idherramientas_tablero = %d",$id_herramienta);
			$result = $this->db->getData($query);
		//El resultado se guarda en una variable y luego se hace una verificación. Si el resultado es mayor a 0 se crea un nuevo objeto tablero y así retorna a la función principal o quien la llame.
				
			if(!$result) {

				$respuesta =  new Respuesta(-1,'No se ha encontrado ninguna herramienta'); 
				return $respuesta;
			}else{
	
					$herramienta = new stdClass();
					$herramienta->idherramientas_tablero = $result[0]['idherramientas_tablero'];
					$herramienta->nombre= $result[0]['nombre'];
					$herramienta->tamanio_red= $result[0]['tamanio_red'];
					$herramienta->tamanio_ext= $result[0]['tamanio_ext'];

					$respuesta =  new Respuesta(1,$herramienta);
					return $respuesta;
				}
			}
			
			public function ProyectosFinalizados($id_creador){
			$query = sprintf("SELECT boxtracker_01.proyectos.* FROM boxtracker_01.proyectos INNER join boxtracker_01.miembros_grupo ON boxtracker_01.proyectos.id_group = boxtracker_01.miembros_grupo.fk_grupo WHERE boxtracker_01.proyectos.estado = 5 and boxtracker_01.miembros_grupo.fk_usuario = %d ;",$id_creador);
			$result = $this->db->getData($query);

			if(!$result) {
				$respuesta =  new Respuesta(-1,'No se ha encontrado ningun proyecto de ese usuario.'); 
				return $respuesta;
			}else{
					$proyectos = [];
				for($i=0; $i< count($result);$i++){						
					array_push($proyectos, new Proyect($result[$i]['id_proyect'],$result[$i]['nombre'],$result[$i]['pais'],$result[$i]['ciudad'],$result[$i]['fecha_creacion'],$result[$i]['descripcion'],$result[$i]['id_group'],$result[$i]['id_creador'],$result[$i]['estado'],$result[$i]['imagen']));	
				}	
					$respuesta =  new Respuesta(1,$proyectos);
					return $respuesta;
			}	
			
			}

			public function VerConfig($id_tablero){
			$query = sprintf("SELECT * FROM boxtracker_01.ajustes_tablero where id_tablero = %d",$id_tablero);
			$result = $this->db->getData($query);

			if(!$result) {
				$respuesta =  new Respuesta(-1,'No se ha encontrado ningun proyecto de ese usuario.'); 
				return $respuesta;
			}else{
					$tableros = [];
				for($i=0; $i< count($result);$i++){		
					$tablero = new stdClass();		
					$tablero->id_tablero=$result[$i]['id_tablero'];
					$tablero->idajustes=$result[$i]['idajustes'];
					//$tablero->paleta_color=$result[$i]['paleta_color'];
					//$tablero->tamanio=$result[$i]['tamanio'];
					$tablero->id_herramienta=$result[$i]['id_herramienta'];
					$tablero->coor_x=$result[$i]['coor_x'];
					$tablero->coor_y=$result[$i]['coor_y'];
					$tablero->escritorio=$result[$i]['escritorio'];
					$tablero->nombre_herramienta=$result[$i]['nombre_herramienta'];

					array_push($tableros, $tablero);
				}	
					$respuesta =  new Respuesta(1,$tableros);
					return $respuesta;
			}	
			
			}


		// 		public function AltaConfig($id_tablero,$paleta_color,$tamanio,$id_herramienta,$coor_x,$coor_y,$escritorio,$nombre_herramienta){	
		// 	$query = sprintf("INSERT INTO ajustes_tablero (id_tablero,paleta_color,tamanio,id_herramienta,coor_x,coor_y,escritorio,nombre_herramienta) VALUES (%d,%d,%d,%d,%d,%d,%d,'%s')", $id_tablero,$paleta_color,$tamanio,$id_herramienta,$coor_x,$coor_y,$escritorio,$nombre_herramienta);

		// 	$result = $this->db->execute($query);
		// 	$id_tablero = $this->db->lastid();
		// 	//var_dump($result);
		// 	if(count($result)>0){ //si la variable result es mayor a 0 significa que el proyecto fue creado y se da un aviso.
		// 		$respuesta =  new Respuesta(1,'Configuracion guardada');
		// 		return $respuesta;
		// 	}else{
		// 			$respuesta =  new Respuesta(-1,'Error, Los ajustes no se han podido grabar');
		// 			return $respuesta;
		// 	}
		// }

			public function EditarConfig($id_tablero,$paleta_color,$tamanio,$coor_x,$coor_y,$escritorio,$nombre_herramienta){	
			$query = sprintf("UPDATE ajustes_tablero SET paleta_color = %d,tamanio = %d,coor_x = %d,coor_y = %d, nombre_herramienta = '%s' WHERE id_tablero = %d ;", $paleta_color,$tamanio,$coor_x,$coor_y,$nombre_herramienta,$id_tablero);

			$result = $this->db->execute($query);

			if(count($result)>0){ //si la variable result es mayor a 0 significa que el proyecto fue creado y se da un aviso.
				$respuesta =  new Respuesta(1,'Configuracion actualizada con exito!');
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'Error, los ajustes no se han podido grabar');
					return $respuesta;
			}
		}	

		public function TraerHerramientas(){
			$query = sprintf("SELECT * FROM boxtracker_01.herramientas_tablero");
			$result = $this->db->getData($query);

			if(!$result) {
				$respuesta =  new Respuesta(-1,'No se ha encontrado ninguna herramienta.'); 
				return $respuesta;

			}else{
					$herramientas = [];

				for($i=0; $i< count($result);$i++){			
					$herramienta = new stdClass();
					$herramienta->idherramientas_tablero = $result[$i]['idherramientas_tablero'];
					$herramienta->nombre= $result[$i]['nombre'];
					$herramienta->tamanio_red= $result[$i]['tamanio_red'];
					$herramienta->tamanio_ext= $result[$i]['tamanio_ext'];

					array_push($herramientas, $herramienta);
				}	

					$respuesta =  new Respuesta(1,$herramientas);
					return $respuesta;
			}

		}

		public function Traer_Plantillas($id_usuario){
			$query = sprintf("SELECT * FROM plantillas_usuarios WHERE id_user = %d",$id_usuario);
			$result = $this->db->getData($query);
		//El resultado se guarda en una variable y luego se hace una verificación. Si el resultado es mayor a 0 se crea un nuevo objeto tablero y así retorna a la función principal o quien la llame.
				
			if(!$result) {

				$respuesta =  new Respuesta(-1,'No se ha encontrado la plantilla especificada'); 
				return $respuesta;
			}else{
					$plantillas = [];

				for($i=0; $i< count($result);$i++){			
					$plantilla = new stdClass();
					$plantilla->idplantillas = $result[$i]['idplantillas'];
					$plantilla->id_usuario= $result[$i]['id_user'];
					$plantilla->nombre= $result[$i]['nombre'];
					$plantilla->fecha_creacion= $result[$i]['fecha_creacion'];
					$plantilla->idproyecto= $result[$i]['idproyecto'];

					array_push($plantillas, $plantilla);
				}	

					$respuesta =  new Respuesta(1,$plantillas);
					return $respuesta;
			}

			
		}

		public function Traer_Template($idconfig_plantilla){
			$query = sprintf("SELECT * FROM plantillas WHERE idconfig_plantilla = %d",$idconfig_plantilla);
			$result = $this->db->getData($query);
		//El resultado se guarda en una variable y luego se hace una verificación. Si el resultado es mayor a 0 se crea un nuevo objeto tablero y así retorna a la función principal o quien la llame.
				
			if(!$result) {

				$respuesta =  new Respuesta(-1,'No se ha encontrado la plantilla especificada'); 
				return $respuesta;
			}else{
					$plantillas = [];

				for($i=0; $i< count($result);$i++){			
					$plantilla = new stdClass();
					$plantilla->idconfig_plantilla = $result[$i]['idconfig_plantilla'];
					$plantilla->idplantillas= $result[$i]['idplantillas'];
					$plantilla->id_herramienta= $result[$i]['id_herramienta'];
					$plantilla->coor_x= $result[$i]['coor_x'];
					$plantilla->coor_y= $result[$i]['coor_y'];
					$plantilla->nombre_herramienta= $result[$i]['nombre_herramienta'];

					array_push($plantillas, $plantilla);
				}	

					$respuesta =  new Respuesta(1,$plantillas);
					return $respuesta;
			}
			
		}

		public function Traer_template_id($idplantillas){
			$query = sprintf("SELECT * FROM plantillas WHERE idplantillas = %d",$idplantillas);
			$result = $this->db->getData($query);
		//El resultado se guarda en una variable y luego se hace una verificación. Si el resultado es mayor a 0 se crea un nuevo objeto tablero y así retorna a la función principal o quien la llame.
				
			if(!$result) {

				$respuesta =  new Respuesta(-1,'No se han encontrado las plantillas especificadas'); 
				return $respuesta;
			}else{
					$templates = [];

				for($i=0; $i< count($result);$i++){			
					$plantilla = new stdClass();
					$plantilla->idplantillas = $result[$i]['idplantillas'];
					$plantilla->id_herramienta= $result[$i]['id_herramienta'];
					$plantilla->coor_x= $result[$i]['coor_x'];
					$plantilla->coor_y= $result[$i]['coor_y'];
					$plantilla->escritorio= $result[$i]['escritorio'];
					$plantilla->nombre_herramienta= $result[$i]['nombre_herramienta'];

					array_push($templates, $plantilla);
				}	

					$respuesta =  new Respuesta(1,$templates);
					return $respuesta;
			}

			
		}
		public function GuardarConfig($id_tablero,$paleta_color,$tamanio,$herramientas,$escritorio,$nombre_herramienta){	
			if (count($herramientas)>0) {
				foreach ($herramientas as $herramienta) {
					$id_herramienta=$herramienta['id'];
					$coor_x=$herramienta['x'];
					$coor_y=$herramienta['y'];
					$nombre_herramienta=$herramienta['i'];
					$query = sprintf("INSERT INTO ajustes_tablero (id_tablero,id_herramienta,coor_x,coor_y,escritorio,nombre_herramienta) VALUES (%d,%d,%d,%d,%d,'%s')", $id_tablero,$id_herramienta,$coor_x,$coor_y,$escritorio,$nombre_herramienta);

					$result = $this->db->execute($query);	
				}

				$query1 = sprintf("UPDATE tablero_proyectos SET paleta_color = %d, tamanio = %d WHERE id_tablero = %d ;", $id_tablero,$paleta_color,$tamanio);
				$result = $this->db->execute($query1);

			}
			
			if(count($herramientas)>0){ //si la variable result es mayor a 0 significa que el proyecto fue creado y se da un aviso.
				$respuesta =  new Respuesta(1,'Configuracion guardada');
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'Error, Los ajustes no se han podido grabar');
					return $respuesta;
			}
		}

		public function Guardar_Config_Plantilla($id_user,$nombre,$idproyecto,$herramientas){	
			$fecha_creacion=date('Y-m-d H:i:s');
			$query1 = sprintf("INSERT INTO plantillas_usuarios (id_user,nombre,fecha_creacion,idproyecto) VALUES (%d,'%s','%s',%d)", $id_user,$nombre,$fecha_creacion,$idproyecto);

					$result = $this->db->execute($query1);
					$idplantillas = $this->db->lastid();
					
					//var_dump($idplantillas);

			if (count($herramientas)>0) {
				foreach ($herramientas as $herramienta) {
					$id_herramienta=$herramienta['id'];
					$coor_x=$herramienta['x'];
					$coor_y=$herramienta['y'];
					$escritorio=1;
					$nombre_herramienta=$herramienta['i'];

					$query2 = sprintf("INSERT INTO plantillas (idplantillas,id_herramienta,coor_x,coor_y,escritorio,nombre_herramienta) VALUES (%d,%d,%d,%d,%d,'%s')", $idplantillas,$id_herramienta,$coor_x,$coor_y,$escritorio,$nombre_herramienta);

					$result2 = $this->db->execute($query2);	
					//var_dump($result2);
				}
			}
			
			if(count($result)>0){ //si la variable result es mayor a 0 significa que el proyecto fue creado y se da un aviso.
				$respuesta =  new Respuesta(1,'Plantilla guardada con éxito');
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'Error, Los ajustes no se han podido grabar');
					return $respuesta;
			}
		}

		public function Traer_color_tamanios(){
			$query = sprintf("SELECT * FROM boxtracker_01.colores_tablero");
			$result = $this->db->getData($query);

			$query2 = sprintf("SELECT * FROM boxtracker_01.tamanios_tableros");
			$result2 = $this->db->getData($query2);
			//var_dump($result2);
			if(!$result) {
				$rta =  new Respuesta(-1,'No se ha encontrado ningun color.'); 

			}else{
					$colores = [];

				for($i=0; $i< count($result);$i++){			
					$color = new stdClass();
					$color->idcolores_tablero = $result[$i]['idcolores_tablero'];
					$color->color1= $result[$i]['color1'];
					$color->color2= $result[$i]['color2'];
					$color->color3= $result[$i]['color3'];
					$color->color4= $result[$i]['color4'];
					$color->nombre= $result[$i]['nombre'];

					array_push($colores, $color);
				}	

					$rta["id_respuesta"]=1;
					$rta["mensaje"]["colores"]=$colores;
					
				}

			if(!$result2) {
				$rta =  new Respuesta(-1,'No se ha encontrado ningun tamanio.'); 
			}else{
				$tamanios = [];
				for($i=0; $i< count($result2);$i++){
					$tamanio = new stdClass();
					$tamanio->idtamanios_tableros = $result2[$i]['idtamanios_tableros'];
					$tamanio->descrip= $result2[$i]['descrip'];
					$tamanio->coor_x= $result2[$i]['coor_x'];
					$tamanio->coor_y= $result2[$i]['coor_y'];

					array_push($tamanios, $tamanio);
				}	

					$rta["mensaje"]["tamanios"]=$tamanios;
					
			}
			return $rta;
		}
}
	?>