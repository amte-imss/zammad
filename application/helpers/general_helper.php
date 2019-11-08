<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// HELPER General
/**
 * Método que preformatea una cadena
 * @autor 		: Jesús Díaz P.
 * @param 		: mixed $mix Cadena, objeto, arreglo a mostrar
 * bool $return Boleano que determina si se imprema o se retorna el valor
 * @return  	: Cadena preformateada
 */
if (!function_exists('pr')) {

    function pr($mix, $return = false) {
        if ($return) {
            return print_r($mix, TRUE);
        } else {
            echo "<pre>";
            print_r($mix);
            echo "</pre>";
        }
    }

}

/**
 * Método que genera un arreglo asociativo de la forma llave => valor, derivado de un arreglo multidimensional
 * @autor 		: Jesús Díaz P.
 * @modified 	:
 * @param 		: mixed[] $array_data
 * @param 		: string $field_key
 * @param 		: string $field_value
 * @return 		: mixed[]. TRUE en caso de que exista, no sea vacía o nula de lo contrario devolverá FALSE
 * Ejemplo: $array_multi = array(
 * 		array('llave1'=>'valor1.0', 'llave2'=>'valor2.0', 'llave3'=>'valor3.0'),
 * 		array('llave1'=>'valor1.1', 'llave2'=>'valor2.1', 'llave3'=>'valor3.1'),
 * 		array('llave1'=>'valor1.2', 'llave2'=>'valor2.2', 'llave3'=>'valor3.2'),
 * )
 * dropdown_options($array_multi, 'llave2', 'llave3');
 * Resultado: array(
 * 		array('valor2.0'=>'valor3.0'),
 * 		array('valor2.1'=>'valor3.1'),
 * 		array('valor2.2'=>'valor3.2'),
 * )
 */
if (!function_exists('dropdown_options')) {

    function dropdown_options($array_data, $field_key, $field_value, $idioma = null) {
        $options = array();
        if (is_null($idioma)) {
            foreach ($array_data as $key => $value) {
                $options[$value[$field_key]] = $value[$field_value];
            }
        }else{//Obtiene el idioma
            foreach ($array_data as $key => &$value) {
                $tmp = json_decode($value[$field_value], TRUE);
                if (isset($tmp[$idioma])) {
                    $value[$field_value] = $tmp[$idioma];
                }
                $options[$value[$field_key]] = $value[$field_value];
            }
        }
        return $options;
    }

}
if (!function_exists('dropdown_options_extra')) {

    function dropdown_options_group($array_data, $field_key, $field_value, $field_group) {
        $options = array();
        foreach ($array_data as $key => $value) {
            $options[$value[$field_key]] = array($value[$field_value] => $value[$field_value]);
        }
        return $options;
    }

}

/**
 * Método que define una plantilla para los mensajes que mostrará un formulario
 * @autor 		: Jesús Díaz P.
 * @modified 	:
 * @param 		: string $elemento Nombre del elemento form
 * @param 		: string $tipo Posibles valores('success','info','warning','danger')
 * @return 		: string Mensaje con formato predefinido
 */
