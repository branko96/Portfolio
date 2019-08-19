<?php

$users2= array();
$sql = "select * from agenda where barbero_id =".$_SESSION["barbero"]." AND fecha=curdate()" ;

$users2 = ReservationData::getBySQL($sql);
//var_dump($users2);
$total=0;
foreach ($users2 as $user) {

    $total += $user->precio;
}


echo number_format($total,2,".",",");

