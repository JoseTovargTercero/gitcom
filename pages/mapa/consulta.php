    <?php
    include('../../configuracion/conexionMysqli.php');

    $endValue = '';
    if (@$_POST['tipo'] == 'casas') {

        $consulta = str_replace('"', "'", $_POST['consulta']);
        $cantidad = 0;
        $query = "SELECT * FROM inf_casas WHERE $consulta";
        $search = $conexion->query($query);
        if ($search->num_rows > 0) {
            while ($row = $search->fetch_assoc()) {
                $cantidad++;
                # code...
                if ($row['coordenada_este'] < 0) {
                    $endValue .= '{ "type": "Feature", "properties": { "tipo": "Viviendas", "codigo": "' . $row['id_vivienda'] . '", "responsable": "' . $row['cod_situr'] . '", "personas": ""}, "geometry": { "type": "Point", "coordinates": [' . $row['coordenada_este'] . ', ' . $row['coordenada_norte'] . '] } }, ';
                }
            }
        }
        //
    } else {
        $reultadoArray = array();
        //$consulta = 'creencia_reliosa="Católico" AND inf_habitantes.id_comuna="02030213"';
        //$consulta = str_replace('"', "'", $consulta);
        $consulta = str_replace('"', "'", $_POST['consulta']);


        $explode = explode('/', $consulta);

        if (count($explode) == 2) {
            $consulta = $explode[0];
            $campoContar = $explode[1];
        }


        $cantidad = 0;
        $query = "SELECT inf_casas.coordenada_este, inf_casas.coordenada_norte, inf_habitantes.cedula, inf_habitantes.nombre, inf_habitantes.id_vivienda, inf_habitantes.id FROM inf_habitantes 
        LEFT JOIN inf_casas ON inf_casas.id_vivienda = inf_habitantes.id_vivienda
        WHERE $consulta";
        $search = $conexion->query($query);
        if ($search->num_rows > 0) {
            while ($row = $search->fetch_assoc()) {
                $idPersonas = $row['id'];
                $cedula = str_replace('/', '', $row['cedula']);
                $nombre = str_replace('/', '', $row['nombre']);

                if (count($explode) == 2) {
                    $cantidad += $row[$campoContar];
                    $cantidadViviendas++;
                    $rslt = '<span style=\"color: gray\">' . $cedula . ' ' . $nombre . ' (' . $row[$campoContar] . ')</span><br><a target=\"_blank\"  href=\"datosPersona?id=' . $idPersonas . '\">Ver información de la persona</a><br>';
                } else {
                    $cantidad++;
                    $rslt = '<span style=\"color: gray\">' . $cedula . ' ' . $nombre . '</span><br><a target=\"_blank\"  href=\"datosPersona?id=' . $idPersonas . '\">Ver información de la persona</a><br>';
                }


                $este = $row['coordenada_este'];
                $norte = $row['coordenada_norte'];
                $id_vivienda = str_replace('/', '', $row['id_vivienda']);
                $responsable = str_replace('/', '', $cedula);

                if ($row['coordenada_este'] < 0) {
                    if (@$reultadoArray[$id_vivienda]) {
                        $value = $reultadoArray[$id_vivienda][2];
                        $reultadoArray[$id_vivienda][2] = $value . $rslt;
                    } else {
                        $reultadoArray[$id_vivienda] = array($id_vivienda, $responsable, $rslt, $este, $norte);
                    }
                }
            }
        }
        foreach ($reultadoArray as $value) {

            $endValue .= '{"type": "Feature", "properties": { "tipo": "Habitantes", "codigo": "' . $value[0] . '",           "responsable": "0", "personas": "' . $value[2] . '"}, "geometry": { "type": "Point",          "coordinates": [' . $value[3] . ', ' . $value[4] . '] } }, ';
        }


        if (count($explode) == 2) {
            $cantidad = $cantidadViviendas . ' - ' . $cantidad;;
        }
    }
































    $endValue = str_replace('/', '', $endValue);
    echo $endValue . '/' . $cantidad;
    exit();
    ?>