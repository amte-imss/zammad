<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author: LEAS
 * @version: 1.0
 * @desc: Clase padre de los controladores del sistema
 * */
class MY_Controller extends CI_Controller {

    protected $language_text = []; //Textos actuales de texto
    protected $grupo_language_text = []; //Grupos de texto actuales del controlador
    private $grupo_language_text_generales = ['template_general', 'generales']; //Grupos de texto actuales del controlador

    function __construct() {
        parent::__construct();
        $this->initialization();
    }

    private function initialization() {
        $this->load->config('general');
        $this->load->model('Idioma_model', 'idioma');

        if (!is_null($this->session->flashdata('limpiar_post_update_lenguaje')) && $this->session->flashdata('limpiar_post_update_lenguaje')) {
            $_POST = array(); //Limpiar post
        }
        $usuario = $this->get_datos_sesion(En_datos_sesion::ID_USUARIO);
//        $usuario_ = $this->get_datos_sesion();
//        pr($usuario_);

        $this->load->model('Menu_model', 'menu');
        $menu['lateral_no_sesion'] = $menu['lateral'] = null;
        if (!is_null($usuario)) {
            $data['usuario'] = $this->get_datos_sesion();
            $menu = $this->menu->get_menu_usuario($usuario, false);
            if (isset($data['usuario']) && !empty($data['usuario'])) {
                $this->load->model('Sesion_model', 'sesion');
            }
            $menu['lateral'] = $this->menu->get_tree($menu['lateral'], null, $this->obtener_idioma());
            $this->template->setNav($menu);
        } else {
            $menu = $this->menu->get_menu_no_sesion();
            $menu['lateral_no_sesion'] = $this->menu->get_tree($menu['lateral_no_sesion'], null, $this->obtener_idioma());
            $this->template->setNav($menu);
        }
        //Selecciona el lenguaje del usuario actual
        $lenguaje = $this->obtener_idioma();
        if (is_null($lenguaje)) {//Si no existe el lenguaje, lo modifica
            $lenguaje = 'es';
//                        $this->idioma->get_lenguaje(En_datos_sesion::LANGUAGE_DEFAULT, $data['usuario'][En_datos_sesion::ID_USUARIO], null);
        }
        //Asignar idioma al sistema
        update_lenguaje_sistema($lenguaje);
        $this->grupo_language_text = array_merge($this->grupo_language_text_generales, $this->grupo_language_text); //Agrega el grupo generales
        $this->language_text = $this->obtener_grupos_texto($this->grupo_language_text, $lenguaje);
        $this->template->setLanguageText($this->language_text);
        $this->template->setLang($lenguaje);
//        pr($this->language_text);
    }

    private function carga_imagen() {
        //carga datos de imagen del docente
    }

    protected function genera_menu() {
        $menu['elementos_menu'] = array(
            1 => array('name_act' => 'Perfil', 'ruta' => 'perfil', 'imagen' => '2.png', 'class' => 'mt'), //mt
            //  1 => array('name_act' => 'Información general', 'ruta' => 'info_gral/mostrar/311091488', 'icono' => 'fa fa-user-md', 'class' => 'sub-menu'), //mt
            2 => array('name_act' => 'Información docente', 'ruta' => 'informacion_imss', 'imagen' => '3.png', 'class' => ''), //mt
            3 => array('name_act' => 'Formación docente', 'ruta' => 'formacion_docente', 'imagen' => '10.png', 'class' => ''),
            4 => array('name_act' => 'Actividad docente', 'ruta' => 'actividad_docente', 'imagen' => '4.png', 'class' => ''),
            5 => array('name_act' => 'Becas', 'ruta' => 'becas_comisiones', 'imagen' => '5.png', 'class' => ''),
            6 => array('name_act' => 'Comisiones', 'ruta' => 'comisiones_academicas', 'imagen' => '6.png', 'class' => ''),
            7 => array('name_act' => 'Dirección de tésis', 'ruta' => 'direccion_tesis', 'imagen' => '9.png', 'class' => ''),
            8 => array('name_act' => 'Material educativo', 'ruta' => 'material_educativo', 'imagen' => '7.png', 'class' => ''),
            9 => array('name_act' => 'Investigación', 'ruta' => 'investigacion', 'imagen' => '8.png', 'class' => ''),
        );
        $this->template->setNav($menu);
    }

