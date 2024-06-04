<?php
include('../../../configuracion/conexionMysqli.php');
include('../../../class/count.php');

unset($_SESSION['proyecto']);
if ($_SESSION['nivel'] != '') {

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
  function nameMonth($mes){

    $meses_ES = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    return $meses_ES[$mes];
  }


?>





  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../../../assets/img/favicon.png">
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
      #chartdiv,
      #chartdiv2,
      #chartdiv3,
      #chartdiv4
      {
        width: 100%;
        height: 280px;
      }


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
        padding: 8px;
        border-radius: 50%;
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
          <div class="col-lg-12 text-end">
            <button onclick="$('#setFiltro').modal('toggle')" class="btn btn-default"> <i class="icon-settings"></i> Filtro</button>
            <button onclick="$('#exampleModal2').modal('toggle')" class="btn btn-primary">Nuevo registro</button>
          </div>
        </div>
        <div class="row">


          <div class="col-lg-12 mb-3">
            <div class="card h-100 mb-4">
              <div class="ventana-header pb-0 px-3">
                <div class="row">
                  <div class="col-md-12">
                    <h6>Plan de amor<small><br></small><small class="text-gray-400">Comunas previstas.</small></h6>
                  </div>
                </div>
                <script>
                  var actividades = [];
                  var data_vertices = [];
                  var data_status = [];
                  var data_atencionMes = [];
                  var data_entes = [];
                </script>

                <div class="card-body p-2">

                  <table class="table table-borderless">

                    <thead>
                      <tr>
                        <th style="padding: 0 !important;"></th>
                        <th style="padding: 0 !important;"></th>
                        <th style="padding: 0 !important;"></th>
                        <th style="padding: 0 !important;"></th>
                      </tr>
                    </thead>
                    <tbody>



                      <?php
                      $vertices_j = array(
                        1 => 'TERRITORIAL Y ORGANIZACIÓN POPULAR',
                        2 => 'EDUCACION',
                        3 => 'SALUD',
                        4 => 'PROTECCIÓN',
                        5 => 'MUJER Y FAMILIA',
                        6 => 'HABITAT, VIVIENDA Y ECOSOCIALISMO',
                        7 => 'EMPRENDIMIENTO, TRABAJO Y PRODUCCION',
                        8 => 'JUVENTUD Y DEPORTE',
                        9 => 'CULTURA Y ESPIRITUALIDAD',
                        10 => 'ALIMENTACIÓN',
                        11 => 'INFRAESTRUCTURA SOCIAL Y SERVICIOS PUBLICOS'
                      );

                      $fecha_incial = '';
                      $fecha_final = '';

                      $vertices = array();
                      $status = array();
                      $meses = array('1' => 0,'2' => 0,'3' => 0,'4' => 0,'5' => 0,'6' => 0,'7' => 0,'8' => 0,'9' => 0,'10' => 0,'11' => 0,'10' => 0);
                      $entes = array();

                      $stmt = mysqli_prepare($conexion, "SELECT * FROM he_pa_acciones WHERE id_plan= ?");
                      $stmt2 = mysqli_prepare($conexion, "SELECT * FROM he_pa_sub_acciones WHERE id_p= ?");


                      $trimestre = 0;
                      $currentYear = date('Y');
                      $lastYear = $currentYear - 1;
                      $queryyy = "SELECT * FROM he_pa_planes WHERE anio>$lastYear ORDER BY fecha, trimestre";
                      $buscarM = $conexion->query($queryyy);
                      if ($buscarM->num_rows > 0) {
                        while ($row = $buscarM->fetch_assoc()) {


                          $stmt->bind_param("s", $row['id']);
                          $stmt->execute();
                          $result = $stmt->get_result();
                          if ($result->num_rows > 0) {
                            while ($r = $result->fetch_assoc()) {

                              if (@$vertices[$vertices_j[$r['vertice']]]) {
                                $vertices[$vertices_j[$r['vertice']]][0] += 1;
                              } else {
                                $vertices[$vertices_j[$r['vertice']]] = array(1, $row['trimestre']);
                              }


                              if (@$entes[$r['ente']]) {
                                $entes[$r['ente']] += 1;
                              } else {
                                $entes[$r['ente']] = 1;
                              }

                            }
                          }


                          $stmt2->bind_param("s", $row['id']);
                          $stmt2->execute();
                          $result2 = $stmt2->get_result();
                          if ($result2->num_rows > 0) {
                            while ($r2 = $result2->fetch_assoc()) {

                              if (@$status[$r2['status']]) {
                                $status[$r2['status']][0] += 1;
                              } else {
                                $status[$r2['status']] = array(1, $row['trimestre']);
                              }

                       
                                $meses[$r2['accion_mes']] = $meses[$r2['accion_mes']] + $r2['impacto_ac'];



                            }
                          }

                          
                          //herea



                          switch ($row['trimestre']) {
                            case '1':
                              $trimestreName = "Primer trimestre";
                              break;

                            case '2':
                              $trimestreName = "Segundo trimestre";
                              break;

                            case '3':
                              $trimestreName = "Tercer trimestre";
                              break;

                            case '4':
                              $trimestreName = "Cuarto trimestre";
                              break;
                          }



                      $idd = $row['id'];

                      $ttl = contar2('he_pa_sub_acciones', "id_p='$row[id]'");
                      $pend = contar2('he_pa_sub_acciones', "id_p='$row[id]' AND status='1'");
                      $ejecs = contar2('he_pa_sub_acciones', "id_p='$row[id]' AND status='2'");
                      //herea
                      echo '
                      <script>
                      actividades.push(["' . $row['fecha'] . '", "' . $row['com_nom'] . '", "'.$ttl.'", "'.$pend.'", "'.$ejecs.'", "' . fechaCastellano($row['fecha']) . '", "' .$idd. '"]);
                      </script>
                      ' . PHP_EOL;

                      if (@$actividades[$row['fecha']]) {
                      if ($actividades[$row['fecha']] != 3) {
                      $actividades[$row['fecha']] =  $actividades[$row['fecha']] + 1;
                      }
                      } else {
                      $actividades[$row['fecha']] = 1;
                      }



                      if ($fecha_incial == '') {
                      $fecha_incial = $row['fecha'];
                      }
                      $fecha_final = $row['fecha'];




                          echo '
                      <tr>
                      <td width="3%">
                      
                      <div class="me-4 position-relative">
                      <div class="symbol symbol-35px ">
                        <span class="symbol-label bg-light-danger text-danger fw-semibold symbol-circle">' . substr($row['com_nom'], 0, 1) . '</span>
                      </div>
                    </div>

                      </td>
                      <td  width="54%">
                      
                      <div class="fw-semibold">
                      <span class="fs-5 fw-bold text-gray-800 text-hover-primary">' . $row['com_nom'] . '</span>
                      <div class="text-gray-400">Acciones: ' . contar2('he_pa_sub_acciones', "id_p='$row[id]'") . '. Pendientes: ' . contar2('he_pa_sub_acciones', "id_p='$row[id]' AND status='1'") . '. Ejecutado: ' . contar2('he_pa_sub_acciones', "id_p='$row[id]' AND status='2'") . '
                      </div>
                      
                    </div>
                      </td>


                      <td width="40%">

                      <span class="text-gray-800 fw-800">' . fechaCastellano($row['fecha']) . '</span>
                      <br>
                      <span class="text-gray-400">' . $trimestreName . '</span>
                      </td>

                      <td width="3%">
                      <div class="ms-auto"><a class="text-muted" href="detalles?id=' . $row['id'] . '"><i class="icon icon-grid"></i></a></div>
                      </td>
                      </tr>';
                        }
                      }

                      $i = 0;
                      $i2 = 0;
                      echo "<script>" . PHP_EOL;


                      
                    foreach ($entes as $key => $item) {
                      echo 'data_entes["' . $key . '"] = '.$item . PHP_EOL;
                    }



                      foreach ($meses as $key => $item) {
                        echo 'data_atencionMes[' . $key . '] = '.$item . PHP_EOL;
                      }


                      
                      
                      foreach ($vertices as $key => $item) {
                        echo 'data_vertices[' . $i . '] = {nombre: "' . $key . '", cant:  ' . $item[0] . ', trim: ' . $item[1] . '}' . PHP_EOL;
                        $i++;
                      }

                      foreach ($status as $key => $item) {
                        switch ($key) {
                          case '0':
                            $nombre = 'Pendiente';
                            break;
                          case '1':
                            $nombre = 'En proceso';
                            break;
                          case '2':
                            $nombre = 'Ejecutado';
                            break;
                        }
                        echo 'data_status[' . $key . '] = {nombre: "' . $nombre . '", cant:  ' . $item[0] . ', trim: ' . $item[1] . '}' . PHP_EOL;
                      }
                      echo "</script>";


                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 pb-3">
            <div class="card h-100 mb-4">
              <div class="ventana-header pb-0 px-3">
                <div class="row">
                  <div class="col-md-12">

                    <h6>Cronograma de actividades<small><br></small>
                      <small class="text-gray-400">Próximos planes</small>
                    </h6>
                  </div>
                </div>

                <div class="tab-content">
                  <ul class="nav nav-pills d-flex flex-nowrap hover-scroll-x pt-2" role="tablist">

                    <?php

                    $fecha1 = $fecha_incial;
                    $fecha2 = $fecha_final;

                    function dia_semana($fecha){

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

                    for ($i = $fecha1; $i <= $fecha2; $i = date("Y-m-d", strtotime($i . "+ 1 days"))) {

                      $result = dia_semana($i);
                      $day = $result[1];
                      $number = $result[0];
                      $class = $result[2];
                      $date = $result[3];

                      echo '<li class="" onclick="viewTaskList(\'' . $date . '\')" >
                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-active-primary ' . $class . '">
                              <span class="opacity-50 fs-7 fw-semibold">' . $number . '</span>
                              <span class="fs-6 fw-bold">' . $day . '</span>
                            </a>
                          </li>';
                    }


                    ?>

                  </ul>


                  <script>
//herea                  
                      function viewTaskList(date) {

                        $('#tareasCronograma').html('')

                        actividades.forEach(element => {


                          if (element[0] == date) {

                            $('#tareasCronograma').append(`<div class="d-flex flex-stack position-relative mt-4">
                              <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                              <div class="fw-semibold ms-5 text-gray-600" style="max-width: 80%;">
                                <div class="fs-5">` + element[5] + `</div>
                                <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">` + element[1] + ` </a>
                                <div class="text-gray-400">
                                  Total: <a class="text-primary" href="#">` + element[2] + `</a> -
                                  Pendientes: <a class="text-primary" href="#">` + element[3] + `</a> -
                                  Ejecutados: <a class="text-primary" href="#">` + element[4] + `</a> -
                                </div>
                              </div>
                              <a href="detalles?id=` + element[6] + `" class="btn btn-bg-light btn-active-color-primary btn-sm">VER</a>
                            </div>`)


                          }

                        });
                        }

                  </script>


                  <div id="tareasCronograma" class="tab-pane fade show active" role="tabpanel">

                  </div>


                </div>












              </div>
            </div>
          </div>


          <div class="col-lg-6 pb-3">
            <div class="card h-100 mb-4">
              <div class="ventana-header pb-0 px-3">
                <div class="row">
                  <div class="col-md-12">
                    <h6 class="mb-0">Principales vertices</h6>
                  </div>
                </div>
                <div id="chartdiv"></div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 pb-3">
            <div class="card h-100 mb-4">
              <div class="ventana-header pb-0 px-3">
                <div class="row">
                  <div class="col-md-12">
                    <h6 class="mb-0">Estatus de las acciones a ejecutar</h6>
                  </div>
                </div>
                <div id="chartdiv2"></div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 pb-3">
            <div class="card h-100 mb-4">
              <div class="ventana-header pb-0 px-3">
                <div class="row">
                  <div class="col-md-12">
                    <h6 class="mb-0">Personas atendidas por mes</h6>
                  </div>
                </div>
                <div id="chartdiv3"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 pb-3">
            <div class="card h-100 mb-4">
              <div class="ventana-header pb-0 px-3">
                <div class="row">
                  <div class="col-md-12">
                    <h6 class="mb-0">Entes con mas participaciones</h6>
                  </div>
                </div>
                <div id="chartdiv4"></div>
              </div>
            </div>
          </div>


          <script>
            function setComuna(codigo, nombre) {
              if (codigo) {
                $('#codigo_comuna').val(codigo)
                $('#comuna').val(nombre)
                $('#modal').removeClass('modal-lg')
                $('#div_list').addClass('hide')
                $('#div_nr').removeClass('col-lg-6')
                $('#div_nr').addClass('col-lg-12')

              } else {
                $('#modal').addClass('modal-lg')
                $('#div_nr').removeClass('col-lg-12')
                $('#div_nr').addClass('col-lg-6')
                $('#div_list').removeClass('hide')
              }

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
                  if (rePol.trim() != 'error') {
                    toast('success', 'Registro realizado correctamente')
                    location.href = 'detalles?id=' + rePol;

                  }
                })
            }
          </script>





          <div class="modal fade" id="setFiltro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title">Filtro</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="max-height: 500px; overflow: auto;">

                  <div class="mb-3">
                    <label for="comuna" class="form-label">Condición del filtro</label>
                    <select type="text" class="form-control" id="periodo">
                      <option value="">Selecciones</option>
                      <option value="anio">Mostrar todo el año</option>
                      <option value="1">Primer trimestre</option>
                      <option value="2">Segundo trimestre</option>
                      <option value="3">Tercer trimestre</option>
                      <option value="4">Cuarto trimestre</option>
                    </select>
                  </div>




                </div>
                <div class="modal-footer">
                  <a class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                  <a onclick="setfiltro()" class="btn btn-primary">Filtrar</a>
                </div>



              </div>
            </div>
          </div>


          <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" id="modal">
              <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title">Nuevo registro</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="max-height: 500px; overflow: auto;">
                  <div class="row">
                    <div class="col-lg-12" id="div_nr">
                      <input type="text" hidden id="codigo_comuna">
                      <div class="mb-3">
                        <label for="comuna" class="form-label" onclick="setComuna()">Comuna</label>
                        <input type="text" class="form-control" readonly id="comuna" onclick="setComuna()">
                      </div>
                      <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha del abordaje</label>
                        <input type="date" class="form-control" id="fecha">
                      </div>
                      <div class="mb-4">
                        <label for="comentarios" class="form-label">Comentarios</label>
                        <input type="text" class="form-control" id="comentarios">
                      </div>
                    </div>


                    <div class="col-lg-6 hide" id="div_list">

                      <h6>Comunas<small><br></small>
                        <small class="text-gray-400">Selección de comuna.</small>
                      </h6>


                      <ul class="list text-gray-400" style="max-height: 300px; overflow-y: auto;">
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


                  </div>




                </div>
                <div class="modal-footer">
                  <a class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                  <a onclick="nuevoRegistro()" class="btn btn-primary">Registrar</a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      </div>
    </main>

    <!--   Core JS Files   -->
    <script src="../../../assets/js/core/popper.min.js"></script>
    <script src="../../../assets/js/core/bootstrap.min.js"></script>
    <script src="../../../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../../../assets/js/plugins/smooth-scrollbar.min.js"></script>

    <script src="../../../assets/amcharts5/index.js"></script>
    <script src="../../../assets/amcharts5/xy.js"></script>
    <script src="../../../assets/amcharts5/percent.js"></script>
    <script src="../../../assets/amcharts5/radar.js"></script>
    <script src="../../../assets/amcharts5/themes/Animated.js"></script>
    <script src="../../../assets/amcharts5/themes/Material.js"></script>


    <script>
      function setfiltro() {
        let inst = $('#periodo').val()
        if (inst == '') {
          toast('error', 'Seleccione una opción')
          return
        }
        // filtrar todos los graficos aqui 
        $('#setFiltro').modal('toggle')
        toast('success', 'Se estableció un filtro con exito')
      }





      /* PieChart con los vertices mas frecuentes */
      var root = am5.Root.new("chartdiv");
      root.setThemes([
        am5themes_Animated.new(root),
        am5themes_Material.new(root)
      ]);
      var chart = root.container.children.push(am5percent.PieChart.new(root, {
        layout: root.horizontalLayout,
        innerRadius: am5.percent(70),
        width: am5.percent(72)
      }));
      var series = chart.series.push(
        am5percent.PieSeries.new(root, {
          name: "Series",
          valueField: "sales",
          categoryField: "country"
        })
      );
      series.labels.template.set("forceHidden", true);
      series.ticks.template.set("forceHidden", true);

      function grafico1() {
        var data = [];

        for (let index = 0; index < data_vertices.length; index++) {
          let nombre
          if (data_vertices[index]['nombre'].length > 20) {
            nombre = data_vertices[index]['nombre'].substr(0, 20) + '...'
          } else {
            nombre = data_vertices[index]['nombre']
          }


          data.push({
            country: nombre,
            sales: data_vertices[index]['cant']
          })

        }

        series.data.setAll(data);

        var legend = chart.children.push(am5.Legend.new(root, {
          centerY: am5.percent(50),
          y: am5.percent(50),
          layout: root.verticalLayout,
          marginTop: 15,
          marginBottom: 15,
          width: am5.percent(50)
        }));

        legend.data.setAll(series.dataItems);
        series.appear(1000, 100);

      }

      grafico1();
      /* PieChart con los vertices mas frecuentes */
      /* ---------------------------------------------- */
      /* PieChart CON STATUS DE LAS ACCIONES */
      var root2 = am5.Root.new("chartdiv2");

      root2.setThemes([
        am5themes_Animated.new(root2),
        am5themes_Material.new(root2)
      ]);

      var chart = root2.container.children.push(am5percent.PieChart.new(root2, {
        layout: root2.verticalLayout
      }));

      var series = chart.series.push(am5percent.PieSeries.new(root2, {
        valueField: "value",
        categoryField: "category"
      }));

      function grafico2() {

        series.data.setAll([{
          value: data_status[0]['cant'],
          category: data_status[0]['nombre'] + '(' + data_status[0]['cant'] + ')'
        }, {
          value: data_status[1]['cant'],
          category: data_status[1]['nombre'] + '(' + data_status[1]['cant'] + ')'
        }, {
          value: data_status[2]['cant'],
          category: data_status[2]['nombre'] + '(' + data_status[2]['cant'] + ')'
        }]);

        series.appear(1000, 100);
      }

      grafico2()
    

      /* PieChart CON STATUS DE LAS ACCIONES */
      
      
      /* barChart CON STATUS DE LAS ACCIONES */
      var root3 = am5.Root.new("chartdiv3");

// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root3.setThemes([
  am5themes_Animated.new(root3),
  am5themes_Material.new(root3)

]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root3.container.children.push(am5xy.XYChart.new(root3, {
  panX: true,
  panY: true,
  wheelX: "panX",
  wheelY: "zoomX",
  pinchZoomX: true
}));

// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root3, {}));
cursor.lineY.set("visible", false);


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xRenderer = am5xy.AxisRendererX.new(root3, { minGridDistance: 30 });
xRenderer.labels.template.setAll({
  rotation: -90,
  centerY: am5.p50,
  centerX: am5.p100,
  paddingRight: 15
});

xRenderer.grid.template.setAll({
  location: 1
})

var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root3, {
  maxDeviation: 0.3,
  categoryField: "month",
  renderer: xRenderer,
  tooltip: am5.Tooltip.new(root3, {})
}));

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root3, {
  maxDeviation: 0.3,
  renderer: am5xy.AxisRendererY.new(root3, {
    strokeOpacity: 0.1
  })
}));


// Create series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.ColumnSeries.new(root3, {
  name: "Series 1",
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "value",
  sequencedInterpolation: true,
  categoryXField: "month",
  tooltip: am5.Tooltip.new(root3, {
    labelText: "{valueY}"
  })
}));

series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5, strokeOpacity: 0 });
series.columns.template.adapters.add("fill", function(fill, target) {
  return chart.get("colors").getIndex(series.columns.indexOf(target));
});

