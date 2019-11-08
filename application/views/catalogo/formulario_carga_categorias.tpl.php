
<div id="page-inner">
    <div class="col-sm-12">
        <h1 class="page-head-line">
            Carga Masiva de Categorías
        </h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="container" style="text-aligne:center; width: 650px; text-align: left;">
                <div class="form-group">
                    <label class="col-md-4 control-label">Seleccione su CSV : </label>
                    <div class="col-md-6 input-group">
                        <?php echo form_open_multipart('catalogo/categoria_csv'); ?>
                        <input type="file" name="userfile"><br>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <input type="submit" name="submit" value="Cargar archivo" class="btn btn-primary">
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>