<?php
$id = $_GET['id'];
if ($id != '') {
    define('PAGINA_INICIO', '../datosPersona.php?id='.$id);
    header('Location: ' . PAGINA_INICIO);
}
?>