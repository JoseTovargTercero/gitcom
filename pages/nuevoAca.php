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

<script>
  // var arrayObjetivos = [];
  var arrayNudos = [];
</script>
<?php
include('../configuracion/conexionMysqli.php');

if ($_SESSION['nivel'] == 1) {


  unset($_SESSION['proyecto']);

  $query55 = $conexion->query("select * from local_municipio");
  $countries55 = array();
  while ($r55 = $query55->fetch_object()) {
    $countries55[] = $r55;
  }


  $query = $conexion->query("select * from aca_objetivos");
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
    <link rel="icon" type="image/png" href="../assets/img/SLS.png">
    <title class="aca" id="title">Registro del aca</title>


    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../assets/css/animate.css">


    <style>
      .titulos {
        margin: 27px 16px 25px !important;
        padding: 0 0 5px !important;
        font-size: 18px;
        border-bottom: 1px solid #e1e1e1;
        color: #344767;
      }

      .btnAdd {
        position: absolute !important;
        background-color: #ebebeb !important;
        right: 0 !important;
        margin-right: -3px !important;
        height: 40px !important;
        border: 1px solid #d2d6da !important;
        border-left: none !important;
        font-weight: bold !important;
        font-size: 20px !important;
        z-index: 9999 !important;
      }

      #nudos {
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
      }

      #potencialidades {
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
      }

      .ulTags {
        list-style: none;
        padding: 0;
        margin-top: 49px;
      }

      .ulTags>li {
        background-color: #f7f7f7;
        box-shadow: 1px 1px 2px #e1e1e1;
        color: #a3a3a3;
        border-radius: 4px;
        width: 100%;
        padding: 2px 11px;
        margin: 10px 0;
        border: 1px solid #ebebeb !important;
      }

      a {
        cursor: pointer;
      }
    </style>

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
            <h6 class="font-weight-bolder mb-0">Agenda concreta de acción</h6>
          </nav>
          <?php include('includes/header.php') ?>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid py-4">

        <div class="row mb-4  animated fadeInUp" id="nuevoVista" style="display: none;">


          <div class="col-lg-12 col-md-12">
            <div class="card" style="min-height: 65vh; overflow: auto;">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-12 col-7">
                  </div>
                </div>
              </div>
              <div class="card-body px-0 pb-2" style="padding: 0;">
                <div style="margin: 0 15px !important;" class="row">


                  <h1 class="titulos" style="    margin-top: 0!important;">
                    <i class="fa fa-check"></i>
                    Instancia
                  </h1>






                  <div class="col-lg-6">

                    <label style="margin-bottom: 0;" for="municipio_id" style="white-space: nowrap;" class="label-control">Municipio</label>
                    <div class="input-group input-group-outline my-3">
                      <select class="form-control" name="municipio_id" id="municipio_id">
                        <option value="">Seleccione...</option>

                        <?php foreach ($countries55 as $c) : ?>
                          <option value="<?php echo $c->id_municipio; ?>">&nbsp;<?php echo $c->nombre_municipio; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6">

                    <label style="margin-bottom: 0;" for="continente_id" style="white-space: nowrap;" class="label-control">Parroquia</label>
                    <div class="input-group input-group-outline my-3">
                      <select class="form-control" name="continente_id" id="continente_id">
                        <option value="">Seleccione...</option>
                      </select>
                    </div>

                  </div>
                  <div class="col-lg-6">

                    <label style="margin-bottom: 0;" for="pais_id" style="white-space: nowrap;" class="label-control">Comuna</label>
                    <div class="input-group input-group-outline my-3">
                      <select class="form-control" name="pais_id" id="pais_id">
                        <option value="">Seleccione...</option>
                      </select>
                    </div>


                  </div>
                  <div class="col-lg-6">

                    <label style="margin-bottom: 0;" for="ciudad_id" style="white-space: nowrap;" class="label-control">Consejo comunal</label>
                    <div class="input-group input-group-outline my-3">
                      <select class="form-control" name="ciudad_id" id="ciudad_id">
                        <option value="">Seleccione...</option>
                      </select>
                    </div>

                  </div>






                  <h1 class="titulos">
                    <i class="fa fa-check"></i>
                    Problema concreto
                  </h1>





                  <div class="col-lg-6">

                    <label for="objetivos" style="white-space: nowrap;" class="label-control">Objetivo histórico del plan de la patria</label>
                    <div class="input-group input-group-outline my-3">
                      <select style="padding-left: 10px;" required="" class="form-control" name="objetivos" id="objetivos">
                        <option></option>
                        <?php foreach ($countries as $c) : ?>
                          <option value="<?php echo $c->id; ?>">&nbsp;<?php echo $c->objetivo; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>


                  <div class="col-lg-6">

                    <label class="control-label">Frente de batalla</label>
                    <div class="input-group input-group-outline my-3">
                      <select style="padding-left: 10px;" required="" class="form-control" name="frentes" id="frentes">
                        <option></option>
                      </select>
                    </div>













                  </div>

                  <div class="col-lg-6">

                    <label class="control-label">Área específica de trabajo</label>
                    <div class="input-group input-group-outline my-3">

                      <select style="padding-left: 10px;" required="" class="form-control" name="areas" id="areas">
                        <option></option>
                      </select>
                    </div>
                  </div>



                  <div class="col-lg-6">

                    <label class="control-label2">Problema concreto</label>
                    <div class="input-group input-group-outline my-3">

                      <input type="text" class="form-control" name="problemas" id="problemas">
                    </div>


                  </div>








                  <h1 class="titulos">
                    <i class="fa fa-check"></i>
                    Nudos Críticos
                  </h1>
                  <input type="text" class="form-control" name="nudos" id="resultNudos" hidden>



                  <div class="col-lg-6">
                    <label class="control-label2">Nudos Críticos</label>
                    <div class="input-group input-group-outline my-3">
                      <input type="text" class="form-control" name="nudos" id="nudos">

                      <button type="submit" onclick="addElementoN()" class="btn btnAdd"><i class="fa fa-plus"></i></button>

                    </div>
                  </div>

                  <div class="col-lg-6">
                    <ul class='ulTags' id="nudosAgregados"></ul>
                  </div>





















                  <h1 class="titulos">
                    <i class="fa fa-check"></i>
                    Potencialidades
                  </h1>




                  <div class="col-lg-6">

                    <input type="text" class="form-control" name="potencialidades" id="resultPotecialidades" hidden>
                    <label class="control-label2">Potencialidades</label>
                    <div class="input-group input-group-outline my-3">
                      <input type="text" class="form-control" name="potencialidades" id="potencialidades">
                      <button type="submit" onclick="addElementoP()" class="btn btnAdd"><i class="fa fa-plus"></i></button>

                    </div>

                  </div>



                  <div class="col-lg-6">
                    <ul class='ulTags' id="potencialidadesAgregados"></ul>
                  </div>






                  <h1 class="titulos">
                    <i class="fa fa-check"></i>
                    Solución
                  </h1>






                  <div class="col-lg-6">

                    <label style="margin-bottom: 0;" for="solucion" style="white-space: nowrap;" class="label-control">Solución</label>
                    <div class="input-group input-group-outline my-3">
                      <textarea class="form-control" rows="1" id="solucion"></textarea>
                    </div>

                  </div>
                  <div class="col-lg-6">

                    <label style="margin-bottom: 0;" for="acompanante" style="white-space: nowrap;" class="label-control">Ente acompañante</label>
                    <div class="input-group input-group-outline my-3">
                      <input class="form-control" id="acompanante">
                    </div>
                  </div>

                  <button style="width: 10%;margin: 33px auto;" class="btn btn-danger" onclick="guardar()">Guardar</button>

                </div>

              </div>
            </div>
          </div>
        </div>







        <div class="col-lg-5" style="display: none;">
          <div class="card" style="max-height: 85vh; overflow: auto;">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-12 col-7">
                  <h6>Progreso</h6>

                </div>
                <hr>
              </div>
            </div>
            <div class="card-body px-0 pb-2" style="margin-top: -20px;">
              <div class="row">
                <div class="col-lg-12" style="padding: 0 35px; min-height: 390px">
                  <div class="row">

                    <dic class="col-lg-5 hide" id="divNudos">
                    </dic>

                    <dic class="col-lg-6">
                      <span id="progreso"></span>
                    </dic>


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>



        <div class="row" id="listAcas">

          <div class="col-lg-12 animated fadeInUp">
            <div class="card" style="min-height: 75vh; overflow: auto;">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-12 col-7">
                    <h6>Agendas registradas


                      <span>
                        <a onclick=" $('#nuevoVista').show(); $('#listAcas').hide() " style="cursor: pointer; color: gray; float: right;">
                          <i class="fa fa-plus"></i> Nuevo
                        </a>

                      </span>
                    </h6>

                  </div>
                  <hr>
                </div>
              </div>
              <div class="card-body px-0 pb-2" style="margin: -30px 25px 25px; ">

                <table class="table">



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
                    $queryyy4 = "SELECT * FROM aca_resultado WHERE activo='0' AND comuna='$comunaConsultar'";
                  } else {
                    $queryyy4 = "SELECT * FROM aca_resultado WHERE activo='0'";
                  }

                  $buscarM4 = $conexion->query($queryyy4);
                  if ($buscarM4->num_rows > 0) {
                    echo '  <thead>

                    <tr>
                      <th style="padding-left: 7px;">Instancia</th>
                      <th style="padding-left: 7px;">Problema</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>';
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
                            $nudos .=  $row4455['detalle'] . '. ';
                          } else {
                            $potencialidades .= $row4455['detalle'] . '. ';
                          }
                        }
                      }



                      $soluciones = $row4['soluciones'];
                      $ejecutor = $row4['ejecutor'];


                      if ($_GET['id'] != '' && $_GET['problemas']  != '' && $_GET['comuna']  != '') {
                        echo '<a onclick=\'asociar("' . $problema . '", "' . $idAcaComunal . '")\'>Asociar</a> ';
                      } else {
                        if ($tp == '1') {
                          $link = '<a style=\'float: right\' href=\'mapa/index.php?proceso=aca&comuna=' . $row4['comuna'] . '&idProblema=' . $row4['id'] . '&tipo=comunal\'><i class=\'fa fa-folder-open text-sm me-2\'></i></a>';
                        } else {
                          $link = '<a style=\'float: right\' href=\'mapa/index.php?proceso=aca&comunidad=' . $row4['comunidad'] . '&idProblema=' . $row4['id'] . '\'><i class=\'fa fa-folder-open text-sm me-2\'></i></a>';
                        }
                      }

                      $menu++;
                      echo '<tr>
                      <td>' . $localidad . '</td>
                      <td>' . $problema . '</td>
                      <td><a style=\'float: right\' href=\'mapa/modificarAca.php?proceso=aca&aca=' . $row4['id'] . '&idProblema=' . $row4['id'] . '\'><i class=\'fa fa-pencil text-sm me-2\'></i></a></td>
                      <td>' . $link . '</td>
                      </tr>';
                    }
                  } else {
                    echo 'No hay información para mostrar';
                  }

                  ?>








                </table>



              </div>
            </div>
          </div>
        </div>
      </div>

      </div>

      </div>

      </div>
      <?php include('notificacion.php'); ?>

      </div>
    </main>




    <script type="text/javascript">
      const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })






      function vincular() {

        Swal.fire({
          title: '¿Esta seguro?',
          html: 'Se procederá con la georreferenciacion.',
          icon: 'question',
          confirmButtonText: 'Continuar',
          showCancelButton: true,
          cancelButtonText: 'Cancelar'


        }).then((result) => {
          if (result.isConfirmed) {
            guardar();
          }
        })
      }


      function deleteThisElement(element, type) {
        $('#' + element).remove()

        var idElements = element
        idElements = idElements.replace(/_/g, ' ')

        var newValue;
        if (type == 'n') {
          newValue = $('#resultNudos').val()
          newValue = newValue.replace('~' + idElements + '/', '')
          $('#resultNudos').val(newValue)
        } else {
          newValue = $('#resultPotecialidades').val()
          newValue = newValue.replace('~' + idElements + '/', '')
          $('#resultPotecialidades').val(newValue)
        }
      }



      function addElementoN() {
        var nudos = $('#nudos').val()


        if (nudos == '') {
          Toast.fire({
            icon: 'error',
            title: 'Antes debe rellenar el campo'
          })
          return;
        } //salir de la funcion sin agregar ningun dato



        let value = $('#resultNudos').val()

        if (value.indexOf(nudos) != '-1') {

          Toast.fire({
            icon: 'error',
            title: 'El nudo crítico ya existe'
          })
          return

        }



        $('#nudos').val('')
        $('#divNudos').removeClass('hide')

        var contenidoPrevio = $('#resultNudos').val();

        $('#resultNudos').val(contenidoPrevio + '~' + nudos + '/')

        Toast.fire({
          icon: 'success',
          title: 'Nudo critico agregado correctamente'
        })



        let idElement = nudos.trim()
        idElement = idElement.replace(/ /g, '_')


        let sctructura = '<li class="animated fadeInLeft " id="' + idElement + '">' + nudos.trim() + ' <a onclick="deleteThisElement(\'' + idElement + '\', \'n\')"> <i style="color: #e64f60; float: right; margin: 4px;" class="fa fa-close"></i> </a></li>'

        $('#nudosAgregados').html($('#nudosAgregados').html() + sctructura)
      }

      function addElementoP() {

        var potencialidad = $('#potencialidades').val()

        if (potencialidad == '') {
          Toast.fire({
            icon: 'error',
            title: 'Antes debe rellenar el campo'
          })
          return;
        } //salir de la funcion sin agregar ningun dato

        let value = $('#resultPotecialidades').val()
        if (value.indexOf(potencialidad) != '-1') {

          Toast.fire({
            icon: 'error',
            title: 'La potencialidad ya existe'
          })
          return

        }

        $('#potencialidades').val('')

        var contenidoPrevioP = $('#resultPotecialidades').val();

        $('#resultPotecialidades').val(contenidoPrevioP + potencialidad + '/')
        // mensaje de exito
        Toast.fire({
          icon: 'success',
          title: 'Potencialidad agregada correctamente'
        })
        let idElementDos = potencialidad.trim()
        idElementDos = idElementDos.replace(/ /g, '_')




        let sctructura = '<li class="animated fadeInLeft " id="' + idElementDos + '">' + potencialidad.trim() + ' <a onclick="deleteThisElement(\'' + idElementDos + '\', \'p\')"> <i style="color: #e64f60; float: right; margin: 4px;" class="fa fa-close"></i> </a></li>'

        $('#potencialidadesAgregados').html($('#potencialidadesAgregados').html() + sctructura)
      }






      $(document).ready(function() {
        $("#objetivos").change(function() {
          $.get("moduloACA/selec_frentes.php", "objetivos=" + $("#objetivos").val(), function(data) {
            $("#frentes").html(data);
            console.log(data);
          });
        });

        $("#frentes").change(function() {
          $.get("moduloACA/selec_areas.php", "frentes=" + $("#frentes").val(), function(data) {
            $("#areas").html(data);
            console.log(data);
          });
        });


      });



      function guardar() {


        var municipio_id = $("#municipio_id").val()
        var continente_id = $("#continente_id").val()
        var pais_id = $("#pais_id").val()
        var ciudad_id = $("#ciudad_id").val()

        var objetivos = $("#objetivos").val()
        var frentes = $("#frentes").val()
        var areas = $("#areas").val()
        var problemas = $("#problemas").val()
        var resultNudos = $("#resultNudos").val()
        var resultPotecialidades = $("#resultPotecialidades").val()

        var solucion = $("#solucion").val()
        var acompanante = $("#acompanante").val()





        if (municipio_id == '' ||
          continente_id == '' ||
          pais_id == '' ||
          objetivos == '' ||
          frentes == '' ||
          areas == '' ||
          problemas == '' ||
          resultNudos == '' ||
          resultPotecialidades == '' ||
          solucion == '' ||
          acompanante == '') {

          Toast.fire({
            icon: 'error',
            title: 'Faltan datos'
          })
          return;
        } else {
          //Segundo if para los proyectos

          $.ajax({
              url: 'moduloACA/registro.php',
              type: 'POST',
              dataType: 'html',
              data: {
                municipio_id: municipio_id,
                continente_id: continente_id,
                pais_id: pais_id,
                ciudad_id: ciudad_id,
                objetivos: objetivos,
                frentes: frentes,
                areas: areas,
                problemas: problemas,
                resultNudos: resultNudos,
                resultPotecialidades: resultPotecialidades,
                solucion: solucion,
                acompanante: acompanante
              },
            })
            .done(function(resultado5) {
              window.open("mapa/modificarAca.php?proceso=aca&aca=" + resultado5, "_self");
            })



        }

      }
    </script>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script>
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