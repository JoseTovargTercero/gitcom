<?php
include('configuracion/conexionMysqli.php');


$cedula = $_POST["cedula"];
$nombre = $_POST["nombre"];
$fecha = $_POST["fecha"];
$telefono = $_POST["telefono"];
$edad = $_POST["edad"];
$sexo = $_POST["sexo"];
$instancia = $_POST["instancia"];
$grado = $_POST["grado"];
$profesion = $_POST["profesion"];
$institucion = $_POST["institucion"];
$cargo = $_POST["cargo"];
$tiempo = $_POST["tiempo"];
$edoCivil = $_POST["edoCivil"];
$correo = $_POST["correo"];
$militar = $_POST["militar"];
$activo = $_POST["activo"];
$rango = $_POST["rango"];
$direccion = $_POST["direccion"];
$mcp = $_POST["mcp"];
$pq = $_POST["pq"];
$estado = $_POST["estado"];
$estructura = $_POST["estructura"];
$media = $_POST["media"];
$base = $_POST["base"];


$partido = $_POST["partido"];
$cargo1 = $_POST["cargo1"];
$cargo2 = $_POST["cargo2"];
$cargo3 = $_POST["cargo3"];
$cargo4 = $_POST["cargo4"];
$cargo5 = $_POST["cargo5"];


$responsabilidad1 = $_POST["responsabilidad1"];
$responsabilidad2 = $_POST["responsabilidad2"];
$responsabilidad3 = $_POST["responsabilidad3"];
$responsabilidad4 = $_POST["responsabilidad4"];
$responsabilidad5 = $_POST["responsabilidad5"];


/*
$stmt = mysqli_prepare($conexion, "SELECT * FROM psuv WHERE cedula= ? LIMIT 1");
$stmt->bind_param("i", $cedula);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
  echo 'Y';
  exit();
}

*/


$stmt_aeras = $conexion->prepare("INSERT INTO psuv (
  cedula, 
  nombre, 
  fecha, 
  telefono, 
  edad, 
  sexo, 
  instancia, 
  grado, 
  profesion, 
  institucion, 
  cargo, 
  tiempo, 
  edoCivil, 
  correo, 
  militar, 
  activo, 
  rango, 
  direccion, 
  mcp, 
  pq, 
  estado, 
  estructura, 
  media, 
  base,
  partido,
  cargo1,
  cargo2,
  cargo3,
  cargo4,
  cargo5,
  responsabilidad1,
responsabilidad2,
responsabilidad3,
responsabilidad4,
responsabilidad5
  ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");


    
      $stmt_aeras->bind_param("sssssssssssssssssssssssssssssssssss", $cedula, $nombre, $fecha, $telefono, $edad, $sexo, $instancia, $grado, $profesion, $institucion, $cargo, $tiempo, $edoCivil, $correo, $militar, $activo, $rango, $direccion, $mcp, $pq, $estado, $estructura, $media, $base, $partido, $cargo1, $cargo2,$cargo3,$cargo4,$cargo5,
      $responsabilidad1, $responsabilidad2, $responsabilidad3, $responsabilidad4, $responsabilidad5); 
      $stmt_aeras->execute();

$stmt_aeras->close();







function cargarArchivo($archivo, $folder){
  global $cedula;
  foreach($_FILES[$archivo]['tmp_name'] as $key => $tmp_name){
    if($_FILES[$archivo]["name"][$key]) {
      $source = $_FILES[$archivo]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
      $directorio = $folder; //Declaramos un  variable con la ruta donde guardaremos los archivos
      if(!file_exists($directorio)){
        mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
      }
      $dir=opendir($directorio); //Abrimos el directorio de destino
      $target_path = $directorio.'/'.$cedula.'.png'; //Indicamos la ruta de destino, así como el nombre del archivo
      if(move_uploaded_file($source, $target_path)) {	
        echo 'ok';
        } else {	
        echo "no";
      }
      closedir($dir); //Cerramos el directorio de destino
    }
  }
}

cargarArchivo("foto", 'psuv_f/');


// retornar


?>