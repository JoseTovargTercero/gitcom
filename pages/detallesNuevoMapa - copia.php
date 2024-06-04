<?php
include('includes/seleccionado.php');
if ($_SESSION['nivel'] == 1) {
	include('includes/menu.php');
	$menu = MenuAdministrador();
	include('includes/cabecera.php');
	$cabecera = topNav();


	if ($_GET['id'] == '') {
		define('PAGINA_INICIO', 'mapa/index.php');
		header('Location: ' . PAGINA_INICIO);
	}

	$id = $_GET['id'];

?>
	<!DOCTYPE html>
	<html lang="es">

	<head>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<link rel='icon' href='assets/img/favicon.ico' type='image/ico' />
		<title>información de la vivienda</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="./css/main.css">
		<link href="pop-up/css/bootstrap.css" rel="stylesheet">
		<link href="pop-up/css/magnific-popup.css" rel="stylesheet">
		<link href="pop-up/css/styles.css" rel="stylesheet">
		<script src="./js/jquery-3.1.1.min.js"></script>
		<link href="js/data/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		<link href="js/data/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
		<link href="js/data/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
		<link href="js/data/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
		<link href="js/data/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
		<style>
			.form-group {
    position: relative;
    margin-bottom: -0.75rem;
}
		</style>
	</head>


	<body>
		<?php echo $menu ?>
		<!-- Content page-->
		<section id="ojo" class="full-box dashboard-contentPage" style="height: 100%; overflow-y:auto;">

			<!-- NavBar -->
			<?php echo $cabecera; ?>

			<!-- Content page -->
			<div class="container-fluid">
				<div class="page-header">
					<h1 class="text-titles"><i class="zmdi zmdi-home zmdi-hc-fw"></i> Datos <small> de la vivienda</small></h1>
				</div>
			</div>


			

<div class="row">
			<!-- Panel nuevo administrador -->
			<div class="col-lg-4">
			<div class="container-fluid">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; Información de la vivienda</h3>
					</div>
					<div class="panel-body">
						<fieldset>
							<div class="container-fluid">
									<div class="row">
										<?php
													$queryCasa = "SELECT * FROM inf_casas WHERE id_vivienda='$id'";
													$buscarCasas = $conexion->query($queryCasa);
													if ($buscarCasas->num_rows > 0) {
														while ($filaCasas = $buscarCasas->fetch_assoc()) {
															
															if ($filaCasas['zonaRiesgo'] == '') {
																$zonaRiesgo = 'Ninguna';
															}else {
																$zonaRiesgo = $filaCasas['zonaRiesgo'];
															}


															echo "<div class='col-lg-12'>
															<p>Tipo: <strong>".$filaCasas['tipo']."</strong></p>
															<p>Material: <strong>".$filaCasas['material_construccion']."</strong></p>
															<p>Codigo: <strong>".$filaCasas['id_vivienda']."</strong></p>
															<p>Condición: <strong>".$filaCasas['condicion_vivienda']."</strong></p>
															<p>Habitaciones: <strong>".$filaCasas['cantidad_habitaciones']."</strong></p>
															<p>Tenencia: <strong>".$filaCasas['tenencia_tierra']."</strong></p>
															<p>GMVV: <strong>".$filaCasas['vivienda_venezuela']."</strong></p>
															<p>BNBT: <strong>".$filaCasas['bnbt']."</strong></p>
															<p>Codigo INE: <strong>".$filaCasas['cod_ine']."</strong></p>
															<p>Codigo catastral: <strong>".$filaCasas['cod_catastro']."</strong></p>
															<p>Suministro de agua: <strong>".$filaCasas['agua_potable']."</strong></p>
															<p>Almacenamiento: <strong>".$filaCasas['almacenamiento_agua']."</strong></p>
															<p>Aguas Residuales: <strong>".$filaCasas['agua_servidas']."</strong></p>
															<p>Basura: <strong>".$filaCasas['disposicion_basura']."</strong></p>
															<p>Electricidad: <strong>".$filaCasas['electricidad']."</strong></p>
															<p>Telefonia: <strong>".$filaCasas['telefonia']."</strong></p>
															<p>Internet: <strong>".$filaCasas['internet']."</strong></p>
															<p>Television: <strong>".$filaCasas['television']."</strong></p>
															<p>Zona de Riesgo: <strong>".$zonaRiesgo."</strong></p>
															<p>Calle: <strong>".$filaCasas['jefe_calle']."</strong></p>

															<p>Latitud: <strong>".$filaCasas['coordenada_norte']."</strong></p>
															<p>Longitud: <strong>".$filaCasas['coordenada_este']."</strong></p></div>
															
															
															";
														}
													}
													?>
												
								</div>
							</div>
						</fieldset>
					</div>
				</div>
			</div>
			</div>



			<div class="col-lg-8">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; Familias</h3>
					</div>
					<div class="panel-body">
						<fieldset>
							<div class="container-fluid">
							
										<div class="card-box table-responsive">
										
										<table id="datatable-responsive" class="table table-striped table-bordered" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr class="headings">
													<th>#</th>
													<th>Rol Familiar </th>
													<th>Nombre </th>
													<th>Parentesco</th>
													<th>Cedula</th>
													<th>Telefono</th>
													<th></th>
												</tr>
											</thead>




											<tbody>


												<?php
												$var = 1;
												$queryJefeDeFamilia = "SELECT * FROM inf_habitantes WHERE rol_familiar='JEFE DE FAMILIA'  AND muerte='0' AND id_vivienda='$id'";
														$buscarHabitantes = $conexion->query($queryJefeDeFamilia);
														if ($buscarHabitantes->num_rows > 0) {
															while ($filaJefeFamilia = $buscarHabitantes->fetch_assoc()) {



																$idFamilia = $filaJefeFamilia['id_familia'];

																echo '<tr class="even pointer"  style="background-color: rgb(205 92 92 / 12%);">
																<td>'.$var++.'</td>

																<td >J. DE FAMILIA</td>

																<td>' . $filaJefeFamilia['nombre'] . '</td>
																<td></td>
																<td>' . $filaJefeFamilia['cedula'] . '</td>
																<td>' . $filaJefeFamilia['telefono'] . '</td>
																<td style="text-align: center;">
																<a style="cursor: pointer"  href="personaInfo.php?id=' . $filaJefeFamilia['id'] . '"  title="Información del habitante">
																	<i class="zmdi zmdi-account"></i>
																	</a>
																</td>
																</tr>


																';


																$queryCarga = "SELECT * FROM inf_habitantes WHERE id_familia='$idFamilia' AND rol_familiar='CARGA FAMILIAR' AND muerte='0'";

																$buscarCarga = $conexion->query($queryCarga);
																if ($buscarCarga->num_rows > 0) {
																	while ($filaCarga = $buscarCarga->fetch_assoc()) {

																		echo '<tr class="even pointer">
																		<td>'.$var++.'</td>
																		<td></td>
																		<td>' . $filaCarga['nombre'] . '</td>
																		<td>' . $filaCarga['parentesco_al_jefe'] . '</td>
																		<td>' . $filaCarga['cedula'] . '</td>
																		<td>' . $filaCarga['telefono'] . '</td>
																		<td style="text-align: center;">
																		<a style="cursor: pointer"  href="personaInfo.php?id=' . $filaCarga['id'] . '"  title="Información del habitante">
																			<i class="zmdi zmdi-account"></i>
																			</a>
																		</td>
																		</tr>';
																	}
																}
															}
														}
												
												?>




											</tbody>
										</table>
									</div>

										
							</div>
						</fieldset>
				</div>
			</div>
</div>
</div>

		</section>
                                
		<script src="js/peticionBusqueda.js"></script>
		<script src="js/mask/jquery.min.js"></script>
		<script src="js/mask/bootstrap.bundle.min.js"></script>
		<script src="js/mask/jquery.inputmask.bundle.min.js"></script>
		<script src="js/mask/custom.min.js"></script>

		<script src="js/validator/multifield.js"></script>
		<script src="js/validator/validator.js"></script>


		<script src="js/data/datatables.net/js/jquery.dataTables.min.js"></script>
		<script src="js/data/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
		<script src="js/data/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
		<script src="js/data/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
		<script src="js/data/datatables.net-buttons/js/buttons.flash.min.js"></script>
		<script src="js/data/datatables.net-buttons/js/buttons.html5.min.js"></script>
		<script src="js/data/datatables.net-buttons/js/buttons.print.min.js"></script>
		<script src="js/data/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
		<script src="js/data/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
		<script src="js/data/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
		<script src="js/data/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
		<script src="js/data/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

		<script src="./js/sweetalert2.min.js"></script>
		<script src="./js/bootstrap.min.js"></script>
		<script src="./js/material.min.js"></script>
		<script src="./js/ripples.min.js"></script>
		<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="./js/main.js"></script>
		<?php


if ($_SESSION['notificacionFromCasa'] == "si") {

	echo "
	<script>
	$(window).on('load', function(e){
		e.preventDefault();
		swal({
			  title: 'Actualización exitosa',
			  text: 'Se actualizaron los datos correctamente',
			  type: 'success',
			  confirmButtonColor: '#03A9F4',
			  cancelButtonColor: '#F44336',
			  confirmButtonText: '<i class=\'zmdi zmdi-check\'></i> Aceptar!',
		})
	});
		</script>";

	unset($_SESSION['notificacionFromCasa']);
} elseif ($_SESSION["notificacion"] == "delete") {
	echo "
	<script>
	$(window).on('load', function(e){
		e.preventDefault();
		swal({
			  title: 'Borrado exitosamente',
			  text: 'Se borraron los datos correctamente',
			  type: 'success',
			  confirmButtonColor: '#03A9F4',
			  cancelButtonColor: '#F44336',
			  confirmButtonText: '<i class=\'zmdi zmdi-check\'></i> Aceptar!',
		})
	});
		</script>";
	unset($_SESSION['notificacion']);
} elseif ($_SESSION['notificacion'] == "editado") {

	echo "
	<script>
	$(window).on('load', function(e){
		e.preventDefault();
		swal({
			  title: 'Editado exitosamente',
			  text: 'Se actualizaron los datos correctamente',
			  type: 'success',
			  confirmButtonColor: '#03A9F4',
			  cancelButtonColor: '#F44336',
			  confirmButtonText: '<i class=\'zmdi zmdi-check\'></i> Aceptar!',
		})
	});
		</script>";
	unset($_SESSION['notificacion']);
} elseif ($_SESSION["notificacion"] == "actualizadoDead") {

	echo "
	<script>
	$(window).on('load', function(e){
		e.preventDefault();
		swal({
			  title: 'Editado exitosamente',
			  text: 'La tarea se completó correctamente.',
			  type: 'success',
			  confirmButtonColor: '#03A9F4',
			  cancelButtonColor: '#F44336',
			  confirmButtonText: '<i class=\'zmdi zmdi-check\'></i> Aceptar!',
		})
	});
		</script>";

	unset($_SESSION['notificacion']);

}

if ( $_SESSION['notificacion2'] == "nFoto") {

	echo "
	<script>
	$(window).on('load', function(e){
		e.preventDefault();
		swal({
			  title: 'Agregado exitosamente',
			  text: 'La imagen se agregó correctamente.',
			  type: 'success',
			  confirmButtonColor: '#03A9F4',
			  cancelButtonColor: '#F44336',
			  confirmButtonText: '<i class=\'zmdi zmdi-check\'></i> Aceptar!',
		})
	});
		</script>";

	unset($_SESSION['notificacion2']);
}



?>

<script>
			$.material.init();
		</script>
				
    <script src="pop-up/js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="pop-up/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="pop-up/js/scripts.js"></script> <!-- Custom scripts -->
	
	</body>

	</html>
<?php
} else {
	define('PAGINA_INICIO', '../index.php');
	header('Location: ' . PAGINA_INICIO);
}
?>