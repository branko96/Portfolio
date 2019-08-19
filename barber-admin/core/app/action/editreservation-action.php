<?php
$reservation = ReservationData::getById($_GET["id"]);
$pacients = PacientData::getAll();
$medics = MedicData::getAll();
$statuses = StatusData::getAll();
$payments = PaymentData::getAll();
$servicio = CategoryData::getAll();
?>



<form class="form-horizontal" id="form_editar_turno" role="form" method="post" action="./?action=updatereservation">
    <input type="hidden" id="cliente_id2" value="<?php echo $reservation->cliente_id;?>">
    <input type="hidden" id="fecha2" value="<?php echo $reservation->fecha;?>">
    <input type="hidden" id="hora2" value="<?php echo $reservation->hora;?>">
    <input type="hidden" id="servicio_id3" value="<?php echo $reservation->servicio_id;?>">
    <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label">Cliente</label>
        <div class="col-lg-4">
            <p id="Buscar" name="cliente_id" style="width: 100%" class="form-control"
                <?php foreach($pacients as $p):?>
                <?php if($p->id==$reservation->cliente_id){?>><?php echo $p->nombre." ".$p->apellido; }?>
                <?php endforeach; ?>
            </p>
        </div>
        <label for="inputEmail1" class="col-lg-2 control-label">Barbero</label>
        <div class="col-lg-4">
            <p id="BuscarBarbero" name="barbero_id" required class="form-control"
                <?php foreach($medics as $p):?>
                <?php if($p->id==$reservation->barbero_id){?>><?php echo $p->nombre." ".$p->apellido; }?>
                <?php endforeach; ?>
            </p>
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label">Fecha</label>
        <div class="col-lg-4">
            <p name="fecha" required class="form-control" placeholder="Fecha"><?php echo $reservation->fecha; ?></p>
        </div>
        <label for="inputEmail1" class="col-lg-2 control-label">Hora</label>
        <div class="col-lg-4">
            <p name="hora" required class="form-control" placeholder="Hora" ><?php echo $reservation->hora; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label">Nota</label>
        <div class="col-lg-4">
            <textarea class="form-control" name="notas" id="notas2" placeholder="Nota"><?php echo $reservation->notas;?></textarea>
        </div>
        <label for="inputEmail1" class="col-lg-2 control-label">Precio Cobrado</label>
        <div class="col-lg-4">
            <input class="form-control" name="precio" id="precio" value="<?php echo $reservation->precio; ?>" placeholder="$" >
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label">Estado del pago</label>
        <div class="col-lg-4">
            <select name="estado_pago_id" id="estado_pago_id2" class="form-control" required>
                <?php foreach($payments as $p):?>
                    <option value="<?php echo $p->id; ?>" <?php if($p->id==$reservation->estado_pago_id){ echo "selected"; }?>><?php echo $p->estado; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <label for="inputEmail1" class="col-lg-2 control-label">Forma de Pago</label>
        <div class="col-lg-4">
            <input class="formapago" <?php if ($reservation->forma_pago=="tarjeta"){echo'checked';} ?> value="tarjeta" name="forma_pago"  type="radio" > Tarjeta <br>
            <input class="formapago" <?php if ($reservation->forma_pago=="efectivo"){echo'checked';}?> value="efectivo" name="forma_pago"  type="radio"> Efectivo<br>

        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label">Servicio</label>
        <div class="col-lg-4">
            <select name="servicio_id" id="servicio_id2" class="form-control" required>

            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-6">
            <input  type="hidden" name="id" id="id2" value="<?php echo $reservation->id; ?>">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-default" style="background: mediumseagreen;width: 100%;">Actualizar Turno</button>
            </div>
            <div class="col-sm-6">
                <button type="button" class="btn btn-default" style="background: red; width: 100%;" onclick="EliminarTurno(<?php echo $reservation->id;?>)">Eliminar</button>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    function EliminarTurno(id) {
        $.confirm({
            title: 'Eliminar!',
            content: '¿Esta seguro que desea eliminar el turno?',
            buttons: {
                aceptar: function () {
                    $.ajax({
                        method: 'GET',
                        url: 'index.php?action=delreservation&id=' + id,
                        data: {},
                    });
                    $("#form_editar_turno")[0].reset();
                    $("#modal_editar_turno").modal("hide");
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