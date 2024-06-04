
<?php
include('../configuracion/conexionMysqli.php');

if ($_SESSION['nivel'] == 1) {
	unset($_SESSION['proyecto']);
  function contar($tabla, $condicion){
    $condicionEnd = str_replace('"', "'", $condicion);
    $condicionExtra = "";

    if (isset($_GET['modo'])) {
      
      $value = $_GET['value'];
      
      switch ($_GET['modo']) {

        case 'mcp':
          $condicionExtra = " AND id_municipio = '".$value."'";
          break;
        case 'paq':
          $condicionExtra = " AND id_parroquia = '".$value."'";
          break;
        case 'com':
          $condicionExtra = " AND id_comuna = '".$value."'";
          break;
        case 'cod':
          $condicionExtra = " AND id_c_comunal = '".$value."'";
          break;
      }
      
      $condicionEnd = $condicionEnd.$condicionExtra;
    }

    

    global $conexion;

    
    $conteoH78 = mysqli_query($conexion, "SELECT * FROM $tabla WHERE $condicionEnd");
    if (mysqli_num_rows($conteoH78) >= 0) {
      return  mysqli_num_rows($conteoH78);
    } else {
      return 0;
    }
  }



  $hab = contar('inf_habitantes', 'id!=""');
  $fam = contar('inf_habitantes', 'rol_familiar="JEFE DE FAMILIA"');
  $viv = contar('inf_casas', 'id!=""');
  function countDistinc($distinc, $tabla){
    $condicionExtra = "";

    if (isset($_GET['modo'])) {
      
      $value = $_GET['value'];
      
      switch ($_GET['modo']) {

        case 'mcp':
          $condicionExtra = " WHERE id_municipio = '".$value."'";
          break;
        case 'paq':
          $condicionExtra = " WHERE id_parroquia = '".$value."'";
          break;
        case 'com':
          $condicionExtra = " WHERE id_comuna = '".$value."'";
          break;
        case 'cod':
          $condicionExtra = " WHERE id_c_comunal = '".$value."'";
          break;
      }
      
    }



    global $conexion;

    
    $sql = "SELECT count(distinct $distinc) FROM $tabla $condicionExtra";
    $result = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_assoc($result);
    return $fila['count(distinct ' . $distinc . ')'];
  }

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
    <title class="registros" id="title">Registros</title>
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/amcharts5/examples/misc-40-charts/index.css" />
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
                  <p class="text-sm mb-0 text-capitalize">Habitantes</p>
                  <h4 class="mb-0"><?php echo number_format(contar('inf_habitantes', 'id!=""'), '0', '.', '.') ?></h4>
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
                  <h4 class="mb-0"><?php echo number_format(contar('inf_habitantes', 'rol_familiar="JEFE DE FAMILIA"'), '0', '.', '.') ?></h4>
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
                  <h4 class="mb-0"><?php echo number_format(contar('inf_casas', 'id!=""'), '0', '.', '.') ?></h4>

                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">Viviendas censadas</p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-star opacity-10"></i>

                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Directorio</p>
                  <h4 class="mb-0"><a href="directorio.php">ver</a></h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">Directorio de las organizaciones</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">

          <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
            <div class="card" style="min-height: 550px;">
              <div class="card-header pb-0">

                <div class="row">
                  <div class="col-lg-9 col-10">
                    <h6>Resumen por area</h6>
                  </div>

                  <div class="col-lg-3 col-4" style="display: flex;">
                    <div class="input-group input-group-outline my-3">

                      <select onchange="setVistaArea()" class="form-control" id="area" style="padding: 10px !important;margin-top: -20px;">
                        <option value="informacionGeneral">General</option>
                        <option value="ProteccionSocial">Protección Social</option>
                      </select>
                    </div>



                    <span title="Filtrar por localidad" style="margin-left: 20px; cursor: pointer;">
                      <a onclick="setFilter()">
                        <i class="fa fa-filter"></i>
                      </a>
                    </span>

                  </div>

                </div>


              </div>
              <div class="card-body px-0 pb-2" style="margin: 0 15px 15px">


                <div class="row vistas animated fadeInUp" id="informacionGeneral">
                  <div class="col-lg-6">
                    <ul>
                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Comunas</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Comunas', <?php echo 1 ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo 1 ?>
                        </div>
                      </li>
                      <hr>
                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Consejos Comunales</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Consejos Comunales', <?php echo 7 ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo 7 ?>
                        </div>
                      </li>
                      <hr>
                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Viviendas</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Viviendas', <?php echo $viv  ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo $viv  ?>
                        </div>
                      </li>
                      <hr>

                    </ul>
                  </div>


                  <div class="col-lg-6">

                    <ul>


                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Viviendas vacias</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Viviendas vacias', <?php echo $viv - countDistinc('id_vivienda', 'inf_habitantes'); ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo $viv - countDistinc('id_vivienda', 'inf_habitantes')  ?>
                        </div>
                      </li>
                      <hr>

                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Familias</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Familias', <?php echo $fam  ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo $fam  ?>
                        </div>
                      </li>
                      <hr>

                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Habitantes</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Habitantes', <?php echo $hab ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo $hab  ?>
                        </div>
                      </li>
                      <hr>

                    </ul>

                  </div>
                </div>
                <div class="row vistas  animated fadeInUp" id="ProteccionSocial" style="display: none">
                  <div class="col-lg-6">
                    <ul>
                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Combos alimenticios CLAP</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Combos alimenticios CLAP', <?php echo contar('inf_habitantes', 'combo_alimenticio_clap="SI"') ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo contar('inf_habitantes', 'combo_alimenticio_clap="SI"') ?>
                        </div>
                      </li>
                      <hr>


                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Hogares de la patria</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Hogares de la patria', <?php echo contar('inf_habitantes', 'hogares_de_la_patria="SI"') ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo contar('inf_habitantes', 'hogares_de_la_patria="SI"') ?>
                        </div>
                      </li>
                      <hr>


                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Parto humanizado</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Parto humanizado', <?php echo contar('inf_habitantes', 'parto_humanizado="SI"') ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo contar('inf_habitantes', 'parto_humanizado="SI"') ?>
                        </div>
                      </li>
                      <hr>

                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Lactancia materna</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Lactancia materna', <?php echo contar('inf_habitantes', 'lactancia_materna="SI"') ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo contar('inf_habitantes', 'lactancia_materna="SI"') ?>
                        </div>
                      </li>
                      <hr>

                    </ul>
                  </div>





                  <div class="col-lg-6">
                    <ul>

                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Adulto mayor</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Adulto mayor', <?php echo contar('inf_habitantes', 'pension="SI"') ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo contar('inf_habitantes', 'pension="SI"') ?>
                        </div>
                      </li>
                      <hr>

                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">José Gregorio Hernandez</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('José Gregorio Hernandez', <?php echo contar('inf_habitantes', 'recibe_bono_jose_g="SI"') ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo contar('inf_habitantes', 'recibe_bono_jose_g="SI"') ?>
                        </div>
                      </li>
                      <hr>


                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Carnetizados</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Carnetizados', <?php echo contar('inf_habitantes', 'carnet_patria="SI"') ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo contar('inf_habitantes', 'carnet_patria="SI"') ?>
                        </div>
                      </li>
                      <hr>


                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Sin carnet</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Sin carnet', <?php echo contar('inf_habitantes', 'carnet_patria="NO"') ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo contar('inf_habitantes', 'carnet_patria="NO"') ?>
                        </div>
                      </li>
                      <hr>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-2 mb-md-0 mb-4">


            <div id="graficoContent">

              <div class="card mh-550">
                <h6 class="h6Card">Información comparada</h6>
                <div class="h6CardDiv">
                  <div id="chartdiv" style="display: none;"></div>

                  <div class="piechart imagenNoData" style="margin: 15px">
                    <div id="graficoSinDatos" class="nodatachart card ">Sin datos disponibles</div>
                  </div>
                </div>
                <p id="vaciarDatos" style="cursor: pointer; margin: 0 0 20px 21px; display: none;" onclick="vaciarChart()">Quitar elementos comparados</p>

              </div>
            </div>




            <div id="filterConctent" style="display: none;">

              <div class="card mh-550" style="min-height: 550px;">
                <h6 class="h6Card">Información comparada</h6>
                <div>


                  <div style="margin: 10px 21px 0 21px;">
                    <br>
                    <label style="margin-bottom: 0;" for="municipio?id" style="white-space: nowrap;" class="label-control">Municipio</label>
                    <div class="input-group input-group-outline my-3">
                      <select class="form-control" name="municipio_id" id="municipio_id">
                        <option value="">Seleccione...</option>

                        <?php foreach ($countries as $c) : ?>
                          <option value="<?php echo $c->id_municipio; ?>">&nbsp;<?php echo $c->nombre_municipio; ?></option>
                        <?php endforeach; ?>


                      </select>
                    </div>
                    <label style="margin-bottom: 0;" for="municipio?id" style="white-space: nowrap;" class="label-control">Parroquia</label>
                    <div class="input-group input-group-outline my-3">
                      <select class="form-control" name="continente_id" id="continente_id">
                        <option value="">Seleccione...</option>
                      </select>
                    </div>
                    <label style="margin-bottom: 0;" for="municipio?id" style="white-space: nowrap;" class="label-control">Comuna</label>
                    <div class="input-group input-group-outline my-3">
                      <select class="form-control" name="pais_id" id="pais_id">
                        <option value="">Seleccione...</option>
                      </select>
                    </div>
                    <label style="margin-bottom: 0;" for="municipio?id" style="white-space: nowrap;" class="label-control">Consejo comunal</label>
                    <div class="input-group input-group-outline my-3">
                      <select class="form-control" name="ciudad_id" id="ciudad_id">
                        <option value="">Seleccione...</option>
                      </select>
                    </div>

                    <button class="btn btn-primary bg-gradient-primary box-shadow-primary fr mt1" onclick="establecerFiltro()">
                      Establecer
                    </button>




                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>


        <div class="row mt-4">
          <div class="col-lg-12 col-md-8 mb-md-0 mb-4">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-12 col-12">
                    <h6>Consultar datos</h6>
                    <!-- vista resultado consulta -->
                    <br>
                    <!-- Inicio de la tabla -->
                    <div class="row">
                      <div class="col-lg-4">

                        <label style="margin-bottom: 0;" for="condicion">Condición</label>
                        <div class="input-group input-group-outline my-3">
                          <input type="text" name="condicion" id="condicion" class="form-control" placeholder="Cada condición se deberá separar por un punto y coma">
                        </div>

                      </div>

                      <div class="col-lg-4">

                        <label style="margin-bottom: 0;" for="modo" style="white-space: nowrap;" class="label-control">Metodo de busqueda</label>
                        <div class="input-group input-group-outline my-3">
                          <select class="form-control" name="modo" id="modo">
                            <option value=" OR ">Alguna de las condiciones se debe cumlir</option>
                            <option value=" AND ">Todas las condiciones se deben cumplir</option>
                            <option value="!=">Ninguna de las condiciones se debe cumlir</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-3 btn-col">
                        <button style="margin-top: 40px !important;" onclick="validarConsulta()" class="btn bg-gradient-primary w-100 my-4 mb-2">Realizar consulta</button>
                      </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                      <section id="tablaResultado" style="max-height: 60vh;overflow-y: auto; overflow-x: hidden;"></section>
                    </div>
                    <!-- Fin de la tabla -->
                  </div>
                </div>
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
    <script src="mapa/glosario.js"></script>



    <script src="../assets/amcharts5/index.js"></script>
    <script src="../assets/amcharts5/xy.js"></script>
    <script src="../assets/amcharts5/themes/Animated.js"></script>
    <script src="../assets/amcharts5/themes/Material.js"></script>
    <script src="../assets/amcharts5/percent.js"></script>
    <script src="../assets/amcharts5/examples/misc-40-charts/index.js"></script>
    <script>
      //crear una funcion con nombre establecerFiltro que tome los valores de los select con id municipio_id, continente_id, pais_id, ciudad_id y vericar que no esten vacios y recargar la pagina pasando los valores de los select como parametros

      function establecerFiltro() {
        var municipio_id = document.getElementById("municipio_id").value;
        var continente_id = document.getElementById("continente_id").value;
        var pais_id = document.getElementById("pais_id").value;
        var ciudad_id = document.getElementById("ciudad_id").value;

        if (municipio_id == "" && continente_id == "" && pais_id == "" && ciudad_id == "") {
          alert("Debe seleccionar algun filtro");
        } else {

          if (municipio_id != "" && continente_id == "" && pais_id == "" && ciudad_id == "") {
            window.location.href = "?modo=mcp&value=" + municipio_id;
          } else if (municipio_id != "" && continente_id != "" && pais_id == "" && ciudad_id == "") {
            window.location.href = "?modo=paq&value=" + continente_id;
          } else if (municipio_id != "" && continente_id != "" && pais_id != "" && ciudad_id == "") {
            window.location.href = "?modo=com&value=" + pais_id;
          } else if (municipio_id != "" && continente_id != "" && pais_id != "" && ciudad_id != "") {
            window.location.href = "?modo=cod&value=" + ciudad_id;
          }

        }

      }

     



      // crear funcion setFilter que me oculte el div graficoContent y muestre el div filterConctent
      function setFilter() {
        document.getElementById('graficoContent').style.display = 'none'; 
        document.getElementById('filterConctent').style.display = 'block';
      }

      function vaciarChart() {
        $('#vaciarDatos').hide()
        $('#chartdiv').hide()
        $('.imagenNoData').show()

        series.data.setAll();

      }
      /* quitar todos los elementos del grafico */

      function comparar(categoryValue, valuePorcen) {


        document.getElementById('graficoContent').style.display = 'block';
        document.getElementById('filterConctent').style.display = 'none';

        $('.imagenNoData').hide()
        $('#chartdiv').show()
        $('#vaciarDatos').show()

        series.data.push({
          value: valuePorcen,
          category: categoryValue
        });
        legend.data.setAll(series.dataItems);
      }
      /* Agregar elementos al grafico */

      function setVistaArea() {
        var valor = $('#area').val()
        $('.vistas').hide()
        $('#' + valor).show()
      }
      /** Cambiar las vista de resume */

      function validarConsulta() {

        if ($('#condicion').val().length >= 1) {

          var caso, newCaso;
          var comprobacion = 0;
          var status = 1;
          var condicion = $('#condicion').val().toLowerCase().trim().split(';');
          var consulta = '';
          var modo = $('#modo').val();
          switch (modo) {
            case '!=':
              var modoEjecucion = ' AND '
              break;

            default:
              var modoEjecucion = modo
              break;
          }


          condicion.forEach(element => {

            if (!miArray[element.trim()]) {
              alert('La palabra ' + element.trim() + ' no se reconoce')
              status = 0;


            } else {


              consulta = consulta + miArray[element.trim()][0] + modoEjecucion;

              if (comprobacion == 0) {
                caso = miArray[element.trim()][1];
                comprobacion = 1;
              } else {
                newCaso = miArray[element.trim()][1];
                if (newCaso != caso) {
                  alert('Consulta no valida');
                  status = 0;
                }
              }

            }
          });

          if (modoEjecucion == ' OR ') {
            resultado = consulta.substring(0, consulta.length - 4);
          } else {
            resultado = consulta.substring(0, consulta.length - 5);
          }

          if (modo == '!=') {
            resultado = resultado.replace('=', '!=')
          }


          if (status == 1) {

            obtenerTabla(resultado, caso)
          }
        }
      }
      /** validar la consulta escrita por el usuario */

      function obtenerTabla(consulta, tipo) {

        $.ajax({
            url: 'consultasAjax/tabla_mostrarTabla.php',
            type: 'POST',
            dataType: 'html',
            data: {
              consulta: consulta,
              tipo: tipo
            },
          })
          .done(function(resultado) {
            $('#tablaResultado').html(resultado)
          })
      }
      /** imprimir la tabla si la consulta fue validada */
      $(document).ready(function() {
        $("#municipio_id").change(function() {
          $.get("consultasAjax/selec_continente.php", "municipio_id=" + $("#municipio_id").val(), function(data) {
            $("#continente_id").html(data);
            var valorConsulta = $('#organizacion').val();


            $("#pais_id").html("<option value=''>Seleccione...</option>")
            $("#ciudad_id").html("<option value=''>Seleccione...</option>")

            obeternDirectorio(get[valorConsulta], $("#municipio_id").val(), '', '', '');
          });
        });

        $("#continente_id").change(function() {
          $.get("consultasAjax/selec_paises.php", "continente_id=" + $("#continente_id").val(), function(data) {
            $("#pais_id").html(data);
            var valorConsulta = $('#organizacion').val();

            $("#ciudad_id").html("<option value=''>Seleccione...</option>")

            obeternDirectorio(get[valorConsulta], $("#municipio_id").val(), $("#continente_id").val(), '', '');
          });
        });

        $("#pais_id").change(function() {
          $.get("consultasAjax/selec_ciudades.php", "pais_id=" + $("#pais_id").val(), function(data) {
            $("#ciudad_id").html(data);
            var valorConsulta = $('#organizacion').val();

            obeternDirectorio(get[valorConsulta], $("#municipio_id").val(), $("#continente_id").val(), $("#pais_id").val(), '');
          });
        });


        $("#ciudad_id").change(function() {
          var valorConsulta = $('#organizacion').val();

          obeternDirectorio(get[valorConsulta], $("#municipio_id").val(), $("#continente_id").val(), $("#pais_id").val(), $("#ciudad_id").val());
        });

      });


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