    <?php
    include('../../configuracion/conexionMysqli.php');

    $endValue = '';
    if ($_POST['tipo'] == 'casas') {
     
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

    } else {
        $reultadoArray = array();
        $consulta = str_replace('"', "'", $_POST['consulta']);
        
        $explode = explode('/', $consulta);

        if (count($explode) == 2) {
            $consulta = $explode[0];
            $campoContar = $explode[1];
        }
        

        $cantidad = 0; 
        $query = "SELECT * FROM inf_habitantes WHERE $consulta";
        $search = $conexion->query($query);
        if ($search->num_rows > 0) {
            while ($row = $search->fetch_assoc()) {
                $idPersonas = $row['id'];
                $cedula = str_replace('/', '', $row['cedula']);
                $nombre = str_replace('/', '', $row['nombre']);
                
                if (count($explode) == 2) {
                    $cantidad += $row[$campoContar];
                    $cantidadViviendas++;

                    $personas = $cedula . ' ' . $nombre.' ('.$row[$campoContar].')<br><a target=\"_blank\" class=\"link\" href=\"datosPersona.php?id='.$idPersonas.'\">Ver información de la persona</a><br>';
                }else{
                    $cantidad++;
                    $personas = $cedula . ' ' . $nombre.'<br>

                    <a target=\"_blank\" class=\"link\" href=\"datosPersona.php?id='.$idPersonas.'\">
                    Ver información de la persona</a>
                    <br>';

                }


                $este = $row['coordenada_este'];
                $norte = $row['coordenada_norte'];
                $id_vivienda = str_replace('/', '', $row['id_vivienda']);
                $responsable = str_replace('/', '', $row['cod_situr']);
         
            if ($row['coordenada_este'] < 0) {
                if (@$reultadoArray[$id_vivienda]) {
                    $value = $reultadoArray[$id_vivienda][2];
                    $reultadoArray[$id_vivienda][2] = $value.$personas;
                 }else {
                     $reultadoArray[$id_vivienda] = array($id_vivienda , $responsable, $personas, $este, $norte);
                 }
            }

            }
        }
      
      foreach ($reultadoArray as $value) {


        $endValue .= '{"type": "Feature", "properties": { "tipo": "Habitantes", "codigo": "' .$value[0]. '",           "responsable": "' . $row['cod_situr'] . '", "personas": "'.$value[2].'"}, "geometry": { "type": "Point",          "coordinates": ['.$value[3].', '.$value[4].'] } }, ';
   
      }

      if (count($explode) == 2) {
                $cantidad = $cantidadViviendas.' - '.$cantidad;;
        }



    }

 
    $endValue = str_replace('/', '', $endValue);


    echo $endValue.'/'.$cantidad;
    exit();
    ?>