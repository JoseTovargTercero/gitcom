<?php
  include('configuracion/conexionMysqli.php');

	include("class/clearDates.php");
  
  $tk  = clearDate($_GET['tk']);
  $u  = clearDate($_GET['u']);


	$stmt = $conexion->prepare("UPDATE `sist_usuarios` SET `u_token`='$tk' WHERE id='$u' AND u_token='x'");
	$stmt->execute();

  if ($stmt) {
       echo 'cerrar';
    echo '<script>
    window.close()
    </script>';
  }else {
    echo 'No se esperaba ninguna peticion, el servidor ha cerreado la conexion.';
  }
  
  
  
  
  
  

?>