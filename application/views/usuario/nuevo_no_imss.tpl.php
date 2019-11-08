<?php
echo form_open('usuario/nuevo/'.Usuario::NO_IMSS, array('id' => 'form_registro_no_imss','autocomplete'=>"off"));
?>
<input type="hidden" name="formulario" value="<?php echo Usuario::NO_IMSS; ?>">
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
                        Nombre de usuario: </label>
                    </div>
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="fa fa-male"> </span>
                            </span>
                            <?php
                            echo $this->form_complete->create_element(array('id' => 'matricula2',
                            'type' => 'text',
                            'value' => isset($post['matricula2'])?$post['matricula2']:'',
                            'attributes' => array(
                                'class' => 'form-control',
                                'placeholder'=>"Escriba la matrícula",
                                'required'=>true
                            )));
                            ?>
                            <!-- <input id="matricula2" name="matricula2" placeholder="Escriba su matrícula" class="form-control"  type="text" required> -->
                        </div>
                    </div>
                    <?php echo form_error_format('matricula2'); ?>
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
                                echo $this->form_complete->create_element(array('id' => 'email2',
                                'type' => 'email',
                                'value' => isset($post['email2'])?$post['email2']:'',
                                'attributes' => array(
                                    'class' => 'form-control',
                                    'placeholder'=>"correo@imss.com",
                                    'required'=>true
                                )));
                                ?>
                                <!-- <input id="email2" name="email2" placeholder="correo@imss.com" class="form-control"  type="email" required> -->
                            </div>
                        </div>
                        <?php echo form_error_format('email2'); ?>
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
                                    echo $this->form_complete->create_element(array('id' => 'password2',
                                    'type' => 'password',
                                    'value' => isset($post['password2'])?$post['password2']:'',
                                    'attributes' => array(
                                        'class' => 'form-control',
                                        'placeholder'=>"Escribe la contraseña",
                                        'required'=>true
                                    )));
                                    ?>
                                    <!-- <input id="password2" name="password2" placeholder="Escribe tu contraseña" class="form-control" type="password" required> -->
                                </div>
                            </div>
                            <?php echo form_error_format('password2'); ?>
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
                                        echo $this->form_complete->create_element(array('id' => 'repass2',
                                        'type' => 'password',
                                        'value' => isset($post['repass2'])?$post['repass2']:'',
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'placeholder'=>"Repite la contraseña",
                                            'required'=>true
                                        )));
                                        ?>
                                        <!-- <input id="repass2" name="repass2" placeholder="Repite tu contraseña" class="form-control" type="password" required > -->
                                    </div>
                                </div>
                                <?php echo form_error_format('repass2'); ?>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-5">
                            <div class="row">


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
                                                echo $this->form_complete->create_element(array('id' => 'grupo2', 'type' => 'dropdown', 'options' => $nivel_atencion, 'first' => array('' => 'Seleccione una opción'), 'attributes' => array('name' => 'niveles', 'class' => 'form-control')));
                                                ?>                           </div>
                                            </div>
                                            <?php echo form_error_format('grupo2'); ?>
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
