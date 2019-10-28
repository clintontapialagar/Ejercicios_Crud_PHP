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
        $numeroidquery = mysqli_query($conexion,"select * from socios where idsocio='$idsocio'");
	if (mysqli_num_rows($numeroidquery)<1){
        $query = "INSERT INTO socios(idsocio, nombre, apellido, direccion, edad) VALUES ('$idsocio', '$nombre', '$apellido', '$direccion', '$edad')";
        $result = mysqli_query($conexion, $query);
        $_SESSION['message'] = 'Socio ingresado con éxito';
        $_SESSION['message_type'] = 'success';
        header('Location: index.php');
    }else{
        //si existen duplicados muestro mensaje
        $_SESSION['message'] = 'Ya existe ese id de socio ingresado';
        $_SESSION['message_type'] = 'warning';
        header('Location: index.php');
    }
    }else {
        //si existen duplicados muestro mensaje
		$_SESSION['message'] = 'Ingrese datos válidos';
        $_SESSION['message_type'] = 'warning';
        header('Location: index.php');
    }
}else{
		echo "<script language='javascript'>";
		echo "alert('Compruebe los campos inválidos')";
		echo "</script>";
        header('Location: index.php');
}
?>
