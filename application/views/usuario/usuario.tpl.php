<?php
echo js('usuario/usuario.js');
// pr($usuario);
?>
<div id="page-inner">
  <div class="col-sm-12">
    <h1 class="page-head-line">Información general</h1>
  </div>
  <div class="col-sm-12">
      <?php
      echo form_open('usuario/editar/' . $usuario['id_usuario'] . '/' . Usuario::BASICOS, array('id' => 'form_actualizar_interno'));
      ?>
      <div id="area_datos_basicos" class="col-md-12">
          <?php echo $datos_basicos; ?>
      </div>
      <?php echo form_close(); ?>
  </div>
  <div class="col-sm-12"><hr></div>
  <div class="col-sm-12">
    <h1 class="page-head-line">Actividad del usuario</h1>
  </div>
  <div class="col-sm-12">
    <div class="col-sm-4"></div>
    <div class="col-sm-2">
      <label>Actividad</label>
    </div>
    <div id="status_actividad_usuario" class="col-sm-2">
       <?php
       $opciones_actividad = array(
           0 => 'Desactivado', 1 => 'Activo'
       );
       echo form_open('usuario/editar/' . $usuario['id_usuario'] . '/' . Usuario::STATUS_ACTIVIDAD, array('id' => 'form_actualizar_actividad'));

       echo $this->form_complete->create_element(
           array(
               'id' => 'status_actividad',
               'type' => 'dropdown',
               'options' => $opciones_actividad,
               'value' => $usuario['usuario_activo']? 1: 0,
               'attributes' => array(
                   'class' => 'form-control'
               )
           )
       );
       ?>
    </div>
    <div class="col-sm-4">
        <button name="submit" type="submit" class="btn btn-success"  style=" background-color:#008EAD">Guardar <span class=""></span></button>
         <?php echo form_close(); ?>
    </div>
  </div>
  <div class="col-sm-12"><hr></div>
  <div class="col-sm-12">
    <div class="col-sm-12">
      <h1 class="page-head-line">Contraseña de usuario</h1>
    </div>
    <div class="col-md-12">
      <div class="" style="text-aligne:center; width: 650px; text-align: left;">
          <!--form usuario completo-->
          <?php
          echo form_open('usuario/editar/' . $usuario['id_usuario'] . '/' . Usuario::PASSWORD, array('id' => 'form_actualizar_password'));
          ?>
          <div id="campo_password">
              <?php echo $campo_password; ?>
          </div>
          <?php echo form_close(); ?>
      </div>
    </div>
  </div>
  <div class="col-sm-12"><hr></div>
  <div class="col-sm-12">
    <h1 class="page-head-line">Roles del usuario</h1>
  </div>
  <div class="col-sm-12">
    <?php
    echo form_open('usuario/editar/' . $usuario['id_usuario'] . '/' . Usuario::NIVELES_ACCESO, array('id' => 'form_usuario_niveles'));
    ?>
    <div  id="campo_niveles_acceso">
        <?php echo $campo_niveles_acceso; ?>
    </div>
    <?php
    echo form_close();
    ?>
  </div>
</div>
