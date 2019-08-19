<?php
require_once('../../conexion.php');
require_once('../../consultas.php');
$consultas=new consultas();
$nombre_club=$_POST['nombre_club'];
$subdominio=$_POST['subdominio'];

$res=$consultas->crear_club($nombre_club,$subdominio);
$user=$_POST['nombre_usuario'];
$pass=$_POST['contrauser'];
$color=$_POST['color_panel'];
$nombrelogo=$_POST['logoo'];
if($res != false && isset($user) && isset($pass)){
			$id_club=$res;
			
			$estado=1;
			$res2=$consultas->insertar_user_club($user,$pass, $id_club, $estado);
			
			$res3=$consultas->insertar_pref_club($id_club, $color,$nombrelogo);
			

			$nombre_carpeta = "../../../../".$subdominio; 
			$fuente = "../../../../para_copiar"; 

				if(!is_dir($nombre_carpeta)){ 
				@mkdir($nombre_carpeta, 0700); 
				copiar($fuente, $nombre_carpeta);
				}else{ 
				echo "Ya existe ese directorio\n"; 
				} 
			
			header("Location: ../../../index.php?a=2");
}

function copiar($fuente, $destino)
{
    if(is_dir($fuente))
    {
        $dir=opendir($fuente);
        while($archivo=readdir($dir))
        {
            if($archivo!="." && $archivo!="..")
            {
                if(is_dir($fuente."/".$archivo))
                {
                    if(!is_dir($destino."/".$archivo))
                    {
                        mkdir($destino."/".$archivo);
                    }
                    copiar($fuente."/".$archivo, $destino."/".$archivo);
                }
                else
                {
                    copy($fuente."/".$archivo, $destino."/".$archivo);
                }
            }
        }
        closedir($dir);
    }
    else
    {
        copy($fuente, $destino);
    }
}
?>