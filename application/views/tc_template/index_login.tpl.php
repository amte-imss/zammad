<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=0">

        <title>
            <?php echo (!is_null($title)) ? "{$title}&nbsp;|" : "" ?>
            <?php echo (!is_null($main_title)) ? $main_title : "XV Foro Nacional y I Foro Internacional de Educación en Salud" ?>
        </title>

        <!-- Favicons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="shortcut icon" href="assets/ico/favicon.ico">

        <!-- CSS Global -->
        <link href="<?php echo asset_url(); ?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo asset_url(); ?>plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo asset_url(); ?>plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
        <!-- <link href="<?php echo asset_url(); ?>plugins/owlcarousel2/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="<?php echo asset_url(); ?>plugins/owlcarousel2/assets/owl.theme.default.min.css" rel="stylesheet">
        <link href="<?php echo asset_url(); ?>plugins/prettyphoto/css/prettyPhoto.css" rel="stylesheet"> -->
        <link href="<?php echo asset_url(); ?>plugins/animate/animate.min.css" rel="stylesheet">
        <!-- <link href="<?php echo asset_url(); ?>plugins/countdown/jquery.countdown.css" rel="stylesheet"> -->

        <link href="<?php echo asset_url(); ?>css/theme.css" rel="stylesheet">
        <link href="<?php echo asset_url(); ?>css/custom.css" rel="stylesheet">
        <link href="<?php echo asset_url();?>css/esconder.css" rel="stylesheet">
        <!--link href="<?php echo asset_url(); ?>css/inicio_sesion.css" rel="stylesheet"-->
        <?php echo $css_files; ?>
        <?php echo css('template_foro/apprise.css'); ?>

        <!--[if lt IE 9]>
        <script src="<?php echo asset_url(); ?>plugins/iesupport/html5shiv.js"></script>
        <script src="<?php echo asset_url(); ?>plugins/iesupport/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript">
            var language_text = <?php echo json_encode($language_text); ?>;
            var lang_system_ = "<?php echo $lang_system; ?>";
            var url = "<?php echo base_url(); ?>";
            var site_url = "<?php echo site_url(); ?>";
            var img_url_loader = "<?php echo base_url('assets/img/loader.gif'); ?>";
        </script>
        <!--[if lt IE 9]><script src="<?php echo asset_url(); ?>plugins/jquery/jquery-1.11.1.min.js"></script><![endif]-->
        <!--[if gte IE 9]><!--><script src="<?php echo asset_url(); ?>plugins/jquery/jquery-2.1.1.min.js"></script><!--<![endif]-->
        <script src="<?php echo asset_url(); ?>js/template_foro/general.js"></script>
        <script src="<?php echo asset_url(); ?>js/template_foro/apprise.js"></script>
        <script src="<?php echo asset_url(); ?>js/template_foro/idioma.js"></script>
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
    <body id="home" class="wide body-light">
        <div id="overlay">
            <img src="<?php echo base_url('assets/img/loader.gif'); ?>" alt="Loading" /><br/>
            Cargando...
        </div>

        <!-- Preloader -->
        <div id="preloaders">
            <div id="status">
                <div class="spinner"></div>
            </div>
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

        <!-- Wrap all content -->
        <div class="wrapper">
            <!-- HEADER -->
            <header class="header">
                <div id="linea_inicial"></div>
                <div class="container">
                    <div class="header-wrapper clearfix">
                        <!-- Logo -->
                        <section id="logo" class="col-xs-12 col-sm-12 col-md-5">
                            <div class="region region-head-logo">
                                <section id="block-block-4" class="block block-block clearfix">
                                    <div class="col-xs-6 col-sm-6 col-md-6 main-logos"><a href="http://www.gob.mx/" target="_blank"><img alt="MÉXICO | Gobierno de la República" class="img-responsive" src="<?php echo asset_url(); ?>img/PRESIDENCIA-2.png"></a></div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 main-logos"><a href="/"><img alt="Coordinación de Educación en Salud" class="img-responsive" src="<?php echo asset_url(); ?>img/ces.png"></a></div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 main-logos"><a href="http://www.imss.gob.mx/" target="_blank"><img alt="Instituto Mexicano del Seguro Social" class="img-responsive" src="<?php echo asset_url(); ?>img/imss.png"></a></div>
                                </section>
                            </div>
                        </section>
                        <section id="btn-divisiones" class="col-xs-12 col-sm-12 col-md-7">
                            <!-- <div class="region region-head-button">
                                <section id="block-block-3" class="block block-block clearfix">
                                    <div class="col-xs-12 col-sm-4 col-md-4 main-CESbuttons"><div class="btn-pad botonPE"><a class="main-button" href="/programas-educativos/acerca">PROGRAMAS EDUCATIVOS</a></div></div>
                                    <div class="col-xs-12 col-sm-4 col-md-4 main-CESbuttons"><div class="btn-pad botonPE"><a class="main-button" href="/educacion-continua/acerca">EDUCACIÓN CONTINUA</a></div></div>
                                    <div class="col-xs-12 col-sm-4 col-md-4 main-CESbuttons"><div class="btn-pad botonPE"><a class="main-button" href="/innovacion-educativa/acerca">INNOVACIÓN EDUCATIVA</a></div></div>
                                </section>
                            </div> -->
                        </section>
                        <!-- /Logo -->
                        <!-- <div class="col-sm-4 col-md-7 col-lg-7 pull-right text-right">
                            <a href="#" class="languaje_catalogo" data-cvelanguage="es">
                                <img img-responsive src="<?php echo asset_url(); ?>img/language/mx.png"
                                     class="logos"
                                     alt="<?php echo $language_text['template_general']['espaniol']; ?>"
                                     title="<?php echo $language_text['template_general']['espaniol']; ?>"
                                     target="_blank"
                                     width="20px;"/>
                            </a>
                            <a href="#" class="languaje_catalogo" data-cvelanguage="en">
                                <img img-responsive src="<?php echo asset_url(); ?>img/language/us.png"
                                     class="logos"
                                     alt="<?php echo $language_text['template_general']['ingles']; ?>"
                                     title="<?php echo $language_text['template_general']['ingles']; ?>"
                                     target="_blank"
                                     width="20px;"/>
                            </a>
                        </div> -->                        
                    </div>
                </div>
                <!-- Navigation -->
                <div class="col-sm-12 col-md-12 col-lg-12 right">
                    <div class="container-fluid">
                        <div class="container">
                            <?php
                            if (isset($menu) && !is_null($menu)) {
                                // pr($menu);
                                //echo $menu;
                                if (isset($menu['lateral']) && !empty($menu['lateral'])) {
                                    //echo render_menu($menu['lateral'], null);
                                    echo render_menu_no_sesion($menu['lateral'], null);
                                }
                                if (isset($menu['lateral_no_sesion']) && !empty($menu['lateral_no_sesion'])) {
                                    echo render_menu_no_sesion($menu['lateral_no_sesion'], null);
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!-- /Navigation -->
                
                <!-- <nav class="navbar navbar-default navbar-inverse">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="collapse in navbar-collapse" id="navbar-1">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding:0px;">
                                    <div class="region region-navigation">
                                        <section id="block-superfish-1" class="block block-superfish clearfix">
                                            <ul id="superfish-1" class="menu nav navbar-nav sf-menu sf-main-menu sf-horizontal sf-style-space sf-total-items-9 sf-parent-items-3 sf-single-items-6 superfish-processed sf-js-enabled sf-shadow"><li id="menu-238-1" class="active-trail first odd sf-item-1 sf-depth-1 sf-no-children"><a href="/es" class="sf-depth-1 active">Inicio</a></li><li id="menu-728-1" class="middle even sf-item-2 sf-depth-1 sf-total-children-5 sf-parent-children-0 sf-single-children-5 menuparent"><a href="/es/content/coordinaci%C3%B3n-de-educaci%C3%B3n-en-salud" class="sf-depth-1 menuparent sf-with-ul">Nosotros<span class="sf-sub-indicator"> »</span></a><ul style="float: none; width: 21.4615em;" class="sf-hidden"><li id="menu-973-1" class="first odd sf-item-1 sf-depth-2 sf-no-children" style=""><a href="/es/content/coordinaci%C3%B3n-de-educaci%C3%B3n-en-salud" class="sf-depth-2" style="">Coordinación de Educación en Salud</a></li><li id="menu-1223-1" class="middle even sf-item-2 sf-depth-2 sf-no-children" style=""><a href="/es/programas-educativos/acerca" title="División de Programas Educativos" class="sf-depth-2" style="">División de Programas Educativos</a></li><li id="menu-1225-1" class="middle odd sf-item-3 sf-depth-2 sf-no-children" style=""><a href="/es/educacion-continua/acerca" title="División de Educación Continua" class="sf-depth-2" style="">División de Educación Continua</a></li><li id="menu-976-1" class="middle even sf-item-4 sf-depth-2 sf-no-children" style=""><a href="/es/innovacion-educativa/acerca" class="sf-depth-2" style="">División de Innovación Educativa</a></li><li id="menu-1628-1" class="last odd sf-item-5 sf-depth-2 sf-no-children" style=""><a href="/es/fofoe-0" class="sf-depth-2" style="">FOFOE</a></li></ul></li><li id="menu-951-1" class="middle odd sf-item-3 sf-depth-1 sf-total-children-8 sf-parent-children-1 sf-single-children-7 menuparent"><a href="/es/oferta-educativa" class="sf-depth-1 menuparent sf-with-ul">Oferta educativa<span class="sf-sub-indicator"> »</span></a><ul style="float: none; width: 16.3846em;" class="sf-hidden"><li id="menu-1227-1" class="first odd sf-item-1 sf-depth-2 sf-no-children" style=""><a href="/es/programas-educativos/enfermer%C3%ADa" title="Descripción del perfil de enfermería" class="sf-depth-2" style="">Enfermería</a></li><li id="menu-1488-1" class="middle even sf-item-2 sf-depth-2 sf-no-children" style=""><a href="/es/estudios-t%C3%A9cnicos-1" class="sf-depth-2" style="">Estudios Técnicos</a></li><li id="menu-1229-1" class="middle odd sf-item-3 sf-depth-2 sf-no-children" style=""><a href="/es/programas-educativos/pregrado" class="sf-depth-2" style="">Pregrado</a></li><li id="menu-1230-1" class="middle even sf-item-4 sf-depth-2 sf-total-children-1 sf-parent-children-0 sf-single-children-1 menuparent" style=""><a href="/es/programas-educativos/postgrado" class="sf-depth-2 menuparent sf-with-ul" style="">Posgrado<span class="sf-sub-indicator"> »</span></a><ul style="left: 100%; float: none; width: 16.3846em;" class="sf-hidden"><li id="menu-1419-1" class="firstandlast odd sf-item-1 sf-depth-3 sf-no-children" style=""><a href="/es/convocatorias" class="sf-depth-3" style="">Convocatorias</a></li></ul></li><li id="menu-981-1" class="middle odd sf-item-5 sf-depth-2 sf-no-children" style=""><a href="http://edumed.imss.gob.mx:8080/bCurso/" title="" class="sf-depth-2" style="" target="_blank">Educación Continua</a></li><li id="menu-982-1" class="middle even sf-item-6 sf-depth-2 sf-no-children" style=""><a href="http://innovacioneducativa.imss.gob.mx/index.php?option=com_content&amp;view=article&amp;id=159" title="" class="sf-depth-2" style="" target="_blank">Educación a Distancia</a></li><li id="menu-1414-1" class="middle odd sf-item-7 sf-depth-2 sf-no-children" style=""><a href="/es/ingreso-ex%C3%A1menes" class="sf-depth-2" style="">Ingreso a Exámenes</a></li><li id="menu-1485-1" class="last even sf-item-8 sf-depth-2 sf-no-children" style=""><a href="http://innovacioneducativa.imss.gob.mx/es/centros_y_sedes_de_informacion" title="" class="sf-depth-2" style="" target="_blank">CIEFD</a></li></ul></li><li id="menu-1232-1" class="middle even sf-item-4 sf-depth-1 sf-no-children"><a href="/es/reis" class="sf-depth-1">Recursos de Información</a></li><li id="menu-952-1" class="middle odd sf-item-5 sf-depth-1 sf-no-children"><a href="http://educacionensalud.imss.gob.mx/becas/" title="Programa de educación en centros de excelencia" class="sf-depth-1">PECE</a></li><li id="menu-1484-1" class="middle even sf-item-6 sf-depth-1 sf-no-children"><a href="http://aplicativosweb_die.imss.gob.mx/cores/" title="Consulta de resultados de educación en salud" class="sf-depth-1" target="_blank">CORES</a></li><li id="menu-1220-1" class="middle odd sf-item-7 sf-depth-1 sf-no-children"><a href="/es/noticias" class="sf-depth-1">Noticias</a></li><li id="menu-1231-1" class="middle even sf-item-8 sf-depth-1 sf-no-children"><a href="/es/faq" title="" class="sf-depth-1">FAQ</a></li><li id="menu-955-1" class="last odd sf-item-9 sf-depth-1 sf-total-children-1 sf-parent-children-0 sf-single-children-1 menuparent"><a href="/es/contacto" title="" class="sf-depth-1 menuparent sf-with-ul">Contacto<span class="sf-sub-indicator"> »</span></a><ul style="float: none; width: 16.3846em;" class="sf-hidden"><li id="menu-1233-1" class="firstandlast odd sf-item-1 sf-depth-2 sf-no-children" style=""><a href="/es/directorio-ces" class="sf-depth-2" style="">Directorio CES</a></li></ul></li></ul>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav> -->
            </header><div class="clear:both"></div>
            <!-- /HEADER -->

            <!-- Content area -->
            <div class="content-area">
                <div class="sn-title">
                    <div class="container">
                        <h3 class="title-section col-xs-12 col-sm-12 col-md-12 ">
                            <?php if (isset($main_title)) { ?>
                                <?php echo $main_title; ?>
                            <?php } ?>
                        </h3>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!-- <div id="main"> -->
                <section class="page-section background-img">
                    <div class="container">
                        <div class="">
                            <?php echo $main_content; ?>
                        </div>
                    </div>
                </section>
                <!-- SLIDER -->
                <!-- <section class="page-section no-padding background-img-slider">
                    <div style="clear:both;"></div>
                    <div class="container">
                        <div id="main-slider"> -->
<?php //echo $main_content;  ?>
                <!-- </div>
            </div>
        </section> -->
                <!-- /SLIDER -->
            </div>
            <span class="copyright" data-animation="fadeInUp" data-animation-delay="100"></span>

            <!-- </div> -->
            <!-- /Content area -->
            <!-- FOOTER -->
            <footer class="footer">
                <div class="footer-meta">
                    <section id='f-header' class='container-fluid'>
                        <div class='container'>
                            <div class='region region-separator3'>
                                <section id='block-block-2' class='block block-block clearfix'>
                                <div class='col-xs-12 col-sm-12 col-md-12' id='sn-title'><h4>Coordinación de Educación en Salud</h4></div>	</section>
                            </div>
                        </div>
                    </section>
                    <div class="container">
                        <div class="clearfix text-center">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                                <?php if(isset($language_text['generales']['legal'])){
                                    echo $language_text['generales']['legal'];
                                } ?>
                            </div>
                            <?php if(isset($language_text['generales']['creditos_titulo'])){
                                echo $language_text['generales']['creditos_titulo'];
                            } ?>
                        </div>
                        
                        <!-- <section id='f-CES' class='col-xs-12 col-sm-6 col-md-4'>
                            <div class='region region-footer-t1'>
                                <section id='block-superfish-2' class='block block-superfish clearfix'>
                                <ul id='superfish-2' class='menu nav navbar-nav sf-menu sf-menu-men-divisiones sf-vertical sf-style-menu-secundario-ces sf-total-items-4 sf-parent-items-0 sf-single-items-4 superfish-processed sf-js-enabled sf-shadow' style='display: block;'><li id='menu-964-2' class='first odd sf-item-1 sf-depth-1 sf-no-children'><a href='/es/programas-educativos/acerca' title='' class='sf-depth-1'>División de Programas Educativos</a></li><li id='menu-963-2' class='middle even sf-item-2 sf-depth-1 sf-no-children'><a href='/es/educacion-continua/acerca' title='' class='sf-depth-1'>División de Educación Continua</a></li><li id='menu-965-2' class='middle odd sf-item-3 sf-depth-1 sf-no-children'><a href='/es/innovacion-educativa/acerca' title='' class='sf-depth-1'>División de Innovación Educativa</a></li><li id='menu-1483-2' class='last even sf-item-4 sf-depth-1 sf-no-children'><a href='/es/requerimientos_tecnicos' title='' class='sf-depth-1'>Requerimientos de Sistema</a></li></ul>	</section>
                                <section id='block-block-23' class='block block-block clearfix'>
                                <div class='col col-sm-6 col-sm-push-3 col-xs-4 col-xs-push-4 '><br>&nbsp;</div>	</section>
                            </div>
                        </section>
                        <section id='f-menu' class='col-xs-12 col-sm-6 col-md-3'>
                            <div class='region region-footer-t2'>
                                <section id='block-superfish-3' class='block block-superfish clearfix'>
                                <ul id='superfish-3' class='menu nav navbar-nav sf-menu sf-menu-men-secundario sf-vertical sf-style-menu-secundario-ces sf-total-items-8 sf-parent-items-0 sf-single-items-8 superfish-processed sf-js-enabled sf-shadow' style='display: block;'><li id='menu-1039-3' class='active-trail first odd sf-item-1 sf-depth-1 sf-no-children'><a href='/es' title='' class='sf-depth-1 active'>Inicio</a></li><li id='menu-957-3' class='middle even sf-item-2 sf-depth-1 sf-no-children'><a href='/es/content/coordinaci%C3%B3n-de-educaci%C3%B3n-en-salud' title='' class='sf-depth-1'>Nosotros</a></li><li id='menu-958-3' class='middle odd sf-item-3 sf-depth-1 sf-no-children'><a href='/es/oferta-educativa' title='' class='sf-depth-1'>Oferta educativa</a></li><li id='menu-1041-3' class='middle even sf-item-4 sf-depth-1 sf-no-children'><a href='/es/reis' title='' class='sf-depth-1'>Recursos de Información</a></li><li id='menu-1040-3' class='middle odd sf-item-5 sf-depth-1 sf-no-children'><a href='http://educacionensalud.imss.gob.mx/becas/' title='' class='sf-depth-1'>Becas</a></li><li id='menu-959-3' class='middle even sf-item-6 sf-depth-1 sf-no-children'><a href='/es/noticias' title='' class='sf-depth-1'>Noticias</a></li><li id='menu-960-3' class='middle odd sf-item-7 sf-depth-1 sf-no-children'><a href='/es/faq' title='' class='sf-depth-1'>FAQ</a></li><li id='menu-961-3' class='last even sf-item-8 sf-depth-1 sf-no-children'><a href='/es/contacto' title='' class='sf-depth-1'>Contacto</a></li></ul>	</section>
                                <section id='block-block-33' class='block block-block clearfix'>
                                <div><a href='http://educacionensalud.imss.gob.mx/aviso-privacidad/' target='_blank'><span style='color:#ffffff; font-size:14px; line-height:20px; padding: 10px 15px;'>Aviso de Privacidad</span></a></div>	</section>
                            </div>
                        </section> -->
                        <section id='f-contact' class='col-xs-12 col-sm-12 col-md-12 text-center'>
                            <div class='fborder'>
                                <div class='region region-footer-t3'>
                                    <section id='block-social-media-links-social-media-links' class='block block-social-media-links clearfix'>
                                    <ul class='social-media-links platforms inline horizontal'><li class='facebook first'><a href='https://www.facebook.com/SaberIMSS' target='_blank' title='Facebook'><img src='http://educacionensalud.imss.gob.mx/sites/all/modules/social_media_links/libraries/elegantthemes/PNG/facebook.png' alt='Facebook icon'></a></li><li class='twitter'><a href='http://www.twitter.com/Saber_IMSS ' target='_blank' title='Twitter'><img src='http://educacionensalud.imss.gob.mx/sites/all/modules/social_media_links/libraries/elegantthemes/PNG/twitter.png' alt='Twitter icon'></a></li><li class='youtube_channel last'><a href='http://www.youtube.com/channel/UCvlda6Uw7N_pZAH_fxE9ZYA' target='_blank' title='Youtube (Channel)'><img src='http://educacionensalud.imss.gob.mx/sites/all/modules/social_media_links/libraries/elegantthemes/PNG/youtube.png' alt='Youtube (Channel) icon'></a></li></ul>	</section>
                                    <section id='block-block-1' class='block block-block clearfix'>
                                    <div class='center-block block-contact withadress'><address class='faddress'><span style='color:#ffffff;'><strong>Instituto Mexicano del Seguro Social Centro Médico Siglo XXI</strong><br>Cuauhtémoc 330, Doctores 06720, Ciudad de México</span><br><br><a href='tel:+15556276900'><div aria-hidden='true' class='glyphicon glyphicon-earphone' style='color:#ffffff;'><span style='color:#ffffff;'>&nbsp;</span></div><span style='color:#ffffff;'>01 (55) 5627 6900</span></a><span style='color:#ffffff;'><span> Ext. 21175</span></span></address><address class='faddress'><span style='color:#ffffff;'><span style='font-size:11px;'>Programas Educativos | &nbsp;Ext. 21178<br>Educación Continua | &nbsp;Ext. 21243<br>Innovación Educativa | &nbsp;Ext. 21254</span></span></address><p class='f-private-policy'><span style='color:#ffffff;'>IMSS, 2019. Todos los derechos reservados.</span></p></div></section>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </footer>
            <!-- <footer id='pie'>
    <section id='f-header' class='container-fluid'>
        <div class='container'>
            <div class='region region-separator3'>
                <section id='block-block-2' class='block block-block clearfix'>
                <div class='col-xs-12 col-sm-12 col-md-12' id='sn-title'><h4>Coordinación de Educación en Salud</h4></div>	</section>
            </div>
        </div>
    </section>
    <div class='container'>
        <section id='f-CES' class='col-xs-12 col-sm-6 col-md-4'>
            <div class='region region-footer-t1'>
                <section id='block-superfish-2' class='block block-superfish clearfix'>
                <ul id='superfish-2' class='menu nav navbar-nav sf-menu sf-menu-men-divisiones sf-vertical sf-style-menu-secundario-ces sf-total-items-4 sf-parent-items-0 sf-single-items-4 superfish-processed sf-js-enabled sf-shadow' style='display: block;'><li id='menu-964-2' class='first odd sf-item-1 sf-depth-1 sf-no-children'><a href='/es/programas-educativos/acerca' title='' class='sf-depth-1'>División de Programas Educativos</a></li><li id='menu-963-2' class='middle even sf-item-2 sf-depth-1 sf-no-children'><a href='/es/educacion-continua/acerca' title='' class='sf-depth-1'>División de Educación Continua</a></li><li id='menu-965-2' class='middle odd sf-item-3 sf-depth-1 sf-no-children'><a href='/es/innovacion-educativa/acerca' title='' class='sf-depth-1'>División de Innovación Educativa</a></li><li id='menu-1483-2' class='last even sf-item-4 sf-depth-1 sf-no-children'><a href='/es/requerimientos_tecnicos' title='' class='sf-depth-1'>Requerimientos de Sistema</a></li></ul>	</section>
                <section id='block-block-23' class='block block-block clearfix'>
                <div class='col col-sm-6 col-sm-push-3 col-xs-4 col-xs-push-4 '><br>&nbsp;</div>	</section>
            </div>
        </section>
        <section id='f-menu' class='col-xs-12 col-sm-6 col-md-3'>
            <div class='region region-footer-t2'>
                <section id='block-superfish-3' class='block block-superfish clearfix'>
                <ul id='superfish-3' class='menu nav navbar-nav sf-menu sf-menu-men-secundario sf-vertical sf-style-menu-secundario-ces sf-total-items-8 sf-parent-items-0 sf-single-items-8 superfish-processed sf-js-enabled sf-shadow' style='display: block;'><li id='menu-1039-3' class='active-trail first odd sf-item-1 sf-depth-1 sf-no-children'><a href='/es' title='' class='sf-depth-1 active'>Inicio</a></li><li id='menu-957-3' class='middle even sf-item-2 sf-depth-1 sf-no-children'><a href='/es/content/coordinaci%C3%B3n-de-educaci%C3%B3n-en-salud' title='' class='sf-depth-1'>Nosotros</a></li><li id='menu-958-3' class='middle odd sf-item-3 sf-depth-1 sf-no-children'><a href='/es/oferta-educativa' title='' class='sf-depth-1'>Oferta educativa</a></li><li id='menu-1041-3' class='middle even sf-item-4 sf-depth-1 sf-no-children'><a href='/es/reis' title='' class='sf-depth-1'>Recursos de Información</a></li><li id='menu-1040-3' class='middle odd sf-item-5 sf-depth-1 sf-no-children'><a href='http://educacionensalud.imss.gob.mx/becas/' title='' class='sf-depth-1'>Becas</a></li><li id='menu-959-3' class='middle even sf-item-6 sf-depth-1 sf-no-children'><a href='/es/noticias' title='' class='sf-depth-1'>Noticias</a></li><li id='menu-960-3' class='middle odd sf-item-7 sf-depth-1 sf-no-children'><a href='/es/faq' title='' class='sf-depth-1'>FAQ</a></li><li id='menu-961-3' class='last even sf-item-8 sf-depth-1 sf-no-children'><a href='/es/contacto' title='' class='sf-depth-1'>Contacto</a></li></ul>	</section>
                <section id='block-block-33' class='block block-block clearfix'>
                <div><a href='http://educacionensalud.imss.gob.mx/aviso-privacidad/' target='_blank'><span style='color:#ffffff; font-size:14px; line-height:20px; padding: 10px 15px;'>Aviso de Privacidad</span></a></div>	</section>
            </div>
        </section>
        <section id='f-contact' class='col-xs-12 col-sm-12 col-md-5'>
            <div class='fborder'>
                <div class='region region-footer-t3'>
                    <section id='block-social-media-links-social-media-links' class='block block-social-media-links clearfix'>
                    <ul class='social-media-links platforms inline horizontal'><li class='facebook first'><a href='https://www.facebook.com/SaberIMSS' target='_blank' title='Facebook'><img src='http://educacionensalud.imss.gob.mx/sites/all/modules/social_media_links/libraries/elegantthemes/PNG/facebook.png' alt='Facebook icon'></a></li><li class='twitter'><a href='http://www.twitter.com/Saber_IMSS ' target='_blank' title='Twitter'><img src='http://educacionensalud.imss.gob.mx/sites/all/modules/social_media_links/libraries/elegantthemes/PNG/twitter.png' alt='Twitter icon'></a></li><li class='youtube_channel last'><a href='http://www.youtube.com/channel/UCvlda6Uw7N_pZAH_fxE9ZYA' target='_blank' title='Youtube (Channel)'><img src='http://educacionensalud.imss.gob.mx/sites/all/modules/social_media_links/libraries/elegantthemes/PNG/youtube.png' alt='Youtube (Channel) icon'></a></li></ul>	</section>
                    <section id='block-block-1' class='block block-block clearfix'>
                    <div class='center-block block-contact withadress'><address class='faddress'><span style='color:#ffffff;'><strong>Instituto Mexicano del Seguro Social<br>Centro Médico Siglo XXI</strong><br>Cuauhtémoc 330, Doctores<br>06720, Ciudad de México</span><div aria-hidden='true' class='glyphicon glyphicon-earphone'><span style='color:#ffffff;'>&nbsp;</span><a href='tel:+15556276900' style='font-size: 11px;'><span style='color:#ffffff;'>01 (55) 5627 6900</span></a><span style='color:#ffffff;'><span style='font-size: 11px;'> Ext. 21175</span></span></div></address><address class='faddress'><span style='color:#ffffff;'><span style='font-size:11px;'>Programas Educativos | &nbsp;Ext. 21178<br>Educación Continua | &nbsp;Ext. 21243<br>Innovación Educativa | &nbsp;Ext. 21254</span></span></address><p class='f-private-policy'><span style='color:#ffffff;'>IMSS, 2016. Todos los derechos reservados.</span></p><p class='f-private-policy'>&nbsp;</p></div>	</section>
                </div>
            </div>
        </section>
    </div>
</footer> -->
            <!-- <footer id="pie">
                <section id="f-header" class="container-fluid">
                    <div class="container">
                        <div class="region region-separator3">
                            <section id="block-block-2" class="block block-block clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-12" id="sn-title"><h4>Coordinación de Educación en Salud</h4></div>
                            </section>
                        </div>
                    </div>
                </section>
                <div class="container">
                    <section id="f-CES" class="col-xs-12 col-sm-6 col-md-4">
                        <div class="region region-footer-t1">
                            <section id="block-superfish-2" class="block block-superfish clearfix">
                                <ul id="superfish-2" class="menu nav navbar-nav sf-menu sf-menu-men-divisiones sf-vertical sf-style-menu-secundario-ces sf-total-items-4 sf-parent-items-0 sf-single-items-4 superfish-processed sf-js-enabled sf-shadow"><li id="menu-964-2" class="first odd sf-item-1 sf-depth-1 sf-no-children"><a href="/es/programas-educativos/acerca" title="" class="sf-depth-1">División de Programas Educativos</a></li><li id="menu-963-2" class="middle even sf-item-2 sf-depth-1 sf-no-children"><a href="/es/educacion-continua/acerca" title="" class="sf-depth-1">División de Educación Continua</a></li><li id="menu-965-2" class="middle odd sf-item-3 sf-depth-1 sf-no-children"><a href="/es/innovacion-educativa/acerca" title="" class="sf-depth-1">División de Innovación Educativa</a></li><li id="menu-1483-2" class="last even sf-item-4 sf-depth-1 sf-no-children"><a href="/es/requerimientos_tecnicos" title="" class="sf-depth-1">Requerimientos de Sistema</a></li></ul>	
                            </section>
                            <section id="block-block-23" class="block block-block clearfix">
                                <div class="col col-sm-6 col-sm-push-3 col-xs-4 col-xs-push-4 "><br>&nbsp;</div>	
                            </section>
                        </div>
                    </section>
                    <section id="f-menu" class="col-xs-12 col-sm-6 col-md-3">
                        <div class="region region-footer-t2">
                            <section id="block-superfish-3" class="block block-superfish clearfix">
                                <ul id="superfish-3" class="menu nav navbar-nav sf-menu sf-menu-men-secundario sf-vertical sf-style-menu-secundario-ces sf-total-items-8 sf-parent-items-0 sf-single-items-8 superfish-processed sf-js-enabled sf-shadow"><li id="menu-1039-3" class="active-trail first odd sf-item-1 sf-depth-1 sf-no-children"><a href="/es" title="" class="sf-depth-1 active">Inicio</a></li><li id="menu-957-3" class="middle even sf-item-2 sf-depth-1 sf-no-children"><a href="/es/content/coordinaci%C3%B3n-de-educaci%C3%B3n-en-salud" title="" class="sf-depth-1">Nosotros</a></li><li id="menu-958-3" class="middle odd sf-item-3 sf-depth-1 sf-no-children"><a href="/es/oferta-educativa" title="" class="sf-depth-1">Oferta educativa</a></li><li id="menu-1041-3" class="middle even sf-item-4 sf-depth-1 sf-no-children"><a href="/es/reis" title="" class="sf-depth-1">Recursos de Información</a></li><li id="menu-1040-3" class="middle odd sf-item-5 sf-depth-1 sf-no-children"><a href="http://educacionensalud.imss.gob.mx/becas/" title="" class="sf-depth-1">Becas</a></li><li id="menu-959-3" class="middle even sf-item-6 sf-depth-1 sf-no-children"><a href="/es/noticias" title="" class="sf-depth-1">Noticias</a></li><li id="menu-960-3" class="middle odd sf-item-7 sf-depth-1 sf-no-children"><a href="/es/faq" title="" class="sf-depth-1">FAQ</a></li><li id="menu-961-3" class="last even sf-item-8 sf-depth-1 sf-no-children"><a href="/es/contacto" title="" class="sf-depth-1">Contacto</a></li></ul>
                            </section>
                            <section id="block-block-33" class="block block-block clearfix">
                                <div><a href="http://educacionensalud.imss.gob.mx/aviso-privacidad/" target="_blank"><span style="color:#ffffff; font-size:14px; line-height:20px; padding: 10px 15px;">Aviso de Privacidad</span></a></div>
                            </section>
                        </div>
                    </section>
                    <section id="f-contact" class="col-xs-12 col-sm-12 col-md-5">
                        <div class="fborder">
                            <div class="region region-footer-t3">
                                <section id="block-social-media-links-social-media-links" class="block block-social-media-links clearfix">
                                    <ul class="social-media-links platforms inline horizontal"><li class="facebook first"><a href="https://www.facebook.com/SaberIMSS" target="_blank" title="Facebook"><img src="http://educacionensalud.imss.gob.mx/sites/all/modules/social_media_links/libraries/elegantthemes/PNG/facebook.png" alt="Facebook icon"></a></li><li class="twitter"><a href="http://www.twitter.com/Saber_IMSS " target="_blank" title="Twitter"><img src="http://educacionensalud.imss.gob.mx/sites/all/modules/social_media_links/libraries/elegantthemes/PNG/twitter.png" alt="Twitter icon"></a></li><li class="youtube_channel last"><a href="http://www.youtube.com/channel/UCvlda6Uw7N_pZAH_fxE9ZYA" target="_blank" title="Youtube (Channel)"><img src="http://educacionensalud.imss.gob.mx/sites/all/modules/social_media_links/libraries/elegantthemes/PNG/youtube.png" alt="Youtube (Channel) icon"></a></li></ul>
                                </section>
                                <section id="block-block-1" class="block block-block clearfix">
                                    <div class="center-block block-contact withadress"><address class="faddress"><span style="color:#ffffff;"><strong>Instituto Mexicano del Seguro Social<br>Centro Médico Siglo XXI</strong><br>Cuauhtémoc 330, Doctores<br>06720, Ciudad de México</span><div aria-hidden="true" class="glyphicon glyphicon-earphone"><span style="color:#ffffff;">&nbsp;</span><a href="tel:+15556276900" style="font-size: 11px;"><span style="color:#ffffff;">01 (55) 5627 6900</span></a><span style="color:#ffffff;"><span style="font-size: 11px;"> Ext. 21175</span></span></div></address><address class="faddress"><span style="color:#ffffff;"><span style="font-size:11px;">Programas Educativos | &nbsp;Ext. 21178<br>Educación Continua | &nbsp;Ext. 21243<br>Innovación Educativa | &nbsp;Ext. 21254</span></span></address><p class="f-private-policy"><span style="color:#ffffff;">IMSS, 2016. Todos los derechos reservados.</span></p><p class="f-private-policy">&nbsp;</p></div>	
                                </section>
                            </div>
                        </div>
                    </section>
                </div>
            </footer> -->
            <!-- /FOOTER -->
            <div class="to-top"><i class="fa fa-angle-up"></i></div>

        </div>
        <!-- /Wrap all content -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered"  role="document">
                <div id="modal_contenido" class="modal-content">
                    <!-- <div class="modal-header">
                      <h3 class="modal-title" id="exampleModalLabel">Asignar revisor(es)</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div> -->
                    <div class="modal-body">
                        <!-- <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Nombre</th>
                              <th scope="col">Especialidad</th>
                              <th scope="col">Opciones</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="row">Juan Cuadros </th>
                              <td>Diabetes</td>
                              <td><button type="button" data-animation="flipInY" data-animation-delay="100" class="btn btn-theme btn-block submit-button" data-toggle="modal" data-target="#exampleModal">Asignar</button>
                              </td>
                            </tr>
                            <tr>
                              <th scope="row">Mariana Reyes</th>
                              <td>Medicina general</td>
                              <td><button type="button" data-animation="flipInY" data-animation-delay="100" class="btn btn-theme btn-block submit-button" data-toggle="modal" data-target="#exampleModal">Asignar</button>
                              </td>
                            </tr>
                            <tr>
                              <th scope="row">Cristina Pacheco</th>
                              <td>Neurocirugia</td>
                              <td><button type="button" data-animation="flipInY" data-animation-delay="100" class="col-sm-1 btn btn-theme btn-block submit-button" data-toggle="modal" data-target="#exampleModal">Asignar</button>
                              </td>
                            </tr>
                            <tr>
                              <th scope="row">Cristina Pacheco</th>
                              <td>Neurocirugia</td>
                              <td><button type="button" data-animation="flipInY" data-animation-delay="100" class="col-sm-1 btn btn-theme btn-block submit-button" data-toggle="modal" data-target="#exampleModal">Asignar</button>
                              </td>
                            </tr>
                          </tbody>
                        </table> -->
                    </div>
                    <!-- <div class="modal-footer">
                      <button type="button" data-animation="flipInY" data-animation-delay="100" class="btn btn-theme btn-block" class="btn btn-primary">Guardar</button>
                    </div> -->
                </div>
            </div>
        </div>
        <!-- Modal -->

        <!-- JS Global -->
        <script src="<?php echo asset_url(); ?>plugins/modernizr.custom.js"></script>
        <script src="<?php echo asset_url(); ?>plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo asset_url(); ?>plugins/bootstrap-select/bootstrap-select.min.js"></script>
        <!-- <script src="<?php echo asset_url(); ?>plugins/superfish/js/superfish.js"></script>
        <script src="<?php echo asset_url(); ?>plugins/prettyphoto/js/jquery.prettyPhoto.js"></script> -->
        <script src="<?php echo asset_url(); ?>plugins/placeholdem.min.js"></script>
        <script src="<?php echo asset_url(); ?>plugins/jquery.smoothscroll.min.js"></script>
        <script src="<?php echo asset_url(); ?>plugins/jquery.easing.min.js"></script>

        <!-- JS Page Level -->
        <!-- <script src="<?php echo asset_url(); ?>plugins/owlcarousel2/owl.carousel.min.js"></script> -->
        <script src="<?php echo asset_url(); ?>plugins/waypoints/waypoints.min.js"></script>
        <!-- <script src="<?php echo asset_url(); ?>plugins/countdown/jquery.plugin.min.js"></script>
        <script src="<?php echo asset_url(); ?>plugins/countdown/jquery.countdown.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script> -->

        <script src="<?php echo asset_url(); ?>js/theme-ajax-mail.js"></script>
        <script src="<?php echo asset_url(); ?>js/theme.js"></script>
        <script src="<?php echo asset_url(); ?>js/template_foro/menu.js"></script>
        <!-- script src="<?php echo asset_url(); ?>js/custom.js"></script -->

        <script type="text/javascript">
            jQuery(document).ready(function () {
                theme.init();
                theme.initMainSlider();
                theme.initCountDown();
                theme.initPartnerSlider();
                theme.initTestimonials();
                theme.initGoogleMap();



                $(window).resize(function(){

                   if ($('header').width() < 992 ){
                     $('#menuREPORTES_MENU').parent()[0].childNodes[1].className = "esconderNav";
                     $('#menuPERFIL').parent()[0].childNodes[1].className = "esconderNav";
                     $('#menuADMIN').parent()[0].childNodes[1].className = "esconderNav";
                     $('.esconderNav').hide();
                     //$('#menuREPORTES_MENU').children('li').css('display','none !important');
                   }else{
                     $('.esconderNav').show();
                     //$('.sf-menu ul li').css('background-color','rgba(13, 29, 49, 0.80)');
                     //background-color: ;
                   }

                });
            });
            jQuery(window).load(function () {
                theme.initAnimation();
            });

            jQuery(window).load(function () {
                jQuery('body').scrollspy({offset: 100, target: '.navigation'});
            });
            jQuery(window).load(function () {
                jQuery('body').scrollspy('refresh');
            });
            jQuery(window).resize(function () {
                jQuery('body').scrollspy('refresh');
            });

            jQuery(document).ready(function () {
                theme.onResize();
            });
            jQuery(window).load(function () {
                theme.onResize();
            });
            jQuery(window).resize(function () {
                theme.onResize();
            });

            jQuery(window).load(function () {
                if (location.hash != '') {
                    var hash = '#' + window.location.hash.substr(1);
                    if (hash.length) {
                        jQuery('html,body').delay(0).animate({
                            scrollTop: jQuery(hash).offset().top - 44 + 'px'
                        }, {
                            duration: 1200,
                            easing: "easeInOutExpo"
                        });
                    }
                }
            });

        </script>
<?php echo $js_files; ?>
    </body>
</html>
