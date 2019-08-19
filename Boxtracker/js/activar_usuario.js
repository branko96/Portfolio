$(function() {

	$("#form_crear_contraseña").submit(function(e){
		e.preventDefault();
        if(validar_contraseñas()){
                $("#resultado").html(""); 
                $("#cargando").fadeIn();
        		var parametros= $(this).serialize();
        		$.ajax({
        		 	data: parametros,
        		 	url: 'ajax/ajax_crear_pass.php',
        		 	type: 'post',
                    dataType:'json',
        			success: function (data) {
                        //console.log(data.estado);
                        $("#cargando").fadeOut();
                        $("#resultado").html(data.mensaje);
                        if (data.estado == '1'){
                            setTimeout(function() {
                                window.location='index.php'; 

                             },3500);
                            
                        }

        			} 
        		}); 
        }
	});

});
    function validar_contraseñas(){
        var pass1= $('#pass1').val();
        var pass2= $('#pass2').val();
        if (pass1 == pass2){
            quitar_error();
            return true;
        }else{
            mostrar_error();
            return false;
        }
    }

    function mostrar_error(){
        $("#label_error").show();
        var pass1_padre=$("#pass1").parent();
        var pass2_padre=$("#pass2").parent();
        pass1_padre.addClass("has-error");
        pass2_padre.addClass("has-error");
    }
    function quitar_error(){
        $("#label_error").hide();
        var pass1_padre=$("#pass1").parent();
        var pass2_padre=$("#pass2").parent();
        pass1_padre.removeClass("has-error");
        pass2_padre.removeClass("has-error");
    }