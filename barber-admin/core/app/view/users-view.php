<?php require_once('verificar_login.php'); ?>
<div class="row">
	<div class="col-md-12">

<div class="card">
  <div class="card-header" data-background-color="green">
      <h4 class="title">Usuarios</h4>
  </div>
  <div class="card-content table-responsive">


	<a href="index.php?view=newuser" class="btn btn-default"><i class='fa fa-user'></i> Nuevo Usuario</a>
<br>
		<?php
		/*
		$u = new UserData();
		print_r($u);
		$u->name = "Agustin";
		$u->lastname = "Ramos";
		$u->email = "evilnapsis@gmail.com";
		$u->password = sha1(md5("l00lapal00za"));
		$u->add();


		$f = $u->createForm();
		print_r($f);
		echo $f->label("name")." ".$f->render("name");
		*/
		?>
		<?php

		$users = UserData::getAll();
		if(count($users)>0){
			// si hay usuarios
			?>
			<table class="table table-bordered table-hover">
			<thead>
			<th>Nombre completo</th>
			<th>Email</th>
			<th>Activo</th>
			<th>Admin</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
				<td><?php echo $user->nombre." ".$user->apellido; ?></td>
				<td><?php echo $user->email; ?></td>
				<td>
					<?php if($user->es_activo):?>
						<i class="fa fa-check"></i>
					<?php endif; ?>
				</td>
				<td>
					<?php if($user->es_admin):?>
						<i class="fa fa-check"></i>
					<?php endif; ?>
				</td>
				<td style="width:30px;">
                    <a href="index.php?view=edituser&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
                    <a href="#" name="idEliminar" class="btn btn-danger btn-xs" onclick="ConfirmarEliminacion(<?php echo $user->id;?>)" >Eliminar</a>
                    </td>
                </tr>
				<?php

			}
			?>
			</table>
			<?php



		}else{
			// no hay usuarios
		}


		?>

</div>
</div>
	</div>
</div>


<script type="text/javascript">
    function ConfirmarEliminacion(id) {
        $.confirm({
            title: 'Eliminar!',
            content: 'Esta seguro que desea eliminar a este usuario?',
            buttons: {
                aceptar: function () {
                        $.ajax({
                            method: 'GET',
                            url: 'index.php?view=delusuario&id=' + id,
                            data: {},
                        });
                    window.location.assign('index.php?view=users');

                },
                cancelar: function () {
                },
            }
        });
    }
</script>