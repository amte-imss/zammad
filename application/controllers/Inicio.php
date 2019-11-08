<?php

/*
 * Cuando escribí esto sólo Dios y yo sabíamos lo que hace.
 * Ahora, sólo Dios sabe.
 * Lo siento.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Inicio
 *
 * @author chrigarc
 */
class Inicio extends MY_Controller {

    const INTERNOS = 'internos', EXTERNOS = 'externos', REGISTRO_USUARIO = "registro_usuario";

    public function __construct() {
        //$this->grupo_language_text = ['registro_usuario', 'inicio_sesion', 'mensajes', "listado_trabajo", "dashboard", "jsgrid_elementos"]; //Grupo de idiomas para el controlador actual
        $this->grupo_language_text = ['registro_usuario', 'inicio_sesion', 'mensajes']; //Grupo de idiomas para el controlador actual
        parent::__construct();
        $this->load->library('form_complete');
        $this->load->library('form_validation');
        $this->load->library('seguridad');
        $this->load->library('empleados_siap');
        $this->load->library('LNiveles_acceso');
        $this->load->helper(array('secureimage'));
        $this->load->model('Sesion_model', 'sesion');
        $this->load->model('Usuario_model', 'usuario');
    }

    public function index() {
        //$this->language_text += $this->obtener_grupos_texto(array('template_general'), $this->obtener_idioma()); //textos del formulario
        $data['language_text'] = $this->language_text; //Asigna textos de lenguaje para el template de login
        $inicio_reg = $this->session->flashdata('inicio_registro');
        if (!is_null($inicio_reg)) {
            $post["usuario"] = $inicio_reg['username'];
            $post["password"] = $inicio_reg['password'];
            $post["captcha"] = $this->session->userdata('captchaWord');
            $this->session->set_flashdata('inicio_registro', null);
        } else {

            $post = $this->input->post(null, true);
        }
        ////        $data_post = $this->input->post();
        if ($post) {

            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item('login'); //Obtener validaciones de archivo general
            $this->form_validation->set_data($post);
            //$this->set_textos_campos_validacion($validations, $data['language_text']['inicio_sesion']);
            $this->form_validation->set_rules($validations);
            if ($this->form_validation->run() == TRUE) {
                $valido = $this->sesion->validar_usuario($post["usuario"], $post["password"]);
                //$mensajes = $this->lang->line('mensajes');
                switch ($valido) {
                    case 1:
                        //redirect to home //load menu...etc etc
                        /*$params = array(
                            'where' => array('usuarios.username' => $post['usuario'], 'usuarios.email' => $post["usuario"]),
                            'where_funcion' => array('usuarios.username' => "where", 'usuarios.email' => "or_where"),
                            'select' => array("case when usuarios.username is null then usuarios.email else usuarios.username end username",
                                "usuarios.email", "inf.es_imss",
                                "usuarios.id_usuario", "coalesce(inf.matricula, usuarios.username) matricula",
                                "usuarios.clave_idioma lenguaje",
                                "inf.id_informacion_usuario", "inf.nombre", "inf.apellido_paterno", "inf.apellido_materno","inf.institucion",
                                "inf.clave_pais", "inf.sexo","inf.pais_institucion","inf.telefono_personal", "inf.telefono_oficina",
                                "uni.clave_unidad", "uni.nombre unidad", "inf.fecha_nacimiento",
                                "dep.clave_departamental", "dep.nombre departamento",
                                "cat.clave_categoria", "cat.id_categoria", "cat.nombre categoria",
                                "inf.curp", "inf.rfc"
                                , "inf.email", "inf.clave_delegacional", "del.nombre delegacion"
                            )
                        );*/
                        $params = array(
                            'where' => array('usuarios.username' => $post['usuario'], 'usuarios.email' => $post["usuario"]),
                            'where_funcion' => array('usuarios.username' => "where", 'usuarios.email' => "or_where"),
                            'select' => array("case when usuarios.username is null then usuarios.email else usuarios.username end username",
                                "usuarios.email", "usuarios.id_usuario", "usuarios.username matricula",
                                "usuarios.clave_idioma lenguaje"
                            )
                        );
                        $foro_educacion['usuario'] = $this->usuario->get_usuarios($params)[0];
                        $foro_educacion['usuario']['niveles_acceso'] = $this->sesion->get_niveles_acceso($foro_educacion['usuario']['id_usuario']);
                        update_lenguaje($foro_educacion['usuario']['lenguaje']);
                        $this->session->set_userdata(En_datos_sesion::__INSTANCIA, $foro_educacion);
//                        $this->redireccion_inicio($foro_educacion);
                        break;
                    case 2:
                        $data['errores'] = $data['language_text']['mensajes']['msg_contrasenia_incorrecta'];
                        //$this->session->set_flashdata('flash_password', $mensajes[$valido]);
                        break;
                    case 3:
                        $data['errores'] = $data['language_text']['mensajes']['msg_usuario_no_existe'];
                        //$this->session->set_flashdata('flash_usuario', $mensajes[$valido]);
                        break;
                    default :
                        break;
                }
            } else {
//                pr(validation_errors());
                //$data['errores'] = validation_errors();
            }
        }

        $foro_educacion = $this->session->userdata(En_datos_sesion::__INSTANCIA);
        if (isset($foro_educacion['usuario']['id_usuario'])) {
            $this->redireccion_inicio($foro_educacion);
        } else {//De inicio aquí es donde entra
            $this->load->model('Catalogo_model', 'catalogo');

            $this->template->setTitle('Buscador de usuarios');
            //$this->template->setNav($this->load->view('tc_template/menu.tpl.php', null, TRUE));
            $main_content = $this->load->view('sesion/login_modal.tpl.php', $data, true);
            $this->template->setMainContent($main_content);
            $this->template->getTemplate(true, 'tc_template/index_login.tpl.php');
        }
    }

