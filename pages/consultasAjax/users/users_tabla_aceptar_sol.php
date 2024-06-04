    <?php
    include('../../../configuracion/conexionMysqli.php');
    include('../../../class/accionesSecundarias.php');
       
    if ($_SESSION['nivel'] == 1) {


        $rand_n = '00';
        //$rand_n = rand(10000,1000000);
        $rand = password_hash($rand_n, PASSWORD_BCRYPT);


        $id = $_POST['id'];
        $dato0 = $_POST['dato0'];
        $dato1 = $_POST['dato1'];
        $dato2 = $_POST['dato2'];

        $st = '1';

        $sql = "UPDATE sist_solicitudes_acceso SET status = ?, tk = ?, responsabilidad=?, dato1=?, lugar=? WHERE id = ?";
        $resultado = $conexion->prepare($sql);
        $resultado->bind_param('ssssss', $st, $rand, $dato0, $dato1, $dato2 ,$id);
        $resultado->execute();
        if ($resultado) {



            $stmt_access = mysqli_prepare($conexion, "SELECT * FROM sist_solicitudes_acceso WHERE id = ?");
            $stmt_access->bind_param('s', $id);
            $stmt_access->execute();
            $result_access = $stmt_access->get_result();
            if ($result_access->num_rows > 0) {
              while ($row_access = $result_access->fetch_assoc()) {
                $email = $row_access['usuario'];
                $nombre = $row_access['responsable'];
                $tk = $row_access['tk'];
                }
            }



                $idu = $conexion->insert_id;
                $stmt -> close();
            
                $titulo = 'GITCOM - Activacion de usuario'; // Asunto
                $mensaje = ' 
                <html> 
                <head> 
                <title>GITCOM  - Activacion de usuario</title> 
                </head> 
                <body> 
                <h1>Hola '.$nombre.'!</h1> 
                <p> 
                <br>
                    Su usuario fue creado correctamente. Utilice el siguiente enlace para actualizar su contraseña y poder acceder a su cuenta.
            
                    <a href="https://gitcom.com.ve/activate?tk='.$tk.'&u='.$id.'">Activaci&oacute;n de usuario</a>
                <br>
                <br>
                <h2></h2>
                <br>
                <br>
                </p> 
                </body> 
                </html> '; 



                if (sendMails($email, $titulo, $mensaje)) {
                    echo '1';
                }else {
                    echo '3';
                }
            








        }
        $resultado->close();

    }
    ?>
 