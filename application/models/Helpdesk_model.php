<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Helpdesk_model extends MY_Model {
    /*const NO_SIAP = 'no_siap', SIAP = 'siap', NO_IMSS = 'no_imss';
    const LIMIT = 10, LISTA = 'lista', BASICOS = 'basico', PASSWORD = 'password',
            NIVELES_ACCESO = 'niveles', STATUS_ACTIVIDAD = 'actividad';*/

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function get_delegacion($params=array()) {
        $delegacion = null;
        $this->db->flush_cache();
        $this->db->reset_query();
        if(isset($params['where']) && !is_null($params['where'])) {
            $this->db->where($params['where']);
        }
        $this->db->order_by('nombre');
        $query = $this->db->get('catalogo.delegaciones');
        $delegacion = $query->result_array();
        /*if ($resultado) {
            $delegacion = $resultado[0];
        }*/
        $query->free_result();//pr($delegacion);
        return $delegacion;
    }

    public function get_catalogo($params=array()) {
        $catalogo = array();
        $this->db->flush_cache();
        $this->db->reset_query();
        if(isset($params['where']) && !is_null($params['where'])) {
            $this->db->where($params['where']);
        }
        $this->db->order_by('nombre');
        if(isset($params['table']) && !is_null($params['table'])) {
            $query = $this->db->get($params['table']);
            $catalogo = $query->result_array();

            $query->free_result();//pr($delegacion);
        }        
        
        return $catalogo;
    }

}
