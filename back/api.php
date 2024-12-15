<?php
// Configuración de CORS
header("Access-Control-Allow-Origin: http://localhost"); // Permitir el dominio de origen
//header("Access-Control-Allow-Origin: https://sigep-amazonas.com"); // Permitir el dominio de origen
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Encabezados permitidos
header("Access-Control-Allow-Credentials: true"); // Si es necesario enviar cookies u otras credenciales
header('Content-Type: application/json');

// Manejo de solicitudes preflight (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204); // Sin contenido
    exit(0);
}


include('../configuracion/conexionMysqli.php');


try {
    // Verificar si los datos JSON son válidos
    $datos = json_decode(file_get_contents('php://input'), true);
    if (!$datos || !isset($datos['identificador'])) {
        throw new Exception("Datos JSON inválidos o campo 'identificador' faltante.");
    }

    $identificador = $datos['identificador'];

    // Preparar la consulta
    $stmt = mysqli_prepare($conexion, "SELECT HA.nombre, HA.sexo, CA.*, MCP.nombre_municipio, PQ.nombre_parroquia, CAS.nombre_comuna, COM.nombre_c_comunal
        FROM `inf_habitantes` AS HA
        LEFT JOIN inf_casas AS CA ON CA.id_vivienda = HA.id_vivienda
        LEFT JOIN local_municipio AS MCP ON MCP.id_municipio = CA.id_municipio
        LEFT JOIN local_parroquia AS PQ ON PQ.id_parroquias = CA.id_parroquia
        LEFT JOIN local_comunas AS CAS ON CAS.id_Comuna = CA.id_comuna
        LEFT JOIN local_comunidades AS COM ON COM.id_consejo = CA.id_c_comunal
        WHERE cedula = ?");

    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: " . mysqli_error($conexion));
    }

    $stmt->bind_param('s', $identificador);
    if (!$stmt->execute()) {
        throw new Exception("Error al ejecutar la consulta: " . mysqli_error($conexion));
    }

    $result = $stmt->get_result();

    // Verificar resultados
    if ($result->num_rows > 0) {
        $response = [];
        while ($row = $result->fetch_assoc()) {
            $response[] = $row;
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    } else {
        echo json_encode(['message' => 'No se encontraron resultados']);
    }

    $stmt->close();
} catch (Exception $e) {
    // Manejar errores y devolverlos como JSON
    http_response_code(500);
    echo json_encode(['el error es: ' => $e->getMessage()]);
}
