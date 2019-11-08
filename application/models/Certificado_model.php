<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Certificado_model extends MY_Model {
    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    /*public function get_delegacion($params=array()) {
        $delegacion = null;
        $this->db->flush_cache();
        $this->db->reset_query();
        if(isset($params['where']) && !is_null($params['where'])) {
            $this->db->where($params['where']);
        }
        $this->db->order_by('nombre');
        $query = $this->db->get('catalogo.delegaciones');
        $delegacion = $query->result_array();
        $query->free_result();//pr($delegacion);
        return $delegacion;
    }*/

    public function get_certificado($params=array()) {
        $catalogo = array();
        $this->db->flush_cache();
        $this->db->reset_query();
        
        if(isset($params['select']) && !is_null($params['select'])) {
            $this->db->where($params['select']);
        }
        if(isset($params['where']) && !is_null($params['where'])) {
            $this->db->where($params['where']);
        }
        if(isset($params['order']) && !is_null($params['order'])) {
            $this->db->order_by($params['order']);
        }        
        if(isset($params['table']) && !is_null($params['table'])) {
            $query = $this->db->get($params['table']);
            //pr($this->db->last_query());
            $catalogo = $query->result_array();

            $query->free_result();//pr($delegacion);
        }
        
        return $catalogo;
    }

}
