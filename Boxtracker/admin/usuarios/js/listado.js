$(function(){
	var table= $("#tabla_usuarios").DataTable({
		"language":{
			"url":"http://boxtracker.net/boxtracker1/vendors/datatables.net/Spanish-DATATABLE.json"
		},
        responsive: true
	});
 
    //new $.fn.dataTable.FixedHeader( table );

	$('#tabla_usuarios tbody').on('click', 'td.details-control', function () {

        var tr = $(this).closest('tr');
        var row = table.row( tr );
        var id=$(this).data('id');
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            $.ajax({
                url: "ajax/ajax_usuarios.php",
                type: 'post',
                data: {id_user: id, op:'ver_hijos'},
                dataType: 'json',
                success: function(data) {
                   console.log(data);
                    var rta='';
                    var usuarios=data;
                    if (usuarios.length >0) {
                        $.each(usuarios, function(i, item) {
                             console.log(item);
                             rta+='<tr class="fil-hijo"><td class="col-long">'+'<strong>Nombre: </strong>'+item.nombre+' '+item.apellido+'</td><td class="col-medium"><strong>DNI: </strong>'+item.dni+'</td><td class="col-long"><strong>Mail: </strong>'+item.email+'</td></tr>';
                        });
                    }
                     row.child( rta ).show();
                    tr.addClass('shown');
                }                                           
            });
            
        }
    } );

	$(".ver_hijos").click(function(){
		//$(this).parent().find(".div_hijos").show("slow");
	});
});

/* Formatting function for row details - modify as you need */
function format ( id ) {
var rta ='';
    return rta;
}
function traer_hijos(id){
   
}