<!--
=========================================================
* Material Dashboard 2 - v3.0.2
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php
include('../configuracion/conexionMysqli.php');
include('../class/count.php');

if ($_SESSION['nivel'] == 1) {
  unset($_SESSION['proyecto']);



  $id = $_GET['id'];


  function calculaedad($fechanacimiento)
  {
    list($ano, $mes, $dia) = explode("-", $fechanacimiento);
    $ano_diferencia  = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia   = date("d") - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0) {
      $ano_diferencia--;
    }
    return  $ano_diferencia;
  }

  class MiBD extends SQLite3
  {
    function __construct()
    {
      $this->open('../db/bd_concejos.db');
    }
  }
  $bd = new MiBD();

  $query = $bd->query("select * from local_c_comunales");
  $states = array();
  while ($r = $query->fetchArray()) {
    $states[$r[8]] = $r[1];
  }




  function imagen($edad, $sexo)
  {

    if ($sexo == 'Femenino') {
      $sexo = 'mujer';
    } else {
      $sexo = 'hombre';
    }

    if ($edad <= 25) {
      $imagen = $sexo . '25.png';
    } elseif ($edad <= 45) {
      $imagen = $sexo . '45.png';
    } elseif ($edad >= 46) {
      $imagen = $sexo . '50.png';
    }

    return $imagen;
  }

  $conteoCasas = "SELECT * FROM inf_habitantes WHERE id='$id'";
  $buscarAlumnos222 = $conexion->query($conteoCasas);
  if ($buscarAlumnos222->num_rows > 0) {
    while ($filaAlumnos33 = $buscarAlumnos222->fetch_assoc()) {
      $id_vivienda = $filaAlumnos33['id_vivienda'];


      $comunidad = $filaAlumnos33['id_c_comunal'];



      $queryCasa = "SELECT * FROM inf_casas WHERE id_vivienda='$id_vivienda'";
      $buscarCasas = $conexion->query($queryCasa);
      if ($buscarCasas->num_rows > 0) {
        while ($filaCasa = $buscarCasas->fetch_assoc()) {
          $calle = $filaCasa['jefe_calle'];
        }
      }


      $nombre = $filaAlumnos33['nombre'];
      $nombre = trim($nombre);
      $nombreCorto = explode(" ", $nombre);



      if (count($nombreCorto) == 2) {
        $nombreCorto = $nombreCorto[0] . " " . $nombreCorto[1];
      } elseif (count($nombreCorto) == 3) {
        $nombreCorto = $nombreCorto[0] . " " . $nombreCorto[2];
      } elseif (count($nombreCorto) >= 4) {
        $nombreCorto = $nombreCorto[0] . " " . $nombreCorto[3];
      } else {
        $nombreCorto = $nombre;
      }







      $cedula = $filaAlumnos33['cedula'];
      $rolFamiliar = $filaAlumnos33['rol_familiar'];
      $idFamilia = $filaAlumnos33['id_familia'];
      $id_vivienda = $filaAlumnos33['id_vivienda'];
      $flia = $filaAlumnos33['id_familia'];
      $fecha_de_nacimiento = $filaAlumnos33['fecha_de_nacimiento'];
      $edad = calculaedad($fecha_de_nacimiento);
      $sexo = $filaAlumnos33['sexo'];
      $imagenPerfil = imagen($edad, $sexo);
      $longitud = $filaAlumnos33['coordenada_este'];
      $latitud = $filaAlumnos33['coordenada_norte'];
      $paisOrigen = $filaAlumnos33['procedencia'];
      $pueblo_indigena = $filaAlumnos33['pueblo_indigena'];
      $nacionalidad = $filaAlumnos33['nacionalidad'];
      $tiempo_reside_sector = calculaedad($filaAlumnos33['tiempo_reside_sector']);
      $educacion = $filaAlumnos33['educacion'];
      $profesion = $filaAlumnos33['profesion'];
      $ocupacion = $filaAlumnos33['ocupacion'];
      $padecio_covid = $filaAlumnos33['padecio_covid'];
      $creencia_reliosa = $filaAlumnos33['creencia_reliosa'];
      $concejo_comunal = $filaAlumnos33['concejo_comunal'];
      $raas = $filaAlumnos33['raas'];
      $clap = $filaAlumnos33['clap'];
      $milicia = $filaAlumnos33['milicia'];
      $ubch = $filaAlumnos33['ubch'];
      $msv = $filaAlumnos33['msv'];
      $robert_serra = $filaAlumnos33['robert_serra'];
      $tipo_voto = $filaAlumnos33['tipo_voto'];


      $carnetPatria = $filaAlumnos33['carnet_patria'];
      $codigo_carnet = $filaAlumnos33['codigo_carnet'];
      $serial_carnet = $filaAlumnos33['serial_carnet'];

      $combo_alimenticio_clap = $filaAlumnos33['combo_alimenticio_clap'];


      $telefono = $filaAlumnos33['telefono'];
      $procedencia = $filaAlumnos33['procedencia'];
      $instancia_laboral = $filaAlumnos33['instancia_laboral'];


      // $conf_ingreso_mensual = $filaAlumnos33['conf_ingreso_mensual'];
      $pertenece_cuerpo_seguridad_gestion_riesgo = $filaAlumnos33['pertenece_cuerpo_seguridad_gestion_riesgo'];
      $practica_deporte = $filaAlumnos33['practica_deporte'];
      $realiza_actividad_cultural = $filaAlumnos33['realiza_actividad_cultural'];
      $pasatiempo = $filaAlumnos33['pasatiempo'];
      $imaginarios_gustos_etc = $filaAlumnos33['imaginarios_gustos_etc'];
      $diabetico = $filaAlumnos33['diabetico'];
      $hipertenso = $filaAlumnos33['hipertenso'];
      $artritis = $filaAlumnos33['artritis'];
      $asma = $filaAlumnos33['asma'];
      $enf_renal = $filaAlumnos33['enf_renal'];
      $ets = $filaAlumnos33['ETS'];
      $cancer = $filaAlumnos33['cancer'];
      $epilepsia = $filaAlumnos33['epilepsia'];
      $linfoma = $filaAlumnos33['linfoma'];
      $paralisis = $filaAlumnos33['paralisis'];
      $enf_cardiaca = $filaAlumnos33['enf_cardiaca'];
      $enf_alto_costo = $filaAlumnos33['enf_alto_costo'];
      $otra = $filaAlumnos33['otra'];
      $recibe_tratamiento = $filaAlumnos33['recibe_tratamiento'];
      $dificultad_visual = $filaAlumnos33['dificultad_visual'];
      $discapacidad = $filaAlumnos33['discapacidad'];
      $carnet_discapacidad = $filaAlumnos33['carnet_discapacidad'];
      $requiere_ayuda = $filaAlumnos33['requiere_ayuda'];
      $recibe_bono_jose_g = $filaAlumnos33['recibe_bono_jose_g'];
      $embarazada = $filaAlumnos33['embarazada'];
      $embarazada_alto_riesgo = $filaAlumnos33['embarazada_alto_riesgo'];
      $concepcion_semana = $filaAlumnos33['concepcion_semana'];
      $parto_humanizado = $filaAlumnos33['parto_humanizado'];
      $lactancia_materna = $filaAlumnos33['lactancia_materna'];
      $madre_lactante = $filaAlumnos33['madre_lactante'];
      $capacidadProductiva = $filaAlumnos33['capacidadProductiva'];
      $bono_lactancia = $filaAlumnos33['bono_lactancia'];
      $planificacion_familiar = $filaAlumnos33['planificacion_familiar'];
      $deficit_nutricional = $filaAlumnos33['deficit_nutricional'];
      $combo_inn = $filaAlumnos33['combo_inn'];
      $hogares_de_la_patria = $filaAlumnos33['hogares_de_la_patria'];
      $registro_jefe_hogar_patria = $filaAlumnos33['registro_jefe_hogar_patria'];
      $combo_alimenticio_clap = $filaAlumnos33['combo_alimenticio_clap'];
      $pension = $filaAlumnos33['pension'];
      $actividad_productiva = $filaAlumnos33['actividad_productiva'];
      $superficie_m2_productiva = $filaAlumnos33['superficie_m2_productiva'];
      $infraestructura_agricola = $filaAlumnos33['infraestructura_agricola'];
      $animales_domesticos = $filaAlumnos33['animales_domesticos'];
      $movilizacion = $filaAlumnos33['movilizacion'];
      $promotores_comunitarios = $filaAlumnos33['promotores_comunitarios'];
      $grado_militar = $filaAlumnos33['grado_militar'];
      $sala_bnbt = $filaAlumnos33['sala_bnbt'];
      $chamba_juvenil = $filaAlumnos33['chamba_juvenil'];
      $ffm = $filaAlumnos33['ffm'];
      $msv = $filaAlumnos33['msv'];
      $eulalia_buroz = $filaAlumnos33['eulalia_buroz'];
      $promotora_parto_humanizado = $filaAlumnos33['promotora_parto_humanizado'];
      $mesa_tecnica_agua = $filaAlumnos33['mesa_tecnica_agua'];
      $mesa_tecnica_telecomunicaciones = $filaAlumnos33['mesa_tecnica_telecomunicaciones'];
      $otros_p_polo = $filaAlumnos33['otros_p_polo'];
      $congreso_pueblos = $filaAlumnos33['congreso_pueblos'];
      $bombona_pequena = $filaAlumnos33['bombona_pequena'];
      $bombona_mediana = $filaAlumnos33['bombona_mediana'];
      $bombona_grande = $filaAlumnos33['bombona_grande'];
      $codigo_mediana = $filaAlumnos33['codigo_mediana'];
      $codigo_grande = $filaAlumnos33['codigo_grande'];
      $actividad_agricola = $filaAlumnos33['actividad_agricola'];
      $laedad = $filaAlumnos33['edad'];


      if (@$_GET['jefe'] == "si") {
        $query = "SELECT * FROM inf_habitantes WHERE rol_familiar='CARGA FAMILIAR' And id_familia='$flia'";
        $buscar = $conexion->query($query);
        if ($buscar->num_rows > 0) {
          while ($fila = $buscar->fetch_assoc()) {
            $var1 += 1;
          }
        }
      }
    }
  }


  function comprobarVariable($variable, $pretitulo, $titulo, $diferenteA)
  {
    if ($variable != $diferenteA) {
      return '<li class="list-group-item border-0 ps-0 pt-0 text-sm">' . $pretitulo . ': <strong class="text-dark">' . $titulo . '</strong></li>';
    }
  }