    /*public function ver_creditos() {
        $output = [];
        $output['language_text'] = $this->language_text; //Asigna textos de lenguaje para el template de login
        $main_content = $this->load->view('creditos.php', $output, TRUE);
        $this->template->setMainContent($main_content);
        $this->template->getTemplate();
    }*/

    private function redireccion_inicio(&$foro_educacion) {
        $redirect = array(LNiveles_acceso::Investigador => '/registro_investigacion/index',
            LNiveles_acceso::Revisor => '/revision/trabajos_investigacion_evaluacion',
            'default' => 'inicio/inicio',
        );
        ///Redirección de investigador
        if (isset($foro_educacion['usuario']['niveles_acceso'][0]['clave_rol'])) {
            $rol = $foro_educacion['usuario']['niveles_acceso'][0]['clave_rol'];
            if (isset($redirect[$rol])) {
                redirect(site_url($redirect[$rol])); //Redirección de moderador
            } else {
                redirect(site_url($redirect['default'])); //Redirección de moderador
            }
        } else {
            redirect(site_url($redirect['default'])); //Redirección de moderador
        }
    }

    /*public function registro_usuario() {
        $foro_educacion = $this->session->userdata(En_datos_sesion::__INSTANCIA);
        if (isset($foro_educacion['usuario']['id_usuario'])) {
            redirect(site_url('inicio/inicio'));
        } else {//De inicio aquí es donde entra
            $data['language_text'] = $this->language_text; //Asigna textos de lenguaje para el template de login

            $this->load->model('Catalogo_model', 'catalogo');
            $data['delegaciones'] = dropdown_options($this->catalogo->get_delegaciones(null, array('oficinas_centrales' => true)), 'clave_delegacional', 'nombre');
            $data['paises'] = dropdown_options($this->catalogo->get_paises(), "clave_pais", "lang", $this->obtener_idioma()); //Obtiene el idioma
            $data['tipo_registro'] = Inicio::EXTERNOS;
            $data['registro_externos'] = $this->load->view("sesion/registro_externos.php", $data, TRUE);
            $data['tipo_registro'] = Inicio::INTERNOS;
            $data['registro_internos'] = $this->load->view("sesion/registro_internos.php", $data, TRUE);
            $main_content = $this->load->view("sesion/registro_modal.tpl.php", $data, TRUE);

            $this->template->setTitle('XV Foro Nacional y I Foro Internacional de Educación en Salud');
            $this->template->setMainContent($main_content);
            $this->template->getTemplate(true, 'tc_template/index_login.tpl.php');
        }
    }*/

    /**
     * @author LEAS
     * @fecha 08/05/2018
     */
    public function inicio() {
        $output = [];
        $datos_sesion = $this->get_datos_sesion();
        //$id_informacion_usuario = $datos_sesion['id_informacion_usuario'];

        $lang = $this->obtener_idioma();
        $output['language_text'] = $this->language_text; //obtiene textos del lenguaje
//        $output['listado'] = $this->trabajo->listado_trabajos_autor($id_informacion_usuario, $lang);
        $output['lang'] = $this->obtener_idioma();
//        pr($this->language_text);
        $main_content = $this->load->view('dashboard/index.tpl.php', $output, true);
        $this->template->setMainContent($main_content);
        $this->template->getTemplate();
    }

