<?php include('conexion.php'); ?>

<!-- Consulta Ajax socio -->
<?php
$output = '';

$sql = "SELECT * FROM socios WHERE idsocio LIKE '%".$_POST["search"]."%' OR nombre LIKE '%".$_POST["search"]."%' OR apellido LIKE '%".$_POST["search"]."%' OR direccion LIKE '%".$_POST["search"]."%' OR edad LIKE '%".$_POST["search"]."%'";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result)>0){
    $output .= '<thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Direccion</th>
                        <th>Edad</th>
                    </tr>
                </thead>
                <tbody>
                ';
    while($row = mysqli_fetch_array($result)){
        $output .= '<tr>
                        <td>'.$row["idsocio"].'</td>
                        <td>'.$row["nombre"].'</td>
                        <td>'.$row["apellido"].'</td>
                        <td>'.$row["direccion"].'</td>
                        <td>'.$row["edad"].'</td>
                    </tr>
                    </tbody>';
    }
    echo $output; 
} else{
    echo "No se encontraron datos";
}
?>