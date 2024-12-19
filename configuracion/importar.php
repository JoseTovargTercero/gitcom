<?php
include('conexionMysqli.php');
include('../class/count.php');





$ca = number_format(contar2('temp_areasinteres', 'id!=""'), '0', '.', '.') + number_format(contar2('temp_inf_casas', 'id!=""'), '0', '.', '.')
  + number_format(contar2('temp_inf_jcalles', 'id!=""'), '0', '.', '.') + number_format(contar2('temp_inf_habitantes', 'id!=""'), '0', '.', '.');

if ($ca > 0) {
  define('PAGINA_INICIO', '../pages/importar');
  header('Location: ' . PAGINA_INICIO);
}
/* SUBIR ARCHIVOS */
function moverArchivo($file, $name)
{
  if ((isset($_FILES[$file]['name']) && ($_FILES[$file]['error'] == UPLOAD_ERR_OK))) {
    $ruta_destino = "files/" . $name . ".csv";
    move_uploaded_file($_FILES[$file]['tmp_name'], $ruta_destino);
    // echo "se subio el archivo ".$name.'.csv<br>';
    return true;
  } else {
    return false;
  }
}
/* SUBIR ARCHIVOS */

/* OBTENER ID DE LA COMUNIDAD */
function obtenerId($file)
{
  $file = fopen('files/' . $file . '.csv', "r");
  while (($datos = fgetcsv($file, ",")) == true) {

    if (strlen($datos[0]) > 5) {
      $datos = explode(',', $datos[0]);
    }
    $id = $datos[1];
    $ca = $datos[2];
    $bc = $datos[3];
    $cp = $datos[4];
    $ec = $datos[5];
  }
  return [$id, $ca, $bc, $cp, $ec];
}
/* OBTENER ID DE LA COMUNIDAD */


function errorImportar($fase)
{
  // eregreaa la pagina
  echo "error en " . $fase;
}


function deleteDirectory()
{
  $dir = 'files';
  if (!$dh = @opendir($dir)) return;
  while (false !== ($current = readdir($dh))) {
    if ($current != '.' && $current != '..') {
      echo 'Se ha borrado ' . $dir . '/' . $current . '<br/>';
      if (!@unlink($dir . '/' . $current))
        deleteDirectory($dir . '/' . $current);
    }
  }
  closedir($dh);
  echo 'Se ha borrado el directorio ' . $dir . '<br/>';
  //@rmdir($dir);

  exit();
}





