<?php
include('../configuracion/conexionMysqli.php');
include('../class/count.php');

if ($_SESSION['nivel'] == 1) {


  $cantidadComunas = 0;
  $cantidadComunas_terminadas = 0;





  echo '<script>
  var comunidadesCensadas = [];
  var comunidadesFase1 = [];
  </script>';

  $query2E = "SELECT * FROM local_comunidades WHERE status!='0'";
  $search2E = $conexion->query($query2E);
  if ($search2E->num_rows > 0) {
    while ($row2E = $search2E->fetch_assoc()) {
      $com = $row2E['id_consejo'];

      if ($row2E['status'] == '1') {
        echo '<script>
        comunidadesCensadas.push("' . $com . '");
        </script>';
      } else {
        echo '<script>
        comunidadesFase1.push("' . $com . '");
        </script>';
      }
    }
  }







  $query2E = "SELECT * FROM local_comunas";
  $search2E = $conexion->query($query2E);
  if ($search2E->num_rows > 0) {
    while ($row2E = $search2E->fetch_assoc()) {

      $comuna_consulta = $row2E['id_Comuna'];
      $cantidadComunas++;
      if (contar2('local_comunidades', "id_comuna='$comuna_consulta'") == contar2('local_comunidades', "id_comuna='$comuna_consulta' AND status='1'")) {

        if (contar2('local_comunidades', "id_comuna='$comuna_consulta'") != 0) {
          $cantidadComunas_terminadas++;
        }
      }
    }
  }



?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/SLS.png">
    <title class="home" id="title">Incio</title>


    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="mapa/css/leaflet.css">
    <link rel="stylesheet" href="mapa/css/qgis2web.css">
    <style>
      #map {
        width: 100%;
        height: 100%;
      }

      .leaflet-bar {
        box-shadow: none !important
      }

      td {
        font-size: 12px !important;
      }
    </style>

    <!-- AMCHART -->
    <link rel="stylesheet" href="../assets/amcharts5/uso/pie-chart/index.css" />

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
            <h6 class="font-weight-bolder mb-0">Dashboard</h6>
          </nav>
          <?php include('includes/header.php') ?>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-xl-3 col-sm-6">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-star opacity-10"></i>

                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Comunidades</p>
                  <h4 class="mb-0">
                    <span class="hover-danger" style="cursor: help;" title="Fase 2 (Todos los datos recolectados)">
                      <?php echo contar('local_comunidades', '1', 'status') ?>
                    </span>
                    /
                    <span class="hover-danger" style="cursor: help;" title="Fase 1 (Solo servicios)">
                      <?php echo contar2('local_comunidades', 'status!=0') ?>
                    </span>
                    /

                    <span class="hover-danger" style="cursor: help;" title="FGT y LAG">
                      <?php echo contar2('local_comunidades', 'id_parroquia="020301" OR id_parroquia="020302"') ?>
                    </span>

                  </h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">Comunidades con información</p>
              </div>
            </div>
          </div>


          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-user opacity-10"></i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Habitantes</p>
                  <h4 class="mb-0"><?php echo number_format(contar('inf_habitantes', '0', 'extra'), '0', '.', '.') ?></h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">Habitantes censados</p>
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
                  <p class="text-sm mb-0 text-capitalize">Familias</p>
                  <h4 class="mb-0"><?php echo number_format(contar('inf_habitantes', 'JEFE DE FAMILIA', 'rol_familiar'), '0', '.', '.')  ?></h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">Familias censadas</p>
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
                  <p class="text-sm mb-0 text-capitalize">Viviendas</p>
                  <h4 class="mb-0">
                    <?php echo number_format(contar2('inf_casas', '1'), '0', '.', '.') ?>
                  </h4>

                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">Viviendas censadas</p>
              </div>
            </div>
          </div>

        </div>
        <div class="row mt-4">




          <div class="col-lg-7">

            <div class="card " style="overflow: hidden; height: 80vh">
              <div class="card-header pb-0">
                <h6>Comunidades censadas </h6>
              </div>
              <div class="card-body">
                <div id="map" style="height: 60vh"></div>

              </div>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="card" style="height: 80vh; overflow: auto;">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-6 col-7">
                    <h6>Avance por comuna</h6>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">1a</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">2a</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php


                      function avance($comuna)
                      {
                        $data = [];
                        global $conexion;
                        $comunidades_f1 = 0;
                        $comunidades_f2 = 0;


                        $comunidades = contar('local_comunidades', $comuna, 'id_comuna');


                        $stmt = $conexion->prepare("SELECT COUNT(DISTINCT id_c_comunal) FROM inf_casas WHERE id_comuna = ?");
                        $stmt->bind_param('s', $comuna);
                        $stmt->execute();
                        $stmt->bind_result($comunidades_f1);
                        $stmt->fetch();
                        $stmt->close();


                        $stmt = $conexion->prepare("SELECT COUNT(DISTINCT id_c_comunal) FROM inf_habitantes WHERE id_comuna = ?");
                        $stmt->bind_param('s', $comuna);
                        $stmt->execute();
                        $stmt->bind_result($comunidades_f2);
                        $stmt->fetch();
                        $stmt->close();



                        return [$comunidades, $comunidades_f1, $comunidades_f2];
                      }



                      // realizar consulta a la tabla proyectos e imprimir los resultados en una tabla

                      $sql = "SELECT *  FROM local_comunas";
                      $result = mysqli_query($conexion, $sql);
                      if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                          $avances = avance($row['id_Comuna']);
                          echo '<tr>
                              <td> <i style="cursor: pointer; font-size: 12px" class="fa fa-info-circle" onclick="viewAvanceComuna(\'' . $row['id_Comuna'] . '\')"></i> &nbsp;&nbsp;&nbsp;  ' . $row['nombre_comuna'] . '</td>
                              <td class="align-middle">' . $avances[1] . '/ ' . $avances[0] . '</td>
                              <td class="align-middle">' . $avances[2] . '/ ' . $avances[0] . '</td>
                             </tr>';
                        }
                      }

                      ?>
                      <tr>
                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-lg-4">
            <div class="card h-100">
              <div class="card-header pb-0">
                <h6>Ultimos inicios</h6>
              </div>
              <div class="card-body p-3">
                <div class="timeline timeline-one-side">

                  <?php

                  $query = "SELECT * FROM log_usuarios ORDER BY id DESC LIMIT 11";
                  $search1 = $conexion->query($query);
                  if ($search1->num_rows > 0) {
                    while ($row = $search1->fetch_assoc()) {


                      echo '
                      <div class="timeline-block mb-3 d-flex">
                  <span class="timeline-step me-2">
                 
                  <img style="border: 2px solid #ffd4d9 !important;" class="avatar avatar-profile" src="../assets/img/user-pictures/' . $row['id_user'] . '.png" alt="photo-user"  onerror="this.onerror=null; this.src=\'../assets/img/user-pictures/default.jpg\'">



                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">' . $row['usuario'] . '</h6>
                    <p class="text-secondary text-xs mt-1 mb-0">' . date("d-m-Y H:i a", $row['fecha']) . '</p>
                  </div>
                </div>';
                    }
                  }

                  ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8 col-md-6">

            <div class="card " style="overflow: hidden;">
              <div class="card-header pb-0">
                <h6>Avances total </h6>
              </div>
              <div class="card-body">
                <div id="chartdiv" style="height: 60vh"></div>

              </div>
            </div>

            <div class="card " style="overflow: hidden; margin-top: 15px;">
              <div class="card-body">
                <div id="chartdiv2" style="height: 10vh"></div>
              </div>
            </div>
          </div>

        </div>


        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Avance de la comunidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="table-responsive p-0  animated fadeInUp" style="overflow-x: auto !important;">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs">Comunidad</th>
                        <th class="text-uppercase text-secondary text-xxs text-center">Fase</th>
                        <th class="text-uppercase text-secondary text-xxs">Viviendas</th>
                        <th class="text-uppercase text-secondary text-xxs">Habitantes</th>
                      </tr>
                    </thead>
                    <tbody id="staticBackdropContenido">

                    </tbody>
                  </table>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>




        <?php include('notificacion.php'); ?>

      </div>
    </main>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>

    <!-- AMCHART -->
    <script src="../assets/amcharts5/index.js"></script>
    <script src="../assets/amcharts5/percent.js"></script>
    <script src="../assets/amcharts5/xy.js"></script>
    <script src="../assets/amcharts5/themes/Animated.js"></script>
    <script src="../assets/amcharts5/themes/Material.js"></script>


    <script src="mapa/js/leaflet.js"></script>
    <script src="mapa/data/comunidades_0.js"></script>

    <script>
      var map = L.map('map', {
        zoomControl: false,
        maxZoom: 28,
        minZoom: 1
      })

      map.attributionControl.setPrefix('');

      var bounds_group = new L.featureGroup([]);

      function setBounds() {
        if (bounds_group.getLayers().length) {
          map.fitBounds(bounds_group.getBounds());
        }
      }

      function pop_comunidades_0(feature, layer) {
        var popupContent = (feature.properties['NAME'] !== null ? feature.properties['NAME'].toLocaleString() : '') + '<br>' + (feature.properties['COMUNA'] !== null ? feature.properties['COMUNA'].toLocaleString() : '') + '<br>' + (feature.properties['id_comunid'] !== null ? feature.properties['id_comunid'].toLocaleString() : '');

        layer.bindPopup(popupContent, {
          maxHeight: 400
        });
      }

      function style_comunidades_0_0(feature) {
        // alert(feature.properties['NAME'])
        let color = 'rgba(234,234,234,1.0)';



        if (comunidadesCensadas.indexOf(feature.properties['id_comunid']) != -1) {
          color = '#d64757';
        } else if (comunidadesFase1.indexOf(feature.properties['id_comunid']) != -1) {
          color = '#ffd400';
        }




        /*
        if (feature.properties['id_comunid'] == '' || feature.properties['id_comunid'] == undefined) {
          color = '#000';
        }
        */



        return {
          pane: 'pane_comunidades_0',
          opacity: 1,
          color: 'rgba(163,163,163,1.0)',
          dashArray: '',
          lineCap: 'butt',
          lineJoin: 'miter',
          weight: 1.0,
          fill: true,
          fillOpacity: 1,
          fillColor: color,
          interactive: true,
        }
      }
      map.createPane('pane_comunidades_0');
      map.getPane('pane_comunidades_0').style.zIndex = 400;
      map.getPane('pane_comunidades_0').style['mix-blend-mode'] = 'normal';
      var layer_comunidades_0 = new L.geoJson(json_comunidades_0, {
        attribution: '',
        interactive: true,
        dataVar: 'json_comunidades_0',
        layerName: 'layer_comunidades_0',
        pane: 'pane_comunidades_0',
        onEachFeature: pop_comunidades_0,
        style: style_comunidades_0_0,
      });
      bounds_group.addLayer(layer_comunidades_0);
      map.addLayer(layer_comunidades_0);
      setBounds();
      var i = 0;
      var totalMarkers = 0
      layer_comunidades_0.eachLayer(function(layer) {
        var context = {
          feature: layer.feature,
          variables: {}
        };
        totalMarkers += 1;
        layer.added = true;
        i++;
      });
    </script>

    <script>
      function viewAvanceComuna(comuna) {
        $.ajax({

            url: 'consultasAjax/inicio_avance-comunidades.php',
            type: 'POST',
            dataType: 'html',
            data: {
              comuna: comuna
            },
          })
          .done(function(rePol) {
            let respuesta = JSON.parse(rePol)
            $('#staticBackdrop').modal('toggle')


            $('#staticBackdropContenido').html('')


            for (const key in respuesta) {
              if (respuesta.hasOwnProperty(key)) {
                $('#staticBackdropContenido').append(`
                  <tr>
                    <td>${respuesta[key].comunidad}</td>
                    <td class="text-center"><b>${(respuesta[key].fase == 0 ? '<span class="text-info">PENDIENTE</span>' : 'Fase ' + respuesta[key].fase)}</b></td>
                    <td>${respuesta[key].viviendas}</td>
                    <td>${respuesta[key].personas}</td>
                  </tr>
                `)

              }
            }


          })
      }



      //<i class="fa fa-check"></i>
      /* graficos */
      function graficoAvance() {
        // Create root element
        var root = am5.Root.new("chartdiv");

        // Set themes
        root.setThemes([
          am5themes_Animated.new(root),
          am5themes_Material.new(root)
        ]);

        // Create chart
        var chart = root.container.children.push(am5percent.PieChart.new(root, {
          layout: root.verticalLayout
        }));


        // Create series
        var series = chart.series.push(
          am5percent.PieSeries.new(root, {
            valueField: "value",
            categoryField: "category",
            alignLabels: false
          })
        );


        series.labels.template.setAll({
          textType: "circular",
          radius: 4
        });


        // Set data
        series.data.setAll([{
            value: <?php echo contar('local_comunidades', '1', 'status') ?>,
            category: "Censado"
          },
          {
            value: <?php echo contar('local_comunidades', '0', 'status') ?>,
            category: "Faltante"
          }
        ]);


        // Create legend
        // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
        var legend = chart.children.push(am5.Legend.new(root, {
          centerX: am5.percent(50),
          x: am5.percent(50),
          marginTop: 15,
          marginBottom: 15,
        }));

        legend.data.setAll(series.dataItems);


        // Play initial series animation
        // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
        series.appear(1000, 100);
      }

      graficoAvance()



      function graficoAvanceComuna() {
        am5.ready(function() {

          // Create root element
          // https://www.amcharts.com/docs/v5/getting-started/#Root_element
          var root = am5.Root.new("chartdiv2");


          // Set themes
          // https://www.amcharts.com/docs/v5/concepts/themes/
          root.setThemes([
            am5themes_Animated.new(root)
          ]);


          // Create chart
          // https://www.amcharts.com/docs/v5/charts/xy-chart/
          var chart = root.container.children.push(am5xy.XYChart.new(root, {
            panX: false,
            panY: false,
            wheelX: "none",
            wheelY: "none",
            layout: root.verticalLayout
          }));


          var data = [{
            category: "",
            open: 0,
            close: <?php echo $cantidadComunas ?>,
            average: <?php echo $cantidadComunas_terminadas ?>
          }];



          // Create axes
          // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
          var yAxis = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
            categoryField: "category",
            renderer: am5xy.AxisRendererY.new(root, {
              cellStartLocation: 0.1,
              cellEndLocation: 0.9
            }),
            tooltip: am5.Tooltip.new(root, {})
          }));

          yAxis.data.setAll(data);

          var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
            renderer: am5xy.AxisRendererX.new(root, {
              minGridDistance: 30
            })
          }));

          xAxis.get("renderer").grid.template.set("visible", false);


          // Add series
          // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
          var series = chart.series.push(am5xy.ColumnSeries.new(root, {
            xAxis: xAxis,
            yAxis: yAxis,
            openValueXField: "open",
            valueXField: "close",
            categoryYField: "category",
            fill: am5.color(0x888888)
          }));

          series.columns.template.setAll({
            height: 10
          });

          series.data.setAll(data);

          // Add bullets
          series.bullets.push(function() {
            return am5.Bullet.new(root, {
              locationX: 0,
              sprite: am5.Circle.new(root, {
                fill: am5.color(0x009dd9),
                radius: 10
              })
            });
          });

          series.bullets.push(function() {
            return am5.Bullet.new(root, {
              locationX: 1,
              sprite: am5.Circle.new(root, {
                fill: am5.color(0x009dd9),
                radius: 10
              })
            });
          });


          var series2 = chart.series.push(am5xy.LineSeries.new(root, {
            name: "Avance",
            xAxis: xAxis,
            yAxis: yAxis,
            valueXField: "average",
            categoryYField: "category"
          }));

          series2.strokes.template.setAll({
            visible: false
          });

          series2.data.setAll(data);

          // Add bullets
          series2.bullets.push(function() {
            return am5.Bullet.new(root, {
              sprite: am5.Triangle.new(root, {
                fill: am5.color(0x70b603),
                rotation: 180,
                width: 24,
                height: 24
              })
            });
          });



          // Add bullets
          series3.bullets.push(function() {
            return am5.Bullet.new(root, {
              locationX: 0,
              sprite: am5.Circle.new(root, {
                fill: am5.color(0x009dd9),
                radius: 10
              })
            });
          });
          series3.data.setAll(data);

          // Add legend
          var legend = chart.children.push(am5.Legend.new(root, {
            layout: root.horizontalLayout,
            clickTarget: "none"
          }));

          legend.data.setAll([series3, series2]);


          // Make stuff animate on load
          // https://www.amcharts.com/docs/v5/concepts/animations/
          series.appear();
          chart.appear(1000, 100);

        }); // end am5.ready()
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