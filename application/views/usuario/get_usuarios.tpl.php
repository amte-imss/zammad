<?php echo js('usuario/get_usuarios.js'); ?>

    <div id="page-inner">
      <div class="col-sm-12">
          <h1 class="page-head-line">
            Lista de usuarios
          </h1>
        </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div>
                        <?php
                        echo form_open('usuario/get_usuarios/'.Usuario::LISTA.'/', array('id' => 'form_usuarios'));
                        ?>

                        <div class="row">
                          <div class="col-md-7">

                          </div>

                            <div class="col-lg-4">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button id="btn-filtro-tablero" type="button" class="btn btn-tpl dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Matrícula <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="option-input-tablero" data-id="nombre_completo" href="#">Nombre</a></li>
                                            <li><a class="option-input-tablero" data-id="matricula" href="#">Matrícula</a></li>
                                            <li><a class="option-input-tablero" data-id="email" href="#">Correo electrónico</a></li>
                                        </ul>
                                    </div><!-- /btn-group -->
                                    <input type="text" class="form-control" aria-label="..." name="keyword">
                                </div><!-- /input-group -->
                                <input type="hidden" id="filtro_texto" name="filtro_texto" value="matricula">
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->
                        <br>

                        <?php
                        if (isset($current_row))
                        {
                            ?>
                            <input id="usuarios_current_page" type="hidden" name="current_row" value="<?php echo $current_row; ?>" />
                            <input id="usuarios_limit" type="hidden" name="usuarios_limit" value="<?php echo $per_page; ?>" />
                        <?php }
                        ?>




                        <div class="form-group">
                            <div class="col-md-2">
                                <div class="input-group input-group-sm">
                                    <label >Mostrar</label>
                                    <?php
                                    echo $this->form_complete->create_element(
                                            array('id' => 'per_page',
                                                'type' => 'dropdown',
                                                'value' => $limit,
                                                'options' => array(5 => 5, 10 => 10, 20 => 20, 50 => 50, 100 => 100),
                                                'attributes' => array('name' => 'per_page',
                                                    'class' => 'form-control  form-control input-group-sm',
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top',
                                                    'title' => 'Número de registros a mostrar')
                                            )
                                    );
                                    ?>


                                  <?php echo form_error_format('per_page'); ?>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="input-group input-group-sm">
                                    <label class="input-group">Orden</label>
                                    <?php
                                    echo $this->form_complete->create_element(
                                            array('id' => 'order',
                                                'type' => 'dropdown',
                                                'options' => array(1 => 'Ascendente', 2 => 'Descendente'),
                                                'attributes' => array('name' => 'order',
                                                    'class' => 'form-control  form-control input-sm',
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top',
                                                    'title' => 'Tipo de orden')
                                            )
                                    );
                                    ?>
                                </div>

                                <?php echo form_error_format('order'); ?>


                            </div>


                            <div class="col-md-2">
                              <div class="input-group input-group-sm">
                                <?php
                                echo $this->form_complete->create_element(array(
                                    'id' => 'btn_submit',
                                    'type' => 'submit',
                                    'value' => 'Buscar',
                                    'attributes' => array(
                                    'class' => 'btn btn-tpl',
                                    ),
                                ));
                                ?>
                              </div>
                              <br> <br><br>


                            </div>

                        </div>
                        <?php echo form_close(); ?>

                    </div>


                    <!--tablas de usuarios-->
                    <div class="col-sm-12 table-responsive">


                    <div id="area_usuarios" class=" sorting table table-striped table-bordered table-hover dataTable" cellspacing="0" mwidth="100%" role="grid" aria-describedby="datatable_info" style="width: 100%;">
                        <?php echo $tabla_usuarios; ?>
                    </div>
                    <?php
                    if (isset($paginacion))
                    {
                        echo $paginacion['links'];
                    }
                    ?>
                </div>
                </div>
            </div>

    </div>
  </div>
