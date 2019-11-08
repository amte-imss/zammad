$(function () {
    console.log('cargando');
    $('#form_actualizar_password').submit(function (event) {
        event.preventDefault();
        data_ajax($(this).attr('action'), $(this), '#campo_password', null, true);
    });

    $('#form_actualizar_interno').submit(function (event) {
        event.preventDefault();
        data_ajax($(this).attr('action'), $(this), '#area_datos_basicos', null, true);
    });
    $('#form_actualizar_externo').submit(function (event) {
        event.preventDefault();
        data_ajax($(this).attr('action'), $(this), '#area_datos_basicos', null, true);
    });
    $('#form_usuario_niveles').submit(function (event) {
        event.preventDefault();
        data_ajax($(this).attr('action'), $(this), '#campo_niveles_acceso', null, true);
    });

    $('#form_actualizar_actividad').submit(function (event) {
        event.preventDefault();
        data_ajax($(this).attr('action'), $(this), null, actualiza_actividad_usuario, true,[]);
    });

    $('#unidad_texto').keyup(function () {
        keyword = document.getElementById('unidad_texto').value;
        console.log('buscando:' + keyword);
        $.ajax({
            url: site_url + '/buscador/search_unidad_instituto'
            , method: "post"
            , timeout: 200
            , data: {keyword: keyword}
            , error: function () {
                console.warn("No se pudo realizar la conexión");
            }
        }).done(function (response) {
            $('#unidad_autocomplete').css('display', 'block');
            $('#unidad_autocomplete').html(response);
        });
    });

    $('#categoria_texto').keyup(function () {
        keyword = document.getElementById('categoria_texto').value;
        console.log('buscando:' + keyword);
        $.ajax({
            url: site_url + '/buscador/search_categoria'
            , method: "post"
            , timeout: 200
            , data: {keyword: keyword}
            , error: function () {
                console.warn("No se pudo realizar la conexión");
            }
        }).done(function (response) {
            $('#categoria_autocomplete').css('display', 'block');
            $('#categoria_autocomplete').html(response);
        });
    });
});

function actualiza_actividad_usuario(data){
    if(data.object.status){
        $('#status_actividad_usuario').html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Usuario actualizado con éxito</div>');
    }else{
        $('#status_actividad_usuario').html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Se presentó una falla al actualizar el usuario</div>');
    }
}

function set_value_unidad(item) {
    var id_unidad = item.getAttribute("data-unidad-id");
    var unidad = item.getAttribute("data-unidad-nombre");
    document.getElementById('unidad').value = id_unidad;
    document.getElementById('unidad_texto').value = unidad;
    $('#unidad_autocomplete').css('display', 'none');
    $('#unidad_autocomplete').html('');
}


function set_value_categoria(id_categoria, categoria) {
    console.log(categoria);
    document.getElementById('categoria').value = id_categoria;
    document.getElementById('categoria_texto').value = categoria;
    $('#categoria_autocomplete').css('display', 'none');
    $('#categoria_autocomplete').html('');
}
