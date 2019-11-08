<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['email'] = Array(
	'debug' => 1,
    /*'protocol' => 'smtp',
	'crypt' => 'tls',
    //'host' => 'tls://smtp.gmail.com',
    'host' => 'smtp.gmail.com',
    'port' => 587,
    //'port' => 465,
    'username' => 'sied.ad.imss@gmail.com',
    'password' => 's13d.4d.1mss',
    'mailtype'  => 'html',
    'charset'   => 'utf-8',
    'validate'  => true,*/

    'host' => 'smtp.gmail.com',
    'port' => 587,
    'crypt' => 'tls',
    'username' => "sied.ad.imss@gmail.com",
    'password' => "s13d.4d.1mss",
    'setFrom' => array('email'=>'sied.ad.imss@gmail.com', 'name'=>'Foro Nacional e Internacional de Educación en Salud'),
    /*'SMTPOptions' => array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    )*/

    /*'host' => 'aspmx.l.google.com',
    'port' => 25,
    'crypt' => 'ssl',
    'username' => "sied.ad.imss@gmail.com",
    'password' => "s13d.4d.1mss",
    'validate'  => false,
    'setFrom' => array('email'=>'sied.ad.imss@gmail.com', 'name'=>'Foro Nacional e Internacional de Educación en Salud'),*/


    //'username' => "cenitluis.pumas@gmail.com",
    //'password' => "el#:(vlaluna2vces",
//    'setFrom' => array('email'=>'cenitluis.pumas@gmail.com', 'name'=>'SIPIMSS')

	//Correo IMSS
    // 'debug' => 1,
    /*'host' => 'smtp.1and1.mx',
    'port' => "587",
    'crypt' => 'TLS',
    'username' => "postmaster@kaliashop.me",
    'password' => "Banana123.",
    'setFrom' => array('email'=>'soporte.fnies@gmail.com', 'name'=>'Foro Nacional e Internacional de Educación en Salud')*/
);
