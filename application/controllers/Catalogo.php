<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que contiene la gestion de catálogos
 * @version 	: 1.0.0
 * @author      : JZDP & Chekoarcs
 * */
class Catalogo extends MY_Controller {

    const LISTA = 'lista', LIMIT = 25, NUEVA = 'agregar', EDITAR = 'editar',
            CREAR = 'crear', LEER = 'leer', ACTUALIZAR = 'actualizar', ELIMINAR = 'eliminar',
            EXPORTAR = 'exportar', IMPORTAR = 'importar';

    function __construct() {
        parent::__construct();
        $this->load->library('Form_validation');
        $this->load->model('Catalogo_model', 'catalogo');
        $this->load->config('catalogos');
    }

    public function index() {
        redirect(site_url());
    }

    public function categoria($opcion = '') {
        $this->load->model('Catalogo_model', 'catalogo');
        // $this->load->config('catalogos');
        $filtros = $this->config->item('catalogo.categorias');
        $c_query = $this->config->item('catalogo.grupos_categorias');
        $c_query['select'] = array('grupos_categorias.id_grupo_categoria', 'grupos_categorias.nombre grupo_categoria');
        $output = [];
        $output['js'] = '/catalogo/categorias.js';
        $output['exportar'] = site_url('catalogo/categoria/exportar');
        switch ($opcion) {
            case Catalogo::LISTA:
                $params = $this->input->get(null, true);
                $filtros['limit'] = isset($params['pageSize']) ? $params['pageSize'] : Catalogo::LIMIT;
                $filtros['offset'] = isset($params['pageIndex']) ? ($filtros['limit'] * ($params['pageIndex'] - 1)) : 0;
                $filtros['where'] = $this->prepara_filtros($params, array('id_grupo_categoria' => 'categorias.id_grupo_categoria'));
                $filtros['like'] = $this->prepara_filtros($params, array(
                    'clave_categoria' => 'clave_categoria',
                    'categoria' => 'categorias.nombre'
                ));
                $registros['data'] = $this->catalogo->get_registros('catalogo.categorias', $filtros);
                // $registros['query'] = $this->db->last_query();
                $filtros['total'] = true;
                $total = $this->catalogo->get_registros('catalogo.categorias', $filtros)[0]['total'];
                $registros['length'] = $total;
                header('Content-Type: application/json; charset=utf-8;');
                echo json_encode($registros);
                break;
            case Catalogo::NUEVA:
                $post = [];
                $post = $this->input->post(null, true);
                $this->nueva_categoria($post);
                break;
            case Catalogo::EDITAR:
                $post = [];
                $post = $this->input->post(null, true);
                $this->editar_categoria($post);
                break;
            case Catalogo::ELIMINAR:
                $post = $this->input->post(null, true);
                $this->eliminar_categoria($post);
                break;
            case Catalogo::EXPORTAR:
                $file_name = 'catalogo_categorias_' . date('Ymd_his', time());
                $filtros = $this->config->item('catalogo.categorias');
                $registros['data'] = $this->catalogo->get_registros('catalogo.categorias', $filtros);
                $registros['columnas'] = array(
                    'id_categoria', 'categoria', 'id_grupo_categoria',
                    'grupo_categoria', 'clave_categoria',
                );
                $this->exportar_xls($registros['columnas'], $registros['data'], null, null, $file_name);
            default:
                //$grupos_categorias = array('id_grupo_categoria' => '', 'grupo_categoria' => 'Seleccionar');
                $grupos_categorias = $this->catalogo->get_registros('catalogo.grupos_categorias', $c_query);
                array_unshift($grupos_categorias, array('id_grupo_categoria' => '', 'grupo_categoria' => 'Seleccionar'));
                $output['var_js'] = array(
                    array(
                        "name" => 'g_grupos_categorias',
                        'value' => json_encode($grupos_categorias)
                    )
                );
                $output['scripts_adicionales'] = array($this->load->view('tc_template/var_js_view.tpl.php', $output, true));
                $view = $this->load->view('catalogo/grid_general.tpl.php', $output, true);
                $this->template->setMainContent($view);
                $this->template->getTemplate();
                break;
        }
    }

    private function eliminar_categoria(&$params) {
        if ($this->input->post()) {
            $where_ids = array('id_categoria' => $params['id_categoria']);
            $result = $this->catalogo->delete_registros('catalogo.categorias', $where_ids);
            header('Content-Type: application/json; charset=utf-8;');
            echo json_encode($result);
        }
    }

    private function nueva_categoria(&$params) {
        if ($this->input->post()) {
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item('insert_catalogo_categorias'); //Obtener validaciones de archivo general
            $this->form_validation->set_rules($validations); //Añadir validaciones
            if ($this->form_validation->run() == TRUE) {
                $form = array(
                    'nombre' => $params['categoria'],
                    'clave_categoria' => $params['clave_categoria'],
                    'id_grupo_categoria' => $params['id_grupo_categoria']
                );
                $result = $this->catalogo->insert_registro('catalogo.categorias', $form);
            } else {
                $result['success'] = false;
                $result['message'] = validation_errors();
            }
            $result['data'] = $params;
            header('Content-Type: application/json; charset=utf-8;');
            echo json_encode($result);
        }
    }

    private function editar_categoria(&$params) {
        if ($this->input->post()) {
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item('update_catalogo_categorias'); //Obtener validaciones de archivo general
            $this->form_validation->set_rules($validations); //Añadir validaciones
            if ($this->form_validation->run() == TRUE) {
                $form = array(
                    'nombre' => $params['categoria'],
                    'clave_categoria' => $params['clave_categoria'],
                    'id_grupo_categoria' => $params['id_grupo_categoria']
                );
                $ids = array(
                    'id_categoria' => $params['id_categoria']
                );
                $result = $this->catalogo->update_registro('catalogo.categorias', $form, $ids);
            } else {
                $result['success'] = false;
                $result['message'] = validation_errors();
            }
            $result['data'] = $params;
            $result['data']['id_categoria'] = $ids['id_categoria'];
            header('Content-Type: application/json; charset=utf-8;');
            echo json_encode($result);
        }
    }

