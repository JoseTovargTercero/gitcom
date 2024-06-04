<?php
include('../../../../configuracion/conexionMysqli.php');
include('../../../../class/count.php');

if ($_GET['p'] != '') {

  $p = $_GET['p'];
  $c = $_GET['c'];

  $vertices_j = array(
    '1' => 'TERRITORIAL Y ORGANIZACIÓN POPULAR',
    '2' => 'EDUCACION',
    '3' => 'SALUD',
    '4' => 'PROTECCIÓN',
    '5' => 'MUJER Y FAMILIA',
    '6' => 'HABITAT, VIVIENDA Y ECOSOCIALISMO',
    '7' => 'EMPRENDIMIENTO, TRABAJO Y PRODUCCION',
    '8' => 'JUVENTUD Y DEPORTE',
    '9' => 'CULTURA Y ESPIRITUALIDAD',
    '10' => 'ALIMENTACIÓN',
    '11' => 'INFRAESTRUCTURA SOCIAL Y SERVICIOS PUBLICOS');



  $queryyy = "SELECT * FROM he_pa_acciones WHERE id_plan='$p' AND com='$c'";
  $buscarM = $conexion->query($queryyy);
  if ($buscarM->num_rows > 0) {
    echo '<option value="">Selecciones</option>';
    while ($row = $buscarM->fetch_assoc()) {
      echo '<option value="'.$row['id_acc'].'*'.$row['tipo_ac'].'*'.$row['vertice'].'">'.$row['tipo_ac'].' - '.$vertices_j[$row['vertice']].'</option>';

    }
  }










  
}

?>