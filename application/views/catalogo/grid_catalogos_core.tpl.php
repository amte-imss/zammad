<link href="<?php echo base_url('assets/css/jquery-ui/jquery-ui.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/third-party/jsgrid-1.5.3/dist/jsgrid.min.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/third-party/jsgrid-1.5.3/dist/jsgrid-theme.min.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/css/catalogos.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/third-party/jsgrid-1.5.3/dist/jsgrid.min.js"></script>
<script src="<?php echo base_url(); ?>assets/css/jquery-ui/jquery-ui.js"></script>


<?php
if(isset($scripts_adicionales))
{
    foreach ($scripts_adicionales as $value)
    {
        ?>
        <script type="text/javascript">
            <?php echo $value ?>
        </script>
        <?php
    }
}
?>
<?php echo $js?js($js):"Prueba"; ?>
<div id="page-inner">
    <div class="col-sm-12">
        <h1 class="page-head-line">
            <?php echo $title; ?>
        </h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <div>
                <div class="pager-panel">
                    <label>Cantidad por pagina:
                        <select id="pager">
                            <option>5</option>
                            <option>10</option>
                            <option selected>25</option>
                            <option>50</option>
                            <option>100</option>
                            <option>200</option>
                        </select>
                    </label>
                </div>
                <div class="">
                    <div id="lista_registros">
                </div>
            </div>
        </div>
    </div>
</div>
