<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que contiene la gestion de catálogos
 * @version 	: 1.0.0
 * @author      : JZDP AND LEAS
 * */
class Idiomas extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('grocery_CRUD');
        $this->load->library('form_complete');
        $this->load->library('seguridad');
        $this->load->library('form_validation');
        $this->load->model('Idioma_model', 'idioma');
        $this->template->setTitle('Usuarios');
    }

   /**
     * @author LIMA
     * @fecha 27/04/2018
     * @param  $cve_grupo_etiqueta
     * @return VOID
     * Controla los Datos del Grid y de la Busqueda que Hace por Filtros
     */
 public function obtener_grupo_etiquetas()
    {
      try {
            $this->db->schema = 'idiomas';
            $crud = $this->new_crud();
            $crud->set_table('grupo');
            $crud->set_subject('grupo');
            $crud->set_primary_key('clave_grupo');
            $crud->columns('clave_grupo','nombre','descripcion');
            $crud->fields('clave_grupo','nombre','descripcion');
            $crud->required_fields('clave_grupo','nombre');
            $crud->add_action('Agregar', '', '', 'ui-icon-add', array($this, 'elemento_link'));
            $crud->unset_read();
            $crud->unset_delete();
            $crud->unset_export();
            $output = $crud->render();
            $main_content = $this->load->view('idioma/gc_traduccion.tpl.php', $output, true);
            $this->template->setMainContent($main_content);
            $this->template->getTemplate();

          } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

   public function elemento_link($value, $row)
    {
       return site_url('idiomas/obtener_grupo_traduccion/'.$row->clave_grupo);
    }

   /**
     * @author LIMA
     * @fecha 27/04/2018
     * @param  $cve_grupo_etiqueta, $tipo
     * @return Vista
     * Controla Busqueda por Filtros
     */
    public function obtener_grupo_traduccion($clave_grupo)
    {
        try {
            $this->db->schema = 'idiomas';
            $crud = $this->new_crud();
            $crud->set_table('traduccion');
            $crud->where('clave_grupo',$clave_grupo);
            $crud->set_subject('traduccion');
            $crud->set_primary_key('clave_traduccion');
            $crud->columns('clave_grupo','clave_traduccion','clave_tipo', 'lang');
            $crud->fields('clave_grupo','clave_traduccion','clave_tipo','lang');
            $crud->required_fields('clave_grupo','clave_traduccion','clave_tipo','lang');
            $crud->display_as('clave_grupo','Clave Grupo');
            $opciones_clave_grupo = $this->idioma->obtener_claves_grupos();
            $crud->field_type('clave_grupo','dropdown',$opciones_clave_grupo);
            $crud->display_as('clave_tipo','Tipo de Componenete');
            $opciones_tipo_componente = $this->idioma->obtener_tipo_componente();
            $crud->field_type('clave_tipo','dropdown',$opciones_tipo_componente);
            $crud->unset_texteditor('lang', 'full_text');
            $crud->unset_read();
            $crud->unset_export();
            $output = $crud->render();
            $main_content = $this->load->view('idioma/gc_traduccion.tpl.php', $output, true);
            $this->template->setMainContent($main_content);
            $this->template->getTemplate();
          } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
      }
}
