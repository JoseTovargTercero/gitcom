<?php
	include('../../configuracion/conexionMysqli.php');


	$aca_problema = $_POST['aca_problema'];
	$aca_nudosCriticos = $_POST['aca_nudosCriticos'];
	$aca_potencialidades = $_POST['aca_potencialidades'];
	$aca_solucion = $_POST['aca_solucion'];
	$aca_ente = $_POST['aca_ente'];
	$aca_id = $_POST['id'];

	//update
	$sql = "UPDATE `aca_resultado` SET `problema`='$aca_problema',`nudos`='$aca_nudosCriticos',`potencialidades`='$aca_potencialidades',`soluciones`='$aca_solucion',`ejecutor`='$aca_ente' WHERE `id`='$aca_id'";
	$result = $conexion->query($sql);
	if($result){
		echo "1";
	}else{
		echo "0";
	}


?>