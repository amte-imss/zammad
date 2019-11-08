<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Menu_model
 *
 * @author chrigarc
 */
class Idioma_model extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_lenguaje($lenguaje_default = 'es', $id_usuario = null, $ip = null) {
        if (!is_null($id_usuario)) {
            $this->db->where('id_usuario', $id_usuario);
        } else {
            if (!is_null($ip)) {
                $this->db->where('ip', $id_usuario);
            }
        }
        $this->db->where('url ', 'gestion_idiomas/modifica_idioma');
        $select = array(
            "id_bitacora", "id_usuario", "valor", "ip", "url"
        );

        $this->db->select($select);
        $this->db->order_by('fecha desc');
        $this->db->limit(1);

        $query = $this->db->get('sistema.bitacora_sipimss');
        $result = $query->result_array();
        $query->free_result();
        if (!empty($result)) {//
            $decode = json_decode($result[0]['valor'], TRUE);
            $lenguaje_default = $decode['language']; //Le asigna el lenguaje registrado en bitacora
        }
        return $lenguaje_default;
    }

    /**
     * @author LEAS
     * @fecha 27/04/2018
     * @param type $idiomas
     * @param type $lenguaje, es el lenguaje en el que se cargara el catálogo
     * @return type
     */
    public function get_idiomas($idiomas = [], $lenguaje = 'es') {
        $this->db->flush_cache();
        $this->db->reset_query();
        $this->db->select(array(
            "g.clave_idioma", "g.nombre idioma"
        ));
        if (!empty($idiomas)) {//Condición de idiomas
            $this->db->where_in('g.clave_idioma', $idiomas);
        }
        $this->db->where('g.activo', true);
        $this->db->order_by('orden, nombre');
        $idioma = $this->db->get('idiomas.idioma g')->result_array();
        $this->db->flush_cache();
        $this->db->reset_query();
        return $idioma;
    }

    public function get_etiquetas_texto($grupos_texto = [], $idioma = 'es') {

        $this->db->flush_cache();
        $this->db->reset_query();
        $this->db->select(array(
            "t.clave_traduccion", "t.clave_tipo", "t.clave_grupo", "t.lang"
        ));
        $this->db->where_in('t.clave_grupo', $grupos_texto);
        $result = $this->db->get('idiomas.traduccion t')->result_array();
        $this->db->flush_cache();
        $this->db->reset_query();
        if (!empty($result)) {
            $language = [];
            foreach ($result as $value) {//Genera agrupaciónes
                if (!isset($language[$value['clave_grupo']])) {//Si no existe, agrega 
                    $language[$value['clave_grupo']] = [];
                }
                $valores = json_decode($value['lang'], true);
                if (isset($valores[$idioma])) {
                    $language[$value['clave_grupo']][$value['clave_traduccion']] = $valores[$idioma]; //Asigna el valor
                } else {
                    $language[$value['clave_grupo']][$value['clave_traduccion']] = ""; //Asigna el valor
                }
            }
            return $language;
        }
        return [];
    }

    public function insert_user_idioma($id_user, $idioma) {
        $this->db->flush_cache();
        $this->db->reset_query();
        $salida = false;
        $this->db->trans_begin();
        $params = array(
            'clave_idioma' => $idioma
        );

        $this->db->where('id_usuario', $id_user);
        $this->db->update('sistema.usuarios', $params);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $salida = false;
        } else {
            $this->db->trans_commit();
            $salida = true;
        }
        $this->db->flush_cache();
        $this->db->reset_query();
        return $salida;
    }
	
	 /**
     * @author LIMA
     * @fecha 27/04/2018
     * @param  $params = []
     * @return $salida
     * Obtiene los Datos del Grid y de la Busqueda que Hace por Filtros
     */
    public function obten_grupo_etiquetas($params = []) 
    {
        $this->db->flush_cache();
        $this->db->reset_query();
        $usuarios = [];
        if(isset($params['total'])) 
           {
              $select = 'count(*) total';
           } else {
              $select = $params['select'];
           }
        $this->db->select($select);
        $this->db->from('idiomas.grupo');    
        if(isset($params['where']))
           {
             foreach($params['where'] as $key => $value)
              {
                $this->db->where($key, $value);
              }
           }
        if(isset($params['like'])) 
           {
             foreach ($params['like'] as $key => $value)
              {
                $this->db->like($key, $value);
              }
           }
        if(isset($params['limit']) && isset($params['offset']) && !isset($params['total'])) 
           {
               $this->db->limit($params['limit'], $params['offset']);
           } else if (isset($params['limit']) && !isset($params['total'])) 
           {
               $this->db->limit($params['limit']);
           }
        if(isset($params['order_by']) && !isset($params['total'])) 
           {
              $order = $params['order_by'] == 'desc' ? $params['order_by'] : 'asc';
              $this->db->order_by('clave_grupo', $order);
            }
        $query = $this->db->get();
        if ($query) {
            $usuarios = $query->result_array();
            $query->free_result(); //Libera la memoria
        }
        //pr($this->db->last_query());
        $this->db->flush_cache();
        $this->db->reset_query();
        return $usuarios;
    }

	 /**
     * @author LIMA
     * @fecha 27/04/2018
     * @param type $tipo = Idiomas::GE, $params = []
     * @return $salida
     * Regresa un Verdadero o Falso segun el proceso
     */
    public function actualizar_grupo_etiqueta($tipo = Idiomas::GE, $params = []) {
        $salida = false;
        switch ($tipo) {
                case Idiomas::GE:
                $salida = $this->actualiza_tabla_grupos_etiquetas($params);
                break;
        }
        return $salida;
    }
	
	  /**
     * @author LIMA
     * @fecha 27/04/2018
     * @param  $params = []
     * @return $salida
     * Regresa un Verdadero o Falso segun el proceso
     */
    private function actualiza_tabla_grupos_etiquetas($params = []) {
   
        $grupo_etiqueta_datos = array('clave_grupo' => $params['clave_grupo'],
                                                    'nombre' => $params['nombre'],
                                               'descripcion' => $params['descripcion']);
        $this->db->trans_begin();
        $this->db->where('clave_grupo',$params['clave_grupo']);
        $this->db->update('idiomas.grupo', $grupo_etiqueta_datos);
        if ($this->db->trans_status() === FALSE) 
           {
                $this->db->trans_rollback();
                $salida = false;
            } else {
                $this->db->trans_commit();
                $salida = true;
           }
        $this->db->flush_cache();
        $this->db->reset_query();
        return $salida;
    }
	
	 public function insertar_grupos_etiquetas($datos_nuevos)
    {
        $this->db->insert('idiomas.grupo', $datos_nuevos);
    }
  

    public function obtener_claves_grupos($params = null) {
        $opciones = array();

        if (isset($params['callback'])) {
            $this->db->where_in('clave_grupo', $params['rules']);
        }

        $this->db->order_by('nombre', 'asc');
        $resultado = $this->db->get('idiomas.grupo');
        $resultado = $resultado->result_array();

        foreach ($resultado as $key => $value) {
            $opciones[$value['clave_grupo']] = $value['nombre'];
        }

        return $opciones;
    }

    public function obtener_tipo_componente($params = null) {
        $opciones = array();

        if (isset($params['callback'])) {
            $this->db->where_in('clave_tipo', $params['rules']);
        }

        $this->db->order_by('nombre', 'asc');
        $resultado = $this->db->get('idiomas.tipo');
        $resultado = $resultado->result_array();

        foreach ($resultado as $key => $value) {
            $opciones[$value['clave_tipo']] = $value['nombre'];
        }

        return $opciones;
    }
}
