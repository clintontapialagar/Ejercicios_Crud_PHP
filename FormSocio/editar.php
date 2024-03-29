<?php
include("conexion.php");
$idsocio = '';
$nombre= '';
$apellido= '';
$direccion= '';
$edad= '';
if  (isset($_GET['idsocio'])) {
  $idsocio = trim($_GET['idsocio']);
  $query = "SELECT * FROM socios WHERE idsocio=$idsocio";
  $result = mysqli_query($conexion, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $idsocio = $row['idsocio'];
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    $direccion = $row['direccion'];
    $edad = $row['edad'];
  }
}
if (isset($_POST['actualizar'])) {
  $idsocio = trim($_GET['idsocio']);
  $nombre= trim($_POST['nombre']);
  $apellido = trim($_POST['apellido']);
  $direccion = trim($_POST['direccion']);
  $edad = trim($_POST['edad']);
  $query = "UPDATE socios set nombre = '$nombre', apellido = '$apellido', direccion = '$direccion', edad = '$edad', fecha = now() WHERE idsocio=$idsocio";
  mysqli_query($conexion, $query);
  $_SESSION['message'] = 'Socio modificado con éxito';
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}
?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="editar.php?idsocio=<?php echo $_GET['idsocio']; ?>" method="POST">
        <div class="form-group">
            <input type="number" name="idsocio" class="form-control" value="<?php echo $idsocio; ?>" placeholder="Actualizar ID" pattern="[1-9]{1,3}" maxlength="3" max="10000" disabled>
        </div>
        <div class="form-group">
            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre;?>" placeholder="Actualizar nombre" pattern="[A-z]{3,20}" maxlength="20" required autofocus/>
        </div>
        <div class="form-group">
            <input type="text" name="apellido" class="form-control" value="<?php echo $apellido;?>" placeholder="Actualizar apellido" pattern="[A-z]{3,20}" maxlength="20" required autofocus/>
        </div>
        <div class="form-group">
            <input type="text" name="direccion" class="form-control" value="<?php echo $direccion;?>" placeholder="Actualizar direccion" pattern="[A-z A-z 0-9]{3,30}" maxlength="30" required autofocus/>
        </div>
        <div class="form-group">
            <input type="number" name="edad" class="form-control" value="<?php echo $edad;?>" placeholder="Actualizar edad" pattern="[0-9]{1,3}" maxlength="3" min="1" step="1" max="100" required autofocus/>
        </div>
        <button class="btn-success" name="actualizar">
          Actualizar
        </button>
      </form>
      </div>
    </div>
  </div>
</div>
<?php include('includes/footer.php'); ?>