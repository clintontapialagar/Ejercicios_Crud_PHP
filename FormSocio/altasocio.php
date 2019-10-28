<?php
include('conexion.php');
if (isset($_POST['Registrarme'])) {
    $idsocio = trim($_POST['idsocio']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $direccion = trim($_POST['direccion']);
    $edad = trim($_POST['edad']);
    
    // Validamos campos de formulario
    if (!empty($idsocio) && (is_numeric($idsocio)) && (!is_numeric($nombre)) && (!is_numeric($apellido)) && (!is_numeric($direccion)) && (is_numeric($edad)) && ($edad >"1") && ($edad <="99")) {
        $query = "INSERT INTO socios(idsocio, nombre, apellido, direccion, edad) VALUES ('$idsocio', '$nombre', '$apellido', '$direccion', '$edad')";
        $result = mysqli_query($conexion, $query);
        if(!$result) {
            die("Error en la consulta a la BD.");
        }
        $_SESSION['message'] = 'Socio ingresado con éxito';
        $_SESSION['message_type'] = 'success';
        header('Location: index.php');
    }else {
        die("Los campos no son válidos");
    }
}else{
    die("Error al enviar el formulario");
}
?>