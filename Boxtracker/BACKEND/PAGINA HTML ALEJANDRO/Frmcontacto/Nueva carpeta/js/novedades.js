(function () {
    "use strict";

    var url = 'ContentManager/WebServices/Noticias.asmx/GetNoticiasBySeccion',
        htmlTrim;

    htmlTrim = function (str) {
        return str.replace(/<(p|div|span|b|u|i|strong|em|h\d+)>\s*\n*\t*[&nsbp;]*\s*\n*\t*<\/\1>/, '');
    };

	$.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        url: url,
        data: '{ cod : "NOV", descending: true, start: 0, limit: 0 }',
        dataType: "json",
        success: function (data) {
            var i,
                res = data.d,
                j = Math.min(res.length, 15),
                source = $('#notice-template').html(),
                container = $('#noticias'),
                template,
                noticia;

            container.empty();
            for (i = 0; i < j; i += 1) {
                noticia = res[i];
                noticia.Titulo = unescape(noticia.Titulo);
                noticia.nombreImagen = 'ContentManager/' + noticia.nombreImagen;
                noticia.Breve = htmlTrim(unescape(noticia.Breve));

                template = Handlebars.compile(source);
                container.append(template(noticia));
            }
        }
    });
}());

function cargarNoticia(id) {
    $.ajax({
        type: "POST",
        contentType: "application/json; charset=utf-8",
        url: 'ContentManager/WebServices/Noticias.asmx/GetNoticiaById',
        data: '{ id : ' + id + ' }',
        dataType: "json",
        success: function (data) {
            $('#noticias')
                //.empty()
                .append('<h2>' + unescape(data.d.Titulo) + '</h2>')
                .append(unescape(data.d.Contenido));
            $("#cargando").css("display", "none");
        }
    });
}