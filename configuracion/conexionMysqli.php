<?php

$usuario = 'root';
$contrasena = '';
$baseDeDatos = 'gitcom';


$conexion = new mysqli('localhost', $usuario, $contrasena, $baseDeDatos);
$conexion->set_charset('utf8');

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}


error_reporting(0);
date_default_timezone_set('America/Manaus');
session_start();
