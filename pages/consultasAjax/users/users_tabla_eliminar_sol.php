    <?php
    include('../../../configuracion/conexionMysqli.php');
       
    if ($_SESSION['nivel'] == 1) {


        $id = $_GET['id'];

        $sql = "DELETE FROM sist_solicitudes_acceso WHERE id = ?";
        $resultado = $conexion->prepare($sql);
        $resultado->bind_param('s', $id);
        $resultado->execute();
        if ($resultado) {
            echo 1;
        }
        $resultado->close();
    }
    ?>
 