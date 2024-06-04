<?php

include('../../configuracion/conexionMysqli.php');

$query = "SELECT * FROM local_comunidades WHERE id_comuna='$_GET[pais_id]' AND id_user=''";
$search = $conexion->query($query);
if ($search->num_rows > 0) {
	echo '<option value="">Seleccione..</option>';
    while ($row = $search->fetch_assoc()) {
		echo "<option value='".$row['id_consejo']."'>&nbsp;".$row['nombre_c_comunal']."</option>";

    }
}

?>