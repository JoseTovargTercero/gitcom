<?php
include('../../../configuracion/conexionMysqli.php');




$poste = $_POST['poste'];
$radiImg = $_POST['radiImg'];


       /*
var src = result[0];
var ltd = result[1];
var lng = result[2];
var capa = result[3];
*/

$insertar = "UPDATE postes SET rotate='$radiImg' WHERE id='$poste'";
$result = mysqli_query( $conexion, $insertar );



	$query = "SELECT * FROM postes WHERE id='$poste'";
	$search = $conexion->query($query);
	if ($search->num_rows > 0) {
		while ($row = $search->fetch_assoc()) {

			if ($row['status'] == 1) {
				$src = 'cl/' . $row['rotate'] . '-cl';
			} else {
				$src = 'sl/' . $row['rotate'] . '-sl';
			}



			echo $src.'*'.$row['ltd'].'*'.$row['lng'].'*'.$row['capa'];

		}
	}




?>