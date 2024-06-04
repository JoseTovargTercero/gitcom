<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="description" content="Gitcom es una herramienta geo-espacial que facilita la recolección de información cartográfica y su posterior análisis">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="assets/img/3-SF.png">
  <script src="assets/js/sweetalert2.all.min.js"></script>
  <title>GITCOM</title>
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="assets/css/core.css">
  <link rel="stylesheet" href="assets/css/inicio.css">
  </link>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
</head>






<?php 


/*



$conexion = new mysqli('localhost', $usuario, $contrasena, $baseDeDatos); 
$conexion->set_charset('utf8'); 

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}


error_reporting(0);
date_default_timezone_set('America/Manaus');
session_start();


$stmt = mysqli_prepare($conexion, "SELECT * FROM system WHERE id='1' AND maintenance='1'");
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
  echo '<svg viewBox="0 0 100 100">
	<g fill="none" stroke="#d64757 " stroke-linecap="round" stroke-linejoin="round" stroke-width="6">
		<!-- left line -->
		<path d="M 21 40 V 59">
			<animateTransform
      attributeName="transform"
      attributeType="XML"
      type="rotate"
      values="0 21 59; 180 21 59"
      dur="2s"
      repeatCount="indefinite" />
		</path>
		<!-- right line -->
		<path d="M 79 40 V 59">
			<animateTransform
      attributeName="transform"
      attributeType="XML"
      type="rotate"
      values="0 79 59; -180 79 59"
      dur="2s"
      repeatCount="indefinite" />
		</path>
		<!-- top line -->
		<path d="M 50 21 V 40">
			<animate
      attributeName="d"
      values="M 50 21 V 40; M 50 59 V 40"
      dur="2s"
      repeatCount="indefinite" />
		</path>
		<!-- btm line -->
		<path d="M 50 60 V 79">
			<animate
      attributeName="d"
      values="M 50 60 V 79; M 50 98 V 79"
      dur="2s"
      repeatCount="indefinite" />
		</path>
		<!-- top box -->
		<path d="M 50 21 L 79 40 L 50 60 L 21 40 Z">
		<animate
      attributeName="stroke"
      values="#d64757; rgba(100,100,100,0)"
      dur="2s"
      repeatCount="indefinite" />
		</path>
		<!-- mid box -->
		<path d="M 50 40 L 79 59 L 50 79 L 21 59 Z"/>
		<!-- btm box -->
		<path d="M 50 59 L 79 78 L 50 98 L 21 78 Z">
		<animate
      attributeName="stroke"
      values="rgba(100,100,100,0); #d64757"
      dur="2s"
      repeatCount="indefinite" />
		</path>
		<animateTransform
      attributeName="transform"
      attributeType="XML"
      type="translate"
      values="0 0; 0 -19"
      dur="2s"
      repeatCount="indefinite" />
	</g>
</svg>
<p style="margin: auto;margin-bottom: 14%;font-size: 18px;font-weight: 600;color: #d64757;">Mantenimiento.</p>


<style>

svg {
	position: fixed;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	height: 150px;
	width: 150px;
}
</style>
';

$result->close(); 
$conexion->close(); 
exit();

}

*/

?>









<body>
  <div class="container-arrows" id="arrowsLocation" style="display: none;">
    <div class="chevron"></div>
    <div class="chevron"></div>
    <div class="chevron"></div>
    <div class="text-arrow">
      <span id="text-pantalla-loc">Gitcom necesita acceder a su ubicación para continuar.</span>
      <br>

      <div class="error_loc" style="display: none;">
        <br>
        <br>
        <br>
        No se pudo acceder a la ubicación.
        <br>
        <br>
        <button onclick="">Reintentar</button>
      </div>
    </div>
  </div>
  <script>
    function activar() {
     $('.fondo-loader').hide();
    }
    $(window).on("load", activar);
  </script>
 
 <div class="fondo-loader">
    <div class='container'>
    <svg viewBox="0 0 396.45 396.45" stroke-width='10' fill="none" xmlns="http://www.w3.org/2000/svg" class="loadersVG">
      <g class="dash">
        <path style="--sped: 4s;" pathLength="360" d="M181.66,317.82s-48.11-90.72-59.23-114.38c-3.34-7.1-8-17.23-9.07-31.28-3.19-41.66,28.51-72.6,32-76,31.22-29.57,69.74-28.56,75.07-28.34,44.07,1.87,70,31.64,74,36.51,5.12,5.75,26.58,31.08,24,66.64a85.26,85.26,0,0,1-10.73,35.35L251.11,316.8c18.94,3.27,67.17,12.12,67.17,12.12a12.13,12.13,0,0,1,8.57,4.36,11.74,11.74,0,0,1,.88,13,12,12,0,0,1-6.12,5.07,379.7,379.7,0,0,0-52.12-11c-11.62-1.61-22.63-2.59-32.9-3.11a15.44,15.44,0,0,1-5.05-2.19,9.42,9.42,0,0,1-2.65-2.23c-3.33-4.45-3.12-11.26.35-17.42l61.3-121.42c10.48-20.75,7.71-33.44,1.93-41-6.37-8.36-18.05-9.84-24.77-10.08l-52.34.77A17.51,17.51,0,0,0,197.68,160c-.39,9.59,7.77,18.07,17.94,17.88H247a13.16,13.16,0,0,1,.89,25.78L215,204c-24.36.89-44.79-18.88-44.81-42.89,0-24.21,20.71-44.1,45.25-42.95l16.28-.2c.83-.06,7.63-.6,11.49-6.45,3.56-5.4,2.45-12-.19-16.09-2.95-4.54-7.91-6.05-10.15-6.7-10-2.89-45.15-6.35-72.31,19-2.73,2.56-24.51,23.57-25.54,56.6a79.53,79.53,0,0,0,3.77,26.62c21.78,41.44,66,127.53,66,127.53.19.33,3.82,6.79.35,13a13.13,13.13,0,0,1-7.66,6,344.43,344.43,0,0,0-42,4.09c-15.35,2.44-41.23,9.19-41.23,9.19-5.06-2.23-8-7.22-7.31-12,.7-5,5-7.61,5.65-7.95,7.44-2.35,15.49-4.5,24.08-6.49A270.26,270.26,0,0,1,181.66,317.82Z" transform="translate(-200.7 -200)" class="big" ></path>
      </g>
    </svg>
    <P style="margin: 165px 0 0 -41px;text-transform: uppercase;color: #bbbbbb;font-family: sans-serif;">
      Cargando...
    </P>
    </div>
  </div>





  <div class="session onloadView">
    <div class="left">
      <img src="assets/img/logo-white.png" width="55px" alt="logo">
    </div>
    <div class="log-in">
      <div class="container-line-loader">
        <div class="line"></div>
      </div>
      <section id="vista"></section>
    </div>
  </div>
  <p class="nav-footer onloadView" style="text-align: right;">
    GITCOM © <script> document.write(new Date().getFullYear()) </script> <br>
  </p>

  <script src="assets/js/plugins/security.min.js"></script>
  <link rel="stylesheet" href="assets/vendor/strength/strength.css" />
  <script src="assets/vendor/strength/strength.min.js"></script>

</body>

</html>