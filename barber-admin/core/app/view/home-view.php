<?php
//$tz_object = new DateTimeZone('America/Argentina/Buenos_Aires');
//date_default_timezone_set('Brazil/East');
require_once('verificar_login.php');
date_default_timezone_set('America/Argentina/Buenos_Aires');
$datetime=date("Y-m-d h:i:s");

$medics = MedicData::getAll();
if (!isset($_POST["barbero_elegido"])){
    $_SESSION["barbero"]=$medics[0]->id;
}else{
    $_SESSION["barbero"]=$_POST["barbero_elegido"];
}

?>
<?php //if($_SESSION['id_barbero_us']==0){ ?>
    <!--  <form class="" method="post" id="form_barbero">
          <div class="col-sm-6 col-sm-offset-3 text-center">
              <label for="inputEmail1" class="col-lg-2 control-label">Barbero</label>

            <select name="barbero_elegido" id="barbero_elegido" class="form-control" required>
                <?php// foreach($medics as $p):?>
                    <option value="<?php// echo $p->id; ?>"<?php// if($p->id==$_SESSION["barbero"]){ echo "selected"; }?>><?php// echo $p->nombre." ".$p->apellido; ?></option>
                <?php// endforeach; ?>
            </select>
        </div>
       <input  type="submit" name="button" id="button" value="Cargar Calendario">

    </form>
<?php// }else{ ?>
    <form class="" method="post" id="form_barbero">
        <div class="col-sm-6 col-sm-offset-3 text-center">
            <label for="inputEmail1" class="col-lg-2 control-label">Barbero</label>
            <h5 style="margin-bottom: 5px;">Barbero</h5>
            <select disabled name="barbero_elegido" id="barbero_elegido" class="form-control" required>
                <?php// foreach($medics as $p):?>
                    <option value="<?php// echo $p->id; ?>"<?php// if($p->id==$_SESSION["id_barbero_us"]){ echo "selected"; }?>><?php// echo $p->nombre." ".$p->apellido; ?></option>
                <?php// endforeach; ?>
            </select>
        </div>
       <input  type="submit" name="button" id="button" value="Cargar Calendario">

    </form>-->

<?php// } ?>
<?php


$thejson=null;
if($_SESSION['id_barbero_us']==0){
    $_SESSION['barbero']=$_SESSION['barbero'];
}else{
    $_SESSION['barbero']=$_SESSION['id_barbero_us'];
}
$events = ReservationData::getEvery($_SESSION['barbero']);
$pacients = PacientData::getAll();
$servicio = CategoryData::getAll();
$statuses = StatusData::getAll();
$payments = PaymentData::getAll();
if (count($events)>0) {
    foreach ($events as $event) {
        $cliente=PacientData::getById($event->cliente_id);
        $servicio=CategoryData::getById($event->servicio_id);
        $servnom=$servicio->nombre;
        //var_dump($event);
        if ($event->cliente_id==0){
            $nombrecliente="Inactivo";
        }else {
            $nombrecliente = $cliente->nombre;
            $apellidocliente=$cliente->apellido;
            $telcliente=$cliente->telefono;
        }

        if ($event->estado_pago_id == 2){
            $color='green';
        }elseif($event->estado_pago_id == 3){
            $color='red';
        }elseif($event->inactivo == 1){
            $color='gray';
        }else{
            $color='';
        }
        if(($event->inactivo == 1)){
            $thejson[] = array("color" => $color,"start" => $event->fecha . "T" . $event->hora,"event_id"=>$event->id,
                "title"=>$servnom.'<br>'.$nombrecliente,"end"=> $event->fecha . "T" . $event->endturno);
        }else {
            $thejson[] = array("color" => $color, "start" => $event->fecha . "T" . $event->hora, "event_id" => $event->id,
                "title"=>$servnom.'<br>'.$nombrecliente.'  '.$apellidocliente.' <br> Teléfono: '.$telcliente, "end"=> $event->fecha . "T" . $event->endturno);
        }
    }

}
$show_json = json_encode($thejson,JSON_UNESCAPED_UNICODE);
//$reservation = ReservationData::getById($event->id);
//include_once "/../layouts/layout.php";

