(function () {
    "use strict";

    var id,
        loadNoticia,
        getId,
        init;

    getId = function () {
        id = window.location.hash.substring(2);
    };

    init = function () {
        getId();
        loadNoticia();
    };

    window.onhashchange = function () {
        init();
    };


    loadNoticia = function () {
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            url: '../ContentManager/WebServices/Noticias.asmx/GetNoticiaById',
            data: '{ id : ' + id + ' }',
            dataType: "json",
            success: function (data) {
                $('#noticias')
                    .empty()
                    .append('<h2>' + unescape(data.d.Titulo) + '</h2>')
                    .append(unescape(data.d.Contenido));
            }
        });
    };

    init();
}());