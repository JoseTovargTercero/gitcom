<?php
include('../configuracion/conexionMysqli.php');

if ($_SESSION["nivel"] != '') {
    // Definir columnas a ignorar
    $columnas_ignorar = ["CASA", "calle", ""]; // Reemplaza con los nombres reales de las columnas a excluir

    // Consultar datos de inf_habitantes
    $stmt = mysqli_prepare($conexion, "SELECT * FROM `inf_habitantes`");
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            foreach ($row as $key => $value) {
                if (!in_array($key, $columnas_ignorar)) { // Verifica si la columna está en la lista de exclusión
                    $data[$key][] = $value; // Agrupar valores por columna
                }
            }
        }
    }
    $stmt->close();

    // Eliminar valores duplicados en cada columna
    foreach ($data as $key => $values) {
        $data[$key] = array_values(array_unique($values));
    }

    // Devolver JSON
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
}




/*
NO  {
    grupoIntercambio
    hogares_de_la_patria
    ETS


} = ''





************************

'' {
    hogares_de_la_patria
    id_comuna
}

*/
