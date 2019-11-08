<?php
//echo js('helpdesk/helpdesk.js');
?>
<link href="<?php echo asset_url(); ?>css/jquery-ui.min.css" rel="stylesheet">
<script src="<?php echo asset_url(); ?>js/jquery-ui.min.js"></script>
<div id="page-inner">
    <?php echo form_open('helpdesk/', array('id' => 'form_helpdesk')); ?>
    <div class="col-sm-12" style="margin-top:20px;">
        <div id="msg"></div>
        <div class="ces-contact-form form-item webform-component webform-component-textfield webform-component--matricula webform-container-inline form-group form-inline form-item form-item-submitted-matricula form-type-textfield form-group"> <label class="control-label" for="edit-submitted-matricula">Matrícula:</label>
            <?php 
            echo $this->form_complete->create_element(
                array(
                    'id' => 'matricula',
                    'type' => 'text',
                    'value' => '',
                    'attributes' => array(
                        'class' => 'form-control form-imss',
                        //'placeholder' => 'Matrícula'
                    )
                )
            ); ?>
            <!-- <input placeholder="Matrícula" class="form-control form-text" type="text" id="matricula" name="matricula" value="" size="60" maxlength="15"> -->
        </div>
        <div class="ces-contact-form form-item webform-component webform-component-textfield webform-component--matricula webform-container-inline form-group form-inline form-item form-item-submitted-matricula form-type-textfield form-group"> <label class="control-label" for="edit-submitted-matricula">Delegación:</label>
            <?php
            echo $this->form_complete->create_element(
                array(
                    'id' => 'delegacion',
                    'type' => 'dropdown',
                    'options' => $delegacion,
                    //'value' => 
                    'attributes' => array(
                        'class' => 'form-control form-imss',
                        //'placeholder' => 'Delegación'
                    )
                )
            ); ?><div id="div_validar"></div><div id="div_validar_msg" class="clearfix text-center"></div>
            <!-- <input placeholder="Delegación" class="form-control form-text" type="text" id="edit-submitted-matricula" name="submitted[matricula]" value="" size="60" maxlength="15">-->
        </div>
        <div class="ces-contact-form form-item webform-component webform-component-textfield webform-component--matricula webform-container-inline form-group form-inline form-item form-item-submitted-matricula form-type-textfield form-grou"> <label class="control-label" for="edit-submitted-matricula">Nombre de usuario:</label>
            <?php 
            echo $this->form_complete->create_element(
                array(
                    'id' => 'nombre',
                    'type' => 'text',
                    'value' => '',
                    'attributes' => array(
                        'class' => 'form-control form-text',
                        //'placeholder' => 'Nombre de usuario'
                    )
                )
            ); ?>
            <!-- <input placeholder="Nombre de usuario" class="form-control form-text" type="text" id="edit-submitted-matricula" name="submitted[matricula]" value="" size="60" maxlength="15"> -->
        </div>
        <div class="ces-contact-form form-item webform-component webform-component-textfield webform-component--matricula webform-container-inline form-group form-inline form-item form-item-submitted-matricula form-type-textfield form-grou"> <label class="control-label" for="edit-submitted-matricula">Apellido paterno:</label>
            <?php 
            echo $this->form_complete->create_element(
                array(
                    'id' => 'apellido_paterno',
                    'type' => 'text',
                    'value' => '',
                    'attributes' => array(
                        'class' => 'form-control form-text',
                        //'placeholder' => 'Nombre de usuario'
                    )
                )
            ); ?>
            <!-- <input placeholder="Nombre de usuario" class="form-control form-text" type="text" id="edit-submitted-matricula" name="submitted[matricula]" value="" size="60" maxlength="15"> -->
        </div>
        <div class="ces-contact-form form-item webform-component webform-component-textfield webform-component--matricula webform-container-inline form-group form-inline form-item form-item-submitted-matricula form-type-textfield form-grou"> <label class="control-label" for="edit-submitted-matricula">Apellido materno:</label>
            <?php 
            echo $this->form_complete->create_element(
                array(
                    'id' => 'apellido_materno',
                    'type' => 'text',
                    'value' => '',
                    'attributes' => array(
                        'class' => 'form-control form-text',
                        //'placeholder' => 'Nombre de usuario'
                    )
                )
            ); ?>
            <!-- <input placeholder="Nombre de usuario" class="form-control form-text" type="text" id="edit-submitted-matricula" name="submitted[matricula]" value="" size="60" maxlength="15"> -->
        </div>
        <div class="ces-contact-form form-item webform-component webform-component-textfield webform-component--matricula webform-container-inline form-group form-inline form-item form-item-submitted-matricula form-type-textfield form-group"> <label class="control-label" for="edit-submitted-matricula">Correo electrónico:</label>
            <?php 
            echo $this->form_complete->create_element(
                array(
                    'id' => 'correo',
                    'type' => 'text',
                    'value' => '',
                    'attributes' => array(
                        'class' => 'form-control form-text',
                        //'placeholder' => 'Correo electrónico'
                    )
                )
            ); ?>
            <!-- <input placeholder="Correo electrónico" class="form-control form-text" type="text" id="edit-submitted-matricula" name="submitted[matricula]" value="" size="60" maxlength="15"> -->
        </div>
        <div class="ces-contact-form form-item webform-component webform-component-textfield webform-component--matricula webform-container-inline form-group form-inline form-item form-item-submitted-matricula form-type-textfield form-group"> <label class="control-label" for="edit-submitted-matricula">División:</label>
            <?php 
            echo $this->form_complete->create_element(
                array(
                    'id' => 'division',
                    'type' => 'dropdown',
                    'options' => $division,
                    'attributes' => array(
                        'class' => 'form-control form-text',
                        //'placeholder' => 'División'
                    )
                )
            ); ?>
            <!-- <input placeholder="Área" class="form-control form-text" type="text" id="edit-submitted-matricula" name="submitted[matricula]" value="" size="60" maxlength="15"> -->
        </div>
        <div class="ces-contact-form form-item webform-component webform-component-textfield webform-component--matricula webform-container-inline form-group form-inline form-item form-item-submitted-matricula form-type-textfield form-group"> <label class="control-label" for="edit-submitted-matricula">Área:</label>
            <?php 
            echo $this->form_complete->create_element(
                array(
                    'id' => 'area',
                    'type' => 'text',
                    'value' => '',
                    'attributes' => array(
                        'class' => 'form-control form-text',
                        //'placeholder' => 'Área'
                    )
                )
            ); ?>
            <!-- <input placeholder="Departamento" class="form-control form-text" type="text" id="edit-submitted-matricula" name="submitted[matricula]" value="" size="60" maxlength="15"> -->
        </div>
        <div class="ces-contact-form form-item webform-component webform-component-textfield webform-component--matricula webform-container-inline form-group form-inline form-item form-item-submitted-matricula form-type-textfield form-group"> <label class="control-label" for="edit-submitted-matricula">Teléfono de contacto:</label>
            <?php 
            echo $this->form_complete->create_element(
                array(
                    'id' => 'telefono',
                    'type' => 'text',
                    'value' => '',
                    'attributes' => array(
                        'class' => 'form-control form-text',
                        //'placeholder' => 'Teléfono de contacto'
                    )
                )
            ); ?>
            <!-- <input placeholder="Teléfono de contacto" class="form-control form-text" type="text" id="edit-submitted-matricula" name="submitted[matricula]" value="" size="60" maxlength="15">-->
        </div>
        <div class="ces-contact-form form-item webform-component webform-component-textfield webform-component--matricula webform-container-inline form-group form-inline form-item form-item-submitted-matricula form-type-textfield form-group"> <label class="control-label" for="edit-submitted-matricula">Tipo:</label>
            <?php 
            echo $this->form_complete->create_element(
                array(
                    'id' => 'tipo_asistencia',
                    'type' => 'dropdown',
                    'options' => $tipo_asistencia,
                    //'value' => 
                    'attributes' => array(
                        'class' => 'form-control',
                        //'placeholder' => 'Delegación'
                    )
                )
            ); ?>
            <!-- <input placeholder="Tipo" class="form-control form-text" type="text" id="edit-submitted-matricula" name="submitted[matricula]" value="" size="60" maxlength="15"> -->
        </div>
        <div id="div_evento">
            <div class="ces-contact-form form-item webform-component webform-component-textfield webform-component--matricula webform-container-inline form-group form-inline form-item form-item-submitted-matricula form-type-textfield form-group"> <label class="control-label" for="edit-submitted-matricula">Fecha:</label>
                <?php 
                echo $this->form_complete->create_element(
                    array(
                        'id' => 'fecha',
                        'type' => 'text',
                        'value' => '',
                        'attributes' => array(
                            'class' => 'form-control form-text',
                            //'placeholder' => 'Fecha'
                        )
                    )
                ); ?>
                <!-- <input placeholder="Fecha" class="form-control form-text" type="text" id="edit-submitted-matricula" name="submitted[matricula]" value="" size="60" maxlength="15">-->
            </div>
            <div class="ces-contact-form form-item webform-component webform-component-textfield webform-component--matricula webform-container-inline form-group form-inline form-item form-item-submitted-matricula form-type-textfield form-group"> <label class="control-label" for="edit-submitted-matricula">Hora:</label>
                <?php 
                echo $this->form_complete->create_element(
                    array(
                        'id' => 'hora',
                        'type' => 'text',
                        'value' => '',
                        'attributes' => array(
                            'class' => 'form-control form-text',
                            //'placeholder' => 'Hora'
                        )
                    )
                ); ?>
                <!-- <input placeholder="Hora" class="form-control form-text" type="text" id="edit-submitted-matricula" name="submitted[matricula]" value="" size="60" maxlength="15"> -->
            </div>
            <div class="ces-contact-form form-item webform-component webform-component-textfield webform-component--matricula webform-container-inline form-group form-inline form-item form-item-submitted-matricula form-type-textfield form-group"> <label class="control-label" for="edit-submitted-matricula">Lugar:</label>
                <?php 
                echo $this->form_complete->create_element(
                    array(
                        'id' => 'lugar',
                        'type' => 'text',
                        'value' => '',
                        'attributes' => array(
                            'class' => 'form-control form-text',
                            //'placeholder' => 'Lugar'
                        )
                    )
                ); ?>
                <!-- <input placeholder="Lugar" class="form-control form-text" type="text" id="edit-submitted-matricula" name="submitted[matricula]" value="" size="60" maxlength="15"> -->
            </div>
        </div>
        <div class="ces-contact-form form-item webform-component webform-component-textfield webform-component--matricula webform-container-inline form-group form-inline form-item form-item-submitted-matricula form-type-textfield form-group"> <label class="control-label" for="edit-submitted-matricula">Descripión del problema:</label>
            <?php 
            echo $this->form_complete->create_element(
                array(
                    'id' => 'descripcion',
                    'type' => 'textarea',
                    'value' => '',
                    'attributes' => array(
                        'class' => 'form-control form-text',
                        //'placeholder' => 'Descripión del problema'
                    )
                )
            ); ?>
            <!-- <input placeholder="Descripción del problema" class="form-control form-text" type="text" id="edit-submitted-matricula" name="submitted[matricula]" value="" size="60" maxlength="15"> -->
        </div>
        <div class="col-sm-12 text-center">
            <button name="submit" type="submit" class="btn-pad botonPE" id="btn_helpdesk">Enviar <span class=""></span></button>    
        </div>
        
    </div>
    <?php echo form_close(); ?>
    <!-- <div class="col-sm-12">    
        <div class="col-sm-4"></div>
        <div id="status_actividad_usuario" class="col-sm-2">
        <?php
        /*$opciones_actividad = array(
            0 => 'Desactivado', 1 => 'Activo'
        );
        echo form_open('helpdesk/', array('id' => 'form_actualizar_actividad'));

        echo $this->form_complete->create_element(
            array(
                'id' => 'status_actividad',
                'type' => 'dropdown',
                'options' => $opciones_actividad,
                'value' => $usuario['usuario_activo'] ? 1: 0,
                'attributes' => array(
                    'class' => 'form-control'
                )
            )
        );*/
        ?>
        </div>
        
    </div> -->
