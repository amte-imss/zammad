<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Usuario
 *
 * @author chrigarc
 */
class Helpdesk extends MY_Controller {
    /*const LIMIT = 10, LISTA = 'lista', BASICOS = 'basico', PASSWORD = 'password',
            NIVELES_ACCESO = 'niveles', NO_SIAP = 'no_siap', SIAP = 'siap', NO_IMSS = 'no_imss',
            STATUS_ACTIVIDAD = 'actividad';*/

    function __construct() {
        $this->grupo_language_text = ['helpdesk'];
        parent::__construct();
        $this->load->library('form_complete');
        $this->load->library('seguridad');
        $this->load->library('empleados_siap');
        $this->load->library('form_validation');
        $this->load->library('en_tipo_asistencia');
        $this->load->library('en_tpmsg');
        $this->load->library('en_sexo');
        $this->load->model('Helpdesk_model', 'helpdesk');
        $this->template->setTitle('Atención al usuario');
    }

    public function index() {
        $seleccione = array(''=>'Seleccione...');
        $this->load->model('Catalogo_model', 'catalogo');
        $output['language_text'] = $this->language_text;
        $output['delegacion'] = $seleccione+dropdown_options($this->helpdesk->get_catalogo(array('table'=>'catalogo.delegaciones','where'=>"clave_delegacional<>'00'")), "clave_delegacional", "nombre");
        $output['division'] = $seleccione+array('DEC'=>'División de Educación Continua', 'DIE'=>'División de Innovación Educativa', 'DPE'=>'División de Programas Educativos');
        $output['tipo_asistencia'] = $seleccione+dropdown_options($this->helpdesk->get_catalogo(array('table'=>'catalogo.tipo_asistencia')), "id_tipo_asistencia", "nombre");
        $view = $this->load->view('helpdesk/helpdesk.tpl.php', $output, true);
        $this->template->setMainTitle($this->language_text['helpdesk']['help_titulo']);
        $this->template->setMainContent($view);
        $this->template->getTemplate();
    }

    public function validar_matricula(){
        $result = array('result'=>false, 'msg'=>'', 'data'=>'');
        if($this->input->is_ajax_request()){ //Validar tipo de petición, solo se aceptan de tipo ajax
            $form = $this->input->post(null, true); //Limpieza de datos
            if($form) { //Se valida el envío de datos
                if(array_key_exists('matricula', $form) && array_key_exists('delegacion', $form)){
                    $usuario = $this->empleados_siap->buscar_usuario_siap($form['delegacion'], $form['matricula']);
                    if($usuario['tp_msg'] == En_tpmsg::SUCCESS){
                        $result['result'] = true;
                    }
                } else {
                    $result['msg'] = 'Valores insuficientes';
                }
            }
        } else {
            $result['msg'] = 'Petición inválida';
        }
        echo json_encode($result);
        exit();
    }

    public function validar_datos(){
        $result = array('result'=>false, 'msg'=>'', 'data'=>'');
        if($this->input->is_ajax_request()){ //Validar tipo de petición, solo se aceptan de tipo ajax
            $form = $this->input->post(null, true); //Limpieza de datos
            //pr($form);
            if($form) { //Se valida el envío de datos
                $this->load->library('form_validation');
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_helpdesk'); //Obtener validaciones de archivo general
                $usuario = $this->empleados_siap->buscar_usuario_siap($form['delegacion'], $form['matricula']); //Verificar datos de usuario
                if($form['tipo_asistencia']==En_tipo_asistencia::EVENTO){
                    array_push($validations, array(
                            'field' => 'fecha',
                            'label' => 'Fecha',
                            'rules' => 'required',
                    ));
                    array_push($validations, array(
                            'field' => 'hora',
                            'label' => 'Hora',
                            'rules' => 'required|trim|exact_length[5]',
                    ));
                    array_push($validations, array(
                            'field' => 'lugar',
                            'label' => 'Lugar',
                            'rules' => 'required|trim|min_length[1]|max_length[400]',
                    ));
                }
                $this->form_validation->set_rules($validations); //Añadir validaciones
                //pr($validations);
                if ($this->form_validation->run() == TRUE && $usuario['tp_msg'] == En_tpmsg::SUCCESS) {
                    $this->load->library('Zammad');
                    $form['siap_nombre'] = $usuario['empleado']['nombre'][0];
                    $form['siap_paterno'] = $usuario['empleado']['paterno'][0];
                    $form['siap_materno'] = $usuario['empleado']['materno'][0];
                    $form['siap_sexo'] = $usuario['empleado']['sexo'][0];
                    $form['siap_curp'] = $usuario['empleado']['curp'][0];
                    $form['siap_rfc'] = $usuario['empleado']['rfc'][0];
                    $form['siap_nacimiento'] = $usuario['empleado']['nacimiento'][0];
                    $form['siap_status'] = $usuario['empleado']['status'][0];
                    $form['siap_delegacion'] = $usuario['empleado']['delegacion'][0];
                    $form['siap_antiguedad'] = $usuario['empleado']['antiguedad'][0];
                    $form['siap_adscripcion'] = $usuario['empleado']['adscripcion'][0];
                    $form['siap_descripcion'] = $usuario['empleado']['descripcion'][0];
                    $form['siap_emp_regims'] = $usuario['empleado']['emp_regims'][0];
                    $form['siap_emp_keypue'] = $usuario['empleado']['emp_keypue'][0];
                    $form['siap_pue_despue'] = $usuario['empleado']['pue_despue'][0];
                    $form['siap_fecha_ingreso'] = $usuario['empleado']['fecha_ingreso'][0];
                    $ticket = $this->zammad->create_ticket($form);
                    /*switch ($form['tipo_busqueda']) {
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
                    $output['resultado'] = $this->load->view('certificado/resultado.tpl.php', $datos, true);*/
                    pr($ticket);
                    $result['result'] = true;
                } else {
                    $result['msg'] = validation_errors();
                }
                /*if(array_key_exists('matricula', $form) && array_key_exists('delegacion', $form)){
                    $usuario = $this->empleados_siap->buscar_usuario_siap($form['delegacion'], $form['matricula']);
                    if($usuario['tp_msg'] == En_tpmsg::SUCCESS){
                        $result['result'] = true;
                        //$result['data'] = $usuario['empleado'];
                    }
                } else {
                    $result['msg'] = 'Valores insuficientes';
                }*/
            }
        } else {
            $result['msg'] = 'Petición inválida';
        }
        echo json_encode($result);
        exit();
    }
}
