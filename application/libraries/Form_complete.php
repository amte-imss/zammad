<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Form_complete {

    var $array_validation;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->helper('form');
        $this->array_validations = array();
    }

    /**
     * @access  public
     * @param 	array asociative 	$form Información correspondiente a elemento form, al menos debe contener el campo action, para poder crear el formulario.
     * @param 	array asociative 	$elements (Orden de indices no indispensable)
     * 					id 					Identificador del elemento
     * 					type				Tipo del elemento (text, radio, checkbox, dropdown, multiselect, button, submit, hidden, textarea, password, upload, reset)
     * 					[label] 			Etiqueta adjunta al contenido
     * 					[value]				Valor(es) que tendrá
     * 					[validation] array	Validaciones que incluirá el elemento
     * 										rules    array	Reglas
     * 										[errors] array	Texto por regla
     * 					[attributes] array 	Atributos (class, width, rel, style, etc)
     * 					[options] array		Parametro usado solo para los tipos 'dropdown' y 'multiselect'. Arreglo de la forma: array('valor'=>'texto','valor'=>'texto',...)
     * 					[first] array 		Parametro usado solo para los tipos 'dropdown' y 'multiselect'. Arreglo de la forma: array(llave=>Texto). Campo que será colocado al inicio de la lista.
     * @param 	array sociative		[$data_form] Datos asociados al elemento. Arreglo asociativo de la forma 'identificador'=>array(llave=>texto, llave=>texto, ...)
     * @return 	string 	Elementos del formulario
     */
    public function create_form_elements($form, $elements, $data_element_form = null) {
        $html = null;
        //pr($data_element_form);
        if (array_key_exists('action', $form)) {
            $html = (array_key_exists('multipart', $form) && $form['multipart'] == TRUE) ? form_open_multipart($form['action'], $form['attributes']) : form_open($form['action'], $form['attributes']); //Definir el tipo de formulario (Normal o Multiparte[Permite subir archivos])
            $html .= $this->body_form_elements($elements, $data_element_form);
            $html .= form_close();
        }
        return $html;
    }

    public function body_form_elements(&$elements, &$data_element_form = null) {
        $html = "";
        $array_containers = array('div', 'label', 'span', 'p', 'fieldset');
        $array_forms = array('button', 'submit', 'reset', 'checkbox', 'dropdown', 'multiselect', 'hidden', 'password', 'textarea', 'text','email', 'radio', 'upload');
        foreach ($elements as $key => $element) {
            $array_sub_element = array_map(array($this, 'validate_key_name'), array_values($element), array_keys($element));
            $string_sub_element = "";
            foreach ($array_sub_element as $key_ase => $sub_element) {
                if (!empty($sub_element)) { //Verificación de sub-elementos
                    $new_array = array($element[$sub_element]);
                    $string_sub_element .= $this->body_form_elements($new_array, $data_element_form);
                }
            }
            if (array_key_exists('type', $element) && in_array($element['type'], $array_containers)) {
                $element['value'] = (array_key_exists('value', $element)) ? $element['value'] . $string_sub_element : $string_sub_element;
                $element['id'] = (array_key_exists('id', $element)) ? $element['id'] : array(); //No se incluye dentro de function 'validate_data_element'
                $html .= $this->create_element($element);
            } elseif (array_key_exists('id', $element) && array_key_exists('type', $element) && in_array($element['type'], $array_forms)) { //Verificar campos mínimos para elementos de formulario (id, type)
                if (!is_null($data_element_form) && array_key_exists($element['id'], $data_element_form) && is_array($data_element_form[$element['id']])) { //Datos del elemento // && !in_array($element['type'], array('dropdown','multiselect'))
                    $html .= $this->body_form_elements($data_element_form[$element['id']]);
                } else {
                    $html .= $this->create_element($element);
                    $html .= form_error($element['id']); //Añadir mensaje de error, mostrado por campo
                }
                //echo $element['id']." - ";
            }
        }
        return $html;
    }

    public function set_array_validation(&$elements) {
        foreach ($elements as $key => $element) {
            //pr($element);
            if (is_array($element)) {
                if (array_key_exists('validation', $element) && is_array($element['validation'])) {
                    $rules = array();
                    foreach ($element['validation'] as $key => $rule) {
                        $rules[] = $rule['rules'];
                        if (array_key_exists('errors', $rule)) { //Si texto predefinido es sobreescrito
                            if ($rule_length = stripos($rule['rules'], "[")) {
                                $rule_name_fix = substr($rule['rules'], 0, $rule_length);
                                $array_validation['errors'][$rule_name_fix] = $rule['errors'];
                            } else {
                                $array_validation['errors'][$rule['rules']] = $rule['errors'];
                            }
                        }
                    }
                    if (!empty($rules)) { //Generar arreglo de validaciones si existen reglas
                        $array_validation['field'] = $element['id'];
                        $array_validation['label'] = (array_key_exists('label', $element)) ? $element['label'] : $element['id'];
                        $array_validation['rules'] = implode('|', $rules);
                        $this->array_validations[] = $array_validation;
                    }
                }
                $array_sub_element = array_map(array($this, 'validate_key_name'), array_values($element), array_keys($element));
                foreach ($array_sub_element as $key_ase => $sub_element) {
                    if (!empty($sub_element)) { //Verificación de sub-elementos
                        $new_array = array($element[$sub_element]);
                        $array_sub_validation = $this->set_array_validation($new_array);
                        if (!empty($array_sub_validation)) {
                            $this->array_validations[] = $array_sub_validation;
                        }
                    }
                }
            }
        }
    }

    public function get_array_validation() {
        return $this->array_validations;
    }

    private function validate_key_name($value, $key) {
        if (preg_match('/^#/', $key) === 1) {
            //echo "valor: ".$value." | key:".$key."<br>";
            return $key;
        }
    }

    private function element_format_default($type, $attributes) {

        $clase = null;
        if (!isset($attributes['default'])) {
            switch ($type) { //Validar tipo
                case 'button': case 'submit': case 'reset':
                    $clase = ' btn';
                    break;
                case 'dropdown': case 'multiselect':
//                    $clase = 'input-sm';
                    break;
                case 'password': case 'textarea': case 'text':
                    $clase = '';
                    break;
                case 'checkbox': case 'radio': case 'upload': case 'label': case 'span': case 'hidden':
                    break;
            }
        }

        if (!is_null($clase)) {
            $attributes['class'] = (array_key_exists('class', $attributes) ) ? $attributes['class'] . " " . $clase : $clase;
        }
        return $attributes;
    }

    public function create_element($element) {
//        pr($element);
        if (isset($element['atributos_catalogo'])) {//Atributos temporales de catalogos, aplican para gestor de formularios
            $atributos_catalogo = $element['atributos_catalogo'];
        }
        $e = $this->validate_data_element($element);
        $elemento = null;
        if (!is_null($e)) {
            $name = $e['name'];
            $value = $e['value'];
            $attributes = $e['attributes'];
            $attributes = $this->element_format_default($element['type'], $attributes);

            switch ($element['type']) { //Validar tipo
                case 'button':
                    $elemento = form_button(array_merge(array('id' => $element['id'], 'name' => $name, 'value' => $value, 'content' => $value), $attributes));
                    break;
                case 'checkbox':
                    $checked = (set_checkbox($name, $value)) ? array('checked' => 'checked') : array();
                    $elemento = form_checkbox(array_merge(array('id' => $element['id'], 'name' => $name, 'value' => $value), $attributes, $checked));
                    break;
                case 'dropdown':
//                    $options = (array_key_exists('options', $element) && is_array($element['options'])) ? $element['options'] : array();
//                    $options = (array_key_exists('first', $element) && is_array($element['first'])) ? ($element['first'] + $options) : $options;
////                    $value = $this->selected_option_element($element['id'], $options);
//                    $option_selected = $this->selected_option_element($element['id'], $options);
                    //**********************************************************
                    if (isset($atributos_catalogo)) {//Aplica a gestor de formularios ***************
                        $options = (array_key_exists('options', $atributos_catalogo) && is_array($atributos_catalogo['options'])) ? $atributos_catalogo['options'] : array();
                        $option_selected = $this->selected_option_element_valido($element['id'], $value, $options, $atributos_catalogo['id'], $atributos_catalogo['label'], $atributos_catalogo['llave_valido']);
                        $options = (array_key_exists('first', $element) && is_array($element['first'])) ? ($element['first'] + $options) : $options;
//                        unset($attributes['atributos_catalogo']); //Elimina atributos, ya que es exclusivo del gestor de formularios
                    } else {
                        $options = (array_key_exists('options', $element) && is_array($element['options'])) ? $element['options'] : array();
                        $options = (array_key_exists('first', $element) && is_array($element['first'])) ? ($element['first'] + $options) : $options;
                        $option_selected = $this->selected_option_element($element['id'], $options);
                    }
//                    pr($option_selected);
                    //**********************************************************
                    $value = (!empty($option_selected)) ? $option_selected : array($value);
                    $elemento = form_dropdown($element['id'], $options, $value, array_merge(array('id' => $element['id']), $attributes));
                    break;
                case 'dropdown_otro'://Para gestor de formularios
                    if (isset($atributos_catalogo)) {//
                        $options = (array_key_exists('options', $atributos_catalogo) && is_array($atributos_catalogo['options'])) ? $atributos_catalogo['options'] : array();
//                    pr($options);
                        $option_selected = $this->selected_option_element_valido($element['id'], $value, $options, $atributos_catalogo['id'], $atributos_catalogo['label'], $atributos_catalogo['llave_valido']);
                        $options = (array_key_exists('first', $element) && is_array($element['first'])) ? ($element['first'] + $options) : $options;
//                        unset($attributes['atributos_catalogo']); //Elimina atributos, ya que es exclusivo del gestor de formularios
                    } else {
                        $options = (array_key_exists('options', $element) && is_array($element['options'])) ? $element['options'] : array();
                        $options = (array_key_exists('first', $element) && is_array($element['first'])) ? ($element['first'] + $options) : $options;
                        $option_selected = $this->selected_option_element($element['id'], $options);
                    }
                    $value = (!empty($option_selected)) ? $option_selected : array($value);
                    $elemento = form_dropdown($element['id'], $options, $value, array_merge(array('id' => $element['id']), $attributes));
                    break;
                case 'hidden': //Método 'form_hidden' no permite agregar más atributos, solo nombre y valor. Por este inconveniente se utiliza 'form_input'
                    $elemento = form_input(array_merge(array('id' => $element['id'], 'name' => $name, 'value' => set_value($element['id'], $value), 'type' => 'hidden'), $attributes));
                    break;
                case 'email':
                $elemento = form_input(array_merge(array('id' => $element['id'], 'name' => $name, 'value' => set_value($element['id'], $value), 'type' => 'email'), $attributes));
                    break;
                case 'multiselect':
                    $options = (array_key_exists('options', $element) && is_array($element['options'])) ? $element['options'] : null;
                    $options = (array_key_exists('first', $element) && is_array($element['first'])) ? ($element['first'] + $options) : $options;
                    //$value = $this->selected_option_element($element['id'], $options);
                    $option_selected = $this->selected_option_element($element['id'], $options);
                    $value = (!empty($option_selected)) ? $option_selected : $value;
                    $elemento = form_multiselect($element['id'] . "[]", $options, $value, array_merge(array('id' => $element['id'], 'multiple' => 'multiple'), $attributes));
                    break;
                case 'password':
                    $elemento = form_password(array_merge(array('id' => $element['id'], 'name' => $name), $attributes)); //No se retoma valor, ni se permite especificarlo por default
                    break;
                case 'number':
                    $elemento = form_input(array_merge(array('id' => $element['id'], 'name' => $name, 'value' => set_value($element['id'], $value), 'type' => 'number'), $attributes));
                    break;
                case 'radio':
                    $checked = (set_radio($name, $value)) ? array('checked' => 'checked') : array();
                    $elemento = form_radio(array_merge(array('id' => $element['id'], 'name' => $name, 'value' => $value), $attributes, $checked));
                    break;
                case 'reset':
                    $elemento = form_reset(array_merge(array('id' => $element['id'], 'name' => $name, 'value' => $value), $attributes));
                    break;
                case 'submit':
                    $elemento = form_submit(array_merge(array('id' => $element['id'], 'name' => $name, 'value' => $value), $attributes));
                    break;
                case 'textarea':
                    $elemento = form_textarea(array_merge(array('id' => $element['id'], 'name' => $name, 'value' => set_value($element['id'], $value)), $attributes));
                    break;
                case 'upload':
                    $elemento = form_upload(array_merge(array('id' => $element['id'], 'name' => $name), $attributes)); //No se retoma valor, ni se permite especificarlo por default
                    break;
                case 'label':
                    $elemento = form_label($value, $element['id'], $attributes);
                    //$elemento = form_upload(array_merge(array('id'=>$element['id'], 'name'=>$name), $attributes)); //No se retoma valor, ni se permite especificarlo por default
                    break;
                case 'fieldset':
                    $elemento = form_fieldset($value, $attributes) . form_fieldset_close();
                    break;
                case 'div':
                    $elemento = html_div($value, $attributes);
                    break;
                case 'span':
                    $elemento = html_span($value, $attributes);
                    break;
                case 'p':
                    $elemento = html_p($value, $attributes);
                    break;
                case 'help_popover':
                    $elemento = html_help_popover($attributes, $element['in_group']);
                    break;
                case 'date':
                    $elemento = form_input(array_merge(array('id' => $element['id'], 'name' => $name, 'type' => 'date', 'value' => set_value($element['id'], $value)), $attributes));
                    break;
                case 'file':
                    $elemento = form_input(array_merge(array('id' => $element['id'], 'name' => $name, 'type' => 'file', 'value' => set_value($element['id'], $value)), $attributes));
                    break;
                case 'date':
                    $elemento = form_input(array_merge(array('id' => $element['id'], 'name' => $name, 'type' => 'date', 'value' => set_value($element['id'], $value)), $attributes));
                    break;
                default: //Text
                    /* echo "id:";
                      pr(array('id'=>$element['id'], 'name'=>$name, 'value'=>set_value($element['id'], $value)));
                      echo "attributes:";
                      pr($attributes); */
                    $elemento = form_input(array_merge(array('id' => $element['id'], 'name' => $name, 'value' => set_value($element['id'], $value)), $attributes));
                    //pr(array_merge(array('id'=>$element['id'], 'name'=>$name, 'value'=>set_value($element['id'], $value)), $attributes));
                    //echo "@"; pr($value); echo "@";
                    break;
            }
        }
        return $elemento;
    }

    private function validate_data_element(&$element) {
        if (array_key_exists('id', $element) && array_key_exists('type', $element)) {
            $data_elemento = array();
            $data_elemento['attributes'] = array();
            $data_elemento['name'] = $element['id'];
            $data_elemento['value'] = (array_key_exists('value', $element)) ? $element['value'] : null;
            if (array_key_exists('attributes', $element)) {
                if (array_key_exists('id', $element['attributes']) || array_key_exists('type', $element['attributes']) || array_key_exists('value', $element['attributes'])) { //Validar que no existan id, type y value en attributes
                    unset($element['attributes']['id'], $element['attributes']['type'], $element['attributes']['value']);
                }
                $data_elemento['attributes'] = $element['attributes'];
                $data_elemento['name'] = (array_key_exists('name', $element['attributes'])) ? $element['attributes']['name'] : $element['id'];
            }
        } else {
            $data_elemento = null;
        }
        return $data_elemento;
    }

    private function selected_option_element($element, $options) {
        $selected = array();
        foreach ($options as $key_options => $option) {
            if (set_select($element, $key_options)) {
                $selected[] = $key_options;
            }
        }
        return $selected;
    }

    /**
     * @author LEAS
     * @fecha 31/07/2017
     * @param type $element elemento seleccionado
     * @param type &$options opciones del catálogo, es posible modificar, la variable se modificará por referencia
     * @return type
     */
    private function selected_option_element_valido($element, $value, &$options, $llave_select, $valor_select, $llave_valido = 'is_validado') {
        $selected = array();
        $options_auxiliar = array();

        foreach ($options as $key_options => $option) {
            $seleccionado = FALSE;
            if (set_select($element, $option[$llave_select])) {//Compara con el post, si existe algo precargado
//                pr($option[$llave_select]);
                $selected[] = $option[$llave_select];
                $seleccionado = TRUE;
            }
//                $options_auxiliar[$option[$llave_select]] = $option[$valor_select]; //Agrega la opción del valor
            if ($option[$llave_valido] and $option['activo']) {//Valida que el registro de catálogo  haya sido validado por algún ente responsable y que se encuentre activo el elemento
                $options_auxiliar[$option[$llave_select]] = $option[$valor_select]; //Agrega la opción del valor
            } else {
                if ($seleccionado || $value == $option[$llave_select]) {//Si no es validado por el ente responsable, valida que el registro requiera de la opción
                    $options_auxiliar[$option[$llave_select]] = $option[$valor_select]; //Agrega la opción del valor no validado por el ente
                }
            }
        }
        $options = $options_auxiliar; //Reemplaza los valores de opción
//        pr($selected);
        return $selected;
    }

}
