<script>
  var municipio = [];
  var parroquias = [];
  var comunas = [];
  var comunidades = [];
</script>
<?php
include('../configuracion/conexionMysqli.php');
include('../class/count.php');

if ($_SESSION['nivel'] == 1) {


?>

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
        $t = "local_comunidades WHERE status='0'";
        break;
    }

    $query2 = "SELECT * FROM $t";
    $search2 = $conexion->query($query2);
    if ($search2->num_rows > 0) {
      while ($row2 = $search2->fetch_assoc()) {
        echo $array . '.push(["' . $row2[$campo1] . '", "' . $row2[$campo2] . '", "' . $row2[$campo3] . '"]);';
      }
    }
  }

  addInfoInstancias('1', 'municipio', 'id_estado', 'id_municipio', 'nombre_municipio');
  addInfoInstancias('2', 'parroquias', 'id_municipio', 'id_parroquias', 'nombre_parroquia');
  addInfoInstancias('3', 'comunas', 'id_parroquia', 'id_Comuna', 'nombre_comuna');
  addInfoInstancias('4', 'comunidades', 'id_comuna', 'id_consejo', 'nombre_c_comunal');



  echo '</script>';
  ?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/SLS.png">
    <title class="aca" id="title">Importar marcadores</title>


    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../assets/css/animate.css">
    <script src="../assets/js/vis-network.min.js"></script>






    <script src="mapa/js/leaflets.js"></script>
    <link rel="stylesheet" href="mapa/css/leaflet.css">
    <link rel="stylesheet" href="mapa/dist/leaflet.awesome-markers.css">
    <script src="mapa/dist/leaflet.awesome-markers.js"></script>

    <style>
      .table thead th {
        padding: 0.7rem 8px !important
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
            <h6 class="font-weight-bolder mb-0">Importar marcadores</h6>
          </nav>
          <?php include('includes/header.php') ?>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid py-4">




        <div class="row">

          <div class="col-lg-6 animated fadeInUp" id="formulario">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-12 col-7">
                    <h6>Archivo CSV</h6>

                  </div>
                  <hr>
                </div>
              </div>
              <form method="POST" enctype="multipart/form-data" id="formData" class="card-body px-0 pb-2" style="  margin: -30px 25px 25px; ">


                <h2>Importar archivo <strong style="color: #ed5264;">CSV</strong></h2>
                <p class="lead">
                  Seleccione el archivo CSV con los marcadores de posición e indique la comunidad al cual pertenece.
                </p>

                <div class="mb-3">
                  <label for="csv" class="form-label">Archivo en formato <strong>CSV</strong></label>
                  <input class="form-control" type="file" id="csv" name="csv[]" required="" accept=".csv">
                </div>

                <div class="mb-2">
                  <label for="mcp" class="label-control">Municipio</label>
                  <select id="mcp" name="mcp" class="form-control" onchange="setSelect('mcp', this.value)">
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
                  <select id="pq" name="pq" class="form-control" onchange="setSelect('pq', this.value)">
                    <option value="">Seleccione</option>
                  </select>
                </div>
                <div class="mb-2">
                  <label for="com" class="label-control">Comuna</label>
                  <select id="com" name="com" class="form-control" onchange="setSelect('com', this.value)">
                    <option value="">Seleccione</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="comdad" class="label-control">Comunidad</label>
                  <select id="comdad" name="comdad" class="form-control" onchange="setSelect('comdad', this.value)">
                    <option value="">Seleccione</option>
                  </select>
                </div>

                <div class="mb-2" style="text-align: right;">
                  <button class="btn btn-danger" id="guardarButton">Validar</button>
                </div>
              </form>
            </div>
          </div>

          <div class="col-lg-6 animated fadeInUp" id="correccion">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-12 col-7">
                    <h6>Resultados</h6>
                  </div>
                  <hr>
                </div>
              </div>
              <div class="card-body px-0 pb-2" style="  margin: -10px 25px 25px;">

                Cantidad total de marcadores: <strong><span id="cantidadMarcadores">Sin archivo de entrada</span></strong><br>
                Errores de formato: <strong><span id="erroresE">Sin archivo de entrada</span></strong>.
                <br>Estatus: <strong><span id="statusE">Sin archivo de entrada</span></strong>.

                <section class="mt-4" style="height: 490px; overflow-y: auto;">

                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Respuesta</th>
                        <th>Error</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="rsultSection">

                    </tbody>
                  </table>

                </section>
              </div>


            </div>
          </div>

        </div>

        <div class="row my-3">
          <div class="col-lg-12 animated fadeInUp" id="mapa">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-12 col-7">
                    <h6>Corregir posición de los marcadores



                      <div style="display: none; float: right" id="editando">
                        <button id="salvar" class="btn btn-danger" style="margin-left: 44px;"><i class="fa fa-save"></i> Guardar</button>
                      </div>


                    </h6>
                  </div>
                  <hr>
                </div>
              </div>
              <div class="card-body" style="padding-top: 3px !important;">
                <div id="map"></div>

              </div>


            </div>
          </div>


        </div>
      </div>

      </div>

      </div>

      </div>

      </div>


      <style>
        .floating {
          position: fixed;
          bottom: 10px;
          right: 10px;
          transition: all 300ms ease 0ms;
          z-index: 99;
          display: none;
        }
      </style>
      <button onclick="finalizar()" class="btn btn-danger floating" id="finalizarBtn">Finalizar</button>



      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modificar</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="respuesta" class="label-form">Respuesta</label>
                <input type="text" id="respuesta" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" onclick="setResponse()">Guardar</button>
            </div>
          </div>
        </div>
      </div>




    </main>

    <style>
      #map {
        width: 100%;
        height: 600px;
      }
    </style>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script>
      /* End map */



      var map = new L.Map('map', {
        minZoom: 1, // se establece un rango de zoom
        maxZoom: 28 // se establece un rango de zoom
      }).setView([5.6450, -67.5950], 17, false);


      googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 28,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
      });
      googleSat.addTo(map);


      var casas = L.layerGroup([]).addTo(map);
      var redMarker = L.AwesomeMarkers.icon({
        markerColor: 'red',
      });


      var drawnItems = new L.FeatureGroup();
      map.addLayer(drawnItems);



      //validar archivo de entrada

      function finalizar() {

        Swal.fire({
          title: '¿Esta seguro?',
          confirmButtonText: 'Finalizar proceso',
          html: 'EL proceso de corrección no podrá ser reanudado.',
          icon: 'info',
          confirmButtonColor: '#7eca54',
          showCancelButton: true,
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            location.reload();
          }
        })

      }



      function editarDatos(id, lastNorte, lastEste, nombre, cedula) {

        $("#editando").show(500, "swing");

        map.eachLayer(function(marker) {
          if (marker.options) {
            var markerId = marker.options.id;
            if (markerId == id) {

              casas.removeLayer(marker);

              casas.remove();

              drawnItems.addLayer(L.marker([lastNorte, lastEste], {
                draggable: true
              }).addTo(map));

            }
          }
        })

        sessionStorage['id'] = id;
        sessionStorage['este'] = lastEste;
        sessionStorage['norte'] = lastNorte;
        sessionStorage['nombre'] = nombre;
        sessionStorage['cedula'] = cedula;

      }

      /*===================================================
          EDITAR Y BORRAR MARCADORES PREVIAMENTE CREADOS          
      ===================================================*/
      document.getElementById("salvar").addEventListener("click", function() {


        var drawJson = (JSON.stringify(drawnItems.toGeoJSON()));
        drawJson = drawJson.replace('{"type":"FeatureCollection","features":[{"type":"Feature","properties":{},"geometry":{"type":"Point","coordinates":[', '')
        drawJson = drawJson.replace(']}}]}', '')


        let alatitude = drawJson.split(',')[1];
        let alongitude = drawJson.split(',')[0];


        valoresResultado[sessionStorage['id']][1] = alatitude
        valoresResultado[sessionStorage['id']][2] = alongitude


        $.ajax({
          url: '../configuracion/importar-marcadores-bd.php',
          type: 'POST',
          dataType: 'html',
          data: {
            ced: sessionStorage['cedula'],
            id: sessionStorage['id'],
            alatitude: alatitude,
            alongitude: alongitude,
            tipo: 'i'
          },
          success: function(msg) {

            if (msg.trim() == '1') {
              casas.addTo(map)
              drawnItems.clearLayers();
              $("#editando").hide(500, "swing");

              /*  ojo  */

              var pointx = L.marker([alatitude, alongitude], {
                id: sessionStorage['id'],
                este: alongitude,
                norte: alatitude
              }).bindPopup("<strong>Responsable: </strong> " + sessionStorage['nombre'] + "<br>CI: <strong>" + sessionStorage['cedula'] + "</strong><br><a class=\"aMover\" onclick=\'editarDatos(\"" + sessionStorage['id'] + "\", \"" + alatitude + "\", \"" + alongitude + "\", \"" + sessionStorage['nombre'] + "\", \"" + sessionStorage['cedula'] + "\")\'><i class=\'line icon-note\'></i> Convertir en objeto editable</a>");
              casas.addLayer(pointx);

              toast('success', 'Actualizado correctamente')


            }


          }
        }).fail(function(jqXHR, textStatus, errorThrown) {
          if (jqXHR.status === 0) {
            alert('Not connect: Verify Network.');
          } else if (jqXHR.status == 404) {
            alert('Requested page not found [404]');
          } else if (jqXHR.status == 500) {
            alert('Internal Server Error [500].');
          } else if (textStatus === 'parsererror') {
            alert('Requested JSON parse failed.');
          } else if (textStatus === 'timeout') {
            alert('Time out error.');
          } else if (textStatus === 'abort') {
            alert('Ajax request aborted.');
          } else {
            alert('Uncaught Error: ' + jqXHR.responseText);
          }

        });









      });



      /*===================================================
                  AGREGAR POLIGONOS          
      ===================================================*/




      /* End map */
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


      function validarRespuestas(desc, cedula, id) {

        /* ** LIMPIAR DATOS ** */
        while (desc.indexOf(' ') != '-1') {
          desc = desc.replace(' ', '')
        }

        while (desc.length > 5) {
          desc = desc.slice(0, -1);
        }

        while (desc.indexOf(',,') != '-1') {
          desc = desc.replace(',,', ',')
        }

        var numeros = desc.split(',');

        /* ** LIMPIAR DATOS ** */




        if (desc == '' && cedula != '0') {
          return '<span style="color: red">Sin Respuesta</span>';
        } else if (desc.length == 1 || desc.length == 2) {
          return '<span style="color: red">Faltan Datos</span>';
        } else if (desc.length == 3 || desc.length == 4) {
          let response2

          if (desc.length == 4) {
            response2 = desc.slice(0, -1);
          }

          response2 = desc.split(',')

          if (response2[1] == '1') {
            return '<span style="color: red">Faltan Datos</span>';
          }

        } else if (desc.length == 5) {
          let response2 = desc.split(',')
          if (response2[1] != '1') {
            return '<span style="color: red">Incongruencia</span>';
          }

        }


        if (cedula != '0') {
          if (numeros[0] != '1' && numeros[0] != '2' && numeros[0] != '3' && numeros[0] != '4' && numeros[0] != '5') {
            return '<span style="color: red">Respuesta incorrecta</span>';
          }
          if (numeros[1] != '1' && numeros[1] != '2' && numeros[1] != '3' && numeros[1] != '4') {
            return '<span style="color: red">Respuesta incorrecta</span>';
          }
          if (numeros[1] == '1') {
            if (numeros[2] == '' || numeros[2] == undefined) {
              return '<span style="color: red">Faltan Datos</span>';
            }
            if (numeros[2] != '1' && numeros[2] != '2' && numeros[2] != '3' && numeros[2] != '4') {
              return '<span style="color: red">Respuesta incorrecta</span>';
            }
          }
        }

        return 'ok';
      }

      var cedulaEdita = '';
      var idEdita = '';

      function edit(id, desc, ced) {
        cedulaEdita = ced
        idEdita = id
        $('#respuesta').val(desc)
        $('#staticBackdrop').modal('toggle')
      }


      var valoresResultado = [];



      function setResponse() {

        let response = $('#respuesta').val()
        let id = idEdita;
        let cedula = cedulaEdita;

        if (validarRespuestas(response, cedula, id) == 'ok') {
          valoresResultado[id][3] = response

          let errores = parseInt($('#erroresE').html()) - 1;
          $('#erroresE').html(errores)
          $('#c-' + id).remove()
          if (errores == 0) {
            saveDef()
          }
          $('#staticBackdrop').modal('toggle')

        } else {
          toast('error', validarRespuestas(response, cedula, id))
        }





      }


      var valoresResultado = [];


      function saveDef() {

        let resultado = '';
        valoresResultado.forEach(element => {
          resultado = resultado + element + '*'
        });


        $.ajax({
            url: '../configuracion/importar-marcadores-bd.php',
            type: 'POST',
            dataType: 'html',
            data: {
              resultado: resultado,
              mcp: $('#mcp').val(),
              pq: $('#pq').val(),
              com: $('#com').val(),
              comd: $('#comdad').val(),
              tipo: 'm'
            },
          })
          .done(function(rePol) {





            valoresResultado.forEach(element => {


              let pasos = element[4]
              let longitude = element[2]
              let latitude = element[1]
              let nombre = 'No disponible'
              let cedula = element[0]

              var point = L.marker([latitude, longitude], {
                id: pasos,
                este: longitude,
                norte: latitude
              }).bindPopup("<strong>Responsable: </strong> " + nombre + "<br>CI: <strong>" + cedula + "</strong><br><a class=\"aMover\" onclick=\'editarDatos(\"" + pasos + "\", \"" + latitude + "\", \"" + longitude + "\", \"" + nombre + "\", \"" + cedula + "\")\'><i class=\'line icon-note\'></i> Convertir en objeto editable</a>");
              casas.addLayer(point);
            });

            $('#formulario').hide(300);
            $('#correccion').hide(300);
            $('#mapa').show(300);
            $('#finalizarBtn').show(300);
            toast('success', 'El archivo es correcto. Corrección de desplazamiento requerida.')
            //
          })
      }


      function deleteI(id) {



        Swal.fire({
          title: '¿Esta seguro?',
          confirmButtonText: 'Eliminar marcador',
          html: 'Se eliminará el marcador seleccionado.',
          icon: 'warning',
          showCancelButton: true,
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            delete(valoresResultado[id])
            $('#c-' + id).remove()
            console.log('Se elimino ' + id);

            let errores = parseInt($('#erroresE').html()) - 1;
            $('#erroresE').html(errores)

            let total = parseInt($('#cantidadMarcadores').html()) - 1;
            $('#cantidadMarcadores').html(total)

            if (errores == 0) {
              saveDef()
            }

          }
        })


      }


      $(document).ready(function(e) {
        $("#formData").on('submit', function(e) {

          $('.loading-container').show();

          e.preventDefault();
          let formData = new FormData(this);

          if ($('#comdad').val() == '') {
            toast('error', 'Rellene todos los campos');
            return;
          }

          console.log('Se incia el preceso de guardado')

          $('#guardarButton').attr('disabled', true);

          $.ajax({
            type: 'POST',
            url: '../configuracion/importar-marcadores.php',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(msg) {

              $('#guardarButton').attr('disabled', false);

              let resultado = msg.split('~')

              $('#cantidadMarcadores').html(resultado.length - 1);
              $('#erroresE').html('0');

              valoresResultado = [];
              let pasos = 0;
              let errores = 0;

              resultado.forEach(element => {
                if (pasos != 0) {

                  let subElement = element.slice(2);
                  subElement = subElement.slice(0, -2);
                  subElement = subElement.split('","')

                  let cedula = subElement[0];
                  let latitude = subElement[2]
                  let longitude = subElement[3]
                  let desc = subElement[6]
                  let nombre = subElement[7]


                  while (cedula.indexOf('.') != '-1') {
                    cedula = cedula.replace('.', '')
                  }


                  valoresResultado[pasos] = [cedula, latitude, longitude, desc, pasos]



                  let validacion = validarRespuestas(desc, cedula, pasos);


                  if (validacion != 'ok') {

                    errores += 1;

                    $('#rsultSection').append(`<tr id="c-` + pasos + `">
                              <td>#</td>
                              <td>` + cedula + `</td>
                              <td>` + nombre + `</td>
                              <td>` + desc + `</td>
                              <td>` + validacion + `</td>
                              <td><i onclick="edit('` + pasos + `', '` + desc + `', '` + cedula + `')" class="fa fa-pencil"></i> </td>
                              <td><i onclick="deleteI('` + pasos + `')" class="fa fa-trash"></i> </td>
                            </tr>`);
                  }

                  pasos += 1;


                } else {
                  pasos = 1;
                }
              });

              $('#erroresE').html(errores)
              if (errores == '0') {
                saveDef()
              } else {
                $('#statusE').html('<span style="color: red">Errores encontrados</span>')
              }
            }
          }).fail(function(jqXHR, textStatus, errorThrown) {
            if (jqXHR.status === 0) {
              alert('Not connect: Verify Network.');
            } else if (jqXHR.status == 404) {
              alert('Requested page not found [404]');
            } else if (jqXHR.status == 500) {
              alert('Internal Server Error [500].');
            } else if (textStatus === 'parsererror') {
              alert('Requested JSON parse failed.');
            } else if (textStatus === 'timeout') {
              alert('Time out error.');
            } else if (textStatus === 'abort') {
              alert('Ajax request aborted.');
            } else {
              alert('Uncaught Error: ' + jqXHR.responseText);
            }

          });

        });



        $("#csv").change(function() {
          var file = this.files[0];
          var imagefile = file.type;
          var match = "text/csv";
          if (!((imagefile == match))) {
            toast('error', 'Seleccione un archivo en formato CSV');
            return false;
          }
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