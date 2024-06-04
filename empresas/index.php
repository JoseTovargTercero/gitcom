<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Caracterización de las principales actividades económicas de su empresa">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="../assets/img/3-SF.png">

    <title >Empresas</title>
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">

   <style>
        .input-outline-danger{
            box-shadow: 0px 0px 3px 0px red;
        }
    </style>
</head>


<div class="fondo-loader">
    <div class='container'>
      <svg viewBox="0 0 396.45 396.45" stroke-width='10' fill="none" xmlns="http://www.w3.org/2000/svg" class="loadersVG">
        <g class="dash">
          <path style="--sped: 4s;" pathLength="360" d="M181.66,317.82s-48.11-90.72-59.23-114.38c-3.34-7.1-8-17.23-9.07-31.28-3.19-41.66,28.51-72.6,32-76,31.22-29.57,69.74-28.56,75.07-28.34,44.07,1.87,70,31.64,74,36.51,5.12,5.75,26.58,31.08,24,66.64a85.26,85.26,0,0,1-10.73,35.35L251.11,316.8c18.94,3.27,67.17,12.12,67.17,12.12a12.13,12.13,0,0,1,8.57,4.36,11.74,11.74,0,0,1,.88,13,12,12,0,0,1-6.12,5.07,379.7,379.7,0,0,0-52.12-11c-11.62-1.61-22.63-2.59-32.9-3.11a15.44,15.44,0,0,1-5.05-2.19,9.42,9.42,0,0,1-2.65-2.23c-3.33-4.45-3.12-11.26.35-17.42l61.3-121.42c10.48-20.75,7.71-33.44,1.93-41-6.37-8.36-18.05-9.84-24.77-10.08l-52.34.77A17.51,17.51,0,0,0,197.68,160c-.39,9.59,7.77,18.07,17.94,17.88H247a13.16,13.16,0,0,1,.89,25.78L215,204c-24.36.89-44.79-18.88-44.81-42.89,0-24.21,20.71-44.1,45.25-42.95l16.28-.2c.83-.06,7.63-.6,11.49-6.45,3.56-5.4,2.45-12-.19-16.09-2.95-4.54-7.91-6.05-10.15-6.7-10-2.89-45.15-6.35-72.31,19-2.73,2.56-24.51,23.57-25.54,56.6a79.53,79.53,0,0,0,3.77,26.62c21.78,41.44,66,127.53,66,127.53.19.33,3.82,6.79.35,13a13.13,13.13,0,0,1-7.66,6,344.43,344.43,0,0,0-42,4.09c-15.35,2.44-41.23,9.19-41.23,9.19-5.06-2.23-8-7.22-7.31-12,.7-5,5-7.61,5.65-7.95,7.44-2.35,15.49-4.5,24.08-6.49A270.26,270.26,0,0,1,181.66,317.82Z" transform="translate(-200.7 -200)" class="big"></path>
        </g>
      </svg>
      <P style="margin: 165px 0 0 -41px;text-transform: uppercase;color: #bbbbbb;font-family: sans-serif;">
        Cargando...
      </P>
    </div>
  </div>
