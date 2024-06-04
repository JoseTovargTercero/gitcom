<?php
function clearDate($value){
	$value = addslashes($value);
	$value = strip_tags($value);
	$value = stripslashes($value);
	$value = str_replace('"', "", $value);
	$value = str_replace("'", "", $value);
	$value = str_replace("drop", "", $value);
	$value = str_replace("truncate", "", $value);
	$value = str_replace("delete", "", $value);
	$value = str_replace("DROP", "", $value);
	$value = str_replace("TRUNCATE", "", $value);
	$value = str_replace("DELETE", "", $value);
	return $value;
}
?>