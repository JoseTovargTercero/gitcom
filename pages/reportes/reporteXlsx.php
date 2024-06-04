<?php

/** Error reporting */
error_reporting(0);
include('../../configuracion/conexionMysqli.php');
$post = explode('/', $_GET['consulta'])[0];
$tipo = explode('/', $_GET['consulta'])[1]; 


if ($tipo == 'personas') {
    $tabla = 'inf_habitantes.';    
}else {
    $tabla = 'inf_casas.';    
}

$consulta = '';

function replaceConsulta($var, $consultaParam){
global $tabla;
$estado = '';

$arrayConstulta = explode($var, $consultaParam); 
$posicion_coincidencia = strpos($consultaParam, $var);

if ($posicion_coincidencia === false) {
    return $consultaParam;
}else{

    foreach ($arrayConstulta as $value) {
        $estado .= $tabla.$value.$var;
    }
    if ($var == ' OR ') {
        return substr($estado, 0 , -4);
    }else {
        return substr($estado, 0 , -5);
    }
}

}

$arrayConstulta = trim($post); 

$consulta =  replaceConsulta(' OR ', $post);
$consulta =  replaceConsulta(' AND ', $consulta);
$consulta = str_replace('*', "'", $consulta);


$contador = 1;
$rowA = 9;
$rowB = 9;
$rowC = 9;
$rowD = 9;
$rowE = 9;
$rowF = 9;
$rowG = 9;
$rowH = 9;
$rowI = 9;
$rowJ = 9;
$rowK = 9;
$rowL = 9;


require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';
$objReader = PHPExcel_IOFactory::createReader('Excel5');

if ($tipo == 'personas') {
    $objPHPExcel = $objReader->load("PHPExcel/Examples/templates/templateConsutlaXlsxPersonas.xls");
}else {
        $objPHPExcel = $objReader->load("PHPExcel/Examples/templates/templateConsutlaXlsx.xls");
    }

// Set document properties
$objPHPExcel->getProperties()->setCreator("GITCOM Amazonas")
							 ->setLastModifiedBy("GITCOM Amazonas")
							 ->setKeywords("GITCOM")
							 ->setCategory("Reportes gitcom");





$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A2', ucwords(mb_strtolower('GITCOM')))
->setCellValue('A4', ucwords(mb_strtolower('GESTION DE INFORMACION TERRITOIAL COMUNAL')))
->setCellValue('A6', ucwords(mb_strtolower('')));





class MiBD extends SQLite3{
    function __construct(){
        $this->open('../../db/bd_concejos.db');
    }
}
$bd = new MiBD();

$query = $bd->query("select * from local_c_comunales");
$states = array();
while ($r = $query->fetchArray()) {
    $states[$r[8]] = $r[1];
}


if ($tipo == 'personas') {


    $query = "SELECT * FROM inf_habitantes
    LEFT JOIN local_parroquia ON local_parroquia.id_parroquias = inf_habitantes.id_parroquia
    LEFT JOIN local_comunas ON local_comunas.id_Comuna = inf_habitantes.id_comuna
     WHERE $consulta";
    $search = $conexion->query($query);
    if ($search->num_rows > 0) {
        while ($row = $search->fetch_assoc()) {
    
            
            $comunidad = $row['id_c_comunal'];

        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$rowA++, $cantidad++)
        ->setCellValue('B'.$rowB++, 'AMAZONAS')
        ->setCellValue('C'.$rowC++, 'ATURES')
        ->setCellValue('D'.$rowD++, $row['nombre_parroquia'])
        ->setCellValue('E'.$rowE++, $row['nombre_comuna'])
        ->setCellValue('F'.$rowF++, $states[$comunidad])
        ->setCellValue('G'.$rowH++, $row['id_vivienda'])
        ->setCellValue('H'.$rowI++, $row['cedula'])
        ->setCellValue('I'.$rowJ++, $row['nombre'])
        ->setCellValue('J'.$rowK++, $row['telefono'])
        ->setCellValue('K'.$rowL++, $row['coordenada_este'].'-'.$row['coordenada_norte']);



        }
    }



}else{
$jefesFamilia = array();
$query2 = "SELECT * FROM inf_habitantes WHERE rol_familiar='JEFE DE FAMILIA'";
$search2 = $conexion->query($query2);
if ($search2->num_rows > 0) {
    while ($row2 = $search2->fetch_assoc()) {
        $jefesFamilia[$row2['id_vivienda']] = array($row2['nombre'], $row2['cedula'], $row2['telefono']);
    }
}

$cantidad = 1;

$query = "SELECT * FROM inf_casas
LEFT JOIN local_parroquia ON local_parroquia.id_parroquias = inf_casas.id_parroquia
LEFT JOIN local_comunas ON local_comunas.id_Comuna = inf_casas.id_comuna
 WHERE $consulta";
$search = $conexion->query($query);
if ($search->num_rows > 0) {
    while ($row = $search->fetch_assoc()) {
        
        $comunidad = $row['id_c_comunal'];

        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$rowA++, $cantidad++)
        ->setCellValue('B'.$rowB++, 'AMAZONAS')
        ->setCellValue('C'.$rowC++, 'ATURES')
        ->setCellValue('D'.$rowD++, $row['nombre_parroquia'])
        ->setCellValue('E'.$rowE++, $row['nombre_comuna'])
        ->setCellValue('F'.$rowF++, $states[$comunidad])
        ->setCellValue('G'.$rowG++, $row['jefe_calle'])
        ->setCellValue('H'.$rowH++, $row['id_vivienda'])
        ->setCellValue('I'.$rowI++, $jefesFamilia[$row['id_vivienda']][1])
        ->setCellValue('J'.$rowJ++, $jefesFamilia[$row['id_vivienda']][0])
        ->setCellValue('K'.$rowK++, $jefesFamilia[$row['id_vivienda']][2])
        ->setCellValue('L'.$rowL++, $row['coordenada_este'].'-'.$row['coordenada_norte']);

   
    }
}

}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('GITCOM');

$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="GITCOM - '.date('Y_m_d h-i a').'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');