    /**
     * Función que muestra la vista para cargar csv
     * @author Lima
     * @param  $view['status']['result']== 1 Si Cargo el CSV Redirige a Precarga
     *
     * Inicia Carga Categoría por Lote */
    public function categoria_csv() {
        if ($this->input->post()) {     // SI EXISTE UN ARCHIVO EN POST
            $config['upload_path'] = './uploads/';      // CONFIGURAMOS LA RUTA DE LA CARGA PARA LA LIBRERIA UPLOAD
            $config['allowed_types'] = 'csv';           // CONFIGURAMOS EL TIPO DE ARCHIVO A CARGAR
            $config['max_size'] = '1000';               // CONFIGURAMOS EL PESO DEL ARCHIVO
            $this->load->library('upload', $config);    // CARGAMOS LA LIBRERIA UPLOAD
            $view['status']['result'] = false;
            if ($this->upload->do_upload()) { //Se ejecuta la validación de datos
                $this->load->library('csvimport');
                $file_data = $this->upload->data();     //BUSCAMOS LA INFORMACIÓN DEL ARCHIVO CARGADO
                $file_path = './uploads/' . $file_data['file_name'];         // CARGAMOS LA URL DEL ARCHIVO
                if ($this->csvimport->get_array($file_path)) {              // EJECUTAMOS EL METODO get_array() DE LA LIBRERIA csvimport PARA BUSCAR SI EXISTEN DATOS EN EL ARCHIVO Y VERIFICAR SI ES UN CSV VALIDO
                    $csv_array = $this->csvimport->get_array($file_path);   //SI EXISTEN DATOS, LOS CARGAMOS EN LA VARIABLE $csv_array
                    $view['status'] = $this->catalogo->carga_masiva($csv_array, $file_data);
                    //pr($view['status']);
                    //$this->reporte_registro($view['status']);
                } else {
                    $view['status']['msg'] = "Formato inválido";
                }
            } else {
                $view['status']['msg'] = "Formato inválido";
            }

            if ($view['status']['result'] == 1) {
                redirect('precarga');
            }
        }
        #Muestra Vista del Template Carga CSV
        $main_content = $this->load->view('catalogo/formulario_carga_categorias.tpl.php', array(), true);
        $this->template->setMainContent($main_content);
        $this->template->getTemplate();
    }

    /* Termina Carga Categoría por Lote */

