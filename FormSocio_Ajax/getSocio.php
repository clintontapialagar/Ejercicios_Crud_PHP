<?php include('conexion.php'); ?>

<!-- Consulta Ajax socio -->
<?php
$output = '';

$sql = "SELECT * FROM socios WHERE nombre LIKE '%".$_POST["search"]."%'";
$result = mysqli_query($conexion, $sql);
if (mysqli_num_rows($result)>0){
    $output .= '<div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Direccion</th>
                            <th>Edad</th>
                        </tr>
                    </thead>';
    while($row = mysqli_fetch_array($result)){
        $output .= '
            <tr>
                <td>'.$row["idsocio"].'</td>
                <td>'.$row["nombre"].'</td>
                <td>'.$row["apellido"].'</td>
                <td>'.$row["direccion"].'</td>
                <td>'.$row["edad"].'</td>
            </tr>
        ';
    }
    echo $output;
} else{
    echo "No se encontraron datos";
}
?>