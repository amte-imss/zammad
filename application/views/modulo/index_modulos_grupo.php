<section id="main-content">
<?php echo js('modulo/modulos_grupo.js'); ?>
<div ng-class="panelClass" class="row">
    <div class="col col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body"><br><br>                
                <div>
                    <?php
                    echo form_open('catalogo/categoria/', array('id' => 'form_paginacion'));
                    ?>
                    <div class="form-group">
                        <div class="col-md-4">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">Grupo:</span>
                                <?php
                                echo $this->form_complete->create_element(
                                        array('id' => 'grupo',
                                            'type' => 'dropdown',
                                            'first'=>array(''=>'Seleccione...'),
                                            'options' => $grupos,
                                            'attributes' => array('name' => 'grupo',
                                                'class' => 'form-control  form-control input-sm',
                                                'data-toggle' => 'tooltip',
                                                'data-placement' => 'top',
                                                'title' => 'Grupos disponibles',
                                                'onchange' => "get_form_modulos_grupo()")
                                        )
                                );
                                ?>
                            </div>
                            <?php echo form_error_format('grupo'); ?>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>                
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body"><br><br>     
                <div class="row" id="area_grupo"></div>
            </div>
        </div>
    </div>
</div>
    
</section>