

<!--formulario de registro-->
<?php
if (isset($registro_valido['result']))
{
    //pr($registro_valido);
    $tipo_msg = $registro_valido['result'] ? 'success' : 'danger';
    echo html_message($registro_valido['msg'], $tipo_msg);
}
?>

<?php
if ($formulario_completo)
{
    echo js('registro.js');
    echo form_open('welcome/registro', array('id' => 'form_registro'));
}
?>
<!--Matriculas-->
<div class="form">
    <?php echo form_open('welcome/index', array('id' => 'session_form')); ?>
    <div class="sign-in-htm">
        <div class="form-group">
            <label for="user" class="pull-left"><span class="glyphicon glyphicon-user"></span> Matrícula:</label>
            <input id="matricula" name="matricula" placeholder="Escriba su matrícula" class="input form-control"  type="number" required>
            <?php echo form_error_format('matricula');
            ?>
        </div>

        <div class="form-group">
          <label class="pull-left">Correo electrónico: </label>
          <!-- <div class="col-md-4 inputGroupContainer"> -->
          <input id="email" name="email" placeholder="correo@imss.gob.mx" class="input form-control"  type="email" required>
          <?php echo form_error_format('email'); ?>
        </div>
        <div class="form-group">
          <label class="pull-left">Contraseña: </label>
          <!-- <div class="col-md-4 inputGroupContainer"> -->
              <input id="pass" name="pass" placeholder="Escribe tu contraseña" class="input form-control" type="password" required>
          <?php echo form_error_format('pass'); ?>
        </div>
        <div class="form-group">
          <label class="pull-left">Confirmar contraseña: </label>
          <!-- <div class="col-md-4 inputGroupContainer"> -->
              <input id="repass" name="repass" placeholder="Repite tu contraseña" class="input form-control" type="password" required >
          <?php echo form_error_format('repass'); ?>
        </div>
        <div class="form-group">
          <label class="pull-left">Delegación: </label>
          <!-- <div class="col-md-4 "> -->
              <?php
              echo $this->form_complete->create_element(array('id' => 'delegacion', 'type' => 'dropdown', 'options' => $delegaciones, 'first' => array('' => 'Seleccione una opción'), 'attributes' => array('name' => 'delegacion', 'class' => 'form-control')));
              ?>
          <?php echo form_error_format('delegacion'); ?>
        </div>
        <div class="form-group">
            <label class="pull-left">Captcha: </label>
            <!-- <div class="col-md-4 selectContainer"> -->
                <input id="captcha"
                       name="captcha"
                       type="text"
                       class="input form-control"
                       placeholder="<?php echo $texts['captcha']; ?>:">
                       <?php
                       echo form_error_format('captcha');
                       ?>
                <br>
                <div class="captcha-container" id="captcha_first">
                  <br>
                    <img id="captcha_img" src="<?php echo site_url(); ?>/welcome/captcha" alt="CAPTCHA Image" />
                    <a class="btn btn-lg btn-success pull-right" onclick="new_captcha()">
                        <span class="glyphicon glyphicon-refresh"></span>
                    </a>
                </div>
            <?php echo form_error_format('niveles'); ?>
        </div>







        <br>
        <div class="">
          <button id="submit" name="submit" type="submit" class="btn btn-success btn-block" data-idmodal="#divModal" ><a class="btn-primary">Registrar</a> <span class="glyphicon glyphicon-send"></span></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<!-- </div> -->
<?php
if ($formulario_completo)
{
    echo form_close();
}
?>
