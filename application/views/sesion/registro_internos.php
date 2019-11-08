<?php //pr($language_text);   ?>
<?php
if (isset($registro_valido)) {
    $tipo = $registro_valido['result'] ? 'success' : 'danger';
    echo html_message($registro_valido['msg'], $tipo);
//    pr($tipo_registro);
}
?>

<div id="area_registro_<?php echo $tipo_registro; ?>" class="form area_registro">
    <?php echo form_open('inicio/registro/' . $tipo_registro, array('id' => 'registro_form' . $tipo_registro, 'autocomplete' => 'off')); ?>
    <div class="sign-in-htm">
        <div class="form-group">
            <label class="pull-left form-etiquetas pull-right col-sm-5"><?php echo $language_text['registro_usuario']['matricula']; ?></label>
            <?php
            echo $this->form_complete->create_element(array('id' => 'matricula',
                'type' => 'text',
                'value' => isset($post['matricula']) ? $post['matricula'] : '',
                'attributes' => array(
                    'class' => ' form-control',
            )));

            echo form_error_format('matricula');
            ?>
        </div>
        <div class="form-group">
            <label class="pull-left form-etiquetas pull-right col-sm-5"><?php echo $language_text['registro_usuario']['cve_delegacion']; ?></label>
            <?php
            echo $this->form_complete->create_element(array('id' => 'cve_delegacion',
                'type' => 'dropdown',
                'first' => array('' => $language_text['registro_usuario']['cve_delegacion']),
                'options' => $delegaciones,
                'value' => isset($post['cve_delegacion']) ? $post['cve_delegacion'] : '',
                'attributes' => array(
                    'class' => 'form-control',
            )));

            echo form_error_format('cve_delegacion');
            ?>
        </div>
        <div class="form-group">
            <label class="pull-left form-etiquetas pull-right col-sm-5"><?php echo $language_text['registro_usuario']['ext_mail']; ?></label>
            <?php
            echo $this->form_complete->create_element(array('id' => 'ext_mail',
                'type' => 'email',
                'value' => isset($post['ext_mail']) ? $post['ext_mail'] : '',
                'attributes' => array(
                    'class' => 'form-control',
            )));

            echo form_error_format('ext_mail');
            ?>
        </div>
        <div class="form-group">
            <label class="pull-left form-etiquetas pull-right col-sm-5"><?php echo $language_text['registro_usuario']['telefono_personal']; ?></label>

            <?php
            echo $this->form_complete->create_element(array('id' => 'telefono_personal',
                'type' => 'numeric',
                'value' => isset($post['telefono_personal']) ? $post['telefono_personal'] : '',
                'attributes' => array(
                    'class' => 'input form-control',
            )));

            echo form_error_format('telefono_personal');
            ?>
        </div>
        <div class="form-group">
            <label class="pull-left form-etiquetas pull-right col-sm-5"><?php echo $language_text['registro_usuario']['telefono_oficina']; ?></label>

            <?php
            echo $this->form_complete->create_element(array('id' => 'telefono_oficina',
                'type' => 'numeric',
                'value' => isset($post['telefono_oficina']) ? $post['telefono_oficina'] : '',
                'attributes' => array(
                    'class' => ' input form-control',
            )));

            echo form_error_format('telefono_oficina');
            ?>
        </div>
        <div class="form-group">
            <label class="pull-left form-etiquetas pull-right col-sm-5"><?php echo $language_text['registro_usuario']['pais_origen']; ?></label>
            <?php
            echo $this->form_complete->create_element(array('id' => 'pais_origen',
                'type' => 'dropdown',
                'first' => array('' => $language_text['registro_usuario']['pais_origen']),
                'options' => $paises,
                'value' => isset($post['pais_origen']) ? $post['pais_origen'] : 'MX',
                'attributes' => array(
                    'class' => 'form-control',
                    'style' => 'max-width:210px'
            )));
            echo form_error_format('pais_origen');
            ?>
        </div>
        <div class="form-group">
            <label class="pull-left form-etiquetas pull-right col-sm-5"><?php echo $language_text['registro_usuario']['reg_password']; ?></label>
            <?php
            echo $this->form_complete->create_element(array('id' => 'reg_password',
                'type' => 'password',
                'value' => isset($post['reg_password']) ? $post['reg_password'] : '',
                'attributes' => array(
                    'class' => 'input form-control',
            )));

            echo form_error_format('reg_password');
            ?>
        </div>
        <div class="form-group">
            <label class="pull-left form-etiquetas pull-right col-sm-5"><?php echo $language_text['registro_usuario']['reg_repassword']; ?></label>
            <?php
            echo $this->form_complete->create_element(array('id' => 'reg_repassword',
                'type' => 'password',
                'value' => isset($post['reg_repassword']) ? $post['reg_repassword'] : '',
                'attributes' => array(
                    'class' => 'input form-control',
            )));

            echo form_error_format('reg_repassword');
            ?>
        </div>
        <div class="form-group" style="text-align:center;">
            <label class="pull-left form-etiquetas pull-right col-sm-5"><?php echo $language_text['registro_usuario']['reg_captcha']; ?></label>
            <input id="reg_captcha"
                   name="reg_captcha"
                   type="text"
                   class="form-control">
                   <?php
                   echo form_error_format('reg_captcha');
                   ?>
            <br>
            <div class="captcha-container" id="captcha_first">
                <img id="captcha_img" class="captcha" src="<?php echo site_url(); ?>/inicio/captcha" alt="CAPTCHA Image" />
                <a class="btn btn-lg btn-theme pull-right" onclick="new_captcha()">
                    <span class="glyphicon glyphicon-refresh"></span>
                </a>
            </div>
        </div>
        <div class="col-sm-12 text-justify">
            <label><?php echo isset($language_text['registro_usuario']['reg_nota'])?$language_text['registro_usuario']['reg_nota']:''; ?></label>
        </div>
        <br>
        <div class="col-sm-12">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <input id="regform" type="button" data-animation="flipInY" data-animation-delay="100" class="btn btn-theme btn-block submit-button" value="<?php echo $language_text['registro_usuario']['registrar']; ?>" data-tpform="<?php echo $tipo_registro; ?>">
            </div>
        </div>
        <div style="clear:both;" ></div>
    </div>
    <?php echo form_close(); ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#regform").on('click', function (e) {
            var tipoform = $(this).data('tpform');
            var div = "#r_" + tipoform;
            data_ajax_modificada(site_url + '/inicio/registro/' + tipoform, '#registro_form' + tipoform, div);
        });
    });

    function data_ajax_modificada(path, form_recurso, elemento_resultado, callback, is_json, parametros) {
        var dataSend = $(form_recurso).serialize();
        $.ajax({
            url: path,
            data: dataSend,
            method: 'POST',
            beforeSend: function (xhr) {
    //            $(elemento_resultado).html(create_loader());
                mostrar_loader();
            }
        }).done(function (response) {
            var html = response;
            var json = null;
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
                    $(elemento_resultado).html(html).promise().done(callback(parametros));
                } else {
                    $(elemento_resultado).html(html).promise().done(callback());
                }
            } else {
                $(elemento_resultado).html(html);
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            $(elemento_resultado).html("<div class='alert alert-danger'><?php echo isset($language_text['registro_usuario']['reg_mensaje_error'])?$language_text['registro_usuario']['reg_mensaje_error']:''; ?></div>");
            // console.log(jqXHR);
            if(jqXHR.responseText.indexOf('<script') > -1){
                document.location.href = site_url + '/inicio/index';
            }
        }).always(function () {
            remove_loader();
            ocultar_loader();
        });
    }
</script>