</div>
<script>
$(function() {
    $( "#fecha" ).datepicker();
    $("#tipo_asistencia").click(function() {
        var tipo_asistencia = $(this).val();
        if(tipo_asistencia==<?php echo En_tipo_asistencia::EVENTO; ?>){
            $('#div_evento').fadeIn("slow");
        } else {
            $('#div_evento').fadeOut("fast");
        }
        $('#fecha').val('');
        $('#hora').val('');
        $('#lugar').val('');
    });
    $("#matricula").blur(function() {
        validar_matricula();
    });
    $("#delegacion").change(function() {
        validar_matricula();
    });
    $("#form_helpdesk").submit(function(event) {
        event.preventDefault();
        var correct = "<div aria-hidden='true' class='glyphicon glyphicon-ok' style='color:green;'><span>&nbsp;</span></div>";
        var incorrect = "<div aria-hidden='true' class='glyphicon glyphicon-remove' style='color:red;'><span>&nbsp;</span></div>";
        $.ajax({
            url: site_url+'/helpdesk/validar_datos',
            data: $('#form_helpdesk').serialize(),
            method: 'POST',
            dataType: 'json',
            beforeSend: function (xhr) {
                mostrar_loader();
            }
        }).done(function (response) {
            var result = incorrect;
            var msg = "Valor incorrecto, verifique la Matrícula y la Delegación."
            console.log(response);
            console.log(response.result);
            if(response.result==true){
                result = correct;
                msg = "";
                $("#msg").removeClass('alert alert-danger');
            } else {
                $("#msg").addClass('alert alert-danger');
            }
            //$("#div_validar_msg").html(msg);
            $("#msg").html(response.msg);
            console.log(response.msg);
        }).fail(function (jqXHR, textStatus) {
            $("#msg").html(incorrect).addClass('alert alert-danger');
            console.log('Ocurrió un error durante el proceso, inténtelo más tarde.');
        }).always(function () {
            remove_loader();
            ocultar_loader();
        });
    });
});
function validar_matricula() { //callback, is_json, parametros
    var matricula = $("#matricula").val();
    if(matricula!="" && matricula.length>6 && $("#delegacion").val()!=""){
        var correct = "<div aria-hidden='true' class='glyphicon glyphicon-ok' style='color:green;'><span>&nbsp;</span></div>";
        var incorrect = "<div aria-hidden='true' class='glyphicon glyphicon-remove' style='color:red;'><span>&nbsp;</span></div>";
        $.ajax({
            url: site_url+'/helpdesk/validar_matricula',
            data: $('.form-imss').serialize(),
            method: 'POST',
            dataType: 'json',
            beforeSend: function (xhr) {
                mostrar_loader();
            }
        }).done(function (response) {
            var result = incorrect;
            var msg = "Valor incorrecto, verifique la Matrícula y la Delegación."
            /*var json = null;
            if (typeof is_json !== 'undefined' && is_json) {
                json = JSON.parse(response);
                console.log(json);
                if (typeof json.html !== 'undefined') {
                    html = json.html;
                }
            }
            if (typeof callback !== 'undefined' && typeof callback === 'function') {
                if (typeof parametros !== 'undefined') {
                    if (is_json !== 'undefined' && is_json) {
                        parametros.object = json;
                    }
                    $("#div_validar").html(html).promise().done(callback(parametros));
                } else {
                    $("#div_validar").html(html).promise().done(callback());
                }
            } else {
                $("#div_validar").html(html);
            }*/console.log(response);
            console.log(response.result);
            if(response.result==true){
                result = correct;
                msg = "";
                $("#div_validar_msg").removeClass('alert alert-danger');
            } else {
                $("#div_validar_msg").addClass('alert alert-danger');
            }
            //$("#div_validar_msg");
            $("#div_validar_msg").html(msg);
            $("#div_validar").html(result);
            console.log(response.msg);
        }).fail(function (jqXHR, textStatus) {
            $("#div_validar").html(incorrect);
            console.log('Ocurrió un error durante el proceso, inténtelo más tarde.');
        }).always(function () {
            remove_loader();
            ocultar_loader();
        });
    }
}
</script>

