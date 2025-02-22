<?php
include('../configuracion/conexionMysqli.php');
include('../class/count.php');

unset($_SESSION['proyecto']);
if ($_SESSION['nivel'] != '') {

  $idUser = $_SESSION['id'];

?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title class="cartografia" id="title">
      Proyectos GITCOM
    </title>
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <style>
      .list-group-item {
        cursor: pointer;
      }

      .list-group-item:hover {
        filter: brightness(0.9);
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
            <h6 class="font-weight-bolder mb-0">Proyectos</h6>
          </nav>
          <?php include('includes/header.php') ?>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-lg-5 mb-3">
            <div class="card" style="min-height: 238px;">
              <div class="card-body d-flex justify-content-center flex-wrap ps-xl-15 pe-0">
                <div class="flex-grow-1 me-9 me-md-0">
                  <h3 class="position-relative fw-bold mb-2">
                    Reportes descargables
                  </h3>
                  <span class="fw-semibold fs-5  mb-4 d-block">
                    Crea un proyecto con múltiples archivos
                    <br>
                    descargabale en formato xls o pdf.
                  </span>
                  <button data-bs-toggle="modal" data-bs-target="#ModalReporte" class="btn btn-sm btn-primary fw-semibold ">
                    Crear proyecto
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-7 mb-3">
            <div class="card" style="min-width: 238px;">
              <div class="card-body d-flex justify-content-center flex-wrap ps-xl-15 pe-0">
                <!--begin::Wrapper-->
                <div class="flex-grow-1 me-9 me-md-0">
                  <h3 class="position-relative fw-bold mb-2">
                    Consulta rapida
                  </h3>

                  <span class="text-gray-600 fw-semibold fs-5 mb-4 d-block">
                    Realice una consulta usando el mapa sin la
                    <br>
                    necesidad de crear un proyecto.
                  </span>

                  <a href="mapa/" class="btn btn-sm btn-primary fw-semibold ">
                    Ir al mapa
                  </a>
                </div>

                <img src="../assets/img/Paper-map-pana.svg" class="me-4" width="190px">
              </div>
            </div>









          </div>



        </div>

        <div class="row py-4 ">

          <div class="col-lg-7">
            <hr>
          </div>
          <div class="col-lg-5 text-end">
            <?php
            if ($_SESSION['nivel'] != '3') {
              echo '<a href="consultar_comunidades" class="btn btn-default">Consultar comunidades</a>';
            } else
            ?>

            <a href="cartografia_nuevo_proyecto" class="btn btn-primary"> Crear </a>
          </div>
        </div>


        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="ventana-header pb-0 px-3">

                <div class="card-title flex-column">
                  <h5 class="fw-bold mb-1" style="font-size: 17.5px;">Tus proyectos</h5>

                  <div class="fs-5" style=" color: #B5B5C3 !important; font-weight: 600; font-size: 12.4px !important;">
                    PRIV: <?php echo number_format(contar2('proyectos', 'user=' . $idUser . ' AND tipo=1'), '0', '.', '.') ?> -
                    PÚBL: <?php echo number_format(contar2('proyectos', 'user=' . $idUser . ' AND tipo=2'), '0', '.', '.') ?>
                  </div>
                </div>

              </div>
              <div class="card-body p-3 min-vh-50">

                <div class="table-responsive">
                  <!--begin::Table-->
                  <table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 fw-bold" style="min-height: 30vh;">
                    <thead class="fs-7 text-gray-400 text-uppercase">
                      <tr>
                        <th class="min-w-150px"></th>
                        <th class="min-w-250px">Nombre</th>
                        <th class="min-w-90px">Colaboradores</th>
                        <th class="min-w-90px">Tipo</th>
                        <th class="min-w-50px text-end"></th>
                      </tr>
                    </thead>
                    <tbody class="fs-5">




                      <?php

                      $queryyy4 = "SELECT * FROM proyectos WHERE user='$idUser'";
                      $buscarM4 = $conexion->query($queryyy4);
                      if ($buscarM4->num_rows > 0) {
                        while ($row4 = $buscarM4->fetch_assoc()) {

                          $id = $row4['id'];





                          echo '<tr id="p_' . $row4['id'] . '">
                          
                      <td class="text-center" style="color: #585b65" class="fs-5" >' . ($row4['tipo'] == '2' ? '<i title="Público" class="fa fa-unlock"></i>' : '<i title="Privado" class="fa fa-lock"></i>') . '</td>
                      <td>
                     
                        <div class="d-flex align-items-center">

                          <div class="d-flex flex-column justify-content-center">
                            <span class="fs-5" style="color: #585b65">' . $row4['nombre'] . '</span>

                            <div class="fw-semibold text-gray-400">' . date('Y-m-d h:i a', $row4['ultimoCambio']) . '</div>
                          </div>
                        </div>
                      </td>';


                          $queryCob = "SELECT proyectos_colaboradores.user, sist_usuarios.nombreUser FROM proyectos_colaboradores LEFT JOIN sist_usuarios ON proyectos_colaboradores.user = sist_usuarios.id WHERE proyecto='$id'";
                          $searchCob = $conexion->query($queryCob);
                          if ($searchCob->num_rows > 0) {
                            echo '<td><div class="avatar-group">';
                            while ($rowCob = $searchCob->fetch_assoc()) {
                              echo '<a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="' . $rowCob['nombreUser'] . '">
                               <img alt="Image placeholder" src="../assets/img/user-pictures/' . $rowCob['user'] . '.png" onerror="this.onerror=null; this.src=\'../assets/img/user-pictures/default.jpg\'">
                             </a>';
                            }
                            echo '</div></td>';
                          } else {
                            echo '<td></td>';
                          }



                          if ($row4['reporte'] == '1') {
                            echo '<td>
                      <span class="badge bg-success">REPORTE XLS </span>
                    </td>';
                          } else {
                            echo '<td>
                      <span class="badge bg-danger">MAPA GITCOM</span>
                    </td>';
                          }


                          echo '
                      <td class="text-center">
                      
                      <div class="btn-group dropend">
                        <i type="button" class="fa fa-ellipsis-v" data-bs-toggle="dropdown" aria-expanded="false">
                        </i>
                        <ul class="dropdown-menu">
                        <li class="item">';

                          if ($row4['reporte'] == '1') {
                            echo '<a  href="consultasDescargables.php?codigo=' . $row4['id'] . '"  class="btn btn-link text-dark px-3 mb-0"><i class="fa fa-folder-open text-sm me-2"></i>Abrir</a>';
                          } else {
                            echo '<a  href="mapa/index.php?codigo=' . $row4['id'] . '"  class="btn btn-link text-dark px-3 mb-0"><i class="fa fa-folder-open text-sm me-2"></i>Abrir</a>';
                          }

                          echo '
                        </li>
                        <li class="item"> 
                        <a onclick="eliminarProyecto(\'' . $row4['id'] . '\')" class="btn btn-link text-danger text-gradient px-3 mb-0"><i class="fa fa-trash text-sm me-2"></i>Eliminar</a>
                        </li>
                        </ul>
                      </div>

                      </td>
                    </tr>';
                        }
                      } else {
                        echo '<p class="ntp">Los proyectos en los que participes se mostraran aquí</p>';
                      }

                      ?>


                    </tbody>
                  </table>
                </div>

                <style>
                  .table thead th {
                    padding: 8px !important;
                    color: #B5B5C3 !important;
                    text-transform: uppercase;
                    font-size: 12.4px !important;
                  }

                  td {
                    font-size: 13px !important;
                  }

                  table {
                    padding-top: 0;
                  }
                </style>

              </div>
            </div>
          </div>




          <div class="col-lg-4 ">

            <div class="card h-100 mb-4">
              <div class="ventana-header pb-0 px-3">
                <div class="row">
                  <div class="col-md-12">
                    <?php
                    if ($_SESSION["nivel"] == '1') {
                      echo '<h6 class="mb-0">Proyectos de los usuarios</h6>';
                    } else {
                      echo '<h6 class="mb-0">Proyectos públicos</h6>';
                    }
                    ?>


                  </div>

                </div>
              </div>
              <div class="card-body pt-4 p-3">
                <ul class="list-group" data-bs-toggle="modal" data-bs-target="#exampleModal">

                  <?php
                  $tabla = '';
                  if ($_SESSION["nivel"] == '1') {
                    $queryyy = "SELECT proyectos.id, proyectos.nombre, proyectos.ultimoCambio, sist_usuarios.nombreUser, proyectos.id, proyectos.tipo, proyectos.descripcion FROM proyectos 
                LEFT JOIN sist_usuarios ON proyectos.user = sist_usuarios.id WHERE user!='$idUser'";
                  } else {
                    $queryyy = "SELECT proyectos.id, proyectos.nombre, proyectos.ultimoCambio, sist_usuarios.nombreUser, proyectos.id, proyectos.tipo, proyectos.descripcion FROM proyectos 
               LEFT JOIN sist_usuarios ON proyectos.user = sist_usuarios.id WHERE tipo='2' AND user!='$idUser'";
                  }



                  $buscarM = $conexion->query($queryyy);
                  if ($buscarM->num_rows > 0) {
                    while ($row = $buscarM->fetch_assoc()) {

                      $tipo = ($row['tipo'] == "2" ? 'Público' : 'Privado');
                      $part = contar('proyectos_colaboradores', $row['id'], 'proyecto');

                      $tabla .= '<li onclick="viewProject(\'' . $row['id'] . '\', \'' . $row['nombre'] . '\',  \'' . $row['descripcion'] . '\', \'' . $part . '\', \'' . date('Y-m-d h:i a', $row['ultimoCambio']) . '\', \'' . $row['nombreUser'] . '\', \'' . $tipo . '\')" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                              <div style="margin: 0 10px">
                                <img  src="../assets/img/capaGitcom2.png"  class="avatar avatar-profile" alt="Logo GITCOM">
                              </div>
                              <div class="d-flex flex-column">
                                <h6 class="mb-1 text-dark text-sm">' . $row['nombre'] . '</h6>
                                <span class="text-xs">' . $row['nombreUser'] . ' - ' . date('Y-m-d h:i a', $row['ultimoCambio']) . '</span>
                              </div>
                            </div>
                     
                       </li>';
                    }
                  }
                  echo $tabla;

                  ?>




                </ul>

              </div>
            </div>


            <script>
              function viewProject(id, nombre, desc, part, lastc, user, tipo) {

                $('#infoProyecto').html(`<p>
                    Creador: <strong>` + user + `</strong><br>
                    Nombre del proyecto: <strong>` + nombre + `</strong><br>
                    Descripción: <strong>` + desc + `</strong><br>
                    Tipo de proyecto: <strong>` + tipo + `</strong><br>
                    Cantidad de participantes: <strong>` + part + `</strong><br>
                    Ultima modificación: <strong>` + lastc + `</strong>
                  </p>`)

                $('#abrirmapP').attr('href', 'mapa/index?codigo=' + id)
              }
            </script>


            <!-- Modal -->
            <div class="modal fade" id="ModalReporte" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                  <div class="modal-header">
                    <h5 class="modal-title">Crear reportes descargable</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="modal-body">

                    <div class="mb-3 ">
                      <label for="nombreArchivo" class="form-label">Nombre del proyecto</label>
                      <input type="text" class="form-control" id="nombreArchivo">
                    </div>

                    <div class="mb-3 ">
                      <label for="tipoEstatusX" class="form-label">Tipo</label>
                      <select id="tipoEstatusX" class="form-control">
                        <option value="">Seleccione</option>
                        <option value="1">Privado</option>
                        <option value="2" disabled>Público</option>
                      </select>
                    </div>





                  </div>
                  <div class="modal-footer">
                    <a class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                    <a onclick="crearArchivoDescargable()" class="btn btn-primary">Crear</a>
                  </div>

                </div>
              </div>
            </div>






            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Información del proyecto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="modal-body">
                    <section id="infoProyecto">



                    </section>

                  </div>
                  <div class="modal-footer">
                    <a class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                    <a id="abrirmapP" class="btn btn-primary">Abrir</a>
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
    <script>
      function crearArchivoDescargable() {
        let nombreArchivo = $('#nombreArchivo').val()
        let tipoEstatusX = $('#tipoEstatusX').val()

        if (nombreArchivo == '' || tipoEstatusX == '') {
          toast('error', 'Rellene todos los campos.')
          return;
        }

        $.ajax({
          url: 'consultasAjax/nuevoProyectoXls.php',
          type: 'POST',
          dataType: 'html',
          data: {
            nombreArchivo: nombreArchivo,
            tipoEstatusX: tipoEstatusX
          },
        }).done(function(response) {
          if (response != 'error') {
            window.open("consultasDescargables.php?codigo=" + response.trim(), "_self");
          }
        })




      }

      function eliminarProyecto(id) {


        Swal.fire({
          title: '¿Está seguro?',
          html: 'Se eliminara el proyecto y toda la información relacionada.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#ed5264',
          cancelButtonColor: '#a9a9a9',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Continuar'
        }).then((result) => {
          if (result.isConfirmed) {

            $.get("../back/cartografia_eliminar_proyecto.php", "id=" + id, function(data) {
              if (data.trim() == '0') {
                toast("success", "El proyecto se eliminó correctamente");
                $('#p_' + id).remove()
              }
            });
          }
        })


      }



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