<?php
echo form_open('usuario/nuevo/'.Usuario::SIAP, array('id' => 'form_registro','autocomplete'=>"off"));
?>
<input type="hidden" name="formulario" value="<?php echo Usuario::SIAP; ?>">
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
                            echo $this->form_complete->create_element(array('id' => 'matricula',
                            'type' => 'text',
                            'value' => isset($post['matricula'])?$post['matricula']:'',
                            'attributes' => array(
                                'class' => 'form-control',
                                'placeholder'=>"Escriba su matrícula",
                                'required'=>true
                            )));
                            ?>
                        </div>
                    </div>
                    <?php echo form_error_format('matricula'); ?>
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
                                echo $this->form_complete->create_element(array('id' => 'email',
                                'type' => 'email',
                                'value' => isset($post['email'])?$post['email']:'',
                                'attributes' => array(
                                    'class' => 'form-control',
                                    'placeholder'=>"correo@imss.com",
                                    'required'=>true
                                )));
                                ?>
                            </div>
                        </div>
                        <?php echo form_error_format('email'); ?>
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
                                    echo $this->form_complete->create_element(array('id' => 'password',
                                    'type' => 'password',
                                    'value' => isset($post['password'])?$post['password']:'',
                                    'attributes' => array(
                                        'class' => 'form-control',
                                        'placeholder'=>"Escribe la contraseña",
                                        'required'=>true
                                    )));
                                    ?>
                                </div>
                            </div>
                            <?php echo form_error_format('password'); ?>
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
                                        echo $this->form_complete->create_element(array('id' => 'repass',
                                        'type' => 'password',
                                        'value' => isset($post['repass'])?$post['repass']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'placeholder'=>"Repite la contraseña",
                                            'required'=>true
                                        )));
                                        ?>                                        
                                    </div>
                                </div>
                                <?php echo form_error_format('repass'); ?>
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
                                        Delegación: </label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <span class="fa fa-male"> </span>
                                            </span>
                                            <?php
                                            echo $this->form_complete->create_element(array('id' => 'delegacion', 'type' => 'dropdown', 'options' => $delegaciones, 'first' => array('' => 'Seleccione una opción'), 'attributes' => array('name' => 'delegacion', 'class' => 'form-control')));
                                            ?>
                                        </div>
                                    </div>
                                    <?php echo form_error_format('delegacion'); ?>
                                </div>
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
                                                echo $this->form_complete->create_element(array('id' => 'grupo', 'type' => 'dropdown', 'options' => $nivel_atencion, 'first' => array('' => 'Seleccione una opción'), 'attributes' => array('name' => 'niveles', 'class' => 'form-control')));
                                                ?>                           </div>
                                            </div>
                                            <?php echo form_error_format('grupo'); ?>
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
