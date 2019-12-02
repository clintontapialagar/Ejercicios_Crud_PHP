<?php include('includes/header.php'); ?>

<body class="text-center">
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
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
    </div>
</div>

<?php include('includes/footer.php'); ?>