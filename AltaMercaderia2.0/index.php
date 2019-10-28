<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
<meta name="generator" content="Jekyll v3.8.5">
<title>Login Sistema Mercaderia</title>
<link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">
    <!-- Bootstrap core CSS -->
<link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>

    .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    }

    @media (min-width: 768px) {
    .bd-placeholder-img-lg {
        font-size: 3.5rem;
    }
    }

</style>
    <!-- Custom styles for this template -->
<link href="https://getbootstrap.com/docs/4.3/examples/sign-in/signin.css" rel="stylesheet">
</head>
<body class="text-center">
    <!--Formulario de Ingreso al Sistema-->
    <form name="formlogin" action="index2.php" class="form-signin" method="post">
        <img class="mb-4" src="https://image.flaticon.com/icons/svg/813/813896.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Log-In</h1>
        <label for="inputid" class="sr-only">Usuario</label>
        <input type="text" id="inputid" name="inputid" class="form-control" placeholder="Usuario" maxlength="10" required autofocus>
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input type="password" id="inputPassword" name="inputpassword" class="form-control" placeholder="Contraseña" maxlength="10" required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Recordar contraseña
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="Ingresar" value="Ingresar">Ingresar al Sistema</button>
        <p class="mt-5 mb-3 text-muted">&copy; Sistema Mercadería 2.0</p>
    </form>
</body>
</html>