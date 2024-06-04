<?php
include('../../../../configuracion/conexionMysqli.php');
include('../../../../class/count.php');

if ($_SESSION['nivel'] != '') {

  $idUser = $_SESSION['id'];
  $he = $_POST['he'];
  $manejador = $_POST["m"];
  


  function fechaCastellano ($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
   // $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_ES = array("", "", "", "", "", "", "");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
  $meses_ES = array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sept", "Oct", "Nov", "Dic");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia." ".$numeroDia." ".$nombreMes." ".$anio;
  }





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


  $queryyy = "SELECT * FROM herramientas_gitcom WHERE user='$idUser' AND id='$he'";
  $buscarM = $conexion->query($queryyy);
  if ($buscarM->num_rows > 0) {


    if ($manejador == 'tareasReg') {

      // listado de tareas en el registro (por comunidad)
         
       $plan = $_POST["plan"];
       $c = $_POST["com"];




       $stmt = mysqli_prepare($conexion, "SELECT * FROM he_pa_sub_acciones LEFT JOIN he_pa_acciones_inner ON he_pa_acciones_inner.accion = he_pa_sub_acciones.id_accion WHERE id_tarea= ? ORDER BY fecha_ac");
       
      $queryyy = "SELECT * FROM he_pa_acciones  WHERE id_plan='$plan' AND com='$c' ORDER BY fecha_ac";
      $buscarM = $conexion->query($queryyy);
      if ($buscarM->num_rows > 0) {
        while ($row = $buscarM->fetch_assoc()) {
          echo  '
          <div class="p-0 tab-pane fade show active">
          <div class="timeline timeline-border-dashed">
            <div class="timeline-item">
              <div class="timeline-line"></div>

              <!--begin::Timeline icon-->
              <div class="timeline-icon">
                <i class="'.($row['tipo_ac'] == 'Jornada' ? 'icon-size-fullscreen' : 'icon-size-actual').' fs-6 text-gray-500"></i>
              </div>
              <!--end::Timeline icon-->

              <div class="timeline-content mt-n1">
                <div class="pe-3 mb-3">
                  <div class="normalText fw-semibold mb-1">'.$vertices_j[$row['vertice']].' - '.$row['ente'].'</div>
                  <div class="d-flex align-items-center mt-1 fs-6">
                    <div class="text-gray-400 me-2 fs7">Agregado el: '.fechaCastellano(date('Y-m-d H:s a', $row['fecha_ac'])).'</div>


                    <i onclick="borrarTarea(\''.$row['id_acc'].'\', \'tarea\')" class="icon icon-trash fs-6"></i>


                  </div>
                </div>
                <div class="overflow-auto">


                  <table class="table table-borderless" style="width: 100%;">
                    <thead>
                      <tr>
                        <th style=" padding: 0; width: 75%"></th>
                        <th style=" padding: 0; width: 15%"></th>
                        <th style=" padding: 0; width: 5%"></th>
                        <th style=" padding: 0; width: 5%"></th>
                      </tr>
                    </thead>
                    <tbody>';


                    $stmt->bind_param("s", $row['id_acc']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                      while ($r = $result->fetch_assoc()) {
                        // tabla y proxima cantidad - formato 3 digitos minimo para la nom 000 - 23
                        echo '
                        <tr class="border border-dashed border-gray-300 rounded thisTable" style="background-color: #f0f2f5 !important;">

                        <td>
                          <span href="/metronic8/demo23/../demo23/apps/projects/project.html" class="text-dark text-hover-primary fw-semibold">'.$r['nombre'].'</span><br>
                          <span class="badge badge-light text-muted">'.fechaCastellano($r['fecha_ac']).'</span>
                        </td>

                        <td>';

                        switch ($r['status']) {
                          case '0':
                            echo '<span class="badge badge-light-primary">Pendiente</span>';
                            break;
                          
                          case '1':
                            echo '<span class="badge badge-light-success">Progreso</span>';
                            break;
                          
                          case '2':
                            echo '<span class="badge badge-light-danger">Ejecutado</span>';
                            break;

                        }


                        echo '
                        <td class="text-center">
                            <i onclick="borrarTarea(\''.$r['id_sc'].'\', \'accion\')" class="icon icon-trash"></i>
                        </td>
                        <td class="text-center">';
                            
                        if ($r['status'] != '2') {
                         echo ' <i onclick="setStatus(\''.$r['id_sc'].'\', \''.$r['status'].'\')" class="icon icon-refresh"></i>';
                        }
                       
                        echo '</td>
                      </tr>';
                      }
                      
                    } else {
                      echo ' <div class="text-gray-400 me-2 fs7">No hay ninguna acción registrada para esta tarea.</div>';
                    }




                    echo '
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>';



        }

        echo ' </tbody>
        </table>';
      }




    }elseif ($manejador == 'tareasDetalles') {
       
    $plan = $_POST["id_plan"];
    $c = $_POST["com"];



      $queryyy = "SELECT * FROM he_pa_acciones WHERE id_plan='$plan' AND com='$c' ORDER BY fecha_ac";
      $buscarM = $conexion->query($queryyy);
      if ($buscarM->num_rows > 0) {
        while ($row = $buscarM->fetch_assoc()) {
          echo '<div class="timeline-item" date-is="'.$row['fecha_ac'].'">';


          switch ($row['status']) {
            case '0':
              echo '<span class="btn-delete" > <i class="fa fa-exclamation-circle" ></i> Pendiente</span>';
              break;
            case '1':
              echo '<span class="btn-delete" > <i class="fa fa-clock-o" ></i> En proceso</span>';
              break;
            case '2':
              echo '<span class="btn-delete" > <i class="fa fa-check-circle" ></i> Ejecutado</span>';
              break;
          }


          
          echo '<p class="timeline-titulo">';

          echo ($row['tipo_ac'] == 'Jornada' ? '<i class="fa fa-star" style="color: "></i> ' : '<i class="fa fa-star" style="color: #ed5264"></i> ');

          echo $vertices_j[$row['vertice']].'</p>
          <p>
          '.$row['tipo_ac'].' - 
          <strong>Responsable: </strong> '.$row['ente'].' ('.$row['responsable'].' - '.$row['telefono'].'). ';
          echo ($row['tipo_ac'] == 'Jornada' ? '' : '<em>Personas atendidas: '.$row['impacto_ac'].'.</em>');
          echo '
          </p>
        </div>';
        }
      }



    
    }elseif ($manejador == 'uptT') {
      $st = $_POST["status"] + 1;
      $id = $_POST["id"];

      $stmt = $conexion->prepare("UPDATE `he_pa_sub_acciones` SET `status`= ? WHERE id_sc=?");
      $stmt->bind_param("ss", $st, $id);
      $stmt->execute();
      if ($stmt) {
        echo '1';
      }
      $stmt -> close();


    } 
  } 
}

?>