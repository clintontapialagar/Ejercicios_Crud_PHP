<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>AltaMercaderia</title>
    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php
require('altalogin.php');
//uso de la funcion verificar_usuario()
if (verificar_usuario()){

	//si el usuario es verificado puede acceder al contenido permitido a el
    print '
    <div class="container-fluid">
    <header>
        <h3>Alta de mercaderia</h3>
    </header>
    <form name ="forminventario" action="altamercaderia.php" class="form-horizontal" method="post">
    <hr />

    <!--Alta 1-->
    <div class="form-group has-warning">
        <label class="control-label col-md-3" for="id">Codigo de la Mercaderia:</label>
        <div class="col-md-10">
            <input class="form-control" type="number" id="id" name="id" placeholder="Ingrese aqui Codigo" maxlength="3" required min="1" step="1" max="999" required>
        </div>
    </div>

     <!--Alta 2-->
    <div class="form-group has-warning">
        <label class="control-label col-md-5" for="descripcion">Ingrese la Descripcion de la Mercaderia:</label>
        <div class="col-md-10">
            <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Ingrese Descripcion" maxlength="15" required>  
        </div>
    </div>

    <!-- Alta 3-->
    <div class="form-group has-warning">
        <label class="control-label col-md-5" for="precio">Ingrese precio unitario de la Mercaderia:</label>
        <div class="col-md-10">
            <input class="form-control" type="number" id="precio" name="precio" placeholder="Ingrese precio unitario" maxlength="3" required>
        </div>
    </div>
    
    <!--Alta 4-->
    <div class="form-group has-warning">
        <label class="control-label col-md-5" for="existencia">Ingrese la cantidad en Stock:</label>
        <div class="col-md-10">
            <input class="form-control" type="number" id="cantidad" name="cantidad" placeholder="Ingrese existencia" maxlength="3" required min="1" step="1" max="100" required>   
        </div>
    </div>

    <!--Alta 5-->
    <div class="form-check>
        <label class="form-check-label col-md-5" for="deporte">Procedencia Mercaderia</label>
    </div>
    <div class="form-check" has-warning">
            <input class="form-check-input" type="radio" name="procedencia" id="nacional" value="Nacional" required>
            <label class="form-check-label" for="radio1">
                Nacional
            </label>
    </div>
    <div class="form-check" has-warning">
        <input class="form-check-input" type="radio" name="procedencia" id="importado" value="Importado" required>
        <label class="form-check-label" for="radio2">
            Importado
        </label>
    </div>

    <!--Envio Formulario-->
    <div class="form-group">
        <div class="col-md-10">
            <input class="btn btn-primary" type="submit" id="Registrarme" name="Registrar" value="Registrar"/>
            <input class="btn btn-primary" type="reset" name="Borra" value="Borrar"/>
        </div>
    </div>
    </form>
</div>';

echo "<br>";

print "<div class='form-group'>
            <div class='col-md-10'>
                Hola $_SESSION[inputid] <a class='btn btn-primary' href='logout.php'>Salir</a><br/>
            </div>
        </div>";
} else {
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
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>