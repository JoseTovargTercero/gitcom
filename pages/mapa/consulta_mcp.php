<?php
include('../../configuracion/conexionMysqli.php');
header('Content-Type: application/json');

$filtro_unidad = $_POST['tipo_unidad_inmobiliaria'] ?? null;
$consultaRaw   = $_POST['consulta'] ?? '';

$where_unidad = '';
if (!empty($filtro_unidad)) {
    $where_unidad = " AND estructura = " . intval($filtro_unidad);
}

$consulta = str_replace('"', "'", $consultaRaw);

$query = "SELECT * FROM inf_casas_f_mcp WHERE $consulta $where_unidad";
$search = $conexion->query($query);

$features = [];
$statsPorTipo = [];   // 👈 estadísticas
$total = 0;

if ($search && $search->num_rows > 0) {
    while ($row = $search->fetch_assoc()) {

        if ($row['coordenada_este'] < 0) {

            $total++;

            $tipo = "Viviendas"; // si luego cambia por BD, solo usa $row['tipo']

            // ===== stats =====
            if (!isset($statsPorTipo[$tipo])) {
                $statsPorTipo[$tipo] = 0;
            }
            $statsPorTipo[$tipo]++;

            // ===== feature =====
            $features[] = [
                "type" => "Feature",
                "properties" => [
                    "tipo"   => $tipo,
                    "codigo" => $row['id_vivienda']
                ],
                "geometry" => [
                    "type" => "Point",
                    "coordinates" => [
                        floatval($row['coordenada_este']),
                        floatval($row['coordenada_norte'])
                    ]
                ],
                "data" => $row   // 👈 fila completa
            ];
        }
    }
}

$response = [
    "ok"        => true,
    "total"     => $total,
    "stats"     => $statsPorTipo,   // 👈 estadísticas por tipo
    "geojson"   => [
        "type" => "FeatureCollection",
        "features" => $features
    ]
];

echo json_encode($response, JSON_UNESCAPED_UNICODE);
exit;
