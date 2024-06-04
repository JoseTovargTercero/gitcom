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

if($_SESSION['nivel'] == ''){
  define('PAGINA_INICIO', '../login/salir.php');
  header('Location: ' . PAGINA_INICIO);
}


if ($_SESSION['nivel'] != '') {


  $habitantes = contar('inf_habitantes', '0', 'extra');
  $viviendasHabitadas = contar2('inf_casas', 'extra!=""');
  $viviendas = contar2('inf_casas', "extra!=''");




?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title class="index" id="title">Incio</title>
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="mapa/css/leaflet.css">
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../assets/css/animate.min.css" />


    <?php

    echo '<script>' . PHP_EOL;

    function addInfoInstancias($tabla, $array, $campo1, $campo2, $campo3)    {
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
        <div class="row">
          <div class="col-xl-3 col-sm-6">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-star opacity-10"></i>

                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Comunidades</p>
                  <h4 class="mb-0" id="c_comunidades">
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
                  <h4 class="mb-0" id="c_habitantes"></h4>
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
                  <h4 class="mb-0" id="c_familias"></h4>
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
                  <h4 class="mb-0" id=""><?php echo number_format(contar('inf_casas', '0', 'extra'), '0', '.', '.') ?></h4>

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
          <div class="col-lg-12 " id="col-iz-b">
            <div class="card" style=" overflow: auto;">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-6 col-7">
                    <h6>
                      <span id="tituloBarras" style="float: left;">
                        Cargando...
                      </span>

                      <select id="sBarras" class="form-control" onchange="setBarras(this.value)" style="position: absolute;right: 0;width: 104px;margin-right: 31px;">


                        <script>
                          var categoriasBarrasR = categoriasBarras.filter((item, index) => {
                            return categoriasBarras.indexOf(item) === index;
                          })



                          categoriasBarrasR.forEach(element => {
                            document.write('<option value="' + element + '">' + element + '</option>')
                          });
                        </script>
                      </select>

                    </h6>
                  </div>
                </div>
              </div>
              <div class="card-body" style="min-height: 80vh;">

                <div class="cardLoaerd " id="loader-barras">
                  <div class="card__skeleton card__title"></div>
                  <div class="card__skeleton card__description"></div>
                  <div style="margin-top: 15px; display: flex;">
                    <div class="card__skeleton card__description" style="width: 49%; margin-right: 2%;"></div>
                    <div class="card__skeleton card__description" style="width: 49%;"></div>
                  </div>
                  <div class="card__skeleton card__title" style="margin-top: 15px;"></div>
                </div>
                <div class="grafico" id="chartdiv"></div>
              </div>
            </div>
          </div>

          <div class="col-lg-3  hide" id="col-de-b">
            <div class="card" style="height: 80vh; overflow: auto;">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-6 col-7">
                    <h6>Tratamiento</h6>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="grafico" id="chartdiv2"></div>

                <div class="leyendaTratamiento">
                  <div style="background-color: #67b7dc"></div> Red privada |
                  <div style="background-color: #6794dc"></div> Red pública |
                  <div style="background-color: #6771dc"></div> Cuenta propia |
                  <div style="background-color: #8067dc"></div> No recibe
                </div>

              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <?php if ($_SESSION["nivel"] == 4) { ?>
              <?php
              $query2 = "SELECT * FROM local_comunidades WHERE id_consejo='$_SESSION[dato2]' LIMIT 1";
              $search2 = $conexion->query($query2);
              if ($search2->num_rows > 0) {
                while ($row2 = $search2->fetch_assoc()) {
                  $correccion_poligonos = $row2['correccion_poligonos'];
                }
              }
              if ($correccion_poligonos == 0) {

              ?>
                <div class="blog-box" style="width: 100%;">
                  <div class="blog-img">
                    <img class="img-fluid" src="../assets/img/base-maps/1.PNG" alt="">
                  </div>
                  <div class="blog-content">
                    <div class="title-blog">
                      <h3>Corrección de polígonos</h3>
                      <small>Comunidad GITCOM</small>
                      <a href="#" class="viewMapBtn"><i class="fa fa-star"></i></a>
                      <p>
                        Consulta y corrige los polígonos que limitan la comunidad <strong><?php echo $_SESSION["entidad"] ?></strong>. <br>
                        <small><strong>*</strong> Tus cambios se validaran con las comunidades cercanas.</small>
                      </p>
                    </div>
                    <div class="fc">
                      <a href="mapa/mapa-correccion-p" class="viewMapBtn">Comenzar...</a>
                    </div>
                  </div>
                </div>




            <?php }
            } ?>

          </div>

        </div>


        <div class="row mt-4">
          <div class="col-lg-3">
            <div class="card" style="height: 80vh; overflow: auto;">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-12">



                    <h6>Controlador base</h6>





                  </div>
                </div>
              </div>
              <div class="card-body">

                <ul style="padding: 0; list-style: none;">
                  <script>
                    var tituloSection = '';

                    datosPerspectiva.forEach(function callback(value, index) {
                      if (tituloSection != value['titulo']) {
                        document.write('<li><strong> <i class="fa fa-star"></i> ' + value['titulo'] + '</strong></li>')
                        tituloSection = value['titulo'];
                      }
                      document.write('<li class="perspItem" id="p_' + index + '"><a onclick="setBase100(\'' + index + '\')">' + value['nombre'] + '</a></li>')
                    });
                  </script>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="card" style="height: 80vh; overflow: auto;">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-12 headHerramientas">
                    <h6 id="tituloPerspectiva">Cargando...</h6>
                    <form id="testForm" class="herramientasRight">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" onchange="setBase100('last')" type="radio" name="base" id="base10" value="10">
                        <label class="form-check-label" for="base10">10</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" onchange="setBase100('last')" checked type="radio" name="base" id="base100" value="100">
                        <label class="form-check-label" for="base100">100</label>
                      </div>
                    </form>
                  </div>
                </div>
              </div>




              <div class="card-body" style="display: flex;">







                <div class="cardLoaerd" id="loader-perspectiva">
                  <div class="card__skeleton card__title"></div>
                  <div class="card__skeleton card__description"></div>
                  <div style="margin-top: 15px; display: flex;">
                    <div class="card__skeleton card__description" style="width: 49%; margin-right: 2%;"></div>
                    <div class="card__skeleton card__description" style="width: 49%;"></div>

                  </div>
                  <div class="card__skeleton card__title" style="margin-top: 15px;"></div>

                </div>






                <div class="lgP animate__animated animate__fadeIn">
                  <h3>
                    <span id="nombrePers" style="color: #F44335;"></span><br>
                    <span id="cantidadPers" style="color: #F44335;"></span> /<span id="baseText">100</span>
                  </h3>
                </div>

                <div class="grafico" id="gp" style="width: 100%;"></div>
              </div>
            </div>
          </div>
        </div>




        <div class="row mt-4">
          <div class="col-lg-9">
            <div class="card" style="height: 80vh; overflow: auto;">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-6 col-7">
                    <h6 id="tituloMapa">Cargando...</h6>
                  </div>
                </div>
              </div>
              <div class="card-body" style="display: flex;">








                <div class="cardLoaerd" id="loaderMapa">
                  <div class="card__skeleton card__title"></div>
                  <div class="card__skeleton card__description"></div>
                  <div style="margin-top: 15px; display: flex;">
                    <div class="card__skeleton card__description" style="width: 49%; margin-right: 2%;"></div>
                    <div class="card__skeleton card__description" style="width: 49%;"></div>

                  </div>
                  <div class="card__skeleton card__title" style="margin-top: 15px;"></div>

                </div>





                <ul id="mapaCoropletico" class="leyendaMapaCoropletico">
                  <li>
                    <div style="background-color: #ccccccf7"></div> Ningún resultado
                  </li>
                  <li>
                    <div style="background-color: #ffa2a2;"></div> &nbsp;&nbsp;&nbsp;1&nbsp; - 10 &nbsp;&nbsp;resultados
                  </li>
                  <li>
                    <div style="background-color: #ff7878;"></div> &nbsp;&nbsp;11 - 20&nbsp;&nbsp; resultados
                  </li>
                  <li>
                    <div style="background-color: #ff4848;"></div> &nbsp;&nbsp;21 - 30&nbsp;&nbsp; resultados
                  </li>
                  <li>
                    <div style="background-color: #ff2525;"></div> &nbsp;&nbsp;31 - 50&nbsp;&nbsp; resultados
                  </li>
                  <li>
                    <div style="background-color: #ff0c0c;"></div> &nbsp;&nbsp;51 - 80&nbsp;&nbsp; resultados
                  </li>
                  <li>
                    <div style="background-color: #ca0000;"></div> &nbsp;&nbsp;81 - 120 resultados
                  </li>
                  <li>
                    <div style="background-color: #a20000;"></div> 121 - 150 resultados
                  </li>
                  <li>
                    <div style="background-color: #7c0000;"></div> 151 - 220 resultados
                  </li>
                  <li>
                    <div style="background-color: #590000;"></div> 221 - 300 resultados
                  </li>
                  <li>
                    <div style="background-color: #3c0000;"></div> Mas de 300 resultados
                  </li>
                </ul>


                <div class="animate__animated animate__fadeIn" id="map" style="margin-left: -80px; z-index: 1;"></div>



              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="card" style="height: 80vh; overflow: auto;">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-12">
                    <h6>Controlador Mapa</h6>
                  </div>
                </div>
              </div>
              <div class="card-body">

                <ul style="padding: 0; list-style: none;">

                  <?php
                  $titulo = '';
                  foreach ($arrayConsultas as $i => $item) {

                    if ($titulo != $item[2]) {
                      $titulo = $item[2];
                      echo '<li><strong> <i class="fa fa-star"></i> ' . $titulo . '</strong></li>';
                    }
                    echo '<li class="perspItemM" id="m_' . $i . '"><a onclick="setMap(\'' . $i . '\')">' . $item[3] . '</a></li>';
                  }
                  ?>

                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-lg-12">
            <div class="card" style="height: 80vh; overflow: auto;">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-6 col-7">
                    <h6>

                      <span id="tituloComparativo" style="float: left;">
                        Cargando...
                      </span>

                      <div style="position: absolute;right: 0;margin-right: 31px; display: flex;">



                        <div class="form-check form-switch" style="    padding: 7px 25px;">
                          <input class="form-check-input" type="checkbox" id="agruparCheck" checked onchange="setComparativo($('#sComparativo').val())">
                          <label class="form-check-label" for="agruparCheck">Modo agrupar</label>
                        </div>







                        <select id="sComparativo" class="form-control" onchange="setComparativo(this.value)" style="width: 204px; height: 39px;padding: 0px;">
                          <script>
                            categoriasBarrasR.forEach(element => {
                              document.write('<option value="' + element + '">' + element + '</option>')
                            });
                          </script>
                        </select>

                      </div>
                    </h6>
                  </div>
                </div>
              </div>
              <div class="card-body" style="display: flex;">
                <div class="cardLoaerd " id="loader-comparativo">
                  <div class="card__skeleton card__title"></div>
                  <div class="card__skeleton card__description"></div>
                  <div style="margin-top: 15px; display: flex;">
                    <div class="card__skeleton card__description" style="width: 49%; margin-right: 2%;"></div>
                    <div class="card__skeleton card__description" style="width: 49%;"></div>
                  </div>
                  <div class="card__skeleton card__title" style="margin-top: 15px;"></div>
                </div>

                <div class="grafico" id="chartdiv5"></div>
              </div>
            </div>
          </div>
        </div>
        <?php include('notificacion.php'); ?>
      </div>
    </main>
    <!--  -->
    <div class="configuraciones animate__animated">
      <h6>Configuración del inicio <i class="fa fa-close closeConfig" onclick="setViewConfig('hide')"></i></h6>


      <hr>



      <h6>Modificar instancia</h6>
      <div>
        <div class="mb-2">
          <label for="mcp" class="label-control">Municipio</label>
          <select id="mcp" class="form-control" onchange="setSelect('mcp', this.value)">
            <option value="">Seleccione</option>
            <script>
              municipio.forEach(element => {
                document.write('<option value="' + element[1] + '">' + element[2] + '</option>')
              });
            </script>
          </select>
        </div>
        <div class="mb-2">
          <label for="pq" class="label-control">Parroquia</label>
          <select id="pq" class="form-control" onchange="setSelect('pq', this.value)">
            <option value="">Seleccione</option>
          </select>
        </div>
        <div class="mb-2">
          <label for="com" class="label-control">Comuna</label>
          <select id="com" class="form-control" onchange="setSelect('com', this.value)">
            <option value="">Seleccione</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="comdad" class="label-control">Comunidad</label>
          <select id="comdad" class="form-control" onchange="setSelect('comdad', this.value)">
            <option value="">Seleccione</option>
          </select>
        </div>
        <div class="mb-2" style="text-align: right;">
          <button class="btn btn-primary" onclick="setInstancia()">Filtrar</button>

        </div>
      </div>

      <hr>
      <div style="width: 100%; display:flex">
        <a class="btn btn-primary" href="psuv-l.php" style="margin: auto">Caracterización PSUV</a>
      </div>

      <script>
        var nameInstance = '';
        var filterValue = '';

        function separadorMiles(numero) {
          let num = parseInt(numero)
          return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function manejadorCantidades() {

          $.ajax({
              url: 'consultasAjax/index_manejadorCantidades.php',
              type: 'POST',
              dataType: 'html',
              data: {
                nameInstance: nameInstance,
                filterValue: filterValue
              },
            })
            .done(function(rsult) {
              let arrayResult = rsult.split('*')
              $('#c_comunidades').html(separadorMiles(arrayResult[0]))
              $('#c_habitantes').html(separadorMiles(arrayResult[1]))
              $('#c_familias').html(separadorMiles(arrayResult[2]))
             // $('#c_viviendas').html(separadorMiles(arrayResult[3]))

            })
        }

        manejadorCantidades()

        function setInstancia() {

          //filterValue
          if ($('#mcp').val() == '') {
            toast('info', 'No se ha seleccionado ninguna instancia')
          } else {
            filterValue = $('#' + nameInstance).val()

            $('.infoFiltro').removeClass('hide')
            $('#textFilter').html(all[$('#' + nameInstance).val()])

            setComparativo('last')
            setBarras('last')
            setBase100('last')
            setMap('last')
            manejadorCantidades()
          }
          setViewConfig('hide')

        }



        function setSelect(select, value) {

          nameInstance = select;

          if (select == 'mcp') {
            $('#pq').html('<option value="">Seleccione</option>')
            $('#com').html('<option value="">Seleccione</option>')
            $('#comdad').html('<option value="">Seleccione</option>')
            parroquias.forEach(element => {
              if (element[0] == value) {
                $('#pq').append('<option value="' + element[1] + '">' + element[2] + '</option>')
              }
            });
          }

          if (select == 'pq') {
            $('#com').html('<option value="">Seleccione</option>')
            $('#comdad').html('<option value="">Seleccione</option>')
            comunas.forEach(element => {
              if (element[0] == value) {
                $('#com').append('<option value="' + element[1] + '">' + element[2] + '</option>')
              }
            });
          }

          if (select == 'com') {
            $('#comdad').html('<option value="">Seleccione</option>')
            comunidades.forEach(element => {
              if (element[0] == value) {
                $('#comdad').append('<option value="' + element[1] + '">' + element[2] + '</option>')
              }
            });
          }


        }

        function setViewConfig(params) {
          if (params == 'show') {
            $('.configuraciones').removeClass('animate__fadeOutRight')
            $('.configuraciones').addClass('animate__fadeInRight')
            $('.configuraciones').show()
          } else {
            $('.configuraciones').removeClass('animate__fadeInRight')
            $('.configuraciones').addClass('animate__fadeOutRight')
          }
        }
      </script>

      <hr>


      <h6>Modificar gráfico principal</h6>
      <div>

        <div class="form-check">
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
          <label class="form-check-label" for="flexRadioDefault1">
            Barras verticales
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" disabled>
          <label class="form-check-label" for="flexRadioDefault2">
            Barras horizontales
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" disabled>
          <label class="form-check-label" for="flexRadioDefault2">
            Radar
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" disabled>
          <label class="form-check-label" for="flexRadioDefault2">
            Piramide invertida
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" disabled>
          <label class="form-check-label" for="flexRadioDefault2">
            Torta
          </label>
        </div>

      </div>

      <hr>



    </div>







    <div class="infoFiltro hide">
      <span id="textFilter"></span>
      <i class="fa fa-close" onclick="removeFilter()"></i>
    </div>



    <div class="btnConfig" onclick="setViewConfig('show')">
      <i class="fa fa-gear gearConfig"></i>
    </div>






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
    <script src="../assets/js/material-dashboard.min.js?v=3.0.2"></script>
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
      // Create root element
      var root = am5.Root.new("chartdiv5");


      // Set themes
      root.setThemes([am5themes_Animated.new(root)]);


      // Create chart
      var chart = root.container.children.push(am5percent.SlicedChart.new(root, {
        layout: root.verticalLayout
      }));


      // Create series
      var series2 = chart.series.push(am5percent.PictorialStackedSeries.new(root, {
        alignLabels: true,
        orientation: "vertical",
        valueField: "value",
        categoryField: "category",
        svgPath: "M175,157.53l31.53-1,17.36.51,12.89,3.7,10.86,2.17,5-1.15,13.79-12.25,8.17-9.58,3.58-5.36,5.74-4.34,12.77-6.89L307.47,118l8.68-1.15h7.79l5.36,1.66,1.91,1.66.77,2.81-.89,4.08-.52,2.68-.63,3.19s-.64,2.81-.64,3.32-.13,1.53-.13,2-.26,2.8-.26,2.8v11a16.2,16.2,0,0,0,.26,2.17l1,2.56a10,10,0,0,1,.51,1.53A8.67,8.67,0,0,0,331,160a10.55,10.55,0,0,0,1,1.91s-.77.51,0,1.41a6.3,6.3,0,0,1,1.15,1.66,8.47,8.47,0,0,0,1.66,2.42,21.17,21.17,0,0,0,3.83,1.41l3.44-.9,4.09-3.44,3.06-3.2,26.68.9,1.79,1.53v1.91l-1.79,5.37a17.39,17.39,0,0,0-1.15,3.19c0,.64,1.15,5.49,1.15,5.49l6.77,11,5,4.85V198l-4.34,7.66-2.3,1.79-6.89,1.15s-3.71.25-4.09,1a16.69,16.69,0,0,0-1.4,3.7,66.1,66.1,0,0,0,1.78,7.15c.26.51,3.32,7.15,3.32,7.15l2.81,14.29,11.11,26.3,10.59,18.64,8.43,7.66,8.94,2,7.14,1.28,3.83,1.79,2.81,10.72L431.43,329v7.4H421L417.38,340h-5.1L399,332.3l-.51,5.36,2,7.15,6.38,5.87,28.6,35.49,8.43,4.6,27.06,24v9.44l-5.87,4.27-1.53,5.43,3.83,34L481.72,487l2.3,6.89,3.32,7.92s3.83,5.11,4.09,6.13,1.27,14,1.27,14l-3.32,8.43-2.29,8.42,3.57,4.85L509,549.32l8.94,1.79,5.36,1,18.89-2.3,10-2,9.19-.26v2.3a33.1,33.1,0,0,1,0,5.11c-.25.76,1,7.66,1.53,8.93s1.79,7.92,1.79,7.92l-1.27,5.61L560.87,581s-5.87,1.79-6.89,2-14.81,2.3-14.81,2.3-5.62,2.3-6.64,2.81-9.7,7.15-9.7,7.15l-5.62,3.57h-24s-6.38,8.43-6.38,9.7-1.28,14.3-1.28,14.3L484,632l-5.11,10-12.76,13.28s-4.34,1.78-6.89,3.06-5.88,8.94-6.13,9.7-4.6,2.56-4.6,2.56-2.55-2.05-2.55-3.83,2-7.41,2.55-8.94,2-5.36,1.28-5.36-4.34,2.55-4.34,2.55-5.87,3.83-8.17,4.85-14.81,12.77-14.81,12.77l-10.21,9.19-6.64,4.6-10-6.64-15.83,11-6.64,11.49-7.91-3.58-6.9,3.58-1.78,20.42h-18.9l-7.15,12.77s-2.55,11.23-2.8,12-15.07,7.4-15.07,7.4l-4.34-6.64L315.51,737l5.62-9.45-3.58-12.25s-7.66-5.37-13-5.37-12.76-3.31-18.38,5.62-20.94,11-13.79,12.77-5.1,1.79-5.1,1.79l-2.56,4.08a17.12,17.12,0,0,1-3.57,2.81c-1.28.51-9.45,1.28-9.45,1.28l-2.3,2.29L245,743.36s-3.32,3.58-4.59,1.28-2.3-4.09-2.3-4.09l-10-.51-7.66,2.3-65.36-59v-12l-14-49.53-6.9-16.09-5.36-2.29V588.89L122,581.23v-23L85.21,520.72l-9.95-1.53V506.94l-26.05-8.43-6.89,10v-6.9l11-13.78L75,470.17,95.17,452l7.4-8.42,4.86-10.22-2.81-4.92-8.17-7.54L88,400.72l-4.85-5.61-8.17-1-3.06-2.3-3.83-10.47-6.64-18.38-4.6-12.26-6.13-9.45a23.41,23.41,0,0,1-1.53-4.08c0-.77,1-21.19,1-21.19l-7.91-14,4.59-25.27,2.56-30.38v-11l-5.11-23L51,203.62,59.68,198l7.66-7.4L69.13,174v-8.17s4.34-11.23,4.85-12,6.64-8.68,6.64-8.68,7.4-6.89,8.17-8.43l2.81-5.61s2-1.79-.26-4.6a66.06,66.06,0,0,1-5.87-8.42c-.26-.77.76-5.62.76-5.62l3.32-1.79L100,114.51s7.66,2.55,10.47,3.06S122,118.85,122,118.85l3.83,2.55s2.55,5.88,2.55,6.9.51,8.17.51,8.93.51,11.24.51,11.24L127.85,160v2.55l10.72.51,7.41-.76,1.28,5.61,1.27,2.81,5.87,2.3,4.09-1.79s10-9.19,11-11S175,157.53,175,157.53Z"
      }));


      series2.labelsContainer.set("width", 100);
      series2.ticks.template.set("location", 0.6);




      // Add legend
      chart.set("layout", root.horizontalLayout);

      var legend = chart.children.moveValue(am5.Legend.new(root, {
        y: am5.percent(50),
        layout: root.verticalLayout,
        centerY: am5.percent(50)
      }), 0);

      legend.markers.template.setAll({
        width: 15,
        height: 15
      });
      legend.markerRectangles.template.setAll({
        cornerRadiusBL: 20,
        cornerRadiusBR: 20,
        cornerRadiusTL: 20,
        cornerRadiusTR: 20
      });


      // Play  initial se ries animation
      chart.appear(1000, 100);




      var filtroComparativo = '';

      function setComparativo(value) {

        if (value != 'last') {
          filtroComparativo = value;
        }

        $('#loader-comparativo').show()
        $('#chartdiv5').hide()
        $('#tituloComparativo').html('Cargando...')

        $.ajax({

            url: 'consultasAjax/index_barras.php',
            type: 'POST',
            dataType: 'html',
            data: {
              t: filtroComparativo,
              nameInstance: nameInstance,
              filterValue: filterValue
            },
          })
          .done(function(rsult) {
            // se value

            $("#sComparativo option[value='" + filtroComparativo + "']").attr("selected", true);

            $('#tituloComparativo').html(filtroComparativo)
            $('#loader-comparativo').hide()
            $('#chartdiv5').show()

            let presultado = rsult.split('+')
            let total = presultado[1];
            let resultado = presultado[0].split('*')

            var data = []
            var otrosC = 0;
            xAxis.data.setAll([]);
            series2.data.setAll([]);
            legend.data.setAll([]);
            resultado.forEach(element => {
              let val = element.split('/')
              let cantidad = parseInt(val[1])


              if (document.getElementById("agruparCheck").checked) {

                if ((cantidad * 100 / total) < 1) {
                  otrosC += cantidad;
                } else {
                  data.push({
                    category: val[0] + ' ('+cantidad+'/'+total+')',
                    value: cantidad
                  })
                }

              } else {
                data.push({
                  category: val[0] + ' ('+cantidad+'/'+total+')',
                  value: cantidad
                })
              }


            });



            if (otrosC > 1) {
              data.push({
                category: 'Otros' + ' ('+cantidad+'/'+total+')',
                value: otrosC
              })
            }



            data.sort((a, b) => {
              return b['value'] - a['value']
            })





            xAxis.data.setAll(data);
            series2.data.setAll(data);
            legend.data.setAll(series2.dataItems);




          })
      }


      /*-------------------------- Graficos ------------------- */

      var root44 = am5.Root.new('chartdiv');

      root44.setThemes([am5themes_Animated.new(root44)]);

      var chart = root44.container.children.push(am5xy.XYChart.new(root44, {
        panX: true,
        panY: true,
        wheelX: "panX",
        wheelY: "zoomX",
        pinchZoomX: true
      }));

      // Add cursor
      var cursor = chart.set("cursor", am5xy.XYCursor.new(root44, {}));
      cursor.lineY.set("visible", false);

      // Create axes
      var xRenderer = am5xy.AxisRendererX.new(root44, {
        minGridDistance: 30
      });
      xRenderer.labels.template.setAll({
        rotation: -90,
        centerY: am5.p50,
        centerX: am5.p100,
        paddingRight: 15
      });

      xRenderer.grid.template.setAll({
        location: 1
      })

      var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root44, {
        maxDeviation: 0.3,
        categoryField: "country",
        renderer: xRenderer,
        tooltip: am5.Tooltip.new(root44, {})
      }));

      var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root44, {
        maxDeviation: 0.3,
        renderer: am5xy.AxisRendererY.new(root44, {
          strokeOpacity: 0.1
        })
      }));

      // Create series
      var series = chart.series.push(am5xy.ColumnSeries.new(root44, {
        name: "Series 1",
        xAxis: xAxis,
        yAxis: yAxis,
        valueYField: "value",
        sequencedInterpolation: true,
        categoryXField: "country",
        tooltip: am5.Tooltip.new(root44, {
          labelText: "{valueY}"
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

      series.appear(1000);
      chart.appear(1000, 100);


      function removeFilter() {
        $('#mcp').val('')
        $('#pq').val('')
        $('#com').val('')
        $('#comdad').val('')
        $('#pq').html('<option value="">Seleccione</option>')
        $('#com').html('<option value="">Seleccione</option>')
        $('#comdad').html('<option value="">Seleccione</option>')


        $('.infoFiltro').addClass('hide')
        nameInstance = ''
        filterValue = ''

        setComparativo('last')
        setBarras('last')
        setBase100('last')
        setMap('last')
        manejadorCantidades()


      }


      var filtroBarras = '';

      function setBarras(value) {

        if (value != 'last') {
          filtroBarras = value;
        }

        $('#loader-barras').show()
        $('#chartdiv').hide()
        $('#tituloBarras').html('Cargando...')

        $.ajax({

            url: 'consultasAjax/index_barras.php',
            type: 'POST',
            dataType: 'html',
            data: {
              t: filtroBarras,
              nameInstance: nameInstance,
              filterValue: filterValue
            },
          })
          .done(function(rsult) {
            // se value

            if (filtroBarras == '(Enfermedades más frecuentes)') {

              $('#col-iz-b').removeClass('col-lg-12')
              $('#col-iz-b').addClass('col-lg-9')
              $('#col-de-b').removeClass('hide')
            } else {
              $('#col-iz-b').removeClass('col-lg-9')
              $('#col-iz-b').addClass('col-lg-12')
              $('#col-de-b').addClass('hide')
            }

            $("#sBarras option[value='" + filtroBarras + "']").attr("selected", true);


            $('#tituloBarras').html(filtroBarras)
            $('#loader-barras').hide()
            $('#chartdiv').show()
            let presultado = rsult.split('+')
            let resultado = presultado[0].split('*')
            var data = []

            resultado.forEach(element => {
              let val = element.split('/')
              let cantidad = parseInt(val[1])

              data.push({
                country: val[0],
                value: cantidad
              })

              data.sort((a, b) => {
                return b['value'] - a['value']
              })
            });

            xAxis.data.setAll([]);
            series.data.setAll([]);
            xAxis.data.setAll(data);
            series.data.setAll(data);

          })
      }





      function chart2(div) {
        am5.ready(function() {


          var root44 = am5.Root.new(div);


          // Set themes
          root44.setThemes([
            am5themes_Animated.new(root44)
          ]);


          // Create chart
          var chart = root44.container.children.push(am5xy.XYChart.new(root44, {
            panX: false,
            panY: false,
            wheelX: "panX",
            wheelY: "zoomX",
            layout: root44.verticalLayout
          }));

          // Add scrollbar
          var data = [{
            "year": "Tratamiento",
            "privada": <?php echo contar2('inf_habitantes', 'recibe_tratamiento="Por la Red Privada"') ?>,
            "publica": <?php echo contar2('inf_habitantes', 'recibe_tratamiento="Por la Red Publica"') ?>,
            "propia": <?php echo contar2('inf_habitantes', 'recibe_tratamiento="Por cuenta propia"') ?>,
            "nr": <?php echo contar2('inf_habitantes', 'recibe_tratamiento="No Recibe Tratamiento"') ?>
          }]


          // Create axes
          // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
          var xRenderer = am5xy.AxisRendererX.new(root44, {});
          var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root44, {
            categoryField: "year",
            renderer: xRenderer,
            tooltip: am5.Tooltip.new(root44, {})
          }));


          xAxis.data.setAll(data);

          var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root44, {
            min: 0,
            max: 100,
            numberFormat: "#'%'",
            strictMinMax: true,
            calculateTotals: true,
            renderer: am5xy.AxisRendererY.new(root44, {
              strokeOpacity: 0.1
            })
          }));


          // Add legend
          // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
          var legend = chart.children.push(am5.Legend.new(root44, {
            centerX: am5.p50,
            x: am5.p50
          }));


          // Add series
          // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
          function makeSeries(name, fieldName) {
            var series = chart.series.push(am5xy.ColumnSeries.new(root44, {
              name: name,
              stacked: true,
              xAxis: xAxis,
              yAxis: yAxis,
              valueYField: fieldName,
              valueYShow: "valueYTotalPercent",
              categoryXField: "year"
            }));

            series.columns.template.setAll({
              tooltipText: "{name}",
              tooltipY: am5.percent(10)
            });
            series.data.setAll(data);

            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            series.appear();

            series.bullets.push(function() {
              return am5.Bullet.new(root44, {
                sprite: am5.Label.new(root44, {
                  text: "{valueYTotalPercent.formatNumber('#.#')}%",
                  fill: root44.interfaceColors.get("alternativeText"),
                  centerY: am5.p50,
                  centerX: am5.p50,
                  populateText: true
                })
              });
            });

          }

          makeSeries("Por la red privada", "privada");
          makeSeries("Por la red publica", "publica");
          makeSeries("Por cuenta propia", "propia");
          makeSeries("No recibe tratamiento", "nr");


          // Make stuff animate on load
          chart.appear(1000, 100);

        }); // end am5.ready()
      }
      chart2('chartdiv2')


      function generateData(count) {
        var row = 1;
        var col = 1;
        var data = [];
        for (var i = 0; i < count; i++) {
          data.push({
            x: col + "",
            y: row + ""
          });
          col++;
          if (col > rowSize) {
            row++;
            col = 1;
          }
        }
        return data;
      }
      var rowSize;
      var colSize;

      function generateCategories(count) {
        var data = [];
        for (var i = 0; i < count; i++) {
          data.push({
            cat: (i + 1) + ""
          });
        }
        return data;
      }

      var graficoBase = 0;
      function setBase100(index) {
        if (index != 'last') {
          graficoBase = index;
        }
        //loader perspectiva

        $('#loader-perspectiva').show()

        var base = $('input[name=base]:checked', '#testForm').val();

        $.ajax({

            url: 'consultasAjax/index_datos_perspectiva.php',
            type: 'POST',
            dataType: 'html',
            data: {
              t: datosPerspectiva[graficoBase]['tipo'],
              c: datosPerspectiva[graficoBase]['c'],
              b: base,
              nameInstance: nameInstance,
              filterValue: filterValue
            },
          })
          .done(function(rsult) {

            let resultado = parseInt(rsult)

            if (resultado >= 1) {



              if (base == '10') {
                rowSize = 5;
                colSize = 2;
              } else {
                rowSize = 20;
                colSize = 5;
              }

              $('#baseText').html(base)


              document.getElementById("gp").innerHTML = "";
              document.getElementById("gp").innerHTML = "<div id=\"chartdiv3\"></div>";

              var root44 = am5.Root.new('chartdiv3'); // creo el grafico

              root44.setThemes([am5themes_Animated.new(root44)]); // tema

              var chart = root44.container.children.push(am5xy.XYChart.new(root44, {
                panX: false,
                panY: false,
                wheelX: "panX",
                wheelY: "zoomX",
                layout: root44.verticalLayout
              }));

              var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root44, {
                categoryField: "cat",
                renderer: am5xy.AxisRendererX.new(root44, {})
              }));
              var xRenderer = xAxis.get("renderer");
              xRenderer.labels.template.set("forceHidden", true);
              xRenderer.grid.template.set("forceHidden", true);
              xAxis.data.setAll(generateCategories(rowSize));

              var yAxis1 = chart.yAxes.push(am5xy.CategoryAxis.new(root44, {
                categoryField: "cat",
                renderer: am5xy.AxisRendererY.new(root44, {})
              }));
              var yRenderer1 = yAxis1.get("renderer");
              yRenderer1.labels.template.set("forceHidden", true);
              yRenderer1.grid.template.set("forceHidden", true);
              yAxis1.data.setAll(generateCategories(colSize));



              var maleIcon = "";

              if (datosPerspectiva[graficoBase]['tipo'] == '2') {

                if (datosPerspectiva[graficoBase]['s'] == 'F') {
                  maleIcon = "M 18.4 15.1 L 15.5 25.5 c -0.6 2.3 2.1 3.2 2.7 1 l 2.6 -9.6 h 0.7 l -4.5 16.9 H 21.3 v 12.7 c 0 2.3 3.2 2.3 3.2 0 V 33.9 h 1 v 12.7 c 0 2.3 3.1 2.3 3.1 0 V 33.9 h 4.3 l -4.6 -16.9 h 0.8 l 2.6 9.6 c 0.7 2.2 3.3 1.3 2.7 -1 l -2.9 -10.4 c -0.4 -1.2 -1.8 -3.3 -4.2 -3.4 h -4.7 C 20.1 11.9 18.7 13.9 18.4 15.1 z M 28.6 7.2 c 0 -2.1 -1.6 -3.7 -3.7 -3.7 c -2 0 -3.7 1.7 -3.7 3.7 c 0 2.1 1.6 3.7 3.7 3.7 C 27 10.9 28.6 9.2 28.6 7.2 z";
                } else {
                  maleIcon = "M 25.1 10.7 c 2.1 0 3.7 -1.7 3.7 -3.7 c 0 -2.1 -1.7 -3.7 -3.7 -3.7 c -2.1 0 -3.7 1.7 -3.7 3.7 C 21.4 9 23 10.7 25.1 10.7 z M 28.8 11.5 H 25.1 h -3.7 c -2.8 0 -4.7 2.5 -4.7 4.8 V 27.7 c 0 2.2 3.1 2.2 3.1 0 V 17.2 h 0.6 v 28.6 c 0 3 4.2 2.9 4.3 0 V 29.3 h 0.7 h 0.1 v 16.5 c 0.2 3.1 4.3 2.8 4.3 0 V 17.2 h 0.5 v 10.5 c 0 2.2 3.2 2.2 3.2 0 V 16.3 C 33.5 14 31.6 11.5 28.8 11.5 z";
                }



              } else {
                maleIcon = "M 44.4 42 L 44.4 34.8 L 38.4 34.8 L 38.4 42 L 27.6 42 L 27.6 26.4 L 26.4 25.2 L 40.8 13.2 L 56.4 25.2 L 55.2 26.4 T 55.2 42";
              }


              $('#tituloPerspectiva').html(datosPerspectiva[graficoBase]['titulo'])
              $('#nombrePers').html(datosPerspectiva[graficoBase]['nombre'])
              $('#cantidadPers').html(resultado)
              $('.perspItem').removeClass('text-danger')
              $('#p_' + graficoBase).addClass('text-danger')
              makeSeries("Date", generateData(base), '#999999', maleIcon, false); // maleSeriesMax
              makeSeries("Date", generateData(resultado), '#F44335', maleIcon, true); // maleSeries


              function makeSeries(name, data, color, path) {
                var series = chart.series.insertIndex(0, (am5xy.ColumnSeries.new(root44, {
                  name: name,
                  xAxis: xAxis,
                  yAxis: yAxis1,
                  categoryYField: "y",
                  openCategoryYField: "y",
                  categoryXField: "x",
                  openCategoryXField: "x",
                  clustered: false
                })));

                series.columns.template.setAll({
                  width: am5.percent(100),
                  height: am5.percent(100),
                  fill: '#fff',
                  fillOpacity: 1,
                  strokeOpacity: 0
                });


                series.bullets.unshift(function(root44) {
                  return am5.Bullet.new(root44, {
                    locationX: 0.5,
                    locationY: 0.5,
                    sprite: am5.Graphics.new(root44, {
                      fill: color,
                      svgPath: path,
                      centerX: am5.p50,
                      centerY: am5.p50,
                      scale: 0.8
                    })
                  });
                });

                series.data.setAll(data);
                series.appear();
                return series;
              }
            } else {
              toast('info', 'El resultado es inferior a uno (1)')
            }
            $('#loader-perspectiva').hide()


          })





      }


      function getRandomInt(max) {
        return Math.floor(Math.random() * max);
      }

      function myFunction() {
        setTimeout(alertFunc, 3000);
      }

      setComparativo(categoriasBarrasR[getRandomInt(categoriasBarrasR.length)])
      setBarras(categoriasBarrasR[getRandomInt(categoriasBarrasR.length)])
      setBase100(graficoBase)
      setMap(0)


      /* ----------------------------- graficos ---------------------------------*/

      var valoresMapa = [];
      var filterMapa = '0';

      function setMap(value) {
        $('#tituloMapa').html('Cargando datos...')
        $('#loaderMapa').show()

        if (value != 'last') {
          filterMapa = value;
        }

        $.ajax({

            url: 'consultasAjax/index_mapa_coropletico.php',
            type: 'POST',
            dataType: 'html',
            data: {
              t: datosMapa[filterMapa]['t'],
              c: datosMapa[filterMapa]['c'],
              nameInstance: nameInstance,
              filterValue: filterValue
            },
          })
          .done(function(rsult) {

            if (rsult.trim() != '') {

              $('.perspItemM').removeClass('text-danger')
              $('#m_' + filterMapa).addClass('text-danger')

              valoresMapa = [];

              let preValue;


              if (rsult.indexOf('*') != '-1') {
                preValue = rsult.trim().split('*')

                preValue.forEach(element => {
                  let item = element.split(',')
                  valoresMapa[item[0].trim()] = item[1].trim();
                });

              } else {
                preValue = rsult.trim()
                let item1 = preValue.split(',')
                valoresMapa[item1[0].trim()] = item1[1].trim();
              }

              $('#tituloMapa').html('Dibujando mapa...')
              cargarMapa(datosMapa[filterMapa]['titulo'])
              $('#tituloMapa').html(datosMapa[filterMapa]['titulo'])
            }
          })
      }

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




      function style_comunidades_0_0(feature) {
        let color;
        let cantidad = 0;

        if (valoresMapa[feature.properties['id_comunid']]) {
          cantidad = valoresMapa[feature.properties['id_comunid']];
        }

        if (cantidad == 0) {
          color = '#ccccccf7';
        } else if (cantidad <= 10) {
          color = '#ffa2a2';
        } else if (cantidad <= 20) {
          color = '#ff7878';
        } else if (cantidad <= 30) {
          color = '#ff4848';
        } else if (cantidad <= 50) {
          color = '#ff2525';
        } else if (cantidad <= 80) {
          color = '#ff0c0c';
        } else if (cantidad <= 120) {
          color = '#ca0000';
        } else if (cantidad <= 150) {
          color = '#a20000';
        } else if (cantidad <= 220) {
          color = '#7c0000';
        } else if (cantidad <= 300) {
          color = '#590000';
        } else if (cantidad >= 301) {
          color = '#3c0000';
        }

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


      function cargarMapa(titulo) {

        let resultados = '0';



        function pop_comunidades_0(feature, layer) {


          if (valoresMapa[feature.properties['id_comunid']]) {
            resultados = valoresMapa[feature.properties['id_comunid']]
          }


          var popupContent = (feature.properties['NAME'] !== null ? feature.properties['NAME'].toLocaleString() : '') + '<br>' + (feature.properties['COMUNA'] !== null ? feature.properties['COMUNA'].toLocaleString() : '') + '<br>' + titulo + ': ' + resultados;
          layer.bindPopup(popupContent, {
            maxHeight: 400
          });
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
        layer_comunidades_0.eachLayer(function(layer) {
          var context = {
            feature: layer.feature,
            variables: {}
          };
        });

        $('#loaderMapa').hide()
      }


      //console.clear();
    </script>

    <!-- HTML -->
  </body>

  </html>


<?php
} else {

  define('PAGINA_INICIO', '../index.php');
  header('Location: ' . PAGINA_INICIO);
}
?>