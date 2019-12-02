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
            <h5 class="card-title">Alta de mercaderia</h5>
                <form action="altamercaderia.php" method="post" id="formulario">
                    <!-- Alta ID Mercaderia-->
                    <div class="form-group has-warning">
                        <input class="form-control" type="number" id="id" name="id" placeholder="Ingrese aqui ID" maxlength="3" required min="1" step="1" max="999" required autfocus/>
                    </div>

                    <!--Alta Descripcion-->
                    <div class="form-group has-warning">
                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Ingrese descripcion" pattern="[A-z]{3,15}" maxlength="15" required autofocus/>  
                    </div>

                    <!--Alta Precio-->
                    <div class="form-group has-warning">
                        <input class="form-control" type="number" id="precio" name="precio" placeholder="Ingrese precio unitario" pattern="[0-9]{1,3}" maxlength="3" required autofocus/>
                    </div>

                    <!--Alta Cantidad-->
                    <div class="form-group has-warning">
                        <input class="form-control" type="number" id="cantidad" name="cantidad" placeholder="Ingrese cantidad" pattern="[0-9]{1,3}" maxlength="3" required min="1" step="1" max="100" autofocus/>   
                    </div>

                    <!--Alta Procedencia-->
                    <div class="form-group has-warning">
                        <div class="form-check has-warning col-md-10">
                            <input class="form-check-input" type="radio" name="procedencia" id="nacional" value="Nacional" required/>
                            <label class="form-check-label" for="radio1">Nacional</label>
                        </div>

                        <div class="form-check has-warning col-md-10">
                            <input class="form-check-input" type="radio" name="procedencia" id="importado" value="Importado" required/>
                            <label class="form-check-label" for="radio2">Importado</label>
                        </div>
                    </div>

                    <!--Envio Formulario-->
                    <input type="submit" name="Registrar" id="Registrar" class="btn btn-success btn-bloc" value="Registrar"/>
                    <input type="reset" name="Borra" class="btn btn-success btn-bloc" value="Limpiar"/>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Actual search box Bootstrap 4-->
            <div class="form-group has-search">
                <span class="fa fa-search form-control-feedback">
            </span>
            <form action="mercaderia.php" method="POST">
                <input type="search" name="busquedaMercaderia" id="busquedaMercaderia" class="form-control" placeholder="Buscar mercaderia" autocomplete="off">
            </form>
            </div>
            <!-- Tabla mercaderia -->
            <div data-spy="scroll" data-target="col-md-8" data-offset="0">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Procedencia</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT * FROM mercaderia ORDER BY id";
                    $result_query = mysqli_query($conexion, $query);
                    while($row = mysqli_fetch_assoc($result_query)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['precio']; ?></td>
                        <td><?php echo $row['cantidad']; ?></td>
                        <td><?php echo $row['procedencia']; ?></td>
                        <td>
                        <a href="editar.php?idmercaderia=<?php echo $row['id']?>" class="btn btn-secondary">
                            <i class="fas fa-marker"></i>
                        </a>
                        <a href="borrar.php?idmercaderia=<?php echo $row['id']?>" class="btn btn-danger">
                            <i class="far fa-trash-alt"></i>
                        </a>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Tabla búsqueda de socio -->
            <table id="resultado" class="table table-bordered"></table>
        </div>
    </div>
</main>