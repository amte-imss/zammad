<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sesion_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    function validar_usuario($usr, $passwd) {
        $this->db->flush_cache();
        $this->db->reset_query();
        $this->db->start_cache();

        $this->db->select(array('username', 'email', 'password', 'token', ''));
        $this->db->from('sistema.usuarios u');
        $this->db->where('u.username', $usr);
        $this->db->or_where('u.email', $usr);//Valida que sea el correo también un nombre de usuario

        $num_user = $this->db->count_all_results();
        $this->db->reset_query();
        if ($num_user == 1) {
            $usuario = $this->db->get();
            $result = $usuario->result_array();
            // pr($passwd);
            // pr($result);
            $this->load->library('seguridad');
            $cadena = $result[0]['token'] . $passwd . $result[0]['token'];
            $clave = $this->seguridad->encrypt_sha512($cadena);
            // pr($clave);
            // pr($result[0]['password']);
            $this->db->flush_cache();
            $this->db->reset_query();
            if ($clave == $result[0]['password']) {
                return 1; //Existe
            }
            return 2; //contraseña incorrrecta
        } else {
            return 3; //Usuario no existe
        }

        //$cadena = $result[0]['token'] . $password . $result[0]['token'];
    }

    public function update_password($code = null, $new_password = null)
    {
        $salida = false;
        if ($code != null && $new_password != null)
        {
            $this->db->flush_cache();
            $this->db->reset_query();

            $this->db->select(array(
                'id_usuario', 'token'
            ));
            $this->db->where('recovery_code', $code);
            $this->db->limit(1);
            $resultado = $this->db->get('sistema.usuarios')->result_array();
            //pr($resultado);
            if ($resultado)
            {
                $this->load->library('seguridad');
                $usuario = $resultado[0];
                $this->db->reset_query();
                $pass = $this->seguridad->encrypt_sha512($usuario['token'] . $new_password . $usuario['token']);
                $this->db->where('id_usuario', $usuario['id_usuario']);
                $this->db->set('password', $pass);
                $this->db->set('recovery_code', null);
                $this->db->update('sistema.usuarios');
                //pr($this->db->last_query());
                $salida = true;
            }
        }
        return $salida;
    }


    public function recuperar_password($username, $texto_correo=null) {
        $this->db->flush_cache();
        $this->db->reset_query();
        $this->db->select(array(
            'u.id_usuario', 'concat("D".nombre, $$ $$, "D".apellido_paterno, $$ $$, "D".apellido_materno) nombre', 'u.email', 'recovery_code'
        ));
        $this->db->join('sistema.informacion_usuario D', 'D.id_usuario = u.id_usuario', 'left');
        $this->db->where('u.username', $username);
        $this->db->or_where('u.email', $username);
        $this->db->or_where('D.email', $username);
        $this->db->limit(1);
        $resultado = $this->db->get('sistema.usuarios u')->result_array();
        if ($resultado)
        {
            $usuario = $resultado[0];
            if (empty($usuario['recovery_code']))
            {
                $this->load->library('seguridad');
                $usuario['recovery_code'] = $this->seguridad->crear_token();
                $this->db->reset_query();
                $this->db->where('id_usuario', $usuario['id_usuario']);
                $this->db->set('recovery_code', $usuario['recovery_code']);
                $this->db->update('sistema.usuarios');
                //pr($this->db->last_query());
            }
            $res = true;
            $this->send_recovery_mail($usuario, $texto_correo);
        } else {
            $res = false;
        }

        //pr($this->db->last_query());
        //pr($resultado); //exit();
        return $res;
    }

    private function send_recovery_mail($usuario, $texto_correo)
    {
        $this->load->config('email');
        $this->load->library('My_phpmailer');
        $mailStatus = $this->my_phpmailer->phpmailerclass();
        /*$mailStatus->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );*/
        $mailStatus->SMTPAuth = false;
        //$emailStatus = $this->load->view('sesion/mail_recovery_password.tpl.php', $usuario, true);
        $emailStatus = $this->procesar_correo($texto_correo['correo']['cuerpo_recuperar_contrasenia'], array('{{$recovery_code}}'=>$usuario['recovery_code']));
//        $mailStatus->addAddress('zurgcom@gmail.com'); //pruebas chris 
        $mailStatus->addAddress($usuario['email']);
        $subject = $texto_correo['correo']['asunto_recuperar_contrasenia'];
        //$subject = ENVIRONMENT=='development'?'[Pruebas] '.$subject:$subject;
        $mailStatus->Subject = utf8_decode($subject);
        $mailStatus->msgHTML(utf8_decode($emailStatus));
        //pr($mailStatus);
        $mailStatus->send();
    }
    
    private function procesar_correo($texto, $palabras)
    {
        return str_replace(array_keys($palabras), $palabras, $texto);
    }
    
    public function get_info_convocatoria($id_docente)
    {
        $this->db->flush_cache();
        $this->db->reset_query();
        $select = array(
            'E.id_linea_tiempo', 'E.id_workflow', 'E.nombre', 'E.clave',
            'E.fechas_inicio', 'E.fechas_fin', 'E.id_etapa_activa',
            'F.nombre etapa_activa',
            '("cf".id_docente is not null and "cf".id_linea_tiempo is not null) finalizada'
        );
        $this->db->select($select);
        $this->db->join('catalogo.departamentos_instituto B ','B.id_departamento_instituto = A.id_departamento_instituto', 'inner');
        $this->db->join('catalogo.unidades_instituto C ',' C.clave_unidad = B.clave_unidad and C.anio = date_part($$year$$, current_date)');
        $this->db->join('workflow.unidades_censo D','D.id_unidad = C.id_unidad_instituto', 'inner');
        $this->db->join('workflow.lineas_tiempo E','E.id_linea_tiempo = D.id_linea_tiempo', 'inner');
        $this->db->join('workflow.etapas F','F.id_etapa = E.id_etapa_activa', 'inner');
        $this->db->join('workflow.convocatoria_finalizada cf','cf.id_docente = A.id_docente and cf.id_linea_tiempo = E.id_linea_tiempo', 'left');
        $this->db->where('A.id_docente', $id_docente);
        $this->db->where('E.activa', true);
        $this->db->where('E.id_etapa_activa is not null');
        $this->db->where('D.activa', true);
        $this->db->where('A.actual','1');
        // $this->db->where('E.id_workflow','1');
        $convocatoria = $this->db->get('censo.historico_datos_docente A')->result_array();
        // pr($this->db->last_query());
        $this->db->flush_cache();
        $this->db->reset_query();
        // $convocatoria = array(array('id_linea_tiempo' => 3, 'id_workflow' => 1, 'nombre' => 'Convocatoria censo', 'clave' => 'CENSO',
        //     'fechas_inicio' =>'{2018-03-22,2018-03-25,2018-03-27}', 'fechas_fin' => '{2018-03-23,2018-03-26,2018-03-29}',
        //     'id_etapa_activa' => 1, 'etapa_activa' => 'Registro', 'finalizada' => false
        // ));
        return $convocatoria;
    }

    public function get_niveles_acceso($id_usuario, $agrupadas = false){
        $this->db->flush_cache();
        $this->db->reset_query();
        $select = array(
            'B.clave_rol', 'B.nombre rol'
        );
        $this->db->select($select);
        $this->db->join('sistema.roles B','B.clave_rol = A.clave_rol', 'inner');
        $this->db->where('A.id_usuario', $id_usuario);
        $this->db->where('A.activo', true);
        $niveles = $this->db->get('sistema.usuario_rol A')->result_array();
        $this->db->flush_cache();
        $this->db->reset_query();
        if($agrupadas)
        {
            $tmp = [];
            foreach ($niveles as $row)
            {
                $tmp[$row['clave_rol']] = $row['rol'];
            }
            $niveles = $tmp;
        }
        return $niveles;
    }

    /**
     * Funcion que obtiene la notificacion estatica
     * @author Cheko
     * @return type $notificacion Numero de días restantes  de la notificacion
     */
    public function get_notificaciones_estaticas()
    {

    }

}
