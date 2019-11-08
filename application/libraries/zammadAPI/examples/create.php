<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/config.php';

use ZammadAPIClient\Client;
use ZammadAPIClient\ResourceType;

$client = new Client($zammad_api_client_config);

//
// Create a ticket
//
$ticket_text = 'API test ticket';

function exitOnError($object)
{
    if ( $object->hasError() ) {
        print $object->getError() . "\n";
        exit(1);
    }
}


if(isset($_POST['subject_name']) && (trim($_POST['subject_name']) != '') 
    && isset($_POST['user_message']) && (trim($_POST['user_message']) != '')) {
    $subject_name = $_POST['subject_name'];
    $user_message = $_POST['user_message'];
    $user_email = $_POST['user_email'];
    $matricula = $_POST['matricula'];
    //print_r($_POST);

    $ticket_data = [
        'group_id'    => 1,
        'priority_id' => 1,
        'state_id'    => 1,
        'title'       => $subject_name,
        'customer_id' => "guess:$user_email",
        'matricula'   => $matricula,
        'article'     => [
            'subject' => $subject_name,
            'body'    => $user_message,
        ],
    ];

    $ticket = $client->resource( ResourceType::TICKET );
    $ticket->setValues($ticket_data);
    $ticket->save();
    exitOnError($ticket);

    $ticket_id = $ticket->getID(); // same as getValue('id')
    /*$cliente_ID = $ticket->getValue('customer_id');
    echo "<pre>";
    print_r($ticket->getValue('customer_id'));
    echo "</pre>";*/

    ////////////////////////////////Información de usuario
    $user_data = [
        'email' => $user_email,
        'matricula'   => $matricula,
    ];
    $user = $client->resource( ResourceType::USER );
    $user->setValues($user_data);
    $user->save();

    exitOnError($user);
    
    echo "Ticket creado correctamente, recibirá un correo electrónico con más información.";
} else {
    echo "Información incorrecta.";
}
