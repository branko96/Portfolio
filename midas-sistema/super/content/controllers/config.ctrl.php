<?php 
	
	
	if($_POST){

		require('content/models/saveconfig.mod.php');

		if($result_AP)
          {
       
         	require_once("content/views/sms_true.tpl.php");
         }
         else
         {
            require_once("content/views/sms_false.tpl.php");
         }  
		

	}else{


		require('content/models/config.mod.php');

		require('content/views/config.tpl.php');

		 
	}




 ?>