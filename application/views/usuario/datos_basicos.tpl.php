<?php
if (isset($status) && $status)
{
    echo html_message('Usuario actualizado con éxito', 'success');
}
// pr($usuario);
?>

<div class="col-md-12 form-inline" role="form" id="informacion_general">
  <!--<form class="form-horizontal" id="form_datos_generales" method="post" accept-charset="utf-8">-->
  <?php
    //if($usuario['es_imss']){
  ?>
  <div class="col-sm-12">
    <div class="col-sm-6 text-center">
      <label> Usuario: </label>
      <br>
      <?php
        echo $this->form_complete->create_element(array(
            'id' => 'username',
            'type' => 'text',
            'value' => $usuario['username'],
            'attributes' => array(
                'readonly' => '',
                'class' => 'form-control',
                'style' => 'color: #6d7a83'
            )));
      ?>
    </div>
    <div class="col-sm-6 text-center">
      <label> Correo electrónico: </label>
      <br>
      <?php
      echo $this->form_complete->create_element(array(
          'id' => 'email',
          'type' => 'text',
          'value' => $usuario['email'],
          'attributes' => array('class' => 'form-control')));
      ?>
      <?php echo form_error_format('email');?>
    </div>
  </div>
  <?php
    //}
  ?>
  <!--</form>-->
</div>
<div class="col-sm-12"><br></div>
<div class="col-md-12">
  <div class="col-md-5"></div>
  <div class="col-md-1">
    <button name="submit" type="submit" class="btn btn-success"  style=" background-color:#008EAD">Guardar <span class=""></span></button>
  </div>
</div>
