 <?php
 session_start();

 //conexion con base de datos
$conexion = mysqli_connect("localhost", "root", "", "usuarios") or die(mysqli_erro($mysqli));

?>
