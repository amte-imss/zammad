<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Usuario
 *
 * @author chrigarc
 */
class Usuario extends MY_Controller {

    const LIMIT = 10, LISTA = 'lista', BASICOS = 'basico', PASSWORD = 'password',
            NIVELES_ACCESO = 'niveles', NO_SIAP = 'no_siap', SIAP = 'siap', NO_IMSS = 'no_imss',
            STATUS_ACTIVIDAD = 'actividad';

    function __construct() {
        $this->grupo_language_text = ['registro_usuario'];
        parent::__construct();
        $this->load->library('form_complete');
        $this->load->library('seguridad');
        $this->load->library('empleados_siap');
        $this->load->library('form_validation');
        //$this->load->library('en_tpmsg');
        $this->load->model('Usuario_model', 'usuario');
        $this->template->setTitle('Usuarios');
    }

    public function index() {
        redirect('usuario/get_usuarios/');
    }

    public function get_usuarios($usuario = '') {
        $output = [];
        switch ($usuario) {
            case Usuario::LISTA:
                $get = $this->input->get(null, true);
                $this->lista_usuarios($get);
                break;
            case '':
                $output['language_text'] = $this->language_text;
                $view = $this->load->view('usuario/get_usuarios_v2.tpl.php', $output, true);
                $this->template->setMainContent($view);
                $this->template->getTemplate();
                break;
            default:
                //pr($output);
                $this->muestra_usuario($usuario);
                break;
        }
    }

    private function obtener_db_usuario($id_usuario)
    {
        $params['where'] = array(
            'usuarios.id_usuario' => $id_usuario
        );
        /*$params['select'] = array(
            'inf.es_imss',
            'usuarios.id_usuario', 'usuarios.activo usuario_activo',
            'inf.matricula', 'inf.rfc','inf.curp',
            'inf.nombre', 'inf.apellido_paterno', 'inf.apellido_materno', 'sexo',
            'inf.email', 'inf.telefono_personal','inf.telefono_oficina',
            'inf.clave_pais','inf.pais_institucion','inf.institucion',
            'dep.clave_departamental','dep.nombre departamento',
            'uni.clave_unidad','uni.nombre unidad',
            'cat.clave_categoria','cat.nombre categoria'
        );*/
        $params['select'] = array(
            'usuarios.id_usuario', 'usuarios.activo usuario_activo', 'usuarios.username', 'usuarios.email'
        );
        $resultado = $this->usuario->get_usuarios($params);
        //pr($resultado);
        if (count($resultado) == 1) {
            return $resultado[0];
        }

        return array();
    }

    private function muestra_usuario($usuario = 0) {
        $this->load->model('Catalogo_model', 'catalogo');
        $output['language_text'] = $this->language_text;
        $output['usuario'] = $this->obtener_db_usuario($usuario);
        //$output['paises'] = dropdown_options($this->catalogo->get_paises(), "clave_pais", "lang", $this->obtener_idioma());
        $output['datos_basicos'] = $this->load->view('usuario/datos_basicos.tpl.php', $output, true);
        $output['grupos_usuario'] = $this->usuario->get_niveles_acceso($output['usuario']['id_usuario']);
        $output['campo_password'] = $this->load->view('usuario/campo_password.tpl.php', $output, true);
        $output['view_grupos_usuario'] = $this->load->view('usuario/tabla_niveles.tpl.php', $output, true);
        $output['campo_niveles_acceso'] = $this->load->view('usuario/niveles_acceso.tpl.php', $output, true);
        $view = $this->load->view('usuario/usuario.tpl.php', $output, true);
        $this->template->setMainContent($view);
        $this->template->getTemplate();
    }

    private function lista_usuarios(&$params = []) {
        //pr($params);
        $filtros = $this->genera_filtros($params);
        $filtros['limit'] = isset($params['pageSize']) ? $params['pageSize'] : Usuario::LIMIT;
        $filtros['offset'] = isset($params['pageIndex']) ? ($filtros['limit'] * ($params['pageIndex'] - 1)) : 0;
        /*
        $filtros['select'] = array(
            'usuarios.id_usuario', 'coalesce(inf.matricula, usuarios.username) matricula',
            'concat(inf.nombre, $$ $$, inf.apellido_paterno, $$ $$, inf.apellido_materno) nombre',
            'del.nombre delegacion', 'uni.nombre unidad', 'inf.es_imss', 'usuarios.activo',
            '(select array_agg(nombre) from sistema.roles R join sistema.usuario_rol UR on R.clave_rol=UR.clave_rol and UR.id_usuario=usuarios.id_usuario and UR.activo=true) as rol'
        );
        */
        $filtros['select'] = array(
            //'usuarios.id_usuario','usuarios.username', 'concat(inf.nombre, $$ $$, inf.apellido_paterno, $$ $$, inf.apellido_materno) nombre_completo', 'del.nombre delegacion', 'inf.es_imss', 'usuarios.activo','(select array_agg(nombre) from sistema.roles R join sistema.usuario_rol UR on R.clave_rol=UR.clave_rol and UR.id_usuario=usuarios.id_usuario and UR.activo=true) as rol'
            'usuarios.id_usuario','usuarios.username', 'concat(inf.nombre, $$ $$, inf.apellido_paterno, $$ $$, inf.apellido_materno) nombre_completo', 'usuarios.activo','(select array_agg(nombre) from sistema.roles R join sistema.usuario_rol UR on R.clave_rol=UR.clave_rol and UR.id_usuario=usuarios.id_usuario and UR.activo=true) as rol'
        );

        $usuarios['data'] = $this->usuario->get_usuarios($filtros); //exit();
        //pr($usuarios['data']);
        $filtros['total'] = true;
        $total = $this->usuario->get_usuarios($filtros)[0]['total'];
        $usuarios['length'] = $total;

        header('Content-Type: application/json; charset=utf-8;');
        echo json_encode($usuarios);
    }

