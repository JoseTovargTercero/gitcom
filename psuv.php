<?php
include('configuracion/conexionMysqli.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="../assets/img/SLS.png">
  <title id="title">Caracterización PSUV</title>



  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/animate.css">
  <script src="../assets/js/jquery-3.6.0.min.js"></script>

  <script src="../assets/js/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="../assets/css/core.css">
  <style>
    .cintaBottomPerfil {
      height: 100%;
    }

    .outline-danger {
      border: 1px solid red;
    }
  </style>


  <script>
    var municipio = [];
    var parroquias = [];
    var comunidades = [];
    var all = [];


    <?php

    function addInfoInstancias($tabla, $array, $campo1, $campo2, $campo3)
    {
      global $conexion;
      switch ($tabla) {
        case '1':
          $t = 'local_municipio';
          break;
        case '2':
          $t = 'local_parroquia';
          break;
      }

      $query2 = "SELECT * FROM $t";
      $search2 = $conexion->query($query2);
      if ($search2->num_rows > 0) {
        while ($row2 = $search2->fetch_assoc()) {
          echo $array . '.push(["' . $row2[$campo1] . '", "' . $row2[$campo2] . '", "' . $row2[$campo3] . '"]);';
          echo 'all["' . $row2[$campo2] . '"] = "' . $row2[$campo3] . '";';
        }
      }
    }

    addInfoInstancias('1', 'municipio', 'id_estado', 'id_municipio', 'nombre_municipio');
    addInfoInstancias('2', 'parroquias', 'id_municipio', 'id_parroquias', 'nombre_parroquia');



    ?>
  </script>

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
          <h6 class="font-weight-bolder mb-0">Caracterización PSUV</h6>
        </nav>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">


      <div class="page-header min-height-100 border-radius-xl mt-4">
        <span class="mask " style="background-color: red;"></span>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-3">


          <form id="formElem">
            <div class="row">

              <h5>Caracterización de cargos de dirección</h5>


              <div class="col-lg-4">
                <div class="card card-plain h-100">

                  <div class="card-body p-3">



                    <div class="mb-3">
                      <label for="cedula" class="form-label">Cédula de identidad</label>
                      <input class="form-control" type="text" name="cedula" id="cedula">
                    </div>

                    <div class="mb-3">
                      <label for="nombre" class="form-label">Nombres y apellidos</label>
                      <input class="form-control" type="text" name="nombre" id="nombre">
                    </div>

                    <div class="mb-3">
                      <label for="fecha" class="form-label">Fecha de nacimiento</label>
                      <input class="form-control" type="date" name="fecha" id="fecha">
                    </div>

                    <div class="mb-3">

                      <label for="telefono" class="form-label">Telefono</label>
                      <input class="form-control" type="text" name="telefono" id="telefono">
                    </div>



                    <div class="row">
                      <div class="col-lg-6">
                        <div class="mb-3">
                          <label for="edad" class="form-label">Edad</label>
                          <input class="form-control" type="number" name="edad">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-3">
                          <label for="sexo" class="form-label">Sexo</label>
                          <select name="sexo" class="form-control" id="sexo">
                            <option value="">Seleccione</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                          </select>
                        </div>
                      </div>
                    </div>






                    <div class="mb-3">
                      <label for="instancia" class="form-label">Instancia</label>
                      <select name="instancia" class="form-control" id="instancia">
                        <option value="">Seleccione</option>
                        <option value="Gobernacion">Gobernación</option>
                        <option value="Alcaldias">Alcaldias</option>
                        <option value="Ministerios">Ministerios</option>
                        <option value="Misiones">Misiones</option>
                        <option value="Entes legislativos">Entes legislativos</option>
                      </select>
                    </div>





                    <br>

                    <div class="mb-3">
                      <label for="foto" class="form-label">Subir foto</label>
                      <input class="form-control" type="file" id="foto" accept=".png, .jpg, .jpeg" name="foto[]">
                    </div>



                    <div class="mb-3">
                      <label for="correo" class="form-label">Partido político en el que milita</label>
                      <input class="form-control" type="text" name="partido" id="partido">
                    </div>







                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-4">
                <div class="card card-plain h-100">



                  <div class="card-body p-3">

                    <div class="row">
                      <div class="col-lg-6">
                        <div class="mb-3">
                          <label for="grado" class="form-label">Grado de instrucción</label>



                          <select name="grado" id="grado" class="form-control">
                            <option value="">Seleccione</option>
                            <option value="Basico">Basico</option>
                            <option value="Bachiller">Bachiller</option>
                            <option value="TSU">TSU</option>
                            <option value="Universitario">Universitario</option>
                            <option value="Pos-grado">Pos-grado</option>
                            <option value="Magister">Magister</option>
                            <option value="Doctorado">Doctorado</option>
                            <option value="Otros">Otros</option>

                          </select>









                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-3">
                          <label for="profesion" class="form-label">Profesión</label>
                          <input class="form-control" type="text" name="profesion" id="profesion">
                        </div>
                      </div>
                    </div>


                    <div class="mb-3">
                      <label for="institucion" class="form-label">Institución en la que labora</label>
                      <input class="form-control" type="text" name="institucion" id="institucion">
                    </div>
                    <div class="mb-3">
                      <label for="cargo" class="form-label">Cargo</label>
                      <input class="form-control" type="text" name="cargo" id="cargo">
                    </div>
                    <div class="mb-3">
                      <label for="tiempo" class="form-label">Tiempo en la tarea</label>
                      <input class="form-control" type="text" name="tiempo" id="tiempo">
                    </div>




                    <div class="mb-3">
                      <label for="edoCivil" class="form-label">Estado civil</label>
                      <input class="form-control" type="text" name="edoCivil" id="edoCivil">
                    </div>



                    <div class="mb-3">
                      <label for="correo" class="form-label">Correo</label>
                      <input class="form-control" type="mail" name="correo" id="correo">
                    </div>






                    <div class="row">
                      <div class="col-lg-12">
                        <div class="mb-3">
                          <label for="militar" class="form-label">Militar</label>
                          <select name="militar" class="form-control" onchange="(this.value == 'Si' ? $('#militares').show(300) : $('#militares').hide(300))">
                            <option value="">Seleccione</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                          </select>
                        </div>
                      </div>


                      <div class="col-lg-12" id="militares" style="display: none;">
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="mb-3">
                              <label for="activo" class="form-label">Activo</label>
                              <select name="activo" class="form-control" id="activo">
                                <option value="">Seleccione</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="mb-3">
                              <label for="rango" class="form-label">Rango</label>
                              <select name="rango" id="rango" class="form-control">
                                <option value="">Seleccione</option>
                                <option value="GJ">GJ</option>
                                <option value="MG">MG</option>
                                <option value="GD">GD</option>
                                <option value="GB">GB</option>
                                <option value="CNEL">CNEL</option>
                                <option value="TCNEL">TCNEL</option>
                                <option value="MAY">MAY</option>
                                <option value="CAP">CAP</option>
                                <option value="PTTE">PTTE</option>
                                <option value="TTE">TTE</option>
                                <option value="SS">SS</option>
                                <option value="SA">SA</option>
                                <option value="SM1">SM1</option>
                                <option value="SM2">SM2</option>
                                <option value="SM3">SM3</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                              </select>
                            </div>
                          </div>

                        </div>
                      </div>




                      <div class="mb-3">
                        <label for="correo" class="form-label">Responsabilidades politicas o social </label>

                        <input class="form-control mb-2" placeholder="1era experiencia" type="text" name="cargo1" id="cargo1">
                        <input class="form-control mb-2" placeholder="2da experiencia" type="text" name="cargo2" id="cargo2">
                        <input class="form-control mb-2" placeholder="3era experiencia" type="text" name="cargo3" id="cargo3">
                        <input class="form-control mb-2" placeholder="4ta experiencia" type="text" name="cargo4" id="cargo4">
                        <input class="form-control mb-2" placeholder="5ta experiencia" type="text" name="cargo5" id="cargo5">


                      </div>


                    </div>









                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-4">
                <div class="card card-plain h-100">

                  <div class="card-body p-3">

                    <div class="mb-3">
                      <label for="direccion" class="form-label">Dirección de habitación</label>
                      <input class="form-control" type="text" name="direccion" id="direccion">
                    </div>



                    <div class="mb-3">
                      <label for="mcp" class="label-control">Municipio</label>
                      <select id="mcp" name="mcp" class="form-control" onchange="setSelect('mcp', this.value)">
                        <option value="">Seleccione</option>
                        <script>
                          municipio.forEach(element => {
                            document.write('<option value="' + element[1] + '">' + element[2] + '</option>')
                          });
                        </script>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="pq" class="label-control">Parroquia</label>
                      <select id="pq" name="pq" class="form-control" onchange="setSelect('pq', this.value)">
                        <option value="">Seleccione</option>
                      </select>
                    </div>






                    <div class="mb-3">
                      <label class="label-control">¿Pertenece a alguna estructura del partido?</label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="estructura" id="nacional" value="nacional">
                        <label class="form-check-label" for="nacional">
                          Nacional
                        </label>
                      </div>


                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="estructura" id="media" value="media">
                        <label class="form-check-label" for="media">
                          Media
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="estructura" id="base" value="base">
                        <label class="form-check-label" for="base">
                          Base
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="estructura" id="ninguna1" value="no">
                        <label class="form-check-label" for="ninguna1">
                          Ninguna
                        </label>
                      </div>



                      <hr>





                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="media" id="estadal" value="estadal">
                        <label class="form-check-label" for="estadal">
                          Estadal (Media)
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="media" id="municipal" value="municipal">
                        <label class="form-check-label" for="municipal">
                          Municipal (Media)
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="media" id="parroquial" value="parroquial">
                        <label class="form-check-label" for="parroquial">
                          parroquia (Media)
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="media" id="ninguna2" value="No">
                        <label class="form-check-label" for="ninguna2">
                          Ninguna
                        </label>
                      </div>


                      <hr>



                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="base" id="ubch" value="ubch">
                        <label class="form-check-label" for="ubch">
                          UBCH (Base)
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="base" id="comunidad" value="comunidad">
                        <label class="form-check-label" for="comunidad">
                          Comunidad (Base)
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="base" id="calle" value="calle">
                        <label class="form-check-label" for="calle">
                          Calle (Base)
                        </label>
                      </div>

                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="base" id="ninguna3" value="No">
                        <label class="form-check-label" for="ninguna3">
                          Ninguna
                        </label>
                      </div>

                    </div>






                    <div class="mb-3">
                      <label for="correo" class="form-label">Responsabilidad institucional desempeñada</label>

                      <input class="form-control mb-2" placeholder="1era responsabilidad" type="text" name="responsabilidad1" id="responsabilidad1">
                      <input class="form-control mb-2" placeholder="2da responsabilidad" type="text" name="responsabilidad2" id="responsabilidad2">
                      <input class="form-control mb-2" placeholder="3era responsabilidad" type="text" name="responsabilidad3" id="responsabilidad3">
                      <input class="form-control mb-2" placeholder="4ta responsabilidad" type="text" name="responsabilidad4" id="responsabilidad4">
                      <input class="form-control mb-2" placeholder="5ta responsabilidad" type="text" name="responsabilidad5" id="responsabilidad5">


                    </div>










                    <div style="text-align: right; width: 100%" class="mt-3">
                      <button class="btn btn-primary" id="guardarButton">Guardar</button>
                    </div>

                  </div>


                  <!-- Modal -->

                </div>
              </div>
          </form>
        </div>
      </div>
    </div>

    </div>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <link rel="stylesheet" href="../assets/vendor/strength/strength.css" />
    <script src="../assets/vendor/strength/strength.min.js"></script>
    <script>
      function setSelect(select, value) {

        nameInstance = select;

        if (select == 'mcp') {
          $('#pq').html('<option value="">Seleccione</option>')
          $('#com').html('<option value="">Seleccione</option>')
          parroquias.forEach(element => {
            if (element[0] == value) {
              $('#pq').append('<option value="' + element[1] + '">' + element[2] + '</option>')
            }
          });
        }


      }



      function emtyInputs(campo) {
        if ($("#" + campo).val() == "") {
          $("#" + campo).addClass('outline-danger');
          //alert(campo + " no puede estar vacio");
          return 1;
        }
        return 0;
      }





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



          let error = 0;
          error += emtyInputs('cedula');
          error += emtyInputs('nombre');
          error += emtyInputs('fecha');
          error += emtyInputs('telefono');
          error += emtyInputs('edad');
          error += emtyInputs('sexo');
          error += emtyInputs('instancia');
          error += emtyInputs('grado');
          error += emtyInputs('profesion');
          error += emtyInputs('institucion');
          error += emtyInputs('cargo');
          error += emtyInputs('tiempo');
          error += emtyInputs('edoCivil');
          error += emtyInputs('militar');
          error += emtyInputs('correo');
          if ($('#militar').val() == 'Si') {
            error += emtyInputs('activo');
            error += emtyInputs('grado');
          }
          error += emtyInputs('direccion');
          error += emtyInputs('mcp');
          error += emtyInputs('pq');







          let estructura = $('input[name=estructura]:checked', '#formElem').val();
          let media = $('input[name=media]:checked', '#formElem').val();
          let base = $('input[name=base]:checked', '#formElem').val();


          formData.append('estructura', estructura);
          formData.append('media', media);
          formData.append('base', base);
          formData.append('estado', 'AMAZONAS');

          if (error != 0) {
            Toast.fire({
              icon: 'warning',
              title: 'Rellene todos los campos (' + error + ')'
            })

            $('#guardarButton').attr('disabled', false);
            return;

          }

          if ($("#foto").val().length < 1) {
            toast('error', 'Seleccione una imagen');
            $('#guardarButton').attr('disabled', false);
            return false;
          }





          $.ajax({
            type: 'POST',
            url: 'psuv-back.php',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(msg) {

              $('#guardarButton').attr('disabled', false);
              $('.form-control').val('');
              if (msg.trim() == 'ok') {


                Swal.fire({
                  title: 'Exito',
                  html: 'La informacion se guardo correctamente.',
                  icon: 'success',
                  showCancelButton: false,
                  confirmButtonText: 'Ok'
                }).then((result) => {

                })
              } else if (msg.trim() == 'Y') {


                Swal.fire({
                  title: 'Denegado',
                  html: 'Registro duplicado.',
                  icon: 'info',
                  showCancelButton: false,
                  confirmButtonText: 'Ok'
                }).then((result) => {

                })



              }










            }
          }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#guardarButton').attr('disabled', false);
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




      $('.form-control').change(function() {
        $(this).removeClass('outline-danger');
      });

      $('.form-control').blur(function() {
        $(this).removeClass('outline-danger');
      });







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