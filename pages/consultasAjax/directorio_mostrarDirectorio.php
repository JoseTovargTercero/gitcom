    <?php
    include('../../configuracion/conexionMysqli.php');
       
    $consulta = str_replace('*', "'", $_POST['consulta']);
    $consulta = explode('/', $consulta);
    $consultaEnd = $consulta[1];
    $campo = $consulta[0];

    class MiBD extends SQLite3{
        function __construct(){
            $this->open('../../db/bd_concejos.db');
        }
    }
    $bd = new MiBD();


    $query = $bd->query("select * from local_c_comunales");
    $states = array();
    while ($r = $query->fetchArray()) {
        $states[$r[8]] = $r[1];
    }


    function mostrarDatos($nombre, $cedula, $resp, $telefono, $states, $comunidad){
        echo '
        <tr>
          <td>
            <div class="d-flex px-2 py-1">
              <div>
                <img src="../assets/img/img2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
              </div>
              <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-sm">' . $nombre . '</h6>
                <p class="text-xs text-secondary mb-0">' . $cedula . '</p>
              </div>
            </div>
          </td>
          <td>
            ' . $resp . '
          </td>
          <td class="align-middle text-sm">' . $telefono . '
          </td>
          <td class="align-middle">
          <p class="text-xs font-weight-bold mb-0">' . $states[$comunidad] . '</p>
<p class="text-xs text-secondary mb-0">Amazonas</p>
          </td>
        </tr>';
    }
    
    $query = "SELECT inf_casas.coordenada_este, inf_habitantes.cedula, inf_casas.coordenada_norte, inf_casas.id_municipio, inf_casas.id_parroquia, inf_casas.id_comuna, inf_casas.id_c_comunal, inf_casas.id_vivienda, inf_habitantes.concejo_comunal, inf_habitantes.raas, inf_habitantes.clap, inf_habitantes.ubch, inf_habitantes.milicia, inf_habitantes.nombre, inf_habitantes.telefono FROM inf_habitantes
    LEFT JOIN inf_casas ON inf_casas.id_vivienda = inf_habitantes.id_vivienda 
     WHERE $consultaEnd ";
    $search = $conexion->query($query);
    if ($search->num_rows > 0) {

       
        echo '	
        
        <div class="col-lg-12">
            <a style="float: right; margin-right: 20px" href="mapa/index.php?proceso=directorio&param='.$campo.'" style="margin-left: 16px;">Crear mapa</a>
        <br>
        </div>
        <div class="table-responsive p-0  animated fadeInUp" style="overflow-x: auto !important;">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs">Información</th>
              <th class="text-uppercase text-secondary text-xxs">Responsabilidad</th>
              <th class="text-uppercase text-secondary text-xxs">Telefono</th>
              <th class="text-uppercase text-secondary text-xxs">Consejo Comunal</th>
            </tr>
          </thead>
          <tbody>

        ';


        while ($row = $search->fetch_assoc()) {
            $comunidad = explode('_', $row['id_vivienda']);
            $comunidad = $comunidad[0];
            $cedula = $row['cedula'];
       
            switch ($campo) {
                case ('sala_bnbt'):
                    $resp = 'Int. Sala BNBT';
                    break;
                case ('mesa_tecnica_agua'):
                    $resp = 'Int. MT. de Agua';
                    break;
                case ('mesa_tecnica_telecomunicaciones'):
                    $resp = 'Int. MT. de Telecomunicaciones';
                    break;
                case ('robert_serra'):
                    $resp = 'Brig. Robert Serra';
                    break;
                case ('msv'):
                    $resp = 'Brig. Somos Venezuela';
                    break;
                case ('ffm'):
                    $resp = 'Int. FFM';
                    break;
                case ('promotores_comunitarios'):
                    $resp = 'Promotor Comunitario';
                    break;
                case ('concejo_comunal'):
                    $resp = $row['concejo_comunal'];
                    break;
                case ('raas'):
                    $resp = $row['raas'];
                    break;
                case ('clap'):
                    $resp = $row['clap'];
                    break;
                case ('ubch'):
                    $resp = $row['ubch'];
                    break;
                 case ('milicia'):
                    $resp = $row['milicia'];
                    break;
            }
            $nombreSP = explode(' ', $row['nombre']);
            if (count($nombreSP) == 1 || count($nombreSP) == 2) {
                $nombre = $row['nombre'];
            }elseif (count($nombreSP) >= 3) {
                $nombre = $nombreSP[2].' '.$nombreSP[0]; 
            }
            $telefono = $row['telefono'];

            

            if ($_POST['cc'] != '') {

                if ($_POST['cc'] == $row['id_c_comunal']) {
                    mostrarDatos($nombre, $cedula, $resp, $telefono, $states, $comunidad);
            }


            }elseif ($_POST['cmu'] != '') {
                # Se filtra por comuna
                if ($_POST['cmu'] == $row['id_comuna']) {
                    mostrarDatos($nombre, $cedula, $resp, $telefono, $states, $comunidad);
                }

            }elseif ($_POST['pq'] != '') {
                # Se filtra por parroquia
                
                if ($_POST['pq'] == $row['id_parroquia']) {
                    mostrarDatos($nombre, $cedula, $resp, $telefono, $states, $comunidad);
                }
            }elseif ($_POST['mcp'] != '') {
                # Se filtra por municipio
                     
                if ($_POST['mcp'] == $row['id_municipio']) {
                    mostrarDatos($nombre, $cedula, $resp, $telefono, $states, $comunidad);
                }
            }else {
                # No se filtra por comunidad
                mostrarDatos($nombre, $cedula, $resp, $telefono, $states, $comunidad);
            }

            
            
            
            

       
        }
        echo '   </tbody>
        </table>
      </div>';
    
    }
   
    ?>
 