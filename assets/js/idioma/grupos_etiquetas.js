$(function () {
    $('#form_actualizar_ge').submit(function (event) {
        event.preventDefault();
        data_ajax($(this).attr('action'), $(this), '#area_grupo_etiquetas', null, true);
    });
});
