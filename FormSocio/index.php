<?php include('conexion.php'); ?>

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
                <form action="altasocio.php" method="POST" id="formulario">
                    <!-- Alta ID Socio-->
                    <div class="form-group has-warning">
                        <input type="number" name="idsocio" class="form-control" placeholder="Ingrese aqui su ID" pattern="[1-9]{1,3}" maxlength="3" min="1" step="1" max="10000" required autofocus/>
                    </div>

                    <!--Alta Nombre-->
                    <div class="form-group has-warning">
                        <input type="text" name="nombre" class="form-control" placeholder="Ingrese su Nombre" pattern="[A-z]{3,20}" maxlength="20" required autofocus/>
                    </div>

                    <!--Alta Apellido-->
                    <div class="form-group has-warning">
                        <input type="text" name="apellido" class="form-control" placeholder="Ingrese Apellido" pattern="[A-z]{3,20}" maxlength="20" required autofocus/>
                    </div>

                    <!--Alta Direccion-->
                    <div class="form-group has-warning">
                        <input type="text" name="direccion" class="form-control" placeholder="Ingrese Dirección" pattern="[A-z A-z 0-9]{3,30}" maxlength="30" required autofocus/>
                    </div>

                    <!--Alta Edad-->
                    <div class="form-group has-warning">
                        <input type="number" name="edad" class="form-control" placeholder="Ingrese Edad" pattern="[0-9]{1,3}" maxlength="3" required min="1" step="1" max="100" autofocus/>
                    </div>

                    <!--Envio Formulario-->
                    <input type="submit" name="Registrarme" id="Registrarme" class="btn btn-success btn-bloc" value="Registrarme"/>
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
                    <span class="fa fa-search form-control-feedback">
                    <div id="searchLoad"></div>
                    </span>
                    <form action="index.php" method="POST">
                    <input type="search" name="busquedaSocio" id="busquedaSocio" class="form-control" placeholder="Buscar socio" autocomplete="off">
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
                
                <!-- Objeto resultado de DB socio -->
                
                <?php
                $querysocio = "SELECT * FROM socios";
                $resultado = mysqli_query($conexion, $querysocio);
                $array = array();
                while($tupla = mysqli_fetch_array($resultado)) {
                    $socio = utf8_encode($tupla['nombre']);
                    array_push($array, $socio);
                }
                ?>
                
                <!--Ajax Search -->

                <script type="text/javascript">
                    $(document).ready(function (){
                        var items = <?= json_encode($array); ?>
                        
                        $("#busquedaSocio").autocomplete({
                            source: items,
                            select: function (event, item) {
                                var params = {
                                    socio : item.item.value
                                };
                                $.get("getSocio.php", params, function (response) {
                                    console.log(response);
                                    var json = JSON.parse(response);
                                    if (json.status == 200){
                                        $("#busquedaSocio").html(json.nombre);
                                        $("#searchLoad").html("<img src='./img/pacman.gif' alt='Pacman Search' height='38' width='38'>");
                                    }else{
                                        
                                    }
                                });
                            }
                        });
                    });
                </script>
                
                <?php 
                if (!empty($_POST['busquedaSocio']) && ($_POST['busquedaSocio'] != "")){
                    $busquedasocio = trim($_POST['busquedaSocio']);
                    $query_search = "SELECT * FROM socios WHERE nombre='$busquedasocio' OR apellido='$busquedasocio' OR direccion='$busquedasocio' ORDER BY idsocio";
                    $result_query_search = mysqli_query($conexion, $query_search);
                    while($row = mysqli_fetch_assoc($result_query_search)){ ?>
                    <tbody>
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
</main>
<?php include('includes/footer.php'); ?>

