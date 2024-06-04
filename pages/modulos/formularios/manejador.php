<?php 

include('../../../configuracion/conexionMysqli.php');

function fechaCastellano($fecha){
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  // $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
  $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombredia . " " . $numeroDia . " de " . $nombreMes . " del " . $anio;
}
function nameMonth($mes){
  $meses_ES = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  return $meses_ES[$mes];
}

    $stmt = mysqli_prepare($conexion, "SELECT * FROM temp_caracterizacion_empresas WHERE id= ?");
    $stmt->bind_param("s", $_POST['registro']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      while ($r = $result->fetch_assoc()) {
        $actividad = '';

        if ($r['prod_bienes'] == 'Si') {$actividad .= ' Producción de bienes.';}
        if ($r['dist_bienes'] == 'Si') {$actividad .= ' Distribución de bienes.';}
        if ($r['com_bienes'] == 'Si') {$actividad .= ' Comercialización de bienes.';}
        if ($r['pres_servicios'] == 'Si') {$actividad .= ' Prestación de servicios.';}
        

        if ($r['sis_facturacion'] == 'NO') {
            $sis_facturacion = ' </span> <span class="badge badge-light-primary">No posee</span>';
        }elseif ($r['sis_facturacion'] == 'Manual') {
            $sis_facturacion = ' </span> <span class="badge badge-light-success">Manual</span>';
        }else {
            $sis_facturacion = ' </span> <span class="badge badge-light-danger">Sistema Automatizado</span>';
        }



        if ($r['sis_invetario'] == 'NO') {
            $sis_invetario = ' </span> <span class="badge badge-light-primary">No posee</span>';
        }elseif ($r['sis_invetario'] == 'Manual') {
            $sis_invetario = ' </span> <span class="badge badge-light-success">Manual</span>';
        }else {
            $sis_invetario = ' </span> <span class="badge badge-light-danger">Sistema Automatizado</span>';
        }


        if ($r['sis_asociados'] == 'NO' || $r['sis_asociados'] == 'No aplica') {
            $sis_asociados = ' </span> <span class="badge badge-light-primary">No</span>';
        }else {
            $sis_asociados = ' </span> <span class="badge badge-light-danger">Si</span>';
        }


        if ($r['prod_bienes'] == 'Si' || $r['dist_bienes'] == 'Si' || $r['com_bienes'] == 'Si') {
            $actividad .= ' Producción de bienes.';
        }

        $archivo = '<hr><span class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2"> <span class="text-gray-400 ">Archivo de inventario: </span> <a class="text-primary"  target="_blank"  href="../../../empresas/files/'.$r['id'].'_'.$r['file'].'">Descargar archivo</a> </span> <br>';



          echo '<div class="d-flex flex-stack position-relative mt-4">
          <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
          <div class="fw-semibold ms-5 text-gray-600">
            <span class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2"> <span class="text-gray-400">Empresa: </span>  '.$r['empresa'].'</span> <br>
            <span class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2"> <span class="text-gray-400">Actividad economica: </span> <span class="text-primary" href="#">'.$actividad.'</span></span> <br>
            <span class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2"> <span class="text-gray-400">Servicios que presta: </span> '.$r['servicios_presta'].' </span>  <br>
            
            <span class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2"> <span class="text-gray-400">Sistema de facturacion: '.$sis_facturacion.' </span> <br>
            <span class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2"> <span class="text-gray-400">Sistema de inventario: '.$sis_invetario.' </span> <br>
            <span class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2"> <span class="text-gray-400">Conexión inventario-facturación: '.$sis_asociados.' </span> <br>
         
            <span class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2"> <span class="text-gray-400">Fecha del registro: </span>  '.fechaCastellano($r['fecha']).' - '.date('H:i a', strtotime($r['fecha'])).'</span> <br>
            '.$archivo.'
           
           
            </div>
        </div>';
      }
    }
?>