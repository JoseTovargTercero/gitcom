<script>
  var inicialIndex = 0;
  /* Array instancias */
  var municipio = [];
  var parroquias = [];
  var comunas = [];
  var comunidades = [];
  var all = [];
  var datosPerspectiva = []
  var comunidadesCensadas = [];
  var datosMapa = [];
  var categoriasBarras = [];
</script>

<?php
include('../configuracion/conexionMysqli.php');
include('../class/count.php');
include('../class/arrayGraficos.php');

if ($_SESSION['nivel'] == '') {
  define('PAGINA_INICIO', '../login/salir.php');
  header('Location: ' . PAGINA_INICIO);
}



if ($_SESSION['nivel'] != '') {

  $comunidad = $_SESSION['dato1'];
  $id = $_SESSION['id'];


  $stmt = $conexion->prepare("SELECT usuario, nivel FROM sist_usuarios WHERE id = ?");
  $stmt->bind_param('s', $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $datos = false;

  if ($row = $result->fetch_assoc()) {
    $datos = !($row['nivel'] == 3 && strpos($row['usuario'], '@') === false);
  }

  $stmt->close();


?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/SLS.png">
    <title class="index" id="title">Incio</title>
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="mapa/css/leaflet.css">
    <script src="../assets/js/sweetalert2.all.min.js"></script>

    <?php

    echo '<script>' . PHP_EOL;

    function addInfoInstancias($tabla, $array, $campo1, $campo2, $campo3)
    {
      global $conexion;
      switch ($tabla) {
        case '1':
          $t = 'local_municipio';
          break;
        case '2':
          $t = 'local_parroquia';
          break;
        case '3':
          $t = 'local_comunas';
          break;
        case '4':
          $t = 'local_comunidades';
          break;
      }

      $query2 = "SELECT * FROM $t";
      $search2 = $conexion->query($query2);
      if ($search2->num_rows > 0) {
        while ($row2 = $search2->fetch_assoc()) {
          echo $array . '.push(["' . $row2[$campo1] . '", "' . $row2[$campo2] . '", "' . $row2[$campo3] . '"]);';
          echo 'all["' . $row2[$campo2] . '"] = "' . $row2[$campo3] . '";';
        }
      }
    }

    addInfoInstancias('1', 'municipio', 'id_estado', 'id_municipio', 'nombre_municipio');
    addInfoInstancias('2', 'parroquias', 'id_municipio', 'id_parroquias', 'nombre_parroquia');
    addInfoInstancias('3', 'comunas', 'id_parroquia', 'id_Comuna', 'nombre_comuna');
    addInfoInstancias('4', 'comunidades', 'id_comuna', 'id_consejo', 'nombre_c_comunal');



    foreach ($arrayConsultas as $item) {

      if ($item[0] == 'inf_habitantes') {
        $t = 2;
      } else {
        $t = 1;
      }

      if ($item[2] != '(General - ADM)') {
        if (@$item[4]) {
          $s = $item[4];
        } else {
          $s = 'x';
        }


        echo 'datosPerspectiva.push({c: \'' . $item[1] . '\', titulo: "' . $item[2] . '", nombre: "' . $item[3] . '", tipo: "' . $t . '", s: "' . $s . '"})' . PHP_EOL;
        echo 'categoriasBarras.push("' . $item[2] . '")' . PHP_EOL;
      }

      echo 'datosMapa.push({t: "' . $t . '", c: \'' . $item[1] . '\', titulo: "' . $item[3] . '"})' . PHP_EOL;
    }

    // DASHBOARD DATA EXTRACTION: atencion_social
    $dashboardData = [
      'categoria' => [],
      'requerimiento' => [],
      'responsable' => [],
      'municipio' => [],
      'parroquia' => [],
      'comuna' => [],
      'anio' => [],
      'total' => 0
    ];

    $resTotal = $conexion->query("SELECT COUNT(*) as t FROM atencion_social");
    if($resTotal) {
        $row = $resTotal->fetch_assoc();
        $dashboardData['total'] = $row['t'];
    }

    $queries = [
      'categoria' => "SELECT CATEGORIA as label, COUNT(*) as value FROM atencion_social WHERE CATEGORIA IS NOT NULL AND CATEGORIA != '' GROUP BY CATEGORIA",
      'requerimiento' => "SELECT REQUERIMIENTO as label, COUNT(*) as value FROM atencion_social WHERE REQUERIMIENTO IS NOT NULL AND REQUERIMIENTO != '' GROUP BY REQUERIMIENTO ORDER BY value DESC LIMIT 10",
      'responsable' => "SELECT RESPONSABLE as label, COUNT(*) as value FROM atencion_social WHERE RESPONSABLE IS NOT NULL AND RESPONSABLE != '' GROUP BY RESPONSABLE ORDER BY value DESC LIMIT 10",
      'municipio' => "SELECT MUNICIPIO as label, COUNT(*) as value FROM atencion_social WHERE MUNICIPIO IS NOT NULL AND MUNICIPIO != '' GROUP BY MUNICIPIO ORDER BY value DESC",
      'parroquia' => "SELECT PARROQ as label, COUNT(*) as value FROM atencion_social WHERE PARROQ IS NOT NULL AND PARROQ != '' GROUP BY PARROQ ORDER BY value DESC LIMIT 10",
      'comuna' => "SELECT COMUNA as label, COUNT(*) as value FROM atencion_social WHERE COMUNA IS NOT NULL AND COMUNA != '' GROUP BY COMUNA ORDER BY value DESC LIMIT 10",
      'anio' => "SELECT anio as label, COUNT(*) as value FROM atencion_social WHERE anio IS NOT NULL AND anio != '' GROUP BY anio ORDER BY anio ASC"
    ];

    foreach($queries as $key => $query) {
        $res = $conexion->query($query);
        if($res) {
            while($row = $res->fetch_assoc()) {

              $porcentaje = $row['value'] * 100 / $dashboardData['total'];

              $value = str_replace("AUTONOMO", "", $row['label']);

              if ($value != '#N/A') {
                if ($key == 'categoria' && $porcentaje < 1) {
                  $encontrado = false;
                  foreach ($dashboardData[$key] as &$item) {
                    if ($item['label'] == 'Otro') {
                      $item['value'] += (int)$row['value'];
                      $encontrado = true;
                      break;
                    }
                  }
                  if (!$encontrado) {
                    $dashboardData[$key][] = [
                      'label' => 'Otro',
                      'value' => (int)$row['value']
                    ];
                  }
                } else {
                  $dashboardData[$key][] = [
                      'label' => $value,
                      'value' => (int)$row['value']
                  ];
                }
              }
            }
        }
    }

    echo 'var dashData = ' . json_encode($dashboardData) . ';' . PHP_EOL;

    echo '

 
  
  </script>';
    ?>



    <!-- AMCHART -->
    <link rel="stylesheet" href="../assets/amcharts5/uso/pie-chart/index.css" />
    <script>
      function activar() {
        $('.fondo-loader').hide();
      }
      $(window).on("load", activar);
    </script>
  </head>



  <div class="fondo-loader">
    <div class='container'>
      <svg viewBox="0 0 396.45 396.45" stroke-width='10' fill="none" xmlns="http://www.w3.org/2000/svg" class="loadersVG">
        <g class="dash">
          <path style="--sped: 4s;" pathLength="360" d="M181.66,317.82s-48.11-90.72-59.23-114.38c-3.34-7.1-8-17.23-9.07-31.28-3.19-41.66,28.51-72.6,32-76,31.22-29.57,69.74-28.56,75.07-28.34,44.07,1.87,70,31.64,74,36.51,5.12,5.75,26.58,31.08,24,66.64a85.26,85.26,0,0,1-10.73,35.35L251.11,316.8c18.94,3.27,67.17,12.12,67.17,12.12a12.13,12.13,0,0,1,8.57,4.36,11.74,11.74,0,0,1,.88,13,12,12,0,0,1-6.12,5.07,379.7,379.7,0,0,0-52.12-11c-11.62-1.61-22.63-2.59-32.9-3.11a15.44,15.44,0,0,1-5.05-2.19,9.42,9.42,0,0,1-2.65-2.23c-3.33-4.45-3.12-11.26.35-17.42l61.3-121.42c10.48-20.75,7.71-33.44,1.93-41-6.37-8.36-18.05-9.84-24.77-10.08l-52.34.77A17.51,17.51,0,0,0,197.68,160c-.39,9.59,7.77,18.07,17.94,17.88H247a13.16,13.16,0,0,1,.89,25.78L215,204c-24.36.89-44.79-18.88-44.81-42.89,0-24.21,20.71-44.1,45.25-42.95l16.28-.2c.83-.06,7.63-.6,11.49-6.45,3.56-5.4,2.45-12-.19-16.09-2.95-4.54-7.91-6.05-10.15-6.7-10-2.89-45.15-6.35-72.31,19-2.73,2.56-24.51,23.57-25.54,56.6a79.53,79.53,0,0,0,3.77,26.62c21.78,41.44,66,127.53,66,127.53.19.33,3.82,6.79.35,13a13.13,13.13,0,0,1-7.66,6,344.43,344.43,0,0,0-42,4.09c-15.35,2.44-41.23,9.19-41.23,9.19-5.06-2.23-8-7.22-7.31-12,.7-5,5-7.61,5.65-7.95,7.44-2.35,15.49-4.5,24.08-6.49A270.26,270.26,0,0,1,181.66,317.82Z" transform="translate(-200.7 -200)" class="big"></path>
        </g>
      </svg>
      <P style="margin: 165px 0 0 -41px;text-transform: uppercase;color: #bbbbbb;font-family: sans-serif;">
        Cargando...
      </P>
    </div>
  </div>


  <body class="g-sidenav-show  bg-gray-200 ">
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
      <div class="container-fluid py-4 animate__animated animate__fadeInUp">
        
        <div class="row mb-4">
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-users opacity-10" style="margin-top: 12px; font-size: 24px;"></i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Total Atenciones</p>
                  <h4 class="mb-0" id="total_atenciones">
                    <script>document.write(dashData.total);</script>
                  </h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Registro </span>Global</p>
              </div>
            </div>
          </div>
          
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-map-marker opacity-10" style="margin-top: 12px; font-size: 24px;"></i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Municipios</p>
                  <h4 class="mb-0">
                    <script>document.write(dashData.municipio.length);</script>
                  </h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Cobertura </span>Geográfica</p>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-list opacity-10" style="margin-top: 12px; font-size: 24px;"></i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Categorías</p>
                  <h4 class="mb-0">
                    <script>document.write(dashData.categoria.length);</script>
                  </h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Tipos de </span>Atención</p>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-calendar opacity-10" style="margin-top: 12px; font-size: 24px;"></i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Años de Registro</p>
                  <h4 class="mb-0">
                    <script>document.write(dashData.anio.length);</script>
                  </h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Periodos </span>Activos</p>
              </div>
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-6 col-7">
                    <h6>Distribución por Categoría</h6>
                    <p class="text-sm mb-0">
                      <i class="fa fa-bar-chart text-info" aria-hidden="true"></i>
                      <span class="font-weight-bold">Proporción general</span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div id="chartCategoria" style="height: 350px; width: 100%;"></div>
              </div>
            </div>
          </div>
          </div>

          <div class="row mb-3" >
          <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-6 col-7">
                    <h6>Top 10 Requerimientos</h6>
                    <p class="text-sm mb-0">
                      <i class="fa fa-bar-chart text-success" aria-hidden="true"></i>
                      <span class="font-weight-bold">Casos más frecuentes</span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div id="chartRequerimiento" style="height: 350px; width: 100%;"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-6 col-7">
                    <h6>Atención por Municipio</h6>
                  </div>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div id="chartMunicipio" style="height: 350px; width: 100%;"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-6 col-7">
                    <h6>Evolución Histórica (Anual)</h6>
                  </div>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div id="chartAnio" style="height: 350px; width: 100%;"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-6 col-7">
                    <h6>Top 10 Entes Responsables</h6>
                  </div>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div id="chartResponsable" style="height: 400px; width: 100%;"></div>
              </div>
            </div>
          </div>
        </div>
      




      </div>
    </main>
    <!--  -->
   



    <style>
      .closeConfig {
        float: right;
        margin: 5px;
        cursor: pointer;
      }

      .configuraciones {
        position: fixed;
        height: 100%;
        width: 300px;
        background-color: white;
        right: 0;
        box-shadow: 2px 1px 20px 5px #9b9b9b;
        z-index: 100000;
        top: 0;
        padding: 10px;
        transition: 1s;
        display: none;
      }

      .infoFiltro {
        display: flex;
        white-space: nowrap;
        background-color: white;
        padding: 5px 10px;
        position: fixed;
        z-index: 99999;
        right: 0;
        bottom: 0;
        margin: 17px 76px;
        border-radius: 10px;
        color: #2c2c2c;
        box-shadow: 0 5px 15px #9b9b9b;
      }

      .infoFiltro>i {
        margin: 5px 10px;
        cursor: pointer;
      }

      .btnConfig {
        background-color: white;
        width: 50px;
        height: 50px;
        position: fixed;
        z-index: 99999;
        right: 0;
        bottom: 0;
        margin: 10px 6px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        font-size: 26px;
        color: #2c2c2c;
        box-shadow: 0 5px 15px #9b9b9b;
        cursor: pointer;
      }

      .gearConfig {
        transition: 1s;
      }

      .btnConfig:hover>.gearConfig {
        transform: rotate(150deg);
      }
    </style>



    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../assets/vendor/strength/strength.css" />
    <script src="../assets/vendor/strength/strength.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/amcharts5/index.js"></script>
    <script src="../assets/amcharts5/percent.js"></script>
    <script src="../assets/amcharts5/xy.js"></script>
    <script src="../assets/amcharts5/themes/Animated.js"></script>
    <script src="../assets/amcharts5/themes/Material.js"></script>
    <script src="mapa/js/leaflet.js"></script>

    <script>
    am5.ready(function() {
      function createPieChart(divId, data, categoryField, valueField) {
        var root = am5.Root.new(divId);
        root.setThemes([am5themes_Animated.new(root), am5themes_Material.new(root)]);
        var chart = root.container.children.push(am5percent.PieChart.new(root, {
          layout: root.verticalLayout,
          innerRadius: am5.percent(50)
        }));
        var series = chart.series.push(am5percent.PieSeries.new(root, {
          valueField: valueField,
          categoryField: categoryField,
          alignLabels: false
        }));
        series.labels.template.setAll({
          textType: "circular",
          centerX: 0,
          centerY: 0
        });
        series.data.setAll(data);
        var legend = chart.children.push(am5.Legend.new(root, {
          centerX: am5.percent(50),
          x: am5.percent(50),
          marginTop: 15,
          marginBottom: 15
        }));
        legend.data.setAll(series.dataItems);
        series.appear(1000, 100);
        return root;
      }

      function createBarChart(divId, data, categoryField, valueField, horizontal=false) {
        var root = am5.Root.new(divId);
        root.setThemes([am5themes_Animated.new(root), am5themes_Material.new(root)]);
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
          panX: true,
          panY: true,
          wheelX: "panX",
          wheelY: "zoomX",
          pinchZoomX: true
        }));
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineY.set("visible", false);
        
        var xRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });
        xRenderer.labels.template.setAll({
          rotation: -45,
          centerY: am5.p50,
          centerX: am5.p100,
          paddingRight: 15
        });
        
        var xAxis, yAxis;
        if(horizontal) {
            yAxis = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
              maxDeviation: 0.3,
              categoryField: categoryField,
              renderer: am5xy.AxisRendererY.new(root, {inversed: true}),
              tooltip: am5.Tooltip.new(root, {})
            }));
            xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
              maxDeviation: 0.3,
              renderer: am5xy.AxisRendererX.new(root, {})
            }));
        } else {
            xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
              maxDeviation: 0.3,
              categoryField: categoryField,
              renderer: xRenderer,
              tooltip: am5.Tooltip.new(root, {})
            }));
            yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
              maxDeviation: 0.3,
              renderer: am5xy.AxisRendererY.new(root, {})
            }));
        }

        var tooltipText = horizontal ? "{valueX}" : "{valueY}";
        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
          name: "Casos",
          xAxis: xAxis,
          yAxis: yAxis,
          valueYField: horizontal ? undefined : valueField,
          categoryXField: horizontal ? undefined : categoryField,
          valueXField: horizontal ? valueField : undefined,
          categoryYField: horizontal ? categoryField : undefined,
          tooltip: am5.Tooltip.new(root, {
            labelText: tooltipText
          })
        }));
        
        series.columns.template.setAll({
          cornerRadiusTL: 5,
          cornerRadiusTR: 5,
          strokeOpacity: 0
        });
        
        series.columns.template.adapters.add("fill", function(fill, target) {
          return chart.get("colors").getIndex(series.columns.indexOf(target));
        });
        series.columns.template.adapters.add("stroke", function(stroke, target) {
          return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        if(horizontal) {
            yAxis.data.setAll(data);
        } else {
            xAxis.data.setAll(data);
        }
        series.data.setAll(data);
        series.appear(1000);
        chart.appear(1000, 100);
        return root;
      }
      
      function createLineChart(divId, data, categoryField, valueField) {
        var root = am5.Root.new(divId);
        root.setThemes([am5themes_Animated.new(root), am5themes_Material.new(root)]);
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
          panX: true,
          panY: true,
          wheelX: "panX",
          wheelY: "zoomX",
          pinchZoomX:true
        }));
        chart.set("cursor", am5xy.XYCursor.new(root, {
          behavior: "none"
        }));
        
        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
          categoryField: categoryField,
          startLocation: 0.5,
          endLocation: 0.5,
          renderer: am5xy.AxisRendererX.new(root, {}),
          tooltip: am5.Tooltip.new(root, {})
        }));
        xAxis.data.setAll(data);
        
        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
          renderer: am5xy.AxisRendererY.new(root, {})
        }));
        
        var series = chart.series.push(am5xy.SmoothedXLineSeries.new(root, {
          name: "Casos Anuales",
          xAxis: xAxis,
          yAxis: yAxis,
          valueYField: valueField,
          categoryXField: categoryField,
          tooltip: am5.Tooltip.new(root, {
            labelText: "{valueY}"
          })
        }));
        series.fills.template.setAll({
          visible: true,
          fillOpacity: 0.2
        });
        series.bullets.push(function() {
          return am5.Bullet.new(root, {
            locationY: 0,
            sprite: am5.Circle.new(root, {
              radius: 4,
              stroke: root.interfaceColors.get("background"),
              strokeWidth: 2,
              fill: series.get("fill")
            })
          });
        });
        series.data.setAll(data);
        series.appear(1000);
        chart.appear(1000, 100);
        return root;
      }

      if (typeof dashData !== 'undefined') {
        if(dashData.categoria.length > 0) createBarChart("chartCategoria", dashData.categoria, "label", "value", false);
        if(dashData.requerimiento.length > 0) createBarChart("chartRequerimiento", dashData.requerimiento, "label", "value");
        if(dashData.municipio.length > 0) createPieChart("chartMunicipio", dashData.municipio, "label", "value");
        if(dashData.anio.length > 0) createLineChart("chartAnio", dashData.anio, "label", "value");
        if(dashData.responsable.length > 0) createBarChart("chartResponsable", dashData.responsable, "label", "value", false);
      }
    });
    </script>
  </body>

  </html>


<?php
} else {

  define('PAGINA_INICIO', '../index.php');
  header('Location: ' . PAGINA_INICIO);
}
?>