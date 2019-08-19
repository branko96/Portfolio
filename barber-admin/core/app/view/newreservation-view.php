<?php
$pacients = PacientData::getAll();
$medics = MedicData::getAll();

$statuses = StatusData::getAll();
$payments = PaymentData::getAll();
$servicio = CategoryData::getAll();
?>

<div class="row">
<div class=" col-md-12">
    <div class="card">
        <div class="card-header" style="font-size: large" data-background-color="blue">Nuevo Turno</div>

<form class="form-horizontal" role="form" method="post" action="./?action=addreservation">
  <!-- <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Asunto</label>
    <div class="col-lg-10">
      <input type="text" name="title" required class="form-control" id="inputEmail1" placeholder="Asunto">
    </div>
  </div> -->
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Cliente</label>
    <div class="col-lg-8">
<select name="cliente_id" class="form-control" required>
<option value="">-- SELECCIONE --</option>
  <?php foreach($pacients as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->id." - ".$p->nombre." ".$p->apellido; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Barbero</label>
    <div class="col-lg-8">
<select name="barbero_id" class="form-control" required>
<option value="">-- SELECCIONE --</option>
  <?php foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->id." - ".$p->nombre." ".$p->apellido; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1 "  class="col-lg-2 control-label" >Fecha/Hora</label>
    <div class="col-lg-4">
      <input type="date"  name="date_at" required class="form-control" id="inputEmail1" placeholder="Fecha">
    </div>
    <div class="col-lg-4">
      <input type="time"  name="time_at" required class="form-control" id="inputEmail1" placeholder="Hora">
    </div>
  </div>
   <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nota</label>
    <div class="col-lg-8">
    <textarea class="form-control" name="notas" placeholder="Nota"></textarea>
    </div>
  </div>
    <div class="form-group">
        <label for="inputEmail1" class="col-lg-2 control-label">Servicio</label>
        <div class="col-lg-8">
            <select name="servicio_id" class="form-control" required>
                <option value="">-- SELECCIONE --</option>
                <?php foreach($servicio as $p):?>
                    <option value="<?php echo $p->id; ?>" <?php if($p->id==$reservation->servicio_id){ echo "selected"; }?>><?php echo $p->nombre; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <!-- <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Enfermedad</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="sick" placeholder="Enfermedad"></textarea>
    </div>
  </div> -->
      <!-- <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Sintomas</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="symtoms" placeholder="Sintomas"></textarea>
    </div>
  </div> -->
        <!-- <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Medicamentos</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="medicaments" placeholder="Medicamentos"></textarea>
    </div>
  </div> -->
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Estado del turno</label>
    <div class="col-lg-8">
<select name="estado_id" class="form-control" required>
  <?php foreach($statuses as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->nombre; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
   <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Estado del pago</label>
    <div class="col-lg-8">
<select name="estado_pago_id" class="form-control" required>
  <?php foreach($payments as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->estado; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div> 


  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-8">
      <button type="submit" class="btn btn-default">Agregar Turno</button>
    </div>
  </div>
</form>

    </div>
</div>
</div>