?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
      Datos de la persona
    </title>
    <link id="pagestyle" href="../assets/css/animate.css" rel="stylesheet" />
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
  </head>

  <body class="g-sidenav-show bg-gray-200">
    <?php include('includes/menu.php'); ?>
    <div class="main-content position-relative max-height-vh-100 h-100">
      <!-- Navbar -->
      <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Gitcom</a></li>
            </ol>
            <h6 class="font-weight-bolder mb-0"> Datos de la persona</h6>
          </nav>
          <?php include('includes/header.php') ?>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/bg-profile.PNG');">
          <span class="mask  bg-gradient-primary  opacity-6"></span>
        </div>
        <div class="card card-body mx-3 mx-md-4 mt-n6">
          <div class="row gx-4 mb-2">
            <div class="col-auto">
              <div class="avatar avatar-xl position-relative">
                <img style="opacity: .7;width: 65px !important;" src="../assets/img/1-SF-SH.png" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
              </div>
            </div>
            <div class="col-auto my-auto">
              <div class="h-100">
                <h5 class="mb-1">
                  <?php echo $nombreCorto ?>
                </h5>
                <p class="mb-0 font-weight-normal text-sm">
                  <?php echo $nacionalidad . '-' . $cedula . ' - ' . $rolFamiliar ?>
                </p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
              <div class="nav-wrapper position-relative end-0">
                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                  <li class="nav-item">
                    <a id="pestanaUno" class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                      <i class="material-icons text-sm position-relative">Primera pestaña</i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a id="pestanaDos" class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                      <i class="material-icons text-sm position-relative">segunda pestaña</i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="row">
              <div class="col-12 col-xl-4 animated fadeInUp">
                <div class="card card-plain h-100">
                  <div class="card-header pb-0 p-3">
                    <h6 class="mb-0"><i class="fa fa-info-circle"></i> Datos personales</h6>
                  </div>
                  <div class="card-body p-3">

                    <ul class="list-group">
                      <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nombre:</strong> <?php echo $nombre ?></li>

                      <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Telefono:</strong> <?php echo $telefono ?></li>
                      <?php
                      if ($nacionalidad == 'E') {
                        echo '<li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">País de origen: </strong>' . $paisOrigen . '</li>';
                      }
                      ?>
                      <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Fecha de nacimiento:</strong> <?php echo $fecha_de_nacimiento . ' (' . $edad . ' años)' ?></li>
                      <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Sexo:</strong> <?php echo $sexo ?></li>
                      <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Pueblo indigena:</strong> <?php echo $pueblo_indigena ?></li>
                      <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Identidad Religiosa: </strong> <?php echo $creencia_reliosa ?></li>
                      <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Dirección:</strong> <?php echo $states[$comunidad] . ' - ' . $calle ?></li>
                      <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Tiempo de residencia:</strong> <?php if ($tiempo_reside_sector > 0) {
                                                                                                                                    echo $tiempo_reside_sector . ' Años';
                                                                                                                                  } else {
                                                                                                                                    echo 'Menos de un año';
                                                                                                                                  } ?></li>
                      <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Coordenadas:</strong> W°<?php echo substr($longitud, 0, 8) . '/N°' . substr($latitud, 0, 8) ?></li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-12 col-xl-8 animated fadeInUp" id="vistaUno">
                <div class="row">
                  <div class="col-12 col-xl-6">
                    <div class="card card-plain h-100">
                      <div class="card-header pb-0 p-3">
                        <div class="row">
                          <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0"><i class="fa fa-info-circle"></i> Educación<?php
                                                                                        if ($edad > 15) {
                                                                                          echo ' y trabajo';
                                                                                        }
                                                                                        ?>
                            </h6>
                          </div>
                          <div class="col-md-4 text-end">
                            <a href="javascript:;">
                              <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="p-3">
                        <ul class="list-group">

                          <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nivel educativo:</strong> <?php echo $educacion ?></li>

                          <?php if ($edad > 15) { ?>
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Profesión:</strong> <?php echo $profesion ?></li>
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Ocupación:</strong> <?php echo $ocupacion ?></li>

                            <?php if ($ocupacion != 'Desempleado') { ?>
                              <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Instancia laboral:</strong> <?php echo $instancia_laboral ?></li>
                            <?php } ?>

                          <?php } ?>
                        </ul>


                      </div>

                      <!-- final del card body -->




                      <div class="card-header pb-0 p-3">
                        <div class="row">
                          <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0"><i class="fa fa-info-circle"></i> Salud
                            </h6>
                          </div>
                          <div class="col-md-4 text-end">
                            <a href="javascript:;">
                              <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="p-3">
                        <ul class="list-group">

                          <?php

                          $condicionesSalud =
                            comprobarVariable($diabetico, 'Condición', 'Diabético', '') .
                            comprobarVariable($artritis, 'Condición', 'Artritis', '') .
                            comprobarVariable($asma, 'Condición', 'Asma', '') .
                            comprobarVariable($hipertenso, 'Condición', 'Hipertensión', '') .
                            comprobarVariable($enf_renal, 'Condición', 'Enfermedad renal', '') .
                            comprobarVariable($cancer, 'Condición', $cancer, '') .
                            comprobarVariable($epilepsia, 'Condición', 'Epilepsia', '') .
                            comprobarVariable($paralisis, 'Condición', 'Paralisis', '') .
                            comprobarVariable($enf_cardiaca, 'Condición', 'Enfermedad cardiaca', '') .
                            comprobarVariable($linfoma, 'Condición', 'Linfoma', '') .
                            comprobarVariable($dificultad_visual, 'Condición', 'Dificultad visual', '') .
                            comprobarVariable($recibe_tratamiento, 'Recibe tratamiento', $recibe_tratamiento, '');
                          if ($condicionesSalud == '') {
                            echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm">Ninguna condición de salud</li>';
                          } else {
                            echo $condicionesSalud;
                          }

                          ?>


                        </ul>


                      </div>





                    </div>
                  </div>
                  <div class="col-12 col-xl-6">
                    <div class="card card-plain h-100">
                      <div class="card-header pb-0 p-3">
                        <h6 class="mb-0"> <i class="fa fa-info-circle"></i> Proteción social</h6>
                      </div>
                      <div class="p-3">
                        <ul class="list-group">

                          <?php


                          if ($edad >= 65 && $sexo == 'Masculino') {
                            echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Pensión:</strong> ' . $pension . '</li>';
                          } elseif ($edad >= 60 && $sexo == 'Femenino') {
                            echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Pensión:</strong> ' . $pension . '</li>';
                          }

                          echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Carnet de la Patria:</strong> ' . $carnetPatria . '</li>';

                          if ($rolFamiliar == 'JEFE DE FAMILIA') {
                            echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Hogares de la patria:</strong> ' . $hogares_de_la_patria . '</li>';
                          }


                          if ($carnetPatria == 'SI') {
                            echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Codigo del carnet de la Patria:</strong> ' . $codigo_carnet . '</li>';
                            echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Serial del carnet de la Patria:</strong> ' . $serial_carnet . '</li>';
                          }

                          if ($rolFamiliar == 'JEFE DE FAMILIA') {
                            echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Combo alimenticio CLAP:</strong> ' . $combo_alimenticio_clap . '</li>';
                          }

                          echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Discapacidad:</strong> ' . $discapacidad . '</li>';

                          if (comprobarVariable($discapacidad, 'Discapacidad', $discapacidad, 'NO') != '') {
                            echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Carnet CONAPDIS:</strong> ' . $carnet_discapacidad . '</li>';

                            echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Ayuda técnica:</strong> ' . $requiere_ayuda . '</li>';

                            echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Bono José Gregorio Hernandez:</strong> ' . $recibe_bono_jose_g . '</li>';
                          }

                          if ($sexo == 'Femenino') {
                            if ($embarazada != 'NO' && $embarazada != 'NO APLICA') {

                              echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Embarazada:</strong> ' . $embarazada . '</li>';

                              echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Embarazada de alto riesgo:</strong> ' . $embarazada_alto_riesgo . '</li>';

                              echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Parto humanizado:</strong> ' . $parto_humanizado . '</li>';
                            }
                            if ($madre_lactante == 'SI') {
                              echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Madre lactante:</strong> ' . $madre_lactante . '</li>';
                              echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Bono lactancia materna:</strong> ' . $bono_lactancia . '</li>';
                            }
                          }

                          echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Deficit nutricional:</strong> ' . $deficit_nutricional . '</li>';

                          if ($madre_lactante == 'SI') {
                            echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Combo alimentico por el INN:</strong> ' . $combo_inn . '</li>';
                          }

                          ?>

                        </ul>
                      </div>

                      <!-- FIN FIN FIN FIN FIN FIN FIN FIN FIN -->

                      <div class="card-header pb-0 p-3">
                        <h6 class="mb-0"> <i class="fa fa-info-circle"></i> Cultura y deporte</h6>
                      </div>
                      <div class="p-3">
                        <ul class="list-group">

                          <?php
                          echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Actividad cultural:</strong> ' . $realiza_actividad_cultural . '</li>';
                          echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Pasatiempo:</strong> ' . $pasatiempo . '</li>';
                          echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Imaginarios:</strong> ' . $imaginarios_gustos_etc . '</li>';
                          echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Deportes:</strong> ' . $practica_deporte . '</li>';

                          ?>

                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-xl-8 animated fadeInUp" id="vistaDos" style="display: none">
                <div class="row">
                  <div class="col-12 col-xl-6">
                    <div class="card card-plain h-100">
                      <div class="card-header pb-0 p-3">
                        <div class="row">
                          <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0"><i class="fa fa-info-circle"></i> Actividad productiva
                            </h6>
                          </div>
                          <div class="col-md-4 text-end">
                            <a href="javascript:;">
                              <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="p-3">
                        <ul class="list-group">

                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Actividad productiva:</strong> <?php echo $actividad_productiva ?></li>
                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Actividad agricola:</strong> <?php echo $actividad_agricola ?></li>

                          <?php if ($actividad_agricola != 'NO' && $actividad_agricola != 'NO APLICA') {

                            if ($actividad_agricola != 'Pesca') {
                              echo '<li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Superficie productiva:</strong> ' . $superficie_m2_productiva . '</li>';

                              echo '<li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Infraestructura:</strong> ' . $infraestructura_agricola . '</li>';
                            }

                            if ($capacidadProductiva != '') {
                              echo '<li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Capacidad productiva:</strong> ' . $capacidadProductiva . ' kg (por año)</li>';
                            }
                          } ?>
                        </ul>


                      </div>

                      <!-- final del card body -->

                      <div class="card-header pb-0 p-3">
                        <div class="row">
                          <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0"><i class="fa fa-info-circle"></i> Bombonas
                            </h6>
                          </div>
                          <div class="col-md-4 text-end">
                            <a href="javascript:;">
                              <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="p-3">
                        <ul class="list-group">

                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Bombonas pequeñas:</strong> <?php echo $bombona_pequena ?></li>

                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Bombonas medianas:</strong> <?php echo $bombona_mediana ?></li>

                          <?php
                          if ($bombona_mediana > 0) {
                            echo '<li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Código:</strong> ' . $codigo_mediana . '</li>';
                          }
                          ?>
                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Bombonas grandes:</strong> <?php echo $bombona_grande ?></li>

                          <?php
                          if ($bombona_grande > 0) {
                            echo '<li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Código:</strong> ' . $codigo_grande . '</li>';
                          }
                          ?>
                        </ul>


                      </div>





                    </div>
                  </div>
                  <div class="col-12 col-xl-6">
                    <div class="card card-plain h-100">
                      <div class="card-header pb-0 p-3">
                        <h6 class="mb-0"> <i class="fa fa-info-circle"></i> Organizaciones de base</h6>
                      </div>
                      <div class="p-3">
                        <ul class="list-group">
                          <?php
                          $organizaciones =
                            comprobarVariable($promotores_comunitarios, 'Org', 'Promotor comunitario', 'NO') .
                            comprobarVariable($sala_bnbt, 'Org', 'Sala de Barrio Nuevo Barrio Tricolor', 'NO') .
                            comprobarVariable($ffm, 'Org', 'Frente Francisco de Miranda', 'NO') .
                            comprobarVariable($msv, 'Org', 'Brigadista de Somos Venezuela', 'NO') .
                            comprobarVariable($mesa_tecnica_agua, 'Org', 'Mesa Técnica de agua', 'NO') .
                            comprobarVariable($mesa_tecnica_telecomunicaciones, 'Org', 'Mesa Técnica de Telecomunicaciones', 'NO') .
                            comprobarVariable($milicia, 'Org', 'Miliciano', 'NO');

                          if ($sexo == 'Femenino') {
                            $organizaciones .=
                              comprobarVariable($eulalia_buroz, 'Org', 'Eulalia Buroz', 'NO') .
                              comprobarVariable($promotora_parto_humanizado, 'Org', 'Promotora de parto humanizado', 'NO');
                          }

                          if ($organizaciones == '') {
                            echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm">No pertenence a ninguna organizacion de base del poder popular</li>';
                          } else {
                            echo $organizaciones;
                          }

                          if (comprobarVariable($milicia, 'Org', 'Miliciano', 'NO') != '') {
                            echo '<li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Grado militar:</strong> ' . $grado_militar . '</li>';
                          }

                          ?>
                        </ul>
                      </div>


                      <div class="card-header pb-0 p-3">
                        <div class="row">
                          <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0"><i class="fa fa-info-circle"></i> Politico
                            </h6>
                          </div>
                          <div class="col-md-4 text-end">
                            <a href="javascript:;">
                              <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="p-3">
                        <ul class="list-group">


                          <?php
                          if ($edad >= 18) {
                            echo '<li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Tipo de voto:</strong> ' . $tipo_voto . '</li>';

                            echo '<li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Otros partidos:</strong> ' . $otros_p_polo . '</li>';
                          } else {
                            echo '<li class="list-group-item border-0 ps-0 pt-0 text-sm">No hay información para mostrar</li>';
                          }
                          ?>
                        </ul>


                      </div>


                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include('notificacion.php'); ?>

    </div>

    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
      // crear funcion que mande un alert si se da click en a con id pestanaUno
      $(document).ready(function() {
        $("#pestanaUno").click(function() {
          setPestana(1)
        });
        $("#pestanaDos").click(function() {
          setPestana(2)
        });
      });




      function setPestana(pestana) {
        if (pestana == 1) {
          $('#vistaUno').show();
          $('#vistaDos').hide();
        } else {
          $('#vistaUno').hide();
          $('#vistaDos').show();
        }
      }



      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
    </script>

    <script src="../assets/js/material-dashboard.min.js?v=3.0.2"></script>


  </body>

  </html>


<?php
} else {

  define('PAGINA_INICIO', '../index.php');
  header('Location: ' . PAGINA_INICIO);
}
?>