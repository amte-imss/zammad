<?php

/*
 * Cuando escribí esto sólo Dios y yo sabíamos lo que hace.
 * Ahora, sólo Dios sabe.
 * Lo siento.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of LoaderV2
 *
 * @author chrigarc
 */
class LoaderV2 {

    const PAGINA_404 = '/inicio/p404';

    function load() {
        $this->superadmin = false;
        // pr('Hola yo soy el quien decide quien es digno de pasar, muestrame tu valor');
        $this->CI = & get_instance(); //Obtiene la insatancia del super objeto en codeigniter para su uso directo
        $ds = $this->CI->get_datos_sesion();
        if (isset($ds['id_usuario'])) {
            $this->CI->load->model('Sesion_model', 'us');
            $this->roles = array_keys($this->CI->us->get_niveles_acceso($ds['id_usuario'], true));
            $this->superadmin = (in_array('SUPERADMIN', $this->roles));
        }
        //pr($this->CI->uri->rsegment(1));  //Controlador actual o dirección actual
        //pr($this->CI->uri->rsegment(2));  //Controlador actual o dirección actual
        $this->CI->load->model('Modulo_model', 'modulo');
        $modulo = '/' . $this->CI->uri->rsegment(1) . '/' . $this->CI->uri->rsegment(2);
        //pr($modulo);
        if ($modulo != LoaderV2::PAGINA_404 && !$this->superadmin) {
            $filtros['where'] = array('url' => $modulo);
            $modulo = $this->CI->modulo->get_modulos($filtros, false);
//            pr($modulo); exit();
            if (empty($modulo)) {
                redirect('/');
                // pr('error 404');
                // exit(0);
            } else {
                $acceso_false = FALSE;
                foreach ($modulo as $value) {
                    $this->modulo = $value;
                    $acceso_false = $this->checa_permisos_acceso();
                    if ($this->checa_permisos_acceso()) {
                        break;
                    }
                }
                if (!$acceso_false) {
                    redirect('/');
                }
                //$this->bitacora();
            }
        } else if ($this->superadmin) {
            //$this->bitacora();
        }
    }

    private function bitacora() {
        $CI = & get_instance(); //Obtiene la insatancia del super objeto en codeigniter para su uso directo
        $CI->load->library('Bitacora');
        $CI->bitacora->registra_actividad();
    }

    private function checa_permisos_acceso() {

        $permitir_acceso = true;
        switch ($this->modulo['id_configurador']) {
            case 'ACCION':
            case 'MENU':
            case 'MODAL':
                $ds = $this->CI->get_datos_sesion();
                if (isset($ds['id_usuario'])) {
                    $acceso = $this->CI->modulo->check_acceso($this->modulo['url'], $ds['id_usuario']);
//                    pr($acceso);
                    if (!$acceso) {
//                        redirect('/');
                        $permitir_acceso = false;
                    } else {
                        $permitir_acceso = $this->checa_permisos_workflow();
                    }
                } else {
//                    redirect('/');
                    $permitir_acceso = false;
                }
                break;
            default:
                // pr('Casos en los que no se necesita confirmar al usuario');
                break;
        }
        return $permitir_acceso;
    }

    private function checa_permisos_workflow() {
        $acceso = true;
        $ds = $this->CI->get_datos_sesion();
        if (isset($ds['workflow']) && !empty($ds['workflow'])) {
            $w = $ds['workflow'][0];
            $this->CI->load->model('Workflow_model', 'workflow');
            $filtros['roles'] = $this->roles;
            $filtros['id_linea_tiempo'] = $w['id_linea_tiempo'];
            $filtros['clave_modulo'] = $this->modulo['id_modulo'];
            $pw = $this->CI->workflow->get_modulos_etapas($filtros);
            if (!empty($pw)) {
                $acceso = false;
                // pr($pw);
                foreach ($pw as $row) {
                    if ($row['id_etapa'] == $w['id_etapa_activa'] && $row['clave_modulo'] == $this->modulo['id_modulo']) {
                        $acceso = true;
                    }
                }
            }
        }
        if (!$acceso) {
            redirect('/');
        }
        return $acceso;
    }

}
