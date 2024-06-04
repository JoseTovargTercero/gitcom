    <?php
    include('../../configuracion/conexionMysqli.php');

    $i = $_GET["i"];
    $user = $_SESSION['id'];
    $query = "SELECT * FROM reportes WHERE id='$i' AND user='$user' LIMIT 1";
    $search = $conexion->query($query);
    if ($search->num_rows > 0) {
      while ($row = $search->fetch_assoc()) {
        $formato = $row['formato'];
        $nombreArchivo = $row['nombreArchivo'];
        $consulta = $row['consulta'];
        $tabla = $row['tabla'];
        $campos = substr($row['campos'], 1);


        if ($tabla == '1') {
          $tabla = 'inf_casas';
        }else{
          $tabla = 'inf_habitantes';
        }
      }
    } else {
      define('PAGINA_INICIO', '../../index.php');
      header('Location: ' . PAGINA_INICIO);
    }


    $cmapos_nombres = array(
      'coordenada_norte'=>'Latitud',
      'coordenada_este'=>'Longitud',
      'material_construccion'=>'Material de construcción',
      'condicion_vivienda'=>'Condición de la vivienda',
      'cantidad_habitaciones'=>'Cantidad de habitaciones',
      'vivienda_venezuela'=>'Vivienda Venezuela',
      'bnbt'=>'BNBT',
      'tenencia_tierra'=>'Tenencia de la tierra',
      'agua_potable'=>'Suministro de agua potable',
      'almacenamiento_agua'=>'Almacenamiento del agua',
      'suministro_agua_consumo'=>'Suministro del agua de consumo',
      'tratamientoAgua'=>'Tratamiento del agua',
      'agua_servidas'=>'Agua servidas',
      'tapaPozo'=>'Tapa del pozo séptico',
      'disposicion_basura'=>'Disposición de la basura',
      'frecuencia_recoleccion'=>'Frecuencia de recolección',
      'electricidad'=>'Electricidad',
      'medidor_electricidad'=>'Medidor eléctrico',
      'telefonia'=>'Telefonía',
      'internet'=>'Internet',
      'television'=>'Televisión',
      'zonaRiesgo'=>'Zona de riesgo'
    );


    if ($campos != '') {
      if (strpos($campos, '*')) {
        $array_campos = explode('*', $campos);
      }else{
        $array_campos = array();
        array_push($array_campos, $campos);
      }
    }




    if ($formato == '1') { // xls
      
      header("Content-type: application/vnd.ms-excel; charset=UTF-8");
      header("Content-Disposition: attachment; filename=" . $nombreArchivo . date('Y-m-d H_s_i a') .".xls");
      echo pack("CCC", 0xef, 0xbb, 0xbf);
    }
    echo info();




    function info(){

      global $tabla;
      global $array_campos;
      global $consulta;
      global $conexion;
      global $cmapos_nombres;
      global $nombreArchivo;
        $inf = '<style>
            h1 {
              text-align: center;
              width: 100%;
              margin-top: 0;
              margin-bottom: 10px;
            }
    
            table {
              width: 100%;
              font-size: 9px;
            }
    
            th,
            td {
              border: 1px solid gray;
              padding: 5px 2px;
            }
    
            .center {
              text-align: center;
            }
          </style>';
   

    $inf .= '

    <body>
      <div style="width: 100% !important;">
        <h1 style="font-size: 22px;">'.$nombreArchivo.'</h1>
        <table>
          <tr>
            <th style="text-align: center; background-color: #d64757 !important; color: white !important">N#</th>
            <th style="text-align: center; background-color: #d64757 !important; color: white !important">Municipio</th>
            <th style="text-align: center; background-color: #d64757 !important; color: white !important">Parroquia</th>
            <th style="text-align: center; background-color: #d64757 !important; color: white !important">Comunida</th>
            <th style="text-align: center; background-color: #d64757 !important; color: white !important">Consejo Comunal</th>
            <th style="text-align: center; background-color: #d64757 !important; color: white !important">Vivienda</th>';
            
            if ($tabla == 'inf_casas') {
              $inf .= '<th style="text-align: center; background-color: #d64757 !important; color: white !important">Responsable</th>';
            }

            if ($array_campos) {
              foreach ($array_campos as $item) {
                $inf .= '<th style="text-align: center; background-color: #d64757 !important; color: white !important">'.$cmapos_nombres[$item].'</th>';
              }
            }
            $inf .= '</tr>
                  <tbody>';


                  $consulta = str_replace('*', "'", $consulta);
                  $count = 1;
                  $query2E = "SELECT * FROM $tabla
                  LEFT JOIN local_municipio ON local_municipio.id_municipio=$tabla.id_municipio
                  LEFT JOIN local_parroquia ON local_parroquia.id_parroquias=$tabla.id_parroquia
                  LEFT JOIN local_comunas ON local_comunas.id_Comuna=$tabla.id_comuna
                  LEFT JOIN local_comunidades ON local_comunidades.id_consejo=$tabla.id_c_comunal
                  WHERE $consulta";

                  $search2E = $conexion->query($query2E);
                  if ($search2E->num_rows > 0) {
                    while ($row2E = $search2E->fetch_assoc()) {
                  
                      $inf .= '
                        <tr>
                        <td style="text-align: center; background-color: #d64757;  color: white !important">'.$count++.'</td>
                        <td>'.$row2E['nombre_municipio'].'</td>
                        <td>'.$row2E['nombre_parroquia'].'</td>
                        <td>'.$row2E['nombre_comuna'].'</td>
                        <td>'.$row2E['nombre_c_comunal'].'</td>
                        <td>'.$row2E['id_vivienda'].'</td>
                        ';

                        if ($tabla == 'inf_casas') {
                          $inf .= ' <td>'.$row2E['responsable'].'</td>';
                        }


                        if ($array_campos) {
                          foreach ($array_campos as $item) {
                            $inf .= ' <td>'.$row2E[$item].'</td>';
                          }
                        }

                        $inf .= '</tr>';
                }

                $inf .= ' </tbody>
                </table>
              </div>
              </div>
            </body>
            </html>'; 
              }

              return $inf;
    }


    ?>

  
