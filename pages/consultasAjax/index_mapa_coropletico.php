    <?php
    include('../../configuracion/conexionMysqli.php');
    include('../../class/count.php');

    if ($_POST["t"] == '2') {
        $tabla = 'inf_habitantes';
    } else {
        $tabla = 'inf_casas';
    }
    $consulta = $_POST["c"];
    $array = array();
    
    /* instancia */
    $nameInstance = $_POST["nameInstance"];
    $filterValue = $_POST["filterValue"];

    if ($nameInstance != '') {
        switch ($nameInstance) {
            case 'mcp':
                $consulta .= " AND id_municipio='$filterValue'";
                break;
            case 'pq':
                $consulta .= " AND id_parroquia='$filterValue'";
                break;
            case 'com':
                $consulta .= " AND id_comuna='$filterValue'";
                break;
            case 'comdad':
                $consulta .= " AND id_c_comunal='$filterValue'";
                break;
        }
    }
    /* instancia */

    $query2E = "SELECT * FROM $tabla WHERE $consulta";
    $search2E = $conexion->query($query2E);
    if ($search2E->num_rows > 0) {
        while ($row2E = $search2E->fetch_assoc()) {
            $comunidad = $row2E['id_c_comunal'];

            if (@$array[$comunidad]) {
                $array[$comunidad] = $array[$comunidad] + 1;
            }else {
                $array[$comunidad] = 1;
            }
         //   echo $comunidad . ',' . contar2($tabla, $consulta . ' AND id_c_comunal="' . $comunidad . '"') . '*<br>';
        }
    }
        $result = '';
    foreach ($array as $i => $item) {
        $result .= $i. ',' . $item . '*';
    }

    $result = substr($result, 0, -1);
    echo $result;


    ?>