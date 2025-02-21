    <?php
    include('../../configuracion/conexionMysqli.php');
    include('../../class/count.php');


    /* instancia */
    $nameInstance = $_POST["nameInstance"];
    $filterValue = $_POST["filterValue"];
    $consulta = '';
    $consultta2 = '';



    if ($_SESSION['nivel'] == 3) {
        $nameInstance = 'comdad';
        $filterValue = $_SESSION["dato1"];
    }



    if ($nameInstance != '') {
        switch ($nameInstance) {
            case 'mcp':
                $consulta .= " AND id_municipio='$filterValue'";
                $consultta2 .= " AND id_municipio='$filterValue'";
                break;
            case 'pq':
                $consulta .= " AND id_parroquia='$filterValue'";
                $consultta2 .= " AND id_parroquia='$filterValue'";
                break;
            case 'com':
                $consulta .= " AND id_comuna='$filterValue'";
                $consultta2 .= " AND id_comuna='$filterValue'";
                break;
            case 'comdad':
                $consulta .= " AND id_c_comunal='$filterValue'";
                $consultta2 .= " AND id_consejo='$filterValue'";
                break;
        }
    }


    echo json_encode([
        contar2('local_comunidades', 'status="1"' . $consultta2),
        contar2('inf_habitantes', 'id!=""' . $consulta),
        contar2('inf_habitantes', 'rol_familiar!="JEFE DE FAMILIA"' . $consulta),
        contar2('inf_casas', 'id!=""' . $consulta)
    ]);




    ?>