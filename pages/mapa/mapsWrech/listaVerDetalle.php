    <?php
    include('../conexionBd/conexion.php');

            $id = $_POST['id'];
   

        class MiBD extends SQLite3
        {
            function __construct()
            {
                $this->open('../../../db/bd_concejos.db');
            }
        }
        $bd = new MiBD();
    
        $query = $bd->query("select * from local_c_comunales");
        $states = array();
        while ($r = $query->fetchArray()) {
            $states[$r[8]] = $r[1];
        }
    
    
        $queryyy4 = "SELECT * FROM aca_resultado WHERE activo='0' AND id='$id'";
        $buscarM4 = $conexion->query($queryyy4);
        if ($buscarM4->num_rows > 0) {
            while ($row4 = $buscarM4->fetch_assoc()) {
                $comunidad = $row4['comunidad'];
                $comuna = $row4['comuna'];
    
    
                if ($comunidad == 0) {
                    $queryyy44 = "SELECT * FROM local_comunas WHERE id_Comuna='$comuna' LIMIT 1";
                    $buscarM44 = $conexion->query($queryyy44);
                    if ($buscarM44->num_rows > 0) {
                        while ($row44 = $buscarM44->fetch_assoc()) {
                            $problema .= '<li><strong>Comuna: </strong>' . $row44['nombre_comuna'] . '</li>';
                        }
                    }
                } else {
                    $problema .= '<li><strong>Consejo comunal: </strong>' . $states[$comunidad] . '</li>';
                }
    
    
    
                $aca_problema = $row4['problema'];
                $aca_nudos = $row4['nudos'];
                $aca_potencialidades = $row4['potencialidades'];
                $aca_solucion = $row4['soluciones'];
                $aca_ejecutor = $row4['ejecutor'];
    
                $problema .= '	<li><strong>Problema: </strong>' . $row4['problema'] . '</li>
                                <li><strong>Nudos Críticos: </strong>' . $row4['nudos'] . '</li>
                                <li><strong>Potencialidades: </strong>' . $row4['potencialidades'] . '</li>
                                <li><strong>Solución: </strong>' . $row4['soluciones'] . '</li>
                                <li><strong>Ente acompañante: </strong>' . $row4['ejecutor'] . '</li>
                  ';
            }
        }

        echo $problema;