    /**
     * @author LEAS
     * @fecha 08/05/2018
     */
    /*function informacion($tipo = 'lista') {
        $this->load->model('Trabajo_model', 'trabajo');
        $lang = $this->obtener_idioma();
        $listado = $this->trabajo->listado_trabajos_autor_general();
        foreach ($listado as $key => $value) {
            $json = json_decode($value['estado'], true);
            $value['estado'] = $json['investigador'][$lang];
            $listado[$key] = $value;
        }
//        pr($output['data']);
        $output['data'] = $listado;
        header('Content-Type: application/json; charset=utf-8;');
        echo json_encode($output);
    }*/

//    public function inicio() {
//        $foro_educacion = $this->session->userdata(En_datos_sesion::__INSTANCIA);
//        //pr($foro_educacion);exit();
//        if (isset($foro_educacion['usuario']['niveles_acceso']['0']['clave_rol']) && $foro_educacion['usuario']['niveles_acceso']['0']['clave_rol'] == 'INV') {
//            redirect(site_url('/registro_investigacion/index'));
//        } else {
//            $output = [];
//            $u_siap = $this->session->flashdata('die_sipimss_siap');
//            if (!is_null($u_siap) && $u_siap == 0) {
//                $output['usuario'] = $this->get_datos_sesion();
//                $output['modal_siap'] = $this->load->view('sesion/modal_siap.tpl.php', $output, true);
//            }
//            $this->template->setTitle('Inicio');
//            $main_content = $this->load->view('sesion/index.tpl.php', $output, true);
//            $this->template->setMainContent($main_content);
//            $this->template->getTemplate();
//        }
//    }

    function captcha() {
        new_captcha();
    }

    public function cerrar_sesion() {
        $idioma = $this->obtener_idioma();
        $this->session->sess_destroy();
        update_lenguaje($idioma); //Agrega el último idioma
        redirect(site_url());
    }

    /*public function recuperar_password($code = null) {
        $this->language_text += $this->obtener_grupos_texto(array('recuperar_contrasenia'), $this->obtener_idioma()); //textos del formulario
        $datos = array();
        $datos['language_text'] = $this->language_text;
        if ($this->input->post() && $code == null) {
            $usuario = $this->input->post("usuario", true);
            $this->form_validation->set_rules('usuario', $datos['language_text']['recuperar_contrasenia']['matricula_o_correo_rc'], 'required');
            if ($this->form_validation->run() == TRUE) {
                $datos['recovery'] = $this->sesion->recuperar_password($usuario, $this->obtener_grupos_texto(array('correo'), $this->obtener_idioma()));
                //$datos['recovery'] = true;
            }
        } else if ($this->input->post() && $code != null) {
            $this->form_validation->set_rules('new_password', 'Contraseña', 'trim|required|min_length[8]');
            $this->form_validation->set_rules('new_password_confirm', 'Confirmar contraseña', 'trim|required|matches[new_password]');
            if ($this->form_validation->run() == TRUE) {
                $new_password = $this->input->post('new_password', true);
                $datos['success'] = $this->sesion->update_password($code, $new_password);
            } else {
                $datos['code'] = $code;
                $datos['form_recovery'] = true;
            }
        } else if ($code != null) {
            $datos['code'] = $code;
            $datos['form_recovery'] = true;
        }
        //pr($datos);
        $main_content = $this->load->view("sesion/recuperar_password.tpl.php", $datos, TRUE);
        //$datos["texts"] = $this->lang->line('formulario'); //textos del formulario
        //$datos['my_modal'] .= $this->load->view("sesion/login_modal.tpl.php", $datos, TRUE);
        //$this->load->view("sesion/login.tpl.php", $datos);
        //$main_content = $this->load->view('sesion/login_modal.tpl.php', $data, true);
        $this->template->setMainContent($main_content);
        $this->template->getTemplate(true, 'tc_template/index_login.tpl.php');
    }*/

    /*public function manteminiemto() {
        echo 'En mantenimiento';
    }*/

    /**
     * @deprecated since version 0.01
     */
    /*public function dashboard() {
        $id_usuario = $this->get_datos_sesion(En_datos_sesion::ID_USUARIO);
        $this->load->model('Modulo_model', 'modulo');
        $this->load->library('LNiveles_acceso');
        $niveles = $this->modulo->get_niveles_acceso($id_usuario, 'usuario');
        if ($this->lniveles_acceso->nivel_acceso_valido(array(LNiveles_acceso::Super, LNiveles_acceso::Admin, LNiveles_acceso::Nivel_central), $niveles)) {
            redirect('reporte/nivel_central');
        } else {
            redirect('reporte/n1');
        }
    }*/

