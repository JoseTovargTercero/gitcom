    <?php
        include('../../configuracion/conexionMysqli.php');
      
        $codigoProyecto = $_POST["id"];

        $query66 = "SELECT * FROM consultas_almacenadas WHERE proyecto='$codigoProyecto'";
        $buscar66 = $conexion->query($query66);
        if ($buscar66->num_rows > 0) {
            echo '<ul class="ul-mp">';
            while ($row66 = $buscar66->fetch_assoc()) {
                $id = $row66['id'];
                echo '
                <li class="misProyectosMap" style="background: #c7c7c759;">
                    <div>'.$row66['nombreCapa'].' <br> <span class="text-xs">'.$row66['tipo'].'</span> </div>
                    <div>
                    <a onclick="deleteCapa(\''.$id.'\')" class="open-pr" style="color: #282828;"> <i class="fa fa-trash"></i></a>
                    </div>
                </li>
                ';
       
            }
            echo '</ul>';

        }
    ?>
