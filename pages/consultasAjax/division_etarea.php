<?php
include('../../configuracion/conexionMysqli.php');


if ($_SESSION["nivel"] != '') {
    // Definir columnas a ignorar
    $condicion = '';


    // FILTRO POR CEDULA
    $cedula = $_POST["cedula"];
    if (trim($cedula) != null) {

        // sacar casa del habitante

        $stmt = mysqli_prepare($conexion, "SELECT * FROM `inf_habitantes` WHERE cedula = ?");
        $stmt->bind_param('s', $cedula);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $vivienda = $row['id_vivienda'];
            }
        }
        $stmt->close();

        $condicion = " WHERE id_vivienda = '$vivienda' ";
    }


    // FILTRO PRO COMUNIDAD
    $comunidad = $_POST["comunidad"];
    if (trim($comunidad) != null) {
        $condicion = " WHERE id_c_comunal = '$comunidad' ";
    }


    // Consultar datos de inf_habitantes
    $stmt = mysqli_prepare($conexion, "SELECT 
    CASE 
        WHEN TIMESTAMPDIFF(YEAR, fecha_de_nacimiento, CURDATE()) BETWEEN 0 AND 2 THEN '0-2'
        WHEN TIMESTAMPDIFF(YEAR, fecha_de_nacimiento, CURDATE()) BETWEEN 3 AND 5 THEN '3-5'
        WHEN TIMESTAMPDIFF(YEAR, fecha_de_nacimiento, CURDATE()) BETWEEN 6 AND 11 THEN '6-11'
        WHEN TIMESTAMPDIFF(YEAR, fecha_de_nacimiento, CURDATE()) BETWEEN 12 AND 14 THEN '12-14'
        WHEN TIMESTAMPDIFF(YEAR, fecha_de_nacimiento, CURDATE()) BETWEEN 15 AND 17 THEN '15-17'
        WHEN TIMESTAMPDIFF(YEAR, fecha_de_nacimiento, CURDATE()) BETWEEN 18 AND 35 THEN '18-35'
        WHEN TIMESTAMPDIFF(YEAR, fecha_de_nacimiento, CURDATE()) BETWEEN 36 AND 45 THEN '36-45'
        WHEN TIMESTAMPDIFF(YEAR, fecha_de_nacimiento, CURDATE()) BETWEEN 46 AND 54 THEN '46-54'
        WHEN TIMESTAMPDIFF(YEAR, fecha_de_nacimiento, CURDATE()) BETWEEN 55 AND 79 THEN '55-79'
        ELSE '80-+100'
    END AS rango_edad,
    sexo,
    COUNT(*) AS cantidad
FROM inf_habitantes
 $condicion 
GROUP BY rango_edad, sexo
ORDER BY MIN(TIMESTAMPDIFF(YEAR, fecha_de_nacimiento, CURDATE())), sexo;");
    $stmt->execute();
    $result = $stmt->get_result();
    $datos  = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rango = $row['rango_edad'];
            $sexo = strtolower($row['sexo']) == 'femenino' ? 'femenino' : 'masculino'; // Normalizar nombres
            $cantidad = (int) $row['cantidad'];

            // Inicializar el rango si no existe
            if (!isset($datos[$rango])) {
                $datos[$rango] = ['femenino' => 0, 'masculino' => 0];
            }

            // Asignar cantidad según sexo
            $datos[$rango][$sexo] = $cantidad;
        }
    }
    $stmt->close();

    // Devolver JSON
    header('Content-Type: application/json');
    // ordena $datos por su key
    ksort($datos);
    echo json_encode($datos, JSON_PRETTY_PRINT);
}
