<?php
include('../configuracion/conexionMysqli.php');


$stmt = mysqli_prepare($conexion, "SELECT H.id, H.cedula, PS.CATEGORIA  FROM inf_habitantes AS H
INNER JOIN atencion_social AS PS ON PS.CEDULA = H.cedula
 WHERE H.cedula != 'N_C' ");

$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
	$c = 1;
	while ($row = $result->fetch_assoc()) {
		$id = $row["id"];
		$cedula = $row["cedula"];
		$categoria = $row["CATEGORIA"];

		// update inf_habitantes set proteccion_social = 1 where id = $id
		$stmt_update = mysqli_prepare($conexion, "UPDATE inf_habitantes SET proteccion_social = '$categoria' WHERE id = ?");
		$stmt_update->bind_param("i", $id);
		$actualizado = 'no';

		if ($stmt_update->execute()) {
			$actualizado = 'si';
		}



		echo $c . ' - ' . $cedula . ' - ' . $categoria . ' - ' . $actualizado . '<br>';
		$c++;
	}
}


$stmt->close();

