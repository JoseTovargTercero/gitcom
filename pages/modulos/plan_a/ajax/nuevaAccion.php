<?php
include('../../../../configuracion/conexionMysqli.php');
include('../../../../class/count.php');





  $tarea = $_POST["tarea"];
  $s_acciones = $_POST["s_acciones"];
  $s_fecha = $_POST["s_fecha"];
  $tipo = $_POST["tipo"];
  $s_atendidos = $_POST["s_atendidos"];
  $c = $_POST["c"];
  $plan = $_POST["plan"];

  $explode_f = explode('-', $s_fecha);


  if ($tipo == 'MicroJornada') {
    $status = '2';
  }else {
    $status = '0';
  }

  $queryyy = "SELECT * FROM he_pa_sub_acciones WHERE id_p='$plan' AND com='$c' AND id_accion='$s_acciones' ";
  $buscarM = $conexion->query($queryyy);
  if (!$buscarM->num_rows > 0) {
  
  $stmt_nr = $conexion->prepare("INSERT INTO he_pa_sub_acciones (id_tarea, id_accion, fecha_ac, accion_anio, accion_mes, impacto_ac, status, id_p, com) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt_nr->bind_param("sssssssss", $tarea, $s_acciones, $s_fecha, $explode_f[0], $explode_f[1], $s_atendidos, $status, $plan, $c); 
  $stmt_nr->execute();
  if (!$stmt_nr) {
    echo 'error';
  }else{
    echo 'success';
  }
  $stmt_nr->close();

  }else{
    echo 'ye';
  }






  

?>