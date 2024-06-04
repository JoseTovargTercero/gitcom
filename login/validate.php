<?php
	
	include('../configuracion/conexionMysqli.php');
	include("../class/clearDates.php");
	include("../class/accionesSecundarias.php");

	$doc = clearDate($_POST['user']);
	$contrasena = clearDate($_POST['password']);

	$stmt = mysqli_prepare($conexion, "SELECT * FROM `sist_usuarios` WHERE usuario= ? AND contrasena!='' AND status='0' LIMIT 1");
	$stmt->bind_param("s", $doc);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			if (password_verify($contrasena, $row['contrasena'])) {
				if ($row['status'] == 0) {
					$_SESSION['id']=$row['id'];
					$id = $row['id'];
					//$rand = rand(10000,1000000);
					$rand = '1';
					$_SESSION['rand'] = $rand;

					$stmt = $conexion->prepare("UPDATE `sist_usuarios` SET `u_token`= 'x' WHERE id='$id'");
					$stmt->execute();

				
					$titulo = 'GITCOM - Verificacion'; // Asunto
					$mensaje = ' 
					<html> 
					<head> 
					<title>GITCOM</title> 
					</head> 
					<body> 
					<h1>Hola '.$row['nombreUser'].'!</h1> 
					<p> 
					<b>
						Haga click en el siguiente enlace para validar su inicio de sesion. 
						<strong>
						En caso de no haber realizado ningun inicio, actualice sus credenciales.
						</strong>
				
						<a href="https://gitcom-ve.com/ini?tk='.$rand.'&u='.$row['id'].'">Validacio de usuario</a>
					<br>
					<br>
					<h2></h2>
					<br>
					<br>
					</p> 
					</body> 
					</html> '; 
				
				
				 if(sendMails($row['usuario'], $titulo, $mensaje)) {
						$estado = 'true';
						// correcto
					}

				}else{
					$estado = 'false-2';
					// por usr bloqueado
				}

			}else{
				$estado = 'false';
				// por pss incorrecto
			}
		}
	}else {
		$estado = 'false';
		// por pss/usr incorrecto
	}
	$stmt -> close();
	echo $estado;
?>