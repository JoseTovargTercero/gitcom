<?php
include('../../../configuracion/conexionMysqli.php');
include('../../../class/count.php');

unset($_SESSION['proyecto']);
if ($_SESSION['nivel'] != '') {

  $plan = $_GET['id'];
  $idUser = $_SESSION['id'];
  $he = '1';


  $queryyy = "SELECT * FROM herramientas_gitcom WHERE user='$idUser' AND id='$he'";
  $buscarM = $conexion->query($queryyy);
  if ($buscarM->num_rows > 0) {
    while ($row = $buscarM->fetch_assoc()) {
      $h_nombre = $row['nombre'];
    }
  } else {

    define('PAGINA_INICIO', '../../../index.php');
    header('Location: ' . PAGINA_INICIO);
  }




  $queryyy = "SELECT * FROM he_pa_planes WHERE id='$plan'";
  $buscarM = $conexion->query($queryyy);
  if ($buscarM->num_rows > 0) {
    while ($row = $buscarM->fetch_assoc()) {
      $comuna = $row['com_nom'];
      $cod_comuna = $row['com_cod'];
      $comentarios = $row['comentarios'];
      $fecha = $row['fecha'];
      $coms = $row['coms'];



      switch ($row['trimestre']) {
        case '1':
          $nombreTrimestre = 'Primer trimestre';
          break;
        case '2':
          $nombreTrimestre = 'Segundo trimestre';
          break;
        case '3':
          $nombreTrimestre = 'Tercer trimestre';
          break;
        case '4':
          $nombreTrimestre = 'Cuarto trimestre';
          break;
      }
    }
  }


  function fechaCastellano($fecha)
  {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    // $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia . " " . $numeroDia . " de " . $nombreMes . " del " . $anio;
  }



?>




  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../../../assets/img/SLS.png">
    <title class="herramientas" id="title">
      Herramientas GITCOM
    </title>
    <link href="../../../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="../../../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../../../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <script src="../../../assets/js/sweetalert2.all.min.js"></script>
    <script src="../../../assets/js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">

    <style>
      .list-group-item {
        cursor: pointer;
      }

      .list-group-item:hover {
        filter: brightness(0.9);
      }

      .list {
        list-style: none;
        margin-left: 0;
        padding-left: 0px;
      }

      .list>li {
        cursor: pointer;
        transition: 0.5s;
      }

      .list>li:hover {
        color: #ed5264;
      }

      #chartdiv {
        width: 100%;
        height: 240px;
      }

      .comunidadNme {
        font-size: 13px;
        font-weight: 600;
        margin-bottom: -2px;
      }

      .td-com {
        display: flex
      }



      .hover-scroll-overlay-x,
      .hover-scroll-x,
      .scroll-x {
        overflow-x: scroll;
        position: relative;
      }

      .py-2 {
        padding-top: 0.5rem !important;
        padding-bottom: 0.5rem !important;
      }

      .flex-nowrap {
        flex-wrap: nowrap !important;
      }

      .d-flex {
        display: flex !important;
      }

      .nav-pills {
        --bs-nav-pills-border-radius: var(--bs-border-radius);
        --bs-nav-pills-link-active-color: #FFFFFF;
        --bs-nav-pills-link-active-bg: #3E97FF;
      }

      .nav {
        --bs-nav-link-padding-x: 1rem;
        --bs-nav-link-padding-y: 0.5rem;
        --bs-nav-link-color: var(--bs-link-color);
        --bs-nav-link-hover-color: var(--bs-link-hover-color);
        --bs-nav-link-disabled-color: var(--bs-secondary-color);
        display: flex;
        flex-wrap: wrap;
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
      }

      @media (min-width: 992px) {

        div,
        main,
        ol,
        pre,
        span,
        ul {
          scrollbar-width: thin;
          scrollbar-color: var(--bs-scrollbar-color) transparent;
        }
      }

      dl,
      ol,
      ul {
        margin-top: 0;
        margin-bottom: 1rem;
      }

      ol,
      ul {
        padding-left: 2rem;
      }

      *,
      ::after,
      ::before {
        box-sizing: border-box;
      }

      user agent stylesheet ul {
        display: block;
        list-style-type: disc;
        margin-block-start: 1em;
        margin-block-end: 1em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        padding-inline-start: 40px;
      }

      .bg-secondary {
        background-color: #DBDFE9 !important;
      }

      .bg-secondary {
        opacity: 0.3;
        background-color: gray !important;
      }

      .w-4px {
        width: 4px !important;
      }

      .start-0 {
        left: 0 !important;
      }

      .btn.btn-active-primary.active {
        color: white !important;
        border-color: var(--bs-primary);
        background-color: var(--bs-primary) !important;
        /*   padding: 19px 19px !important;
                    margin-top: 5px;
                    margin-bottom: 0;
*/
      }

      .thisTime,
      .thisTimeInvert {
        border: 1px dashed var(--bs-primary) !important;
        /*  padding: 19px 19px !important;
                    margin-top: 5px;
                    margin-bottom: 0;*/
      }

      .thisTimeInvert {
        border: 1px dashed white !important;
      }

      .fw-bold {
        font-weight: 600 !important;
      }

      .fs-6 {
        font-size: 1.075rem !important;
      }

      .nav.nav-pills .nav-link.active {
        animation: 0.2s ease;
      }

      .nav.nav-pills .nav-link {
        height: 72px;
      }

      .bg-light-danger {
        background-color: #ffdfdd;
      }
    </style>
  </head>

  <body class="g-sidenav-show  bg-gray-200">
    <?php include('../includes/menu.php'); ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
      <!-- Navbar -->
      <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Gitcom</a></li>
            </ol>
            <h6 class="font-weight-bolder mb-0"><?php echo $h_nombre ?></h6>
          </nav>
          <?php include('../includes/header.php') ?>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid py-4">





        <div class="row">

          <div class="col-lg-12">

            <div class="card mb-3 ">
              <div class="card-body pt-4 pb-0">
                <!--begin::Details-->
                <div class="d-flex flex-wrap flex-sm-nowrap ">
                  <!--begin::Image-->
                  <div class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-4 mb-4">
                    <img class="mw-50px mw-lg-75px" src="../../../assets/img/digital.png" alt="image">
                  </div>
                  <!--end::Image-->

                  <!--begin::Wrapper-->
                  <div class="flex-grow-1">
                    <!--begin::Head-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                      <!--begin::Details-->
                      <div class="d-flex flex-column">
                        <!--begin::Status-->
                        <div class="d-flex align-items-center">
                          <span href="#" class="fs-2 fw-bold me-3" style="font-size: 19.5px !important; color: #344767;"><?php echo $comuna ?></span>
                          <span class="badge badge-light-success me-auto">En progreso</span>
                        </div>
                        <!--end::Status-->


                        <!--begin::Description-->
                        <div class="d-flex flex-wrap fw-semibold mb-4 text-gray-400" style="font-size: 14.95px !important">
                          <?php echo $comentarios ?> - <?php echo fechaCastellano($fecha) ?> (<?php echo $nombreTrimestre  ?>)
                        </div>
                        <!--end::Description-->
                      </div>


                      <!--end::Details-->

                      <!--begin::Actions-->
                      <div class="d-flex mb-4">

                        <button href="#" class="btn btn-sm btn-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target" onclick="$('#exampleModalCom').modal('toggle')">Agregar comunidad</button>


                      </div>
                      <!--end::Actions-->
                    </div>
                    <!--end::Head-->

                    <!--begin::Info-->
                    <div class="d-flex flex-wrap justify-content-start">
                      <!--begin::Stats-->
                      <div class="d-flex flex-wrap">
                        <!--begin::Stat-->
                        <div class="border border-gray-300 border-dashed rounded  py-2 px-4 me-4 mb-3">
                          <!--begin::Number-->
                          <div class="d-flex align-items-center">


                            <i class="icon-plus fs-6 text-success me-2"></i>

                            <div class="fs-4 fw-bold" id="ttl_acciones"> <?php echo contar2('he_pa_sub_acciones', "id_p='" . $plan . "'") ?> </div>
                          </div>
                          <!--end::Number-->


                          <!--begin::Label-->
                          <div class="fw-semibold fs-6 text-gray-400">Acciones</div>
                          <!--end::Label-->
                        </div>
                        <!--end::Stat-->

                        <!--begin::Stat-->
                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-2 px-4 me-4 mb-3">
                          <!--begin::Number-->
                          <div class="d-flex align-items-center">
                            <i class="icon-arrow-up fs-6 text-success me-2"></i>
                            <div class="fs-4 fw-bold" id="acciones_realizadas"><?php echo contar2('he_pa_sub_acciones', "id_p='" . $plan . "' AND status=2") ?></div>
                          </div>
                          <!--end::Number-->

                          <!--begin::Label-->
                          <div class="fw-semibold fs-6 text-gray-400">Realizadas &nbsp;&nbsp; </div>
                          <!--end::Label-->
                        </div>
                        <!--end::Stat-->

                        <!--begin::Stat-->
                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-2 px-4 me-4 mb-3">
                          <!--begin::Number-->
                          <div class="d-flex align-items-center">
                            <i class="icon-arrow-down fs-6 text-danger me-2"></i>
                            <div class="fs-4 fw-bold" id="acciones_pendientes"><?php echo contar2('he_pa_sub_acciones', "id_p='" . $plan . "' AND status!='2'") ?></div>
                          </div>
                          <!--end::Number-->

                          <!--begin::Label-->
                          <div class="fw-semibold fs-6 text-gray-400">Pendientes</div>
                          <!--end::Label-->
                        </div>
                        <!--end::Stat-->

                      </div>
                    </div>
                  </div>
                </div>



                <hr class="my-1 mb-0">













                <!--end::Details-->
              </div>


            </div>
          </div>
        </div>





        <div class="row">
          <div class="col-lg-6">
            <div class="card h-100 mb-4">
              <div class="ventana-header pb-0 px-3">
                <div class="row">
                  <div class="col-md-12">


                    <h6>Acciones en la comuna
                      <small><br></small>
                      <small class="text-gray-400">Total de acciones (Pendientes, en proceso y ejecutadas)</small>
                    </h6>



                  </div>
                </div>

                <?php
                $g_proceso = contar2('he_pa_sub_acciones', "id_p='$plan' AND status='1'");
                $g_ejecutado = contar2('he_pa_sub_acciones', "id_p='$plan' AND status='2'");
                $g_pendientes = contar2('he_pa_sub_acciones', "id_p='$plan' AND status='0'");

                $g_total = $g_proceso + $g_ejecutado + $g_pendientes;
                if ($g_total != 0) {
                  $gp_proceso = ($g_proceso * 100) / $g_total;
                  $gp_ejecutado = ($g_ejecutado * 100) / $g_total;
                  $gp_pendientes = ($g_pendientes * 100) / $g_total;
                } else {
                  $gp_proceso = 0;
                  $gp_ejecutado = 0;
                  $gp_pendientes = 0;
                }

                ?>



                <div id="chartdiv"></div>





                <br>
                <br>
                <br>


                <script>
                  var actividades = []

                  <?php

                  $fecha_incial = '';
                  $fecha_final = '';
                  $actividades = array();

                  $queryTareas = mysqli_prepare($conexion, "SELECT he_pa_sub_acciones.fecha_ac, he_pa_sub_acciones.id_sc, he_pa_sub_acciones.status, he_pa_sub_acciones.id_tarea, local_comunidades.nombre_c_comunal, he_pa_acciones_inner.nombre FROM he_pa_sub_acciones 
                  LEFT JOIN he_pa_acciones_inner ON he_pa_acciones_inner.accion = he_pa_sub_acciones.id_accion
                  LEFT JOIN local_comunidades ON local_comunidades.id_consejo = he_pa_sub_acciones.com
                   WHERE id_p= ? ORDER BY fecha_ac");
                  $queryTareas->bind_param("s", $plan);
                  $queryTareas->execute();
                  $buscarTareas = $queryTareas->get_result();
                  if ($buscarTareas->num_rows > 0) {
                    while ($r = $buscarTareas->fetch_assoc()) {

                      echo 'actividades.push(["' . $r['fecha_ac'] . '", "' . $r['id_sc'] . '", "' . $r['status'] . '", "' . $r['nombre_c_comunal'] . '", "' . $r['nombre'] . '", "' . $r['id_tarea'] . '", "' . fechaCastellano($r['fecha_ac']) . '"]);' . PHP_EOL;

                      if (@$actividades[$r['fecha_ac']]) {
                        if ($actividades[$r['fecha_ac']] != 3) {
                          $actividades[$r['fecha_ac']] =  $actividades[$r['fecha_ac']] + 1;
                        }
                      } else {
                        $actividades[$r['fecha_ac']] = 1;
                      }

                      if ($fecha_incial == '') {
                        $fecha_incial = $r['fecha_ac'];
                      }
                      $fecha_final = $r['fecha_ac'];
                    }
                  }

                  $queryTareas->close();




                  $fecha1 = $fecha_incial;
                  $fecha2 = $fecha_final;

                  function dia_semana($fecha)
                  {

                    global $actividades;
                    $dia = date("d", strtotime($fecha));

                    $dias = array('', 'LU', 'MA', 'MI', 'JU', 'VI', 'SA', 'DO');
                    $dia_semana = $dias[date('N', strtotime($fecha))];

                    if (@$actividades[$fecha]) {
                      if ($fecha == date('Y-m-d')) {
                        $class = 'active thisTimeInvert';
                      } else {
                        $class = 'active';
                      }
                    } elseif ($fecha == date('Y-m-d')) {
                      $class = 'thisTime';
                    } else {
                      $class = '';
                    }

                    return [$dia_semana, $dia, $class, $fecha];
                  }
                  ?>
                </script>



                <?php
                if ($fecha_incial != '') {
                ?>

                  <h6>Cronograma de actividades<small><br></small>
                    <small class="text-gray-400">Próximas acciones</small>
                  </h6 <div class="card-body p-9 pt-4">




                  <div class="tab-content">

                    <ul class="nav nav-pills d-flex flex-nowrap hover-scroll-x pt-2" role="tablist">

                      <?php


                      for ($i = $fecha1; $i <= $fecha2; $i = date("Y-m-d", strtotime($i . "+ 1 days"))) {

                        $result = dia_semana($i);
                        $day = $result[1];
                        $number = $result[0];
                        $class = $result[2];
                        $date = $result[3];

                        echo '<li class="nav-item me-1" role="presentation">
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-active-primary ' . $class . '" onclick="viewTaskList(\'' . $date . '\')">
                              <span class="opacity-50 fs-7 fw-semibold">' . $number . '</span>
                              <span class="fs-6 fw-bold">' . $day . '</span>
                            </a>
                          </li>';
                      }


                      ?>

                    </ul>




                    <div id="tareasCronograma" class="tab-pane fade show active" role="tabpanel">

                    </div>


                  </div>


                <?php
                }
                ?>

              </div>



            </div>
          </div>
















          <div class="col-lg-6">
            <div class="card h-100 mb-4">
              <div class="ventana-header pb-0 px-3">
                <div class="row">
                  <div class="col-md-12">
                    <h6>Comunidades abordadas
                      <small><br></small>
                      <small class="text-gray-400">Total de comunidades: <?php echo '<span id="contadorComsA">' . contar2('he_pa_coms_previstas', "cod_plan='$plan'") . '</span>/' . $coms ?></small>
                    </h6>


                  </div>
                </div>

                <?php


                $queryyy = "SELECT * FROM he_pa_coms_previstas WHERE cod_plan='$plan'";
                $buscarM = $conexion->query($queryyy);
                if ($buscarM->num_rows > 0) {
                  echo '  <table class="table table-borderless ">
                          <thead>
                            <tr>
                              <th style="padding: 5px;"></th>
                              <th style="padding: 5px; text-align: center"></th>
                            </tr>
                          </thead>
                          <tbody>';
                  while ($row = $buscarM->fetch_assoc()) {

                    echo '
                        <tr>
                        <td class="td-com"> 
                        <div class="me-3 rounded bg-light px-2">
                        <img src="comunidad.png" class="mt-1" width="25px" height="25px">
                        </div>
                        
                        <div>
                        <p class="comunidadNme">' . $row['name_coms'] . '</p> <span class="text-gray-400">Ejecutadas: ' .
                      contar2('he_pa_sub_acciones', "com='" . $row['cod_coms'] . "' AND id_p='" . $plan . "' AND status=2") . ' - Pendientes: ' .
                      contar2('he_pa_sub_acciones', "com='" . $row['cod_coms'] . "' AND id_p='" . $plan . "' AND status!='2'")

                      . '</span>
                      </div>
                      </td>
                      <td style="text-align: center"> <a href="agregarTareas?ir=' . $row['id_coms'] . '&c=' . $row['cod_coms'] . '&p=' . $plan . '"><i class="icon icon-grid"></i> </a> </td>
                    </tr>';
                  }


                  echo '</tbody></table>';
                }
                ?>



                <small>
                  <br>

                </small>
                <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-2 pointer" style="background-color: #fff5f5" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target" onclick="$('#exampleModalCom').modal('toggle')">
                  <i class="ki-outline ki-svg/files/upload.svg fs-2tx text-primary me-4"></i> <!--end::Icon-->
                  <div class="d-flex flex-stack flex-grow-1 ">
                    <div class=" fw-semibold">
                      <h4 class="text-gray-900 fw-bold">Agregar comunidad</h4>
                      <div class="fs-6 text-gray-700 ">Agregar mas comunidades al plan de amor</div>
                    </div>
                  </div>
                </div>





                <br>
                <br>


                <?php
                $queryTareas = mysqli_prepare($conexion, "SELECT * FROM he_pa_acciones WHERE id_plan= ? ORDER BY fecha_ac");
                $queryTareas->bind_param("s", $plan);
                $queryTareas->execute();
                $buscarTareas = $queryTareas->get_result();
                if ($buscarTareas->num_rows > 0) {
                  echo '
                      <h6>Entes involucrados
                        <small><br></small>
                        <small class="text-gray-400">Acciones por entes</small>
                      </h6 <div class="card-body p-9 pt-4">
                      <div class="card-body d-flex flex-column p-3 pt-3">';
                  while ($r = $buscarTareas->fetch_assoc()) {


                    if (@$tareas_list[$r['ente']]) {
                      if ($tareas_list[$r['ente']] != 3) {
                        $tareas_list[$r['ente']] =  $tareas_list[$r['ente']] + 1;
                      }
                    } else {
                      $tareas_list[$r['ente']] = 1;
                    }
                  }
                }

                $queryTareas->close();


                if (@$tareas_list) {

                  foreach ($tareas_list as $key => $item) {
                    echo '<div class="d-flex align-items-center mb-3">
                        <div class="me-4 position-relative">
                          <div class="symbol symbol-35px">
                            <span class="symbol-label bg-light-danger text-danger fw-semibold symbol-circle">' . substr($key, 0, 1) . '</span>
                          </div>
                        </div>
                        <div class="fw-semibold">
                          <span class="fs-5 fw-bold text-gray-800 text-hover-primary">' . $key . '</span>
                          <div class="text-gray-400">Total de acciones: ' . $item . '</div>
                        </div>
                      </div>';
                  }

                  echo '</div>';
                }
                ?>







              </div>
            </div>
          </div>


          <div class="row py-3" id="zonaCom" style="display: none;">
            <div class="col-lg-6">
              <div class="card h-100 mb-4">
                <div class="ventana-header pb-0 px-3">
                  <div class="row">
                    <div class="col-md-12">
                      <h6 class="mb-0" style="color: #757575;"><i class="fa fa-plus"></i> Comunidades</h6>

                    </div>
                  </div>

                  <div class="counter_n">0</div>




                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus provident alias veritatis earum. Vitae dolores ipsum necessitatibus eveniet culpa at quod tempore ab dignissimos optio voluptate amet, asperiores quis saepe.
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card h-100 mb-4">
                <div class="ventana-header pb-0 px-3">
                  <div class="row">
                    <div class="col-md-12">
                      <h6 class="mb-0" style="color: #757575;"><i class="fa fa-plus"></i> Comunidades</h6>
                    </div>
                  </div>
                  <section id="tareasCom"></section>
                </div>
              </div>
            </div>
          </div>
        </div>



        <div class="modal fade" id="infoTarea" tabindex="-1" aria-labelledby="infoTarea" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

              <div class="modal-header">
                <h5 class="modal-title">Detalles de la acción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <div class="modal-body" style="max-height: 500px; overflow: auto;" id="infoTarea_detalles">



              </div>
              <div class="modal-footer">
                <a class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</a>
              </div>

            </div>
          </div>
        </div>



        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

              <div class="modal-header">
                <h5 class="modal-title">Selección de comuna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <div class="modal-body" style="max-height: 500px; overflow: auto;">
                <ul class="list">
                  <?php

                  $queryyy = "SELECT * FROM local_comunas ORDER BY id";
                  $buscarM = $conexion->query($queryyy);
                  if ($buscarM->num_rows > 0) {
                    while ($row = $buscarM->fetch_assoc()) {
                      echo '<li onclick="setComuna(\'' . $row['id_Comuna'] . '\', \'' . $row['nombre_comuna'] . '\')">' . $row['nombre_comuna'] . '</li>';
                    }
                  }


                  ?>
                </ul>

              </div>
              <div class="modal-footer">
                <a class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                <a id="abrirmapP" class="btn btn-primary">Abrir</a>
              </div>

            </div>
          </div>
        </div>

      </div>


      <div class="modal fade" id="exampleModalCom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title">Comnidades</h5>
              <span style="position: absolute;right: 0;margin-right: 21px;font-size: 14px;"><?php echo '<span id="contadorComsA">' . contar2('he_pa_coms_previstas', "cod_plan='$plan'") . '</span>/' . $coms ?></span>
            </div>

            <div class="modal-body" style="max-height: 500px; overflow: auto;">
              <section id="tabla"></section>

              <div class="mb-3">
                <label for="n_fecha" class="form-label">Fecha</label>
                <input type="date" id="n_fecha" class="form-control">
              </div>
            </div>



            <div class="modal-footer">
              <a class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
              <a id="crearComunida" class="btn btn-primary" onclick="nuevaComunidad()">Agregar</a>
            </div>

          </div>
        </div>
      </div>
    </main>


    <!--   Core JS Files   -->
    <script src="../../../assets/js/core/popper.min.js"></script>
    <script src="../../../assets/js/core/bootstrap.min.js"></script>

    <script src="../../../assets/amcharts5/index.js"></script>
    <script src="../../../assets/amcharts5/xy.js"></script>
    <script src="../../../assets/amcharts5/percent.js"></script>
    <script src="../../../assets/amcharts5/radar.js"></script>
    <script src="../../../assets/amcharts5/themes/Animated.js"></script>
    <script src="../../../assets/amcharts5/themes/Material.js"></script>
    <script>
      // 3 

      var vertices_j = {
        1: 'TERRITORIAL Y ORGANIZACIÓN POPULAR',
        2: 'EDUCACION',
        3: 'SALUD',
        4: 'PROTECCIÓN',
        5: 'MUJER Y FAMILIA',
        6: 'HABITAT, VIVIENDA Y ECOSOCIALISMO',
        7: 'EMPRENDIMIENTO, TRABAJO Y PRODUCCION',
        8: 'JUVENTUD Y DEPORTE',
        9: 'CULTURA Y ESPIRITUALIDAD',
        10: 'ALIMENTACIÓN',
        11: 'INFRAESTRUCTURA SOCIAL Y SERVICIOS PUBLICOS'
      };



      function viewTaskList(date) {

        $('#tareasCronograma').html('')

        actividades.forEach(element => {


          if (element[0] == date) {

            var status_tarea2;

            switch (element[2]) {
              case '0':
                status_tarea2 = '<span class="badge badge-light-primary"><i class="icon-exclamation"></i></span>';
                break;
              case '1':
                status_tarea2 = '<span class="badge badge-light-success"><i class="icon-clock"></i></span>';
                break;
              case '2':
                status_tarea2 = '<span class="badge badge-light-danger"><i class="icon-check"></i></span>';
                break;
            }


            $('#tareasCronograma').append(`
                          <div class="d-flex flex-stack position-relative mt-4">
                      <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                      <div class="fw-semibold ms-5 text-gray-600" style="max-width: 80%;">
                        <div class="fs-5">` + element[6] + ` ` + status_tarea2 + `</div>
                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">` + element[4] + ` </a>                        <!--end::Title-->
                        <div class="text-gray-400">
                          Comunidad <a class="text-primary" href="#">` + element[3] + `</a>
                        </div>
                      </div>
                      <a onclick="viewTask('` + element[1] + `')" class="btn btn-bg-light btn-active-color-primary btn-sm">VER</a>
                    </div>`)


          }

        });
      }

      function viewTask(id) {
        actividades.forEach(element => {
          if (element[1] == id) {
            var status_tarea;
            switch (element[2]) {
              case '0':
                status_tarea = '<span class="badge badge-light-primary">Pendiente</span>';
                break;
              case '1':
                status_tarea = '<span class="badge badge-light-success">En progreso</span>';
                break;
              case '2':
                status_tarea = '<span class="badge badge-light-danger">Ejecutado</span>';
                break;
            }

            $('#infoTarea_detalles').html(`
                <div class="d-flex flex-stack position-relative mt-4">
                <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                <div class="fw-semibold ms-5 text-gray-600">
                  <span class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2"> <span class="text-gray-400">Fecha: </span>  ` + element[6] + `</span> <br>
                  <span class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2"> <span class="text-gray-400">Comunidad: </span> <span class="text-primary" href="#">` + element[3] + `</span></span> <br>
                  <span class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2"> <span class="text-gray-400">Vértice: </span> ` + vertices_j[element[5]] + ` </span>  <br>
                  <span class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2"> <span class="text-gray-400">Acción: </span> ` + element[4] + ` </span>                         <br>
                  <span class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2"> <span class="text-gray-400">Estatus: </span> ` + status_tarea + ` </span> <br>
                </div>
              </div>`)
          }
        })

        $('#infoTarea').modal('toggle')

      }

      function actualizarInfoComunidad(com, id_plan) {
        $('#zonaCom').show()
        $.ajax({
            url: 'ajax/tareas.php',
            type: 'POST',
            dataType: 'html',
            data: {
              he: '<?php echo $he ?>',
              m: 'tareasDetalles',
              com: com,
              id_plan: id_plan
            }
          })
          .done(function(rePol) {
            $('#tareasCom').html(rePol)
            $("html, body").animate({
              scrollTop: $('#zonaCom').offset().top
            }, 800);

          })
      }






      function setComuna(codigo, nombre) {
        if (codigo) {
          $('#codigo_comuna').val(codigo)
          $('#comuna').val(nombre)
        }
        $('#exampleModal').modal('toggle')
      }
      //ajax/agregarComunidad
      function actualizarTabla() {
        $.ajax({
            url: 'ajax/manejador.php',
            type: 'POST',
            dataType: 'html',
            data: {
              he: '<?php echo $he ?>',
              m: 'tabla_coms',
              i: "<?php echo $plan ?>",
              co: "<?php echo $cod_comuna ?>"
            },
          })
          .done(function(rePol) {
            $('#tabla').html(rePol)
          })
      }
      actualizarTabla()


      function nuevaComunidad() {
        let n_comunidad = $('#n_comunidad').val()
        let n_fecha = $('#n_fecha').val()
        $('#crearComunida').attr('disabled', true)

        if (n_comunidad == '' || n_fecha == '') {
          toast('error', 'Rellene todos los campos')
          return
        }

        $.ajax({
            url: 'ajax/agregarComunidad.php',
            type: 'POST',
            dataType: 'html',
            data: {
              comunidad: n_comunidad,
              p: "<?php echo $plan ?>",
              n_fecha: n_fecha
            },
          })
          .done(function(rePol) {
            if (rePol.trim() != 'error') {
              // redirigir a la comunidad
              $('#crearComunida').attr('disabled', false)
              location.href = 'agregarTareas?c=' + n_comunidad + '&p=' + '<?php echo $plan ?>&ir=' + rePol.trim();
            } else {
              alert(rePol)
            }
          })

      }





      function verDetallesCom(id) {
        alert(id)
      }



      function nuevoRegistro() {

        let codigo_comuna = $('#codigo_comuna').val()
        let comuna = $('#comuna').val()
        let fecha = $('#fecha').val()
        let comentarios = $('#comentarios').val()

        let he = <?php ?>
        $.ajax({
            url: 'ajax/manejador.php',
            type: 'POST',
            dataType: 'html',
            data: {
              he: '<?php echo $he ?>',
              m: 'registro',
              codigo_comuna: codigo_comuna,
              comuna: comuna,
              fecha: fecha,
              comentarios: comentarios
            },
          })
          .done(function(rePol) {
            if (rePol.trim() == '1') {
              toast('success', 'Registro realizado correctamente')
              actualizarTabla()

            }
          })
      }


      am5.ready(function() {

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chartdiv");


        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
          am5themes_Animated.new(root),
          am5themes_Material.new(root)

        ]);




        var chart = root.container.children.push(am5percent.PieChart.new(root, {
          layout: root.horizontalLayout,
          innerRadius: am5.percent(70),
          width: am5.percent(72)
        }));




        // Define data
        var data = [{
          country: "Pendientes (<?php echo $g_pendientes ?>)",
          sales: <?php echo $gp_pendientes ?>
        }, {
          country: "En Proceso (<?php echo $g_proceso ?>)",
          sales: <?php echo $gp_proceso ?>
        }, {
          country: "Ejecutado (<?php echo $g_ejecutado ?>)",
          sales: <?php echo $gp_ejecutado ?>
        }];





        // Create series
        var series = chart.series.push(
          am5percent.PieSeries.new(root, {
            name: "Series",
            valueField: "sales",
            categoryField: "country"
          })
        );
        series.data.setAll(data);
        series.labels.template.set("forceHidden", true);
        series.ticks.template.set("forceHidden", true);

        // Add legend
        var legend = chart.children.push(am5.Legend.new(root, {
          centerY: am5.percent(50),
          y: am5.percent(50),
          layout: root.verticalLayout,
          marginTop: 15,
          marginBottom: 15,
        }));


        legend.data.setAll(series.dataItems);

























      }); // end am5.ready()
    </script>

    <!-- HTML -->


    <script>
      function eliminarProyecto(id) {


        Swal.fire({
          title: '¿Está seguro?',
          html: 'Se eliminara el proyecto y toda la información relacionada.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#ed5264',
          cancelButtonColor: '#a9a9a9',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Continuar'
        }).then((result) => {
          if (result.isConfirmed) {

            $.get("../back/cartografia_eliminar_proyecto.php", "id=" + id, function(data) {
              if (data.trim() == '0') {
                toast("success", "El proyecto se eliminó correctamente");
                $('#p_' + id).remove()
              }
            });
          }
        })


      }



      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
    </script>
    <script src="../../../assets/js/material-dashboard.min.js?v=3.0.2"></script>
  </body>

  </html>


<?php
} else {

  define('PAGINA_INICIO', '../../../index.php');
  header('Location: ' . PAGINA_INICIO);
}
?>