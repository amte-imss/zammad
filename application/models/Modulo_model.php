<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Modulo_model
 *
 * @author chrigarc
 */
class Modulo_model extends CI_Model
{

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->config->load('general');
        $this->load->database();
    }

    public function get_modulos($filtros = [], $agrupadas = true, $idioma = null)
    {
        // pr($filtros);
        $this->db->flush_cache();
        $this->db->reset_query();
        $select = array(
            'A.clave_modulo id_modulo', 'A.nombre', 'A.descripcion', 'A.url', 'A.orden'
            , 'A.clave_configurador_modulo id_configurador', 'B.nombre configurador', 'A.modulo_padre_clave modulo_padre_id', 'A.icon'
        );
        $this->db->select($select);
        $this->db->join('sistema.configurador_modulo B', 'B.clave_configurador_modulo = A.clave_configurador_modulo', 'inner');
        $this->db->where('A.activo', true);
        if(isset($filtros['where']))
        {
            foreach ($filtros['where'] as $key => $value)
            {
                $this->db->where($key, $value);
            }
        }
        $this->db->order_by('A.orden');
        $modulos = $this->db->get('sistema.modulos A')->result_array();
        if ($agrupadas)
        {
            $modulos = $this->get_tree($modulos, $idioma);
        }
        return $modulos;
    }

    public function get_modulos_usuario($id_usuario = 0)
    {
        $this->db->flush_cache();
        $this->db->reset_query();
        $select = array(
            'A.clave_modulo id_modulo', 'A.nombre', 'A.descripcion', 'A.url', 'A.orden'
            , 'A.clave_configurador_modulo id_configurador', 'B.nombre configurador', 'A.modulo_padre_clave modulo_padre_id', 'A.icon'
        );
        $this->db->select($select);
        $this->db->join('sistema.configurador_modulo B', 'B.clave_configurador_modulo = A.clave_configurador_modulo', 'inner');
        $this->db->join('sistema.roles_modulos C', ' C.clave_modulo  = A.clave_modulo ', 'inner');
        $this->db->join('sistema.usuario_rol D', 'D.clave_rol = C.clave_rol', 'inner');
        $this->db->where('A.activo', true);
        $this->db->where('C.activo', true);
        $this->db->where('D.activo', true);
        $this->db->where('C.clave_grupo', $id_grupo);
        $this->db->order_by('A.orden');
        $modulos = $this->db->get('sistema.modulos A')->result_array();
    }

    public function get_niveles_acceso($id_modulo = '')
    {
        $this->db->flush_cache();
        $this->db->reset_query();
        $select = array(
            'A.clave_rol id_grupo', 'nombre', 'B.activo'
        );
        $this->db->select($select);
        $this->db->join('sistema.roles_modulos B', " A.clave_rol = B.clave_rol AND B.clave_modulo = '{$id_modulo}'", 'left');
        $this->db->where('A.activo', true);
        $this->db->order_by('A.orden');
        $niveles = $this->db->get('sistema.roles A')->result_array();
        $this->db->reset_query();
        //pr($this->db->last_query());
        return $niveles;
    }

    public function get_usuarios($id_modulo = ''){
        $this->db->flush_cache();
        $this->db->reset_query();
        $select = array(
            'A.id_usuario', 'B.matricula', 'C.add_sub', 'C.activo'
        );
        $this->db->select($select);
        $this->db->join('censo.docente B','B.id_usuario = A.id_usuario', 'inner');
        $this->db->join('sistema.usuarios_modulos C','C.id_usuario = A.id_usuario', 'left');
        $this->db->where('A.activo', true);
        $this->db->where('C.activo', true);
        $this->db->where('C.clave_modulo', $id_modulo);
        $this->db->order_by('B.matricula');
        $usuarios = $this->db->get('sistema.usuarios A')->result_array();
        $this->db->reset_query();
        return $usuarios;
    }

    public function get_configuradores()
    {
        $this->db->flush_cache();
        $this->db->reset_query();
        $select = array(
            'clave_configurador_modulo id_configurador', 'nombre', 'descripcion'
        );
        $this->db->select($select);
        $configuradores = $this->db->get('sistema.configurador_modulo')->result_array();
        return $configuradores;
    }

    public function upsert_usuario($id_usuario = null, $params = [])
    {
        $salida = false;
        $id_modulo = $params['modulo'];
        $activo = $params['activo'];
        $incremento = false;
        if(isset($params['tipo'])){
            $incremento = $params['tipo'] == 1 ? true : false;
        }
        if ($id_usuario != null)
        {
            $this->db->trans_begin();
            $this->db->flush_cache();
            $this->db->reset_query();
            $this->db->select('count(*) cantidad');
            $this->db->start_cache();
            $this->db->where('id_usuario', $id_usuario);
            $this->db->where('clave_modulo', $id_modulo);
            $this->db->stop_cache();
            $existe = $this->db->get('sistema.usuarios_modulos')->result_array()[0]['cantidad'] != 0;
            if ($existe)
            {
                $this->db->set('activo', $activo);
                $this->db->set('add_sub', $incremento);
                $this->db->update('sistema.usuarios_modulos');
            } else
            {
                $this->db->flush_cache();
                $insert = array(
                    'id_usuario' => $id_usuario,
                    'clave_modulo' => $id_modulo,
                    'add_sub' => $incremento,
                    'activo' => $activo
                );
                $this->db->insert('sistema.usuarios_modulos', $insert);
            }
            $this->db->reset_query();
            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
            } else
            {
                $this->db->trans_commit();
                $salida = true;
            }
        }
        return $salida;
    }

    public function upsert_niveles_acceso($niveles_acceso = [], $params = [])
    {
        $salida = false;
        $this->db->trans_begin();
        $id_modulo = $params['modulo'];
        foreach ($niveles_acceso as $nivel)
        {
            $activo = (isset($params['activo' . $nivel['id_grupo']])) ? true : false;
            $this->upsert_modulo_grupo($nivel['id_grupo'], $id_modulo, $activo);
        }
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        } else
        {
            $this->db->trans_commit();
            $salida = true;
        }
        return $salida;
    }

    private function upsert_modulo_grupo($id_grupo = '', $id_modulo = '', $activo = false)
    {
        //pr('[CH][modulo_model][upsert_modulo_grupo] id_grupo: '.$id_grupo.' id_modulo: '.$id_modulo.', conf: '.$configurador.', activo: '.($activo?'true':'false') );
        if ($id_grupo != '0' && $id_modulo != '0')
        {
            $this->db->flush_cache();
            $this->db->reset_query();
            $this->db->select('count(*) cantidad');
            $this->db->start_cache();
            $this->db->where('clave_rol', $id_grupo);
            $this->db->where('clave_modulo', $id_modulo);
            $this->db->stop_cache();
            $existe = $this->db->get('sistema.roles_modulos')->result_array()[0]['cantidad'] != 0;
            if ($existe)
            {
                $this->db->set('activo', $activo);
                $this->db->update('sistema.roles_modulos');
            } else
            {
                $this->db->flush_cache();
                $insert = array(
                    'clave_modulo' => $id_modulo,
                    'clave_rol' => $id_grupo,
                    'activo' => $activo
                );
                $this->db->insert('sistema.roles_modulos', $insert);
            }
            $this->db->reset_query();
//            pr($this->db->last_query());
        }
    }

    public function update($id_modulo = '', &$datos = array())
    {
        $status = false;
        if ($id_modulo != '')
        {
            $this->db->flush_cache();
            $this->db->reset_query();
            $this->db->set('nombre', $datos['nombre']);
            $this->db->set('url', $datos['url']);
            $this->db->set('modulo_padre_clave', (empty($datos['padre'])) ? null : $datos['padre']);
            $this->db->set('orden', $datos['orden']);
            $this->db->set('clave_configurador_modulo', $datos['tipo']);
            $this->db->set('icon', (isset($datos['icono'])) ? $datos['icono'] : null);

            $this->db->where('clave_modulo', $id_modulo);
            $this->db->update('sistema.modulos');
            $status = true;
        }
        return $status;
    }

    public function insert(&$datos = array())
    {
        $status = false;
        $clave_nueva = $this->genera_clave();
        try
        {
            $insert = array(
                'clave_modulo' => $clave_nueva,
                'nombre' => $datos['nombre'],
                'url' => $datos['url'],
                'modulo_padre_clave' => $datos['padre'],
                'orden' => $datos['orden'],
                'clave_configurador_modulo' => $datos['tipo'],
                'icon' => (isset($datos['icono']) ? $datos['icono'] : NULL)
            );
            $this->db->insert('sistema.modulos', $insert);
            $this->upsert_modulo_grupo('SUPERADMIN', $clave_nueva, true);
            $this->db->reset_query();
            $status = true;
        } catch (Exception $e)
        {

        }
        return $status;
    }

    private function genera_clave()
    {
        $this->db->flush_cache();
        $this->db->reset_query();

        $this->load->library('Seguridad');

        $index = 0;
        do
        {
            $tmp = 'M'.$this->seguridad->folio_random(9);
            $this->db->where('clave_modulo', $tmp);
            $cantidad = $this->db->count_all('sistema.modulos A');
            $this->db->last_query();
            $this->db->reset_query();
            $index++;
        } while ($cantidad != 0 && $index < 10);

        $clave_nueva = $tmp;

        $this->db->flush_cache();
        $this->db->reset_query();

        return $clave_nueva;
    }

    private function get_tree($modulos = array(), $idioma = null)
    {
        $niveles_tree = 10;
        $pre_tree = [];
        for ($i = 0; $i < $niveles_tree + 1; $i++)
        {
            foreach ($modulos as $row)
            {
                if (is_null($idioma)) {
                    $row['nombre'] = $row['nombre'];
                } else {
                    $tmp = json_decode($row['nombre'], TRUE);
                    if (isset($tmp[$idioma])) {
                        $row['nombre'] = $tmp[$idioma];
                    }
                }
                if (!isset($pre_tree[$row['id_modulo']]))
                {
                    $pre_tree[$row['id_modulo']] = $row;
                }
                //pr($pre_tree[$row['id_modulo']]);
                if (isset($pre_tree[$row['modulo_padre_id']]) /* && !isset($pre_menu[$row['id_menu_padre']]['childs'][$row['id_menu']]) */)
                {
//                    pr($row['id_modulo']['id_modulo_padre']);
                    $pre_tree[$row['modulo_padre_id']]['childs'][$row['id_modulo']] = $pre_tree[$row['id_modulo']];
                } else
                {
                    //pr($row['id_modulo']['id_modulo_padre']);
                }
                //pr($row);
            }
        }
        $tree = [];
//        pr($pre_tree);

        foreach ($pre_tree as $row)
        {
            if (empty($row['modulo_padre_id']) && !isset($tree[$row['id_modulo']]))
            {
                $tree[$row['id_modulo']] = $row;
            }
        }
        //pr($tree);
        return $tree;
    }

    function check_acceso($url = null, $id_usuario = 0)
    {
        $salida = null;
        if ($id_usuario != '' && $url != null && $url != "")
        {
            $this->db->flush_cache();
            $this->db->reset_query();
            $select = array(
                'A.clave_modulo id_modulo', 'A.nombre  modulo', 'A.url'
            );
            $this->db->select($select);
            $this->db->join('sistema.roles_modulos B', 'B.clave_modulo = A.clave_modulo', 'inner');
            $this->db->join('sistema.usuario_rol C', 'C.clave_rol = B.clave_rol', 'inner');
            $this->db->where('C.id_usuario', $id_usuario);
            $this->db->where('A.activo', true);
            $this->db->where('B.activo', true);
            $this->db->where('C.activo', true);
            $url_d = $url.'/';
            $this->db->where("(A.url = '{$url}' or A.url = '{$url_d}')");
            $result_set = $this->db->get('sistema.modulos A');
            if ($result_set)
            {
                $salida = $result_set->result_array();
            }
        }
        return $salida;
    }
}
