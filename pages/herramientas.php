<?php
include('../configuracion/conexionMysqli.php');
include('../class/count.php');

unset($_SESSION['proyecto']);
if ($_SESSION['nivel'] != '') {

  $idUser = $_SESSION['id'];

?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/SLS.png">
    <title class="herramientas" id="title">
      Herramientas GITCOM
    </title>


    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <style>
      .list-group-item {
        cursor: pointer;
      }

      .list-group-item:hover {
        filter: brightness(0.9);
      }
    </style>

  </head>

  <body class="g-sidenav-show  bg-gray-200">
    <?php include('includes/menu.php'); ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
      <!-- Navbar -->
      <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Gitcom</a></li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Herramientas</h6>
          </nav>
          <?php include('includes/header.php') ?>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid py-4">



        <div class="row">
          <?php
          $user = $_SESSION['id'];
          $tabla = '';
          $queryyy = "SELECT * FROM herramientas_gitcom WHERE user='$user'";
          $buscarM = $conexion->query($queryyy);
          if ($buscarM->num_rows > 0) {
            while ($row = $buscarM->fetch_assoc()) {
              $tabla .= '
                        <div class="col-md-6 col-xl-3 ">
                        <div class="card h-100 ">
                          <div class="card-body d-flex justify-content-center text-center flex-column p-4">
                          <a href="modulos/' . $row['direccion'] . '/" class="text-gray-800 text-hover-primary d-flex flex-column">  
                          <div class=" mb-3"><img width="70px" src="../assets/img/digital.png" class="theme-dark-show" alt=""></div>
                              <div class="fw-bold mb-1" style="color: #4B5675">
                                ' . $row['nombre'] . '
                              </div>
                            </a>
                            <div class="fs-7 fw-semibold text-gray-400" style="font-size: 13px;">
                            ' . $row['descripcion'] . '
                             </div>
                          </div>
                        </div>
                      </div>
                        ';
            }
          } else {
            $tabla = '
            <div class="card w-100 d-flex p-3">
            <div class="m-auto">
              <img src="../assets/img/work.jpg" alt="sin herramientas" width="400px" class="mb-3">
            <h4 class="text-center text-muted">No tiene herramientas asignadas!</h4>
            </div>
          </div>
            ';
          }
          echo $tabla;

          ?>











        </div>
        <?php include('notificacion.php'); ?>
      </div>
    </main>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
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