series.columns.template.adapters.add("stroke", function(stroke, target) {
  return chart.get("colors").getIndex(series.columns.indexOf(target));
});



function grafico3() {
  
var data = [{
    month: "Ene",
    value: data_atencionMes[1]
  }, {
    month: "Feb",
    value: data_atencionMes[2]
  }, {
    month: "Mar",
    value: data_atencionMes[3]
  }, {
    month: "Abr",
    value: data_atencionMes[4]
  }, {
    month: "May",
    value: data_atencionMes[5]
  }, {
    month: "Jun",
    value: data_atencionMes[6]
  },{
    month: "Jul",
    value: data_atencionMes[7]
  },{
    month: "Ago",
    value: data_atencionMes[8]
  },{
    month: "Sep",
    value: data_atencionMes[9]
  },{
    month: "Oct",
    value: data_atencionMes[10]
  },{
    month: "Nov",
    value: data_atencionMes[11]
  },{
    month: "Dic",
    value: data_atencionMes[12]
  }];
  
xAxis.data.setAll(data);
series.data.setAll(data);


series.appear(1000);
chart.appear(1000, 100);
}


grafico3()








var root4 = am5.Root.new("chartdiv4");

root4.setThemes([
  am5themes_Animated.new(root4),
  am5themes_Material.new(root4)
]);

var chart2 = root4.container.children.push(am5percent.PieChart.new(root4, {
  startAngle: 180,
  endAngle: 360,
  layout: root4.verticalLayout,
  innerRadius: am5.percent(50)
}));

var series2 = chart2.series.push(am5percent.PieSeries.new(root4, {
  startAngle: 180,
  endAngle: 360,
  valueField: "value",
  categoryField: "category",
  alignLabels: false
}));

series2.states.create("hidden", {
  startAngle: 180,
  endAngle: 180
});

series2.slices.template.setAll({
  cornerRadius: 5
});

series2.ticks.template.setAll({
  forceHidden: true
});









function grafico4(){
  
  var data_entes_vals = [];


  let claves = Object.keys(data_entes)


  claves.forEach(element => {
    data_entes_vals.push({ value: data_entes[element], category: element })
  });

  series2.data.setAll(data_entes_vals);


series2.appear(1000, 100);



}






grafico4()




      /* barChart CON STATUS DE LAS ACCIONES */























      /*  END CHARTS */


    

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