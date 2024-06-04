<?php
include('../configuracion/conexionMysqli.php');

if ($_SESSION["nivel"] != '') {
	$c = $_GET['c'];
	$s = $_GET['s'];
	$id = $_SESSION["id"];

	switch ($c) {
		case 'p_1':
			$campo = 'disponible_p';
			break;
		case 'p_2':
			$campo = 'notificacion_c';
			break;
	}

	echo $s;
	$stmt2 = $conexion->prepare("UPDATE `sist_usuarios` SET `$campo`= ? WHERE id=?");
	$stmt2->bind_param("ss", $s, $id);
	$stmt2->execute();
	$stmt2 -> close();

}

