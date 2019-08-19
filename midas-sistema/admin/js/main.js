$(document).ready(function(){
  var data=[];
  var dataAux= new Array();
  var ObjCliente=[];
  var suma=0;
  var valor;

        //$('#header').css("background-color", "#fff");


  $('#btn_enviar').click(function(){
      
         valor= $('#acumulados').val();
         suma=0;
        var values = [];
       //recorremos todos los checkbox seleccionados con .each
        $("input[name='premios[]']:checked").each(function() {
         suma=suma + parseFloat($(this).val()); //sumo los puntos segun los check seleccionados
         values.push($(this).attr("id")); //obtengo el id de cada checkbox seleccionada que es el id de premio
         $(this).attr('value',$(this).attr("id")); //selecciono el value por id de cada premio para enviar por POST
          
        });
            
          
  });

    //$('#socio').attr("maxlength",5); //por defecto 

   /* $('.radios').change(function(){
        var valor= $('input:radio[name=radios]:checked').val();
        if(valor==1)
         $('#socio').attr("maxlength",8);
       else
          $('#socio').attr("maxlength",5);
      $('#socio').focus(); 

    });*/
    //-----------------------------------------------------------------------------
    //compara la suma de puntos de premios con los acumulados por el socio
    $("input[name='premios[]']").click(function(){

      suma=0;
      $("input[name='premios[]']:checked").each(function() {
         suma=suma + parseFloat($(this).val()); 
         valor= $('#acumulados').val();
         
     }); 
            if(suma>valor)
            {
               alert('La suma de puntos es mayor a la acumulada por el socio');
               $('#btn_enviar').attr('disabled',true);
            }
            else
               $('#btn_enviar').attr('disabled',false);
        if(suma==0)
           $('#btn_enviar').attr('disabled',true);
    });
  
  //valida existencia de socio al perder el focus el input socio
  $('#socio').keypress(function(e){
    if(e.which == 13)
    {
        var str=$('#socio').val();  
        var pattern = /[0-9]+/g;  //patron
        var matches = str.match(pattern); //extraemos los numeros del string
        $('#socio').val(matches); //seteo en codigo solo numeros 
        //alert(matches);
         var tipo= $('input:radio:radio[name=radios]:checked').val(); //si es dni o tarj
           
      
             var socio=$('#socio').val();
             var data={
              'action': 'validar_socio',
              'socio':socio,
              'tipo': tipo
             }
             $.ajax({
               type: "POST",
                  url:"content/controllers/socio.ctrl.php",
                  data:data,
                  success: function(res){
                  
                      $('#existe').empty();
                      if(res!='')
                      {
                      $('#existe').append(res);
                      $('#btn_enviar').attr("disabled",false);
                      }
                      else
                       {
                        $('#existe').append('El Socio no existe!!');
                        $('#btn_enviar').attr("disabled",true);
                        return false;
                       } 
                      
                      

                  }
             });
     
     }

 
  });
  //-----------------------------------------------------------------------
  $( "#importe" ).keyup(function() {
    var value=$(this).val();
    var inputMinimo=$('#inputMinimo').val();
    var puntosXinput=$('#puntosXinput').val();

    var puntos= Math.round(value * puntosXinput / inputMinimo);
    $('#puntos').val(puntos);

  });

  /******************************
          SECTOR CONFIG
  *****************************/
  if ( $("#config").length ) {
  // Si estoy en la vista config poner aqui las funciones
    if( !($('#radioCategoria').is(':checked')) ) {
      
      $('.class-tipo-cliente').hide();
    }else{
      $('#inputMinimo').attr('readonly', true);
    }

   $('#radioCategoria').on('click', function (){
      $('.class-tipo-cliente,.class-cliente-c').show();
      $('.class-herencia-cliente').hide();
        //cuando tildo el ckeck categorizar tipo seteo el valor 100 para los porcentajes y bloqueo el input
      if( ($('#radioCategoria').is(':checked')) ) {
      
       $('#inputMinimo').val(100);
       $('#inputMinimo').attr('readonly', true);

      }else{

         $('#inputMinimo').attr('readonly', false);
      }

     });

    $('#radioHerencia').on('click', function (){
      $('.class-tipo-cliente,.class-cliente-c').hide();
      $('.class-herencia-cliente').show();
        //cuando tildo el ckeck categorizar tipo seteo el valor 100 para los porcentajes y bloqueo el input
      if( ($('#radioHerencia').is(':checked')) ) {
      
       $('#inputMinimo').val(100);
       $('#inputMinimo').attr('readonly', true);

      }else{

         $('#inputMinimo').attr('readonly', false);
      }

     });

    $('#radioNinguno').on('click', function (){
      $('.class-tipo-cliente').hide();
      $('.class-herencia-cliente').hide();
      $('.class-cliente-c').show();
      $('#inputMinimo').attr('readonly', false);
      
    });
    

  
  }

  /******************************
          ALTA DE SOCIO
  *****************************/
    //RECOMENDANTE AUTOCOMPLETAR

  $.post(route+'/content/controllers/ajax.ctrl.php',{action:'LISTAR_SOCIOS'},
    function(res) { //Procesamiento de los datos de vuelta
      ObjCliente = $.parseJSON(res); // paso el array a Json
      
      
      for (var i = 0; i < ObjCliente.length; i++) { //lo recorro y guardo la razonSocial
          
          concatenar=ObjCliente[i].nTarjeta+' '+ObjCliente[i].nombre;
          data.push(concatenar); 
          dataAux[ObjCliente[i].idSocios]= concatenar;
          
      }         

      $('#recomendante').typeahead({
        name: 'nombre',
        local:data //asigno el array como source
        // [
        //   'Alabama','Alaska','Arizona','Arkansas','California','Colorado','Connecticut','Delaware','Florida','Georgia','Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas','Kentucky','Louisiana','Maine','Maryland','Massachusetts','Michigan','Minnesota','Mississippi','Missouri','Montana','Nebraska','Nevada','New Hampshire','New Jersey','New Mexico','New York','North Dakota','North Carolina','Ohio','Oklahoma','Oregon','Pennsylvania','Rhode Island','South Carolina','South Dakota','Tennessee','Texas','Utah','Vermont','Virginia','Washington','West Virginia','Wisconsin','Wyoming'
        // ]
      });

        completarRecomendante(dataAux);
  });


  //FUNCION para buscar y guardar el id del socio
   $('#recomendante').bind('typeahead:selected',function(){

    var val= $('#recomendante').val();
     array= val.split(' ');
     numTarjeta = array[0];
      
     for (var i = 0; i < ObjCliente.length; i++) { //lo recorro y guardo el id del socio
      if(numTarjeta == ObjCliente[i].nTarjeta){

        idCliente = ObjCliente[i].idSocios;

        $('#idRecomendante').val(idCliente);         
       break
      }
         
    } //end for
    
   
   });


    //recibe id del recomendante y devuelve tarjeta y nombre concatenado


    function completarRecomendante(dataAux){
      idRecomendante=$('#idRecomendante').val();
      $('#recomendante').val(dataAux[idRecomendante]);
      
    }
       

       
          
         


}); //FIN DOCUMENT READY

 