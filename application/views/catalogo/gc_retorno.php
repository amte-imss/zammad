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
                <h3 class="panel-title">Añadir</h3>
            </div>
            <div class="panel-body"><br>
              <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row" style="margin:5px;">
						<div>
						<?php 
         				foreach($ruta_elemento_seccion as $ruta)
   						{
            				echo $ruta;
         				}
        				?>
        				</div>
					<br>
			        <form method="post" action="<?php echo $ruta= base_url().'index.php/formulario/formulario'; ?>"   enctype="multipart/form-data">
			            <input type="submit" name="submit" value="Regresar a formularios" class="btn btn-primary">
			        </form>
        			<div class="table table-container-fluid panel">
				        <?php echo $output;?>
    		        </div>
    		        </div>pues 
        		  </div>
        	 </div>
            </div>
        </div>
    </div>
</div>