<?php require_once('verificar_login.php'); ?>
<div class="row">
	<div class="col-md-12">
<div class="card">
  <div class="card-header" data-background-color="blue">
      <h4 class="title">Nuevo Servicio</h4>
  </div>
  <div class="card-content table-responsive">

		<form class="form-horizontal" method="post" id="addcategory" action="index.php?view=addcategory" role="form">


            <div class="form-group">
                <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
                <div class="col-md-6">
                    <input type="text" name="nombre" required class="form-control" id="name" placeholder="Nombre">
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail1" class="col-lg-2 control-label">Importe*</label>
                <div class="col-md-6">
                    <input type="text" name="importe" required class="form-control" id="importe" placeholder="Importe">
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail1" class="col-lg-2 control-label">Duración*</label>
                <div class="col-md-6">

                    <select name="tiempo" id="tiempo"  class="form-control" required>
                        <option value=""  selected="" disabled="">-- SELECCIONE DURACIÓN --</option>

                            <option value="1800">1/2 HORA</option>
                        <option value="3600">1 HORA</option>

                    </select>
                </div>
            </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Servicio</button>
    </div>
  </div>
</form>
</div>
</div>
	</div>
</div>