?>

<link rel="stylesheet" type="text/css" href="core/app/view/select2/select2.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/style_inicio.css">

<style>
   


</style>
<script src="core/app/view/select2/select2.min.js"></script>
<script>
    if( navigator.userAgent.match(/iPhone|iPad|iPod/i) ) {
        var styleEl = document.createElement('style'), styleSheet;
        document.head.appendChild(styleEl);
        styleSheet = styleEl.sheet;
        styleSheet.insertRule(".modal-dialog{top:0px;}", 0);
     }
    window.onload=function cambiartexto(){
        var texto="Ganancias de hoy: $";

        var total = $('form').find('h5[id="total"]').val();
        event.preventDefault();
        $.ajax({
            url: './?action=ganancia',
            type: 'POST',
            data: {total: total},
            success: function(total) {
                //$.alert(respuesta);
                $('#total').html(texto+total);
            },

        });
    };



    $(document).ready(function() {

        function cambiartexto1(){
            var texto="Ganancias de hoy: $ ";

            var total = $('form').find('h5[id="total"]').val();
            event.preventDefault();
            $.ajax({
                url: './?action=ganancia',
                type: 'POST',
                data: {total: total},
                success: function(total) {
                    //$.alert(respuesta);
                    $('#total').html(texto+total);
                },

            });
        }




        $(".form-wrapper .button").click(function(){
            var button = $(this);
            var currentSection = button.parents(".section");
            var currentSectionIndex = currentSection.index();
            var headerSection = $('.steps li').eq(currentSectionIndex);
            currentSection.removeClass("is-active").next().addClass("is-active");
            headerSection.removeClass("is-active").next().addClass("is-active");


            $(".form-wrapper").submit(function(e) {
                e.preventDefault();
            });

            if(currentSectionIndex === 1){
                $(document).find(".form-wrapper .section").first().addClass("is-active");
                $(document).find(".steps li").first().addClass("is-active");
            }
        });
        /* $("#modal_editar_turno").appendTo("body");
         $("#modal_reserva").appendTo("body");*/
        $('#cliente_id').select2({width:'100%'});
        $('#barbero_id').select2({width:'100%'});
        // $('#barbero_elegido').select2({width:'100%'});
        // $("#barbero_elegido").change(function(){
        //     $("#form_barbero").submit();
        // });

        function traerclientes(){

            $.ajax({
                method:'GET',
                url: './?action=traerclientes',
                data: {},
                success: function(respuesta) {
                    //$.alert(respuesta);
                    $("#cliente_id").html(respuesta);

                },
                error: function() {
                    console.log("No se ha podido obtener la información ddd");
                }
            });
        }

        $("#form_nuevo_cliente").submit(function(e){
            e.preventDefault();
            $.ajax({
                method:'POST',
                url: './?action=addpacient&nombre='+$("#name").val()+'&apellido='+$("#lastname").val()+'&email='+$("#email1").val()+'&telefono='+$("#phone1").val()+'&dni='+$("dni").val(),
                data: {},
                success: function(respuesta) {
                    $.alert(respuesta);

                    $("#form_nuevo_cliente")[0].reset();
                    traerclientes();
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }
            });
        });
        
        
        $("#form_nuevo_turno").submit(function(e){
            e.preventDefault();
            $.ajax({
                method:'POST',
                url: './?action=addreservation&notas='+$("#notas").val()+'&fecha='+$("#fecha").val()+'&hora='+$("#hora").val()+'&cliente_id='+$("#cliente_id").val()+'&servicio_id='+$("#servicio_id").val()+'&estado_pago_id='+$("#estado_pago_id").val()+'&estado_id='+$("#estado_id").val(),
                data: {},
                success: function(respuesta) {
                    mailturno();
                    $.alert(respuesta);

                    $("#form_nuevo_turno")[0].reset();
                    $("#cliente_id").val("").trigger('change');
                    $("#modal_reserva").modal("hide");
                    recargar_calendario();
                    cambiartexto1();

                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }
            });
        });
        function mailturno(){


            $.ajax({
                method:'POST',
                url: './?action=mailturno&fecha='+$("#fecha").val()+'&hora='+$("#hora").val()+'&cliente_id='+$("#cliente_id").val(),
                data: {},
                success: function(respuesta) {
                    $.alert(respuesta);


                    $("#cliente_id").val("").trigger('change');


                },
                error: function() {
                    console.log("error mail turno");
                }
            });
        }
        function edicion_turno() {
            $("#form_editar_turno").submit(function(e){
                e.preventDefault();
                e.stopImmediatePropagation ();

                $.ajax({
                    method:'POST',
                    url: './?action=updatereservation&id='+$("#id2").val()+'&notas='+$("#notas2").val()+'&fecha='+$("#fecha2").val()+'&hora='+$("#hora2").val()+'&cliente_id='+$("#cliente_id2").val()+'&servicio_id='+$("#servicio_id2").val()+'&estado_pago_id='+$("#estado_pago_id2").val()+'&estado_id='+$("#estado_id").val()+'&precio='+$("#precio").val()+'&forma_pago='+$(".formapago:checked").val(),
                    data: {},
                    success: function(respuesta) {
                        $.alert(respuesta);
                        $("#form_editar_turno")[0].reset();
                        $("#modal_editar_turno").modal("hide");
                        cambiartexto1();
                        recargar_calendario();

                    },
                    error: function() {
                        console.log("No se ha podido obtener la información");
                    }
                });
            });
        }
        function edicion_inactividad() {
            $("#form_cancelar_inactividad").submit(function(e){
                e.preventDefault();
                $("#form_cancelar_inactividad")[0].reset();
                $("#modal_eliminar_inactividad").modal("hide");
                recargar_calendario();
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
                    cambiartexto1();
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

        function Turno_Inactivo() {
            $("#inactivo_btn").click(function(e){
                e.preventDefault();
                e.stopImmediatePropagation ();
                $.ajax({
                    method:'POST',
                    url: './?action=inactivo&notas='+$("#notas").val()+'&fecha='+$("#fecha").val()+'&hora='+$("#hora").val()+'&cliente_id=0&servicio_id=1&estado_pago_id=1&estado_id=1&inactivo=1',
                    data: {},
                    success: function(respuesta) {
                        $.alert(respuesta);
                        // $("#inactivo")[0].reset();
                        $("#modal_reserva").modal("hide");
                        recargar_calendario();
                    },
                    error: function() {
                        console.log("No se ha podido obtener la información");
                    }
                });
            });
        }

        function disponible(){

            $.ajax({
                method:'GET',
                url: './?action=comprobarDispNuevo&fecha='+$("#fecha1").val()+'&hora='+$("#hora1").val(),
                data: {},
                success: function(respuesta) {
                    //$.alert(respuesta);
                    $("#servicio_id").html(respuesta);

                },
                error: function() {
                    console.log("No se ha podido obtener la información ddd");
                }
            });
        }

        function disponibleEdit(){
            $.ajax({
                method:'GET',
                url: './?action=comprobarDisponibilidad&fecha='+$("#fecha2").val()+'&hora='+$("#hora2").val()+'&servicio_id='+$("#servicio_id3").val()+'&id='+$("#id2").val(),
                data: {},
                success: function(respuesta) {
                    //$.alert(respuesta);
                    $("#servicio_id2").html(respuesta);

                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }
            });
        }

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },

            allDaySlot: false,
            defaultView: $(window).width() < 765 ? 'agendaDay':'agendaWeek',
            defaultDate: '<?php echo $datetime;?>',
            editable: false,
            eventLimitText: "Más",
            eventLimit: true, // allow "more" link when too many events
            eventSources:[{
                events: <?php echo $show_json;?>,
            }],
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
            lang:'es',
            firstDay: 2,
            hiddenDays: [ 0,1 ],
            contentHeight: 'auto',
            slotDuration:'00:30:01' ,
            slotLabelInterval:30,
            slotlabelformat:'h(:mm)a',
            minTime:'10:30:00',
            maxTime:'20:00:00',
            eventRender : function(event, element) {
                element.find('div.fc-title').html(element.find('div.fc-title').text()) ;
            },
            viewRender: function(view, element){
                if(view.name == "agendaWeek"){
                    $("#calendar").addClass('agenda-week');
                }else{
                    $("#calendar").removeClass('agenda-week');
                }
                },

            eventClick: function(info,event) {
                if (info.color == 'gray') {
                    var evento_id = info.event_id;
                    $.ajax({
                        method: 'GET',
                        url: './?action=cancelarInactividad&id=' + evento_id,
                        data: {},
                        success: function (respuesta) {
                            //console.log(respuesta);
                            $("#div_inactivo").html(respuesta);
                            $("#modal_eliminar_inactividad").modal('show');
                            $('.main-panel').animate({
                                scrollTop: 90
                            }, 800);
                            edicion_inactividad();
                        },
                        error: function () {
                            console.log("No se ha podido obtener la información");
                        }
                    });
                } else {
                    var evento_id = info.event_id;
                    $.ajax({
                        method: 'GET',
                        url: './?action=editreservation&notas=' + $("#notas").val() + '&estado_pago_id=' + $("#estado_pago_id").val() + '&servicio_id=' + $("#servicio_id").val() + '&id=' + evento_id,
                        data: {},
                        success: function (respuesta) {
                            //console.log(respuesta);
                            $("#div_form_editar").html(respuesta);
                            $("#modal_editar_turno").modal('show');
                            $('.main-panel').animate({
                                scrollTop: 90
                            }, 800);
                            disponibleEdit();
                            edicion_turno();
                        },
                        error: function () {
                            console.log("No se ha podido obtener la información");
                        }
                    });
                }
            },

            dayClick: function(date, jsEvent, view) {
                var fecha=date._d;
                var mes=fecha.getMonth()+1;
                //console.log(fecha);
                var formatted_date = fecha.getFullYear() + "-" + ("0"+mes).slice(-2) + "-" + ("0"+fecha.getDate()).slice(-2);
                // console.log(formatted_date);
                document.getElementById("fecha").value = formatted_date;
                document.getElementById("fecha1").value = formatted_date;
                var formatted_hs =("0"+fecha.getUTCHours()).slice(-2) + ":" + ("0"+fecha.getUTCMinutes()).slice(-2);
                // console.log($("#hora").val());
                document.getElementById("hora").value = formatted_hs;
                document.getElementById("hora1").value = formatted_hs;
                if (view.name!="month"){
                    $("#modal_reserva").modal("show");
                    $('.main-panel').animate({
                        scrollTop: 90
                    }, 800);
                    disponible();
                    Turno_Inactivo();
                }else{
                    $('#calendar').fullCalendar('gotoDate',date);
                    $('#calendar').fullCalendar('changeView','agendaDay');
                }
                
            },
        });

    });
