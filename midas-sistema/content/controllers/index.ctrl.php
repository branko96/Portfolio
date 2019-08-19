 <?php 
  require_once("../admin/content/database.php");
  $db=new database();
  $db->conectar();

	$sql="SELECT * FROM em_club cl LEFT JOIN em_config cf on cf.club=cl.idclub WHERE subdominio ='$subdominio'";
  $datos_club=$db->queryList($sql);

  $idClub=$datos_club[0]['idclub'];

  $url= (isset ($_GET['url'])) ? $_GET['url'] : "";
  $url=explode("/",$url);


 if (isset($url[0])){$controller=$url[0];}
 if (isset($url[1])){$model=$url[1];}
 if (isset($url[2])){$params=$url[2];}

  			
  if(!empty($url[0])){

    $path='../content/controllers/'.$controller.'.ctrl.php';

    if(file_exists($path)){
      require $path;
    }

  }else{
 
    
    require_once("../content/models/premios.mod.php");
    require_once("../content/views/index.tpl.php");

  }
          	
	

  if(@$GLOBALS['error']) var_dump($GLOBALS['error']);
  
 ?>
