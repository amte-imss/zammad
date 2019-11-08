<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que contiene métodos para la carga de la plantilla base del sistema y creación de la paginación
 * @version 	: 1.1.0
 * @author 	: LEAS
 * @property    : mixed[] Data arreglo de datos de plantilla con la siguisnte estructura array("title"=>null,"nav"=>null,"main_title"=>null,"main_content"=>null);
 * */
class Template {

    private $elements;
    private $elements_modal;
    private $datos_imagen_perfil;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->helper('html');
        $this->CI->load->helper('menu_helper');
        $this->new_tpl = FALSE;
        $this->elements = array(
            "title" => null, //Titulo de de la sección
            "menu" => null, //Pinta todo el cuerpo del menú en el template
            "main_title" => null, //Pinta un titulo, el titulo del "main_content", puede o no existir
            "sub_title" => null, //Pinta un subtitulo, el sub_titulo del "main_content", puede o no existir
            "descripcion" => null, //
            "language_text" => null, //
            "main_content" => null, //contenido del template, información relevante de la sección en cuestion
            "css_files" => null, //Carga rutas de archivos css que se llamarán al pintar el formulario de core
            "js_files" => null, //Carga rutas de archivos js que se llmaran al pintar el formulario de core
            "css_script" => null,
            "cuerpo_modal" => null,
            "blank" => null,
            'date_picker' => true,
            'notificaciones_estaticas' => null,
            'lang_system' => null
        );

