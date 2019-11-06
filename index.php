<?php include("conexion.php"); ?>

<?php include('includes/header.php'); ?>

<main class="container p-4">
    <div class="row">
        <div class="col-md-4">
            <!-- Mensajes -->

            <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message']?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <?php session_unset(); } ?>

            <!-- ADD TASK FORM -->
            <div class="card card-body">
                <form action="alta.php" method="POST">
                    <!-- Alta Cedula-->
                    <div class="form-group has-warning">
                    <label for="cedula" class="form-check-label">Cédula de Usuario sin puntos ni guiones:</label>
                        <input type="number" name="cedula" class="form-control" placeholder="Ingrese aqui Cedula" pattern="[1-9]{1,8}" maxlength="8" required autofocus/>
                    </div>

                    <!--Alta Nombre-->
                    <div class="form-group has-warning">
                    <label for="nombre" class="form-check-label">Nombre de Usuario:</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ingrese su Nombre" pattern="[A-z]{3,20}" maxlength="20" required autofocus/>
                    </div>

                    <!--Alta Apellido-->
                    <div class="form-group has-warning">
                        <label for="apellido" class="form-check-label">Apellidos de Usuario:</label>
                        <input type="text" name="apellido" class="form-control" placeholder="Ingrese Apellido" pattern="[A-z]{3,20}" maxlength="20" required autofocus/>
                    </div>

                    <!--Alta Contraseña-->
                    <div class="form-group has-warning">
                        <label for="passwd" class="form-check-label">Contraseña:</label>
                        <input type="password" name="contrasena" class="form-control" placeholder="Ingrese Contraseña" pattern="[A-z A-z 0-9]{3,30}" maxlength="30" required autofocus/>
                    </div>

                    <!--Alta Confirmo Contraseña-->
                    <div class="form-group has-warning">
                        <label for="confirmopasswd" class="form-check-label">Confirmar Contraseña:</label>
                        <input type="password" name="confirmocontrasena" class="form-control" placeholder="Confirme Contraseña" pattern="[A-z A-z 0-9]{3,30}" maxlength="30" required autofocus/>
                    </div>
                    
                    <!--Envio Formulario-->
                    <input type="submit" name="Registrarme" class="btn btn-success btn-bloc" value="Registrarme"/>
                    <input type="reset" name="Borra" class="btn btn-success btn-bloc" value="Limpiar"/>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <!-- Actual search box Bootstrap 4-->
                    <div class="form-group has-search">
                    <span class="fa fa-search form-control-feedback"></span>
                    <form action="index.php" method="POST">
                        <input type="search" name="busquedaUsuario" class="form-control" placeholder="Búsqueda" maxlength="20" autocomplete="off" required autofocus>
                    </form>
                    </div>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <?php if(isset($_POST['contrasena'])){echo '<th>Contraseña</th>';}?>
                    <th>Contraseña encriptada</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $query = "SELECT * FROM usuarios ORDER BY cedula";
                $result_query = mysqli_query($conexion, $query);
                while($row = mysqli_fetch_assoc($result_query)) { ?>
                <tr>
                    <td><?php echo $row['cedula']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['apellido']; ?></td>
                    <?php if (isset($_POST['contrasena'])){echo '<td>' .$contraseña. '</td>';}?>
                    <td><?php echo $row['contrasena']; ?></td>
                    <td>
                    <a href="editar.php?cedula=<?php echo $row['cedula']?>" class="btn btn-secondary">
                        <i class="fas fa-marker"></i>
                    </a>
                    <a href="borrar.php?cedula=<?php echo $row['cedula']?>" class="btn btn-danger">
                        <i class="far fa-trash-alt"></i>
                    </a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>

        <div class="col-md-8">
            <table class="table table-bordered">
            <thead>
            <tr>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Contraseña encriptada</th>
            </tr>
            </thead>

                <?php 
                if (!empty($_POST["busquedaUsuario"]) && ($_POST["busquedaUsuario"] != "")){
                    $busquedausuario = trim($_POST["busquedaUsuario"]);
                    $query_search = "SELECT * FROM usuarios WHERE cedula='$busquedausuario' OR nombre='$busquedausuario' OR apellido='$busquedausuario' ORDER BY cedula";
                    $result_query_search = mysqli_query($conexion, $query_search);
                    while($row = mysqli_fetch_assoc($result_query_search)){ ?>
                    <tbody>
                    <tr>
                        <td><?php echo $row['cedula']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['apellido']; ?></td>
                        <td><?php echo $row['contrasena']; ?></td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
        </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>