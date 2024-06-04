<?php

$usuario = 'ricardo';
$contrasena = '^ZwYa^.?hT7&';
$baseDeDatos = 'gitcom';
$conexion = new mysqli('localhost', $usuario, $contrasena, $baseDeDatos); 
$conexion->set_charset('utf8'); 

if ($conexion->connect_error) {
    die('Error de conexi¨®n: ' . $conexion->connect_error);
}
/* ---------- */


echo 'Consulta b&aacute;sica: <br>';
$queryShp = "SELECT * FROM `inf_casas` LIMIT 5";
$searchShp = $conexion->query($queryShp);
if ($searchShp->num_rows > 0) {
	while ($M3 = $searchShp->fetch_assoc()) {
	 // off -> OK
		echo $M3['id_vivienda'] . ' - ' . $M3['coordenada_este'].','.$M3['coordenada_norte'].'<br>';

	}
}





echo '<br><br><br>Consulta preparada: <br>';

$stmt_access = mysqli_prepare($conexion, "SELECT * FROM `inf_casas` LIMIT 5");
$stmt_access->execute();
$result_access = $stmt_access->get_result();
if ($result_access->num_rows > 0) {
  while ($row_access = $result_access->fetch_assoc()) {
	
	
	echo $row_access['id_vivienda'] . ' - ' . $row_access['coordenada_este'].','.$row_access['coordenada_norte'].'<br>';

  }
}
echo 'No se ejecuta';




?>