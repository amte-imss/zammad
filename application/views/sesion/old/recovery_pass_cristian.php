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
                    <div class="login-wrap">
                        <div class="login-html">
                            <!--<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Entrar</label>-->
                            <!--<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Registrarse</label>-->
                            <div class="login-form">
                                <?php
                                if (!isset($recovery) && !isset($form_recovery) && !isset($success)) {
                                    ?>
                                    <div class="login-form">
                                        <p >¿Perdiste tu constraseña? Por favor introduce tu nombre de usuario o correo electrónico. Recibirás un enlace para crear una contraseña nueva por correo electronico.</p>
                                        <?php echo form_open('welcome/recuperar_password', array('id' => 'session_form')); ?>
                                        <div class="sign-in-htm">
                                            <div class="group">
                                                <label for="user" class="label">Nombre de usuario o correo electrónico</label>
                                                <input id="usuario" name="usuario" type="text" class="input">
                                            </div>
                                            <?php echo form_error_format('usuario'); ?>
                                            <div class="group">
                                                <input type="submit" class="btn btn-success btn-lg btn-login" value="Restablecer contraseña">
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>

                                    </div>
                                    <?php
                                } else if (isset($form_recovery)) {
                                    ?>
                                    <div class="login-form">
                                        <p style="color: #fff;">Por favor indica cual será tu nueva contraseña</p>
                                        <?php echo form_open('welcome/recuperar_password/' . $code, array('id' => 'session_form')); ?>
                                        <div class="sign-in-htm">
                                            <div class="group">
                                                <label for="new_password" class="label">Contraseña:</label>
                                                <input id="new_password" name="new_password" type="password" class="input" data-type="password">
                                            </div>
                                            <?php echo form_error_format('new_password'); ?>

                                            <div class="group">
                                                <label for="new_password_confirm" class="label">Confirmar Contraseña:</label>
                                                <input id="new_password_confirm" name="new_password_confirm" type="password" class="input" data-type="password">
                                            </div>
                                            <?php echo form_error_format('new_password_confirm'); ?>
                                            <div class="group">
                                                <input type="submit" class="btn btn-success btn-lg btn-login" value="Restablecer contraseña">
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>

                                    </div>
                                    <?php
                                } else if (isset($success)) {
                                    ?>
                                    <p >Contraseña actualizada con éxito</p>
                                    <?php
                                } else {
                                    ?>
                                    <p >El sistema ha recibido tu solicud con éxito, recibirás un enlace para crear una contraseña nueva por correo electrónico.</p>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </body>
</html>