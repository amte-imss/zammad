function get_form_modulos_grupo() {
    var id_grupo = document.getElementById('grupo').value;
    $.ajax({
        url: site_url + "/modulo/get_modulos_grupo/" + id_grupo
        , method: "post"
        , data: {status: status}
        , error: function () {
            console.warn("No se pudo realizar la conexión");
        }
        , beforeSend: function (xhr) {
//            mostrar_loader();
        }
    }).done(function (response) {
        $('#area_grupo').html(response);
//        ocultar_loader();
    });
}