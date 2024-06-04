<?php
include('../../configuracion/conexionMysqli.php');




$query=$conexion->query("select * from local_parroquia where id_municipio=$_GET[municipio_id]");
$states = array();
while($r=$query->fetch_object()){ $states[]=$r; }
if(count($states)>0){
	print '<option value="">Seleccione..</option>';

foreach ($states as $s) {
	print "<option value='$s->id_parroquias'>&nbsp;$s->nombre_parroquia</option>";
}
}



?>