<?php
require_once('verificar_login.php');

?>
<div class="row">
	<div class="col-md-12">
<div class="card">
  <div class="card-header" data-background-color="blue">
      <h4 class="title">Finanzas</h4>
  </div>
  <div class="card-content table-responsive">


<form class="form-horizontal" role="form">
<input type="hidden" name="view" value="reports">
        <?php
            $pacients = PacientData::getAll();
            $medics = MedicData::getAll();
            $statuses = StatusData::getAll();
            $payments = PaymentData::getAll();
        ?>

  <div class="form-group">

<!--    <div class="col-lg-3">-->
<!--		<div class="input-group">-->
<!--		  <span class="input-group-addon"><i class="fa fa-male"></i></span>-->
<!--            <select name="cliente_id" class="form-control">-->
<!--            <option value="">Cliente</option>-->
<!--              --><?php //foreach($pacients as $p):?>
<!--                <option value="--><?php //echo $p->id; ?><!--" --><?php //if(isset($_GET["cliente_id"]) && $_GET["cliente_id"]==$p->id){ echo "selected"; } ?><?php //echo $p->id." - ".$p->nombre." ".$p->apellido; ?><!--</option>-->
<!--              --><?php //endforeach; ?>
<!--            </select>-->
<!--		</div>-->
<!--    </div>-->
<!--      <div class="button dropdown">-->
<!--          <select id="selectreport" >-->
<!--              <option value="" selected="" disabled="">Seleccionar una opción</option>-->
<!--              <option value="barbero">Finanzas de hoy por Barbero</option>-->

<!--              <option value="semana">Finanzas de la semana</option>-->
<!--              <option value="mes">Finanzas del mes</option>-->
<!--              <option value="diaselegidos">Finanzas por días elegidos</option>-->
<!--          </select>-->
<!--      </div>-->

      <div class="button dropdown" >
<!--          <div id="barbero" class="col-lg-3" style="display: none; left: 25%;">-->
<!--              <div class="input-group" >-->
<!--                  <span class="input-group-addon"><i class="fa fa-user"></i></span>-->
                  <select id="selectreport" value="barbero" name="barbero_id" >
                      <option value="" selected="" disabled="">Seleccionar Barbero</option>-->

                      <?php foreach($medics as $p):?>
                          <option value="<?php echo $p->id; ?>" <?php if(isset($_GET["barbero_id"]) && $_GET["barbero_id"]==$p->id){ echo "selected"; } ?>><?php echo $p->id." - ".$p->nombre." ".$p->apellido; ?> </option>
                      <?php endforeach; ?>
                  </select>

<!--              </div>-->
<!--              </div>-->
          </div>
      <div class="input-group" style="width: 50%;top: 30px;left: 34%;">
      <input type="checkbox" name="choice-animals" id="choice-animals-dogs" style="margin: 4px 100px 0!important;">
      <label for="choice-animals-dogs" style="display: inline;margin: 2em 1em .25em -6.25em!important;">Elegir Fecha desde/hasta</label>

      <div class="reveal-if-active">
          <span class="input-group-addon" style="font-size:medium;">INICIO</span>
          <input style="font-size: medium;" type="date" name="start_at" value="<?php if(isset($_GET["start_at"]) && $_GET["start_at"]!=""){ echo $_GET["start_at"]; } ?>" class="form-control" placeholder="Palabra clave">
          <span class="input-group-addon" style="font-size: medium;">FIN</span>
          <input style="font-size: medium;" type="date" name="finish_at" value="<?php if(isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?>" class="form-control" placeholder="Palabra clave">
      </div>
      </div>

<!--      <div class="input-group" style="width: 50%;top: 30px;left: 25%;">-->
<!--         -->
<!--      </div>-->

<!--          <div id="dia" > </div>-->
<!--          <div id="semana" > </div>-->
<!--          <div id="mes" > </div>-->
<!--          <div id="diaselegidos" class="col-lg-3" style="display:none; left: 25%">-->
<!--              <div class="input-group">-->
<!--                  <span class="input-group-addon">INICIO</span>-->
<!--                  <input type="date" name="start_at" value="--><?php //if(isset($_GET["start_at"]) && $_GET["start_at"]!=""){ echo $_GET["start_at"]; } ?><!--" class="form-control" placeholder="Palabra clave">-->
<!--              </div>-->
<!--              <div class="input-group" >-->
<!--                  <span class="input-group-addon">FIN</span>-->
<!--                  <input type="date" name="finish_at" value="--><?php //if(isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?><!--" class="form-control" placeholder="Palabra clave">-->
<!--              </div>-->
<!---->
<!--          </div>-->

