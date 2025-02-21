<?php
include('../configuracion/conexionMysqli.php');

if ($_SESSION["nivel"] == 3) {
    header('Content-Type: application/json');

    $info = json_decode(file_get_contents("php://input"), true);

    $id = $info["id"];
    $data = $info["data"];





    // Construcción dinámica del query
    $set_clause = [];
    $values = [];

    foreach ($data as $item) {
        if ($item['valorNuevo'] != '') { // Solo actualizar si hay un nuevo valor
            $set_clause[] = "{$item['campo']} = ?";
            $values[] = $item['valorNuevo'];
        }
    }

    $set_clause[] = "fecha = ?";
    $values[] = date('Y-m-d H:s:i');

    // Si no hay valores a actualizar, salir
    if (empty($set_clause)) {
        die("No hay valores nuevos para actualizar.");
    }

    // Agregar el ID a los valores
    $values[] = $id;

    // Construir la consulta SQL
    $sql_query = "UPDATE inf_habitantes SET " . implode(", ", $set_clause) . " WHERE id = ?";

    // Preparar la consulta
    $stmt = $conexion->prepare($sql_query);

    // Crear tipos de parámetros dinámicos ("s" para strings, "i" para enteros, etc.)
    $types = str_repeat("s", count($values)); // Suponemos que todos son strings
    $stmt->bind_param($types, ...$values);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'msg' => 'Registro actualizado correctamente', 'fields' => implode(", ", $set_clause)]);
    } else {
        echo json_encode(['error' => true, 'msg' => "Error en la actualización: " . $stmt->error]);
    }

    // Cerrar conexión
    $stmt->close();
    $conexion->close();

    //  echo $sql_query;
}
