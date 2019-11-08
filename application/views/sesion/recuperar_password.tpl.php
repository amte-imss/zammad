<div class="col-md-6 col-lg-12">
  <h1 class="section-title">
      <span data-animation="flipInY" data-animation-delay="300" class="icon-inner animated flipInY visible">
          <span class="fa-stack">
              <i class="fa rhex fa-stack-2x"></i><i class="fa fa-key fa-stack-1x"></i>
          </span>
      </span>
      <span data-animation="fadeInRight" data-animation-delay="500" class="title-inner animated fadeInRight visible"><?php echo $language_text['recuperar_contrasenia']['recuperar_contrasenia']; ?></span>
  </h1>
</div>
<div class="col-md-6 col-lg-6">
  <div class="form-background">
    <div class="">
      <?php
      if (!isset($recovery) && !isset($form_recovery) && !isset($success)) {
          ?>
          <div class="login-form">
              <label for="user" class="formulario"><?php echo $language_text['recuperar_contrasenia']['recuperar_contrasenia_texto']; ?></label>
              <?php echo form_open('/inicio/recuperar_password', array('id' => 'session_form')); ?>
              <div class="sign-in-htm">
                  <div class="group">
                      <label for="user" class="formulario"><br><?php echo $language_text['recuperar_contrasenia']['matricula_o_correo_rc']; ?></label>
                      <br>
                      <input id="usuario" name="usuario" type="text" class="input form-control">
                  </div>
                  <br>
                  <?php echo form_error_format('usuario'); ?>
                  <div class="group">
                    <button data-animation="flipInY" data-animation-delay="100" class="btn btn-theme btn-block submit-button" value="<?php echo $language_text['recuperar_contrasenia']['recuperar_contrasenia']; ?>">
                      <?php echo $language_text['recuperar_contrasenia']['recuperar_contrasenia']; ?>
                    </button>
                  </div>
                  <?php echo form_close(); ?>
              </div>
          </div>
          <?php
      } else if (isset($form_recovery)) {
          ?>
          <div class="login-form">
              <label for="user" class="formulario"><?php echo $language_text['recuperar_contrasenia']['instruccion_rc']; ?></label>
              <?php echo form_open('/inicio/recuperar_password/' . $code, array('id' => 'session_form')); ?>
              <div class="sign-in-htm">
                  <div class="group">
                      <label for="new_password" class="formulario"><?php echo $language_text['recuperar_contrasenia']['contrasenia_rc']; ?>:</label><br>
                      <input id="new_password" name="new_password" type="password" class="input form-control" data-type="password">
                  </div>
                  <?php echo form_error_format('new_password'); ?>

                  <div class="group">
                      <label for="new_password_confirm" class="formulario"><?php echo $language_text['recuperar_contrasenia']['confirmar_contrasenia_rc']; ?>:</label><br>
                      <input id="new_password_confirm" name="new_password_confirm" type="password" class="input form-control" data-type="password">
                  </div>
                  <?php echo form_error_format('new_password_confirm'); ?>
                  <div class="group">
                      <input type="submit" data-animation="flipInY" data-animation-delay="100" class="btn btn-theme btn-login" value="<?php echo $language_text['recuperar_contrasenia']['restablecer_contrasenia_rc']; ?>">
                  </div>
                  <?php echo form_close(); ?>
              </div>

          </div>
          <?php
      } else if (isset($success)) {
          ?>
          <label for="user" class="formulario"><?php echo $language_text['recuperar_contrasenia']['msg_exito_rc']; ?></label>
          <?php
      } else {
          if(isset($recovery) && $recovery==false) {
              ?>
              <label for="user" class="formulario"><?php echo $language_text['mensajes']['msg_usuario_no_existe_rc']; ?></label>
              <?php
          } else {
              ?>
              <label for="user" class="formulario"><?php echo $language_text['recuperar_contrasenia']['msg_correo_enviado_rc']; ?></label>
              <?php
          }
      }
      ?>
    </div>
  </div>
</div>
<div class="col-md-6 col-lg-6">
    <?php echo $language_text['inicio_sesion']['convocatoria']; ?>
</div>

