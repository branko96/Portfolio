<?php 
  require_once("content/database.php");
	
  $url= (isset ($_GET['url'])) ? $_GET['url'] : "";
  
  $url=explode("/",$url);

  if (isset($url[0])){$controller=$url[0];} 
  if (isset($url[1])){$model=$url[1];}
  if (isset($url[2])){$params=$url[2];}


  if(!empty($_POST))
	{
		@$action=$_POST['action'];
		switch ($action) {
			case 'A':
				 require_once("content/models/altaSocio.mod.php");
				 if($result_A <> NULL){
            if($result_A){ // si es TRUE
         	    require_once("content/views/sms_true.tpl.php");
             
            }else{ //SI ES FALSE
              require_once("content/views/sms_false.tpl.php");
            }
         }else{
          require_once("content/views/sms_validacion.tpl.php");
         }  
				break;

			// case 'B':
			// 	 require_once("content/models/bajaSocio.mod.php");
			// 	 if($result_B)
   //         {
   //         	 require_once("content/views/sms_true.tpl.php");
   //         }
   //         else
   //         {
   //            require_once("content/views/sms_false.tpl.php");
   //         }  
			// 	break;	

      case 'GS'://guardar cambios del socio
         require_once("content/models/modificarSocio.mod.php");
         if($result_GS)
           {
           	 require_once("content/views/sms_true.tpl.php");
           }
           else
           {
              require_once("content/views/sms_false.tpl.php");
           }  
      break;

      case 'AP': //alta Premio
        require_once("content/models/altaPremio.mod.php");
         if($result_AP)
         {
         	 require_once("content/views/sms_true.tpl.php");
         	
         }
         else
         {
            require_once("content/views/sms_false.tpl.php");
         }  
			break; 

			case 'BP': //baja Premio
        require_once("content/models/bajaPremio.mod.php");

        if($result_BP)
         {
       
         	 require_once("content/views/sms_true.tpl.php");
         }
         else
         {
            require_once("content/views/sms_false.tpl.php");
         }  
			break;

	    case'MP': 
	      require_once("content/views/editarPremio.tpl.php");
	    break; 

		  case 'GP': //baja Premio
        require_once("content/models/modificarPremio.mod.php");

        if($result_GP)
         {
       
         	 require_once("content/views/sms_true.tpl.php");
         }
         else
         {
            require_once("content/views/sms_false.tpl.php");
         }  
      break;

      case 'canje': //llama a canje
        require_once("content/models/opciones_canje.mod.php");
        require_once("content/views/altaCanje.tpl.php");  
      break;

      case 'AC':  //cuarda el canje
        require_once("content/models/altaCanje.mod.php"); 
        if($result_AC)
          {
       
         	 require_once("content/views/sms_true.tpl.php");
         }
         else
         {
            require_once("content/views/sms_false.tpl.php");
         }  
      break;
            case 'addCompra': //compras

              require_once("content/models/compras.mod.php");
              
              if($_SESSION['login']['categorizarSocio'] == 'herencia'){

                $herencia = json_decode($_SESSION['login']['herencia']);
                $length = count($herencia);
                //[5,3,1]
                for ($i = 1; $i < $length; $i++) {

                  if(($herencia[$i] != '') && ($idRecomendante != 0)){ //si hay un valor puesto en el campo de los niveles 1 o 2
                    echo "herencia ".$herencia[$i];
                    echo "ID RECOMENDANTE ".$idRecomendante."</BR>";

                    $puntosXinput=$herencia[$i];
                    require('content/models/recomendante.mod.php');
   
                    require("content/models/compras.mod.php");
                  }

                }              
              }

             if($ingresar_compra) 
              {
                require_once("content/views/sms_true.tpl.php");
               }
               else
               {   
                require_once("content/views/sms_false.tpl.php");
               }  
            break;     
			default:
				//pongo aca porque cuando mando algo por POST con la nueva estructura, es evaluado por la parte vieja que hizo diego.
        //de esta forma pasa de largo y evalua el controlador dado por GET y los nuevos datos via post.
        if(!empty($url[0])){

            $path='content/controllers/'.$controller.'.ctrl.php';

            if(file_exists($path)){
              require $path;
            }

          }else{
          //llamo a la vista por default compras
            require_once("content/views/compras.tpl.php");

          }


				break;
		}
	}
	else
	{
		
			switch (@$_GET['opc']) {
				//vistas de formulario
        case 'altaSocio':
          require_once("content/views/altaSocio.tpl.php");
          break;
				case 'bajaSocio':
					require_once("content/views/bajaSocio.tpl.php");
					break;
				case 'modificarSocio':
					require_once("content/views/modificarSocio.tpl.php");
					break;

				case'altaPremio':	
				   require_once("content/views/altaPremio.tpl.php");
				   break;
				case'bajaPremio':	
				   require_once("content/views/bajaPremio.tpl.php");
				   break;  
				case'modificarPremio':	
				   require_once("content/views/modificarPremio.tpl.php");
				   break;    
				case'canje':
				   require_once("content/views/canje.tpl.php");
				   break; 
        case 'compra':
            require_once("content/views/compras.tpl.php");
            break;        
				default:
					
          if(!empty($url[0])){

            $path='content/controllers/'.$controller.'.ctrl.php';

            if(file_exists($path)){
              require $path;
            }

          }else{
          //llamo a la vista por default compras
            require_once("content/views/compras.tpl.php");

          }
	              
					break;
			}
	
	
	}

  if(@$GLOBALS['error']) var_dump($GLOBALS['error']);
  
 ?>