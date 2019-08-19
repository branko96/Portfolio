<?php

if(@$_SERVER['HTTPS']){
	$protocolo='https://';
}else{
	$protocolo='http://';
}

if($_SERVER['SERVER_NAME'] == 'localhost'){

	define('user', 'root');
	define('pass', '');
	define ('route',$protocolo.$_SERVER['SERVER_NAME'].'/midas-sistema/super');
}else{
	define('user', 'midasmkt');
	define('pass', 'MLChius3778');
	define ('route',$protocolo.$_SERVER['SERVER_NAME'].'/super');
}
define('server','localhost');
define('bd', 'midasmkt_bdd');


?>