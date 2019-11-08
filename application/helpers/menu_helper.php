<?php
/**
 * @author Christian Garcia
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('render_menu_no_sesion')) {

    function render_menu_no_sesion($menu = [], $dropdown = null) {
//        pr($menu);
        $html = '';
        ob_start();
        ?>
        <div id="mobile-menu"></div>
        <nav class="navigation closed clearfix">
            <a href="#" class="menu-toggle btn"><i class="fa fa-bars" style="color: red !important;"></i></a>
            <ul class="sf-menu nav">
                <?php
                foreach ($menu as $item) {
                    //                pr($item);
                    $enlace = '#';
                    if (isset($item['link'])) {
                        if (startsWith($item['link'], 'http://') || startsWith($item['link'], 'https://')) {
                            $enlace = $item['link'];
                        } else if (empty($item['link'])) {
                            $enlace = '#';
                        } else {
                            $enlace = site_url() . $item['link'];
                        }
                    }
                    ?>
                    <li class="<?php echo (current_url() == $enlace) ? 'active' : ''; ?>">
                        <a href="<?php echo (isset($item['childs']) || $item['id_menu'] == 'CENSO' ? '#' : $enlace); ?>" <?php echo (isset($item['childs']) || $item['id_menu'] == 'CENSO' ? 'data-toggle="collapse" data-target="#menu' . $item['id_menu'] . '"' : ' id="tablero-menu-item-' . $item['id_menu'] . '" class="tablero-menu-item" '); ?>
                        <?php
                        if (isset($item['configurador'])) {
                            switch ($item['configurador']) {
                                case 'EXTERNO':
                                    echo ' target="_blank" ';
                                    break;
                                case 'MODAL':
                                    echo ' data-toggle="modal" data-target="#my_modal" onclick="modal_menu(\'' . $enlace . '\')"';
                                    break;
                                case 'MODAL_GENE':
                                    echo ' data-toggle="modal" data-target="#my_modal" onclick="modal_menu(\'' . $enlace . '\')"';
                                    break;
                            }
                        }
                        ?>

                           >
                            <!-- <i class="<?php echo ((isset($item['icon']) && !empty($item['icon'])) ? $item['icon'] : 'dashboard'); ?>"></i> -->
                            <?php
                            if (isset($item['titulo'])) {
                                ?>
                                <?php echo $item['titulo']; ?>
                                <?php
                            }
                            ?>
                        </a>
                        <?php
                        if (isset($item['childs'])) {
                            //pr($item['childs']);
                            echo render_menu($item['childs'], 'menu' . $item['id_menu']);
                        }
                        if ($item['id_menu'] == 'CENSO') {
                            //                        render_elementos_censo($elementos_censo);
                        }
                        ?>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <?php
        $html = ob_get_contents();
        ob_get_clean();
        return $html;
    }

}

if (!function_exists('render_menu')) {

    function render_menu($menu = [], $dropdown = null) {
//        pr($menu);
        $html = '';
        ob_start();
        ?>
        <ul class="nav  <?php echo ($dropdown != null ? 'collapse' : ''); ?>" <?php echo ($dropdown != null ? 'id="' . $dropdown . '" style="margin-left: 1px;"' : ''); ?>>
            <?php
            foreach ($menu as $item) {
//                pr($item);
                $enlace = '#';
                if (isset($item['link'])) {
                    if (startsWith($item['link'], 'http://') || startsWith($item['link'], 'https://')) {
                        $enlace = $item['link'];
                    } else if (empty($item['link'])) {
                        $enlace = '#';
                    } else {
                        $enlace = site_url() . $item['link'];
                    }
                }
                ?>
                <li class="<?php echo (isset($item['childs']) ? '' : '') ?>" style="list-style-type: none;">

                    <a href="<?php echo (isset($item['childs']) || $item['id_menu'] == 'CENSO' ? '#' : $enlace); ?>" <?php echo (isset($item['childs']) || $item['id_menu'] == 'CENSO' ? 'data-toggle="collapse" data-target="#menu' . $item['id_menu'] . '"' : ' id="tablero-menu-item-' . $item['id_menu'] . '" class="tablero-menu-item" '); ?>
                    <?php
                    if (isset($item['configurador'])) {
                        switch ($item['configurador']) {
                            case 'EXTERNO':
                                echo ' target="_blank" ';
                                break;
                            case 'MODAL':
                                echo ' data-toggle="modal" data-target="#my_modal" onclick="modal_menu(\'' . $enlace . '\')"';
                                break;
                            case 'MODAL_GENE':
                                echo ' data-toggle="modal" data-target="#my_modal" onclick="modal_menu(\'' . $enlace . '\')"';
                                break;
                        }
                    }
                    ?>

                       >
                        <i class="<?php echo ((isset($item['icon']) && !empty($item['icon'])) ? $item['icon'] : 'dashboard'); ?>"></i>
                        <?php
                        if (isset($item['titulo'])) {
                            ?>
                            <?php echo $item['titulo']; ?>
                            <?php
                        }
                        ?>
                    </a>
                    <?php
                    if (isset($item['childs'])) {
                        //pr($item['childs']);
                        echo render_menu($item['childs'], 'menu' . $item['id_menu']);
                    }
                    if ($item['id_menu'] == 'CENSO') {
//                        render_elementos_censo($elementos_censo);
                    }
                    ?>
                </li>
        <?php } ?>
        </ul>
        <?php
        $html = ob_get_contents();
        ob_get_clean();
        return $html;
    }

}

if (!function_exists('update_lenguaje')) {

    /**
     *
     * @param type $clave_lenguaje
     */
    function update_lenguaje($clave_lenguaje = 'es') {
        $CI = & get_instance();
        $CI->session->set_userdata(En_datos_sesion::LANGUAGE, $clave_lenguaje);
        update_lenguaje_sistema($clave_lenguaje);
        return TRUE;
    }

}

if (!function_exists('obtener_lenguaje_actual')) {

    /**
     * @author LEAS
     * @fecha 30/04/2018
     * @param type $clave_lenguaje
     */
    function obtener_lenguaje_actual($clave_lenguaje = 'es') {
        $CI = & get_instance();
        if (!is_null($CI->session->userdata(En_datos_sesion::LANGUAGE))) {
            $clave_lenguaje = $CI->session->userdata(En_datos_sesion::LANGUAGE);
        }
        return $clave_lenguaje;
    }

}

if (!function_exists('update_lenguaje_sistema')) {

    /**
     * @author LEAS
     * @fecha 02/05/2018
     * @param type $clave_lenguaje Modifica el lenguaje del sistema, es decir el predeterminado
     *
     */
    function update_lenguaje_sistema($clave_lenguaje = 'es') {
        $lenguaje = ['es' => 'spanish', 'en' => 'english'];
        $CI = & get_instance();
        $CI->config->load('config');
        $CI->config->set_item('language', $lenguaje[$clave_lenguaje]);
    }

}
