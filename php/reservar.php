<?php
session_start();
require 'controller.php';

$c = new Controller();

$cantidad = $_POST['cantidad'];
$sala = $_POST['sala'];
$curso = $_POST['curso'];
$asignatura = $_POST['asignatura'];
$fecha = $_POST['date'];
$bloque = $_POST['options'];

if (strlen($cantidad) > 0 && strlen($sala) > 0 && strlen($curso) > 0 && strlen($asignatura) > 0 && strlen($fecha) > 0 && strlen($bloque) > 0) {
   $result = $c->registrarreserva($cantidad, $sala, $asignatura,$fecha,$curso, $bloque, $_SESSION['id']);
   if ($result == 'true') {
    echo 1;
   }else{
    echo 0;
   }
}else{
    echo 2;
}

