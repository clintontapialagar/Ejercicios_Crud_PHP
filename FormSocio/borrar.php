<?php
include("conexion.php");
if(isset($_GET['idsocio'])) {
  $idsocio = trim($_GET['idsocio']);
  $query = "DELETE FROM socios WHERE idsocio = $idsocio";
  $result = mysqli_query($conexion, $query);
  if(!$result) {
    die("Error en la consulta a la BD");
  }
  $_SESSION['message'] = 'Socio dado de baja con éxito';
  $_SESSION['message_type'] = 'danger';
  header('Location: index.php');
}
?>