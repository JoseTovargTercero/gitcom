<?php
include('../../configuracion/conexionMysqli.php');
include('../../class/count.php');




if ($_SESSION['validate'] != 'ok') {
    define('PAGINA_INICIO', '../../login/salir.php');
    header('Location: ' . PAGINA_INICIO);
}


$query = $conexion->query("select * from local_municipio");
$countries = array();
while ($r = $query->fetch_object()) {
    $countries[] = $r;
}

$id_usuario = $_SESSION['id'];

$instancia =  '0x';
$instancia_def = '0x';
$instancia_def_name = '0x';

$codigoProyecto = 0;
/* VALIDAR SI LO QUE SE ESTA ABRIENDO ES UN PROYECTO O UNA CONSULTA RAPIDA */
if (isset($_GET['codigo'])) {
    $CantidadConsulta = 0;
    $codigoProyecto = $_GET['codigo'];
    $tipo = '1';

    $query_p = "SELECT * FROM proyectos WHERE id='$codigoProyecto'";
    $buscarMa = $conexion->query($query_p);
    if ($buscarMa->num_rows > 0) {
        while ($row_p = $buscarMa->fetch_assoc()) {
            $mapa = $row_p['nombre'];
            $tipo_proyecto = $row_p['nombre'];
            $desc_proyecto = $row_p['descripcion'];
            $creador_p = $row_p['user'];
            $statusUsuarios = $row_p['confirmar'];
            $raster = $row_p['raster'];
            $instancia_def = $row_p['instancia_def'];
            $instancia = $row_p['instancia'];
        }
    }

    if ($instancia == '2') {
        //saca el nombre de la comuna
        $query_p = "SELECT * FROM local_comunas WHERE id_Comuna='$instancia_def'";
        $buscarMa = $conexion->query($query_p);
        if ($buscarMa->num_rows > 0) {
            while ($row_p = $buscarMa->fetch_assoc()) {
                $instancia_def_name = $row_p['nombre_comuna'];
            }
        }
    }



    if ($creador_p != $id_usuario) {

        if (contar2('proyectos_colaboradores', "proyecto='$codigoProyecto' AND user='$id_usuario'") < 1) {
            if ($_SESSION['nivel'] != '1') {
                define('PAGINA_INICIO', '../cartografia.php');
                header('Location: ' . PAGINA_INICIO);
            }
        } else {
            $rol_proyecto = 'Colaborador';
        }
    } else {
        $rol_proyecto = 'Creador';
    }


    $CantidadConsulta = contar('consultas_almacenadas', $codigoProyecto, 'proyecto');
} else {
    $tipo = '2';
    $mapa = 'Cartografia GITCOM';
}
/* VALIDAR SI LO QUE SE ESTA ABRIENDO ES UN PROYECTO O UNA CONSULTA RAPIDA */

?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel='icon' href='../../assets/img/3-SF.png' type='image/ico' />
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>Cartografía GITCOM</title>
    <script src="js/leaflets.js"></script>
    <link rel="stylesheet" href="css/leaflet.css">
    <link rel="stylesheet" href="css/leaflet-measure.css">
    <link rel="stylesheet" href="webfonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="dist/leaflet.awesome-markers.css">
    <link rel="stylesheet" href="css/leafletDraw.css" />
    <script src="js/leaflet.draw.js"></script>
    <link rel="stylesheet" href="./css/main.css">
    <script type="text/javascript" src="js/Leaflet.Coordinates-0.1.5.min.js"></script>
    <link rel="stylesheet" href="css/Leaflet.Coordinates-0.1.5.css" />
    <link rel="stylesheet" href="../../assets/css/animate.css">
    <link rel="stylesheet" href="plugins/minmap/Control.MiniMap.css" />
    <script src="plugins/minmap/Control.MiniMap.js" type="text/javascript"></script>
    <link rel="stylesheet" href="plugins/context-menu/leaflet.contextmenu.min.css" />
    <script src="plugins/context-menu/leaflet.contextmenu.min.js" type="text/javascript"></script>
    <script src="js/ui/jquery.min.js"></script>
    <script src="js/ui/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="plugins/leaflet.browser.print-master/dist/leaflet-geoman.css">
    <script src="glosario.js"></script>
    <link href="css/styles.css" rel="stylesheet">

    <link rel="stylesheet" href="js/ui/jquery-ui.min.css">
    <script src="../../assets/js/sweetalert2.all.min.js"></script>


    <style>
        .css_COMUNAS_AYACUCHOcopiar_1 {
            background-color: transparent;
            text-shadow: #000 2px 2px;
            border: none;

        }
    </style>

    <script>
        let claves = Object.keys(miArray);
        var availableTags = [];

        claves.forEach(element => {
            availableTags.push(element)
        });

        $(function() {

            $("#consultaPersInput").autocomplete({
                minLength: 3,
                source: availableTags
            });

        });

        function buscarConsulta(valor) {
            var idPersona;
            for (var i = 0; i < availableTags.length; i++) {
                if (availableTags[i].toLowerCase().includes(valor.toLowerCase())) {
                    idPersona = availableTags[i];
                    break;
                }
            }
            return idPersona;
        }

        $(function() {
            $("#graficoMapa").draggable({
                handle: "p"
            });
            $("#leyendaMapa").draggable({
                handle: "p"
            });
            $("div, p").disableSelection();
        });
    </script>