if (!function_exists('form_error_format')) {

    function form_error_format($elemento, $tipo = null) {
        if (is_null($tipo)) {
            $tipo = 'danger';
        }
        return form_error($elemento, '<div class="alert alert-' . $tipo . '" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
    }

}

/**
 * Método que define una plantilla para los mensajes que se mostrarán con bootstrap
 * @autor 		: Jesús Díaz P.
 * @modified 	:
 * @param 		: string $message Texto a mostrar
 * @param 		: string $tipo Posibles valores('success','info','warning','danger')
 * @return 		: string Mensaje de alerta con formato predefinido
 */
if (!function_exists('html_message')) {

    function html_message($message, $tipo = null) {
        if (is_null($tipo)) {
            $tipo = 'danger';
        }
        return '<div class="alert alert-' . $tipo . '" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message . '</div>';
    }

}

/**
 * Método que define una plantilla para los mensajes que se mostrarán con bootstrap
 * @autor     : Jesús Díaz P.
 * @modified  :
 * @param     : string $message Texto a mostrar
 * @param     : string $tipo Posibles valores('success','info','warning','danger')
 * @return    : string Mensaje de alerta con formato predefinido
 */
if (!function_exists('imprimir_resultado')) {

    function imprimir_resultado($resultado) {
        $tipo_mensaje = ($resultado['result'] === true) ? 'success' : 'danger';

        return '<div id="js_msg" class="row">
                <div class="col-lg-12 alert alert-' . $tipo_mensaje . '">
                    ' . $resultado['msg'] . '
                </div>
            </div>';
    }

}

/**
 * Método que obtiene un listado de archivos de la ruta otorgada
 * @autor 		: Jesús Díaz P.
 * @modified 	:
 * @param 		: string $path Ruta de donde se obtendrá el listado de archivos
 * @return 		: mixed[] $result Listado de archivos
 */
if (!function_exists('get_files')) {

    function get_files($path) {
        return scandir($path);
    }

}

/**
 * Método que hace una intersección entre dos array
 * @autor 		: Luis E. A.S.
 * @modified            :
 * @param 		: array $array_1 a comparar con $array_2
 * @return 		: $array_result  de intersección entré dor arrays
 */
if (!function_exists('filtra_array_por_key')) {

    function filtra_array_por_key($array_bidimencional, $array_unidimencional) {
        $is_array = exist_and_not_null($array_bidimencional);
        $is_array = $is_array && exist_and_not_null($array_unidimencional);
        $is_array = $is_array && is_array($array_bidimencional);
        $is_array = $is_array && is_array($array_unidimencional);
        $array_result = array();
        if ($is_array) {
            foreach ($array_unidimencional as $value) {
                foreach ($array_bidimencional as $key => $value_2) {
                    if ($value == $key) {
                        $array_result[$key] = $value_2;
                    }
                }
            }
            return $array_result;
        } else {
            return null;
        }
    }

}

if (!function_exists('crear_formato_array')) {

    /**
     * @author : LEAS <cenitluis.pumas@gmail.com>
     * @Fecha creación : 25-05-2016
     * @Fecha modificación :
     * @param type $array_value : Array ha analizar
     * @param type $key_ref : Llave de referencia del arreglo que será el index
     * del arreglo formateado
     * @param type $not_index_auto_incrementables : En false le agregará
     * un index autoincrementable, y en true se lo quita y sólo le agrega el $keyref
     * @return array[]
     * <p>
     * Array
      (
      [3] => Array
      (
      [0] => Array
      (
      [nombre_rol] => Ayudante
      [cve_modulo] => 3
      [nombre_modulo] => Comisiones académicas
      )

      )

      [4] => Array
      (
      [0] => Array
      (
      [nombre_rol] => Instructor de prácti
      [cve_modulo] => 2
      [nombre_modulo] => Formación del docente
      )

      [1] => Array
      (
      [nombre_rol] => Instructor de prácti
      [cve_modulo] => 3
      [nombre_modulo] => Comisiones académicas
      )

      )
      )

     * </p>
     */
    function crear_formato_array($array_value, $key_ref, $not_index_auto_incrementables) {
        $array_modulo = array();
        $index = -1;
        if ($not_index_auto_incrementables) {
            /* Le asigna la llave de referencia $key_ref al formato y no le agrega
             * index autoincrementables
             */
            for ($i = 0; $i < count($array_value); $i++) {
                $index = $array_value[$i][$key_ref];
                if (array_key_exists($index, $array_modulo)) {
                    $index_num_siguiente = count($array_modulo[$index]);
                    $array_modulo[$index] = array();
                } else {
                    $array_modulo[$index] = array();
                }
                foreach ($array_value[$i] as $key => $value) {
                    if ($key != $key_ref) {
                        $array_modulo[$index][$key] = $value;
                    }
                }
            }
        } else {
            /* Le  asigna un index auto incrementable que va desde "0" ,...., "n"
              al formato del array */
            for ($i = 0; $i < count($array_value); $i++) {
                $index = $array_value[$i][$key_ref];
                if (array_key_exists($index, $array_modulo)) {
                    $index_num_siguiente = count($array_modulo[$index]);
                    $array_modulo[$index][$index_num_siguiente] = array();
                } else {
                    $index_num_siguiente = 0;
                    $array_modulo[$index][$index_num_siguiente] = array();
                }
                foreach ($array_value[$i] as $key => $value) {
                    if ($key != $key_ref) {
                        $array_modulo[$index][$index_num_siguiente][$key] = $value;
                    }
                }
            }
        }
        return $array_modulo;
    }

}

if (!function_exists('crear_lista_asociativa_valores')) {

    /**
     *
     * @param type : $array_value array de busqueda
     * @param type : $key_ref llave busqueda
     * @param type : $val_ref valor asociación
     * @return type : array
     */
    function crear_lista_asociativa_valores($array_value, $key_ref, $val_ref) {
        $array_lista_roles = array();
        $key = -1;
        $value = '';
        for ($i = 0; $i < count($array_value); $i++) {
            $key = $array_value[$i][$key_ref];
            $value = $array_value[$i][$val_ref];
            $array_lista_roles[$key] = $value;
        }

        return $array_lista_roles;
    }

}

if (!function_exists('get_busca_array_nivel_profundidad_dos')) {

    /**
     *
     * @param type $array_busqueda
     * @param type $controlador
     * @param type $metodo_controlador
     * @param type $llave
     * @return int|array
     */
    function get_busca_array_nivel_profundidad_dos($array_busqueda = null, $controlador = null, $metodo_controlador = 'index', $llave = null) {
        //Si el arreglo es null y vacio, retorna false
//        pr($array_busqueda);
        $array_result = array();
        if (is_null($array_busqueda) AND empty($array_busqueda)) {
            return $array_result;
        }
        //Si el controlador a buscar es vacio, retorna FALSE
        if (is_null($controlador) AND empty($controlador)) {
            return $array_result;
        }
        foreach ($array_busqueda as $value_array_n1) {
            foreach ($value_array_n1 as $key_n2 => $value_array_n2) {
                if (is_array($value_array_n2) AND array_key_exists($llave, $value_array_n2)) {//Verifica que sea un array y que se encuentrá la llave
                    $valor_analizar = $value_array_n2[$llave];
                    if ($valor_analizar === $controlador) {//Si la llave es diferente de null y no es vacia
                        $array_result = $value_array_n2; //Retorna el array encontrado
                        break 2;
                    }
                }
            }
        }

        //Si no existe el controlador, retorna false
        return $array_result;
    }

}

if (!function_exists('get_busca_hijos')) {

    /**
     * @author LEAS
     * @param  type $array_busqueda
     * @param  type $controlador
     * @return array
     */
    function get_busca_hijos($array_busqueda = null, $controlador = null) {
        //Si el arreglo es null y vacio, retorna false
        $array_result = array();
        pr($controlador);
        if (is_null($array_busqueda) AND empty($array_busqueda)) {
            return $array_result;
        }
        pr($array_busqueda);
        foreach ($array_busqueda as $keys => $valores) {
            $cad1 = strtolower($controlador);
//            $cad2 = strtolower($valores['nombre_padre']);
            $cad2 = strtolower($valores['ruta_padre']);
            if (!empty($valores['padre']) AND ( $cad1 === $cad2)) {
                $array_result[$keys] = $valores;
            }
        }

        //Si no existe el controlador, retorna false
        return $array_result;
    }

}

if (!function_exists('get_ip_cliente')) {

    /**
     * @author LEAS
     * @return ip del cliente: obtiene la ip del cliente, por tres tipos de casos,
     * hasta obtener una ip:
     * 1 por IP compartido = HTTP_CLIENT_IP;
     * 2 por IP Proxy = HTTP_X_FORWARDED_FOR;
     * 3 por IP Acceso = REMOTE_ADDR;
     *
     */
    function get_ip_cliente() {
        $ip_cliente = '';
        $conexiones_ip = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR');
        foreach ($conexiones_ip as $value) {
            if (isset($_SERVER[$value]) AND ! empty($_SERVER[$value])) {
                $ip_cliente = $_SERVER[$value];
                break;
            }
        }
        return $ip_cliente;
    }

}

if (!function_exists('get_etiqueta_row')) {

    /**
     * @author LEAS
     * @return designa etiqueta de linea nueva para las vistas html, 
     */
    function get_etiqueta_row($indice = 1, $nueva_linea = false) {
//        pr($indice);
//        pr($indice % 2);
        $array_result = array();
        if ($indice % 2 == 0) {//Es continuación de la fila (par)
            if ($nueva_linea and $indice > 1) {//si es nueva linea y el indice es mayor que 1 
                $array_result['row_begin'] = "</div><br><div class='row'>"; //Etiqueta de inicio de fila 
                $array_result['row_end'] = ""; //Etiqueta de fin de etiqueta 
                $array_result['row_close'] = "</div>";
//                pr($indice);
                $indice ++;
                $array_result['indice'] = $indice;
            } else {
//                pr($indice);
                $array_result['row_begin'] = ""; //Etiqueta de inicio de fila 
                $array_result['row_end'] = "</div>"; //Etiqueta de fin de etiqueta 
                $array_result['row_close'] = "";
                $array_result['indice'] = $indice;
            }
        } else {//Nueva fila impar
            $array_result['row_begin'] = "<br><div class='row'>"; //Etiqueta de inicio de fila 
            $array_result['row_end'] = ""; //Etiqueta de fin de etiqueta 
            $array_result['row_close'] = "</div>";
            $array_result['indice'] = $indice;
        }
        return $array_result;
    }

}

if (!function_exists('get_obtiene_cadena_pajar')) {

    /**
     * @fecha 25/04/2017
     * @author LEAS
     * @return designa etiqueta de linea nueva para las vistas html, 
     */
    function get_obtiene_cadena_pajar($haystack = null, $needle = '$') {
        $pos_ini = strpos($haystack, $needle);
        $pos_fin = strrpos($haystack, $needle);
        if (!empty($pos_ini) and ! empty($pos_fin)) {
            $cadena = substr($haystack, $pos_ini + 1, ($pos_fin - $pos_ini - 1));
//            pr($pos_ini . ' -> ' . $pos_fin . ' = ' . $cadena);
            return $cadena;
        }
        return null;
    }

}

if (!function_exists('crea_directorio')) {

    /**
     * @author LEAS
     * @return Si se crea el satisfactoriamente o existe el directorio retorna true, si no, false, 
     */
    function crea_directorio($ruta) {
//        pr($ruta);
        if (!file_exists($ruta)) {
            return mkdir($ruta); //Si se crea el directorio retorna true, si no, false
        }
        return TRUE; //Indica que si exite el directorio
    }

}

if (!function_exists('get_elementos_lenguaje')) {

    /**
     * @fecha 26/04/2017
     * @author LEAS
     * @return designa etiqueta de linea nueva para las vistas html, 
     */
    function get_elementos_lenguaje($identificadores = array()) {
        $CI = & get_instance();
        $string_values = array();
        foreach ($identificadores as $key => $value) {
            if (is_numeric($key)) {//Valida que sea numerico para buscar el mismo nombre del array con el de archivo
                $CI->lang->load($value, 'spanish');
            } else {
                $CI->lang->load($key, 'spanish');
            }
            $string_values = array_merge($string_values, $CI->lang->line($value));
        }
        return $string_values; //Indica que si exite el directorio
    }

}

if (!function_exists('classe_adicional_tipo_dato')) {

    /**
     * @fecha 04/05/2017
     * @author LEAS
     * @return designa etiqueta de linea nueva para las vistas html, 
     */
    function classe_adicional_tipo_dato($tipo_dato_campo = '', $classe = '') {
        $concat = '';
//        pr($tipo_dato_campo);
        switch ($tipo_dato_campo) {
            case 'date':
                $concat = $classe . ' fecha';
                break;
            default :
                $concat = $classe;
        }
//        pr($concat);
        return $concat;
    }

}

if (!function_exists('get_extencion_archivo_de_nombre')) {

    /**
     * @fecha 07/06/2017
     * @author LEAS
     * @return obtiene la extencion de archivo , 
     */
    function get_extencion_archivo_de_nombre($name_file = '') {
        $partes = explode('.', $name_file); //Rompe en partes
        $count_partes = count($partes);
        if ($count_partes > 0) {
            return $partes[$count_partes - 1]; //Retorna el primer punto, es decir, la extención
        }
        return NULL;
    }

}

if (!function_exists('valida_fecha_inicial_menor_final')) {

    /**
     * @fecha 14/06/2017
     * @author LEAS
     * @param type $fecha_inicial
     * @param type $fecha_final
     * @return False si es mayor la fecha inicial, true si la fecha final el 
     * mayor o igual que la fecha inicial
     */
    function valida_fecha_inicial_menor_final($fecha_inicial, $fecha_final) {
        $date1 = strtotime(str_replace('/', '-', $fecha_inicial));
        $date2 = strtotime(str_replace('/', '-', $fecha_final));
        return ($date2 >= $date1);
    }

}
if (!function_exists('valida_fecha_mayor_actual')) {

    /**
     * @fecha 14/06/2017
     * @author LEAS
     * @param type $fecha_inicial
     * @param type $fecha
     * @return False si es mayor la fecha inicial, true si la fecha final el 
     * mayor o igual que la fecha inicial
     */
    function valida_fecha_mayor_actual($fecha) {
        $now = time();
//        pr($now);
        $date2 = strtotime(str_replace('/', '-', $fecha));
//        pr($date2);
        return ($date2 >= $now);
    }

}

if (!function_exists('startsWith')) {

    /**
     * @fecha 20/06/2017
     * @author Chris
     * @param type $haystack
     * @param type $needle
     * @return False si haystack no comienza igual que needle
     */
    function startsWith($haystack, $needle) {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

}

if (!function_exists('transform_date')) {

    /**
     * @fecha 20/06/2017
     * @author Chris
     * @param type $parametros     
     * @return Arreglo de fechas si parametros es una cadena de arrays
     * String de las fechas si parametros es un array
     */
    function transform_date($parametros = null) {
        $salida = null;
        if ($parametros != null && is_array($parametros)) {
            $iniciales = [];
            $finales = [];
            foreach ($parametros as $key => $value) {

                if (startsWith($key, 'fecha_inicio_')) {
                    $date = date_format(date_create_from_format('d-m-Y', $value), 'Y-m-d');
                    array_push($iniciales, $date);
                }
                if (startsWith($key, 'fecha_fin_')) {
                    $date = date_format(date_create_from_format('d-m-Y', $value), 'Y-m-d');
                    array_push($finales, $date);
                }
            }
            $salida = [];
            $salida[0] = '{' . implode(',', $iniciales) . '}';
            $salida[1] = '{' . implode(',', $finales) . '}';
        } else if ($parametros != null) {
            $parametros = str_replace('{', '', $parametros);
            $parametros = str_replace('}', '', $parametros);
            $salida = explode(',', $parametros);
        }
        return $salida;
    }

}


if (!function_exists('get_date_formato')) {

    /**
     * @fecha 20/06/2017
     * @author Chris
     * @param type $parametros     
     * @return Arreglo de fechas si parametros es una cadena de arrays
     * String de las fechas si parametros es un array
     */
    function get_date_formato($fecha, $formato = 'd-m-Y') {
        return date($formato, strtotime(str_replace("/", "-", $fecha)));
    }

}


if (!function_exists('remove_accents')) {

    /**
     * @author CPMS
     * @date 25/07/2017
     * @param str Palabra a convertir
     * @return Palabra sin acentos y en minusculas
     */
    function remove_accents($str) {
        return strtolower(trim(preg_replace('~[^0-9a-z]+~i', ' ', preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($str, ENT_QUOTES, 'UTF-8'))), ' '));
    }

}

/* End of file general_helper.php */