<?php

class MY_Form_validation extends CI_Form_validation {

    function __construct($config = array()) {
        parent::__construct($config);
        /*
          $this->CI =& get_instance();
          $this->CI->load->helper('captcha');
          $this->CI->load->library('session'); */
    }

    public function get_data() {
        if (!empty($this->validation_data)) {
            return $this->validation_data;
        }
        return $_POST;
    }

    public function alpha_accent_space($str) {
        $exp = '/^[\p{L}- ]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function alpha_numeric_accent_space($str) {
        $exp = '/^[\p{L}-0123456789 ]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function alpha_numeric_accent_space_dot($str) {
        $exp = '/^[\p{L}-0123456789,. \s]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    /**/

    public function alpha_accent_space_dot_quot($str) {
        $exp = '/^[\p{L}-.\s]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function alpha_numeric_accent_slash($str) {
        $exp = '/^[\p{L}-0123456789.\/]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function alpha_numeric_accent_space_dot_parent($str) {
        $exp = '/^[\p{L}-0123456789,.:\(\)\/\s]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function alpha_numeric_accent_space_dot_double_quot($str) {
        $exp = '/^[\p{L}-0123456789,.:\(\)\/\s]*$/u';
        //$exp = '/^[\p{L}-0123456789,.:;\'\"\(\)\/\s]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function exists_a_number($str) {
        $exp = '/^[0123456789,]+*$/u';
        //$exp = '/^[\p{L}-0123456789,.:;\'\"\(\)\/\s]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function exists_a_uppercase($str) {
        $exp = '/^[A-Z,]*$/u';
        //$exp = '/^[\p{L}-0123456789,.:;\'\"\(\)\/\s]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function exists_a_lowercase($str) {
        $exp = '/^[a-z,]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function exists_a_aspecial_character($str) {
        $exp = '/^[%$#,]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function exists_a_aspecial_character_password($str) {
        $exp = '/^[*\/_+-,]*$/u';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    /*
     * validación contraseña
     */

    public function valid_pass_user($str) {
        $exp = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/";
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    /*
      falta validacion pa ra % $ # & !
     */

    // /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/
    public function validate_url($url) {
        $url = trim($url);
        $url = stripslashes($url);
        $url = htmlspecialchars($url);

        // check address syntax is valid or not(this regular expression also allows dashes in the URL)
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $url)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /* Formato yyyy-mm-dd */

    public function validate_date($date) {
        $exp = '/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/';
        return (!preg_match($exp, $date)) ? FALSE : TRUE;
    }

    public function validate_date_dd_mm_yyyy($date) {
        $exp = '/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/';
        return (!preg_match($exp, $date)) ? FALSE : TRUE;
    }

    /* public function compare_date($end, $start){
      if($start>$end){
      return false;
      } else {
      return true;
      }
      } */

    public function radio_buttom_validation($str) {
//        $exp = '/^[0-9]+$/';
//        return (!preg_match($exp, $value)) ? FALSE : TRUE;
        return is_array($str) ? (bool) count($str) : (trim($str) !== '');
    }

    public function check_captcha($str) {
        $this->CI = & get_instance();
        $this->CI->load->library('session');

        $this->CI->load->config('general');
        $status_servidor = $this->CI->lang->line('status_sistema');
        if ($status_servidor != null && $status_servidor == 'T') {
            return true;
        }

        $word = $this->CI->session->userdata('captchaWord');
        if (strcmp(strtoupper($str), strtoupper($word)) == 0) {
            return true;
        } else {
            //$this->form_validation->set_message('check_captcha','Por favor introduce correctamente los caracteres');
            return false;
        }
    }

    /**
     * @author LEAS
     * @fecha creación 03/abril/2016
     * @param String $str
     * @return true si el correo es valido 
     * 
     */
    public function valida_correo_electronico($str) {
        $exp = '/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function valida_password_estructura($str) {
        $exp = '/^[A-Za-z0-9-]';
        return (!preg_match($exp, $str)) ? FALSE : TRUE;
    }

    public function matches($str, $field) {
        if (!isset($_POST[$field])) {
            return FALSE;
        }
        $field = $_POST[$field];
        return ($str !== $field) ? FALSE : TRUE;
    }

    /**
     * 
     * @author LEAS
     * @param type $folio folio del comprobante
     * @return type tru
     */
    public function is_folio_comprobante_unico($folio) {
        $this->CI = & get_instance();
        $this->CI->load->model('Formulario_model', 'fm');
        return !$this->CI->fm->get_valida_folio($folio);
    }

    /**
     * 
     * @author LEAS
     * @param type $str folio del comprobante
     * @return type tru
     */
    public function folio_comprobante_unico_docente_seccion($str, $field) {
        $this->CI = & get_instance();
        $this->CI->load->model('Formulario_model', 'fm');
        $data = $this->get_data();
        $uri = $this->CI->uri->rsegment(1);
        $data_usuario = $this->CI->session->userdata('die_sipimss')['usuario'];
        if (isset($data['censo_regstro']) && !empty($data['censo_regstro'])) {//Es una actualización
            $id_censo = decrypt_base64($data['censo_regstro']); //Desencripta censo
            $where = array("c.id_censo <> {$id_censo}" => null, "s.url" => $uri, "cm.nombre" => $field, "ci.valor" => $str, "c.id_docente" => $data_usuario[En_datos_sesion::ID_DOCENTE]);
        } else {//Una insersión
            $where = array("s.url" => $uri, "cm.nombre" => $field, "ci.valor" => $str, "c.id_docente" => $data_usuario[En_datos_sesion::ID_DOCENTE]);
        }
        $result = $this->CI->fm->get_valida_folio_comprobante($where, null, 'num_rows');
//        pr($result);
        return $result < 1;
    }

    public function valida_date_duracion_fecha_inicial($str) {
//        pr($str);
        if (isset($_POST['fecha_inicio']) AND isset($_POST['fecha_termino'])) {
            return valida_fecha_inicial_menor_final($_POST['fecha_inicio'], $_POST['fecha_termino']);
        }
        return FALSE;
    }

    public function valida_date_duracion_fecha_final($str) {
//        pr($str);
        if (isset($_POST['fecha_inicio']) AND isset($_POST['fecha_termino'])) {
            return valida_fecha_inicial_menor_final($_POST['fecha_inicio'], $_POST['fecha_termino']);
        }
        return FALSE;
    }

    public function valida_date_certificado_concejo_fecha_inicial($str) {
//        pr($str);
//        pr('algo imprime....');

        if (isset($_POST['cert_vigencia_inicial']) AND isset($_POST['cert_vigencia_termino'])) {
            return valida_fecha_inicial_menor_final($_POST['cert_vigencia_inicial'], $_POST['cert_vigencia_termino']);
        }
        return FALSE;
    }

    public function valida_date_certificado_concejo_fecha_final($str) {
//        pr('ahsjhajhs');
//        return TRUE;
        if (isset($_POST['cert_vigencia_inicial']) AND isset($_POST['cert_vigencia_termino'])) {
            return valida_fecha_inicial_menor_final($_POST['cert_vigencia_inicial'], $_POST['cert_vigencia_termino']);
        }
        return FALSE;
    }

    public function valida_requerido() {

        $formacion = $_POST['"formacion_prof_prof"'];
        if ($formacion == 14) {
            
        }

        if ($date1 > $date2) {
            return false;
        }

        return true;
    }

    /**
     * 
     * @param type $str
     * @param type $parametros
     * @return type
     * Valida que la fecha de inicio sea menor que la fecha de termino
     */
    public function valida_fecha_inicio_menor_fecha_fin($str, $parametros) {
        $respuesta = FALSE;
        if (!empty($str) AND ! empty($parametros)) {//Valida que lleguen parametros a validar
            $post_param = explode('~', $parametros);
            $CI = & get_instance();
            if (isset($post_param[0]) AND ! empty($post_param[0])) {//Valida que haya solamente dos parametros de fecha
                if (!is_null($CI->input->post($post_param[0])) || !empty($CI->input->post($post_param[0]))) {//Valida que existan los parametros en post
//                    pr($CI->input->post($post_param[0]));
                    $respuesta = valida_fecha_inicial_menor_final($str, $CI->input->post($post_param[0]));
                }
            }
            if (isset($post_param[1]) AND ! empty($post_param[1])) {//Valida que exista un mensaje particular
                //Modifica mensaje de fecha
                $CI->form_validation->set_message('valida_fecha_inicio_menor_fecha_fin', $post_param[1]);
            }
        }

        return $respuesta;
    }

    /**
     * 
     * @param type $str
     * @param type $parametros
     * @return type
     * Valida que la fecha de termino sea mayor que la fecha de inicio
     */
    public function valida_fecha_fin_mayor_inicio($str, $parametros) {
        $respuesta = FALSE;
        if (!empty($str) AND ! empty($parametros)) {//Valida que lleguen parametros a validar
            $post_param = explode('~', $parametros);
            $CI = & get_instance();
            if (isset($post_param[0]) AND ! empty($post_param[0])) {//Valida que haya solamente dos parametros de fecha
                if (!is_null($CI->input->post($post_param[0])) || !empty($CI->input->post($post_param[0]))) {//Valida que existan los parametros en post
                    $respuesta = valida_fecha_inicial_menor_final($CI->input->post($post_param[0]), $str);
                }
            }
            if (isset($post_param[1]) AND ! empty($post_param[1])) {//Valida que exista un mensaje particular
                //Modifica mensaje de fecha
                $CI->form_validation->set_message('valida_fecha_fin_mayor_inicio', $post_param[1]);
            }
        }

        return $respuesta;
    }

    public function obliga_actualiza_certificado($str, $field) {
        if (!empty($_POST['censo_regstro']) and isset($_POST[$field]) and ! empty($_POST[$field])) {
//        if (isset($_POST[$field]) and ! empty($_POST[$field])) {
//            $is_mayor_actual = valida_fecha_mayor_actual($_POST[$field]);
            return valida_fecha_mayor_actual($_POST[$field]);
        }
        return true;
    }

    public function not_space($str) {
        $exp = '/\s/';
        return (!preg_match($exp, $str)) ? TRUE : FALSE;
    }

    /**
     * @author LEAS
     * @fecha 10/08/2017
     * @param type $str Valor del campo
     * @return type true si la fecha ingresada es menor a la fecha maxíma indicada 
     * en las reglas de validación, se asocia a que los ciclos clínicos no existen 
     * despues del 2018, por tal razón no puede ser mayor 
     */
    public function ciclos_clinicos_fecha_maxima($str, $fecha_maxima) {
//        $result = valida_fecha_inicial_menor_final($str, '01/01/2018');
        $result = valida_fecha_inicial_menor_final($str, $fecha_maxima);
        return $result;
    }

    /**
     * @author LEAS
     * @fecha 10/08/2017
     * @param type $str Valor del campo
     * @return type Compara que el valor del campo a fin de tipo fecha sea menor a la 
     * fecha indicada, ejemplo uso:  fecha_maxima_indicada[01/01/2018]
     */
    public function fecha_maxima_indicada($str, $fecha_maxima) {
//        $result = valida_fecha_inicial_menor_final($str, '01/01/2018');
        $result = valida_fecha_inicial_menor_final($str, $fecha_maxima);
        return $result;
    }

    public function field_required_depends($str, $field) {
        pr($field);
        pr($str);
    }

    public function anio_menor_actual($str) {
        return (date('Y', now()) >= intval($str));
    }

    public function fecha_menor_actual($str) {
        $fecha_c = date('dmY', strtotime(str_replace("/", "-", $str)));
        $fecha_actual = date('dmY', now());
        return ($fecha_actual >= $fecha_c);
    }

    public function is_unico_datos_usuarios($str, $field) {
//        pr($field);
//        pr($str);
        $this->CI = & get_instance();
        $this->CI->load->model('Usuario_model', 'usm');
        $result = $this->CI->usm->is_unico_datos_usuarios($field, $str);
        return $result;
    }

    public function is_valido_rango_calificacion($str, $field) {
        $opcion = $_POST['seleccion_opcion_evaluacion_' . $field];
        if (trim($opcion) == "")
            return false;
        $this->CI = & get_instance();
        $this->CI->load->model('Evaluacion_revision_model', 'eval');
        $result = $this->CI->eval->is_valido_rango_calificacion($opcion, $str);

        return $result;
    }

    public function alpha_nombre_nomina($str) {
        //$exp = '/^[A-Z,]*$/u';
        $exp = '/^[ A-ZÑ]*$/u';
        //pr($str); pr(preg_match($exp, mb_strtoupper($str, 'UTF-8')));// exit();
        return (!preg_match($exp, mb_strtoupper($str, 'UTF-8'))) ? FALSE : TRUE;
    }

}
