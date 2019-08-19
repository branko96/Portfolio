<?php require_once('verificar_login.php'); ?>
<div class="row">
	<div class="col-md-12">
        <div class="btn-group pull-right"></div>
<div class="card">
  <div class="card-header" data-background-color="blue">
      <h4 class="title">Servicios</h4>
  </div>
  <div class="card-content table-responsive">
	<a href="index.php?view=newcategory" class="btn btn-default"><i class='fa fa-th-list'></i> Nuevo Servicio</a>

		<?php

		$users = CategoryData::getAll();
		if(count($users)>0){
			// si hay usuarios
			?>

			<table class="table table-bordered table-hover">
			<thead>
			<th>Nombre</th>
            <th>Importe</th>
            <th>Duración</th>
            <th></th>

			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
				<td><?php echo $user->nombre; ?></td>
                 <td><?php echo $user->importe; ?></td>

                 <td><?php
                     if ($user->tiempo==1800){
                         echo "1/2 HORA";}
                     elseif ($user->tiempo==3600){
                         echo "1 HORA";
                     }?></td>
                    <td style="width:280px;">

<!--         <a href="index.php?view=editcategory&id=--><?php //echo $user->id;?><!--" rel="tooltip" title="Editar" class="btn btn-simple btn-warning btn-xs"><i class='fa fa-pencil'></i></a>-->
<!--         <a href="index.php?view=delcategory&id=--><?php //echo $user->id;?><!--" rel="tooltip" title="Eliminar" class=" btn-simple btn btn-danger btn-xs"><i class='fa fa-remove'></i></a>-->
              <a href="index.php?view=editcategory&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
              <a href="#" name="idEliminar" class="btn btn-danger btn-xs" onclick="ConfirmarEliminacion(<?php echo $user->id;?>)" >Eliminar</a>
                 </td>
				</tr>
				<?php

			}
?>
</table>
  </div>
</div>

<?php


		}else{
			echo "<p class='alert alert-danger'>No hay Categorias</p>";
		}


		?>


	</div>
</div>
<script type="text/javascript">
    function ConfirmarEliminacion(id) {
        $.confirm({
            title: 'Eliminar!',
            content: 'Esta seguro que desea eliminar este servicio?',
            buttons: {
                aceptar: function () {
                    $.ajax({
                        method: 'GET',
                        url: 'index.php?view=delcategory&id=' + id,
                        data: {},
                    });
                    window.location.assign('index.php?view=categories');

                },
                cancelar: function () {
                },
            }
        });
    }
</script>