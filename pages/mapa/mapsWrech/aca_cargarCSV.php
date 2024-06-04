<?php
include('../../../configuracion/conexionMysqli.php');


$id = $_POST['aca'];
$nameCapaVectorial = $_POST['nameCapaVectorial'];

if ((isset($_FILES['photo']['name']) && ($_FILES['photo']['error'] == UPLOAD_ERR_OK))){
    $ruta_destino = "respaldoArchivosCsv/archivo_".$id.".csv";
    move_uploaded_file( $_FILES['photo']['tmp_name'], $ruta_destino );
}

$linea = 1;

$file = fopen('respaldoArchivosCsv/archivo_'.$id.'.csv', "r");
    while(($datos = fgetcsv($file, ",")) == true){

            $datos3 = $datos[0];
            $datos2 = explode(',', $datos3);

            $status = str_replace(',', '', $datos[0]);
            $latitud =  str_replace(',', '', $datos[2]); 
            $longitud = str_replace(',', '', $datos[3]);
            $valido = 'Si';

            if ($linea != 1) {
                $conexion->query("INSERT INTO postes (capa, status, lng, ltd, aca) VALUES ('$nameCapaVectorial', '$status','$longitud','$latitud', '$id')");
            }

            $linea += 1;
    }

?>


<script>
    window.history.go(-1);
</script>