<?php
include('../configuracion/conexionMysqli.php');
include('../class/count.php');

if ($_SESSION['nivel'] == 1) {
  unset($_SESSION['proyecto']);

  $id = $_GET["id"];



  $query55 = $conexion->query("select * from local_municipio");
  $countries55 = array();
  while ($r55 = $query55->fetch_object()) {
    $countries55[] = $r55;
  }




?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/SLS.png">
    <title class="solicitud" id="title">Datos de solicitud</title>


    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <script src="../assets/js/sweetalert2.all.min.js"></script>


    <script src="mapa/js/leaflets.js"></script>
    <link rel="stylesheet" href="mapa/css/leaflet.css">

  </head>

  <style>
    #map {
      height: 200px;
      border-radius: 5px;
      border: 1px solid #d5d5d5;
    }

    .col-lg-6>p {
      margin-bottom: 12px;
    }
  </style>

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
            <h6 class="font-weight-bolder mb-0">Solicitud de acceso</h6>
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
                  <h6 class="text-white text-capitalize ps-3">Solicitud de acceso</h6>
                </div>
              </div>
              <div class="card-body px-0 pb-2">

                <div class="row" style="padding: 10px 30px;">
                  <div class="col-lg-6">
                    <h6> Datos de la solicitud:</h6>
                    <?php
                    $query = "SELECT * FROM sist_solicitudes_acceso WHERE id='$id'";
                    $search = $conexion->query($query);
                    if ($search->num_rows > 0) {
                      while ($row = $search->fetch_assoc()) {
                        $lat = $row['lat'];
                        $lng = $row['lng'];
                        $tipo = $row['tipo'];

                        echo '
                          <p>Cedula: <strong>' . $row['cedula'] . '</strong></p>
                          <p>Nombre: <strong>' . $row['responsable'] . '</strong></p>
                          <p>Tipo: <strong>' . ($row['tipo'] == 4 ? 'Comunitario' : 'Institución/Empresa') . '</strong></p>
                          <p>origen: <strong>' . $row['lugar'] . '</strong></p>
                          <p>Telefono: <strong>' . $row['telefono'] . '</strong></p>
                          <p>Correo: <strong>' . $row['usuario'] . '</strong></p>
                          ';
                      }
                    }
                    ?>



                    <div id="map">

                    </div>

                  </div>
                  <div class="col-lg-6">

                    <?php

                    if ($tipo == 4) {

                    ?>

                      <h6> Información del consejo comunal:</h6>


                      <label style="margin-bottom: 0;" for="municipio_id" style="white-space: nowrap;" class="label-control">Municipio</label>
                      <div class="input-group input-group-outline mb-3">
                        <select class="form-control" name="municipio_id" id="municipio_id">
                          <option value="">Seleccione...</option>

                          <?php foreach ($countries55 as $c) : ?>
                            <option value="<?php echo $c->id_municipio; ?>">&nbsp;<?php echo $c->nombre_municipio; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>

                      <label style="margin-bottom: 0;" for="continente_id" style="white-space: nowrap;" class="label-control">Parroquia</label>
                      <div class="input-group input-group-outline mb-3">
                        <select class="form-control" name="continente_id" id="continente_id">
                          <option value="">Seleccione...</option>
                        </select>
                      </div>


                      <label style="margin-bottom: 0;" for="pais_id" style="white-space: nowrap;" class="label-control">Comuna</label>
                      <div class="input-group input-group-outline mb-3">
                        <select class="form-control" name="pais_id" id="pais_id">
                          <option value="">Seleccione...</option>
                        </select>
                      </div>



                      <label style="margin-bottom: 0;" for="ciudad_id" style="white-space: nowrap;" class="label-control">Consejo comunal</label>
                      <div class="input-group input-group-outline mb-3">
                        <select class="form-control" name="ciudad_id" id="ciudad_id">
                          <option value="">Seleccione...</option>
                        </select>
                      </div>


                      <label style="margin-bottom: 0;" for="responsabilidad_comunidad" style="white-space: nowrap;" class="label-control">Responsabilidad dentro de la comunidad</label>
                      <div class="input-group input-group-outline mb-3">
                        <select class="form-control" name="responsabilidad_comunidad" id="responsabilidad_comunidad">
                          <option value="">Seleccione...</option>
                          <option value="Lider del consejo comunal">Lider del consejo comunal</option>
                          <option value="Promotor comunitario">Promotor comunitario</option>
                          <option value="Jefe de Calle">Jefe de Calle</option>
                          <option value="Lider del clap">Lider del clap</option>
                          <option value="Jefe de comunidad">Jefe de comunidad</option>
                        </select>
                      </div>


                      <button class="btn btn-primary" onclick="aprobar()">Aprobar</button>
                      <button class="btn btn-info" style="float: right;" onclick="rechazar()">Rechazar</button>


                    <?php } else { ?>

                      <h6> Información del usuario y empresa:</h6>


                      <label style="margin-bottom: 0;" for="nombre_empresa" style="white-space: nowrap;" class="label-control">Empresa/institución</label>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" id="nombre_empresa">
                      </div>

                      <label style="margin-bottom: 0;" for="rif_empresa" style="white-space: nowrap;" class="label-control">Rif la empresa/institución</label>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" id="rif_empresa">
                      </div>

                      <label style="margin-bottom: 0;" for="responsabilidad" style="white-space: nowrap;" class="label-control">Responsabilidad dentro de la empresa/institución</label>
                      <div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" id="responsabilidad">
                      </div>



                      <button class="btn btn-primary" onclick="aprobar()">Aprobar</button>
                      <button class="btn btn-info" style="float: right;" onclick="rechazar()">Rechazar</button>



                    <?php } ?>


                  </div>
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
      var map = new L.Map('map', {
        minZoom: 1, // se establece un rango de zoom
        maxZoom: 28 // se establece un rango de zoom
      }).setView([<?php echo $lat ?>, <?php echo $lng ?>], 13, false);



      map.attributionControl.addAttribution('Gitcom');

      L.marker([<?php echo $lat ?>, <?php echo $lng ?>]).addTo(map)
        .bindPopup('Ubicación del usuario al momento de la solicitud.')
        .openPopup();




      var baseLayers = {

        Google_maps: L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
          minZoom: 2,
          maxZoom: 28,
          attribution: '',
          subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }),

      };
      map.addLayer(baseLayers.Google_maps);


      $(document).ready(function() {
        $("#municipio_id").change(function() {
          $.get("selects/selec_continente.php", "municipio_id=" + $("#municipio_id").val(), function(data) {
            $("#continente_id").html(data);
            $("#pais_id").html("<option value=''>Seleccione...</option>")
            $("#ciudad_id").html("<option value=''>Seleccione...</option>")
          });
        });

        $("#continente_id").change(function() {
          $.get("selects/selec_paises.php", "continente_id=" + $("#continente_id").val(), function(data) {
            $("#pais_id").html(data);
            $("#ciudad_id").html("<option value=''>Seleccione...</option>")

          });
        });

        $("#pais_id").change(function() {
          $.get("selects/selec_ciudades.php", "pais_id=" + $("#pais_id").val(), function(data) {
            $("#ciudad_id").html(data);
          });
        });

      });



      function aprobar() {
        let id = "<?php echo $id ?>"
        let tipo = "<?php echo $tipo ?>"
        let dato0;
        let dato1;
        let dato2;

        if (tipo == 4) {
          if ($('#ciudad_id').val() == '') {
            toast('error', 'Faltan datos')
            return;
          }
          dato0 = $('#responsabilidad_comunidad').val();
          dato1 = $('#pais_id').val();
          dato2 = $('#ciudad_id').val();
        } else {
          if ($('#rif_empresa').val() == '' || $('#responsabilidad').val() == '') {
            toast('error', 'Faltan datos')
            return;
          }
          dato0 = $('#responsabilidad').val();
          dato1 = $('#rif_empresa').val();
          dato2 = $('#nombre_empresa').val();
        }

        Swal.fire({
          title: '¿Esta seguro?',
          html: 'Se creará una cuenta de usuario y se dará acceso al sistema.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#ed5264',
          confirmButtonText: 'Dar acceso',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
                url: 'consultasAjax/users/users_tabla_aceptar_sol.php',
                type: 'POST',
                dataType: 'html',
                data: {
                  id: id,
                  tipo: tipo,
                  dato0: dato0,
                  dato1: dato1,
                  dato2: dato2
                },
              })
              .done(function(rePol) {
                window.location.href = "adm_solicitud.php";
              })
          }
        })
      }

      function rechazar() {
        let id = <?php echo $id ?>

        Swal.fire({
          title: '¿Esta seguro?',
          html: 'Se eliminara la solicitud de acceso.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#ed5264',
          confirmButtonText: 'Eliminar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            $.get("consultasAjax/users/users_tabla_eliminar_sol.php", "id=" + id, function(data) {
              window.location.href = "adm_solicitud.php";
            });
          }
        })


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