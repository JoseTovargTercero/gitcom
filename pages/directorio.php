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
include('../class/count.php');

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
    <title class="directorio" id="title">Directorio</title>
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
                  <p class="text-sm mb-0 text-capitalize">UBCH</p>
                  <h4 class="mb-0"><?php echo number_format(contar2('inf_habitantes', 'ubch!="NO" AND ubch!="NO APLICA"'), '0', '.', '.') ?></h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">Integrantes de las UBCH</p>
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
                  <p class="text-sm mb-0 text-capitalize">Somos Venezuela</p>
                  <h4 class="mb-0"><?php echo number_format(contar2('inf_habitantes', 'msv="SI"'), '0', '.', '.') ?></h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">Brigadistas</p>
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
                  <p class="text-sm mb-0 text-capitalize">Promotores</p>
                  <h4 class="mb-0"><?php echo number_format(contar2('inf_habitantes', 'promotores_comunitarios="SI"'), '0', '.', '.') ?></h4>

                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">Promotores comunitarios</p>
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
                  <p class="text-sm mb-0 text-capitalize">Registros</p>
                  <h4 class="mb-0"><a href="registros.php">ver</a></h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">Consulta de información cargada</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
            <div class="card" style="min-height: 550px;">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-8 col-10">
                    <h6>Directorio</h6>
                  </div>

                  <div class="col-lg-4 col-4">
                  <div class="input-group input-group-outline my-3">

                      <select  class="form-control" id="organizacion"  name="organizacion" style="padding: 10px !important;margin-top: -20px;">
                      <option value="concejo_comunal"> Consejo Comunal</option>
											<option value="raas"> RAAS</option>
											<option value="clap"> CLAP</option>
											<option value="ubch"> UBCH</option>
											<option value="milicia">Milicianos</option>
											<option value="promotores_comunitarios">Promotores Comunitarios</option>
											<option value="ffm"> FFM</option>
											<option value="msv">Brig. Somos Venezuela</option>
											<option value="mesa_tecnica_telecomunicaciones"> MT. de Telecomunicaciones</option>
											<option value="mesa_tecnica_agua"> MT. de Agua</option>
											<option value="sala_bnbt"> Sala BNBT</option>
                      </select>
                    </div>
                  </div>


                </div>
              </div>
              <div class="card-body px-0 pb-2" style="margin: -50px 15px 15px">
                <div class="row vistas">
                  <div class="card-body px-0 pb-2">
	                    <section  style="height: 70vh; overflow: auto" id="resultadoDirectorio"></section>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-2 mb-md-0 mb-4">
            <div class="card" style="min-height: 550px;">
              <h6 style="margin: 21px 0 0 21px;">Filtrar</h6>
              <div style="margin: 10px 21px 0 21px;">
                <br>
                <label style="margin-bottom: 0;" for="municipio_id" style="white-space: nowrap;" class="label-control">Municipio</label>
                <div class="input-group input-group-outline my-3">
                  <select class="form-control" name="municipio_id" id="municipio_id">
                    <option value="">Seleccione...</option>

                    <?php foreach ($countries as $c) : ?>
                      <option value="<?php echo $c->id_municipio; ?>">&nbsp;<?php echo $c->nombre_municipio; ?></option>
                    <?php endforeach; ?>


                  </select>
                </div>
                <label style="margin-bottom: 0;" for="continente_id" style="white-space: nowrap;" class="label-control">Parroquia</label>
                <div class="input-group input-group-outline my-3">
                  <select class="form-control" name="continente_id" id="continente_id">
                    <option value="">Seleccione...</option>
                  </select>
                </div>
                <label style="margin-bottom: 0;" for="pais_id" style="white-space: nowrap;" class="label-control">Comuna</label>
                <div class="input-group input-group-outline my-3">
                  <select class="form-control" name="pais_id" id="pais_id">
                    <option value="">Seleccione...</option>
                  </select>
                </div>
                <label style="margin-bottom: 0;" for="ciudad_id" style="white-space: nowrap;" class="label-control">Consejo comunal</label>
                <div class="input-group input-group-outline my-3">
                  <select class="form-control" name="ciudad_id" id="ciudad_id">
                    <option value="">Seleccione...</option>
                  </select>
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


var get = {
				'concejo_comunal': 'concejo_comunal/inf_habitantes.concejo_comunal!=*NO* AND inf_habitantes.concejo_comunal!=*NO APLICA*',
				'raas': 'raas/inf_habitantes.raas!=*NO* AND inf_habitantes.raas!=*NO APLICA*',
				'clap': 'clap/inf_habitantes.clap!=*NO* AND inf_habitantes.clap!=*NO APLICA*',
				'ubch': 'ubch/inf_habitantes.ubch!=*NO* AND inf_habitantes.ubch!=*NO APLICA*',
				'milicia': 'milicia/inf_habitantes.milicia!=*NO*',
				'promotores_comunitarios': 'promotores_comunitarios/inf_habitantes.promotores_comunitarios=*SI*',
				'ffm': 'ffm/inf_habitantes.ffm=*SI*',
				'msv': 'msv/inf_habitantes.msv=*SI*',
				'robert_serra': 'robert_serra/inf_habitantes.robert_serra=*SI*',
				'mesa_tecnica_telecomunicaciones': 'mesa_tecnica_telecomunicaciones/inf_habitantes.mesa_tecnica_telecomunicaciones=*SI*',
				'mesa_tecnica_agua': 'mesa_tecnica_agua/inf_habitantes.mesa_tecnica_agua=*SI*',
				'sala_bnbt': 'sala_bnbt/inf_habitantes.sala_bnbt=*SI*'
			};

function obeternDirectorio(consulta, mcp, pq, cmu, cc) {
				$.ajax({
          url: 'consultasAjax/directorio_mostrarDirectorio.php',
						type: 'POST',
						dataType: 'html',
						data: {
							consulta: consulta,
							mcp: mcp,
							pq: pq,
							cmu: cmu,
							cc: cc
						},
					})

					.done(function(resultado) {
						$("#resultadoDirectorio").html(resultado);
					})
			}

			$(document).on('change', '#organizacion', function() {
			var valorConsulta = $('#organizacion').val();
				obeternDirectorio(get[valorConsulta], $("#municipio_id").val(),  $("#continente_id").val(), $("#pais_id").val(), $("#ciudad_id").val());	

			});


      obeternDirectorio(get[$('#organizacion').val()], $("#municipio_id").val(),  $("#continente_id").val(), $("#pais_id").val(), $("#ciudad_id").val());	
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
						
						obeternDirectorio(get[valorConsulta], $("#municipio_id").val(),  $("#continente_id").val(), '', '');
					});
				});

				$("#pais_id").change(function() {
					$.get("consultasAjax/selec_ciudades.php", "pais_id=" + $("#pais_id").val(), function(data) {
						$("#ciudad_id").html(data);
						var valorConsulta = $('#organizacion').val();

						obeternDirectorio(get[valorConsulta], $("#municipio_id").val(),  $("#continente_id").val(), $("#pais_id").val(), '');
					});
				});


				$("#ciudad_id").change(function() {
						var valorConsulta = $('#organizacion').val();

						obeternDirectorio(get[valorConsulta], $("#municipio_id").val(),  $("#continente_id").val(), $("#pais_id").val(), $("#ciudad_id").val());
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