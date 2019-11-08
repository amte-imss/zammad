<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// HELPER General
/**
 * M�todo que preformatea una cadena
 * @autor 		: Jes�s D�az P.
 * @param 		: mixed $mix Cadena, objeto, arreglo a mostrar
 * @return  	: Cadena preformateada
 */
class Seguridad {

    private $pasa_convocatoria = null;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('session');
    }

    public function crear_token() {
        return md5(uniqid(rand(), TRUE));
    }

    public function token() {
        $this->CI->session->set_userdata('token', $this->crear_token());
        return;
    }

    public function crear_token_url() {
        return hash('sha512', uniqid(rand(), TRUE));
    }

    /**
     * M�todo que codifica una cadena a base 64
     * @autor       : Jes�s D�az P.
     * @modified    : 
     * @param       : string $string Cadena a codificar
     * @return      : string Cadena codificada
     */
    public function encrypt_base64($string) {
        //return base64_encode($string); //convert_uuencode($string);
        //return strtr(base64_encode($string), '+/=', '-_*');
        return rtrim(strtr(base64_encode($string), '+/', '-_'), '=');
    }

    /**
     * M�todo que decodifica una cadena en base 64
     * @autor       : Jes�s D�az P.
     * @modified    : 
     * @param       : string $string Cadena a decodificar
     * @return      : string Cadena decodificada
     */
    public function decrypt_base64($string) {
        //return base64_decode($string); //convert_uudecode($string);
        //return base64_decode(strtr($string, '-_*', '+/='));
        return base64_decode(str_pad(strtr($string, '-_', '+/'), strlen($string) % 4, '=', STR_PAD_RIGHT));
    }

    /**
     * M�todo que encripta una cadena con el algoritmo sha256
     * @autor       : Jes�s D�az P.
     * @modified    : 
     * @param       : string $string Cadena a decodificar
     * @return      : string Cadena decodificada
     */
    public function encrypt_sha256($string) {
        return hash('sha256', $string);
    }

    /**
     * M�todo que encripta una cadena con el algoritmo sha512
     * @autor       : Jes�s D�az P.
     * @modified    : 
     * @param       : string $string Cadena a decodificar
     * @return      : string Cadena decodificada
     */
    public function encrypt_sha512($string) {
        return hash('sha512', $string);
    }

    /**
     * M�todo que encripta una cadena con el algoritmo md5
     * @autor       : Jes�s D�az P.
     * @modified    : 
     * @param       : string $string Cadena a decodificar
     * @return      : string Cadena decodificada
     */
    public function encrypt_carpeta_nombre($string) {
        return md5($string);
    }

    public function folio_random($limit = 6, $anadirEspecial = false) {
        $cadena_base = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; //Alfa
        $cadena_base .= '0123456789'; //N�meros
        if ($anadirEspecial) {
            $cadena_base .= '%&*_,.!'; //Caracteres especiales
        }

        $password = '';
        $limite = strlen($cadena_base) - 1;

        for ($i = 0; $i < $limit; $i++) {
            $password .= $cadena_base[rand(0, $limite)];
        }
        return $password;
    }

    /**
     * @author Jesús Zoe Días 
     * @fecha 27/08/2016
     * @param type $IS_VALIDO_PROFESIONALIZACION
     * @param type $validation_estado
     * @param type $validation_estado_anterior
     * @return boolean
     */
    public function verificar_liga_validar_est($IS_VALIDO_PROFESIONALIZACION = null, $validation_estado = null, $validation_estado_anterior = null) {
        //$this->CI->load->config('general');
        $flag_validar = false;
        $estados_val_censo = $this->CI->config->item('estados_val_censo'); ///Obtener listado de estados de la validaci�n, definidos en archivo de configuraci�n
        $rol_validador_actual = $this->CI->session->userdata('datos_validador')['ROL_CVE']; //Obtener de sesi�n el rol del usuario que validar�
        $estado_validacion_actual = $this->CI->session->userdata('datosvalidadoactual')['est_val']; //Obtener de sesi�n el estado actual de la validaci�n
        //pr($this->CI->session->userdata());
        //pr($estados_val_censo[$estado_validacion_actual]['rol_permite']);
        //echo $IS_VALIDO_PROFESIONALIZACION."|".$rol_validador_actual."|".$estado_validacion_actual; pr('<br>');
        $fue_validado = $this->CI->session->userdata('datosvalidadoactual')['estado']['fue_validado'];
        if ($IS_VALIDO_PROFESIONALIZACION == 0 && in_array($rol_validador_actual, $estados_val_censo[$estado_validacion_actual]['rol_permite'])) {
            //pr('////////////////////////////////////////////////');
            //pr('entro');
            if ($fue_validado['result'] == true) {
                //pr('entro1: '.$validation_estado_anterior.'|'.$this->CI->config->item('cvalidacion_curso_estado')['CORRECCION']['id']);
                if ($validation_estado_anterior == $this->CI->config->item('cvalidacion_curso_estado')['CORRECCION']['id']) {
                    /* pr('entro2');
                      pr('/////////');
                      pr($validation_estado_anterior);
                      pr($this->CI->config->item('cvalidacion_curso_estado')['CORRECCION']['id']); */
                    $flag_validar = true;
                }
            } else {
                //pr('else');
                $estado_validacion_actual = $this->CI->session->userdata('datosvalidadoactual')['est_val']; //Estado actual de la validaci�n
                if ($this->CI->config->item('estados_val_censo')[$estado_validacion_actual]['color_status'] == $this->CI->config->item('CORRECCION') && ($this->CI->config->item('cvalidacion_curso_estado')['CORRECCION']['id'] != $validation_estado)) { //Validar estado en correcci�n
                    $flag_validar = false;
                    //pr('else2');
                } else {
                    $flag_validar = true;
                }
            }
        }
        return $flag_validar;
    }

    public function set_tiempo_convocatoria($convocatoria_delegacion = null, $rol_validar = null, $is_interseccion = 0) {
        if (is_null($convocatoria_delegacion) AND ! is_null($this->CI->session->userdata('convocatoria_delegacion'))) {
            $convocatoria_delegacion = $this->CI->session->userdata('convocatoria_delegacion');
        } else if (is_null($convocatoria_delegacion) AND ! is_null($this->CI->session->userdata('datos_validador')['ETAPA_CONVOCATORIA'])) {
            $convocatoria_delegacion['convocatoria_cve'] = $this->CI->session->userdata('datos_validador')['VAL_CON_CVE'];
            $convocatoria_delegacion['aplica_convocatoria'] = $this->CI->session->userdata('datos_validador')['ETAPA_CONVOCATORIA'];
            $convocatoria_delegacion = (object) $convocatoria_delegacion;
        }
        if (is_null($rol_validar)) {
            $rol_validar = $this->CI->session->userdata('rol_seleccionado_cve');
        }
        $this->rol_actual = $rol_validar;
        if (!empty($rol_validar) AND ! empty($convocatoria_delegacion) AND is_null($this->pasa_convocatoria)) {
            $this->pasa_convocatoria = get_valida_tiempo_convocatoria_rol($rol_validar, $convocatoria_delegacion->aplica_convocatoria, $is_interseccion);
        } else {
            $this->pasa_convocatoria = 0;
        }
//        pr('pasa convocatoria ' . $this->pasa_convocatoria);
    }

    public function set_tiempo_convocatoria_null() {
        $this->pasa_convocatoria = null;
    }

    /**
     * 
     * @author LEAS
     * @fecha 27/10/2016
     * @param type $is_profesionalizacion_evaluado : Variable que en "1" indica que un curso ha sido evaluado por GAECUD 
     * @param type $is_carga_sistema : Variable que indica que el curso ha sido cargado por ETL por lo que es información cvalida 
     * @param type array $convocatoria_delegacion : Convocatoria de la delegación actual, si existe la onvoatoria, el id > 0; la etapa de la convocatoria es "aplica_convocatoria" 
     *                      Si la convocatoria es nula, busca una convocatoria en la variable de sesión
     * @param type $rol_validar Rol que hará uso de  la convocatoria, puede ser un validador o un docente. Si el rol es nulo, busca en la variable de sesion el rol que inicio sesion 
     * @return type 0 - No hacepta liga; 1 - Acepta que pueda existir un cambio
     */
    public function verificar_liga_validar($is_profesionalizacion_evaluado = null, $is_carga_sistema = null, $estado_validacion_curso = null, $convocatoria_delegacion = null, $rol_validar = NULL) {
        //$this->CI->load->config('general');
        $flag_validar = 0;
//        pr($this->pasa_convocatoria);
        //Valida que el curso no se encuentre evaluado "$is_profesionalizacion_evaluado" o que allá sido argado por el sistem "$is_carga_sistema"
        if (!is_null($this->pasa_convocatoria)) {
//            pr($this->pasa_convocatoria);
            //Valida que rol tenga aceso al estado de la convocatoria con la variable global, considerar que se deba resetear cada que se consulte la convocatoria
            $flag_validar = $this->pasa_convocatoria;
//            pr($flag_validar);
            if (!is_null($is_profesionalizacion_evaluado)) {//Si en diferente de null, valida que por ejemplo un urso se puede editar o eliminar
                $flag_validar = ($flag_validar and ! $is_profesionalizacion_evaluado) ? 1 : 0;
            }
            if (!is_null($is_carga_sistema)) {//Si en diferente de null, valida que por ejemplo un urso se puede editar o eliminar
                $flag_validar = ($flag_validar and ! $is_carga_sistema) ? 1 : 0;
            }
            if (!is_null($estado_validacion_curso) AND ! empty($estado_validacion_curso)) {//Si es diferente de null, obtiene el estado de la validación del curso
                switch (intval($estado_validacion_curso)) {
                    case 1://Valido
                        $flag_validar = 0; //Se queda en cero para que los validados en última instancia no se puedan editar ni eliminar
                        break;
                    case 2://No valido
                        $flag_validar = ($flag_validar AND TRUE) ? 1 : 0; //Los no validos se pueden eliminar o editar , ya que, por alguna razón los docentes subieron algo mal
                        break;
                    case 3://En corrección
                        $flag_validar = ($flag_validar AND TRUE) ? 1 : 0; //Los que se envian a corrección, deben poder ser eliminados o editados
                        break;
                    case 4://Valido sin revisión
                        //No se define aún actualmente
                        break;
                }
            }
        }
//        pr($flag_validar);
        return $flag_validar;
    }

    /**
     * 
     * @author LEAS y Jesús Días
     * @modificado 27/10/2016
     * @param type $is_evaluado_gaecud Parametro que indica si ya fue evaluado el curso
     * @param type $is_carga_sistema Parametro que indica que es un curso cargado por sistema
     * @return type
     */
    public function html_verificar_valido_profesionalizacion($is_evaluado_gaecud = null, $is_carga_sistema = null, $is_valido = null) {
//        if ($is_evaluado_gaecud == 1) {
//            return '<span class="class_validacion_registro text-black glyphicon glyphicon-ok-sign" data-toggle="tooltip" data-placement="left" title="Curso evaluado"></span>';
//        } else if ($is_carga_sistema == 1) {
//            return '<span class="class_validacion_registro text-black glyphicon glyphicon-ok-sign" data-toggle="tooltip" data-placement="left" title="Curso cargado por sistema"></span>';
//        } else if ($is_valido == 1) {
//            return '<span class="class_validacion_registro text-black glyphicon glyphicon-ok" data-toggle="tooltip" data-placement="left" title="Valido"></span>';
//        }
//        return '';
        $glyphicon = 'minus';
        $texto = '';
        if (!is_null($is_valido)) {//Menor_a mayor peso
            switch ($is_valido) {
                case 1:
                    $glyphicon = 'ok-circle';
                    $texto = 'El curso es valido ';
                    break;
                case 2:
                    $glyphicon = 'remove-sign';
                    $texto = 'El curso no es valido ';
                    break;
                case 3:
                    $glyphicon = 'remove';
                    $texto = 'El curso fue enviado a corrección ';
                    break;
                default :
                    $glyphicon = 'minus';
                    $texto = 'Curso no validado por ningun nivel ';
            }
        }
        if (!is_null($is_carga_sistema) and $is_carga_sistema == 1) {
            $glyphicon = 'ok';
            $texto .= 'Curso cargado por sistema ';
        }
        if (!is_null($is_evaluado_gaecud) and $is_evaluado_gaecud == 1) {
            $glyphicon = 'ok-sign';
            $texto .= 'Curso evaluado por GAECUD ';
        }
        $texto = (!empty($texto)) ? $texto : 'Curso no validado por ningun nivel';
        return '<span class="class_validacion_registro text-black glyphicon glyphicon-' . $glyphicon . '" '
                . 'data-toggle="tooltip" data-placement="left" data-original-title="' . $texto . '"></span>';
    }

    /**
     * 
     * @author LEAS 
     * @modificado 02/11/2016
     * @param type $is_evaluado_gaecud Parametro que indica si ya fue evaluado el curso
     * @param type $is_carga_sistema Parametro que indica que es un curso cargado por sistema
     * @return type
     */
    public function html_verificar_evaluado_issistema_valido($is_evaluado_gaecud = null, $is_carga_sistema = null, $is_valido = null) {
//        pr($is_valido . ' -> ' . $is_carga_sistema . ' -> ' . $is_valido);
        $glyphicon = 'minus';
        $texto = '';
        if (!is_null($is_valido)) {//Menor_a mayor peso
            switch ($is_valido) {
                case 1:
                    $glyphicon = 'ok-circle';
                    $texto = 'El curso es valido ';
                    break;
                case 2:
                    $glyphicon = 'remove-sign';
                    $texto = 'El curso no es valido ';
                    break;
                case 3:
                    $glyphicon = 'remove';
                    $texto = 'El curso fue enviado a corrección ';
                    break;
                default :
                    $glyphicon = 'minus';
                    $texto = 'Curso no validado por ningun nivel ';
            }
        }
        if (!is_null($is_carga_sistema) and $is_carga_sistema == 1) {
            $glyphicon = 'ok';
            $texto .= 'Curso cargado por sistema ';
        }
        if (!is_null($is_evaluado_gaecud) and $is_evaluado_gaecud == 1) {
            $glyphicon = 'ok-sign';
            $texto .= 'Curso evaluado por GAECUD ';
        }
        $texto = (!empty($texto)) ? $texto : 'Curso no validado por ningun nivel';
        return '<span class="class_validacion_registro text-black glyphicon glyphicon-' . $glyphicon . '" '
                . 'data-toggle="tooltip" data-placement="left" data-original-title="' . $texto . '"></span>';
//        return '<span class="class_validacion_registro text-black glyphicon glyphicon-' . $glyphicon . '" data-toggle="tooltip" data-placement="left" title="a,snasnd"></span>';
    }

    public function html_verificar_validacion_registro($is_valido_profesionalizacion, $is_carga_sistema) {
        $html_valido = '<span class="class_validacion_registro ' . (($is_valido_profesionalizacion == 1) ? 'text-black' : '') . ' glyphicon glyphicon-ok-sign" data-toggle="tooltip" data-placement="left" title="' . (($is_valido_profesionalizacion == 1) ? 'Validaci&oacute;n confirmada por profesionalizaci&oacute;n' : 'Validaci&oacute;n realizada') . '"></span>';
        $html = $html_no_valido = '-';

        if ($is_valido_profesionalizacion || $is_carga_sistema) {
            $html = $html_valido;
        } else {
            $html = $html_no_valido;
        }

        return $html;
    }

    public function verificar_liga_agregar_docente() {
        $estado_actual = $this->CI->session->userdata('datosvalidadoactual')['est_val'];
        if ($this->CI->config->item('estados_val_censo')[$estado_actual]['agregar_docente']) {
            return true;
        } else {
            return false;
        }
    }

    public function verificar_liga_eliminar_docente($is_valido_profesionalizacion) {
        $estado_actual = $this->CI->session->userdata('datosvalidadoactual')['est_val'];

        if (!$is_valido_profesionalizacion && $this->CI->config->item('estados_val_censo')[$estado_actual]['eliminacion_docente']) {
            return true;
        } else {
            return false;
        }
    }

    public function verificar_liga_editar_docente($is_valido_profesionalizacion, $estado_actual_registro) {
        $estado_actual = $this->CI->session->userdata('datosvalidadoactual')['est_val'];

        if (!$is_valido_profesionalizacion) {
            if ($this->CI->config->item('estados_val_censo')[$estado_actual]['edicion_docente']) { //En caso de que se permita la edici�n
                if ($estado_actual == Enum_ev::Correccion_docente) { //Validar estado correcci�n, solo se mostrar� liga a los marcados como en correcci�n
                    if ($this->CI->config->item('cvalidacion_curso_estado')['CORRECCION']['id'] == $estado_actual_registro) {
                        return true;
                    }
                } else { ///En caso de que sea parte de la edici�n
                    return true;
                }
            }
        }
        return false;
    }

}
