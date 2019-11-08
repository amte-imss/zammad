<?php

/**
 * @author Christian Garcia
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('new_captcha'))
{

    function new_captcha()
    {
        require_once dirname(__FILE__) . '/securimage/securimage.php';


        $type = array(
            Securimage::SI_CAPTCHA_STRING
            //,Securimage::SI_CAPTCHA_MATHEMATIC
            //,Securimage::SI_CAPTCHA_WORDS
        );

// Passing array of options to the constructor
        $options = array(
            'captcha_type' => array_rand($type, 1)/* use $img = new Securimage(); */
        );

        $img = new Securimage($options);

// You can customize the image by making changes below, some examples are included - remove the "//" to uncomment
$img->ttf_file        = './application/helpers/securimage/fonts/AHGBold.ttf';
//$img->captcha_type    = Securimage::SI_CAPTCHA_MATHEMATIC; // show a simple math problem instead of text
//$img->case_sensitive  = true;                              // true to use case sensitve codes - not recommended
//$img->image_height    = 90;                                // height in pixels of the image
//$img->image_width     = $img->image_height * M_E;          // a good formula for image size based on the height
//$img->perturbation    = .75;                               // 1.0 = high distortion, higher numbers = more distortion
//$img->image_bg_color  = new Securimage_Color("#0099CC");   // image background color
//$img->text_color      = new Securimage_Color("#EAEAEA");   // captcha text color
//$img->num_lines       = 8;                                 // how many lines to draw over the image
$img->line_color      = new Securimage_Color("#666666");   // color of lines over the image
//$img->image_type      = SI_IMAGE_JPEG;                     // render as a jpeg image
//$img->signature_color = new Securimage_Color(rand(0, 64),
//                                             rand(64, 128),
//                                             rand(128, 255));  // random signature color
// see securimage.php for more options that can be set
// set namespace if supplied to script via HTTP GET
        if (!empty($_GET['namespace']))
            $img->setNamespace($_GET['namespace']);

        $_SESSION['captcha_code'] = $img;
        return $img->genera_code();  // outputs the image and content headers to the browser
    }

}

if (!function_exists('check_captcha'))
{

    function check_captcha($word = null)
    {
//        pr($_SESSION);
        require_once dirname(__FILE__) . '/securimage/securimage.php';
        $img = new Securimage();
        return $img->check($word);
    }

}
