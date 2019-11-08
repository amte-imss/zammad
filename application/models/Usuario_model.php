<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends MY_Model {

    const NO_SIAP = 'no_siap', SIAP = 'siap', NO_IMSS = 'no_imss';
    const LIMIT = 10, LISTA = 'lista', BASICOS = 'basico', PASSWORD = 'password',
            NIVELES_ACCESO = 'niveles', STATUS_ACTIVIDAD = 'actividad';

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    /**
     * @author LEAS
     * @fecha 02/05/2018
     * @param type $parametros
     * @param type $tipo
     * @return boolean
     */
    public function nuevo(&$parametros = null, $tipo = Usuario_model::SIAP, $language_text = null) {
        $salida['msg'] = $language_text['registro_usuario']['user_registro_problem'];
        $salida['result'] = false;
        switch ($tipo) {
            case Usuario_model::SIAP:
                $this->nuevo_siap($parametros, $salida, $language_text);
                break;
            case Usuario_model::NO_SIAP:
                $this->nuevo_no_siap($parametros, $salida);
                break;
            case Usuario_model::NO_IMSS://Externos
                $this->nuevo_no_imss($parametros, $salida, $language_text);
                break;
        }
        return $salida;
    }

    /*     * *
     * Array
      (
      [ext_nombre] =>
      [ext_ap] =>
      [ext_am] =>
      [ext_sexo] => M
      [ext_mail] =>
      [telefono] =>
      [pais_origen] =>
      [pais_institucion] =>
      [institucion] =>
      [reg_password] =>
      [reg_repassword] =>
      [reg_captcha] =>
      )
     */

    private function nuevo_no_imss(&$parametros, &$salida, $language_text) {
        $token = $this->seguridad->folio_random(10, TRUE);
        $pass = $this->seguridad->encrypt_sha512($token . $parametros['password'] . $token);
        $params['where'] = array(
            'usuarios.email' => $parametros['email'],
        );
        $params['informacion_docente'] = false;
        $usuario_db = count($this->get_usuarios($params)) == 0;
        if ($usuario_db) {
            $data['usuario'] = array(
                'password' => $pass,
                'token' => $token,
                'username' => null,
                'email' => $parametros['email'],
                'clave_idioma' => $parametros['idioma']
            );
            $data['informacion_usuario'] = array(
                'email' => $parametros['email'],
                'matricula' => null,
                'nombre' => $parametros['nombre'],
                'apellido_paterno' => $parametros['apellido_paterno'],
                'apellido_materno' => $parametros['apellido_materno'],
                'sexo' => $parametros['sexo'],
                'es_imss' => FALSE,
                'activo' => true,
                'clave_pais' => $parametros['pais_origen'],
                'pais_institucion' => $parametros['pais_institucion'],
                'institucion' => $parametros['institucion'],
                'telefono_personal' => $parametros['telefono_personal'],
                'telefono_oficina' => $parametros['telefono_oficina'],
            );
            $salida = $this->insert_guardar($data, $parametros['grupo'], $language_text);
//            if ($salida['result'] && isset($parametros['registro_usuario'])) {
//                $this->load->model('Plantilla_model', 'plantilla');
//                //$this->plantilla->send_mail(Plantilla_model::BIENVENIDA_REGISTRO, $parametros);
//            }
        } else if (!$usuario_db) {
            $salida['msg'] = 'Usuario ya registrado';
        }
    }

    private function nuevo_siap(&$parametros, &$salida, $language_text) {
        // pr($parametros);
        $token = $this->seguridad->folio_random(10, TRUE);
        $pass = $this->seguridad->encrypt_sha512($token . $parametros['password'] . $token);
        $usuario = $this->empleados_siap->buscar_usuario_siap($parametros['delegacion'], $parametros['matricula'])['empleado'];
//        pr($usuario);
        $params['where'] = array(
            'username' => $parametros['matricula']
        );
        $usuario_db = count($this->get_usuarios($params)) == 0;
        // pr($parametros);
        // pr($this->db->last_query());
        if ($usuario && $usuario_db) {
            $unidad_instituto = $this->get_unidad($usuario['adscripcion'][0]);
            $categoria = $this->get_categoria($usuario['emp_keypue'][0]);
            if ($unidad_instituto == null) {
                $unidad_instituto = $this->localiza_unidad($usuario['adscripcion'][0]);
            }
            if ($unidad_instituto == null) {
                $unidad_instituto['clave_departamental'] = $usuario['adscripcion'][0];
            }
            if ($unidad_instituto != null) {
                $data['usuario'] = array(
                    'password' => $pass,
                    'token' => $token,
                    'username' => $parametros['matricula'],
                    'email' => $parametros['email'],
                    'clave_idioma' => $parametros['idioma']
                );
                $data['informacion_usuario'] = array(
                    'email' => $parametros['email'],
                    'matricula' => $parametros['matricula'],
                    'nombre' => $usuario['nombre'][0],
                    'apellido_paterno' => $usuario['paterno'][0],
                    'apellido_materno' => $usuario['materno'][0],
                    'curp' => $usuario ['curp'],
                    'sexo' => $usuario['sexo'],
                    'rfc' => $usuario['rfc'][0],
                    'es_imss' => true,
                    'activo' => true,
                    'status_siap' => $usuario['status'][0],
                    'clave_pais' => $parametros['pais_origen'],
//                    'pais_institucion' => $parametros['pais_institucion'],
//                    'institucion' => $parametros['institucion'],
                    'telefono_personal' => $parametros['telefono_personal'],
                    'telefono_oficina' => $parametros['telefono_oficina'],
                    'clave_delegacional' => $parametros['delegacion'],
                );
                $data['historico_informacion_usuario'] = array(
                    'actual' => true,
                    'id_categoria' => $categoria['id_categoria'],
                    'clave_departamental' => $unidad_instituto['clave_departamental']
                );
                //pr($data);
                $salida = $this->insert_guardar($data, $parametros['grupo'], $language_text);
//                if ($salida['result'] && isset($parametros['registro_usuario'])) {
//                    $this->load->model('Plantilla_model', 'plantilla');
                //$this->plantilla->send_mail(Plantilla_model::BIENVENIDA_REGISTRO, $parametros);
//                }
                $salida['siap'] = $data;
            } else {
                $salida['msg'] = $language_text['registro_usuario']['adscripcion_no_encontrada'];
            }
        } else if (!$usuario_db) {
            $salida['msg'] = $language_text['registro_usuario']['user_ya_registrado'];
        } else if (!$usuario) {
            $salida['msg'] = $language_text['registro_usuario']['user_no_encontrado_siap'];
        }
    }

    private function nuevo_no_siap(&$parametros, &$salida, $language_text) {
        $token = $this->seguridad->folio_random(10, TRUE);
        $pass = $this->seguridad->encrypt_sha512($token . $parametros['password'] . $token);
        $params['where'] = array(
            'username' => $parametros['matricula']
        );
        $usuario_db = count($this->get_usuarios($params)) == 0;
        if ($usuario_db) {
            $unidad_instituto = $this->get_unidad($parametros['clave_departamental']);
            $categoria = $this->get_categoria($parametros['categoria']);
            if ($unidad_instituto != null) {
                $data['usuario'] = array(
                    'password' => $pass,
                    'token' => $token,
                    'username' => $parametros['matricula'],
                    'email' => $parametros['email']
                );
                $data['docente'] = array(
                    'email' => $parametros['email'],
                    'matricula' => $parametros['matricula'],
                    'nombre' => $parametros['nombre'],
                    'apellido_p' => $parametros['paterno'],
                    'apellido_m' => $parametros['materno'],
                    'curp' => $parametros ['curp'],
                    'sexo' => $parametros['sexo'],
                    'rfc' => $parametros['rfc'],
                    'status_siap' => 1
                );
                $data['historico'] = array(
                    'actual' => 1,
                    'id_categoria' => $categoria['id_categoria'],
                    'clave_departamental' => $unidad_instituto['clave_departamental']
                );
                //pr($data);
                $salida = $this->insert_guardar($data, $parametros['grupo'], $language_text);
                if ($salida['result'] && isset($parametros['registro_usuario'])) {
                    $this->load->model('Plantilla_model', 'plantilla');
                    //$this->plantilla->send_mail(Plantilla_model::BIENVENIDA_REGISTRO, $parametros);
                }
                $salida['siap'] = $data;
            } else {
                $salida['msg'] = $language_text['registro_usuario']['adscripcion_no_encontrada'];
            }
        } else if (!$usuario_db) {
            $salida['msg'] = $language_text['registro_usuario']['user_ya_registrado'];
        }
    }

    private function get_unidad($clave) {
        $unidad = null;
        $this->db->flush_cache();
        $this->db->reset_query();
        $this->db->where('clave_departamental', $clave);
        $query = $this->db->get('catalogo.departamento');
        $resultado = $query->result_array();
        if ($resultado) {
            $unidad = $resultado[0];
        }
        $query->free_result();
        return $unidad;
    }

    private function get_categoria($clave) {
        $categoria = null;
        $this->db->flush_cache();
        $this->db->reset_query();
        $this->db->where('clave_categoria', $clave);
        $query = $this->db->get('catalogo.categorias');
        $resultado = $query->result_array();
        if ($resultado) {
            $categoria = $resultado[0];
        }
        $query->free_result();
        return $categoria;
    }

    private function get_departamento($clave) {
        $categoria = null;
        $this->db->flush_cache();
        $this->db->reset_query();
        $this->db->where('clave_departamental', $clave);
        $query = $this->db->get('catalogo.departamento');
        $resultado = $query->result_array();
        if ($resultado) {
            $categoria = $resultado[0];
        }
        $query->free_result();
        return $categoria;
    }

    /**
     *
     * @param type $datos usuario
      informacion_usuario
      historico_informacion_usuario
     * @param type $id_grupo
     * @return type
     */
    private function insert_guardar(&$datos, $id_grupo, $language_text = null) {
        $this->db->flush_cache();
        $this->db->reset_query();
        $this->db->trans_begin(); //Definir inicio de transacción

        $this->db->insert('sistema.usuarios', $datos['usuario']); //nombre de la tabla en donde se insertaran

        $id_usuario = $this->db->insert_id();
        $docente = $this->get_informacion_usuario($datos['usuario']['username']);
        // pr($docente);

        if (!is_null($docente)) {
            if (isset($datos['informacion_usuario'])) {
                $datos['informacion_usuario']['id_usuario'] = $id_usuario;
//                $datos['usuario']['id_docente'] = $docente['id_informacion_usuario'];
                $this->db->where('id_informacion_usuario', $docente['id_informacion_usuario']);
                $this->db->update('sistema.informacion_usuario', $datos['informacion_usuario']);
                $this->db->reset_query();
            }
        } else if (isset($datos['informacion_usuario'])) {
            $datos['informacion_usuario']['id_usuario'] = $id_usuario;
            $this->db->insert('sistema.informacion_usuario', $datos['informacion_usuario']);
            $docente['id_informacion_usuario'] = $this->db->insert_id();
        }

        $data = array(
            'clave_rol' => $id_grupo,
            'id_usuario' => $id_usuario
        );
        $this->db->insert('sistema.usuario_rol', $data);
        if (isset($datos['historico_informacion_usuario'])) {
            $this->db->reset_query();
            $this->db->where('id_informacion_usuario', $docente['id_informacion_usuario']);
            $this->db->set('actual', FALSE);
            $this->db->update('sistema.historico_informacion_usuario');
            $this->db->reset_query();
            $datos['historico_informacion_usuario']['id_informacion_usuario'] = $docente['id_informacion_usuario'];
            $this->db->insert('sistema.historico_informacion_usuario', $datos['historico_informacion_usuario']);
            //pr($this->db->last_query());
            //pr($datos);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $resultado['result'] = FALSE;
            $resultado['msg'] = $language_text['registro_usuario']['user_registro_problem'];
            $resultado['id_usuario'] = null;
        } else {
            $this->db->trans_commit();
            $resultado['msg'] = $language_text['registro_usuario']['user_registro_succes'];
            $resultado['result'] = TRUE;
            $resultado['id_usuario'] = $id_usuario;
        }
        return $resultado;
    }

    private function get_informacion_usuario($matricula = '') {
        $this->db->flush_cache();
        $this->db->reset_query();
        $this->db->select('id_informacion_usuario');
        $this->db->where('matricula', $matricula);
        $this->db->where('id_usuario is null');
        $informacion_usuario = $this->db->get('sistema.informacion_usuario')->result_array();
        if (!empty($informacion_usuario)) {
            $informacion_usuario = $informacion_usuario[0];
        } else {
            $informacion_usuario = null;
        }
        return $informacion_usuario;
    }

    private function localiza_unidad($clave) {
        $this->db->flush_cache();
        $this->db->reset_query();
        $unidad = null;
        if (strlen($clave) > 7) {
            $busqueda = substr($clave, 0, 7);
            $this->db->like('clave_unidad', $clave, 'after');
            $query = $this->db->get('catalogo.unidad');
            $resultado = $query->result_array();
            if ($resultado) {
                $unidad = $resultado[0];
            }
            $query->free_result();
        }
        return $unidad;
    }

    public function get_usuarios($params = []) {
        if (!isset($params['informacion_docente'])) {
            $params['informacion_docente'] = true;
        }
        $this->db->flush_cache();
        $this->db->reset_query();
        $usuarios = [];
        if (isset($params['total'])) {
            $select = 'count(*) total';
        } else {
            if (isset($params['select'])) {
                $select = $params['select'];
            } else if ($params['informacion_docente']) {
                /*$select = array("case when usuarios.username is null then usuarios.email else usuarios.username end username",
                    "usuarios.email",
                    "usuarios.id_usuario", "coalesce(inf.matricula, usuarios.username) matricula",
                    "usuarios.clave_idioma lenguaje",
                    "inf.id_informacion_usuario", "inf.nombre", "inf.apellido_paterno", "inf.apellido_materno",
                    "uni.clave_unidad", "uni.nombre unidad", "inf.fecha_nacimiento",
                    "dep.clave_departamental", "dep.nombre departamento",
                    "cat.clave_categoria", "cat.id_categoria", "cat.nombre categoria",
                    "inf.curp", "inf.rfc"
                    , "inf.email", "inf.clave_delegacional", "del.nombre delegacion"
                );*/
                $select = array("case when usuarios.username is null then usuarios.email else usuarios.username end username",
                    "usuarios.email",
                    "usuarios.id_usuario", "usuarios.username matricula",
                    "usuarios.clave_idioma lenguaje"
                );
            } else {
                $select = array(
                    'usuarios.id_usuario', 'usuarios.username'
                );
            }
        }
        $this->db->select($select, false);
        $this->db->from('sistema.usuarios usuarios');
//        if ($params['informacion_docente']) {
        //$this->db->join('sistema.informacion_usuario inf', 'inf.id_usuario = usuarios.id_usuario', 'left');
        //$this->db->join('sistema.historico_informacion_usuario hinf', 'hinf.id_informacion_usuario = inf.id_informacion_usuario and hinf.actual', 'left');
        //$this->db->join('catalogo.departamento dep', 'dep.clave_departamental = hinf.clave_departamental', 'left');
        //$this->db->join('catalogo.unidad uni', 'uni.clave_unidad = dep.clave_unidad and uni.anio = extract(year from CURRENT_DATE)', 'left');
        //$this->db->join('catalogo.categorias cat', 'cat.id_categoria = hinf.id_categoria', 'left');
        //$this->db->join('catalogo.delegaciones del', 'del.clave_delegacional = inf.clave_delegacional', 'left');
//        }

        if (isset($params['where'])) {
//            pr($params['where']);
            if (isset($params['where_funcion'])) {
//                pr($params);
                foreach ($params['where'] as $key => $value) {
                    $this->db->{$params['where_funcion'][$key]}($key, $value);
                }
            } else {
                foreach ($params['where'] as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
        }


        if (isset($params['like'])) {
            foreach ($params['like'] as $key => $value) {
                $this->db->like($key, $value);
            }
        }

        if(isset($params['ilike'])){
            foreach ($params['ilike'] as $key => $value) {
                $this->db->like($key,strtoupper($value));
                $this->db->or_like($key,strtolower($value));
            }
        }

        if (isset($params['limit']) && isset($params['offset']) && !isset($params['total'])) {
            $this->db->limit($params['limit'], $params['offset']);
        } else if (isset($params['limit']) && !isset($params['total'])) {
            $this->db->limit($params['limit']);
        }
        if (isset($params['order_by']) && !isset($params['total'])) {
            $order = $params['order_by'] == 'desc' ? $params['order_by'] : 'asc';
            $this->db->order_by('usuarios.username', $order);
        }
        //pr($this->db->get_compiled_select());
        $query = $this->db->get();
        //pr($this->db->last_query());
        //exit();
        if ($query) {
            $usuarios = $query->result_array();
            $query->free_result(); //Libera la memoria
        }
        $this->db->flush_cache();
        $this->db->reset_query();
        return $usuarios;
    }

    public function get_niveles_acceso($id_usuario) {
        $this->db->flush_cache();
        $this->db->reset_query();
        $select = array(
            'A.clave_rol id_rol', 'A.nombre', 'B.activo'
        );
        $this->db->select($select);
        $this->db->join('sistema.usuario_rol B', " B.clave_rol = A.clave_rol and B.id_usuario = {$id_usuario}", 'left');
        $query = $this->db->get('sistema.roles A');
        if ($query) {
            $niveles = $query->result_array();
            $query->free_result(); //Libera la memoria
        }
        $this->db->flush_cache();
        $this->db->reset_query();
        return $niveles;
    }

    public function update($tipo = Usuario_model::BASICOS, $params = []) {
        $salida = false;
        switch ($tipo) {
            case Usuario_model::BASICOS:
                $salida = $this->update_basicos($params);
                break;
            case Usuario_model::PASSWORD:
                $salida = $this->update_password($params);
                break;
            case Usuario_model::NIVELES_ACCESO:
                $salida = $this->update_niveles_acceso($params);
                break;
            case Usuario_model::STATUS_ACTIVIDAD:
                $salida = $this->update_status_actividad($params);
                break;
        }
        return $salida;
    }

    private function update_status_actividad($params = []) {
        $this->db->flush_cache();
        $this->db->reset_query();
        $salida = false;
        try {
            $status_usuario = $params['status_actividad'] == 1 ? true : false;
            $this->db->set('activo', $status_usuario);
            $this->db->where('id_usuario', $params['id_usuario']);
            $this->db->update('sistema.usuarios');
            $salida = true;
        } catch (Exception $ex) {

        }
        $this->db->reset_query();
        return $salida;
    }



    private function update_basicos($params = []) {
      //  pr($params);
        $this->db->flush_cache();
        $this->db->reset_query();

        $this->db->trans_begin();
        $this->db->where('id_usuario', $params['id_usuario']);
        $user = $params['id_usuario'];
        unset($params['id_usuario']);
        unset($params['username']);
        $this->db->update('sistema.usuarios', $params);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }else{
          $this->db->set('email', $params['email']);
          $this->db->where('id_usuario', $user);
          $this->db->update('sistema.usuarios');
          //pr($params);

          if ($this->db->trans_status() === FALSE) {
              $this->db->trans_rollback();
          }else{
            $this->db->trans_commit();
            $salida = true;
          }
        }
        /*
        if (count($resultado) == 1) {
            $usuario = $resultado[0];
            $docente = array(
                'curp' => $params['curp'],
                'sexo' => $params['sexo'],
                'rfc' => $params['rfc'],
                'email' => $params['email'],
                'nombre' => $params['nombre'],
                'apellido_paterno' => $params['apellido_paterno'],
                'apellido_materno' => $params['apellido_materno'],
                'telefono_personal' => $params['telefono_personal'],
                'telefono_oficina' => $params['telefono_oficina'],
                'fecha_nacimiento' => ($params['fecha_nacimiento'] != '') ? $params['fecha_nacimiento'] : null
            );
            $this->db->start_cache();
            $this->db->where('id_informacion_usuario', $usuario['id_informacion_usuario']);
            $this->db->stop_cache();
            $this->db->update('sistema.informacion_usuario', $docente);
            $this->db->reset_query();
            $this->db->set('actual', false);
            $this->db->update('sistema.historico_informacion_usuario');
            //pr($this->db->last_query());
            $this->db->flush_cache();
            $this->db->reset_query();
            $categoria = $this->get_categoria($params['categoria_texto'])['id_categoria'];
            $departamento = $this->get_departamento($params['departamento_texto'])['clave_departamental'];
            $historico = array(
                'id_informacion_usuario' => $usuario['id_informacion_usuario'],
                'actual' => true,
                'id_categoria' => $categoria,
                'clave_departamental' => $departamento
            );
            $this->db->insert('sistema.historico_informacion_usuario', $historico);
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $salida = false;
        } else {
            $this->db->trans_commit();
            $salida = true;
        }
        $this->db->flush_cache();
        $this->db->reset_query();
        */
        return $salida;
    }

    private function update_password($datos = null) {
        $salida = false;
        try {
            $this->db->flush_cache();
            $this->db->reset_query();
            $this->db->select('token');
            $this->db->where('id_usuario', $datos['id_usuario']);
            $resultado = $this->db->get('sistema.usuarios')->result_array();
            //pr($datos);
            //pr($this->db->last_query());
            if ($resultado) {
                $this->load->library('seguridad');
                $token = $resultado[0]['token'];
                $this->db->reset_query();
                $password = $this->seguridad->encrypt_sha512($token . $datos['pass'] . $token);
                $this->db->set('password', $password);
                $this->db->where('id_usuario', $datos['id_usuario']);
                $this->db->update('sistema.usuarios');
//                pr($this->db->last_query());
                $salida = true;
            } else {
                // pr('usuario no localizado');
            }
        } catch (Exception $ex) {
            //  pr($ex);
        }
        $this->db->flush_cache();
        $this->db->reset_query();
        return $salida;
    }

    private function update_niveles_acceso($params = []) {
        $this->load->model('Administracion_model', 'admin');
        $id_usuario = $params['id_usuario'];
        $grupos = $this->admin->get_niveles_acceso();
//        pr($grupos);
        $this->db->trans_begin();
        foreach ($grupos as $grupo) {
            $id_grupo = $grupo['id_grupo'];
            $activo = (isset($params['activo' . $id_grupo])) ? true : false;
            $this->upsert_usuario_nivel_acceso($id_usuario, $id_grupo, $activo);
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $status = false;
        } else {
            $this->db->trans_commit();
            $status = true;
        }
        return $status;
    }

    private function upsert_usuario_nivel_acceso($id_usuario, $id_grupo, $activo) {
        if ($id_grupo != '' && $id_usuario > 0) {
            $this->db->flush_cache();
            $this->db->reset_query();
            $this->db->select('count(*) cantidad');
            $this->db->start_cache();
            $this->db->where('clave_rol', $id_grupo);
            $this->db->where('id_usuario', $id_usuario);
            $this->db->stop_cache();
            $existe = $this->db->get('sistema.usuario_rol')->result_array()[0]['cantidad'] != 0;
            if ($existe) {
                $this->db->set('activo', $activo);
                $this->db->update('sistema.usuario_rol');
//                pr($this->db->last_query());
            } else {
                $this->db->flush_cache();
                $insert = array(
                    'id_usuario' => $id_usuario,
                    'clave_rol' => $id_grupo,
                    'activo' => $activo
                );
                $this->db->insert('sistema.usuario_rol', $insert);
            }
        }
        $this->db->flush_cache();
        $this->db->reset_query();
    }

    public function datos_generales_docente($params) {
        $this->db->where('matricula', $params['matricula']);
        $query = $this->db->get('censo.docente');
        $this->db->flush_cache(); // limpiamos la cache
        $resultado = $query->free_result(); //Libera la memoria
        return $resultado;
    }

    public function datos_imss_docente($parametros) {

        /*
          select * from censo.docente
          left join censo.historico_datos_docente on (censo.historico_datos_docente.id_docente=censo.docente.id_docente and actual=1)
          inner join catalogo.delegaciones on catalogo.delegaciones.clave_delegacional = censo.historico_datos_docente.clave_delegacional
          inner join catalogo.categorias on catalogo.categorias.clave_categoria= historico_datos_docente.clave_categoria
          left join catalogo.departamentos_instituto on catalogo.departamentos_instituto.clave_departamental= historico_datos_docente.clave_departamental
          left join catalogo.unidades_instituto on catalogo.unidades_instituto.id_unidad_instituto=catalogo.departamentos_instituto.id_unidad_instituto
          where matricula='99095896'
         */



        $this->db->where('matricula', $params['matricula']);
        $this->db->join('censo.historico_datos_docente hd ', 'hd.id_docente=c.docente.id_docente', 'left');
        $this->db->join('catalogo.delegaciones cd ', 'cd.clave_delegacional = ch.clave_delegacional');
        $this->db->join('catalogo.categorias cc ', 'cc.clave_categoria= hd.clave_categoria');
        $this->db->join('catalogo.departamentos_instituto cdep ', 'cdep.clave_departamental= hd.clave_departamental', 'left');
        $this->db->join('catalogo.unidades_instituto cuni ', 'cuni.id_unidad_instituto=cdep.id_unidad_instituto and cuni.anio = date_part($$year$$, CURRENT_DATE)', 'left');

        $query = $this->db->get('censo.docente c');

        $this->db->flush_cache(); // limpiamos la cache
        $resultado = $query->free_result(); //Libera la memoria

        return $resultado;
    }

    /**
     * @author LEAS
     * @fecha 05/07/2017
     * @param type $id_user
     * @param type $id_file identificador del archivo
     * @return type array 'tp_msg' success si tuvo exito la transacción; danger
     * si ocurrio un rollback o un error
     */
    public function delete_foto_perfil($id_user, $id_file) {
        $this->db->trans_begin();

        $this->db->where('id_usuario', $id_user);
        $this->db->where('id_file', $id_file);
        $this->db->update('sistema.usuarios', array('id_file' => null));


        if ($this->db->trans_status() === FALSE) {//ocurrio un error
            $this->db->trans_rollback();
            $respuesta = array('tp_msg' => En_tpmsg::DANGER, 'mensaje' => '');
        } else {
            $this->db->where('id_file', $id_file);
            $this->db->delete('censo.files');
            if ($this->db->trans_status() === FALSE) {//ocurrio un error
                $this->db->trans_rollback();
                $respuesta = array('tp_msg' => En_tpmsg::DANGER, 'mensaje' => '');
            } else {
                $this->db->trans_commit();
                $respuesta = array('tp_msg' => En_tpmsg::SUCCESS, 'mensaje' => '');
            }
        }
        return $respuesta;
    }

    public function carga_masiva($id_usuario, $tipo_registro, &$file_data, &$csv_array) {
        $resultado['msg'] = 'Error';
        $resultado['result'] = false;
        $this->db->flush_cache();
        $this->db->reset_query();
        $this->db->trans_begin(); //Definir inicio de transacción
        $valido = false;
        switch ($tipo_registro) {
            case 'registro_' . Usuario_model::SIAP:
                // pr($csv_array[0]);
                $valido = in_array('matricula', array_keys($csv_array[0]));
                $valido &= in_array('email', array_keys($csv_array[0]));
                $valido &= in_array('grupo', array_keys($csv_array[0]));
                $valido &= in_array('delegacion', array_keys($csv_array[0]));
                $resultado['msg'] = 'Las columnas para SIAP deben ser matricula, email, delegacion y grupo';
                break;
            case 'registro_' . Usuario_model::NO_SIAP:
                $valido = in_array('matricula', array_keys($csv_array[0]));
                $valido &= in_array('email', array_keys($csv_array[0]));
                $valido &= in_array('grupo', array_keys($csv_array[0]));
                $valido &= in_array('delegacion', array_keys($csv_array[0]));
                $valido &= in_array('nombre', array_keys($csv_array[0]));
                $valido &= in_array('paterno', array_keys($csv_array[0]));
                $valido &= in_array('materno', array_keys($csv_array[0]));
                $valido &= in_array('curp', array_keys($csv_array[0]));
                $valido &= in_array('sexo', array_keys($csv_array[0]));
                $valido &= in_array('rfc', array_keys($csv_array[0]));
                $valido &= in_array('clave_departamental', array_keys($csv_array[0]));
                $valido &= in_array('categoria', array_keys($csv_array[0]));
                $resultado['msg'] = 'Las columnas para NO SIAP deben ser matricula1, email1, delegacion, nombre, paterno, materno, curp, sexo, rfc, clave_departamental, categoria y grupo1';
                break;
            case 'registro_' . Usuario_model::NO_IMSS:
                $valido = in_array('matricula', array_keys($csv_array[0]));
                $valido &= in_array('email', array_keys($csv_array[0]));
                $valido &= in_array('grupo', array_keys($csv_array[0]));
                $resultado['msg'] = 'Las columnas para NO IMSS deben ser matricula, email, grupo';
                break;
            default:
                break;
        }
        if (!$valido) {
            return $resultado;
        }
        $precarga = array(
            'id_usuario' => $id_usuario,
            'nombre_archivo' => $file_data['file_name'],
            'peso' => $file_data['file_size'],
            'modelo' => 'Usuario_model',
            'funcion' => 'background_usuarios'
        );
        $this->db->insert('sistema.precargas', $precarga);
        $id_precarga = $this->db->insert_id();
        $registro = array(
            'id_precarga' => $id_precarga,
            'tabla_destino' => 'sistema.usuarios'
        );
        foreach ($csv_array as $row) {
            $pass = $this->seguridad->folio_random(10, TRUE);
            $row['tipo_registro'] = $tipo_registro;
            $row['password'] = $pass;
            $registro['detalle_registro'] = json_encode($row);
            $this->db->insert('sistema.detalle_precargas', $registro);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $resultado['result'] = FALSE;
            $resultado['msg'] = "Ocurrió un error durante el guardado, por favor intentelo de nuevo más tarde.";
        } else {
            $this->db->trans_commit();
            $resultado['msg'] = 'Ëxito';
            $resultado['result'] = TRUE;
        }
        return $resultado;
        $this->db->flush_cache();
        $this->db->reset_query();
    }

    public function background_usuarios(&$array) {
        $this->load->library('Seguridad');
        $this->load->library('Empleados_siap');
        $this->db->flush_cache();
        $this->db->reset_query();
        $salida = array();
        // pr($array['detalle_registro']);
        $parametros = json_decode($array['detalle_registro'], true);
        switch ($parametros['tipo_registro']) {
            case 'registro_' . Usuario_model::SIAP:
                $this->nuevo_siap($parametros, $salida);
                break;
            case 'registro_' . Usuario_model::NO_SIAP:
                $this->nuevo_no_siap($parametros, $salida);
                break;
            case 'registro_' . Usuario_model::NO_IMSS:
                $this->nuevo_no_imss($parametros, $salida);
                break;
            default:
                break;
        }
        if (isset($salida['result']) && $salida['result']) {
            $this->db->set('status', 'OK');
            $this->db->set('id_tabla_destino', $salida['id_usuario']);
        } else {
            $this->db->set('status', 'FALLA');
            $this->db->set('descripcion_status', $salida['msg']);
        }
        $this->db->where('id_detalle_precarga', $array['id_detalle_precarga']);
        $this->db->update('sistema.detalle_precargas');
        $this->db->flush_cache();
        $this->db->reset_query();
    }

    public function test_precarga($data) {
        return json_decode($data['detalle_registro'], true);
    }

    public function is_unico_datos_usuarios($campo, $valor) {
        $this->db->flush_cache();
        $this->db->reset_query();
        $this->db->where($campo, $valor);
        $this->db->limit(1);
        $query = $this->db->get('sistema.usuarios')->result_array();
//        pr($this->db->last_query());
        $this->db->flush_cache();
        $this->db->reset_query();
        return (empty($query));
    }

    /**
    * Permite actualizar la informacion de un usuario
    * @author clapas
    * @date 15/06/2018
    * @param array
    * @return boolean
    */
    public function actualizar_informacion($params=array())
    {
        $salida = false;
        $this->db->flush_cache();
        $this->db->reset_query();

        $this->db->trans_begin();
        $this->db->where($params['where']);
        $this->db->set($params['datos']);
        $this->db->update('sistema.informacion_usuario');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }else{
            $this->db->trans_commit();
            $salida = true;
        }

        return $salida;
    }

    /**
    * Devuelve la informacion de un usuario
    * @author clapas
    * @date 18/06/2018
    * @param array
    * @return array
    */
    public function obtener_informacion_usuario($params=array())
    {
        $this->db->flush_cache();
        $this->db->reset_query();

        if(isset($params['select'])){
            $this->db->where($params['select']);
        }

        if(isset($params['where'])){
            $this->db->where($params['where']);
        }

        $query = $this->db->get('sistema.informacion_usuario');
        return $query->result_array();
    }
}
