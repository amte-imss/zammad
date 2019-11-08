<link href="<?php echo base_url('assets/js/js_export_grid/jsgrid-1.5.3/jsgrid.min.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/js/js_export_grid/jsgrid-1.5.3/jsgrid-theme.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/js_export_grid/jsgrid-1.5.3/jsgrid.min.js"></script>
<?php echo js('idioma/lista.js'); ?>
<div id="page-inner">
    <div class="col-sm-12">
        <h1 class="page-head-line">
            Lista de Grupos Etiquetas
        </h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <div>
                <div class="pager-panel">
                    <label>Cantidad por pagina:
                        <select id="pager">
                            <option selected>5</option>
                            <option>10</option>
                            <option>20</option>
                            <option>50</option>
                            <option>100</option>
                            <option>200</option>                            
                        </select>
                    </label>
                </div>
                <div class="">
                    <div id="lista_usuarios">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_entrar_como" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" data-keyboard="false">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Entrar como...</h4>
      </div>
      <div class="modal-body">
        <p>¿Confirma que desea entrar como el usuario seleccionado?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
     <form id="form_entrar_como" method="post">
        <input type="submit" class="btn btn-primary" value="Continuar">
     </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->