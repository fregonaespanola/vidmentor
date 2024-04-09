<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vidmentor</title>
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
  </head>
<body>
<?php require_once("header.php"); ?>
<div class="container-fluid">
        <div class="row row-left">
            <div class="col-lg-3 bg-row-login text-white">
                <div class="d-flex flex-column justify-content-between h-100 p-4">
                    <img src="assets/logo 3.png" alt="Logo" class="img-logo-big">
                    <h2 class="mb-3 row-login">Lidera la <b>creación<br> de contenido</b></h2>
                    <h3 class="mb-3 row-login">Conéctate directamente<br>con tu audiencia</h3>
                    <img src="assets/diseño 2.png" alt="Imagen" class="mt-auto">
                </div>
            </div>
            <div class="col-lg-9 d-flex align-items-center justify-content-center">
                <div class="login-form-container w-25">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="text-white">Iniciar sesión</h2>
                        <a class="link-log">Registrarse</a>
                    </div>
                    <div class="line"></div>
                    <form action="procesar_login.php" method="post" class="mb-3 mt-3">
                        <div class="mb-3">
                            <input type="email" class="form-control" name="usernameLogin" id="email" placeholder="Ingrese su correo electrónico">
                            <?php if(isset($errors['usernameLogin'])) { ?>
                                <span class="error"><?=$errors['usernameLogin']?></span>
                            <?php } ?>
                        </div>
                        <div class="mb-1">
                            <input type="password" class="form-control" name="passwordLogin" id="password" placeholder="Ingrese su contraseña">
                            <?php if(isset($errors['passwordLogin'])) { ?>
                                <span class="error"><?=$errors['passwordLogin']?></span>
                            <?php } ?>
                        </div>
                        <div class="mb-3 text-end">
                            <a href="#" class="forgot-password link-log">¿Has olvidado tu contraseña?</a>
                        </div>
                        <button type="submit" class="btn btn-login w-100 btn-danger">Iniciar sesión</button>
                        <?php if(isset($errors['login'])) { ?>
                            <span class="error"><?=$errors['login']?></span>
                        <?php } ?>
                    </form>
                    <div class="line"></div>
                    <a href="oauthGoogle.php"><button class="btn btn-google w-100 btn-primary mt-3"><img src="assets/google logo.png" alt="Google Logo" class="google-logo">Iniciar sesión con Google</button></a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