    public function delegacion() {
        try {
            $this->db->schema = 'catalogo';
            //pr($this->db->list_tables()); //Muestra el listado de tablas pertenecientes al esquema seleccionado

            $crud = $this->new_crud();
            $crud->set_table('delegaciones');

            $crud->set_subject('Delegación');
            $crud->display_as('clave_delegacional', 'Clave');
            $crud->display_as('nombre', 'Nombre de la delegación');
            $crud->display_as('id_region', 'Región');
            $crud->display_as('configuraciones', 'Configuraciones');
            $crud->display_as('latitud', 'Latitud');
            $crud->display_as('longitud', 'Longitud');
            $crud->display_as('fecha', 'Fecha');
            $crud->display_as('activo', 'Activo');


            $crud->set_primary_key('id_region', 'regiones'); //Definir llaves primarias, asegurar correcta relación
            $crud->set_primary_key('id_delegacion', 'delegaciones');

            $crud->set_relation('id_region', 'regiones', 'nombre', null, 'nombre'); //Establecer relaciones

            $crud->columns('clave_delegacional', 'nombre', 'id_region', 'latitud', 'longitud', 'fecha', 'activo'); //Definir columnas a mostrar en el listado y su orden
            $crud->add_fields('clave_delegacional', 'nombre', 'id_region', 'latitud', 'longitud', 'configuraciones', 'fecha', 'activo'); //Definir campos que se van a agregar y su orden
            $crud->edit_fields('clave_delegacional', 'nombre', 'id_region', 'latitud', 'longitud', 'configuraciones', 'fecha', 'activo'); //Definir campos que se van a editar y su orden

            $crud->change_field_type('activo', 'true_false', array(0 => 'Inactivo', 1 => 'Activo'));

            $crud->set_rules('nombre', 'Nombre de categoría', 'trim|required');
            $crud->set_rules('fecha', 'Fecha', 'trim|required');
            $crud->set_rules('activo', 'Activo', 'required');

            $crud->unset_delete();
            $output = $crud->render();
            $view['contenido'] = $this->load->view('catalogo/gc_output', $output, true);
            //pr($view['contenido']); exit();
            //$main_content = $this->load->view('admin/admin', $view, true);
            $main_content = $view['contenido'];
            $this->template->setMainContent($main_content);
            $this->template->getTemplate();
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function departamento($opcion = '', $id = null) {
        $this->load->model('Catalogo_model', 'catalogo');
        // $this->load->config('catalogos');
        $filtros = $this->config->item('catalogo.departamentos');
        $output = [];
        $output['js'] = '/catalogo/departamento.js';
        $output['exportar'] = site_url('catalogo/departamento/exportar');
        switch ($opcion) {
            case Catalogo::LISTA:
                $params = $this->input->get(null, true);
                $filtros['limit'] = isset($params['pageSize']) ? $params['pageSize'] : Catalogo::LIMIT;
                $filtros['offset'] = isset($params['pageIndex']) ? ($filtros['limit'] * ($params['pageIndex'] - 1)) : 0;
                $filtros['like'] = $this->prepara_filtros($params, array(
                    'departamento' => 'departamentos.nombre',
                    'clave_departamental' => 'departamentos.clave_departamental',
                    'clave_unidad' => 'departamentos.clave_unidad'
                ));
                // pr($filtros);
                $registros['data'] = $this->catalogo->get_registros('catalogo.departamento departamentos', $filtros);
                // $registros['query'] = $this->db->last_query();
                $filtros['total'] = true;
                $total = $this->catalogo->get_registros('catalogo.departamento departamentos', $filtros)[0]['total'];
                $registros['length'] = $total;
                header('Content-Type: application/json; charset=utf-8;');
                echo json_encode($registros);
                break;
            case Catalogo::NUEVA:
                $post = [];
                $post = $this->input->post(null, true);
                $this->nuevo_departamento($post);
                break;
            case Catalogo::EDITAR:
                $post = [];
                $post = $this->input->post(null, true);
                $this->editar_departamento($post);
                break;
            case Catalogo::ELIMINAR:
                $post = $this->input->post(null, true);
                $this->eliminar_departamento($post);
                break;
            case Catalogo::EXPORTAR:
                $file_name = 'catalogo_adscripciones_' . date('Ymd_his', time());
                $filtros = $this->config->item('catalogo.departamento');
                $registros['data'] = $this->catalogo->get_registros('catalogo.departamento departamentos', $filtros);
                $registros['columnas'] = array(
                    "id_departamento_instituto",
                    "Adscripción",
                    "Clave departamental",
                    "Clave unidad",
                    "Activa"
                );
                $this->exportar_xls($registros['columnas'], $registros['data'], null, null, $file_name);
                break;
            default:
                $view = $this->load->view('catalogo/grid_general.tpl.php', $output, true);
                $this->template->setMainContent($view);
                $this->template->getTemplate();
                break;
        }
    }

    private function eliminar_departamento(&$params) {
        if ($this->input->post()) {
            $where_ids = array('clave_departamental' => $params['clave_departamental']);
            $result = $this->catalogo->delete_registros('catalogo.departamento', $where_ids);
            header('Content-Type: application/json; charset=utf-8;');
            echo json_encode($result);
        }
    }

    private function nuevo_departamento(&$params = []) {
        if ($this->input->post()) {
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item('insert_catalogo_departamento'); //Obtener validaciones de archivo general
            $this->form_validation->set_rules($validations); //Añadir validaciones
            if ($this->form_validation->run() == TRUE) {
                $form = array(
                    'nombre' => $params['departamento'],
                    'clave_unidad' => $params['clave_unidad'],
                    'clave_departamental' => $params['clave_departamental']
                );
                $result = $this->catalogo->insert_registro('catalogo.departamento', $form);
            } else {
                $result['success'] = false;
                $result['message'] = validation_errors();
            }
            $result['data'] = $params;
            header('Content-Type: application/json; charset=utf-8;');
            echo json_encode($result);
        }
    }

    private function editar_departamento($params = []) {
        if ($this->input->post()) {
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item('update_catalogo_departamento'); //Obtener validaciones de archivo general
            $this->form_validation->set_rules($validations); //Añadir validaciones
            $ids = array(
                'clave_departamental' => $params['clave_departamental']
            );
            if ($this->form_validation->run() == TRUE) {
                $form = array(
                    'nombre' => $params['nombre'],
                    'clave_unidad' => $params['clave_unidad'],
                    'clave_departamental' => $params['clave_departamental']
                );
                // $ids = array(
                //     'clave_departamental' => $params['clave_departamental']
                // );
                $result = $this->catalogo->update_registro('catalogo.departamento', $form, $ids);
            } else {
                $result['success'] = false;
                $result['message'] = validation_errors();
            }
            $result['data'] = $params;
            $result['data']['clave_departamental'] = $ids['clave_departamental'];
            header('Content-Type: application/json; charset=utf-8;');
            echo json_encode($result);
        }
    }

    public function grupo_categoria() {
        try {
            $this->db->schema = 'catalogo';
            //pr($this->db->list_tables()); //Muestra el listado de tablas pertenecientes al esquema seleccionado

            $crud = $this->new_crud();
            $crud->set_table('grupos_categorias');

            $crud->set_subject('Grupo categoría');
            $crud->display_as('id_grupo_categoria', 'ID');
            $crud->display_as('clave', 'Clave');
            $crud->display_as('nombre', 'Nombre del grupo-categoría');
            $crud->display_as('descripcion', 'Descripción');

            $crud->set_primary_key('id_grupo_categoria', 'grupos_categorias'); //Definir llaves primarias, asegurar correcta relación

            $crud->columns('id_grupo_categoria', 'clave', 'nombre'); //Definir columnas a mostrar en el listado y su orden
            $crud->add_fields('clave', 'nombre', 'descripcion'); //Definir campos que se van a agregar y su orden
            $crud->edit_fields('clave', 'nombre', 'descripcion'); //Definir campos que se van a editar y su orden

            $crud->set_rules('nombre', 'Nombre del grupo-categoría', 'trim|required');

            $crud->unset_delete();
            $output = $crud->render();

            $view['contenido'] = $this->load->view('catalogo/gc_output', $output, true);
            //pr($view['contenido']); exit();
            // $main_content = $this->load->view('admin/admin', $view, true);
            $main_content = $view['contenido'];
            $this->template->setMainContent($main_content);
            $this->template->getTemplate();
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function region() {
        try {
            $this->db->schema = 'catalogo';
            //pr($this->db->list_tables()); //Muestra el listado de tablas pertenecientes al esquema seleccionado

            $crud = $this->new_crud();
            $crud->set_table('regiones');

            $crud->set_subject('Región');
            $crud->display_as('id_region', 'ID');
            $crud->display_as('clave_regional', 'Clave');
            $crud->display_as('nombre', 'Nombre de la región');
            $crud->display_as('configuraciones', 'Configuraciones');
            $crud->display_as('fecha', 'Fecha');
            $crud->display_as('activo', 'Activo');

            $crud->set_primary_key('id_region', 'regiones'); //Definir llaves primarias, asegurar correcta relación

            $crud->columns('id_region', 'clave_regional', 'nombre', 'fecha', 'activo'); //Definir columnas a mostrar en el listado y su orden
            $crud->add_fields('clave_regional', 'nombre', 'fecha', 'configuraciones', 'activo'); //Definir campos que se van a agregar y su orden
            $crud->edit_fields('clave_regional', 'nombre', 'fecha', 'configuraciones', 'activo'); //Definir campos que se van a editar y su orden

            $crud->change_field_type('activo', 'true_false', array(0 => 'Inactivo', 1 => 'Activo'));

            $crud->set_rules('nombre', 'Nombre de la región', 'trim|required');
            $crud->set_rules('clave_regional', 'Clave', 'trim|required');
            $crud->set_rules('fecha', 'Fecha', 'trim|required');
            $crud->set_rules('activo', 'Activo', 'required');

            $crud->unset_delete();
            $output = $crud->render();

            $view['contenido'] = $this->load->view('catalogo/gc_output', $output, true);
            //pr($view['contenido']); exit();
            // $main_content = $this->load->view('admin/admin', $view, true);
            $main_content = $view['contenido'];
            $this->template->setMainContent($main_content);
            $this->template->getTemplate();
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function tipo_unidad() {
        try {
            $this->db->schema = 'catalogo';
            //pr($this->db->list_tables()); //Muestra el listado de tablas pertenecientes al esquema seleccionado

            $crud = $this->new_crud();
            $crud->set_table('tipos_unidades');

            $crud->set_subject('Tipo de unidad');
            $crud->display_as('id_tipo_unidad', 'ID');
            $crud->display_as('nombre', 'Nombre del tipo de unidad');
            $crud->display_as('clave', 'Clave');
            $crud->display_as('descripcion', 'Descripción');
            $crud->display_as('activa', 'Activo');

            $crud->set_primary_key('id_tipo_unidad', 'tipos_unidades'); //Definir llaves primarias, asegurar correcta relación

            $crud->columns('id_tipo_unidad', 'nombre', 'clave', 'activa'); //Definir columnas a mostrar en el listado y su orden
            $crud->add_fields('clave', 'nombre', 'descripcion', 'activa'); //Definir campos que se van a agregar y su orden
            $crud->edit_fields('clave', 'nombre', 'descripcion', 'activa'); //Definir campos que se van a editar y su orden

            $crud->change_field_type('activa', 'true_false', array(0 => 'Inactivo', 1 => 'Activo'));

            $crud->set_rules('nombre', 'Nombre del tipo de unidad', 'trim|required');
            $crud->set_rules('activa', 'Activo', 'required');

            $crud->unset_delete();
            $output = $crud->render();

            $view['contenido'] = $this->load->view('catalogo/gc_output', $output, true);
            //pr($view['contenido']); exit();
            // $main_content = $this->load->view('admin/admin', $view, true);
            $main_content = $view['contenido'];
            $this->template->setMainContent($main_content);
            $this->template->getTemplate();
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function unidad_instituto($opcion = '', $id = null) {
        $this->load->model('Catalogo_model', 'catalogo');
        // $this->load->config('catalogos');
        $filtros = $this->config->item('catalogo.unidad');
        $output = [];
        $output['js'] = '/catalogo/unidad_instituto.js';
        $output['exportar'] = site_url('catalogo/unidad_instituto/exportar');
        $post = [];
        switch ($opcion) {
            case Catalogo::LISTA:
                $params = $this->input->get(null, true);
                $filtros['limit'] = isset($params['pageSize']) ? $params['pageSize'] : Catalogo::LIMIT;
                $filtros['offset'] = isset($params['pageIndex']) ? ($filtros['limit'] * ($params['pageIndex'] - 1)) : 0;
                $filtros['like'] = $this->prepara_filtros($this->input->get(null, true), array(
                    'unidad' => 'unidades.nombre',
                    'delegacion' => 'delegacion.nombre',
                    'clave_presupuestal' => 'unidades.clave_presupuestal',
                    'clave_unidad' => 'unidades.clave_unidad',
                    'es_umae' => 'unidades.grupo_tipo_unidad',
                        )
                );
                $filtros['where'] = $this->prepara_filtros($this->input->get(null, true), array(
                    'anio' => 'unidades.anio'
                        )
                );
                $registros['data'] = $this->catalogo->get_registros('catalogo.unidad unidades', $filtros);
                // $registros['query'] = $this->db->last_query();
                $filtros['total'] = true;
                $total = $this->catalogo->get_registros('catalogo.unidad unidades', $filtros)[0]['total'];
                $registros['length'] = $total;
                header('Content-Type: application/json; charset=utf-8;');
                echo json_encode($registros);
                break;
            case Catalogo::NUEVA:
                $this->nueva_unidad_instituto($post);
                break;
            case Catalogo::EDITAR:
                $post['id_unidad'] = $id;
                $this->editar_unidad_instituto($post);
                break;
            case Catalogo::EXPORTAR:
                $file_name = 'catalogo_categorias_' . date('Ymd_his', time());
                $filtros = $this->config->item('catalogo.unidad completo');
                $registros['data'] = $this->catalogo->get_registros('catalogo.unidad unidades', $filtros);
                $registros['columnas'] = array(
                    'id_unidad_instituto', 'nombre', 'clave_unidad', 'anio',
                    'nivel_atencion', 'id_tipo_unidad', 'umae', 'clave_presupuestal',
                    'longitud', 'latitud', 'id_region', 'grupo_tipo_unidad', 'activa',
                    'grupo_delegacion', 'direccion_fisica', 'entidad_federativa',
                    'unidad_principal', 'nombre_unidad_principal',
                    'clave_unidad_principal', 'tipo_unidad', 'id_delegacion',
                    'delegacion'
                );
                $this->exportar_xls($registros['columnas'], $registros['data'], null, null, $file_name);
                break;
            default:
                $view = $this->load->view('catalogo/grid_general.tpl.php', $output, true);
                $this->template->setMainContent($view);
                $this->template->getTemplate();
                break;
        }
    }

    private function nueva_unidad_instituto(&$params = []) {
        $this->load->library('form_complete');
        $this->load->library('form_validation');
        $output = [];
        if ($this->input->post()) {
            $post = $this->input->post(null, true);
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item('catalogo_unidades_instituto'); //Obtener validaciones de archivo general
            $this->form_validation->set_rules($validations); //Añadir validaciones
            if ($this->form_validation->run() == TRUE) {
                $post['umae'] = $post['umae'] == 1 ? true : false;
                $post['activa'] = $post['activa'] == 1 ? true : false;
                $post['longitud'] = is_numeric($post['longitud']) ? $post['longitud'] : null;
                $post['latitud'] = is_numeric($post['latitud']) ? $post['latitud'] : null;
                $output['status'] = $this->catalogo->insert_registro('catalogo.unidades_instituto', $post);
            } else {
                pr(validation_errors());
            }
        }
        $filtros = $this->config->item('catalogo.unidades_instituto');
        $tipos_unidades = $this->catalogo->get_registros('catalogo.unidades_instituto unidades', $filtros);
        $filtros = $this->config->item('catalogo.regiones');
        $regiones = $this->catalogo->get_registros('catalogo.regiones', $filtros);

        $output['post']['data'] = $params;
        $output['delegaciones'] = dropdown_options($this->catalogo->get_delegaciones(null, array('oficinas_centrales' => true)), 'clave_delegacional', 'nombre');
        $output['tipos_unidades'] = dropdown_options($tipos_unidades, 'id_tipo_unidad', 'tipo_unidad');
        $output['regiones'] = dropdown_options($regiones, 'id_region', 'region');
        $view = $this->load->view('catalogo/formulario_unidad_instituto.tpl.php', $output, true);
        $this->template->setMainContent($view);
        $this->template->getTemplate();
    }

    private function editar_unidad_instituto(&$params = []) {
        $this->load->library('form_complete');
        $this->load->library('form_validation');
        $output = [];
        $filtros = $this->config->item('catalogo.unidades_instituto');
        $tipos_unidades = $this->catalogo->get_registros('catalogo.unidades_instituto unidades', $filtros);
        if ($this->input->post()) {
            $post = $this->input->post(null, true);
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item('catalogo_unidades_instituto'); //Obtener validaciones de archivo general
            $this->form_validation->set_rules($validations); //Añadir validaciones
            if ($this->form_validation->run() == TRUE) {
                $post['umae'] = $post['umae'] == 1 ? true : false;
                $post['activa'] = $post['activa'] == 1 ? true : false;
                $post['longitud'] = is_numeric($post['longitud']) ? $post['longitud'] : null;
                $post['latitud'] = is_numeric($post['latitud']) ? $post['latitud'] : null;
                $where_ids = array(
                    'id_unidad_instituto' => $params['id_unidad']
                );
                $output['status'] = $this->catalogo->update_registro('catalogo.unidades_instituto', $post, $where_ids);
            } else {
                pr(validation_errors());
            }
        }
        $filtros = $this->config->item('catalogo.regiones');
        $regiones = $this->catalogo->get_registros('catalogo.regiones', $filtros);
        $filtros = $this->config->item('catalogo.unidades_instituto completo');
        $filtros['where'] = array(
            'id_unidad_instituto' => $params['id_unidad']
        );
        $unidad = $this->catalogo->get_registros('catalogo.unidades_instituto unidades', $filtros);
        if (empty($unidad)) {
            redirect('catalogo/unidad_instituto');
        }
        $output['post'] = $unidad[0];
        // pr($output['post']);
        $output['delegaciones'] = dropdown_options($this->catalogo->get_delegaciones(null, array('oficinas_centrales' => true)), 'clave_delegacional', 'nombre');
        $output['tipos_unidades'] = dropdown_options($tipos_unidades, 'id_tipo_unidad', 'tipo_unidad');
        $output['regiones'] = dropdown_options($regiones, 'id_region', 'region');
        $view = $this->load->view('catalogo/formulario_unidad_instituto.tpl.php', $output, true);
        $this->template->setMainContent($view);
        $this->template->getTemplate();
    }

    public function genero() {
        //        try
//        {
        $data_view = array();

        $this->db->schema = 'idiomas';
        $crud = $this->new_crud();
        $crud->set_table('genero');
        $crud->set_subject('genero');
        $crud->set_primary_key('id_genero');

        $crud->columns("id_genero", "nombre", "clave_control_idioma");
        $crud->fields( "nombre", "clave_control_idioma");

        $crud->required_fields("id_genero", "nombre");
        $crud->display_as("id_genero", 'Id genero');
        $crud->display_as('nombre', 'Genero');

        $crud->edit_fields('nombre');
        $crud->add_fields('nombre');
//        $crud->unset_delete();
//        $crud->unset_read();

        $data_view['output'] = $crud->render();
        $data_view['title'] = "Genero";

        $vista = $this->load->view('admin/admin.tpl.php', $data_view, true);
        $this->template->setMainContent($vista);
        $this->template->getTemplate();
//        } catch (Exception $e)
//        {
//            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
//        }
    }

    /**
     * Función que hace la gestion de las categorias
     * con grocery crud
     * @author Cheko
     * @date 28/05/2018
     *
     */
     public function gestion_categorias(){
         $this->db->schema = 'catalogo';
         $crud = $this->new_crud();
         $crud->set_table('categorias');
         $crud->set_subject('categorias');
         $crud->set_primary_key('id_categoria');

         $crud->columns("id_categoria","nombre", "clave_categoria", "activa");
         $crud->change_field_type('id_categoria', 'hidden');
         $crud->add_fields('nombre','clave_categoria','activa');
         $crud->edit_fields('nombre','clave_categoria','activa');
         $crud->field_type('activa','true_false');
         $crud->required_fields("nombre", "activa");

         $data_view['output'] = $crud->render();
         $data_view['title'] = "Categorias";

         $vista = $this->load->view('admin/admin.tpl.php', $data_view, true);
         $this->template->setMainContent($vista);
         $this->template->getTemplate();
     }

     /**
      * Función que hace la gestion de los departamentos
      * con grocery crud
      * @author Cheko
      * @date 28/05/2018
      *
      */
      public function gestion_departamentos(){
          $this->db->schema = 'catalogo';
          $crud = $this->new_crud();
          $crud->set_table('departamento');
          $crud->set_subject('departamento');
          $crud->set_primary_key('clave_departamental');

          $crud->columns("clave_departamental","nombre", "clave_presupuestal","clave_unidad","es_unidad","anio");
          $crud->change_field_type('clave_departamental', 'hidden');
          $crud->add_fields('nombre','clave_presupuestal','clave_unidad',"es_unidad","anio");
          $crud->edit_fields('nombre','clave_presupuestal','clave_unidad',"es_unidad","anio");
          $crud->field_type('es_unidad','true_false');
          $crud->required_fields("clave_departamental", "nombre",'clave_presupuestal','clave_unidad');

          $data_view['output'] = $crud->render();
          $data_view['title'] = "Departamentos";

          $vista = $this->load->view('admin/admin.tpl.php', $data_view, true);
          $this->template->setMainContent($vista);
          $this->template->getTemplate();
      }

      /**
       * Función que hace la gestion de unidades
       * con grocery crud
       * @author Cheko
       * @date 28/05/2018
       *
       */
       public function gestion_unidades(){
           $this->db->schema = 'catalogo';
           $crud = $this->new_crud();
           $crud->set_table('unidad');
           $crud->set_subject('unidad');
           $crud->set_primary_key('clave_unidad');

           $crud->columns('clave_unidad',"nombre",'id_delegacion',"clave_presupuestal", 'nivel_atencion','id_tipo_unidad',
           'es_umae','activo','latitud','longitud','direccion_fisica','entidad_federativa','anio','unidad_principal',
           'nombre_unidad_principal');
           $crud->change_field_type('clave_unidad', 'hidden');
           $crud->add_fields("nombre",'id_delegacion',"clave_presupuestal", 'nivel_atencion','id_tipo_unidad',
           'es_umae','activo','latitud','longitud','direccion_fisica','entidad_federativa','anio','unidad_principal',
           'nombre_unidad_principal');
           $crud->edit_fields("nombre",'id_delegacion',"clave_presupuestal", 'nivel_atencion','id_tipo_unidad',
           'es_umae','activo','latitud','longitud','direccion_fisica','entidad_federativa','anio','unidad_principal',
           'nombre_unidad_principal');
           $crud->field_type('activo','true_false');
           $crud->required_fields('clave_unidad', 'nombre','clave_presupuestal');

           $crud->set_relation('id_delegacion','delegaciones','nombre');
           $crud->set_relation('id_tipo_unidad','tipos_unidades','nombre');

           $data_view['output'] = $crud->render();
           $data_view['title'] = "Unidades";

           $vista = $this->load->view('admin/admin.tpl.php', $data_view, true);
           $this->template->setMainContent($vista);
           $this->template->getTemplate();
       }

       /**
        * Función que hace la gestión de la configuración
        * del trabajo de investigación
        * @author Cheko
        * @date 28/05/2018
        *
        */
        public function gestion_configuracion(){
            $this->db->schema = 'foro';
            $crud = $this->new_crud();
            $crud->set_table('configuracion');
            $crud->set_subject('configuracion');
            $crud->columns("llave","valor");
            $crud->change_field_type('llave', 'hidden');
            $data_view['output'] = $crud->render();
            $data_view['title'] = "Configuracion";

            $vista = $this->load->view('admin/admin.tpl.php', $data_view, true);
            $this->template->setMainContent($vista);
            $this->template->getTemplate();
        }

        /**
         * Función que hace la gestión de la convocatoria
         * del trabajo de investigación
         * @author Cheko
         * @date 28/05/2018
         *
         */
         public function gestion_convocatoria(){
             $this->db->schema = 'foro';
             $crud = $this->new_crud();
             $crud->set_table('convocatoria');
             $crud->set_subject('convocatoria');
             $crud->set_primary_key('id_convocatoria');

             $crud->columns("id_convocatoria","nombre", "anio","activo","registro","revision");
             $crud->change_field_type('id_convocatoria', 'hidden');
             $crud->add_fields('nombre','anio','activo',"registro","revision");
             $crud->edit_fields('nombre','anio','activo',"registro","revision");
             $crud->field_type('activo','true_false');
             $crud->field_type('registro','true_false');
             $crud->field_type('revision','true_false');
             $crud->required_fields('anio');

             $data_view['output'] = $crud->render();
             $data_view['title'] = "Convocatoria";

             $vista = $this->load->view('admin/admin.tpl.php', $data_view, true);
             $this->template->setMainContent($vista);
             $this->template->getTemplate();
         }


         /**
          * Función que hace la gestión del estado
          * del trabajo de investigación
          * @author Cheko
          * @date 28/05/2018
          *
          */
          public function gestion_estado_trabajo(){
              $this->db->schema = 'foro';
              $crud = $this->new_crud();
              $crud->set_table('estado_trabajo');
              $crud->set_subject('estado_trabajo');
              $crud->set_primary_key('clave_estado');

              $crud->columns("clave_estado","lang", "descripcion", "activo");
              $crud->fields('clave_estado','lang','investigador','gestor','revisor','descripcion','activo');
              $crud->change_field_type('lang', 'hidden');
              $crud->change_field_type('clave_estado', 'hidden');
              $crud->field_type('activo','true_false');

              if($crud->getState() == 'edit'){
                  $crud->change_field_type('lang', 'string');
                  $crud->edit_fields("lang","descripcion", "activo");
                  //falta editar los campos con json
                  // $crud->callback_edit_field('investigador',array($this,'_callback_leer_editar_investigador'));
                  // $crud->callback_edit_field('gestor',array($this,'_callback_leer_editar_gestor'));
                  // $crud->callback_edit_field('revisor',array($this,'_callback_leer_editar_revisor'));
                  // $crud->callback_before_update(array($this,'_callback_actualizar_estado_trabajo'));
              }

              if($crud->getState() == 'success' || $crud->getState() == 'list'){
                  $crud->callback_column('lang',array($this,'_callback_cambiar_valores_gestion_trabajo'));
              }

              if($crud->getState() == 'insert'){
                  $crud->required_fields('clave_estado', 'Investigador','Gestor','Revisor');
                  $crud->callback_before_insert(array($this,'_callback_insertar_estado_trabajo'));
              }

              if($crud->getState() == 'read'){
                  $crud->callback_read_field('investigador',array($this,'_callback_leer_investigador'));
                  $crud->callback_read_field('gestor',array($this,'_callback_leer_gestor'));
                  $crud->callback_read_field('revisor',array($this,'_callback_leer_revisor'));
              }



              $data_view['output'] = $crud->render();
              $data_view['title'] = "Estado del trabajo";

              $vista = $this->load->view('admin/admin.tpl.php', $data_view, true);
              $this->template->setMainContent($vista);
              $this->template->getTemplate();
          }


          /**
           * Función que hace la gestión de opciones
           * del trabajo de investigación
           * @author Cheko
           * @date 28/05/2018
           *
           */
           public function gestion_opciones(){
               $this->db->schema = 'foro';
               $crud = $this->new_crud();
               $crud->set_table('opcion');
               $crud->set_subject('opcion');
               $crud->set_primary_key('id_opcion');

               $crud->columns('id_opcion','id_seccion','descripcion','id_rango');
               $crud->change_field_type('id_opcion','hidden');
               $crud->add_fields('id_seccion','descripcion','id_rango');
               $crud->edit_fields('id_seccion','descripcion','id_rango');
               $crud->required_fields('id_seccion','descripcion');
               $crud->set_relation('id_seccion','seccion','descripcion',null,'id_seccion asc');
               $crud->set_relation('id_rango','rango','cualitativa',null,'id_rango asc');

               if($crud->getState() == 'success' || $crud->getState() == 'list'){
                 //$crud->callback_column($this->unique_field_name('id_seccion'),array($this,'_callback_cambiar_id_seccion'));
                 // $crud->callback_column($this->unique_field_name('id_rango'),array($this,'_callback_cambiar_id_rango'));
                 $crud->callback_column('descripcion',array($this,'_callback_cambiar_valores'));
               }

               if($crud->getState() == 'read'){
                  $crud->callback_read_field('descripcion',array($this,'_callback_leer_opciones_descripcion'));
               }

               if($crud->getState() == 'insert'){
                  //faltan los selects que no aparezca el id si no la descripcion
               }

               if($crud->getState() == 'edit'){
                  //faltan editar select y campos json
               }

               $data_view['output'] = $crud->render();
               $data_view['title'] = "Opciones";

               $vista = $this->load->view('admin/admin.tpl.php', $data_view, true);
               $this->template->setMainContent($vista);
               $this->template->getTemplate();
           }

           /**
            * Función que hace la gestión de rangos
            * del trabajo de investigación
            * @author Cheko
            * @date 28/05/2018
            *
            */
            public function gestion_rangos(){
                $this->db->schema = 'foro';
                $crud = $this->new_crud();
                $crud->set_table('rango');
                $crud->set_subject('rango');
                $crud->set_primary_key('id_rango');

                $crud->columns("id_rango", 'cualitativa',"minimo", "maximo");
                $crud->change_field_type('id_rango','hidden');
                $crud->add_fields('cualitativa',"minimo", "maximo");
                $crud->edit_fields('cualitativa',"minimo", "maximo");
                $crud->required_fields('cualitativa');

                if($crud->getState() == 'success' || $crud->getState() == 'list'){
                    $crud->callback_column('cualitativa',array($this,'_callback_cambiar_valores'));
                }

                if($crud->getState() == 'read'){
                    $crud->callback_read_field('cualitativa',array($this,'_callback_leer_rangos_caulitativa'));
                }

                if($crud->getState() == 'insert'){
                    $crud->callback_before_insert(array($this,'_callback_insertar_rango'));
                }

                if($crud->getState() == 'edit'){
                    //falta editar campo json
                }


                $data_view['output'] = $crud->render();
                $data_view['title'] = "Rangos";

                $vista = $this->load->view('admin/admin.tpl.php', $data_view, true);
                $this->template->setMainContent($vista);
                $this->template->getTemplate();
            }


            /**
             * Función que hace la gestión de secciones
             * del trabajo de investigación
             * @author Cheko
             * @date 28/05/2018
             *
             */
             public function gestion_seccion(){
                 $this->db->schema = 'foro';
                 $crud = $this->new_crud();
                 $crud->set_table('seccion');
                 $crud->set_subject('seccion');
                 $crud->set_primary_key('id_seccion');

                 $crud->columns("id_seccion", "descripcion", "id_tipo_metodologia");
                 $crud->change_field_type('id_seccion','hidden');
                 $crud->add_fields("descripcion", "id_tipo_metodologia");
                 $crud->edit_fields("descripcion", "id_tipo_metodologia");
                 $crud->required_fields('descripcion');
                 $crud->set_relation('id_tipo_metodologia','tipo_metodologia','lang',null,'id_tipo_metodologia asc');

                 if($crud->getState() == 'success' || $crud->getState() == 'list'){
                    //$crud->callback_column($this->unique_field_name('id_tipo_metodologia'),array($this,'_callback_cambiar_id_tipo_metodologia'));
                    $crud->callback_column('descripcion',array($this,'_callback_cambiar_valores'));
                 }

                 if($crud->getState() == 'read'){
                     $crud->callback_read_field('descripcion',array($this,'_callback_leer_seccion_descripcion'));
                 }

                 if($crud->getState() == 'edit'){
                     //Falta cambiar el select y el campo de json
                 }

                 if($crud->getState() == 'insert'){
                     $crud->callback_before_insert(array($this,'_callback_insertar_seccion'));
                 }


                 $data_view['output'] = $crud->render();
                 $data_view['title'] = "Secciones";

                 $vista = $this->load->view('admin/admin.tpl.php', $data_view, true);
                 $this->template->setMainContent($vista);
                 $this->template->getTemplate();
             }


             /**
              * Función que hace la gestión de secciones
              * del trabajo de investigación
              * @author Cheko
              * @date 28/05/2018
              *
              */
              public function gestion_tipo_metodologia(){
                  $this->db->schema = 'foro';
                  $crud = $this->new_crud();
                  $crud->set_table('tipo_metodologia');
                  $crud->set_subject('tipo_metodologia');
                  $crud->set_primary_key('id_tipo_metodologia');

                  $crud->columns('id_tipo_metodologia', "activo", "lang");
                  $crud->change_field_type('id_tipo_metodologia','hidden');
                  $crud->add_fields("activo", "lang");
                  $crud->edit_fields("activo", "lang");

                  $crud->field_type('activo','true_false');

                  if($crud->getState() == 'success' || $crud->getState() == 'list'){
                      $crud->callback_column('lang',array($this,'_callback_cambiar_valores'));
                  }

                  if($crud->getState() == 'read'){
                      $crud->callback_read_field('lang',array($this,'_callback_leer_metodologia_lang'));
                  }

                  if($crud->getState() == 'edit'){
                      //Falta cambiar el campo json
                  }

                  if($crud->getState() == 'insert'){
                      $crud->callback_before_insert(array($this,'_callback_insertar_metodologia'));
                  }


                  $data_view['output'] = $crud->render();
                  $data_view['title'] = "Tipos de metodología";

                  $vista = $this->load->view('admin/admin.tpl.php', $data_view, true);
                  $this->template->setMainContent($vista);
                  $this->template->getTemplate();
              }

              /**
               * Función que cambia los valores de las columnas
               * con valores json, dependiendo el lenguaje es, en
               * @author Cheko
               * @date 28/05/2018
               * @param
               */
              public function _callback_cambiar_valores_gestion_trabajo($value, $row)
              {
                  $lenguaje = obtener_lenguaje_actual();
                  $array_php = json_decode($value,true);
                  $investigador = "Investigador: ".$array_php['investigador'][$lenguaje];
                  $gestor = "Gestor: ".$array_php['gestor'][$lenguaje];
                  $revisor = "Revisor: ".$array_php['revisor'][$lenguaje];;
                  return $investigador."\n".$gestor."\n".$revisor;

              }

              /**
               * Función que cambia los valores de las columnas
               * con valores json, dependiendo el lenguaje es, en
               * @author Cheko
               * @date 28/05/2018
               * @param
               */
              public function _callback_cambiar_valores($value, $row)
              {
                  $lenguaje = obtener_lenguaje_actual();
                  $array_php = json_decode($value,true);
                  return $array_php[$lenguaje];
              }

              /**
               * Función que cambia los valores de la columna
               * id seccion de cada renglon de la gestion de opciones
               * @author Cheko
               * @date 29/05/2018
               * @param
               *
               */
               public function _callback_cambiar_id_seccion($value,$row){
                  $lenguaje = obtener_lenguaje_actual();
                  $seccion = $this->catalogo->obtener_seccion($value);
                  if($seccion['success'])
                  {
                      if(count($seccion['result']) > 0)
                      {
                         $array_php = json_decode($seccion['result'][0]['descripcion'],true);
                         return $array_php[$lenguaje];
                      }
                  }
                  return 'NA';
               }

               /**
                * Función que cambia los valores de la columna
                * id rango de cada renglon de la gestion de opciones
                * @author Cheko
                * @date 29/05/2018
                * @param
                *
                */
                public function _callback_cambiar_id_rango($value,$row){
                    $lenguaje = obtener_lenguaje_actual();
                    $rango = $this->catalogo->obtener_rango($value);
                    if($rango['success'])
                    {
                        if(count($rango['result']) > 0)
                        {
                           $array_php = json_decode($rango['result'][0]['cualitativa'],true);
                           return $array_php[$lenguaje];
                        }

                    }
                    return 'NA';
                }

                /**
                 * Función que cambia los valores de la columna
                 * id rango de cada renglon de la gestion de opciones
                 * @author Cheko
                 * @date 29/05/2018
                 * @param
                 *
                 */
                 public function _callback_cambiar_id_tipo_metodologia($value,$row){
                     $lenguaje = obtener_lenguaje_actual();
                     $rango = $this->catalogo->obtener_tipo_metodologia($value);
                     if($rango['success'])
                     {
                         if(count($rango['result']) > 0)
                         {
                            $array_php = json_decode($rango['result'][0]['lang'],true);
                            return $array_php[$lenguaje];
                         }
                     }
                     return 'NA';

                 }

                 /**
                  * Función auxiliar para tener un unico
                  * nombre de un campo
                  * @author Cheko
                  * @date 29/05/2018
                  * @param String $field_name nombre del campo
                  *
                  */
                 public function unique_field_name($field_name) {
                   return 's'.substr(md5($field_name),0,8); //This s is because is better for a string to begin with a letter and not with a number
                 }

                 /**
                  * Función que para manejar el insertar
                  * un estado de trabajo de Grocery CRUD
                  * @author Cheko
                  * @date 29/05/2018
                  * @param array $post_array Arreglo de datos a insertar
                  *
                  */
                 public function _callback_insertar_estado_trabajo($post_array){
                    $lenguaje = obtener_lenguaje_actual();
                    $lang = array('investigador'=>array('es'=>'','en'=>''),'gestor'=>array('es'=>'','en'=>''),'revisor'=>array('es'=>'','en'=>''));
                    $lang['investigador'][$lenguaje] = $post_array['investigador'];
                    $lang['gestor'][$lenguaje] = $post_array['gestor'];
                    $lang['revisor'][$lenguaje] = $post_array['revisor'];
                    $post_array['lang'] = json_encode($lang);
                    unset($post_array['investigador']);
                    unset($post_array['gestor']);
                    unset($post_array['revisor']);

                    return $post_array;
                 }

                 /**
                  * Función que cambia el campo de investigador en
                  * leer un estado del trabajo
                  * @author Cheko
                  * @date 30/05/2018
                  */
                  public function _callback_leer_investigador($value, $primary_key) {
                      $lenguaje = obtener_lenguaje_actual();
                      $estado_trabajo = $this->catalogo->obtener_estado_trabajo($primary_key);
                      if($estado_trabajo['success']){
                          if(count($estado_trabajo['result']) > 0){
                              if(json_decode($estado_trabajo['result'][0]['lang'],true)['investigador'][$lenguaje] != ''){
                                  return json_decode($estado_trabajo['result'][0]['lang'],true)['investigador'][$lenguaje];
                              }
                          }
                      }
                      return 'NA';
                  }

                  /**
                   * Función que cambia el campo de gestor en
                   * leer un estado del trabajo
                   * @author Cheko
                   * @date 30/05/2018
                   */
                   public function _callback_leer_gestor($value, $primary_key) {
                       $lenguaje = obtener_lenguaje_actual();
                       $estado_trabajo = $this->catalogo->obtener_estado_trabajo($primary_key);
                       if($estado_trabajo['success']){
                           if(count($estado_trabajo['result']) > 0){
                                if(json_decode($estado_trabajo['result'][0]['lang'],true)['gestor'][$lenguaje] != ''){
                                    return json_decode($estado_trabajo['result'][0]['lang'],true)['gestor'][$lenguaje];
                                }
                           }
                       }
                       return 'NA';
                   }

                   /**
                    * Función que cambia el campo de revisor en
                    * leer un estado del trabajo
                    * @author Cheko
                    * @date 30/05/2018
                    *
                    */
                    public function _callback_leer_revisor($value, $primary_key) {
                        $lenguaje = obtener_lenguaje_actual();
                        $estado_trabajo = $this->catalogo->obtener_estado_trabajo($primary_key);
                        if($estado_trabajo['success']){
                            if(count($estado_trabajo['result']) > 0){
                                if(json_decode($estado_trabajo['result'][0]['lang'],true)['revisor'][$lenguaje] != ''){
                                    return json_decode($estado_trabajo['result'][0]['lang'],true)['revisor'][$lenguaje];
                                }
                            }
                        }
                        return 'NA';
                    }

                    /**
                     * Función que cambia el campo de descripcion en
                     * leer un opcion del foro
                     * @author Cheko
                     * @date 30/05/2018
                     *
                     */
                     public function _callback_leer_opciones_descripcion($value, $primary_key){
                         $lenguaje = obtener_lenguaje_actual();
                         $opcion = $this->catalogo->obtener_opcion($primary_key);
                         if($opcion['success']){
                             if(count($opcion['result']) > 0){
                                 if(json_decode($opcion['result'][0]['descripcion'],true)[$lenguaje] != ''){
                                     return json_decode($opcion['result'][0]['descripcion'],true)[$lenguaje];
                                 }
                             }
                         }
                         return 'NA';
                     }

                     /**
                      * Función que cambia el campo de cualitativa en
                      * leer un rango del foro
                      * @author Cheko
                      * @date 30/05/2018
                      *
                      */
                      public function  _callback_leer_rangos_caulitativa($value, $primary_key){
                          $lenguaje = obtener_lenguaje_actual();
                          $opcion = $this->catalogo->obtener_rango($primary_key);
                          if($opcion['success']){
                              if(count($opcion['result']) > 0){
                                  if(json_decode($opcion['result'][0]['cualitativa'],true)[$lenguaje] != ''){
                                      return json_decode($opcion['result'][0]['cualitativa'],true)[$lenguaje];
                                  }
                              }
                          }
                          return 'NA';
                      }

                      /**
                       * Función que para manejar el insertar
                       * un rango de Grocery CRUD
                       * @author Cheko
                       * @date 29/05/2018
                       * @param array $post_array Arreglo de datos a insertar
                       *
                       */
                      public function _callback_insertar_rango($post_array){
                         $lenguaje = obtener_lenguaje_actual();
                         $lang = array('es'=>'','en'=>'');
                         $lang[$lenguaje] = $post_array['cualitativa'];
                         $post_array['cualitativa'] = json_encode($lang);
                         return $post_array;
                      }

                      /**
                       * Función que cambia el campo de descripcion en
                       * leer una seccion del foro
                       * @author Cheko
                       * @date 30/05/2018
                       *
                       */
                      public function _callback_leer_seccion_descripcion($value, $primary_key){
                          $lenguaje = obtener_lenguaje_actual();
                          $opcion = $this->catalogo->obtener_seccion($primary_key);
                          if($opcion['success']){
                              if(count($opcion['result']) > 0){
                                  if(json_decode($opcion['result'][0]['descripcion'],true)[$lenguaje] != ''){
                                      return json_decode($opcion['result'][0]['descripcion'],true)[$lenguaje];
                                  }
                              }
                          }
                          return 'NA';
                      }

                      /**
                       * Función que para manejar el insertar
                       * una seccion de Grocery CRUD
                       * @author Cheko
                       * @date 29/05/2018
                       * @param array $post_array Arreglo de datos a insertar
                       *
                       */
                      public function _callback_insertar_seccion($post_array){
                         $lenguaje = obtener_lenguaje_actual();
                         $lang = array('es'=>'','en'=>'');
                         $lang[$lenguaje] = $post_array['descripcion'];
                         $post_array['descripcion'] = json_encode($lang);
                         return $post_array;
                      }

                      /**
                       * Función que cambia el campo de lang en
                       * leer un tipo de metodologia del foro
                       * @author Cheko
                       * @date 30/05/2018
                       *
                       */
                      public function _callback_leer_metodologia_lang($value, $primary_key){
                          $lenguaje = obtener_lenguaje_actual();
                          $opcion = $this->catalogo->obtener_tipo_metodologia($primary_key);
                          if($opcion['success']){
                              if(count($opcion['result']) > 0){
                                  if(json_decode($opcion['result'][0]['lang'],true)[$lenguaje] != ''){
                                      return json_decode($opcion['result'][0]['lang'],true)[$lenguaje];
                                  }
                              }
                          }
                          return 'NA';
                      }

                      /**
                       * Función que para manejar el insertar
                       * un tipo de metodologia de Grocery CRUD
                       * @author Cheko
                       * @date 29/05/2018
                       * @param array $post_array Arreglo de datos a insertar
                       *
                       */
                      public function _callback_insertar_metodologia($post_array){
                         $lenguaje = obtener_lenguaje_actual();
                         $lang = array('es'=>'','en'=>'');
                         $lang[$lenguaje] = $post_array['lang'];
                         $post_array['lang'] = json_encode($lang);
                         return $post_array;
                      }








                    /**
                     * Función que cambia el campo de investigador al
                     * editar un estado del trabajo
                     * @author Cheko
                     * @date 30/05/2018
                     *
                     */
                    public function _callback_leer_editar_investigador($value, $primary_key) {
                        $lenguaje = obtener_lenguaje_actual();
                        $estado_trabajo = $this->catalogo->obtener_estado_trabajo($primary_key);
                        if($estado_trabajo['success']){
                            if(count($estado_trabajo['result']) > 0){
                                if(json_decode($estado_trabajo['result'][0]['lang'],true)['investigador'][$lenguaje] != ''){
                                    return json_decode($estado_trabajo['result'][0]['lang'],true)['investigador'][$lenguaje];
                                }
                            }
                        }
                        return 'NA';
                    }

                    /**
                     * Función que cambia el campo de investigador al
                     * editar un estado del trabajo
                     * @author Cheko
                     * @date 30/05/2018
                     *
                     */
                    public function _callback_leer_editar_gestor($value, $primary_key) {
                        $lenguaje = obtener_lenguaje_actual();
                        $estado_trabajo = $this->catalogo->obtener_estado_trabajo($primary_key);
                        if($estado_trabajo['success']){
                            if(count($estado_trabajo['result']) > 0){
                                if(json_decode($estado_trabajo['result'][0]['lang'],true)['gestor'][$lenguaje] != ''){
                                    return json_decode($estado_trabajo['result'][0]['lang'],true)['gestor'][$lenguaje];
                                }
                            }
                        }
                        return 'NA';
                    }

                    /**
                     * Función que cambia el campo de investigador al
                     * editar un estado del trabajo
                     * @author Cheko
                     * @date 30/05/2018
                     *
                     */
                    public function _callback_leer_editar_revisor($value, $primary_key) {
                        $lenguaje = obtener_lenguaje_actual();
                        $estado_trabajo = $this->catalogo->obtener_estado_trabajo($primary_key);
                        if($estado_trabajo['success']){
                            if(count($estado_trabajo['result']) > 0){
                                if(json_decode($estado_trabajo['result'][0]['lang'],true)['revisor'][$lenguaje] != ''){
                                    return json_decode($estado_trabajo['result'][0]['lang'],true)['revisor'][$lenguaje].$value;
                                }
                            }
                        }
                        return 'NA';
                    }

                    /**
                    * Funcion que filtra los campos para actualizar
                    * los valores de un estado de trabajo del foro
                    * @author Cheko
                    * @date 30/05/2018
                    *
                    */
                    public function _callback_actualizar_estado_trabajo($post_array, $primary_key){
                        $lenguaje = obtener_lenguaje_actual();
                        $lang = array('investigador'=>array('es'=>'','en'=>''),'gestor'=>array('es'=>'','en'=>''),'revisor'=>array('es'=>'','en'=>''));
                        $lang['investigador'][$lenguaje] = $post_array['investigador'];
                        $lang['gestor'][$lenguaje] = $post_array['gestor'];
                        $lang['revisor'][$lenguaje] = $post_array['revisor'];
                        $post_array['lang'] = json_encode($lang);
                        unset($post_array['investigador']);
                        unset($post_array['gestor']);
                        unset($post_array['revisor']);

                        return $post_array;
                    }


}
