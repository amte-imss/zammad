<script src="<?php echo base_url(); ?>assets/dropzone/min/dropzone.min.js"></script>
<link href="<?php echo base_url('assets/dropzone/min/dropzone.min.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/css/catalogos.css'); ?>" rel="stylesheet" />

<div id="secCSV">
  <h1>Files</h1>
  <?php echo $mensaje;?>
  <?php echo form_open_multipart('/catalogo/restfull_modulos/'.$catalogo['tipo']."/importar/".$catalogo['id_catalogo']."/");?>
      <div id="dropzone_config">
        <input name="file" type="file"/>
      </div>
      <input type="submit" value="cargar" />
  </form>
</div>
