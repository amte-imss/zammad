<div class="">
    <div class="modal fade" id="registro-modal" tabindex="-1" role="dialog"  style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="padding:35px 50px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4><span class="glyphicon glyphicon-lock"></span>Registro de usuario</h4>
                </div>
                <div class="modal-body" style="padding:40px 50px;">
                    <div class="login-page">
                        <?php
                        if(isset($registro_valido))
                        {
                            $tipo = $registro_valido['result']?'success':'danger';
                            echo html_message($registro_valido['msg'], $tipo);
                        }
                        ?>
                        <div id="area_registro" class="form">
                            <?php echo form_open('inicio/registro', array('id' => 'registro_form', 'autocomplete' => 'off')); ?>
                            <div class="sign-in-htm">
                                <div class="form-group">
                                    <label for="user" class="pull-left"><span class="glyphicon glyphicon-user"></span> Matrícula:</label>
                                    <?php
                                    echo $this->form_complete->create_element(array('id' => 'reg_usuario',
                                    'type' => 'text',
                                    'value' => isset($post['reg_usuario'])?$post['reg_usuario']:'',
                                    'attributes' => array(
                                        'class' => 'form-control',
                                        'required'=>true,
                                        'placeholder' =>$texts['user']
                                    )));
                                    echo form_error_format('reg_usuario');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="delegacion" class="pull-left"><span class="glyphicon glyphicon-user"></span> Delegación:</label>
                                    <?php
                                    echo $this->form_complete->create_element(array('id' => 'id_delegacion',
                                    'type' => 'dropdown',
                                    'first' => array('' => 'Seleccione una opción'),
                                    'options' => $delegaciones,
                                    'value' => isset($post['id_delegacion'])?$post['id_delegacion']:'',
                                    'attributes' => array(
                                        'class' => 'form-control',
                                        'required'=>true,
                                        'placeholder' =>$texts['user']
                                    )));
                                    echo form_error_format('delegacion');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="delegacion" class="pull-left"><span class="glyphicon glyphicon-user"></span> Correo electrónico:</label>
                                    <?php
                                    echo $this->form_complete->create_element(array('id' => 'reg_email',
                                    'type' => 'email',
                                    'value' => isset($post['reg_email'])?$post['reg_email']:'',
                                    'attributes' => array(
                                        'class' => 'form-control',
                                        'required'=>true,
                                        'placeholder' =>$texts['email']
                                    )));
                                    echo form_error_format('reg_email');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="reg_password" class="pull-left"><span class="glyphicon glyphicon-eye-open"></span> Contraseña:</label>
                                    <?php
                                    echo $this->form_complete->create_element(array('id' => 'reg_password',
                                    'type' => 'password',
                                    'value' => isset($post['reg_password'])?$post['reg_password']:'',
                                    'attributes' => array(
                                        'class' => 'input form-control',
                                        'required'=>true,
                                        'placeholder' =>$texts['passwd']
                                    )));
                                    echo form_error_format('reg_password');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="reg_repassword" class="pull-left"><span class="glyphicon glyphicon-eye-open"></span> Confirma contraseña:</label>
                                    <?php
                                    echo $this->form_complete->create_element(array('id' => 'reg_repassword',
                                    'type' => 'password',
                                    'value' => isset($post['reg_repassword'])?$post['reg_repassword']:'',
                                    'attributes' => array(
                                        'class' => 'input form-control',
                                        'required'=>true,
                                        'placeholder' =>$texts['passwd']
                                    )));
                                    echo form_error_format('reg_repassword');
                                    ?>
                                </div>
                                <div class="form-group" style="text-align:center;">
                                    <label for="reg_captcha" class="pull-left"><span class="glyphicon glyphicon-text-width"></span> Escribe el texto de la imagen:</label>
                                    <?php
                                    echo $this->form_complete->create_element(array('id' => 'reg_captcha',
                                    'type' => 'text',
                                    'value' => isset($post['reg_captcha'])?$post['reg_captcha']:'',
                                    'attributes' => array(
                                        'class' => 'form-control',
                                        'required'=>true,
                                        'placeholder' =>$texts['captcha']
                                    )));
                                    echo form_error_format('reg_captcha');
                                    ?>
                                    <br>
                                    <div class="captcha-container" id="captcha_first">
                                        <img id="captcha_img" class="captcha" src="<?php echo site_url(); ?>/inicio/captcha" alt="CAPTCHA Image" />
                                        <a class="btn btn-lg btn-success pull-right" onclick="new_captcha()">
                                            <span class="glyphicon glyphicon-refresh"></span>
                                        </a>
                                    </div>
                                </div>
                                <br>
                                <div class="">
                                    <input type="submit" class="btn btn-success btn-block" value="Iniciar sesión">
                                </div>

                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="">
                        <p><!-- <a href="#">¿Necesita ayuda? <span class="glyphicon glyphicon-question-sign"></span></a> --><br>
                            ¿Olvidó su contraseña?<br>
                            <a href="<?php echo site_url('inicio/recuperar_password'); ?>">Solicitela aquí</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        new_captcha();
        prepara_form_registro();
        <?php
        if(isset($registro_valido['result']) && $registro_valido['result'])
        {
        ?>
            $('#area_registro').css('display', 'none');
        <?php
        }
        ?>
    });
</script>
