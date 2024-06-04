<?php
include('../../../../configuracion/conexionMysqli.php');
include('../../../../class/count.php');

if ($_SESSION['nivel'] != '') {

  $idUser = $_SESSION['id'];
  $he = $_POST['he'];
  $manejador = $_POST["m"];

  $queryyy = "SELECT * FROM herramientas_gitcom WHERE user='$idUser' AND id='$he'";
  $buscarM = $conexion->query($queryyy);
  if ($buscarM->num_rows > 0) {


    if ($manejador == 'registro') {
      $cod = $_POST['codigo_comuna'];
      $com = $_POST['comuna'];
      $fecha = $_POST['fecha'];
      $desc = $_POST['comentarios'];
      $coms = contar2('local_comunidades', "id_comuna='$cod'");
      $date = explode('-', $fecha);
      $anio = $date[0];
      $mes = $date[1];

      if ($mes >= 10) {
        $trimestre = 4;
      }elseif ($mes >= 7) {
        $trimestre = 3;
      }elseif ($mes >= 4) {
        $trimestre = 2;
      }else {
        $trimestre = 1;
      }


      $stmt_nr = $conexion->prepare("INSERT INTO he_pa_planes (com_cod, com_nom, fecha, comentarios, coms, anio, trimestre) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt_nr->bind_param("sssssss",$cod, $com, $fecha, $desc, $coms, $anio, $trimestre); 
      $stmt_nr->execute();
      if (!$stmt_nr) {
        echo 'error';
      }else{
       echo $stmt_nr->insert_id;
      }
      $stmt_nr->close();















      

    }elseif ($manejador == 'registroT') {

      $veticesId = $_POST["vetices"];
     // $accionId = $_POST["acciones"];
      $tipoTarea = $_POST["tipoTarea"];
     // $atendidos = $_POST["atendidos"];
      $plan = $_POST["plan"];
      $ecargado = $_POST["ecargado"];
      $telefonos = $_POST["telefonos"];
      $ente = $_POST["ente"];
      $c = $_POST["c"];
      $preabordaje = time();

//AND fecha_ac='$preabordaje'

      $queryyy = "SELECT * FROM he_pa_acciones WHERE id_plan='$plan' AND vertice='$veticesId' AND com='$c' ";
      $buscarM = $conexion->query($queryyy);
      if (!$buscarM->num_rows > 0) {

      $stmt_nr = $conexion->prepare("INSERT INTO he_pa_acciones (vertice, fecha_ac, tipo_ac, id_plan, responsable, telefono, ente, com) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt_nr->bind_param("ssssssss", $veticesId, $preabordaje, $tipoTarea, $plan, $ecargado, $telefonos, $ente, $c); 
      $stmt_nr->execute();
      if (!$stmt_nr) {
        echo 'error';
      }else{
        echo $stmt_nr->insert_id;
      }
      $stmt_nr->close();

      }else{
        echo 'rechazado';
      }





    }elseif ($manejador == 'tabla_coms') {
      $co = $_POST["co"];
      $plan = $_POST["i"];
      $comunidades = array();

      
      $queryyy = "SELECT * FROM local_comunidades WHERE id_comuna='$co'";
      $buscarM = $conexion->query($queryyy);
      if ($buscarM->num_rows > 0) {
        while ($row = $buscarM->fetch_assoc()) {
          $comunidades[$row['id_consejo']] = [$row['id_consejo'], $row['nombre_c_comunal'], $row['status']];
        }
      }


      $queryyy = "SELECT * FROM he_pa_coms_previstas WHERE cod_plan='$plan'";
      $buscarM = $conexion->query($queryyy);
      if ($buscarM->num_rows > 0) {
        while ($row = $buscarM->fetch_assoc()) {
          if ($comunidades[$row['cod_coms']]) {
            unset($comunidades[$row['cod_coms']]);
          }
      }
      }


      echo ' <div class="mb-3">
      <label for="n_comunidad" class="form-label">Comunidad</label>
      <select id="n_comunidad" class="form-control">';
      echo '<option value="">Seleccione</option>';
    foreach ($comunidades as $item) {
      echo '<option value="'.$item[0].'">'.$item[1].'</option>';
    }
    echo ' </select>
    </div>';




  } 
  } 



}
