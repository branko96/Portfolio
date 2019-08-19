<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema de Beneficios MIDAS MKT</title>

    <!-- Core CSS - Include with every page -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="css/oasis.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login">
                    <div class="row panel-logo">
                        <figure>
                            <img src="img/oasis-logo.png" height="91" width="298" class="img-responsive" alt="">   
                        </figure>
                    </div>

                   
                    <div class="row panel-clock clock">
                        <div id="Date"></div>

                        <ul>
                            <li id="hours"> </li>
                            <li id="point">:</li>
                            <li id="min"> </li>
                            <li id="point">:</li>
                            <li id="sec"> </li>
                        </ul>
                        
                    </div>

                    <div class="row panel-register">
                        <form name="login" method="post" action="../content/checklogin.php" role="form">
                            <fieldset>
                                <label class="col-md-4" for="nTarjeta">Nº Tarjeta:</label>
                                <div class="form-group col-md-8">    
                                    <input class="form-control " placeholder="Número de Tarjeta" id="nTarjeta" name="nTarjeta" type="text" autofocus required>
                                </div>
                                <label class="col-md-4" for="nDocumento">Nº DNI:</label>
                                <div class="form-group col-md-8">
                                    <input class="form-control " placeholder="Número de DNI" id="nDocumento" name="nDocumento" type="text" value="" required>
                                </div>
                                <?php if(isset($_GET['Error'])){?>
                                    <div class='alert alert-danger ' style="overflow: hidden">Usuario y/o Contraseña incorrecta</div>
                                <?php }  ?>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Ingresar</button>
                            </fieldset>
                        </form>
                    </div>

                    <div class="panel-social">
                    <a href="" title=""><i class="icon-facebook"></i></a>
                    <a href="" title=""><i class="icon-twitter"></i></a>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Core Scripts - Include with every page -->
    <script src="../js/vendor/jquery-1.11.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    
    <!-- SB Admin Scripts - Include with every page -->
    <script src="../js/main.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
        // Create two variable with the names of the months and days in an array
        var monthNames = [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]; 
        var dayNames= ["Domingo","Lunes","Martes","Miercoles","jueves","Viernes","Sabado"]

        // Create a newDate() object
        var newDate = new Date();
        // Extract the current date from Date object
        newDate.setDate(newDate.getDate());
        // Output the day, date, month and year    
        $('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

        setInterval( function() {
            // Create a newDate() object and extract the seconds of the current time on the visitor's
            var seconds = new Date().getSeconds();
            // Add a leading zero to seconds value
            $("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
            },1000);
            
        setInterval( function() {
            // Create a newDate() object and extract the minutes of the current time on the visitor's
            var minutes = new Date().getMinutes();
            // Add a leading zero to the minutes value
            $("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
            },1000);
            
        setInterval( function() {
            // Create a newDate() object and extract the hours of the current time on the visitor's
            var hours = new Date().getHours();
            // Add a leading zero to the hours value
            $("#hours").html(( hours < 10 ? "0" : "" ) + hours);
            }, 1000);
            
        }); 
</script>

</body>

</html>
