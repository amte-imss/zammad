<br><br>
<h1 class="section-title">
  <span data-animation="flipInY" data-animation-delay="100" class="icon-inner animated flipInY visible"><span class="fa-stack"><i class="fa rhex fa-stack-2x"></i><i class="fa fa-ticket fa-stack-1x"></i></span></span>
  <span data-animation="fadeInRight" data-animation-delay="100" class="title-inner animated fadeInRight visible">Modificar contraseña</span>
</h1>
<section class="panel panel-default">
  <div class="container">
    <div class="row">
      <div class="col-sm-offset-1 col-sm-10">
        <?php
        if(isset($salida))
        {
          echo '<div class="alert alert-'.$salida['msg_type'].'">';
          echo $salida['msg'];
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <?php
        echo '</div>';
        }
      ?>
      </div>
    </div><!--row-->
    <!-- Contact form -->
    <?php echo form_open('perfil/password', array('id' => 'form_editar_password', 'autocomplete' => 'off')); ?>
    <br>
    <div class="col-sm-12 af-outer af-required">
      <div class="col-sm-2">
      </div>
      <div class="col-sm-3">
        <label for=""><?php echo $language_text['registro_usuario']['reg_password']; ?></label>
      </div>
      <div class="">
        <input type="password" id="reg_password" name="reg_password" class="form-control placeholder" size="30">
      </div>
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-7">
      <?php echo form_error_format('reg_password');?>
    </div>
    <br><br>
    <div class="col-sm-12 af-outer af-required">
      <div class="col-sm-2">
      </div>
      <div class="col-sm-3">
        <label for=""><?php echo $language_text['registro_usuario']['reg_repassword']; ?></label>
      </div>
      <div class="">
        <input type="password" id="reg_repassword" name="reg_repassword" class="form-control placeholder" size="30">
      </div>
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-7">
      <?php echo form_error_format('reg_repassword');?>
    </div>
    <br><br>
    <div class="col-sm-12">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <button id="regform" type="submit" class="btn btn-theme btn-block submit-button" onclick="mostrar_loader();"><?php echo $language_text['registro_usuario']['actualizar_registro']; ?></button>
        </div>
    </div>
  <!-- /Contact form -->
  <?php echo form_close(); ?>
  </div>
</section>