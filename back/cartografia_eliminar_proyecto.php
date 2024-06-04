<?php
include('../configuracion/conexionMysqli.php');
if ($_SESSION['nivel'] != '') {
include('../class/accionesSecundarias.php');
$proyecto = $_GET['id'];
$errores = 0;

if (!delete('proyectos', 'id', $proyecto) || !delete('proyectos_colaboradores', 'proyecto', $proyecto) || !delete('consultas_almacenadas', 'proyecto', $proyecto)) {
    $errores++;
}

echo $errores;
}
?>