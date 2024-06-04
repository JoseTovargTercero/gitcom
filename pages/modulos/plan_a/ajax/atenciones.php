<?php
include('../../../../configuracion/conexionMysqli.php');
include('../../../../class/count.php');

  if ($_POST["accion"] == 'registro') {

  $com = $_POST["com"];
  $plan = $_POST["plan"];

  $cons_medicas = $_POST['cons_medicas'];
  $cons_medicas_i = $_POST['cons_medicas_i'];
  $cons_programas = $_POST['cons_programas'];
  $cons_programas_i = $_POST['cons_programas_i'];
  $its = $_POST['its'];
  $its_i = $_POST['its_i'];
  $planificacion_fa = $_POST['planificacion_fa'];
  $planificacion_fa_i = $_POST['planificacion_fa_i'];
  $medic_entregadas = $_POST['medic_entregadas'];
  $medic_entregadas_i = $_POST['medic_entregadas_i'];
  $inmunizacion = $_POST['inmunizacion'];
  $inmunizacion_i = $_POST['inmunizacion_i'];
  $eval_nutricional = $_POST['eval_nutricional'];
  $eval_nutricional_i = $_POST['eval_nutricional_i'];
  $cortes_cabello = $_POST['cortes_cabello'];
  $cortes_cabello_i = $_POST['cortes_cabello_i'];
  $emb_cejas = $_POST['emb_cejas'];
  $emb_cejas_i = $_POST['emb_cejas_i'];
  $pcd = $_POST['pcd'];
  $pcd_i = $_POST['pcd_i'];
  $asesorias_viviendas = $_POST['asesorias_viviendas'];
  $asesorias_viviendas_i = $_POST['asesorias_viviendas_i'];
  $asesoria_a_myo = $_POST['asesoria_a_myo'];
  $asesoria_a_myo_i = $_POST['asesoria_a_myo_i'];
  $plantas = $_POST['plantas'];
  $plantas_i = $_POST['plantas_i'];
  $mascotas = $_POST['mascotas'];
  $mascotas_i = $_POST['mascotas_i'];
  $asesorias_produc = $_POST['asesorias_produc'];
  $asesorias_produc_i = $_POST['asesorias_produc_i'];
  $capac_universitaria = $_POST['capac_universitaria'];
  $capac_universitaria_i = $_POST['capac_universitaria_i'];
  $re_bombillos = $_POST['re_bombillos'];
  $re_bombillos_i = $_POST['re_bombillos_i'];
  $refrigerios = $_POST['refrigerios'];
  $refrigerios_i = $_POST['refrigerios_i'];
  $trans_personal = $_POST['trans_personal'];
  $trans_personal_i = $_POST['trans_personal_i'];
  $recreacion_nn = $_POST['recreacion_nn'];
  $recreacion_nn_i = $_POST['recreacion_nn_i'];
  $ases_pedago = $_POST['ases_pedago'];
  $ases_pedago_i = $_POST['ases_pedago_i'];
  $entrega_fe_v = $_POST['entrega_fe_v'];
  $entrega_fe_v_i = $_POST['entrega_fe_v_i'];
  $c_ninos = $_POST['c_ninos'];
  $c_ninos_i = $_POST['c_ninos_i'];
  $c_mujeres = $_POST['c_mujeres'];
  $c_mujeres_i = $_POST['c_mujeres_i'];
  $c_juventud = $_POST['c_juventud'];
  $c_juventud_i = $_POST['c_juventud_i'];
  $c_todo = $_POST['c_todo'];
  $c_todo_i = $_POST['c_todo_i'];
  $pintacaritas = $_POST['pintacaritas'];
  $pintacaritas_i = $_POST['pintacaritas_i'];
  $cedula_indi = $_POST['cedula_indi'];
  $cedula_indi_i = $_POST['cedula_indi_i'];
  $rhab_insfra = $_POST['rhab_insfra'];
  $rhab_insfra_i = $_POST['rhab_insfra_i'];

  $stmt_nr = $conexion->prepare("INSERT INTO he_pa_atenciones (com, plan, cons_medicas, cons_medicas_i, cons_programas, cons_programas_i, its, its_i, planificacion_fa, planificacion_fa_i, medic_entregadas, medic_entregadas_i, inmunizacion, inmunizacion_i, eval_nutricional, eval_nutricional_i, cortes_cabello, cortes_cabello_i, emb_cejas, emb_cejas_i, pcd, pcd_i, asesorias_viviendas, asesorias_viviendas_i, asesoria_a_myo, asesoria_a_myo_i, plantas, plantas_i, mascotas, mascotas_i, asesorias_produc, asesorias_produc_i, capac_universitaria, capac_universitaria_i, re_bombillos, re_bombillos_i, refrigerios, refrigerios_i, trans_personal, trans_personal_i, recreacion_nn, recreacion_nn_i, ases_pedago, ases_pedago_i, entrega_fe_v, entrega_fe_v_i, c_ninos, c_ninos_i, c_mujeres, c_mujeres_i, c_juventud, c_juventud_i, c_todo, c_todo_i, pintacaritas, pintacaritas_i, cedula_indi, cedula_indi_i, rhab_insfra, rhab_insfra_i
  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt_nr->bind_param("ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss", $com, $plan, $cons_medicas, $cons_medicas_i, $cons_programas, $cons_programas_i, $its, $its_i, $planificacion_fa, $planificacion_fa_i, $medic_entregadas, $medic_entregadas_i, $inmunizacion, $inmunizacion_i, $eval_nutricional, $eval_nutricional_i, $cortes_cabello, $cortes_cabello_i, $emb_cejas, $emb_cejas_i, $pcd, $pcd_i, $asesorias_viviendas, $asesorias_viviendas_i, $asesoria_a_myo, $asesoria_a_myo_i, $plantas, $plantas_i, $mascotas, $mascotas_i, $asesorias_produc, $asesorias_produc_i, $capac_universitaria, $capac_universitaria_i, $re_bombillos, $re_bombillos_i, $refrigerios, $refrigerios_i, $trans_personal, $trans_personal_i, $recreacion_nn, $recreacion_nn_i, $ases_pedago, $ases_pedago_i, $entrega_fe_v, $entrega_fe_v_i, $c_ninos, $c_ninos_i, $c_mujeres, $c_mujeres_i, $c_juventud, $c_juventud_i, $c_todo, $c_todo_i, $pintacaritas, $pintacaritas_i, $cedula_indi, $cedula_indi_i, $rhab_insfra, $rhab_insfra_i); 
  $stmt_nr->execute();
  if (!$stmt_nr) {
    echo 'error';
  }else{

    $stmt_nr -> close();
    $st = '1';
    $stmt = $conexion->prepare("UPDATE `he_pa_coms_previstas` SET `atenciones`= ? WHERE cod_plan=? AND cod_coms=?");
    $stmt->bind_param("sss", $st, $plan, $com);
    $stmt->execute();
    if ($stmt) {
      echo 'success';
    }else {
      echo "error";
    }
    $stmt -> close();

  }

}elseif ($_POST["accion"] == 'consulta') {

  $com = $_POST["com"];
  $plan = $_POST["plan"];

  function atencion($cantidad, $nombre, $ente){
    if ($cantidad > 0) {
      return '<div class="col-lg-6">
      <ul style="padding-left: 20px;list-style: circle;">
        <li><span class="text-gray-800">'.$nombre.': </span>'.$cantidad.'<br><small claas="text-gray">'.$ente.'</small></li>
      </ul>
    </div>';
    }
  }

  $queryyy = "SELECT * FROM he_pa_atenciones WHERE plan='$plan' AND com='$com' LIMIT 1";
  $buscarM = $conexion->query($queryyy);
  if ($buscarM->num_rows > 0) {
    while ($row = $buscarM->fetch_assoc()) {
      echo '<div class="row">';
  
      echo atencion($row['cons_medicas'], 'C. medicas', $row['cons_medicas_i']);
      echo atencion($row['cons_programas'], 'C. medicina G', $row['cons_programas_i']);
      echo atencion($row['its'], 'ITS', $row['its_i']);
      echo atencion($row['planificacion_fa'], 'P. Familiar', $row['planificacion_fa_i']);
      echo atencion($row['medic_entregadas'], 'Medicinas e.', $row['medic_entregadas_i']);
      echo atencion($row['inmunizacion'], 'I. dosis aplicadas', $row['inmunizacion_i']);
      echo atencion($row['eval_nutricional'], 'E. nutricional', $row['eval_nutricional_i']);

      echo atencion($row['cortes_cabello'], 'C. de cabello', $row['cortes_cabello_i']);
      echo atencion($row['emb_cejas'], 'E. de cejas', $row['emb_cejas_i']);
      echo atencion($row['pcd'], 'A. a PCD', $row['pcd_i']);
      echo atencion($row['asesorias_viviendas'], 'A. por viviendas', $row['asesorias_viviendas_i']);
      echo atencion($row['asesoria_a_myo'], 'A. a adultos mayores', $row['asesoria_a_myo_i']);
      echo atencion($row['plantas'], 'D. de plantas', $row['plantas_i']);
      echo atencion($row['mascotas'], 'A. a mascotas', $row['mascotas_i']);
      echo atencion($row['asesorias_produc'], 'A. productivas', $row['asesorias_produc_i']);
      echo atencion($row['capac_universitaria'], 'C. de becas u.', $row['capac_universitaria_i']);
      echo atencion($row['re_bombillos'], 'R. de bombillos', $row['re_bombillos_i']);
      echo atencion($row['refrigerios'], 'E. de refrigerios', $row['refrigerios_i']);
      echo atencion($row['trans_personal'], 'Transporte personal', $row['trans_personal_i']);
      echo atencion($row['recreacion_nn'], 'Recración de niños (a)', $row['recreacion_nn_i']);
      echo atencion($row['ases_pedago'], 'A. pedagógicas', $row['ases_pedago_i']);
      echo atencion($row['entrega_fe_v'], 'E. de fe de vida', $row['entrega_fe_v_i']);
      echo atencion($row['c_ninos'], 'C. para niños', $row['c_ninos_i']);
      echo atencion($row['c_mujeres'], 'C. para mujeres', $row['c_mujeres_i']);
      echo atencion($row['c_juventud'], 'C. para la juventud', $row['c_juventud_i']);
      echo atencion($row['c_todo'], 'C. para todo el publico', $row['c_todo_i']);
      echo atencion($row['pintacaritas'], 'Pintacaritas', $row['pintacaritas_i']);

      echo atencion($row['cedula_indi'], 'Casos de cedula indígena', $row['cedula_indi_i']);
      echo atencion($row['rhab_insfra'], 'Rehabilitación de infraestructuras', $row['rhab_insfra_i']);

      echo '</div>';
    }
  }

}

?>