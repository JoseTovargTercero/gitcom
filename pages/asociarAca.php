<!--
=========================================================
* Material Dashboard 2 - v=3.0.2
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

if ($_SESSION['nivel'] == 1) {
  unset($_SESSION['proyecto']);



  if ($_GET['id'] != '' && $_GET['problemas']  != '' && $_GET['comuna']  != '' && $_GET['proceso']  == '1') {
  } else {
    /*
  define('PAGINA_INICIO', 'listaAca.php');
  header('Location: ' . PAGINA_INICIO);
  */
  }


?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/SLS.png">
    <title class="aca" id="title">Incio</title>
    <link id="pagestyle" href="../assets/css/animate.css" rel="stylesheet" />
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script>
      var array = [];
    </script>
    <style>
      section p {
        margin: 0 !important;
        overflow: hidden;
        max-height: 0;
        text-align: justify;
        background: #b7b7b752;
      }

      .linkAc {
        text-decoration: none;
        display: grid;
        text-align: left;
        padding: 10px;
        border-bottom: 1px solid #eeeeee;
        cursor: pointer;
      }

      section:target p {
        max-height: 1000px;
        padding: 20px;
      }

      .linkAc:hover {
        color: #ed5264 !important;
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
            <h6 class="font-weight-bolder mb-0">Agenda concreta de acción</h6>
          </nav>
          <?php include('includes/header.php') ?>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid py-4">

        <div class="row mb-4">
          <div class="col-lg-12 mb-md-0 mb-4">
            <div class="card" style="max-height: 85vh; overflow: auto;">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-12 col-7">
                    <h6>Agendas registradas</h6>

                  </div>
                  <hr>
                </div>
              </div>
              <div class="card-body px-0 pb-2" style="margin-top: -20px;">

                <div style="margin: 0 15px !important;">


                  <div class="card-box table-responsive">

                    <table id="datatable-responsive" class="table table-striped table-bordered" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr class="headings">
                          <th style="padding: 0.6rem;"># </th>
                          <th style="padding: 0.6rem;">Problema </th>
                          <th style="padding: 0.6rem;">Comunidad/comuna</th>
                          <th style="padding: 0.6rem;">Asociar</th>
                        </tr>
                      </thead>




                      <tbody>







                        <?php


                        $menu = 1;

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


                        $idUser = $_SESSION['id'];

                        if ($_GET['id'] != '' && $_GET['problemas']  != '' && $_GET['comuna']  != '') {
                          $comunaConsultar = $_GET['comuna'];
                          $idAcaComunal = $_GET['id'];
                          $queryyy4 = "SELECT * FROM aca_resultado WHERE activo='0' AND comuna='$comunaConsultar' AND comunidad!='0'";
                        }

                        $buscarM4 = $conexion->query($queryyy4);
                        if ($buscarM4->num_rows > 0) {
                          while ($row4 = $buscarM4->fetch_assoc()) {
                            $comunidad = $row4['comunidad'];
                            $comuna = $row4['comuna'];
                            $problema =  $row4['id'];
                            $idTag = 'problema' . $problema;




                            if ($comunidad == 0) {
                              $queryyy44 = "SELECT * FROM local_comunas WHERE id_Comuna='$comuna' LIMIT 1";
                              $buscarM44 = $conexion->query($queryyy44);
                              if ($buscarM44->num_rows > 0) {
                                while ($row44 = $buscarM44->fetch_assoc()) {
                                  $localidad = $row44['nombre_comuna'];
                                  $problema = $row4['problema'];
                                  $tp = '1';
                                }
                              }
                            } else {
                              $tp = '0';
                              $localidad =  $states[$comunidad];
                              $problema = $row4['problema'];
                            }
                            $idProblema = $row4['id'];
                            $var++;
                            echo '<tr id="problema' . $idProblema . '">
                              <td><span style="font-size: .8rem !important;">' . $var . '</span></td>
                              <td><span style="font-size: .8rem !important;">' . $problema . '</span></td>
                              <td><small style="font-size: .7rem !important;" class="font-weight-bold">' . $localidad . '</small></td>
                              <td><a style="cursor: pointer" onclick=\'asociar("' . $idAcaComunal . '", "' . $idProblema . '")\'><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Asociar</a>
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
          </div>
          <?php include('notificacion.php'); ?>

        </div>
    </main>
    <script>
      array.forEach(element => {
        $("#sectionDetails").html($("#sectionDetails").html() + element);
      });

      function verAca(id) {
        $(".data").hide();
        $("." + id).show();
      }
    </script>

    <style>
      .data {
        display: none;
      }
    </style>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script>
      function asociar(acaComunal, idProblema) {
        $.ajax({
            url: 'moduloAca/ajaxC_asociar_aca.php',
            type: 'POST',
            dataType: 'html',
            data: {
              acaComunal: acaComunal,
              idNuevo: idProblema
            },
          })
          .done(function(resultado5) {
            $('#problema' + idProblema).addClass('animated fadeOutUp')


            setTimeout(function() {
              $('#problema' + idProblema).hide()
            }, 1000);

          })
      }
    </script>
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