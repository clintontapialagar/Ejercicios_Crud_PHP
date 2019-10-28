<?php
session_start(); //Inicia una nueva sesión o reanuda la existente
require('altalogin.php');

//usuario y clave pasados por el formulario
$usuario = trim($_POST['inputid']);
$clave = trim($_POST['inputpassword']);

//usa la funcion conexiones() que se ubica dentro de altalogin.php
if (conexiones($usuario, $clave)){
	//validamos usuario admin
	switch ($usuario) {
		case 'masteruser':
			# code...
			header('Location: mercaderia.php');
			break;
		case 'user':
			#code...
			echo "Hola $usuario <a class='btn btn-primary' href='logout.php'>Salir</a><br/>";
			break;
	}
} else {
    //si no es valido volvemos al formulario inicial
    echo "<script language='javascript'>";
	echo "alert('El usuario $usuario y la clave $clave no son válidos')";
	echo "</script>";
	echo "<script type='text/javascript'>";
	echo "window.location = 'index.php'";
    echo "</script>";
    //header('Location: index.php');
    exit();
}
?>