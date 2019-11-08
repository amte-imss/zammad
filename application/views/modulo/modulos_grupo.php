<?php echo js('modulo/formulario_modulos_grupo.js'); ?>
<div>
    <?php
    echo form_open('modulo/get_modulos_grupo/', array('id' => 'form_modulos_grupo'));
    ?>
    <input type="hidden" name="grupo" value="<?php echo $grupo; ?>">
    <?php echo render_modulos_grupo($this, $modulos); ?>
    <div class="col-md-4">
        <?php
        echo $this->form_complete->create_element(array(
            'id' => 'btn_submit',
            'type' => 'submit',
            'value' => 'Guardar',
            'attributes' => array(
                'class' => 'btn btn-primary',
            ),
        ));
        ?>
    </div>
    <?php
    echo form_close();
    ?>
</div>