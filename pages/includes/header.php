<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
  <div class="ms-md-auto pe-md-3 d-flex align-items-center">
  </div>
  <ul class="navbar-nav  justify-content-end">
      <ul class="navbar-nav  justify-content-end">



      <?php
  /*    
				if ($_SESSION["status"] == 0) {
					echo '<li class="nav-item d-flex align-items-center">
          <a class="mb-0 me-3 badge bg-danger" href="perfil.php?ac=m"> <i class="fa fa-info-circle"></i> Complete los datos de su perfil </a>
            </li>';
				}else{
					echo '<li class="nav-item d-flex align-items-center">
                  <a class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" href="mapa/index.php">Ver mapa</a>
                </li>';
        }
*/      ?>



        <li class="mt-2">
          <span></span>
        </li>
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link p-0 text-body" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </li>
      
        <li class="nav-item dropdown pe-2 d-flex align-items-center">
          <a href="javascript:;" class="nav-link p-0 text-body" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-bell cursor-pointer" aria-hidden="true"></i>
          </a>
          <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
            <li class="mb-2">
              <a class="dropdown-item border-radius-md" href="javascript:;">
                <div class="d-flex py-1">
                  <div class="my-auto">
                    <img src="" class="avatar avatar-sm  me-3 ">
                  </div>
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="text-sm font-weight-normal mb-1">
                      <span class="font-weight-bold">New message</span> from Laur
                    </h6>
                    <p class="text-xs text-secondary mb-0">
                      <i class="fa fa-clock me-1" aria-hidden="true"></i>
                      13 minutes ago
                    </p>
                  </div>
                </div>
              </a>
            </li>
            <li class="mb-2">
              <a class="dropdown-item border-radius-md" href="javascript:;">
                <div class="d-flex py-1">
                  <div class="my-auto">
                    <img src="" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                  </div>
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="text-sm font-weight-normal mb-1">
                      <span class="font-weight-bold">New album</span> by Travis Scott
                    </h6>
                    <p class="text-xs text-secondary mb-0">
                      <i class="fa fa-clock me-1" aria-hidden="true"></i>
                      1 day
                    </p>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <a class="dropdown-item border-radius-md" href="javascript:;">
                <div class="d-flex py-1">
                  <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                    <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <title>credit-card</title>
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                          <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(453.000000, 454.000000)">
                              <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                              <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                  </div>
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="text-sm font-weight-normal mb-1">
                      Payment successfully completed
                    </h6>
                    <p class="text-xs text-secondary mb-0">
                      <i class="fa fa-clock me-1" aria-hidden="true"></i>
                      2 days
                    </p>
                  </div>
                </div>
              </a>
            </li>
          </ul>
        </li>
   

        
      <li class="nav-item dropdown pe-3 d-flex align-items-center">
      <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="../assets/img/user-pictures/<?php echo $_SESSION['id'] ?>.png" alt="user-picture" class="cursor-pointer avatar avatar-profile" onerror="this.onerror=null; this.src='../assets/img/user-pictures/default.jpg'">
      </a>

      <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">

        <li class="mb-2">
          <a class="dropdown-item border-radius-md" href="perfil.php">
            <div class="d-flex py-1">
              <div class="my-auto">
                <i class="fa fa-user avatar avatar-sm  me-3" style="color: #eeeeee;    font-size: 29px;margin: 4px 0 0"></i>

              </div>
              <div class="d-flex flex-column justify-content-center">
                <h6 class="text-sm font-weight-normal mb-1">
                  <span class="font-weight-bold">Configuración del perfil</span>
                </h6>
                <p class="text-xs text-secondary mb-0">
                  Configuración y mantenimiento
                </p>
              </div>
            </div>
          </a>
        </li>
        <li class="mb-2">
          <a class="dropdown-item border-radius-md" onclick="setModeColor()">
            <div class="d-flex py-1">
              <div class="my-auto">
                <i class="fa fa-moon-o avatar avatar-sm  me-3" style="color: #eeeeee;    font-size: 29px;margin: 4px 0 0"></i>
              </div>
              <div class="d-flex flex-column justify-content-center">
                <h6 class="text-sm font-weight-normal mb-1">
                  <span class="font-weight-bold">Cambiar modo de color</span>
                </h6>
                <p class="text-xs text-secondary mb-0">
                  Modo oscuro/claro
                </p>
              </div>
            </div>
          </a>
        </li>

        <li class="mb-2">
          <a class="dropdown-item border-radius-md" href="../login/salir.php">
            <div class="d-flex py-1">
              <div class="my-auto">
                <i class="fa fa-power-off avatar avatar-sm  me-3" style="color: #e9508494;    font-size: 29px;margin: 4px 0 0"></i>
              </div>
              <div class="d-flex flex-column justify-content-center">
                <h6 class="text-sm font-weight-normal mb-1">
                  <span class="font-weight-bold">Cerrar sesion</span>
                </h6>
                <p class="text-xs text-secondary mb-0">
                  Salir
                </p>
              </div>
            </div>
          </a>
        </li>

      </ul>

    </li>
      </ul>






  </ul>
