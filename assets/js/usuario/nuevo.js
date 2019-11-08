function cmbox_tipo_registro(elemento){
    $(".areas_registros").css('display', 'none');
    var valor = elemento.value;
    $('#area_' + valor).css('display', 'initial');
}

function activa_tipo_registro(valor){
    console.log(valor);
    $(".areas_registros").css('display', 'none');
    $('#area_registro_' + valor).css('display', 'initial');
    $('#tipo_registro').val('registro_'+valor);
}