<!--          <div id="diaselegidos2" class="col-lg-3" style="display:none">-->
<!--              <div class="input-group">-->
<!--                  <span class="input-group-addon">FIN</span>-->
<!--                  <input type="date" name="finish_at" value="--><?php //if(isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?><!--" class="form-control" placeholder="Palabra clave">-->
<!--              </div>-->
<!--          </div>-->
<!--      </div>-->


<!--          <div class="col-lg-3">-->
<!--      		<div class="input-group">-->
<!--      		  <span class="input-group-addon"><i class="fa fa-male"></i></span>-->
<!--                  <select name="cliente_id" class="form-control">-->
<!--                  <option value="">Cliente</option>-->
<!--                    --><?php //foreach($pacients as $p):?>
<!--                      <option value="--><?php //echo $p->id; ?><!--" --><?php //if(isset($_GET["cliente_id"]) && $_GET["cliente_id"]==$p->id){ echo "selected"; } ?><?php //echo $p->id." - ".$p->nombre." ".$p->apellido; ?><!--</option>-->
<!--                    --><?php //endforeach; ?>
<!--                  </select>-->
<!--      		</div>-->
<!--          </div>-->
<!--    <div class="col-lg-3">-->
<!--		<div class="input-group">-->
<!--		  <span class="input-group-addon"><i class="fa fa-user"></i></span>-->
<!--            <select value="barbero" name="barbero_id" class="form-control">-->
<!--            <option value="">Barbero</option>-->
<!--              --><?php //foreach($medics as $p):?>
<!--                <option value="--><?php //echo $p->id; ?><!--" --><?php //if(isset($_GET["barbero_id"]) && $_GET["barbero_id"]==$p->id){ echo "selected"; } ?><?php //echo $p->id." - ".$p->nombre." ".$p->apellido; ?><!--</option>-->
<!--              --><?php //endforeach; ?>
<!--            </select>-->
<!--		</div>-->
<!--    </div>-->
<!--    <div class="col-lg-3">-->
<!--		<div class="input-group">-->
<!--		  <span class="input-group-addon">INICIO</span>-->
<!--		  <input type="date" name="start_at" value="--><?php //if(isset($_GET["start_at"]) && $_GET["start_at"]!=""){ echo $_GET["start_at"]; } ?><!--" class="form-control" placeholder="Palabra clave">-->
<!--		</div>-->
<!--    </div>-->
<!--    <div class="col-lg-3">-->
<!--		<div class="input-group">-->
<!--		  <span class="input-group-addon">FIN</span>-->
<!--		  <input type="date" name="finish_at" value="--><?php //if(isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?><!--" class="form-control" placeholder="Palabra clave">-->
<!--		</div>-->
<!--    </div>-->

  </div>
  <div class="form-group">
<!--    <div class="col-lg-3">-->
<!--		<div class="input-group">-->
<!--		  <span class="input-group-addon">ESTADO</span>-->
<!--            <select name="estado_id" class="form-control">-->
<!--              --><?php //foreach($statuses as $p):?>
<!--                <option value="--><?php //echo $p->id; ?><!--" --><?php //if(isset($_GET["estado_id"]) && $_GET["estado_id"]==$p->id){ echo "selected"; } ?><?php //echo $p->nombre; ?><!--</option>-->
<!--              --><?php //endforeach; ?>
<!--            </select>-->
<!--		</div>-->
<!--    </div>-->
<!--      -->
    <div class="col-lg-6">
    <button class="btn btn-primary btn-block" style="left: 50%;" >Procesar</button>
    </div>
  </div>
</form>

<?php
$users= array();




//if((isset($_GET["estado_id"]) && isset($_GET["estado_pago_id"]) && isset($_GET["cliente_id"]) && isset($_GET["barbero_id"]) && isset($_GET["start_at"]) && isset($_GET["finish_at"]) ) && ($_GET["estado_id"]!="" ||$_GET["estado_pago_id"]!="" || $_GET["cliente_id"]!="" || $_GET["barbero_id"]!="" || ($_GET["start_at"]!="" && $_GET["finish_at"]!="") ) ) {
//$sql = "select * from agenda where ";
//if($_GET["estado_id"]!=""){
//	$sql .= " estado_id = ".$_GET["estado_id"];
//}
//
//if($_GET["estado_pago_id"]!=""){
//if($_GET["estado_id"]!=""){
//	$sql .= " and ";
//}
//	$sql .= " estado_pago_id = ".$_GET["estado_pago_id"];
//}
//
//
//if($_GET["cliente_id"]!=""){
//if($_GET["estado_id"]!=""||$_GET["estado_pago_id"]!=""){
//	$sql .= " and ";
//}
//	$sql .= " cliente_id = ".$_GET["cliente_id"];
//}
//
//if($_GET["barbero_id"]!=""){
//if($_GET["estado_id"]!=""||$_GET["cliente_id"]!=""||$_GET["estado_pago_id"]!=""){
//	$sql .= " and ";
//}
//
//	$sql .= " barbero_id = ".$_GET["barbero_id"];
//}
//
//
//
//if($_GET["start_at"]!="" && $_GET["finish_at"]){
//if($_GET["estado_id"]!=""||$_GET["cliente_id"]!="" ||$_GET["barbero_id"]!="" ||$_GET["estado_pago_id"]!="" ){
//	$sql .= " and ";
//}
//
//	$sql .= " ( fecha >= \"".$_GET["start_at"]."\" and fecha <= \"".$_GET["finish_at"]."\" ) ";
//}

