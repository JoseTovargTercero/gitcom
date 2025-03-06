<?php
include('../configuracion/conexionMysqli.php');
include('../class/count.php');

if ($_SESSION['nivel'] == 1) {


?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/SLS.png">
    <title class="aca" id="title">Importar</title>


    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../assets/css/animate.css">



    <script src="../assets/js/vis-network.min.js"></script>

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
            <h6 class="font-weight-bolder mb-0">Importar datos</h6>
          </nav>
          <?php include('includes/header.php') ?>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid py-4">




        <div class="row">

          <div class="col-lg-6 animated fadeInUp">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-12 col-7">
                    <h6>Archivos CSV</h6>

                  </div>
                  <hr>
                </div>
              </div>
              <form action="../configuracion/importar.php" method="POST" enctype="multipart/form-data" class="card-body px-0 pb-2" style="  margin: -30px 25px 25px; ">


                <div class="mb-3">
                  <label for="continente_id" class="label-control">Comunidad</label>
                  <div class="input-group input-group-outline ">
                    <input type="file" required class="form-control" name="comunidad">
                  </div>
                </div>



                <div class="mb-3" style="display: none">
                  <label for="continente_id" class="label-control">Areas de interes</label>
                  <div class="input-group input-group-outline ">
                    <input type="file" class="form-control" name="areas">
                  </div>
                </div>



                <div class="mb-3">
                  <label for="continente_id" class="label-control">Calles</label>
                  <div class="input-group input-group-outline ">
                    <input type="file" required class="form-control" name="calles">
                  </div>
                </div>

                <div class="mb-3">
                  <label for="continente_id" class="label-control">Casas</label>
                  <div class="input-group input-group-outline ">
                    <input type="file" required class="form-control" name="casas">
                  </div>
                </div>

                <div class="mb-3">
                  <label for="continente_id" class="label-control">Habitantes</label>
                  <div class="input-group input-group-outline ">
                    <input type="file" required class="form-control" name="habitantes">
                  </div>
                </div>


                <button class="btn btn-danger">Subir</button>



              </form>
            </div>
          </div>




          <div class="col-lg-6 animated fadeInUp">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-12 col-7">
                    <h6>Resultados
                      <small>

                        <?php
                        echo 'Com: ' . contar('local_comunidades', '1', 'status');
                        echo ' - Cal: ' . contar2('inf_jcalles', 'id!=""');
                        echo ' - Hab: ' . contar('inf_habitantes', '0', 'extra');
                        echo ' - Cas: ' . contar2('inf_casas', 'id!=""');
                        ?>

                      </small>

                    </h6>



                  </div>
                  <hr>
                </div>
              </div>
              <div class="card-body px-0 pb-2" style="  margin: -30px 25px 25px; ">

                <p>Areas de interes - Estructura (<?php echo number_format(contar2('temp_areasinteres', 'id!=""'), '0', '.', '.') ?>)</p>

                <?php
                $query_p = "SELECT * FROM temp_areasinteres LIMIT 1";
                $buscarMa = $conexion->query($query_p);
                if ($buscarMa->num_rows > 0) {
                  while ($row_p = $buscarMa->fetch_assoc()) {
                    echo '<p style="background-color: lightgray; padding: 5px"><strong>' . $row_p['area_interes'] . ' * ' . $row_p['longitud'] . '</strong></p>';
                  }
                }
                ?>

                <hr>
                <p>Casas - Estructura (<?php echo number_format(contar2('temp_inf_casas', 'id!=""'), '0', '.', '.') ?>)</p>

                <?php
                $query_p = "SELECT * FROM temp_inf_casas LIMIT 1";
                $buscarMa = $conexion->query($query_p);
                if ($buscarMa->num_rows > 0) {
                  while ($row_p = $buscarMa->fetch_assoc()) {
                    echo '<p style="background-color: lightgray; padding: 5px"><strong>' . $row_p['tipo'] . ' * ' . $row_p['agua_servidas'] . '</strong></p>';
                  }
                }
                ?>

                <hr>
                <p>Calles - Estructura (<?php echo number_format(contar2('temp_inf_jcalles', 'id!=""'), '0', '.', '.') ?>)</p>
                <?php
                $query_p = "SELECT * FROM temp_inf_jcalles LIMIT 1";
                $buscarMa = $conexion->query($query_p);
                if ($buscarMa->num_rows > 0) {
                  while ($row_p = $buscarMa->fetch_assoc()) {
                    echo '<p style="background-color: lightgray; padding: 5px"><strong>' . $row_p['calle'] . ' * ' . $row_p['toponimiaCalle'] . '</strong></p>';
                  }
                }
                ?>
                <hr>
                <p>Habitantes - Estructura (<?php echo number_format(contar2('temp_inf_habitantes', 'id!=""'), '0', '.', '.') ?>)</p>

                <?php
                $query_p = "SELECT * FROM temp_inf_habitantes LIMIT 1";
                $buscarMa = $conexion->query($query_p);
                if ($buscarMa->num_rows > 0) {
                  while ($row_p = $buscarMa->fetch_assoc()) {
                    echo '<p style="background-color: lightgray; padding: 5px"><strong>' . $row_p['rol_familiar'] . ' * ' . $row_p['cedula'] . '</strong></p>';
                  }
                }
                ?>

                <br>

                <a href="../configuracion/importar-manejador.php?key=r" class="btn btn-info">Resetear</a>
                <a href="../configuracion/importar-manejador.php?key=i" style="float: right;" class="btn btn-danger">Cargar</a>



              </div>


            </div>
          </div>


        </div>
      </div>

      </div>

      </div>

      </div>

      </div>
    </main>


    <!--   Core JS Files   -->
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
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