if ($_SESSION["nivel"] == 1) {

  $tempName = time();
  $nam_comu_file = 'comunidad_' . $tempName;
  $nam_area_file = 'areas_' . $tempName;
  $nam_call_file = 'calles_' . $tempName;
  $nam_casa_file = 'casas_' . $tempName;
  $nam_habi_file = 'habitantes_' . $tempName;

  $file_comu = moverArchivo('comunidad', $nam_comu_file);
  $file_call = moverArchivo('calles', $nam_call_file);
  $file_casa = moverArchivo('casas', $nam_casa_file);

  $file_habi = moverArchivo('habitantes', $nam_habi_file);

  $comunidad = obtenerId($nam_comu_file)[0];


  $mcp = substr($comunidad, 0, 4);
  $pq = substr($comunidad, 0, 6);
  $comuna = substr($comunidad, 0, 8);




  // Se inserta la información de los jefes de calles
  $stmt_call = $conexion->prepare("INSERT INTO temp_inf_jcalles (id_comunidad, cedula, nombre_j, telefono, sexo, cv, carnet_psuv, calle, toponimiaCalle, tipoVoto) VALUES (?,?,?,?,?,?,?,?,?,?)");
  if ($file_call) {
    $file = fopen('files/' . $nam_call_file . '.csv', "r");
    $pasos = 0;
    // Se usa para validar que todas la entradas correspondan a la misma comunidad, sino se aborta el proceso

    while (($datos = fgetcsv($file, ",")) == true) {
      if (strlen($datos[0]) > 8) {
        $datos = explode(',', $datos[0]);
      }

      if ($pasos != 0) {
        $stmt_call->bind_param("ssssssssss", $comunidad, $datos[2], $datos[3], $datos[4], $datos[5], $datos[6], $datos[7], $datos[8], $datos[9], $datos[10]);
        $stmt_call->execute();
      }
      $pasos++;
    }
    $stmt_call->close();
  }
  // Se inserta la información de las casas
  $stmt_casa = $conexion->prepare("INSERT INTO temp_inf_casas (id_municipio, id_parroquia, id_comuna, id_c_comunal, id_vivienda, tipo, coordenada_este, coordenada_norte, jefe_calle, material_construccion, condicion_vivienda, cantidad_habitaciones, vivienda_venezuela, bnbt, tenencia_tierra, agua_potable, almacenamiento_agua, agua_servidas, disposicion_basura, frecuencia_recoleccion, electricidad, medidor_electricidad, telefonia, internet, television, tv_satelital, cod_catastro, cod_ine, responsable, zonaRiesgo, robos, cantidadRobos, ultimoRobo, denucio, tratamientoAgua, tapaPozo, animalesDomesticos, suministro_agua_consumo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  if ($file_casa) {

    $file = fopen('files/' . $nam_casa_file . '.csv', "r");
    $pasos = 0;
    // Se usa para validar que todas la entradas correspondan a la misma comunidad, sino se aborta el proceso
    while (($datos = fgetcsv($file, ",")) == true) {
      if (strlen($datos[0]) > 8) {
        $datos = explode(',', $datos[0]);
      }

      if ($datos[4] != $comunidad && $datos[4] != 'id_c_comunal') {
        echo $datos[4] . ' - ' . $comunidad;
        errorImportar('casas');
        exit();
      }
    }
    $file = fopen('files/' . $nam_casa_file . '.csv', "r");

    while (($datos = fgetcsv($file, ",")) == true) {

      if (strlen($datos[0]) > 8) {
        $datos = explode(',', $datos[0]);
      }
      if ($pasos != 0) {
        $stmt_casa->bind_param("ssssssssssssssssssssssssssssssssssssss", $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[6], $datos[7], $datos[8], $datos[9], $datos[10], $datos[11], $datos[12], $datos[13], $datos[14], $datos[15], $datos[16], $datos[17], $datos[18], $datos[19], $datos[20], $datos[21], $datos[22], $datos[23], $datos[24], $datos[25], $datos[26], $datos[27], $datos[28], $datos[29], $datos[30], $datos[31], $datos[32], $datos[33], $datos[34], $datos[35], $datos[36], $datos[37], $datos[38]);
        $stmt_casa->execute();
      }
      $pasos++;
    }
    $stmt_casa->close();
  }

  $file_area = moverArchivo('areas', $nam_area_file);
  if ($file_area != false) {
    # code...
    // Se inserta la información de las areas
    $stmt_aeras = $conexion->prepare("INSERT INTO temp_areasinteres (id_comunidad, id_area_interes, area_interes, piso, pintura, iluminacion, techo, tipoAgro, produccion, instalada, producto, longitud, latitud) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($file_area) {
      $file = fopen('files/' . $nam_area_file . '.csv', "r");
      $pasos = 0;
      // Se usa para validar que todas la entradas correspondan a la misma comunidad, sino se aborta el proceso
      while (($datos = fgetcsv($file, ",")) == true) {
        if (strlen($datos[0]) > 8) {
          $datos = explode(',', $datos[0]);
        }


        if ($datos[1] != $comunidad && $datos[1] != 'id_comunidad') {
          errorImportar('areas');
          exit();
        }
      }
      $file = fopen('files/' . $nam_area_file . '.csv', "r");

      while (($datos = fgetcsv($file, ",")) == true) {
        if (strlen($datos[0]) > 8) {
          $datos = explode(',', $datos[0]);
        }
        if ($pasos != 0) {
          $stmt_aeras->bind_param("sssssssssssss", $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[6], $datos[7], $datos[8], $datos[9], $datos[10], $datos[11], $datos[12], $datos[13]);
          $stmt_aeras->execute();
        }
        $pasos++;
      }
      $stmt_aeras->close();
    }
  }

  // Se inserta la información de las areas
  $stmt_habit = $conexion->prepare("INSERT INTO temp_inf_habitantes (id_municipio, id_parroquia, id_comuna, id_c_comunal, coordenada_este, coordenada_norte, CASA, id_vivienda, id_familia, rol_familiar, cedula, nombre, telefono, fecha_de_nacimiento, sexo, genero, tiempo_reside_sector, parentesco_al_jefe, pueblo_indigena, nacionalidad, procedencia, educacion, profesion, ocupacion, instancia_laboral, conf_ingreso_mensual, pertenece_cuerpo_seguridad_gestion_riesgo, practica_deporte, realiza_actividad_cultural, creencia_reliosa, imaginarios_gustos_etc, diabetico, hipertenso, artritis, asma, enf_renal, cancer, epilepsia, linfoma, paralisis, enf_cardiaca, otra, recibe_tratamiento, dificultad_visual, discapacidad, carnet_discapacidad, requiere_ayuda, recibe_bono_jose_g, embarazada, embarazada_alto_riesgo, concepcion_semana, parto_humanizado, lactancia_materna, madre_lactante, bono_lactancia, planificacion_familiar, deficit_nutricional, combo_inn, carnet_patria, codigo_carnet, serial_carnet, hogares_de_la_patria, combo_alimenticio_clap, cantidadBolsas, pension, actividad_productiva, actividad_agricola, superficie_m2_productiva, infraestructura_agricola, capacidadProductiva, movilizacion, concejo_comunal, raas, clap, promotores_comunitarios, milicia, miliciaActivo, capacitacionAdies, sala_bnbt, ubch, chamba_juvenil, ffm, msv, robert_serra, eulalia_buroz, promotora_parto_humanizado, mesa_tecnica_agua, mesa_tecnica_telecomunicaciones, votante, caracterizacion, congreso_pueblos, bombona_pequena, bombona_mediana, bombona_grande, codigo_mediana, codigo_grande, migracion, muerte, conoceCuandrante, jefeCuadrante, telefonoCuadrante, reportadoCuadrante, atendidoCuadrante, grupoIntercambio, productorIndependiente, lugarProduccionAgricola, lugarProduccion, produccion, registro, consejo, partidos, terreno_productivo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  if ($file_habi) {
    $file = fopen('files/' . $nam_habi_file . '.csv', "r");
    $pasos = 0;

    // Se usa para validar que todas la entradas correspondan a la misma comunidad, sino se aborta el proceso
    while (($datos = fgetcsv($file, ",")) == true) {

      if (strlen($datos[0]) > 8) {
        $datos = explode(',', $datos[0]);
      }

      if ($datos[4] != $comunidad && $datos[4] != 'id_c_comunal' && $datos[4] != '') {

        echo '  -  ' . $datos[4] . ' - ' . errorImportar('habitantes');
        exit();
      }
    }




    $file = fopen('files/' . $nam_habi_file . '.csv', "r");

    while (($datos = fgetcsv($file, ",")) == true) {
      if (strlen($datos[0]) > 8) {
        $datos = explode(',', $datos[0]);
      }
      if ($pasos != 0) {

        if ($datos[55] == 'Seleccione') {
          $lact = 'NO';
        } else {
          $lact = $datos[55];
        }

        if ($datos[4] == '') {
          $datos[1] = $mcp;
          $datos[2] = $pq;
          $datos[3] = $comuna;
          $datos[4] = $comunidad;
        }


        $stmt_habit->bind_param("ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss", $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[6], $datos[7], $datos[8], $datos[9], $datos[10], $datos[11], $datos[12], $datos[13], $datos[14], $datos[15], $datos[16], $datos[17], $datos[18], $datos[19], $datos[20], $datos[21], $datos[22], $datos[23], $datos[24], $datos[25], $datos[26], $datos[27], $datos[28], $datos[29], $datos[30], $datos[31], $datos[32], $datos[33], $datos[34], $datos[35], $datos[36], $datos[37], $datos[38], $datos[39], $datos[40], $datos[41], $datos[42], $datos[43], $datos[44], $datos[45], $datos[46], $datos[47], $datos[48], $datos[49], $datos[50], $datos[51], $datos[52], $datos[53], $datos[54], $lact, $datos[56], $datos[57], $datos[58], $datos[59], $datos[60], $datos[61], $datos[62], $datos[63], $datos[64], $datos[65], $datos[66], $datos[67], $datos[68], $datos[69], $datos[70], $datos[71], $datos[72], $datos[73], $datos[74], $datos[75], $datos[76], $datos[77], $datos[78], $datos[79], $datos[80], $datos[81], $datos[82], $datos[83], $datos[84], $datos[85], $datos[86], $datos[87], $datos[88], $datos[89], $datos[90], $datos[91], $datos[92], $datos[93], $datos[94], $datos[95], $datos[96], $datos[97], $datos[98], $datos[99], $datos[100], $datos[101], $datos[102], $datos[103], $datos[104], $datos[105], $datos[106], $datos[107], $datos[108], $datos[109], $datos[110], $datos[111], $datos[112]);
        $stmt_habit->execute();
      }
      $pasos++;
    }
    $stmt_habit->close();
  }
}
/*
define('PAGINA_INICIO', '../pages/importar');
header('Location: ' . PAGINA_INICIO);
*/