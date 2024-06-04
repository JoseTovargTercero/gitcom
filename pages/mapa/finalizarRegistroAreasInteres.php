<?php

include('../../configuracion/conexionMysqli.php');

unset($_SESSION['municipio_id']);
unset($_SESSION['continente_id']);
unset($_SESSION['pais_id']);
unset($_SESSION['ciudad_id']);

define( 'PAGINA_INICIO', 'index.php' );
header( 'Location: '.PAGINA_INICIO );

?>