</div>


<?php 


if ($_SESSION['darkMode'] == '1') {
 echo '   <style>
 .swal2-popup.swal2-toast .swal2-title{
   color: #344767 !important;
 }
</style>';
} 


?>
<script>




  function alerta(texto, tipo) {

    if (tipo == 'ok') {
      var valor1 = '<i class="fa fa-check"></i>';
      var backColor = '#56f1ca';
    } else {
      var valor1 = '<i class="fa fa-close"></i>';
      var backColor = '#f3f224';
    }

    var notificacionBox = document.getElementById('notificacionBox');
    notificacionBox.style.background = backColor;

    $('#iconoNotificacion').html(valor1)
    $('#textoNotificacion').html(texto)
    $('#notificacionBox').show()

    setTimeout(function() {
      ocultarNotificacion()
    }, 5000);
  }

  function ocultarNotificacion() {
    $('#notificacionBox').addClass('fadeOutRight')
    setTimeout(function() {
      $('#notificacionBox').hide()
      $('#notificacionBox').removeClass('fadeOutRight')
    }, 1200);
  }


  function setModeColor() {
    $.get("consultasAjax/setModeColor.php", "setMode=true", function(data) {
      //recargar la pagina
      location.reload();
    });
  }

  var dark = "<?php echo $_SESSION['darkMode'] ?>";
  if (dark == '1') {
    setDarkMode(1)
  } else {
    setDarkMode(0)
  }

  //obeter atributo de un elemento
  var elemento = document.getElementById('title');
  var atributo = elemento.getAttribute('class');

  //obtente un elemento por su id y añadirle una clase
  var elemento = document.getElementById(atributo);
  elemento.setAttribute('class', 'nav-link text-white active bg-gradient-primary');


  function setDarkMode(set) {
    const body = document.getElementsByTagName('body')[0];
    const hr = document.querySelectorAll('div:not(.sidenav) > hr');
    const hr_card = document.querySelectorAll('div:not(.bg-gradient-dark) hr');
    const text_btn = document.querySelectorAll('button:not(.btn) > .text-dark');
    const text_span = document.querySelectorAll('span.text-dark, .breadcrumb .text-dark');
    const text_span_white = document.querySelectorAll('span.text-white, .breadcrumb .text-white');
    const text_strong = document.querySelectorAll('strong.text-dark');
    const text_strong_white = document.querySelectorAll('strong.text-white');
    const text_nav_link = document.querySelectorAll('a.nav-link.text-dark');
    const text_nav_link_white = document.querySelectorAll('a.nav-link.text-white');
    const secondary = document.querySelectorAll('.text-secondary');
    const bg_gray_100 = document.querySelectorAll('.bg-gray-100');
    const bg_gray_600 = document.querySelectorAll('.bg-gray-600');
    const btn_text_dark = document.querySelectorAll('.btn.btn-link.text-dark, .material-icons.text-dark');
    const btn_text_white = document.querySelectorAll('.btn.btn-link.text-white, .material-icons.text-white');
    const card_border = document.querySelectorAll('.card.border');
    const card_border_dark = document.querySelectorAll('.card.border.border-dark');
    const card_border_dark_p = document.querySelectorAll('section > p');



    const svg = document.querySelectorAll('g');

    if (set == '1') {
      body.classList.add('dark-version');
      for (var i = 0; i < hr.length; i++) {
        if (hr[i].classList.contains('dark')) {
          hr[i].classList.remove('dark');
          hr[i].classList.add('light');
        }
      }

      for (var i = 0; i < hr_card.length; i++) {
        if (hr_card[i].classList.contains('dark')) {
          hr_card[i].classList.remove('dark');
          hr_card[i].classList.add('light');
        }
      }
      for (var i = 0; i < text_btn.length; i++) {
        if (text_btn[i].classList.contains('text-dark')) {
          text_btn[i].classList.remove('text-dark');
          text_btn[i].classList.add('text-white');
        }
      }
      for (var i = 0; i < text_span.length; i++) {
        if (text_span[i].classList.contains('text-dark')) {
          text_span[i].classList.remove('text-dark');
          text_span[i].classList.add('text-white');
        }
      }
      for (var i = 0; i < text_strong.length; i++) {
        if (text_strong[i].classList.contains('text-dark')) {
          text_strong[i].classList.remove('text-dark');
          text_strong[i].classList.add('text-white');
        }
      }
      for (var i = 0; i < text_nav_link.length; i++) {
        if (text_nav_link[i].classList.contains('text-dark')) {
          text_nav_link[i].classList.remove('text-dark');
          text_nav_link[i].classList.add('text-white');
        }
      }
      for (var i = 0; i < secondary.length; i++) {
        if (secondary[i].classList.contains('text-secondary')) {
          secondary[i].classList.remove('text-secondary');
          secondary[i].classList.add('text-white');
          secondary[i].classList.add('opacity-8');
        }
      }
      for (var i = 0; i < bg_gray_100.length; i++) {
        if (bg_gray_100[i].classList.contains('bg-gray-100')) {
          bg_gray_100[i].classList.remove('bg-gray-100');
          bg_gray_100[i].classList.add('bg-gray-600');
        }
      }
      for (var i = 0; i < btn_text_dark.length; i++) {
        btn_text_dark[i].classList.remove('text-dark');
        btn_text_dark[i].classList.add('text-white');
      }
      for (var i = 0; i < svg.length; i++) {
        if (svg[i].hasAttribute('fill')) {
          svg[i].setAttribute('fill', '#fff');
        }
      }
      for (var i = 0; i < card_border.length; i++) {
        card_border[i].classList.add('border-dark');
      }
      el.setAttribute("checked", "true");
    } else {
      body.classList.remove('dark-version');
      for (var i = 0; i < hr.length; i++) {
        if (hr[i].classList.contains('light')) {
          hr[i].classList.add('dark');
          hr[i].classList.remove('light');
        }
      }
   

      
      for (var i = 0; i < hr_card.length; i++) {
        if (hr_card[i].classList.contains('light')) {
          hr_card[i].classList.add('dark');
          hr_card[i].classList.remove('light');
        }
      }
      for (var i = 0; i < text_btn.length; i++) {
        if (text_btn[i].classList.contains('text-white')) {
          text_btn[i].classList.remove('text-white');
          text_btn[i].classList.add('text-dark');
        }
      }
      for (var i = 0; i < text_span_white.length; i++) {
        if (text_span_white[i].classList.contains('text-white') && !text_span_white[i].closest('.sidenav') && !text_span_white[i].closest('.card.bg-gradient-dark')) {
          text_span_white[i].classList.remove('text-white');
          text_span_white[i].classList.add('text-dark');
        }
      }
      for (var i = 0; i < text_strong_white.length; i++) {
        if (text_strong_white[i].classList.contains('text-white')) {
          text_strong_white[i].classList.remove('text-white');
          text_strong_white[i].classList.add('text-dark');
        }
      }
      for (var i = 0; i < text_nav_link_white.length; i++) {
        if (text_nav_link_white[i].classList.contains('text-white') && !text_nav_link_white[i].closest('.sidenav')) {
          text_nav_link_white[i].classList.remove('text-white');
          text_nav_link_white[i].classList.add('text-dark');
        }
      }
      for (var i = 0; i < secondary.length; i++) {
        if (secondary[i].classList.contains('text-white')) {
          secondary[i].classList.remove('text-white');
          secondary[i].classList.remove('opacity-8');
          secondary[i].classList.add('text-dark');
        }
      }
      for (var i = 0; i < bg_gray_600.length; i++) {
        if (bg_gray_600[i].classList.contains('bg-gray-600')) {
          bg_gray_600[i].classList.remove('bg-gray-600');
          bg_gray_600[i].classList.add('bg-gray-100');
        }
      }
      for (var i = 0; i < svg.length; i++) {
        if (svg[i].hasAttribute('fill')) {
          svg[i].setAttribute('fill', '#252f40');
        }
      }
      for (var i = 0; i < btn_text_white.length; i++) {
        if (!btn_text_white[i].closest('.card.bg-gradient-dark')) {
          btn_text_white[i].classList.remove('text-white');
          btn_text_white[i].classList.add('text-dark');
        }
      }
      for (var i = 0; i < card_border_dark.length; i++) {
        card_border_dark[i].classList.remove('border-dark');
      }
    }
  };
</script>