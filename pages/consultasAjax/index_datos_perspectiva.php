    <?php
    include('../../configuracion/conexionMysqli.php');
    include('../../class/count.php');

    $consulta = $_POST["c"];
    $b = $_POST["b"];
    $array = array();


        /* instancia */
        $nameInstance = $_POST["nameInstance"];
        $filterValue = $_POST["filterValue"];
        $add_consulta = '';
        if ($nameInstance != '') {
            switch ($nameInstance) {
                case 'mcp':
                    $add_consulta .= " AND id_municipio='$filterValue'";
                    break;
                case 'pq':
                    $add_consulta .= " AND id_parroquia='$filterValue'";
                    break;
                case 'com':
                    $add_consulta .= " AND id_comuna='$filterValue'";
                    break;
                case 'comdad':
                    $add_consulta .= " AND id_c_comunal='$filterValue'";
                    break;
            }
            $consulta .= $add_consulta;
        }
        /* instancia */


    if ($_POST["t"] == '2') {
        $tabla = 'inf_habitantes';
        $d = contar2('inf_habitantes', "id!=''".$add_consulta);
    } else {
        $tabla = 'inf_casas';
        //$d = contar2('inf_casas', 'material_construccion!=""'.$add_consulta);
        
        $d = contar2('inf_casas', 'extra!=""'.$add_consulta);
    }


    $cantidad = contar2($tabla, $consulta);
   if ($cantidad >= 1) {
        $cantidad = ($cantidad / $d) * $b;
        if ($cantidad >= 1) {
            $cantidad = round($cantidad, 0, PHP_ROUND_HALF_UP);
            echo $cantidad;
        }else {
            echo "0";
        }
      }else {
        echo "0";
    }




    ?>