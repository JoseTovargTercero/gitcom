<?php
    include('../../configuracion/conexionMysqli.php');
       
    $comuna = $_POST['comuna'];

    $query = "SELECT * FROM local_comunidades WHERE id_comuna='$comuna'";
    $search = $conexion->query($query);
    if ($search->num_rows > 0) {

        echo '	
        
        <div class="table-responsive p-0  animated fadeInUp" style="overflow-x: auto !important;">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs">Comunidad</th>
              <th class="text-uppercase text-secondary text-xxs">Estatus</th>
              <th class="text-uppercase text-secondary text-xxs">Ultima Actualizaci贸n</th>
            </tr>
          </thead>
          <tbody>

        ';


        while ($row = $search->fetch_assoc()) {
            

            echo "<tr><td>".$row['nombre_c_comunal']."</td>";
                
                if($row['status'] == 1){
                    
                    echo '<td><i class="fa fa-check"></i></td>';
                }else if($row['status'] == 2){
                    
                          echo '<td>Fase 1</td>';
                }else{
                          echo '<td>Pendiente</td>';
                }
                
                
                
                
            echo "
                <td>".$row['ultimocambio']."</td>
            </tr>";
        }
      
      
        echo '   </tbody>
        </table>
      </div>';



        }
    
    ?>
 