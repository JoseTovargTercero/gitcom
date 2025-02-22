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
    <title class="users" id="title">Usuarios</title>
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
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
            <h6 class="font-weight-bolder mb-0">Inicio</h6>
          </nav>
          <?php include('includes/header.php') ?>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-user opacity-10"></i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Administradores</p>
                  <h4 class="mb-0"><?php echo number_format(contar2('sist_usuarios', 'nivel="1"'), '0', '.', '.') ?></h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">Primer nivel</p>
              </div>
            </div>
          </div>



          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-users opacity-10"></i>

                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Gitcom soporte</p>
                  <h4 class="mb-0"><?php echo number_format(contar2('sist_usuarios', 'nivel="2"'), '0', '.', '.') ?></h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">Segundo nivel</p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-home opacity-10"></i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Instituciones</p>
                  <h4 class="mb-0"><?php echo number_format(contar2('sist_usuarios', 'nivel="4"'), '0', '.', '.') ?></h4>

                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">Tercer nivel</p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-user opacity-10"></i>

                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Comunidades</p>
                  <h4 class="mb-0"><?php echo number_format(contar2('sist_usuarios', 'nivel="3"'), '0', '.', '.') ?></h4>

                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">Cuarto nivel</p>
              </div>
            </div>
          </div>
        </div>




        <div class="row mt-4">

          <div class="col-lg-12 mb-md-0 mb-4">
            <div class="card" style="min-height: 550px;">
              <div class="card-header pb-0">

                <div class="row">
                  <div class="col-lg-9 col-10">
                    <h6>Usuarios</h6>
                  </div>
                </div>
              </div>
              <div class="card-body px-0 pb-2" style="margin: 0 15px 15px">



                <div class="table-responsive p-0  animated fadeInUp" style="overflow-x: visible;">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs">Usuario</th>
                        <th class="text-uppercase text-secondary text-xxs">Teléfono</th>
                        <th class="text-uppercase text-secondary text-xxs">Origen</th>
                        <th class="text-uppercase text-secondary text-xxs"></th>
                      </tr>
                    </thead>
                    <tbody id="tablaUsers">





                    </tbody>
                  </table>




                </div>






              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 mb-md-0 mb-4" style="display: none;">
            <div class="card" style="min-height: 550px;">
              <div class="card-header pb-0">

                <div class="row">
                  <div class="col-lg-9 col-10">
                    <h6>Usuarios</h6>
                  </div>
                </div>
              </div>
              <div class="card-body px-0 pb-2" style="margin: 0 15px 15px">


                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis enim perferendis cumque eos voluptates quasi, provident iusto dolorum, at dolores consequatur quos ab nam dolor? Dolorem, dicta. Id, sequi nihil?



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
    <script>
      function actualizarTablaUser() {
        $.get("consultasAjax/users/users_tabla.php", "", function(data) {
          $("#tablaUsers").html(data);
        });
      }

      actualizarTablaUser()

      function userAccion(tipo, user) {
        alert(user)
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