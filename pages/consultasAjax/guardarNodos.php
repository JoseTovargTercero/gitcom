    <?php
    include('../../configuracion/conexionMysqli.php');
    

    $nodos = $_POST['nodos'];
    $vinculosI = $_POST['vinculosI'];
    $id = $_POST['id'];


    $insertar = "INSERT INTO aca_graficos (nodos, edges, problema) VALUES ('$nodos','$vinculosI','$id')";
	$resut = mysqli_query( $conexion, $insertar );    

    


    ?>
 