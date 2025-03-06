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
  var arrayResultado = []
  var arrayNudos = [];
  var arrayComparaciones = [];
  var arrayMaximos = []
</script>
<?php
include('../configuracion/conexionMysqli.php');

if ($_SESSION['nivel'] == 1) {



  $aca = $_GET['aca'];

  if ($aca == '') {
    define('PAGINA_INICIO', '../nuevoAca.php');
    header('Location: ' . PAGINA_INICIO);
  }




  $queryyy = "select * from aca_mapa WHERE problema = '$aca' AND tipo='n'";
  $buscarM = $conexion->query($queryyy);
  if ($buscarM->num_rows > 0) {
    while ($fila = $buscarM->fetch_assoc()) {
      $nudo = $fila['nombre'];
      echo '<script>
      arrayNudos.push("' . $nudo . '");
    </script>';
    }
  }



  function validarExistencia()
  {
    global $conexion;
    global $aca;
    $queryyy = "select * from aca_graficos WHERE problema = '$aca'";
    $buscarM = $conexion->query($queryyy);
    if ($buscarM->num_rows > 0) {
      return 1;
    } else {
      return 0;
    }
  }

  if (validarExistencia() == 1) {
    /*  define('PAGINA_INICIO', 'nuevoAca.php');
    header('Location: ' . PAGINA_INICIO);*/
  }
?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/SLS.png">
    <title class="home" id="title">Registro del aca</title>


    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>

    <link rel="stylesheet" href="../assets/css/jquery.lineProgressbar.css">
    <script src="../assets/js/jquery.lineProgressbar.js"></script>

    <style>
      .form-control {
        padding: 5px !important;
      }

      .hide {
        display: none;
      }

      #mynetwork {
        width: 100%;
        height: 95%;
        cursor: all-scroll;
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

        <div class="row mb-4">
          <div class="col-lg-7" id="divGra">
            <div class="card" style="overflow: hidden;">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-12 col-7">
                    <h6>Gráfico de decisión</h6>
                    </h6>
                  </div>
                  <hr>
                </div>
              </div>
              <div class="card-body px-0 pb-2" style="margin-top: -20px;">
                <div class="row" style="padding: 5px 28px 0px 28px; height: 70vh;">
                  <input type="text" id="nodos" hidden>
                  <input type="text" id="vinculosI" hidden>

                  <div id="mynetwork"></div>
                </div>
                <div style="padding: 0 20px 10px;" id="2">

                  <span id="tablaVinculos"></span>
                </div>


              </div>
            </div>
          </div>

          <div class="col-lg-5" id="divVin">
            <div class="col-lg-12" id="1">
              <div class="card" style="max-height: 85vh; overflow: auto;">
                <div class="card-header pb-0">
                  <div class="row">
                    <div class="col-lg-12 col-7">
                      <h6>Vinculos</h6>
                    </div>
                    <hr>
                  </div>
                </div>
                <div class="card-body px-0 pb-2" style="margin-top: -20px;  overflow-x: hidden;">
                  <div class="row">
                    <div class="col-lg-12" style="padding: 0 35px;" id="zonaPregunta">
                      <div aria-labelledby="swal2-title" aria-describedby="swal2-html-container" class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: grid;">

                        <div class="swal2-icon swal2-question swal2-icon-show" id="question" style="display: flex;">
                          <div class="swal2-icon-content">?</div>
                        </div>
                        <h2 class="swal2-title" id="swal2-title">
                          <span id="nudo1" style="color: #182c43;"></span> <br>
                          <span id="nudo2" style="color: #e93f3f;"></span>

                        </h2>

                        <div class="swal2-html-container" id="swal2-html-container">
                          ¿Existe algun vinculo entre estos nudos crticos?
                        </div>

                        <input type="text" id="indexVinculados" value="0" hidden>
                        <div class="swal2-actions" style="display: flex;">
                          <button type="button" onclick="procesarPregunta(1, 1)" class="btn btn-danger">Vinculo</button>
                          <button type="button" onclick="procesarPregunta(1, 2)" style="margin-left: 15px; margin-right: 15px;" class="btn btn-info">Vinculo dudoso</button>
                          <button type="button" onclick="procesarPregunta(1, 0)" class="btn btn-dark">Ninguno</button>
                        </div>

                      </div>
                    </div>
                    <div>
                    </div>
                  </div>
                </div>
                <div id="progress" data-init="true"></div>

              </div>
            </div>




            <div class="col-lg-12" id="problemaYente" style="display: none;">
              <div class="card">
                <div class="card-header pb-0">
                  <div class="row">
                    <div class="col-lg-12 col-7">
                      <h6>Solución</h6>
                    </div>
                    <hr>
                  </div>
                </div>
                <div class="card-body px-0 pb-2" style="margin-top: -20px;  overflow-x: hidden;">
                  <div class="row">
                    <div class="col-lg-12" style="padding: 0 35px;">

                      <label style="margin-bottom: 0;" for="solucion" style="white-space: nowrap;" class="label-control">Solucion</label>
                      <div class="input-group input-group-outline my-3">
                        <textarea class="form-control" rows="15" id="solucion"></textarea>
                      </div>



                      <label style="margin-bottom: 0;" for="adquirir" style="white-space: nowrap;" class="label-control">Insumos necesarios</label>
                      <div class="input-group input-group-outline my-3">
                        <textarea class="form-control" rows="2" id="adquirir"></textarea>
                      </div>





                      <label style="margin-bottom: 0;" for="financiero" style="white-space: nowrap;" class="label-control">Ente financiero</label>
                      <div class="input-group input-group-outline my-3">
                        <input class="form-control" id="financiero">
                      </div>

                      <label style="margin-bottom: 0;" for="acompanante" style="white-space: nowrap;" class="label-control">Ente acompañante</label>
                      <div class="input-group input-group-outline my-3">
                        <input class="form-control" id="acompanante">
                      </div>

                      <div>
                      </div>
                      <button style="float: right;" class="btn btn-danger" onclick="finalizar()">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>




            </div>
            <script>

            </script>
            <script>
              function comparar(key) {
                let start = key - 1;
                for (let index = start; index >= 0; index--) {
                  arrayComparaciones.push([arrayNudos[key], arrayNudos[index]])
                }
              }

              for (let i = 0; i <= arrayNudos.length - 1; i++) {
                comparar(i)
              }
            </script>

          </div>
          <?php include('notificacion.php'); ?>

        </div>
    </main>

    <script>
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })



      var nodes, edges, network;
      // convenience method to stringify a JSON object
      function toJSON(obj) {
        return JSON.stringify(obj, null, 4);
      }

      function addNode(id, label, fijo) {
        try {
          nodes.add({
            id: id,
            label: label,
            shape: 'box',
            title: 'descripcion nudo critico',
          });
        } catch (err) {
          alert(err);
        }
      }

      function updateNode() {
        try {
          nodes.update({
            id: document.getElementById("node-id").value,
            label: document.getElementById("node-label").value
          });
        } catch (err) {
          alert(err);
        }
      }

      function removeNode() {
        try {
          nodes.remove({
            id: document.getElementById("node-id").value
          });
        } catch (err) {
          alert(err);
        }
      }

      function addEdge(id, desde, hasta, tipo) {
        try {
          edges.add({
            id: id,
            from: desde,
            to: hasta,
            dashes: tipo
          });
        } catch (err) {
          alert(err);
        }
      }

      function updateEdge() {
        try {
          edges.update({
            id: document.getElementById("edge-id").value,
            from: document.getElementById("edge-from").value,
            to: document.getElementById("edge-to").value,
          });
        } catch (err) {
          alert(err);
        }
      }

      function removeEdge() {
        try {
          edges.remove({
            id: document.getElementById("edge-id").value
          });
        } catch (err) {
          alert(err);
        }
      }

      function draw() {
        // create an array with nodes
        nodes = new vis.DataSet();
        nodes.on("*", function() {

          let value = JSON.stringify(
            nodes.get()
          );
          document.getElementById("nodos").value = value;

        });

        // create an array with edges
        edges = new vis.DataSet();
        edges.on("*", function() {

          let value = JSON.stringify(
            edges.get()
          );

          document.getElementById("vinculosI").value = value;

        });

        // create a network
        var container = document.getElementById("mynetwork");
        var data = {
          nodes: nodes,
          edges: edges,
        };
        //var options = {physics: { enabled: true, wind: { x: -1, y: 0 } } };
        var options = {
          physics: {
            enabled: true,
            barnesHut: {
              gravitationalConstant: -14000,
              centralGravety: 1,
              damping: 0.5
            },
            adaptiveTimestep: true
          }
        };

        network = new vis.Network(container, data, options);
      }


      window.addEventListener("load", () => {
        draw();


        let index = 0;
        arrayNudos.forEach(element => {
          index++;
          if (index == 1) {
            addNode(element, element, true)
          } else {
            addNode(element, element, false)
          }
        });
      });



      function finalizar() {
        //recuperar el contenido de un textarea
        let financiero = document.getElementById("financiero").value;
        let acompanante = document.getElementById("acompanante").value;
        let solucion = document.getElementById("solucion").value;
        let adquirir = document.getElementById("adquirir").value;
        let id = "<?php echo $_GET['aca'] ?>"
        // verificar que ningun campo este vacio
        if (financiero == '' || acompanante == '' || solucion == '' || adquirir == '') {
          Toast.fire({
            icon: 'error',
            title: 'Información imcompleta'
          })
          return;
        }


        $.ajax({
            url: 'consultasAjax/guardarResponsableYsolucion.php',
            type: 'POST',
            dataType: 'html',
            data: {
              financiero: financiero,
              acompanante: acompanante,
              solucion: solucion,
              adquirir: adquirir,
              id: id
            },
          })
          .done(function(rePol) {

            Swal.fire({
              title: 'Buen trabajo',
              html: 'La agenda concreta de accion de su consejo comunal fue registrada con exito',
              icon: 'success',
              confirmButtonText: 'ok'
            }).then((result) => {
              window.location.href = "nuevoAca.php";
            })
          })

      }



      //incio
      //incio
      //incio
      //incio
      //incio

      function end() {
        $('#divGra').removeClass('col-lg-7')
        $('#divGra').addClass('col-lg-8')

        $('#divVin').removeClass('col-lg-5')
        $('#divVin').addClass('col-lg-4')
        $('#1').hide()
        $('#2').show()



        econtrarFoco()
        $('#problemaYente').show(300)

        let progress = $('#progress').LineProgressbar({
          percentage: 100
        });
      }

      function procesarPregunta(index, tipo) {
        if (tipo == 2) {
          dash = true
        } else {
          dash = false
        }
        var valueInput = $('#indexVinculados').val();


        if (arrayComparaciones[valueInput] == undefined) {
          end()

          return
        }

        var nudo1 = arrayComparaciones[valueInput][0];
        var nudo2 = arrayComparaciones[valueInput][1];

        var vinc = 0;
        var dudo = 0;


        if (index != 0) {

          if (tipo != 0) {
            addEdge(valueInput, nudo1, nudo2, dash)

            if (dash == true) {
              dudo = 1;
            } else {
              vinc = 1;
            }

            if (!arrayResultado[nudo1]) {

              arrayResultado[nudo1] = [nudo1, dudo, vinc]
            } else {
              var preDud = dudo + arrayResultado[nudo1][1];
              var preVic = vinc + arrayResultado[nudo1][2];

              arrayResultado[nudo1] = [nudo1, preDud, preVic]
            }

            if (!arrayResultado[nudo2]) {
              arrayResultado[nudo2] = [nudo2, dudo, vinc]
            } else {
              var preDud = dudo + arrayResultado[nudo2][1];
              var preVic = vinc + arrayResultado[nudo2][2];
              arrayResultado[nudo2] = [nudo2, preDud, preVic]
            }
            // updateTable()
          }

          var nextVinculo = parseInt(valueInput) + 1;


          $('#indexVinculados').val(nextVinculo)

          if (nextVinculo != arrayComparaciones.length) {
            $('#question').html('<div class="swal2-icon-content">?</div>')
            $('#nudo1').html(arrayComparaciones[nextVinculo][0])
            $('#nudo2').html(arrayComparaciones[nextVinculo][1])

          }

        } else {

          $('#nudo1').html(nudo1)
          $('#nudo2').html(nudo2)
        }




        if (nextVinculo != undefined) {
          let porcentaje = nextVinculo * 100 / arrayComparaciones.length
          if (porcentaje == 100) {
            end()
          }
          if (porcentaje != 'NaN') {

            let progress = $('#progress').LineProgressbar({
              percentage: porcentaje
            });
          }
        }

      }
      // fin
      // fin
      // fin
      // fin
      // fin
      // fin





      function updateTable() {
        $('#tablaVinculos').html('')

        let claves = Object.keys(arrayResultado);

        claves.forEach(element => {
          let clave = arrayResultado[element];

          $('#tablaVinculos').html($('#tablaVinculos').html() + '<tr id="' + clave[0] + '"><td>' + clave[0] + '</td><td>' + clave[1] + '</td><td>' + clave[2] + '</td></tr>')
        });
      }
      procesarPregunta(0, 0)



      function econtrarFoco() {
        // encontrar los valor mas alto en un array

        let claves = Object.keys(arrayResultado);
        var max = 0;

        claves.forEach(element => {
          let clave = arrayResultado[element];

          if (clave[2] > max) {
            max = clave[2]
            arrayMaximos = []
            arrayMaximos.push(clave[0])
          } else if (clave[2] == max) {
            arrayMaximos.push(clave[0])
          }
        });


        if (arrayMaximos.length > 1) {
          $('#tablaVinculos').html('<hr><strong>Focos encontrados:</strong> ');
        } else if (arrayMaximos.length == 1) {
          $('#tablaVinculos').html('<hr><strong>Foco encontrado:</strong> ');
        }


        arrayMaximos.forEach(value => {

          $('#tablaVinculos').html($('#tablaVinculos').html() + value + ', ');
          nodes.update({
            id: value,
            label: value,
            color: 'rgb(230 79 96)',
            font: {
              color: "white"
            }
          });

        });

        let resultado = $('#tablaVinculos').html();
        resultado = resultado.substring(0, resultado.length - 2);
        $('#tablaVinculos').html(resultado)




        guardarDatos()

      }


      function guardarDatos(params) {
        let nodos = $('#nodos').val()
        let vinculosI = $('#vinculosI').val()
        let id = "<?php echo $_GET['aca'] ?>"

        $.ajax({
            url: 'consultasAjax/guardarNodos.php',
            type: 'POST',
            dataType: 'html',
            data: {
              nodos: nodos,
              vinculosI: vinculosI,
              id: id
            },
          })
          .done(function(rePol) {
            Toast.fire({
              icon: 'success',
              title: 'Informacion guardada, es hora de proponer una solución'
            })
          })
      }
    </script>


    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
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