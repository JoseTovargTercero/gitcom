<?php
include('../configuracion/conexionMysqli.php');

if ($_SESSION["nivel"] != '') {
	$p = $_GET['p'];
	$m = $_GET['m'];
	$idUser = $_SESSION["id"];

	$query_p = "SELECT * FROM proyectos WHERE user='$idUser' AND id='$p'";
    $buscarMa = $conexion->query($query_p);
    if ($buscarMa->num_rows > 0) {

		$stmt2 = $conexion->prepare("UPDATE `proyectos` SET `raster`=? WHERE id= ?");
		$stmt2->bind_param("ss", $m, $p);
		$stmt2->execute();
		$stmt2 -> close();

		echo '1';
		

    }
}
?>