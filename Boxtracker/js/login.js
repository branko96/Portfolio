$( document ).ready(function() {

    $(".forgot-password").click(function(){
        var email=$("#inputEmail").val();
        if(email != ""){
            var parametros={email : email};
            $("#cargando2").show("fast");
            $.ajax({
                data: parametros,
                url: 'ajax/ajax_mail_pass.php',
                type: 'post',
                dataType:'json',
                success: function (data) {
                    //console.log(data);
                    $("#cargando2").hide("fast");
                    if (data.estado == "1") {
                        $.alert({title: 'Te enviamos un e-mail',content: data.mensaje});
                    }else{
                       $.alert({title: 'Error',content: data.mensaje}); 
                    }
                    
                    
                }
            });
        }else{
            $("#inputEmail").focus();
        }
    });

    login();
});

function login(){
	$("#form_login").submit(function(e){
		e.preventDefault();
        $("#resultado").html(""); 
        $("#cargando").fadeIn();
        //$("#loading").fadeIn(500);
		var parametros= $(this).serialize();
		$.ajax({
		 	data: parametros,
		 	url: 'ajax/ajax_login_user.php',
		 	type: 'post',
            dataType:'json',
			success: function (data) {
                //console.log(data.estado);
                
                if (data.estado == '1'){
                    
                   // $("#resultado").html(data.mensaje);
                    notif({
                      msg: data.mensaje,
                      type: "success",
                      position: "center"
                    });
                    setTimeout(function() {
                    	$("#cargando").fadeOut();
                        window.location='admin/index.php'; 

                     },1250);
                    
                }else{
                    $("#cargando").fadeOut();
                    //$("#resultado").html(data.mensaje);
                    notif({
                      msg: data.mensaje,
                      type: "error",
                      position: "center"
                    });
                }

			} 
		}); 
	});
}
