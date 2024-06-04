<?php



/*
function historial($text, $description, $tipo, $user){
  global $conexion;
  $date = date('Y-m-d H:i:s');
  $date_1 = date('Y-m-d');
  $insertar = "INSERT INTO `inner_sheet_access_historial` (`texto`, `descripcion`, `tipo`, `user`, `date`, `date_1`) VALUES ('$text', '$description', '$tipo', '$user', '$date', '$date_1')";
  mysqli_query( $conexion, $insertar );
}
*/

function sendMails($email, $titulo, $mensaje){

  $headers = "MIME-Version: 1.0\r\n"; 
  $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
  $headers .= "From: Soporte de Usuarios GITCOM <soporte@gitcom.com.ve>\r\n"; 
  $headers .= "Return-path: soporte@gitcom.com.ve\r\n"; 
  $headers .= "Cc: soporte@gitcom.com.ve\r\n"; 
  $headers .= "Bcc: soporte@gitcom.com.ve\r\n"; 

  
  if (mail($email, $titulo, $mensaje, $headers)) {
    return 1;
  }else {
    return 0;
  }
}



function delete($tabla, $campo, $value){
  global $conexion;

  $stmt_fech = $conexion->prepare("DELETE FROM `$tabla` WHERE $campo='$value'");
  $stmt_fech->execute();
  $stmt_fech -> close();
  if ($stmt_fech) {
      return true;
  }
}


?>