<?php
include('conexion.php');
if (isset($_POST['Registrarme'])) {
    $cedula = trim($_POST['cedula']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $contraseña = trim(sha1($_POST['contrasena']));
    $confirmocontraseña = trim(sha1($_POST['confirmocontrasena']));

    // Validamos campos de formulario
    if (empty($cedula) && (!is_numeric($cedula))){
        //muestro mensaje de cedula invalida o vacia
        $_SESSION['message'] = 'Cedula inválida';
        $_SESSION['message_type'] = 'warning';
        header('Location: index.php');
    }else if (is_numeric($nombre) && (empty($nombre))){
        //muestro mensaje de usuario
        $_SESSION['message'] = 'Nombre inválida';
        $_SESSION['message_type'] = 'warning';
        header('Location: index.php');
    }else if (is_numeric($apellido) && (empty($apellido))){
        $_SESSION['message'] = 'Apellido inválida';
        $_SESSION['message_type'] = 'warning';
        header('Location: index.php');
    }else if (is_numeric($contraseña) && (empty($contraseña))){
        $_SESSION['message'] = 'Contraseña inválida o vacía';
        $_SESSION['message_type'] = 'warning';
        header('Location: index.php');
    }else if ($contraseña != $confirmocontraseña){
        $_SESSION['message'] = 'Error al confirmar contraseña';
        $_SESSION['message_type'] = 'warning';
        header('Location: index.php');
    }else{
        $numeroidquery = mysqli_query($conexion,"select * from usuarios where cedula='$cedula'");
        if (mysqli_num_rows($numeroidquery)<1){
            $query = "INSERT INTO usuarios(cedula, nombre, apellido, contrasena) VALUES ('$cedula', '$nombre', '$apellido', '$contraseña')";
            $result = mysqli_query($conexion, $query);
            $_SESSION['message'] = 'Usuario ingresado con éxito';
            $_SESSION['message_type'] = 'success';
            header('Location: index.php');
        }else{
            //si existen duplicados muestro mensaje
            $_SESSION['message'] = 'Ya existe esa cedula de usuario ingresada';
            $_SESSION['message_type'] = 'warning';
            header('Location: index.php');
        }
    }
}else{
		echo "<script language='javascript'>";
		echo "alert('No se puede enviar el formulario en este momento')";
		echo "</script>";
        header('Location: index.php');
}
?>