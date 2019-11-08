<?php
header('Content-type: text/html; charset=utf-8');
//pr($language_text);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/img/template_sipimss/apple-icon.png'); ?>" />
        <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/template_sipimss/favicon.ico'); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>
            <?php echo (!is_null($title)) ? "{$title}&nbsp;|" : "" ?>
            <?php echo (!is_null($main_title)) ? $main_title : "XV Foro Nacional y I Foro Internacional de Educación en Salud" ?>
        </title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <!-- BOOTSTRAP STYLES-->
        <?php echo css('bootstrap.css'); ?>

        <script type="text/javascript">
            var language_text = <?php echo (isset($language_text)) ? json_encode($language_text) : json_encode([]); ?>;
            var url = "<?php echo base_url(); ?>";
            var site_url = "<?php echo site_url(); ?>";
            var img_url_loader = "<?php echo base_url('assets/img/loader.gif'); ?>";
        </script>
        <?php echo css('estilo_perfil.css'); ?>
        <?php echo css('fonts/font-awesome.css'); ?>
        <?php echo css('style.css'); ?>
        <?php echo css('template_foro/sipimss.css'); ?>
        <?php echo css("date/datepicker.css"); ?>
        <?php echo css("datepicker.less"); ?>

        <?php echo css('custom.css') ?>
        <?php echo css('template_foro/apprise.css'); ?>


        <?php echo js("jquery.js"); ?>
        <?php echo js("jquery.min.js"); ?>
        <?php echo js("jquery.ui.min.js"); ?>
        <!-- General de SIPIMSS -->
        <?php echo js('template_foro/general.js'); ?>
        <?php echo js('template_foro/apprise.js'); ?>
        <?php echo js('template_foro/idioma.js'); ?>

        <!-- Google Analytics -->
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-119316120-1', 'auto');
            ga('send', 'pageview');
        </script>
        <!-- End Google Analytics -->

    </head>
    <body>
        <div id="overlay">
            <img src="<?php echo base_url('assets/img/loader.gif'); ?>" alt="Loading" /><br/>
            Cargando...
        </div>

        <div class="modal fade" id="my_modal" tabindex="3" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" id="my_modal_content" role="document">
                <?php
                if (isset($my_modal)) {
                    ?>
                    <?php echo $my_modal; ?>
                <?php } ?>
            </div>
        </div>
        <div id="wrapper">
            <!-- /. NAV TOP  -->
            <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">

                <!-- LLAMAR NAVTOP.PHP -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a  class="navbar-brand" href="<?php echo site_url(); ?>">XV Foro Nacional y I Foro Internacional de Educación en Salud
                    </a>
                </div>
                <div class="notifications-wrapper">
                    <ul class="nav">

                        <?php
                        if (isset($this->session->get_userdata()['die_sipimss']['usuario'])) {
                            $datos_sesion = $this->session->get_userdata()['die_sipimss']['usuario'];
                            //pr($datos_sesion);
                        } else {
                            $datos_sesion = array(
                                'nombre' => '', 'apellido_p' => '', 'apellido_m' => '',
                                'matricula' => '', 'categoria' => '', 'delegacion' => '',
                                'unidad' => ''
                            );
                        }
                        ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-user-plus"></i>  <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">

                                <?php
                                //pr($datos_sesion);
                                if (isset($datos_sesion['matricula'])) {
                                    ?>
                                    <li><a class="link_ficha_usuario" href="#">
                                            <b>Nombre:</b> <?php echo $datos_sesion['nombre'] . ' ' . $datos_sesion['apellido_paterno'] . ' ' . $datos_sesion['apellido_materno']; ?> <br>
                                            <b>Matrícula:</b> <?php echo $datos_sesion['matricula']; ?><br>
                                            <b>Categoría:</b> <?php echo $datos_sesion['categoria']; ?><br>
                                            <b>Delegación:</b> <?php echo $datos_sesion['delegacion']; ?> <br>
                                            <b>Unidad:</b> <?php echo $datos_sesion['unidad']; ?><br>
                                            <!--<b>Rol:</b> <?php // echo $datos_sesion['nombre_role'];           ?><br>-->
                                            <div class="ripple-container"></div></a>
                                    </li>
<?php } ?>

                                <li><a href="<?php echo site_url(); ?>/perfil"><i class="fa fa-user-plus"></i> Mi perfil</a></li>
                                <li><a href="<?php echo site_url(); ?>/inicio/cerrar_sesion"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>
                            </ul>
                        </li>

                        <?php
                        if (isset($this->session->userdata(En_datos_sesion::__INSTANCIA)['anterior'])) {
                            ?>
                            <li class="nav">
                                <a href="<?php echo site_url('administracion/terminar_entrar_como'); ?>"> Regresar a la sesión original</a>
                            </li>
                        <?php } ?>
                        <?php if (ENVIRONMENT == 'development' && isset($datos_sesion['workflow']) && count($datos_sesion['workflow']) > 0) {
                            ?>
                            <li>
                                Solo en desarrollo <br>Etapa activa del usuario: <?php echo $datos_sesion['workflow'][0]['etapa_activa']; ?>
                            </li>
                        <?php }
                        ?>

                        <li class="nav pull-right">
                            <ul class="">
                                <li>
                                    <!-- <a href="#"><img img-responsive class"logos" height="70px" src="assets/img/sipimss.png" alt=""></a> -->
                                    <a href="#" class="languaje_catalogo" data-cvelanguage="es">
                                        <img img-responsive src="<?php echo asset_url(); ?>img/language/Spain.png"
                                             height="30px"
                                             class="logos"
                                             alt="SIPIMSS"
                                             title="<?php  echo $language_text['template_general']['espaniol']; ?>"
                                             target="_blank"/>
                                    </a>
                                    <!-- <a href="#"><img img-responsive class"logos" height="70px" src="assets/img/sipimss.png" alt=""></a> -->
                                    <a href="#" class="languaje_catalogo" data-cvelanguage="en">
                                        <img img-responsive src="<?php echo asset_url(); ?>img/language/England.png"
                                             height="30px"
                                             class="logos"
                                             alt="SIPIMSS"
                                             title="<?php echo $language_text['template_general']['ingles']; ?>"
                                             target="_blank"/>
                                    </a>
                                </li>
                                <li>
                                    <!-- <a href="#"><img img-responsive class"logos" height="70px" src="assets/img/sipimss.png" alt=""></a> -->
                                    <a href="#">
                                        <img img-responsive src="<?php echo asset_url(); ?>img/sipimss.png"
                                             height="70px"
                                             class="logos"
                                             alt="SIPIMSS"
                                             title="SIPIMSS"
                                             target="_blank"/>
                                    </a>
                                </li>
                                <li>
                                    <!-- <a href="#"><img img-responsive class"logos" height="70px" src="assets/img/ces.png" alt=""></a> -->
                                    <a href="http://educacionensalud.imss.gob.mx">
                                        <img img-responsive src="<?php echo asset_url(); ?>img/ces.png"
                                             height="70px"
                                             class="logos"
                                             alt="CES"
                                             title="CES"
                                             target="_blank"/>
                                    </a>
                                </li>
                                <li>
                                    <!-- <a href="#"><img img-responsive class"logos" height="70px" src="assets/img/imss.png" alt=""></a> -->
                                    <a href="http://www.imss.gob.mx/">
                                        <img img-responsive src="<?php echo asset_url(); ?>img/imss.png"
                                             height="70px"
                                             class="logos"
                                             alt="IMSS"
                                             title="IMSS"
                                             target="_blank"/>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>


            </nav>

            <nav  class="navbar-default navbar-side " role="navigation">
                <div class="sidebar-collapse">
                    <!-- AQUI VA EL MENU LATERAL -->
                    <?php
                    if (isset($menu) && !is_null($menu)) {
                        // pr ($menu);
                        //echo $menu;
                        echo render_menu($menu['lateral'], null);
                    }
                    ?>

                </div>


            </nav>
            <!-- /. SIDEBAR MENU (navbar-side) -->
            <div id="main-content" class="page-wrapper-cls">
                <?php
                if (isset($blank)) {
                    ?>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <?php
                            echo $blank;
                            ?>
                        </div>
                    </div>
                <?php } //fin blank zone   ?>

