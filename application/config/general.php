<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config['upload_us'] = '/assets/us/uploads/'; //Rutas uploads
$config['upload_perfil'] = '/assets/us/perfil/'; //Rutas uploads

$config['upload_header_carta'] ='/xampp/htdocs/foro_v2/assets/img/dictamen/header.png';
$config['upload_footer_carta'] ='/xampp/htdocs/foro_v2/assets/img/dictamen/footer.png';
$config['upload_fondo_carta'] ='/xampp/htdocs/foro_v2/assets/img/dictamen/fondo.png';

$config['upload_config'] = array(
    'comprobantes' => array(
        'upload_path' => '.' . $config['upload_us'],
        'allowed_types' => 'pdf',
        'remove_spaces' => TRUE,
        'max_size' => 1024 * 15,
        'detect_mime' => true,
        'file_name' => 'tmp_comprobante',
    ),
    'perfil' => array(
        'upload_path' => '.' . $config['upload_perfil'],
        'allowed_types' => 'gif|jpg|png',
        'remove_spaces' => TRUE,
        'max_size' => 1024 * 15,
        'detect_mime' => true,
        'file_name' => 'tmp_perfil',
    ),
    'pdf' => array(
        'upload_path' => '.' . $config['upload_us'],
        'allowed_types' => 'pdf',
        'remove_spaces' => TRUE,
        'max_size' => 1024 * 15,
        'detect_mime' => true,
        'file_name' => 'tmp_filecore',
    ),
    'jpg' => array(
        'upload_path' => '.' . $config['upload_perfil'],
        'allowed_types' => 'jpg',
        'remove_spaces' => TRUE,
        'max_size' => 1024 * 15,
        'detect_mime' => true,
        'file_name' => 'tmp_filecore',
    ),
    'png' => array(
        'upload_path' => '.' . $config['upload_perfil'],
        'allowed_types' => 'png',
        'remove_spaces' => TRUE,
        'max_size' => 1024 * 15,
        'detect_mime' => true,
        'file_name' => 'tmp_filecore',
    ),
    'gif' => array(
        'upload_path' => '.' . $config['upload_perfil'],
        'allowed_types' => 'gif',
        'remove_spaces' => TRUE,
        'max_size' => 1024 * 15,
        'detect_mime' => true,
        'file_name' => 'tmp_filecore',
    ),
);

$config['img_perfil_default'] = base_url('assets/img/user_icon_icons.png');

$config['columnas_unidades_grid'] = array(
    'id' => array('name' => 'id_unidad_instituto', 'type' => "text", 'title' => 'Id'),
    'cve_unidad' => array('name' => 'clave_unidad', 'type' => "text", 'title' => 'Clave'),
    'nombre_unidad' => array('name' => 'unidad', 'type' => "text", 'title' => 'Unidad/UMAE'),
    'cve_presupuestal' => array('name' => 'clave_presupuestal', 'type' => "text", 'title' => 'Cve presupuestal'),
    'nivel_atencion' => array('name' => 'nivel_atencion', 'type' => "int", 'title' => 'Nivel de atención'),
    'latitud' => array('name' => 'latitud', 'type' => "float", 'title' => 'Latitud'),
    'longitud' => array('name' => 'longitud', 'type' => "float", 'title' => 'Longitud'),
    'clave_delegacional' => array('name' => 'clave_delegacional', 'type' => "text", 'title' => 'Cve delegacional'),
    'delegacion' => array('name' => 'delegacion', 'type' => "float", 'title' => 'Delegación'),
    'region' => array('name' => 'region', 'type' => "text", 'title' => 'Región'),
);

$config['columnas_umae_grid'] = array(
    'id' => array('name' => 'id_unidad_instituto', 'type' => "text", 'title' => 'Id'),
    'cve_unidad' => array('name' => 'clave_unidad', 'type' => "text", 'title' => 'Clave'),
    'nombre_unidad' => array('name' => 'unidad', 'type' => "text", 'title' => 'UMAE/CUMAE'),
    'cve_unidad_principal' => array('name' => 'clave_unidad_principal', 'type' => "text", 'title' => 'Clava unidad principal'),
    'nombre_unidad_principal' => array('name' => 'unidad_principal', 'type' => "text", 'title' => 'UMAE principal'),
    'cve_presupuestal' => array('name' => 'clave_presupuestal', 'type' => "text", 'title' => 'Cve presupuestal'),
    'nivel_atencion' => array('name' => 'nivel_atencion', 'type' => "int", 'title' => 'Nivel de atención'),
    'latitud' => array('name' => 'latitud', 'type' => "float", 'title' => 'Latitud'),
    'longitud' => array('name' => 'longitud', 'type' => "float", 'title' => 'Longitud'),
    'clave_delegacional' => array('name' => 'clave_delegacional', 'type' => "text", 'title' => 'Cve delegacional'),
    'region' => array('name' => 'region', 'type' => "text", 'title' => 'Región'),
);

$config['filtros_unidades'] = array(
    'localizador_sede_id_delegacion_' => 'delegacion',
    'localizador_sede_id_servicio_' => 'nivel_servicio',
    'localizador_sede_id_nivel_' => "nivel",
    'localizador_sede_id_tipo_unidad_' => "tipo_unidad",
    'localizador_sede_cve_umae_' => 'clave_unidad_principal'
);

/**
 * 'P' => 'Productivo',
 *    'T' => 'Pruebas',
 *    'M' => 'Mantenimiento'
 */
$config['status_sistema'] = 'P';

/**
*
*
**/
$config['menu_configuradores'] = array('MENU', 'MODAL', 'EXTERNO','MODAL_GENE');

$config['menu_configuradores_no_sesion'] = array('MENU_LIBRE','MODAL_GENE');

$config['estados_transicion_evaluacion'] = array(
"CT"=>"",
""=>"",
""=>"",
""=>"",

);
