<?php
//Inicia una nueva sesión o reanuda la existente
session_start();
?>
<?php require('altalogin.php'); ?>
<?php
if (verificar_usuario()){
//si el usuario es verificado puede acceder al contenido permitido a el
include("conexion.php");
$idmercaderia = '';
$nombre= '';
$precio= '';
$cantidad= '';
$procedencia= '';
if  (isset($_GET['idmercaderia'])) {
  $idmercaderia = trim($_GET['idmercaderia']);
  $query = "SELECT * FROM mercaderia WHERE id=$idmercaderia";
  $result = mysqli_query($conexion, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $idmercaderia = $row['id'];
    $nombre = $row['nombre'];
    $precio = $row['precio'];
    $cantidad = $row['cantidad'];
    $procedencia = $row['procedencia'];
  }
}
if (isset($_POST['actualizar'])) {
  $idmercaderia = trim($_GET['idmercaderia']);
  $nombre= trim($_POST['nombre']);
  $precio = trim($_POST['precio']);
  $cantidad = trim($_POST['cantidad']);
  $procedencia = trim($_POST['procedencia']);
  $query = "UPDATE mercaderia set nombre = '$nombre', precio = '$precio', cantidad = '$cantidad', procedencia = '$procedencia', fecha = now() WHERE id=$idmercaderia";
  mysqli_query($conexion, $query);
  $_SESSION['message'] = 'Mercaderia modificada con éxito';
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}
?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="editar.php?idmercaderia=<?php echo $_GET['idmercaderia']; ?>" method="post">
        <div class="form-group">
          <input type="number" name="idmercaderia" class="form-control" value="<?php echo $idmercaderia; ?>" placeholder="Actualizar ID" pattern="[1-9]{1,3}" maxlength="3" max="10000" disabled/>
        </div>
        <div class="form-group">
          <input type="text" name="nombre" class="form-control" value="<?php echo $nombre;?>" placeholder="Actualizar descripcion" pattern="[A-z]{3,15}" maxlength="15" required autofocus/>
        </div>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">$</div>
          </div>
            <input type="number" name="precio" class="form-control" value="<?php echo $precio;?>" placeholder="Actualizar precio" pattern="[0-9]{1,3}" maxlength="3" required autofocus/>
          </div>
        </div>
        <div class="form-group">
          <input type="number" name="cantidad" class="form-control" value="<?php echo $cantidad;?>" placeholder="Actualizar cantidad" pattern="[0-9]{1,3}" maxlength="3" required min="1" step="1" max="100" autofocus/>
        </div>
        <div class="form-group">
          <input type="text" name="procedencia" class="form-control" value="<?php echo $procedencia;?>" placeholder="Actualizar procedencia" pattern="[A-z]{1,9}" maxlength="9" required autofocus/>
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
<?php
}else{
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