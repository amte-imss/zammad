<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//pr($titulo_seccion);
?>
<?php echo css('template_sipimss/style_profile.css'); ?>

<div class="row mt">
    <div class="col-lg-12">
        <div class="content-panel">
            <div class="form-inline" role="form" id="detalle_registro">
                <?php if (!is_null($detalle_registro)) {//Pinta sección ?>
                    <?php echo $detalle_registro; ?>
                <?php } ?>
            </div>
            <?php if (!is_null($detalle_validacion_censo)) { //Pinta formulario?>
                <div class="form-inline" role="form" id="detalle_validacion_censo">
                    <?php echo $detalle_validacion_censo; ?>
                </div>
            <?php } ?>

            <?php if (!is_null($detalle_evaluacion_curricular_censo)) { //Pinta tabla?>
                <div class="form-inline" role="form" id="detalle_evaluacion_curricular_censo">
                    <?php echo $detalle_evaluacion_curricular_censo; ?>
                </div>
            <?php } ?>
        </div>
    </div><!-- col-lg-12-->
</div><!-- /row -->

<!-- /MAIN CONTENT -->

