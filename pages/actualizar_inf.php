<?php
include('../configuracion/conexionMysqli.php');
include('../class/count.php');

unset($_SESSION['proyecto']);
if ($_SESSION['nivel'] == '3') {
  $idUser = $_SESSION['id'];


?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/SLS.png">
    <title class="cartografia" id="title">
      Proyectos GITCOM
    </title>
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

      .table thead th {
        padding: 8px !important;
        color: #344767 !important;
        text-transform: uppercase;
        font-size: 12.4px !important;
      }

      td {
        font-size: 13px !important;
      }

      table {
        padding-top: 0;
      }

      .highlight {
        background-color: yellow;
        font-weight: bold;
      }

      .bb {
        border-bottom: 1px solid #d3d3d3d1;
      }
    </style>

    <style>
      .form-control {
        color: gray !important;
      }

      .multiselect {
        position: relative;
        min-width: 100%;
        white-space: nowrap;
      }

      .selectBox {
        position: relative;
      }

      .selectBox select {
        width: 100%;
      }

      .overSelect {
        position: absolute;
        cursor: pointer;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
      }

      #checkboxes,
      #checkboxes2,
      #checkboxes3,
      #checkboxes4 {
        display: block;
        border: 1px #dadada solid;
        border-top: none;
        margin-top: -5px;
        position: absolute;
        width: 100%;
        background-color: white;
        box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.1);
        z-index: 99;
        box-sizing: border-box;
        overflow-y: auto;
        min-width: 100%;
        white-space: nowrap;
        border-bottom-right-radius: 5px;
        border-bottom-left-radius: 5px;
      }

      #checkboxes.hide,
      #checkboxes2.hide,
      #checkboxes3.hide,
      #checkboxes4.hide {
        display: none;
      }



      #checkboxes label,
      #checkboxes2 label,
      #checkboxes3 label,
      #checkboxes4 label {
        display: block;
        padding: 5px;

      }


      #checkboxes label:hover,
      #checkboxes2 label:hover,
      #checkboxes3 label:hover,
      #checkboxes4 label:hover {
        background-color: #ed5264;
        cursor: pointer;
        color: white;
      }



      .ck {
        margin: 4px 5px 0 0;
      }

      .lbCk {
        margin-bottom: 0 !important;
      }

      .hover-danger:hover {
        color: #ed5264;
      }
    </style>
  </head>

  <body class="g-sidenav-show  bg-gray-200" id="table-container">
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
        <div class="row" id="vista_1">
          <div class="col-lg-5 mb-3">
            <div class="card" style="min-height: 238px;">
              <div class="card-body d-flex justify-content-center flex-wrap ps-xl-15 pe-0">
                <div class="flex-grow-1 me-9 me-md-0">
                  <h3 class="position-relative fw-bold mb-2">
                    Buscar por cédula
                  </h3>
                  <span class="fw-semibold fs-5  mb-4 d-block">
                    <input type="text" class="form-control" id="cedula_buscar" style="max-width: 90%;" placeholder="Ingrese el numero de cédula">
                  </span>
                  <button id='btn-cedula' class="btn btn-sm btn-primary fw-semibold ">
                    Buscar
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
                    Datos sin actualizar:
                    <span class="text-danger" id="contador_pendientes">0</span>
                  </h3>

                  <span class="text-gray-600 fw-semibold fs-5 mb-4 d-block">
                    Despliegue la lista de datos por actualizar.
                  </span>

                  <button id="btn-enlistar" class="btn btn-sm btn-primary fw-semibold ">
                    Ver lista
                    </button=>
                </div>

                <img src="../assets/img/Paper-map-pana.svg" class="me-4" width="190px">
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card">

              <div class="ventana-header pb-0 px-3 ">

                <div class="card-title  d-flex justify-content-between">
                  <h5 class="fw-bold mb-1" style="font-size: 17.5px;">Habitantes y viviendas de la comunidad</h5>
                  <input type="text" style="max-width: 30%;" class="form-control" id="buscador" placeholder="Buscar en la tabla...">
                </div>



              </div>
              <div class="card-body p-3 min-vh-50">

                <div class="table-responsive">
                  <!--begin::Table-->
                  <table class="table table-row-bordered table-row-dashed gy-4" style="min-height: 30vh;">
                    <thead class="fs-7 text-gray-400 text-uppercase">
                      <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>Cédula</th>
                        <th>Rol familiar</th>
                        <th>Teléfono</th>
                        <th>Estatus</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody class="fs-5" id="table">

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row" id="vista_2" style="display: none;">
          <div class="col-lg-12">
            <div class="card h-100 mb-4">
              <div class="card-body pt-4 p-3">
                <form id="formulario">



                  <h6 class="mb-3 mt-2">Datos personales</h6>
                  <div class="row">
                    <div class="col-lg-4">

                      <label class="control-label">Cedula</label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;border: 1px solid #d8d8d8; color: #9c9c9c; max-width: 10%; margin-right: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px;" class="form-control" id="nacionalidad">
                          <option value="V">V</option>
                          <option value="E">E</option>
                        </select>
                        <input disabled placeholder="Numero de cedula" class="form-control" type="number" id="cedula">
                      </div>

                      <script>
                        function mfced(valor) {
                          let numCed = $('#cedula').val()
                          if (numCed.indexOf(valor) != -1) {
                            $('#cedula').val('');
                            return 1;
                          }
                          return 0;

                        }
                      </script>


                      <label class="control-label">Nombre </label>
                      <div class="input-group input-group-outline my-2">
                        <input disabled placeholder="Nombre del jefe de familia" class="form-control" type="text" id="nombre">
                      </div>



                      <label class="control-label">Fecha de nacimiento </label>
                      <div class="input-group input-group-outline my-2">
                        <input disabled class="form-control" type="date" style="color: gray;" id="fecha_de_nacimiento">
                      </div>
                    </div>

                    <div class="col-lg-4">


                      <section class="mas17">

                        <label class="control-label">Telefono </label>
                        <div class="input-group input-group-outline my-2">
                          <input placeholder="Numero de telefono" class="form-control" type="number" id="telefono" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11">
                        </div>

                      </section>




                      <label class="control-label">Residencia en el sector desde (aprox)</label>
                      <div class="input-group input-group-outline my-2">
                        <input class="form-control" type="date" style="color: gray;" id="tiempo_reside_sector">
                      </div>



                      <label class="control-label">Pueblo Indigena </label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" class="form-control" id="pueblo_indigena">
                          <option value="Ninguno">Ninguno</option>
                          <option value="Baniva">Baniva</option>
                          <option value="Bare">Bare</option>
                          <option value="Cubeo">Cubeo</option>
                          <option value="Curripaco">Curripaco</option>
                          <option value="Eñapa">Eñapa</option>
                          <option value="Guanano">Guanano</option>
                          <option value="Hotti">Hotti</option>
                          <option value="Inga">Inga</option>
                          <option value="Jivi">Jivi</option>
                          <option value="Piapoco">Piapoco</option>
                          <option value="Piaroa">Piaroa</option>
                          <option value="Puinave">Puinave</option>
                          <option value="Saliva">Saliva</option>
                          <option value="Sanema">Sanema</option>
                          <option value="Warequena">Warequena</option>
                          <option value="Yabarana">Yabarana</option>
                          <option value="Yanomami">Yanomami</option>
                          <option value="Yavitero">Yavitero</option>
                          <option value="Yecuana">Yecuana</option>
                          <option value="Yeral">Yeral</option>
                        </select>
                      </div>


                    </div>
                    <div class="col-lg-4">

                      <label class="control-label">Sexo </label>
                      <div class="input-group input-group-outline my-2">
                        <select disabled class="form-control" id="sexo">
                          <option value="">Seleccione</option>
                          <option value="Masculino">Masculino</option>
                          <option value="Femenino">Femenino</option>
                        </select>
                      </div>
                      <script>
                        $(document).ready(function() {
                          $('#sexo').on('change', function() {
                            var sexo = document.getElementById('sexo').value
                            if (sexo == 'Masculino') {
                              document.getElementById('genero').value = 'Masculino'
                            } else [
                              document.getElementById('genero').value = 'Femenino'
                            ]

                          });
                        });
                      </script>

                      <div class="mas14">
                        <label class="control-label">Genero </label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" class="form-control" id="genero">
                            <option value="">Seleccione</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="nb">No Binario</option>
                          </select>
                        </div>
                      </div>

                      <script>
                        $(document).ready(function() {
                          $('#nacionalidad').on('change', function() {
                            var nacionalidad = document.getElementById('nacionalidad').value
                            if (nacionalidad == 'E') {
                              $('#paisOrigenDiv').show(300)
                            } else [
                              $('#paisOrigenDiv').hide(300)
                            ]

                          });
                        });
                      </script>
                      <section id="paisOrigenDiv" style="display: none;">

                        <label class="control-label">Pais Origen </label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" class="form-control" id="paisOrige">
                            <option value="">Seleccione</option>
                            <optgroup label="America">
                              <option value="Colombia">Colombia</option>
                              <option value="Brasil">Brasil</option>
                              <option value="Chile">Chile</option>
                              <option value="Peru">Peru</option>
                              <option value="Argentina">Argentina</option>
                              <option value="Cuba">Cuba</option>
                              <option value="Uruguay">Uruguay</option>
                              <option value="Ecuador">Ecuador</option>
                              <option value="Bolivia">Bolivia</option>
                              <option value="Costa Rica">Costa Rica</option>
                              <option value="Paraguay">Paraguay</option>
                              <option value="Puerto Rico">Puerto Rico</option>
                              <option value="Honduras">Honduras</option>
                              <option value="Jamaica">Jamaica</option>
                              <option value="Belice">Belice</option>
                              <option value="El Salvador">El Salvador</option>
                              <option value="Guatemala">Guatemala</option>
                              <option value="Panamá">Panamá</option>
                              <option value="Nicaragua">Nicaragua</option>
                              <option value="República Dominicana">República Dominicana</option>
                              <option value="Haití">Haití</option>
                              <option value="Bahamas">Bahamas</option>
                              <option value="Aruba">Aruba</option>
                              <option value="Surinam">Surinam</option>
                              <option value="Guyana">Guyana</option>
                              <option value="Barabados">Barabados</option>
                              <option value="Guayana Francesa">Guayana Francesa</option>
                              <option value="Trinidad y Tobago">Trinidad y Tobago</option>
                              <option value="Mexico">Mexico</option>
                              <option value="Canada">Canada</option>
                              <option value="Estados Unidos">Estados Unidos</option>
                            </optgroup>
                          </select>
                        </div>
                      </section>


                    </div>

                  </div> <!-- End of row  -->


                  <h6 class="mb-3 mt-5">Educación y Ocupación</h6>
                  <div class="row">
                    <div class="col-lg-4 mas6">
                      <label class="control-label">Educación </label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;border: 1px solid #d8d8d8; color: #9c9c9c;" class="form-control" id="educacion">

                          <option value="">Seleccione</option>

                          <optgroup label="Actualmente estudiando">
                            <option value="Cursando Media General">Media general</option>
                            <option value="cursando Inicial">Inicial</option>
                            <option value="Misión Ribas">Misión Ribas</option>
                            <option value="Misión Robinson">Misión Robinson</option>
                            <option value="Misión Sucre">Misión Sucre</option>
                            <option value="Estudiando Universidad">Universidad</option>
                          </optgroup>


                          <optgroup label="Estudios realizados">
                            <option value="Inicial">Inicial</option>
                            <option value="Basica">Basica</option>
                            <option value="Media General">Bachiller</option>
                            <option value="Universitario">Universitario</option>
                            <option value="TSU">TSU</option>
                            <option value="Postgrados">Postgrados</option>
                            <option value="Especialización">Especialización</option>
                          </optgroup>

                          <optgroup label="Estudios Incompletos">
                            <option value="Media General Incompleto">Media General Incompleto</option>
                            <option value="Postgrado Incompleto">Postgrado Incompleto</option>
                            <option value="Universitario Incompleto">Universitario Incompleto</option>
                          </optgroup>

                          <optgroup label="">
                          </optgroup>

                          <option value="No Escolarizado Inicial a Media General">No Escolarizado Inicial a Media General</option>
                          <option value="Sin estudio">Sin estudio</option>


                        </select>
                      </div>

                      <script>
                        $(document).ready(function() {
                          $('#educacion').on('change', function() {
                            var educacion = document.getElementById('educacion').value


                            if (educacion == 'Universitario' || educacion == 'Postgrados' || educacion == 'Especialización' || educacion == 'Postgrado Incompleto') {
                              $('#profesionDiv').show(300)
                            } else {
                              $('#profesionDiv').hide(300)
                              $('#profesion').val('Ninguna')
                            }

                          });
                        });
                      </script>





                      <div id="profesionDiv" style="display: none;">
                        <label class="control-label">Profesión </label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;border: 1px solid #d8d8d8; color: #9c9c9c;" class="form-control" id="profesion">
                            <option value="">Seleccione</option>
                            <option value="Abogado">Abogado</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Arquitecto">Arquitecto</option>
                            <option value="Contador">Contador</option>
                            <option value="Educador">Educador</option>
                            <option value="Enfermeros">Enfermero</option>
                            <option value="Gestion Ambiental">Gestion Ambiental</option>
                            <option value="Gestion Social">Gestion Social</option>
                            <option value="Ingeniero">Ingeniero</option>
                            <option value="Medico">Medico</option>
                            <option value="Odontologo">Odontologo</option>
                            <option value="Otro">Otro</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 mas6">
                      <label class="control-label">Ocupación </label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;border: 1px solid #d8d8d8; color: #9c9c9c;" class="form-control" id="ocupacion">
                          <option value="Desempleado">Desempleado</option>
                          <option value="Empleado">Empleado</option>
                          <option value="Jubilido">Jubilido</option>
                          <option value="Estudiante">Estudiante</option>
                          <option value="Obrero">Obrero</option>
                          <option value="Oficios del Hogar">Oficios del Hogar</option>
                          <option value="Trabajador por Cuenta Propia (Formal)">Trabajador por Cuenta Propia (Formal)</option>
                          <option value="Trabajador por Cuenta Propia (Informal)">Trabajador por Cuenta Propia (Informal)</option>
                        </select>
                      </div>

                      <script>
                        $(document).ready(function() {
                          $('#ocupacion').on('change', function() {
                            var ocupacion = document.getElementById('ocupacion').value


                            if (ocupacion == 'Empleado' || ocupacion == 'Jubilido') {
                              $('#intLabDiv').show(300)
                            } else {
                              $('#intLabDiv').hide(300)
                            }

                          });
                        });
                      </script>


                      <div id="intLabDiv" style="display: none;">

                        <label class="control-label">Instancia Laboral </label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;border: 1px solid #d8d8d8; color: #9c9c9c;" class="form-control" id="instancia_laboral">
                            <option value="">Seleccione</option>
                            <option value="Publico Municipal">Publico Municipal</option>
                            <option value="Publico Regional">Publico Regional</option>
                            <option value="Publico Nacional">Publico Nacional</option>
                          </select>
                        </div>

                      </div>



                    </div>
                    <div class="col-lg-4 mas17">
                      <label class="control-label2">Conformación del ingreso mensual</label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;" class="form-control" name="conf_ingreso_mensual" id="conf_ingreso_mensual">
                          <option value="">Seleccione</option>
                          <option value="Ninguno">Ninguno</option>
                          <option value="menos salario minimo">Menos de un salario minimo</option>
                          <option value="salario minimo">Salario minimo</option>
                          <option value="entre uno-tres">Entre un salario minimo y tres</option>
                          <option value="entre tres-cinco">Entre tres salarios minimos y cinco</option>
                          <option value="entre cinco-diez">Entre cinco salarios minimos y diez</option>
                          <option value="mas de diez saliros">Más de diez salios minimos</option>
                        </select>
                      </div>



                    </div>
                  </div> <!-- End of row  -->

                  <h6 class="mb-3 mt-5 mas6">Cultura y deporte</h6>
                  <div class="row">
                    <div class="col-lg-4">
                      <label class="control-label">Actividad cultural que practica </label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" class="form-control" id="realiza_actividad_cultural">
                          <option value="">Seleccione</option>
                          <option value="NINGUNA">Ninguna</option>
                          <option value="Artes Plasticas">Artes Plasticas</option>
                          <option value="Baile">Baile</option>
                          <option value="Cuenta Cuentos">Cuenta Cuentos</option>
                          <option value="Danza">Danza</option>
                          <option value="Musica">Musica</option>
                          <option value="Pintura">Pintura</option>
                          <option value="Teatro">Teatro</option>
                          <option value="Otro">Otro</option>
                        </select>
                      </div>
                      <label class="control-label">Imaginarios, Gustos Y Hábitos de Consumo Cultural </label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" class="form-control" id="imaginarios_gustos_etc">
                          <option value="">Seleccione</option>
                          <option value="Ninguno">Ninguno</option>
                          <option value="Artes Escénicas">Artes Escénicas</option>
                          <option value="Artes Visuales">Artes Visuales</option>
                          <option value="Biblioteca">Biblioteca</option>
                          <option value="Exposición a la Radio">Exposición a la Radio</option>
                          <option value="Exposición al Cine">Exposición al Cine</option>
                          <option value="Imaginarios">Imaginarios</option>
                          <option value="Literatura">Literatura</option>
                          <option value="Música">Música</option>
                          <option value="Tiempo Libre">Tiempo Libre</option>
                          <option value="Uso del Internet">Uso del Internet</option>
                          <option value="Uso del Celular">Uso del Celular</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-4 mas8">
                      <label class="control-label">Identidad religiosa </label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" class="form-control" id="creencia_reliosa">
                          <option value="">Seleccione</option>
                          <option value="Creyente Sin Religion">Creyente Sin Religion</option>
                          <option value="Adventista">Adventista</option>
                          <option value="Bahai">Bahai</option>
                          <option value="Católico">Católico</option>
                          <option value="Budissta">Budissta</option>
                          <option value="Espiritista">Espiritista</option>
                          <option value="Evangélico">Evangélico</option>
                          <option value="Islamico">Islamico</option>
                          <option value="Gnóstico">Gnóstico</option>
                          <option value="Judío">Judío</option>
                          <option value="Mason">Mason</option>
                          <option value="Palero">Palero</option>
                          <option value="Santero">Santero</option>
                          <option value="Testigo de Jehova">Testigo de Jehova</option>
                          <option value="No definido">No definido</option>
                          <option value="Ninguna (Agnostico)">Ninguna (Agnostico)</option>
                          <option value="Ninguna (Ateo)">Ninguna (Ateo)</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-4 mas6">
                      <label class="control-label">Deporte </label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" class="form-control" id="practica_deporte">
                          <option value="">Seleccione</option>
                          <option value="Ninguno">Ninguno</option>
                          <option value="Ajedrez">Ajedrez</option>
                          <option value="Atletismo">Atletismo</option>
                          <option value="Baile Deportivo">Baile Deportivo</option>
                          <option value="Baloncesto">Baloncesto</option>
                          <option value="Baloncesto">Baloncesto</option>
                          <option value="Beisbol">Beisbol</option>
                          <option value="Ciclismo">Ciclismo</option>
                          <option value="Danza Deportiva">Danza Deportiva</option>
                          <option value="Esgrima">Esgrima</option>
                          <option value="Fútbol">Fútbol</option>
                          <option value="Fútbol Sala">Fútbol Sala</option>
                          <option value="Gimnasia">Gimnasia</option>
                          <option value="Judo">Judo</option>
                          <option value="Lucha">Lucha</option>
                          <option value="Nado Sincronizado">Nado Sincronizado</option>
                          <option value="Natación">Natación</option>
                          <option value="Salto">Salto</option>
                          <option value="Softbol">Softbol</option>
                          <option value="Tenis">Tenis</option>
                          <option value="Tenis de mesa">Tenis de mesa</option>
                          <option value="Triatlón">Triatlón</option>
                          <option value="Voleibol">Voleibol</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <h6 class="mb-3 mt-5">Salud</h6>
                  <div class="row">
                    <div class="col-lg-4">
                      <label class="control-label">¿Padece alguna enfermedad? </label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" class="form-control" id="boolean_enf">
                          <option value="NO">No</option>
                          <option value="SI">Si</option>
                        </select>
                      </div>

                      <label class="control-label">¿Padece dificultad visual? </label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" class="form-control" id="dificultad_visual">
                          <option value="NO">NO</option>
                          <option value="Astigmatismo">Astigmatismo</option>
                          <option value="Cataratas">Cataratas</option>
                          <option value="Estrabismo">Estrabismo</option>
                          <option value="Glaucoma">Glaucoma</option>
                          <option value="Hipermetropia">Hipermetropia</option>
                          <option value="Miopia">Miopia</option>
                          <option value="Presbicia">Presbicia</option>
                          <option value="Pterigión (Carnosidad)">Pterigión (Carnosidad)</option>
                        </select>
                      </div>
                      <script>
                        $(document).ready(function() {
                          $('#boolean_enf').on('change', function() {
                            var boolean_enf = document.getElementById('boolean_enf').value
                            if (boolean_enf == 'SI') {
                              $('#enfermedadesDiv').show(300)
                              $('#tratamientoDiv').show(300)
                            } else {
                              $('#enfermedadesDiv').hide(300)
                              $('#tratamientoDiv').hide(300)
                              $('#enfermedades').val('')
                            }
                          });
                        });
                      </script>

                    </div>


                    <div class="col-lg-4" id="enfermedadesDiv" style="display: none;">

                      <label class="control-label">¿Que enfermedad padece? </label>
                      <div class="multiselect" style="margin-top: 6px; margin-bottom: 5px;">
                        <div class="selectBox" onclick="$('#modal_enfermedades').modal('toggle')">
                          <input style="color: gray;" type="text" class="form-control" placeholder="No padece ninguna enfermedad" id='enfermedades'>
                          <span class="hide" id="hideButtom" style="float: right; margin: -32px 10px 0 0;"><i class="fa fa-close"></i></span>
                          <div class="overSelect"></div>
                        </div>
                      </div>

                      <div id="divOtraEnf" style="display: none; margin-top: 7px;">
                        <label class="control-label">Especifique que otra enfermedad padece </label>
                        <div class="input-group input-group-outline my-2">
                          <input style="color: gray;" type="text" class="form-control" placeholder="¿Que otra enfermedad padece?" id='otraEnf'>
                        </div>
                      </div>

                      <label class="control-label">Cancer </label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" class="form-control" id="cancer">
                          <option value="NO">No</option>
                          <option value="Cabeza y Cuello">Cabeza y Cuello</option>
                          <option value="Cerebro">Cerebro</option>
                          <option value="Colorectal">Colorectal</option>
                          <option value="Cuello Uterino">Cuello Uterino</option>
                          <option value="Endometrio">Endometrio</option>
                          <option value="Estomago">Estomago</option>
                          <option value="Hepatico">Hepatico</option>
                          <option value="Higado">Higado</option>
                          <option value="Huesos">Huesos</option>
                          <option value="Leucemia">Leucemia</option>
                          <option value="Mama">Mama</option>
                          <option value="Melnoma">Melnoma</option>
                          <option value="Mieloma">Mieloma</option>
                          <option value="Ojos">Ojos</option>
                          <option value="Ovarios">Ovarios</option>
                          <option value="Pancreas">Pancreas</option>
                          <option value="Piel">Piel</option>
                          <option value="Prostata">Prostata</option>
                          <option value="Pulmon">Pulmon</option>
                          <option value="Riñon">Riñon</option>
                          <option value="Tiroides">Tiroides</option>
                          <option value="Utero">Utero</option>
                          <option value="Vagina">Vagina</option>
                          <option value="Vejiga">Vejiga</option>
                          <option value="Vulva">Vulva</option>
                        </select>
                      </div>



                    </div>
                    <div class="col-lg-4" id="tratamientoDiv" style="display: none;">

                      <label class="control-label">¿Recibe Tratamiento? </label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" class="form-control" id="recibe_tratamiento">
                          <option value="Por la Red Publica">Por la red publica</option>
                          <option value="Por la Red Privada">Por la red privada</option>
                          <option value="Por cuenta propia">Por cuenta propia</option>
                          <option value="No Recibe Tratamiento">No recibe tratamiento</option>
                        </select>
                      </div>
                    </div>
                  </div> <!-- End of row  -->

                  <h6 class="mb-3 mt-5">Protección social</h6>
                  <div class="row">
                    <div class="col-lg-4">


                      <label class="control-label2">¿Padece Deficit Nutricional? </label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;" class="form-control" id="deficit_nutricional">
                          <option value="">Seleccione</option>
                          <option value="NO">No</option>
                          <option value="SI">Si</option>

                        </select>

                      </div>


                      <script>
                        $(document).ready(function() {
                          $('#deficit_nutricional').on('change', function() {
                            var deficit_nutricional = document.getElementById('deficit_nutricional').value
                            if (deficit_nutricional == 'SI') {
                              $('#DivDeficit_nutricional').show(300)
                            } else {
                              $('#DivDeficit_nutricional').hide(300)
                            }
                          });
                        });
                      </script>

                      <div id="DivDeficit_nutricional" style="display: none">
                        <label class="control-label2">¿Recibe Combo Nutricional por el Instituto de Nutrición? </label>
                        <div class="input-group input-group-outline my-2">

                          <select style="padding-left: 10px;" class="form-control" id="combo_inn">
                            <option value="">Seleccione</option>
                            <option value="SI">Si</option>
                            <option value="NO">No</option>
                          </select>
                        </div>
                      </div>
                      <section class="mas15">

                        <label class="control-label2">¿Posee Carnet de la Patria? </label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;" class="form-control" id="carnet_patria">
                            <option value="">Seleccione</option>
                            <option value="NO">No</option>
                            <option value="SI">Si</option>
                          </select>
                        </div>

                        <script>
                          $(document).ready(function() {
                            $('#carnet_patria').on('change', function() {
                              var carnet_patria = document.getElementById('carnet_patria').value
                              if (carnet_patria == 'SI') {
                                $('#Divcarnet_patria').show(300)
                              } else {
                                $('#Divcarnet_patria').hide(300)
                              }
                            });
                          });
                        </script>

                        <div id="Divcarnet_patria" style="display: none;">


                          <label class="control-label">Codigo del carnet </label>
                          <div class="input-group input-group-outline my-2">
                            <input placeholder="Codigo del carnet" class="form-control" type="number" id="codigo_carnet" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11">
                          </div>
                          <label class="control-label">Serial del carnet </label>
                          <div class="input-group input-group-outline my-2">
                            <input placeholder="Serial del carnet" class="form-control" type="number" id="serial_carnet" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11">
                          </div>

                        </div>



                        <label class="control-label2">¿Recibe el Beneficio del Combo Alimenticio (CLAP)? </label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;" class="form-control" name="combo_alimenticio_clap" id="combo_alimenticio_clap">
                            <option value="">Seleccione</option>
                            <option value="NO">No</option>
                            <option value="SI">Si</option>
                          </select>
                        </div>

                        <script>
                          $(document).ready(function() {
                            $('#combo_alimenticio_clap').on('change', function() {
                              var combo_alimenticio_clap = document.getElementById('combo_alimenticio_clap').value
                              if (combo_alimenticio_clap == 'SI') {
                                $('#Divcombo_clap').show(300)
                              } else {
                                $('#Divcombo_clap').hide(300)
                              }
                            });
                          });
                        </script>


                        <div id="Divcombo_clap" style="display: none;">

                          <label class="control-label2"> Combos alimenticios que recibe su familia</label>
                          <div class="input-group input-group-outline my-2">
                            <input class="form-control" value="1" type='number' id='cantidadBolsas'>
                          </div>
                          <script>
                            $("#cantidadBolsas").change(function() {
                              if ($(this).val() < 1) {
                                $(this).val(1);
                              }
                            });
                          </script>
                        </div>

                      </section>



                    </div>

                    <div class="col-lg-4 mas13">


                      <div class="solo_mujer">

                        <label class="control-label">Embarazada </label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" class="form-control" id="embarazada">
                            <option value="">Seleccione</option>
                            <option value="NO">No</option>
                            <option value="SI">Si</option>
                          </select>
                        </div>
                        <script>
                          $(document).ready(function() {
                            $('#embarazadas').on('change', function() {
                              var embarazada = document.getElementById('embarazadas').value
                              if (embarazada == 'SI') {
                                $('#embarazaddDiv').show(300)
                                $('#embarazaddDiv').show(300)
                              } else {
                                $('#embarazaddDiv').hide(300)
                                $('#embarazaddDiv').hide(300)
                              }
                            });
                          });
                        </script>
                        <div id="embarazaddDiv" style="display: none;">

                          <label class="control-label2">Embarazada de Alto Riesgo</label>
                          <div class="input-group input-group-outline my-2">
                            <select style="padding-left: 10px;" class="form-control" name="Embarazada_riesgo" id="Embarazada_riesgo">
                              <option value="">Seleccione</option>
                              <option value="SI">Si</option>
                              <option value="NO">No</option>
                            </select>
                          </div>



                          <label class="control-label2">¿Recibe Bono Parto Humanizado?</label>
                          <div class="input-group input-group-outline my-2">
                            <select style="padding-left: 10px;" class="form-control" name="parto_h" id="parto_h">
                              <option value="">Seleccione</option>
                              <option value="SI">Si</option>
                              <option value="NO">No</option>
                            </select>
                          </div>

                          <label class="control-label2">Circulo de Apoyo Gestacional y de Lactancia Materna</label>
                          <div class="input-group input-group-outline my-2">
                            <select style="padding-left: 10px;" class="form-control" name="Lactancia" id="Lactancia">
                              <option value="">Seleccione</option>
                              <option value="SI">Es participante</option>
                              <option value="NO">No es participante</option>
                            </select>
                          </div>

                          <label class="control-label2">¿Semanas de embarazo?</label>
                          <div class="input-group input-group-outline my-2">
                            <select style="padding-left: 10px;" class="form-control" name="semana_emb" id="semana_emb">
                              < <option value="">Seleccione</option>
                                <option value="01">01 Semana</option>
                                <option value="02">02 Semana</option>
                                <option value="03">03 Semana</option>
                                <option value="04">04 Semana</option>
                                <option value="05">05 Semana</option>
                                <option value="06">06 Semana</option>
                                <option value="07">07 Semana</option>
                                <option value="08">08 Semana</option>
                                <option value="09">09 Semana</option>
                                <option value="10">10 Semana</option>
                                <option value="11">11 Semana</option>
                                <option value="12">12 Semana</option>
                                <option value="13">13 Semana</option>
                                <option value="14">14 Semana</option>
                                <option value="15">15 Semana</option>
                                <option value="16">16 Semana</option>
                                <option value="18">18 Semana</option>
                                <option value="19">19 Semana</option>
                                <option value="20">20 Semana</option>
                                <option value="21">21 Semana</option>
                                <option value="22">22 Semana</option>
                                <option value="23">23 Semana</option>
                                <option value="24">24 Semana</option>
                                <option value="25">25 Semana</option>
                                <option value="26">26 Semana</option>
                                <option value="27">27 Semana</option>
                                <option value="28">28 Semana</option>
                                <option value="29">29 Semana</option>
                                <option value="30">30 Semana</option>
                                <option value="31">31 Semana</option>
                                <option value="32">32 Semana</option>
                                <option value="33">33 Semana</option>
                                <option value="34">34 Semana</option>
                                <option value="35">35 Semana</option>
                                <option value="36">36 Semana</option>
                                <option value="37">37 Semana</option>
                                <option value="38">38 Semana</option>
                                <option value="39">39 Semana</option>
                            </select>
                          </div>

                        </div>

                        <label class="control-label2">¿Es una Madre Lactante?</label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;" class="form-control" name="madre_lactante" id="madre_lactante">
                            <option value="">Seleccione</option>
                            <option value="NO">No</option>
                            <option value="SI">Si</option>

                          </select>
                        </div>
                        <script>
                          $(document).ready(function() {
                            $('#madre_lactante').on('change', function() {
                              var madre_lactante = document.getElementById('madre_lactante').value
                              if (madre_lactante == 'SI') {
                                $('#DivMadreLactante').show(300)
                                $('#DivMadreLactante').show(300)
                              } else {
                                $('#DivMadreLactante').hide(300)
                                $('#DivMadreLactante').hide(300)
                              }
                            });
                          });
                        </script>

                        <div id="DivMadreLactante" style="display: none;">
                          <label class="control-label2">¿Recibe Bono Lactancia Materna? </label>
                          <div class="input-group input-group-outline my-2">
                            <select style="padding-left: 10px;" class="form-control" name="bono_lactancia" id="bono_lactancia">
                              <option>Seleccione</option>
                              <option value="NO">No</option>
                              <option value="SI">Si</option>
                            </select>
                          </div>
                        </div>


                      </div>

                      <section class="mas17">


                        <label class="control-label2">Planificación Familiar </label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;" class="form-control" name="planificacion_familiar" id="planificacion_familiar">
                            <option value="">Seleccione</option>
                            <option value="Es Participante">Es Participante</option>
                            <option value="Desea Participar">Desea Participar</option>
                            <option value="No Desea Participar">No Desea Participar</option>
                          </select>
                        </div>
                      </section>





                      <section class="mas17">
                        <label class="control-label2">¿Recibe Bono de Hogares de la Patria? </label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;" class="form-control" name="hogares_de_la_patria" id="hogares_de_la_patria">
                            <option value="">Seleccione</option>
                            <option value="NO">No</option>
                            <option value="SI">Si</option>

                          </select>
                        </div>
                      </section>




                      <div id="divPension" style="display: none">
                        <label class="control-label2">¿Es beneficiario de amor mayor? </label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;" class="form-control" id="pension">
                            <option value="">Seleccione</option>
                            <option value="SI">Si</option>
                            <option value="NO">No</option>
                          </select>
                        </div>
                      </div>




                    </div>
                    <div class="col-lg-4">





                      <label class="control-label">¿Tiene Alguna Discapacidad? </label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" class="form-control" id="discapacidad">

                          <option value="">No</option>
                          <option value="Fisica">Fisica</option>
                          <option value="Auditiva">Auditiva</option>
                          <option value="Visual">Visual</option>
                          <option value="Vohabla">Vohabla</option>
                          <option value="Intelectual">Intelectual</option>
                          <option value="Mental">Mental</option>
                          <option value="Daño Cerebral Adquirido">Daño Cerebral Adquirido</option>
                          <option value="Autismo o Asperger">Autismo o Asperger</option>
                        </select>
                      </div>

                      <script>
                        $(document).ready(function() {
                          $('#discapacidad').on('change', function() {
                            var discapacidad = document.getElementById('discapacidad').value
                            if (discapacidad != '') {
                              $('#divDiscapacidad').show(300)
                            } else {
                              $('#divDiscapacidad').hide(300)
                            }
                          });
                        });
                      </script>





                      <div id="divDiscapacidad" style="display: none;">
                        <label class="control-label">¿Posee Carnet de discapacidad? </label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" class="form-control" id="carnet_discapacidad">
                            <option value="">Seleccione</option>
                            <option value="SI">Si</option>
                            <option value="NO">No</option>
                          </select>
                        </div>


                        <label class="control-label">¿Recibe Bono José Gregorio Hernadez? </label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" class="form-control" id="recibe_bono_jose_g">
                            <option value="">Seleccione</option>
                            <option value="SI">Si</option>
                            <option value="NO">No</option>
                          </select>
                        </div>


                        <label class="control-label">¿Requiere Ayuda Tecnica? </label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;border: 1px solid #d8d8d8;border-radius: 5px; color: #9c9c9c" class="form-control" id="requiere_ayuda">
                            <option value="">Seleccione</option>
                            <option value="NO">No</option>
                            <option value="Andadera">Andadera</option>
                            <option value="Baston 1 Punto">Baston 1 Punto</option>
                            <option value="Baston 4 Puntos">Baston 4 Puntos</option>
                            <option value="Baston Rastrero">Baston Rastrero</option>
                            <option value="cama ortopedica">Cama Ortopedica</option>
                            <option value="Centro de Cama">Centro de Cama</option>
                            <option value="Coche Ortopedico">Coche Ortopedico</option>
                            <option value="Lupa">Lupa</option>
                            <option value="Muletas">Muletas</option>
                            <option value="Pañales">Pañales</option>
                            <option value="Pie Sanitario">Pie Sanitario</option>
                            <option value="Protesis">Protesis</option>
                            <option value="Silla de Ruedas">Silla de Ruedas</option>
                          </select>
                        </div>




                      </div>


                    </div>
                  </div>

                  <h6 class="mb-3 mt-5 mas17">Economia Productiva</h6>
                  <div class="row mas17">
                    <div class="col-lg-4">
                      <section class="mas17">

                        <label class="control-label2">Emprendimiento </label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;" class="form-control" name="actividad_productiva" id="actividad_productiva">

                            <option value="NO">Ninguna</option>
                            <option value="Bodega">Bodega</option>
                            <option value="reposteria">Reposteria</option>
                            <option value="Carpinteria">Carpinteria</option>
                            <option value="Herreria">Herreria</option>
                            <option value="Costura">Costura</option>
                            <option value="Panaderia">Panaderia</option>
                            <option value="Mecanica">Mecanica</option>
                            <option value="Estilismo">Estilismo</option>
                            <option value="Otro Emprendimiento">Otro Emprendimiento</option>
                          </select>
                        </div>
                      </section>
                      <section class="mas18" id="mas18_4">

                        <label class="control-label2">Actividad Productiva Agricola</label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;" class="form-control" name="actividad_agricola" id="actividad_agricola">

                            <option value="NO">Ninguna</option>
                            <option value="Patio Productivo">Patio Productivo</option>
                            <option value="Conuco">Conuco</option>
                            <option value="Pesca">Pesca</option>
                            <option value="acuicultura">Acuicultura</option>
                            <option value="Cria de Animales de Consumo">Cria de Animales de Consumo</option>
                          </select>
                        </div>


                        <label class="control-label2">¿Pertenece a algun grupo de intercambio?</label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;" class="form-control" id="grupoIntercambio">
                            <option value="NO">No</option>
                            <option value="SI">Si</option>
                          </select>
                        </div>




                    </div>



                    </section>


                    <div class="col-lg-4">
                    </div>

                  </div>


                  <h6 class="mb-3 mt-5 mas15">Organizaciones del poder popular y movimientos sociales</h6>
                  <div class="row mas15">

                    <div class="col-lg-4 mas18">
                      <label class="control-label2">¿Es votante?</label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;" class="form-control" id="votante">
                          <option value="">Seleccione</option>
                          <option value="Si">Si</option>
                          <option value="No">No</option>
                        </select>
                      </div>

                      <script>
                        $("#votante").change(function() {
                          if ($("#votante").val() == "Si") {
                            $("#divPoscion").show(300);
                          } else {
                            $("#divPoscion").hide(300);
                          }
                        });
                      </script>

                      <div id="divPoscion" style="display: none;">
                        <label class="control-label2">¿Está de acuerdo con el Plan de Desarrollo Económico y Social Nueva Amazonas?</label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;" class="form-control" id="caracterizacion">
                            <option value="">Seleccione</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                          </select>
                        </div>

                        <label class="control-label2">¿Pertenece a alguna organización política?</label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;" class="form-control" id="partidos">
                            <option value="">Seleccione</option>
                            <option value="No">No</option>
                            <option value="no contesta">Prefiero no contestar</option>

                            <optgroup label="Organizaciones políticas">
                              <option value="PSUV">PSUV</option>
                              <option value="MSV">MSV</option>
                              <option value="PPT">PPT</option>
                              <option value="PODEMOS">PODEMOS</option>
                              <option value="ORA">ORA</option>
                              <option value="APC">APC</option>
                              <option value="MEP">MEP</option>
                              <option value="TUPAMARO">TUPAMARO</option>
                              <option value="UPV">UPV</option>
                              <option value="FV">FV</option>
                              <option value="MUD">MUD</option>
                              <option value="UNTC">UNTC</option>
                              <option value="NUVIPA">NUVIPA</option>
                              <option value="MR">MR</option>
                              <option value="SPV">SPV</option>
                              <option value="PCV">PCV</option>
                              <option value="CONVERGENCIA">CONVERGENCIA</option>
                              <option value="BR">BR</option>
                              <option value="MAS">MAS</option>
                              <option value="ALIANZA DEL LAPIZ">ALIANZA DEL LAPIZ</option>
                              <option value="MPV">MPV</option>
                              <option value="UNION PROGRESO">UNION PROGRESO</option>
                              <option value="UPP89">UPP89</option>
                              <option value="CENTRADOS">CENTRADOS</option>
                              <option value="MOVEV">MOVEV</option>
                              <option value="PUENTE">PUENTE</option>
                              <option value="COMPA">COMPA</option>
                              <option value="VPA">VPA</option>
                              <option value="MIN UNIDAD">MIN UNIDAD</option>
                              <option value="LPC">LPC</option>
                              <option value="AD">AD</option>
                              <option value="AP">AP</option>
                              <option value="PV">PV</option>
                              <option value="COPEI">COPEI</option>
                              <option value="CMC">CMC</option>
                              <option value="VU">VU</option>
                              <option value="EL CAMBIO">EL CAMBIO</option>
                              <option value="PUAMA">PUAMA</option>
                              <option value="TUPAZ">TUPAZ</option>
                              <option value="ORISUR">ORISUR</option>
                              <option value="CREEA">CREEA</option>
                            </optgroup>
                          </select>
                        </div>


                      </div>

                    </div>
                    <div class="col-lg-4 mas18">

                      <label class="control-label2">Congreso de los Pueblos </label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;" class="form-control" name="congreso_pueblos" id="congreso_pueblos">
                          <option value="No Pertenece">No Pertenece</option>
                          <option value="Adultos Mayores">Adultos Mayores</option>
                          <option value="Afrodecendientes">Afrodecendientes</option>
                          <option value="Agroproductores y Asociados">Agroproductores y Asociados</option>
                          <option value="Animalistas">Animalistas</option>
                          <option value="Cafeteros">Cafeteros</option>
                          <option value="Campesinos">Campesinos</option>
                          <option value="Cientificos e Innovadores">Cientificos e Innovadores</option>
                          <option value="Clase Media">Clase Media</option>
                          <option value="Colombianos en Venezuela">Colombianos en Venezuela</option>
                          <option value="Comunicadores">Comunicadores</option>
                          <option value="Cultura">Cultura</option>
                          <option value="Defensa de Derechos Humanos">Defensa de Derechos Humanos</option>
                          <option value="Deporte">Deporte</option>
                          <option value="Discapacidad">Discapacidad</option>
                          <option value="Ecologistas">Ecologistas</option>
                          <option value="Educación">Educación</option>
                          <option value="Emprendedores">Emprendedores</option>
                          <option value="Empresarios">Empresarios</option>
                          <option value="Hogares de la Patria">Hogares de la Patria</option>
                          <option value="Indígenas">Indígenas</option>
                          <option value="Intelectuales">Intelectuales</option>
                          <option value="Juventud">Juventud</option>
                          <option value="Misiones Sociales">Misiones Sociales</option>
                          <option value="Movimiento 2.0">Movimiento 2.0</option>
                          <option value="Movimiento Bolivariano de Familias">Movimiento Bolivariano de Familias</option>
                          <option value="Movimiento Comunas">Movimiento Comunas</option>
                          <option value="Movimiento por la Paz y la Vida">Movimiento por la Paz y la Vida</option>
                          <option value="Mujeres">Mujeres</option>
                          <option value="Pescadores">Pescadores</option>
                          <option value="Profesionales y Técnicos">Profesionales y Técnicos</option>
                          <option value="Religiosos">Religiosos</option>
                          <option value="Reserva Activa">Reserva Activa</option>
                          <option value="Salud">Salud</option>
                          <option value="Seguridad Ciudadana">Seguridad Ciudadana</option>
                          <option value="Sexodiversidad">Sexodiversidad</option>
                          <option value="Trabajadores">Trabajadores</option>
                          <option value="Trasporte Multimodal">Trasporte Multimodal</option>
                          <option value="Vuelta a la Patria">Vuelta a la Patria</option>
                        </select>
                      </div>

                      <div id="divChamba">
                        <label class="control-label2">¿Pertenece a Chamba Juvenil?</label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;" class="form-control" id="chamba_juvenil">
                            <option value="">Seleccione</option>
                            <option value="Si">Si</option>
                            <option value="NO">No</option>
                          </select>
                        </div>
                      </div>


                    </div>
                  </div>

                  <h6 class="mb-3 mt-5 mas18">Seguridad ciudadana</h6>
                  <div class="row mas18">



                    <div class="col-lg-4">


                      <label class="control-label2">¿Conoce su Cuadrante de Paz?</label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;" class="form-control" id="conoceCuandrante">

                          <option value="">Seleccione</option>
                          <option value="SI">Si</option>
                          <option value="NO">No</option>
                        </select>
                      </div>

                      <script>
                        $("#conoceCuandrante").change(function() {
                          if ($("#conoceCuandrante").val() == "SI") {
                            $("#divConoceCuadrante").show(300);
                          } else {
                            $("#divConoceCuadrante").hide(300);
                          }
                        });
                      </script>


                      <section id="divConoceCuadrante" style="display: none;">


                        <label class="control-label2">¿Conoce al jefe de su Cuadrante de Paz?</label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;" class="form-control" id="jefeCuadrante">

                            <option value="">Seleccione</option>
                            <option value="SI">Si</option>
                            <option value="NO">No</option>
                          </select>
                        </div>
                        <label class="control-label2">¿Conoce el número de celular de su Cuadrante de Paz?</label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;" class="form-control" id="telefonoCuadrante">

                            <option value="">Seleccione</option>
                            <option value="SI">Si</option>
                            <option value="NO">No</option>
                          </select>
                        </div>

                        <label class="control-label2">¿Ha reportado incidencias al número del Cuadrante de Paz?</label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;" class="form-control" id="reportadoCuadrante">

                            <option value="">Seleccione</option>
                            <option value="SI">Si</option>
                            <option value="NO">No</option>
                          </select>
                        </div>

                        <label class="control-label2">¿Han sido atendidas las denuncias reportadas a Jefe del Cuadrante de Paz?</label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;" class="form-control" id="atendidoCuadrante">

                            <option value="">Seleccione</option>
                            <option value="SI">Si</option>
                            <option value="NO">No</option>
                          </select>
                        </div>



                      </section>

                    </div>

                    <div class="col-lg-4">
                      <label class="control-label2">¿Pertenece a Algún Cuerpo de Seguridad o de Gestion de Riesgo?</label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;" class="form-control" id="pertenece_cuerpo_seguridad_gestion_riesgo">
                          <option value="NO">No</option>
                          <option value="Bomberos">Bomberos</option>
                          <option value="CICPC">CICPC</option>
                          <option value="FANB Armada">FANB Armada</option>
                          <option value="FANB Aviación">FANB Aviación</option>
                          <option value="FANB Ejercito">FANB Ejercito</option>
                          <option value="FANB Guardia Nacional">FANB Guardia Nacional</option>
                          <option value="FANB Milicia">FANB Milicia</option>
                          <option value="Policia Estadal">Policia Estadal</option>
                          <option value="Policia Municipal">Policia Municipal</option>
                          <option value="Policia Nacional">Policia Nacional</option>
                          <option value="Protección Civil">Protección Civil</option>
                          <option value="SEBIN">SEBIN</option>
                        </select>
                      </div>
                    </div>



                  </div>

                  <h6 class="mb-3 mt-5">Otros datos</h6>
                  <div class="row">
                    <div class="col-lg-4 mas18">
                      <label class="control-label2">Bombonas Pequeñas </label>

                      <div class="input-group input-group-outline my-2">
                        <input class="form-control" value="0" type='number' name='bombona_pequena' id='bombona_pequena'>
                      </div>

                      <script>
                        // evitar que el campo bombona_pequenatenga un valor negativo
                        $("#bombona_pequena").change(function() {
                          if ($(this).val() < 0) {
                            $(this).val(0);
                          }
                        });

                        $(document).ready(function() {
                          $("#bombona_pequena").change(function() {
                            var bombona_pequena = $("#bombona_pequena").val();
                            if (bombona_pequena > 0) {
                              $('#co_mediana').show(300)
                            } else {
                              $('#co_mediana').hide(300)
                            }

                          });
                        });
                      </script>


                      <section id="co_mediana" style="display: none;">
                        <label class="control-label2">Codigo Bombona Medianas </label>
                        <div class="input-group input-group-outline my-2">
                          <input class="form-control" type="text" id="codigo_mediana">
                        </div>
                      </section>


                      <label class="control-label2">Bombonas Grandes </label>
                      <div class="input-group input-group-outline my-2">
                        <input class="form-control" value="0" type='number' id='bombona_grande'>
                      </div>
                      <script>
                        // evitar que el campo bombona_pequenatenga un valor negativo
                        $("#bombona_grande").change(function() {
                          if ($(this).val() < 0) {
                            $(this).val(0);
                          }
                        });
                        $(document).ready(function() {
                          $("#bombona_grande").change(function() {
                            var bombona_grande = $("#bombona_grande").val();
                            if (bombona_grande > 0) {
                              $('#co_grande').show(300)
                            } else {
                              $('#co_grande').hide(300)
                            }

                          });
                        });
                      </script>


                      <section id="co_grande" style="display: none;">
                        <label class="control-label2">Codigo Bombona Grandes </label>
                        <div class="input-group input-group-outline my-2">
                          <input class="form-control" type="text" name="codigo_grande" id="codigo_grande">
                        </div>
                    </div>
                    <div class="col-lg-4 mas14">
                      <section class="mas18">
                        <label class="control-label2"> Bombonas Medianas</label>

                        <div class="input-group input-group-outline my-2">
                          <input class="form-control" value="0" type='number' name='bombona_mediana' id='bombona_mediana'>
                        </div>
                        <script>
                          $("#bombona_mediana").change(function() {
                            if ($(this).val() < 0) {
                              $(this).val(0);
                            }
                          });
                        </script>
                      </section>


                      <section class="mas14">

                        <label class="control-label2">Principal Metodo de Movilización </label>
                        <div class="input-group input-group-outline my-2">
                          <select style="padding-left: 10px;" class="form-control" name="movilizacion" id="movilizacion">
                            <option value="Caminando">Caminando</option>
                            <option value="Bicicleta">Bicicleta</option>
                            <option value="Bus">Bus</option>
                            <option value="Camiones">Camiones</option>
                            <option value="Moto">Moto</option>
                            <option value="Vehiculo Familiar">Vehiculo Familiar</option>
                          </select>
                        </div>
                      </section>

                    </div>
                    <div class="col-lg-4">
                      <label class="control-label2">Situación de Migración </label>
                      <div class="input-group input-group-outline my-2">
                        <select style="padding-left: 10px;" class="form-control" name="migracion" id="migracion">
                          <option value="Ninguna">Ninguna</option>
                          <option value="Migración Interna">Migración Interna</option>
                          <option value="Migración Externa">Migración Externa</option>
                        </select>
                      </div>


                    </div>

                    </section>


                  </div>

                  <div class="modal fade" id="modal_enfermedades" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Enfermedades que padece</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">


                          <div class="mb-3">
                            <label for="diabetico" class="form-label">¿Es diabético?</label>
                            <select class="form-control" id="diabetico">
                              <option value="NO" selected>No</option>
                              <option value="SI">Sí</option>
                            </select>
                          </div>

                          <div class="mb-3">
                            <label for="hipertenso" class="form-label">¿Es hipertenso?</label>
                            <select class="form-control" id="hipertenso">
                              <option value="NO" selected>No</option>
                              <option value="SI">Sí</option>
                            </select>
                          </div>

                          <div class="mb-3">
                            <label for="artritis" class="form-label">¿Tiene artritis?</label>
                            <select class="form-control" id="artritis">
                              <option value="NO" selected>No</option>
                              <option value="SI">Sí</option>
                            </select>
                          </div>

                          <div class="mb-3">
                            <label for="asma" class="form-label">¿Tiene asma?</label>
                            <select class="form-control" id="asma">
                              <option value="NO" selected>No</option>
                              <option value="SI">Sí</option>
                            </select>
                          </div>

                          <div class="mb-3">
                            <label for="enf_renal" class="form-label">¿Tiene enfermedad renal?</label>
                            <select class="form-control" id="enf_renal">
                              <option value="NO" selected>No</option>
                              <option value="SI">Sí</option>
                            </select>
                          </div>


                          <div class="mb-3">
                            <label for="epilepsia" class="form-label">¿Tiene epilepsia?</label>
                            <select class="form-control" id="epilepsia" name="epilepsia">
                              <option value="NO" selected>No</option>
                              <option value="SI">Sí</option>
                            </select>
                          </div>

                          <div class="mb-3">
                            <label for="linfoma" class="form-label">¿Tiene linfoma?</label>
                            <select class="form-control" id="linfoma" name="linfoma">
                              <option value="NO" selected>No</option>
                              <option value="SI">Sí</option>
                            </select>
                          </div>

                          <div class="mb-3">
                            <label for="paralisis" class="form-label">¿Tiene parálisis?</label>
                            <select class="form-control" id="paralisis" name="paralisis">
                              <option value="NO" selected>No</option>
                              <option value="SI">Sí</option>
                            </select>
                          </div>

                          <div class="mb-3">
                            <label for="enf_cardiaca" class="form-label">¿Tiene alguna enfermedad cardíaca?</label>
                            <select class="form-control" id="enf_cardiaca" name="enf_cardiaca">
                              <option value="NO" selected>No</option>
                              <option value="SI">Sí</option>
                            </select>
                          </div>

                          <div class="mb-3">
                            <label for="otra" class="form-label">¿Tiene alguna otra enfermedad?</label>
                            <input class="form-control" id="otra" placeholder="Mencione la enfermedad que padece">
                          </div>




                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                          <button type="button" id="aplicar_btn-modal" class="btn btn-primary">Aplicar</button>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="d-flex justify-content-between">

                    <button type="button" id="btn-cancelar_actualizacion" class="btn btn-secondary mt3">Cancelar</button>

                    <button type="submit" class="btn btn-primary bg-gradient-primary box-shadow-primary fr mt3">Guardar</button>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
        <?php include('notificacion.php'); ?>
      </div>


    </main>




    <div class="modal fade" id="modal_info" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropTitulo" aria-hidden="true">
      <div class="modal-dialog modal-xl  modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropTitulo">Enfermedades que padece</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row" id="info_habitante"></div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btn-edit-modal" data-vivienda='' data-habitante='' class="btn btn-primary btn-edit" onclick="$('#modal_info').modal('toggle')">Editar</button>
          </div>
        </div>
      </div>
    </div>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script>
      var lista

      function buscar(cedula = null) {
        $.ajax({
          url: 'consultasAjax/actualizar_inf_manejador.php',
          type: 'POST',
          dataType: 'html',
          data: {
            cedula: cedula
          },
        }).done(function(response) {
          const resultado = JSON.parse(response)
          lista = resultado;

          $('#table').html('')

          let contador = 1;
          let pendientes = 0;
          for (let clave in resultado) {

            resultado[clave].habitantes.forEach((habitante, index) => {


              $('#table').append(`<tr ${(habitante.rol_familiar == 'JEFE DE FAMILIA' ? 'style="background: #fff0f0;"' : '')}>
                <td>${contador++}</td>
                <td><a class="hover-danger" onclick='showInfo("${index}", "${habitante.id_vivienda}")'>${habitante.nombre}</a></td>
                <td>${habitante.cedula}</td>
                <td>${(habitante.rol_familiar == 'JEFE DE FAMILIA' ? habitante.rol_familiar : '')}</td>
                <td>${habitante.telefono}</td>
                <td>${(habitante.actualizado == '1' ? '<span class="badge bg-danger">Actualizado</span>' : '<span class="badge bg-info">Pendiente</span>')}</td>
                <td><button data-vivienda='${habitante.id_vivienda}' data-habitante='${index}' class="btn btn-sm btn-danger btn-edit">Editar</button></td>
            </tr>`)

              pendientes += (habitante.actualizado == '0' ? 1 : 0)

            });
          }
          if (cedula == null) {
            document.getElementById('contador_pendientes').innerHTML = pendientes
          }
        })
      }





      /* Columnas y labels */
      const configuracionItems = {
        rol_familiar: ["Rol Familiar", true, ""],
        cedula: ["Cédula", true, "No posee"],
        nombre: ["Nombre", true, ""],
        telefono: ["Teléfono", true, "No posee"],
        fecha_de_nacimiento: ["Fecha de Nacimiento", true, ""],
        sexo: ["Sexo", true, "No especificado"],
        parentesco_al_jefe: ["Parentesco con el Jefe", true, ""],
        pueblo_indigena: ["Pueblo Indígena", true, "Ninguno"],
        nacionalidad: ["Nacionalidad", true, "No especificado"],
        procedencia: ["Procedencia", true, "No aplica"],
        educacion: ["Educación", true, "Ninguna"],
        profesion: ["Profesión", true, "Ninguna"],
        ocupacion: ["Ocupación", true, "Ninguna"],
        instancia_laboral: ["Instancia Laboral", true, "No especificado"],
        conf_ingreso_mensual: ["Ingreso Mensual", true, "No especificado"],
        pertenece_cuerpo_seguridad_gestion_riesgo: ["Cuerpos de Seguridad o Gestión de Riesgo", true, "Ninguno"],
        practica_deporte: ["Practica Deporte", true, "No"],
        realiza_actividad_cultural: ["Actividad Cultural", true, "No"],
        pasatiempo: ["Pasatiempo", true, "No"],
        creencia_reliosa: ["Creencia Religiosa", true, "Ninguna"],
        imaginarios_gustos_etc: ["Imaginarios, Gustos, etc.", true, "No"],
        diabetico: ["Diabético", true, "No"],
        hipertenso: ["Hipertenso", true, "No"],
        artritis: ["Artritis", true, "No"],
        asma: ["Asma", true, "No"],
        enf_renal: ["Enfermedad Renal", true, "No"],
        ETS: ["ETS", true, "No"],
        cancer: ["Cáncer", true, "No"],
        epilepsia: ["Epilepsia", true, "No"],
        linfoma: ["Linfoma", true, "No"],
        paralisis: ["Parálisis", true, "No"],
        enf_cardiaca: ["Enfermedad Cardíaca", true, "No"],
        enf_alto_costo: ["Enfermedad de Alto Costo", true, "No"],
        otra: ["Otra", true, "No"],
        recibe_tratamiento: ["Recibe Tratamiento", true, "No"],
        padecio_covid: ["Padeció COVID", true, "No"],
        dificultad_visual: ["Dificultad Visual", true, "No"],
        discapacidad: ["Discapacidad", true, "No"],
        carnet_discapacidad: ["Carnet de Discapacidad", true, "No"],
        requiere_ayuda: ["Requiere Ayuda", true, "No"],
        recibe_bono_jose_g: ["Recibe Bono José Gregorio", true, "No"],
        embarazada: ["Embarazada", true, "No"],
        embarazada_alto_riesgo: ["Embarazo de Alto Riesgo", true, "No"],
        concepcion_semana: ["Semana de Concepción", true, "No"],
        parto_humanizado: ["Parto Humanizado", true, "No"],
        lactancia_materna: ["Lactancia Materna", true, "No"],
        madre_lactante: ["Madre Lactante", true, "No"],
        bono_lactancia: ["Bono de Lactancia", true, "No"],
        planificacion_familiar: ["Planificación Familiar", true, "No"],
        deficit_nutricional: ["Déficit Nutricional", true, "No"],
        combo_inn: ["Combo INN", true, "No"],
        carnet_patria: ["Carnet de la Patria", true, "No"],
        codigo_carnet: ["Código del Carnet", true, "No"],
        serial_carnet: ["Serial del Carnet", true, "No"],
        hogares_de_la_patria: ["Hogares de la Patria", true, "No"],
        registro_jefe_hogar_patria: ["Registro de Jefe de Hogar en Patria", true, "No"],
        combo_alimenticio_clap: ["Combo Alimenticio CLAP", true, "No"],
        pension: ["Pensión", true, "No"],
        actividad_productiva: ["Actividad Productiva", true, "No"],
        extra: ["Extra", false, "No"]
      };
      /* Columnas y labels */
      function showInfo(hab, viv) {
        const infoHabitante = lista[viv]['habitantes'][hab];
        $('#btn-edit-modal').attr('data-vivienda', viv).attr('data-habitante', hab);

        $('#info_habitante').html(`
        <div class="row">
            <div class="col-lg-4" id="col1"></div>
            <div class="col-lg-4" id="col2"></div>
            <div class="col-lg-4" id="col3"></div>
        </div>
    `);

        let colIndex = 1;

        Object.keys(configuracionItems).forEach(key => {
          if (configuracionItems[key][1]) { // Solo si la propiedad debe mostrarse
            let value = infoHabitante[key] && infoHabitante[key] !== '' ? infoHabitante[key] : configuracionItems[key][2];
            let itemHtml = `<div class='bb'><b>${configuracionItems[key][0]}</b>: <span class="text-danger">${value}</span></div>`;

            $(`#col${colIndex}`).append(itemHtml);

            colIndex = colIndex === 3 ? 1 : colIndex + 1; // Ciclar entre las tres columnas
          }
        });

        $('#modal_info').modal('toggle');
      }







      $(document).ready(function() {
        buscar();
      });

      document.getElementById('btn-enlistar').addEventListener('click', () => buscar());

      document.getElementById('btn-cedula').addEventListener('click', function() {
        const cedula = document.getElementById('cedula_buscar').value.trim();
        if (cedula != '') {
          buscar(cedula)
        } else {
          alert('Ingrese el numero de cédula')
        }
      })

      document.addEventListener('click', function(event) {

        if (event.target.closest('.btn-edit')) { // ACCION DE ELIMINAR
          const vivienda = event.target.closest('.btn-edit').getAttribute('data-vivienda');
          const habitante = event.target.closest('.btn-edit').getAttribute('data-habitante');

          mostrar_form_editar(vivienda, habitante);
        }
      });

      const campos_ignorar = ['id', "procedencia", 'id_municipio', 'id_parroquia', 'id_comuna', 'id_c_comunal', 'coordenada_este', 'coordenada_norte', 'CASA', 'id_vivienda', 'id_familia', 'rol_familiar', 'idFake2', 'referenciaMAMA', 'referenciaPAPA', 'nameMama', 'namePapa', 'jefeCuadrante', 'animales_domesticos', 'pasatiempo', 'caracterizacion']

      const campos_especiales = ["educacion", "", "ocupacion", "cancer", "enf_alto_costo", "otra", "padecio_covid", "embarazada", "embarazada_alto_riesgo", "concepcion_semana", "parto_humanizado", "lactancia_materna", "madre_lactante", "bono_lactancia", "planificacion_familiar", "combo_inn", "carnet_patria", "registro_jefe_hogar_patria", "pension", "actividad_productiva", "superficie_m2_productiva", "infraestructura_agricola", "concejo_comunal", "raas", "clap", "promotores_comunitarios", "milicia", "grado_militar", "sala_bnbt", "ubch", "ffm", "msv", "robert_serra", "eulalia_buroz", "promotora_parto_humanizado", "mesa_tecnica_agua", "mesa_tecnica_telecomunicaciones", "tipo_voto", "otros_p_polo", "congreso_pueblos", "calle", "codigo_mediana", "codigo_grande", "migracion", "actividad_agricola", "muerte", "capacidadProductiva", "genero", "edad", "conoceCuandrante", "telefonoCuadrante", "reportadoCuadrante", "atendidoCuadrante", "grupoIntercambio", "productorIndependiente", "lugarProduccionAgricola", "lugarProduccion", "produccion", "registro", "consejo", "partidos", "terreno_productivo", "cantidadBolsas", "miliciaActivo", "capacitacionAdies", "votante"]





      document.getElementById('aplicar_btn-modal').addEventListener('click', function() {
        recorrerAsignar()
        $('#modal_enfermedades').modal('toggle')
      }) // APLICAR LAS ENFERMEDADES AL IMPUT


      const enfermedades = [
        "diabetico", "hipertenso", "artritis", "asma",
        "enf_renal", "epilepsia", "linfoma", "paralisis", "enf_cardiaca"
      ];


      function recorrerAsignar() {

        const nombres_enfermedades = {
          "diabetico": "Diabetes",
          "hipertenso": "Hipertensión",
          "artritis": "Artritis",
          "asma": "Asma",
          "enf_renal": "Enfermedad renal",
          "epilepsia": "Epilepsia",
          "linfoma": "Linfoma",
          "paralisis": "Parálisis",
          "enf_cardiaca": "Enfermedad cardíaca"
        }

        let resultado = [];

        enfermedades.forEach(id => {
          const select = document.getElementById(id);
          if (select && select.value === "SI") {
            resultado.push(nombres_enfermedades[id]); // Toma el texto del label
          }
        });

        document.getElementById('enfermedades').value = resultado.join(", ");
      }

      var datosModificar

      function mostrar_form_editar(vivienda, habitante) {
        const infoHabitante = lista[vivienda]['habitantes'][habitante];
        datosModificar = infoHabitante;

        const event = new Event('change', {
          bubbles: true
        });


        if (parseInt(infoHabitante['cedula']) < 10) {
          console.log('error: ' + infoHabitante['cedula'])
        }
        Object.keys(infoHabitante).forEach(key => {

          const input = document.getElementById(key.trim().toString());

          if (input) {
            if (input.type === 'date') {
              const fecha = new Date(infoHabitante[key]);
              if (!isNaN(fecha.getTime())) {
                input.value = fecha.toISOString().split('T')[0]; // Formato YYYY-MM-DD
              }
            } else {
              //  input.value = (infoHabitante[key] == '' && input.tagName.toLowerCase() === 'select' ? 'NO' : infoHabitante[key]);
              input.value = infoHabitante[key];
            }
            input.dispatchEvent(event);
          } else {
            //    console.log(input)
            // verifica si el key existe en campos_ignorar, si no existe, lo mandas a la consola
            if (!campos_ignorar.includes(key)) {
              //     document.write('"' + key + '", ');

            }
          }

          // CASOS ESPECIALES
          //* Enfermedades

          enfermedades.forEach(id => {

            const select = document.getElementById(id);
            if (infoHabitante[id] == 'SI') {
              document.getElementById('boolean_enf').value = 'SI';
              let input_enf = document.getElementById('boolean_enf');
              input_enf.dispatchEvent(event);
              recorrerAsignar()
            }
          });
        });

        secciones_por_Edad($('#fecha_de_nacimiento').val())

        $('#vista_1').hide(300)
        $('#vista_2').show(300)

      }

      document.getElementById('btn-cancelar_actualizacion').addEventListener('click', function() {
        $('#vista_1').show(300)
        $('#vista_2').hide(300)
      })


      // GUARDAR FORMULARIO
      document.addEventListener("DOMContentLoaded", function() {
        const formulario = document.getElementById("formulario");

        formulario.addEventListener("submit", function(event) {
          event.preventDefault(); // Evita el envío del formulario

          let camposModificados = [];

          Object.keys(datosModificar).forEach((key) => {
            let valorAnterior = datosModificar[key] == '' ? 'NO' : datosModificar[key];
            let campo = document.getElementById(key);
            let valorNuevo = campo ? campo.value : '';

            if (campo && !(valorAnterior === '' && valorNuevo === 'NO') && valorNuevo !== valorAnterior.toString()) {
              camposModificados.push({
                campo: key,
                valorAnterior: valorAnterior,
                valorNuevo: valorNuevo
              });
            }
          });

          const id = datosModificar['id']
          $.ajax({
            url: '../back/actualizar_inf.php',
            type: "json",
            contentType: 'application/json',
            data: JSON.stringify({
              id: id,
              data: camposModificados
            }),
            success: function(response) {
              if (response['success']) {
                toast('success', response['msg'])
                buscar();

                $('#vista_1').show(300)
                $('#vista_2').hide(300)


              } else {
                toast('error', response['msg'])
              }
              console.log(response)
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
            },
          });

        });
      });


















      // BUSCADOR
      document.getElementById("buscador").addEventListener("input", function() {
        let filtro = this.value.toLowerCase();
        let filas = document.querySelectorAll("#table tr");
        let primeraCoincidencia = null;
        let hayCoincidencia = false;

        filas.forEach(fila => {
          let encontrado = false;
          let celdas = fila.querySelectorAll("td");

          // Solo buscar en las columnas 2 y 3 (índices 1 y 2)
          if (celdas.length > 2) {
            for (let i = 1; i <= 2; i++) { // 1 para columna 2 y 2 para columna 3
              let td = celdas[i];
              td.innerHTML = td.textContent; // Limpiar resaltado anterior
              if (filtro && td.textContent.toLowerCase().includes(filtro)) {
                let regex = new RegExp(`(${filtro})`, "gi");
                td.innerHTML = td.textContent.replace(regex, `<span class="highlight">$1</span>`);
                encontrado = true;
              }
            }
          }

          if (encontrado) {
            hayCoincidencia = true;
            if (!primeraCoincidencia) {
              primeraCoincidencia = fila;
            }
          }
        });

        // Si hay coincidencias, hacer scroll hasta la primera
        if (hayCoincidencia && primeraCoincidencia) {
          primeraCoincidencia.scrollIntoView({
            behavior: "smooth",
            block: "center"
          });
        } else {
          // Si no hay coincidencias, regresar el scroll al inicio
          document.getElementById("table-container").scrollTop = 0;
        }
      });





      /* * Calcular edad */
      function resultEdad(fechaEd) {
        if (!fechaEd || !/^\d{4}-\d{2}-\d{2}$/.test(fechaEd)) {
          console.warn("Fecha de nacimiento incompleta o con formato incorrecto.");
          return null;
        }

        var fecha = new Date(fechaEd);
        var fechaActual = new Date();

        if (isNaN(fecha.getTime())) {
          console.warn("Fecha de nacimiento inválida.");
          return null;
        }

        if (fecha > fechaActual) {
          console.warn("La fecha de nacimiento no puede ser futura.");
          return null;
        }

        var mes = fechaActual.getMonth();
        var dia = fechaActual.getDate();
        var año = fechaActual.getFullYear();
        fechaActual.setDate(dia + 1);
        var años = año - fecha.getFullYear();
        if ((mes < fecha.getMonth() - 1) || (mes == fecha.getMonth() - 1 && dia < fecha.getDate())) {
          años--;
        }
        return años;
      }
      /* * Calcular edad */


      /* * Controlador de secciones según edad y sexo */
      function secciones_por_Edad(value) {


        let edad = resultEdad(value);
        let sexo = $('#sexo').val();

        if (edad === null) return;

        // Mapeo de edades con clases correspondientes
        let edadClases = {
          6: '.mas6',
          8: '.mas8',
          13: '.mas13',
          14: '.mas14',
          15: '.mas15',
          17: '.mas17',
          18: '.mas18'
        };

        // Mostrar u ocultar elementos según la edad
        $.each(edadClases, function(key, clase) {
          $(clase).toggle(edad >= key);
          //   console.log(clase + ' se ' + (edad >= key ? 'muestra' : 'oculta'))
        });

        // Mostrar elementos exclusivos para mujeres de 13 años en adelante
        let mostrarSoloMujer = edad >= 13 && sexo === 'Femenino';
        $('.solo_mujer').toggle(mostrarSoloMujer);
        //console.log(`.solo_mujer se ${mostrarSoloMujer ? 'muestra' : 'oculta'}`);

        // Mostrar divChamba si la edad está entre 15 y 35 años
        let mostrarDivChamba = edad >= 15 && edad <= 35;
        $('#divChamba').toggle(mostrarDivChamba);
        //console.log(`#divChamba se ${mostrarDivChamba ? 'muestra' : 'oculta'}`);

        // Mostrar divPension si cumple con los requisitos de edad y sexo
        let mostrarDivPension = (edad >= 60 && sexo === 'Femenino') || (edad >= 65 && sexo === 'Masculino');
        $('#divPension').toggle(mostrarDivPension);
        //console.log(`#divPension se ${mostrarDivPension ? 'muestra' : 'oculta'}`);

      }
      /* * Controlador de secciones según edad y sexo */

      function secciones_por_sexo(value) {
        if (value == 'Femenino') {
          $('.solo_mujer').show(300);
        } else {
          $('.solo_mujer').hide(300);
        }
      }


      document.getElementById('fecha_de_nacimiento').addEventListener('change', function() {
        secciones_por_Edad(this.value)
        secciones_por_sexo($('#sexo').val())
      })
      document.getElementById('sexo').addEventListener('change', function() {
        secciones_por_sexo(this.value)
        secciones_por_Edad($('#fecha_de_nacimiento').val())
      })





      function verificarCedula(cedula) {
        let str = cedula;
        let arr = str.split('');

        if (cedula.length <= 4) {
          return false;
        }


        // recorremos todos los caracteres de la cadena y verificamos si el caracter es un numero
        for (let i = 0; i < arr.length; i++) {
          // si el caracter es un numero entero
          if (isNaN(arr[i])) {
            // si el caracter es una letra
            return false;
          }
        }


        // si todos los caracteres de la cadena son numeros
        return true;

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