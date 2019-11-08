<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que contiene métodos para siap
 * @version 	: 1.0.0
 * @author      : Pablo José
 * */
class Empleados_siap {

    public function __construct() {
        $this->CI = & get_instance();        
    }

    /*     * *********Buscar usuario siap
     * Función que genera una imagen captcha
     * recibe dos parametros (informacion de registro de aspirantes)
     * @method: void buscar_usuario_siap()
     */

    function buscar_usuario_siap($delegacion, $matricula) {
        $return_info = false;
        $result = array('resp_info' => null, 'resultado' => 'false');
        $params = array("Delegacion" => "{$delegacion}", "Matricula" => "{$matricula}", "RFC" => '');
        try{
            $client = new SoapClient("http://172.26.18.156/ServiciosWeb/wsSIED.asmx?WSDL", ['trace' => 1, 'exceptions' => true]);
            // $client = new SoapClient("http://172.26.18.15/ServiciosWeb/wsSIED.asmx?WSDL", ['trace' => 1, 'exceptions' => true]);
            $resultado_siap = $client->__soapCall("ConsultaSIED", array($params));
            $resultado = simplexml_load_string($resultado_siap->ConsultaSIEDResult->any); //obtenemos la consulta xml
            $res_json = json_encode($resultado); // la codificamos en json
            $array_result = json_decode($res_json); // y la decodificamos en un arreglo compatible php

            $return_info['empleado'] = array();
            $return_info['tp_msg'] = En_tpmsg::DANGER;
            if (isset($resultado->EMPLEADOS)) {
                $result['resultado'] = true;
                $result['resp_info'] = $resultado;
                $return_info['empleado'] = $this->regresa_datos($result, $delegacion);
                $return_info['tp_msg'] = En_tpmsg::SUCCESS;
            }
        }catch (Exception $fault) {
            trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
            /*$return_info['empleado'] = $this->busca_nomina($delegacion, $matricula); ///Buscar en nomina
            if($return_info !== FALSE){
                $return_info['tp_msg'] = En_tpmsg::SUCCESS;
            }*/
            // pr('catch');
            // pr($return_info);
        }

        return $return_info;
    }

    public function regresa_datos($result, $delegacion) {
        if ($result['resultado'] == 1) {
            foreach ($result['resp_info'] as $aspirante) {
                $fecha_curp = str_split($aspirante->EMP_RECURP, 2);
                /*
                 * //str_pad($datos_resgistro['reg_delegacion'], 4,"0" , STR_PAD_LEFT); $fecha_actual = now();
                 *  * despues actualizar por fechas mas reales
                 * */
                $anio = $fecha_curp[2];
                $anio_completo = ($anio > 59) ? str_pad($anio, 4, "19", STR_PAD_LEFT) : str_pad($anio, 4, "20", STR_PAD_LEFT);
                $mes = $fecha_curp[3];
                $dia = $fecha_curp[4];
                $fecha_nacimiento = $anio_completo . '/' . $mes . '/' . $dia;
//                pr($aspirante->SEXO);
                switch ($aspirante->SEXO) {
                    case'Femenino':
                        $sexo = En_sexo::FEMENINO;
                        break;
                    case'Masculino':
                        $sexo = En_sexo::MASCULINO;
                        break;
                    default :
                        $sexo = En_sexo::OTRO;
                }

//                $sexo_asp = str_split($aspirante->SEXO, 1);
//                $sexo = $sexo_asp[0];
                $datos = array(
                    'matricula' => (array) $aspirante->MATRICULA,
                    'nombre' => (array) $aspirante->NOMBRE,
                    'paterno' => (array) $aspirante->APE_PATERNO,
                    'materno' => (array) $aspirante->APE_MATERNO,
                    'sexo' => (array) $sexo,
                    'curp' => (array) $aspirante->EMP_RECURP,
                    'rfc' => (array) $aspirante->RFC,
                    'nacimiento' => (array) $fecha_nacimiento,
                    'status' => (array) $aspirante->EMP_STATUS,
                    //'delegacion' => $aspirante->DELEGACION,
                    'delegacion' => (array) $delegacion,
                    'antiguedad' => (array) $aspirante->ANTIGUEDAD,
                    'adscripcion' => (array) $aspirante->ADSCRIPCION,
                    'descripcion' => (array) $aspirante->DESCRIPCION,
                    'emp_regims' => (array) $aspirante->EMP_REGIMS,
                    'emp_keypue' => (array) $aspirante->EMP_KEYPUE,
                    'pue_despue' => (array) $aspirante->PUE_DESPUE,
                    'fecha_ingreso' => (array) $aspirante->FECHAINGRESO
                );

                return $datos;
            }
        } else {
            return false;
        }
    }

    private function busca_nomina($delegacion, $matricula){
        // pr($delegacion);
        // pr($matricula);
        $this->CI = & get_instance();
        $this->db = $this->CI->load->database('default', true);
        $this->db->flush_cache();
        $this->db->reset_query();
        $select = array(
            'emp_keyemp matricula',
            'emp_emppat paterno',
            'emp_empmat materno',
            'emp_empnom nombre',
            'emp_recurp curp',
            'emp_regrfc rfc',
            'emp_keypue',
            'pue_despue',
            'emp_keydep adscripcion',
            'dep_desdep descripcion',
            'emp_fecing fecha_ingreso',
            'emp_cvesex sexo',
            'emp_fecnac nacimiento',
            'substring(clave_delegacional, 1, 2) delegacion'
        );
        $this->db->select($select);
        $this->db->join('catalogo.delegaciones DEL', "substring(emp_keydep, 1, 2) = clave_delegacional", 'inner');
        $this->db->where('emp_keyemp', $matricula);
        $this->db->where('clave_delegacional', $delegacion);
        $resultado = $this->db->get('nomina')->result_array();
        // pr($this->db->last_query());
        if(count($resultado)>0){
            $resultado = $resultado[0];
            $resultado['paterno'] = array($resultado['paterno']);
            $resultado['materno'] = array($resultado['materno']);
            $resultado['nombre'] = array($resultado['nombre']);
            $resultado['rfc'] = array($resultado['rfc']);
            $resultado['adscripcion'] = array($resultado['adscripcion']);
            $resultado['emp_keypue'] = array($resultado['emp_keypue']);
            $resultado['status'] = array(0);
        }else{
            $resultado = false;
        }
        return $resultado;
    }

}
