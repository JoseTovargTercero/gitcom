<?php
include('conexionMysqli.php');
include('../class/count.php');




if ($_GET["key"] == 'i') {
  /*if (number_format(contar2('temp_areasinteres', 'id!=""'), '0', '.', '.') > 0) {
    $stmt_aeras = $conexion->prepare("INSERT INTO areasinteres (id_comunidad, id_area_interes, area_interes, piso, pintura, iluminacion, techo, tipoAgro, produccion, instalada, producto, longitud, latitud) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $query_p = "SELECT * FROM temp_areasinteres ";
    $buscarMa = $conexion->query($query_p);
    if ($buscarMa->num_rows > 0) {
      while ($row_p = $buscarMa->fetch_assoc()) {

        $stmt_aeras->bind_param("sssssssssssss", $row_p['id_comunidad'], $row_p['id_area_interes'], $row_p['area_interes'], $row_p['piso'], $row_p['pintura'], $row_p['iluminacion'], $row_p['techo'], $row_p['tipoAgro'], $row_p['produccion'], $row_p['instalada'], $row_p['producto'], $row_p['longitud'], $row_p['latitud']);
        $stmt_aeras->execute();
      }
    }
    $stmt_aeras->close();
  }*/


  $stmt_casa = $conexion->prepare("INSERT INTO inf_casas (id_municipio, id_parroquia, id_comuna, id_c_comunal, id_vivienda, tipo, coordenada_este, coordenada_norte, jefe_calle, material_construccion, condicion_vivienda, cantidad_habitaciones, vivienda_venezuela, bnbt, tenencia_tierra, agua_potable, almacenamiento_agua, agua_servidas, disposicion_basura, frecuencia_recoleccion, electricidad, medidor_electricidad, telefonia, internet, television, tv_satelital, cod_catastro, cod_ine, responsable, zonaRiesgo, robos, cantidadRobos, ultimoRobo, denucio, tratamientoAgua, tapaPozo, animalesDomesticos, suministro_agua_consumo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $query_p = "SELECT * FROM temp_inf_casas ";
  $buscarMa = $conexion->query($query_p);
  if ($buscarMa->num_rows > 0) {
    while ($row_p = $buscarMa->fetch_assoc()) {

      $stmt_casa->bind_param("ssssssssssssssssssssssssssssssssssssss", $row_p['id_municipio'], $row_p['id_parroquia'], $row_p['id_comuna'], $row_p['id_c_comunal'], $row_p['id_vivienda'], $row_p['tipo'], $row_p['coordenada_este'], $row_p['coordenada_norte'], $row_p['jefe_calle'], $row_p['material_construccion'], $row_p['condicion_vivienda'], $row_p['cantidad_habitaciones'], $row_p['vivienda_venezuela'], $row_p['bnbt'], $row_p['tenencia_tierra'], $row_p['agua_potable'], $row_p['almacenamiento_agua'], $row_p['agua_servidas'], $row_p['disposicion_basura'], $row_p['frecuencia_recoleccion'], $row_p['electricidad'], $row_p['medidor_electricidad'], $row_p['telefonia'], $row_p['internet'], $row_p['television'], $row_p['tv_satelital'], $row_p['cod_catastro'], $row_p['cod_ine'], $row_p['responsable'], $row_p['zonaRiesgo'], $row_p['robos'], $row_p['cantidadRobos'], $row_p['ultimoRobo'], $row_p['denucio'], $row_p['tratamientoAgua'], $row_p['tapaPozo'], $row_p['animalesDomesticos'], $row_p['suministro_agua_consumo']);
      $stmt_casa->execute();
    }
  }
  /*

  if (number_format(contar2('temp_inf_jcalles', 'id!=""'), '0', '.', '.') > 0) {
    $stmt_call = $conexion->prepare("INSERT INTO inf_jcalles (id_comunidad, cedula, nombre_j, telefono, sexo, cv, carnet_psuv, calle, toponimiaCalle, tipoVoto) VALUES (?,?,?,?,?,?,?,?,?,?)");

    $query_p = "SELECT * FROM temp_inf_jcalles ";
    $buscarMa = $conexion->query($query_p);
    if ($buscarMa->num_rows > 0) {
      while ($row_p = $buscarMa->fetch_assoc()) {
        $stmt_call->bind_param("ssssssssss", $row_p['id_comunidad'], $row_p['cedula'], $row_p['nombre_j'], $row_p['telefono'], $row_p['sexo'], $row_p['cv'], $row_p['carnet_psuv'], $row_p['calle'], $row_p['toponimiaCalle'], $row_p['tipoVoto']);
        $stmt_call->execute();
      }
    }
  }





  if (number_format(contar2('temp_inf_habitantes', 'id!=""'), '0', '.', '.') > 0) {
    $stmt_habit = $conexion->prepare("INSERT INTO inf_habitantes (id_municipio, id_parroquia, id_comuna, id_c_comunal, coordenada_este, coordenada_norte, CASA, id_vivienda, id_familia, rol_familiar, cedula, nombre, telefono, fecha_de_nacimiento, sexo, genero, tiempo_reside_sector, parentesco_al_jefe, pueblo_indigena, nacionalidad, procedencia, educacion, profesion, ocupacion, instancia_laboral, conf_ingreso_mensual, pertenece_cuerpo_seguridad_gestion_riesgo, practica_deporte, realiza_actividad_cultural, creencia_reliosa, imaginarios_gustos_etc, diabetico, hipertenso, artritis, asma, enf_renal, cancer, epilepsia, linfoma, paralisis, enf_cardiaca, otra, recibe_tratamiento, dificultad_visual, discapacidad, carnet_discapacidad, requiere_ayuda, recibe_bono_jose_g, embarazada, embarazada_alto_riesgo, concepcion_semana, parto_humanizado, lactancia_materna, madre_lactante, bono_lactancia, planificacion_familiar, deficit_nutricional, combo_inn, carnet_patria, codigo_carnet, serial_carnet, hogares_de_la_patria, combo_alimenticio_clap, cantidadBolsas, pension, actividad_productiva, actividad_agricola, superficie_m2_productiva, infraestructura_agricola, capacidadProductiva, movilizacion, concejo_comunal, raas, clap, promotores_comunitarios, milicia, miliciaActivo, capacitacionAdies, sala_bnbt, ubch, chamba_juvenil, ffm, msv, robert_serra, eulalia_buroz, promotora_parto_humanizado, mesa_tecnica_agua, mesa_tecnica_telecomunicaciones, votante, caracterizacion, congreso_pueblos, bombona_pequena, bombona_mediana, bombona_grande, codigo_mediana, codigo_grande, migracion, muerte, conoceCuandrante, jefeCuadrante, telefonoCuadrante, reportadoCuadrante, atendidoCuadrante, grupoIntercambio, productorIndependiente, lugarProduccionAgricola, lugarProduccion, produccion, registro, consejo, partidos, terreno_productivo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query_p = "SELECT * FROM temp_inf_habitantes ";
    $buscarMa = $conexion->query($query_p);
    if ($buscarMa->num_rows > 0) {
      while ($row_p = $buscarMa->fetch_assoc()) {
        $comunidad = $row_p['id_c_comunal'];

        $stmt_habit->bind_param("ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss", $row_p['id_municipio'], $row_p['id_parroquia'], $row_p['id_comuna'], $row_p['id_c_comunal'], $row_p['coordenada_este'], $row_p['coordenada_norte'], $row_p['CASA'], $row_p['id_vivienda'], $row_p['id_familia'], $row_p['rol_familiar'], $row_p['cedula'], $row_p['nombre'], $row_p['telefono'], $row_p['fecha_de_nacimiento'], $row_p['sexo'], $row_p['genero'], $row_p['tiempo_reside_sector'], $row_p['parentesco_al_jefe'], $row_p['pueblo_indigena'], $row_p['nacionalidad'], $row_p['procedencia'], $row_p['educacion'], $row_p['profesion'], $row_p['ocupacion'], $row_p['instancia_laboral'], $row_p['conf_ingreso_mensual'], $row_p['pertenece_cuerpo_seguridad_gestion_riesgo'], $row_p['practica_deporte'], $row_p['realiza_actividad_cultural'], $row_p['creencia_reliosa'], $row_p['imaginarios_gustos_etc'], $row_p['diabetico'], $row_p['hipertenso'], $row_p['artritis'], $row_p['asma'], $row_p['enf_renal'], $row_p['cancer'], $row_p['epilepsia'], $row_p['linfoma'], $row_p['paralisis'], $row_p['enf_cardiaca'], $row_p['otra'], $row_p['recibe_tratamiento'], $row_p['dificultad_visual'], $row_p['discapacidad'], $row_p['carnet_discapacidad'], $row_p['requiere_ayuda'], $row_p['recibe_bono_jose_g'], $row_p['embarazada'], $row_p['embarazada_alto_riesgo'], $row_p['concepcion_semana'], $row_p['parto_humanizado'], $row_p['lactancia_materna'], $row_p['madre_lactante'], $row_p['bono_lactancia'], $row_p['planificacion_familiar'], $row_p['deficit_nutricional'], $row_p['combo_inn'], $row_p['carnet_patria'], $row_p['codigo_carnet'], $row_p['serial_carnet'], $row_p['hogares_de_la_patria'], $row_p['combo_alimenticio_clap'], $row_p['cantidadBolsas'], $row_p['pension'], $row_p['actividad_productiva'], $row_p['actividad_agricola'], $row_p['superficie_m2_productiva'], $row_p['infraestructura_agricola'], $row_p['capacidadProductiva'], $row_p['movilizacion'], $row_p['concejo_comunal'], $row_p['raas'], $row_p['clap'], $row_p['promotores_comunitarios'], $row_p['milicia'], $row_p['miliciaActivo'], $row_p['capacitacionAdies'], $row_p['sala_bnbt'], $row_p['ubch'], $row_p['chamba_juvenil'], $row_p['ffm'], $row_p['msv'], $row_p['robert_serra'], $row_p['eulalia_buroz'], $row_p['promotora_parto_humanizado'], $row_p['mesa_tecnica_agua'], $row_p['mesa_tecnica_telecomunicaciones'], $row_p['votante'], $row_p['caracterizacion'], $row_p['congreso_pueblos'], $row_p['bombona_pequena'], $row_p['bombona_mediana'], $row_p['bombona_grande'], $row_p['codigo_mediana'], $row_p['codigo_grande'], $row_p['migracion'], $row_p['muerte'], $row_p['conoceCuandrante'], $row_p['jefeCuadrante'], $row_p['telefonoCuadrante'], $row_p['reportadoCuadrante'], $row_p['atendidoCuadrante'], $row_p['grupoIntercambio'], $row_p['productorIndependiente'], $row_p['lugarProduccionAgricola'], $row_p['lugarProduccion'], $row_p['produccion'], $row_p['registro'], $row_p['consejo'], $row_p['partidos'], $row_p['terreno_productivo']);
        $stmt_habit->execute();
      }
    }
  }
  $date = date('Y-m-d');
  $ultimocambio = date('Y-m-d');

  $stmt_u = $conexion->prepare("UPDATE  `local_comunidades` SET `status`='1',  `fechaCarga`='$date', `ultimocambio`='$ultimocambio' WHERE id_consejo='$comunidad'");
  $stmt_u->execute();

  $stmt_casa->close();
  $stmt_call->close();
  $stmt_habit->close();

  $conexion->query("TRUNCATE `temp_areasinteres`");
  $conexion->query("TRUNCATE `temp_inf_casas`");
  $conexion->query("TRUNCATE `temp_inf_jcalles`");
  $conexion->query("TRUNCATE `temp_inf_habitantes`");*/
} else {

  $conexion->query("TRUNCATE `temp_areasinteres`");
  $conexion->query("TRUNCATE `temp_inf_casas`");
  $conexion->query("TRUNCATE `temp_inf_jcalles`");
  $conexion->query("TRUNCATE `temp_inf_habitantes`");
}
/*
define('PAGINA_INICIO', '../pages/importar');
header('Location: ' . PAGINA_INICIO);
*/
// retornar