if((isset($_GET["barbero_id"])&& empty($_GET["start_at"]) && empty($_GET["finish_at"])   ) ) {


    $sql = "select * from agenda where barbero_id =".$_GET["barbero_id"]." AND fecha=curdate()" ;

		$users = ReservationData::getBySQL($sql);


}elseif (isset($_GET["start_at"]) && isset($_GET["finish_at"]) && isset($_GET["barbero_id"]))  {
    $sql = "select * from agenda where  ( fecha >= \"".$_GET["start_at"]."\" and fecha <= \"".$_GET["finish_at"]."\" and barbero_id=\"".$_GET["barbero_id"]."\" )";


    $users = ReservationData::getBySQL($sql);

}
//    $users = ReservationData::getAllPendings();

		if(count($users)>0){
			// si hay usuarios
			$_SESSION["report_data"] = $users;
			?>
			<div class="panel panel-default">
			<div class="panel-heading">
			Reportes</div>
			<table class="table table-bordered table-hover">
			<thead>
			<th>Cliente</th>
			<th>Barbero</th>
			<th>Fecha Turno</th>
			<th>Estado</th>
			<th>Estado Pago</th>
			<th>Costo</th>
			</thead>
			<?php
			$total = 0;
			foreach($users as $user){
				$pacient  = $user->getPacient();
                $medic = $user->getMedic();
               ?>
				<tr>

				<td><?php echo $pacient->nombre." ".$pacient->apellido; ?></td>
				<td><?php echo $medic->nombre." ".$medic->apellido; ?></td>
				<td><?php echo $user->fecha." ".$user->hora; ?></td>
				<td><?php echo $user->getStatus()->nombre; ?></td>
				<td><?php echo $user->getPayment()->estado; ?></td>
				<td>$ <?php echo number_format($user->precio,2,".",",");?></td>
				</tr>
				<?php
				$total += $user->precio;

			}
			echo "</table>";
			?>
			<div class="panel-body">
                <?php
                if((isset($_GET["barbero_id"])&&empty($_GET["start_at"]) && empty($_GET["finish_at"])   ) ) {
                   echo'<h1>Ganancias de Hoy: $'.number_format($total,2,".",",").'</h1>';
                }else{
                    echo'<h1>Total: $'.number_format($total,2,".",",").'</h1>';
                }
                ?>
<!--			<h1>Total: $ --><?php //echo number_format($total,2,".",",");?><!--</h1>-->
<!--			<a href="./report/report-word.php" class="btn btn-default"><i class="fa fa-download"> Descargar (.docx)</i></a>-->
			</div>
			<?php
		}elseif((isset($_GET["barbero_id"])  ) ) {
			echo "<p class='alert alert-danger'>NO SE ENCONTRARON RESULTADOS!</p>";
		}
		?>
	</div>
</div>
	</div>
</div>
    <link rel="stylesheet" type="text/css" href="core/app/view/selectreport/selectreport.min.css">
    <script src="core/app/view/selectreport/selectreport.min.js"></script>
<style>

    input[type="radio"]:checked ~ .reveal-if-active,
    input[type="checkbox"]:checked ~ .reveal-if-active {
        opacity: 1;
        max-height: 100px; /* little bit of a magic number :( */
        overflow: visible;
        width: 50%;
    }
    .reveal-if-active {
        opacity: 0;
        max-height: 0;
        overflow: hidden;
        transform: scale(0.9);

    label {
        display: block;
        margin: 0 0 3px 0;
    }
    input[type="checkbox"]:checked ~  {
        opacity: 1;
        max-height: 100px;
        overflow: visible;
        padding: 10px 20px;
        transform: scale(1);
    }
    }
    </style>