</script>


<div class="row">
    <div class="col-md-12">
        <div class="card" style="margin-top: 4rem;">
            <div class="card-header" data-background-color="green">
                <?php if($_SESSION['id_barbero_us']==0){ ?>

                    <form class="" method="post" id="form_barbero" >

                  <!--          <select name="barbero_elegido" id="barbero_elegido" class="form-control" required>
                                <?php //foreach($medics as $p):?>
                                    <option value="<?php// echo $p->id; ?>"<?php// if($p->id==$_SESSION["barbero"]){ echo "selected"; }?>><?php// echo $p->nombre." ".$p->apellido; ?></option>
                                <?php //endforeach; ?>
                            </select>-->
                        <div class="tab"  >
                            <?php foreach($medics as $p):?>
                            <button name="barbero_elegido" type="submit" class="tablinks <?php if($p->id==$_SESSION["barbero"]){ echo "active"; }?>" value="<?php echo $p->id; ?>" id="barbero_elegido"  onclick="openCity(event,'<?php echo $p->nombre.' '.$p->apellido; ?>' )"><?php echo $p->nombre." ".$p->apellido; ?></button>
                            <?php endforeach; ?>
                        </div>

                    </form>
                    <form id="ganancia" method="post" style="text-align: right; margin-top: -71px;" >
                    <?php
                    $users2= array();
                    $users2=MedicData::getById($_SESSION["barbero"]);

                    ?>

                    <h4 > <?php echo $users2->nombre.' '. $users2->apellido ;?> </h4>
                    <h5 id="total" name="total" >Ganancias de hoy: $0.00 <?php// echo number_format($total,2,".",",");?></h5>
                    </form>

                <?php }else{ ?>


                <!--    <select disabled name="barbero_elegido" id="barbero_elegido" class="form-control" required>
                                <?php //foreach($medics as $p):?>
                                    <option value="<?php// echo $p->id; ?>"<?php// if($p->id==$_SESSION["id_barbero_us"]){ echo "selected"; }?>><?php// echo $p->nombre." ".$p->apellido; ?></option>
                                <?php //endforeach; ?>
                            </select>-->


                    <form class="" method="post" id="form_barbero">
                        <div class="tab"  >
                            <?php foreach($medics as $p):?>
                                <button name="barbero_elegido" type="submit" class="tablinks <?php if($p->id==$_SESSION["id_barbero_us"]){ echo "active"; }?>" value="<?php echo $p->id; ?>"  id="barbero_elegido"  onclick="openCity(event,'<?php echo $p->nombre.' '.$p->apellido; ?>' )"><?php echo $p->nombre." ".$p->apellido; ?></button>
                            <?php endforeach; ?>
                        </div>

                    </form>
                    <form id="ganancia" method="post" style="text-align: right; margin-top: -71px;" >
                        <?php
                        $users2= array();
                        $users2=MedicData::getById($_SESSION["barbero"]);

                        ?>

                        <h4 > <?php echo $users2->nombre.' '. $users2->apellido ;?> </h4>
                        <h5 id="total" name="total" >Ganancias de Hoy: $ 0.00 <?php// echo number_format($total,2,".",",");?></h5>
                    </form>

                <?php } ?>
            </div>
            <div class="card-content table-responsive">
                <div id="calendar"></div>

                <div id="modal_eliminar_inactividad" data-backdrop="false" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Periodo de inactividad</h4>
                            </div>
                            <div class="modal-body">
                                <div id="div_inactivo">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div id="modal_editar_turno" data-backdrop="false" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Editar Turno</h4>
                            </div>
                            <div class="modal-body">
                                <div id="div_form_editar"></div>
                                <!-- BODY-->
                            </div>
                        </div>
                    </div>
                </div>

                <div id="modal_reserva" class="modal fade" data-backdrop="false" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                </button>

                            </div>
                            <ul class="steps">
                                <li class="is-active  button" style="font-size: x-large;">Nuevo Turno</li>
                                <li class="button" style="font-size: x-large;">Nuevo Cliente</li>


                            </ul>
                            <div class="modal-body form-wrapper">
                                <!-- <fieldset class="section is-active" style="margin-left: -24px"> -->
                                <div class="section is-active" style="margin-left: -24px;">
                                <form class="form-horizontal" role="form" id="form_nuevo_turno" method="post" action="./?action=addreservation">
                                    <input type="hidden" name="id" id="id" value="<?php echo $reservation->id; ?>">
                                    <input type="hidden" id="servicio_id_home" value="<?php echo $reservation->servicio_id;?>">
                                    <input type="hidden" name="id" id="id_home" value="<?php echo $reservation->id; ?>">
                                    <input type="hidden" name="precio" id="precio" value="0">
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-2 control-label">Cliente</label>
                                        <div class="col-lg-8">
                                            <select name="cliente_id" id="cliente_id" class="form-control" required>
                                                <option value="">-- SELECCIONE --</option>
                                                <?php foreach($pacients as $p):?>
                                                    <option value="<?php echo $p->id; ?>"><?php echo $p->nombre." ".$p->apellido; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1 "  class="col-lg-2 control-label" >Fecha/Hora</label>
                                        <div class="col-lg-4">
                                            <input type="date" disabled id="fecha" required  class="form-control" id="inputEmail1" placeholder="Fecha">
                                            <input type="hidden" id="fecha1" name="fecha">
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="time" disabled required id="hora" class="form-control" id="inputEmail1" placeholder="Hora">
                                            <input type="hidden" id="hora1" name="hora">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-2 control-label">Nota</label>
                                        <div class="col-lg-8">
                                            <textarea class="form-control" id="notas" name="notas" placeholder="Nota"></textarea>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-2 control-label">Servicio</label>
                                        <div class="col-lg-8">
                                            <select name="servicio_id" id="servicio_id" class="form-control" required>

                                            </select>
                                        </div>
                                    </div>
