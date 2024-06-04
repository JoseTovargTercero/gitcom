<?php



function contar($table, $val, $input){
  global $conexion;
  $condicion = '';

  if ($_SESSION['nivel'] == 4) {
    if ($table == 'inf_casas' || $table == 'inf_habitantes') {
      $com = $_SESSION['dato2'];
      $condicion = " id_c_comunal='$com' AND ";
    }
  }
  


  $sql = "SELECT count(*) FROM $table WHERE $condicion $input = ?";
  $stmt = $conexion->prepare($sql);
  $stmt->bind_param('s', $val);
  $stmt->execute();
  $row = $stmt->get_result()->fetch_row();
  $galTotal = $row[0];

  return $galTotal;
}


function contar2($table, $condicion){
  global $conexion;

  if ($_SESSION['nivel'] == 4) {
    if ($table == 'inf_casas' || $table == 'inf_habitantes') {
      $com = $_SESSION['dato2'];
      $condicion.= " AND id_c_comunal='$com'";
    }
  }

  
  $sql = "SELECT count(*) FROM $table WHERE $condicion";
  $stmt = $conexion->prepare($sql);
  $stmt->execute();
  $row = $stmt->get_result()->fetch_row();
  $galTotal = $row[0];

  return $galTotal;
}
