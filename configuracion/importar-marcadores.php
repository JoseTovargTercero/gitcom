<?php
include('conexionMysqli.php');
include('../class/count.php');
error_reporting(0);
	$mcp = $_POST['mcp'];
	$pq = $_POST['pq'];
	$com = $_POST['com'];
	$comd = $_POST['comdad'];

	function cargarArchivo($archivo, $folder){
    global $comd;
	
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
			$target_path = $directorio.'/'.$comd.'.csv'; //Indicamos la ruta de destino, así como el nombre del archivo
			//Movemos y validamos que el archivo se haya cargado correctamente
			//El primer campo es el origen y el segundo el destino
			if(move_uploaded_file($source, $target_path)) {	
			//	echo 'ok. ';
				} else {	
			//	echo "no. ";
			}
			closedir($dir); //Cerramos el directorio de destino
		}
	}
}

cargarArchivo("csv", 'marcadores/');




function getName($var){
	return 'No disponible';
}



$data = '';
	//// LEER EL ARCHIVO CSV E INSERTAR LOS DATOS EN LA BD PORVICIONAL
	$file = fopen('marcadores/'.$comd.'.csv', "r");
while(($datos = fgetcsv($file, ",")) == true){
	array_push($datos, getName($datos[0]));
	$data .= json_encode($datos).'~';
}


$data = substr($data, 0, -1);
echo $data;
/*
	$base_dir = realpath($_SERVER["DOCUMENT_ROOT"]);

    if (unlink($base_dir.'/gitcom_fork/configuracion/marcadores/'.$comd.'.csv')) {
    }*/
?>