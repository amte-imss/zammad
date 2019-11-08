
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo isset($texts["title"]) ? $texts["title"] . "::" : ""; ?>SIPIMSS</title>
        <?php echo css('bootstrap.css'); ?>
        <?php echo css('style_login.css'); ?>
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
                            <button type="button" name="button" class="btn btn-md btn-success" onclick="welcome/index()">
                              Inicio de sesión
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
        <div class="wrapper">
          <div class="container">

            <!-- Modal recovery pass-->

            <div class="modal" aria-hidden="true" id="modalRecovery" tabindex="-1" role="document" >
             <div class="modal-dialog">
               <div class="modal-content">
                <div class="modal-header" style="padding:35px 50px;">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4><span class="glyphicon glyphicon-lock"></span>Recuperar contraseña</h4>
                </div>
                <div id="modal_recovery" class="modal-body" style="padding:40px 50px;">
                  <div class="login-page">
                    <div class="form">
                      <?php
                      if (!isset($recovery) && !isset($form_recovery) && !isset($success)) {
                          ?>
                          <div class="login-form">
                              <p >¿Perdiste tu constraseña? Por favor introduce tu nombre de usuario o correo electrónico. Recibirás un enlace para crear una contraseña nueva por correo electronico.</p>
                              <?php echo form_open('welcome/recuperar_password', array('id' => 'session_form')); ?>
                              <div class="sign-in-htm">
                                  <div class="group">
                                      <label for="user">Nombre de usuario o correo electrónico:</label>
                                      <br>
                                      <input id="usuario" name="usuario" type="text" class="input form-control">
                                  </div>
                                  <br>
                                  <?php echo form_error_format('usuario'); ?>
                                  <div class="group">
                                    <button  onclick="data_ajax(site_url + 'welcome/recuperar_password', null, '#modal_recovery');" class="btn btn-success btn-block" value="Restablecer contraseña">
                                      Restablecer contraseña
                                    </button>
                                      <!-- <input type="submit" class="btn btn-success btn-block" value="Restablecer contraseña"> -->
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
                                      <input type="submit" class="btn btn-success btn-login" value="Restablecer contraseña">
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
                <div class="modal-footer">
                  <!-- <div class="">

                      <p><a href="#">¿Necesita ayuda? <span class="glyphicon glyphicon-question-sign"></span></a><br>
                         ¿Olvidó su contraseña?<br>
                        <a href="<?php //echo site_url('welcome/recuperar_password'); ?>">Solicitela aquí <span class="glyphicon glyphicon-info-sign"></span></a> </p>
                  </div> -->
                </div>
              </div>

               </div>

            <!-- /Modal recovery pass -->


</div>
<ul class="bg-bubbles">
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
// <?php //echo js("login.js"); ?>
<?php echo js("bootstrap.js"); ?>

<script type="text/javascript">
        $('#modalRecovery').modal('show');
</script>


    </body>



</html>
