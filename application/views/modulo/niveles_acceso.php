<?php
    if(isset($status) && $status){
         echo html_message('Usuario actualizado con éxito', 'success');
    }else if(isset($status)){
         echo html_message('Falla al actualizar usuario', 'danger');
    }

    echo form_open('modulo/niveles_acceso/', array('id' => 'form_custom_modulo'));
?>
<input type="hidden" name="modulo" value="<?php echo $id_modulo ?>">
<table class="table  table-bordered table-hover ">
    <thead>
    <th>Nombre</th>
    <th>Activo</th>
</thead>
<tbody>
    <?php
    foreach ($grupos_usuario as $row)
    {
        ?>
        <tr>
            <td><?php echo $row['nombre']; ?></td>
            <td>
                <?php
                echo $this->form_complete->create_element(
                        array('id' => 'activo' . $row['id_grupo'],
                            'type' => 'checkbox',
                            'attributes' => array('name' => 'activo' . $row['id_grupo'],
                                'class' => 'input-sm',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'title' => 'activo',
                                'checked' => (empty($row['activo']) ? false : true))
                        )
                );
                ?>
            </td>
        </tr>
    <?php } ?>
</tbody>
</table>
<div class="col-md-12">
  <div class="col-md-10">

  </div>
  <div class="col-md-2">
      <?php
      echo $this->form_complete->create_element(array(
          'id' => 'btn_submit',
          'type' => 'submit',
          'value' => 'Guardar',
          'attributes' => array(
          'class' => 'btn btn-tpl',
          ),
      ));
      ?>
  </div>
</div>

<br><br>
<?php echo form_close(); ?>
