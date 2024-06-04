<?php
include('../../../../configuracion/conexionMysqli.php');














if ($_SESSION['nivel'] != '') {

  $idUser = $_SESSION['id'];
  $he = $_GET['he'];
  $id = $_GET["id"];
  $accion = $_GET["accion"];

  
  if ($accion == 'tarea') {

    $queryyy = "SELECT * FROM herramientas_gitcom WHERE user='$idUser' AND id='$he'";
    $buscarM = $conexion->query($queryyy);
    if ($buscarM->num_rows > 0) {
      //
     
    $stmt = $conexion->prepare("DELETE FROM `he_pa_acciones` WHERE id_acc = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($stmt) {
      echo '1';
    }else {
      echo '0';
    }
    $stmt->close();
      
    $stmt = $conexion->prepare("DELETE FROM `he_pa_sub_acciones` WHERE id_tarea = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

  
    }

}else{


    $stmt = $conexion->prepare("DELETE FROM `he_pa_sub_acciones` WHERE id_sc = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($stmt) {
      echo '1';
    }else {
      echo '0';
    }
    $stmt->close();



  }

}

?>