    /*public function registro($tipo_registro = null) {
        if (!is_null($tipo_registro)) {
//            if ($this->input->post()) {
            $config = ['ruta_registro', 'select_validation'];
            $data_post = $this->input->post(null, TRUE);
//            pr($data_post);
            switch ($tipo_registro) {
                case Inicio::INTERNOS:
                    $config['select_validation'] = "form_registro_usuario_internos";
                    $config['ruta_registro'] = "sesion/registro_internos.php";
                    $config['tipo_registro'] = Usuario_model::SIAP;
                    break;
                case Inicio::EXTERNOS:
                    $config['select_validation'] = "form_registro_usuario_externos";
                    $config['ruta_registro'] = "sesion/registro_externos.php";
                    $config['tipo_registro'] = Usuario_model::NO_IMSS;
                    break;
            }
//            $output["texts"] = $this->lang->line('formulario'); //textos del formulario
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item($config['select_validation']); //Obtener validaciones de archivo general
            $this->set_textos_campos_validacion($validations, $this->language_text[Inicio::REGISTRO_USUARIO]); //Modifica los textos del nombre de campo
            $this->form_validation->set_rules($validations); //Añadir validaciones
            $this->load->model('Administracion_model', 'administracion');
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'nombre' => $this->input->post('ext_nombre', TRUE),
                    'matricula' => $this->input->post('matricula', TRUE),
                    'delegacion' => $this->input->post('cve_delegacion', TRUE),
                    'apellido_paterno' => $this->input->post('ext_ap', TRUE),
                    'apellido_materno' => $this->input->post('ext_am', TRUE),
                    'email' => $this->input->post('ext_mail', TRUE),
                    'sexo' => $this->input->post('ext_sexo', TRUE),
                    'pais_institucion' => $this->input->post('pais_institucion', TRUE),
                    'institucion' => $this->input->post('institucion', TRUE),
                    'telefono_personal' => $this->input->post('telefono_personal', TRUE),
                    'telefono_oficina' => $this->input->post('telefono_oficina', TRUE),
                    'pais_origen' => $this->input->post('pais_origen', TRUE),
                    'password' => $this->input->post('reg_password', TRUE),
                    'grupo' => Administracion_model::INVESTIGADOR,
                    'registro_usuario' => true,
                    'tipo_registro' => Inicio::EXTERNOS,
                    'idioma' => $this->obtener_idioma(),
                );
                $output['registro_valido'] = $this->usuario->nuevo($data, $config['tipo_registro'], $this->language_text);
                if ($output['registro_valido']['result'] == 'success') {
                    $data_session = ['username' => $data['matricula'], 'password' => $data['password']];
                    if ($data['tipo_registro'] == Inicio::EXTERNOS) {
                        $data_session['username'] = $data['email'];
                    }
                    $this->session->set_flashdata('inicio_registro', $data_session);
                    echo $this->load->view('sesion/registro_internos_externos_redireccionar.php', null, true);
                    exit();
                }
//                pr($output['registro_valido']['msg']);
//
//                registro_valido
//                pr($output['registro_valido']);
            } else {
                // pr(validation_errors());;
            }
//            }
            $this->load->model('Catalogo_model', 'catalogo');
            $output['delegaciones'] = dropdown_options($this->catalogo->get_delegaciones(null, null), 'clave_delegacional', 'nombre');
            $output['paises'] = dropdown_options($this->catalogo->get_paises(), "clave_pais", "lang", $this->obtener_idioma());
            $output['language_text'] = $this->language_text;
            $output['tipo_registro'] = $tipo_registro;
            $output['post'] = $this->input->post(null, TRUE);
            $this->load->view($config['ruta_registro'], $output);
        }
    }*/

    public function mesa_ayuda() {
        $this->language_text += $this->obtener_grupos_texto(array('template_general'), $this->obtener_idioma()); //textos del formulario
        $datos['language_text'] = $this->language_text;
        $this->template->set_titulo_modal('<h4><span class="glyphicon glyphicon-lock"></span>' . $datos['language_text']['template_general']['mesa_ayuda_titulo'] . '</h4>');
        $view = $this->load->view('sesion/mesa_ayuda.tpl.php', $datos, true);
        $this->template->set_cuerpo_modal($view);
        $this->template->get_modal();
    }

    /*private function valida_info_siap($usuario) {
        $status = true;
        if (isset($usuario['id_docente'])) {
            $status = false;
            // pr($usuario['clave_departamental'].' - '.$usuario['clave_categoria']);

            $siap = $this->empleados_siap->buscar_usuario_siap(substr($usuario['clave_unidad'], 0, 2), $usuario['matricula']);
            if ($siap['tp_msg'] == En_tpmsg::SUCCESS) {
                $siap = $siap['empleado'];
                // pr($siap);
                // pr($siap['adscripcion'][0].' - '.$siap['emp_keypue'][0]);
                $status = ($siap['adscripcion'][0] == $usuario['clave_departamental']) && ($siap['emp_keypue'][0] == $usuario['clave_categoria']);
                // echo $status ? 'true':'false';
            }
            if (!$status) {
                $this->session->set_flashdata('die_sipimss_siap', 0);
            }
        }
    }*/

    public function p404() {
        $output = [];
        $this->load->view('404.tpl.php', $output);
    }

}
