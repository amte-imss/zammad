<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo isset($texts["title"]) ? $texts["title"] . "::" : ""; ?>SIPIMSS</title>
    </head>

    <body>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    Inicio de sesión
                    <div class="login-html">
                        <div class="login-form">
                            <?php echo form_open('welcome/index', array('id' => 'session_form')); ?>
                            <div class="sign-in-htm">
                                <div class="group">
                                    <!--label for="user" class="label">Usuario:</label-->
                                    <input id="usuario"
                                           name="usuario"
                                           type="text"
                                           class="input"
                                           placeholder="<?php echo $texts['user']; ?>:">

                                </div>
                                <?php
                                echo form_error_format('usuario');
                                if ($this->session->flashdata('flash_usuario')) {
                                    ?>
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <?php echo $this->session->flashdata('flash_usuario'); ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="group">
                                    <!--label for="pass" class="label">Contraseña:</label-->
                                    <input id="password"
                                           name="password"
                                           type="password"
                                           class="input"
                                           data-type="password"
                                           placeholder="<?php echo $texts['passwd']; ?>:">
                                </div>
                                <?php
                                echo form_error_format('password');
                                if ($this->session->flashdata('flash_password')) {
                                    ?>
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <?php echo $this->session->flashdata('flash_password'); ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="group">
                                    <!--label for="captcha" class="label"></label-->
                                    <input id="captcha"
                                           name="captcha"
                                           type="text"
                                           class="input"
                                           placeholder="<?php echo $texts['captcha']; ?>:">
                                           <?php
                                           echo form_error_format('captcha');
                                           ?>
                                    <br>
                                    <div class="captcha-container" id="captcha_first">
                                        <img id="captcha_img" src="<?php echo site_url(); ?>/welcome/captcha" alt="CAPTCHA Image" />
                                        <a class="btn btn-lg btn-success pull-right" onclick="new_captcha()">
                                            <span class="glyphicon glyphicon-refresh"></span>
                                        </a>
                                    </div>
                                </div>
                                <br>
                                <div class="group">
                                    <input type="submit" class="btn btn-success btn-lg btn-login" value="Iniciar sesión">
                                </div>
                                <?php echo form_close(); ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="">
                    <p><a href="#">Necesita ayuda</a></p>
                    <p>Olvido su contraseña<br>
                      <a href="<?php echo site_url('welcome/recuperar_password'); ?>">Solicitela aquí</a></p>
                </div>
            </div>
        </div>
    </body>
</html>
