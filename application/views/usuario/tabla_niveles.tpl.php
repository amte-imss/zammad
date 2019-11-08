<?php
if (isset($status) && $status)
{
    echo html_message('Usuario actualizado con éxito', 'success');
} else if (isset($status))
{
    echo html_message('Falla al actualizar usuario', 'danger');
}
?>
<input type="hidden" name="niveles" value="1">
<table class="table table-bordered">
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
            <td ><?php echo $row['nombre']; ?></td>
            <td class="text-center">
                <?php
                echo $this->form_complete->create_element(
                        array('id' => 'activo' . $row['id_rol'],
                            'type' => 'checkbox',
                            'attributes' => array('name' => 'activo' . $row['id_rol'],
//                                'class' => 'text-center',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'title' => 'activo',
                                'checked' => $row['activo']
                            )
                        )
                );
                ?>
            </td>
        </tr>
<?php } ?>
</tbody>
</table>
<div class="col-md-12">
  <div class="col-md-5">

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
