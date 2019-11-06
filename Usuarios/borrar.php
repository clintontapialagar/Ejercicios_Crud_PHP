<?php
include("conexion.php");
if(isset($_GET['cedula'])) {
  $cedula = trim($_GET['cedula']);
  $query = "DELETE FROM usuarios WHERE cedula = $cedula";
  $result = mysqli_query($conexion, $query);
  if(!$result) {
    die("Error en la consulta a la BD");
  }
  $_SESSION['message'] = 'Usuario dado de baja con éxito';
  $_SESSION['message_type'] = 'danger';
  header('Location: index.php');
}
?>