    <?php
    include('../conexionBd/conexion.php');

            $gjso = $_POST['gjso'];
            $color = $_POST['color'];
            $id = $_POST['id'];
   
            $query = "UPDATE aca_mapa SET geojson='$gjso', color='$color' WHERE id='$id'";
            $result = $conexion->query($query);
            