    <?php
    include('../../configuracion/conexionMysqli.php');

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
        $cantidad = 0; 
        $query = "SELECT * FROM inf_habitantes 
        LEFT JOIN inf_casas ON inf_casas.id_vivienda = inf_habitantes.id_vivienda 
        WHERE $consulta";
        $search = $conexion->query($query);
        if ($search->num_rows > 0) {
            while ($row = $search->fetch_assoc()) {
                $cantidad++;
                $este = $row['coordenada_este'];
                $norte = $row['coordenada_norte'];
                $id_vivienda = str_replace('/', '', $row['id_vivienda']);
                $responsable = str_replace('/', '', $row['cod_situr']);
                $cedula = str_replace('/', '', $row['cedula']);
                $nombre = str_replace('/', '', $row['nombre']);
                $personas = $cedula . ' ' . $nombre.'<br>';
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


        $endValue .= '{"type": "Feature", "properties": { "tipo": "Personas", "codigo": "' .$value[0]. '",           "responsable": "' . $value[1] . '", "personas": "'.$value[2].'"}, "geometry": { "type": "Point",          "coordinates": ['.$value[3].', '.$value[4].'] } }, ';
   
      }


    }
    $endValue = str_replace('/', '', $endValue);
    ?>

<input type="text" hidden name="resultadoConsultaCampo"  id="resultadoConsultaCampo" value='<?php echo $endValue.'/'.$cantidad ?>' placeholder="campo">




