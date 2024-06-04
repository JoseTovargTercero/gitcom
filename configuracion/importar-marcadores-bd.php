<?php
include('conexionMysqli.php');

	$tipo = $_POST["tipo"];

	if ($tipo == 'm') {
		$resultado = $_POST['resultado'];
		$resultado = substr($resultado, 0, -1);
		$resultado = explode('*', $resultado);

	
		$agua = array('', 'Pozo', 'Tuberia', 'De la lluvia', 'Del Vecino', 'Cisterna');
		$basura = array('', 'Servicio de Recoleccion', 'Al Aire Libre', 'Quema', 'Entierro');
		$frecuencia = array('', 'Diaria', 'Una vez a la Semana', 'Cada 15 dias', 'Una vez al mes');

		$mcp = $_POST["mcp"];
		$pq = $_POST["pq"];
		$com = $_POST["com"];
		$comd = $_POST["comd"];


		$stmt = $conexion->prepare("INSERT INTO inf_casas (coordenada_este, coordenada_norte, responsable, extra, agua_potable, disposicion_basura, frecuencia_recoleccion,
		id_municipio, id_parroquia, id_comuna, id_c_comunal, id_vivienda) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");



		foreach ($resultado as $item) {
			
			$result = explode(',', $item);
			$i_lon  = $result[2];
			$i_lat  = $result[1];
			$i_cedula = $result[0];
			$i_agua  = $agua[$result[3]];
			$i_basura  = $basura[$result[4]];

			if (@$result[6]) {
				$i_id  = $result[6];
				$i_frecuencia  = $frecuencia[$result[5]];
			}else {
				$i_id  = $result[5];
				$i_frecuencia  = '';
			}

			if ($i_id < 10) {
				$idV = $comd.'_0'.$i_id;
			}else{
				$idV = $comd.'_'.$i_id;
			}

			$stmt->bind_param("ssssssssssss", $i_lon, $i_lat, $i_cedula, $i_id, $i_agua, $i_basura, $i_frecuencia, $mcp,$pq,$com,$comd,$idV); 
			$stmt->execute();
			
			print_r($stmt);
	
		}

		$stmt->close();



		$stmt2 = $conexion->prepare("UPDATE `local_comunidades` SET `status`= '2' WHERE id_consejo=?");
		$stmt2->bind_param("s", $comd);
		$stmt2->execute();
		if ($stmt2) {
			echo'1';
		}
		$stmt2 -> close();




	}elseif ($tipo == 'i') {
		# upodate where cedula y pasos

		$alatitude = $_POST["alatitude"];
		$alongitude = $_POST["alongitude"];
		$id = $_POST["id"];
		$ced = $_POST["ced"];


		$stmt2 = $conexion->prepare("UPDATE `inf_casas` SET `coordenada_este`= ?, `coordenada_norte`= ? WHERE extra=? AND responsable=?");
		$stmt2->bind_param("ssss", $alongitude, $alatitude, $id, $ced);
		$stmt2->execute();
		if ($stmt2) {
			echo'1';
		}
		$stmt2 -> close();








	}


?>