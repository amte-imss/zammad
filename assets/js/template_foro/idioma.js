
$(document).ready(function () {
    $(".languaje_catalogo").on('click', function (e) {
        language(this);
    });
});

function language(element) {
    var objeto = $(element);
    var language = objeto.data('cvelanguage');

    $.ajax({
        type: "GET",
        url: site_url + "/gestion_idiomas/modifica_idioma/" + language,
        data: null,
        dataType: "json",
        beforeSend: function (xhr) {
//            $(elemento_resultado).html(create_loader());
            mostrar_loader();
        }
    })
            .done(function (result) {
//                            console.log(result.estados_implementaciones);
                if (result.success === true) {
                    location.reload();
                }
            }).always(function () {
        remove_loader();
        ocultar_loader();
    });
    ;
}