    public function new_crud() {
        $db_driver = $this->db->platform();
        $model_name = 'Grocery_crud_model_' . $db_driver;
        $model_alias = 'm' . substr(md5(rand()), 0, rand(4, 15));
        unset($this->{$model_name});
        $this->load->library('grocery_CRUD');
        $crud = new Grocery_CRUD();
        if (file_exists(APPPATH . '/models/' . $model_name . '.php')) {
            $this->load->model('Grocery_crud_model');
            $this->load->model('Grocery_crud_generic_model');
            $this->load->model($model_name, $model_alias);
            $crud->basic_model = $this->{$model_alias};
        }
        $crud->set_theme('datatables');
        $crud->unset_print();
        return $crud;
    }

    /**
     *
     * @param type $busqueda_especifica
     * @return int
     * @obtiene el array de los datos de
     */
    public function get_datos_sesion($busqueda_especifica = '*') {
        if (isset($this->session->userdata(En_datos_sesion::__INSTANCIA)['usuario'])) {
            $data_usuario = $this->session->userdata(En_datos_sesion::__INSTANCIA)['usuario'];
//        $data_usuario = array(En_datos_sesion::ID_DOCENTE =>1,  En_datos_sesion::MATRICULA=>'311091488');
            if ($busqueda_especifica == '*') {
                return $data_usuario;
            } else {
                if (isset($data_usuario[$busqueda_especifica])) {
                    return $data_usuario[$busqueda_especifica];
                }
            }
        }
        return NULL; //No se encontro  una llave especifica o la session caduco
    }

    /**
     * @author LEAS
     * @param type $configuracion Lllave de configuración para la carga de archivo
     * (archivo general de configuraciones) el cual incluye upload_path, allowed_types,
     *  remove_spaces, max_size, detect_mime, file_name
     * @param type $carpeta Nombre del directorio donde se almacenará el archivo
     * @param type $nombre_file Nombre del archivo despues de guardado
     * @return type
     */
    protected function save_file($configuracion, $carpeta, $nombre_file, $key_name_file = 'userfile') {
        if ($_FILES && $this->input->post()) {
            $string_value = get_elementos_lenguaje(array(En_catalogo_textos::GUARDAR_ACTUALIZAR));
//            $data = $this->input->post(null, true);
            $config = $this->colocar_configuracion($configuracion, $carpeta, $nombre_file); ///Obtener configuración para carga de archivo
//            pr($config);
            $this->load->library('upload', $config); ///Librería que carga y valida(peso, extensión) los archivos
//            pr($key_name_file);
//            pr($_FILES);
            if (!$this->upload->do_upload($key_name_file)) {
                return array('tp_msg' => En_tpmsg::DANGER, 'mensaje' => $this->upload->display_errors());
            } else {
                $data_file_complete = $this->upload->data();
                return array('tp_msg' => En_tpmsg::SUCCESS,
                    'mensaje' => $string_value['guardo_file'],
                    'upload_path' => $config['upload_path'],
                    'raw_name' => $data_file_complete['raw_name'], //Nombre real del archivo
                );
            }
        }
    }

