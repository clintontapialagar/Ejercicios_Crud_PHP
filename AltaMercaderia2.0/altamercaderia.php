<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- Bootstrap CSS -->
<title>Altamercaderia</title>	
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<?php
require('altalogin.php');
//uso de la funcion verificar_usuario()
if (verificar_usuario()){
//si se ha pulsado el botón enviar limpio campos
	
if (isset($_POST['Registrar'])){

	$numeroid = trim($_POST['id']);
    $nombre = trim($_POST['nombre']);
    $precio = trim($_POST['precio']);
	$cantidad = trim($_POST['cantidad']);
    $procedencia = trim($_POST['procedencia']);

	// validamos que se hayan enviado los campos y sean válidos
	
	if (!empty($numeroid) && (is_numeric($numeroid)) && ($numeroid !="0") && (!empty($nombre)) && (!is_numeric($nombre)) && (!empty($precio)) && (($precio)>1) && (!empty($cantidad)) && (($cantidad)>1) && (!empty($procedencia))){
	
	//conexion con base de datos
	$servidor_db="localhost";
    $usuario_db="root";
    $clave_db="";
    $db_nombre="inventario";
	$nombretabla="mercaderia";
	$conexion=new mysqli($servidor_db,$usuario_db,$clave_db,$db_nombre) or die ("No se ha podido conectar al servidor de Base de datos ") . mysqli_connect_error();
	
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
	} else {
		
		//mostramos si hay algun error al insertar el registro
		
		echo "Error: " . $altaquery . "" . mysqli_error($conexion);
	}
	}

	////////////////////////ESTADISTICAS////////////////////////////////////
		
	//querys ya guardadas para su uso
	$articulosnacionales = "SELECT sum(cantidad) FROM $nombretabla where procedencia='Nacional'";
	$consulta2 = "SELECT * FROM mercaderia ORDER BY precio";
	$consulta3 = "SELECT count(id) FROM $nombretabla";
	$preciobarato = "SELECT COUNT(precio) FROM $nombretabla WHERE precio BETWEEN 1 AND 50";
	$precioaccesible = "SELECT COUNT(precio) FROM $nombretabla WHERE precio BETWEEN 50 AND 100";
	$preciocaro = "SELECT COUNT(precio) FROM $nombretabla WHERE precio>100";
	$preciototal = "SELECT sum(precio) from $nombretabla";
	$cantidad = "SELECT sum(cantidad) from $nombretabla";
		
	$res = mysqli_query($conexion,$consulta3);
	
	//compruebo si existen filas, y si las hay tiro las query de arriba para traerlas y mostrarlas
	if (mysqli_num_rows($res)>0){
	
	$resconsultaarticulos = $conexion->query ($consulta3);
	$filaconsulta3 = mysqli_fetch_array($resconsultaarticulos);
	echo "<br><br>";
	echo "Cantidad de articulos ingresados: " . $filaconsulta3[0];
		
	$resconsulta1 = $conexion->query ($articulosnacionales);
	$filaonsulta1 = mysqli_fetch_array($resconsulta1);

	$restotal = $conexion->query ($cantidad);
	$filatotal = mysqli_fetch_array($restotal);


	echo "<br><br>";
	echo "Porcentaje de articulos nacionales: " . round($filaonsulta1[0] / $filatotal[0] * 100,0,PHP_ROUND_HALF_UP) . "%";
	echo "<br><br>";
	
	$respreciobarato = $conexion->query ($preciobarato);
	$filapreciobarato = mysqli_fetch_array($respreciobarato);	
	echo "Articulos baratos: " . $filapreciobarato[0];
	echo "<br><br>";
		
	$resprecioaccesible = $conexion->query ($precioaccesible);
	$filaprecioaccesible = mysqli_fetch_array($resprecioaccesible);	
	echo "Articulos accesibles: " . $filaprecioaccesible[0];
	echo "<br><br>";
	
	$respreciocaro = $conexion->query ($preciocaro);
	$filapreciocaro = mysqli_fetch_array($respreciocaro);	
	echo "Articulos caros: " . $filapreciocaro[0];
	echo "<br><br>";

	$restotal = $conexion->query ($cantidad);
	$filatotal = mysqli_fetch_array($restotal);

	echo "Articulos totales: " . $filatotal[0];
	echo "<br><br>";
		
	//creo la tabla y me paseo por el array para llenar las filas
	
	echo "<div class='table-responsive'>";
	echo "<table class='table table-condensed' cellpadding='10' cellspacing='2'>";
	echo "<tr bgcolor =#baf291>";
	echo "<td class='info'>ID nº</td>";
	echo "<td class='info'>Nombre</td>";
	echo "<td class='info'>Precio</td>";
	echo "<td class='info'>Cantidad</td>";
	echo "<td class='info'>Procedencia</td>";
	echo "</tr>";
	echo "</div>";
		
	$resultado = $conexion->query($consulta2);
	while($fila = mysqli_fetch_array($resultado)){

		echo "<tr><td>" . $fila['id'] . 
			"</td><td>" . $fila['nombre'] . 
			"</td><td>" . $fila['precio'] . 
			"</td><td>" . $fila['cantidad'] . 
			"</td><td>" . $fila['procedencia'] . 
			"</td></tr>";
		}
		
	echo "</table>";
		
	//Libero y cierro conexion
		
	mysqli_free_result($resultado);
	mysqli_close($conexion);
		
} else {
		
	//mostramos que no hay registros para mostrar en pantalla
		
	echo "No hay registros ingresados para mostrar" . "$altaquery" . mysqli_error($conexion);
}
	

}else{
	echo "<script language='javascript'>";
	echo "alert('Verifique los campos ingresados,y vuelva a enviar el formulario')";
	echo "</script>";
	echo "<script type='text/javascript'>";
	echo "window.location = 'index.php'";
	echo "</script>";
    exit();
	}
}else{
	echo "<script language='javascript'>";
	echo "alert('Error al enviar o procesar el formulario, vuelva a intentarlo mas tarde')";
	echo "</script>";
	echo "<script type='text/javascript'>";
	echo "window.location = 'index.php'";
	echo "</script>";
    exit();
}
} else {
	//si el usuario no es verificado volvera al formulario de ingreso
	header('Location: index.php');
	
}
?>
<br><br>
<input type="button" value="Dar de alta mas mercaderia" onclick="history.go(-1)">

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>