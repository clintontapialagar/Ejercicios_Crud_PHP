<?php
include("conexion.php");
$cedula = '';
$nombre= '';
$apellido= '';
$contraseña= '';

if  (isset($_GET['cedula'])) {
  $cedula = trim($_GET['cedula']);
  $query = "SELECT * FROM usuarios WHERE cedula=$cedula";
  $result = mysqli_query($conexion, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $cedula = $row['cedula'];
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    $contraseña = $row['contrasena'];
  }
}
if (isset($_POST['actualizar'])) {
  $cedula = trim($_GET['cedula']);
  $nombre= trim($_POST['nombre']);
  $apellido = trim($_POST['apellido']);
  $contraseña = trim(sha1($_POST['contrasena']));
  $query = "UPDATE usuarios set nombre = '$nombre', apellido = '$apellido', contrasena = '$contraseña', fecha = now() WHERE cedula=$cedula";
  mysqli_query($conexion, $query);
  $_SESSION['message'] = 'Usuario modificado con éxito';
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}
?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="editar.php?cedula=<?php echo $_GET['cedula']; ?>" method="POST">
        <div class="form-group">
            <input type="number" name="cedula" class="form-control" value="<?php echo $cedula; ?>" placeholder="Actualizar cedula" pattern="[0,9]{1,8}" maxlength="8" disabled>
        </div>
        <div class="form-group">
            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre;?>" placeholder="Actualizar nombre" pattern="[A-z]{3,20}" maxlength="20" required autofocus/>
        </div>
        <div class="form-group">
            <input type="text" name="apellido" class="form-control" value="<?php echo $apellido;?>" placeholder="Actualizar apellido" pattern="[A-z]{3,20}" maxlength="20" required autofocus/>
        </div>
        <div class="form-group">
            <input type="password" name="contrasena" class="form-control" value="<?php echo $contraseña;?>" placeholder="Actualizar contraseña" pattern="[A-z A-Z 0-9]{3,30}" maxlength="50" required autofocus/>
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