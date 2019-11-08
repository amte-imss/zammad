<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of certificado
 *
 * @author JZDP
 */
class Certificado extends MY_Controller {

    function __construct() {
        $this->grupo_language_text = ['registro_usuario'];
        parent::__construct();
        $this->load->library('form_complete');
        $this->load->library('seguridad');
        $this->load->model('Certificado_model', 'certificado');
        $this->template->setTitle('Consulta de certificados. Residencias 2018');
    }

    public function index($folio=null) {
        $form = $this->input->post(null, true); //Limpieza de datos
        if($form) { //Se valida el envío de datos
            if((array_key_exists('folio', $form) && !empty($form['folio']))  || (array_key_exists('curp', $form) && !empty($form['curp'])) || ((array_key_exists('nombre', $form) && !empty($form['nombre'])) && (array_key_exists('apellido_paterno', $form) && !empty($form['apellido_paterno'])))){ //Validar datos mínimos obligatorios
                $this->load->library('form_validation');
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('consulta_'.$form['tipo_busqueda']); //Obtener validaciones de archivo general
                $this->form_validation->set_rules($validations); //Añadir validaciones
                //pr($form);
                /*$_POST['nombre'] = mb_strtoupper($form['nombre'], 'UTF-8'); ///Pasar a mayúsculas el nombre de usuario antes de validar
                $_POST['apellido_paterno'] = mb_strtoupper($form['apellido_paterno'], 'UTF-8');
                $_POST['apellido_materno'] = mb_strtoupper($form['apellido_materno'], 'UTF-8');*/
                //pr($validations);
                if ($this->form_validation->run() == TRUE) {
                    switch ($form['tipo_busqueda']) {
                        case 'folio':
                            $params = array('table'=>'certificado.residencia', 'where'=>"res_folio='".$form['folio']."'");
                            break;
                        case 'curp':
                            $params = array('table'=>'certificado.residencia', 'where'=>"res_curp='".$form['curp']."'");
                            break;
                        case 'nombre':
                            $form = array_map(function($str){ return mb_strtoupper($str); }, $form);
                            //pr($form);
                            $params = array('table'=>'certificado.residencia', 'where'=>"res_nombre='".$form['nombre']."' AND res_apellido_paterno='".$form['apellido_paterno']."' AND res_apellido_materno='".$form['apellido_materno']."'");
                            break;
                        default:
                            $params = array();
                            break;
                    }
                    $datos['datos'] = $this->certificado->get_certificado($params);
                    $output['resultado'] = $this->load->view('certificado/resultado.tpl.php', $datos, true);
                }
                //pr(validation_errors());
            } else {
                $output['msg'] = 'Debe seleccionar el tipo de búsqueda a realizar y llenar la información solicitada.';
            }
            //pr($form);
        }
        $folio = xss_clean($folio); //Limpiar cadena
        if(!is_null($folio) && !empty($folio)){ //Almacenar en arreglo POST valores de búsqueda
            $folio = decrypt_base64(xss_clean($folio));
            $this->load->library('form_validation');
            $this->form_validation->set_data(array('folio'=>$folio));
            $this->form_validation->set_rules('folio', 'Folio', 'required|alpha_dash|min_length[22]|max_length[30]');

            if ($this->form_validation->run() == TRUE) {
                //$form = $this->input->post(null, true); //Limpieza de datos
                $params = array('table'=>'certificado.residencia', 'where'=>"res_folio='".$folio."'");
                $datos['datos'] = $this->certificado->get_certificado($params);
                $output['resultado'] = $this->load->view('certificado/resultado.tpl.php', $datos, true);
            } else {
                //echo "***";
                //pr(validation_errors());
                $output['msg'] = 'Folio incorrecto, favor de verificarlo.';
            }
        }
        $seleccione = array(''=>'Seleccione...');
        $this->load->model('Catalogo_model', 'catalogo');
        $output['language_text'] = $this->language_text;
        //pr($output);
        $view = $this->load->view('certificado/certificado.tpl.php', $output, true);
        $this->template->setMainContent($view);
        $this->template->getTemplate();
    }
}
