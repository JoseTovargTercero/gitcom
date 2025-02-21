<?php
include('../configuracion/conexionMysqli.php');
include('../class/count.php');

if ($_SESSION['nivel'] == 1) {
	unset($_SESSION['proyecto']);
	$id = $_GET['id'];




	function calculaedad($fechanacimiento)
	{
		list($ano, $mes, $dia) = explode("-", $fechanacimiento);
		$ano_diferencia  = date("Y") - $ano;
		$mes_diferencia = date("m") - $mes;
		$dia_diferencia   = date("d") - $dia;
		if ($dia_diferencia < 0 || $mes_diferencia < 0) {
			$ano_diferencia--;
		}
		return  $ano_diferencia;
	}




	function condicionEdad($edad, $mayorOmenor, $vivienda)
	{
		global $conexion;

		$sengundosDeRetorno = $edad * 31536000;

		$ano = time() - $sengundosDeRetorno;

		$anoDate = date('Y-m-d', $ano);


		while (calculaedad($anoDate) != $edad) {
			$ano = $ano - 86400;
			$anoDate = date('Y-m-d', $ano);
		}


		if ($mayorOmenor == 'mayor de') {
			$conteoH78 = mysqli_query($conexion, "SELECT * FROM inf_habitantes WHERE fecha_de_nacimiento <= '$anoDate' AND id_vivienda = '$vivienda'");
		} else {
			$conteoH78 = mysqli_query($conexion, "SELECT * FROM inf_habitantes WHERE fecha_de_nacimiento >= '$anoDate' AND id_vivienda = '$vivienda'");
		}

		if (mysqli_num_rows($conteoH78) >= 0) {
			return mysqli_num_rows($conteoH78);
		} else {
			return 0;
		}
	}

	$queryCasa = "SELECT * FROM inf_casas WHERE id_vivienda='$id'";
	$buscarCasas = $conexion->query($queryCasa);
	if ($buscarCasas->num_rows > 0) {
		while ($filaCasas = $buscarCasas->fetch_assoc()) {

			if ($filaCasas['zonaRiesgo'] == '') {
				$zonaRiesgo = 'Ninguna';
			} else {
				$zonaRiesgo = $filaCasas['zonaRiesgo'];
			}



			$tipo = $filaCasas['tipo'];
			$material_construccion = $filaCasas['material_construccion'];
			$id_vivienda = $filaCasas['id_vivienda'];
			$condicion_vivienda = $filaCasas['condicion_vivienda'];
			$cantidad_habitaciones = $filaCasas['cantidad_habitaciones'];
			$tenencia_tierra = $filaCasas['tenencia_tierra'];
			$vivienda_venezuela = $filaCasas['vivienda_venezuela'];
			$bnbt = $filaCasas['bnbt'];
			$cod_ine = $filaCasas['cod_ine'];
			$cod_catastro = $filaCasas['cod_catastro'];
			$agua_potable = $filaCasas['agua_potable'];
			$almacenamiento_agua = $filaCasas['almacenamiento_agua'];
			$agua_servidas = $filaCasas['agua_servidas'];
			$disposicion_basura = $filaCasas['disposicion_basura'];
			$electricidad = $filaCasas['electricidad'];
			$telefonia = $filaCasas['telefonia'];
			$internet = $filaCasas['internet'];
			$television = $filaCasas['television'];
			$jefe_calle = $filaCasas['jefe_calle'];
			$coordenada_norte = $filaCasas['coordenada_norte'];
			$coordenada_este = $filaCasas['coordenada_este'];
			$zonaRiesgo = $filaCasas['zonaRiesgo'];
		}
	}

	switch ($cantidad_habitaciones) {
		case ('Una'):
			$cantidadEnNumero = 1;
			break;
		case ('Dos'):
			$cantidadEnNumero = 2;
			break;
		case ('Tres'):
			$cantidadEnNumero = 3;
			break;
		case ('Cuatro'):
			$cantidadEnNumero = 4;
			break;
		case ('Cinco'):
			$cantidadEnNumero = 5;
			break;
		case ('Seis o más'):
			$cantidadEnNumero = 6;
			break;
	}

	//$condicionHacimamiento = number_format(contar('inf_habitantes', '') / $cantidadEnNumero, '2', '.', '.');
	$condicionHacimamiento = number_format(contar2('inf_habitantes', 'id_vivienda="' . $id . '"') / $cantidadEnNumero, '2', '.', '.');

	if ($condicionHacimamiento > 3) {
		$colorH = 'color: #1A73E8';
	}
?>
	<!DOCTYPE html>
	<html lang="es">

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" type="image/png" href="../assets/img/favicon.png">
		<title class="registros" id="title">Detalles de la vivienda</title>
		<link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
		<link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
		<link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
		<link rel="stylesheet" href="../assets/webfonts/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../assets/css/animate.css">
		<link rel="stylesheet" href="../assets/amcharts5/examples/misc-40-charts/index.css" />
		<script src="../assets/js/jquery-3.6.0.min.js"></script>
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
									<i class="fa fa-users opacity-10"></i>
								</div>
								<div class="text-end pt-1">
									<p class="text-sm mb-0 text-capitalize">Habitantes</p>
									<h4 class="mb-0"><?php echo contar2('inf_habitantes', "id_vivienda='$id'") ?></h4>
								</div>
							</div>
							<hr class="dark horizontal my-0">
							<div class="card-footer p-3">
								<p class="mb-0">Personas en la vivienda</p>
							</div>
						</div>
					</div>



					<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
						<div class="card">
							<div class="card-header p-3 pt-2">
								<div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
									<i class="fa fa-home opacity-10"></i>

								</div>
								<div class="text-end pt-1">
									<p class="text-sm mb-0 text-capitalize">Habitaciones</p>
									<h4 class="mb-0"><?php echo $cantidadEnNumero ?></h4>
								</div>
							</div>
							<hr class="dark horizontal my-0">
							<div class="card-footer p-3">
								<p class="mb-0">Cantidad de habitaciones</p>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
						<div class="card">
							<div class="card-header p-3 pt-2">
								<div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
									<i class="fa fa-cube opacity-10" style="position: absolute;margin: -10px 0 0 8px;font-size: 10px;"></i>
									<i class="fa fa-group opacity-10"></i>
								</div>
								<div class="text-end pt-1">
									<p class="text-sm mb-0 text-capitalize">Hacinamiento</p>
									<h4 class="mb-0" style="<?php echo $colorH ?>"><?php echo $condicionHacimamiento ?></h4>
								</div>
							</div>
							<hr class="dark horizontal my-0">
							<div class="card-footer p-3">
								<p class="mb-0">Personas por habitación</p>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6">
						<div class="card">
							<div class="card-header p-3 pt-2">
								<div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
									<i class="fa fa-child opacity-10"></i>

								</div>
								<div class="text-end pt-1">
									<p class="text-sm mb-0 text-capitalize">Niños</p>
									<h4 class="mb-0"><?php echo condicionEdad(13, 'menor de', $id) ?></h4>
								</div>


							</div>
							<hr class="dark horizontal my-0">
							<div class="card-footer p-3">
								<p class="mb-0">Menores de 13</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-4">

					<div class="col-lg-8 col-md-6 mb-md-0 mb-4">
						<div class="card" style="min-height: 350px;">
							<div class="card-header pb-0">

								<div class="row">
									<div class="col-lg-12 col-10">
										<h6>Habitantes
											<?php
											if ($zonaRiesgo != '' && $zonaRiesgo != 'ninguna') {
												echo '<span style="float: right; color: #1A73E8">Riesgo: ' . $zonaRiesgo . '</span>';
											}
											?>
										</h6>
									</div>
								</div>


							</div>
							<div class="card-body px-0 pb-2" style="margin: 0 15px 15px">


								<div class="row vistas animated fadeInUp">
									<div class="col-lg-12">
										<div class="card-box table-responsive">

											<table id="datatable-responsive" class="table table-striped table-bordered" class="table table-striped table-bordered" style="width:100%">
												<thead>
													<tr class="headings">
														<th style="padding: 0.6rem;"></th>
														<th style="padding: 0.6rem;"></th>
														<th style="padding: 0.6rem;">Nombre </th>
														<th style="padding: 0.6rem;">Parentesco</th>
														<th style="padding: 0.6rem;">Cedula</th>
														<th style="padding: 0.6rem;">Telefono</th>
														<th style="padding: 0.6rem;">Ver</th>
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

															echo '<tr class="even pointer" >
						<td style="font-size: 13px">' . $var++ . '</td>
						<td style="font-size: 13px">JF</td>
						<td style="font-size: 13px">' . $filaJefeFamilia['nombre'] . '</td>
						<td style="font-size: 13px"></td>
						<td style="font-size: 13px">' . $filaJefeFamilia['cedula'] . '</td>
						<td style="font-size: 13px">' . $filaJefeFamilia['telefono'] . '</td>
						<td style="text-align: center; font-size: 13px">
						<a style="cursor: pointer"  href="datosPersona.php?id=' . $filaJefeFamilia['id'] . '"  title="Información del habitante">
							<i class="fa fa-user"></i>
							</a>
						</td>
						</tr>


						';


															$queryCarga = "SELECT * FROM inf_habitantes WHERE id_familia='$idFamilia' AND rol_familiar='CARGA FAMILIAR' AND muerte='0'";

															$buscarCarga = $conexion->query($queryCarga);
															if ($buscarCarga->num_rows > 0) {
																while ($filaCarga = $buscarCarga->fetch_assoc()) {

																	echo '<tr class="even pointer">
								<td style="font-size: 13px">' . $var++ . '</td>
								<td style="font-size: 13px"></td>
								<td style="font-size: 13px">' . $filaCarga['nombre'] . '</td>
								<td style="font-size: 13px">' . $filaCarga['parentesco_al_jefe'] . '</td>
								<td style="font-size: 13px">' . $filaCarga['cedula'] . '</td>
								<td style="font-size: 13px">' . $filaCarga['telefono'] . '</td>
								<td style="text-align: center; font-size: 13px">
								<a style="cursor: pointer"  href="datosPersona.php?id=' . $filaCarga['id'] . '"  title="Información del habitante">
									<i class="fa fa-user"></i>
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
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-md-2 mb-md-0 mb-4">


						<div id="filterConctent">

							<div class="card mh-550" style="min-height: 550px;">
								<h6 class="h6Card">Información de la vivienda</h6>
								<div class="row">
									<div class="col-lg-12" style="padding: 0 30px">
										<hr style="margin: 7px; opacity: 0;">
										<?php

										echo 'Tipo: ' . $tipo . '<br>';
										echo 'Material de construcción:  ' . $material_construccion . '<br>';
										echo 'Código: ' . $id_vivienda . '<br>';
										echo 'Condición: ' . $condicion_vivienda . '<br>';
										echo 'Tenencia de la tierra: ' . $tenencia_tierra . '<br>';
										echo 'GMVV: ' . $vivienda_venezuela . '<br>';
										echo 'BNBT: ' . $bnbt . '<br>';
										echo 'Código INE: ' . $cod_ine . '<br>';
										echo 'Código catastral: ' . $cod_catastro . '<br>';
										echo 'Agua potable: ' . $agua_potable . '<br>';
										echo 'Almacenamiento del agua: ' . $almacenamiento_agua . '<br>';
										echo 'Aguas residuales: ' . $agua_servidas . '<br>';
										echo 'Disposicion del basura: ' . $disposicion_basura . '<br>';
										echo 'SEN: ' . $electricidad . '<br>';
										echo 'Telefonia: ' . $telefonia . '<br>';
										echo 'Interne: t' . $internet . '<br>';
										echo 'Televisión: ' . $television . '<br>';
										echo 'Calle: ' . $jefe_calle . '<br>';
										echo 'Latitud: ' . $coordenada_norte . '<br>';
										echo 'Longitud: ' . $coordenada_este . '<br>';

										?>
										<hr style="margin: 17px; opacity: 0;">

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
		<script src="../assets/js/material-dashboard.min.js?v=3.0.2"></script>
	</body>

	</html>

<?php
} else {

	define('PAGINA_INICIO', '../index.php');
	header('Location: ' . PAGINA_INICIO);
}
?>