    <?php
    include('../../configuracion/conexionMysqli.php');
    // header json
    header('Content-Type: application/json');

    $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : null;
    $comunidad  = $_SESSION['dato1'];


    if ($cedula != '') {
      /* CEDULA:
        si recibe una cedula, se realiza una consulta a la lista de habitantes, se toma el id de la   vivienda, se consulta la vivienda y todos sus integrantes
      */
      $data = [];

      $stmt = mysqli_prepare($conexion, "SELECT * FROM `inf_habitantes` WHERE cedula = ? AND id_c_comunal = ?");
      $stmt->bind_param('ss', $cedula, $comunidad);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $vivienda = $row['id_vivienda'];
        }
      }
      $stmt->close();

      $stmt = mysqli_prepare($conexion, "SELECT * FROM `inf_casas` WHERE id_vivienda = ?");
      $stmt->bind_param('s', $vivienda);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $data[$vivienda] = [
            "casa" => [$row['id'], $row['id_vivienda']],
            "habitantes" => []
          ];
        }
      }
      $stmt->close();
      $stmt = mysqli_prepare($conexion, "SELECT * FROM `inf_habitantes` WHERE
      id_vivienda = ?");
      $stmt->bind_param('s', $vivienda);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

          $fecha = $row['fecha']; // Puede ser datetime, vacío o null

          if (empty($fecha) || is_null($fecha)) {
            $actualizado = 0;
          } else {
            $fecha_obj = new DateTime($fecha);
            $fecha_actual = new DateTime();
            $diferencia = $fecha_obj->diff($fecha_actual);

            $actualizado = ($diferencia->m + ($diferencia->y * 12) > 3) ? 0 : 1;
          }

          $row['actualizado'] = $actualizado;

          $data[$vivienda]["habitantes"][] = $row;
        }
      }
      $stmt->close();

      echo json_encode($data, JSON_PRETTY_PRINT);
    } else {
      /* LISTA:
      si no recibe nada, se realiza una consulta general a las viviendas y a los habitantes
      */

      $data = [];

      $stmt = mysqli_prepare($conexion, "SELECT * FROM `inf_casas` WHERE id_c_comunal = ?  ");
      $stmt->bind_param('s', $comunidad);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $data[$row['id_vivienda']] = [
            "casa" => [$row['id'], $row['id_vivienda']],
            "habitantes" => []
          ];
        }
      }
      $stmt->close();
      $stmt = mysqli_prepare($conexion, "SELECT * FROM `inf_habitantes` WHERE
      id_c_comunal = ? ORDER BY id_familia, id");
      $stmt->bind_param('s', $comunidad);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

          $fecha = $row['fecha']; // Puede ser datetime, vacío o null

          if (empty($fecha) || is_null($fecha)) {
            $actualizado = 0;
          } else {
            $fecha_obj = new DateTime($fecha);
            $fecha_actual = new DateTime();
            $diferencia = $fecha_obj->diff($fecha_actual);

            $actualizado = ($diferencia->m + ($diferencia->y * 12) > 3) ? 0 : 1;
          }

          $row['actualizado'] = $actualizado;
          $data[$row['id_vivienda']]["habitantes"][] = $row;
        }
      }
      $stmt->close();

      echo json_encode($data, JSON_PRETTY_PRINT);
    }



    /*
    $stmt = mysqli_prepare($conexion, "SELECT * FROM `go_planes` WHERE ano = ?");
    $stmt->bind_param('s', $var);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
      }
    }
    $stmt->close();

*/






    ?>
 