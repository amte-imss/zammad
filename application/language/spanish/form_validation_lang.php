<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
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

$lang['form_validation_required'] = 'El campo {field} es obligatorio.';
$lang['form_validation_isset'] = 'El campo {field} debe tener un valor.';
$lang['form_validation_valid_email'] = 'El campo {field} debe contener una dirección de correo válida';
$lang['form_validation_valid_emails'] = 'El campo {field} debe contener direcciones de correo válidas.';
$lang['form_validation_valid_url'] = 'El campo {field} debe contener una URL válida.';
$lang['form_validation_valid_ip'] = 'El campo {field} debe contener una IP válida.';
$lang['form_validation_min_length'] = 'El campo {field} debe tener al menos {param} caracteres. Por favor verifíquelo';
$lang['form_validation_max_length'] = 'El campo {field} no debe exceder {param} caracteres de longitud.';
$lang['form_validation_exact_length'] = 'El campo {field} debe tener una longitud exacta de {param} caracteres.';
$lang['form_validation_alpha'] = 'El campo {field} puede solo contener caracteres alfabéticos.';
$lang['form_validation_alpha_numeric'] = 'El campo {field} puede solo contener caracteres alfanuméricos.';
$lang['form_validation_alpha_numeric_spaces'] = 'El campo {field} puede solo contener caracteres alfanuméricos y espacios.';
$lang['form_validation_alpha_dash'] = 'El campo {field} puede solo contener caracteres alfanuméricos, guiones bajos y guiones medios.';
$lang['form_validation_numeric'] = 'El campo {field} debe solo contener números.';
$lang['form_validation_is_numeric'] = 'El campo {field} debe contener solo caracteres numéricos.';
$lang['form_validation_integer'] = 'El campo {field} debe contener un número entero.';
$lang['form_validation_regex_match'] = 'El campo {field} no tiene un formato correcto.';
$lang['form_validation_matches'] = 'El campo {field} no corresponde al campo {param}.';
$lang['form_validation_match_date'] = 'La fecha {field} debe ser mayor que {param}.';
$lang['form_validation_differs'] = 'El campo {field} debe ser diferente del campo {param}.';
$lang['form_validation_is_unique'] = 'El campo {field} debe contener un único valor.';
$lang['form_validation_is_natural'] = 'El campo {field} debe solo contener digitos.';
$lang['form_validation_is_natural_no_zero'] = 'El campo {field} debe solo contener digitos y debe ser más grande que cero.';
$lang['form_validation_decimal'] = 'El campo {field} debe contener un número decimal.';
$lang['form_validation_less_than'] = 'El campo {field} debe contener un número menor que {param}.';
$lang['form_validation_less_than_equal_to'] = 'El campo {field} debe contener un número menor o igual a {param}.';
$lang['form_validation_greater_than'] = 'El campo {field} debe contener un número más grande que {param}.';
$lang['form_validation_greater_than_equal_to'] = 'El campo {field} debe contener un número más grande o igual a {param}.';
$lang['form_validation_error_message_not_set'] = 'No se puede acceder a un mensaje de error que corresponde al campo {field}.';
$lang['form_validation_in_list'] = 'El campo {field} debe ser uno de: {param}.';
$lang['form_validation_password_strong'] = 'El campo {field} debe tener una longitud mínima de 8 caracteres. Debe contener al menos una letra mayúscula, una minúscula, 3 dígitos y 3 caracteres especiales. Caracteres especiales permitidos: -+%#.,;:';
$lang['form_validation_valid_pass'] = 'El campo {field} debe tener una longitud mínima de 8 caracteres. Debe contener al menos una letra mayúscula, una minúscula, 1 dígito y 1 caracter especial.';
$lang['form_validation_alpha_accent_space'] = 'El campo {field} solo puede contener caracteres alfabéticos, acentos y espacios.';
$lang['form_validation_alpha_numeric_accent_space'] = 'El campo {field} solo puede contener caracteres alfanuméricos, acentos y espacios.';
$lang['form_validation_alpha_numeric_accent_space_dot'] = 'El campo {field} solo puede contener caracteres alfanuméricos, acentos, espacios, comas y puntos.';
$lang['form_validation_validate_url'] = 'El campo {field} debe contener una URL válida.';
$lang['form_validation_validate_date'] = 'El campo {field} debe contener una fecha válida; con el formato yyyy/mm/dd';
$lang['form_validation_validate_date_dd_mm_yyyy'] = 'El campo {field} debe contener una fecha válida; con el formato dd-mm-yyyy';
//valid_pass_user
$lang['form_validation_valid_pass_user'] = 'El campo {field} debe tener una longitud mínima de 8 caracteres. Debe contener al menos una letra mayúscula, una minúscula, 1 dígito y 1 caracter especial.';
$lang['form_validation_alpha_accent_space_dot_quot'] = 'El campo {field} solo puede contener caracteres alfabéticos, acentos, puntos y espacios.';
$lang['form_validation_alpha_numeric_accent_slash'] = 'El campo {field} solo puede contener caracteres alfanuméricos, acentos y diagonal.';
$lang['form_validation_alpha_numeric_accent_space_dot_parent'] = 'El campo {field} solo puede contener caracteres alfanuméricos, acentos, espacios, comas, puntos, espacios, paréntesis y diagonal.';
$lang['form_validation_alpha_numeric_accent_space_dot_double_quot'] = 'El campo {field} solo puede contener caracteres alfanuméricos, acentos, espacios, comas, puntos, espacios, paréntesis y diagonal';
$lang['form_validation_radio_buttom_validation'] = 'Debe seleccionar {field} ';

