<?php
include('../configuracion/conexionMysqli.php');
include('../class/count.php');

if ($_SESSION['nivel'] != '') {


  $query = "SELECT * FROM sist_usuarios WHERE id='$_SESSION[id]' LIMIT 1";
  $search = $conexion->query($query);
  if ($search->num_rows > 0) {
    while ($row = $search->fetch_assoc()) {



?>




      <!DOCTYPE html>
      <html lang="en">

      <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/png" href="../assets/img/favicon.png">
        <title id="title">Perfil</title>

        <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
        <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
        <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
        <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/css/animate.css">
        <script src="../assets/js/jquery-3.6.0.min.js"></script>

        <script src="../assets/js/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="../assets/css/core.css">



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
                <h6 class="font-weight-bolder mb-0">Perfil de usuario</h6>
              </nav>
              <?php include('includes/header.php') ?>
            </div>
          </nav>
          <!-- End Navbar -->
          <div class="container-fluid py-4">


            <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/bg-profile.png');">
              <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
              <div class="row gx-4 mb-2">
                <div class="col-auto">
                  <div class="avatar avatar-xl position-relative">
                    <img style="aspect-ratio: 1/1;" src="../assets/img/user-pictures/<?php echo $row['id'] ?>.png" alt="profile_image" onerror="this.onerror=null; this.src='../assets/img/user-pictures/default.jpg'" class="w-100 border-radius-lg shadow-sm">
                    <div class="cintaBottomPerfil">
                      <i class="fa fa-edit" onclick="actualizarPerfilModal()" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>
                    </div>

                  </div>
                </div>
                <div class="col-auto my-auto">
                  <div class="h-100">
                    <h5 class="mb-1">
                      <?php echo $row['nombreUser'] ?>
                    </h5>
                    <p class="mb-0 font-weight-normal text-sm">
               
                    
                      <?php echo $row['responsabilidad'] ?>

                      <strong> - 
                        <?php 
                          echo $_SESSION["entidad"];
                        ?>
                      </strong>


                    </p>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                  <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                      <li class="nav-item" onclick="setVista()">
                        <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                          <i class="material-icons text-lg position-relative">Conversaciones</i>
                        </a>
                      </li>
                      <li class="nav-item" onclick="setVista()">
                        <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                          <i class="material-icons text-lg position-relative">Seguridad</i>
                        </a>
                      </li>

                    </ul>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="row">
                  <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                      <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Configuracion del perfil</h6>
                      </div>
                      <div class="card-body p-3">
                        <ul class="list-group">
                          <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">


                              <input class="form-check-input ms-auto" type="checkbox" onchange="setChechStatus('p_1')" id="p_1" <?php echo ($row['disponible_p'] == '0' ? 'checked' : '') ?> >
                              <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="p_1">Disponible para proyectos</label>
                            </div>




                          </li>
                          <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" onchange="setChechStatus('p_2')" id="p_2" <?php echo ($row['notificacion_c'] == '0' ? 'checked' : '') ?>>

                              <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="p_2">Enviar notificaciones al correo</label>
                            </div>
                          </li>
                       
                          
                        </ul>

                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">

                      <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Informacion del perfil

                        </h6>
                      </div>

                      <div class="card-body p-3">

                        <ul class="list-group">
                          <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nombre:</strong> &nbsp; <?php echo $row['nombreUser'] ?></li>
                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Teléfono:</strong> &nbsp; <?php echo $row['telefono'] ?></li>
                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Correo:</strong> &nbsp; <?php echo $row['usuario'] ?></li>

                          <?php

                          if ($row['nivel'] == 4) {
                            echo '  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Comuna:</strong> &nbsp; ' . $row['dato1'] . '</li>
                      <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Comunidad:</strong> &nbsp; ' . $row['dato2'] . '</li>
                      <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Responsabilidad:</strong> &nbsp; ' . $row['responsabilidad'] . '</li>';
                          } elseif ($row['nivel'] == 3) {
                            echo ' <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Empresa/Institución:</strong> &nbsp; ' . $row['dato2'] . '</li>
                     <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Rif:</strong> &nbsp; ' . $row['dato1'] . '</li>
                     <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Responsabilidad:</strong> &nbsp; ' . $row['responsabilidad'] . '</li>';
                          }

                          ?>



                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100 vistas" id="conversations">
                      <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Conversaciones</h6>
                      </div>
                      <div class="card-body p-3">
                        <ul class="list-group">
                          <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                            <div class="avatar me-3">
                              <img src="../assets/img/user-pictures/<?php echo $row['id'] ?>.png" onerror="this.onerror=null; this.src='../assets/img/user-pictures/default.jpg'" alt="kal" class="border-radius-lg shadow">
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">Lorem, ipsum.</h6>
                              <p class="mb-0 text-xs">Lorem ipsum dolor sit amet consectetur</p>
                            </div>
                            <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;"><i class="fa fa-reply"></i></a>
                          </li>

                        </ul>
                      </div>
                    </div>
                    <div class="card card-plain h-100 vistas" id="security" style="display: none;">
                      <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Seguridad</h6>
                      </div>
                      <div class="card-body p-3">

                        <label style="margin-bottom: 0;" for="pass_a" style="white-space: nowrap;" class="label-control">Constraseña actual</label>
                        <div class="input-group input-group-outline mb-3">
                          <input type="password" class="form-control" id="pass_a">
                        </div>

                        <label style="margin-bottom: 0;" for="pass_n" style="white-space: nowrap;" class="label-control">Nueva constraseña</label>
                        <div class="input-group input-group-outline mb-3">
                          <input type="password" class="form-control" id="pass_n">
                        </div>



                        <div class="progress mt-2">
                          <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="passstrength">
                          </div>
                        </div>




                        <label style="margin-bottom: 0;" for="pass_r" style="white-space: nowrap;" class="label-control">Repetir constraseña</label>
                        <div class="input-group input-group-outline mb-3">
                          <input type="password" class="form-control" id="pass_r">
                        </div>

                        <button class="btn btn-primary" onclick="uptpass()">Actualizar</button>


                      </div>
                    </div>

                    <!-- Button trigger modal -->


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <form id="formElem" enctype="multipart/form-data">

                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Foto de la cuenta</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="mb-3">
                                <label for="foto" class="form-label">Subir foto de perfil</label>
                                <input class="form-control" type="file" id="foto" accept=".png, .jpg, .jpeg" name="foto[]">
                              </div>


                            </div>
                            <div class="modal-footer">
                              <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                              <button type="submit" id="guardarButton" onclick="updateFoto()" class="btn btn-primary">Actualizar</button>
                            </div>

                          </form>
                        </div>
                      </div>
                    </div>

                  </div>

                </div>
              </div>
            </div>
          </div>

          </div>

          <!--   Core JS Files   -->
          <script src="../assets/js/core/popper.min.js"></script>
          <script src="../assets/js/core/bootstrap.min.js"></script>
          <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
          <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
          <script src="../class/alertas.js"></script>
          <link rel="stylesheet" href="../assets/vendor/strength/strength.css" />
          <script src="../assets/vendor/strength/strength.min.js"></script>
          <script>
            function setChechStatus(check) {
              
              let status = document.getElementById(check).checked

              if (status) {
                status = 0;
              }else{
                status = 1;
              }

              $.get("../back/perfil_setcheck.php", "c=" + check + "&s=" + status, function(data) {
                  toast("success", "Se actualizo la configuración correctamente" + data.trim());
              });

            }

            //'disponible_p'

            $(document).ready(function(e) {

              //file type validation
              $("#foto").change(function() {
                var file = this.files[0];
                var imagefile = file.type;
                var match = ["image/jpeg", "image/png", "image/jpg"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                  toast('error', 'Seleccione un formato valido (JPEG/JPG/PNG)');
                  $("#foto").val('');
                  return false;
                }
              });


              $("#formElem").on('submit', function(e) {

                $('#guardarButton').attr('disabled', true);
                e.preventDefault();

                let formData = new FormData(this);

                if ($("#foto").val().length < 1) {
                  toast('error', 'Seleccione una imagen');
                  return false;
                }



                $.ajax({
                  type: 'POST',
                  url: '../back/perfil_foto.php',
                  data: formData,
                  contentType: false,
                  cache: false,
                  processData: false,
                  success: function(msg) {
                    if (msg.trim() == 'ok') {
                      location.reload()
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
            });
            var pass;
            $(document).ready(function() {
              $("#pass_n").keyup(function() {
                fuerza(this.value)
              });
            });


            function fuerza(value) {

              var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
              var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
              var enoughRegex = new RegExp("(?=.{6,}).*", "g");

              if (false == enoughRegex.test(value)) {
                $('#passstrength').html('');
                $('#passstrength').width('0%');
                pass = '0';
              } else if (strongRegex.test(value)) {
                $('#passstrength').width('100%');
                $('#passstrength').html('Fuerte');
                pass = '100';
              } else if (mediumRegex.test(value)) {
                $('#passstrength').width('50%');
                $('#passstrength').html('Media');
                pass = '50';
              } else {
                $('#passstrength').width('25%');
                $('#passstrength').html('Debil');
                pass = '25';
              }
            }



            function uptpass() {
              let pass_a = $('#pass_a').val()
              let pass_n = $('#pass_n').val()
              let pass_r = $('#pass_r').val()

              if (pass_n != pass_r) {
                toast('error', 'Las contraseñas no  coinciden')
                return
              }

              if (pass != '100') {
                toast("error", "La contraseña debe tener al menos una (1) mayúscula, un (1) numero y un (1) carácter especial.");
                return;
              }
              $.ajax({
                  url: 'consultasAjax/users/uptpass.php',
                  type: 'POST',
                  dataType: 'html',
                  data: {
                    pass_a: pass_a,
                    pass_n: pass_n
                  },
                })
                .done(function(rePol) {
                  if (rePol.trim() == 'E_P') {
                    toast('error', 'La contraseña actual no es correcta')
                  } else if (rePol.trim() == '1') {
                    $('.form-control').val('')
                    $('#passstrength').html('');
                    $('#passstrength').width('0%');
                    toast('success', 'Actualizado correctamente')
                  }

                })


            }



            function setVista() {
              $('#conversations').toggle(300)
              $('#security').toggle(300)
            }


            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
              var options = {
                damping: '0.5'
              }
              Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
          </script>
          <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
      </body>

      </html>

<?php

    }
  }
} else {




  define('PAGINA_INICIO', '../index.php');
  header('Location: ' . PAGINA_INICIO);
}
?>