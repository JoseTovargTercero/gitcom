    <?php
    include('../../configuracion/conexionMysqli.php');
    include('../../class/count.php');
    include('../../class/arrayGraficos.php');


    /* instancia */
    $nameInstance = $_POST["nameInstance"];
    $filterValue = $_POST["filterValue"];
    $consulta = '';
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

    $t = $_POST["t"];
    $result = '';
    $total = 0;
    foreach ($arrayConsultas as $value) {
        if ($value[2] == $t) {
            $cantidad = contar2($value[0], $value[1].$consulta);
            if ($cantidad >= 1) {
                $total += $cantidad;
                $result .= $value[3].'/'.$cantidad.'*';
            }
        }
    }

    $result = trim($result, '*');;
    echo $result.'+'.$total;


    ?>