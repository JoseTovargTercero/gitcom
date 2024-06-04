    <?php
    include('../../../configuracion/conexionMysqli.php');

    if ($_SESSION['nivel'] == '1') {
        $query = "SELECT * FROM sist_solicitudes_acceso ORDER BY tipo";
        $search = $conexion->query($query);
        if ($search->num_rows > 0) {
          while ($row = $search->fetch_assoc()) {
                //$cantidad++;
                if ($row['tipo'] == 3) {
                    $tipo = 'Empresa';
                }elseif ($row['tipo'] == 4) {
                    $tipo = 'Comunidad';
                }
                if ($row['status'] == 0) {
                    $st = '<span class="badge bg-danger text-white">Sin revisar</span>';
                }elseif ($row['status'] == 1) {
                    $st = '<span class="badge bg-dark text-white">Esperando por el usuario</span> ';
                }
                echo '
                    <tr>
                    <td>
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">' . $row['responsable'] . '</h6>
                        <p class="text-xs text-secondary mb-0">' . $row['usuario'] . '</p>
                        </div>
                    </div>
                    </td>
                    <td>
                    ' . $row['telefono'] . '
                    </td>
                    <td>
                    ' . $tipo . '
                    </td>
                    <td class="align-middle text-sm">' . $row['lugar'] . '
                    </td>

                    
                    </td>
                    <td class="align-middle text-sm">' . $st . '
                    </td>
                   <td class="align-middle">
                   
                        <li class="nav-item dropdown pe-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                    </a>
              
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
              
                      <li class="mb-2">
                        <a class="dropdown-item border-radius-md" onclick="userAccion(1, \''.$row['id'].'\', \''.$row['tipo'].'\')">
                          <div class="d-flex py-1">
                            <div class="my-auto">
                              <i class="fa fa-ban avatar avatar-sm  me-3" style="color: #eeeeee;    font-size: 29px;margin: 4px 0 0"></i>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="text-sm font-weight-normal mb-1">
                                <span class="font-weight-bold">Eliminar</span>
                              </h6>
                              <p class="text-xs text-secondary mb-0">
                                Denegar acceso
                              </p>
                            </div>
                          </div>
                        </a>
                      </li>';
              

                      if ($row['status'] == 0) {
                       
                        echo ' <li class="mb-2">
                        <a class="dropdown-item border-radius-md" onclick="userAccion(2, \''.$row['id'].'\', \''.$row['tipo'].'\')"">
                          <div class="d-flex py-1">
                            <div class="my-auto">
                              <i class="fa fa-check avatar avatar-sm  me-3" style="color: #eeeeee; font-size: 29px;margin: 4px 0 0"></i>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="text-sm font-weight-normal mb-1">
                                <span class="font-weight-bold">Revisar</span>
                              </h6>
                              <p class="text-xs text-secondary mb-0">
                              Revisar solicitud
                              </p>
                            </div>
                          </div>
                        </a>
                      </li>';
                      
                      
                      }
                     
              

                      echo '
                    </ul>
              
                  </li>
                        ';





                   echo '
                    </td>
                </tr>

                ';
           
            }
          
        }
    }
    ?>
 