<body>

    <?php
    if ($tipo == '1' && $CantidadConsulta != '0') {

        echo '
        <div class="fondo-loader"  id="loaderCounter">
       <div style="display: flex;flex-direction: column;margin: auto;">
       
       <div class="container">
       <i class="layer"></i>
       <i class="layer"></i>
       <i class="layer"></i>
       </div>
       <br>
       <div class="inf-loader">
       <span>Se están cargando las capas. <br> Restan </span>
       <span id="loaderCounterText" class="loaderCounterText">' . $CantidadConsulta . '</span>
       </div>
       </div>
      </div>';


        echo '
        <input hidden type="text" value="' . $CantidadConsulta . '" id="loaderCounterValue">
        <input type="text" value="' . $codigoProyecto . '" id="codigoProyecto" hidden>';
    }



    ?>
    <!-- Loader consultas -->
    <div class="loader oculto" id="cargandoConsulta">
        <div class="box ">
            <div class="container-2 containerCsv ">
                <div class="card5 ">
                    <span class=" spinIcon " style="background-color: #ffffff00; margin-top: 9.5px; margin-left: 1px !important;"><i class="fa fa-spinner fa-spin"></i></span>
                </div>
            </div>
        </div>
    </div>
    <input type="text" id="cantidadGeometrias" value="hola" hidden>
    <!-- Loader consultas -->






    <?php $arrayColors = array('', 'Dot&nbsp;1', 'Dot&nbsp;2', 'Dot&nbsp;3', 'Dot&nbsp;4', 'Dot&nbsp;5', 'Dot&nbsp;6', 'Dot&nbsp;7', 'Dot&nbsp;8', 'Dot&nbsp;9', 'Dot&nbsp;10', 'Dot&nbsp;11', 'Dot&nbsp;12', 'Dot&nbsp;13', 'Dot&nbsp;14', 'Dot&nbsp;15', 'Dot&nbsp;16', 'Dot&nbsp;17', 'Dot&nbsp;18', 'Dot&nbsp;19', 'Dot&nbsp;20', 'Dot&nbsp;21', 'Dot&nbsp;22', 'Dot&nbsp;23', 'Dot&nbsp;24', 'Dot&nbsp;25', 'Dot&nbsp;26', 'Dot&nbsp;27', 'Dot&nbsp;28', 'Dot&nbsp;29', 'Dot&nbsp;28', 'Dot&nbsp;29', 'Dot&nbsp;30'); ?>


    <div style="height: 100%;" leaflet-browser-print-content>
        <div id="headerImprimir" class="title hide">
            <img src="../../assets/img/gobierno.PNG" height="50px" class="imgGob">
            <img src="../../assets/img/emp_pub.png" height="60px" class="imgGit">
            <span>
                <textarea name="" id="" rows="1" cols="95" style="text-align:center; border: none; font-size: 19px;" rows="10">
                <?php echo $mapa ?>
                </textarea>
                <p style="font-size: 19px;">Gestion de Informacion Territorial Comunal</p>
            </span>
        </div>

        <div id="LeyendaImprimida" class="masPequed hide">
            <div>
                <div style="height: 60%;">
                    <img src="../../assets/img/banda.jpg" width="95%">
                    <p style="font-size: 19px; margin-left: 10px">Elementos del mapa</p>
                    <ul class="list2 leyendaMapaText leyImp" style="font-size: 19px;  margin-left: 0 !important" id="listLeyendaImpresion">
                    </ul>
                </div>
                <img src="../../assets/img/banda.jpg" width="95%">
                <p style="font-size: 19px; margin-left: 10px">Situacion relativa nacional</p>
                <img src="../../assets/img/relativa_nac.jpg" width="95%">

                <img src="../../assets/img/banda.jpg" width="95%">
                <p style="font-size: 19px; margin-left: 10px">Situacion relativa regional</p>
                <img src="../../assets/img/relativa_reg.jpg" width="95%">
                <br>
                <img src="../../assets/img/banda.jpg" width="95%">
                <br>
                <span style=" margin-left: 10px" id="alturaOjo"></span>

            </div>
        </div>




        <?php
        if ($tipo == '1') {
            # code...
            if ($creador_p == $id_usuario && $statusUsuarios == '0' && $tipo == '1') {
                $displayC = 'display: block;';
            }

            if ($creador_p == $id_usuario && $tipo == '1') {

        ?>


                <div class="myModal" style="<?php echo $displayC ?>" id="modal-confirmarUsers">
                    <div class="myContainterModal myContainterModalMin animated fadeInUp">
                        <div class="myheadModal">
                            <div class="headTop">
                                <span>Permisos de los colaboradores</span>
                                <span>
                                    <i class="fa fa-close" onclick="$('.myModal').hide()"></i>
                                </span>
                            </div>
                        </div>
                        <div class="myBodyModal">
                            <table class="table">

                                <thead>
                                    <tr>
                                        <th style="border: none;">Usuario</th>
                                        <th style="border: none; text-align: center;">Modificar</th>
                                    </tr>
                                </thead>

                                <?php



                                $qyery = "SELECT proyectos_colaboradores.mdf, sist_usuarios.id, sist_usuarios.nombreUser, sist_usuarios.origen, proyectos_colaboradores.user FROM proyectos_colaboradores
                        LEFT JOIN sist_usuarios ON sist_usuarios.id = proyectos_colaboradores.user
                         WHERE proyecto='$codigoProyecto'";
                                $search = $conexion->query($qyery);
                                if ($search->num_rows > 0) {
                                    while ($row = $search->fetch_assoc()) {
                                        echo '<tr>
                                            <td>' . $row['nombreUser'] . '</td>
                                            <td style="text-align: center"> <input onchange="setPermisos(\'' . $row['user'] . '\')" type="checkbox"  id="check_' . $row['user'] . '"></td>
                                        <tr>';
                                    }
                                }
                                ?>

                            </table>
                        </div>
                        <?php
                        if ($statusUsuarios == '0') {
                        ?>
                            <div class="myFooterModal">
                                <button class="btn btn-primary" onclick="validarConfigPermisos()">No volver a mostrar</button>
                            </div>

                        <?php
                        }
                        ?>
                        <script>
                            function validarConfigPermisos() {
                                let p = "<?php echo $codigoProyecto ?>"
                                $.get("../../back/mapa_validarpermisos.php", "p=" + p, function(data) {
                                    $('.myModal').hide()
                                });
                            }


                            function setPermisos(id) {
                                let status = document.getElementById('check_' + id).checked
                                let p = "<?php echo $codigoProyecto ?>"
                                if (status) {
                                    status = 1;
                                } else {
                                    status = 0;
                                }

                                $.get("../../back/mapa_permisos.php", "u=" + id + "&s=" + status + "&p=" + p, function(data) {
                                    toast("success", "Se actualizo la configuracion correctamente" + data.trim());
                                });
                            }
                        </script>
                    </div>
                </div>
        <?php
            }
        }

        ?>
        <div class="myModal" id="modal-adminstradorCapasActivas">
            <div class="myContainterModal myContainterModalMin animated fadeInUp">
                <div class="myheadModal">
                    <div class="headTop">
                        <span>Administrar capas activas</span>
                        <span>
                            <i class="fa fa-close" onclick="$('.myModal').hide()"></i>
                        </span>
                    </div>
                </div>
                <div class="myBodyModal">
                </div>
            </div>
        </div>
        <div id="contentMap">
            <div class="header-map" style="display: flex;">
                <nav role="navigation" class="primary-navigation">
                    <ul>
                        <li><i class="fa fa-bars"></i></a>
                            <ul class="dropdown">
                                <li><a href="#">Guardar como proyecto</a></li>
                                <li><a href="#">Publicar como mapa</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <img src="../../assets/img/user-pictures/<?php echo $_SESSION['id'] ?>.png" onerror="this.onerror=null; this.src='../../assets/img/user-pictures/default.jpg'" alt="user-picture" class="cursor-pointer avatar">
            </div>

            <div class="menuLateral">

                <div class="navbar-brand m-0" style="display: flex;  width: 100%;">
                    <img src="../../assets/img/logo-white.png" class="navbar-brand-img h-100" alt="main_logo" width="38px;">

                    <div style="margin-left: 10px;margin-top: -1px; display: grid;">
                        <span style="margin-left: 10px;" class="ms-1  text-white"><?php echo $_SESSION['nombre'] ?></span>
                        <span style="margin-left: 10px;    font-size: 11px;opacity: 0.4;     margin-top: -3px;" class="ms-1  text-white">Usuario GITCOM</span>
                    </div>
                    <span class="cerrarMenu" onclick="vermenulateral()">
                        <i class="fa fa-arrow-left"></i>
                    </span>
                </div>

                <div>
                    <br>
                    <br>
                    <br>

                    <div class="section-capas">

                        <div>
                            <h6 class="tituloAdmCapas bgray">
                                <span>Proyectos recientes</span>
                                <i onclick="minimizarZona('ul-mp', 'che_mp')" id="che_mp" class="fa fa-chevron-up"></i>
                            </h6>
                            <ul class="ul-mp">

                                <?php
                                $query_pr = "SELECT * FROM proyectos WHERE user='$id_usuario' ORDER BY ultimoCambio DESC LIMIT 3 ";
                                $buscarM = $conexion->query($query_pr);
                                if ($buscarM->num_rows > 0) {
                                    while ($row_pa = $buscarM->fetch_assoc()) {

                                        echo ' <li class="misProyectosMap">
                                    <div>' . $row_pa['nombre'] . ' <br> <span class="text-xs">' . date('d/m/Y H:i a', $row_pa['ultimoCambio']) . '</span> </div>

                                    <div>
                                    <a href="?codigo=' . $row_pa['id'] . '" class="open-pr"> <i class="fa fa-folder-open"></i></a>
                                    </div>
                                </li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>

                        <div id="control-layer-gitcom">
                            <h6 class="tituloAdmCapas bgray">
                                <span>
                                    Control de capas
                                </span>

                                <?php
                                if ($tipo == '1') {
                                    echo ' <i onclick="controlCapas()" class="fa fa-gear"></i>';
                                }
                                ?>

                            </h6>
                        </div>
                    </div>
                    <div class="menu-general">
                        <div class="herramientas bgray" title="Inicio">
                            <a href="../" class="text-white" style="top: 0"><i class="fa fa-home"></i></a>
                        </div>

                        <div class="herramientas bgray" title="Cartografia Gitcom">
                            <a href="../cartografia.php" class="text-white" style="top: 0"><i class="fa fa-map"></i></a>
                        </div>

                        <div class="herramientas bgray" title="Consulta avanzada">
                            <a href="../registros.php" class="text-white" style="top: 0"><i class="fa fa-code"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="barra-herramientas">

                <div class="herramientas bg-gradient-primary">
                    <a href="../" class="text-white" style="top: 0"><i class="fa fa-home"></i></a>
                </div>

                <hr class="herramientas-divisor">

                <div class="herramientas" title="Busqueda">
                    <i class="fa fa-search"></i>
                </div>

                <div class="herramientas" title="Consulta" onclick="mostrarOcultarVentanaModal('#consultaPersonalDiv')">
                    <i class="fa fa-search-plus"></i>
                </div>

                <hr class="herramientas-divisor">

                <div class="herramientas" title="Atajos" onclick="mostrarOcultarVentanaModal('#consultaPersonalDiv')">
                    <i class="fa fa-keyboard-o"></i>
                </div>

                <div class="herramientas" title="Proyectos" onclick="mostrarOcultarVentanaModal('#proyectos')">
                    <i class="fa fa-folder-o"></i>
                </div>


                <?php if ($tipo == '1') {
                    if ($creador_p == $id_usuario && $tipo == '1') { ?>

                        <div class="herramientas" title="Permisos de usuarios" onclick="$('#modal-confirmarUsers').show()">
                            <i class="fa fa-users"></i>
                        </div>

                <?php }
                } ?>


                <?php if (@$_SESSION['proyecto']) { ?>
                    <div class="herramientas" title="A�0�9adir capa vectorial" id="cargarCapas" onclick="mostrarOcultarVentanaModal('#nuevaCapaCampos')">
                        <i class="fa fa-file-archive-o"></i>
                    </div>
                <?php } ?>

                <div class="herramientas" style="bottom: 0;position: absolute;" title="Menu" onclick="vermenulateral()">
                    <i class="fa fa-ellipsis-h"></i>
                </div>

            </div>

            <div class="control-baseLayers animated fadeInUp" id="control-baseLayers">
                <h5>Mapas base
                    <i style="float: right; margin-right: 5px;" class="fa fa-close" onclick="$('#control-baseLayers').hide()"></i>
                </h5>
                <span>Seleccione el proveedor que desee</span>
            </div>

            <div id="map"></div>

        </div>


        <img src="images/norte.png" class="norte hide" style="position: absolute;margin: -95px 0 0 12px;width: 80px;">

        <div style="width: 100%; display: flex">

            <p style="width: 25%;" class="autor hide">
                Elaborado el: <?php echo date('d-m-Y') ?>
                <br>
                <?php echo $_SESSION['nombre']
                ?>
            </p>

            <p style="width: 50%; text-align: center; margin-top: 10px">
                Sistema de Coordenadas Geograficas <br> Datum SIRGAS-REGVEN (WGS84)
            </p>
        </div>

    </div>



    <!-- Modal -->
    <div class="modal " id="modal1" data-animation="slideInOutLeft">
        <div class="modal-dialog">

            <div id="nuevoElementoLeyenda" style="display: none; padding-top: 0;">
                <header class="modal-header headerModal" id="tituloPropiedades">
                    Nuevo elemento de leyenda
                    <i class="close-modal zmdi zmdi-close cerrarModal" onclick="cerrarModal()"></i>
                </header>
                <section class="modal-content">


                    <div class="row" style="margin-top: 15px;">


                        <div class="col-lg-12">
                            <div class="col-lg-12">
                                <div class="form-group label-floating is-empty">
                                    <label style="font-weight: 100;" class="control-label">Etiqueta </label>
                                    <input type="text" class="borde form-control" required name="etiquetaLeyenda" id="etiquetaLeyenda">
                                </div>
                            </div>
                            <div class="col-lg-12">

                                <label style="margin: 13px 0 0 0; font-weight: 100;" class="control-label">Simbologia</label>

                                <div class="contenedor row" id="iconosEstandar">


                                    <?php


                                    echo '<label class="center22"  for="2raster1" >
                    <label class="contentRaster" for="2raster1"><img class="imgDot"  width="20px"  src="images/dot/dot_1.png" alt="dot_1.PNG"></label>
                         <p class="textRaster">
                            <input  type="radio" checked name="raster" id="2raster1" class="radio" value="1">
                            <label for="2raster1">' . $arrayColors[1] . '</label>
                        </p>
                    </label>';


                                    for ($i = 2; $i <= 50; $i++) {
                                        echo '<label class="col-lg-3 center22"  for="2raster' . $i . '" >
                    <label class="contentRaster" for="2raster' . $i . '"><img  width="20px"  class="imgDot" src="images/dot/dot_' . $i . '.png" alt="dot_' . $i . '.PNG"></label>
                         <p class="textRaster">
                            <input  type="radio" name="raster" id="2raster' . $i . '" class="radio" value="1">
                            <label for="2raster' . $i . '">' . $arrayColors[$i] . '</label>
                        </p>
                </label>';
                                    }

                                    ?>


                                    <a style="color: #808080;  cursor: pointer; text-decoration: none" class="center22" onclick="mostrarIconosPersonalizados()">
                                        <label class="contentRaster" style=" cursor: pointer;">
                                            <i style="cursor: pointer;font-size: 29px;" class="fa fa-edit"></i>
                                        </label>
                                        <p class="textRaster" style="cursor: pointer;">
                                            Personalizado
                                        </p>
                                    </a>


                                </div>
                                <div id="iconosPersonalizados" style="display: none;">
                                    <div class="contenedor row">


                                        <?php
                                        for ($i = 1; $i <= 4; $i++) {
                                            echo '<label class="center22"  for="4raster' . $i . '" >
                            <label class="contentRaster" for="4raster' . $i . '"><img class="imgDot imgDotSpecial" width="20px" id="img' . $i . '" src="images/dot/dot_es_' . $i . '.png" alt="dot_' . $i . '.PNG"></label>
                                 <p class="textRaster">
                                    <input  type="radio" name="raster" id="4raster' . $i . '" class="radio" value="1">
                                    <label for="4raster' . $i . '">' . $arrayColors[$i] . '</label>
                                </p>
                        </label>';
                                        }

                                        ?>



                                        <a style="color: #808080;  cursor: pointer; text-decoration: none" class="center22" onclick="cerrarIconosPersonalizados()">
                                            <label class="contentRaster" style=" cursor: pointer;">
                                                <i style="cursor: pointer;font-size: 29px;" class="fa fa-dot-circle-o"></i>
                                            </label>
                                            <p class="textRaster" style=" cursor: pointer;">
                                                Estandar
                                            </p>
                                        </a>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group label-floating is-empty">
                                            <label style="font-weight: 100;" class="control-label" for="colorEspecial">Color de icono </label>
                                            <input placeholder="coolore" type="color" class="borde form-control" required name="colorEspecial" id="colorEspecial">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <footer class="modal-footer">
                    <button class="close-modal btn btn-danger btn-raised btn-sm" onclick="nuevoElementoDeLeyenda()"> Agregar</button>
                </footer>
            </div>
            <div id="propiedadesCapa" style="display: none; padding-top: 0;">
                <header class="modal-header headerModal" id="tituloPropiedades">
                    Propiedades
                </header>
                <section class="modal-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label style="font-weight: 100;" class="control-label">
                                    Modificar capa
                                </label>
                                <div class="contenedor row" style="padding: 15px;">
                                    No disponible



                                </div>
                            </div>
                        </div>
                </section>
                <footer class="modal-footer">
                    <span id="nuevoLink">

                    </span>


                    <button class="close-modal btn btn-info btn-raised btn-sm" aria-label="close modal" onclick="cerrarModal()" data-close> Cancelar</button>
                    <button class="close-modal btn btn-danger btn-raised btn-sm" onclick="actualizarPropiedades()"> Actualizar</button>
                </footer>
            </div>
            <div id="nuevaCanchaDiv" style="display: none; padding-top: 0;">
                <header class="modal-header headerModal">
                    Estado de la cancha
                </header>
                <section class="modal-content">

                    <div class="form-group label-floating is-empty">
                        <label class="control-label">Está techada? </label>
                        <select style="padding-left: 10px;" required class="form-control" id="techo">

                            <option value="">-- Seleccione --</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>

                        </select>
                    </div>


                    <div class="form-group label-floating is-empty">
                        <label class="control-label">Está Iluminada? </label>
                        <select style="padding-left: 10px;" required class="form-control" id="iluminada">

                            <option value="">-- Seleccione --</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>

                        </select>
                    </div>

                    <div class="form-group label-floating is-empty">
                        <label class="control-label">Esta pintada? </label>
                        <select style="padding-left: 10px;" required class="form-control" id="pintura">

                            <option value="">-- Seleccione --</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>

                        </select>
                    </div>
                    <div class="form-group label-floating is-empty">
                        <label class="control-label">Tipo de suelo </label>
                        <select style="padding-left: 10px;" required class="form-control" id="piso">
                            <option value="">-- Seleccione --</option>
                            <option value="cemento">Cemento</option>
                            <option value="arena">Arena</option>

                        </select>
                    </div>


                </section>
                <footer class="modal-footer">
                    <button class="close-modal btn btn-info btn-raised btn-sm" aria-label="close modal" onclick="cerrarModal()" data-close> Cancelar</button>
                    <button class="close-modal btn btn-danger btn-raised btn-sm" onclick="guardarCancha()"> Guardar</button>
                </footer>
            </div>
            <div id="consultaRapida" style="display: none; padding-top: 0;">
                <header class="modal-header headerModal">
                    Consulta rapida
                </header>

                <div class="form-group" style="    display: flex">
                    <input type="text" id="consultaSearch" autocomplete="off" name="consultaSearch" class="form-control borde" placeholder="Consulta rapida..." style="height: 34px;">


                </div>
            </div>
            <div id="poligonosCampos" style="display: none;     padding-top: 0;">
                <header class="modal-header headerModal">
                    Atributos del poligono
                </header>


                <div class="form-group label-floating is-empty">
                    <label class="control-label">Es un edificio/casa? </label>
                    <select style="padding-left: 10px;" required class="form-control" id="tresDe">

                        <option value="">-- Seleccione --</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>

                    </select>
                </div>
                <div id="opcionesTresDe" style="display: none;">


                    <div class="form-group label-floating is-empty">
                        <label class="control-label">Color del techo </label>
                        <select style="padding-left: 10px;" required class="form-control" id="colorTecho">

                            <option value="#e0757c">Rojo</option>
                            <option value="#a4c1f0">Azul</option>
                            <option value="#696773">Negro</option>
                            <option value="#cbccc7">Gris</option>

                        </select>
                    </div>
                    <div class="form-group label-floating is-empty">
                        <label class="control-label">Tipo de infraestructura </label>
                        <select style="padding-left: 10px;" required class="form-control" id="tipoEdificio">

                            <option value="residential">Residencial</option>
                            <option value="comercial">Comercial</option>

                        </select>
                    </div>
                    <div class="form-group label-floating is-empty">
                        <label style="background-color: white; width:100%" class="control-label">Cantidad de pisos </label>
                        <input required="" class="form-control" type="number" value="1" id="cantidadPisos">
                    </div>

                </div>

                </section>
                <footer class="modal-footer">
                    <button class="close-modal btn btn-info btn-raised btn-sm" aria-label="close modal" onclick="cerrarModal()" data-close> Cancelar</button>
                    <button class="close-modal btn btn-danger btn-raised btn-sm" id="guardarPoligono"> Guardar</button>
                </footer>
            </div>
            <div id="nuevaCapaCampos" style="display: none; padding-top: 0;">
                <header class="modal-header headerModal">
                    Agregar capa vectorial
                    <i class="close-modal zmdi zmdi-close cerrarModal" onclick="cerrarModal()"></i>
                </header>


                <form action='mapsWrech/cargarCapaVectorial.php' method='post' enctype="multipart/form-data" style="margin: 0 25px;">

                    <div class="form-group label-floating is-empty">
                        <label class="control-label">Tipo de archivo </label>
                        <select style="padding-left: 10px;" required class="form-control" required id="tipoCapaVectorial" name="tipoCapaVectorial">

                            <option value="shp">Archivos shape de ESRI (*.shp *.SHP)</option>
                            <option value="geojson">GeoJSON (*.geojson *.GEOJSON)</option>

                        </select>
                    </div>

                    <div class="form-group label-floating is-empty">
                        <label class="control-label">Nombre de la capa </label>
                        <input type="text" class="form-control" required name="nameCapaVectorial" id="nameCapaVectorial">
                    </div>


                    <div class="form-group label-floating is-empty">
                        <label class="control-label">Conjunto de datos Vectoriales </label>
                        <div style="display: flex;">
                            <input type="file" required class="arreglo" id="archivo[]" name="archivo[]" multiple='' accept=".dbf, .prj, .shp, .shx" style="display: none;" style="width: 93% !important">
                            <input type="text" readonly class="form-control" name="campoNameCapaVectorial" id="campoNameCapaVectorial" style="width: 95%; display: inline-flex;">
                            <label for="archivo[]" class="botomSuspensive" style="margin: 13px 0 0 5px;">...</label>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label">Color de la capa </label>
                                <input type="color" class="form-control" required name="colorCapa" id="colorCapa">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label">Color del borde de la capa </label>
                                <input type="color" class="form-control" required name="colorBordeCapa" id="colorBordeCapa">
                            </div>
                        </div>
                    </div>



                    <footer class="modal-footer">
                        <input type="submit" class="btn btn-danger btn-raised btn-sm" id="guardarCapaVectorial" class="Guardar">
                    </footer>
                </form>
            </div>
            <div id="pointAtPos" style="display: none; padding-top: 0;">
                <header class="modal-header headerModal">
                    Posición especifica
                    <i class="close-modal zmdi zmdi-close cerrarModal" onclick="cerrarModal()"></i>
                </header>

                <div class="row" style="margin: 15px">
                    <div class="col-lg-12">


                        <div class="form-group">
                            <label>
                                <input type="radio" class="radioProjection" name="projection" id="projectionU" value="utm"> &nbsp;&nbsp;
                                <label style="font-weight: 100;" for="projectionU" class="control-label">Proyeccion global (UTM - metros) </label>

                            </label>
                        </div>
                        <div class="col-lg-5">

                            <div class="form-group label-floating is-empty">
                                <label style="font-weight: 100;" class="control-label">Coordenada X </label>
                                <input disabled type="text" class="borde form-control" required name="coordenadaX" id="coordenadaX">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group label-floating is-empty">
                                <label style="font-weight: 100;" class="control-label">Coordenada Y </label>
                                <input disabled type="text" class="borde form-control" required name="coordenadaY" id="coordenadaY">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group label-floating is-empty">
                                <label style="font-weight: 100;" class="control-label">Zona </label>
                                <input disabled type="number" class="borde form-control" required name="zona" id="zona">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>
                                <input type="radio" class="radioProjection" checked name="projection" id="projectionG" value="latlon"> &nbsp;&nbsp;
                                <label style="margin-top: 24px; font-weight: 100;" for="projectionG" class="control-label">Coordenadas geograficas (Latitud - Longitud) </label>
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group label-floating is-empty">
                                <label style="font-weight: 100;" class="control-label">Latitud </label>
                                <input type="text" class="borde form-control" required name="latitud" id="latitud">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group label-floating is-empty">
                                <label style="font-weight: 100;" class="control-label">Longitud </label>
                                <input type="text" class="borde form-control" required name="longitud" id="longitud">
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="modal-footer" style="padding: 19px 20px 0px;">
                    <div class="form-group">
                        <label>
                            <input type="checkbox" style="height: 12px !important;width: 12px !important;margin-right: 13px;" name="centrarMapa" id="centrarMapa"> &nbsp;&nbsp;
                            <label class="control-label" for="centrarMapa">Centrar vista en el marcador </label>

                        </label>
                    </div>

                    <input type="submit" value="Crear" class="btn btn-danger btn-raised btn-sm" class="Guardar" onclick="crearPuntoPorCoordenada()">
                </footer>
            </div>
            <div id="consultaPersonalDiv" style="padding-top: 0; display: none;">


                <header class="modal-header headerModal">
                    Nueva Capa GITCOM
                    <i class="close-modal zmdi zmdi-close cerrarModal" onclick="cerrarModal()"></i>
                </header>

                <div class="row" style="margin: 15px 0 30px 0; padding: 0 11px;" id="consultaDiv">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group label-floating is-empty">
                                    <label style="font-weight: 100;" class="control-label">Nombre de la capa *</label>
                                    <input type="text" class="borde form-control" required name="nombreCapaLeyenda" id="nombreCapaLeyenda">
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group label-floating is-empty">
                                    <label style="font-weight: 100;" class="control-label">Consulta *</label>
                                    <input type="text" class="borde form-control" required name="consultaPersInput" id="consultaPersInput">
                                </div>
                            </div>
                        </div>


                        <?php


                        if ($_SESSION['nivel'] == 3) {
                            $display = "style='display: none'";
                        } else {
                            $display = "";
                        }

                        ?>


                        <div class="row" <?php echo $display ?>>
                            <div class="col-lg-12" style="margin: 22px 0;">
                                <hr>
                            </div>






                            <div class="col-lg-6">
                                <div class="form-group label-floating is-empty">
                                    <label style="font-weight: 100;" class="control-label">Municipio</label>
                                    <select style="padding-left: 10px;" class="form-control" id="mcp">
                                        <option value=""> -- No aplicar ningun filtro --</option>
                                        <?php foreach ($countries as $c) : ?>
                                            <option value="<?php echo $c->id_municipio; ?>">&nbsp;<?php echo $c->nombre_municipio; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group label-floating is-empty">
                                    <label style="font-weight: 100;" class="control-label">Parroquia </label>
                                    <select style="padding-left: 10px;" class="form-control" id="paq">
                                        <option value=""> -- No aplicar ningun filtro --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group label-floating is-empty">
                                    <label style="font-weight: 100;" class="control-label">Comuna </label>
                                    <select style="padding-left: 10px;" class="form-control" id="cma">
                                        <option value=""> -- No aplicar ningun filtro --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group label-floating is-empty">
                                    <label style="font-weight: 100;" class="control-label">Comunidad </label>
                                    <select style="padding-left: 10px;" class="form-control" id="cmia">
                                        <option value=""> -- No aplicar ningun filtro --</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="row" style="padding: 0px 14px; display: none" id="consultaMarcadorDiv">
                    <div class="col-lg-12 marcCol">
                        <div class="marcadorLeft">
                            <div id="marcadorContent1" class="marcadorContent">
                            </div>
                        </div>
                        <div class="marcadorRight">




                            <div style="display: flex; cursor: pointer" onclick="toggleCusmtomMarker()">

                                <i id="chevronRight" class="fa fa-chevron-right" style="font-size: 12px;margin: 5px 0;"></i>
                                <i id="chevronDown" class="fa fa-chevron-down" style="font-size: 12px;margin: 5px 0; display: none"></i>



                                <div id="marcadorContent2" class="marcadorContent" style="width: 15px;height: 15px; margin: 3px;box-shadow: none"></div>
                                <span>Marcador</span>
                            </div>


                            <div style="display: none" id="customMarkerLink" onclick="toggleCusmtomMarkerContent()">

                                <a style="display: flex; color: #f66f77; cursor: pointer; text-decoration: none">

                                    <div id="marcadorContent3" class="marcadorContent" style="width: 15px;height: 15px; margin: 3px 3px 3px 28px;box-shadow: none"></div>
                                    <span>Marcador personalizado</span>
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <hr>
                    </div>
                    <?php

                    $arrayRealColors = array(
                        '',
                        '#e03f48',
                        '#ae2c30',
                        '#ff8f7f',
                        '#ff961d',
                        '#00abdf',
                        '#0067a7',
                        '#226675',
                        '#45daff',
                        '#ef50bb',
                        '#63356b',
                        '#45af00',
                        '#99f765',
                        '#ff91ed',
                        '#565656',
                        '#a5a5a5',
                        '#2c2c2c',
                        '#ff371d',
                        '#cb282c',
                        '#0067ab',
                        '#a7a7a7',
                        '#ff92f0',
                        '#51f757',
                        '#00b100',
                        '#70326d',
                        '#ff4fbf',
                        '#00dbff',
                        '#00ade2',
                        '#ff9700',
                        '#ff907f',
                        '#7e59ff'
                    );

                    ?>
                    <div class="col-lg-12" id="iconosPredeterminados">
                        <label style="font-weight: 100;" class="control-label">Marcadores predeterminados</label>
                        <div class="contenedor row">
                            <?php



                            for ($i = 1; $i <= 31; $i++) {

                                if ($i > 17) {
                                    $borde = '#000000';
                                } else {
                                    $borde = '#ffffff';
                                }


                                echo '<div class="center22" id="id' . $i . '" onclick="iconoPersonalizadoCi(\'' . $arrayRealColors[$i] . '\', \'' . $borde . '\', \'' . $i . '\')">

                                        <div class="contentRaster" >
                                            <div style="height: 18px;width: 18px;background-color: ' . $arrayRealColors[$i] . ';border-radius: 50%;border: 2px solid ' . $borde . ';"></div>
                                        </div>

                                        <p class="textRaster">Dot&nbsp;' . $i . '</p>

                                    </div>';
                            }

                            ?>
                        </div>
                    </div>

                    <div class="col-lg-12" id="iconoPersonalizado" style="display: none;">

                        <div class="col-lg-12">
                            <div class="form-group label-floating is-empty">
                                <label style="font-weight: 100;" class="control-label" onchange="">Tamaño </label>
                                <input type="number" class="form-control" id="ciTamano" value="4" onchange="iconoPersonalizadoCi()">
                                <span style="position: absolute;right: 0;margin: -33px 24px 0 0;font-size: 12px;color: #b8b8b8;">px</span>

                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group label-floating is-empty">
                                <label style="font-weight: 100;" class="control-label">Color del relleno </label>
                                <input type="color" class="form-control" id="ciRellenoColor" value="#e03f48" onchange="iconoPersonalizadoCi()">
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group label-floating is-empty">
                                <label style="font-weight: 100;" class="control-label">Color del borde </label>
                                <input type="color" class="form-control" value="#ffffff" id="ciLineaColor" onchange="iconoPersonalizadoCi()">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group label-floating is-empty">
                                <label style="font-weight: 100;" class="control-label">Estilo del borde </label>
                                <select style="padding-left: 10px;" class="form-control" id="ciEstiloLinea" onchange="iconoPersonalizadoCi()">

                                    <option value="solid">Linea solida</option>
                                    <option value="none">Sin linea</option>

                                </select>

                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group label-floating is-empty">


                                <label style="font-weight: 100;" class="control-label">Ancho del borde </label>

                                <input value="2" type="number" class="form-control" id="ciAnchoLinea" onchange="iconoPersonalizadoCi()">
                                <span style="position: absolute;right: 0;margin: -33px 24px 0 0;font-size: 12px;color: #b8b8b8;">px</span>

                            </div>
                        </div>

                    </div>

                </div>


                <footer class="modal-footer" style="padding: 19px 20px 0px;">

                    <?php

                    if ($tipo != '1') {
                        $condition = 'display: none';
                    }

                    ?>

                    <p style="display: flex; float: left; margin-left: 25px; <?php echo $condition ?>"><input type="checkbox" style="height: 12px !important; width: 12px !important; margin-right: 13px" id="saveConsulta" name="saveConsulta" class="form-control" style="width: 18px; margin-right: 10px; "> <label style="cursor: pointer; margin-top: 5px;" for="saveConsulta"> Almacenar consulta</label></p>

                    <input type="submit" value="Siguiente" class="btn btn-danger btn-raised btn-sm  bg-gradient-primary" class="Guardar" id="siguienteForCapaGitcom" onclick="pantallaMarcadores()">

                    <input style="display: none;" type="submit" value="Cancelar" class="btn btn-secondary btn-raised btn-sm" class="Guardar" id="cancelarVista" onclick="pantallaMarcadores('omite')">

                    <input style="display: none;" type="submit" value="Finalizar" class="btn btn-danger btn-raised btn-sm" class="Guardar" id="btnConsultaPerso">

                </footer>

            </div>
            <div id="icnosPostes" style="padding-top: 0; display: none;">

                <header class="modal-header headerModal">
                    Modificar icono
                    <i class="close-modal zmdi zmdi-close cerrarModal" onclick="cerrarModal()"></i>
                </header>

                <div class="row" style="margin: 15px 0 30px 0; padding: 0 11px;">

                    <input type="text" id="poste" hidden>


                    <div class="col-lg-3">
                        <label class='checkeable'>
                            <input type="radio" value="0" name="radiImg" id="cl-0">
                            <img width="120px" src="images/postes/cl/0-cl.png" alt="0">
                            <center> <small>0 Grados</small> </center>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class='checkeable'>
                            <input type="radio" value="1" name="radiImg" id="cl-1">
                            <img width="120px" src="images/postes/cl/1-cl.png" alt="1">
                            <center> <small>30 Grados</small> </center>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class='checkeable'>
                            <input type="radio" value="2" name="radiImg" id="cl-2">
                            <img width="120px" src="images/postes/cl/2-cl.png" alt="2">
                            <center> <small>60 Grados</small> </center>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class='checkeable'>
                            <input type="radio" value="3" name="radiImg" id="cl-3">
                            <img width="120px" src="images/postes/cl/3-cl.png" alt="3">
                            <center> <small>90 Grados</small> </center>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class='checkeable'>
                            <input type="radio" value="4" name="radiImg" id="cl-4">
                            <img width="120px" src="images/postes/cl/4-cl.png" alt="4">
                            <center> <small>120 Grados</small> </center>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class='checkeable'>
                            <input type="radio" value="5" name="radiImg" id="cl-5">
                            <img width="120px" src="images/postes/cl/5-cl.png" alt="5">
                            <center> <small>150 Grados</small> </center>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class='checkeable'>
                            <input type="radio" value="6" name="radiImg" id="cl-6">
                            <img width="120px" src="images/postes/cl/6-cl.png" alt="6">
                            <center> <small>180 Grados</small> </center>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class='checkeable'>
                            <input type="radio" value="7" name="radiImg" id="cl-7">
                            <img width="120px" src="images/postes/cl/7-cl.png" alt="7">
                            <center> <small>210 Grados</small> </center>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class='checkeable'>
                            <input type="radio" value="8" name="radiImg" id="cl-8">
                            <img width="120px" src="images/postes/cl/8-cl.png" alt="8">
                            <center> <small>240 Grados</small> </center>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class='checkeable'>
                            <input type="radio" value="9" name="radiImg" id="cl-9">
                            <img width="120px" src="images/postes/cl/9-cl.png" alt="9">
                            <center> <small>270 Grados</small> </center>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class='checkeable'>
                            <input type="radio" value="0" name="radiImg" id="cl-10">
                            <img width="120px" src="images/postes/cl/10-cl.png" alt="10">
                            <center> <small>300 Grados</small> </center>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class='checkeable'>
                            <input type="radio" value="1" name="radiImg" id="cl-11">
                            <img width="120px" src="images/postes/cl/11-cl.png" alt="11">
                            <center> <small>330 Grados</small> </center>
                        </label>
                    </div>
                </div>
                <footer class="modal-footer" style="padding: 19px 20px 0px;">
                    <button class="btn btn-danger" onclick="actualizarPoste()">Actualizar</button>
                </footer>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <div id='tabla_resultado'></div>
    <div id='resultadoEdit'></div>

    <div class="time-control" id="areasDe" style="display: none; margin-bottom: -1px;">
        <div style="display: flex;">

            <input type="text" hidden id="codigoAreaInput">
            <input type="text" hidden id="nombreAreaInput">
            <input type="text" hidden id="idArray" value="0">

            <p id="nameArea" style="margin-bottom: 0;margin-right: 15px;width: 251px;overflow: hidden;padding-top: 4px;height: 25px;white-space: nowrap;">Nombre del area de interes</p>
            <button style="height: 28px;" onclick="beforRegistroAerasInteres('resta')" class="btn btn-secondary" id="areaAnterior"><i class="line icon-arrow-left"></i></button>
            <button style="height: 28px;" onclick="beforRegistroAerasInteres('suma')" class="btn btn-secondary" id="areaSiguiente"><i class="line icon-arrow-right"></i></button>


            <button style="background-color: #ff000000 !important;height: 28px;margin-top: -13px;font-size: 18px;padding: 15px;outline: none !important;color: #818181; display: none;" onclick="guardarMarker('guardarAreaInteres')" class="btn btn-secondary" id="guardarArea"><i class="fa fa-save"></i></button>

        </div>

    </div>


    <div class="leyendaMapa animated fadeInUp" id="leyendaMapa">
        <div class="headerLeyenda">
            <p class="headerText">Elementos del mapa
                <span class="leyendaHerramientas">
                    <i class="botonesLeyenda fa fa-plus" onclick="mostrarOcultarVentanaModal('#nuevoElementoLeyenda')"></i> &nbsp;&nbsp;
                    <i class="botonesLeyenda fa fa-close" onclick="mostrarOcultarLeyenda()"></i>
                </span>
            </p>
        </div>
        <ul class="list2 leyendaMapaText" id="listLeyenda"></ul>
    </div>


    <div class="botonImpresion" id="botonImpresion">
        <div style="display: flex;">
            <button class="btn btn-primary printEnd" id="CancelprintMapButtom" onclick=" printMapEnd()"> Cancelar</button>
            <button style="margin-left: 15px;" class="btn btn-danger printEnd" id="printMapButtom" onclick="printEnd()"><i class="fa fa-print"></i> Imprimir</button>
        </div>
    </div>


    <script src="js/leaflet.rotatedMarker.js"></script>
    <script src="js/leaflet.pattern.js"></script>
    <script src="js/Autolinker.min.js"></script>
    <script src="js/rbush.min.js"></script>
    <script src="js/labelgun.min.js"></script>
    <script src="js/labels.js"></script>
    <script src="js/Autolinker.min.js"></script>

    <script src="js/leaflet-measure.js"></script>
    <script src="js/proj4.js"></script>
    <script src="js/proj4leaflet.js"></script>
    <script src="data/EtiquetaComunidades_3.js"></script>
    <script src="data/BordeComunidades_7.js"></script>
    <script src="dist/leaflet.awesome-markers.js"></script>
    <script src="catiline.js"></script>
    <script src="leaflet.shpfile.js"></script>
    <script src="data/COMUNAS_AYACUCHOcopiar_1.js"></script>


    <script src="plugins/leaflet.browser.print-master/dist/leaflet.browser.print.js"></script>
    <script src="plugins/leaflet.browser.print-master/dist/leaflet-geoman.js"></script>
    <?php
    /*
    //  $instancia_def

    if (isset($_GET['codigo'])) {


        if ($instancia == '1') {
            // comunidad -> 
            $query_p = "SELECT * FROM local_comunidades WHERE id_consejo='$instancia_def'";
            $buscarMa = $conexion->query($query_p);
            if ($buscarMa->num_rows > 0) {
                while ($row_p = $buscarMa->fetch_assoc()) {
                    $id_municipio = $row_p['id_municipio'];
                    $id_parroquia = $row_p['id_parroquia'];
                    $id_comuna = $row_p['id_Comuna'];
                }
            }
    ?>
            <script>
                $("#mcp" + " option[value='<?php echo $id_municipio ?>']").attr("selected", true);
                $("#paq" + " option[value='<?php echo $id_parroquia ?>']").attr("selected", true);
                $("#cma" + " option[value='<?php echo $id_comuna ?>']").attr("selected", true);
                $("#cmia" + " option[value='<?php echo $instancia_def ?>']").attr("selected", true);
            </script>

        <?php
        } elseif ($instancia == '2') {
            // comunidad -> 
            $query_p = "SELECT * FROM local_comunidades WHERE id_comuna='$instancia_def'";
            $buscarMa = $conexion->query($query_p);
            if ($buscarMa->num_rows > 0) {
                while ($row_p = $buscarMa->fetch_assoc()) {
                    $id_municipio = $row_p['id_municipio'];
                    $id_parroquia = $row_p['id_parroquia'];
                    $id_comuna = $row_p['id_comuna'];
                }
            }
        ?>
            <script>
                $("#mcp" + " option[value='<?php echo $id_municipio ?>']").attr("selected", true);
                $("#paq" + " option[value='<?php echo $id_parroquia ?>']").attr("selected", true);
                $("#cma" + " option[value='<?php echo $instancia_def ?>']").attr("selected", true);
            </script>
    <?php
        }
    }*/
    ?>



    <script>
        function minimizarZona(div, che) {


            if ($('.' + div).hasClass('min')) {
                $('.' + div).removeClass('min')
                $('#' + che).addClass('fa-chevron-up')
                $('#' + che).removeClass('fa-chevron-down')
            } else {
                $('.' + div).addClass('min')
                $('#' + che).addClass('fa-chevron-down')
                $('#' + che).removeClass('fa-chevron-up')
            }

            $('.' + div).toggle(300);


        }


        function mostrarOcultarGrilla() {
            if (map.hasLayer(tiles)) {
                tiles.remove(map)
            } else {
                tiles.setZIndex(999)
                tiles.addTo(map)
            }
        }


        function mostrarOcultarLeyenda() {
            $('#leyendaMapa').toggle()
        }


        function vermenulateral() {
            if ($('.menuLateral').hasClass('menuVisible')) {
                $('.menuLateral').removeClass('menuVisible')
            } else {
                $('.menuLateral').addClass('menuVisible')
            }
        }


        function printMap() {
            $('#contentMap').addClass('masPeque');
            $('#map').addClass('relative');
            $('#LeyendaImprimida').removeClass('hide');
            $('.norte').removeClass('hide');
            $('#headerImprimir').removeClass('hide');
            $('.autor').removeClass('hide');

            $('.leaflet-control-container').hide();
            $('.classresumen').hide();
            $('.marcaGitcom').hide();
            $('#leyendaMapa').addClass('hide');

            $('#alturaOjo').text('Altura: ' + $('.leaflet-control-scale-line').text());

            $('#botonImpresion').show();

            if ("<?php echo $tipo ?>" == "3") {
                $('#verDetalesACA').hide();
                $('#DetalesACA').hide();
            }

        }

        function setTime() {
            if ($('.tileSatelite').hasClass('noche')) {
                $('.tileSatelite').removeClass('noche')
                $('#map').removeClass('mapNoche')
            } else {
                $('.tileSatelite').addClass('noche')
                $('#map').addClass('mapNoche')
            }
        }

        function zoomIn(e) {
            map.zoomIn();
        }

        function zoomOut(e) {
            map.zoomOut();
        }

        function mapasBaseDisponibles() {
            $('#control-baseLayers').show()
        }

        var map = new L.Map('map', {
            minZoom: 1, // se establece un rango de zoom
            maxZoom: 28, // se establece un rango de zoom
            contextmenu: true,
            contextmenuWidth: 300,
            contextmenuItems: [{
                text: 'Mostrar/Ocultar grilla',
                callback: mostrarOcultarGrilla
            }, {
                text: 'Mostrar/Ocultar elementos del mapa',
                callback: mostrarOcultarLeyenda
            }, {
                text: 'Nueva composicion de impresion',
                callback: printMap
            }, {
                text: 'Cambiar mapa base',
                callback: mapasBaseDisponibles
            }, '-', {
                text: 'Acercar',
                icon: '../../assets/img/zoom-in.png',
                callback: zoomIn
            }, {
                text: 'Alejar',
                icon: '../../assets/img/zoom-out.png',
                callback: zoomOut
            }]
        }).setView([5.6450, -67.5950], 17, false);


        map.attributionControl.addAttribution('Gitcom');

        const instancia = "<?php echo $instancia ?>"
        const instancia_def = "<?php echo $instancia_def ?>"
        const instancia_def_name = "<?php echo $instancia_def_name ?>"


        var polligono_comunidades = new L.Shapefile('capasCargadas/comunidades.zip', {
            onEachFeature: function(feature, layer) {
                if (feature.properties) {
                    layer.bindPopup(Object.keys(feature.properties).map(function(k) {
                        let comprobacion = false;

                        if (instancia == 1) {
                            // comunitario
                            if (layer.feature.properties['id_comunid'] == instancia_def) {
                                comprobacion = true
                            }
                        } else if (instancia == 2) {
                            if (layer.feature.properties['COMUNA'] == instancia_def_name) {
                                comprobacion = true
                            }
                        }

                        if (comprobacion) {
                            layer.setStyle({
                                color: "red",
                                dashArray: "4",
                                fillColor: "red",
                                fillOpacity: 0.1,
                            })
                        }

                        if (k == 'NAME' || k == 'PERIMETER' || k == 'COMUNA') {
                            return k + ": " + feature.properties[k] + '<br>';
                        }
                    }).join(''), {
                        maxHeight: 200
                    });
                }
            },
            style: function(feature) {
                return {
                    color: "#ffffff",
                    fillColor: "#ffffff",
                    fillOpacity: 0.05,
                    weight: 2
                };
            }
        });
        //polligono_comunidades.addTo(map)



        function cargarShp(nombreCapa, src, fillColor, strokeColor, fillOpacity, status) {
            var geometrias = 0;

            var capa = new L.Shapefile("capasCargadas/" + src + ".zip", {
                onEachFeature: function(feature, layer) {
                    if (feature.properties) {
                        layer.bindPopup(
                            Object.keys(feature.properties)
                            .map(function(k) {
                                if (feature.properties[k] != '') {
                                    return k + ": " + feature.properties[k] + '<br>';
                                }
                            })
                            .join(""), {
                                maxHeight: 200,
                            }
                        );
                    }

                    /*   var layerPropertys = Object.entries(layer['feature']['geometry']);
                       var typeGeometry = Object.entries(layerPropertys[0][1])
                       
                       var myArray = Object.values(typeGeometry)
                       var typeGEnd = '';
                       myArray.forEach(element => {
                           typeGEnd = typeGEnd + element;
                       });

                       alert(typeGEnd)*/

                    /* layer.setIcon(
                       new L.Icon({
                         iconUrl: "images/dot/dot_1.png",
                         iconSize: [13, 13],
                         popupAnchor: [0, -4],
                       })
                     );
                     */

                    geometrias = geometrias + 1;

                    $("#cantidadGeometrias").val(geometrias);
                },
                style: function(feature) {
                    return {
                        color: strokeColor,
                        fillColor: fillColor,
                        fillOpacity: fillOpacity
                    };
                },

            });

            if (status == '1') {
                capa.addTo(map);
            }

            capa.once("data:loaded", function() {

                capa.bringToBack()
                controlP.addOverlay(
                    capa,
                    '<img width="13px" src="legend/shapes.png" />  ' + nombreCapa + ' (' + $("#cantidadGeometrias").val() + ')'
                );
            });


        }
        //   L.control.coordinates().addTo(map);





        var autolinker = new Autolinker({
            truncate: {
                length: 30,
                location: 'smart'
            }
        });







        // remove popup's row if "visible-with-data"
        function removeEmptyRowsFromPopupContent(content, feature) {
            var tempDiv = document.createElement('div');
            tempDiv.innerHTML = content;
            var rows = tempDiv.querySelectorAll('tr');
            for (var i = 0; i < rows.length; i++) {
                var td = rows[i].querySelector('td.visible-with-data');
                var key = td ? td.id : '';
                if (td && td.classList.contains('visible-with-data') && feature.properties[key] == null) {
                    rows[i].parentNode.removeChild(rows[i]);
                }
            }
            return tempDiv.innerHTML;
        }
        // add class to format popup if it contains media
        function addClassToPopupIfMedia(content, popup) {
            var tempDiv = document.createElement('div');
            tempDiv.innerHTML = content;
            if (tempDiv.querySelector('td img')) {
                popup._contentNode.classList.add('media');
                // Delay to force the redraw
                setTimeout(function() {
                    popup.update();
                }, 10);
            } else {
                popup._contentNode.classList.remove('media');
            }
        }


        function pop_COMUNAS_AYACUCHOcopiar_1(feature, layer) {
            var popupContent = '<table>\
                    <tr>\
                        <td colspan="2"><b>Comunidad</b>: ' + (feature.properties['NAME'] !== null ? autolinker.link(String(feature.properties['NAME']).replace(/'/g, '\'').toLocaleString()) : '') + '</td>\
                    </tr>\
                    <tr>\
                        <td colspan="2"><b>Comuna</b>:' + (feature.properties['COMUNA'] !== null ? autolinker.link(String(feature.properties['COMUNA']).replace(/'/g, '\'').toLocaleString()) : '') + '</td>\
                    </tr>\
                </table>';
            var content = removeEmptyRowsFromPopupContent(popupContent, feature);
            layer.on('popupopen', function(e) {
                addClassToPopupIfMedia(content, e.popup);
            });
            layer.bindPopup(content, {
                maxHeight: 400
            });
        }

        function style_COMUNAS_AYACUCHOcopiar_1_0() {
            return {
                pane: 'pane_COMUNAS_AYACUCHOcopiar_1',
                opacity: 1,
                color: 'rgba(229,229,229,1.0)',
                dashArray: '',
                lineCap: 'square',
                lineJoin: 'bevel',
                weight: 1.0,
                fillOpacity: 0,
                interactive: true,
            }
        }
        map.createPane('pane_COMUNAS_AYACUCHOcopiar_1');
        map.getPane('pane_COMUNAS_AYACUCHOcopiar_1').style.zIndex = 200;
        map.getPane('pane_COMUNAS_AYACUCHOcopiar_1').style['mix-blend-mode'] = 'normal';
        var layer_COMUNAS_AYACUCHOcopiar_1 = new L.geoJson(json_COMUNAS_AYACUCHOcopiar_1, {
            attribution: '',
            interactive: true,
            dataVar: 'json_COMUNAS_AYACUCHOcopiar_1',
            layerName: 'layer_COMUNAS_AYACUCHOcopiar_1',
            pane: 'pane_COMUNAS_AYACUCHOcopiar_1',
            onEachFeature: pop_COMUNAS_AYACUCHOcopiar_1,
            style: style_COMUNAS_AYACUCHOcopiar_1_0,
        });
        map.addLayer(layer_COMUNAS_AYACUCHOcopiar_1);
        var i = 0;
        layer_COMUNAS_AYACUCHOcopiar_1.eachLayer(function(layer) {
            var context = {
                feature: layer.feature,
                variables: {}
            };
            layer.bindTooltip((layer.feature.properties['NAME'] !== null ? String('<div style="color: #fff;  font-weight: bold; font-size: 12pt; font-family: \'Arial\', sans-serif;">' + layer.feature.properties['NAME']) + '</div>' : ''), {
                permanent: false,
                offset: [-0, -16],
                className: 'css_COMUNAS_AYACUCHOcopiar_1'
            });
            labels.push(layer);
            totalMarkers += 1;
            layer.added = true;
            addLabel(layer, i);
            i++;
        });


















        function ajax(url, callback) {
            var req = new XMLHttpRequest();
            req.onreadystatechange = function() {
                if (req.readyState !== 4) {
                    return;
                }
                if (!req.status || req.status < 200 || req.status > 299) {
                    return;
                }

                callback(JSON.parse(req.responseText));
            };
            req.open('GET', url);
            req.send(null);
        }

        // formatted json output
        function formatJSON(json) {
            var html = '';
            for (var key in json) {
                html += '<em>' + key + '</em> ' + json[key] + '<br>';
            }
            return html;
        }




        var baseLayers = {
            Satelite: L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                minZoom: 2,
                maxZoom: 28,
                attribution: '',
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            Google_maps: L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                minZoom: 2,
                maxZoom: 28,
                attribution: '',
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            SateliteToponimia: L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                minZoom: 2,
                maxZoom: 28,
                attribution: '',
                subdomains: ["mt0", "mt1", "mt2", "mt3"]
            }),
            CartoDB_DarkMatter: L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                minZoom: 2,
                maxZoom: 28,
                attribution: '',
                subdomains: 'abcd'
            }),
            Osm: L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                minZoom: 2,
                maxZoom: 28,
                attribution: ''
            }),
            Thunderforest_cycle: L.tileLayer('https://tile.thunderforest.com/cycle/{z}/{x}/{y}.png?apikey=bcb6498104ba41898868b1e683344a4b', {
                minZoom: 2,
                maxZoom: 18,
                attribution: '',
                subdomains: 'abcd',
            }),

        };

        <?php

        if ($tipo == '1') {
            switch ($raster) {
                case '1':
                    echo 'map.addLayer(baseLayers.SateliteToponimia);';
                    break;
                case '2':
                    echo 'map.addLayer(baseLayers.Satelite);';
                    break;
                case '3':
                    echo 'map.addLayer(baseLayers.Google_maps);';
                    break;
                case '4':
                    echo 'map.addLayer(baseLayers.CartoDB_DarkMatter);';
                    break;
                case '5':
                    echo 'map.addLayer(baseLayers.Osm);';
                    break;
                case '6':
                    echo 'map.addLayer(baseLayers.Thunderforest_cycle);';
                    break;
            }
        } else {
            echo 'map.addLayer(baseLayers.SateliteToponimia);';
        }

        ?>
        /* layers del mapa */


        var baseLayersCopy = {
            Satelite: L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                minZoom: 2,
                maxZoom: 28,
                attribution: '',
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            Google_maps: L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                minZoom: 2,
                maxZoom: 28,
                attribution: '',
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            SateliteToponimia: L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                minZoom: 2,
                maxZoom: 28,
                attribution: '',
                subdomains: ["mt0", "mt1", "mt2", "mt3"]
            }),
            CartoDB_DarkMatter: L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                minZoom: 2,
                maxZoom: 28,
                attribution: '',
                subdomains: 'abcd'
            }),
            Osm: L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                minZoom: 2,
                maxZoom: 28,
                attribution: ''
            }),
            Thunderforest_cycle: L.tileLayer('https://tile.thunderforest.com/cycle/{z}/{x}/{y}.png?apikey=bcb6498104ba41898868b1e683344a4b', {
                minZoom: 2,
                maxZoom: 18,
                attribution: '',
                subdomains: 'abcd',
            }),

        };


        var miniMap = new L.Control.MiniMap(baseLayersCopy.SateliteToponimia, {
            toggleDisplay: true
        }).addTo(map);


        map.attributionControl.setPrefix('');

        var autolinker = new Autolinker({
            truncate: {
                length: 30,
                location: 'smart'
            }
        });


        var measureControl = new L.Control.Measure({
            position: 'topleft',
            primaryLengthUnit: 'kilometers',
            secondaryLengthUnit: 'sqmeters',
            primaryAreaUnit: 'meters',
            secondaryAreaUnit: 'sqmeters'
        });
        measureControl.addTo(map);




        /* REGLA PARA MEDIR DISTANCIAS Y AREAS Y LOCATE*/
        var bounds_group = new L.featureGroup([]);

        function setBounds() {
            map.setMaxBounds(map.getBounds());
        }

        var casas = L.layerGroup([]);
        var casasPeople = L.layerGroup([]);


        var EditMarker = L.AwesomeMarkers.icon({
            icon: 'pencil',
            markerColor: 'green',
            prefix: 'fa',
            spin: false
        });

        var iconAreas = L.AwesomeMarkers.icon({
            icon: 'tree',
            markerColor: 'purple',
            prefix: 'fa',
            spin: false
        });




        var colors = ['red', 'blue', 'green', 'purple', 'orange', 'darkred', 'lightred', 'darkblue', 'cadetblue', 'darkpurple', 'pink', 'lightblue', 'lightgreen', 'gray', 'black', 'lightgray'];

        function randomMarker(color, color2, clase) {
            var iconRandomMarker = L.AwesomeMarkers.icon({
                icon: clase,
                iconColor: color2,
                markerColor: color,
                prefix: 'fa',
                spin: false
            });
            return iconRandomMarker;
        }



        /* Marcadores pesonalizados */

        /*===================================================
                         DIBUJAR LA GRILLA          
        ===================================================*/

        var tiles = new L.GridLayer();
        tiles.createTile = function(coords) {
            var tile = L.DomUtil.create('canvas', 'leaflet-tile ');
            var ctx = tile.getContext('2d');
            var size = this.getTileSize()
            tile.width = 256
            tile.height = 256
            // Multiplica el numero de corte por la resolucion del corte, el valor predeterminado es 256 pixeles, obten las coordenadas absolutas de pixeles de la esquina superior izquierda del corte
            var nwPoint = coords.scaleBy(size)
            // Basado en las coordenadas absolutas de pixeles y el nivel de zoom, proyeccion hacia atros para obtener su latitud y longitud
            var nw = map.unproject(nwPoint, coords.z)
            // Comience a dibujar desde la esquina superior izquierda del corte, dibuje un rectangulo sin relleno del tama;o de un corte
            ctx.strokeRect(nwPoint.x, nwPoint.y, size.x, size.y)


            ctx.fillStyle = 'black';
            // pantalla x, y, z
            // ctx.fillText('x: ' + coords.x + ', y: ' + coords.y + ', zoom: ' + coords.z, 50, 60);
            // coordenadas de latitud y longitud

            ctx.fillText(nw.lat, 10, 20);
            ctx.fillText(nw.lng, 10, 40);

            // El color de la l��nea.
            ctx.strokeStyle = 'black';

            // Este es el m��todo de los canvans
            ctx.beginPath();
            ctx.moveTo(0, 0);
            ctx.lineTo(size.x - 1, 0);
            ctx.lineTo(size.x - 1, size.y - 1);
            ctx.lineTo(0, size.y - 1);
            ctx.closePath();
            ctx.stroke();
            return tile;
        }


        function propiedades(value, consulta, tipo) {
            $('#tituloPropiedades').html('Propiedades de la capa ' + value)
            $('#nuevoLink').html(' <a style="display: flex; float: left; margin-left: 15px;" href="../reportes/reporteXlsx.php?consulta=' + consulta + '/' + tipo + '">Generar un archivo XLSX de esta consulta</a>')
            mostrarOcultarVentanaModal('#propiedadesCapa')
        }

        function nuevoElementoDeLeyenda() {
            var etiqueta = $("#etiquetaLeyenda").val()
            if (etiqueta != "") {

                $("#etiquetaLeyenda").val('')

                for (let index = 1; index <= 50; index++) {
                    if (document.getElementById("2raster" + index).checked == true) {
                        cerrarModal()
                        var img = 'dot_' + index + '.png';
                    }
                }


                var htmlExistente = $("#listLeyenda").html();
                var htmlExistente = $("#listLeyendaImpresion").html();

                var htmlAgregado = '<li  style="display: flex; "><img width="13px" src="images/dot/' + img + '"><span>&nbsp;&nbsp;' + etiqueta + '</span></li><br>';

                $("#listLeyenda").html(htmlExistente + htmlAgregado);

                var htmlAgregadoPrint = '<li  style="display: -webkit-inline-box;"><img width="13px" src="images/dot/' + img + '"><span>&nbsp;&nbsp;' + etiqueta + '</span></li><br>';

                $("#listLeyendaImpresion").html(htmlExistente + htmlAgregadoPrint);

            }

        }


        function setMapaBaseDefecto(m) {
            if ("<?php echo $tipo ?>" == '1') {
                let p = "<?php echo @$codigoProyecto ?>"
                $.get("../../back/mapa_setLayer.php", "p=" + p + "&m=" + m, function(data) {});
            }
        }



        function agregarElemento(valor, simbol, ondbl) {

            var borde;
            var values = simbol.split('/');
            var htmlExistente = $("#listLeyenda").html();
            var htmlExistente2 = $("#listLeyendaImpresion").html();


            if (values[3] == 'solid') {
                borde = 'border: 2px ' + values[3] + ' ' + values[2] + ';';
            } else {
                borde = '';
            }

            var htmlAgregado = '<li ' + ondbl + ' style="display: flex; cursor: pointer"><div class="marcadorContent2" style="background-color: ' + values[1] + ' !important; ' + borde + ' -webkit-print-color-adjust: exact;"></div><span>&nbsp;&nbsp;' + valor + '</span></li>';

            $("#listLeyenda").html(htmlExistente + htmlAgregado);

            var htmlAgregadoPrint = '<li  style="display: -webkit-inline-box;"><div class="marcadorContent2" style="margin-top: 8px;margin-right: -3px;background-color: ' + values[1] + ' !important; ' + borde + ' -webkit-print-color-adjust: exact;"></div><span>&nbsp;&nbsp;' + valor + '</span></li><br>';
            $("#listLeyendaImpresion").html(htmlExistente2 + htmlAgregadoPrint);
        }



        //'<img width="13px" src="legend/descargar.png" width="10px"/> Edificios y casas': osmb,
        //        '<img width="13px" src="legend/EtiquetaComunidades_3.png" /> Etiqueta de las comunidades': layer_EtiquetaComunidades_3,

        var controlP = L.control.layers([], {
            '<img width="13px" src="legend/shapes.png" id="hola"/>  Comunidades': polligono_comunidades

        }, {
            collapsed: false
        }).addTo(map);




        var capasBase = L.control.layers({
            '<div onclick="setMapaBaseDefecto(\'1\')" class="controlPersonalizadoMbase"><img src="../../assets/img/legend-base/1.png" alt="mapaBase"><p>Google Hybrid</p></div>': baseLayers.SateliteToponimia,
            '<div onclick="setMapaBaseDefecto(\'2\')" class="controlPersonalizadoMbase"><img src="../../assets/img/legend-base/2.png" alt="mapaBase"><p>Google Satelite</p></div>': baseLayers.Satelite,
            '<div onclick="setMapaBaseDefecto(\'3\')" class="controlPersonalizadoMbase"><img src="../../assets/img/legend-base/3.png" alt="mapaBase"><p>Google Maps</p></div>': baseLayers.Google_maps,
            '<div onclick="setMapaBaseDefecto(\'4\')" class="controlPersonalizadoMbase"><img src="../../assets/img/legend-base/4.png" alt="mapaBase"><p>Carto Map</p></div>': baseLayers.CartoDB_DarkMatter,
            '<div onclick="setMapaBaseDefecto(\'5\')" class="controlPersonalizadoMbase"><img src="../../assets/img/legend-base/5.png" alt="mapaBase"><p>Open Street Map</p></div>': baseLayers.Osm,
            '<div onclick="setMapaBaseDefecto(\'6\')" class="controlPersonalizadoMbase"><img src="../../assets/img/legend-base/6.png" alt="mapaBase"><p>Thunder Cycle</p></div>': baseLayers.Thunderforest_cycle
        }, {}, {
            collapsed: false
        }).addTo(map);
        var htmlObjectBase = capasBase.getContainer();
        L.DomUtil.addClass(capasBase.getContainer(), 'control-baseLayers-la')
        var b = document.getElementById('control-baseLayers');

        // Call the getContainer routine.
        var htmlObject = controlP.getContainer();

        L.DomUtil.addClass(controlP.getContainer(), 'leyenda-perso')


        // Get the desired parent node.
        var a = document.getElementById('control-layer-gitcom');

        // Finally append that node to the new parent, recursively searching out and re-parenting nodes.
        function setParent(el, newParent) {
            newParent.appendChild(el);
        }
        setParent(htmlObject, a);
        setParent(htmlObjectBase, b);




        //       $('#hola').closest('label').hide()
    </script>
    <?php

    if (@$_SESSION['proyecto'] != '') {
        $capasSegunProyecto = $_SESSION['proyecto'];
        $queryShp = "SELECT * FROM shapes where proyecto='$capasSegunProyecto'";
        $searchShp = $conexion->query($queryShp);
        if ($searchShp->num_rows > 0) {
            while ($rowShp = $searchShp->fetch_assoc()) {
                $origen = $rowShp['origen'];
                $nombre = $rowShp['nombre'];
                $colorFill = $rowShp['colorFill'];
                $colorStroke = $rowShp['colorStroke'];
                $fillOpacity = $rowShp['fillOpacity'];

                echo "<script> cargarShp('" . $nombre . "', '" . $origen . "', '" . $colorFill . "', '" . $colorStroke . "', '" . $fillOpacity . "') </script>";
            }
        }
    }

    ?>


    <script>
        /* Consulta de las capas del mapa nps */


        //hexa a rgb
        function hexToRgb(hex) {
            var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
            return result ? {
                r: parseInt(result[1], 16),
                g: parseInt(result[2], 16),
                b: parseInt(result[3], 16)
            } : null;
        }


        if ("<?php echo $tipo ?>" == 3) {


            function npsStyle(color) {

                let colorRgb = hexToRgb(color);

                //hacer un color en hexadecimal un poco mas oscuro
                return {
                    pane: 'geoJsonAca',
                    radius: 4,
                    fillColor: color, // color de relleno
                    fillOpacity: 0.7, // transparencia de relleno
                    weight: 3, // grosor de l��nea
                    opacity: 1.0, // tansparencia de l��nea
                    color: 'rgba(' + colorRgb.r + ', ' + colorRgb.g + ', ' + colorRgb.b + ', 1)' // color de l��nea
                }
            }
            map.createPane('geoJsonAca');
            map.getPane('geoJsonAca').style.zIndex = 400;
            map.getPane('geoJsonAca').style['mix-blend-mode'] = 'normal';


            function potencialidadesMarkerOption() {
                return {
                    pane: 'geoJsonAcaP',
                    radius: 4,
                    fillColor: '#00bb20', // color de relleno
                    fillOpacity: 0.9, // transparencia de relleno
                    weight: 2, // grosor de l��nea
                    opacity: 1.0, // tansparencia de l��nea
                    color: 'rgba(255, 0, 0, .5)' // color de l��nea
                }
            }
            map.createPane('geoJsonAcaP');
            map.getPane('geoJsonAcaP').style.zIndex = 400;
            map.getPane('geoJsonAcaP').style['mix-blend-mode'] = 'normal';


            function solucionesMarkerOption() {
                return {
                    pane: 'geoJsonAcaS',
                    radius: 4,
                    fillColor: '#b71515', // color de relleno
                    fillOpacity: 0.9, // transparencia de relleno
                    weight: 2, // grosor de l��nea
                    opacity: 1.0, // tansparencia de l��nea
                    color: '#9c0909' // color de l��nea
                }
            }
            map.createPane('geoJsonAcaS');
            map.getPane('geoJsonAcaS').style.zIndex = 400;
            map.getPane('geoJsonAcaS').style['mix-blend-mode'] = 'normal';


            var capa1, capa2, capa3;

        }



        var proceso = "<?php echo @$_GET['proceso'] ?>";

        var get = {
            'concejo_comunal': 'Integrante del consejo comunal/concejo_comunal/inf_habitantes.concejo_comunal!=*NO* AND inf_habitantes.concejo_comunal!=*NO APLICA*',
            'raas': 'Integrante de la RAAS/raas/inf_habitantes.raas!=*NO* AND inf_habitantes.raas!=*NO APLICA*',
            'clap': 'Integrante del CLAP/clap/inf_habitantes.clap!=*NO* AND inf_habitantes.clap!=*NO APLICA*',
            'ubch': 'Integrante de la UBCH/ubch/inf_habitantes.ubch!=*NO* AND inf_habitantes.ubch!=*NO APLICA*',
            'milicia': 'Miliciano/milicia/inf_habitantes.milicia!=*NO*',
            'promotores_comunitarios': 'Promotor Comunitario/promotores_comunitarios/inf_habitantes.promotores_comunitarios=*SI*',
            'ffm': 'Frente Francisco de Miranda/ffm/inf_habitantes.ffm=*SI*',
            'msv': 'Brigadista de Somos Venezuela/msv/inf_habitantes.msv=*SI*',
            'robert_serra': 'Robert Serra/robert_serra/inf_habitantes.robert_serra=*SI*',
            'mesa_tecnica_telecomunicaciones': 'Mesa Tecnica de Telecomunicaciones/mesa_tecnica_telecomunicaciones/inf_habitantes.mesa_tecnica_telecomunicaciones=*SI*',
            'mesa_tecnica_agua': 'Mesa Tecnica de agua/mesa_tecnica_agua/inf_habitantes.mesa_tecnica_agua=*SI*',
            'sala_bnbt': 'Sala BNBT/sala_bnbt/inf_habitantes.sala_bnbt=*SI*'
        };

        var allDirectory = [
            'Integrante del consejo comunal/concejo_comunal/inf_habitantes.concejo_comunal!=*NO* AND inf_habitantes.concejo_comunal!=*NO APLICA*',
            'Integrante de la RAAS/raas/inf_habitantes.raas!=*NO* AND inf_habitantes.raas!=*NO APLICA*',
            'Integrante del CLAP/clap/inf_habitantes.clap!=*NO* AND inf_habitantes.clap!=*NO APLICA*',
            'Integrante de la UBCH/ubch/inf_habitantes.ubch!=*NO* AND inf_habitantes.ubch!=*NO APLICA*',
            'Miliciano/milicia/inf_habitantes.milicia!=*NO*',
            'Promotor Comunitario/promotores_comunitarios/inf_habitantes.promotores_comunitarios=*SI*',
            'Frente Francisco de Miranda/ffm/inf_habitantes.ffm=*SI*',
            'Brigadista de Somos Venezuela/msv/inf_habitantes.msv=*SI*',
            'Robert Serra/robert_serra/inf_habitantes.robert_serra=*SI*',
            'Mesa Tecnica de Telecomunicaciones/mesa_tecnica_telecomunicaciones/inf_habitantes.mesa_tecnica_telecomunicaciones=*SI*',
            'Mes#4EC5F1a Tecnica de agua/mesa_tecnica_agua/inf_habitantes.mesa_tecnica_agua=*SI*',
            'Sala BNBT/sala_bnbt/inf_habitantes.sala_bnbt=*SI*'
        ];

        var stylesDot = [
            '/#e03f48/#000000/solid/2',
            '/#0048ff/#ffffff/solid/2',
            '/#00ff61/#000000/solid/2',
            '/#ffa000/#000000/solid/2',
            '/#ff00c1/#ffffff/solid/2',
            '/#4500ff/#000000/solid/2',
            '/#1f7835/#ffffff/solid/2',
            '/#4EC5F1/#000000/solid/2',
            '/#f18e50/#000000/solid/2',
            '/#9863ca/#000000/solid/2',
            '/#01f4ab/#000000/solid/2',
            '/#017ef4/#000000/solid/2'
        ]


        if (proceso == 'directorio') {
            var param = "<?php echo @$_GET['param'] ?>";

            if (get[param]) {
                var valor = get[param].split('/');

                var cleanSearch = valor[2];


                while (cleanSearch.indexOf('*') != '-1') {
                    cleanSearch = cleanSearch.replace('*', '"');
                }

                obtener_puntos(cleanSearch, valor[0], 'personas', '10px/#e03f48/#000000/solid/2')
            }


        } else if (proceso == 'allDirectory') {
            var index = 0;


            allDirectory.forEach(value => {


                var result = value.split('/');



                var cleanSearch = result[2];
                while (cleanSearch.indexOf('*') != '-1') {
                    cleanSearch = cleanSearch.replace('*', '"');
                }
                obtener_puntos(cleanSearch, result[0], 'personas', '5px' + stylesDot[index])

                index++;

            });
        }

        function addItemLeyrnda(color, nombre, tipo) {
            //'+tipo+'
            let htmlExistente = $("#listLeyenda").html();
            let htmlExistentePrint = $("#listLeyendaImpresion").html();

            let htmlAgregado = '<li  style="margin-bottom: 10px; "> <div style="display: flex; "><div class="dot" style="background-color: ' + color + '"></div><span>&nbsp;&nbsp;' + nombre + '</span></div> <span style="margin-left: 23px;font-size: 12px;">' + tipo + '</span></li>';
            let htmlAgregadoPrint = '<li  style="display: -webkit-inline-box;"><div class="dot" style="background-color: ' + color + '"></div><span>&nbsp;&nbsp;' + nombre + '</span></li><br>';

            $("#listLeyenda").html(htmlExistente + htmlAgregado);
            $("#listLeyendaImpresion").html(htmlExistentePrint + htmlAgregadoPrint);

        }




        var sinLuz = L.layerGroup([]);
        var conLuz = L.layerGroup([]);

        var pruebas = L.icon({
            iconUrl: 'images/dot/dot_1.png',
            iconSize: [5, 5] // point of the icon which will correspond to marker's location
        });


        <?php
        if ($tipo == 3) {
            $var5 = 0;

            $query = "SELECT * FROM aca_mapa WHERE problema='$idProblema' AND geojson != '' ORDER BY tipo DESC";
            $search = $conexion->query($query);
            if ($search->num_rows > 0) {
                while ($row = $search->fetch_assoc()) {

                    $var5++;
                    $color = $row['color'];
                    $geojson = $row['geojson'];
                    $nombre = $row['detalle'];
                    $detalle = $row['detalle'];

                    $tipo23 = $row['tipo'];
                    if ($tipo23 == 'n') {
                        $tipoDato = '<small>Nudo critico</small>';
                    } elseif ($tipo23 == 'p') {
                        $tipoDato = '<small>Potencialidad</small>';
                    }


                    $nameFunction = 'function' . $var5;


                    $capa = "npsStyle(\"$color\")";




                    echo "var geoJSON = JSON.parse('$geojson');
                        

                                function " . $nameFunction . "(feature, layer) {
                                    var " . $nameFunction . " = '<div class=\"dot\" style=\"background-color: " . $color . "; height: 20px; float: left; margin-right: 10px;\"></div> <strong>" . $nombre . "</strong><br>" . $tipoDato . '<hr>' . str_replace(';', '<br>', $detalle) . "';
                                    layer.bindPopup(" . $nameFunction . ", {
                                        minWidth: 200
                                    });
                                }
                            
                            myLayer = L.geoJSON(geoJSON, {
                                pointToLayer: function(feature, latlng) {
                                    return L.circleMarker(latlng, {});
                                },
                                style: " . $capa . ",
                                attribution: '',
                                interactive: true,
                               onEachFeature: " . $nameFunction . "
                            
                            });";

                    echo 'addItemLeyrnda("' . $color . '", "' . $detalle . '", "' . $tipoDato . '");
                    

                    myLayer.addTo(map)
                    controlP.addOverlay(myLayer, "' . $nombre . '");

                    ';
                }
            }
        ?>


            function iconoPoste(img) {
                return L.icon({
                    iconUrl: 'images/postes/' + img + '.png',
                    iconSize: [100, 100], // size of the icon
                    iconAnchor: [50, 50] // point of the icon which will correspond to marker's location
                });
            }



            function midifcarAngulo(id) {
                $('#poste').val(id)
                mostrarOcultarVentanaModal('#icnosPostes')
            }

            function actualizarPoste() {
                let poste = $('#poste').val();
                var radiImg;

                if (document.getElementById('cl-0').checked) {
                    radiImg = '0'
                }
                if (document.getElementById('cl-1').checked) {
                    radiImg = '1'
                }
                if (document.getElementById('cl-2').checked) {
                    radiImg = '2'
                }
                if (document.getElementById('cl-3').checked) {
                    radiImg = '3'
                }
                if (document.getElementById('cl-4').checked) {
                    radiImg = '4'
                }
                if (document.getElementById('cl-5').checked) {
                    radiImg = '5'
                }
                if (document.getElementById('cl-6').checked) {
                    radiImg = '6'
                }
                if (document.getElementById('cl-7').checked) {
                    radiImg = '7'
                }
                if (document.getElementById('cl-8').checked) {
                    radiImg = '8'
                }
                if (document.getElementById('cl-9').checked) {
                    radiImg = '9'
                }
                if (document.getElementById('cl-10').checked) {
                    radiImg = '0'
                }
                if (document.getElementById('cl-11').checked) {
                    radiImg = '1'
                }

                $.ajax({
                        url: 'mapsWrech/actualizarAnguloPoste.php',
                        type: 'POST',
                        dataType: 'html',
                        data: {
                            poste: poste,
                            radiImg: radiImg
                        },
                    })
                    .done(function(rePol) {

                        var result = rePol.trim().split('*')

                        var src = result[0];
                        var ltd = result[1];
                        var lng = result[2];
                        var capa = result[3];

                        map.eachLayer(function(marker) {
                            var markerId = marker.options.id;

                            if (marker.options) {
                                if (markerId == poste) {
                                    map.removeLayer(marker);
                                }
                            }
                        })

                        L.marker([ltd, lng], {
                            icon: iconoPoste(src),
                            id: poste
                        }).bindPopup(capa + '<br>Id: P-' + poste + '<br> <a onclick="midifcarAngulo(\'' + poste + '\')">Modificar icono</a>').addTo(map);

                        cerrarModal()

                    })


            }



        <?php
            $aka = $_GET['idProblema'];
            $query2E = "SELECT * FROM postes WHERE aca='$aka' ";
            $search2E = $conexion->query($query2E);
            if ($search2E->num_rows > 0) {
                while ($row2E = $search2E->fetch_assoc()) {

                    $EndltdForm = $row2E['ltd'];
                    $EndlngForm = $row2E['lng'];
                    $id = $row2E['id'];
                    $capa = $row2E['capa'];



                    if ($row2E['status'] == 1) {
                        $src = 'cl/' . $row2E['rotate'] . '-cl';
                    } else {
                        $src = 'sl/' . $row2E['rotate'] . '-sl';
                    }

                    echo "var icon = L.marker([$EndltdForm, $EndlngForm], {
                            icon: iconoPoste('" . $src . "'),
                            id: '" . $id . "'
                        }).bindPopup('" . $capa . "<br>Id: P-" . $id . "<br> <a onclick=\"midifcarAngulo(\'" . $id . "\')\">Modificar icono</a>');" . PHP_EOL;






                    if ($row2E['status'] == 1) {
                        echo "conLuz.addLayer(icon);" . PHP_EOL;
                        $sinLuz += 1;
                    } else {
                        echo "sinLuz.addLayer(icon);" . PHP_EOL;
                        $conLuz += 1;
                    }
                }
                echo "
                controlP.addOverlay(sinLuz, 'Luminarias fuera de funcionamiento (" . $sinLuz . ")');
                controlP.addOverlay(conLuz, 'Luminarias en funcionamiento (" . $conLuz . ")');
        
        
                ";
            }
        }

        ?>

        var i = 0;

        $(document).ready(function() {
            $("#mcp").change(function() {
                $.get("../consultasAjax/selec_continente.php", "municipio_id=" + $("#mcp").val(), function(data) {
                    $("#paq").html(data);
                });
            });

            $("#paq").change(function() {
                $.get("../consultasAjax/selec_paises.php", "continente_id=" + $("#paq").val(), function(data) {
                    $("#cma").html(data);
                });
            });

            $("#cma").change(function() {
                $.get("../consultasAjax/selec_ciudades.php", "pais_id=" + $("#cma").val(), function(data) {
                    $("#cmia").html(data);
                });
            });
        });

        function showModal(origin) {
            switch (origin) {
                case "areasDeInteres":
                    areasDeInteresMdal();
                    break;
            }
        }

        function areasDeInteresMdal() {

            $("#empezarRegistrosAreasI").hide()
            $("#finalizarRegistrosAreasI").show()

            $("#camposSombra").hide(500, 'swing')
            drawnItems.clearLayers();
            $("#boxRefer").hide(500, "swing");

            sessionStorage.setItem("modoRegistro", 'areaDeInteres');

            $("#poligonosCampos").hide();
            $("#nuevaCapaCampos").hide();
            $("#pointAtPos").hide();
            beforRegistroAerasInteres(null)
            $("#areasDe").show(500, "swing");

        }

        /*===================================================
                                AREAS DE INTERES         
               ===================================================*/


        var areasInteres = [
            ['1', 'IGLESIAS CATOLICAS', 'especial'],
            ['2', 'IGLESIAS EVANGELICAS', 'especial'],
            ['3', 'TEMPLOS DE TESTIGOS DE JEHOVA', 'especial'],
            ['4', 'TEMPLOS MORMONES', 'especial'],
            ['5', 'TEMPLOS MASONES', 'especial'],
            ['6', 'MEZQUITAS', 'especial'],
            ['7', 'CANCHAS DE USO MULTIPLE', 'especial'],
            ['8', 'CANCHAS DE FUTBOL', 'especial'],
            ['9', 'CAMPOS DE BEISBOL', 'especial'],
            ['10', 'GIMNASIOS', 'especial'],
            ['11', 'POLIDEPORTIVO', 'especial'],
            ['12', 'CONSULTORIOS POPULARES', 'especial'],
            ['13', 'HOSPITALES', 'especial'],
            ['14', 'AMBULARORIOS', 'especial'],
            ['15', 'CDI', 'especial'],
            ['16', 'SRI', 'especial'],
            ['17', 'CONSULTORIOS ODONTOLOGICO', 'especial'],
            ['18', 'LABORATORIOS', 'especial'],
            ['19', 'CLINICAS PRIVADAS', 'especial'],
            ['20', 'CENTROS DE MATERNIDAD', 'especial'],
            ['21', 'SERVICIOS DE IMAGENOLOGIA [ECOS]', 'especial'],
            ['22', 'CENTROS DE ALTA TECNOLOGIA [CAT]', 'especial'],
            ['23', 'SIMONCITOS', 'especial'],
            ['24', 'ESCUELAS BASICAS PUBLICAS', 'especial'],
            ['25', 'ESCUELAS BASICAS PRIVADAS', 'especial'],
            ['26', 'ESCUELAS BASICAS SUVENCIONADAS', 'especial'],
            ['27', 'MISION ROBINSON', 'especial'],
            ['28', 'ESCUELAS TECNICAS', 'especial'],
            ['29', 'UNIDADES EDUCATIVAS  PUBLICAS', 'especial'],
            ['30', 'UNIDADES EDUCATIVAS  PRIVADAS', 'especial'],
            ['31', 'UNIDADES EDUCATIVAS  SUVENCIONADAS', 'especial'],
            ['32', 'LICEOS BOLIVARIANOS', 'especial'],
            ['33', 'MISION RIBAS', 'especial'],
            ['34', 'UNIVERSIDADES CONVENCIONALES', 'especial'],
            ['35', 'ALDEAS UNIVERSITARIAS [MISION SUCRE]', 'especial'],
            ['36', 'AMBIENTES DE MISIONES EDUCATIVAS ', 'especial'],
            ['37', 'ACADEMIAS', 'especial'],
            ['38', 'NICHOS LINGUISTICOS', 'especial'],
            ['39', 'BIBLIOTECAS', 'especial'],
            ['40', 'INSTITUCIONES PUBLICAS', 'especial'],
            ['41', 'BASES DE MISIONES', 'especial'],
            ['42', 'CASAS DE ALIMENTACION', 'especial'],
            ['43', 'PERSONAS ATENDIDAS POR LA CASA DE ALIMENTACION', 'especial'],
            ['44', 'CASA COMUNAL', 'especial'],
            ['45', 'CASA CULTURAL', 'especial'],
            ['46', 'MERCALITOS', 'especial'],
            ['47', 'PDVAL', 'especial'],
            ['48', 'PLAZAS', 'especial'],
            ['49', 'PARQUES', 'especial'],
            ['50', 'BOULEVAR', 'especial'],
            ['51', 'ACADEMIAS DE DANZAS', 'especial'],
            ['53', 'ESCUELAS DE MUSICA Y CANTO', 'especial'],
            ['54', 'ESCUELAS DE TEATRO O ANFITEATROS', 'especial'],
            ['55', 'SALONES DE ENSAYO', 'especial'],
            ['56', 'ZONAS ARQUEOLOGICAS', 'especial'],
            ['57', 'PETROGLIFOS', 'especial'],
            ['58', 'LUGARES SAGRADOS', 'especial'],
            ['59', 'LUGARES DE PESCA', 'especial'],
            ['60', 'TALLERES DE ARTE O ARTESANIA', 'especial'],
            ['61', 'LUGARES DE CAZA', 'especial'],
            ['62', 'CASAS O SITIOS DE CONSULTAS ESPIRITUALES', 'especial'],
            ['63', 'ESTACIONES DE RADIO', 'especial'],
            ['64', 'TELEVISORAS', 'especial'],
            ['65', 'SALAS DE LECTURA', 'especial'],
            ['66', 'CEMENTERIOS', 'especial'],
            ['67', 'CENTROS COMERCIALES', 'especial'],
            ['68', 'CONFITERIAS', 'especial'],
            ['69', 'FLORISTERIAS', 'especial'],
            ['70', 'PERFUMERIAS', 'especial'],
            ['71', 'HERRERIAS', 'especial'],
            ['72', 'AGENCIAS DE LOTERIAS', 'especial'],
            ['73', 'ELECTROAUTOS', 'especial'],
            ['74', 'BANCOS', 'especial'],
            ['75', 'CARPINTERIAS', 'especial'],
            ['76', 'PASTELERIAS Y PANADERIAS', 'especial'],
            ['77', 'CRISTALERIAS', 'especial'],
            ['78', 'CAUCHERAS', 'especial'],
            ['79', 'VENTA DE ELECTRODOMESTICOS', 'especial'],
            ['80', 'LAVANDERIAS Y TINTORERIAS', 'especial'],
            ['81', 'ALINEACION Y BALANCEO', 'especial'],
            ['82', 'JUGUETERIAS', 'especial'],
            ['83', 'VENTAS DE VIVERES', 'especial'],
            ['84', 'ZAPATERIAS', 'especial'],
            ['85', 'TALLERES DE LATONERIA Y PINTURA', 'especial'],
            ['86', 'CENTROS DE CONEXION A INTERNET', 'especial'],
            ['87', 'FARMACIAS', 'especial'],
            ['88', 'RESTAURANTES', 'especial'],
            ['89', 'BODEGAS CON EXPENDIO DE LICORES', 'especial'],
            ['90', 'LICORERIAS', 'especial'],
            ['91', 'BARES', 'especial'],
            ['92', 'CARNICERIAS', 'especial'],
            ['93', 'FRUTERIAS', 'especial'],
            ['94', 'COMERCIOS MEDIANOS', 'especial'],
            ['95', 'COMERCIOS GRANDES', 'especial'],
            ['96', 'FUNERARIAS', 'especial'],
            ['97', 'BOMBAS DE GASOLINA', 'especial'],
            ['98', 'MERCADOS ', 'especial'],
            ['99', 'SALAS DE MATANZAS O BOTALON', 'especial'],
            ['100', 'BODEGAS', 'especial'],
            ['101', 'HOTELES', 'especial'],
            ['102', 'RESIDENCIAS', 'especial'],
            ['103', 'MOTELES', 'especial'],
            ['104', 'PROSTIBULOS', 'especial'],
            ['105', 'BARBERIAS', 'especial'],
            ['106', 'SALONES DE ESTETICA', 'especial'],
            ['107', 'PELUQUERIAS', 'especial'],
            ['108', 'ESTACIONAMIENTOS', 'especial'],
            ['109', 'REPARACION DE ELECTRODOMESTICOS', 'especial'],
            ['110', 'TALLER DE SOLDADURA', 'especial'],
            ['111', 'EMPRESA SDE PROPIEDAD DIRECTA COMUNAL ', 'especial'],
            ['112', 'EMPRESAS DE PROPIEDAD INDIRECTA COMUNAL ', 'especial'],
            ['113', 'UNIDADES DE PRODUCCION FAMILIAR', 'especial'],
            ['114', 'COOPERATIVAS', 'especial'],
            ['115', 'TALLERES MECANICOS', 'especial'],
            ['116', 'QUEBRADAS', 'especial'],
            ['117', 'RIOS', 'especial'],
            ['118', 'CA&Ntilde;OS', 'especial'],
            ['119', 'LAGUNAS', 'especial'],
            ['120', 'BOSQUES', 'especial'],
            ['121', 'TANQUES DE AGUA COMUNAL', 'especial']
        ]

        function beforRegistroAerasInteres(accion) {

            var numeroActual = parseInt($("#idArray").val())

            if (accion == null) {
                var numero = 0;
            } else if (accion == 'suma') {
                if (numeroActual < 119) {
                    var numero = numeroActual + 1;
                } else {
                    numero = 119;
                }
            } else {
                if (numeroActual != 0) {
                    var numero = numeroActual - 1;
                } else {
                    numero = 0;
                }

            }

            $("#idArray").val(numero)
            $("#codigoAreaInput").val(areasInteres[numero][0])
            $("#nombreAreaInput").val(areasInteres[numero][1])
            $("#nameArea").html(areasInteres[numero][1])

        }


        function obtener_registros(data, referencia, url, origen) {

            if (origen != 'casas') {
                var ida = referencia.split('/');

                if (ida[0] == 7 || ida[0] == 8) {

                    $("#nuevaCanchaDiv").show();

                    sessionStorage['data'] = data;
                    sessionStorage['referencia'] = referencia;
                    sessionStorage['origen'] = origen;

                    document.getElementById("modal1").classList.add('is-visible');

                    return;
                }
            }

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'html',
                data: {
                    data: data,
                    referencia: referencia
                },
            }).done(function(resultado) {
                $("#tabla_resultado").html(resultado);

                var norte = $("#norte").val();
                var este = $("#este").val();

                if (origen == 'casas') {

                    var codigo = $("#codigo").val();
                    var cedula = $("#referencia").val()
                    var id = $("#id").val()

                    var datos = "<strong>Responsable: </strong> " + cedula + " <br><strong>Codigo: </strong>" + codigo + "<br><a class=\"aVerDetallesPopup\" >Ver habitantes</a><br><a class='aMover' onclick='editarDatos(\"" + codigo + "\", \"casas\",\"" + id + "\",\"" + cedula + "\", " + este + ", " + norte + ")'>Convertir en objeto editable</a>";

                    var point = L.marker([norte, este], {
                        icon: blueMarker,
                        id: id,
                        resp: cedula,
                        este: este,
                        norte: norte
                    }).bindPopup(datos);

                    $("#referencia").val('');
                    $("#convert").hide(500, "swing");
                    casas.addLayer(point);
                } else {

                    var datos = referencia.split('/');
                    var point = L.marker([norte, este], {
                        icon: iconAreas,
                        este: este,
                        norte: norte
                    }).bindPopup(datos[1]);


                    areasDeInteres.addLayer(point);
                }

                drawnItems.clearLayers();
            })
        }

        function guardarCancha() {

            if ($('#techo').val() == '' ||
                $('#iluminada').val() == '' ||
                $('#pintura').val() == '' ||
                $('#piso').val() == '') {
                toast("error", "Rellene todos los campos");
                return;
            }


            var techo = $('#techo').val();
            var iluminada = $('#iluminada').val();
            var pintura = $('#pintura').val();
            var piso = $('#piso').val();

            var data = sessionStorage['data'];
            var referencia = sessionStorage['referencia'];


            $.ajax({
                    url: 'guardarAreasDeInteres.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        data: data,
                        referencia: referencia,
                        piso: piso,
                        pintura: pintura,
                        iluminada: iluminada,
                        techo: techo
                    },
                })


                .done(function(rePol) {
                    document.querySelector(".modal.is-visible").classList.remove('is-visible');


                    $("#tabla_resultado").html(rePol);

                    var norte = $("#norte").val();
                    var este = $("#este").val();

                    var datos = referencia.split('/');
                    var point = L.marker([norte, este], {
                        icon: iconAreas,
                        este: este,
                        norte: norte
                    }).bindPopup(datos[1]);


                    areasDeInteres.addLayer(point);


                    drawnItems.clearLayers();
                })
        }


        function deleteRegistros(idStorage) {
            $.ajax({
                    url: '../../configuracion/eliminarCasa.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        id: idStorage
                    },
                })
                .done(function(resultadoEliminar) {
                    $("#editando").hide(500, "swing");
                    $("#tabla_resultado").html(resultadoEliminar);

                })
        }


        function iconPersonalizadoFunction(colorRelleno, opacidadRelleno, grosorBorde, colorBorde, linea, ciTamano) {

            if (linea == 'none') {
                grosorBorde = 0;
            }

            var radius = parseInt(ciTamano);

            return {
                radius: radius,
                fillColor: colorRelleno, // color de relleno
                fillOpacity: 1, // transparencia de relleno
                weight: grosorBorde, // grosor de l��nea
                color: colorBorde // color de l��nea

            }
        }

        function obtener_puntos(consulta, nombreCapa, tipo, perso) {
            console.log(perso)
            var resultado = consulta;
            var final = '';
            var prefijo;
            if (tipo == 'casas') {
                prefijo = 'inf_casas'
            } else {
                prefijo = 'inf_habitantes'
            }

            if ($("#mcp").val() != '' && $("#paq").val() != '' && $("#cma").val() != '' && $("#cmia").val() != '') {

                if (resultado.indexOf(' OR ') != '-1') {
                    var preEnd = resultado.split(' OR ');
                    preEnd.forEach(element => {
                        final = final + element + " " + ' AND ' + prefijo + '.id_c_comunal="' + $("#cmia").val() + '" OR ';
                    });
                    final = final.substring(0, final.length - 4);
                } else {
                    final = resultado + ' AND ' + prefijo + '.id_c_comunal="' + $("#cmia").val() + '"';
                }

            } else if ($("#mcp").val() != '' && $("#paq").val() != '' && $("#cma").val() != '') {

                if (resultado.indexOf(' OR ') != '-1') {
                    var preEnd = resultado.split(' OR ');
                    preEnd.forEach(element => {
                        final = final + element + " " + ' AND ' + prefijo + '.id_comuna="' + $("#cma").val() + '" OR ';
                    });
                    final = final.substring(0, final.length - 4);
                } else {
                    final = resultado + ' AND ' + prefijo + '.id_comuna="' + $("#cma").val() + '"';
                }

            } else if ($("#mcp").val() != '' && $("#paq").val()) {

                if (resultado.indexOf(' OR ') != '-1') {
                    var preEnd = resultado.split(' OR ');
                    preEnd.forEach(element => {
                        final = final + element + " " + ' AND ' + prefijo + '.id_parroquia="' + $("#paq").val() + '" OR ';
                    });
                    final = final.substring(0, final.length - 4);
                } else {
                    final = resultado + ' AND ' + prefijo + '.id_parroquia="' + $("#paq").val() + '"';
                }

            } else if ($("#mcp").val() != '') {

                if (resultado.indexOf(' OR ') != '-1') {
                    var preEnd = resultado.split(' OR ');
                    preEnd.forEach(element => {
                        final = final + element + " " + ' AND ' + prefijo + '.id_municipio="' + $("#mcp").val() + '" OR ';
                    });
                    final = final.substring(0, final.length - 4);
                } else {
                    final = resultado + ' AND ' + prefijo + '.id_municipio="' + $("#mcp").val() + '"';
                }

            } else {
                final = resultado;
            }

            consulta = final;
            console.log(consulta)


            var explode = perso.split('/');

            var ciTamano = explode[0];
            var ciRellenoColor = explode[1];
            var ciLineaColor = explode[2];
            var ciEstiloLinea = explode[3];
            var ciAnchoLinea = explode[4];


            var iconPersonalizado = iconPersonalizadoFunction(ciRellenoColor, '1', ciAnchoLinea, ciLineaColor, ciEstiloLinea, ciTamano);

            if ($("#nombreCapaLeyenda").val() != '') {
                var nombreCapa = $("#nombreCapaLeyenda").val();
            }
            $("#consultaPersInput").val('');
            $("#nombreCapaLeyenda").val('');


            $.ajax({
                    url: 'consulta.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        consulta: consulta,
                        tipo: tipo,
                    },
                })


                .done(function(rePolAt) {
                    $("#cargandoConsulta").addClass('oculto')
                    // Ejemplo de uso

                    var newPoligono = rePolAt.split('/')


                    if (newPoligono[1] == '0') {
                        toast("error", "No se encontraron coincidecias");
                    } else {


                        var polygono = newPoligono[0].substring(0, newPoligono[0].length - 2);


                        const geoJsonPreEnd = '{"type": "FeatureCollection","name": "example","crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:EPSG::32619" } },"features": [' + polygono + ']}';

                        console.log(polygono)

                        const myObjStr1 = JSON.parse(geoJsonPreEnd);

                        var geoJSON = myObjStr1;
                        var featureGroup = L.featureGroup();
                        featureGroup.clearLayers();

                        myLayer = L.geoJSON(geoJSON, {
                            pointToLayer: function(feature, latlng) {
                                return L.circleMarker(latlng, {}, ).bindPopup("Tipo: " + feature.properties.tipo + "<br>Consulta: " + nombreCapa + "<br>Codigo: " + feature.properties.codigo + "<hr>" + feature.properties.personas + "<br><a class=\"aVerDetallesPopup\" target=\"_blank\" href='../detallesNuevoMapa.php?id=" + feature.properties.codigo + "'><i class='fa fa-home'></i> Ver informacion de la vivienda<a>");
                            },
                            style: iconPersonalizado,

                        });

                        featureGroup.addLayer(myLayer);

                        var cleanSearch = consulta;

                        while (cleanSearch.indexOf('"') != '-1') {
                            cleanSearch = cleanSearch.replace('"', '*');
                        }


                        featureGroup.addTo(map);


                        controlP.addOverlay(featureGroup, '<span class="admLayers"><img width="15px" src="../../assets/img/capaGitcom.png"/>  ' + nombreCapa + " </span>(" + newPoligono[1] + ")");

                        toast("success", "Se agrego una nueva capa");


                        if ("<?php echo $_SESSION['nivel'] ?>" == 3) {
                            map.fitBounds(featureGroup.getBounds());
                        }



                        var htmlExistente = $('#elementosGrafico').html();
                        var nuevoHtml = '<li><a style="cursor: pointer; color: #d34f57" onclick="addDataChart(\'' + nombreCapa + '\', \'' + newPoligono[1] + '\')">Agregar: ' + nombreCapa + '</a></li>';

                        $('#elementosGrafico').html(htmlExistente + nuevoHtml);


                        var tipoC = '';

                        if (tipo == 'persona') {
                            tipoC = 'personas';
                        } else {
                            tipoC = 'casas';
                        }

                        var newConsulta = cleanSearch.replace("'", '*');

                        while (newConsulta.indexOf("'") != -1) {
                            newConsulta = newConsulta.replace("'", '*');
                        }

                        agregarElemento(nombreCapa + ' - ' + newPoligono[1], perso, 'ondblclick="propiedades(\'' + nombreCapa + '\', \'' + newConsulta + '\', \'' + tipoC + '\')"');
                    }

                    $("#consultaSearch").val('');
                    $('#siguienteForCapaGitcom').toggle(300)
                    $('#cancelarVista').toggle(300)
                    $('#btnConsultaPerso').toggle(300)

                    $('#consultaDiv').toggle(350)
                    $('#consultaMarcadorDiv').toggle(300)

                })
        }


        //  const centro = calcularCentroCoordenadas(coordenadas);
        /** CENTRAR MAPA */






        /** CENTRAR MAPA */
        function calcularCentroCoordenadas(coordenadas) {
            if (coordenadas.length === 0) {
                return null; // Retorna null si no hay coordenadas
            }

            let sumLon = 0,
                sumLat = 0;

            coordenadas.forEach(coord => {
                sumLon += coord[0]; // Longitud
                sumLat += coord[1]; // Latitud
            });

            let centroLon = sumLon / coordenadas.length;
            let centroLat = sumLat / coordenadas.length;

            return [centroLat, centroLon]; // Leaflet usa formato [lat, lon]
        }




























        // aquiiii
        function obtener_puntos_almacenados(consulta, nombreCapa, tipo, perso) {
            var resultado = consulta;
            var consulta = resultado;

            var explode = perso.split('/');
            var ciTamano = explode[0];
            var ciRellenoColor = explode[1];
            var ciLineaColor = explode[2];
            var ciEstiloLinea = explode[3];
            var ciAnchoLinea = explode[4];

            var iconPersonalizado = iconPersonalizadoFunction(ciRellenoColor, '1', ciAnchoLinea, ciLineaColor, ciEstiloLinea, ciTamano);

            $.ajax({
                    url: 'consulta.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        consulta: consulta,
                        tipo: tipo,
                    },
                })
                .done(function(rePolAt) {

                    $("#cargandoConsulta").addClass('oculto')

                    var newPoligono = rePolAt.split('/')


                    if (newPoligono[1] == '0') {
                        toast("error", "No se encontraron coincidecias");

                    } else {


                        var polygono = newPoligono[0].substring(0, newPoligono[0].length - 2);


                        const geoJsonPreEnd = '{"type": "FeatureCollection","name": "example","crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:EPSG::32619" } },"features": [' + polygono + ']}';


                        const myObjStr1 = JSON.parse(geoJsonPreEnd);

                        var geoJSON = myObjStr1;
                        var featureGroup = L.featureGroup();
                        featureGroup.clearLayers();

                        myLayer = L.geoJSON(geoJSON, {
                            pointToLayer: function(feature, latlng) {
                                return L.circleMarker(latlng, {}, ).bindPopup("Tipo: " + feature.properties.tipo + "<br>Consulta: " + nombreCapa + "<br>Codigo: " + feature.properties.codigo + "<hr>" + feature.properties.personas + "<br><a class=\"aVerDetallesPopup\" target=\"_blank\" href='../detallesNuevoMapa.php?id=" + feature.properties.codigo + "'><i class='fa fa-home'></i> Ver informacion de la vivienda<a>");
                            },
                            style: iconPersonalizado,

                        });

                        featureGroup.addLayer(myLayer);

                        var cleanSearch = consulta;

                        while (cleanSearch.indexOf('"') != '-1') {
                            cleanSearch = cleanSearch.replace('"', '*');
                        }


                        featureGroup.addTo(map);


                        controlP.addOverlay(featureGroup, '<span class="admLayers"><img width="15px" src="../../assets/img/capaGitcom.png"/>  ' + nombreCapa + " </span>(" + newPoligono[1] + ")");

                        toast("success", "Se agrego una nueva capa");


                        var htmlExistente = $('#elementosGrafico').html();
                        var nuevoHtml = '<li><a style="cursor: pointer; color: #d34f57" onclick="addDataChart(\'' + nombreCapa + '\', \'' + newPoligono[1] + '\')">Agregar: ' + nombreCapa + '</a></li>';

                        $('#elementosGrafico').html(htmlExistente + nuevoHtml);


                        var tipoC = '';

                        if (tipo == 'persona') {
                            tipoC = 'personas';
                        } else {
                            tipoC = 'casas';
                        }

                        var newConsulta = cleanSearch.replace("'", '*');

                        while (newConsulta.indexOf("'") != -1) {
                            newConsulta = newConsulta.replace("'", '*');
                        }


                        agregarElemento(nombreCapa + ' - ' + newPoligono[1], perso, 'ondblclick="propiedades(\'' + nombreCapa + '\', \'' + newConsulta + '\', \'' + tipoC + '\')"');


                        if (counterText != 0) {
                            var counterText = parseInt($('#loaderCounterValue').val());
                            var newValue = counterText - 1;
                            $('#loaderCounterValue').val(newValue)
                            $('#loaderCounterText').html(newValue)

                            if (newValue == 0 || newValue < 0) {
                                $('#map').removeClass('blur')
                                $('.classresumen').removeClass('blur')
                                $('.marcaGitcom').removeClass('blur')
                                $('#loaderCounter').hide()
                            }
                        }
                    }
                })
        }


        function printEnd() {
            $('#botonImpresion').hide();
            window.print()

            printMapEnd()
        }

        function printMapEnd() {

            if ("<?php echo $tipo ?>" == "3") {
                $('#verDetalesACA').show();
                $('#DetalesACA').show();
            }


            $('#botonImpresion').hide();
            $('#contentMap').removeClass('masPeque');
            $('#map').removeClass('relative');
            $('#LeyendaImprimida').addClass('hide');
            $('#headerImprimir').addClass('hide');
            $('.autor').addClass('hide');
            $('.norte').addClass('hide');


            $('.leaflet-control-container').show();
            $('.classresumen').show();
            $('.marcaGitcom').show();
            $('#leyendaMapa').removeClass('hide');


        }

        function ocultarNotificacion() {
            $('#notificacionBox').addClass('fadeOutRight')
            setTimeout(function() {
                $('#notificacionBox').hide()
                $('#notificacionBox').removeClass('fadeOutRight')
            }, 1200);
        }


        function toggleCusmtomMarker() {
            $('#customMarkerLink').toggle(300)
            $('#chevronRight').toggle()
            $('#chevronDown').toggle()
        }

        function toggleCusmtomMarkerContent() {
            $('#iconosPredeterminados').toggle(300)
            $('#iconoPersonalizado').toggle(300)
        }


        function VerDetallesFun() {
            $("#DetalesACA").addClass('DetallesVisible')
            $("#DetalesACA").removeClass('DetallesOculto')
            $("#verDetalesACA").addClass('hide')
        }

        function cerrarDetallesAca() {
            $("#DetalesACA").addClass('DetallesOculto')
            $("#DetalesACA").removeClass('DetallesVisible')
            $("#verDetalesACA").removeClass('hide')
        }

        function mostrarIconosPersonalizados() {
            $('#iconosEstandar').toggle(300)
            $('#iconosPersonalizados').toggle(300)

        }

        function cerrarIconosPersonalizados() {
            $('#iconosEstandar').toggle(300)
            $('#iconosPersonalizados').toggle(300)
        }

        function iconoPersonalizadoCi(valor1, valor2, valor3) {

            var ciTamano, ciRellenoColor, ciLineaColor, ciEstiloLinea, ciAnchoLinea;

            if (valor1 != null && valor2 != null && valor3 != null) {

                ciTamano = 10;
                ciRellenoColor = valor1;
                ciLineaColor = valor2;
                ciEstiloLinea = 'solid';
                ciAnchoLinea = 2;

                $('.center22').removeClass('center22Cambio')
                $('#id' + valor3).addClass('center22Cambio')

                $("#ciRellenoColor").val(valor1);
                $("#ciLineaColor").val(valor2);

            } else {
                ciTamano = $("#ciTamano").val() + 'px';
                ciRellenoColor = $("#ciRellenoColor").val();
                ciLineaColor = $("#ciLineaColor").val();
                ciEstiloLinea = $("#ciEstiloLinea").val();
                ciAnchoLinea = $("#ciAnchoLinea").val();
                $('.center22').removeClass('center22Cambio')
            }


            var marcadorContent = document.getElementById('marcadorContent1');
            var marcadorContent2 = document.getElementById('marcadorContent2');
            var marcadorContent3 = document.getElementById('marcadorContent3');
            marcadorContent.style.background = ciRellenoColor;
            marcadorContent2.style.background = ciRellenoColor;
            marcadorContent3.style.background = ciRellenoColor;

            marcadorContent.style.border = ciAnchoLinea + 'px ' + ciEstiloLinea + ' ' + ciLineaColor;

            var anchoPequenos = ciAnchoLinea / 2;
            marcadorContent2.style.border = anchoPequenos + 'px ' + ciEstiloLinea + ' ' + ciLineaColor;
            marcadorContent3.style.border = anchoPequenos + 'px ' + ciEstiloLinea + ' ' + ciLineaColor;

        }

        function pantallaMarcadores(param) {

            var valor = $("#consultaPersInput").val()
            var valor2 = $("#nombreCapaLeyenda").val()

            if (valor == '' && param != 'omite' || valor2 == '' && param != 'omite') {
                toast("error", "Antes de continuar, rellene todos los campos");

            } else {


                if (buscarConsulta($("#consultaPersInput").val().split(':')[0]) != undefined) {
                    if ($("#consultaPersInput").val().trim() == 'rango de edad:') {
                        toast("error", "Faltan datos. Ejemplo: <strong>rango de edad:15-20</strong>");

                    } else {

                        $('#siguienteForCapaGitcom').toggle(300)
                        $('#cancelarVista').toggle(300)
                        $('#btnConsultaPerso').toggle(300)
                        $('#consultaDiv').toggle(350)
                        $('#consultaMarcadorDiv').toggle(300)
                    }
                } else {
                    toast("error", "No se reconce la consulta");

                }

            }
        }

        function actualizarRegistros(drawJson, id_vivienda, lastOrigen, lastData, lastId) {
            $.ajax({
                    url: '../../configuracion/moverCasa.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        drawJson: drawJson,
                        id_vivienda: id_vivienda,
                        lastOrigen: lastOrigen,
                        lastData: lastData
                    },
                })
                .done(function(resultadoEdit) {

                    $("#editando").hide(500, "swing");
                    $("#resultadoEdit").html(resultadoEdit);


                    var este = $("#campOeste").val()
                    var norte = $("#campOnorte").val()

                    switch (lastOrigen) {

                        case 'casas':
                            var registrarDatos = "<a  class='aVerDetallesPopup'  href='../datosCasa.php?casa=" + lastId + "'><i class='line icon-link'></i> Registrar datos</a><br>";
                            lastIcon = blueMarker;
                            break;



                        case 'casasPeople':
                            var registrarDatos = "";
                            lastIcon = redMarker;
                            break;

                    }

                    drawnItems.clearLayers();

                    var point = L.marker([norte, este], {
                        icon: lastIcon,
                        id: lastId,
                        resp: lastData,
                        este: este,
                        norte: norte
                    }).bindPopup("<strong>Responsable: </strong> " + lastData + "<br><strong>Codigo: </strong> " + id_vivienda + "<hr><a class=\"aVerDetallesPopup\" >Ver habitantes</a><br><small>Nota*:</small>Recargue la pagina para ver<hr>" + registrarDatos + "<a  target=\"_blank\" class='aVerDetallesPopup' href='detallesCasa.php?id=" + lastId + "'><i class='line icon-link'></i> Ver informacion</a><br><a class='aMover' onclick='editarDatos(\"" + id_vivienda + "\", \"" + lastOrigen + "\",\"" + lastId + "\",\"" + lastData + "\", " + este + ", " + norte + ")'><i class='line icon-note'></i> Convertir en objeto editable</a>");



                    switch (lastOrigen) {

                        case 'casasPeople':
                            casasPeople.addLayer(point);
                            break;

                        case 'casas':
                            casas.addLayer(point);

                            break;
                    }

                })
        }
    </script>
