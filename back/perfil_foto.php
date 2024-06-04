<?php
include('../configuracion/conexionMysqli.php');

if ($_SESSION["nivel"] != '') {

	function cargarArchivo($archivo, $folder){
		$id = $_SESSION["id"];
		foreach($_FILES[$archivo]['tmp_name'] as $key => $tmp_name){
			if($_FILES[$archivo]["name"][$key]) {
				$source = $_FILES[$archivo]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
				$directorio = $folder; //Declaramos un  variable con la ruta donde guardaremos los archivos
				if(!file_exists($directorio)){
					mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
				}
				$dir=opendir($directorio); //Abrimos el directorio de destino
				$target_path = $directorio.'/'.$id.'.png'; //Indicamos la ruta de destino, así como el nombre del archivo
				if(move_uploaded_file($source, $target_path)) {	
					echo 'ok';
					} else {	
					echo "no";
				}
				closedir($dir); //Cerramos el directorio de destino
			}
		}
	}
	
	cargarArchivo("foto", '../assets/img/user-pictures/');


}else {
	echo 'error_i';
}
