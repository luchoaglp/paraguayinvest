<?php

//ini_set('display_errors', 1);

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

define('ROOTPATH', dirname(__DIR__, 1));

require_once ROOTPATH . '/utils/Email.php';

if(isset($_POST['name']) && !empty($_POST['name']) &&
   isset($_POST['email']) && !empty($_POST['email']) &&
   isset($_POST['message']) && !empty($_POST['message']) &&
   isset($_POST['info'])) {

    $name = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])));
    $info = $_POST['info'] == 'true' ? 'Deseo recibir información de Paraguay Invest.' : 'No deseo recibir información de Paraguay Invest.';

    echo json_encode(Email::send('Solicitud de ' . $name,
        'Solicitud de Contacto',
        '<div style="color: #2155c2;">
        <h3>Solicitud de contacto</h3>
        <p>Nombre y Apellido: ' . $name . '</p>
        <p>Email: ' . $email . '</p>
        <p>Mensaje: ' . $message . '</p>
        <p>' . $info . '</p>
        </div>',
        'contacto@paraguayinvest.com'));

}
