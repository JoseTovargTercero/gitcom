<?php
include('../configuracion/conexionMysqli.php');


header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");



//header json
header('Content-Type: application/json');
//recibir los datos de inputs json
$datos = json_decode(file_get_contents('php://input'), true);
$identificador = $datos['identificador'];


$stmt = mysqli_prepare($conexion, "SELECT HA.nombre, HA.sexo, CA.*, MCP.nombre_municipio, PQ.nombre_parroquia, CAS.nombre_comuna, COM. nombre_c_comunal FROM `inf_habitantes` AS HA
LEFT JOIN inf_casas AS CA ON CA.id_vivienda = HA.id_vivienda
LEFT JOIN local_municipio AS MCP ON MCP.id_municipio = CA.id_municipio
LEFT JOIN local_parroquia AS PQ ON PQ.id_parroquias = CA.id_parroquia
LEFT JOIN local_comunas AS CAS ON CAS.id_Comuna = CA.id_comuna
LEFT JOIN local_comunidades AS COM ON COM.id_consejo = CA.id_c_comunal
WHERE identificador = ?");
$stmt->bind_param('s', $identificador);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    }
}
$stmt->close();
