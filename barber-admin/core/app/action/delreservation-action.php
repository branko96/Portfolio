<?php
/**
* BookMedik
* @author evilnapsis
**/
$user = ReservationData::getById($_GET["id"]);
var_dump($user);
$user->del();

print "<script>window.location='index.php?view=reservations';</script>";

?>