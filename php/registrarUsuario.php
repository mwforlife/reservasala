<?php
require 'controller.php';

$c = new Controller();

$rut = $_POST['ruttxt'];
$nombre = $_POST['nomtxt'];
$apellido = $_POST['apetxt'];
$email = $_POST['ematxt'];
$password = $_POST['pastxt'];
$token = sha1($email);

if (strlen($rut) == 12 && strlen($nombre) > 3 && strlen($apellido) > 3 && strlen($email) > 10 && strlen($password) > 3) {
    $password = sha1($password);
    $result = $c->comprobarusuario($rut, $email);
    if ($result == 0) {
        $result = $c->registrarUsuarios($rut, $nombre, $apellido, 3, $email, $password, $token);
        if ($result == 'true') {
            echo "1";
        } else {
            echo "3";
        }
    } else {
        echo "2";
    }
}else{
    echo "3";
}