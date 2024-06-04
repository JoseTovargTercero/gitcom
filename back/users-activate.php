<?php
include('../configuracion/conexionMysqli.php');

if ($_POST['t']) {
	$u = $_POST['u'];
	$t = $_POST['t'];
	$p = $_POST['password'];
	$passEncrypted = password_hash($p, PASSWORD_BCRYPT);

	$stmt = mysqli_prepare($conexion, "SELECT * FROM sist_solicitudes_acceso WHERE id= ? AND status='1' LIMIT 1");
	$stmt->bind_param("i", $u);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			if (password_verify($t, $row['tk'])) {
			
				$cedula = $row['cedula'];
				$responsable = $row['responsable'];
				$tipo = $row['tipo'];
				$lugar = $row['lugar'];
				$telefono = $row['telefono'];
				$usuario = $row['usuario'];

				$responsabilidad = $row['responsabilidad'];
				$dato1 = $row['dato1'];
				$lugar = $row['lugar'];
			

				$sql = "DELETE FROM sist_solicitudes_acceso WHERE id = ?";
				$resultado = $conexion->prepare($sql);
				$resultado->bind_param('s', $u);
				$resultado->execute();
				$resultado->close();


				$stmt_upt = $conexion->prepare("INSERT INTO sist_usuarios (cedula, nombreUser, responsabilidad, dato1, dato2, usuario, nivel, contrasena, origen, telefono) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$stmt_upt->bind_param("ssssssssss", $cedula, $responsable, $responsabilidad, $dato1,$lugar, $usuario, $tipo, $passEncrypted, $lugar, $telefono); 
				$stmt_upt->execute();
	
				if ($stmt_upt) { 
					echo 'acivado';
				}
				$stmt_upt -> close();


			}else {
				echo 'error_t';
			}

		}
	}else {
		echo 'error_n';
	}


	$stmt -> close();



}else {
	echo 'error_i';
}
