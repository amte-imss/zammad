<?php

/**
 * Archivo que contiene los textos del sistema
 * Contrucción del índice.
 * 	- Archivo fuente: interface_
 * 	- Modulo: login
 *  - Controlador: login
 *  - Identificador único del texto dentro del arreglo: texto_bienvenida
 * 		Ej:
 * 			$lang['interface_login']['login']['texto_bienvenida'] = 'Bienvenido al sistema SIPIMSS';
 * 			$lang['interface_login']['login']['texto_usuario'] = 'Usuario:';
 * 			$lang['interface_login']['login']['texto_contrasenia'] = 'Contraseña:';
 * 			$lang['interface_censo']['formacion']['texto_bienvenida'] = '...';
 * 			$lang['interface_censo']['actividad']['texto_bienvenida'] = '...';
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

//$lang['interface_'][''][''] = '';
//$lang['interface']['registro']['texto_bienvenida'] = 'Hola mundo';
$lang['datatable_secciones'] = array(
    'th_estado_validacion' => 'Estado de validación',
    'th_folio' => 'Folio',
    'th_acciones' => 'Acciones',
    'th_tipo_comprobante' => 'Tipo de comprobante',
    'th_elemento_seccion' => 'Sub sección',
    '' => '',
);

$lang['datatable_secciones_config'] = array(
    'elemento_seccion' => ['label' => 'Sub sección', 'nombre_tipo_campo' => 'text'],
    'estado_validacion' => ['label' => 'Estado de validación', 'nombre_tipo_campo' => 'estado_validacin'],
//    'acciones' => ['label' => 'acciones', 'nombre_tipo_campo' => 'itemTemplate'],
);
