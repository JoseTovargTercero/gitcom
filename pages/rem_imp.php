<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");


if ($_POST['pass'] == 'gtcm_sup.24' || $_POST['pass'] == 'gtcm_sup.24' || $_POST['pass'] == 'gtcm_sup.24') {
include('../configuracion/conexionMysqli.php');
      $data_casa = $_POST["data_casa"];
      $data_habita = $_POST["data_habita"];
      $data_calle = $_POST["data_calle"];
   
      
      
      
      
    if (mysqli_query($conexion, $data_casa)) {
        echo "ok";
    } else {
        echo mysqli_error($conexion);
    }
        
   if (mysqli_query($conexion, $data_habita)) {
        echo "ok";
    } else {
        echo mysqli_error($conexion);
    }
        
   if (mysqli_query($conexion, $data_calle)) {
        echo "ok";
    } else {
        echo 'errror'.mysqli_error($conexion);
    }
        
    
    $comunidad = $_POST['comunidad'];
    
    $insertar = "UPDATE local_comunidades SET status='3' WHERE id_consejo='$comunidad'";
    $result = mysqli_query( $conexion, $insertar );
    
    
}else{
    echo 'CI';
}
?>