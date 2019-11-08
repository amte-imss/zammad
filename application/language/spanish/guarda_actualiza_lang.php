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
$lang['guarda_actualiza'] = array(
    'no_registros_guardar' => 'No se encontro información para guardar.',
    'no_guardo_file' => 'No se guardo el archivo correctamente.',
    'guardo_file' => 'El archivo se guardo correctamente.',
    'no_guardar' => 'No se pudo guardo el registro.',
    'no_guardo_dato' => 'No se guardo el datos del registro de censo.',
    'succes_insert' => 'El registro se guardo correctamente.',
    'no_extencion_archivo' => 'La extención del archivo no es valida.',
    'success_imagen' => 'La image se actualizo correctamente.',
    'error_imagen' => 'Existen problemas para cargar la imagen. Por favor intentelo más tarde',
    'error_encontrar_usuario' => 'No se encontro el usuario para cargar imagen de perfil',
    'error_delete_imagen' => 'Error al eliminar la imagen. Por favor intentelo más tarde',
    'error_general' => 'Ocurrio un error, por favor intentelo más tarde.',
);

//$lang['interface_registro_profesor'] = 'Impresión de texto prueba';
//$lang['interface_otro_mensaje'] = '&lsaquo; Primero';