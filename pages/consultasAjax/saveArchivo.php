<?php

error_reporting(0);
/////// CONEXIÓN A LA BASE DE DATOS /////////
include("../../configuracion/conexionMysqli.php");

$proyecto = $conexion->real_escape_string($_POST['proyecto']);
$user = $_SESSION['id'];
$tabla = $conexion->real_escape_string($_POST['tabla']);
$consulta = $conexion->real_escape_string($_POST['consulta']);
$camposMostrar = $conexion->real_escape_string($_POST['camposMostrar']);
$formato = $conexion->real_escape_string($_POST['formato']);
$nombreArchivo = $conexion->real_escape_string($_POST['nombreArchivo']);
$ultimoCambio = time();
$mcp = $conexion->real_escape_string($_POST['mcp']) ?? null;
$paq = $conexion->real_escape_string($_POST['paq']) ?? null;
$cma = $conexion->real_escape_string($_POST['cma']) ?? null;
$cmia = $conexion->real_escape_string($_POST['cmia']) ?? null;

$tablas = array(
	'1' => 'inf_casas',
	'2' => 'inf_habitantes'
);

$filtro_localidad = null;
if (!empty($mcp)) {
	$filtro_localidad = $tablas[$tabla] . '.id_municipio = ' . $mcp;
}
if (!empty($paq)) {
	$filtro_localidad .= ' AND ' . $tablas[$tabla] . '.id_parroquia = ' . $paq;
}
if (!empty($cma)) {
	$filtro_localidad .= ' AND ' . $tablas[$tabla] . '.id_comuna = ' . $cma;
}
if (!empty($cmia)) {
	$filtro_localidad .= ' AND ' . $tablas[$tabla] . '.id_c_comunal = ' . $cmia;
}

if ($filtro_localidad != null) {
	$filtro_localidad = ' AND (' . $filtro_localidad . ')';
}




$stmt = $conexion->prepare("INSERT INTO reportes (proyecto, user, tabla, consulta, campos, formato, nombreArchivo, ultimoCambio, filtro_localidad) VALUES (?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssssssss", $proyecto, $user, $tabla, $consulta, $camposMostrar, $formato, $nombreArchivo, $ultimoCambio, $filtro_localidad);
$stmt->execute();
$id = $conexion->insert_id;
$stmt->close();


if (!$stmt) {
	echo 'error';
} else {
	echo 'success';
}
