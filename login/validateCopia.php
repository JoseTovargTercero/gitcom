<?php
include('../configuracion/conexionMysqli.php');
include("../class/clearDates.php");



if ($_SESSION['id'] && $_SESSION['rand']) {
	$id = $_SESSION['id'];
	$tk = $_SESSION['rand'];

	$stmt = mysqli_prepare($conexion, "SELECT * FROM sist_usuarios WHERE id=? AND status='0' LIMIT 1");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {

			$stmt = $conexion->prepare("UPDATE `sist_usuarios` SET `u_token`= '' WHERE id='$id'");
			$stmt->execute();

			$_SESSION['nombre'] = $row['nombreUser'];
			$_SESSION['darkMode'] = $row['darkMode'];
			$_SESSION['nivel'] = $row['nivel'];
			$_SESSION['id'] = $row['id'];
			$_SESSION["validate"] = "ok";
			$_SESSION["status"] = $row['status'];
			$_SESSION["origen"] = $row['origen'];
			$_SESSION["dato1"] = $row['dato1'];
			$_SESSION["dato2"] = $row['dato2'];

			$usuario = $row['usuario'];

			$id = $_SESSION['id'];
			$nombre = $_SESSION['nombre'];
			$fecha = time();
			$nivel = $_SESSION['nivel'];

			$insert = $conexion->query("INSERT INTO log_usuarios (id_user, usuario, fecha) VALUES ('$id','$nombre','$fecha')");

			// verifica si $usuario es un correo
			if (strpos($usuario, '@') === false) {
				$accion = 'perfil.php?actualizar=true';
			} else {
				$accion = 'index.php';
			}

			echo json_encode(['status' => true, 'page' => $accion]);
		}
	} else {
		echo json_encode(['status' => false, 'msg' => 'Incorrecto']);
	}
	$stmt->close();
} else {
	echo json_encode(['status' => false, 'msg' => 'Error de conexión']);
}
