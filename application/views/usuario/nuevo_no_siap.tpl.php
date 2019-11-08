<?php
echo form_open('usuario/nuevo/'.Usuario::NO_SIAP, array('id' => 'form_registro_no_siap', 'autocomplete'=>"off"));
?>
<input type="hidden" name="formulario" value="<?php echo Usuario::NO_SIAP; ?>">
<div class="form-inline" role="form" id="informacion_general">
    <br>
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-5">
            <div class="row">
                <div class="col-md-4">
                    <label for="paterno" class="righthoralign control-label">
                        <b class="rojo">*</b>
                        Matrícula: </label>
                    </div>
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="fa fa-male"> </span>
                            </span>
                            <?php
                            echo $this->form_complete->create_element(array('id' => 'matricula1',
                            'type' => 'text',
                            'value' => isset($post['matricula1'])?$post['matricula1']:'',
                            'attributes' => array(
                                'class' => 'form-control',
                                'placeholder'=>"Escriba la matrícula",
                                'required'=>true
                            )));
                            ?>
                        </div>
                    </div>
                    <?php echo form_error_format('matricula1'); ?>
                </div>
            </div>
            <div class="col-md-6" style="display: 1">
                <div class="row">
                    <div class="col-md-4">
                        <label for="materno" class="control-label">
                            <b class="rojo">*</b>
                            Correo electrónico:</label>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="fa fa-female"> </span>
                                </span>
                                <?php
                                echo $this->form_complete->create_element(array('id' => 'email1',
                                'type' => 'email',
                                'value' => isset($post['email1'])?$post['email1']:'',
                                'attributes' => array(
                                    'class' => 'form-control',
                                    'placeholder'=>"correo@imss.com",
                                    'required'=>true
                                )));
                                ?>
                            </div>
                        </div>
                        <?php echo form_error_format('email1'); ?>
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="nombre" class="righthoralign control-label">
                                <b class="rojo">*</b>
                                Nombre: </label>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="fa fa-male"> </span>
                                    </span>
                                    <?php
                                    echo $this->form_complete->create_element(array('id' => 'nombre1',
                                    'type' => 'text',
                                    'value' => isset($post['nombre1'])?$post['nombre1']:'',
                                    'attributes' => array(
                                        'class' => 'form-control',
                                        'placeholder'=>"Escriba el nombre",
                                        'required'=>true
                                    )));
                                    ?>
                                </div>
                            </div>
                            <?php echo form_error_format('nombre1'); ?>
                        </div>
                    </div>
                    <div class="col-md-6" style="display: 1">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="paterno" class="control-label">
                                    <b class="rojo">*</b>
                                    Apellido paterno:</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-female"> </span>
                                        </span>
                                        <?php
                                        echo $this->form_complete->create_element(array('id' => 'paterno1',
                                        'type' => 'text',
                                        'value' => isset($post['paterno1'])?$post['paterno1']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'placeholder'=>"Escriba apellido paterno",
                                            'required'=>true
                                        )));
                                        ?>
                                        <!-- <input id="paterno1" name="paterno1" placeholder="Escriba apellido paterno" class="form-control"  type="text" required> -->
                                    </div>
                                </div>
                                <?php echo form_error_format('paterno1'); ?>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="materno" class="righthoralign control-label">
                                        <b class="rojo">*</b>
                                        Apellido materno: </label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <span class="fa fa-male"> </span>
                                            </span>
                                            <?php
                                            echo $this->form_complete->create_element(array('id' => 'materno1',
                                            'type' => 'text',
                                            'value' => isset($post['materno1'])?$post['materno1']:'',
                                            'attributes' => array(
                                                'class' => 'form-control',
                                                'placeholder'=>"Escriba apellido materno"
                                            )));
                                            ?>
                                            <!-- <input id="materno1" name="materno1" placeholder="Escriba su apéllido materno" class="form-control"  type="text"> -->
                                        </div>
                                    </div>
                                    <?php echo form_error_format('materno1'); ?>
                                </div>
                            </div>
                            <div class="col-md-6" style="display: 1">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="curp" class="control-label">
                                            <b class="rojo">*</b>
                                            CURP:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-female"> </span>
                                                </span>
                                                <?php
                                                echo $this->form_complete->create_element(array('id' => 'curp1',
                                                'type' => 'text',
                                                'value' => isset($post['curp1'])?$post['curp1']:'',
                                                'attributes' => array(
                                                    'class' => 'form-control',
                                                    'placeholder'=>"Escribe el CURP",
                                                    'required'=>true
                                                )));
                                                ?>
                                                <!-- <input id="curp1" name="curp1" placeholder="Escribe el CURP" class="form-control" type="text" required > -->
                                            </div>
                                        </div>
                                        <?php echo form_error_format('curp1'); ?>
                                    </div>
                                </div>

                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="rfc" class="righthoralign control-label">
                                                <b class="rojo">*</b>
                                                RFC: </label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-male"> </span>
                                                    </span>
                                                    <?php
                                                    echo $this->form_complete->create_element(array('id' => 'rfc1',
                                                    'type' => 'text',
                                                    'value' => isset($post['rfc1'])?$post['rfc1']:'',
                                                    'attributes' => array(
                                                        'class' => 'form-control',
                                                        'placeholder'=>"Escribe el RFC",
                                                        'required'=>true
                                                    )));
                                                    ?>
                                                    <!-- <input id="rfc1" name="rfc1" placeholder="Escriba RFC" class="form-control"  type="text"> -->
                                                </div>
                                            </div>
                                            <?php echo form_error_format('rfc1'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="display: 1">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="curp" class="control-label">
                                                    <b class="rojo">*</b>
                                                    Sexo:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <span class="fa fa-female"> </span>
                                                        </span>
                                                        <?php
                                                        echo $this->form_complete->create_element(array('id' => 'sexo1',
                                                        'type' => 'dropdown',
                                                        'options' => array(1=>'Hombre', 2=>'Mujer'),
                                                        'first' => array('' => 'Seleccione una opción'),
                                                        'attributes' => array( 'class' => 'form-control')));
                                                        ?>
                                                    </div>
                                                </div>
                                                <?php echo form_error_format('sexo'); ?>
                                            </div>
                                        </div>

                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-md-1">
                                        </div>
                                        <div class="col-md-5">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="paterno" class="righthoralign control-label">
                                                        <b class="rojo">*</b>
                                                        Contraseña: </label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <span class="fa fa-male"> </span>
                                                            </span>
                                                            <?php
                                                            echo $this->form_complete->create_element(array('id' => 'password1',
                                                            'type' => 'password',
                                                            'value' => isset($post['password1'])?$post['password']:'',
                                                            'attributes' => array(
                                                                'class' => 'form-control',
                                                                'placeholder'=>"Escribe la contraseña",
                                                                'required'=>true
                                                            )));
                                                            ?>
                                                            <!-- <input id="password1" name="password1" placeholder="Escribe tu contraseña" class="form-control" type="password" required> -->
                                                        </div>
                                                    </div>
                                                    <?php echo form_error_format('password1'); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="display: 1">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="materno" class="control-label">
                                                            <b class="rojo">*</b>
                                                            Confirmar contraseña:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <span class="fa fa-female"> </span>
                                                                </span>
                                                                <?php
                                                                echo $this->form_complete->create_element(array('id' => 'repass1',
                                                                'type' => 'password',
                                                                'value' => isset($post['repass1'])?$post['repass1']:'',
                                                                'attributes' => array(
                                                                    'class' => 'form-control',
                                                                    'placeholder'=>"Repite tu contraseña",
                                                                    'required'=>true
                                                                )));
                                                                ?>
                                                                <!-- <input id="repass1" name="repass1" placeholder="Repite tu contraseña" class="form-control" type="password" required > -->
                                                            </div>
                                                        </div>
                                                        <?php echo form_error_format('repass1'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="paterno" class="righthoralign control-label">
                                                                <b class="rojo">*</b>
                                                                Clave departamental: </label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <span class="fa fa-male"> </span>
                                                                    </span>
                                                                    <?php
                                                                    echo $this->form_complete->create_element(array(
                                                                        'id' => 'clave_departamental1', 'type' => 'text',
                                                                        'value' => isset($post['clave_departamental1'])?$post['clave_departamental1']:'',
                                                                        'attributes' => array('class' => 'form-control',
                                                                        'required' => 1)
                                                                    ));
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <?php echo form_error_format('clave_departamental1'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="display: 1">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for="categoria1" class="control-label">
                                                                    <b class="rojo">*</b>
                                                                    Clave de categoría</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <span class="fa fa-female"> </span>
                                                                        </span>
                                                                        <?php
                                                                        echo $this->form_complete->create_element(array('id' => 'categoria1',
                                                                        'type' => 'text',
                                                                        'value' => isset($post['categoria1'])?$post['categoria1']:'',
                                                                        'attributes' => array('class' => 'form-control',
                                                                        'required' => 1)));
                                                                        ?>                           </div>
                                                                    </div>
                                                                    <?php echo form_error_format('categoria1'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                            </div>
                                                            <div class="col-md-6" style="display: 1">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label for="materno" class="control-label">
                                                                            <b class="rojo">*</b>
                                                                            Nivel de atención:</label>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon">
                                                                                    <span class="fa fa-female"> </span>
                                                                                </span>
                                                                                <?php
                                                                                echo $this->form_complete->create_element(array('id' => 'grupo1', 'type' => 'dropdown', 'options' => $nivel_atencion, 'first' => array('' => 'Seleccione una opción'), 'attributes' => array('name' => 'niveles', 'class' => 'form-control')));
                                                                                ?>                           </div>
                                                                            </div>
                                                                            <?php echo form_error_format('grupo1'); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br><br>
                                                                <div class="col-md-5">

                                                                </div>

                                                                <div class="form-group">

                                                                    <label class="col-md-4 control-label"></label>
                                                                    <!-- <div class="col-md-4"> -->
                                                                    <button id="submit" name="submit" type="submit" class="btn btn-tpl" data-idmodal="#divModal" >Registrar   <span class="glyphicon glyphicon-send"></span></button>
                                                                </div>
                                                                <!-- </div> -->
                                                                <?php echo form_close(); ?>
                                                            </div>
