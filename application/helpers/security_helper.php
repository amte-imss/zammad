<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// HELPER Security
// ------------------------------------------------------------------------

if ( ! function_exists('xss_clean'))
{
	/**
	 * XSS Filtering
	 *
	 * @param	string
	 * @param	bool	whether or not the content is an image file
	 * @return	string
	 */
	function xss_clean($str, $is_image = FALSE)
	{
		return get_instance()->security->xss_clean($str, $is_image);
	}
}
/**
 * Método que encripta una cadena con el algoritmo sha512
 * @autor 		: Jesús Díaz P.
 * @modified 	: 
 * @param 		: string $matricula Cadena a codificar
 * @param 		: string $contrasenia Cadena a codificar
 * @return 		: string Cadena codificada
 */
if (!function_exists('contrasenia_formato')) {
    function contrasenia_formato($matricula, $contrasenia) {
        return hash('sha512', $contrasenia . $matricula);
    }

}

if (!function_exists('crear_token')) {
    function crear_token() {
        return md5(uniqid(rand(), TRUE));
    }
}

if (!function_exists('crear_token_url')) {
    function crear_token_url() {
        return hash('sha512', uniqid(rand(), TRUE));
    }
}

/**
 * Método que codifica una cadena a base 64
 * @autor 		: Jesús Díaz P.
 * @modified 	: 
 * @param 		: string $string Cadena a codificar
 * @return 		: string Cadena codificada
 */
if(!function_exists('encrypt_base64')){
	function encrypt_base64($string){
		//return base64_encode($string); //convert_uuencode($string);
		//return strtr(base64_encode($string), '+/=', '-_*');
		return rtrim(strtr(base64_encode($string), '+/', '-_'), '=');
	}
}

/**
 * Método que decodifica una cadena en base 64
 * @autor 		: Jesús Díaz P.
 * @modified 	: 
 * @param 		: string $string Cadena a decodificar
 * @return 		: string Cadena decodificada
 */
if(!function_exists('decrypt_base64')){
	function decrypt_base64($string){
		//return base64_decode($string); //convert_uudecode($string);
		//return base64_decode(strtr($string, '-_*', '+/='));
		return base64_decode(str_pad(strtr($string, '-_', '+/'), strlen($string) % 4, '=', STR_PAD_RIGHT));
	}
}

/**
 * Método que encripta una cadena con el algoritmo sha256
 * @autor       : Jesús Díaz P.
 * @modified    : 
 * @param       : string $string Cadena a decodificar
 * @return      : string Cadena decodificada
 */
if(!function_exists('encrypt_sha256')){
    function encrypt_sha256($string) {
        return hash('sha256', $string);
    }
}

/**
 * M�todo que encripta una cadena con el algoritmo sha512
 * @autor       : Jes�s D�az P.
 * @modified    : 
 * @param       : string $string Cadena a decodificar
 * @return      : string Cadena decodificada
 */
if(!function_exists('encrypt_sha512')){
    function encrypt_sha512($string) {
        return hash('sha512', $string);
    }
}

if(!function_exists('folio_random')){
    function folio_random($limit = 6, $anadirEspecial = false) {
        $cadena_base = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; //Alfa
        $cadena_base .= '0123456789'; //N�meros
        if ($anadirEspecial) {
            $cadena_base .= '%&*_,.!'; //Caracteres especiales
        }

        $password = '';
        $limite = strlen($cadena_base) - 1;

        for ($i = 0; $i < $limit; $i++) {
            $password .= $cadena_base[rand(0, $limite)];
        }
        return $password;
    }
}

