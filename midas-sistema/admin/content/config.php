<?php

if(@$_SERVER['HTTPS']){
	$protocolo='https://';
}else{
	$protocolo='http://';
}

if($_SERVER['SERVER_NAME'] == 'localhost'){

	define('user', 'root');
	define('pass', '');
	define ('route',$protocolo.$_SERVER['SERVER_NAME'].'/midas-sistema/admin');
}else{
	define('user', 'midasmkt');
	define('pass', 'MLChius3778');
	define ('route',$protocolo.$_SERVER['SERVER_NAME'].'/admin');
}
define('server','localhost');
define('bd', 'midasmkt_bdd');


?>