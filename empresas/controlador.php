<?php
include("../configuracion/conexionMysqli.php");


	$fecha = date('d-m-Y H:i:s a');
	$empresa = $_POST["emp"];
	
	$prod_bienes = $_POST["i_prod_bienes"];
	$dist_bienes = $_POST["i_dist_bienes"];
	$com_bienes = $_POST["i_com_bienes"];
	$pres_servicios = $_POST["i_pres_servicios"];
	
	$servicios_presta = $_POST["servicios_presta"];
	$sis_facturacion = $_POST["sis_facturacion"];
	$sis_invetario = $_POST["sis_invetario"];
	$sis_asociados = $_POST["sis_asociados"];

	if ($servicios_presta == '') {$servicios_presta = 'Ninguno';}
	if ($sis_asociados == '') {$sis_asociados = 'No aplica';}




	foreach($_FILES["inventario"]['tmp_name'] as $key => $tmp_name){

		if($_FILES["inventario"]["name"][$key]) {
			$filename = $_FILES["inventario"]["name"][$key]; //Obtenemos el nombre original del archivo
		}
	}








	$stmt = $conexion->prepare("INSERT INTO temp_caracterizacion_empresas (fecha, empresa, prod_bienes, dist_bienes, com_bienes, pres_servicios, servicios_presta, sis_facturacion, sis_invetario, sis_asociados, file) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("sssssssssss", $fecha, $empresa, $prod_bienes, $dist_bienes, $com_bienes, $pres_servicios, $servicios_presta, $sis_facturacion, $sis_invetario, $sis_asociados, $filename); 
	$stmt->execute();
	$id = $conexion->insert_id;
	$stmt -> close();




	function cargarArchivo($archivo, $folder){
    global $id;
    global $empresa;
	
	//Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
	foreach($_FILES[$archivo]['tmp_name'] as $key => $tmp_name){
		//Validamos que el archivo exista
		if($_FILES[$archivo]["name"][$key]) {
			//$filename = $_FILES[$archivo]["name"][$key]; //Obtenemos el nombre original del archivo
			$source = $_FILES[$archivo]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
			$directorio = $folder; //Declaramos un  variable con la ruta donde guardaremos los archivos
			//Validamos si la ruta de destino existe, en caso de no existir la creamos
			if(!file_exists($directorio)){
				mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
			}
			$dir=opendir($directorio); //Abrimos el directorio de destino
			$target_path = $directorio.'/'.$id.'_'.$_FILES[$archivo]["name"][$key]; //Indicamos la ruta de destino, así como el nombre del archivo

			move_uploaded_file($source, $target_path);
			closedir($dir); //Cerramos el directorio de destino
		}
	}
}

cargarArchivo("inventario", 'files/');


echo 's';
?>