    private function genera_filtros($params) {
        $filtros = [];
        foreach ($params as $key => $value) {
            if ($value != '') {
                switch ($key) {
                    /*
                    case 'matricula':
                        $filtros['like']['usuarios.username'] = $value;
                        break;
                        */
                    case 'username':
                        $filtros['where']['usuarios.username'] = $value;
                        break;
                    case 'delegacion':
                        $filtros['ilike']['del.nombre'] = $value;
                        break;
                    case 'unidad':
                        $filtros['like']['uni.nombre'] = $value;
                        break;
                    case 'nombre_completo':
                        $filtros['like']['concat(inf.nombre, $$ $$, inf.apellido_paterno, $$ $$, inf.apellido_materno)'] = $value;
                        break;
                    case 'es_imss':
                        $filtros['where']['inf.es_imss'] = $value;
                        break;
                    case 'activo':
                        $filtros['where']['usuarios.activo'] = $value;
                        break;
                    default:
                        # code...
                        break;
                }
            }
        }
        return $filtros;
    }

    public function editar($id_usuario = 0, $tipo = Usuario::BASICOS) {
        $this->load->library('En_tpmsg');
        $salida['tp_msg'] = En_tpmsg::DANGER;
        $output['status'] = false;
        $view = '';
        $post = $this->input->post(null,true);
        //$es_imss = false;
        if($post) {
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            switch ($tipo) {
                case Usuario::BASICOS:
                    $params['where'] = array('usuarios.id_usuario' => $id_usuario);
                    //$params['select'] = array('es_imss');
                    //pr($params);
                    $resultado = $this->usuario->get_usuarios($params);

                    /*$es_imss = $resultado[0]['es_imss'];
                    if($es_imss){*/
                        $validations = $this->config->item('form_actualizar_interno');
                    /*}else{
                        $validations = $this->config->item('form_actualizar_externo');
                    }*/
                    //$view = $this->get_datos_basicos($id_usuario);
                    break;
                case Usuario::PASSWORD:
                    $validations = $this->config->item('form_user_update_password'); //Obtener validaciones de archivo general
                    break;
                case Usuario::NIVELES_ACCESO:
                    $validations = $this->config->item('form_niveles_acceso_usuario');
                    $view = $this->get_niveles($id_usuario);
                    break;
                case Usuario::STATUS_ACTIVIDAD:
                    $validations = $this->config->item('form_status_actividad_usuario');
                    break;
            }
            //pr($validations);
            $this->form_validation->set_rules($validations); //Añadir validaciones
            if ($this->form_validation->run() == TRUE) {
                $params = $this->input->post(null, true);
                /*if($es_imss){
                    unset($params['categoria']);
                    unset($params['unidad']);
                    unset($params['departamento']);
                    unset($params['matricula']);
                    unset($params['curp']);
                    unset($params['rfc']);
                }*/
                $params['id_usuario'] = $id_usuario;
                if($this->usuario->update($tipo, $params)){
                    $salida['tp_msg'] = En_tpmsg::SUCCESS;
                    $salida['status'] = true;
                    $output['status'] = true;
                    $salida['msg'] = 'Se actualizo correctamente';
                }
            } else {
                $output['status'] = false;
                $salida['msg'] = validation_errors();
                
            }
            $output['language_text'] = $this->language_text;
            switch ($tipo) {
                case Usuario::BASICOS:
                    $this->load->model('Catalogo_model', 'catalogo');
                    //$output['paises'] = dropdown_options($this->catalogo->get_paises(), "clave_pais", "lang", $this->obtener_idioma());
                    $output['usuario'] = $this->obtener_db_usuario($id_usuario);
                    $view = $this->load->view('usuario/datos_basicos.tpl.php', $output, true);
                    break;
                case Usuario::PASSWORD:
                    $view = $this->load->view('usuario/campo_password.tpl.php', $output, true);
                    break;
                case Usuario::NIVELES_ACCESO:
                    $view = $this->get_niveles($id_usuario);
                    break;
            }
        }
        $salida['html'] = $view;
        echo json_encode($salida);
    }

