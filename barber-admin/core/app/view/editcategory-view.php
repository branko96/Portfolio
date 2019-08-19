<?php require_once('verificar_login.php'); ?>
<?php $user = CategoryData::getById($_GET["id"]);
?>
<div class="row">
	<div class="col-md-12">
<div class="card">
  <div class="card-header" data-background-color="blue">
      <h4 class="title">Editar Servicio</h4>
  </div>
  <div class="card-content table-responsive">


		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updatecategory" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="nombre" required value="<?php echo $user->nombre;?>" class="form-control" id="nombre" placeholder="Nombre">
    </div>
  </div>

            <div class="form-group">
                <label for="inputEmail1" class="col-lg-2 control-label">Importe*</label>
                <div class="col-md-6">
                    <input type="text" required name="importe" value="<?php echo $user->importe;?>" class="form-control" id="importe" placeholder="importe">
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail1" class="col-lg-2 control-label">Duración*</label>
                <div class="col-md-6">

                    <select name="tiempo" id="tiempo"  class="form-control" required>
                        <?php if ($user->tiempo==1800){
                            echo '<option value="1800" selected>1/2 HORA</option>
                                  <option value="3600" >1 HORA</option>';
                        }elseif ($user->tiempo==3600){
                            echo '<option value="3600" selected>1 HORA</option>
                                   <option value="1800" >1/2 HORA</option>';
                        } ?>

<!--                        <option value="1800" selected="">1/2 HORA</option>-->
<!--                        <option value="3600">1 HORA</option>-->

                    </select>
                </div>
            </div>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-primary">Actualizar Servicio</button>
    </div>
  </div>
</form>
</div>
</div>
	</div>
</div>