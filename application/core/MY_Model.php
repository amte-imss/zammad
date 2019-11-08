<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
	*@author: Mr. Guag
	*@version: 1.0
	*@desc: Clase padre de los controladores del sistema

	 function model_load_model($model_name)
   {
      $CI =& get_instance();
      $CI->load->model($model_name);
      return $CI->$model_name;
   }
**/
class MY_Model extends CI_Model {
	function __construct(){
        parent::__construct();
        $this->load->database();   
    }
}

//include_once APPPATH . 'core/ICron.php';