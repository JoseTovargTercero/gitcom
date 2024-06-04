        <?php
        include('../../configuracion/conexionMysqli.php');


        $i= $_GET["i"];
        $count = 1;
         $query2E = "SELECT * FROM psuv
         LEFT JOIN local_municipio ON local_municipio.id_municipio=psuv.mcp
         LEFT JOIN local_parroquia ON local_parroquia.id_parroquias=psuv.pq
         WHERE psuv.id='$i'
        ";
         $search2E = $conexion->query($query2E);
         if ($search2E->num_rows > 0) {
           while ($row2E = $search2E->fetch_assoc()) {
         

?>

        <!doctype html>
        <html lang="es">
        <head>

        <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
         <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
         <link id="pagestyle" href="../../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
         <link rel="stylesheet" href=".././assets/webfonts/font-awesome/css/font-awesome.min.css">
         <link rel="stylesheet" href=".././assets/css/core.css">
          <script src="../../assets/js/jquery-3.6.0.min.js"></script>

          <style>
            *{
                text-transform: uppercase;
            }
            .row {
              display: flex;
              width: 100%;
              height: 100%;
            }

            .col-left {
              width: 25%;
              padding: 15px;
              position: absolute;
              z-index: 99;
            }

            .container {
              height: 100vh;
              width: 100% !important;
              padding: 0 !important;
            }

            ul {
              list-style: none;
              padding: 0 21px;
              z-index: 999;
              margin-top: 20px;
            }

            li {
              margin: 5px 0;
            }

            h1 {
    
              margin-top: 0;
              margin-bottom: 10px;
            }

            .leaflet-container {
              background: #fff !important;
            }

            .cinta {
              background-color: #000000b8;
              position: fixed;
              color: white;
              width: 100%;
              padding: 25px;
              bottom: 0;
              z-index: 999;
              text-align: center;
            }

            .btn {
              padding: 7px;
              outline: none;
              text-align: center;
              color: white;
              text-decoration: none;
              border-radius: 5px;
              margin: 5px;
              cursor: pointer;
              box-shadow: -1px 1px 6px 0px #0000006b;
            }

            .btn:hover {
              filter: brightness(0.9);
              box-shadow: none;
            }

            .btn-cancel {
              background-color: #a23553;
            }

            .btn-imprimir {
              background-color: #0029e1;
            }

            .textTi {
              margin: 10px;
              font-weight: bold;
              color: #565656;
            }
              table{
                width: 100%;
                font-size: 12px;
                margin-top: 10px;
              }
              th, td{
                border: 1px solid gray;
                padding: 5px;
                color: black;
              }
              .center{
                text-align: center;
              }
           

            </style>
          <title>GITCOM</title>
        </head>
        <body>
          <div style="display: flex;justify-content: space-between;">
                <div>
            <img src="0.jpeg" alt="logo" width="180px">


            




          <?php 
          
          

          switch ($row2E['instancia']) {
            case 'Gobernacion':
              $i1 = 'box-shadow: inset 0px 0px 4px 3px black;';
              break;
            case 'Alcaldias':
              $i2 = 'box-shadow: inset 0px 0px 4px 3px black;';
              break;
            case 'Ministerios':
              $i3 = 'box-shadow: inset 0px 0px 4px 3px black;';
              break;
            case 'Misiones':
              $i4 = 'box-shadow: inset 0px 0px 4px 3px black;';
              break;
            case 'Entes legislativos':
              $i5 = 'box-shadow: inset 0px 0px 4px 3px black;';
              break;
          }
          ?>



<p style="margin-top: 25px;">
  <div style="width: 20px; height: 20px; border: 1px solid gray; display: inline-flex; <?php echo $i1 ?>"></div> GOBERNACIÓN <br>
  <div style="width: 20px; height: 20px; border: 1px solid gray; display: inline-flex; <?php echo $i2 ?>"></div> ALCALDÍA <br>
  <div style="width: 20px; height: 20px; border: 1px solid gray; display: inline-flex; <?php echo $i3 ?>"></div> MINISTERIOS <br>
  <div style="width: 20px; height: 20px; border: 1px solid gray; display: inline-flex; <?php echo $i4 ?>"></div> MISIONES <br>
  <div style="width: 20px; height: 20px; border: 1px solid gray; display: inline-flex; <?php echo $i5 ?>"></div> ENTES LEGISLATIVOS <br>
</p>




                </div>
                
                <div style="text-align: center">
            <h1 style="font-size: 22px; color: rgb(192, 0, 0);"> CARACTERIZACIÓN<br> DE CARGOS DE DIRECCIÓN</h1>
                </div>
                
                <div>
            <img src="../../psuv_f/<?php echo $row2E['cedula'] ?>.png" id="imagenFoto" alt="imagen" style="width: 170px; height:190px">
                </div>
          </div>
          <div class="cinta" id="cinta">
            <a class="btn btn-imprimir" onclick="printEnd()">Exportar</a>
            <div style="position: absolute;margin-top: -36px;right: 0;margin-right: 15px;">
              Ancho: &nbsp;&nbsp; <button class="btn" onclick="redimensionar('+', 'ancho')">+</button> &nbsp;&nbsp; <button class="btn" onclick="redimensionar('-', 'ancho')">-</button>  &nbsp;&nbsp; 
              Alto: &nbsp;&nbsp; <button class="btn" onclick="redimensionar('+', 'alto')">+</button> &nbsp;&nbsp; <button class="btn" onclick="redimensionar('-', 'alto')">-</button>
            </div>




            <script>
              function redimensionar(a, l){
                var image = document.getElementById('imagenFoto');
                let alto =  image.style.height;
                let ancho =  image.style.width;
                alto = alto.slice(0, alto.length -2)
                ancho = ancho.slice(0, ancho.length -2)



                if (l == 'ancho' && a == '+') {
                  let newAn = 5 + parseInt(ancho)
                  image.style.width = newAn + 'px' 
                }else if (l == 'ancho' && a == '-') {
                  let newAn = parseInt(ancho) - 5
                  image.style.width = newAn + 'px' 
                }else if (l == 'alto' && a == '-') {
                  let newAl = parseInt(alto) - 5
                  image.style.height = newAl + 'px' 
                }else if (l == 'alto' && a == '+') {
                  let newAl = 5 + parseInt(alto)
                  image.style.height = newAl + 'px' 
                }





/*
                image.style.width = image.style.height + 10 + 'px';
                image.style.height = image.style.height + 10 + 'px';
*/


              }
            </script>



          </div>

          <script>
            function printEnd() {
              document.getElementById('cinta').style.display = 'none';
              window.print()
              document.getElementById('cinta').style.display = 'block';
            }
          </script>
          <div class="" style="width: 100% !important;">
        




             

          <table>
            <thead>
              <tr>
                <th style="width: 70%; background-color: rgb(192, 0, 0) !important; color: white !important">Nombres y apellidos</th>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important">Cedula</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php echo $row2E['nombre'] ?></td>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php echo $row2E['cedula'] ?></td>
              </tr>
            </tbody>
          </table>

          <table>
          <thead>
              <tr>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important">F. de Nacimiento</th>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important">Edad</th>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important">Sexo</th>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important">Telefono</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php echo $row2E['fecha'] ?></td>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php echo $row2E['edad'] ?></td>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php echo $row2E['sexo'] ?></td>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php echo $row2E['telefono'] ?></td>
              </tr>
            </tbody>
          </table>
 

          <table>
          <thead>
              <tr>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important">Dirección de Habitación</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php echo $row2E['direccion'] ?></td>
              </tr>
            </tbody>
          </table>
          
<!--
          activo
estructura
media
base
partido -->

          <table>
          <thead>
              <tr>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important">Estado</th>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important">Municipio</th>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important">Parroquia</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="border: 1px solid white; background-color: #ebebeb;">AMAZONAS</td>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php echo $row2E['nombre_municipio'] ?></td>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php echo $row2E['nombre_parroquia'] ?></td>
              </tr>
            </tbody>
          </table>


          <table>
          <thead>
              <tr>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important">Grado de instrucción</th>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important">Profesión</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php echo $row2E['grado'] ?></td>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php echo $row2E['profesion'] ?></td>
              </tr>
            </tbody>
          </table>


          <table>
          <thead>
              <tr>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important">Institución en la que labora</th>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important">Cargo</th>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important">Tiempo en la tarea</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php echo $row2E['institucion'] ?></td>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php echo $row2E['cargo'] ?></td>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php echo $row2E['tiempo'] ?></td>
              </tr>
            </tbody>
          </table>





          <table>
          <thead>
              <tr>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important">Edo. Civil</th>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important">Correo Electrónico</th>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important">Militar (<?php echo $row2E['militar'] ?>)</th>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important">Activo (<?php echo $row2E['activo'] ?>)</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php echo $row2E['edoCivil'] ?></td>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php echo $row2E['correo'] ?></td>
                <td style="border: 1px solid white; background-color: #ebebeb;"></td>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php echo $row2E['rango'] ?></td>
              </tr>
            </tbody>
          </table>


          


          <table>
          <thead>
              <tr>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important" colspan=2>¿Pertenece a alguna estructura del partido?</th>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important"></th>
                <th style="background-color: rgb(192, 0, 0) !important; color: white !important"></th>
              </tr>
            </thead>
            <tbody>

            
              <tr>
                <td style="border: 1px solid white; background-color: #ebebeb;">
                <?php 
                if ($row2E['estructura'] == 'nacional') {
                  echo '<div style="width: 20px; height: 20px; border: 1px solid gray; display: inline-flex; box-shadow: inset 0px 0px 4px 3px black;"></div>';
                }else{
                  echo '<div style="width: 20px; height: 20px; border: 1px solid gray; display: inline-flex;"></div>';
                }
                ?> Estructura nacional 
                </td>


                <td style="border: 1px solid white; background-color: #ebebeb;"></td>
                <td style="border: 1px solid white; background-color: #ebebeb;"></td>
                <td style="border: 1px solid white; background-color: #ebebeb;"></td>
              </tr>

              <tr>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php 
                if ($row2E['estructura'] == 'media') {
                  echo '<div style="width: 20px; height: 20px; border: 1px solid gray; display: inline-flex; box-shadow: inset 0px 0px 4px 3px black;"></div>';
                }else{
                  echo '<div style="width: 20px; height: 20px; border: 1px solid gray; display: inline-flex;"></div>';
                }
                ?> Estructura Media </td>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php echo ($row2E['media'] != 'undefined') ? $row2E['media'] : '' ?></td>
                <td style="border: 1px solid white; background-color: #ebebeb;"></td>
                <td style="border: 1px solid white; background-color: #ebebeb;"></td>
              </tr>

              <tr>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php 
                if ($row2E['estructura'] == 'base') {
                  echo '<div style="width: 20px; height: 20px; border: 1px solid gray; display: inline-flex; box-shadow: inset 0px 0px 4px 3px black;"></div>';
                }else{
                  echo '<div style="width: 20px; height: 20px; border: 1px solid gray; display: inline-flex;"></div>';
                }
                ?> Estructura Base </td>
                <td style="border: 1px solid white; background-color: #ebebeb;"><?php echo ($row2E['base'] != 'undefined') ? $row2E['base'] : '' ?></td>
                <td style="border: 1px solid white; background-color: #ebebeb;"></td>
                <td style="border: 1px solid white; background-color: #ebebeb;"></td>
              </tr>



            </tbody>
          </table>






          </div>
          </div>
        </body>
      </html>

      <?php 
          }
        }

      ?>