    /**
     * @author LEAS
     * @param type $ruta Ruta hasta el directorio donde se encuentra el archivo
     * @param type $nombre_file Nombre del fichero, si el nombre contiene la extención del archivo, entonces extención debe ser NULL
     * si no, indicar la extención del archivo
     * @param type $extencion exteción del archivo, si el nombre del archivo contene la extención, la variable debe de ser NULL
     * @return boolean True si el archivo no existe o si se elimino correctamente
     */
    protected function delete_file($ruta, $nombre_file, $extencion = null) {
        if (is_null($extencion)) {//La extención viene explicito con el nombre del archivo
            $file_nombre_ = '.' . $ruta . $nombre_file;
        } else {//Valida que la extencion exista para concatenar con el nombre del archivo
            $file_nombre_ = '.' . $ruta . $nombre_file . '.' . $extencion;
        }
//        pr($file_nombre_);
        if (file_exists($file_nombre_)) {//Valida que exista el archivo
            return unlink($file_nombre_); //elmina el fichero anterior, despues de guardar la información anterior
        }
        return true;
    }

    private function colocar_configuracion($key_config = 'comprobantes', $carpeta = null, $nombre_archivo = null) {
//        [$configuracion]; //Obtener parámetros definidos en archivo general de configuración
        $configuracion_carga = $this->config->item('upload_config')[$key_config]; //Obtener parámetros definidos en archivo general de configuración
        $ruta = $configuracion_carga['upload_path']; ///Obtener path para carga de archivos
//        pr($ruta);
        if (crea_directorio($ruta . $carpeta)) {//Valida que se creo el directorio de almacenar files del docente o comprobante
            $ruta_archivos = $ruta . $carpeta . "/"; ///Definir ruta de almacenamiento, se utiliza la matricula

            $nombre_archivo_real = (!is_null($nombre_archivo)) ?
                    $nombre_archivo :
                    $this->session->userdata('matricula') . '_' . time();

            $config['carpeta'] = $carpeta;
            $config['path_simple'] = $ruta;
            $config['upload_path'] = $ruta_archivos;
            $config['allowed_types'] = $configuracion_carga['allowed_types'];
            $config['max_size'] = $configuracion_carga['max_size']; // Definir tamaño máximo de archivo
            $config['detect_mime'] = $configuracion_carga['detect_mime']; // Validar mime type
            $config['file_name'] = $nombre_archivo_real; ///Renombrar archivo

            return $config;
        }
    }

