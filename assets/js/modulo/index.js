function get_info_modulo(modulo) {
    data_ajax(site_url + '/modulo/index/2/' + modulo, null, '#my_modal_content',
            function () {
                $.getJSON(site_url + "/modulo/get_modulo/" + modulo, function (data) {
                    //$('#myModalLabel').text(data.modulo.nombre);
                    $('#modulo').val(data.modulo.nombre);
                    $('#url').val(data.modulo.url);
                    $('#tipo').val(data.modulo.id_configurador);
                    $('#padre').val(data.modulo.modulo_padre_id);
                    $('#orden').val(data.modulo.orden);
                    $('#icono').val(data.modulo.icon);
                    $('#visible').checked = data.modulo.visible;
                    form_submit();
                });
            });
}

function form_submit() {
    console.log('colocando form');
    $('#form_custom_modulo').submit(function (event) {
        event.preventDefault();
        console.log($(this).attr('action'));
        $.ajax({
            url: $(this).attr('action')
            , method: "post"
            , data: $(this).serialize()
            , error: function () {
                console.warn("No se pudo realizar la conexión");
            }
            , beforeSend: function (xhr) {
//                mostrar_loader();
            }
        }).done(function (response) {
            //console.log(response);
            refresh_page();
        }).fail(function(fail){
          console.log(fail)
        });
    });
}
;

function form_save() {
    data_ajax(site_url + '/modulo/index/2', null, '#my_modal_content', form_submit);
}

function refresh_page() {
    data_ajax(site_url + '/modulo/index/0', $(this), '#area_modulos', form_submit);
}

function get_niveles_atencion(modulo){
    data_ajax(site_url + '/modulo/index/3/'+modulo, null, '#my_modal_content', form_submit);
}

function get_usuarios(modulo){
    data_ajax(site_url + '/modulo/index/4/'+modulo, null, '#my_modal_content', form_submit);
}

function quitar_usuario(usuario){
    document.getElementById('usuario').value = usuario;
    $('#form_modulo_usuarios').submit(function (event) {
        event.preventDefault();
        console.log($(this).attr('action'));
        $.ajax({
            url: $(this).attr('action')
            , method: "post"
            , data: $(this).serialize()
            , error: function () {
                console.warn("No se pudo realizar la conexión");
            }
            , beforeSend: function (xhr) {
//                mostrar_loader();
            }
        }).done(function (response) {
            console.log(response);
            refresh_page();
        });
    });
    $('#form_modulo_usuarios').submit();
}
