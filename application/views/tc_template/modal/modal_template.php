<?php ?>
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal_titulo">
            <?php if (isset($modal_titulo)) { ?>
                <?php echo $modal_titulo; ?>
            <?php } ?>
        </h4>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12 " id='modal_error' style='display:none'>
        <div id='mensaje_error_modal' class='alert alert-info'>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span id='mensaje_error_modal'></span>
        </div>
    </div>
    <div class="modal-body" id="modal_cuerpo">
        <?php if (isset($modal_cuerpo)) { ?>
            <?php echo $modal_cuerpo; ?>
        <?php } ?>
    </div>
    <div class="modal-footer text-center" id="modal_pie">
        <?php if (isset($modal_pie)) { ?>
            <?php echo $modal_pie; ?>
        <?php } ?>
        <!--                                    <button type="button" class="btn btn-primary">Save changes</button>-->
    </div>
</div>