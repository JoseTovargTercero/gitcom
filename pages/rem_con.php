<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");


if ($_POST['pass'] == 'gtcm_sup.24' || $_POST['pass'] == 'gtcm_sup.24' || $_POST['pass'] == 'gtcm_sup.24') {
  $comunidad = $_POST['comunidad'];

  include('../configuracion/conexionMysqli.php');
    $query22e = "SELECT * FROM local_comunidades WHERE id_consejo='$comunidad'";
    $BuscarCoordenadase22 = $conexion->query($query22e);
    if ($BuscarCoordenadase22->num_rows > 0) {
        while ($row_p = $BuscarCoordenadase22->fetch_assoc()) {
            if($row_p['status'] != '1' && $row_p['status'] != '3'){
                echo 'OK';
            }else{
                echo 'CE';
                exit();
            }
        }
    }

    
} else {
  echo 'CI';
  exit();
}






?>