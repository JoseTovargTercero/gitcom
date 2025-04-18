<?php
include('../configuracion/conexionMysqli.php');



if ($_SESSION["status"] != 0) {
  define('PAGINA_INICIO', '../index.php');
  header('Location: ' . PAGINA_INICIO);
}




if ($_SESSION['nivel'] != '') {

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/SLS.png">
    <title id="title">Actualización del perfil</title>


    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <script src="../assets/js/sweetalert2.all.min.js"></script>

  </head>

  <body class="g-sidenav-show  bg-gray-200">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
      <!-- Navbar -->
      <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Gitcom</a></li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Datos del usuario</h6>
          </nav>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid py-4">


        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/bg-profile.png');">
          <span class="mask  bg-gradient-primary  opacity-6"></span>
        </div>
        <div class="card card-body mx-3 mx-md-4 mt-n6">

          <div class="row">
            <div class="row">
              <div class="col-12 col-xl-4">
                <div class="card card-plain h-100">
                  <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Platform Settings</h6>
                  </div>
                  <div class="card-body p-3">
                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">Account</h6>
                    <ul class="list-group">
                      <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                          <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault" checked>
                          <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault">Email me when someone follows me</label>
                        </div>
                      </li>
                      <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                          <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault1">
                          <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault1">Email me when someone answers on my post</label>
                        </div>
                      </li>
                      <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                          <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault2" checked>
                          <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault2">Email me when someone mentions me</label>
                        </div>
                      </li>
                    </ul>
                    <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Application</h6>
                    <ul class="list-group">
                      <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                          <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault3">
                          <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault3">New launches and projects</label>
                        </div>
                      </li>
                      <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                          <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault4" checked>
                          <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault4">Monthly product updates</label>
                        </div>
                      </li>
                      <li class="list-group-item border-0 px-0 pb-0">
                        <div class="form-check form-switch ps-0">
                          <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault5">
                          <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault5">Subscribe to newsletter</label>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-12 col-xl-4">
                <div class="card card-plain h-100">
                  <div class="card-header pb-0 p-3">
                    <div class="row">
                      <div class="col-md-8 d-flex align-items-center">
                        <h6 class="mb-0">Profile Information</h6>
                      </div>
                      <div class="col-md-4 text-end">
                        <a href="javascript:;">
                          <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-3">
                    <p class="text-sm">
                      Hi, I’m Alec Thompson, Decisions: If you can’t decide, the answer is no. If two equally difficult paths, choose the one more painful in the short term (pain avoidance is creating an illusion of equality).
                    </p>
                    <hr class="horizontal gray-light my-4">
                    <ul class="list-group">
                      <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; Alec M. Thompson</li>
                      <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; (44) 123 1234 123</li>
                      <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; alecthompson@mail.com</li>
                      <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; USA</li>
                      <li class="list-group-item border-0 ps-0 pb-0">
                        <strong class="text-dark text-sm">Social:</strong> &nbsp;
                        <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                          <i class="fab fa-facebook fa-lg"></i>
                        </a>
                        <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                          <i class="fab fa-twitter fa-lg"></i>
                        </a>
                        <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                          <i class="fab fa-instagram fa-lg"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-12 col-xl-4">
                <div class="card card-plain h-100">
                  <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Conversations</h6>
                  </div>
                  <div class="card-body p-3">
                    <ul class="list-group">
                      <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                        <div class="avatar me-3">
                          <img src="../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Sophie B.</h6>
                          <p class="mb-0 text-xs">Hi! I need more information..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                      </li>
                      <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="avatar me-3">
                          <img src="../assets/img/marie.jpg" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Anne Marie</h6>
                          <p class="mb-0 text-xs">Awesome work, can you..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                      </li>
                      <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="avatar me-3">
                          <img src="../assets/img/ivana-square.jpg" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Ivanna</h6>
                          <p class="mb-0 text-xs">About files I can..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                      </li>
                      <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="avatar me-3">
                          <img src="../assets/img/team-4.jpg" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Peterson</h6>
                          <p class="mb-0 text-xs">Have a great afternoon..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                      </li>
                      <li class="list-group-item border-0 d-flex align-items-center px-0">
                        <div class="avatar me-3">
                          <img src="../assets/img/team-3.jpg" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Nick Daniel</h6>
                          <p class="mb-0 text-xs">Hi! I need more information..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                      </li>
                    </ul>
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

      <script>
        Swal.fire({
          title: 'Completar perfil',
          confirmButtonText: 'Continuar',
          html: 'Debe completar la información de su perfil para acceder a las funciones del sistema.',
          icon: 'info',
          confirmButtonColor: '#ed5264',
        }).then((result) => {
          $('#cedula').val('')
        })




        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
          var options = {
            damping: '0.5'
          }
          Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
      </script>
      <!-- Github buttons -->
      <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
  </body>

  </html>

<?php
} else {
  define('PAGINA_INICIO', '../index.php');
  header('Location: ' . PAGINA_INICIO);
}
?>