<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo isset($texts["title"]) ? $texts["title"] . "::" : ""; ?> SIPIMSS</title>
        <?php echo css('bootstrap.css'); ?>
        <?php echo css('style_login.css'); ?>
        <?php echo js('captcha.js'); ?>
        <script type="text/javascript">
            var url = "<?php echo base_url(); ?>";
            var site_url = "<?php echo site_url(); ?>";
            var img_url_loader = "<?php echo base_url('assets/img/loader.gif'); ?>";
        </script>
    </head>
    <body>
        <div class="col-md-14">
            <!-- /. NAV TOP  -->
            <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">

                <!-- LLAMAR NAVTOP.PHP -->
                <div class="navbar-header">

                </div>
                <div class="notifications-wrapper">
                    <ul class="nav">

                        <li class="nav pull-right">
                            <ul class="">
                                <li>
                                    <button type="button" name="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#login-modal">
                                        Inicio de sesión
                                    </button>
                                </li>
                                <li>
                                    <button id="boton_registro" type="button" name="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#registro-modal">
                                        Registro
                                    </button>
                                </li>
                                <li>
                                  <!-- <a href="#"><img img-responsive class"logos" height="70px" src="assets/img/template_sipimss/sipimss.png" alt=""></a> -->
                                    <a href="#">
                                        <img img-responsive src="<?php echo asset_url(); ?>img/template_sipimss/sipimss.png"
                                             height="70px"
                                             class="logos"
                                             alt="SIPIMSS"
                                             title="SIPIMSS"
                                             target="_blank"/>
                                    </a>
                                </li>
                                <li>
                                  <!-- <a href="#"><img img-responsive class"logos" height="70px" src="assets/img/template_sipimss/ces.png" alt=""></a> -->
                                    <a href="http://educacionensalud.imss.gob.mx">
                                        <img img-responsive src="<?php echo asset_url(); ?>img/template_sipimss/ces.png"
                                             height="70px"
                                             class="logos"
                                             alt="CES"
                                             title="CES"
                                             target="_blank"/>
                                    </a>
                                </li>
                                <li>
                                  <!-- <a href="#"><img img-responsive class"logos" height="70px" src="assets/img/template_sipimss/imss.png" alt=""></a> -->
                                    <a href="http://www.imss.gob.mx/">
                                        <img img-responsive src="<?php echo asset_url(); ?>img/template_sipimss/imss.png"
                                             height="70px"
                                             class="logos"
                                             alt="IMSS"
                                             title="IMSS"
                                             target="_blank"/>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>


            </nav>
            <!-- <div class="col-md-7">
  
            </div>
            <div class="col-md-2">
              <button type="button" name="button" class="btn btn-success" data-toggle="modal" data-target="#login-modal">
                Login
              </button> -->

        </div>

    </div>
    <div class="wrapper">
        <div class="container">
            <!-- Registro modal -->
            <div class="modal fade" id="registro-modal" tabindex="-1" role="dialog"  style="display: none;">
                <div class="modal-dialog" id="registro_modal_content">                    
                </div>
            </div>
            <!-- end registro modal -->
            <!-- Modal login-->
            <div class="modal fade" id="login-modal" tabindex="-1" role="dialog"  style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="padding:35px 50px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4><span class="glyphicon glyphicon-lock"></span>Iniciar sesión</h4>
                        </div>
                        <div class="modal-body" style="padding:40px 50px;">
                            <div class="login-page">
                                <div class="form">
                                    <?php echo form_open('welcome/index', array('id' => 'session_form')); ?>
                                    <div class="sign-in-htm">
                                        <div class="form-group">
                                            <label for="user" class="pull-left"><span class="glyphicon glyphicon-user"></span> Matrícula:</label>
                                            <input id="usuario"
                                                   name="usuario"
                                                   type="text"
                                                   class="input form-control"
                                                   placeholder="<?php echo $texts['user']; ?>:">

                                        </div>
                                        <?php
                                        echo form_error_format('usuario');
                                        if ($this->session->flashdata('flash_usuario'))
                                        {
                                            ?>
                                            <div class="alert alert-danger" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <?php echo $this->session->flashdata('flash_usuario');
                                                ?>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="form-group">
                                            <label for="pass" class="pull-left"><span class="glyphicon glyphicon-eye-open"></span> Contraseña:</label>
                                            <input id="password"
                                                   name="password"
                                                   type="password"
                                                   class="input form-control"
                                                   data-type="password"
                                                   placeholder="<?php echo $texts['passwd']; ?>:">
                                        </div>
                                        <?php
                                        echo form_error_format('password');
                                        if ($this->session->flashdata('flash_password'))
                                        {
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
                                        <div class="form-group" style="text-align:center;">
                                            <!--label for="captcha" class="label"></label-->
                                            <input id="captcha"

                                                   name="captcha"
                                                   type="text"
                                                   class="input form-control "
                                                   placeholder="<?php echo $texts['captcha']; ?>">
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
                                        <div class="">
                                            <input type="submit" class="btn btn-success btn-block" value="Iniciar sesión">
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="">

                                <p><a href="#">¿Necesita ayuda? <span class="glyphicon glyphicon-question-sign"></span></a><br>
                                    ¿Olvidó su contraseña?<br>
                                    <!-- <a href="#" data-toggle="modal" data-target="#recuperar-contraseña-modal">Solicitela aquí <span class="glyphicon glyphicon-info-sign"></span></a> -->
                                   <!-- <a "<?php //echo site_url('welcome/recuperar_password')    ?>">Solicitala aqui</a> </p> -->
                                    <!-- <a onclick="recovery_password()">Solicitala aqui </a></p> -->
                                    <a href="<?php echo site_url('welcome/recuperar_password'); ?>">Solicitela aquí</a></p>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- /Modal login -->

        </div>
        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>


        </ul>
    </div>
    <?php echo js("jquery.js"); ?>
    <?php echo js("jquery.min.js"); ?>
    <?php echo js("jquery.ui.min.js"); ?>
    <?php echo js('template_sipimss/general.js'); ?>
    <?php echo js("login.js"); ?>
    <?php echo js("bootstrap.js"); ?>
    <script>

<?php
if (isset($errores))
{
    ?>
            $('#login-modal').modal({show: true});
    <?php
}

if (isset($user_recovery) || isset($code_recovery))
{
    ?>
            $('#modalRecovery').modal({show: true});
    <?php
}
?>
    </script>

</body>



</html>
