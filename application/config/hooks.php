<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
/*      pre_system: al principio de la ejecución del sistema, sin haber cargado básicamente nada.
        pre_controller: ejecutar antes de cargar el controlador, una vez cargadas las librerías y todo el systema básico.
        post_controller_constructor: justo se ejecuta tras el constructor del controlador pero antes de cualquier función.
        post_controller: se ejecutará una vez lo haya hecho el controlador.
        display_override: esto es para sobrescribir la función que nos muestra la pagina finalizada en el navegador.
        cache_override: lo mismo pero para la función de cache, nos permite sobreescrivirla.
        scaffolding_override: para crear nuestro propio scaffolding.
        post_system: ejecutará el código al final de todos los procedimientos.
  |
 */

$hook['post_controller_constructor'] = array(
    'class' => 'LoaderV2',
    'function' => 'load',
    'filename' => 'LoaderV2.php',
    'filepath' => 'hooks'
);
