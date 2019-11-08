const POR_ELEMENTO = 1;
        const OPCIONES_CATALOGO = 2;
        const ALL = 3;
/*
 * Cuando escribí esto sólo Dios y yo sabíamos lo que hace.
 * Ahora, sólo Dios sabe.
 * Lo siento.
 */

$(function () {
    $('.sipimss-helper').click(function (event) {
        var id_help = $(this).attr('data-help');
        var tipo_ayuda = $(this).attr('data-tipoayuda');
        if (typeof tipo_ayuda === 'undefined' || tipo_ayuda === POR_ELEMENTO) {
            data_ajax(site_url + '/ayuda/ver/' + id_help, null, '#my_modal_content');
        } else {
            var name_elemento = $(this).attr('data-name');
            var elemento_ayuda = $(this).attr('data-elementoayuda');
            var elmnt = document.getElementById(name_elemento);
            var json_opciones = [];
            for (var i = 0; i < elmnt.options.length; i++)
            {
                if (elmnt.options[i].value.toString() !== '') {
                    json_opciones.push(parseInt(elmnt.options[i].value));
                }
            }
            var json = JSON.stringify(json_opciones) ;
            var valores = {
                id_help: id_help,
                tipo_ayuda: tipo_ayuda,
                elemento_ayuda: elemento_ayuda,
                opciones: json
            };
            console.log(valores);
            data_ajax_post(site_url + '/ayuda/opciones/', null, '#my_modal_content', valores);
        }
        $('#my_modal').modal('show');
    });
});
