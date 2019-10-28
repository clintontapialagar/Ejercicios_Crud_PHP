<?php
// Tabla de usuarios
/*CREATE TABLE usuarios_login(
	usuario varchar(10) PRIMARY KEY,
	clave varchar(40),
	metodo varchar(5)
	);*/

//funcion para conectar a la base de datos y verificar la existencia del usuario
function conexiones($usuario, $clave) {
	//conexion con el servidor de base de datos MySQL
	$conectar = new mysqli("localhost", "root", "");
	//seleccionar la base de datos para trabajar
	mysqli_select_db($conectar, "inventario");
	//sentencia sql para consultar el nombre del usuario
	$sql = "SELECT * FROM `usuarios` WHERE usuario='$usuario' AND clave=SHA1('$clave')";
	//ejecucion de la sentencia anterior
	$ejecutar_sql=mysqli_query($conectar,$sql);
	//Consulta los datos del usuario
	if (mysqli_num_rows($ejecutar_sql)>0){
		//inicio de sesion
		session_start();
		//configurar un elemento usuario dentro del arreglo global $_SESSION
		$_SESSION['inputid']=$usuario;
		//retornar verdadero
		return true;
	} else {
		//retornar falso
		return false;
	}
}
//funcion para verificar que dentro del arreglo global $_SESSION existe el nombre del usuario
function verificar_usuario(){
	//continuar una sesion iniciada
	session_start();
	//comprobar la existencia del usuario
	if ($_SESSION['inputid']){
		return true;
	}
}
?>