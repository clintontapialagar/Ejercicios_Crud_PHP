<?php include('conexion.php'); ?>

<!-- Consulta Ajax usuario -->
<?php
$output = '';

$sql = "SELECT * FROM usuarios WHERE cedula LIKE '%".$_POST["search"]."%' OR nombre LIKE '%".$_POST["search"]."%' OR apellido LIKE '%".$_POST["search"]."%'";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result) ==1){
    $output .= '<thead>
                    <tr>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Contraseña</th>
                    </tr>
                </thead>
                <tbody>';
    while($row = mysqli_fetch_array($result)){
        $output .= '<tr>
                        <td>'.$row["cedula"].'</td>
                        <td>'.$row["nombre"].'</td>
                        <td>'.$row["apellido"].'</td>
                        <td>'.$row["contrasena"].'</td>
                    </tr>
                    </tbody>';
    }
    echo $output; 
} else{
    echo "No se encontraron datos";
}
?>