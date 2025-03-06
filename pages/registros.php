<?php
include('../configuracion/conexionMysqli.php');
include('../class/count.php');

if ($_SESSION['nivel'] == 1) {
  unset($_SESSION['proyecto']);


  $hab = contar2('inf_habitantes', 'id!=""');
  $fam = contar2('inf_habitantes', 'rol_familiar="JEFE DE FAMILIA"');
  $viv = contar2('inf_casas', 'id!=""');


?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/SLS.png">
    <title class="registros" id="title">Registros</title>


    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/amcharts5/examples/misc-40-charts/index.css" />
    <script src="../assets/js/jquery-3.6.0.min.js"></script>



    <link rel="stylesheet" href="mapa/js/ui/jquery-ui.min.css">
    <script src="mapa/js/ui/jquery.min.js"></script>
    <script src="mapa/js/ui/jquery-ui.min.js"></script>


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
            <h6 class="font-weight-bolder mb-0">Inicio</h6>
          </nav>
          <?php include('includes/header.php') ?>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-user opacity-10"></i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Habitantes</p>
                  <h4 class="mb-0"><?php echo number_format(contar2('inf_habitantes', 'id!=""'), '0', '.', '.') ?></h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">Habitantes censados</p>
              </div>
            </div>
          </div>



          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-users opacity-10"></i>

                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Familias</p>
                  <h4 class="mb-0"><?php echo number_format(contar2('inf_habitantes', 'rol_familiar="JEFE DE FAMILIA"'), '0', '.', '.') ?></h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">Familias censadas</p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-home opacity-10"></i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Viviendas</p>
                  <h4 class="mb-0"><?php echo number_format(contar2('inf_casas', 'id!=""'), '0', '.', '.') ?></h4>

                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">Viviendas censadas</p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                  <i class="fa fa-star opacity-10"></i>

                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Directorio</p>
                  <h4 class="mb-0"><a href="directorio.php">ver</a></h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">Directorio de las organizaciones</p>
              </div>
            </div>
          </div>
        </div>




        <div class="row mt-4">
          <div class="col-lg-12 col-md-8 mb-md-0 mb-4">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-12 col-12">
                    <h6>Consultas avanzadas</h6>
                    <!-- vista resultado consulta -->
                    <br>
                    <!-- Inicio de la tabla -->
                    <div class="row">
                      <div class="col-lg-3">

                        <label style="margin-bottom: 0;" for="condicion">Campo de entrada</label>
                        <div class="input-group input-group-outline my-3">
                          <input type="text" name="condicion" id="condicion" class="form-control" placeholder="">
                        </div>

                        <div style="float: right;">
                          <button onclick="addConsulta(' OR ')" disabled id="btn_info" title="Se cumple alguna de las condiciones dadas" class="btn btn-info">O</button>
                          <button onclick="addConsulta(' AND ')" disabled id="btn_danger" title="Se cumplen todas las condiciones" class="btn btn-danger">Y</button>
                          <button onclick="addConsulta('>')" id="btn_dark" title="Pasar a consultar" class="btn btn-dark">></button>
                        </div>
                      </div>



                      <script>
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
                            formulacion()


                          } else
                            alerta("No se reconoce la entrada", 'error')

                        }

                        function formulacion() {
                          $('#reslutConsulta').html('')
                          $('#tablaResultado').html('')


                          let c = $('#consulta').val();

                          if (c != '') {
                            $('#btn_dark').attr('disabled', true);
                            $('#btn_info').attr('disabled', false);
                            $('#btn_danger').attr('disabled', false);
                          } else {
                            $('#btn_dark').attr('disabled', false);
                            $('#btn_info').attr('disabled', true);
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

                          $('#formulacionConsulta').html(texto)

                          if (c.indexOf('DELETE') != '-1' || c.indexOf('DROP') != '-1' || c.indexOf('drop') != '-1' || c.indexOf('drop') != '-1' || c.indexOf(';') != '-1' || c.indexOf('DELETE') != '-1' || c.indexOf('delete') != '-1') {
                            $('#consulta').val('')
                            $('#formulacionConsulta').html('')
                            alerta("Uso de palabra reservada", 'error')

                          } else {
                            validar()
                          }

                        }
                      </script>










                      <div class="col-lg-6">

                        <label style="margin-bottom: 0;" for="modo" style="white-space: nowrap;" class="label-control">Metodo de busqueda</label>
                        <div class="input-group input-group-outline my-3">
                          <input type="text" name="consulta" onchange="formulacion()" id="consulta" class="form-control" placeholder="Consulta">
                        </div>

                        <p style="background-color: #f1f1f1;padding: 10px;">
                          Formulación de la consulta:
                          <span id="formulacionConsulta">
                          </span>

                        </p>
                        <span id="reslutConsulta">
                        </span>


                      </div>


                      <div class="col-lg-3">

                        <p style="margin-bottom: 14px;" for="condicion">Campos a mostrar</p>

                        <div style="padding: 5px; height: 285px;overflow-y: auto;background: whitesmoke;">

                          <input type="checkbox" onclick="addCampo('id_parroquia')" class="checkCampos" id="id_parroquia"> &nbsp;<label for="id_parroquia"> id_parroquia </label><br>
                          <input type="checkbox" onclick="addCampo('id_comuna')" class="checkCampos" id="id_comuna"> &nbsp;<label for="id_comuna"> id_comuna </label><br>
                          <input type="checkbox" onclick="addCampo('id_c_comunal')" class="checkCampos" id="id_c_comunal"> &nbsp;<label for="id_c_comunal"> id_c_comunal </label><br>
                          <input type="checkbox" onclick="addCampo('coordenada_norte')" class="checkCampos" id="coordenada_norte"> &nbsp;<label for="coordenada_norte"> latitud </label><br>
                          <input type="checkbox" onclick="addCampo('coordenada_este')" class="checkCampos" id="coordenada_este"> &nbsp;<label for="coordenada_este"> longitud </label><br>
                          <input type="checkbox" onclick="addCampo('material_construccion')" class="checkCampos" id="material_construccion"> &nbsp;<label for="material_construccion"> material_construccion </label><br>
                          <input type="checkbox" onclick="addCampo('condicion_vivienda')" class="checkCampos" id="condicion_vivienda"> &nbsp;<label for="condicion_vivienda"> condicion_vivienda </label><br>
                          <input type="checkbox" onclick="addCampo('cantidad_habitaciones')" class="checkCampos" id="cantidad_habitaciones"> &nbsp;<label for="cantidad_habitaciones"> cantidad_habitaciones </label><br>
                          <input type="checkbox" onclick="addCampo('vivienda_venezuela')" class="checkCampos" id="vivienda_venezuela"> &nbsp;<label for="vivienda_venezuela"> vivienda_venezuela </label><br>
                          <input type="checkbox" onclick="addCampo('bnbt')" class="checkCampos" id="bnbt"> &nbsp;<label for="bnbt"> bnbt </label><br>
                          <input type="checkbox" onclick="addCampo('tenencia_tierra')" class="checkCampos" id="tenencia_tierra"> &nbsp;<label for="tenencia_tierra"> tenencia_tierra </label><br>
                          <input type="checkbox" onclick="addCampo('agua_potable')" class="checkCampos" id="agua_potable"> &nbsp;<label for="agua_potable"> agua_potable </label><br>
                          <input type="checkbox" onclick="addCampo('almacenamiento_agua')" class="checkCampos" id="almacenamiento_agua"> &nbsp;<label for="almacenamiento_agua"> almacenamiento_agua </label><br>
                          <input type="checkbox" onclick="addCampo('agua_servidas')" class="checkCampos" id="agua_servidas"> &nbsp;<label for="agua_servidas"> agua_servidas </label><br>
                          <input type="checkbox" onclick="addCampo('disposicion_basura')" class="checkCampos" id="disposicion_basura"> &nbsp;<label for="disposicion_basura"> disposicion_basura </label><br>
                          <input type="checkbox" onclick="addCampo('frecuencia_recoleccion')" class="checkCampos" id="frecuencia_recoleccion"> &nbsp;<label for="frecuencia_recoleccion"> frecuencia_recoleccion </label><br>
                          <input type="checkbox" onclick="addCampo('electricidad')" class="checkCampos" id="electricidad"> &nbsp;<label for="electricidad"> electricidad </label><br>
                          <input type="checkbox" onclick="addCampo('medidor_electricidad')" class="checkCampos" id="medidor_electricidad"> &nbsp;<label for="medidor_electricidad"> medidor_electricidad </label><br>
                          <input type="checkbox" onclick="addCampo('telefonia')" class="checkCampos" id="telefonia"> &nbsp;<label for="telefonia"> telefonia </label><br>
                          <input type="checkbox" onclick="addCampo('internet')" class="checkCampos" id="internet"> &nbsp;<label for="internet"> internet </label><br>
                          <input type="checkbox" onclick="addCampo('television')" class="checkCampos" id="television"> &nbsp;<label for="television"> television </label><br>
                          <input type="checkbox" onclick="addCampo('tv_satelital')" class="checkCampos" id="tv_satelital"> &nbsp;<label for="tv_satelital"> tv_satelital </label><br>
                          <input type="checkbox" onclick="addCampo('cod_catastro')" class="checkCampos" id="cod_catastro"> &nbsp;<label for="cod_catastro"> cod_catastro </label><br>
                          <input type="checkbox" onclick="addCampo('cod_ine')" class="checkCampos" id="cod_ine"> &nbsp;<label for="cod_ine"> cod_ine </label><br>
                          <input type="checkbox" onclick="addCampo('responsable')" class="checkCampos" id="responsable"> &nbsp;<label for="responsable"> responsable </label><br>
                          <input type="checkbox" onclick="addCampo('nombreResponsable')" class="checkCampos" id="nombreResponsable"> &nbsp;<label for="nombreResponsable"> nombreResponsable </label><br>
                          <input type="checkbox" onclick="addCampo('telefono')" class="checkCampos" id="telefono"> &nbsp;<label for="telefono"> telefono </label><br>
                          <input type="checkbox" onclick="addCampo('zonaRiesgo')" class="checkCampos" id="zonaRiesgo"> &nbsp;<label for="zonaRiesgo"> zonaRiesgo </label><br>
                          <input type="checkbox" onclick="addCampo('robos')" class="checkCampos" id="robos"> &nbsp;<label for="robos"> victima_robo </label><br>
                          <input type="checkbox" onclick="addCampo('denucio')" class="checkCampos" id="denucio"> &nbsp;<label for="denucio"> denuncio </label><br>
                          <input type="checkbox" onclick="addCampo('cantidadRobos')" class="checkCampos" id="cantidadRobos"> &nbsp;<label for="cantidadRobos"> cantidadRobos </label><br>
                          <input type="checkbox" onclick="addCampo('ultimoRobo')" class="checkCampos" id="ultimoRobo"> &nbsp;<label for="ultimoRobo"> ultimoRobo </label><br>
                          <input type="checkbox" onclick="addCampo('tratamientoAgua')" class="checkCampos" id="tratamientoAgua"> &nbsp;<label for="tratamientoAgua"> tratamientoAgua </label><br>
                          <input type="checkbox" onclick="addCampo('tapaPozo')" class="checkCampos" id="tapaPozo"> &nbsp;<label for="tapaPozo"> tapaPozo </label><br>
                          <input type="checkbox" onclick="addCampo('suministro_agua_consumo')" class="checkCampos" id="suministro_agua_consumo"> &nbsp;<label for="suministro_agua_consumo"> suministro_agua_consumo </label><br>
                          <input type="checkbox" onclick="addCampo('estructura')" class="checkCampos" id="estructura"> &nbsp;<label for="estructura"> tipo_estructura </label><br>
                          <input type="checkbox" onclick="addCampo('equipos')" class="checkCampos" id="equipos"> &nbsp;<label for="equipos"> equipos </label><br>
                          <input type="checkbox" onclick="addCampo('bom_grandes')" class="checkCampos" id="bom_grandes"> &nbsp;<label for="bom_grandes"> bom_grandes </label><br>
                          <input type="checkbox" onclick="addCampo('bom_mediana')" class="checkCampos" id="bom_mediana"> &nbsp;<label for="bom_mediana"> bom_mediana </label><br>
                          <input type="checkbox" onclick="addCampo('bom_pequena')" class="checkCampos" id="bom_pequena"> &nbsp;<label for="bom_pequena"> bom_pequena </label><br>
                          <input type="checkbox" onclick="addCampo('actividad_productiva')" class="checkCampos" id="actividad_productiva"> &nbsp;<label for="actividad_productiva"> actividad_productiva </label><br>
                          <input type="checkbox" onclick="addCampo('tipoConstruccion')" class="checkCampos" id="tipoConstruccion"> &nbsp;<label for="tipoConstruccion"> tipoConstruccion </label><br>
                          <input type="checkbox" onclick="addCampo('familias')" class="checkCampos" id="familias"> &nbsp;<label for="familias"> familias </label><br>
                          <input type="checkbox" onclick="addCampo('habitantes')" class="checkCampos" id="habitantes"> &nbsp;<label for="habitantes"> habitantes </label><br>
                          <input type="checkbox" onclick="addCampo('circuito')" class="checkCampos" id="circuito"> &nbsp;<label for="circuito"> circuito </label><br>


                        </div>


                        <script>
                          var campos = ['id_parroquia', 'id_comuna', 'id_c_comunal', 'coordenada_este', 'coordenada_norte', 'material_construccion', 'condicion_vivienda', 'cantidad_habitaciones', 'vivienda_venezuela', 'bnbt', 'tenencia_tierra', 'agua_potable', 'almacenamiento_agua', 'agua_servidas', 'disposicion_basura', 'frecuencia_recoleccion', 'electricidad', 'medidor_electricidad', 'telefonia', 'internet', 'television', 'tv_satelital', 'cod_catastro', 'cod_ine', 'responsable', 'zonaRiesgo', 'robos', 'cantidadRobos', 'ultimoRobo', 'denucio', 'tratamientoAgua', 'tapaPozo', 'suministro_agua_consumo', 'estructura', 'nombreResponsable', 'telefono', 'equipos', 'bom_grandes', 'bom_mediana', 'bom_pequena', 'actividad_productiva', 'tipoConstruccion', 'familias', 'habitantes', 'circuito']

                          var camposMostrar = '';

                          function addCampo(campo) {
                            camposMostrar = ''
                            campos.forEach(element => {
                              if (document.getElementById(element).checked) {
                                camposMostrar = camposMostrar + element + '*'
                              }
                            });


                            if (camposMostrar != '') {
                              camposMostrar = camposMostrar.substring(0, camposMostrar.length - 1)
                              verResult()
                            }

                          }
                        </script>


                      </div>

                    </div>
                    <div class="card-body px-0 pb-2">
                      <hr>
                      <section id="tablaResultado" style="max-height: 60vh;overflow-y: auto; overflow-x: hidden;"></section>
                    </div>
                    <!-- Fin de la tabla -->
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>



        <div class="row mt-4">

          <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
            <div class="card" style="min-height: 550px;">
              <div class="card-header pb-0">

                <div class="row">
                  <div class="col-lg-9 col-10">
                    <h6>Resumen por area</h6>
                  </div>

                  <div class="col-lg-3 col-4" style="display: flex;">
                    <div class="input-group input-group-outline my-3">

                      <select onchange="setVistaArea()" class="form-control" id="area" style="padding: 10px !important;margin-top: -20px;">
                        <option value="informacionGeneral">General</option>
                        <option value="ProteccionSocial">Protección Social</option>
                      </select>
                    </div>



                    <span title="Filtrar por localidad" style="margin-left: 20px; cursor: pointer;">
                      <a onclick="setFilter()">
                        <i class="fa fa-filter"></i>
                      </a>
                    </span>

                  </div>

                </div>


              </div>
              <div class="card-body px-0 pb-2" style="margin: 0 15px 15px">


                <div class="row vistas animated fadeInUp" id="informacionGeneral">
                  <div class="col-lg-6">
                    <ul>
                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Comunas</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Comunas', <?php echo 1 ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo 1 ?>
                        </div>
                      </li>
                      <hr>
                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Consejos Comunales</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Consejos Comunales', <?php echo 7 ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo 7 ?>
                        </div>
                      </li>
                      <hr>
                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Viviendas</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Viviendas', <?php echo $viv  ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo $viv  ?>
                        </div>
                      </li>
                      <hr>

                    </ul>
                  </div>


                  <div class="col-lg-6">

                    <ul>


                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Viviendas vacias</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Viviendas vacias', <?php echo $viv - countDistinc('id_vivienda', 'inf_habitantes'); ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo $viv - countDistinc('id_vivienda', 'inf_habitantes')  ?>
                        </div>
                      </li>
                      <hr>

                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Familias</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Familias', <?php echo $fam  ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo $fam  ?>
                        </div>
                      </li>
                      <hr>

                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Habitantes</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Habitantes', <?php echo $hab ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo $hab  ?>
                        </div>
                      </li>
                      <hr>

                    </ul>

                  </div>
                </div>
                <div class="row vistas  animated fadeInUp" id="ProteccionSocial" style="display: none">
                  <div class="col-lg-6">
                    <ul>
                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Combos alimenticios CLAP</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Combos alimenticios CLAP', <?php echo contar2('inf_habitantes', 'combo_alimenticio_clap="SI"') ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo contar2('inf_habitantes', 'combo_alimenticio_clap="SI"') ?>
                        </div>
                      </li>
                      <hr>


                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Hogares de la patria</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Hogares de la patria', <?php echo contar2('inf_habitantes', 'hogares_de_la_patria="SI"') ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo contar2('inf_habitantes', 'hogares_de_la_patria="SI"') ?>
                        </div>
                      </li>
                      <hr>


                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Parto humanizado</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Parto humanizado', <?php echo contar2('inf_habitantes', 'parto_humanizado="SI"') ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo contar2('inf_habitantes', 'parto_humanizado="SI"') ?>
                        </div>
                      </li>
                      <hr>

                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Lactancia materna</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Lactancia materna', <?php echo contar2('inf_habitantes', 'lactancia_materna="SI"') ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo contar2('inf_habitantes', 'lactancia_materna="SI"') ?>
                        </div>
                      </li>
                      <hr>

                    </ul>
                  </div>





                  <div class="col-lg-6">
                    <ul>

                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Adulto mayor</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Adulto mayor', <?php echo contar2('inf_habitantes', 'pension="SI"') ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo contar2('inf_habitantes', 'pension="SI"') ?>
                        </div>
                      </li>
                      <hr>

                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">José Gregorio Hernandez</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('José Gregorio Hernandez', <?php echo contar2('inf_habitantes', 'recibe_bono_jose_g="SI"') ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo contar2('inf_habitantes', 'recibe_bono_jose_g="SI"') ?>
                        </div>
                      </li>
                      <hr>


                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Carnetizados</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Carnetizados', <?php echo contar2('inf_habitantes', 'carnet_patria="SI"') ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo contar2('inf_habitantes', 'carnet_patria="SI"') ?>
                        </div>
                      </li>
                      <hr>


                      <li style="padding: 0;" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                          <div class="d-flex flex-column">
                            <h6 class="mb-1 text-dark text-sm">Sin carnet</h6>
                            <span class="text-xs" style="opacity: .5;">
                              <a style="cursor: pointer" onclick="comparar('Sin carnet', <?php echo contar2('inf_habitantes', 'carnet_patria="NO"') ?>)">Enviar a comparación</a>
                            </span>
                          </div>
                        </div>
                        <div class="d-flex align-items-center text-sm font-weight-bold">
                          <?php echo contar2('inf_habitantes', 'carnet_patria="NO"') ?>
                        </div>
                      </li>
                      <hr>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-2 mb-md-0 mb-4">


            <div id="graficoContent">

              <div class="card mh-550">
                <h6 class="h6Card">Información comparada</h6>
                <div class="h6CardDiv">
                  <div id="chartdiv" style="display: none;"></div>

                  <div class="piechart imagenNoData" style="margin: 15px">
                    <div id="graficoSinDatos" class="nodatachart card ">Sin datos disponibles</div>
                  </div>
                </div>
                <p id="vaciarDatos" style="cursor: pointer; margin: 0 0 20px 21px; display: none;" onclick="vaciarChart()">Quitar elementos comparados</p>

              </div>
            </div>




            <div id="filterConctent" style="display: none;">

              <div class="card mh-550" style="min-height: 550px;">
                <h6 class="h6Card">Información comparada</h6>
                <div>


                  <div style="margin: 10px 21px 0 21px;">
                    <br>
                    <label style="margin-bottom: 0;" for="municipio?id" style="white-space: nowrap;" class="label-control">Municipio</label>
                    <div class="input-group input-group-outline my-3">
                      <select class="form-control" name="municipio_id" id="municipio_id">
                        <option value="">Seleccione...</option>

                        <?php foreach ($countries as $c) : ?>
                          <option value="<?php echo $c->id_municipio; ?>">&nbsp;<?php echo $c->nombre_municipio; ?></option>
                        <?php endforeach; ?>


                      </select>
                    </div>
                    <label style="margin-bottom: 0;" for="municipio?id" style="white-space: nowrap;" class="label-control">Parroquia</label>
                    <div class="input-group input-group-outline my-3">
                      <select class="form-control" name="continente_id" id="continente_id">
                        <option value="">Seleccione...</option>
                      </select>
                    </div>
                    <label style="margin-bottom: 0;" for="municipio?id" style="white-space: nowrap;" class="label-control">Comuna</label>
                    <div class="input-group input-group-outline my-3">
                      <select class="form-control" name="pais_id" id="pais_id">
                        <option value="">Seleccione...</option>
                      </select>
                    </div>
                    <label style="margin-bottom: 0;" for="municipio?id" style="white-space: nowrap;" class="label-control">Consejo comunal</label>
                    <div class="input-group input-group-outline my-3">
                      <select class="form-control" name="ciudad_id" id="ciudad_id">
                        <option value="">Seleccione...</option>
                      </select>
                    </div>

                    <button class="btn btn-primary bg-gradient-primary box-shadow-primary fr mt1" onclick="establecerFiltro()">
                      Establecer
                    </button>




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
    <script src="mapa/glosario.js"></script>



    <script src="../assets/amcharts5/index.js"></script>
    <script src="../assets/amcharts5/xy.js"></script>
    <script src="../assets/amcharts5/themes/Animated.js"></script>
    <script src="../assets/amcharts5/themes/Material.js"></script>
    <script src="../assets/amcharts5/percent.js"></script>
    <script src="../assets/amcharts5/examples/misc-40-charts/index.js"></script>
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







      function validar() {
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
              }
            })



        }
      }

      function verResult() {
        let consulta = $('#consulta').val()
        $.ajax({
            url: 'consultasAjax/tabla_mostrarTabla.php',
            type: 'POST',
            dataType: 'html',
            data: {
              consulta: consulta,
              camposMostrar: camposMostrar
            },
          })
          .done(function(resultado) {
            $('#tablaResultado').html(resultado)
          })
      }

      function descargar() {
        let consulta = $('#consulta').val()


        window.location.href = "reportes/reporteXlsx.php?consulta=" + consulta + "&camposMostrar=" + camposMostrar;

      }

      function verMap() {

      }



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