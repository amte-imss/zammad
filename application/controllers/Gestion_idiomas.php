<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que contiene la gestion de catálogos
 * @version 	: 1.0.0
 * @author      : JZDP AND LEAS
 * */
class Gestion_idiomas extends MY_Controller {

    const LISTA = 'lista', NUEVA = 'agregar', EDITAR = 'editar',
            CREAR = 'crear', LEER = 'leer', ACTUALIZAR = 'actualizar', ELIMINAR = 'eliminar',
            EXPORTAR = 'exportar';

    function __construct() {
        $this->grupo_language_text = ['generales','cat_paises']; //Grupo de idiomas para el controlador actual
        parent::__construct();
    }

    function idiomas() {
        //        try
//        {
        $data_view = array();

        $this->db->schema = 'idiomas';
        $crud = $this->new_crud();
        $crud->set_table('idioma');
        $crud->set_subject('Idiomas');
        $crud->set_primary_key('clave_idioma');

        $crud->columns("clave_idioma", "nombre", "activo", "orden", "clave_control_idioma");
        $crud->fields("clave_idioma", "nombre", "activo", "orden", "clave_control_idioma");

        $crud->required_fields("clave_idioma", "nombre");
        $crud->display_as("clave_idioma", 'Clave de idioma');
        $crud->display_as('nombre', 'Nombre del idioma');
        $crud->display_as('activo', 'Activo');
        $crud->display_as('orden', 'Orden de presentación');

        $crud->change_field_type('activo', 'true_false', array(0 => 'No', 1 => 'Si'));

        $crud->edit_fields('nombre', 'activo', 'orden');
        $crud->add_fields('clave_idioma', 'nombre', 'activo', 'orden');

        $data_view['output'] = $crud->render();
        $data_view['title'] = "Idiomas";

        $vista = $this->load->view('admin/admin.tpl.php', $data_view, true);
        $this->template->setMainContent($vista);
        $this->template->getTemplate();
//        } catch (Exception $e)
//        {
//            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
//        }
    }

    function paises() {
        $data_view = array();
        $this->db->schema = 'catalogo';
        $crud = $this->new_crud();
        $crud->set_table('pais');
        $crud->set_subject("Países");
        $crud->set_primary_key('clave_pais');

        $crud->columns("clave_pais", "lang");
        $crud->fields("clave_pais", "lang");

        $crud->required_fields("clave_pais", "lang");
        $crud->display_as("clave_pais", 'Clave del país');
        $crud->display_as('lang', 'Nombre del país');

        $crud->edit_fields('lang', 'descripcion');
        $crud->add_fields('clave_pais', 'lang');

        $data_view['output'] = $crud->render();
//        $data_view['title'] = $this->language_text['cat_paises']['titulo'];
        $data_view['title'] = "Países";

        $vista = $this->load->view('admin/admin.tpl.php', $data_view, true);
        $this->template->setMainContent($vista);
        $this->template->getTemplate();
    }

    function tipo_etiquetas() {
        $data_view = array();

        $this->db->schema = 'idiomas';
        $crud = $this->new_crud();
        $crud->set_table('tipo');
        $crud->set_subject('Tipo de etiquetas');
        $crud->set_primary_key('clave_tipo');

        $crud->columns("clave_tipo", "nombre", "descripcion");
        $crud->fields("clave_tipo", "nombre", "descripcion");

        $crud->required_fields("clave_tipo", "nombre");
        $crud->display_as("clave_tipo", 'Clave del tipo etiqueta');
        $crud->display_as('nombre', 'Nombre del tipo etiqueta');
        $crud->display_as('descripcion', 'Descripción');

        $crud->edit_fields('nombre', 'descripcion');
        $crud->add_fields('clave_tipo', 'nombre', 'descripcion');

        $data_view['output'] = $crud->render();
        $data_view['title'] = "Tipo de etiquetas";

        $vista = $this->load->view('admin/admin.tpl.php', $data_view, true);
        $this->template->setMainContent($vista);
        $this->template->getTemplate();
//
    }

    /**
     * @author LEAS
     * @Fecha 26/04/2018
     * @param type $idioma
     * @description Modifica el idioma actual de la aplicación
     *
     */
    function modifica_idioma($idioma = "es") {
        $update = update_lenguaje($idioma);
        if ($update) {
            $id_user = $this->get_datos_sesion(En_datos_sesion::ID_USUARIO);
            $this->session->set_flashdata('limpiar_post_update_lenguaje', true);
            $this->load->model('Idioma_model', 'idioma');
            $correct = $this->idioma->insert_user_idioma($id_user, $idioma);
            $result = ['success' => $correct];
        } else {
            $result = ['success' => FALSE];
        }
        header('Content-Type: application/json; charset=utf-8;');
        echo json_encode($result);
    }

    /**
     * Función que hace la gestion de tipos
     * con grocery crud
     * @author Cheko
     * @date 28/05/2018
     *
     */
     function gestion_tipos(){
         $this->db->schema = 'idiomas';
         $crud = $this->new_crud();
         $crud->set_table('tipo');
         $crud->set_subject('tipo');
         $crud->set_primary_key('clave_tipo');

         $crud->columns("clave_tipo","nombre", "descripcion");
         $crud->required_fields('clave_tipo', 'nombre');

         $data_view['output'] = $crud->render();
         $data_view['title'] = "Tipo";

         $vista = $this->load->view('admin/admin.tpl.php', $data_view, true);
         $this->template->setMainContent($vista);
         $this->template->getTemplate();
     }
}
