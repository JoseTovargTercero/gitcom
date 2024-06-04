<?php
include('../../../../configuracion/conexionMysqli.php');
include('../../../../class/count.php');

if ($_SESSION['nivel'] != '') {

  $comunidad = $_POST["comunidad"];
  $plan = $_POST["p"];
  $n_fecha = $_POST["n_fecha"];

  

  $queryyy = "SELECT * FROM he_pa_coms_previstas WHERE cod_plan='$plan' AND cod_coms='$comunidad'";
  $buscarM = $conexion->query($queryyy);
  if ($buscarM->num_rows > 0) {

   define('PAGINA_INICIO', '../../../herramientas');
    header('Location: ' . PAGINA_INICIO);

    }else {

      $queryyy = "SELECT * FROM local_comunidades WHERE id_consejo='$comunidad'";
      $buscarM = $conexion->query($queryyy);
      if ($buscarM->num_rows > 0) {
        while ($row = $buscarM->fetch_assoc()) {
          $nombre = $row['nombre_c_comunal'];
        }
      }

      $stmt_nr = $conexion->prepare("INSERT INTO he_pa_coms_previstas (cod_coms, name_coms, cod_plan, dia_d) VALUES (?, ?, ?, ?)");
      $stmt_nr->bind_param("ssss", $comunidad, $nombre, $plan, $n_fecha); 
      $stmt_nr->execute();
      
      
      if (!$stmt_nr) {
        echo 'error';
      }else{
        echo $stmt_nr->insert_id;;
      }

    }

}
  
?>