<?php 
include('configuracion/conexionMysqli.php');
$id = $_GET["r"];
$tk = $_GET["t"];

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/3-SF.png">
  <script src="assets/js/sweetalert2.all.min.js"></script>
  <title>GITCOM</title>
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="assets/css/inicio.css">
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
    <div class="left" style="width: 52px">
      <img src="assets/img/logo-white.png" width="55px" alt="logo">
    </div>
    <div class="log-in">
      <div class="container-line-loader">
        <div class="line"></div>
      </div>
      <section id="vista">

        
      <form action="" autocomplete="off" style="width: 600px">
          <h4>Bienvenido a <span>GITCOM</span></h4>
          <p>Registre sus datos y valide su correo electrónico. El equipo de soporte de usuarios se comunicara con usted para validar su identidad.</p>

          <div class="row">

            <div class="col-lg-6">

              <div class="floating-label">
                <input placeholder="Correo electrónico" class="w100" type="text" id="c_correo" autocomplete="off">
                <label for="c_correo" class="p0">Correo electrónico</label>
              </div>
              <div class="floating-label">
                <input placeholder="Responsabilidad/cargo" class="w100" type="text" id="c_cedula" autocomplete="off">
                <label for="user" class="p0">Responsabilidad/cargo</label>
              </div>
           

              <div class="floating-label">
                <select id="c_comuna" class="w100" >
                  <option value="">Seleccione</option>
                  <?php 
                  $query = "SELECT * FROM local_comunas";
                  $search = $conexion->query($query);
                  if ($search->num_rows > 0) {
                      while ($row = $search->fetch_assoc()) {
                          echo "<option value='".$row['id_Comuna']."'>&nbsp;".$row['nombre_comuna']."</option>";
                  
                      }
                  }
                  ?>
                </select>
                <label for="c_comuna" class="p0">Comuna</label>
              </div>

              <div class="floating-label">
                <select id="c_comunidad" class="w100" >
                  <option value="">Seleccione</option>
                </select>
                <label for="c_comunidad" class="p0">Comunidad</label>
              </div>


            </div>
            <div class="col-lg-6">



            <div class="floating-label">
              <input placeholder="Contraseña" class="w100" type="password" id="c_pass" autocomplete="off">
              <label for="c_pass" class="p0">Contraseña</label>
            </div>
            <div class="floating-label">
              <input placeholder="Repita la contraseña" class="w100" type="password" id="c_pass2" autocomplete="off">
              <label for="c_pass2" class="p0">Repita la contraseña</label>
            </div>

            </div>

          </div>

          <button type="button" onclick="guardad()" >Completar registro</button>
        </form>

      </section>
    </div>
  </div>
  <p class="nav-footer onloadView" style="text-align: right;">
    GITCOM © <script>
      document.write(new Date().getFullYear())
    </script>
    <br>
    Impulsado por la Gobernación del Estado Amazonas
  </p>
  <script src="class/alertas.js"></script>


  <script>
      $(document).ready(function() {
        $("#c_comuna").change(function() {
          $.get("pages/consultasAjax/selec_ciudades.php", "comuna=" + $("#c_comuna").val(), function(data) {
            $("#c_comunidad").html(data);
          });
       
      });

      });

  </script>
</body>

</html>


