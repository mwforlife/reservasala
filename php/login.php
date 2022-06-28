<?php
require 'controller.php';

$c = new Controller();

$correo = $_POST['login__email'];
$password = sha1($_POST['login__password']);

$result = $c->IniciarSession($correo, $password);
if ($result == 1) {
    echo "1";
} else {
    echo "3";
}