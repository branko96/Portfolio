<?php
$reservation = ReservationData::getById($_GET["id"]);
//var_dump($reservation);
?>

<form class="form-horizontal" id="form_cancelar_inactividad" role="form" method="post">
    <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label">Fecha</label>
        <div class="col-lg-4">
            <p name="fecha" required class="form-control" placeholder="Fecha"><?php echo $reservation->fecha." ".$reservation->hora; ?></p>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md">
            <input type="hidden" name="id" id="id2" value="<?php echo $reservation->id; ?>">
            <button type="button" class="btn btn-default" style="background: red; " onclick="EliminarInactivo(<?php echo $reservation->id;?>)">Eliminar</button>
            <button type="submit" class="btn btn-default" style="background: #8eb19d">Cancelar</button>
        </div>
    </div>
</form>

<script type="text/javascript">
    function EliminarInactivo(id) {
        $.confirm({
            title: 'Eliminar!',
            content: '¿Esta seguro que desea eliminar el periodo de inactividad?',
            buttons: {
                aceptar: function () {
                    $.ajax({
                        method: 'GET',
                        url: 'index.php?action=delreservation&id=' + id,
                        data: {},
                    });
                    $("#form_cancelar_inactividad")[0].reset();
                    $("#modal_eliminar_inactividad").modal("hide");
                    recargar_calendario()

                },
                cancelar: function () {
                },
            }
        });
    }
    function recargar_calendario(){
        $.ajax({
            method:'POST',
            //url: './?action=traerEventos&barbero_id='+$("#barbero_elegido").val(),
            url: './?action=traerEventos',
            data: {},
            dataType:'json',
            success: function(respuesta) {
                // console.log(respuesta);
                if (respuesta.length >0) {
                    $("#calendar").fullCalendar('removeEvents');
                    $("#calendar").fullCalendar('addEventSource', respuesta, true);
                }
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }
        });
        //
    }



</script>