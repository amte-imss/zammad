<?php
/*
$this->load->config('general');
$ruta_imagen_perfil = $this->config->item('img_perfil_default');
$nombre_usuario = '';
$matricula = '';
if (isset($datos_imagen) and ! empty($datos_imagen)) {
    //Carga imagen del usuario docete
    if (!is_null($datos_imagen['nombre_fisico']) and ! is_null($datos_imagen['ruta'])) {
        $ruta_imagen_perfil = base_url($datos_imagen['ruta'] . $datos_imagen['nombre_fisico'] . '.' . $datos_imagen['extencion']);
        if (file_exists($ruta_imagen_perfil)) {//Valida que exista la imagen del perfil solicitada, si no existe, muestra imagen default
            $ruta_imagen_perfil = $this->config->item('img_perfil_default');
        }
    } else {
        $ruta_imagen_perfil = $this->config->item('img_perfil_default');
    }
    $nombre_usuario = isset($datos_imagen['nombre_docente']) ? $datos_imagen['nombre_docente'] : '';
    $matricula = isset($datos_imagen['matricula']) ? $datos_imagen['matricula'] : '';
}*/
//pr($datos_imagen);
?>

<div id="mobile-menu"></div>
<nav class="navigation closed clearfix">
    <a href="#" class="menu-toggle btn"><i class="fa fa-bars imss-foro-gris"></i></a>
    <ul class="sf-menu nav">
        <li class="active"><a href="#home">Inicio</a></li>
    </ul>
</nav>
<!-- <div class="sidebar-collapse">
  <ul class="nav menu-menu" id="main-menu">
    <li>
      <div class="user-img-div">
      <a href="index.html"><img img-responsive src="<?php echo $ruta_imagen_perfil; ?>" class="img-circle" /></a>
      </div>
    </li>
    <li>
      <a  href="index.html"> <strong> <?php echo $nombre_usuario; ?></strong></a>
    </li>
    <?php
        foreach ($elementos_menu as $value) {
            $class = ($this->uri->rsegment(1) == $value['ruta']) ? 'active-menu' : '';
            ?>
            <li class="<?php echo $value['class']; ?>">
                <a class="<?php echo $class; ?>" href="<?php echo base_url('index.php/') . $value['ruta']; ?>">
                    <img class="img-menu" src="<?php echo base_url('assets/img/template_sipimss/img-menu/') . $value['imagen']; ?>">
                    <span><?php echo $value['name_act']; ?></span>
                </a>
            </li>
            <?php
        }
        ?>
  </ul>
</div> -->
