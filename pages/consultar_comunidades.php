<?php
include('../configuracion/conexionMysqli.php');
include('../class/count.php');

unset($_SESSION['proyecto']);
if ($_SESSION['nivel'] != '3') {
  $idUser = $_SESSION['id'];


  $municipios = [];

  $stmt = mysqli_prepare($conexion, "SELECT * FROM `local_municipio`");
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $municipios[$row['id_municipio']] = $row['nombre_municipio'];
    }
  }
  $stmt->close();



  $parroquias = [];

  $stmt = mysqli_prepare($conexion, "SELECT * FROM `local_parroquia`");
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $parroquias[$row['id_parroquias']] = $row['nombre_parroquia'];
    }
  }
  $stmt->close();

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

      #chartdiv {
        width: 100%;
        height: 300px;
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
        <div class="row">
          <div class="col-lg-5 mb-3">


            <div class="card mb-3" style="min-height: 238px;">
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
                <h4 class="position-relative fw-bold mb-2">
                  División etaria
                </h4>
                <div id="chartdiv"></div>
              </div>
            </div>
          </div>


          <div class="col-md-12" id="vista_1">
            <div class="card">
              <div class="ventana-header pb-0 px-3 ">
                <div class="card-title  d-flex justify-content-between">
                  <h5 class="fw-bold mb-1" style="font-size: 17.5px;">Comunidades censadas</h5>



                  <div class="form-check form-switch">
                    <label class="form-check-label" for="showall">Mostrar todos</label>
                    <input style="margin-top: 6px;" class="form-check-input" type="checkbox" id="showall">
                  </div>


                </div>
              </div>
              <div class="card-body p-3 min-vh-50">
                <div class="table-responsive">
                  <!--begin::Table-->
                  <table class="table table-row-bordered table-row-dashed gy-4" style="min-height: 30vh;">
                    <thead class="fs-7 text-gray-400 text-uppercase">
                      <tr>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Estatus</th>
                      </tr>
                    </thead>
                    <tbody class="fs-5">
                      <?php
                      $datos = [];

                      $stmt2 = mysqli_prepare($conexion, "SELECT COM.id_municipio, COM.id_parroquia, COM.id_Comuna, COM.nombre_comuna, CDAD.nombre_c_comunal, CDAD.id_consejo, CDAD.status 
                      FROM local_comunidades AS CDAD 
                      INNER JOIN local_comunas AS COM ON COM.id_Comuna = CDAD.id_comuna
                      WHERE CDAD.id_municipio = '0203'");
                      $stmt2->execute();
                      $result2 = $stmt2->get_result();

                      $datos = []; // Asegurarse de inicializar el array antes de usarlo

                      if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                          // Si la comuna aún no está en $datos, inicializarla con un array vacío para comunidades
                          if (!isset($datos[$row2['id_Comuna']])) {
                            $datos[$row2['id_Comuna']] = [
                              'nombre_comuna' => $row2['nombre_comuna'],
                              'id_municipio' => $row2['id_municipio'],
                              'id_parroquia' => $row2['id_parroquia'],
                              'status' => false,
                              'comunidades' => [] // Aquí aseguramos que sea una lista de comunidades
                            ];
                          }

                          // Agregar cada comunidad al array de comunidades
                          $datos[$row2['id_Comuna']]['comunidades'][] = [
                            "codigo" => $row2['id_consejo'],
                            "nombre" => $row2['nombre_c_comunal'],
                            "status" => $row2['status']
                          ];

                          if ($row2['status'] == 2 || $row2['status'] == 1) {
                            $datos[$row2['id_Comuna']]['status'] = true;
                          }
                        }
                      }


                      foreach ($datos as $key => $item) {

                        $class = ($item['status'] ? 'sho' : 'hiddens hide');

                        echo "<tr class='bg-danger text-white " . $class . "'>
                          <td>" . $municipios[$item['id_municipio']] . ' - ' .  $parroquias[$item['id_parroquia']] . ' - ' . $item['nombre_comuna'] . "</td>
                          <td>" . $key . "</td>
                          <td></td>
                        </tr>"; // IMPRIME LA INFO DE LA COMUNA

                        if (count($item['comunidades']) > 0) {
                          foreach ($item['comunidades'] as $comunidad) {

                            if ($comunidad['status'] == '1') {
                              $status = '<span class="badge bg-danger">Finalizado</span>';
                            } elseif ($comunidad['status'] == '2') {
                              $status = '<span class="badge bg-warning">En proceso</span>';
                            } else {
                              $status = '<span class="badge bg-secondary">Pendiente</span>';
                            }

                            echo "<tr class='" . $class . "'>
                            <td>
                            " . ($comunidad['status'] == '1' ? '<span data-comunidad-nombre="' . $comunidad['nombre'] . '" data-comunidad="' . $comunidad['codigo'] . '" class="linkedtext pointer text-danger">' . $comunidad['nombre'] . '</span>' : $comunidad['nombre']) . "
                            </td>
                            <td>" . $comunidad['codigo'] . "</td>
                          <td>" . $status . "</td>
                          </tr>";
                          }
                        }
                      }


                      ?>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12" id="vista_2" style="display: none;">
            <div class="card">

              <div class="ventana-header pb-0 px-3 ">

                <div class="card-title  d-flex justify-content-between">
                  <h5 class="fw-bold mb-1" id="nombre_comunidad_info" style="font-size: 17.5px;">Habitantes de la comunidad</h5>
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
        <?php include('notificacion.php'); ?>
      </div>
    </main>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>



    <script>
      // ===========================================================
      // Data
      // ===========================================================

      var usData = [];



      function aggregateData(list) {
        var maleTotal = 0;
        var femaleTotal = 0;

        for (var i = 0; i < list.length; i++) {
          var row = list[i];
          maleTotal += row.male;
          femaleTotal += row.female;
        }

        for (var i = 0; i < list.length; i++) {
          var row = list[i];
          row.malePercent = -1 * Math.round((row.male / maleTotal) * 10000) / 100;
          row.femalePercent = Math.round((row.female / femaleTotal) * 10000) / 100;
        }

        return list;
      }

      usData = aggregateData(usData);

      // ===========================================================
      // Root and wrapper container
      // ===========================================================

      // Create root and chart
      var root = am5.Root.new("chartdiv");

      // Set themes
      root.setThemes([
        am5themes_Animated.new(root)
      ]);

      // Create wrapper container
      var container = root.container.children.push(am5.Container.new(root, {
        layout: root.horizontalLayout,
        width: am5.p100,
        height: am5.p100
      }))

      // Set up formats
      root.numberFormatter.setAll({
        numberFormat: "#.##as"
      });


      // ===========================================================
      // XY chart
      // ===========================================================

      // Create chart
      var chart = container.children.push(am5xy.XYChart.new(root, {
        panX: false,
        panY: false,
        wheelX: "none",
        wheelY: "none",
        layout: root.verticalLayout,
        width: am5.percent(60)
      }));

      // Create axes
      var yAxis1 = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
        categoryField: "age",
        renderer: am5xy.AxisRendererY.new(root, {
          minorGridEnabled: true,
          minGridDistance: 15
        })
      }));
      yAxis1.get("renderer").grid.template.set("location", 1);
      yAxis1.get("renderer").labels.template.set("fontSize", 12);
      yAxis1.data.setAll(usData);

      var yAxis2 = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
        categoryField: "age",
        renderer: am5xy.AxisRendererY.new(root, {
          opposite: true
        })
      }));
      yAxis2.get("renderer").labels.template.set("fontSize", 12);
      yAxis2.data.setAll(usData);

      var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
        min: -10,
        max: 10,
        numberFormat: "#.s'%'",
        renderer: am5xy.AxisRendererX.new(root, {
          minGridDistance: 40
        })
      }));

      // Create series
      var maleSeries = chart.series.push(am5xy.ColumnSeries.new(root, {
        name: "Masculino",
        xAxis: xAxis,
        yAxis: yAxis1,
        valueXField: "malePercent",
        categoryYField: "age",
        clustered: false
      }));


      maleSeries.columns.template.setAll({
        tooltipText: "Masculino, edad {categoryY}: {male} ({malePercent.formatNumber('#.0s')}%)",
        tooltipX: am5.p100
      });

      maleSeries.data.setAll(usData);

      var femaleSeries = chart.series.push(am5xy.ColumnSeries.new(root, {
        name: "Femenino",
        xAxis: xAxis,
        yAxis: yAxis1,
        valueXField: "femalePercent",
        categoryYField: "age",
        clustered: false
      }));

      femaleSeries.columns.template.setAll({
        tooltipText: "Femenino, edad {categoryY}: {female} ({femalePercent.formatNumber('#.0s')}%)",
        tooltipX: am5.p100
      });

      femaleSeries.data.setAll(usData);

      // Add labels
      var maleLabel = chart.plotContainer.children.push(am5.Label.new(root, {
        text: "Masculino",
        fontSize: 20,
        y: 5,
        x: 5,
        //centerX: am5.p50,
        fill: maleSeries.get("fill"),
        background: am5.RoundedRectangle.new(root, {
          fill: am5.color(0xffffff),
          fillOpacity: 0.5
        })
      }));

      var femaleLabel = chart.plotContainer.children.push(am5.Label.new(root, {
        text: "Femenino",
        fontSize: 20,
        y: 5,
        x: am5.p100,
        centerX: am5.p100,
        dx: -5,
        fill: femaleSeries.get("fill"),
        background: am5.RoundedRectangle.new(root, {
          fill: am5.color(0xffffff),
          fillOpacity: 0.5
        })
      }));



      // ===========================================================
      // FUNCIÓN PARA CARGAR DATOS DESDE AJAX
      // ===========================================================
      function divisionEtarea(cedula = null, comunidad = null) {
        $.ajax({
          url: 'consultasAjax/division_etarea.php',
          type: 'POST',
          dataType: 'html',
          data: {
            cedula: cedula,
            comunidad: comunidad
          },
        }).done(function(response) {
          const resultado = JSON.parse(response);
          console.log("Datos recibidos:", resultado);

          // Transformar datos al formato del gráfico
          var newData = Object.keys(resultado).map(function(key) {
            return {
              age: key.replace("-", " a "), // Ejemplo: "0-2" -> "0 to 2"
              male: resultado[key].masculino,
              female: resultado[key].femenino
            };
          });

          // Normalizar porcentajes
          newData = aggregateData(newData);

          // Actualizar gráfico con los nuevos datos
          yAxis1.data.setAll(newData);
          yAxis2.data.setAll(newData);
          maleSeries.data.setAll(newData);
          femaleSeries.data.setAll(newData);
        }).fail(function(xhr, status, error) {
          console.error("Error en la consulta AJAX:", error);
        });
      }

      // ===========================================================
      // LLAMAR FUNCIÓN AL CARGAR LA PÁGINA
      // ===========================================================
      $(document).ready(function() {
        divisionEtarea(); // Llamada automática al cargar la página
      });


      /* SALIRRRRRRRRRRRRRRRR */
      var lista

      function buscar(cedula = null, comunidad = null) {
        $.ajax({
          url: 'consultasAjax/actualizar_inf_manejador.php',
          type: 'POST',
          dataType: 'html',
          data: {
            cedula: cedula,
            comunidad: comunidad
          },
        }).done(function(response) {
          divisionEtarea(cedula, comunidad);


          const resultado = JSON.parse(response)

          if (resultado && Object.keys(resultado).length > 0) {

            lista = resultado;

            $('#table').html('')

            let contador = 1;
            let pendientes = 0;
            for (let clave in resultado) {

              resultado[clave].habitantes.forEach((habitante, index) => {


                $('#table').append(`<tr ${(habitante.rol_familiar == 'JEFE DE FAMILIA' ? 'style="background: #fff0f0;"' : '')}>
                <td>${contador++}</td>
                <td><a class="hover-danger" onclick='showInfo("${index}", "${habitante.id_vivienda}")'>${habitante.nombre}</a></td>
                <td><span class="${(cedula != null && cedula == habitante.cedula ? 'text-bold text-danger' : '')}">${ habitante.cedula}</span></td>
                <td>${(habitante.rol_familiar == 'JEFE DE FAMILIA' ? habitante.rol_familiar : '')}</td>
                <td>${habitante.id_c_comunal}</td>
                <td><a href="datosPersona.php?id=${habitante.id}" target="_blank" data-vivienda='${habitante.id_vivienda}' data-habitante='${index}' class="btn btn-sm btn-danger btn-edit"> Ver</a></td>
            </tr>`)

                pendientes += (habitante.actualizado == '0' ? 1 : 0)

              });
            }

            $('#vista_1').hide(300)
            $('#vista_2').show(300)

          } else {
            if (cedula != null) {
              toast('info', 'No se encontró el numero de cédula')
            }
            if (comunidad != null) {
              toast('info', 'No se encontró la comunidad')
            }

          }
        })
      }

      document.addEventListener('click', function(event) {

        if (event.target.closest('.linkedtext')) { // ACCION DE ELIMINAR
          const comunidad = event.target.closest('.linkedtext').getAttribute('data-comunidad');
          const comunidad_nombre = event.target.closest('.linkedtext').getAttribute('data-comunidad-nombre');

          buscar(null, comunidad);

          $('#nombre_comunidad_info').html('Habitantes de la comunidad <b>' + comunidad_nombre + '</b>')
        }
      });

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








      document.getElementById('btn-cedula').addEventListener('click', function() {
        const cedula = document.getElementById('cedula_buscar').value.trim();
        if (cedula != '') {
          buscar(cedula)
        } else {
          alert('Ingrese el numero de cédula')
        }
      })



      document.getElementById('showall').addEventListener('click', function() {
        // verifica si el checkbox esta checked
        if (document.getElementById('showall').checked) {
          $('.hiddens').removeClass('hide')
        } else {
          $('.hiddens').addClass('hide')
        }
      })

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