<?php ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="">
                            <?php
                            if (isset($sub_title) && !empty($sub_title)) {
                                ?>
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">
                                    <?php echo $sub_title; ?>
                                    </h4>
                                    <?php
                                    if (isset($descripcion) && !empty($descripcion)) {
                                        ?>
                                        <p class="category">
                                        <?php echo $descripcion ?>
                                        </p>
                                <?php } ?>
                                </div>
                                <?php
                            }
                            if (isset($main_content)) {
                                ?>
                                <div class="card-content">
                                    <?php
                                    echo $main_content;
                                    ?>
                                </div>
<?php } //fin content card       ?>
                        </div>
                    </div>
                </div>
                <!-- /. PAGE WRAPPER  -->
            </div>
        </div>

        <footer class="navbar">
            <div class="col-md-1"></div>

            <div class="col-md-5">
                <br>
                <br>
                <br>
                &copy; <a href="#" target="_blank">SIPIMSS 2017</a>
                <br>
                Este sitio se visualiza correctamente a partir Mozila Firefox 50 y Google Chrome 55.
            </div>

            <div class="col-md-2"></div>

            <div class="col-md-4">
                <b class="text-center">Mesa de ayuda</b>
                <br>
                ¿Tienes alguna duda? Comunícate con nosotros:
                <br>
                <b>Teléfono:</b> 56 27 69 00 Ext. 21146, 21147 y 21148
                <br>
                <b>Email:</b> soporte.sipimss@gmail.com
                <br>
                <b>Horario:</b> de lunes a viernes, de 8h a 16h
            </div>
            <div class="col-md-4">

            </div>
        </footer>

        <!-- BOOTSTRAP SCRIPTS -->
        <?php echo js("bootstrap.js"); ?>
        <!-- METISMENU SCRIPTS -->
        <?php echo js("jquery.metisMenu.js"); ?>
        <!-- CUSTOM SCRIPTS -->
        <?php echo js("/custom.js"); ?>
        <?php echo js('template_foro/menu.js'); ?>
<?php echo js('template_foro/ayuda.js'); ?>
        <script type="text/javascript">
            // Instantiate the Bootstrap carousel
            $('.multi-item-carousel').carousel({
                interval: false
            });
            // for every slide in carousel, copy the next slide's item in the slide.
            // Do the same for the next, next item
        </script>
        <script type="text/javascript">
            $('#info_siap_modal').modal('show');
        </script>

    </body>
</html>
