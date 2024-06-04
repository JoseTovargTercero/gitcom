<?php

$tipoCapaVectorial = $_POST['tipoCapaVectorial'];
$nameCapaVectorial = $_POST['nameCapaVectorial'];

$colorCap = $_POST['colorCapa'];
$colorBordeCapa = $_POST['colorBordeCapa'];



function eliminar_acentos($cadena){
		
	//Reemplazamos la A y a
	$cadena = str_replace(
	array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
	array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
	$cadena
	);

	//Reemplazamos la E y e
	$cadena = str_replace(
	array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
	array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
	$cadena );

	//Reemplazamos la I y i
	$cadena = str_replace(
	array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
	array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
	$cadena );

	//Reemplazamos la O y o
	$cadena = str_replace(
	array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
	array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
	$cadena );

	//Reemplazamos la U y u
	$cadena = str_replace(
	array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
	array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
	$cadena );

	//Reemplazamos la N, n, C y c
	$cadena = str_replace(
	array('Ñ', 'ñ', 'Ç', 'ç'),
	array('N', 'n', 'C', 'c'),
	$cadena
	);
	
	return $cadena;
}
$nameCapaVectorial = eliminar_acentos($nameCapaVectorial);

$pasos = 0;



foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name){
	if (substr($_FILES["archivo"]["name"][$key], -3) != 'dbf' && 
	substr($_FILES["archivo"]["name"][$key], -3) != 'prj' && 
	substr($_FILES["archivo"]["name"][$key], -3) != 'shp' && 
	substr($_FILES["archivo"]["name"][$key], -3) != 'shx') {
		define( 'PAGINA_INICIO', '../index.php' );
		header( 'Location: '.PAGINA_INICIO );
		// en caso de que se envie un archivos no valido 
		exit();
	}
	$pasos++;
}
	


$result = $pasos / 4;
if (is_float($result)) {
	define( 'PAGINA_INICIO', '../index.php' );
	header( 'Location: '.PAGINA_INICIO );
	// en caso de que falten archivos 

	exit();
}


//Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
	foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name){
		//Validamos que el archivo exista
		if($_FILES["archivo"]["name"][$key]) {
			$filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
			$source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
			
			$directorio = '../tempDocs/'; //Declaramos un  variable con la ruta donde guardaremos los archivos
			
			//Validamos si la ruta de destino existe, en caso de no existir la creamos
			if(!file_exists($directorio)){
				mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
			}
			
			$dir=opendir($directorio); //Abrimos el directorio de destino
			$target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo
			
			//Movemos y validamos que el archivo se haya cargado correctamente
			//El primer campo es el origen y el segundo el destino
			if(move_uploaded_file($source, $target_path)) {	
				echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
				} else {	
				echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
			}
			closedir($dir); //Cerramos el directorio de destino
		}
	}



		//Creamos el archivo
	$zip = new \ZipArchive();

	//abrimos el archivo y lo preparamos para agregarle archivos
	$zip->open("../capasCargadas/".$nameCapaVectorial.".zip", \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

	//indicamos cual es la carpeta que se quiere comprimir
	$origen = realpath('../tempDocs');

	//Ahora usando funciones de recursividad vamos a explorar todo el directorio y a enlistar todos los archivos contenidos en la carpeta
	$files = new \RecursiveIteratorIterator(
				new \RecursiveDirectoryIterator($origen),
				\RecursiveIteratorIterator::LEAVES_ONLY
	);

	//Ahora recorremos el arreglo con los nombres los archivos y carpetas y se adjuntan en el zip
	foreach ($files as $name => $file)
	{
	if (!$file->isDir())
	{
		$filePath = $file->getRealPath();
		$relativePath = substr($filePath, strlen($origen) + 1);

		$zip->addFile($filePath, $relativePath);
	}
	}

	//Se cierra el Zip
	$zip->close();

	
	
	$files = glob('../tempDocs/*'); //obtenemos todos los nombres de los ficheros
	foreach($files as $file){
		if(is_file($file))
		unlink($file); //elimino el fichero
	}
	

/** */

	include('../../../configuracion/conexionMysqli.php');
	
	$codigoProyecto = $_SESSION['proyecto'];

	echo $codigoProyecto;

	$query = $conexion->query("INSERT INTO shapes (origen, nombre, colorFill, colorStroke, fillOpacity, proyecto) VALUES  
                                              ('$nameCapaVectorial', '$nameCapaVectorial', '$colorCap', '$colorBordeCapa', '.25', '$codigoProyecto')"); 
											  
	define( 'PAGINA_INICIO', '../index.php' );
	header( 'Location: '.PAGINA_INICIO );
?>