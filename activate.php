<?php
include('configuracion/conexionMysqli.php');


if (!$_GET['tk']) {
  define('PAGINA_INICIO', 'index');
  header('Location: ' . PAGINA_INICIO);
}

$u = $_GET['u'];
$tk = $_GET['tk'];

	
$stmt = mysqli_prepare($conexion, "SELECT * FROM sist_solicitudes_acceso WHERE id = ? AND status=1");
$stmt->bind_param("i", $u);
$stmt->execute();
$result = $stmt->get_result();
  if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
    if (!password_verify($tk, $row['tk'])) {

    define('PAGINA_INICIO', 'index');
    header('Location: ' . PAGINA_INICIO);
  }
}
}else {
  define('PAGINA_INICIO', 'index');
  header('Location: ' . PAGINA_INICIO);
}


?>

<!DOCTYPE html>
<html
  lang="es"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free"
>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="google-site-verification" content="RTjcLiSpNdMyoTq_ZMTU1ktkBC312b6Cg18NsUeLwkI" />
  <link rel="icon" type="image/png" href="assets/img/3-SF.png">
  <script src="assets/js/sweetalert2.all.min.js"></script>
  <title>GITCOM</title>
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="assets/css/inicio.css">
  <link rel="stylesheet" href="assets/css/core.css">
  </link>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
</head>

<body>
  <script>
    function activar() {
      $('.fondo-loader').hide();
    }
    $(window).on("load", activar);
  </script>
  <div class="fondo-loader">
    <div class='container'>
      <i class='layer'></i>
      <i class='layer'></i>
      <i class='layer'></i>
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
     
      <form id="formAuthentication" class="mb-3">

      <h4>Bienvenido a <span>GITCOM</span></h4>
    <p>Complete la información de seguiridad de su cuenta.</p>



    <div class="floating-label">
      <input placeholder="Contraseña" type="password" name="password" id="password" autocomplete="off">
      <label for="user">Contraseña</label>
      <div class="icon">
      <span class="st1 icon-lock"></span>
      </div>
    </div>


    

    <div class="progress mt-2"  style="    width: 89%;margin-left: 40px;">
                      <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"  id="passstrength">
                      </div>
                    </div>



  
  <div class="floating-label">
      <input placeholder="Repetir la contraseña" type="password" name="email" id="password-2" ame="password-2" autocomplete="off">
      <label for="user">Repetir la contraseña</label>
      <div class="icon">
      <span class="st1 icon-lock"></span>
      </div>
    </div>
  

  <button class="btn btn-primary d-grid w-100">Verificar</button>
</form>

    </div>
  </div>
  <p class="nav-footer onloadView" style="text-align: right;">
    GITCOM © <script>
      document.write(new Date().getFullYear())
    </script>
    <br>
    Impulsado por la Gobernación del Estado Amazonas
  </p>
  <script>
    let u = "<?php echo $_GET['u'] ?>";
    let t = "<?php echo $_GET['tk'] ?>";
    </script>
    <script src="class/alertas.js"></script>
  <link rel="stylesheet" href="assets/vendor/strength/strength.css" />
    <script src="assets/vendor/strength/strength.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>


</body>  


</html>
<!-- https://www.facebook.com/groups/1102669216824868/ ->