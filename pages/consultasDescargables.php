<?php
include('../configuracion/conexionMysqli.php');
include('../class/count.php');

if ($_SESSION['nivel'] == 1) {
  unset($_SESSION['proyecto']);

  $codigo = $_GET["codigo"];
?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title class="cartografia" id="title">Reportes descargables</title>
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/amcharts5/examples/misc-40-charts/index.css" />
    <script src="../assets/js/jquery-3.6.0.min.js"></script>


    <link rel="stylesheet" href="mapa/js/ui/jquery-ui.min.css">
    <script src="mapa/js/ui/jquery.min.js"></script>
    <script src="mapa/js/ui/jquery-ui.min.js"></script>

    <script src="../assets/js/sweetalert2.all.min.js"></script>

    <script src="mapa/glosario.js"></script>

  </head>
  <script>
    let claves = Object.keys(miArray);
    var availableTags = [];



    claves.forEach(element => {
      availableTags.push(element)
    });




    $(function() {

      $("#condicion").autocomplete({
        minLength: 3,
        source: availableTags
      });

    });
  </script>



  <style>
    .camposMostrar {
      padding: 10px 15px;
      height: 285px;
      overflow-y: auto;
      background: #f5f5f5b5;
      border-radius: 10px;
    }
  </style>



  <body class="g-sidenav-show  bg-gray-200" id="myBody">
    <?php include('includes/menu.php'); ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
      <!-- Navbar -->
      <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Gitcom</a></li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Reportes</h6>
          </nav>
          <?php include('includes/header.php') ?>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid">


        <div class="d-flex flex-wrap flex-stack mt-5  mb-3" style="justify-content: space-between;">
          <h5 class="fw-bold my-2">
            Archivos del proyecto
          </h5>

          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <i class="fa fa-file-o me-1"></i> Crear archivo</button>
        </div>

        <section id="archivo_tabla"></section>

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" id="tamanoModal">
            <div class="modal-content">

              <div class="modal-header">
                <h5 class="modal-title">Crear archivo</h5>
                <a type="button" data-bs-dismiss="modal" aria-label="Close" onclick="cancelar()"> <i class="fa fa-close"></i> </a>
              </div>

              <div class="modal-body">



                <section id="sect1">
                  <div class="mb-3 ">
                    <label for="formato" class="form-label">Formato</label>
                    <select id="formato" class="form-control">
                      <option value="">Seleccione</option>
                      <option value="1">XLS</option>
                      <option value="2">PDF</option>
                    </select>
                  </div>

                  <div class="mb-3 ">
                    <label for="nombreArchivo" class="form-label">Nombre del archivo</label>
                    <input type="text" class="form-control" id="nombreArchivo">
                  </div>

                  <div class="mb-3 ">
                    <label for="tabla" class="form-label">Tabla a consultar</label>
                    <select id="tabla" class="form-control">
                      <option value="">Seleccione</option>
                      <option value="1">Viviendas</option>
                      <option value="1" disabled>Habitantes</option>
                    </select>
                  </div>
                </section>


                <section id="sect2" class="row" style="display: none;">



                  <div class="col-lg-6">

                    <div class="mb-3 ">


                      <label style="margin-bottom: 0;" for="condicion">Campo de entrada</label>
                      <div class="input-group input-group-outline my-3">
                        <input type="text" name="condicion" id="condicion" class="form-control" style="height: 40px;">
                        <button onclick="addConsulta('>')" id="btn_dark" style="height: 40px;" title="Pasar a consultar" class="btn btn-danger"> <i class="fa fa-plus"></i> </button>
                      </div>
                    </div>


                    <div id="addBottom" style="display: none;">

                      <section style="display: flex;justify-content: space-between;">
                        <label class="form-label"> Método de validación</label>
                        <section>
                          <button onclick="addConsulta(' OR ')" disabled id="btn_info" title="Que se cumpla alguna de las condiciones" class="btn btn-info">O</button>
                          <button onclick="addConsulta(' AND ')" disabled id="btn_danger" title="Que se cumplan todas las condiciones" class="btn btn-danger">Y</button>
                        </section>
                      </section>



                    </div>




                    <div class="mb-3 ">

                      <label style="margin-bottom: 0;" for="modo" style="white-space: nowrap;" class="label-control">Consulta</label>
                      <div class="input-group input-group-outline my-3">
                        <input type="text" name="consulta" onchange="formulacion()" id="consulta" class="form-control" placeholder="Consulta">
                      </div>



                      <span id="reslutConsulta">
                      </span>



                    </div>



                    <section id="tablaResultado" style="max-height: 60vh;overflow-y: auto; overflow-x: hidden;"></section>









                  </div>
                  <div class="col-lg-6">


                    <p style="margin-bottom: 14px;" for="condicion">Campos extras a mostrar</p>

                    <div class="camposMostrar">

                      <input type="checkbox" onclick="addCampo('coordenada_norte')" class="form-check-input" id="coordenada_norte"> &nbsp;<label for="coordenada_norte"> Latitud </label><br>
                      <input type="checkbox" onclick="addCampo('coordenada_este')" class="form-check-input" id="coordenada_este"> &nbsp;<label for="coordenada_este"> Longitud </label><br>
                      <input type="checkbox" onclick="addCampo('material_construccion')" class="form-check-input" id="material_construccion"> &nbsp;<label for="material_construccion"> Material de construcción </label><br>
                      <input type="checkbox" onclick="addCampo('condicion_vivienda')" class="form-check-input" id="condicion_vivienda"> &nbsp;<label for="condicion_vivienda"> Condición de la vivienda </label><br>
                      <input type="checkbox" onclick="addCampo('cantidad_habitaciones')" class="form-check-input" id="cantidad_habitaciones"> &nbsp;<label for="cantidad_habitaciones"> Cantidad de habitaciones </label><br>
                      <input type="checkbox" onclick="addCampo('vivienda_venezuela')" class="form-check-input" id="vivienda_venezuela"> &nbsp;<label for="vivienda_venezuela"> Vivienda Venezuela </label><br>
                      <input type="checkbox" onclick="addCampo('bnbt')" class="form-check-input" id="bnbt"> &nbsp;<label for="bnbt"> BNBT </label><br>
                      <input type="checkbox" onclick="addCampo('tenencia_tierra')" class="form-check-input" id="tenencia_tierra"> &nbsp;<label for="tenencia_tierra"> Tenencia de la tierra </label><br>
                      <input type="checkbox" onclick="addCampo('agua_potable')" class="form-check-input" id="agua_potable"> &nbsp;<label for="agua_potable"> Suministro de agua potable </label><br>
                      <input type="checkbox" onclick="addCampo('almacenamiento_agua')" class="form-check-input" id="almacenamiento_agua"> &nbsp;<label for="almacenamiento_agua"> Almacenamiento del agua </label><br>
                      <input type="checkbox" onclick="addCampo('suministro_agua_consumo')" class="form-check-input" id="suministro_agua_consumo"> &nbsp;<label for="suministro_agua_consumo"> Suministro del agua de consumo </label><br>
                      <input type="checkbox" onclick="addCampo('tratamientoAgua')" class="form-check-input" id="tratamientoAgua"> &nbsp;<label for="tratamientoAgua"> Tratamiento del agua </label><br>
                      <input type="checkbox" onclick="addCampo('agua_servidas')" class="form-check-input" id="agua_servidas"> &nbsp;<label for="agua_servidas"> Agua servidas </label><br>
                      <input type="checkbox" onclick="addCampo('tapaPozo')" class="form-check-input" id="tapaPozo"> &nbsp;<label for="tapaPozo"> Tapa del pozo séptico </label><br>
                      <input type="checkbox" onclick="addCampo('disposicion_basura')" class="form-check-input" id="disposicion_basura"> &nbsp;<label for="disposicion_basura"> Disposición de la basura </label><br>
                      <input type="checkbox" onclick="addCampo('frecuencia_recoleccion')" class="form-check-input" id="frecuencia_recoleccion"> &nbsp;<label for="frecuencia_recoleccion"> Frecuencia de recolección </label><br>
                      <input type="checkbox" onclick="addCampo('electricidad')" class="form-check-input" id="electricidad"> &nbsp;<label for="electricidad"> Electricidad </label><br>
                      <input type="checkbox" onclick="addCampo('medidor_electricidad')" class="form-check-input" id="medidor_electricidad"> &nbsp;<label for="medidor_electricidad"> Medidor eléctrico </label><br>
                      <input type="checkbox" onclick="addCampo('telefonia')" class="form-check-input" id="telefonia"> &nbsp;<label for="telefonia"> Telefonía </label><br>
                      <input type="checkbox" onclick="addCampo('internet')" class="form-check-input" id="internet"> &nbsp;<label for="internet"> Internet </label><br>
                      <input type="checkbox" onclick="addCampo('television')" class="form-check-input" id="television"> &nbsp;<label for="television"> Televisión </label><br>
                      <input type="checkbox" onclick="addCampo('zonaRiesgo')" class="form-check-input" id="zonaRiesgo"> &nbsp;<label for="zonaRiesgo"> Zona de riesgo </label><br>
                    </div>
                  </div>
                </section>
              </div>
              <div class="modal-footer">
                <a class="btn btn-secondary" data-bs-dismiss="modal" onclick="cancelar()">Cancelar</a>
                <a onclick="siguienteOpt()" id="btnFinalizar" class="btn btn-primary">Siguiente</a>
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
      function descargar() {
        let consulta = $('#consulta').val()

        window.location.href = "reportes/reporteXlsx.php?consulta=" + consulta + "&camposMostrar=" + camposMostrar;

      }

      function siguienteOpt() {
        if ($('#formato').val() == '' || $('#nombreArchivo').val() == '' || $('#tabla').val() == '') {
          toast('error', 'Rellene todos los campos')
          return
        }
        $('#sect1').hide()
        $('#sect2').show()
        $('#btnFinalizar').attr('onclick', 'save()')
        $('#tamanoModal').addClass('modal-lg')
      }

      function cancelar() {
        $('.form-check-input').attr('checked', false)
        $('.form-control').val('')
        $('#sect1').show()
        $('#sect2').hide()
        $('#staticBackdrop').modal('toggle')
        $('#btnFinalizar').attr('onclick', 'siguienteOpt()')
        $('#tamanoModal').removeClass('modal-lg')
      }




      function validar(simbol) {
        let consulta = $('#consulta').val();

        if (consulta != '') {
          $.ajax({
              url: 'consultasAjax/validarConsulta.php',
              type: 'POST',
              dataType: 'html',
              data: {
                consulta: consulta
              },
            })
            .done(function(resultado) {

              if (resultado.indexOf('Trying to get property of non-object in') != '-1') {
                $('#reslutConsulta').html('<span style="color: red">Hay un error en su consulta. (No se reconoce un campo o falta algun simbolo)</span>')
              } else {
                $('#reslutConsulta').html(resultado)
                if (simbol == '>') {
                  $('#btn_dark').hide(resultado)
                  $('#addBottom').show(resultado)
                }
              }
            })
        }
      }




      var camposMostrar = [];

      function addCampo(campo) {
        if (document.getElementById(campo).checked) {
          camposMostrar.push(campo)
        } else {
          delete camposMostrar[camposMostrar.indexOf(campo)]
        }
      }



      function tabla() {

        $.ajax({
            url: 'consultasAjax/consultasDescargables_archivos.php',
            type: 'POST',
            dataType: 'html',
            data: {
              c: "<?php echo $codigo ?>"
            },
          })
          .done(function(resultado) {
            $('#archivo_tabla').html(resultado)
          })

      }

      tabla()




      function imprimir(id) {


        $.ajax({
            url: 'consultasAjax/consultasDescargables_reporte.php',
            type: 'GET',
            dataType: 'html',
            data: {
              i: id
            },
          })
          .done(function(result) {

            var restorepage = $('#myBody').html();
            $('#myBody').html(result);

            window.print();
            $('#myBody').html(restorepage);
            location.reload();
          })

      }










      function save() {

        if ($('#reslutConsulta').html() == '<span style="color: red">Hay un error en su consulta. (No se reconoce un campo o falta algun simbolo)</span>') {
          toast('error', 'Hay un error en la consulta')
          return
        }

        let consulta = $('#consulta').val()
        if (consulta == '') {
          toast('error', 'La consulta no puede estar vacia')
          return
        }

        let formato = $('#formato').val()
        let nombreArchivo = $('#nombreArchivo').val()
        let tabla = $('#tabla').val()

        let campos = ''

        camposMostrar.forEach(element => {
          campos = campos + '*' + element
        });



        consulta = consulta.replaceAll('"', '*');


        $.ajax({
            url: 'consultasAjax/saveArchivo.php',
            type: 'POST',
            dataType: 'html',
            data: {
              consulta: consulta,
              camposMostrar: campos,
              formato: formato,
              nombreArchivo: nombreArchivo,
              tabla: tabla,
              proyecto: '<?php echo $codigo ?>'
            },
          })
          .done(function(resultado) {
            location.reload();

            cancelar()
            // loading
          })

      }






      function addConsulta(params) {

        if (miArray[$('#condicion').val()]) {

          if (params == '>') {
            $('#btn_dark').attr('disabled', true);
            $('#btn_info').attr('disabled', false);
            $('#btn_danger').attr('disabled', false);
            $('#consulta').val(miArray[$('#condicion').val()][0])

          } else {
            $('#consulta').val($('#consulta').val() + params + miArray[$('#condicion').val()][0])
          }
          $('#condicion').val('')

          // Formulacion de la consulta
          formulacion(params)


        } else
          alerta("No se reconoce la entrada", 'error')

      }

      function formulacion(tipo) {
        $('#reslutConsulta').html('')
        $('#tablaResultado').html('')


        let c = $('#consulta').val();

        if (c != '') {
          $('#btn_dark').attr('disabled', true);
          $('#btn_info').attr('disabled', false);
          $('#btn_danger').attr('disabled', false);
          $('#addBottom').show(300);
        } else {
          $('#btn_dark').attr('disabled', false);
          $('#btn_info').attr('disabled', true);
          $('#btn_dark').show(300);
          $('#addBottom').hide(300);
          $('#btn_danger').attr('disabled', true);

        }



        var texto = ' <strong> (Condicion(es) a cumplir):</strong><br><br>';



        if (c.indexOf(' OR ') != '-1') {
          c = c.split(' OR ')

          texto += '<ul>';

          c.forEach(element => {
            texto += '<ul>' + element + '</ul>'
          });
        } else {
          texto += c;
        }



        if (c.indexOf('DELETE') != '-1' || c.indexOf('DROP') != '-1' || c.indexOf('drop') != '-1' || c.indexOf('drop') != '-1' || c.indexOf(';') != '-1' || c.indexOf('DELETE') != '-1' || c.indexOf('delete') != '-1') {
          $('#consulta').val('')
          alerta("Uso de palabra reservada", 'error')

        } else {
          validar(tipo)
        }

      }
    </script>




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










      /** validar la consulta escrita por el usuario */

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