<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>VidMentor - Iniciar Sesión</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style2.css">

    <style>
        body {
            background-color: #282828;
            color: #ffffff;
            font-family: 'Karla', sans-serif;
            padding: 0;
            margin: 0;
        }

        .login-container {
            background-color: #333333;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            animation: fadeIn 1s ease-in-out;
            margin: 2rem 0;
        }

        .login-container h2 {
            color: #E53935;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .login-container label {
            color: #ffffff;
        }

        .login-container input {
            background-color: #444444;
            border: 1px solid #555555;
            color: #ffffff;
        }

        .login-container input:focus {
            border-color: #E53935;
            outline: none;
        }

        .login-container button {
            background-color: #E53935;
            color: #ffffff;
        }

        .login-container button:hover {
            background-color: #d32f2f;
        }

        .login-container .link-log:hover {
            color: #E53935;
        }

        .google-button {
            background-color: #4285F4;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .google-button:hover {
            background-color: #357ae8;
        }

        .google-logo {
            height: 1.5rem;
            margin-right: 0.5rem;
        }

        .line {
            border-bottom: 1px solid #555555;
            margin: 1.5rem 0;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .bg-row-login {
            background-image: url('assets/diseño 3.png');
            background-color: #303030;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .img-logo-big {
            width: 200px;
            height: 140px;
        }

        .row-login {
            font-weight: 100;
            margin-left: 20px;
        }

        .row-login b {
            font-weight: 700;
        }

        .link-log {
            color: #FF5858;
            text-decoration: none;
            cursor: pointer;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .btn-login {
            background-color: #FF2525;
            color: white;
        }

        .btn-login:hover {
            background-color: #d32f2f;
        }

        .transition-transform {
            transition: transform 0.3s;
        }

        .focus\:scale-105:focus {
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .bg-row-login {
                padding: 2rem;
            }

            .img-logo-big {
                width: 150px;
                height: 100px;
            }

            .row-login {
                margin-left: 0;
            }
        }

        .img-logo-big {
            width: 200px;
            height: 140px;
        }

        .responsive-img {
            max-width: 100%;
            height: auto;
        }

        @media (max-width: 768px) {
            .img-logo-big {
                width: 150px;
                height: auto;
            }

            .responsive-img {
                max-width: 60%;
            }

            .row-login {
                font-size: 1.25rem;
                margin-left: 0;
            }
        }
    </style>
</head>

<body class="background">
    <?php require_once("header.php"); ?>
    <div class="container-fluid">
        <div class="row   lg:flex-row">
            <div class="col-lg-9 lg:order-2 order-1 d-flex align-items-center justify-content-center">
                <div class="login-container">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Iniciar sesión</h2>
                        <a class="link-log" href="register.php">Registrarse</a>
                    </div>
                    <div class="line"></div>
                    <form action="procesar_login.php" method="post" class="mb-3 mt-3">
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-semibold mb-2">Correo Electrónico:</label>
                            <input type="email" id="email" name="usernameLogin" class="w-full p-3 rounded focus:ring-2 focus:ring-red-500" placeholder="Ingrese su correo electrónico">
                            <?php if (isset($errors['usernameLogin'])) { ?>
                                <span class="text-red-500"><?= $errors['usernameLogin'] ?></span>
                            <?php } ?>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-semibold mb-2">Contraseña:</label>
                            <input type="password" id="password" name="passwordLogin" class="w-full p-3 rounded focus:ring-2 focus:ring-red-500" placeholder="Ingrese su contraseña">
                            <?php if (isset($errors['passwordLogin'])) { ?>
                                <span class="text-red-500"><?= $errors['passwordLogin'] ?></span>
                            <?php } ?>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <input type="checkbox" id="remember-me" name="remember-me" class="mr-2">
                                <label for="remember-me" class="text-sm">Recuérdame</label>
                            </div>
                            <a href="#" class="forgot-password link-log">¿Has olvidado tu contraseña?</a>
                        </div>
                        <button type="submit" class="w-full py-3 rounded bg-red-500 text-white hover:bg-red-600 transition-transform transform hover:scale-105 duration-300 btn-login">Iniciar sesión</button>
                        <?php if (isset($errors['login'])) { ?>
                            <span class="text-red-500"><?= $errors['login'] ?></span>
                        <?php } ?>
                    </form>
                    <div class="line"></div>
                    <a href="oauthGoogle.php">
                        <button class="w-full py-3 mt-3 rounded google-button transition-transform transform hover:scale-105 duration-300">
                            <img src="assets/google logo.png" alt="Google Logo" class="google-logo"> Iniciar sesión con Google
                        </button>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 lg:order-1 order-2 bg-row-login text-white d-flex flex-column justify-content-between align-items-center text-center">
                <img src="assets/logo 3.png" alt="Logo" class="img-logo-big responsive-img">
                <h2 class="mb-3 row-login">Lidera la <b>creación<br> de contenido</b></h2>
                <h3 class="mb-3 row-login">Conéctate directamente<br>con tu audiencia</h3>
                <img src="assets/diseño 2.png" alt="Imagen" class="mt-auto responsive-img">
            </div>
        </div>
    </div>
    <?php require_once("footer.php"); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', () => {
                    input.classList.add('focus:scale-105');
                    input.classList.add('transition-transform');
                    input.classList.add('duration-300');
                });

                input.addEventListener('blur', () => {
                    input.classList.remove('focus:scale-105');
                    input.classList.remove('transition-transform');
                    input.classList.remove('duration-300');
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>