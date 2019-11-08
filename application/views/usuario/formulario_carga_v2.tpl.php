
<div id="page-inner">
    <div class="col-sm-12">
        <h1 class="page-head-line">
            Lista de usuarios
        </h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <?php
            if(isset($status))
            {
                $ts = (isset($status['result']) && $status['result'])?'success':'danger';
                echo html_message($status['msg'], $ts);
            }
            ?>
                <?php echo form_open_multipart('usuario/carga_usuarios'); ?>
                <div class="form-group">
                    <div class="col-md-5">
                		<div class="row">
                			<div class="col-md-4">
                				<label for="paterno" class="righthoralign control-label">
                					<b class="rojo">*</b>Tipo de registro:
                				</label>
                			</div>
                			<div class="col-md-8">
                				<div class="input-group">
                					<span class="input-group-addon">
                						<span class="fa fa-male"> </span>
                					</span>
                                    <select id="tipo_registro" name="tipo_registro" class="form-control" onchange="cmbox_tipo_registro(this)">
                                        <option value="">Seleccionar</option>
                                        <option value="registro_siap">SIAP</option>
                                        <option value="registro_no_siap">Sin SIAP</option>
                                        <option value="registro_no_imss">No IMSS</option>
                                    </select>
                				</div>
                			</div>
                		</div>
                	</div>
                    <label class="col-md-2 control-label"><b class="rojo">*</b>Seleccione su CSV : </label>

                        <input type="file" name="userfile"><br>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <input type="submit" name="submit" value="Cargar archivo" class="btn btn-primary">
                </div>
                <?php echo form_close(); ?>

        </div>
    </div>
</div>
