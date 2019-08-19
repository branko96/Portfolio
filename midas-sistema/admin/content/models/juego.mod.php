<?php 
	
		
		/*	resultado del json
			{"check":{"3":"on","6":"on","9":"on","12":"on","15":"on","18":"on","21":"on","24":"on","27":"on","30":"on"},"campo":{"1":"100","2":"25","3":"PREMIO","4":"250","5":"10","6":"PREMIO","7":"50","8":"2","9":"PREMIO","10":"45","11":"70","12":"PREMIO","13":"20","14":"25","15":"PREMIO","16":"20","17":"150","18":"PREMIO","19":"5","20":"200","21":"PREMIO","22":"60","23":"10","24":"PREMIO","25":"30","26":"15","27":"PREMIO","28":"20","29":"40","30":"PREMIO"}}*/
				

			for ($i=1; $i <= 30; $i++) { 
				# code...
			 if($datosJson['campo'][$i] != ''){ //si campo tiene contenido texto o numero

				if(isset($datosJson['check'][$i])){
					$array[$i]="'text' : 'Premio', 'detalle':'".$datosJson['campo'][$i]."'";
				}else{
					$array[$i]="'text' : '".$datosJson['campo'][$i]."', 'detalle':'PUNTOS'";
				}

       }else{

        $array[$i]="'text' : '".$datosJson['campo'][$i]."', 'detalle':''";
       }
			
      }

				
	
		@$structure.="{'fillStyle' : '#eae56f', ".$array[1]." },
           {'fillStyle' : '#89f26e', ".$array[2]."},
           {'fillStyle' : '#7de6ef', ".$array[3]."},
           {'fillStyle' : '#e7706f', ".$array[4]."},
           {'fillStyle' : '#eae56f', ".$array[5]."},
           {'fillStyle' : '#89f26e', ".$array[6]."},
           {'fillStyle' : '#7de6ef', ".$array[7]."},
           {'fillStyle' : '#e7706f', ".$array[8]."},
           {'fillStyle' : '#eae56f', ".$array[9]."},
           {'fillStyle' : '#89f26e', ".$array[10]."},
           {'fillStyle' : '#7de6ef', ".$array[11]."},
           {'fillStyle' : '#e7706f', ".$array[12]."},
           {'fillStyle' : '#eae56f', ".$array[13]."},
           {'fillStyle' : '#89f26e', ".$array[14]."},
           {'fillStyle' : '#7de6ef', ".$array[15]."},
           {'fillStyle' : '#e7706f', ".$array[16]."},
           {'fillStyle' : '#eae56f', ".$array[17]."},
           {'fillStyle' : '#89f26e', ".$array[18]."},
           {'fillStyle' : '#7de6ef', ".$array[19]."},
           {'fillStyle' : '#e7706f', ".$array[20]."},
           {'fillStyle' : '#eae56f', ".$array[21]."},
           {'fillStyle' : '#89f26e', ".$array[22]."},
           {'fillStyle' : '#7de6ef', ".$array[23]."},
           {'fillStyle' : '#e7706f', ".$array[24]."},
           {'fillStyle' : '#eae56f', ".$array[25]."},
           {'fillStyle' : '#89f26e', ".$array[26]."},
           {'fillStyle' : '#7de6ef', ".$array[27]."},
           {'fillStyle' : '#e7706f', ".$array[28]."},
           {'fillStyle' : '#eae56f', ".$array[29]."},
           {'fillStyle' : '#89f26e', ".$array[30]."}";

           
?>