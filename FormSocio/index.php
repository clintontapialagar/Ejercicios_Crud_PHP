<?php include("conexion.php"); ?>

<?php include('includes/header.php'); ?>


<main class="container p-2">
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
                <form action="altasocio.php" method="POST">
                    <!-- Alta ID Socio-->
                    <div class="form-group has-warning">
                        <input type="number" name="idsocio" class="form-control" placeholder="Ingrese aqui su ID" maxlength="3" required min="1" step="1" max="999" required autofocus autofocus/>
                    </div>

                    <!--Alta Nombre-->
                    <div class="form-group has-warning">
                        <input type="text" name="nombre" class="form-control" placeholder="Ingrese su Nombre" maxlength="20" required autofocus/>
                    </div>

                    <!--Alta Apellido-->
                    <div class="form-group has-warning">
                        <input type="text" name="apellido" class="form-control" placeholder="Ingrese Apellido" maxlength="20" required autofocus/>
                    </div>

                    <!--Alta Direccion-->
                    <div class="form-group has-warning">
                        <input type="text" name="direccion" class="form-control" placeholder="Ingrese Dirección" maxlength="30" required autofocus/>
                    </div>

                    <!--Alta Edad-->
                    <div class="form-group has-warning">
                        <input type="number" name="edad" class="form-control" placeholder="Ingrese Edad" maxlength="2" required min="1" step="1" max="99" autofocus/>
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
                        <input type="search" name="busquedaSocio" class="form-control" placeholder="Búsqueda de socio por nombre" maxlength="20" required autofocus>
                    </form>
                    </div>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Direccion</th>
                    <th>Edad</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $query = "SELECT * FROM socios ORDER BY idsocio";
                $result_query = mysqli_query($conexion, $query);
                while($row = mysqli_fetch_assoc($result_query)) { ?>
                <tr>
                    <td><?php echo $row['idsocio']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['apellido']; ?></td>
                    <td><?php echo $row['direccion']; ?></td>
                    <td><?php echo $row['edad']; ?></td>
                    <td>
                    <a href="editar.php?idsocio=<?php echo $row['idsocio']?>" class="btn btn-secondary">
                        <i class="fas fa-marker"></i>
                    </a>
                    <a href="borrar.php?idsocio=<?php echo $row['idsocio']?>" class="btn btn-danger">
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
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Direccion</th>
                    <th>Edad</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $busquedasocio = isset($_POST['busquedaSocio']);
                if (!empty($busquedasocio) && ($busquedasocio != "")){
                    $query_search = "SELECT * FROM socios WHERE nombre='$busquedasocio' ORDER BY idsocio";
                    $result_query_search = mysqli_query($conexion, $query_search);
                    while($row = mysqli_fetch_assoc($result_query_search)){ ?>
                    <tr>
                        <td><?php echo $row['idsocio']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['apellido']; ?></td>
                        <td><?php echo $row['direccion']; ?></td>
                        <td><?php echo $row['edad']; ?></td>
                    </tr>
                    <?php } ?>
        <?php } ?>
                </tbody>
            </table>
        </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>
