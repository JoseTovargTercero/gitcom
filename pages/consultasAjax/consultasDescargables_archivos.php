    <?php
    include('../../configuracion/conexionMysqli.php');

    $codigo = $_POST["c"];

    $query = "SELECT * FROM reportes WHERE proyecto='$codigo'";
    $search = $conexion->query($query);
    if ($search->num_rows > 0) {
      echo '    <div class="row">';

      while ($row = $search->fetch_assoc()) {
        echo '
               <div class="col-md-6 col-xl-3 ">
               <div class="card h-100 ">
                 <div class="card-body d-flex justify-content-center text-center flex-column p-4">';
        if ($row['formato'] == '1') {
          $accion = 'href="consultasAjax/consultasDescargables_reporte.php?i=' . $row['id'] . '"';
        } else {
          $accion = 'onclick="imprimir(\'' . $row['id'] . '\')"';
        }

        echo '<a ' . $accion . ' class="text-gray-800 text-hover-primary d-flex flex-column">  
                 <div class="symbol symbol-60px mb-3">';
        if ($row['formato'] == '1') {
          echo '<img src="../assets/img/xls.png" class="theme-dark-show" alt="">';
        } else {
          echo '<img src="../assets/img/pdf.svg" class="theme-dark-show" alt="">';
        }
        echo '</div>
                     <div class="fs-6 fw-bold mb-1" style="color: #4B5675">
                       ' . $row['nombreArchivo'] . '
                     </div>
                   </a>
                   <div class="fs-7 fw-semibold text-gray-400" style="font-size: 13px;">
                   ' . Date('Y-m-d H:s a', $row['ultimoCambio']) . '
                    </div>
                 </div>
               </div>
             </div>
               ';
      }
      echo '</div>';
    } else {
      echo '<div style="display: grid;place-items: center;">
            <br><br><br><i style="font-size: 6rem; color: #dcdcdc;" class="zmdi zmdi-pin-off"></i><br>
            <p>No se encontraron archivos <i class="fa fa-frown-o"></i></p>
            <span>Pruebe a <strong  style="color: gray">crear uno nuevo!</strong></div></span><br><br>';
    }

    ?>
 