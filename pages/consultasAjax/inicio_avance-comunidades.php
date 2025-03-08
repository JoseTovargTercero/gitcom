<?php
include('../../configuracion/conexionMysqli.php');
include('../../class/count.php');

$comuna = $_POST['comuna'];
$data = [];

$stmt = mysqli_prepare($conexion, "SELECT * FROM local_comunidades WHERE id_comuna= ?");
$stmt->bind_param('s', $comuna);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $viviendas = contar('inf_casas', $row['id_consejo'], 'id_c_comunal');
    $personas = contar('inf_habitantes', $row['id_consejo'], 'id_c_comunal');
    $fase = 0;

    if ($viviendas > 0) {
      $fase = 1;
    }
    if ($personas > 0) {
      $fase = 2;
    }

    $data[$row['id_consejo']] = [
      'comunidad' => $row['nombre_c_comunal'],
      'viviendas' => $viviendas,
      'personas' => $personas,
      'fase' => $fase
    ];
  }
}
$stmt->close();

echo json_encode($data);
