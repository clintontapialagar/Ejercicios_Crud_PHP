 <?php
 session_start();

 //conexion con base de datos
$conexion=new mysqli("localhost","root","","database") or die ("No se ha podido conectar al servidor de Base de datos ") . mysqli_connect_error();

?>