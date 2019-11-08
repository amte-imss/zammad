<?php
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<div ng-class="panelClass" class="row">
    <div class="col col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Notificaciones</h3>
            </div>
            <div class="panel-body"><br>
              <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row" style="margin:5px;">
                      <div class="table table-container-fluid panel">
                      <a href="javascript:history.back()" class="btn btn-success" style=" background-color:#008EAD">Regresar</a>  
				              <?php echo $output;?>
    		              </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
    </div>
</div>
