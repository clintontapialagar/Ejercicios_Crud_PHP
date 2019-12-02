<?php
include('conexion.php');
include('mercaderia.php');
if (isset($_POST['Registrar'])) {
    $idmercaderia = trim($_POST['idmercaderia']);
    $nombre = trim($_POST['nombre']);
    $precio = trim($_POST['precio']);
    $cantidad = trim($_POST['cantidad']);
    $procedencia = trim($_POST['procedencia']);
    
    // Validamos campos de formulario
    if (!empty($idmercaderia) && (is_numeric($idmercaderia)) && (!is_numeric($nombre)) && (is_numeric($precio)) && (is_numeric($cantidad))) {
        $numeroidquery = mysqli_query($conexion,"select * from mercaderia where idmercaderia='$idmercaderia'");
	if (mysqli_num_rows($numeroidquery)<1){
        $query = "INSERT INTO mercaderia(id, nombre, precio, cantidad, procedencia) VALUES ('$idmercaderia', '$nombre', '$precio', '$cantidad', '$procedencia')";
        $result = mysqli_query($conexion, $query);
        $_SESSION['message'] = 'Mercaderia ingresada con éxito';
        $_SESSION['message_type'] = 'success';
        header('Location: mercaderia.php');
    }else{
        //si existen duplicados muestro mensaje
        $_SESSION['message'] = 'Ya existe ese id de mercaderia ingresada';
        $_SESSION['message_type'] = 'warning';
        header('Location: mercaderia.php');
    }
    }else {
        //si existen duplicados muestro mensaje
		$_SESSION['message'] = 'Datos duplicados o inválidos,verifique';
        $_SESSION['message_type'] = 'warning';
        header('Location: mercaderia.php');
    }
}else{
		echo "<script language='javascript'>";
		echo "alert('Compruebe los campos inválidos')";
		echo "</script>";
        header('Location: mercaderia.php');
}
?>