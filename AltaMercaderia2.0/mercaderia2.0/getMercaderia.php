
<?php 
//Inicia una nueva sesión o reanuda la existente
session_start();
?> 
<?php include('conexion.php');?>

<?php require('altalogin.php');?>
<?php
//uso de la funcion verificar_usuario()
if (verificar_usuario()){
    //si el usuario es verificado puede acceder al contenido permitido a el

// Consulta Ajax socio //
$output = '';

$sql = "SELECT * FROM mercaderia WHERE id LIKE '%".$_POST["search"]."%' OR nombre LIKE '%".$_POST["search"]."%' OR precio LIKE '%".$_POST["search"]."%' OR cantidad LIKE '%".$_POST["search"]."%' OR procedencia LIKE '%".$_POST["search"]."%' ORDER BY id";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result)>0){
    $output .= '<thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Procedencia</th>
                    </tr>
                </thead>
                <tbody>';
    while($row = mysqli_fetch_array($result)){
        $output .= '<tr>
                        <td>'.$row["id"].'</td>
                        <td>'.$row["nombre"].'</td>
                        <td>'.$row["precio"].'</td>
                        <td>'.$row["cantidad"].'</td>
                        <td>'.$row["procedencia"].'</td>
                    </tr>
                    </tbody>';
    }
    echo $output; 
} else{
    echo "No se encontraron datos";
}
}else {
    //si el usuario no es verificado volvera al formulario de ingreso
    echo "<script language='javascript'>";
    echo "alert('Debe loguearse primero')";
    echo "</script>";
    echo "<script type='text/javascript'>";
    echo "window.location = 'index.php'";
    echo "</script>";
    exit();
}
?>