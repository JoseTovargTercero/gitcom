<?php
	include('../configuracion/conexionMysqli.php');
	include("../class/clearDates.php");


if ($_SESSION['id'] && $_SESSION['rand']) {
	$id = $_SESSION['id'];
	$tk = $_SESSION['rand'];

	$stmt = mysqli_prepare($conexion, "SELECT * FROM sist_usuarios WHERE id=? AND u_token=? AND status='0' LIMIT 1");
	$stmt->bind_param("is", $id, $tk);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {

			$stmt = $conexion->prepare("UPDATE `sist_usuarios` SET `u_token`= '' WHERE id='$id'");
			$stmt->execute();
		
			$_SESSION['nombre']=$row['nombreUser'];
			$_SESSION['darkMode']=$row['darkMode'];
			$_SESSION['nivel']=$row['nivel'];
			$_SESSION['id']=$row['id'];
			$_SESSION["validate"] = "ok";
			$_SESSION["status"] = $row['status'];
			$_SESSION["origen"] = $row['origen'];
			$_SESSION["dato1"] = $row['dato1'];
			$_SESSION["dato2"] = $row['dato2'];


			if ($row['nivel'] == 4) {
				$query2 = "SELECT local_comunidades.nombre_c_comunal, local_comunas.nombre_comuna  FROM local_comunidades 
				LEFT JOIN local_comunas ON local_comunas.id_Comuna = local_comunidades.id_comuna
				WHERE local_comunidades.id_consejo='$row[dato2]' LIMIT 1";
				$search2 = $conexion->query($query2);
				if ($search2->num_rows > 0) {
				  while ($row2 = $search2->fetch_assoc()) {
					$_SESSION["entidad_pre"] = $row2['nombre_comuna'];
					$_SESSION["entidad"] = $row2['nombre_c_comunal'];
				  }
				}
			  }else{
					$_SESSION["entidad"] = $row2['dato2'];
					$_SESSION["entidad_pre"] = $row2['dato1'];

			  }




			$id = $_SESSION['id'];
			$nombre = $_SESSION['nombre'];
			$fecha = time();
			$nivel = $_SESSION['nivel'];

			$insert = $conexion->query("INSERT INTO log_usuarios (id_user, usuario, fecha) VALUES ('$id','$nombre','$fecha')"); 

			echo '1';
			
		}
	} else {
		echo 'false';
	}
	$stmt->close();
} else {
	echo 'false-servidor';
}
