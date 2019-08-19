 <?php
    $users = PacientData::getAll();
    if (count($users)>0) {
        foreach ($users as $user){?>
            <tr>
                 <td><?php echo $user->nombre; ?></td>
                 <td><?php echo $user->apellido; ?></td>
                 <td><?php echo $user->email; ?></td>
                 <td><?php echo $user->telefono; ?></td>
                 <td><?php echo $user->dni; ?></td>
                 <td style="width:280px !important;">
                     <!--<a href="index.php?view=pacienthistory&id=<?php /*echo $user->id;*/?>" class="btn btn-default btn-xs">Historial</a>-->
                     <a href="index.php?view=editpacient&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
                     <a href="#" name="idEliminar" class="btn btn-danger btn-xs" onclick="ConfirmarEliminacion(<?php echo $user->id;?>)" >Eliminar</a>

                 </td>
            </tr>
            <?php
        }

    }
    ?>