<body class="g-sidenav-show  bg-gray-200">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Gitcom</a></li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Empresas</h6>
                </nav>
            </div>
        </nav>
        <div class="container-fluid py-4" style="max-width: 90%; margin: auto">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="card" style="min-height: 238px;">
                        <div class="card-body ">
                            <h3 class="position-relative fw-bold mb-4">Caracterización</h3>

                            <form id="formElem" enctype="multipart/form-data">

                                <div class="mb-4">
                                    <label for="emp" class="form-label fw-bold">Empresa</label>
                                    <select id="emp" name="emp" class="form-control">
                                        <option value="">Seleccione</option>
                                        <option value="Alimentos Amazonas">Alimentos Amazonas</option>
                                        <option value="Farmamazonas">Farmamazonas</option>
                                        <option value="Textiles Amazonas">Textiles Amazonas</option>
                                        <option value="Promoamazonas">Promoamazonas</option>
                                        <option value="Bloques y agregados">Bloques y agregados</option>
                                        <option value="Combustibles Amazonas">Combustibles Amazonas</option>
                                        <option value="Saneamiento ambiental">Saneamiento ambiental</option>
                                        <option value="Hidroamazonas">Hidroamazonas</option>
                                        <option value="Transamazonas">Transamazonas</option>
                                        <option value="Gas comunal amazonas">Gas comunal amazonas</option>
                                        <option value="Serviamazonas">Serviamazonas</option>
                                        <option value="Asfaltos Amazonas">Asfaltos Amazonas</option>
                                        <option value="Fundaprodicam">Fundaprodicam</option>
                                        <option value="Acuarios Amazonas">Acuarios Amazonas</option>
                                               <option value="Lubricantes Amazonas">Lubricantes Amazonas</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <p class="form-label fw-bold">Actividad economica</p>


                                    <div class="form-check">
                                        <div class="custom-control custom-checkbox">
                                            <input onchange="control_bienes()" type="checkbox" class="form-check-input form-check-danger"  name="prod_bienes" id="prod_bienes">
                                            <label class="form-check-label" for="prod_bienes">Producción de bienes</label>
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <div class="custom-control custom-checkbox">
                                            <input onchange="control_bienes()" type="checkbox" class="form-check-input form-check-danger"  name="dist_bienes" id="dist_bienes">
                                            <label class="form-check-label" for="dist_bienes">Distribución de bienes</label>
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <div class="custom-control custom-checkbox">
                                            <input onchange="control_bienes()" type="checkbox" class="form-check-input form-check-danger"  name="com_bienes" id="com_bienes">
                                            <label class="form-check-label" for="com_bienes">Comercialización de bienes</label>
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <div class="custom-control custom-checkbox">
                                            <input onchange="control_servicios()" type="checkbox" class="form-check-input form-check-danger"  name="pres_servicios" id="pres_servicios">
                                            <label class="form-check-label" for="pres_servicios">Prestación de servicios</label>
                                        </div>
                                    </div>


                                </div>
                                <section id="sect_servicios" style="display: none;">
                                    <div class="mb-4">
                                        <label for="servicios_presta" class="form-label fw-bold">Servicios que presta</label>
                                        <input type="text" id="servicios_presta"  name="servicios_presta" class="form-control" placeholder="Utilice como separador una coma (,) para describir cada servicio que presta.">
                                    </div>
                                </section>
                                <div class="mb-4">
                                    <label for="sis_facturacion" class="form-label fw-bold">¿Posee un sistema de facturación?</label>
                                    <select id="sis_facturacion"  name="sis_facturacion" class="form-control" onchange="control_sis_asociado()">
                                        <option value="">Seleccione</option>
                                        <option value="NO">No</option>
                                        <option value="Manual">Manual (físico)</option>
                                        <option value="Automatizado">Automatizado</option>
                                    </select>
                                </div>
                                <section id="sect_bienes" style="display: none;">
                                    <div class="mb-4">
                                        <label for="inventario" class="form-label fw-bold">Archivo de inventario</label>
                                        <input type="file" id="inventario"  name="inventario[]" class="form-control">
                                    </div>

                                    <div class="mb-4">
                                        <label for="sis_invetario" class="form-label fw-bold">¿Posee un sistema de inventario?</label>
                                        <select id="sis_invetario"  name="sis_invetario" class="form-control" onchange="control_sis_asociado()">
                                            <option value="">Seleccione</option>
                                            <option value="NO">No</option>
                                            <option value="Manual">Manual (físico)</option>
                                            <option value="Automatizado">Automatizado</option>
                                        </select>
                                    </div>

                                    <section id="sub_sect_bienes" style="display: none;">
                                        <div class="mb-4">
                                            <label for="sis_asociados" class="form-label fw-bold">¿El sistema de inventario está asociado al sistema de facturacion?</label>
                                            <select id="sis_asociados"  name="sis_asociados"  class="form-control">
                                                <option value="">Seleccione</option>
                                                <option value="SI">Si</option>
                                                <option value="NO">No</option>
                                            </select>
                                        </div>
                                    </section>

                                </section>

                                <div class="text-end">
                                    <button id="btnRegistro" class="btn btn-primary fw-semibold">Nuevo registro</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $("form").keypress(function(e) {
                if (e.which == 13) {
                    return false;
                }
            });
        });

      function activar() {
        $('.fondo-loader').hide();
      }
      $(window).on("load", activar);
    </script>
    <script>
        function control_sis_asociado() {

            if ($('#sis_facturacion').val() != '' && $('#sis_invetario').val() != '') {
                if ($('#sis_facturacion').val() == 'Automatizado' && $('#sis_invetario').val() == 'Automatizado') {
                    $('#sub_sect_bienes').show(300);
                } else {
                    $('#sub_sect_bienes').hide(300);
                }
            } else {
                $('#sub_sect_bienes').hide(300);
            }
        }

        function control_bienes() {
            if (document.getElementById("prod_bienes").checked || document.getElementById("dist_bienes").checked || document.getElementById("com_bienes").checked) {
                $('#sect_bienes').show(300);
            } else {
                $('#sect_bienes').hide(300);
            }
        }

        function control_servicios() {
            if (document.getElementById("pres_servicios").checked) {
                $('#sect_servicios').show(300);
            } else {
                $('#sect_servicios').hide(300);
            }
        }

        var errores;

        function emptyField(element) {
            if ($('#' + element).val() == '') {
                $('#' + element).addClass('input-outline-danger')
                errores = 1;
                toast('error', 'Existen campos vacios');
                console.log('Se requiere ' + element)
            }
        }
        function emptyFieldFile(element) {
            if ($('#' + element).val().length == 0) {
                $('#' + element).addClass('input-outline-danger')
                errores = 1;
                toast('error', 'Existen campos vacios');
                console.log('Se requiere ' + element)
            }
        }


         /*  Guardar informacion */
         $(document).ready(function(e) {
            $("#formElem").on('submit', function(e) {

                $('.fondo-loader').show();
                $('#btnRegistro').attr('disabled', true);

                e.preventDefault();
                let formData = new FormData(this);
                errores = 0;

                let i_prod_bienes;
                let i_dist_bienes;
                let i_com_bienes;
                let i_pres_servicios;

                if(document.getElementById("prod_bienes").checked){i_prod_bienes = 'Si';}else{i_prod_bienes = 'No';}
                if(document.getElementById("dist_bienes").checked){i_dist_bienes = 'Si';}else{i_dist_bienes = 'No';}
                if(document.getElementById("com_bienes").checked){i_com_bienes = 'Si';}else{i_com_bienes = 'No';}
                if(document.getElementById("pres_servicios").checked){i_pres_servicios = 'Si';}else{i_pres_servicios = 'No';}

                emptyField('emp');
                emptyField('sis_facturacion');

                if ($('#sis_facturacion').val() == 'Automatizado' && $('#sis_invetario').val() == 'Automatizado') {
                    emptyField('sis_asociados');
                }
                if (document.getElementById("prod_bienes").checked || document.getElementById("dist_bienes").checked || document.getElementById("com_bienes").checked) {
                    emptyFieldFile('inventario');
                    emptyField('sis_invetario');
                }
                
                if (document.getElementById("pres_servicios").checked) {
                    emptyField('servicios_presta');
                } 

                if ($('#sis_facturacion').val() == 'Automatizado' && $('#sis_invetario').val() == 'Automatizado') {
                    emptyField('sis_asociados');
                }

              formData.append('i_prod_bienes', i_prod_bienes);
              formData.append('i_dist_bienes', i_dist_bienes);
              formData.append('i_com_bienes', i_com_bienes);
              formData.append('i_pres_servicios', i_pres_servicios);


                if (errores > 0) {
                    $('.fondo-loader').hide();
                    $('#btnRegistro').attr('disabled', false);
                    return;
                }

                if (document.getElementById("prod_bienes").checked == false && document.getElementById("dist_bienes").checked == false && document.getElementById("com_bienes").checked == false && document.getElementById("pres_servicios").checked == false) {
                    toast('error', 'Debe seleccionar al menos una actividad economica')
                    $('.fondo-loader').hide();
                    $('#btnRegistro').attr('disabled', false);
                    return;
                }


                $.ajax({
                    type: 'POST',
                    url: 'controlador.php',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(msg) {
                        $('#btnRegistro').attr('disabled', false);
                        $('.fondo-loader').hide();
                        
                        $("#emp" + " option[value='']").attr("selected", true);
                        $("#sis_facturacion" + " option[value='']").attr("selected", true);
                        $("#sis_invetario" + " option[value='']").attr("selected", true);
                        $("#sis_asociados" + " option[value='']").attr("selected", true);
                        

                        if (msg.trim() == 's') {
                            
                            document.getElementById("prod_bienes").checked = false
                            document.getElementById("dist_bienes").checked = false
                            document.getElementById("com_bienes").checked = false
                            document.getElementById("pres_servicios").checked = false
                            $('#sect_servicios').hide();
                            $('#sect_bienes').hide();
                            $('#sub_sect_bienes').hide();
                            $('.form-control').val();

                        Swal.fire({
                            title: 'Guardado!',
                            html: 'La información se guardo correctamente.',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#ed5264',
                            cancelButtonColor: '#a9a9a9',
                            confirmButtonText: 'Ok'
                        })
                        $('#inventario').val().length = 0

                    }else{
                        alert('error ' + msg.trim())
                    }

                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    var error_result;
                    $('.fondo-loader').hide();
                    $('#btnRegistro').attr('disabled', false);

                    if (jqXHR.status === 0) {
                        error_result = 'Not connect: Verify Network.';
                    } else if (jqXHR.status == 404) {
                        error_result = 'Requested page not found [404]';
                    } else if (jqXHR.status == 500) {
                        error_result = 'Internal Server Error [500].';
                    } else if (textStatus === 'parsererror') {
                        error_result = 'Requested JSON parse failed.';
                    } else if (textStatus === 'timeout') {
                        error_result = 'Time out error.';
                    } else if (textStatus === 'abort') {
                        error_result = 'Ajax request aborted.';
                    } else {
                        error_result = 'Uncaught Error: ' + jqXHR.responseText;
                    }

                    Swal.fire({
                        title: 'Error interno!',
                        html: error_result + '.<br><strong>Comuníquese con el administrador.</strong>',
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#ed5264',
                        cancelButtonColor: '#a9a9a9',
                        confirmButtonText: 'Ok'
                    })
                });
            });
        });


        $('.form-control').change(function() {
            $(this).removeClass('input-outline-danger');
        });

        $('.form-control').blur(function() {
            $(this).removeClass('input-outline-danger');
        });
    </script>
</body>

</html>