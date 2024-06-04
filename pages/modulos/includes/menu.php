
<?php


if ($_SESSION['nivel'] == '1') {
?>

  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="../../home" style="display: flex;">
        <img src="../../../assets/img/logo-white.png" class="navbar-brand-img h-100" alt="main_logo">

        <div style="margin-left: 10px;margin-top: -1px; display: grid;">
          <span style="margin-left: 10px;" class="ms-1  text-white"><?php echo $_SESSION['nombre'] ?></span>
          <span style="margin-left: 10px;    font-size: 11px;opacity: 0.4;     margin-top: -3px;" class="ms-1  text-white">
          Administrador
        
        </span>
        </div>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a id="index" class="nav-link text-white" href="../../index">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-bar-chart"></i>
            </div>
            <span class="nav-link-text ms-1">Inicio</span>
          </a>
        </li>





        <li class="nav-item">
          <a id="home" class="nav-link text-white" href="../../home">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-gears"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>



        <li class="nav-item">
          <a id="solicitud" class="nav-link" href="../../adm_solicitud">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-user"></i>
            </div>
            <span class="nav-user ms-1">Solicitudes de acceso</span>

            <?php
            if (contar2('sist_solicitudes_acceso', "status='0'") != 0) {
              echo '
            <span style="position: absolute;right: 0;margin-right: 24px;     background-image: linear-gradient(195deg, #ed5264 0%, #d64757 100%);" class="badge bg-dark" >' . contar2('sist_solicitudes_acceso', "status='0'") . '</span>
            ';
            }

            ?>
          </a>
        </li>

        <li class="nav-item">
          <a id="users" class="nav-link" href="../../adm_users">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-users"></i>
            </div>
            <span class="nav-user ms-1">Usuarios</span>
          </a>
        </li>




        
        <li class="nav-item">
          <a id="aca" class="nav-link text-white " href="../../admin-import">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-file"></i>
            </div>
            <span class="nav-link-text ms-1">Importar datos</span>
          </a>
        </li>


        <li class="nav-item">
          <hr>
        </li>
        
                <li class="nav-item">
                  <a id="herramientas" class="nav-link text-white " href="../../herramientas" style="background-color: #dbd0d20d">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fa fa-star"></i>
                    </div>
                    <span class="nav-link-text ms-1"><?php echo $_SESSION['nombre'] ?></span>
                  </a>
                </li>





        <li class="nav-item">
          <hr>
        </li>









        <li class="nav-item">
          <a id="cartografia" class="nav-link text-white " href="../../cartografia">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-map"></i>
            </div>
            <span class="nav-link-text ms-1">Proyectos Gitcom</span>
          </a>
        </li>
      


        <!--
        <li class="nav-item">
          <a id="aca" class="nav-link text-white " href="../../nuevoAca">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-book"></i>
            </div>
            <span class="nav-link-text ms-1">Agenda Concreta</span>
          </a>
        </li>
-->



        <li class="nav-item">
          <a id="directorio" class="nav-link text-white " href="../../directorio">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-list-alt"></i>
            </div>
            <span class="nav-link-text ms-1">Directorio</span>
          </a>
        </li>

      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3" style="font-size: 11px;padding: 11px;text-align: center;">
        GITCOM © <script> document.write(new Date().getFullYear()) </script>
      </div>
    </div>
  </aside>


<?php }elseif ($_SESSION['nivel'] == '4') { ?>

  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="../../home" style="display: flex;">
        <img src="../../assets/img/logo-white.png" class="navbar-brand-img h-100" alt="main_logo">

        <div style="margin-left: 10px;margin-top: -1px; display: grid;">
          <span style="margin-left: 10px;" class="ms-1  text-white"><?php echo $_SESSION['nombre'] ?></span>
          <span style="margin-left: 10px;    font-size: 11px;opacity: 0.4;     margin-top: -3px;" class="ms-1  text-white">
          <?php echo $_SESSION["entidad"]; ?>
        </span>
        </div>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a id="index" class="nav-link text-white" href="../../index">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-bar-chart"></i>
            </div>
            <span class="nav-link-text ms-1">Inicio</span>
          </a>
        </li>




        <li class="nav-item">
          <hr>
        </li>








        <li class="nav-item">
          <a id="cartografia" class="nav-link text-white " href="../../cartografia">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-map"></i>
            </div>
            <span class="nav-link-text ms-1">Proyectos Gitcom</span>
          </a>
        </li>
        <li class="nav-item">
          <a id="registros" class="nav-link text-white " href="../../registros">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-code"></i>
            </div>
            <span class="nav-link-text ms-1">Consulta avanzada</span>
          </a>
        </li>



        


        <li class="nav-item">
          <a id="directorio" class="nav-link text-white " href="../../directorio">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-list-alt"></i>
            </div>
            <span class="nav-link-text ms-1">Directorio</span>
          </a>
        </li>

      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3" style="font-size: 11px;padding: 11px;text-align: center;">
        GITCOM © <script> document.write(new Date().getFullYear()) </script>
      </div>
    </div>
  </aside>




<?php }elseif ($_SESSION['nivel'] == '3') { ?>





<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="../../home" style="display: flex;">
      <img src="../../../assets/img/logo-white.png" class="navbar-brand-img h-100" alt="main_logo">

      <div style="margin-left: 10px;margin-top: -1px; display: grid;">
        <span style="margin-left: 10px;" class="ms-1  text-white"><?php echo $_SESSION['nombre'] ?></span>
        <span style="margin-left: 10px;    font-size: 11px;opacity: 0.4;     margin-top: -3px;" class="ms-1  text-white">
        Administrador
      
      </span>
      </div>
    </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a id="index" class="nav-link text-white" href="../../index">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-bar-chart"></i>
          </div>
          <span class="nav-link-text ms-1">Inicio</span>
        </a>
      </li>



      <li class="nav-item">
        <hr>
      </li>
      
              <li class="nav-item">
                <a id="herramientas" class="nav-link text-white " href="../../herramientas" style="background-color: #dbd0d20d">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-star"></i>
                  </div>
                  <span class="nav-link-text ms-1"><?php echo $_SESSION['nombre'] ?></span>
                </a>
              </li>



      <li class="nav-item">
        <hr>
      </li>




      <li class="nav-item">
        <a id="cartografia" class="nav-link text-white " href="../../cartografia">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-map"></i>
          </div>
          <span class="nav-link-text ms-1">Proyectos Gitcom</span>
        </a>
      </li>
      <li class="nav-item">
        <a id="registros" class="nav-link text-white " href="../../registros">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-code"></i>
          </div>
          <span class="nav-link-text ms-1">Consulta avanzada</span>
        </a>
      </li>




      <li class="nav-item">
        <a id="directorio" class="nav-link text-white " href="../../directorio">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-list-alt"></i>
          </div>
          <span class="nav-link-text ms-1">Directorio</span>
        </a>
      </li>

    </ul>
  </div>
  <div class="sidenav-footer position-absolute w-100 bottom-0 ">
    <div class="mx-3" style="font-size: 11px;padding: 11px;text-align: center;">
      GITCOM © <script> document.write(new Date().getFullYear()) </script>
    </div>
  </div>
</aside>

<?php } ?>