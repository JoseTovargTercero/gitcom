    <?php
    include('../../configuracion/conexionMysqli.php');
    $consulta2 = str_replace('"', "*", $_POST['consulta']);
    $cantidad = 0; 
       
    if ('casas' == 'casas') {
        $consulta = str_replace('"', "'", $_POST['consulta']);
        $query = "SELECT * FROM inf_casas WHERE $consulta LIMIT 20";
        $search = $conexion->query($query);
        if ($search->num_rows > 0) {
            echo '
            <div class="fadeInUp animated">
            <label style="width:100%">Resultado de la consulta
            <a style="float: right; margin-right: 32px;" href="reportes/reporteXlsx.php?consulta='.$consulta2.'/casas">Generar archivo XLSX de esta consulta</a>
            </label><br><br>
            
            <div class="table-responsive">

            <table id="datatable-responsive" class="table align-items-center mb-0" style="width:100%">
                <thead>
                    <tr>
                        <th text-uppercase text-secondary text-xxs font-weight-bolder opacity-7>#</th>
                        <th text-uppercase text-secondary text-xxs font-weight-bolder opacity-7>Vivienda</th>
                        <th text-uppercase text-secondary text-xxs font-weight-bolder opacity-7>Tipo</th>
                        <th text-uppercase text-secondary text-xxs font-weight-bolder opacity-7>Calle</th>
                        <th text-uppercase text-secondary text-xxs font-weight-bolder opacity-7>Responsable</th>
                        </th>
                    </tr>
                </thead>
        
                <tbody>';
            while ($row = $search->fetch_assoc()) {
                $cantidad++;
                
                echo '
                <tr>
                <td>' . $cantidad . '</td>
                <td>' . $row['id_vivienda'] . '</td>
                <td>' . $row['tipo'] . '</td>
                <td>' . $row['jefe_calle'] . '</td>
                <td>' . $row['cod_situr'] . '</td></tr>';
    
           
            }
            echo ' </tbody>
            </table>
            </div>
        </div>';
        }else {
            echo '<div style="display: grid;place-items: center;">
            <br><br><br><i style="font-size: 6rem; color: #dcdcdc;" class="zmdi zmdi-pin-off"></i><br>
            <p>No se encontraron resultados!</p>
            <span><strong  style="color: gray">Pruebe </strong> a cambiar el metodo de busqueda</div></span><br><br>';
        }
    } else {

        $reultadoArray = array();
        $consulta = str_replace('"', "'", $_POST['consulta']);
        
        $explode = explode('/', $consulta);

        if (count($explode) == 2) {
            $consulta = $explode[0];
            $campoContar = $explode[1];
        }
        

        $query = "SELECT * FROM inf_habitantes WHERE $consulta";
        $search = $conexion->query($query);
        if ($search->num_rows > 0) {
            echo '
            <div class="fadeInUp animated">
            <label style="width:100%">Resultado de la consulta
            <a style="float: right; margin-right: 32px;" href="reportes/reporteXlsx.php?consulta='.$consulta2.'/personas">Generar archivo XLSX de esta consulta</a>
            </label><br><br>
            
            <div class="table-responsive">

            <table id="datatable-responsive" class="table align-items-center mb-0" style="width:100%">
                <thead>
                    <tr>
                        <th text-uppercase text-secondary text-xxs font-weight-bolder opacity-7>Concejo Comunal</th>
                        <th text-uppercase text-secondary text-xxs font-weight-bolder opacity-7>Vivienda</th>
                        <th text-uppercase text-secondary text-xxs font-weight-bolder opacity-7>Nombre</th>
                        <th text-uppercase text-secondary text-xxs font-weight-bolder opacity-7>Cedula</th>
                        <th text-uppercase text-secondary text-xxs font-weight-bolder opacity-7>telefono</th>
                        </th>
                    </tr>
                </thead>
        
                <tbody>';

            while ($row = $search->fetch_assoc()) {
               echo '
               <tr>
                    <td>'.$row['id_vivienda'].'</td>
                    <td>'.$row['id_vivienda'].'</td>
                    <td>'.$row['nombre'].'</td>
                    <td>'.$row['cedula'].'</td>
                    <td>'.$row['telefono'].'</td>
               </tr>
               ';
            }
               echo '
                </tbody>
            </table>
            </div>
        </div>';



        }else {
            echo '<div style="display: grid;place-items: center;">
            <br><br><br><i style="font-size: 6rem; color: #dcdcdc;" class="zmdi zmdi-pin-off"></i><br>
            <p>No se encontraron resultados!</p>
            <span><strong  style="color: gray">Pruebe </strong> a cambiar el metodo de busqueda</div></span><br><br>';
        }
   
    }
    ?>
 