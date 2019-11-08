<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// HELPER General
/**
 * Método que utiliza el API de zammad para envío de información
 * @autor 		: JZDP
 */
class Zammad {

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('session');
    }

    public function create_ticket($datos = array()){
        if(!empty($datos)){
            require_once(APPPATH.'libraries/zammadAPI/vendor/autoload.php');
            require_once(APPPATH.'libraries/zammadAPI/config.php');
            //require __DIR__ . '/../vendor/autoload.php';
            //require __DIR__ . '/config.php';

            //use ZammadAPIClient\Client;
            //use ZammadAPIClient\ResourceType;
            //pr($zammad_api_client_config);
            $client = new ZammadAPIClient\Client($zammad_api_client_config);
            //pr($client);
            /*pr($datos);
            $subject_name = $_POST['subject_name'];
            $user_message = $datos['descripcion'];
            $user_email = $_POST['user_email'];
            $matricula = $_POST['matricula'];*/
            //print_r($_POST);
            $subject_name = "Tickets zammad";
            $user_message = $datos['descripcion'];
            $user_email = $datos['correo'];

            $ticket_data = [
                'group_id'    => 3,
                'priority_id' => 1,
                'state_id'    => 1,
                'title'       => $subject_name,
                'customer_id' => "guess:$user_email",
                //'matricula'   => $datos['matricula'],
                'article'     => [
                    'subject' => $subject_name,
                    'body'    => $user_message,
                ],
            ];
            foreach ($datos as $key => $value) { ///Añadir a ticket los valores que se obtienen del formulario
                $ticket_data += array($key=>$value);
            }

            $ticket = $client->resource( ZammadAPIClient\ResourceType::TICKET );
            $ticket->setValues($ticket_data);
            $ticket->save();
            //pr($ticket);
            $this->exitOnError($ticket);

            ////////////////////////////////Información de cliente
            $ticket_id = $ticket->getID(); //Obtener datos de cliente agregado
            $ticket = $client->resource( ZammadAPIClient\ResourceType::TICKET )->get($ticket_id);
            $this->exitOnError($ticket);
            echo "<pre>";
            echo "/////////////////////////////////////////////////////////////////";
            echo "valores de ticket";
            print_r($ticket->getValue('customer_id'));
            echo "/////////////////////////////////////////////////////////////////";
            echo "</pre>";

            ////////////////////////////////Información de usuario
            $user_data = [
                'id' => $ticket->getValue('customer_id'),
                'firstname' => $datos['nombre'],
                'lastname' => $datos['apellido_paterno'].' '.$datos['apellido_materno'],
                'email' => $user_email,
                'matricula' => $datos['matricula'],
            ];
            //array_push($user_data, $datos);
            foreach ($datos as $key => $value) { ///Añadir a ticket los valores que se obtienen del formulario
                $user_data += array($key=>$value);
            } 
            
            $user = $client->resource( ZammadAPIClient\ResourceType::USER );
            //$user = $client->resource( ZammadAPIClient\ResourceType::USER )->update($ticket->getValue('customer_id'));
            $user->setValues($user_data);
            $user->save();
            if($user->isDirty()) {
                echo "Ocurrió un error durante la actualización del usuario.";
            }

            $this->exitOnError($user);
            
            return "Ticket creado correctamente, recibirá un correo electrónico con más información.";
        }
    }

    private function exitOnError($object)
    {
        if ( $object->hasError() ) {
            print $object->getError() . "\n";
            exit(1);
        }
    }

    /*public function token() {
        $this->CI->session->set_userdata('token', $this->crear_token());
        return;
    }*/

}
