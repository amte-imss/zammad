<?php echo js('usuario/nuevo.js'); ?>
<div id="page-inner">
    <div class="">
        <div class="row">
            <div class="col col-sm-12">
                <h1 class="page-head-line">
                    <br>
                    Registro de usuarios
                </h1>
            </div>
            <div class="panel-default">
                <?php
                if (isset($registro_valido['result']))
                {
                    //pr($registro_valido);
                    $tipo_msg = $registro_valido['result']? 'success' : 'danger';
                    echo html_message($registro_valido['msg'], $tipo_msg);
                }
                ?>
                <div class="form-inline" role="form" id="informacion_general">
                	<br>
                	<div class="row">
                		<div class="col-md-1"></div>
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
                    </div>
                    <div>
                        <div id="area_registro_siap" class="areas_registros">
                            <?php include('nuevo_siap.tpl.php'); ?>
                        </div>
                        <div id="area_registro_no_siap" class="areas_registros">
                            <?php include('nuevo_no_siap.tpl.php'); ?>
                        </div>
                        <div id="area_registro_no_imss" class="areas_registros">
                            <?php include('nuevo_no_imss.tpl.php'); ?>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        activa_tipo_registro('<?php echo $tipo_registro; ?>');
    });
</script>
