<div id="page-inner">
    <div class="col-sm-12">
        <h1 class="page-head-line">
            Unidad/UMAE
        </h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <div>
                <div class="">
                    <?php
                    if(isset($status))
                    {
                        $s_tipo = $status['success'] ? 'success':'danger';
                        echo html_message($status['message'], $s_tipo);
                    }
                    echo form_open('', array('id' => 'form_registro','autocomplete'=>"off"));
                    ?>
                    <div class="form-inline" role="form">
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
                                    <label for="nombre" class="control-label">
                                        <b class="rojo">*</b> Nombre de la unidad:
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
                                            'placeholder'=>"Nombre de la unidad",
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
                                    <label for="id_delegacion" class="righthoralign control-label">
                                        <b class="rojo">*</b> Delegación:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-male"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'id_delegacion',
                                        'type' => 'dropdown',
                                        'first' => array('' => 'Seleccione una opción'),
                                        'options' => $delegaciones,
                                        'value' => isset($post['id_delegacion'])?$post['id_delegacion']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'required'=>true
                                        )));
                                        ?>
                                        <?php echo form_error_format('id_delegacion'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="display: 1">
                                <div class="col-md-4">
                                    <label for="clave_presupuestal" class="control-label">
                                        <b class="rojo">*</b> Clave presupuestal:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-female"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'clave_presupuestal',
                                        'type' => 'text',
                                        'value' => isset($post['clave_presupuestal'])?$post['clave_presupuestal']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'placeholder'=>"Clave presupuestal",
                                            'required'=>true
                                        )));
                                        ?>
                                        <?php echo form_error_format('clave_presupuestal'); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end row-->
                        <br>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <div class="col-md-4">
                                    <label for="nivel_atencion" class="righthoralign control-label">
                                        <b class="rojo">*</b> Nivel atención:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-male"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'nivel_atencion',
                                        'type' => 'dropdown',
                                        'first' => array('' => 'Seleccione una opción'),
                                        'options' => array(1=>'Primer nivel', 2=>'Segundo nivel', 3=>'Tercer nivel'),
                                        'value' => isset($post['nivel_atencion'])?$post['nivel_atencion']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'required'=>true
                                        )));
                                        ?>
                                        <?php echo form_error_format('nivel_atencion'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="display: 1">
                                <div class="col-md-4">
                                    <label for="id_tipo_unidad" class="control-label">
                                        <b class="rojo">*</b> Tipo de unidad:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-female"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'id_tipo_unidad',
                                        'type' => 'dropdown',
                                        'value' => isset($post['id_tipo_unidad'])?$post['id_tipo_unidad']:'',
                                        'first' => array('' => 'Seleccione una opción'),
                                        'options' => $tipos_unidades,
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'required'=>true
                                        )));
                                        ?>
                                        <?php echo form_error_format('id_tipo_unidad'); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end row-->
                        <br>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <div class="col-md-4">
                                    <label for="umae" class="righthoralign control-label">
                                        <b class="rojo">*</b> Es UMAE:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-male"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'umae',
                                        'type' => 'dropdown',
                                        'first' => array('' => 'Seleccione una opción'),
                                        'options' => array(0=>'No', 1=>'Si'),
                                        'value' => isset($post['umae'])?$post['umae']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'required'=>true
                                        )));
                                        ?>
                                        <?php echo form_error_format('umae'); ?>
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
                                        'options' => array(0=>'No', 1=>'Si'),
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
                        <br>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <div class="col-md-4">
                                    <label for="latitud" class="righthoralign control-label">
                                        Latitud:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-male"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'latitud',
                                        'type' => 'number',
                                        'value' => isset($post['latitud'])?$post['latitud']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'placeholder' => 'Latitud',
                                            'step'=>"0.01"
                                        )));
                                        ?>
                                        <?php echo form_error_format('latitud'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="display: 1">
                                <div class="col-md-4">
                                    <label for="lontitud" class="control-label">
                                        Longitud:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-female"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'longitud',
                                        'type' => 'number',
                                        'value' => isset($post['longitud'])?$post['longitud']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'placeholder' => 'Longitud',
                                            'step'=>"0.01"
                                        )));
                                        ?>
                                        <?php echo form_error_format('lontitud'); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end row-->
                        <br>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <div class="col-md-4">
                                    <label for="id_region" class="righthoralign control-label">
                                         <b class="rojo">*</b> Región:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-male"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'id_region',
                                        'type' => 'dropdown',
                                        'value' => isset($post['id_region'])?$post['id_region']:'',
                                        'first' => array('' => 'Seleccione una opción'),
                                        'options' => $regiones,
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'placeholder' => 'Región'
                                        )));
                                        ?>
                                        <?php echo form_error_format('id_region'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="display: 1">
                                <div class="col-md-4">
                                    <label for="grupo_tipo_unidad" class="control-label">
                                        Grupo unidad:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-female"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'grupo_tipo_unidad',
                                        'type' => 'text',
                                        'value' => isset($post['grupo_tipo_unidad'])?$post['grupo_tipo_unidad']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'placeholder' => 'Grupo unidad'
                                        )));
                                        ?>
                                        <?php echo form_error_format('grupo_tipo_unidad'); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end row-->
                        <br>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <div class="col-md-4">
                                    <label for="grupo_delegacion" class="righthoralign control-label">
                                         Grupo delegación:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-male"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'grupo_delegacion',
                                        'type' => 'text',
                                        'value' => isset($post['grupo_delegacion'])?$post['grupo_delegacion']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'placeholder' => 'Región'
                                        )));
                                        ?>
                                        <?php echo form_error_format('grupo_delegacion'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="display: 1">
                                <div class="col-md-4">
                                    <label for="direccion_fisica" class="control-label">
                                        Dirección física de la unidad:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-female"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'direccion_fisica',
                                        'type' => 'text',
                                        'value' => isset($post['direccion_fisica'])?$post['direccion_fisica']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'placeholder' => 'Dirección fisica de la unidad'
                                        )));
                                        ?>
                                        <?php echo form_error_format('direccion_fisica'); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end row-->
                        <br>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <div class="col-md-4">
                                    <label for="entidad_federativa" class="righthoralign control-label">
                                         Entidad federativa:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-male"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'entidad_federativa',
                                        'type' => 'text',
                                        'value' => isset($post['entidad_federativa'])?$post['entidad_federativa']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'placeholder' => 'Entidad federativa'
                                        )));
                                        ?>
                                        <?php echo form_error_format('entidad_federativa'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="display: 1">
                                <div class="col-md-4">
                                    <label for="anio" class="control-label">
                                        <b class="rojo">*</b> Año:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-female"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'anio',
                                        'type' => 'number',
                                        'value' => isset($post['anio'])?$post['anio']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'placeholder' => 'Año',
                                            'required' => true
                                        )));
                                        ?>
                                        <?php echo form_error_format('anio'); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end row-->
                        <br>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <div class="col-md-4">
                                    <label for="unidad_principal" class="righthoralign control-label">
                                         Unidad principal:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-male"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'unidad_principal',
                                        'type' => 'text',
                                        'value' => isset($post['unidad_principal'])?$post['unidad_principal']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'placeholder' => 'Unidad principal'
                                        )));
                                        ?>
                                        <?php echo form_error_format('unidad_principal'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="display: 1">
                                <div class="col-md-4">
                                    <label for="nombre_unidad_principal" class="control-label">
                                        Nombre unidad principal:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-female"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'nombre_unidad_principal',
                                        'type' => 'text',
                                        'value' => isset($post['nombre_unidad_principal'])?$post['nombre_unidad_principal']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'placeholder' => 'Nombre de la unidad/UMAE principal',
                                            'required' => true
                                        )));
                                        ?>
                                        <?php echo form_error_format('nombre_unidad_principal'); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end row-->
                        <br>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <div class="col-md-4">
                                    <label for="clave_unidad_principal" class="righthoralign control-label">
                                         Clave Unidad principal:
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-male"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'clave_unidad_principal',
                                        'type' => 'text',
                                        'value' => isset($post['clave_unidad_principal'])?$post['clave_unidad_principal']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'placeholder' => 'Clave unidad principal'
                                        )));
                                        ?>
                                        <?php echo form_error_format('unidad_principal'); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end row-->
                        <br>
                        <div class="col-md-5"></div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <input type="submit" class="btn btn-tpl" value="Registrar">
                        </div>

                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
