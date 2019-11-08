/*
 * Cuando escribí esto sólo Dios y yo sabíamos lo que hace.
 * Ahora, sólo Dios sabe.
 * Lo siento.
 */

function recovery_password() {
    console.log('test');
    $('#login-modal').modal('hide');
    $('#modalRecovery').modal('show');
}

function prepara_form_registro(){
    $('#registro_form').submit(function(event){
        event.preventDefault();
        $('.modal-backdrop').remove();
        var destino = site_url + '/inicio/registro';
        $('#registro-modal').modal('hide');
        data_ajax(destino, '#registro_form', '#registro_modal_content', function(){
            $('#registro-modal').modal('show');
        });
    });
}
