<?php require_once('verificar_login.php'); ?>
<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
<!--<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="report/clients-word.php">Word 2007 (.docx)</a></li>
  </ul>
</div>
-->
</div>
<div class="card">
  <div class="card-header" data-background-color="green">
      <h4 class="col-md-9">Clientes</h4>
      <button style="margin: auto; background: #426c9e;" id="nuevo_cliente" class="btn btn-default"><i class='fa fa-male'></i> Nuevo Cliente</button>
  </div>
  <div class="card-content table-responsive">

		<?php

		$users = PacientData::getAll();
		if(count($users)>0){
			// si hay usuarios
			?>

			<table id="table_id" class="display hover row-border compact cell-border">

			<thead style="background-color: #59B15D">

			<th>Nombre</th>
			<th>Apellido</th>
			<th>Email</th>
			<th>Telefono</th>
            <th>DNI</th>
			<th>Editar/Eliminar</th>
			</thead>
                <tbody id="contenido">
			<?php
			foreach($users as $user){
				?>

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
			?></tbody>
			</table>
			</div>
			</div>
			<?php



		}else{
			echo "<p class='alert alert-danger'>No hay Clientes</p>";
		}


		?>


	</div>
</div>
<div id="modal_nuevo_cliente" data-backdrop="false" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nuevo Cliente</h4>
            </div>
            <div class="modal-body">
                <div id="div_form_nuevo_cli"></div>
                <!-- BODY-->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function ConfirmarEliminacion(id) {
        $.confirm({
            title: 'Eliminar!',
            content: 'Esta seguro que desea eliminar a este cliente?',
            buttons: {
                aceptar: function () {
                    $.ajax({
                        method: 'GET',
                        url: 'index.php?view=delpacient&id=' + id,
                        data: {},
                    });
                    window.location.assign('index.php?view=pacients');
                },
                cancelar: function () {
                },
            }
        });
    }



</script>
<script>
    function nuevocli() {
        $("#form_nuevo_cliente").submit(function(e){
            e.preventDefault();
            e.stopImmediatePropagation ();
                    $.alert(respuesta);
                    $("#form_nuevo_cliente")[0].reset();
                    $("#modal_nuevo_cliente").modal("hide");
        });
    }


    $("#nuevo_cliente").click(function(e){
        e.preventDefault();
        e.stopImmediatePropagation ();
        $.ajax({
            method: 'GET',
            url: './?action=nuevoCliente',
            data: {},
            success: function (respuesta) {
                //console.log(respuesta);
                $("#div_form_nuevo_cli").html(respuesta);
                $("#modal_nuevo_cliente").modal('show');
                $('.main-panel').animate({
                    scrollTop: 90
                }, 800);
                cliente();

            },

        error: function () {
                console.log("No se ha podido obtener la información");
            }

        });

    });


$(document).ready( function () {
$('#table_id').DataTable({
      language:{
          "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar _MENU_ registros",
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "Ningún dato disponible en esta tabla",
          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix":    "",
          "sSearch":         "Buscar:",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
              "sFirst":    "Primero",
              "sLast":     "Último",
              "sNext":     "Siguiente",
              "sPrevious": "Anterior"
          },
          "oAria": {
              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }

      }
});

} );

function cliente() {
    $("#form_nuevo_cliente").submit(function (e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: './?action=addpacient&nombre=' + $("#name").val() + '&apellido=' + $("#lastname").val() + '&email=' + $("#email1").val() + '&telefono=' + $("#phone1").val() + '&dni=' + $("#dni").val(),
            data: {},
            success: function (respuesta) {
                $.alert(respuesta);

                $("#form_nuevo_cliente")[0].reset();
                $("#modal_nuevo_cliente").modal("hide");
                recargar_clientes();
            },

            error: function () {
                console.log("No se ha podido obtener la información");
            }

        });

    });

}

function recargar_clientes() {
    $.ajax({
        method:'POST',
        url: './?action=recargarClientes',
        data: {},
        success: function(respuesta) {
            console.log(respuesta);
                $("#contenido").html(respuesta);
        },
        error: function() {
            console.log("No se ha podido obtener la información aca");
        }
    });
}
</script>


<link rel="stylesheet" type="text/css" href="assets/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="assets/datatable/datatables.css">

<script type="text/javascript" src="assets/datatable/datatables.min.js"></script>
<script type="text/javascript" src="assets/datatable/datatables.js"></script>
