    <?php
    include('../../configuracion/conexionMysqli.php');
       
    if ($_SESSION['darkMode'] == 1) {
        $setMode = 0;
    }else {
        $setMode = 1;
    }



    $id = $_SESSION['id'];

    $sql = "UPDATE sist_usuarios SET darkMode = ? WHERE id = ?";
    $resultado = $conexion->prepare($sql);
    $resultado->bind_param('ii', $setMode, $id);
    $resultado->execute();
    $resultado->close();

    $_SESSION['darkMode'] = $setMode;
    echo $setMode;
   
    ?>
 