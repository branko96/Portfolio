<?php 
$reservation = ReservationData::getById($_GET["id"]);
$pacients = PacientData::getAll();
$medics = MedicData::getAll();
$statuses = StatusData::getAll();
$payments = PaymentData::getAll();
$servicio = CategoryData::getAll();
include_once "/../layouts/layout.php";
?>

<link rel="stylesheet" type="text/css" href="core/app/view/select2/select2.min.css">
<script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script src="core/app/view/select2/select2.min.js"></script>



<div class="row">
    <div class="col-md-12">
      <div class="card">
          <div class="card-header" data-background-color="blue">
              <h4 class="title">Modificar Turno</h4>
          </div>
        <div class="card-content table-responsive">
            <form class="form-horizontal" role="form" method="post" action="./?action=updatereservation">

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
                        <p id="BuscarBarbero" name="barbero_id"  required class="form-control"
                            <?php foreach($medics as $p):?>
                                <?php if($p->id==$reservation->barbero_id){?>><?php echo $p->nombre." ".$p->apellido; }?>
                            <?php endforeach; ?>
                        </p>
                    </div>
              </div>

              <div class="form-group">
                <label for="inputEmail1" class="col-lg-2 control-label">Fecha</label>
                    <div class="col-lg-4">
                        <p  name="fecha"  required class="form-control" id="fecha" placeholder="Fecha"><?php echo $reservation->fecha; ?></p>
                    </div>
                  <label for="inputEmail1" class="col-lg-2 control-label">Hora</label>
                  <div class="col-lg-4">
                        <p  name="hora" required class="form-control" id="hora" placeholder="Hora" ><?php echo $reservation->hora; ?></p>
                    </div>
              </div>
              <div class="form-group">
                <label for="inputEmail1" class="col-lg-2 control-label">Nota</label>
                    <div class="col-lg-4">
                        <textarea class="form-control" name="notas" placeholder="Nota"><?php echo $reservation->notas;?></textarea>
                    </div>
              </div>

              <div class="form-group">
                 <label for="inputEmail1" class="col-lg-2 control-label">Estado del pago</label>
                      <div class="col-lg-4">
                        <select name="estado_pago_id" class="form-control" required>
                          <?php foreach($payments as $p):?>
                            <option value="<?php echo $p->id; ?>" <?php if($p->id==$reservation->estado_pago_id){ echo "selected"; }?>><?php echo $p->estado; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
              </div>
              <div class="form-group">
                <label for="inputEmail1" class="col-lg-2 control-label">Servicio</label>
                <div class="col-lg-4">
                    <select name="servicio_id" class="form-control" required>
                        <?php foreach($servicio as $p):?>
                            <option value="<?php echo $p->id; ?>" <?php if($p->id==$reservation->servicio_id){ echo "selected"; }?>><?php echo $p->nombre; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
              </div>
              <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-4">
                      <input type="hidden" name="id" value="<?php echo $reservation->id; ?>">
                         <button type="submit" class="btn btn-default">Actualizar Turno</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
