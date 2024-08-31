<?php
include('../configuracion/conexionMysqli.php');
include('../class/count.php');

unset($_SESSION['proyecto']);
if ($_SESSION['nivel'] != '') {
  $idUser = $_SESSION['id'];
?>

  <script>
    var municipios = [];
    var parroquias = [];
    var comunas = [];
    var comunidades = [];

    <?php

    function asignarValores($_1, $_2, $tabla, $arreglo)
    {
      global $conexion;
      $query = "SELECT $_1, $_2 FROM $tabla ";
      $buscar = $conexion->query($query);
      if ($buscar->num_rows > 0) {
        while ($row = $buscar->fetch_assoc()) {
          $id = $row[$_1];
          $nombre = $row[$_2];
          echo $arreglo . '["' . $id . '"] = "' . $nombre . '";';
        }
      }
    }
    asignarValores('id_parroquias', 'nombre_parroquia', 'local_parroquia', 'parroquias');
    asignarValores('id_consejo', 'nombre_c_comunal', 'local_comunidades', 'comunidades');
    asignarValores('id_Comuna', 'nombre_comuna', 'local_comunas', 'comunas');
    asignarValores('id_municipio', 'nombre_municipio', 'local_municipio', 'municipios');


    ?>
  </script>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title class="cartografia" id="title">
      Proyectos GITCOM
    </title>
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
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
            <h6 class="font-weight-bolder mb-0">Proyectos</h6>
          </nav>
          <?php include('includes/header.php') ?>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-lg-8">

            <div class="col-md-12">
              <div class="card">
                <div class="ventana-header pb-0 px-3">
                  <h6 class="mb-0">Nuevo proyecto
                  </h6>
                </div>
                <div class="card-body pt-4 p-3">

                  <label class="control-label">Instancia del Proyecto </label>
                  <div class="input-group input-group-outline my-3">
                    <select onchange="instancia(this.value)" style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" required="" class="form-control" id="instancia">
                      <option value="">Seleccione</option>
                      <option value="1">Comunitario</option>
                      <option value="2">Comunal</option>
                      <option value="3">Parroquial</option>
                      <option value="4">Municipal</option>
                    </select>
                  </div>



                  <label class="control-label">Seleccione la instancia</label>
                  <div class="input-group input-group-outline my-3">
                    <select style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" required="" class="form-control" id="instancia_def">
                      <option value="">Seleccione</option>

                    </select>
                  </div>

                  <script>
                    function instancia(instancia) {
                      let arreglo = []
                      switch (instancia) {
                        case '1':
                          arreglo = comunidades;
                          break;
                        case '2':
                          arreglo = comunas;
                          break;
                        case '3':
                          arreglo = parroquias;
                          break;
                        case '4':
                          arreglo = municipios;
                          break;
                      }
                      let select = document.getElementById('instancia_def');
                      select.innerHTML = '<option value="">Seleccione</option>'
                      // foreach key value
                      for (const key in arreglo) {
                        if (arreglo.hasOwnProperty(key)) {
                          const value = arreglo[key];
                          select.innerHTML += `<option value="${key}">${value}</option>`

                        }
                      }

                    }
                  </script>


                  <label class="control-label">Categoría de Proyecto </label>
                  <div class="input-group input-group-outline my-3">
                    <select style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" required="" class="form-control" id="categoria">
                      <option value="">Seleccione</option>
                      <option value="1">Cartografía de gestión</option>
                      <option value="2">Agenda concreta de acción</option>
                      <option value="3">Mantenimiento y atención</option>
                      <option value="4">Otro</option>
                    </select>
                  </div>

                  <label class="control-label">Nombre del proyecto</label>
                  <div class="input-group input-group-outline my-3">
                    <input required="" placeholder="Nombre del proyecto" class="form-control" type="text" name="nombre" id="nombre">
                  </div>

                  <label class="control-label">Descripción del proyecto</label>
                  <div class="input-group input-group-outline my-3">
                    <input required="" placeholder="Descripción del proyecto" class="form-control" type="text" id="descripcion">
                  </div>

                  <label class="control-label">Tipo de Proyecto </label>
                  <div class="input-group input-group-outline my-3">
                    <select style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" required="" class="form-control" id="tipo">
                      <option value="1">Privado</option>
                      <option value="2">Público</option>
                    </select>
                  </div>




                  <button class="btn btn-primary bg-gradient-primary box-shadow-primary fr mt1" onclick="guardarProject()">Crear</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 ">
            <div class="card h-100 mb-4" id="creacionNuevoProyecto">
              <div class="ventana-header pb-0 px-3">
                <div class="row">
                  <div class="col-md-12">
                    <h6 class="mb-0">Participantes</h6>
                  </div>
                </div>
              </div>
              <div class="card-body pt-4 p-3">

                <section id="participantes">
                </section>


                <p>Participantes disponibles</p>



                <section id="participantes_por_escala">


                  <div class="cardParticipante" id="div_u_l">
                    <div class="imgDiv">
                      <img src="../assets/img/3-SF.png" alt="imagenEscala" class="avatar">
                    </div>
                    <div class="textDiv">
                      <p>Usuarios de la instancia. </p>
                      <small>Todos los usuarios de la instancia</small>
                    </div>
                    <div class="btnDiv">
                      <a onclick="addP('div_u_l', 'participantes_por_escala', '0')" id="div_u_l_r"> <i class="fa fa-plus"></i> </a>
                    </div>
                  </div>
                </section>



                <hr>
                <section id="participantes_disponibles">
                  <?php


                  $queryyy4 = "SELECT * FROM sist_usuarios WHERE nivel='3' AND disponible_p='0' AND id!='$idUser'";
                  $buscarM4 = $conexion->query($queryyy4);
                  if ($buscarM4->num_rows > 0) {
                    while ($row4 = $buscarM4->fetch_assoc()) {


                      echo '
                    <div class="cardParticipante" id="div_u_l' . $row4['id'] . '">
                    <div class="imgDiv">
                    <img src="../assets/img/user-pictures/' . $row4['id'] . '.png" alt="user-picture" class="cursor-pointer avatar avatar-profile" onerror="this.onerror=null; this.src=\'../assets/img/user-pictures/default.jpg\'">

                    </div>
                    <div class="textDiv">
                      <p>' . $row4['nombreUser'] . '. </p> 
                      <small>Empresa del estado</small>
                    </div>
                    <div class="btnDiv">
                      <a onclick="addP(\'div_u_l' . $row4['id'] . '\', \'participantes_disponibles\', \'' . $row4['id'] . '\')" id="div_u_l' . $row4['id'] . '_r"> <i class="fa fa-plus"></i> </a>
                    </div>
                  </div>';
                    }
                  }

                  ?>

                </section>
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
    <script src="../class/alertas.js"></script>

    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
      var participantes = [];

      function addP(div, sect, id) {

        $('#' + div + '_r').html('<i class="fa fa-close"></i>')
        $('#' + div + '_r').attr('onclick', 'remP("' + div + '" , "' + sect + '", "' + id + '")')
        let div_content = $('#' + div).html() // contenido de la tarjeta
        $('#' + div).remove()

        $('#participantes').append('<div class="cardParticipante" id="' + div + '">' + div_content + '</div>')

        participantes[id] = id;
      }

      function remP(div, sect, id) {
        $('#participantes_disponibles').append()
        $('#' + div + '_r').html('<i class="fa fa-plus"></i>')
        $('#' + div + '_r').attr('onclick', 'addP("' + div + '", "' + sect + '", "' + id + '")')
        let div_content = $('#' + div).html() // contenido de la tarjeta
        $('#' + div).remove()

        $('#' + sect).append('<div class="cardParticipante" id="' + div + '">' + div_content + '</div>')

        delete participantes[id];
      }


      function guardarProject() {

        var instancia = $('#instancia').val();
        var categoria = $('#categoria').val();
        var nombre = $('#nombre').val();
        var descripcion = $('#descripcion').val();
        var tipo = $('#tipo').val();
        var instancia_def = $('#instancia_def').val();
        var participantesEnd = [];


        if (instancia == '' || categoria == '' || nombre == '' || descripcion == '' || tipo == '' || instancia_def == '') {
          toast('error', 'Todos los campos son obligatorios')
          return;
        }
        var texto;
        if (participantes.length != 0) {

          participantes.forEach(element => {
            participantesEnd.push(element)
          });
          texto = 'Se creara el proyecto ' + nombre + ' y se configurara como <strong>' + (tipo == 1 ? 'Privado' : 'Público') + '</strong>. <strong><br>SE ENVIARA INVITACIONES A LOS PARTICIPANTES AGREGADOS</strong>'
        } else {
          texto = 'Se creara el proyecto ' + nombre + ' y se configurara como <strong>' + (tipo == 1 ? 'Privado' : 'Público') + '</strong>.'
        }



        let newString = participantesEnd.toString();


        Swal.fire({
          title: '¿Está seguro?',
          html: texto,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: 'rgb(120 26 5)',
          cancelButtonColor: '#a9a9a9',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Continuar'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: 'consultasAjax/nuevoProyecto.php',
              type: 'POST',
              dataType: 'html',
              data: {
                instancia: instancia,
                categoria: categoria,
                nombre: nombre,
                descripcion: descripcion,
                tipo: tipo,
                instancia_def: instancia_def,
                participantes: newString
              },
            }).done(function(response) {
              if (response != 'error') {
                window.open("mapa/index.php?codigo=" + response.trim(), "_self");
              }
            })
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
      console.clear()
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