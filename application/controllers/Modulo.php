<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Modulo
 *
 * @author chrigarc
 */
class Modulo extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_complete');
        $this->load->model('Modulo_model', 'modulo');
        $this->load->helper('modulo_helper');
        $this->template->setTitle('Módulos');
    }

    public function index($full_view = 1, $modulo = null)
    {
        $output['full_view'] = $full_view;
        $output['modulos'] = $this->modulo->get_modulos(array(), true, $this->obtener_idioma());

        switch ($full_view)
        {
            case 1:
                $view = $this->load->view('modulo/index', $output, true);
                $this->template->setMainContent($view);
                $this->template->getTemplate();
                break;
            case 2:
                $output['configuradores'] = dropdown_options($this->modulo->get_configuradores(), 'id_configurador', 'nombre');
                $output['form_url'] = 'modulo/new_modulo/';
                if ($modulo != null)
                {
                    $output['form_url'] = 'modulo/get_modulo/' . $modulo;
                }
                $output['modulos_dropdown'] = dropdown_options($this->modulo->get_modulos(array(), false), 'id_modulo', 'nombre');
                $modal = $this->load->view('modulo/modal_custom_modulo', $output, true);
                $this->template->set_cuerpo_modal($modal);
                $this->template->get_modal();
                break;
            case 3:
                $this->load->model('Administracion_model', 'administracion');
                $output['grupos_usuario'] = $this->modulo->get_niveles_acceso($modulo);
                $output['id_modulo'] = $modulo;
                $modal = $this->load->view('modulo/niveles_acceso', $output, true);
                $this->template->set_titulo_modal('Niveles de acceso');
                $this->template->set_cuerpo_modal($modal);
                $this->template->get_modal();
                break;
            case 4:
                $output['id_modulo'] = $modulo;
                $output['usuarios'] = [];
                $output['usuarios']['tabla'] = $this->modulo->get_usuarios($modulo);
                $output['tipos'] = array(1 => 'Agregar permiso', 2 => 'Quitar permiso');
                $output['tabla'] = $this->load->view('modulo/tabla_usuarios', $output, true);
                $modal = $this->load->view('modulo/usuarios', $output, true);
                $this->template->set_titulo_modal('Usuarios');
                $this->template->set_cuerpo_modal($modal);
                $this->template->get_modal();
                break;
            default:
                $this->load->view('modulo/index', $output);
                break;
        }
    }

    public function usuario()
    {
        $salida['tp_msg'] = false;
        if ($this->input->is_ajax_request() && $this->input->post('modulo'))
        {
            if ($this->input->post('matricula'))
            {
                $matricula = $this->input->post('matricula', true);
                $this->load->model('Usuario_model', 'usuario');
                $params = array(
                    'where' => array('matricula' => $matricula)
                );
                $busqueda = $this->usuario->get_usuarios($params);
                if (count($busqueda) == 1)
                {
                    $id_usuario = $busqueda[0]['id_usuario'];
                }
            } else
            {
                $id_usuario = $this->input->post('usuario', true);
            }
            $salida['tp_msg'] = $this->modulo->upsert_usuario($id_usuario, $this->input->post(null, true));
        }
        echo json_encode($salida);
    }

    public function niveles_acceso()
    {
        if ($this->input->is_ajax_request() && $this->input->post('modulo'))
        {
            $this->load->model('Administracion_model', 'administracion');
            $niveles_acceso = $this->administracion->get_niveles_acceso();
            $salida['tp_msg'] = $this->modulo->upsert_niveles_acceso($niveles_acceso, $this->input->post(null, true));
            echo json_encode($salida);
        }
    }

    public function get_modulo($id_modulo = '')
    {
        if ($this->input->post())
        {
            $datos['nombre'] = $this->input->post('modulo', true);
            $datos['url'] = $this->input->post('url', true);
            $datos['tipo'] = $this->input->post('tipo', true);
            $datos['padre'] = $this->input->post('padre', true);
            $datos['orden'] = $this->input->post('orden', true);
            $datos['icono'] = $this->input->post('icono', true);
            $salida['tp_msg'] = $this->modulo->update($id_modulo, $datos);
        }
        $filtros = array('where' => array('clave_modulo'=>$id_modulo));
        $modulos = $this->modulo->get_modulos($filtros, false);
        $salida['modulo'] =$modulos[0];
        echo json_encode($salida);
    }

    public function new_modulo()
    {
        if ($this->input->post())
        {
            $datos['nombre'] = $this->input->post('modulo', true);
            $datos['url'] = $this->input->post('url', true);
            $datos['tipo'] = $this->input->post('tipo', true);
            $datos['padre'] = (empty($this->input->post('padre', true)) ? null : $this->input->post('padre', true));
            $datos['orden'] = $this->input->post('orden', true);
            $datos['visible'] = ($this->input->post('visible', true) != null ? true : FALSE);
            $datos['icono'] = $this->input->post('icono', true);
            $salida['tp_msg'] = $this->modulo->insert($datos);
        }
    }

}
