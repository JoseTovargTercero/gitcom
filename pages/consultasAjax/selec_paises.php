<?php
include('../../configuracion/conexionMysqli.php');


$query=$conexion->query("select * from local_comunas where id_parroquia=$_GET[continente_id]");
$states = array();
while($r=$query->fetch_object()){ $states[]=$r; }
if(count($states)>0){
	print '<option value="">Seleccione..</option>';
foreach ($states as $s) {
	print "<option value='$s->id_Comuna'>&nbsp;$s->nombre_comuna</option>";
}
}
?>