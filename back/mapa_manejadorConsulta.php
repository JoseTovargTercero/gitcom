<?php
header('Content-Type: application/json');
include('../configuracion/conexionMysqli.php');

$response = ['status' => 'error', 'message' => 'Acción no válida'];

if (isset($_POST['accion'])) {
    if ($_POST['accion'] == 'add') {
        $proyecto = $_POST['proyecto'] ?? null;
        $resultado = $_POST['resultado'] ?? null;
        $nombreCapa = $_POST['nombreCapa'] ?? null;
        $perso = $_POST['perso'] ?? null;
        $tipo = $_POST['tipo'] ?? null;
        $idUser = $_SESSION['id'] ?? null;

        $stmt = $conexion->prepare("INSERT INTO consultas_almacenadas (user, proyecto, nombreCapa, consulta, tipo, icono) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissss", $idUser, $proyecto, $nombreCapa, $resultado, $tipo, $perso);

        if ($stmt->execute()) {
            $response = ['status' => 'success', 'message' => 'Consulta almacenada correctamente'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error al almacenar la consulta: ' . $conexion->error];
        }
        $stmt->close();

    } elseif ($_POST['accion'] == 'del') {
        $id = $_POST['id'] ?? null;
        $idUser = $_SESSION['id'] ?? null;

        if ($id && $idUser) {
            // Seguridad: Solo el dueño puede borrar su consulta
            $stmt = $conexion->prepare("DELETE FROM consultas_almacenadas WHERE id = ? AND user = ?");
            $stmt->bind_param("ii", $id, $idUser);

            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $response = ['status' => 'success', 'message' => 'Consulta eliminada correctamente'];
                } else {
                    $response = ['status' => 'error', 'message' => 'No se encontró la consulta o no tiene permisos'];
                }
            } else {
                $response = ['status' => 'error', 'message' => 'Error al eliminar la consulta: ' . $conexion->error];
            }
            $stmt->close();
        } else {
            $response = ['status' => 'error', 'message' => 'ID no proporcionado o sesión no válida'];
        }
    }
}

echo json_encode($response);
