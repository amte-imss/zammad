<?php
echo js('idioma/grupos_etiquetas.js');
// pr($usuario);
?>
<?php


if (isset($status) && $status)
{
    echo html_message('Grupo Etiqueta actualizado con éxito', 'success');
}
// pr($usuario);
?>
<div id="page-inner" >

<div id="area_grupo_etiquetas" > 

  <div class="col-sm-12">
      <h1 class="page-head-line">Información Grupo Etiquetas</h1>
      <a href="javascript:history.back()" class="btn btn-success" style=" background-color:#008EAD">Regresar</a>
    </div>
    <div class="col-sm-12">
        <div class=""> <br><br>

        <div class="">
      <?php
echo form_open('idiomas/editar_grupo_etiqueta/'.$datos_grupo_etiqueta['clave_grupo'].'/'.Idiomas::GE, array('id' => 'form_actualizar_ge'));
                ?>


<div class="col-md-12 form-inline" role="form" >

<div class="row">

    <div class="col-md-2">
       <label class="righthoralign control-label">
      Calve Grupo: </label>
    </div>
    <div class="col-md-4">
        <div class="input-group">
          <span class="input-group-addon"><!--<span class="fa fa-male">--></span></span>
            <?php
                echo $this->form_complete->create_element(array(
                    'id' => 'clave_grupo',
                    'type' => 'text',
                    'value' => $datos_grupo_etiqueta['clave_grupo'],
                    'attributes' => array(
                        'class' => 'form-control',
                        'required' => true
                    )));
            ?>

        </div>
        <?php echo form_error_format('clave_grupo'); ?>
    </div>
    <div class="col-md-6">
        <div class="row">
          <div class="col-md-4">
              <label  class="control-label">
                  Nombre:</label>
          </div>
            <div class="col-md-8">
              <div class="input-group">
                       <span class="input-group-addon"><!--<span class="fa fa-male">--></span></span>
                <?php
                echo $this->form_complete->create_element(array(
                    'id' => 'nombre',
                    'type' => 'text',
                    'value' => $datos_grupo_etiqueta['nombre'],
                    'attributes' => array('class' => 'form-control', 'required' => true)));
                ?>
              </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">

    <div class="col-md-2">
       <label class="righthoralign control-label">
      Descripcion: </label>
    </div>
    <div class="col-md-4">
        <div class="input-group">
                <span class="input-group-addon"><!--<span class="fa fa-male">--></span></span>
          <?php
          echo $this->form_complete->create_element(array(
              'id' => 'descripcion',
              'type' => 'text',
              'value' => $datos_grupo_etiqueta['descripcion'],
              'attributes' => array('class' => 'form-control', 'required' => true)));
          ?>

        </div>
    </div>

</div>

</div>

<br>
<div class="col-md-12">
  <div class="col-md-5">

  </div>
  <div class="col-md-1">
      <label class=" control-label"></label>
      <button id="submit" name="submit" type="submit" class="btn btn-success"  style=" background-color:#008EAD">Guardar <span class=""></span></button>
  </div>

</div>

                <?php echo form_close(); ?>

            </div>
        </div>

    </div>
</div>

</div>