<?php
if ($full_view == 1) {
    ?>
<div id="page-inner">
  <div class="col-sm-12">
      <h1 class="page-head-line">
           Administración de módulos y permisos</h1>
    </div>
        <?php } ?>    
<?php
if ($full_view == 1)
{
    ?>
    <?php echo js('modulo/index.js'); ?>
    <div class="col-md-12">
      <div class="col-md-10">

      </div>
      <div class="col-md-2">
        <button type="button" onclick="form_save()" class="btn btn-tpl btn-lg" data-toggle="modal" data-target="#my_modal">
            Nuevo
        </button>
        <br>
      </div>

    </div>

    <div id="area_modulos">
    <?php } ?>
    <div ng-class="panelClass" class="row">
        <div class="col col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div>
                    <?php echo render_modulo($modulos); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if ($full_view == 1)
    {
        ?>
    </div>
    <!-- Button trigger modal -->
    <div class="col-md-12">
      <div class="col-md-10">
          </div>
        <div class="col-md-2">
          <button type="button" onclick="form_save()" class="btn btn-tpl btn-lg" data-toggle="modal" data-target="#my_modal">
              Nuevo
          </button>
          
        </div>

    </div>

<?php } ?>


  <br><br><br>
    <?php
    if ($full_view == 1)
    {
        ?>
</div>
<?php } ?>
