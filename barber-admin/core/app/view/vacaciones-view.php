<?php
    require_once('verificar_login.php');
$medics = MedicData::getAll();

?>
<link rel="stylesheet" type="text/css" href="core/app/view/select2/select2.min.css">
<link rel="stylesheet" href="assets/jquery-confirm/jquery-confirm.min.css">
<script src="assets/js/jquery.min.js" type="text/javascript"></script>

<script src="assets/jquery-confirm/jquery-confirm.min.js" type="text/javascript"></script>
<script src="core/app/view/select2/select2.min.js"></script>

<div class="row">
    <div class="col-md-12">

<div class="card">
    <div class="card-header" data-background-color="">
        <h4 class="title">Vacaciones</h4>
    </div>
    <div class="card-content table-responsive">
        <form action="">
            <div class="row">
                <div class="col-md-8">
                    <label for="fname">Barbero</label>
                </div>
                <div class="col-md-8">
                    <select style="width: 50%;" name="barbero_elegido" id="barbero_elegido" class="col-md-8" required>
                        <?php foreach($medics as $p):?>
                            <option value="<?php echo $p->id; ?>"<?php if($p->id==$_SESSION["id_barbero_us"]){ echo "selected"; }?>><?php echo $p->nombre." ".$p->apellido; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
                <!--<input  type="submit" name="button" id="button" value="Cargar Calendario">-->
            <div class="row">
                <div class="col-md-8">
                    <label for="fname">Fecha Inicio</label>
                </div>
                <div class="col-md-8">
                    <input type="date" id="fecha_inicio" name="firstname" >
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <label for="lname">Fecha Final</label>
                </div>
                <div class="col-md-8">
                    <input type="date" id="end_fecha" name="lastname">
                </div>
            </div>
            <div class="col-lg-offset-3 col-lg-8">
                <button type="button" id="agregar" class="btn btn-default">Guardar</button>
            </div>
        </form>
    </div>
</div>
    </div>
</div>




<script type="text/javascript">
    $("#agregar").click(function(e){
        e.preventDefault();
            $.ajax({
                method: 'POST',
                url: './?action=agregarVacaciones&notas=&fecha=' + $("#fecha_inicio").val() + '&endfecha=' + $("#end_fecha").val() + '&barbero_id='+ $("#barbero_elegido").val() +'&hora=10:30&hora_fin=20:00&cliente_id=0&servicio_id=1&estado_pago_id=1&estado_id=1',
                data: {},
                success: function (respuesta) {
                    $.alert(respuesta);
                },
                error: function () {
                    console.log("No se ha podido obtener la información");
                }
            });
    });
    function vacaciones_disponible(){
        $.ajax({
            method:'GET',
            url: './?action=vacacionesDisponibilidad&fecha='+$("#fecha_inicio").val()+'&hora='+$("#hora_ini").val(),
            data: {},
            success: function(respuesta) {
                //$.alert(respuesta);
                if (respuesta.length>0) {
                    agregar();
                }else{
                    $.alert("No se pudo agregar las vacaciones ya que se encuentran turnos o vacaciones registrados en este periodo!");
                }
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }
        });
    }

</script>

<style>

    .card [data-background-color] {
        color: #FFFFFF;
    }
    .card [data-background-color=""] {
        background: linear-gradient(60deg, #5d82d4, #15779c);
        box-shadow: 0 12px 20px -10px rgba(76, 175, 80, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(76, 175, 80, 0.2);
     }
    input{
        width: 50%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        resize: vertical;
        margin-left: 20px;
    }

    select,option{
        width: 50%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        resize: vertical;
        margin-left: 20px;
    }




    /* Style the label to display next to the inputs */
    label {
        padding: 12px 12px 12px 0;
        display: inline-block;
    }

    /* Style the submit button */
    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
    }

    select[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
    }


    /* Floating column for labels: 25% width */
    .col-md-8, .col-md-4 {
        float: left;
        width: 25%;
        margin-top: 2px;
    }



    /* Floating column for inputs: 75% width */
    .col-md-8 , .col-md-4{
        float: left;
        width: 75%;
        margin-top: 6px;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {
        .col-md-8, .col-md-8, input[type=submit],select {
            width: 100%;
            margin-top: 0;
        }
    }

</style>