        <?php
        include('../../configuracion/conexionMysqli.php');

?>

        <!doctype html>
        <html lang="es">
        <head>

        <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
         <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
         <link id="pagestyle" href="../../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
         <link rel="stylesheet" href=".././assets/webfonts/font-awesome/css/font-awesome.min.css">
         <link rel="stylesheet" href=".././assets/css/core.css">
          <style>
         
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
              text-align: center;
              width: 100%;
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
                font-size: 9px;
              }
              th, td{
                border: 1px solid gray;
                padding: 5px 2px;
              }
              .center{
                text-align: center;
              }

            </style>
          <title>GITCOM</title>
        </head>
        <body>
          <div class="cinta" id="cinta">
            <a class="btn btn-imprimir" onclick="printEnd()">Exportar</a>
          </div>

          <script>
            function printEnd() {
              document.getElementById('cinta').style.display = 'none';
              window.print()
              document.getElementById('cinta').style.display = 'block';
            }
          </script>
          <div class="" style="width: 100% !important;">
            <h1 style="font-size: 22px;"> Caracterización de cargos de dirección</h1>
            <table>
              <tr>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important" >N#</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important" >Nombres y apellidos</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important" >Cedula</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Fecha de nacimiento</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Telefono</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Edad</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Sexo</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Instancia</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Grado de instrucción</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Profesión</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Institución en la que labora</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Cargo</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Tiempo en la tarea</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Estado civil</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Correo</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Militar</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Activo</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Rango</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Dirección de habitación</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Estado</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Municipio</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Parroquia</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Estructuras del partido</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Media</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Base</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Experiencia política 1</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Experiencia política 2</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Experiencia política 3</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Experiencia política 4</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Experiencia política 5</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Experiencia institucional  1</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Experiencia institucional  2</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Experiencia institucional  3</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Experiencia institucional  4</th>
                <th style="text-align: center; background-color: rgb(192, 0, 0) !important; color: white !important">Experiencia institucional  5</th>
              </tr>


                 <tbody>
                 <?php
                 
                 $count = 1;
                  $query2E = "SELECT * FROM psuv
                  LEFT JOIN local_municipio ON local_municipio.id_municipio=psuv.mcp
                  LEFT JOIN local_parroquia ON local_parroquia.id_parroquias=psuv.pq
                 ";
                  $search2E = $conexion->query($query2E);
                  if ($search2E->num_rows > 0) {
                    while ($row2E = $search2E->fetch_assoc()) {
                  
                        echo '
                        <tr>
                        <td style="text-align: center; background-color: rgb(192, 0, 0);  color: white !important">'.$count++.'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['nombre'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['cedula'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['fecha'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['telefono'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['sexo'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['instancia'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['grado'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['profesion'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['institucion'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['cargo'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['tiempo'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['edoCivil'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['correo'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['militar'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['activo'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['rango'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['direccion'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['nombre_municipio'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['nombre_parroquia'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['estado'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['estructura'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['media'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['base'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['partido'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['cargo1'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['cargo2'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['cargo3'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['cargo4'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['cargo5'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['responsabilidad1'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['responsabilidad2'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['responsabilidad3'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['responsabilidad4'].'</td>
                        <td style=" color: black !important; font-weight: 600 !important;">'.$row2E['responsabilidad5'].'</td>
                    </tr>
                  ';
                }
              }
                 ?>

              </tbody>
            </table>
          </div>
          </div>
        </body>
      </html>