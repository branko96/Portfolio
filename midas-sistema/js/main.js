$(document).ready(function(){
  $('.btn-canje').click(function(){

      premios = [$(this).attr('data-id')]; //lo guardo en un array por que el modulo puede procesar varios premios simultaneamente, pero aca no lo uso 
      datos_socio = $('#datos_socio').val();
      puntosPremio = $(this).attr('data-puntos');
      premio_titulo = $(this).attr('data-titulo');
      premio_detalle = $(this).attr('data-detalle');

      $.confirm({
          title: 'Confirmación de Canje',
          content: 'Realmente desea canjear este premio?',
          buttons: {
            confirmar: function () { 
             $.post('../content/controllers/ajax.ctrl.php',{
                action:'canjear-premio',
                model:'altaCanje',
                premios:premios,
                datos_socio:datos_socio,
                puntosPremio:puntosPremio,
                premio_titulo:premio_titulo,
                premio_detalle:premio_detalle,
              },
              function(res) { 
                console.log(res);
                if (res != false){
                 
                 if (res == true){
                    $.alert({
                        title: 'CANJE EXITOSO',
                        content: 'Se ha procesado su canje con éxito!',
                        buttons: {
                                    OK: function () {
                                         location.reload();
                                    }
                                  },
                    });

                   
                  }else{
                    
                    $.alert({
                        title: 'ERROR!',
                        content: 'Hay un error en el sistema, por favor comuniquelo al CLUB',
                    });
                  }

                }else{

                 $.alert('NO DISPONE DE PUNTOS SUFICIENTES');                  
                }

              }
            );

            },
            cancelar: function () { $.alert('Proceso Cancelado!') }
              
          }
      })

  });


}); //end DocumentReady