    /**
     *
     * @param type $file
     */
    public function ver_archivo($file = null) {
        //$string_values = get_elementos_lenguaje(array(En_catalogo_textos::COMPROBANTE));
        if (is_null($file)) {
            $data_error['heading'] = $this->language_text['generales']['error_404_generales'];
            $data_error['message'] = $this->language_text['generales']['archivo_inexistente_generales'];
            echo $this->load->view('errors/html/error_404.php', $data_error, TRUE);
            exit();
        }
        if (!is_null($file)) {
            $file_id = decrypt_base64($file); ///Decodificar url, evitar hack
            //pr($file_id);
            $this->load->model("Files_model", "fm");
            $result_file = $this->fm->get_file($file_id); //Se valida que exista registro en base de datos
            //pr($result_file);
            if (!empty($result_file)) {
//                $ruta_archivo = base_url($result_file[0]['ruta'] . $result_file[0]['nombre_fisico'] . '.' . $result_file[0]['nombre_extencion']);
                //$ruta_archivo = '.' . $result_file[0]['ruta'] . $result_file[0]['nombre_fisico'];
                $ruta_archivo = $result_file[0]['ruta'] . $result_file[0]['nombre_fisico'];
                if (file_exists($ruta_archivo)) {
                    $ext = pathinfo($archivo[0]['COM_NOMBRE'], PATHINFO_EXTENSION);
                    header('Content-Description: File Transfer');
                    if ($ext != $this->config->item('upload_config')['comprobantes']['allowed_types']) {
                        header('Content-Type: application/octet-stream');
                    } else {
                        header('Content-type: application/pdf');
                    }
                    header('Content-Disposition: inline; filename="' . $result_file[0]['nombre_fisico'] . '"');
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($ruta_archivo));
                    ob_clean();
                    flush();
                    //readfile($ruta_archivo);
                    echo file_get_contents($ruta_archivo);
                    exit;
                }
            } else {
                $html = '<div role="alert" class="alert alert-success" style="padding:25px; margin-bottom:80px;"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><h4>' . $this->string_values['general']['archivo_inexistente'] . '</h4></div>';
            }
        }
        if (isset($html)) {
            $this->template->setMainContent($html);
            $this->template->getTemplate();
        }
    }

    /**
     *
     * @param type $file
     */
    /* public function ver_archivo($file = null) {
      //        $string_values = get_elementos_lenguaje(array(En_catalogo_textos::COMPROBANTE));
      if (is_null($file)) {
      $data_error['heading'] = $this->language_text['generales']['error_404_generales'];
      $data_error['message'] = $this->language_text['generales']['archivo_inexistente_generales'];
      echo $this->load->view('errors/html/error_404.php', $data_error, TRUE);
      exit();
      }

      $file_id = decrypt_base64($file); ///Decodificar url, evitar hack
      $this->load->model("Files_model", "fm");
      $result_file = $this->fm->get_file($file_id); //Se valida que exista registro en base de datos
      if (!empty($result_file)) {

      $ruta_archivo =$result_file[0]['ruta'] . $result_file[0]['nombre_fisico'];
      if (file_exists($ruta_archivo)) {
      //                pr('entra');
      //$main_content = $this->load->view('template/pdfjs/viewer', array('ruta_archivo'=>$ruta_archivo), true);
      $url = base_url($ruta_archivo);
      $this->load->view('tc_template/pdfjs/viewer.php', array('ruta_archivo' => $url), false);
      //                pr($main_content);
      } else {
      $data_error['heading'] = 'error_404';
      $data_error['message'] = 'archivo_inexistente';
      echo $this->load->view('errors/html/error_404.php', $data_error, TRUE);
      exit();
      }
      } else {
      $html = '<div role="alert" class="alert alert-success" style="padding:25px; margin-bottom:80px;"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><h4>' . $this->language_text['generales']['archivo_inexistente_generales'] . '</h4></div>';
      }
      if (isset($html)) {
      $this->template->setMainContent($html);
      $this->template->getTemplate();
      }
      } */

    /**
     *
     * @param type $file
     */
    public function descarga_archivo($file = null) {
        $string_values = get_elementos_lenguaje(array(En_catalogo_textos::COMPROBANTE));
        if (is_null($file)) {
            $html = '<div role="alert" class="alert alert-success" style="padding:25px; margin-bottom:80px;"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><h4>' . $string_values['archivo_incorrecto'] . '</h4></div>';
            exit();
        }

        if (!is_null($file)) {
            $file_id = decrypt_base64($file); ///Decodificar url, evitar hack
//            pr($file);
            $this->load->model("Files_model", "fm");
            $result_file = $this->fm->get_file($file_id); //Se valida que exista registro en base de datos
            if (!empty($result_file)) {
//                $ruta_archivo = base_url($result_file[0]['ruta'] . $result_file[0]['nombre_fisico'] . '.' . $result_file[0]['nombre_extencion']);
                $ruta_archivo = '.' . $result_file[0]['ruta'] . $result_file[0]['nombre_fisico'] . '.' . $result_file[0]['nombre_extencion'];
                if (file_exists($ruta_archivo)) {
                    $ext = pathinfo($archivo[0]['COM_NOMBRE'], PATHINFO_EXTENSION);
                    header('Content-Description: File Transfer');
                    if ($ext != $this->config->item('upload_config')['comprobantes']['allowed_types']) {
                        header('Content-Type: application/octet-stream');
                    } else {
                        header('Content-type: application/pdf');
                    }
//                    if ($descarga == true) { ///Descargar
//                        header('Content-Disposition: attachment; filename="' . $archivo[0]['COM_NOMBRE'] . '"');
//                    } else { ///Ver en línea
//                    }
                    header('Content-Disposition: inline; filename="' . $result_file[0]['nombre_fisico'] . '.' . $result_file[0]['nombre_extencion'] . '"');
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($ruta_archivo));
                    ob_clean();
                    flush();
                    //readfile($ruta_archivo);
                    echo file_get_contents($ruta_archivo);
                    exit;
                }
            } else {
                $html = '<div role="alert" class="alert alert-success" style="padding:25px; margin-bottom:80px;"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><h4>' . $this->string_values['general']['archivo_inexistente'] . '</h4></div>';
            }
        }
        if (isset($html)) {
            $this->template->setMainContent($html);
            $this->template->getTemplate();
        }
    }

    /**
     *
     * @param array $columnas Nombre de las columnas en el archivo
     * @param type $informacion Información o datos de la exportación
     * @param type $orden_columna Orden de las columnas
     * @param type $file_name Nombre del archivo exportado
     * @param type $delimiter delimitador del csv, por default será ","
     * @return type Descriptión documento a exportado ceon extención csv
     */
    protected function exportar_xls($columnas = null, $informacion = null, $column_unset = null, $orden_columna = null, $file_name = 'tmp_file_export_data', $delimiter = ',') {//$id_ciclo_evaluacion,$status,$filename
        header("Content-Encoding: UTF-8");
        header("Content-type: application/x-msexcel;charset=UTF-8");
        header('Content-Disposition: attachment; filename="' . $file_name . '.csv";');

        $f = fopen('php://output', 'w');

        fputs($f, $bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
        fputcsv($f, $columnas, $delimiter);

        //pr($info);
        if (!is_null($orden_columna)) {
            foreach ($informacion as $line) {

                $column = [];
                foreach ($orden_columna as $genera) {//Recorre las columnas extra que no se imprimen
                    if (isset($line[$genera])) {
                        $column[] = $line[$genera]; //Elimina colunas extra
                    } else {
                        $column[] = ' '; //Elimina colunas extra
                    }
                }
                fputcsv($f, $column, $delimiter);
            }
        } else {
            foreach ($informacion as $line) {
                if (!is_null($column_unset)) {

                    foreach ($column_unset as $val_unset) {//Recorre las columnas extra que no se imprimen
                        unset($line[$val_unset]);
                    }
                }
                fputcsv($f, $line, $delimiter);
            }
        }
        fclose($f);
    }

    /**
     *
     * */
    public function prepara_filtros($array = [], $map = [], $omitir = []) {
        $salida = array();
        $omitidos = array('pageIndex', 'pageSize', 'sortField', 'sortOrder');
        foreach ($map as $key => $value) {
            if (isset($array[$key]) && !is_null($array[$key]) && $array[$key] != '') {
                $salida[$value] = $array[$key];
            }
        }
        return $salida;
    }

    /**
     *
     * @return type
     * @author LEAS
     */
    protected function obtener_idioma() {
        return obtener_lenguaje_actual();
    }

    protected function obtener_grupos_texto($grupos, $lenguaje) {
        $grupos_textos = $this->idioma->get_etiquetas_texto($grupos, $lenguaje);
        return $grupos_textos;
    }

    /**
     * @param type $name Description
     * @param type $grupos
     * @param type $lenguaje
     */
    protected function set_textos_campos_validacion(&$array_validacion, $array_textos, $field = 'field', $label = 'label') {
//        pr($array_validacion);
//        pr($array_textos);
        foreach ($array_validacion as &$value) {
            if (isset($array_textos[$value[$field]])) {
                $campo = str_replace(":", "", $array_textos[$value[$field]]); //Elimina caracteres de dos puntos
                $value[$label] = $campo; //Modifica el texto de las validaciones
            }
        }
    }

//    public function obtener_catalogo_idiomas($idiomas, $lenguaje) {
////        $catalogo_idiomas = $this->idioma->get_idiomas($idiomas, $lenguaje);
//        $catalogo_idiomas = ['es' => 'Español', 'en' => 'Inglish'];
//        return $catalogo_idiomas;
//    }
}

//include_once APPPATH . 'core/General_revision.php';
//include_once APPPATH . 'core/General_reportes.php';
