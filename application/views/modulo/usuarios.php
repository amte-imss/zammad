<div class="row">
    <div class="col col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div>
                    <?php
                    echo form_open('modulo/usuario/', array('id' => 'form_custom_modulo'));
                    ?>
                    <input type="hidden" name="modulo" value="<?php echo $id_modulo ?>">
                    <input type="hidden" id="usuario_activo" name="activo" value="1">
                    <div class="form-group col-md-12">
                        <div class="col-md-6">

                                <div class="input-group input-group-sm">
                                  <span class="input-group-addon">Matrícula</span>
                                  <input type="text" class="form-control" aria-label="..." name="matricula">

                                </div><!-- /btn-group -->

                        </div><!-- /.col-lg-6 -->
                        <div class="col-md-6">
                            <div class="input-group input-group-sm">

                                  <span class="input-group-addon">Tipo</span>
                                  <?php
                                  echo $this->form_complete->create_element(array(
                                      'id' => 'tipo',
                                      'type' => 'dropdown',
                                      'value' => '',
                                      'options' => $tipos,
                                      'attributes' => array(
                                      'class' => 'form-control',
                                      ),
                                  ));
                                  ?>
                              </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                      <div class="col-md-12">
                        <br>
                        <div class="col-md-10">

                        </div>
                        <div class="col-md-2">
                            <?php
                            echo $this->form_complete->create_element(array(
                                'id' => 'btn_submit',
                                'type' => 'submit',
                                'value' => 'Agregar',
                                'attributes' => array(
                                'class' => 'btn btn-tpl',
                                ),
                            ));
                            ?>
                            <br>
                        </div>


                      </div>

                    </div><!-- /.row -->
                    <?php echo form_close(); ?>
                    <!--tablas de usuarios-->

                    <div id="sipimss_tabla">
                          <br>  <br> 

                        <?php echo $tabla; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo form_open('modulo/usuario/', array('id' => 'form_modulo_usuarios')); ?>
<input type="hidden" id="usuario" name="usuario">
<input type="hidden" name="modulo" value="<?php echo $id_modulo ?>">
<input type="hidden" id="usuario_activo" name="activo" value="0">
<?php echo form_close(); ?>
