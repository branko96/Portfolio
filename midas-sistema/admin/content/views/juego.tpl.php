<div align="center">
            <h1>¡¡JUGÁ Y GANÁ!!</h1>
            
        <div class="row">

            <div class="col-md-3 controles">
                <div class="wrapp-socio input-group">
                  <input id="socio" type="text" class="form-control" placeholder="DNI SOCIO">
                  <input id="idSocio" type="hidden" class="form-control" >
                  <span class="input-group-btn">
                    <button id="iniciar_juego" class="btn btn-warning" type="button">INICIAR</button>
                  </span>
                </div><!-- /input-group -->
                

                <img id="spin_button" src="js/juego/spin_on.png" alt="Spin" onClick="startSpin();" style="display: none"/>

                
            </div><!-- /.col-lg-6 -->
           
                
            <div class="col-md-8 the_wheel" style="height:582px">
                <canvas id="canvas" width="434" height="434" style="margin-top: 67px;">
                    <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
                </canvas>
            </div>
            <audio id="soundWin" src="<?php echo route ?>/js/juego/winner.mp3"> </audio>
            <audio id="soundUps" src="<?php echo route ?>/js/juego/ups.mp3"> </audio>
            
            
        </div>
        <script>
            // Create new wheel object specifying the parameters at creation time.
            var theWheel = new Winwheel({
                'numSegments'   : 30,   // Specify number of segments.
                'outerRadius'   : 212,  // Set radius to so wheel fits the background.
                'innerRadius'   : 120,  // Set inner radius to make wheel hollow.
                'textFontSize'  : 16,   // Set font size accordingly.
                'textMargin'    : 0,    // Take out default margin.
                'segments'      :       // Define segments including colour and text.
                [
                    <?php echo $structure ?>
                   // {'fillStyle' : '#eae56f', 'text' : '100','detalle':'puntos'},
                   // {'fillStyle' : '#89f26e', 'text' : '25','detalle':'puntos'},
                   // {'fillStyle' : '#7de6ef', 'text' : 'Premio','detalle':'almoada de felpa'},
                   // {'fillStyle' : '#e7706f', 'text' : '250','detalle':'puntos'},
                   // {'fillStyle' : '#eae56f', 'text' : '10','detalle':'puntos'},
                   // {'fillStyle' : '#89f26e', 'text' : 'Premio','detalle':'puntos'},
                   // {'fillStyle' : '#7de6ef', 'text' : '50','detalle':'puntos'},
                   // {'fillStyle' : '#e7706f', 'text' : '5','detalle':'puntos'},
                   // {'fillStyle' : '#eae56f', 'text' : 'Premio','detalle':'puntos'},
                   // {'fillStyle' : '#89f26e', 'text' : '45','detalle':'puntos'},
                   // {'fillStyle' : '#7de6ef', 'text' : '70','detalle':'puntos'},
                   // {'fillStyle' : '#e7706f', 'text' : 'Premio','detalle':'puntos'},
                   // {'fillStyle' : '#eae56f', 'text' : '20','detalle':'puntos'},
                   // {'fillStyle' : '#89f26e', 'text' : '25','detalle':'puntos'},
                   // {'fillStyle' : '#7de6ef', 'text' : 'Premio','detalle':'puntos'},
                   // {'fillStyle' : '#e7706f', 'text' : '20','detalle':'puntos'},
                   // {'fillStyle' : '#eae56f', 'text' : '150','detalle':'puntos'},
                   // {'fillStyle' : '#89f26e', 'text' : 'Premio','detalle':'puntos'},
                   // {'fillStyle' : '#7de6ef', 'text' : '5','detalle':'puntos'},
                   // {'fillStyle' : '#e7706f', 'text' : '200','detalle':'puntos'},
                   // {'fillStyle' : '#eae56f', 'text' : 'Premio','detalle':'puntos'},
                   // {'fillStyle' : '#89f26e', 'text' : '60','detalle':'puntos'},
                   // {'fillStyle' : '#7de6ef', 'text' : '10','detalle':'puntos'},
                   // {'fillStyle' : '#e7706f', 'text' : 'Premio','detalle':'puntos'},
                   // {'fillStyle' : '#eae56f', 'text' : '30','detalle':'puntos'},
                   // {'fillStyle' : '#89f26e', 'text' : '15','detalle':'puntos'},
                   // {'fillStyle' : '#7de6ef', 'text' : 'Premio','detalle':'puntos'},
                   // {'fillStyle' : '#e7706f', 'text' : '20','detalle':'puntos'},
                   // {'fillStyle' : '#eae56f', 'text' : '40','detalle':'puntos'},
                   // {'fillStyle' : '#89f26e', 'text' : 'Premio','detalle':'puntos'}
                ],
                'animation' :           // Define spin to stop animation.
                {
                    'type'     : 'spinToStop',
                    'duration' : 5,
                    'spins'    : 8,
                    'callbackFinished' : 'alertPrize()'
                }
            });
            
            // Vars used by the code in this page to do power controls.
            var wheelPower    = 0;
            var wheelSpinning = false;
            
            // -------------------------------------------------------
            // Function to handle the onClick on the power buttons.
            // -------------------------------------------------------
            function powerSelected(powerLevel)
            {
                // Ensure that power can't be changed while wheel is spinning.
                if (wheelSpinning == false)
                {
                    // Reset all to grey incase this is not the first time the user has selected the power.
                    // document.getElementById('pw1').className = "";
                    // document.getElementById('pw2').className = "";
                    // document.getElementById('pw3').className = "";
                    
                    // Now light up all cells below-and-including the one selected by changing the class.
                    // if (powerLevel >= 1)
                    // {
                    //     document.getElementById('pw1').className = "pw1";
                    // }
                        
                    // if (powerLevel >= 2)
                    // {
                    //     document.getElementById('pw2').className = "pw2";
                    // }
                        
                    // if (powerLevel >= 3)
                    // {
                    //     document.getElementById('pw3').className = "pw3";
                    // }
                    
                    // Set wheelPower var used when spin button is clicked.
                    wheelPower = powerLevel;
                    
                    // Light up the spin button by changing it's source image and adding a clickable class to it.
                    document.getElementById('spin_button').src = "js/juego/spin_off.png";
                    document.getElementById('spin_button').className = "clickable";
                }
            }
            
            // -------------------------------------------------------
            // Click handler for spin button.
            // -------------------------------------------------------
            function startSpin()
            {
                // Ensure that spinning can't be clicked again while already running.
                if (wheelSpinning == false)
                {
                    // Based on the power level selected adjust the number of spins for the wheel, the more times is has
                    // to rotate with the duration of the animation the quicker the wheel spins.
                    if (wheelPower == 1)
                    {
                        theWheel.animation.spins = 3;
                    }
                    else if (wheelPower == 2)
                    {
                        theWheel.animation.spins = 8;
                    }
                    else if (wheelPower == 3)
                    {
                        theWheel.animation.spins = 15;
                    }
                    
                    // Disable the spin button so can't click again while wheel is spinning.
                    document.getElementById('spin_button').src       = "js/juego/spin_off.png";
                    document.getElementById('spin_button').className = "";
                    
                    // Begin the spin animation by calling startAnimation on the wheel object.
                    theWheel.startAnimation();
                    
                    // Set to true so that power can't be changed and spin button re-enabled during
                    // the current animation. The user will have to reset before spinning again.
                    wheelSpinning = true;
                }
            }
            
            // -------------------------------------------------------
            // Function for reset button.
            // -------------------------------------------------------
            function resetWheel()
            {
                theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
                theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
                theWheel.draw();                // Call draw to render changes to the wheel.
                
                // document.getElementById('pw1').className = "";  // Remove all colours from the power level indicators.
                // document.getElementById('pw2').className = "";
                // document.getElementById('pw3').className = "";
                
                wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.
                document.getElementById('spin_button').src       = "js/juego/spin_on.png";
            }
            
            // -------------------------------------------------------
            // Called when the spin animation has finished by the callback feature of the wheel because I specified callback in the parameters.
            // -------------------------------------------------------
            function alertPrize()
            {
                // Get the segment indicated by the pointer on the wheel background which is at 0 degrees.
                var winningSegment = theWheel.getIndicatedSegment();
                console.log(winningSegment);
                // inicializo el audio
                var audio = $(document).find('audio').get();          

                if(winningSegment.detalle == '') {
                    audio[1].play();
                    alert("¡¡UPS!! NO TE DESANIMES PODRÁS SEGUIR INTENTANDO");
                }else{

                  if(winningSegment.detalle == 'PUNTOS'){
                    audio[0].play();
                    var sistemaValores = "<?php echo " ".$_SESSION['login']['sistemaValores']; ?>";

                    alert("GENIAL ACUMULASTE " + winningSegment.text + sistemaValores);
                    $.ajax({
                        type: "POST",
                        url:"content/controllers/ajax.ctrl.php",
                        data:{
                        'action': 'BONUS',
                        'idSocio':$('#idSocio').val(),
                        'tipo': 4,
                        'puntos': winningSegment.text,
                        
                        },

                        success: function(res){
                          console.log(res);//muestra por consola nombre, apellido y puntos acumulados
                        
                        }
                     });
                  }else{
                    audio[0].play();                                              
                    alert("FELICITACIONES GANASTE EL PREMIO " + winningSegment.detalle);
                  }
                }


                resetWheel();
                $('#socio').val('');
                $('.wrapp-socio').show();
                $('#spin_button').hide();
            }

            $('#iniciar_juego').on('click', function(){
                
                var socio=$('#socio').val();
                console.log('el DNI del socio es '+socio);
                var data={
                'action': 'validar_socio',
                'socio':socio,
                'tipo': 1,
                'emisor_consulta':'juego'
                }
                     $.ajax({
                       type: "POST",
                          url:"content/controllers/socio.ctrl.php",
                          data:data,
                          success: function(res){
                            console.log(res);//muestra por consola nombre, apellido y puntos acumulados
                              if(res!='')
                              {
                                $('#idSocio').val(res);
                                $('.wrapp-socio').hide();
                                $('#spin_button').show();
                              }
                              else
                               {
                                alert('El Socio no existe!!');
                                return false;
                               } 
                              
                              

                          }
                     });
             
                 
            })//fin iniciar_juego
            
        
        </script>