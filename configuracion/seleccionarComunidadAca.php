<?php
include('conexionMysqli.php');

$municipio_id  = strip_tags( addslashes( $_POST['municipio_id'] ) );
$continente_id = strip_tags( addslashes( $_POST['continente_id'] ) );
$pais_id = strip_tags( addslashes( $_POST['pais_id'] ) );
$ciudad_id = strip_tags( addslashes( $_POST['ciudad_id'] ) );

if ($ciudad_id == '') {
  $ciudad_id = '0';
}


if($municipio_id == "" || $continente_id == "" || $pais_id == ""){
    
  $_SESSION['notificacion'] = "faltan_datos";
    define( 'PAGINA_RETORNO', '../pages/listaAca.php' );
    header( 'Location: '.PAGINA_RETORNO ); 

}else{

  $_SESSION['municipio_id'] = $municipio_id;
  $_SESSION['continente_id'] = $continente_id;
  $_SESSION['pais_id'] = $pais_id;
  $_SESSION['ciudad_id'] = $ciudad_id;


  if ($_GET['origen'] == 'aca') {
    define( 'PAGINA_RETORNO', '../pages/nuevoAca.php' );
    header( 'Location: '.PAGINA_RETORNO );
  }else {
    define( 'PAGINA_RETORNO', '../pages/mapa/index.php' );
    header( 'Location: '.PAGINA_RETORNO );
  }

}
?>

