<?php
include('../../../configuracion/conexionMysqli.php');
include('../../../class/count.php');

unset($_SESSION['proyecto']);
if ($_SESSION['nivel'] != '') {


  $ir = $_GET["ir"];
  $c = $_GET["c"];
  $p = $_GET["p"];

  $idUser = $_SESSION['id'];

  $he = '1';
  $queryyy = "SELECT * FROM herramientas_gitcom WHERE user='$idUser' AND id='$he'";
  $buscarM = $conexion->query($queryyy);
  if ($buscarM->num_rows > 0) {
    while ($row = $buscarM->fetch_assoc()) {
      $h_nombre = $row['nombre'];
    }
  } else {

    define('PAGINA_INICIO', '../../../index.php');
    header('Location: ' . PAGINA_INICIO);
  }

  $queryyy = "SELECT * FROM he_pa_coms_previstas WHERE id_coms='$ir'";
  $buscarM = $conexion->query($queryyy);
  if ($buscarM->num_rows > 0) {
    while ($row = $buscarM->fetch_assoc()) {
      $nameCom = $row['name_coms'];
      $caracterizacion = $row['caracterizacion'];
      $atenciones = $row['atenciones'];
    }
  }


?>




  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../../../assets/img/favicon.png">
    <title class="herramientas" id="title">
      Herramientas GITCOM
    </title>
    <link href="../../../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="../../../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../../../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <script src="../../../assets/js/sweetalert2.all.min.js"></script>
    <script src="../../../assets/js/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="style.css">


    <script>
      function actualizarCaracterizacion() {
        $('.fondo-loader').show();
        $.ajax({
            url: 'ajax/caracterizacion.php',
            type: 'POST',
            dataType: 'html',
            data: {
              plan: "<?php echo $p ?>",
              com: "<?php echo $c ?>",
              accion: 'consulta'
            },
          })
          .done(function(rePol) {
            $('#listCaracterizacion').html(rePol)
            $('.fondo-loader').hide();
          })
      }


      function actualizarAtenciones() {
        $('.fondo-loader').show();
        $.ajax({
            url: 'ajax/atenciones.php',
            type: 'POST',
            dataType: 'html',
            data: {
              plan: "<?php echo $p ?>",
              com: "<?php echo $c ?>",
              accion: 'consulta'
            },
          })
          .done(function(rePol) {
            $('#listAtencione').html(rePol)
            $('.fondo-loader').hide();
          })
      }
    </script>
    <div class="fondo-loader">
      <div class='container'>
        <svg viewBox="0 0 396.45 396.45" stroke-width='10' fill="none" xmlns="http://www.w3.org/2000/svg" class="loadersVG">
          <g class="dash">
            <path style="--sped: 4s;" pathLength="360" d="M181.66,317.82s-48.11-90.72-59.23-114.38c-3.34-7.1-8-17.23-9.07-31.28-3.19-41.66,28.51-72.6,32-76,31.22-29.57,69.74-28.56,75.07-28.34,44.07,1.87,70,31.64,74,36.51,5.12,5.75,26.58,31.08,24,66.64a85.26,85.26,0,0,1-10.73,35.35L251.11,316.8c18.94,3.27,67.17,12.12,67.17,12.12a12.13,12.13,0,0,1,8.57,4.36,11.74,11.74,0,0,1,.88,13,12,12,0,0,1-6.12,5.07,379.7,379.7,0,0,0-52.12-11c-11.62-1.61-22.63-2.59-32.9-3.11a15.44,15.44,0,0,1-5.05-2.19,9.42,9.42,0,0,1-2.65-2.23c-3.33-4.45-3.12-11.26.35-17.42l61.3-121.42c10.48-20.75,7.71-33.44,1.93-41-6.37-8.36-18.05-9.84-24.77-10.08l-52.34.77A17.51,17.51,0,0,0,197.68,160c-.39,9.59,7.77,18.07,17.94,17.88H247a13.16,13.16,0,0,1,.89,25.78L215,204c-24.36.89-44.79-18.88-44.81-42.89,0-24.21,20.71-44.1,45.25-42.95l16.28-.2c.83-.06,7.63-.6,11.49-6.45,3.56-5.4,2.45-12-.19-16.09-2.95-4.54-7.91-6.05-10.15-6.7-10-2.89-45.15-6.35-72.31,19-2.73,2.56-24.51,23.57-25.54,56.6a79.53,79.53,0,0,0,3.77,26.62c21.78,41.44,66,127.53,66,127.53.19.33,3.82,6.79.35,13a13.13,13.13,0,0,1-7.66,6,344.43,344.43,0,0,0-42,4.09c-15.35,2.44-41.23,9.19-41.23,9.19-5.06-2.23-8-7.22-7.31-12,.7-5,5-7.61,5.65-7.95,7.44-2.35,15.49-4.5,24.08-6.49A270.26,270.26,0,0,1,181.66,317.82Z" transform="translate(-50 -200)" class="big"></path>
          </g>
        </svg>
        <P style="margin: 165px 0 0 30px;text-transform: uppercase;color: #bbbbbb;font-family: sans-serif;">Cargando...</P>
      </div>
    </div>

    <style>
      .fs-6 {
        font-size: 1.075rem !important;
      }

      .sidenav {
        z-index: 99 !important;
      }
    </style>


    <script>
      function activar() {
        $('.fondo-loader').hide();
      }
      $(window).on("load", activar);
    </script>

  </head>

  <body class="g-sidenav-show  bg-gray-200">
    <?php include('../includes/menu.php'); ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
      <!-- Navbar -->
      <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Gitcom</a></li>
            </ol>
            <h6 class="font-weight-bolder mb-0"><?php echo $h_nombre ?></h6>
          </nav>
          <?php include('../includes/header.php') ?>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid py-4">

        <div class="row">

          <div class="col-lg-12">

            <div class="card mb-3 ">
              <div class="card-body pt-4 pb-0">
                <!--begin::Details-->
                <div class="d-flex flex-wrap flex-sm-nowrap ">
                  <!--begin::Image-->
                  <div class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-4 mb-4">
                    <img class="mw-50px mw-lg-75px" src="../../../assets/img/digital.png" alt="image">
                  </div>
                  <!--end::Image-->

                  <!--begin::Wrapper-->
                  <div class="flex-grow-1">
                    <!--begin::Head-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                      <!--begin::Details-->
                      <div class="d-flex flex-column">
                        <!--begin::Status-->
                        <div class="d-flex align-items-center">
                          <span href="#" class="fs-2 fw-bold me-3" style="font-size: 19.5px !important; color: #344767;"><?php echo $nameCom ?></span>
                        </div>
                        <!--end::Status-->


                        <!--begin::Description-->
                        <div class="d-flex flex-wrap fw-semibold mb-4 text-gray-400" style="font-size: 14.95px !important">
                          Registro de tareas y acciones a realizar.
                        </div>
                        <!--end::Description-->
                      </div>


                      <!--end::Details-->

                      <!--begin::Actions-->
                      <div class="d-flex mb-4">
                        <button href="#" class="btn btn-sm btn-bg-light btn-active-color-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target" onclick="nuevaAccion()">Agregar acción</button>

                        <button href="#" class="btn btn-sm btn-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target" onclick="$('#exampleModal').modal('toggle')">Agregar tarea</button>


                      </div>
                      <!--end::Actions-->
                    </div>
                    <!--end::Head-->

                    <!--begin::Info-->
                    <div class="d-flex flex-wrap justify-content-start">
                      <!--begin::Stats-->
                      <div class="d-flex flex-wrap">
                        <!--begin::Stat-->
                        <div class="border border-gray-300 border-dashed rounded  py-2 px-4 me-4 mb-3">
                          <!--begin::Number-->
                          <div class="d-flex align-items-center">


                            <i class="icon-plus fs-6 text-success me-2"></i>

                            <div class="fs-4 fw-bold" id="ttl_acciones"> <?php echo contar2('he_pa_sub_acciones', "com='" . $c . "' AND id_p='" . $p . "'") ?> </div>
                          </div>
                          <!--end::Number-->


                          <!--begin::Label-->
                          <div class="fw-semibold fs-6 text-gray-400">Acciones</div>
                          <!--end::Label-->
                        </div>
                        <!--end::Stat-->

                        <!--begin::Stat-->
                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-2 px-4 me-4 mb-3">
                          <!--begin::Number-->
                          <div class="d-flex align-items-center">
                            <i class="icon-arrow-up fs-6 text-success me-2"></i>
                            <div class="fs-4 fw-bold" id="acciones_realizadas"><?php echo contar2('he_pa_sub_acciones', "com='" . $c . "' AND id_p='" . $p . "' AND status=2") ?></div>
                          </div>
                          <!--end::Number-->

                          <!--begin::Label-->
                          <div class="fw-semibold fs-6 text-gray-400">Realizadas &nbsp;&nbsp; </div>
                          <!--end::Label-->
                        </div>
                        <!--end::Stat-->

                        <!--begin::Stat-->
                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-2 px-4 me-4 mb-3">
                          <!--begin::Number-->
                          <div class="d-flex align-items-center">
                            <i class="icon-arrow-down fs-6 text-danger me-2"></i>
                            <div class="fs-4 fw-bold" id="acciones_pendientes"><?php echo contar2('he_pa_sub_acciones', "com='" . $c . "' AND id_p='" . $p . "' AND status!='2'") ?></div>
                          </div>
                          <!--end::Number-->

                          <!--begin::Label-->
                          <div class="fw-semibold fs-6 text-gray-400">Pendientes</div>
                          <!--end::Label-->
                        </div>
                        <!--end::Stat-->
                      </div>
                      <!--end::Stats-->

                    </div>
                    <!--end::Info-->
                  </div>
                  <!--end::Wrapper-->
                </div>
                <!--end::Details-->
              </div>


            </div>
          </div>
        </div>





        <div class="row">


          <div class="col-lg-7">
            <div class="card h-100 mb-3">
              <div class="ventana-header pb-0 px-3">
                <div class="row">
                  <div class="col-md-12">
                    <span class="mb-0"> <i class="icon-event me-2"></i> Tareas a realizar</span>
                  </div>
                </div>

                <hr style="opacity: 0.2;">
                <br>

                <section id="tareas">

                </section>

              </div>
            </div>
          </div>



          <div class="col-lg-5">
            <div class="card h-100 mb-3">
              <div class="ventana-header pb-0 px-3">
                <div class="row">
                  <div class="col-md-12">
                    <span class="mb-0"> <i class="icon-note me-2"></i> Información adicional</span>
                  </div>
                </div>

                <hr style="opacity: 0.2;">


                <h6>Caracterización
                  <small><br></small>
                  <small class="text-gray-400">Caracterización de la comunidad</small>
                </h6>
                <section id="listCaracterizacion">
                  <?php
                  if ($caracterizacion == 0) {
                    echo '
                    No se ha cargado la caracterización. <span onclick="$(\'#modalCarac\').modal(\'toggle\')" class="badge pointer badge-light-primary me-auto">Registrar </span>
                 ';
                  } else {
                    echo "<script>
                    actualizarCaracterizacion()
                    </script>";
                  }
                  ?>
                </section>


                <hr>



                <h6>Atención
                  <small><br></small>
                  <small class="text-gray-400">Atenciones de la jornada</small>
                </h6>
                <section id="listAtencione">
                  <?php
                  if ($atenciones == 0) {
                    echo 'No se han registrado las atenciones <span onclick="$(\'#modalAtenciones\').modal(\'toggle\')" class="pointer badge badge badge-light-primary me-auto">Registrar </span>';
                  } else {
                    echo "<script>
                    actualizarAtenciones()
                    </script>";
                  }
                  ?>
                </section>


                <br>




              </div>
            </div>
          </div>


          <script>
            function registrarAtenciones() {

            }




            function setTipoJornada(value) {
              let result = value.split('*')
              if (result[1] == 'MicroJornada') {
                $('#inpPersonasAtendidas').show(300)
              } else {
                $('#inpPersonasAtendidas').hide(300)
              }
              setVertice(result[2])
            }

            function nuevaAccion() {
              $('.fondo-loader').show();
              $.get("ajax/nuevaAccion_tareas.php", "p=" + "<?php echo $_GET["p"] ?>" + "&c=" + "<?php echo $_GET["c"] ?>", function(data) {
                if (data != '') {
                  $('#accionModal').modal('toggle')
                  $('#s_tarea').html(data)
                } else {
                  toast('info', 'No hay tareas registradas')
                }
                $('.fondo-loader').hide();
              });
            }

            function nuevaCaracterizacion() {

              let flias = $('#flias').val()
              let casas = $('#casas').val()
              let hab = $('#hab').val()
              let electores = $('#electores').val()
              let ubchs = $('#ubchs').val()
              let consejos = $('#consejos').val()
              let comites = $('#comites').val()
              let voceros = $('#voceros').val()
              let brigadas_msv = $('#brigadas_msv').val()
              let brigadistas = $('#brigadistas').val()
              let jefes_coms = $('#jefes_coms').val()
              let lideres_calle = $('#lideres_calle').val()
              let bolsas = $('#bolsas').val()
              let c_educativos = $('#c_educativos').val()
              let c_saluds = $('#c_saluds').val()
              let c_alimentacion = $('#c_alimentacion').val()
              let misiones_educativas = $('#misiones_educativas').val()
              let canchas_depors = $('#canchas_depors').val()
              let b_Misiones = $('#b_Misiones').val()
              let c_religiosos = $('#c_religiosos').val()
              let con_carnet = $('#con_carnet').val()
              let sin_carnet = $('#sin_carnet').val()
              let institucionesCom = $('#institucionesCom').val()

              $('.fondo-loader').show();

              $.ajax({
                  url: 'ajax/caracterizacion.php',
                  type: 'POST',
                  dataType: 'html',
                  data: {
                    plan: "<?php echo $p ?>",
                    com: "<?php echo $c ?>",
                    accion: 'registro',
                    flias: flias,
                    casas: casas,
                    hab: hab,
                    electores: electores,
                    ubchs: ubchs,
                    consejos: consejos,
                    comites: comites,
                    voceros: voceros,
                    brigadas_msv: brigadas_msv,
                    brigadistas: brigadistas,
                    jefes_coms: jefes_coms,
                    lideres_calle: lideres_calle,
                    bolsas: bolsas,
                    c_educativos: c_educativos,
                    c_saluds: c_saluds,
                    c_alimentacion: c_alimentacion,
                    misiones_educativas: misiones_educativas,
                    canchas_depors: canchas_depors,
                    b_Misiones: b_Misiones,
                    c_religiosos: c_religiosos,
                    con_carnet: con_carnet,
                    sin_carnet: sin_carnet,
                    institucionesCom: institucionesCom
                  },
                })
                .done(function(rePol) {
                  $('.fondo-loader').hide();
                  actualizarCaracterizacion()
                })
            }


            function nuevaAtencion() {


              let cons_medicas = $('#cons_medicas').val()
              let cons_medicas_i = $('#cons_medicas_i').val()
              let cons_programas = $('#cons_programas').val()
              let cons_programas_i = $('#cons_programas_i').val()
              let its = $('#its').val()
              let its_i = $('#its_i').val()
              let planificacion_fa = $('#planificacion_fa').val()
              let planificacion_fa_i = $('#planificacion_fa_i').val()
              let medic_entregadas = $('#medic_entregadas').val()
              let medic_entregadas_i = $('#medic_entregadas_i').val()
              let inmunizacion = $('#inmunizacion').val()
              let inmunizacion_i = $('#inmunizacion_i').val()
              let eval_nutricional = $('#eval_nutricional').val()
              let eval_nutricional_i = $('#eval_nutricional_i').val()
              let cortes_cabello = $('#cortes_cabello').val()
              let cortes_cabello_i = $('#cortes_cabello_i').val()
              let emb_cejas = $('#emb_cejas').val()
              let emb_cejas_i = $('#emb_cejas_i').val()
              let pcd = $('#pcd').val()
              let pcd_i = $('#pcd_i').val()
              let asesorias_viviendas = $('#asesorias_viviendas').val()
              let asesorias_viviendas_i = $('#asesorias_viviendas_i').val()
              let asesoria_a_myo = $('#asesoria_a_myo').val()
              let asesoria_a_myo_i = $('#asesoria_a_myo_i').val()
              let plantas = $('#plantas').val()
              let plantas_i = $('#plantas_i').val()
              let mascotas = $('#mascotas').val()
              let mascotas_i = $('#mascotas_i').val()
              let asesorias_produc = $('#asesorias_produc').val()
              let asesorias_produc_i = $('#asesorias_produc_i').val()
              let capac_universitaria = $('#capac_universitaria').val()
              let capac_universitaria_i = $('#capac_universitaria_i').val()
              let re_bombillos = $('#re_bombillos').val()
              let re_bombillos_i = $('#re_bombillos_i').val()
              let refrigerios = $('#refrigerios').val()
              let refrigerios_i = $('#refrigerios_i').val()
              let trans_personal = $('#trans_personal').val()
              let trans_personal_i = $('#trans_personal_i').val()
              let recreacion_nn = $('#recreacion_nn').val()
              let recreacion_nn_i = $('#recreacion_nn_i').val()
              let ases_pedago = $('#ases_pedago').val()
              let ases_pedago_i = $('#ases_pedago_i').val()
              let entrega_fe_v = $('#entrega_fe_v').val()
              let entrega_fe_v_i = $('#entrega_fe_v_i').val()
              let c_ninos = $('#c_ninos').val()
              let c_ninos_i = $('#c_ninos_i').val()
              let c_mujeres = $('#c_mujeres').val()
              let c_mujeres_i = $('#c_mujeres_i').val()
              let c_juventud = $('#c_juventud').val()
              let c_juventud_i = $('#c_juventud_i').val()
              let c_todo = $('#c_todo').val()
              let c_todo_i = $('#c_todo_i').val()
              let pintacaritas = $('#pintacaritas').val()
              let pintacaritas_i = $('#pintacaritas_i').val()
              let cedula_indi = $('#cedula_indi').val()
              let cedula_indi_i = $('#cedula_indi_i').val()
              let rhab_insfra = $('#rhab_insfra').val()
              let rhab_insfra_i = $('#rhab_insfra_i').val()

              $('.fondo-loader').show();

              $.ajax({
                  url: 'ajax/atenciones.php',
                  type: 'POST',
                  dataType: 'html',
                  data: {
                    plan: "<?php echo $p ?>",
                    com: "<?php echo $c ?>",
                    accion: 'registro',
                    cons_medicas: cons_medicas,
                    cons_medicas_i: cons_medicas_i,
                    cons_programas: cons_programas,
                    cons_programas_i: cons_programas_i,
                    its: its,
                    its_i: its_i,
                    planificacion_fa: planificacion_fa,
                    planificacion_fa_i: planificacion_fa_i,
                    medic_entregadas: medic_entregadas,
                    medic_entregadas_i: medic_entregadas_i,
                    inmunizacion: inmunizacion,
                    inmunizacion_i: inmunizacion_i,
                    eval_nutricional: eval_nutricional,
                    eval_nutricional_i: eval_nutricional_i,
                    cortes_cabello: cortes_cabello,
                    cortes_cabello_i: cortes_cabello_i,
                    emb_cejas: emb_cejas,
                    emb_cejas_i: emb_cejas_i,
                    pcd: pcd,
                    pcd_i: pcd_i,
                    asesorias_viviendas: asesorias_viviendas,
                    asesorias_viviendas_i: asesorias_viviendas_i,
                    asesoria_a_myo: asesoria_a_myo,
                    asesoria_a_myo_i: asesoria_a_myo_i,
                    plantas: plantas,
                    plantas_i: plantas_i,
                    mascotas: mascotas,
                    mascotas_i: mascotas_i,
                    asesorias_produc: asesorias_produc,
                    asesorias_produc_i: asesorias_produc_i,
                    capac_universitaria: capac_universitaria,
                    capac_universitaria_i: capac_universitaria_i,
                    re_bombillos: re_bombillos,
                    re_bombillos_i: re_bombillos_i,
                    refrigerios: refrigerios,
                    refrigerios_i: refrigerios_i,
                    trans_personal: trans_personal,
                    trans_personal_i: trans_personal_i,
                    recreacion_nn: recreacion_nn,
                    recreacion_nn_i: recreacion_nn_i,
                    ases_pedago: ases_pedago,
                    ases_pedago_i: ases_pedago_i,
                    entrega_fe_v: entrega_fe_v,
                    entrega_fe_v_i: entrega_fe_v_i,
                    c_ninos: c_ninos,
                    c_ninos_i: c_ninos_i,
                    c_mujeres: c_mujeres,
                    c_mujeres_i: c_mujeres_i,
                    c_juventud: c_juventud,
                    c_juventud_i: c_juventud_i,
                    c_todo: c_todo,
                    c_todo_i: c_todo_i,
                    pintacaritas: pintacaritas,
                    pintacaritas_i: pintacaritas_i,
                    cedula_indi: cedula_indi,
                    cedula_indi_i: cedula_indi_i,
                    rhab_insfra: rhab_insfra,
                    rhab_insfra_i: rhab_insfra_i
                  },
                })
                .done(function(rePol) {
                  alert(rePol)
                  if (rePol.trim() == 'success') {
                  $('.fondo-loader').hide();
                  actualizarAtenciones()
                 $('#modalAtenciones').modal('toggle')
                }

                })
            }




            function actualizarTabla() {
              $('.fondo-loader').show();

              $.ajax({
                  url: 'ajax/tareas.php',
                  type: 'POST',
                  dataType: 'html',
                  data: {
                    he: '<?php echo $he ?>',
                    m: 'tareasReg',
                    plan: "<?php echo $p ?>",
                    com: "<?php echo $c ?>"
                  },
                })
                .done(function(rePol) {
                  $('#tareas').html(rePol)
                  $('.fondo-loader').hide();

                })
            }
            actualizarTabla()

            function setStatus(id, status) {
              if (status == 3) {
                toast('info', 'No se puede cambiar el estatus')
                return;
              }
              Swal.fire({
                title: '¿Está seguro?',
                html: 'Se cambiará el estatus de la acción.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ed5264',
                cancelButtonColor: '#a9a9a9',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Continuar'
              }).then((result) => {
                if (result.isConfirmed) {
                  $('.fondo-loader').show();

                  $.ajax({
                      url: 'ajax/tareas.php',
                      type: 'POST',
                      dataType: 'html',
                      data: {
                        he: '<?php echo $he ?>',
                        m: 'uptT',
                        id: id,
                        status: status
                      },
                    })
                    .done(function(rePol) {
                      $('.fondo-loader').hide();

                      if (rePol.trim() == '1') {
                        actualizarTabla()
                        toast("success", "El registro se actualizo correctamente");
                      } else {
                        toast('error', 'Error del servidor')
                      }
                    })
                }
              })
            }


            function nuevoRegistroAccion() {
              let s_tarea = $('#s_tarea').val()

              let s_acciones = $('#s_acciones').val()
              let s_fecha = $('#s_fecha').val()
              let s_atendidos = $('#s_atendidos').val()

              if (s_acciones == "" || s_fecha == '' || s_tarea == '') {
                toast('error', 'Rellene todos los campos')
                return
              }
              if (s_atendidos == '') {
                s_atendidos = '0';
              }


              let result_tarea = s_tarea.split('*')
              if (result_tarea[1] == 'Microjornada') {
                if (s_atendidos == "") {
                  toast('error', 'Rellene todos los campos (Atendidos)')
                  return
                }
              }

              $('#crearTareaAccion').attr('disabled', true)

              $.ajax({
                  url: 'ajax/nuevaAccion.php',
                  type: 'POST',
                  dataType: 'html',
                  data: {
                    tarea: result_tarea[0],
                    tipo: result_tarea[1],
                    s_acciones: s_acciones,
                    s_fecha: s_fecha,
                    s_atendidos: s_atendidos,
                    c: "<?php echo $c ?>",
                    plan: "<?php echo $p ?>"

                  },
                })
                .done(function(rePol) {

                  $('#crearTareaAccion').attr('disabled', false)

                  if (rePol.trim() == 'ye') {
                    toast('error', 'Registro duplicado')
                  } else if (rePol.trim() == 'success') {

                    let valttl = $('#ttl_acciones').html()
                    valttl = parseInt(valttl) + 1;
                    $('#ttl_acciones').html(valttl)


                    if (result_tarea[1] == 'MicroJornada') {

                      let valRea = $('#acciones_realizadas').html()
                      valRea = parseInt(valRea) + 1;
                      $('#acciones_realizadas').html(valRea)

                    } else {
                      let valPens = $('#acciones_pendientes').html()
                      valPens = parseInt(valPens) + 1;
                      $('#acciones_pendientes').html(valPens)
                    }

                    $('.form-control').val('')
                    toast('success', 'Registro realizado correctamente')
                    $('#accionModal').modal('toggle')
                    actualizarTabla()

                  }
                })
            }



            function nuevoRegistro() {

              let tipoTarea = $('#tipoTarea').val()
              let ente = $('#ente').val()
              let ecargado = $('#ecargado').val()
              let telefonos = $('#telefonos').val()
              let vetices = $('#vetices').val()


              if (tipoTarea == '' || ente == '' || ecargado == '' || telefonos == '' || vetices == '') {
                toast('error', 'Rellene todos los campos')
                return
              }
              $('#crearTarea').attr('disabled', true)
              //   let acciones = $('#acciones').val()
              // let atendidos = $('#atendidos').val()

              $.ajax({
                  url: 'ajax/manejador.php',
                  type: 'POST',
                  dataType: 'html',
                  data: {
                    he: '<?php echo $he ?>',
                    m: 'registroT',
                    plan: "<?php echo $p ?>",
                    tipoTarea: tipoTarea,
                    ente: ente,
                    ecargado: ecargado,
                    telefonos: telefonos,
                    vetices: vetices,
                    //    acciones: acciones,
                    //  atendidos: atendidos,
                    c: "<?php echo $c ?>"

                  },
                })
                .done(function(rePol) {

                  $('#crearTarea').attr('disabled', false)


                  $('.form-control').val('')
                  if (rePol.trim() == 'rechazado') {
                    toast('error', 'Registro duplicado')
                  } else if (rePol.trim() != 'error') {
                    toast('success', 'Registro realizado correctamente')
                    actualizarTabla()
                    $('#exampleModal').modal('toggle')

                  }
                })
            }
          </script>

          <!-- Modal -->
          <div class="modal fade" id="modalCarac" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding: 0 !important;">
            <div class="modal-dialog modal-xl modal-dialog-centered">
              <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title">Caracterización de la comunidad</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="overflow: auto;">

                  <div class="row">

                    <div class="col-lg-4">
                      <div class="mb-2">
                        <label for="ente" class="form-label">Cantidad de familias</label>
                        <input type="number" class="form-control" id="flias">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">Cantidad de casas</label>
                        <input type="number" class="form-control" id="casas">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">Cantidad de habitantes</label>
                        <input type="number" class="form-control" id="hab">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">Cantidad de electores</label>
                        <input type="number" class="form-control" id="electores">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">Cantidad de UBCH</label>
                        <input type="number" class="form-control" id="ubchs">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">Cantidad de consejos comunales.</label>
                        <input type="number" class="form-control" id="consejos">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">Cantidad de comités de los concejos comunales.</label>
                        <input type="number" class="form-control" id="comites">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">Cantidad de voceros del consejo comunal.</label>
                        <input type="number" class="form-control" id="voceros">
                      </div>
                    </div>







                    <div class="col-lg-4">
                      <div class="mb-2">
                        <label for="ente" class="form-label">Cantidad de brigadas de MSV.</label>
                        <input type="number" class="form-control" id="brigadas_msv">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">Cantidad de brigadistas del MSV.</label>
                        <input type="number" class="form-control" id="brigadistas">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">Cantidad de jefes de comunidad.</label>
                        <input type="number" class="form-control" id="jefes_coms">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">Cantidad de lideredes de calle</label>
                        <input type="number" class="form-control" id="lideres_calle">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">Cantidad de bolsas CLAP entregada en la comuna</label>
                        <input type="number" class="form-control" id="bolsas">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">Centros educativos</label>
                        <input type="number" class="form-control" id="c_educativos">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">Centros de salud</label>
                        <input type="number" class="form-control" id="c_saluds">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">Casas de Alimentación</label>
                        <input type="number" class="form-control" id="c_alimentacion">
                      </div>
                    </div>









                    <div class="col-lg-4">
                      <div class="mb-2">
                        <label for="ente" class="form-label">Ambientes de las misiones Educativas</label>
                        <input type="number" class="form-control" id="misiones_educativas">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">Canchas Deportivas</label>
                        <input type="number" class="form-control" id="canchas_depors">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">Bases de Misiones</label>
                        <input type="number" class="form-control" id="b_Misiones">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">Centros religiosos</label>
                        <input type="number" class="form-control" id="c_religiosos">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">Cantidad de personas con carnet de la patria</label>
                        <input type="number" class="form-control" id="con_carnet">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">personas que no tienen carnet patria.</label>
                        <input type="number" class="form-control" id="sin_carnet">
                      </div>
                      <div class="mb-2">
                        <label for="ente" class="form-label">Instituciones que hacen vida activa en la comuna</label>
                        <input type="text" class="form-control" id="institucionesCom">
                      </div>
                      <div class="mb-2 pt-4 pe-3 text-end">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button onclick="nuevaCaracterizacion()" class="btn btn-primary">Crear</button>
                      </div>
                    </div>






                  </div>



                </div>


              </div>
            </div>
          </div>




          <div class="modal fade" id="modalAtenciones" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding: 0 !important;">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title">Atenciones</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="overflow: auto;">

                  <div class="row">

                    <div class="col-lg-12">


                    <div class="mb-3">
                        <label for="ente" class="form-label">CONSULTAS MEDICINA GENERAL</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="cons_medicas" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="cons_medicas_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>

                      <div class="mb-3">
                        <label for="ente" class="form-label">CONSULTAS PROGRAMAS ESPECIALES</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="cons_programas" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="cons_programas_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-labITSel">ITS</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="its" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="its_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">PLANIFICACIÓN FAMILIAR</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="planificacion_fa" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="planificacion_fa_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">MEDICINAS ENTREGADAS</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="medic_entregadas" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="medic_entregadas_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">INMUNIZACIÓN: DOSIS APLICADAS</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="inmunizacion" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="inmunizacion_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">EVALUACIÓN NUTRICIONAL</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="eval_nutricional" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="eval_nutricional_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">CORTES DE CABELLO Y BARBERÍA</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="cortes_cabello" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="cortes_cabello_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">EMBELLECIMIENTO CEJAS</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="emb_cejas" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="emb_cejas_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">ATENCÓN A PCD</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="pcd" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="pcd_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">ASESORIAS POR VIVIENDA</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="asesorias_viviendas" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="asesorias_viviendas_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">ASESORIAS A ADULTOS MAYORES</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="asesoria_a_myo" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="asesoria_a_myo_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                     
                      <div class="mb-3">
                        <label for="ente" class="form-label">DONACION DE PLANTAS</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="plantas" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="plantas_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">ATENCION A MASCOTAS</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="mascotas" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="mascotas_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">ASESORIAS PRODUCTIVAS</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="asesorias_produc" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="asesorias_produc_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">CAPTACION BECAS UNIVERSITARIAS</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="capac_universitaria" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="capac_universitaria_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                  
                      <div class="mb-3">
                        <label for="ente" class="form-label">REPARACIÓN DE BOMBILLOS</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="re_bombillos" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="re_bombillos_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">ENTREGA DE REFRIGERIOS</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="refrigerios" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="refrigerios_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">TRANSPORTE DE PERSONAL</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="trans_personal" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="trans_personal_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">RECREACIÓN PARA NIÑOS Y NIÑAS</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="recreacion_nn" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="recreacion_nn_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">ASESORÍAS PEDAGÓGICAS</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="ases_pedago" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="ases_pedago_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">ENTREGA DE FE DE VIDA</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="entrega_fe_v" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="entrega_fe_v_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">CHARLAS PARA NIÑOS</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="c_ninos" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="c_ninos_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">CHARLAS PARA MUJERES</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="c_mujeres" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="c_mujeres_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">CHARLAS PARA LA JUVENTUD</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="c_juventud" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="c_juventud_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">CHARLAS TODO PUBLICO</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="c_todo" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="c_todo_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="ente" class="form-label">PINTACARITAS</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="pintacaritas" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="pintacaritas_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>

                      <div class="mb-3">
                        <label for="ente" class="form-label">IDENTIFICACION DE CASOS PARA CEDULA INDIGENA</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="cedula_indi" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="cedula_indi_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>
                      
                      <div class="mb-3">
                        <label for="ente" class="form-label">ASESORIAS REHABILITACION DE INFRAESTRUCTURAS</label>
                        <div class="row">
                          <div class="col-lg-6"><input type="number" class="form-control" id="rhab_insfra" placeholder="Cantidad"></div>
                          <div class="col-lg-6"><input type="text" class="form-control" id="rhab_insfra_i" placeholder="Institución/Misión"></div>
                        </div>
                      </div>






                    </div>








                    <div class="modal-footer">
                      <div class="mb-2 pt-4 pe-3 text-end">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button onclick="nuevaAtencion()" class="btn btn-primary">Crear</button>
                      </div>
                    </div>






                  </div>



                </div>


              </div>
            </div>
          </div>




          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title">Nueva tarea</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="max-height: 500px; overflow: auto;">


                  <div class="mb-2">
                    <label for="tipoTarea" class="form-label">Tipo de tarea</label>
                    <select class="form-control" id="tipoTarea" onchange="setTipoTarea(this.value)">
                      <option value="">Seleccione</option>
                      <option value="Jornada">Jornada</option>
                      <option value="MicroJornada">MicroJornada</option>
                    </select>
                  </div>

                  <div class="mb-2">
                    <label for="ente" class="form-label">Ente responsable</label>
                    
                    <select id="ente" class="form-control">

                    <option value="">Seleccione</option>
                    <option value="MOVIMIENTO SOMOS VENEZUELA ">MOVIMIENTO SOMOS VENEZUELA </option>
                    <option value="MISIÓN RIBAS">MISIÓN RIBAS</option>
                    <option value="MISIÓN ROBINSON">MISIÓN ROBINSON</option>
                    <option value="MISIÓN SUCRE">MISIÓN SUCRE</option>
                    <option value="MISIÓN CULTURA">MISIÓN CULTURA</option>
                    <option value="MISIÓN BARRIO ADENTRO VENEZUELA">MISIÓN BARRIO ADENTRO VENEZUELA</option>
                    <option value="MISIÓN BARRIO ADENTRO CUBANO">MISIÓN BARRIO ADENTRO CUBANO</option>
                    <option value="MISIÓN SONRISA">MISIÓN SONRISA</option>
                    <option value="MISIÓN NEGRA HIPOLITA">MISIÓN NEGRA HIPOLITA</option>
                    <option value="MISIÓN ÁRBOL">MISIÓN ÁRBOL</option>
                    <option value="HOGARES DE LA PATRIA">HOGARES DE LA PATRIA</option>
                    <option value="MISIÓN JOSÉ GREGORIO HERNÁNDEZ">MISIÓN JOSÉ GREGORIO HERNÁNDEZ</option>
                    <option value="MISIÓN GUAICAIPURO">MISIÓN GUAICAIPURO</option>
                    <option value=" IDENNA"> IDENNA</option>
                    <option value="MISIÓN MERCAL">MISIÓN MERCAL</option>
                    <option value="FRENTE FRANCISCO DE MIRANDA (F.F.M)">FRENTE FRANCISCO DE MIRANDA (F.F.M)</option>
                    <option value="MISIÓN NIÑO SIMÓN">MISIÓN NIÑO SIMÓN</option>
                    <option value="INSTITUTO NACIONAL DE NUTRICIÓN (I.N.N)">INSTITUTO NACIONAL DE NUTRICIÓN (I.N.N)</option>
                    <option value="GRAN MISIÓN SABER Y TRABAJO">GRAN MISIÓN SABER Y TRABAJO</option>
                    <option value="MOVIMIENTO POR LA PAZ Y LA VIDA">MOVIMIENTO POR LA PAZ Y LA VIDA</option>
                    <option value="MISIÓN BARRIO ADENTRO DEPORTE CUBANO">MISIÓN BARRIO ADENTRO DEPORTE CUBANO</option>
                    <option value="MISIÓN NEVADO">MISIÓN NEVADO</option>
                    <option value="FUNDAPROAL">FUNDAPROAL</option>
                    <option value="MISIÓN BARRIO NUEVO, BARRIO TRICOLOR (BNBT)">MISIÓN BARRIO NUEVO, BARRIO TRICOLOR (BNBT)</option>
                    <option value="GRAN MISIÓN VIVIENDA VENEZUELA (GMVV)">GRAN MISIÓN VIVIENDA VENEZUELA (GMVV)</option>
                    <option value="MISIÓN ROBERT SERRA">MISIÓN ROBERT SERRA</option>
                    <option value="MISIÓN JÓVENES DEL BARRIO">MISIÓN JÓVENES DEL BARRIO</option>
                    <option value="MISIÓN MILAGRO">MISIÓN MILAGRO</option>
                    <option value="MISION ZAMORA">MISION ZAMORA</option>
                    <option value="MISION VENEZUELA BELLA">MISION VENEZUELA BELLA</option>
                    <option value="INCES">INCES</option>
                    <option value="PDVAL">PDVAL</option>
                    <option value="FRENTE PREVENTIVO">FRENTE PREVENTIVO</option>
                    <option value="GRAN MISION CHAMBA JUVENIL">GRAN MISION CHAMBA JUVENIL</option>
                    <option value="JPSUV MISIONES">JPSUV MISIONES</option>
                    <option value="PSUV MISIONES">PSUV MISIONES</option>
                    <option value="ALIMENTACIÓN">ALIMENTACIÓN</option>
                    <option value="EDUCACIÓN">EDUCACIÓN</option>
                    <option value="COMUNAS Y MOVIMIENTOS SOCIALES">COMUNAS Y MOVIMIENTOS SOCIALES</option>
                    <option value="MUJER E IGUALDAD DE GÉNERO">MUJER E IGUALDAD DE GÉNERO</option>
                    <option value="HABITAD Y VIVIENDA">HABITAD Y VIVIENDA</option>
                    <option value="OBRAS PÚBLICAS">OBRAS PÚBLICAS</option>
                    <option value="JUVENTUD Y DEPORTE">JUVENTUD Y DEPORTE</option>
                    <option value="PUEBLOS INDÍGENAS">PUEBLOS INDÍGENAS</option>
                    <option value="SALUD">SALUD</option>
                    <option value="EDUCACIÓN">EDUCACIÓN</option>
                    <option value="EDUCACIÓN UNIVERSITARIA">EDUCACIÓN UNIVERSITARIA</option>
                    <option value="INASS">INASS</option>
                    <option value="IVSS">IVSS</option>
                    <option value="INTTT">INTTT</option>
                    <option value="CONAPDIS">CONAPDIS</option>
                    <option value="SUNAD">SUNAD</option>
                    <option value="PARTO HUMANIZADO">PARTO HUMANIZADO</option>
                    <option value="CORPOELEC">CORPOELEC</option>
                    <option value="FAMES">FAMES</option>
                    <option value="FAIMA">FAIMA</option>
                    <option value="SAIPDIS">SAIPDIS</option>
                    <option value="SIDEA">SIDEA</option>
                    <option value="INVIOBRAS">INVIOBRAS</option>
                    <option value="HIDROAMAZONAS">HIDROAMAZONAS</option>
                    <option value="SEJEU">SEJEU</option>
                    <option value="FUNDAIHIRUS">FUNDAIHIRUS</option>
                    <option value="SECRETARIA EJECUTIVA DE PROTECCION SOCIAL GOBERNACIÓN">SECRETARIA EJECUTIVA DE PROTECCION SOCIAL GOBERNACIÓN</option>
                    <option value="DESARROLLO SOCIAL ALCALDÍA">DESARROLLO SOCIAL ALCALDÍA</option>
                    <option value="GUARDIA NACIONAL BOLIVARIANA">GUARDIA NACIONAL BOLIVARIANA</option>
                    <option value="CONAS">CONAS</option>
                    <option value="FUNDACITE">FUNDACITE</option>
                    <option value="GUARDIA DEL PUEBLO">GUARDIA DEL PUEBLO</option>
                    <option value="TRANSAMAZONAS">TRANSAMAZONAS</option>
                    <option value="MOVIMIENTO DE RECREADORES">MOVIMIENTO DE RECREADORES</option>
                    <option value="GRAN MISION CUADRANTES DE PAZ">GRAN MISION CUADRANTES DE PAZ</option>
                    <option value="DIRECCIÓN DE PREVENCIÓN DEL DELITO">DIRECCIÓN DE PREVENCIÓN DEL DELITO</option>
                    </select>



                  </div>
                  <div class="row">


                    <div class="mb-2 col">
                      <label for="ecargado" class="form-label">Persona encargada</label>
                      <input type="text" class="form-control" id="ecargado">
                    </div>

                    <div class="mb-2 col">
                      <label for="telefonos" class="form-label">Telefono</label>
                      <input type="number" class="form-control" id="telefonos">
                    </div>


                  </div>


                  <div class="mb-2">
                    <label for="vetices" class="form-label">Vértice</label>
                    <select class="form-control" id="vetices">
                      <option value="">Seleccione</option>
                    </select>
                  </div>


                </div>
                <div class="modal-footer">
                  <a class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                  <a id="crearTarea" onclick="nuevoRegistro()" class="btn btn-primary">Crear</a>
                </div>

              </div>
            </div>
          </div>



          <div class="modal fade" id="accionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title">Nueva acción</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="max-height: 500px; overflow: auto;">


                  <div class="mb-2">
                    <label for="s_tarea" class="form-label">Tarea</label>
                    <select class="form-control" id="s_tarea" onchange="setTipoJornada(this.value)">
                      <option value="">Seleccione</option>
                    </select>
                  </div>

                  <div class="mb-2">
                    <label for="s_acciones" class="form-label">Acciones</label>
                    <select class="form-control" id="s_acciones">
                      <option value="">Seleccione</option>
                    </select>
                  </div>

                  <div class="mb-2">
                    <label for="s_fecha" class="form-label">Fecha</label>
                    <input type="date" id="s_fecha" class="form-control">
                  </div>




                  <section id="inpPersonasAtendidas" style="display: none;">
                    <div class="mb-2">
                      <label for="s_atendidos" class="form-label">Personas atendidas</label>
                      <input type="number" class="form-control" id="s_atendidos">
                    </div>
                  </section>



                </div>
                <div class="modal-footer">
                  <a class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                  <a id="crearTareaAccion" onclick="nuevoRegistroAccion()" class="btn btn-primary">Crear</a>
                </div>

              </div>
            </div>
          </div>



        </div>
      </div>

      <!--
      <div class="mb-2">
        <label for="acciones" class="form-label">Aciones</label>
        <select class="form-control" id="acciones" >
          <option value="">Seleccione</option>
        </select>
      </div>
      
      <section id="inpPersonasAtendidas" style="display: none;">
      <div class="mb-2">
        <label for="atendidos" class="form-label">Personas atendidas</label>
        <input type="number" class="form-control" id="atendidos">
      </div>
      </section>

-->



      </div>
    </main>

    <!--   Core JS Files   -->
    <script src="../../../assets/js/core/popper.min.js"></script>
    <script src="../../../assets/js/core/bootstrap.min.js"></script>
    <script src="../../../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../../../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
      var vertices_j = {
        1: 'TERRITORIAL Y ORGANIZACIÓN POPULAR',
        2: 'EDUCACION',
        3: 'SALUD',
        4: 'PROTECCIÓN',
        5: 'MUJER Y FAMILIA',
        6: 'HABITAT, VIVIENDA Y ECOSOCIALISMO',
        7: 'EMPRENDIMIENTO, TRABAJO Y PRODUCCION',
        8: 'JUVENTUD Y DEPORTE',
        9: 'CULTURA Y ESPIRITUALIDAD',
        10: 'ALIMENTACIÓN',
        11: 'INFRAESTRUCTURA SOCIAL Y SERVICIOS PUBLICOS'
      };

      var vertices_m = {
        3: 'SALUD',
        4: 'PROTECCIÓN',
        10: 'ALIMENTACIÓN'
      }

      var m_index = [3, 4, 10]



      var acciones_v1 = [
        ["RENOVACIÓN DE CONSEJO COMUNAL", '1-1', '0'],
        ["PLAN DE DESARROLLO COMUNITARIO", '1-2', '0'],
        ["CONFORMACION O ACTIVACION BRIGADA MOV SOMOS VENEZUELA", '1-3', '0'],
        ["ELABORAR CUADERNILLO", '1-4', '0'],
        ["ELABORAR MAQUETA, CROQUIS Y MAPA", '1-5', '0'],
        ["REALIZAR CARTOGRAFIA DIGITAL (GITCOM) GEOREFERENCIACION, REGISTRO Y ANALISIS DE DATOS", '1-6', '0'],
        ["GEORREFERENCIACIÓN DE LAS BMS", '1-7', '0'],
        ["CARTOGRAFIA DIGITAL (GITCOM) ACTUALIZACION", '1-8', '0'],
        ["ACTIVACION DE VOCEROS DE PLANIFICACION DEL CONSEJO COMUNAL", '1-9', '0'],
        ["ELABORAR MATRIZ DE NUDOS CRITICOS Y SOLUCIONES POR VÉRTICE", '1-10', '0'],
        ["ELABORAR AGENDA CONCRETA DE ACCIÓN", '1-11', '0'],
        ["REGISTRAR ACA EN EL MINISTERIO DEL PP PARA LA PLANIFICACIÓN", '1-12', '0'],
        ["INSTALACIÓN DEL SISTEMA DE MISIONES COMUNAL", '1-13', '0'],
        ["PROYECTOS CARGADOS FCI", '1-14', '0'],
        ["SEGUIMIENTO A PROYECTOS APROBADOS FCI", '1-15', '0']
      ]

      var acciones_v2 = [
        ["IDENTIFICAR Y CAPTAR NO ESCOLARIZADOS ", "2-1", "0"],
        ["GESTION DE INSCRIPCION DE NIÑOS NO ESCOLARIZADOS", "2-2", "0"],
        ["IDENTIFICAR Y CAPTAR NNA SIN ACTA DE NACIMIENTO Y C.I.", "2-3", "0"],
        ["GESTION NUEVAS ACTAS DE NACIMIENTO NNA", "2-4", "0"],
        ["GESTION NUEVAS CEDULAS NNA", "2-5", "0"],
        ["DATOS DEL RESPONSABLE DE LA CALIDAD  EDUCATIVA COMUNAL  (EL PERFIL DEBE SER UN CAMARADA DOCENTE ACTIVO GANADO AL TRABAJO SOCIAL)", "2-6", "0"],
        ["CENSO DE PROFESIONALES ACTIVOS Y QUE DESEEN INCORPORARSE COMO FACILITADORES DE LAS MISIONES EDUCATIVAS", "2-7", "0"],
        ["CENSO DE BACHILLERES QUE NO ESTUDIAN EN LA UNIVERSIDAD", "2-8", "0"],
        ["GESTION NUEVO INGRESO A UNIVERSIDADES", "2-9", "0"],
        ["CENSO DE ESTUDIANTES UNIVERSITARIOS SIN BECAS", "2-10", "0"],
        ["GESTION NUEVAS BECAS", "2-11", "0"],
        ["CENSO DE BACHILLERES SIN CARNET DE LA PATRIA", "2-12", "0"],
        ["GESTION NUEVO CARNET DE LA PATRIA DIGITAL A BACHILLERES", "2-13", "0"],
        ["ACTIVACIÓN DE AMBIENTES DE FORMACIÓN DE LAS MISIONES EDUCATIVAS", "2-14", "0"],
        ["CARGA Y VERIFICACIÓN DE REPORTES VENAPP EDUCACIÓN", "2-15", "0"],
      ]


      var acciones_v3 = [
        ["REVISION DE CASOS VULNERABLES O PACIENTES CRONICOS SALUD", "3-1", "0"],
        ["VISITAS A PACIENTES ENCAMADOS", "3-2", "0"],
        ["APOYO A CASOS ENCAMADOS", "3-3", "0"],
        ["ENTREGA DE MEDICINAS CASOS VULNERABLES O PACIENTES CRONICOS", "3-4", "0"],
        ["CARGA DE REPORTES VENAPP SALUD", "3-5", "0"],
        ["REVISIÓN DE REPORTES VENAPP DE SALUD", "3-6", "0"],
        ["CALIFICACION A PERSONAS CON DISCAPACIDAD", "3-7", "0"],
        ["ATENCION CON ECOSONOGRAMA A MUJERES EMBARAZADAS (RUTA MATERNA)", "3-8", "0"],
        ["ATENCION DE EMBARAZADAS Y LACTANTES CON VITAMINAS Y OTROS", "3-9", "0"],
        ["VERIFICACION DE PACIENTES PARA PLAN QUIRURGICO", "3-10", "0"]
      ]
      var acciones_v4 = [
        ["VERIFICAR Y ACTIVAR COMITE DE PERSONAS CON DISCAPACIDAD", "4-1", "0"],
        ["DIAGNOSTICO DE AYUDAS TECNICAS REQUERIDAS", "4-2", "0"],
        ["REPORTE Y VERIFICACIONDE NECESIDAD DE AYUDAS TECNICAS EN VENAPP", "4-3", "0"],
        ["REPARACION DE AYUDAS TECNICAS ( SILLAS DE RUEDAS, ANDADERAS)", "4-4", "0"],
        ["ASESORÍA JURIDICO A PERSONAS CON DISCAPACIDAD", "4-5", "0"],
        ["IDENTIFICACION DE PCD NO CARNETIZADAS CARNET DE LA PATRIA", "4-6", "0"],
        ["IDENTIFICACION DE GESTANTES Y LACTANTES CON Y SIN PROTECCION SOCIAL", "4-7", "0"],
        ["IDENTIFICACION DE PERSONAS CON DISCAPACIDAD SIN CARNET", "4-8", "0"],
        ["VERIFICACION DE BONOS A PERSONAS CON DISCAPACIDAD", "4-9", "0"],
        ["IDENTIFICACION DE PERSONAS ENCAMADAS ( ADULTO MAYOR)", "4-10", "0"],
        ["IDENTIFICACION DE JOVENES A PARTIR DE 15 AÑOS DE EDAD Y ADULTOS QUE NO POSEEN CARNET DE LA PATRIA", "4-11", "0"],
        ["REVISIÓN DE REPORTES VENAPP DE AYUDAS TÉCNICAS", "4-12", "0"],
        ["VERIFICACION DE JEFAS DE FAMILIA CON Y SIN PROTECCIÓN HOGARES DE LA PATRIA", "4-13", "0"],
        ["JORNADA DE ESCANEO, RESETEO Y ACTUALIZACION DE CUENTAS EN SISTEMA PATRIA", "4-14", "0"],
      ]
      var acciones_v5 = [
        ["ESTATUS DE LAS MISIONES, INSTITUCIONES O PROGRAMAS SOCIALES DE ATENCION A LA MUJER Y LA FAMILIA ACTIVOS EN LA COMUNIDAD.", "5-1", "0"],
        ["ACTIVIDADES ECONOMICAS PRODUCTIVAS DE LAS MUJERES", "5-2", "0"],
        ["FORMACION A MUJERES EMRENDEDORAS, O PARA PROMOVER ALGUN OFICIO", "5-3", "0"],
        ["REVISION Y CONFORMACION DE CONSEJOS FEMINISTAS/COMITES DE MUJERES", "5-4", "0"],
        ["REVISIÓN Y FORMACION DE PROMOTORAS DE PARTO HUMANIZADO", "5-5", "0"],
        ["REVISION Y ACTIVACIÓN DEL COMITE DE FAMILIA E IGUALDAD DE GENERO", "5-6", "0"],
        ["REVISAR LIDERESAS DE HOGARES DE LA PATRIA", "5-7", "0"],
        ["REVISAR Y FORMACIÓN DE DEFENSORAS COMUNALES DE LOS DERECHOS HUMANOS DE LA MUJER.", "5-8", "0"],
        ["REVISAR SI POSEEN DATA DE GESTANTES Y LACTANTES.", "5-9", "0"],
        ["IDENTIFICACION DE ADOLESCENTES EMBARAZADAS", "5-10", "0"],
        ["IDENTIFICAR SI EXISTEN EMBARAZADAS DE ALTO RIESGO MENORES DE 18 AÑOS", "5-11", "0"],
        ["IDENTIFICAR SI EXISTEN EMBARAZADAS DE ALTO RIESGO MAYORES DE 18 AÑOS", "5-12", "0"],
        ["IDENTIFICAR PARTERAS O PARTEROS", "5-13", "0"],
        ["IDENTIFICAR CIRCULOS DE GESTANTES Y MADRES AMAMANTADORAS", "5-14", "0"],
        ["TALLER DE PLANIFICACION FAMILIAR", "5-15", "0"],
        ["TALLER SOBRE EDUCACION SEXUAL REPRODUCTIVA Y METODOS ANTICONCEPTIVOS.", "5-16", "0"],
        ["FORMALIZACION JURIDICA DE EMPRENDIMIENTOS", "5-17", "0"],
        ["IDENTIFICAR MUJERES, NNA, PARA ATENCION JURIDICA Y/O PSICOLOGICA.", "5-18", "0"],
        ["IDENTIFICAR MUJER VICTIMA DE VIOLENCIA DE GENERO O VIOLENCIA INTRAFAMILIAR.", "5-19", "0"],
        ["IDENTIFICAR NNA VICTIMAS DE VIOLENCIA", "5-20", "0"],
        ["COORDINACION CON RUTA MATERNA E INN PARA ATENCION DE EMBARAZADAS Y LACTANTES", "5-21", "0"]
      ]
      var acciones_v6 = [
        ["TALLER AL COMITÉ DE VIVIENDA Y AL COMITÉ DE TIERRA URBANA GMVV ", "6-1", "0"],
        ["GESTIONES Y EXPEDIENTES PARA TITULO DE TIERRA URBANA", "6-2", "0"],
        ["ENTREGA DE TITULOS DE TIERRA URBANA ", "6-3", "0"],
        ["DOCUMENTO DE PROPIEDAD DE VIVIENDA (BANAVIH- INVIOBRAS)", "6-4", "0"],
        ["ENTREGA DE TITULOS DE PROPIEDAD MULTIFAMILIAR EN URBANISMOS GMVV ", "6-5", "0"],
        ["CERTIFICACIÓN DE ASAMBLEA VIVIENDO VENEZOLANO", "6-6", "0"],
        ["VIVIENDAS POR SER ADAPTADAS A PERSONAS CON DISCAPACIDAD", "6-7", "0"],
        ["CONFORMACION DE BRIGADA GUARDIANES DEL ARBOL Y CAMBIO CLIMATICO", "6-8", "0"],
        ["CONFORMCION DE METRAS", "6-9", "0"],
        ["ESPACIO RECUPERADO CON NUEVOS ARBOLES SEMBRANDOS", "6-10", "0"],
        ["LIMPIEZA DE ZONAS INSALUBRES O CON CHATARRA", "6-11", "0"],
        ["LIMPIEZA DE CANALES Y QUEBRADAS", "6-12", "0"],
        ["PROMOCION Y GESTION DEL PLAN CREDITECHO", "6-13", "0"],
        ["INSPECCIÓN A FAMILIAS CON CASOS DE EXTREMA VULNERABILIDAD", "6-14", "0"],
        ["GESTION DE SOLUCION A CASOS DE EXTREMA VULNERABILIDAD", "6-15", "0"]
      ]
      var acciones_v7 = [
        ["REGISTRO DE EMPRENDEDORES EN PEQUEÑAS Y MEDIANA EMPRESA, UPF, EPS", "7-1", "0"],
        ["ASESORÍA Y TALLER PARA REGISTRO EN PAGINA DE EMPRENDER JUNTOS", "7-2", "0"],
        ["FORMACION DE EMPRENDEDORES EN DIVERSAS AREAS", "7-3", "0"],
        ["CONFORMAR EL MOVIMIENTO DE EMPRENDEDORES", "7-4", "0"],
        ["IDENTIFICAR PATIOS PRODUCTIVOS", "7-5", "0"],
        ["FORMACION PARA EL MEJORAMIENTO DE LOS PATIOS PRODUCTIVOS", "7-6", "0"],
        ["IDENTIFICAR POTENCIALIDADES PRODUCTIVAS DE LA COMUNIDAD Y GENERAR IDEAS PARA SU DESARROLLO", "7-7", "0"]
      ]
      var acciones_v8 = [
        ["CONFORMACIÓN DE BRIGADAS DE CHAMBA JUVENIL", "8-1", "0"],
        ["CONFORMACIÓN DE  QUINTETOS DEPORTIVOS", "8-2", "0"],
        ["CAPTACIÓN Y FORMACIÓN DE RECREADORES", "8-3", "0"],
        ["FORMACIÓN Y CERTIFICACION DE JOVENES ESTILISTAS Y BARBEROS", "8-4", "0"],
        ["ASESORIA A JOVENES CON EMPRENDIMIENTO", "8-5", "0"],
        ["CAPTACIÓN Y FORMACIÓN DEL JOVEN COMUNERO", "8-6", "0"],
        ["CAPTACIÒN Y FORMACIÓN DE JOVENES VULNERABLES", "8-7", "0"],
        ["PROMOCION Y CAPTACIÓN DE ESTUDIANTES  A CARRERAS PRIORIZADAS", "8-8", "0"],
        ["CAPTACIÒN DE JOVENES AL APRESTO MILITAR ", "8-9", "0"]
      ]
      var acciones_v9 = [
        ["CONFORMACIÓN DE BRIGADAS DE CHAMBA JUVENIL", "9-1", "0"],
        ["CONFORMACIÓN DE  QUINTETOS DEPORTIVOS", "9-2", "0"],
        ["CAPTACIÓN Y FORMACIÓN DE RECREADORES", "9-3", "0"],
        ["FORMACIÓN Y CERTIFICACION DE JOVENES ESTILISTAS Y BARBEROS", "9-4", "0"],
        ["ASESORIA A JOVENES CON EMPRENDIMIENTO", "9-5", "0"],
        ["CAPTACIÓN Y FORMACIÓN DEL JOVEN COMUNERO", "9-6", "0"],
        ["CAPTACIÒN Y FORMACIÓN DE JOVENES VULNERABLES", "9-7", "0"],
        ["PROMOCION Y CAPTACIÓN DE ESTUDIANTES  A CARRERAS PRIORIZADAS", "9-8", "0"],
        ["CAPTACIÒN DE JOVENES AL APRESTO MILITAR ", "9-9", "0"]
      ]
      var acciones_v10 = [
        ["ALCANZAR EL 100% DE PROTECCIÓN POR EL INN DE LOS CASOS CON VULNERABILIDAD NUTRICIONAL. ", "10-1", "0"],
        ["FORMAR NUEVOS PROMOTORES NUTRICIONALES. ", "10-2", "0"],
        ["ENTREGAR SUPLEMENTOS ALIMENTICIOS A CASOS DE BAJO PESO. ", "10-3", "0"],
        ["ACTUALIZAR EL 100% DE LOS CENSO CLAP. ", "10-4", "0"],
        ["ACTUALIZAR LA DATA Y REGISTRO DE LOS JEFES DE CLAP.", "10-5", "0"],
        ["REGISTRO Y CARACTERIZACIÓN DE LOS ESPACIOS PRODUCTIVOS DE LOS CLAP. ", "10-6", "0"],
        ["VERIFICAR SI HAY CASAS DE ALIMENTACIÓN, Y SI ESTÁ EN UN PUNTO Y CIRCULO DE UNA BASE DE MISIONES Y EL NÚMERO DE MISIONEROS. ", "10-7", "0"],
        ["ACTUALIZACION DE LA DATA DE MISIONEROS DE LA CASA DE ALIMENTACION", "10-8", "0"],
        ["ACTUALIZACIÓN DE LOS VOCEROS DE ALIMENTACIÓN EN LAS BASES DE MISIONES. ", "10-9", "0"],
        ["REALIZAR INSPECCIONES A LOS CLAP Y PUNTOS DE ALMACENAMIENTOS DE ALIMENTOS FRIO Y SECO. ", "10-10", "0"],
        ["PROGRAMACIÓN DE LA FERIA DEL CAMPO SOBERANO, Y REPORTAR FECHA DE EJECUCIÓN. ", "10-11", "0"],
        ["REGISTRO DE EMPRENDEDORES Y UNIDADES DE PRODUCCIÓN AGROPECUARIAS. (SUNAGRO)", "10-12", "0"],
        ["ACTIVACIÓN DE ESPACIOS COMUNITARIOS O FAMILIARES CON PRODUCCIÓN AGRÍCOLA, PECUARIA, OTRO", "10-13", "0"]
      ]
      var acciones_v11 = [
        ["INSPECCION DE BASES DE MISIONES EXITENTES Y NUEVAS PROPUESTAS", "11-1", "0"],
        ["REHABILITACION DE ESPACIOS PARA NUEVAS BMS", "11-2", "0"],
        ["CONFORMACION MESA TECNICA DE AGUA", "11-3", "0"],
        ["CONFORMACION MESA TECNICA DE ENERGIA", "11-4", "0"],
        ["CONFORMACION MESA TECNICA DE TELECOMUNICACIONES", "11-5", "0"],
        ["REPORTES VENAPP CASOS AGUA, VIALIDAD, ELECTRICIDAD", "11-6", "0"],
        ["SOLUCION DE CASOS VENAPP AGUA", "11-7", "0"],
        ["SOLUCION DE CASOS VENAPP ELECTRICIDAD", "11-8", "0"],
        ["ELABORACION DE FICHA TECNICA DE PROYECTOS: AGUA, ELECTRICIDAD, VIALIDAD", "11-9", "0"],
      ]





      function setTipoTarea(value) {
        $('#vetices').html('<option value="">Seleccione</option>')
        if (value == 'Jornada') {
          for (let index = 1; index < 12; index++) {
            $('#vetices').append('<option value="' + index + '">' + vertices_j[index] + '</option>')
          }
          $('#inpPersonasAtendidas').hide(300)

        } else if (value == 'MicroJornada') {
          m_index.forEach(element => {
            $('#vetices').append('<option value="' + element + '">' + vertices_m[element] + '</option>')
          });
          $('#inpPersonasAtendidas').show(300)
        }
      }


      function setVertice(value) {
        $('#s_acciones').html('<option value="">Seleccione</option>')
        var arrayOpt;

        if (value == '1') {
          arrayOpt = acciones_v1;
        } else if (value == '2') {
          arrayOpt = acciones_v2;
        } else if (value == '3') {
          arrayOpt = acciones_v3;
        } else if (value == '4') {
          arrayOpt = acciones_v4;
        } else if (value == '5') {
          arrayOpt = acciones_v5;
        } else if (value == '6') {
          arrayOpt = acciones_v6;
        } else if (value == '7') {
          arrayOpt = acciones_v7;
        } else if (value == '8') {
          arrayOpt = acciones_v8;
        } else if (value == '9') {
          arrayOpt = acciones_v9;
        } else if (value == '10') {
          arrayOpt = acciones_v10;
        } else if (value == '11') {
          arrayOpt = acciones_v11;
        }

        arrayOpt.forEach(element => {
          $('#s_acciones').append('<option value="' + element[1] + '">' + element[0] + '</option>')
        });
      }


      /* FUNCIONES A ELIMINAR */


      function borrarTarea(id, tipo) {

        Swal.fire({
          title: '¿Está seguro?',
          html: 'Se eliminara el registro definitivamente.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#ed5264',
          cancelButtonColor: '#a9a9a9',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Continuar'
        }).then((result) => {
          if (result.isConfirmed) {


            $.get("ajax/deleteTarea.php", "id=" + id + '&he=' + "<?php echo $he ?>" + '&accion=' + tipo, function(data) {
              if (data.trim() == '1') {
                toast("success", "El registro se eliminó correctamente");
                actualizarTabla()
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
    <script src="../../../assets/js/material-dashboard.min.js?v=3.0.2"></script>
  </body>

  </html>


<?php
} else {

  define('PAGINA_INICIO', '../../../index.php');
  header('Location: ' . PAGINA_INICIO);
}
?>