<?php

//funcion para conectar a la base de datos y verificar la existencia del usuario
function conexiones($usuario, $clave) {
	//conexion con el servidor de base de datos MySQL
	$conectar = new mysqli("localhost", "root", "", "inventario");
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


//validar formulario Mercaderia
function validaUsuario() {
    session_start();
    if (isset($_SESSION['inputid']) && (isset($_SESSION['nombre'])) && isset($_SESSION['precio']) && isset($_SESSION['cantidad']) && isset($_SESSION['procedencia'])){
		
	    if (!empty($_SESSION['inputid']) && (is_numeric($_SESSION['inputid'])) && ($_SESSION['inputid'] !="0") && (!empty($_SESSION['nombre'])) && (!is_numeric($_SESSION['nombre'])) && (!empty($_SESSION['precio'])) && (($_SESSION['precio'])>1) && (!empty($_SESSION['cantidad'])) && (($_SESSION['cantidad'])>1) && (!empty($_SESSION['procedencia']))){
		    return true;
	    } else {
            return false;
	    }
	}
}

//valida conexion Mercaderia

function validaConexion(){
	//conexion con base de datos
	$servidor_db="localhost";
	$usuario_db="root";
	$clave_db="";
	$nombre_db="inventario";
	$nombretabla="mercaderia";
	$conexion=new mysqli($servidor_db,$usuario_db,$clave_db,$nombre_db) or die ("No se ha podido conectar al servidor de Base de datos ") . mysqli_connect_error();

	//validamos no halla resultados duplicados
	$numeroidquery = mysqli_query($conexion,"select id from $nombretabla where id='$numeroid'");
	if (mysqli_num_rows($numeroidquery)>0){
		//si existen duplicados muestro mensaje
		echo "<script language='javascript'>";
		echo "alert('Error, ya hay una mercaderia registrado con ese número de id')";
		echo "</script>";
	} else {

	//Tabla mercaderia

	//"CREATE TABLE IF NOT EXISTS mercaderia (id INT(3) NOT NULL PRIMARY KEY,nombre VARCHAR(15) NOT NULL,precio INT(3) NOT NULL,cantidad INT(3) NOT NULL,procedencia VARCHAR(10) NOT NULL) ENGINE=INNODB";
	
	// Si no hay resultados, ingresamos el registro a la base de datos
		
	$altaquery="INSERT INTO mercaderia (id, nombre, precio, cantidad, procedencia ) VALUES ('$numeroid', '$nombre', '$precio', '$cantidad', '$procedencia')";
		
	if (mysqli_query($conexion,$altaquery)) {
		//Imprimimos que se ingreso correctamente
		echo "Nuevo Registro creado con éxito.";
		return true;
	} else {
		//mostramos si hay algun error al insertar el registro
		echo "Error: " . $altaquery . "" . mysqli_error($conexion);
        return false;
	}
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
