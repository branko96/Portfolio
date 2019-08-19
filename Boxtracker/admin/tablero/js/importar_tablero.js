


var ruta = 'http://'+window.location.host;
var vm2=new Vue({
    el: '#importar',
    data: {
        showModal: false,
        tableros: [],
        vista_tableros:false,
        show_alta_tableros: false,
        show_form_edicion:false,
        listahorizontal: true,
        idusuario_creador:0,
        id_proyecto:0,
        form_edicion_html:"",
        finalizados:false,
        data:{
            tickets:[{name:"test"}],
            headers:["Test header"]
        }
    },
    methods:{
        handleDragover:handleDragover,
        handleDrop:handleDrop,
        cambiar_color:function(e){
            if (this.finalizados) {
                $(".ver_finalizados").html('<i class="fa fa-eye-slash"></i>');
                $(".ver_finalizados").css('color','red');
            }else{
                $(".ver_finalizados").html('<i class="fa fa-eye"></i>');
                $(".ver_finalizados").css('color','#5A738E');
            }

        },
        crear_tablero: function(e) {
            //console.log($("#form_alta_tablero").serialize());
            var form=$("#form_alta_tablero");
            var formdata = form.serializeArray();
            var data = new FormData();
            $(formdata ).each(function(index, obj){
                // data[obj.name] = obj.value;
                data.append(obj.name,obj.value);
            });
            console.log(data);
            this.$http.post(ruta+"/boxtracker1/BACKEND/apis/tablero/Alta_tablero.php",data)
                .then((respuesta) =>{
                    if (respuesta.body.id_respuesta == "1") {
                        notif({
                            msg: respuesta.body.mensaje,
                            type: "success",
                            position: "center"
                        });
                        $("#form_alta_tablero")[0].reset();
                    }else{
                        notif({
                            msg: respuesta.body.mensaje,
                            type: "error",
                            position: "center"
                        });

                    }

                    // if (respuesta.body.id_respuesta == "1") {
                    // 	this.tableros=respuesta.body.mensaje;
                    // }else{
                    // 	this.tableros=[];
                    // }
                    this.cargarTableros(this.id_proyecto);
                }, (error) => {
                    console.log(error);
                    notif({
                        msg:error,
                        type: "error",
                        position: "center"
                    });
                });
        },
        ver_tablero_editar(id){
            this.$http.get("templates/ver_tablero_edit.php?id_tablero="+id)
                .then((respuesta) =>{
                    console.log(respuesta);
                    //$("#div_form_edicion").html(respuesta);
                    this.form_edicion_html=respuesta.body;
                    this.show_form_edicion=true;
                    this.show_alta_tableros=false;
                });
        },
        cargarTableros(id){
            //console.log(id);
            this.listahorizontal=true;
            this.id_proyecto=id;
            this.$http.get(ruta+"/boxtracker1/BACKEND/apis/tablero/Traer_tablero_proyectos.php?id_proyecto="+id)
                .then((respuesta) =>{
                    console.log(respuesta);
                    if (respuesta.body.id_respuesta == "1") {
                        this.tableros=respuesta.body.mensaje;
                    }else{
                        this.tableros=[];
                    }
                    this.showModal = true;
                    //setTimeout(function () {  }.bind(this), 100);
                });

        }
    }
});



function get_header_row(sheet) {
    var headers = [], range = XLSX.utils.decode_range(sheet['!ref']);
    var C, R = range.s.r; /* start in the first row */
    for(C = range.s.c; C <= range.e.c; ++C) { /* walk every column in the range */
        var cell = sheet[XLSX.utils.encode_cell({c:C, r:R})] /* find the cell in the first row */
        var hdr = "UNKNOWN " + C; // <-- replace with your desired default
        if(cell && cell.t) hdr = XLSX.utils.format_cell(cell);
        headers.push(hdr);
    }
    return headers;
}
function fixdata(data) {
    var o = "", l = 0, w = 10240;
    for(; l<data.byteLength/w; ++l) o+=String.fromCharCode.apply(null,new Uint8Array(data.slice(l*w,l*w+w)));
    o+=String.fromCharCode.apply(null, new Uint8Array(data.slice(l*w)));
    return o;
}
function workbook_to_json(workbook) {
    var result = {};
    workbook.SheetNames.forEach(function(sheetName) {
        var roa = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
        if(roa.length > 0){
            result[sheetName] = roa;
        }
    });
    return result;
}
/** PARSING and DRAGDROP **/
function handleDrop(e) {
    e.stopPropagation();
    e.preventDefault();
    console.log("DROPPED");
    var files = e.dataTransfer.files, i, f;
    for (i = 0, f = files[i]; i != files.length; ++i) {
        var reader = new FileReader(),
            name = f.name;
        reader.onload = function(e) {
            var results,
                data = e.target.result,
                fixedData = fixdata(data),
                workbook=XLSX.read(btoa(fixedData), {type: 'base64'}),
                firstSheetName = workbook.SheetNames[0],
                worksheet = workbook.Sheets[firstSheetName];
            vm2.data.headers=get_header_row(worksheet);
            results=XLSX.utils.sheet_to_json(worksheet);
            vm2.data.tickets=results;
        };
        reader.readAsArrayBuffer(f);
    }
}
function handleDragover(e) {
    e.stopPropagation();
    e.preventDefault();
    e.dataTransfer.dropEffect = 'copy';
}
