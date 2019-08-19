function cargaSendMail(){
	$("#c_enviar").attr("disabled", true);
 
	$(".c_error").remove();
 	
	// var filter=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	
	// var s_email = $('#InputEmail').val();
	// var s_name = $('#InputName').val();    
	// var s_msg = $('#InputMessage').val();
 
	// if (filter.test(s_email)){
	// sendMail = "true";
	// } else{
	// $('#InputEmail').after("<span class='c_error' id='c_error_mail'><i class='fa fa-exclamation-triangle'></i> Ingrese e-mail valido.</span>");
	//  //aplicamos color de borde si el se encontro algun error en el envio
	// $('#contactform').css("border-color","#e74c3c");   
	// sendMail = "false";
	// }
	// if (s_name.length == 0 ){
	// $('#InputName').after( "<span class='c_error' id='c_error_name'><i class='fa fa-exclamation-triangle'></i> Ingrese su nombre.</span>" );
	// var sendMail = "false";
	// }
	// if (s_msg.length == 0 ){
	// $('#InputMessage').after( "<span class='c_error' id='c_error_msg'><i class='fa fa-exclamation-triangle'></i> Ingrese mensaje.</span>" );
	// var sendMail = "false";
	// }



var nombre=$('#contact-name').val();



	 var datos = {
			 "nombre" : $('#contact-name').val(),
			 "email" : $('#contact-email').val(),
			 "mensaje" : $('#contact-message').val()
	 };
 
	 $.ajax({

			 data:  datos,
			 // hacemos referencia al archivo contacto.php
			 url:   'contacto.php',
			 type:  'post',
			 beforeSend: function () {
			
			 //aplicamos color de borde si el envio es exitoso
					
			 },
			 success:  function (response) {
			debugger;
					
 
			 }
	 });

}
