<div id="page-inner">
    <div class="col-sm-12">
        <h1 class="page-head-line">
            Adscripción
        </h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <div>
                <div class="">
                    <?php
                    echo form_open('', array('id' => 'form_registro','autocomplete'=>"off"));
                    if(isset($status))
                    {
                        $s_tipo = $status['success'] ? 'success':'danger';
                        echo html_message($status['message'], $s_tipo);
                    }
                    ?>
                    <div class="form-inline" role="form">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <div class="col-md-4">
                                    <label for="clave_departamental" class="righthoralign control-label">
                                        <b class="rojo">*</b> Clave adscripción:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-male"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'clave_departamental',
                                        'type' => 'text',
                                        'value' => isset($post['clave_departamental'])?$post['clave_departamental']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'placeholder'=>"Clave de la adscripción",
                                            'required'=>true
                                        )));
                                        ?>
                                        <?php echo form_error_format('clave_departamental'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="display: 1">
                                <div class="col-md-4">
                                    <label for="nombre" class="control-label">
                                        <b class="rojo">*</b> Nombre de la adscripción:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-female"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'nombre',
                                        'type' => 'text',
                                        'value' => isset($post['nombre'])?$post['nombre']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'placeholder'=>"Nombre de la adscripción",
                                            'required'=>true
                                        )));
                                        ?>
                                        <?php echo form_error_format('nombre'); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end row-->
                        <br>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <div class="col-md-4">
                                    <label for="clave_unidad" class="righthoralign control-label">
                                        <b class="rojo">*</b> Clave unidad:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-male"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'clave_unidad',
                                        'type' => 'text',
                                        'value' => isset($post['clave_unidad'])?$post['clave_unidad']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'placeholder'=>"Clave de la unidad/UMAE",
                                            'required'=>true
                                        )));
                                        ?>
                                        <?php echo form_error_format('clave_unidad'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="display: 1">
                                <div class="col-md-4">
                                    <label for="activa" class="control-label">
                                        <b class="rojo">*</b> Activa:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-female"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'activa',
                                        'type' => 'dropdown',
                                        'value' => isset($post['activa'])?$post['activa']:'',
                                        'first' => array('' => 'Seleccione una opción'),
                                        'options' => array(0=>'No', 2=>'Si'),
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'required'=>true
                                        )));
                                        ?>
                                        <?php echo form_error_format('activa'); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end row-->
                        <div class="col-md-5"></div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <button id="submit" name="submit" type="submit" class="btn btn-tpl" data-idmodal="#divModal" >Registrar   <span class="glyphicon glyphicon-send"></span></button>
                        </div>

                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
