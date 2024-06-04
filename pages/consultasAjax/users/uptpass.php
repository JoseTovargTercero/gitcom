    <?php
    include('../../../configuracion/conexionMysqli.php');
    include('../../../class/accionesSecundarias.php');
       
    if ($_SESSION['nivel'] != '' || $_SESSION['nivel'] != 'undefined') {

        $id = $_SESSION['id'];
        $pass_a = $_POST['pass_a'];
        $pass_n = $_POST['pass_n'];
        $passEncrypted = password_hash($pass_n, PASSWORD_BCRYPT);



    $stmt = mysqli_prepare($conexion, "SELECT * FROM sist_usuarios WHERE id= ?");
	$stmt->bind_param("s", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			if (password_verify($pass_a, $row['contrasena'])) {
				
                
                $sql = "UPDATE sist_usuarios SET contrasena = ? WHERE id = ?";
                $resultado = $conexion->prepare($sql);
                $resultado->bind_param('ss', $passEncrypted, $id);
                $resultado->execute();
                if ($resultado) {
                    echo '1';
                }
                $resultado->close();
        



			}else {
				echo 'E_P';
			}

		}

	}

    }
    ?>
 