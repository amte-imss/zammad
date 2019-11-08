<link href="<?php if(isset($herramientas) && $herramientas){echo base_url('assets/css/jquery-ui/jquery-ui.css');} ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/js/js_export_grid/jsgrid-1.5.3/jsgrid.min.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/js/js_export_grid/jsgrid-1.5.3/jsgrid-theme.min.css'); ?>" rel="stylesheet" />
<link href="<?php if(isset($herramientas) && $herramientas){echo base_url('assets/css/catalogos.css');} ?>" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/js_export_grid/jsgrid-1.5.3/jsgrid.min.js"></script>
<script src="<?php if(isset($herramientas) && $herramientas){echo base_url('assets/js/jquery-ui.js');}?>"></script>

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
        <h2 class="page-head-line">
            <?php if(isset($title)){ echo $title;}?>
        </h2>
        <?php
          if(isset($csv) && $csv)
          { ?>
            <div id="info_catalogo">
              <h3>Catalogo: <?php echo $catalogo['nombre'];?></h3>
              <h4>Descripcion: <?php echo $catalogo['descripcion'];?></h4>
            </div>
            <button onClick="importar()" id="carga_masiva">Agregar más de un catálogo</button>
          <?php }else{
          }
        ?>

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
                    <?php if(isset($exportar))
                    {
                        ?>
                        <div class="">
                            <a href="<?php echo $exportar;?>" class="btn btn-primary">Exportar</a>
                        </div>
                        <?php
                    } ?>

                </div>
                <div class="">
                    <div id="lista_registros">
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(isset($form)){

    switch ($form) {
        case 'formCatalogo': ?>
          <div id="detailsDialog" title="Basic dialog">
            <form id="detailsForm">
              <label>Nombre</label>
              <input class="input" id="nombre" name="nombre" type='text'/>
              <label>Descripcion</label>
              <input class="input" id="descripcion" name="descripcion" type='text'/>
              <select id="tipo" class="input" name="tipo">
                <option disabled selected value> Selecciona el tipo de catalogo </option>
                <option value="elementos_catalogos">Elementos de catalogos</option>
                <option value="cursos">Cursos</option>
              </select>
              <button type='submit'>Guardar<button/>
            </form>
          </div>
<?php
        break;
        case 'formElementosCatalogo': ?>
            <div id="detailsDialog" title="Basic dialog">
              <form id="detailsForm">
                <label>Nombre</label>
                <input class="input" id="nombre" name="nombre" type='text'/>
                <label>Descripción</label>
                <input class="input" id="descripcion" name="descripcion" type='text'/>
                <label>Tipo</label>
                <input class="input" id="tipo" name="tipo" type='text'/>
                <label>Label</label>
                <input class="input" id="label" name="label" type='text'/>
                <label>Activo</label>
                <input class="input" id="activo" name="activo" type='checkbox'/>
                <label>Orden</label>
                <input class="input" id="orden" name="orden" type='text'/>
                <label>Nivel</label>
                <input class="input" id="nivel" name="nivel" type='text'/>
                <button type='submit'>Guardar<button/>
              </form>
            </div>
<?php
        break;
        case 'formCursosCatalogo': ?>
            <div id="detailsDialog" title="Basic dialog">
              <form id="detailsForm">
                <div class="renglon">
                    <div class="columna" style="margin-right: 15px;">
                        <label>Nombre</label>
                        <input class="input" id="nombre" name="nombre" type='text'/>
                        <label>Descripción</label>
                        <input class="input" id="descripcion" name="descripcion" type='text'/>
                        <label>Tipo</label>
                        <input class="input" id="tipo" name="tipo" type='text'/>
                        <label>Label</label>
                        <input class="input" id="label" name="label" type='text'/>
                        <label>Activo</label>
                        <input class="input" id="activo" name="activo" type='checkbox'/>
                        <label>Orden</label>
                        <input class="input" id="orden" name="orden" type='text'/>
                        <label>Nivel</label>
                        <input class="input" id="nivel" name="nivel" type='text'/>
                        <label>Id proceso educativo</label>
                        <input class="input" id="id_proceso_educativo" name="id_proceso_educativo" type='text'/>
                    </div>
                    <div class="columna">
                        <label>Clave CES</label>
                        <input class="input" id="clave_ces" name="clave_ces" type='text'/>
                        <label>Clave Unidad</label>
                        <input class="input" id="clave_unidad" name="clave_unidad" type='text'/>
                        <label>Año</label>
                        <input class="input" id="anio" name="anio" type='year'/>
                        <label>División</label>
                        <input class="input" id="division" name="division" type='text'/>
                        <label>Fecha de inicio</label>
                        <input class="input" id="fecha_inicio" name="fecha_inicio" type='date'/>
                        <label>Fecha de fin</label>
                        <input class="input" id="fecha_fin" name="fecha_fin" type='date'/>
                    </div>
                </div>
                <button type='submit'>Guardar<button/>
              </form>
            </div>
<?php
          break;
      }
    }
?>

<script>
  function importar(){
    window.location.href = window.location.href+"/carga"
  }
</script>
