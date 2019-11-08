<?php
if (isset($registro_valido)) {
    $tipo = $registro_valido['result'] ? 'success' : 'danger';
    echo html_message($registro_valido['msg'], $tipo);
}
?>

<div id="area_registro_<?php echo $tipo_registro; ?>" class="form area_registro">
    <?php echo form_open('inicio/registro/' . $tipo_registro, array('id' => 'registro_form' . $tipo_registro, 'autocomplete' => 'off')); ?>
    <div class="sign-in-htm">
        <div class="form-group">
            <label class="pull-left form-etiquetas pull-right col-sm-5"><?php echo $language_text['registro_usuario']['ext_nombre']; ?></label>
            <?php
            echo $this->form_complete->create_element(array('id' => 'ext_nombre',
                'type' => 'text',
                'value' => isset($post['ext_nombre']) ? $post['ext_nombre'] : '',
                'attributes' => array(
                    'class' => 'form-control',
            )));
            echo form_error_format('ext_nombre');
            ?>
        </div>
        <div class="form-group">
            <label class="pull-left form-etiquetas pull-right col-sm-5"><?php echo $language_text['registro_usuario']['ext_ap']; ?></label>
            <?php
            echo $this->form_complete->create_element(array('id' => 'ext_ap',
                'type' => 'text',
                'value' => isset($post['ext_ap']) ? $post['ext_ap'] : '',
                'attributes' => array(
                    'class' => 'form-control',
            )));
            echo form_error_format('ext_ap');
            ?>
        </div>
        <div class="form-group">
            <label class="pull-left form-etiquetas pull-right col-sm-5"><?php echo $language_text['registro_usuario']['ext_am']; ?></label>
            <?php
            echo $this->form_complete->create_element(array('id' => 'ext_am',
                'type' => 'text',
                'value' => isset($post['ext_am']) ? $post['ext_am'] : '',
                'attributes' => array(
                    'class' => 'form-control',
            )));
            echo form_error_format('ext_am');
            ?>
        </div>
        <div class="form-group">
            <div class="col-md-12">

                <div class="col-md-3 form-etiqueta">
                    <?php echo form_label($language_text['registro_usuario']['sexo'], 'sexo'); ?>

                </div>
                <div class="col-md-3">
                    <?php echo form_radio(array('name' => 'ext_sexo', 'value' => En_sexo::MASCULINO, 'checked' => (isset($post['ext_sexo']) && $post['ext_sexo'] == 'M') ? true : false, 'id' => 'ext_sexo')) . form_label($language_text['registro_usuario']['ext_sexo_m'], 'male'); ?>
                </div>
                <div class="col-md-3">
                    <?php echo form_radio(array('name' => 'ext_sexo', 'value' => En_sexo::FEMENINO, 'checked' => (isset($post['ext_sexo']) && $post['ext_sexo'] == 'F') ? true : false, 'id' => 'ext_sexo')) . form_label($language_text['registro_usuario']['ext_sexo_f'], 'female'); ?>
                </div>
                <div class="col-md-3">
                    <?php echo form_radio(array('name' => 'ext_sexo', 'value' => En_sexo::OTRO, 'checked' => (isset($post['ext_sexo']) && $post['ext_sexo'] == 'O') ? true : false, 'id' => 'ext_sexo')) . form_label($language_text['registro_usuario']['ext_sexo_o'], 'otro'); ?>
                </div>
            </div>
            <div class="col-md-12">
                <?php echo form_error_format('ext_sexo'); ?>
            </div>
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
                    'class' => 'input form-control',
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
            <label class="pull-left form-etiquetas pull-right col-sm-5"><?php echo $language_text['registro_usuario']['pais_institucion']; ?></label>
            <?php
            echo $this->form_complete->create_element(array('id' => 'pais_institucion',
                'type' => 'dropdown',
                'first' => array('' => $language_text['registro_usuario']['pais_institucion']),
                'options' => $paises,
                'value' => isset($post['pais_institucion']) ? $post['pais_institucion'] : 'MX',
                'attributes' => array(
                    'class' => 'form-control',
                    'style' => 'max-width:210px'
            )));
            echo form_error_format('pais_institucion');
            ?>
        </div>
        <div class="form-group">
            <label class="pull-left form-etiquetas pull-right col-sm-5"><?php echo $language_text['registro_usuario']['institucion']; ?></label>
            <?php
            echo $this->form_complete->create_element(array('id' => 'institucion',
                'type' => 'text',
                'value' => isset($post['institucion']) ? $post['institucion'] : '',
                'attributes' => array(
                    'class' => 'input form-control',
            )));
            echo form_error_format('institucion');
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
//                    'required' => true,
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
        <br>
        <div class="col-sm-12">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <input type="button" id="regform_ext" data-animation="flipInY" data-animation-delay="100" class="btn btn-theme btn-block submit-button" value="<?php echo $language_text['registro_usuario']['registrar']; ?>" data-tpform="<?php echo $tipo_registro; ?>">
            </div>
        </div>

    </div>
    <?php echo form_close(); ?>
    <br><br>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#regform_ext").on('click', function (e) {
            var tipoform = $(this).data('tpform');
            var div = "#r_" + tipoform;
            data_ajax(site_url + '/inicio/registro/' + tipoform, '#registro_form' + tipoform, div);
        });
    });
</script>
