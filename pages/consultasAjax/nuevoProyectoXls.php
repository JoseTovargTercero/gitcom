<?php

error_reporting(0);
/////// CONEXIÓN A LA BASE DE DATOS /////////
include("../../configuracion/conexionMysqli.php");

	$nombreArchivo=$conexion->real_escape_string($_POST['nombreArchivo']);
	$tipoEstatusX=$conexion->real_escape_string($_POST['tipoEstatusX']);
	$user = $_SESSION['id'];
	$ultimoCambio = time();
	$reporte = '1';


	$stmt = $conexion->prepare("INSERT INTO proyectos (user, nombre, tipo, ultimoCambio, reporte) VALUES (?, ?, ?, ?, ?)");
	$stmt->bind_param("sssss", $user, $nombreArchivo, $tipoEstatusX, $ultimoCambio, $reporte); 



	if ($stmt->execute()) {
		$id = $conexion->insert_id;
		$stmt -> close();
		echo json_encode(['status' => 'success', 'id' => $id]);
	}else {
		echo json_encode(['status' => 'Error: ' . $stmt->error]);
	}


?>
