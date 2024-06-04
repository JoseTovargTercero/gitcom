<?php
include('../configuracion/conexionMysqli.php');


if ($_POST['accion'] == 'add') {

$proyecto = $_POST['proyecto'];
$resultado = $_POST['resultado'];
$nombreCapa = $_POST['nombreCapa'];
$perso = $_POST['perso'];
$tipo = $_POST['tipo'];
$idUser = $_SESSION['id'];

$query = $conexion->query("INSERT INTO consultas_almacenadas (user, proyecto, nombreCapa, consulta, tipo, icono) VALUES  
                                                    ('$idUser', '$proyecto', '$nombreCapa', '$resultado', '$tipo', '$perso')"); 
}elseif ($_POST['accion'] == 'del') {

    

}

?>

