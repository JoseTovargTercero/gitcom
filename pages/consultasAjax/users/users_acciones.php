    <?php
    include('../../../configuracion/conexionMysqli.php');

    if ($_SESSION['nivel'] == '1') {
        $query = "SELECT * FROM sist_usuarios WHERE nivel != 4";
        $search = $conexion->query($query);
        if ($search->num_rows > 0) {
          while ($row = $search->fetch_assoc()) {
                //$cantidad++;
                if ($row['nivel'] == 1) {
                    $tipo = 'Administrador';
                }elseif ($row['nivel'] == 2) {
                    $tipo = 'Supervisor';
                }else {
                    $tipo = 'Empresa/Institución';
                }
                echo '
                    <tr>
                    <td>
                    <div class="d-flex px-2 py-1">
                        <div>
                        <img src="../assets/img/user-pictures/' . $row['id'] . '.png" class="avatar avatar-sm me-3 border-radius-lg" alt="user" onerror="this.onerror=null; this.src=\'../assets/img/user-pictures/default.jpg\'">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">' . $row['nombreUser'] . '</h6>
                        <p class="text-xs text-secondary mb-0">' . $tipo . '</p>
                        </div>
                    </div>
                    </td>
                    <td>
                    ' . $row['telefono'] . '
                    </td>
                    <td class="align-middle text-sm">' . $row['origen'] . '
                    </td>
                    <td class="align-middle">
                    ';


                    if ($row['nivel'] != 1) {
                        echo '
                        <li class="nav-item dropdown pe-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                    </a>
              
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
              
                      <li class="mb-2">
                        <a class="dropdown-item border-radius-md" href="consultasAjax/users/.php>
                          <div class="d-flex py-1">
                            <div class="my-auto">
                              <i class="fa fa-ban avatar avatar-sm  me-3" style="color: #eeeeee;    font-size: 29px;margin: 4px 0 0"></i>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="text-sm font-weight-normal mb-1">
                                <span class="font-weight-bold">Boquear</span>
                              </h6>
                              <p class="text-xs text-secondary mb-0">
                                Quitar acceso
                              </p>
                            </div>
                          </div>
                        </a>
                      </li>
              
                      <li class="mb-2">
                        <a class="dropdown-item border-radius-md" href="consultasAjax/users/.php">
                          <div class="d-flex py-1">
                            <div class="my-auto">
                              <i class="fa fa-trash avatar avatar-sm  me-3" style="color: #e9508494;    font-size: 29px;margin: 4px 0 0"></i>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="text-sm font-weight-normal mb-1">
                                <span class="font-weight-bold">Eliminar</span>
                              </h6>
                              <p class="text-xs text-secondary mb-0">
                                Eliminar definitivamente
                              </p>
                            </div>
                          </div>
                        </a>
                      </li>
              
                    </ul>
              
                  </li>
                        ';
                    }





                   echo '
                    </td>
                </tr>

                ';
           
            }
          
        }
    }
    ?>
 