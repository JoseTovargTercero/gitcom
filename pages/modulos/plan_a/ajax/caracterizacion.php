  <?php

  include('../../../../configuracion/conexionMysqli.php');
  include('../../../../class/count.php');

  if ($_POST["accion"] == 'registro') {

  $com = $_POST["com"];
  $plan = $_POST["plan"];
  $flias = $_POST["flias"];
  $casas = $_POST["casas"];
  $hab = $_POST["hab"];
  $electores = $_POST["electores"];
  $ubchs = $_POST["ubchs"];
  $consejos = $_POST["consejos"];
  $comites = $_POST["comites"];
  $voceros = $_POST["voceros"];
  $brigadas_msv = $_POST["brigadas_msv"];
  $brigadistas = $_POST["brigadistas"];
  $jefes_coms = $_POST["jefes_coms"];
  $lideres_calle = $_POST["lideres_calle"];
  $bolsas = $_POST["bolsas"];
  $c_educativos = $_POST["c_educativos"];
  $c_saluds = $_POST["c_saluds"];
  $c_alimentacion = $_POST["c_alimentacion"];
  $misiones_educativas = $_POST["misiones_educativas"];
  $canchas_depors = $_POST["canchas_depors"];
  $b_Misiones = $_POST["b_Misiones"];
  $c_religiosos = $_POST["c_religiosos"];
  $con_carnet = $_POST["con_carnet"];
  $sin_carnet = $_POST["sin_carnet"];
  $institucionesCom = $_POST["institucionesCom"];

  if($com == ''){$com = '0';}
  if($plan == ''){$plan = '0';}
  if($flias == ''){$flias = '0';}
  if($casas == ''){$casas = '0';}
  if($hab == ''){$hab = '0';}
  if($electores == ''){$electores = '0';}
  if($ubchs == ''){$ubchs = '0';}
  if($consejos == ''){$consejos = '0';}
  if($comites == ''){$comites = '0';}
  if($voceros == ''){$voceros = '0';}
  if($brigadas_msv == ''){$brigadas_msv = '0';}
  if($brigadistas == ''){$brigadistas = '0';}
  if($jefes_coms == ''){$jefes_coms = '0';}
  if($lideres_calle == ''){$lideres_calle = '0';}
  if($bolsas == ''){$bolsas = '0';}
  if($c_educativos == ''){$c_educativos = '0';}
  if($c_saluds == ''){$c_saluds = '0';}
  if($c_alimentacion == ''){$c_alimentacion = '0';}
  if($misiones_educativas == ''){$misiones_educativas = '0';}
  if($canchas_depors == ''){$canchas_depors = '0';}
  if($b_Misiones == ''){$b_Misiones = '0';}
  if($c_religiosos == ''){$c_religiosos = '0';}
  if($con_carnet == ''){$con_carnet = '0';}
  if($sin_carnet == ''){$sin_carnet = '0';}
  if($institucionesCom == ''){$institucionesCom = '0';}

  $stmt_nr = $conexion->prepare("INSERT INTO he_pa_caracterizacion (com, plan, flias, casas, hab, electores, ubchs, consejos, comites, voceros, brigadas_msv, brigadistas, jefes_coms, lideres_calle, bolsas, c_educativos, c_saluds, c_alimentacion, misiones_educativas, canchas_depors, b_Misiones, c_religiosos, con_carnet, sin_carnet, institucionesCom) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt_nr->bind_param("sssssssssssssssssssssssss", $com, $plan, $flias, $casas, $hab, $electores, $ubchs, $consejos, $comites, $voceros, $brigadas_msv, $brigadistas, $jefes_coms, $lideres_calle, $bolsas, $c_educativos, $c_saluds, $c_alimentacion, $misiones_educativas, $canchas_depors, $b_Misiones, $c_religiosos, $con_carnet, $sin_carnet, $institucionesCom); 
  $stmt_nr->execute();
  if (!$stmt_nr) {
    echo 'error';
  }else{

    $stmt_nr -> close();
    $st = '1';
    $stmt = $conexion->prepare("UPDATE `he_pa_coms_previstas` SET `caracterizacion`= ? WHERE cod_plan=? AND cod_coms=?");
    $stmt->bind_param("sss", $st, $plan, $com);
    $stmt->execute();
    if ($stmt) {
      echo '1';
    }
    $stmt -> close();

    echo 'success';
  }
  $stmt_nr->close();

}elseif ($_POST["accion"] == 'consulta') {

  $com = $_POST["com"];
  $plan = $_POST["plan"];

  $queryyy = "SELECT * FROM he_pa_caracterizacion WHERE plan='$plan' AND com='$com' LIMIT 1";
  $buscarM = $conexion->query($queryyy);
  if ($buscarM->num_rows > 0) {
    while ($row = $buscarM->fetch_assoc()) {

      echo '<div class="row">
        <div class="col-lg-6">
          <ul style="padding-left: 20px;list-style: circle;">
            <li><span class="text-gray-800">Familias: </span>'.$row['flias'].'</li>
            <li><span class="text-gray-800">Casas: </span>'.$row['casas'].'</li>
            <li><span class="text-gray-800">Habitantes: </span>'.$row['hab'].'</li>
            <li><span class="text-gray-800">Electores: </span>'.$row['electores'].'</li>
            <li><span class="text-gray-800">UBCH: </span>'.$row['ubchs'].'</li>
            <li><span class="text-gray-800">CC: </span>'.$row['consejos'].'</li>
            <li><span class="text-gray-800">Comités: </span>'.$row['comites'].'</li>
            <li><span class="text-gray-800">Voceros: </span>'.$row['voceros'].'</li>
            <li><span class="text-gray-800">Brigadas MSV: </span>'.$row['brigadas_msv'].'</li>
            <li><span class="text-gray-800">Brigadistas: </span>'.$row['brigadistas'].'</li>
            <li><span class="text-gray-800">Jefes de Comunidad.: </span>'.$row['jefes_coms'].'</li>
            <li><span class="text-gray-800">Lideres de Calle: </span>'.$row['lideres_calle'].'</li>
          </ul>
        </div>
        <div class="col-lg-6">
          <ul style="padding-left: 20px;list-style: circle;">
          <li><span class="text-gray-800">Bolsas: </span>'.$row['bolsas'].'</li>
          <li><span class="text-gray-800">C. Educ. </span>'.$row['c_educativos'].'</li>
          <li><span class="text-gray-800">C. de Salud </span>'.$row['c_saluds'].'</li>
          <li><span class="text-gray-800">Casas de Alim. </span>'.$row['c_alimentacion'].'</li>
          <li><span class="text-gray-800">Misiones Educ. </span>'.$row['misiones_educativas'].'</li>
          <li><span class="text-gray-800">Canchas Depor. </span>'.$row['canchas_depors'].'</li>
          <li><span class="text-gray-800">Base de Misiones </span>'.$row['b_Misiones'].'</li>
          <li><span class="text-gray-800">C. Religiosos </span>'.$row['c_religiosos'].'</li>
          <li><span class="text-gray-800">Carnetizados </span>'.$row['con_carnet'].'</li>
          <li><span class="text-gray-800">Sin Carnet </span>'.$row['sin_carnet'].'</li>
          </ul>
        </div>
        <p><span class="text-gray-800">Instituciones de la comuna: </span>'.$row['institucionesCom'].'</p>
        </div>';
    }
  }
}


?>