<?php
include('../configuracion/conexionMysqli.php');

if ($_SESSION["nivel"] != '') {

	$nombre = $_POST['nombre'];
	$telefono = $_POST['telefono'];
	$responsabilidad = $_POST['responsabilidad'];
	$correo = $_POST['correo'];
	$id = $_SESSION["id"];

	$stmt2 = $conexion->prepare("UPDATE `sist_usuarios` SET 
	`nombreUser`=?,
	`responsabilidad`=?,
	`usuario`=?,
	`telefono`=?
	 WHERE id=?");
	$stmt2->bind_param("sssss", $nombre, $responsabilidad, $correo, $telefono, $id);
	if ($stmt2->execute()) {
		echo json_encode(['status' => true]);
	}
	$stmt2->close();
} else {
	echo json_encode(['status' => false]);
}
