<!--
=========================================================
* Material Dashboard 2 - v3.0.2
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


if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2) {

  
  
?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title class="tablas" id="title">
      Proyectos GITCOM
    </title>
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
    

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
  
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
      
      
    
    <script>
        
  
       $(document).ready( function () {
        $('#myTable').DataTable();
    } );
   
     </script>
    
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
            <h6 class="font-weight-bolder mb-0">Tablas
            </h6>
          </nav>
          <?php include('includes/header.php') ?>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-lg-12">
            <div class="card h-100 mb-4">
              <div class="ventana-header pb-0 px-3">
                <div class="row">
                  <div class="col-md-12">
                    <h6 class="mb-0">Registros
                    <a href="reportes/psuv.php"  style="max-width: 30%; float: right; font-size: 12px;"> PDF </a>
                    <a href="reportes/psuv-e.php"  style="max-width: 30%; float: right; font-size: 12px;"> EXCEL - </a>
                    </h6>

                  </div>

                </div>
              </div>
              <div class="card-body pt-4 p-3">
          
              
              <div class="table-responsive" >
                  <table style="font-size: 13px !important;" id="myTable" class="table align-items-center mb-0" style="width:100%">

  <thead>
      



              <tr>
                <th>N#</th>
                <th>Nombres y apellidos</th>
                <th>Cedula</th>
                <th>Telefono</th>
                <th>Mcp</th>
                <th>Instancia</th>
                <th>Cargo</th>
                <th>Ficha</th>
              </tr>

    </thead>
                 <tbody>
                 <?php
                 
                 $count = 1;
                  $query2E = "SELECT psuv.id, psuv.nombre, psuv.cedula, psuv.telefono, psuv.instancia, psuv.cargo, local_municipio.nombre_municipio FROM psuv
                  LEFT JOIN local_municipio ON local_municipio.id_municipio = psuv.mcp
                 ";
                  $search2E = $conexion->query($query2E);
                  if ($search2E->num_rows > 0) {
                    while ($row2E = $search2E->fetch_assoc()) {
                  
                        echo '
                        <tr>
                        <td >'.$count++.'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['nombre'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['cedula'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['telefono'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['nombre_municipio'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['instancia'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['cargo'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;"><a href="reportes/psuv-ficha.php?i='.$row2E['id'].'"><i class="fa fa-download"></i></a></td>
                    </tr>
                  ';
                }
              }
                 ?>

              </tbody>
            </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php include('notificacion.php'); ?>
      </div>
    </main>


    <script type="text/javascript">// < ![CDATA[

    
// ]]></script>




    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
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