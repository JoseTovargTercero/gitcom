<?php
include('../configuracion/conexionMysqli.php');

if ($_SESSION["nivel"] != '') {

	$u = $_GET['u'];
	$s = $_GET['s'];
	$p = $_GET['p'];
	$idUser = $_SESSION["id"];

// u=4&s=1&p=18

	$query_p = "SELECT * FROM proyectos WHERE user='$idUser' AND id='$p'";
    $buscarMa = $conexion->query($query_p);
    if ($buscarMa->num_rows > 0) {
      

		$stmt2 = $conexion->prepare("UPDATE `proyectos_colaboradores` SET `mdf`= ? WHERE proyecto=? AND user=?");
		$stmt2->bind_param("sss", $s, $p, $u);
		$stmt2->execute();
		$stmt2 -> close();

		


    }
	







}

