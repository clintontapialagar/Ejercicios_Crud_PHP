<?php include('conexion.php');
//Inicia una nueva sesión o reanuda la existente
session_start(); 
?>
<?php require('altalogin.php'); ?>
<?php
if (verificar_usuario()){
//si el usuario es verificado puede acceder al contenido permitido a el
include("conexion.php");
if(isset($_GET['idmercaderia'])) {
  $idmercaderia = trim($_GET['idmercaderia']);
  $query = "DELETE FROM mercaderia WHERE id = $idmercaderia";
  $result = mysqli_query($conexion, $query);
  if(!$result) {
    die("Error en la consulta a la BD");
  }
  $_SESSION['message'] = 'Mercaderia dada de baja con éxito';
  $_SESSION['message_type'] = 'danger';
  header('Location: index.php');
}
}else{
    //si el usuario no es verificado volvera al formulario de ingreso
    echo "<script language='javascript'>";
    echo "alert('Debe loguearse primero')";
    echo "</script>";
    echo "<script type='text/javascript'>";
    echo "window.location = 'index.php'";
    echo "</script>";
    exit();
}
?>