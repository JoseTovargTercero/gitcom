<?php
include('../configuracion/conexionMysqli.php');
include('../class/count.php');

if ($_SESSION['nivel'] == 1) {
  unset($_SESSION['proyecto']);

?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title class="solicitud" id="title">Usuarios</title>
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <script src="../assets/js/sweetalert2.all.min.js"></script>

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
            <h6 class="font-weight-bolder mb-0">Solicitudes de acceso</h6>
          </nav>
          <?php include('includes/header.php') ?>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid py-4">
      


      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Solicitudes de acceso</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0" style="min-height: 400px; overflow: visible;">
              <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs">Usuario</th>
                        <th class="text-uppercase text-secondary text-xxs">Teléfono</th>
                        <th class="text-uppercase text-secondary text-xxs">Tipo</th>
                        <th class="text-uppercase text-secondary text-xxs">Origen</th>
                        <th class="text-uppercase text-secondary text-xxs">Estatus</th>
                        <th class="text-uppercase text-secondary text-xxs"></th>
                      </tr>
                    </thead>
                    <tbody id="tablaUsers"></tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>



      </div>
    </main>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/material-dashboard.min.js?v=3.0.2"></script>

    <script src="../class/alertas.js"></script>

    <script>
      function actualizarTablaUser() {
          $.get("consultasAjax/users/users_tabla_solicitudes.php", "", function(data) {
            if (data.trim() != '1') {
              $("#tablaUsers").html(data);
            }
          });
      }

      actualizarTablaUser()

      function userAccion(tipo, user, tipoUser) {
        if (tipo == 2) {
          window.location.href = "datos_solicitud.php?id="+user;
        }else{


          Swal.fire({
            title: '¿Esta seguro?',
            html: 'Se eliminara la solicitud de acceso.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ed5264',
            confirmButtonText: 'Dar acceso',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
              if (result.isConfirmed) {
                $.get("consultasAjax/users/users_tabla_eliminar_sol.php", "id="+user, function(data) {
                  $("#tablaUsers").html(data);
                });
                actualizarTablaUser()
              }
            })




        }
      }
    </script>
  </body>


  </html>


<?php
} else {
  define('PAGINA_INICIO', '../index.php');
  header('Location: ' . PAGINA_INICIO);
}
?>