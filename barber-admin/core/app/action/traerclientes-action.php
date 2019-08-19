<?php

$cli=PacientData::getAll();




//var_dump($rta);

    foreach($cli as $p):

            echo '<option value="'.$p->id.'">'.$p->nombre.' '.$p->apellido.'</option>';

    endforeach;



?>