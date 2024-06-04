<?php
include('../configuracion/conexionMysqli.php');

if ($_SESSION["nivel"] != '') {
	$s = '1';
	$p = $_GET['p'];
	$idUser = $_SESSION["id"];

	$query_p = "SELECT * FROM proyectos WHERE user='$idUser' AND id='$p'";
    $buscarMa = $conexion->query($query_p);
    if ($buscarMa->num_rows > 0) {

		$stmt2 = $conexion->prepare("UPDATE `proyectos` SET `confirmar`='1' WHERE id= ?");
		$stmt2->bind_param("s", $p);
		$stmt2->execute();
		$stmt2 -> close();

		

    }
}
?>