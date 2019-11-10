<?php include('conexion.php'); ?>

<!-- Busqueda Ajax socio -->
<?php 
$socio = $_GET['socio'];
$result = mysqli_query($conexion, "SELECT * FROM socios WHERE nombre = '$socio'  LIMIT 1");
mysqli_set_charset("utf8");
if (mysqli_num_rows($result)>0){
    $socio = mysqli_fetch_object($result);
    $socio->status = 200;
    echo json_encode($socio);
} else{
    $error = array('status' => 400);
    echo json_encode((object)$error);
}
?>
