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
  $query = $conexion->query("select * from local_municipio");
  $countries = array();
  while ($r = $query->fetch_object()) {
    $countries[] = $r;
  }
?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title class="aca" id="title">Incio</title>
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
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
          <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
            <div class="card" style="max-height: 85vh; overflow: auto;">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-12 col-7">
                    <h6>Agendas registradas


                    <a href="nuevoAca.php" class="btn" style="float: right; text-decoration: none; padding: 0;"> <i class="fa fa-plus"></i> Nuevo aca</a>
                    </h6>

                  </div>
<hr>
                </div>
              </div>
              <div class="card-body px-0 pb-2" style="margin-top: -20px;">

                <div style="margin: 0 15px !important;">

                  <?php
                  $menu = 1;

                  class MiBD extends SQLite3{
                    function __construct(){
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
                    $queryyy4 = "SELECT * FROM aca_resultado WHERE activo='0' AND comuna='$comunaConsultar'";
                  } else {
                    $queryyy4 = "SELECT * FROM aca_resultado WHERE activo='0'";
                  }

                  $buscarM4 = $conexion->query($queryyy4);
                  if ($buscarM4->num_rows > 0) {
                    while ($row4 = $buscarM4->fetch_assoc()) {
                      $comunidad = $row4['comunidad'];
                      $comuna = $row4['comuna'];
                      $idP =  $row4['id'];
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

                      $nudos = '';
                      $potencialidades = '';

                      $queryyy445 = "SELECT * FROM aca_mapa WHERE problema='$idP'";
                      $buscarM4455 = $conexion->query($queryyy445);
                      if ($buscarM4455->num_rows > 0) {
                        while ($row4455 = $buscarM4455->fetch_assoc()) {

                          if ($row4455['tipo'] == 'n') {
                            $nudos .=  $row4455['detalle'].'. ';
                          }else{
                            $potencialidades .= $row4455['detalle'].'. ';
                          }
                          }
                      }




                      $soluciones = $row4['soluciones'];
                      $ejecutor = $row4['ejecutor'];


                      if ($_GET['id'] != '' && $_GET['problemas']  != '' && $_GET['comuna']  != '') {
                        echo '<a onclick=\'asociar("' . $problema . '", "' . $idAcaComunal . '")\'>Asociar</a> ';
                      } else {
                        if ($tp == '1') {
                          $link = '<a style=\'float: right\' href=\'mapa/index.php?proceso=aca&comunidad=' . $row4['comunidad'] . '&idProblema=' . $row4['id'] . '&tipo=comunal\'><i class=\'fa fa-folder-open text-sm me-2\'></i>Abrir</a>';
                        } else {
                          $link = '<a style=\'float: right\' href=\'mapa/index.php?proceso=aca&comunidad=' . $row4['comunidad'] . '&idProblema=' . $row4['id'] . '\'><i class=\'fa fa-folder-open text-sm me-2\'></i>Abrir</a>';
                        }
                      }

                      $modificar = '';
                    //  $modificar = '<a style=\'float: left\' href=\'mapa/modificarAca.php?proceso=aca&comunidad=' . $row4['comunidad'] . '&idProblema=' . $row4['id'] . '\'><i class=\'fa fa-pencil text-sm me-2\'></i>Editar</a>';



                      echo '<a  onclick="verAca(\'menu' . $menu . '\')" class="linkAc">
                         <span style="font-size: .8rem !important;">' . $problema . '</span>
                         <small style="font-size: .7rem !important;" class="font-weight-bold">' . $localidad . '</small>
                        </a>

                        <script>
             
                        array.push("<div style=\'font-size: .8rem !important;\' class=\'data menu' . $menu . '\'><span class=\'mb-2\'><br><span class=\'font-weight-bold\'>' . $localidad . '</span><br><span class=\'mb-2\'><br><span class=\'font-weight-bold\'> Problema:</span> <span class=\'ms-sm-2\'>' . $problema . '</span><span class=\'mb-2\'><br><span class=\'font-weight-bold\'> Nudos criticos:</span> <span class=\'ms-sm-2\'>' . $nudos . '</span></span><br><span class=\'mb-2\'><span  class=\'font-weight-bold\'> Potencialidades:</span> <span class=\'ms-sm-2\'>' . $potencialidades . '</span></span><br><span class=\'mb-2\'><span class=\'font-weight-bold\'> Soluciones:</span> <span class=\'ms-sm-2\'>' . $soluciones . '</span></span><br><span class=\'mb-2\'><span class=\'font-weight-bold\'> Responsable:</span> <span class=\'ms-sm-2\'>' . $ejecutor . '</span></span><br><br>'. $modificar . $link . '</div>");


                      </script>';

                      $menu++;

                      }
                    }else {
                      echo 'No hay información para mostrar';
                    }
                 
                  ?>
                </div>
              </div>
            </div>
          </div>

       
        <!-- 
          
            Some folks are born made to wave the flag
            Ooh, they're red, white and blue
            And when the band plays "Hail to the Chief"
            Ooh, they point the cannon at you, Lord
            It ain't me, it ain't me
            I ain't no senator's son, son
            It ain't me, it ain't me
            I ain't no fortunate one, no
            Some folks are born silver spoon in hand
            Lord, don't they help themselves, Lord?
            But when the taxman come to the door
            Lord, the house lookin' like a rummage sale, yeah
            It ain't me, it ain't me
            I ain't no millionaire's son, no, no
            It ain't me, it ain't me
            I ain't no fortunate one, no
            Yeah-yeah, some folks inherit star-spangled eyes
            Ooh, they send you down to war, Lord
            And when you ask 'em, "How much should we give?"
            Hoo, they only answer, "More, more, more, more"
            It ain't me, it ain't me
            I ain't no military son, son, Lord
            It ain't me, it ain't me
            I ain't no fortunate one, one
            It ain't me, it ain't me
            I ain't no fortunate one, no, no, no
            It ain't me, it ain't me
            I ain't no fortunate son, no, no, no
            It ain't me, it ain't me...

         -->
<div class="col-lg-6">

          <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
            <div class="card" style="min-height: 20vh; overflow: auto;">
              <div class="card-header pb-0" >
                <div class="row">
                  <div class="col-lg-12 col-7">
                    <h6>Detalles</h6>
                  </div>
                    <hr>
                </div>
              </div>
              <div class="card-body px-0 pb-2" style="margin-top: -20px;">
                <div style="margin: 0 15px !important;" id="sectionDetails"> </div>
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
      .data{
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





      var ctx = document.getElementById("chart-bars").getContext("2d");

      new Chart(ctx, {
        type: "bar",
        data: {
          labels: ["L", "M", "M", "J", "V", "S", "D"],
          datasets: [{
            label: "Inicios",
            tension: 0.4,
            borderWidth: 0,
            borderRadius: 4,
            borderSkipped: false,
            backgroundColor: "rgba(255, 255, 255, .8)",
            data: [50, 20, 10, 22, 50, 10, 40],
            maxBarThickness: 6
          }, ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5],
                color: 'rgba(255, 255, 255, .2)'
              },
              ticks: {
                suggestedMin: 0,
                suggestedMax: 500,
                beginAtZero: true,
                padding: 10,
                font: {
                  size: 14,
                  weight: 300,
                  family: "Roboto",
                  style: 'normal',
                  lineHeight: 2
                },
                color: "#fff"
              },
            },
            x: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5],
                color: 'rgba(255, 255, 255, .2)'
              },
              ticks: {
                display: true,
                color: '#f8f9fa',
                padding: 10,
                font: {
                  size: 14,
                  weight: 300,
                  family: "Roboto",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
          },
        },
      });







      var ctx2 = document.getElementById("chart-line").getContext("2d");

      new Chart(ctx2, {
        type: "line",
        data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
            label: "Mobile apps",
            tension: 0,
            borderWidth: 0,
            pointRadius: 5,
            pointBackgroundColor: "rgba(255, 255, 255, .8)",
            pointBorderColor: "transparent",
            borderColor: "rgba(255, 255, 255, .8)",
            borderColor: "rgba(255, 255, 255, .8)",
            borderWidth: 4,
            backgroundColor: "transparent",
            fill: true,
            data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
            maxBarThickness: 6

          }],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5],
                color: 'rgba(255, 255, 255, .2)'
              },
              ticks: {
                display: true,
                color: '#f8f9fa',
                padding: 10,
                font: {
                  size: 14,
                  weight: 300,
                  family: "Roboto",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                color: '#f8f9fa',
                padding: 10,
                font: {
                  size: 14,
                  weight: 300,
                  family: "Roboto",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
          },
        },
      });

      var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

      new Chart(ctx3, {
        type: "line",
        data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
            label: "Mobile apps",
            tension: 0,
            borderWidth: 0,
            pointRadius: 5,
            pointBackgroundColor: "rgba(255, 255, 255, .8)",
            pointBorderColor: "transparent",
            borderColor: "rgba(255, 255, 255, .8)",
            borderWidth: 4,
            backgroundColor: "transparent",
            fill: true,
            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
            maxBarThickness: 6

          }],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5],
                color: 'rgba(255, 255, 255, .2)'
              },
              ticks: {
                display: true,
                padding: 10,
                color: '#f8f9fa',
                font: {
                  size: 14,
                  weight: 300,
                  family: "Roboto",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                color: '#f8f9fa',
                padding: 10,
                font: {
                  size: 14,
                  weight: 300,
                  family: "Roboto",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
          },
        },
      });
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