<br><br>
<h1 class="section-title">
  <span data-animation="flipInY" data-animation-delay="100" class="icon-inner animated flipInY visible"><span class="fa-stack"><i class="fa rhex fa-stack-2x"></i><i class="fa fa-ticket fa-stack-1x"></i></span></span>
  <span data-animation="fadeInRight" data-animation-delay="100" class="title-inner animated fadeInRight visible">Perfil</span>
</h1>
<div class="container">


  <section class="panel panel-default">
    <div class="container">
      <br><br>
      <!-- Contact form -->
      <br>
      <div class="col-sm-12 af-outer af-required">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-3">
          <label for=""><?php echo $language_text['registro_usuario']['ext_nombre']; ?></label>
        </div>
        <div class="">
          <input type="text" name="nombre" value="<?php echo $datos_usuario['nombre']; ?>" class="form-control placeholder" size="30" readonly style="color:#000000;">
        </div>


      </div>
      <div class="col-sm-12 af-outer af-required">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-3">
          <label for=""><?php echo $language_text['registro_usuario']['ext_ap'];?></label>
        </div>
        <div class="">
          <input type="text" name="nombre" value="<?php echo $datos_usuario['apellido_paterno']; ?>" class="form-control placeholder" size="30" readonly style="color:#000000;">
        </div>
      </div>

      <div class="col-sm-12 af-outer af-required">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-3">
          <label for=""><?php echo $language_text['registro_usuario']['ext_am'];?></label>
        </div>
        <div class="">
          <input type="text" name="nombre" value="<?php echo $datos_usuario['apellido_materno']; ?>" class="form-control placeholder" size="30" readonly style="color:#000000;">
        </div>
      </div>

      <div class="col-sm-12 af-outer af-required">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-3">
          <label for=""><?php echo $language_text['registro_usuario']['sexo'];?></label>
        </div>
        <div class="">
          <input type="text" name="nombre" value="<?php echo $datos_usuario['sexo']; ?>" class="form-control placeholder" size="30" readonly style="color:#000000;">
        </div>
      </div>

      <div class="col-sm-12 af-outer af-required">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-3">
          <label for=""><?php echo $language_text['registro_usuario']['ext_mail'];?></label>
        </div>
        <div class="">
          <input type="text" name="nombre" value="<?php echo $datos_usuario['email']; ?>" class="form-control placeholder" size="30" readonly style="color:#000000;">
        </div>
      </div>

      <div class="col-sm-12 af-outer af-required">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-3">
          <label for=""><?php echo $language_text['registro_usuario']['telefono_personal'];?></label>
        </div>
        <div class="">
          <input type="text" name="nombre" value="<?php echo $datos_usuario['telefono_personal']; ?>" class="form-control placeholder" size="30" readonly style="color:#000000;">
        </div>
      </div>

      <div class="col-sm-12 af-outer af-required">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-3">
          <label for=""><?php echo $language_text['registro_usuario']['telefono_oficina'];?></label>
        </div>
        <div class="">
          <input type="text" name="nombre" value="<?php echo $datos_usuario['telefono_oficina']; ?>" class="form-control placeholder" size="30" readonly style="color:#000000;">
        </div>
      </div>

      <div class="col-sm-12 af-outer af-required">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-3">
          <label for=""><?php echo $language_text['registro_usuario']['pais_origen'];?></label>
        </div>
        <div class="">
          <input type="text" name="nombre" value="<?php echo $paises[$datos_usuario['clave_pais']]; ?>" class="form-control placeholder" size="30" readonly style="color:#000000;">
        </div>
      </div>

      <!-- /Contact form -->

    </div>
  </section>

</div>
