<?php

error_reporting(0);
/////// CONEXIÓN A LA BASE DE DATOS /////////
include("../../configuracion/conexionMysqli.php");

	$proyecto=$conexion->real_escape_string($_POST['proyecto']);
	$user = $_SESSION['id'];
	$tabla=$conexion->real_escape_string($_POST['tabla']);
	$consulta=$conexion->real_escape_string($_POST['consulta']);
	$camposMostrar=$conexion->real_escape_string($_POST['camposMostrar']);
	$formato=$conexion->real_escape_string($_POST['formato']);
	$nombreArchivo=$conexion->real_escape_string($_POST['nombreArchivo']);
	$ultimoCambio = time();

	$stmt = $conexion->prepare("INSERT INTO reportes (proyecto, user, tabla, consulta, campos, formato, nombreArchivo, ultimoCambio) VALUES (?,?,?,?,?,?,?,?)");
	$stmt->bind_param("ssssssss", $proyecto, $user, $tabla, $consulta, $camposMostrar, $formato, $nombreArchivo, $ultimoCambio); 
	$stmt->execute();
	$id = $conexion->insert_id;
	$stmt -> close();


	if (!$stmt) {
		echo 'error';
	}else {
		echo 'success';
	}


?>
