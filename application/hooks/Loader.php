<?php

/*
 * Cuando escribí esto sólo Dios y yo sabíamos lo que hace.
 * Ahora, sólo Dios sabe.
 * Lo siento.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of HBitacora
 *
 * @author chrigarc
 */
class Loader
{

    function load()
    {
        $this->bitacora();
        $this->acceso();
        // $this->notificaciones();
    }

    private function acceso()
    {
        $CI = & get_instance(); //Obtiene la insatancia del super objeto en codeigniter para su uso directo
//        echo $CI->load->view('template/sin_acceso', $datos_, true);
//        return json_encode($array_result);
        $CI->load->helper('url');
        $CI->load->library('session');

        $controlador = $CI->uri->rsegment(1);  //Controlador actual o dirección actual
        $accion = $CI->uri->rsegment(2);  //Función que se llama en el controlador

        $url = $controlador . '/' . $accion;

        if (true) //cambiar para localizar modulos de libre acceso como login
        {
            $usuario = $CI->session->userdata('usuario');
//            pr($usuario);
            if (isset($usuario['id_usuario']))
            {
                if (!$this->verifica_permiso($CI, $usuario))
                {
                   // redirect(site_url());
                }
            } else
            {
               // redirect(site_url());
            }
        }
    }

    private function verifica_permiso($CI, $usuario)
    {
        $controlador = $CI->uri->rsegment(1);  //Controlador actual o dirección actual
        $accion = $CI->uri->rsegment(2);  //Función que se llama en el controlador
        $url = '/' . $controlador . '/' . $accion;
        $CI->load->model('Modulo_model', 'modulos');
        $modulo = $CI->modulos->check_acceso($url, $usuario['id_usuario']);
        $is_index = null;
        if ($accion == 'index')
        {
            $is_index = $CI->modulos->check_acceso('/' . $controlador, $usuario['id_usuario']);
        }
//        pr($url);
//        pr($modulo);
//        pr($is_index);
       // return $modulo != null || $is_index != null || $url == '/welcome/dashboard';
        return true;
    }

    private function bitacora()
    {
        $CI = & get_instance(); //Obtiene la insatancia del super objeto en codeigniter para su uso directo
        $CI->load->library('Bitacora');
        $CI->bitacora->registra_actividad();
    }

    private function notificaciones()
    {
        $CI = & get_instance(); //Obtiene la insatancia del super objeto en codeigniter para su uso directo
        $CI->load->model('Notificacion_model', 'notificacion');
        $params = [];
        $CI->notificacion->get_notificaciones_usuario($params);
    }

}
