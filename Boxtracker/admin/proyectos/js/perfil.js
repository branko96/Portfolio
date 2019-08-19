$(function(){
	editar_user();
	$("input.form-control").keyup(function(){
		$("#btn-guardar").attr("disabled",false);
	});
});
function recargar(){
	location.reload();
}
function editar_user(){
	$("#form_editar_perfil").submit(function(e){
		e.preventDefault();
		$("#btn-guardar").attr("disabled",true);
		$("#respuesta").html(""); 
		$.ajax({
			url: "../usuarios/ajax/ajax_usuarios.php",
			type: 'post',
			data: new FormData(this),
			cache: false,
		    contentType: false,
		    processData: false,
			success: function(data2) {
				$("#respuesta").html(data2);
				setTimeout(function(){
					window.location="../index.php";
				},2000);  		
			}						                	
		
		});
	});
}
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('.foto_user').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            $("#btn-guardar").attr("disabled",false);
        }
    }