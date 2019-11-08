<br><br>

<h1 class="section-title">
  <span data-animation="flipInY" data-animation-delay="100" class="icon-inner animated flipInY visible"><span class="fa-stack"><i class="fa rhex fa-stack-2x"></i><i class="fa fa-ticket fa-stack-1x"></i></span></span>
  <span data-animation="fadeInRight" data-animation-delay="100" class="title-inner animated fadeInRight visible">Editar perfil</span>
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
      <?php echo form_open('perfil/editar', array('id' => 'form_editar_usuario_externos', 'autocomplete' => 'off')); ?>
      <br>
      <div class="col-sm-12 af-outer af-required">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-3">
          <label for=""><?php echo $language_text['registro_usuario']['ext_nombre']; ?></label>
        </div>
        <div class="">
          <input type="text" id="ext_nombre" name="ext_nombre" value="<?php echo $datos_usuario['nombre'] ?>" class="form-control placeholder" size="30">
        </div>
      </div>
      <div class="col-sm-3"></div>
      <div class="col-sm-7">
        <?php echo form_error_format('ext_nombre');?>
      </div>
      <br><br>
      <div class="col-sm-12 af-outer af-required">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-3">
          <label for=""><?php echo $language_text['registro_usuario']['ext_ap'];?></label>
        </div>
        <div class="">
          <input type="text" id="ext_ap" name="ext_ap" value="<?php echo $datos_usuario['apellido_paterno'] ?>" class="form-control placeholder" size="30">
        </div>
      </div>
      <div class="col-sm-3"></div>
      <div class="col-sm-7">
        <?php echo form_error_format('ext_ap');?>
      </div>
      <br><br>
      <div class="col-sm-12 af-outer af-required">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-3">
          <label for=""><?php echo $language_text['registro_usuario']['ext_am'];?></label>
        </div>
        <div class="">
          <input type="text" id="ext_am" name="ext_am" value="<?php echo $datos_usuario['apellido_materno'] ?>" class="form-control placeholder" size="30">
        </div>
      </div>
      <div class="col-sm-3"></div>
      <div class="col-sm-7">
        <?php echo form_error_format('ext_am');?>
      </div>
      <br><br>
      <div class="col-sm-12 af-outer af-required">
        <div class="col-sm-2"></div>
        <div class="col-sm-2">
          <label for=""><?php echo $language_text['registro_usuario']['sexo'];?></label>
        </div>
        <div class="col-sm-6">
          <div class="col-md-3">
              <?php echo form_radio(array('name' => 'sexo', 'value' => En_sexo::MASCULINO, 'checked' => (isset($datos_usuario['sexo']) && $datos_usuario['sexo'] == 'M') ? true : false, 'id' => 'sexo')) . form_label($language_text['registro_usuario']['ext_sexo_m'], 'male'); ?>
          </div>
          <div class="col-md-3">
              <?php echo form_radio(array('name' => 'sexo', 'value' => En_sexo::FEMENINO, 'checked' => (isset($datos_usuario['sexo']) && $datos_usuario['sexo'] == 'F') ? true : false, 'id' => 'sexo')) . form_label($language_text['registro_usuario']['ext_sexo_f'], 'female'); ?>
          </div>
          <div class="col-md-3">
              <?php echo form_radio(array('name' => 'sexo', 'value' => En_sexo::OTRO, 'checked' => (isset($datos_usuario['sexo']) && $datos_usuario['sexo'] == 'O') ? true : false, 'id' => 'sexo')) . form_label($language_text['registro_usuario']['ext_sexo_o'], 'otro'); ?>
          </div>
        </div>
      </div>
      <div class="col-sm-3"></div>
      <div class="col-sm-7">
        <?php echo form_error_format('sexo');?>
      </div>
      <br><br>
      <div class="col-sm-12 af-outer af-required">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-3">
          <label for=""><?php echo $language_text['registro_usuario']['ext_mail'];?></label>
        </div>
        <div class="">
          <input type="text" id="ext_mail" name="ext_mail" value="<?php echo $datos_usuario['email'] ?>" class="form-control placeholder" size="30">
        </div>
      </div>
      <br><br>
      <div class="col-sm-3"></div>
      <div class="col-sm-7">
        <?php echo form_error_format('ext_mail');?>
      </div>
      <div class="col-sm-12 af-outer af-required">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-3">
          <label for=""><?php echo $language_text['registro_usuario']['telefono_personal'];?></label>
        </div>
        <div class="">
          <input type="text" id="telefono_personal" name="telefono_personal" value="<?php echo $datos_usuario['telefono_personal'] ?>" class="form-control placeholder" size="30">
        </div>
      </div>
      <div class="col-sm-3"></div>
      <div class="col-sm-7">
        <?php echo form_error_format('telefono_personal');?>
      </div>
      <br><br>
      <div class="col-sm-12 af-outer af-required">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-3">
          <label for=""><?php echo $language_text['registro_usuario']['telefono_oficina'];?></label>
        </div>
        <div class="">
          <input type="text" id="telefono_oficina" name="telefono_oficina" value="<?php echo $datos_usuario['telefono_oficina'] ?>" class="form-control placeholder" size="30">
        </div>
      </div>
      <div class="col-sm-3"></div>
      <div class="col-sm-7">
        <?php echo form_error_format('telefono_oficina');?>
      </div>
      <br><br>
      <div class="col-sm-12 af-outer af-required">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-3">
          <label for=""><?php echo $language_text['registro_usuario']['pais_origen'];?></label>
        </div>
        <div class="">
          <?php
            echo $this->form_complete->create_element(array('id' => 'pais_origen',
              'type' => 'dropdown',
              'first' => array('' => $language_text['registro_usuario']['pais_origen']),
              'options' => $paises,
              'value' => isset($datos_usuario['clave_pais']) ? $datos_usuario['clave_pais'] : 'MX',
              'attributes' => array(
                  'class' => 'form-control',
                  'style' => 'max-width:210px'
            )));
          ?>
        </div>
      </div>
      <div class="col-sm-3"></div>
      <div class="col-sm-7">
        <?php echo form_error_format('pais_origen');?>
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