<!--                                    <div class="form-group">-->
<!--                                        <label for="inputEmail1" class="col-lg-2 control-label">Estado del turno</label>-->
<!--                                        <div class="col-lg-8">-->
<!--                                            <select name="estado_id" id="estado_id" class="form-control" required>-->
<!--                                                --><?php //foreach($statuses as $p):?>
                                                    <input type="hidden" id="estado_id" value="1">
<!--                                                --><?php //endforeach; ?>
<!--                                            </select>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="form-group">-->
<!--                                        <label for="inputEmail1" class="col-lg-2 control-label">Estado del pago</label>-->
<!--                                        <div class="col-lg-8">-->
<!--                                            <select name="estado_pago_id" id="estado_pago_id" class="form-control" required>-->
<!--                                                --><?php //foreach($payments as $p):?>
                                                      <input type="hidden" id="estado_pago_id" value="1">
<!--                                                --><?php //endforeach; ?>
<!--                                            </select>-->
<!--                                        </div>-->
<!--                                    </div>-->


                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-8">
                                            <button type="submit" class="btn btn-default">Agregar Turno</button>

                                            <button type="button" id="inactivo_btn" class="btn btn-default">Inactivo</button>
                                        </div>
                                        <div class="col-lg-offset-3 col-lg-8">
                                            <a  class="btn btn-default button"><i class='fa fa-male'></i> Nuevo Cliente</a>
                                        </div>
                                    </div>
                                </form>
                                </div>
                                <div class="section" style="margin-left: -24px">
                                    <form class="form-horizontal"  method="post" id="form_nuevo_cliente" action="./?action=addpacient" role="form">


                                        <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
                                            <div >
                                                <input type="text" name="nombre" required  class="field__input a-field__input" id="name" placeholder="Nombre">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-2 control-label">Apellido</label>
                                            <div >
                                                <input type="text" name="apellido"   class="field__input a-field__input" id="lastname" placeholder="Apellido">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
                                            <div>
                                                <input type="text" name="email"  class="field__input a-field__input" id="email1" placeholder="Email">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-2 control-label">Telefono*</label>
                                            <div >
                                                <input type="text" name="telefono"  class="field__input a-field__input" id="phone1" placeholder="Telefono">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-2 control-label">DNI</label>
                                            <div >
                                                <input type="text" maxlength="8" name="dni"  class="field__input a-field__input" id="dni" placeholder="Dni">
                                            </div>
                                        </div>


                                        <div >
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button type="submit" class="btn btn-primary">Agregar Cliente</button>
                                            </div>
                                            <div class="col-lg-offset-3 col-lg-8">
                                            <a class="btn btn-default button">Volver</a>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                                <div class="modal-body ">

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

<style>


</style>
        <link rel="stylesheet" type="text/css" href="assets/css/input.css">
        <script>

            function openCity(evt, cityName) {

                var i, tablinks;
                tablinks = document.getElementsByClassName("tablinks");

                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
                $("#barbero_elegido").change(function(){
                    $("#form_barbero").submit();

                });


            }

        </script>

