    <?php
        include('../../configuracion/conexionMysqli.php');
        
        
        $consulta2 = str_replace('"', "*", $_POST['consulta']);
        $cantidad = 0; 

        $consulta = str_replace('"', "'", $_POST['consulta']);


        
        $query = "SELECT * FROM inf_casas WHERE $consulta";
        $search = $conexion->query($query);
        if ($search->num_rows > 0) {
            while ($row = $search->fetch_assoc()) {
                 $cantidad++;
            }
           echo "Se encontraron <strong>$cantidad</strong> resultados.<br>";
        }else {
            echo 'No se encontraron resultados (0 filas devueltas)';
        }
 /*

 <div class='mt-3'>

           <button class='btn btn-danger' onclick='verResult()'>Ver resultados</button>
           <button class='btn btn-success' onclick='guardarResultados()'>Guardar resultados</button>

           </div>

 */
 
 ?>
 