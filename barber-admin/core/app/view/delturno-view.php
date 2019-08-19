<?php

$turno = ReservationData::getById($_GET["id"]);
$turno->del();
//Core::redir("./index.php?view=home");

?>