    private function get_datos_basicos($id_usuario = 0, &$output = []) {
        $params['where'] = array(
            'usuarios.id_usuario' => $id_usuario
        );
        /*$params['select'] = array(
            'inf.es_imss',
            'usuarios.id_usuario', 'usuarios.activo usuario_activo',
            'inf.matricula', 'inf.rfc','inf.curp',
            'inf.nombre', 'inf.apellido_paterno', 'inf.apellido_materno', 'sexo',
            'inf.email', 'inf.telefono_personal','inf.telefono_oficina',
            'inf.clave_pais','inf.pais_institucion','inf.institucion',
            'dep.clave_departamental','dep.nombre departamento',
            'uni.clave_unidad','uni.nombre unidad',
            'cat.clave_categoria','cat.nombre categoria'
        );*/
        $params['select'] = array(
            //'usuarios.id_usuario', 'usuarios.activo usuario_activo',
            'usuarios.id_usuario','usuarios.username', 'usuarios.username nombre_completo', 'usuarios.activo','(select array_agg(nombre) from sistema.roles R join sistema.usuario_rol UR on R.clave_rol=UR.clave_rol and UR.id_usuario=usuarios.id_usuario and UR.activo=true) as rol'
        );
        $resultado = $this->usuario->get_usuarios($params);
        if (count($resultado) == 1) {
            $output['usuario'] = $resultado[0];
        }
        $output['language_text'] = $this->language_text;
        return $this->load->view('usuario/datos_basicos.tpl.php', $output, true);
    }

    private function get_niveles($id_usuario = 0) {
        $output['grupos_usuario'] = $this->usuario->get_niveles_acceso($id_usuario);
        //pr($output);
        $output['view_grupos_usuario'] = $this->load->view('usuario/tabla_niveles.tpl.php', $output, true);
        return $this->load->view('usuario/niveles_acceso.tpl.php', $output, true);
    }

    public function nuevo($tipo = Usuario::SIAP) {
        if ($this->input->post()) {
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item('form_registro_' . $tipo); //Obtener validaciones de archivo general
            $this->form_validation->set_rules($validations); //Añadir validaciones
            if ($this->form_validation->run() == TRUE) {
                $data = $this->input->post(null, true);
                $data = $this->filtra_datos_form($data);
                $output['post'] = $data;
                $output['registro_valido'] = $this->usuario->nuevo($data, $tipo);
            } else {
                //pr($this->form_validation)
                pr('no valido');
            }
        }
        $this->load->model('Catalogo_model', 'catalogo');
        $this->load->model('Administracion_model', 'administrador');
        $output['tipo_registro'] = $tipo;
        $output['delegaciones'] = dropdown_options($this->catalogo->get_delegaciones(null, array('oficinas_centrales' => true)), 'clave_delegacional', 'nombre');
        $output['nivel_atencion'] = dropdown_options($this->administrador->get_niveles_acceso(), 'id_grupo', 'nombre');
        $main_content = $this->load->view('usuario/nuevo.tpl.php', $output, true);
        $this->template->setMainContent($main_content);
        $this->template->getTemplate();
    }

    private function filtra_datos_form($datos = []) {
        $nuevo = [];
        foreach ($datos as $key => $value) {
            $nueva_llave = $key;
            $nueva_llave = str_replace('1', '', $nueva_llave);
            $nueva_llave = str_replace('2', '', $nueva_llave);
            $nuevo[$nueva_llave] = $value;
        }
        return $nuevo;
    }

    public function carga_usuarios() {
        $view = [];
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
                    $tipo_registro = $this->input->post('tipo_registro', true);
                    $id_usuario = $this->get_datos_sesion('id_usuario');
                    $view['status'] = $this->usuario->carga_masiva($id_usuario, $tipo_registro, $file_data, $csv_array);
                    //pr($view['status']);
                    //$this->reporte_registro($view['status']);
                } else {
                    $view['status']['msg'] = "Formato inválido";
                }
            } else {
                $view['status']['msg'] = "Formato inválido";
            }
        }
        if (isset($view['status']['result']) && $view['status']['result']) {
            redirect('precarga');
        } else {
            // pr($view);
            $main_content = $this->load->view('usuario/formulario_carga_v2.tpl.php', $view, true);
            $this->template->setMainContent($main_content);
            $this->template->getTemplate();
        }
    }

    private function reporte_registro(&$datos) {
        $filename = "Registro_" . date("d-m-Y_H-i-s") . ".xls";
        /* header("Content-Type: application/vnd.ms-excel");
          header("Content-Disposition: attachment; filename=$filename");
          header("Pragma: no-cache");
          header("Expires: 0"); */
        echo $this->load->view('usuario/reporte_registro.tpl.php', $datos, TRUE);
        exit();
    }

}