</body>

</html>
<script>
    $(document).ready(function() {
        function actualizarLink() {
            var valor = $("#referencia").val()
            if (valor != "") {
                $("#convert").show(500, "swing");

            } else {
                $("#convert").hide(500, "swing");
            }
        }
        $("#referencia").keyup(actualizarLink);

    });

    $(document).ready(function() {

        function realizarConsultaPersonalizada() {

            var valor = $("#consultaPersInput").val()
            var ciTamano = $("#ciTamano").val();
            var ciRellenoColor = $("#ciRellenoColor").val();
            var ciLineaColor = $("#ciLineaColor").val();
            var ciEstiloLinea = $("#ciEstiloLinea").val();
            var ciAnchoLinea = $("#ciAnchoLinea").val();

            var index = ciTamano + '/' + ciRellenoColor + '/' + ciLineaColor + '/' + ciEstiloLinea + '/' + ciAnchoLinea;

            realizarBusqueda(valor, index)


            // 
        }
        $('#btnConsultaPerso').click(realizarConsultaPersonalizada);
    });

    $(document).ready(function() {

        function cambioColor() {

            var img1 = document.getElementById('img1');
            img1.style.backgroundColor = '' + $('#colorEspecial').val() + ''
            var img2 = document.getElementById('img2');
            img2.style.backgroundColor = '' + $('#colorEspecial').val() + ''
            var img3 = document.getElementById('img3');
            img3.style.backgroundColor = '' + $('#colorEspecial').val() + ''
            var img4 = document.getElementById('img4');
            img4.style.backgroundColor = '' + $('#colorEspecial').val() + ''




        }
        $('#colorEspecial').change(cambioColor);
    });

    /////// Funcion para buscar un numero de cedula /////////
    /////// Funcion para buscar un numero de cedula /////////


    function buscarCedula(cedula) {
        $.ajax({
                url: 'buscarCedula.php',
                type: 'POST',
                dataType: 'html',
                data: {
                    cedula: cedula,
                },
            })
            .done(function(resultado) {
                var resultadoConsulta = resultado.trim();
                if (resultadoConsulta == 'NE') {
                    toast("error", "No existe");

                } else {
                    puntoLocalizado(resultadoConsulta)
                }

            })
    }


    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

    var search = getParameterByName('search');


    if (search != undefined && search != '') {
        puntoLocalizado(search)
    }


    function puntoLocalizado(valor) {
        var codigo = valor.split('*')[0];
        var nombre = valor.split('*')[1];
        var latitud = valor.split('*')[2];
        var longitud = valor.split('*')[3];
        var id = valor.split('*')[4];


        var point = L.marker([latitud, longitud]).bindPopup("Resultado encontrado:<br><br>" + nombre + "<br><br><a class='link' target='_blank' href='../datosPersona.php?id=" + id + "'><i class='fa fa-user'></i>&nbsp;&nbsp;Ver&nbsp;informaci��n&nbsp;de&nbsp;la&nbsp;persona</a><br><a class='link' target='_blank' href='../detallesNuevoMapa.php?id=" + codigo + "'><i class='fa fa-home'></i>&nbsp;&nbsp;Ver&nbsp;informacion&nbsp;de&nbsp;la&nbsp;vivienda</a>").addTo(map);

        point.openPopup();

        map.setView([latitud, longitud], 19);

        toast("success", "Se encontro un resultado");

    }

    $(document).ready(function() {
        function displayAvenza() {
            var valorBuscado = $("#search").val()
            $("#casasAvenza").hide(500, "swing");
        }
        $("#botonAvenza").click(displayAvenza);
    });

    $(document).ready(function() {
        function capaVactorialName() {
            $("#campoNameCapaVectorial").val('Archivos cargados exitosamente')

        }
        $(".arreglo").change(capaVactorialName);
    });

    function sombraEdificio() {
        $("#areasDe").hide(500, 'swing')
        $("#camposSombra").show(500, 'swing')

    }


    function cancelarEdition() {
        $("#editando").hide(500, "swing");
        var lastOrigen = sessionStorage['origen'];
        var lastId = sessionStorage['id'];
        var lastData = sessionStorage['data'];
        var lastEste = sessionStorage['este'];
        var lastNorte = sessionStorage['norte'];
        var lastid_vivienda = sessionStorage['id_vivienda'];
        switch (lastOrigen) {

            case 'casas':
                var registrarDatos = "<a  class='aVerDetallesPopup'  href='../datosCasa.php?casa=" + lastId + "'><i class='line icon-link'></i> Registrar datos</a><br>";
                lastIcon = blueMarker;
                break;



            case 'casasPeople':
                var registrarDatos = "";
                lastIcon = redMarker;
                break;

        }


        var point = L.marker([lastNorte, lastEste], {
            icon: lastIcon,
            id: lastId,
            resp: lastData,
            este: lastEste,
            norte: lastNorte
        }).bindPopup("<strong>Responsable: </strong> " + lastData + "<br><strong>Codigo: </strong> " + lastid_vivienda + "<hr><a class=\"aVerDetallesPopup\" >Ver habitantes</a><br><small>Nota*:</small>Recargue la pagina para ver<hr>" + registrarDatos + "<a  target=\"_blank\" class='aVerDetallesPopup' href='detallesCasa.php?id=" + lastId + "'><i class='line icon-link'></i> Ver informacion</a><br><a class='aMover' onclick='editarDatos(\"" + lastid_vivienda + "\", \"" + lastOrigen + "\",\"" + lastId + "\",\"" + lastData + "\", " + lastEste + ", " + lastNorte + ")'><i class='line icon-note'></i> Convertir en objeto editable</a>");;
        drawnItems.clearLayers();


        switch (lastOrigen) {

            case 'casasPeople':
                casasPeople.addLayer(point);
                break;


            case 'casas':
                casas.addLayer(point);

                break;
        }
    }

    $(document).ready(function() {
        function deactivarOtraProjection() {
            if (document.getElementById('projectionU').checked) {
                document.getElementById('latitud').disabled = true;
                document.getElementById('longitud').disabled = true;
                document.getElementById('coordenadaX').disabled = false;
                document.getElementById('coordenadaY').disabled = false;
                document.getElementById('zona').disabled = false;
                $("#latitud").val('')
                $("#longitud").val('')

            } else if (document.getElementById('projectionG').checked) {
                document.getElementById('coordenadaX').disabled = true;
                document.getElementById('coordenadaY').disabled = true;
                document.getElementById('zona').disabled = true;
                document.getElementById('latitud').disabled = false;
                document.getElementById('longitud').disabled = false;

                $("#coordenadaX").val('')
                $("#coordenadaY").val('')
                $("#zona").val('')
            }
        }
        $(".radioProjection").click(deactivarOtraProjection);
    });


    $(document).ready(function() {
        function visibilidad() {

            if ($("#tresDe").val() == "Si") {
                $("#opcionesTresDe").show(500, "swing")
            } else {
                $("#opcionesTresDe").hide(500, "swing")
            }
        }


        $("#tresDe").change(visibilidad);
    });


    function crearPuntoPorCoordenada() {

        if (document.getElementById('projectionU').checked) {
            var x = $("#coordenadaX").val()
            var y = $("#coordenadaY").val()
            var zona = $("#zona").val()

            var norte = cmdUTM2Lat_click(x, y, "n", zona);
            var este = cmdUTM2Lat_click(x, y, "e", zona);

        } else if (document.getElementById('projectionG').checked) {
            var norte = $("#latitud").val()
            var este = $("#longitud").val()

        }

        var point = L.marker([norte, este]).bindPopup("Punto Creado").addTo(map);

        if (document.getElementById('centrarMapa').checked) {
            map.setView([norte, este], 18)
        }

        document.querySelector(".modal.is-visible").classList.remove('is-visible');
    }


    var ventansModal = [
        '#poligonosCampos',
        '#nuevaCapaCampos',
        '#pointAtPos',
        '#consultaPersonalDiv',
        '#consultaRapida',
        '#propiedadesCapa',
        '#nuevoElementoLeyenda',
        '#icnosPostes',
    ];


    function mostrarOcultarVentanaModal(valor) {
        ventansModal.forEach(element => {
            if (valor == element) {
                $(element).show();
            } else {
                $(element).hide();
            }
        });

        document.getElementById("modal1").classList.add('is-visible');
    }


    function hideMenu() {
        $("#contextMenu").hide();
    }

    function rightClick(e) {
        e.preventDefault();

        if (document.getElementById("contextMenu").style.display == "block")
            hideMenu();
        else {


            var menu = document.getElementById("contextMenu")
            $("#contextMenu").hide();
            $("#contextMenu").show();
            menu.style.left = e.pageX + "px";
            menu.style.top = e.pageY + "px";
        }
    }

    function editarDatos(id_vivienda, origen, id, data, este, norte) {

        $("#editando").show(500, "swing");

        if (JSON.stringify(drawnItems.toGeoJSON()) != '{"type":"FeatureCollection","features":[]}') {

            var lastOrigen = sessionStorage['origen'];
            var lastId = sessionStorage['id'];
            var lastData = sessionStorage['data'];
            var lastEste = sessionStorage['este'];
            var lastNorte = sessionStorage['norte'];
            var lastid_vivienda = sessionStorage['id_vivienda'];
            switch (lastOrigen) {

                case 'casas':
                    var registrarDatos = "<a  class='aVerDetallesPopup'  href='../datosCasa.php?casa=" + lastId + "'><i class='line icon-link'></i> Registrar datos</a><br>";
                    lastIcon = blueMarker;
                    break;

                case 'casasPeople':
                    var registrarDatos = "";
                    lastIcon = redMarker;
                    break;

            }


            var point = L.marker([lastNorte, lastEste], {
                icon: lastIcon,
                resp: lastData,
                id: lastId,
                este: lastEste,
                norte: lastNorte
            }).bindPopup("<strong>Responsable: </strong> " + lastData + "<br><strong>Codigo: </strong> " + lastid_vivienda + "<hr><a class=\"aVerDetallesPopup\" >Ver habitantes</a><br><small>Nota*:</small>Recargue la pagina para ver<hr>" + registrarDatos + "<a  target=\"_blank\" class='aVerDetallesPopup' href='detallesCasa.php?id=" + lastId + "'><i class='line icon-link'></i> Ver informacion</a><br><a class='aMover' onclick='editarDatos(\"" + lastid_vivienda + "\", \"" + lastOrigen + "\",\"" + lastId + "\",\"" + lastData + "\", " + lastEste + ", " + lastNorte + ")'><i class='line icon-note'></i> Convertir en objeto editable</a>");;

            drawnItems.clearLayers();


            switch (lastOrigen) {

                case 'casasPeople':
                    casasPeople.addLayer(point);
                    break;


                case 'casas':
                    casas.addLayer(point);

                    break;
            }
        }


        map.eachLayer(function(marker) {
            if (marker.options) {
                var markerId = marker.options.id;
                if (markerId == id) {

                    drawnItems.addLayer(L.marker([norte, este], {
                        icon: EditMarker,
                        resp: data,
                        draggable: true
                    }).addTo(map));
                    map.removeLayer(marker);

                }
            }
        })


        sessionStorage['id'] = id;
        sessionStorage['data'] = data;
        sessionStorage['este'] = este;
        sessionStorage['norte'] = norte;
        sessionStorage['origen'] = origen;
        sessionStorage['id_vivienda'] = id_vivienda;

    }

    function cerrarModal() {
        document.querySelector(".modal.is-visible").classList.remove('is-visible');
    }


    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this,
                args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function() {
                callback.apply(context, args);
            }, ms || 0);
        };
    }



    $('#search').keyup(delay(function(e) {
        if (this.value != '') {
            buscarCedula(this.value);
        }
    }, 2000));


    function realizarBusqueda(valor, icono) {

        if (valor != '') {

            var nombreCapaLeyenda = $("#nombreCapaLeyenda").val();
            var nombreCapa = valor.toLowerCase().trim();
            var consulta = '';
            var palabraError = '';
            var tipo1 = 0;
            var tipo2 = 0;
            var tipo = '';
            var resultado = '';

            if (nombreCapa.toLowerCase().indexOf('rango de edad:') != -1) {
                var consultaRango = nombreCapa.split('rango de edad:')
                var res = consultaRango[1].trim()

                if (res.indexOf(',') != -1) {
                    res = res.split(',');
                    var rangoEdad = res[0];

                    if (res[1].trim() == 'sexo femenino' || res[1].trim() == 'femenino' || res[1].trim() == 'niñas' || res[1].trim() == 'mujeres') {
                        var newCondition = ' AND sexo="Femenino"';
                    } else if (res[1].trim() == 'sexo masculino' || res[1].trim() == 'masculino' || res[1].trim() == 'niños' || res[1].trim() == 'hombres') {
                        var newCondition = ' AND sexo="Masculino"';
                    } else {
                        var newCondition = '';
                    }

                } else {
                    var rangoEdad = res;
                    var newCondition = '';
                }


                var rango = rangoEdad.split('-');

                var connsultaRangoFinal = 'edad>=' + rango[0] + ' AND edad<=' + rango[1] + newCondition;

                final = connsultaRangoFinal;
                cerrarModal()
                obtener_puntos(final, nombreCapaLeyenda, 'personas', icono)

                return;
            }

            var element = nombreCapa.trim().toLowerCase();

            if (miArray[element][1] == 'casas') {
                tipo1 = 1;
                tipo = 'casas';
            } else {
                tipo2 = 1;
                tipo = 'persona';
            }
            resultado = miArray[element][0]

            obtener_puntos(resultado, nombreCapaLeyenda, tipo, icono)

            if (document.getElementById("saveConsulta").checked == true) {
                almacenarConsulta(resultado, nombreCapaLeyenda, icono, tipo)
            }
            cerrarModal()
            $("#cargandoConsulta").removeClass('oculto')
        }
    }



    function almacenarConsulta(resultado, nombreCapa, perso, tipo) {
        var idProyecto = <?php echo $codigoProyecto ?>;
        $.ajax({
            url: '../../back/manejadorConsulta.php',
            type: 'POST',
            dataType: 'html',
            data: {
                proyecto: idProyecto,
                nombreCapa: nombreCapa,
                resultado: resultado,
                tipo: tipo,
                perso: perso,
                accion: 'add'
            },
        }).done(function(rePol) {
            toast("success", "la consulta se almaceno correctamente");

        })
    }


    function controlCapas() {
        vermenulateral()
        $('.myModal').hide()
        $('#modal-adminstradorCapasActivas').show()

        $('.myBodyModal').html('<i class="fa fa-spinner fa-spin" style="margin: auto; color: gray; font-size: 72px"></i></span>')

        var id = <?php echo $codigoProyecto ?>;

        $.ajax({
                url: '../consultasAjax/mapa_consultas_almacenadas.php',
                type: 'POST',
                dataType: 'html',
                data: {
                    id: id
                },
            })
            .done(function(rePol) {
                $('.myBodyModal').html(rePol)
            })

    }


    function deleteCapa(id) {

        $('#modal-adminstradorCapasActivas').hide()
        Swal.fire({
            title: 'Está seguro?',
            html: 'texto',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'rgb(120 26 5)',
            cancelButtonColor: '#a9a9a9',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Continuar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../back/manejadorConsulta.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        id: id,
                        accion: 'del'
                    },
                }).done(function(rePol) {
                    if (rePol.trim() == 'ok') {
                        toast("success", "La consulta fue eliminada correctamente (recargue la pagina para ver los cambios)");
                    }
                })

            }
        })

    }



    <?php
    if ($tipo = '1') {
        $query66 = "SELECT * FROM consultas_almacenadas WHERE proyecto='$codigoProyecto'";
        $buscar66 = $conexion->query($query66);
        if ($buscar66->num_rows > 0) {
            while ($row66 = $buscar66->fetch_assoc()) {


                $consulta = str_replace('"', "'", $row66['consulta']);

                echo 'obtener_puntos_almacenados("' . $consulta . '", "' . $row66['nombreCapa'] . '", "' . $row66['tipo'] . '", "' . $row66['icono'] . '");';
            }
        }
    }

    ?>



    document.addEventListener("keyup", e => {
        if (e.key == "Escape" && document.querySelector(".modal.is-visible")) {
            document.querySelector(".modal.is-visible").classList.remove('is-visible');
        }

        /*  if (e.key == "1") {
            $("#cargandoConsulta").removeClass('oculto')
            obtener_puntos("agua_potable='Tuberia'", "Viviendas con agua por tuberia", "casas", "4/#00abdf/#ffffff/solid/2");
            }


          if (e.key == "0") {
            map.setView([5.6655, -67.5883], 17, false);
            }
*/


    });
</script>