        $this->elements_modal = array(
            "modal_titulo" => null, //Titulo del modal
            "modal_cuerpo" => null, //Cuerpo del modal, contenido reelevante
            "modal_pie" => null, //Píe del modal, normalmente se usa para disponer de un botón de cerrar y/o botones de guardado u actualización de algun formulario
        );
    }

    /* Retorna el atributo elements
     * @method: array getData()
     * @return: mixed[] Data arreglo de datos de plantilla con la siguiente estructura array("title"=>null,"nav"=>null,"main_title"=>null,"main_content"=>null);
     */

    function getElements() {
        return $this->elements;
    }

    /* regresa en pantalla el contenido de la plantilla
     * @method: array getData()
     * @return: mixed[] Data arreglo de datos de plantilla con la siguisnte estructura array("title"=>null,"nav"=>null,"main_title"=>null,"main_content"=>null);
     */

    function getTemplate($tipo = FALSE, $tpl = 'tc_template/index_login.tpl.php') {
        if (empty($this->elements["menu"])) {//Genera menú vacio
            $menu_data['datos_imagen'] = $this->get_datos_imagen_perfil(); //Agrega datos de la imagen para el menu
            $this->setNav($menu_data);
        }
        if ($tipo) {
            $this->CI->load->view($tpl, $this->elements, TRUE);
        }
        $this->CI->load->view($tpl, $this->elements);
    }

    /**
     * Método que carga datos en la plantilla base del sistema
     * @author 		: Jesús Díaz P.
     * @modified 	: Miguel Guagnelli
     * @access 		: public
     * @method:     : void
     * @param 		: mixed[] $elements Elementos configurables en la plantilla
     */
    public function setTemplate($elements = array()) {
        $this->elements['title'] = (array_key_exists('title', $elements)) ? $elements['title'] : null;
        $this->elements['menu'] = $this->templete_menu(); //(array_key_exists('menu', $elements)) ? $elements['menu'] : null;
        $this->elements['main_title'] = (array_key_exists('main_title', $elements)) ? $elements['main_title'] : null;
        $this->elements['sub_title'] = (array_key_exists('sub_title', $elements)) ? $elements['sub_title'] : null;
        $this->elements['descipcion'] = (array_key_exists('descipcion', $elements)) ? $elements['descipcion'] : null;
        $this->elements['blank'] = (array_key_exists('blank', $elements)) ? $elements['blank'] : null;
        $this->elements['main_content'] = (array_key_exists('main_content', $elements)) ? $elements['main_content'] : null;
        $this->elements['css_files'] = (array_key_exists('css_files', $elements)) ? $elements['css_files'] : null;
        $this->elements['js_files'] = (array_key_exists('js_files', $elements)) ? $elements['js_files'] : null;
        $this->elements['css_script'] = (array_key_exists('css_script', $elements)) ? $elements['css_script'] : null;
        $this->elements['myModal'] = (array_key_exists('myModal', $elements)) ? $elements['myModal'] : null;
    }

    /*
     * Asigna valores a la propiedad Titulo de la plantilla
     * @author  : Miguel Guagnelli
     * @method  : void setTitle($title)
     * @access  : public
     * @param   : string $title Es el título de la pestaña de la plantilla.
     */

    function setTitle($title = null) {
        $this->elements["title"] = $title;
    }

    /**
     * @author LEAS
     * @fecha 27/04/2018
     * @param type $language_text Agrega el catalogo de textos que serán usados 
     */
    function setLanguageText($language_text = null) {
        $this->elements["language_text"] = $language_text;
    }

    /**
     * @author LEAS
     * @fecha 27/04/2018
     * @param type $lang Agrega el lenguaje actual
     */
    function setLang($lang = null) {
        $this->elements["lang_system"] = $lang;
    }

    /*
     * Asigna la propiedad de opciones de menú de la plantilla
     * @author  : CAQZ
     * @method  : void setNav($nav)
     * @access  : public
     * @param   : mixed[] $nav Arreglo compuesto de n elementos con la sig estructura array("link"=>"","titulo"=>"","attribs"=>array())",
     */

    function setNav($menu = NULL) {
        //$vista_menu = $this->CI->load->view('tc_template/menu.tpl.php', $menu, TRUE);
        //$this->elements["menu"] = $vista_menu;
        $this->elements["menu"] = $menu;
    }

    /*
     * Asigna la propiedad de título de la sección en la plantilla
     * @author  : Miguel Guagnelli
     * @method: void setMainTitle($main_title)
     * @param: string $main_title Titulo de la sección en la que se encuentra el usuario
     */

    function setMainTitle($main_title = null) {
        $this->elements["main_title"] = $main_title;
    }

    /*
     * Asigna la propiedad de contenido principal en la plantilla
     * @author  : Miguel Guagnelli
     * @method: void setMainContent($main_content)
     * @param: string $main_content Contenido principal de la plantill
     */

    function setMainContent($main_content = null, $options = null, $isProcesed = true) {
        if ($isProcesed) {
            $this->elements["main_content"] = $main_content;
            return true;
        }

        if (!is_null($main_content)) {
            $this->elements["main_content"] = $this->CI->load->view($main_content, $options, true);
            return true;
        } else {
            return false;
        }
    }

    /*
     * Asigna la propiedad de pie_modal de la sección en la plantilla de modal
     * @author  : LEAS
     * @fecha 15/05/2017
     * @method: void setMainTitle($cuerpo_modal)
     * @param: string $pie código HTML del modal, botones u texto simplemente
     * @Descripcion: Asigana a la variable elements_modal["modal_pie"] texto o código html del modal
     */

    function set_pie_modal($pie = '') {
        $this->elements_modal["modal_pie"] = $pie;
    }

    /*
     * Asigna la propiedad de cuerpo_modal de la sección en la plantilla
     * @author  : LEAS
     * @method: void setMainTitle($cuerpo_modal)
     * @param: String $titulo titulo del modal
     * @descripcion: Asigna un titulo al modal
     */

    function set_titulo_modal($titulo = '') {
        $this->elements_modal["modal_titulo"] = $titulo;
    }

    /*
     * Asigna la propiedad de cuerpo_modal de la sección en la plantilla
     * @author  : LEAS
     * @method: void setMainTitle($cuerpo_modal)
     * @param: string $cuerpo cuerpo del modal HTML
     * @descripcion: Asigna el cuerpo del modal HTML para definir modal
     */

    function set_cuerpo_modal($cuerpo = '') {
        $this->elements_modal["modal_cuerpo"] = $cuerpo;
    }

    /**
     *
     * @author  : LEAS
     * @fecha 15/05/2017
     * @param type $tpl ruta del template modal
     * @descripcion: pinta el esquema Html del modal dividido en las secciones
     * de ttulo, cuerpo y píe
     */
    function get_modal($tpl = 'tc_template/modal/modal_template') {
        $this->CI->load->view($tpl, $this->elements_modal, FALSE);
    }

    private function get_datos_imagen_perfil() {
        return $this->datos_imagen_perfil;
    }

    /**
     *
     * @param type $id_docente
     * @descripcion: Consulta información del docente al modelo "Docente_model"
     * y asigna a la variable "datos_imagen_perfil" en type array las
     * siguiente estructura:
     *  Array
     *  (
     *      [id_file] => 113
     *      [nombre_fisico] => 311091488_1495824833
     *      [ruta] => /assets/us/perfil/311091488/
     *      [extencion] => jpg
     *      [nombre_docente] => DIANNA PATRICIA ANGELES GUALITO
     *      [matricula] => 311091488
     *  )
     */
    function set_datos_imagen_perfil($imagen_perfil) {
        /* Cargar imagen de perfil */
        $this->datos_imagen_perfil = $imagen_perfil; //Obtener imagen del docente
    }

    function enable_date_picker($v = true) {
        $this->elements['date_picker'] = $v;
    }

    function set_notificaciones_estaticas($notificaciones) {
        $this->elements['notificaciones_estaticas'] = $notificaciones;
        // pr($this->elements['notificaciones_estaticas']);
    }

    /**
     * Método que crea links de paginación y mensaje sobre registros mostrados
     * @autor 		: Jesús Díaz P.
     * @modified 	:
     * @access 		: public
     * @param 		: mixed[] $pagination_data Parámetros usados para generar las ligas
     * @return 		: midex[] links -> Ligas para la paginación
     * 						total -> Mensaje sobre registros mostrados
     */
    function pagination_data($pagination_data) {
        $this->CI->load->library(array('pagination', 'table'));
        $config['base_url'] = (array_key_exists('controller', $pagination_data) && array_key_exists('action', $pagination_data)) ? site_url(array($pagination_data['controller'], $pagination_data['action'])) : site_url(array('buscador', 'get_data_ajax')); //Path que se utilizará en la generación de los links
        $config['total_rows'] = $pagination_data['total']; //Número total de registros
        $config['per_page'] = $pagination_data['per_page']; //Sobreescribir número de registros a mostrar
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="disabled"><span><strong>';
        $config['cur_tag_close'] = '</strong></span></li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->CI->pagination->initialize($config);

        return array('links' => "<div class='dataTables_paginate paging_simple_numbers  pull-right'>" . $this->CI->pagination->create_links() . "</div>",
            'total' => "Mostrando " . ($pagination_data['current_row'] + 1) . " a " . ((($pagination_data['current_row'] + $config['per_page']) > $pagination_data['total']) ? $pagination_data['total'] : $pagination_data['current_row'] + $config['per_page']) . " de " . $pagination_data['total']
        );
    }

}