$lang['form_validation_check_captcha'] = 'Por favor introduce correctamente los caracteres';

$lang['form_validation_exist_a_lowercase'] = 'El campo {field} debe contener al menos una minúscula. Favor de verificarlo.';
$lang['form_validation_exist_a_upercase'] = 'El campo {field} debe contener al menos una mayúscula. Favor de verificarlo.';
$lang['form_validation_exists_a_aspecial_character_password'] = 'El campo {field} debe contener al menos un carácter especial, como: */_+-. Por favor verifíquelo.';
$lang['form_validation_exist_a_number'] = 'El campo {field} debe contener al menos un número arábigo. Favor de verificarlo.';
$lang['form_validation_valida_correo_electronico'] = 'El campo {field} no es valido.';
/*Validaciones exclusivas de sipimss*/
//El campo Contraseña debe contener al menos un número arábigo. Favor de verificarlo.”
$lang['form_validation_valida_fecha_inicio_menor_fecha_fin'] = 'El campo {field} debe ser menor a la fecha término.';
$lang['form_validation_valida_fecha_fin_mayor_inicio'] = 'El campo {field} debe ser mayor a la fecha inicio.';
$lang['form_validation_is_folio_comprobante_unico'] = 'El campo {field} ya existe.';
$lang['form_validation_valida_date_duracion_fecha_inicial'] = 'El campo {field} debe ser menor a la fecha término. ';
$lang['form_validation_valida_date_duracion_fecha_final'] = 'El campo {field} no debe ser mayor a la fecha inicio. ';
$lang['form_validation_valida_date_certificado_concejo_fecha_inicial'] = 'El campo {field} debe ser menor a la fecha término. ';
$lang['form_validation_valida_date_certificado_concejo_fecha_final'] = 'El campo {field} debe ser mayor a la fecha inicio. ';
$lang['form_validation_valida_file_certificado_concejo'] = 'El campo {field} debe contener un archivo. ';
$lang['form_validation_required_depends'] = 'El campo {field} es obligatorio. ';
$lang['form_validation_obliga_actualiza_certificado'] = 'El campo {field} debe ser actualizado. ';
$lang['form_validation_not_space'] = 'El campo {field} no debe contener espacios';
$lang['form_validation_ciclos_clinicos_fecha_maxima'] = 'El campo {field} es mayor a la esperada, por favor consulte ayudas';
$lang['form_validation_fecha_maxima_indicada'] = 'El campo {field} debe ser menor';
$lang['form_validation_field_required_depends'] = 'El campo {field} es obligatorio. ';
$lang['form_validation_folio_comprobante_unico_docente_seccion'] = 'El campo {field} ya existe. ';
$lang['form_validation_anio_menor_actual'] = 'El campo {field} debe ser menor o igual que el actual. ';
$lang['form_validation_fecha_menor_actual'] = 'El campo {field} debe ser menor o igual que la actual. ';
$lang['form_validation_is_unico_datos_usuarios'] = 'El campo {field} ya ha sido registrado.';
$lang['form_validation_is_valido_rango_calificacion'] = 'La calificación  del campo {field} no se encuentra en el rango seleccionado.';
$lang['form_validation_alpha_nombre_nomina'] = 'El campo {field} solo puede contener caracteres alfabéticos (A a la Z) y espacios.';

/*

alpha_accent_space_dot_quot
 *
alpha_numeric_accent_slash
 *
alpha_numeric_accent_space_dot_parent
 *
alpha_numeric_accent_space_dot_quot
 *
alpha_numeric_accent_space_dot_double_quot

*/
