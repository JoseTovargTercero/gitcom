    <?php
    include('../../configuracion/conexionMysqli.php');

    $consulta=$conexion->real_escape_string($_POST['cedula']);
    function calculaedad($fechanacimiento){
		list($ano, $mes, $dia) = explode("-", $fechanacimiento);
		$ano_diferencia  = date("Y") - $ano;
		$mes_diferencia = date("m") - $mes;
		$dia_diferencia   = date("d") - $dia;
		if ($dia_diferencia < 0 || $mes_diferencia < 0){
			$ano_diferencia--;
		}
		return  $ano_diferencia;
	}

        $query = "SELECT * FROM inf_habitantes WHERE cedula='$consulta'";
        $search = $conexion->query($query);
        if ($search->num_rows > 0) {
            while ($row = $search->fetch_assoc()) {
                $edad =  calculaedad($row['fecha_de_nacimiento']);
                echo $row['id_vivienda'].'*<strong>'.$row['nombre'].'</strong><br>Cedula: '.$row['cedula'].'<br>Edad: '.$edad.' años*'.$row['coordenada_norte'].'*'.$row['coordenada_este'].'*'.$row['id'];
            }
        }else{
            echo 'NE';
        }
        