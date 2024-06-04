<?php
include('../../../configuracion/conexionMysqli.php');
include('../../../class/count.php');

unset($_SESSION['proyecto']);
if ($_SESSION['nivel'] != '') {

  $idUser = $_SESSION['id'];

  $he = '2';
  $queryyy = "SELECT * FROM herramientas_gitcom WHERE id='$he'";
  $buscarM = $conexion->query($queryyy);
  if ($buscarM->num_rows > 0) {
    while ($row = $buscarM->fetch_assoc()) {
      $h_nombre = $row['nombre'];
    }
  } else {
/*
    define('PAGINA_INICIO', '../../../index.php');
    header('Location: ' . PAGINA_INICIO);*/
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


          <div class="col-lg-12 mb-3">
            <div class="card h-100 mb-4">
              <div class="ventana-header pb-0 px-3">
                <div class="row">
                  <div class="col-md-12">
                    <h6>Registros<small><br></small><small class="text-gray-400">Caracterización de empresas.</small></h6>
                  </div>
                </div>
             

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

                      $queryyy = "SELECT * FROM temp_caracterizacion_empresas";
                      $buscarM = $conexion->query($queryyy);
                      if ($buscarM->num_rows > 0) {
                        while ($row = $buscarM->fetch_assoc()) {


                          echo '
                      <tr>
                      <td width="3%">
                      
                      <div class="me-4 position-relative">
                      <div class="symbol symbol-35px ">
                        <span class="symbol-label bg-light-danger text-danger fw-semibold symbol-circle">' . substr($row['empresa'], 0, 1) . '</span>
                      </div>
                    </div>

                      </td>
                      <td  width="54%">
                      
                      <div class="fw-semibold">
                      <span class="fs-5 fw-bold text-gray-800 text-hover-primary">' . $row['empresa'] . '</span>
                      <div class="text-gray-400">
                      Prod: <strong class="text-gray-800">' . $row['prod_bienes'] . '</strong>. 
                      Dist: <strong class="text-gray-800">' . $row['dist_bienes'] . '</strong>. 
                      Com: <strong class="text-gray-800">' . $row['com_bienes'] . '</strong>. 
                      Serv: <strong class="text-gray-800">' . $row['pres_servicios'] . '</strong>
                      </div>
                      
                    </div>
                      </td>


                      <td width="40%">

                      <span class="text-gray-800 fw-800">' . fechaCastellano($row['fecha']) . ' - '.date('H:i a', strtotime($row['fecha'])).'</span>
                      <br>
                      <span class="text-gray-400">'.$row['fecha'].'</span>
                      </td>

                  


                      <td width="3%">
                      <div class="ms-auto"><a class="text-muted" onclick="nuevoRegistro(' . $row['id'] . ')"><i class="fa fa-eye"></i></a></div>
                      </td>
                      </tr>';
                        }
                      }


                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

     


          <script>
    

            function nuevoRegistro(registro) {

              $.ajax({
                  url: 'manejador.php',
                  type: 'POST',
                  dataType: 'html',
                  data: {
                    registro: registro
                  },
                })
                .done(function(rePol) {
                  $('#detallesInfo').html(rePol)
                  $('#exampleModal2').modal('toggle')
                })
            }
          </script>






          <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" >
              <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title">Detalles de registro</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="max-height: 500px; overflow: auto;" id="detallesInfo">



                </div>
                <div class="modal-footer">
                  <a class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</a>
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




    <script>
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