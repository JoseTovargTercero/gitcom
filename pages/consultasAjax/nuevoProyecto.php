<?php

error_reporting(0);
/////// CONEXIÓN A LA BASE DE DATOS /////////
include("../../configuracion/conexionMysqli.php");

$instancia = $conexion->real_escape_string($_POST['instancia']);
$categoria = $conexion->real_escape_string($_POST['categoria']);
$nombre = $conexion->real_escape_string($_POST['nombre']);
$descripcion = $conexion->real_escape_string($_POST['descripcion']);
$tipo = $conexion->real_escape_string($_POST['tipo']);
$participantes = $_POST['participantes'];
$instancia_def = $_POST['instancia_def'];
$user = $_SESSION['id'];
$ultimoCambio = time();

if (strlen($participantes) < 1) {
	$cf = '1';
} else {
	$cf = '0';
}


$stmt = $conexion->prepare("INSERT INTO proyectos (user, nombre, descripcion, tipo, ultimoCambio, instancia, categoria, confirmar, instancia_def) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $user, $nombre, $descripcion, $tipo, $ultimoCambio, $instancia, $categoria, $cf, $instancia_def);
$stmt->execute();
$id = $conexion->insert_id;
$stmt->close();


if (strlen($participantes) > 0) {
	$part = explode(',', $participantes);
	foreach ($part as $value) {
		$stmt = $conexion->prepare("INSERT INTO proyectos_colaboradores (proyecto, user) VALUES (?, ?)");
		$stmt->bind_param("ss", $id, $value);
		$stmt->execute();
		$stmt->close();
	}
}

if (!$stmt) {
	echo 'error';
} else {
	echo $id;
}
