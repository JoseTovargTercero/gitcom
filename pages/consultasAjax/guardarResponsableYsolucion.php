    <?php
    include('../../configuracion/conexionMysqli.php');
    

    $financiero = $_POST['financiero'];
    $acompanante = $_POST['acompanante'];
    $solucion = $_POST['solucion'];
    $adquirir = $_POST['adquirir'];
    $id = $_POST['id'];

    $query = "UPDATE aca_resultado SET soluciones='$solucion', financiador='$financiero', ejecutor='$acompanante', insumos='$adquirir' WHERE id='$id'";
    $result = $conexion->query($query);



    


    ?>
 