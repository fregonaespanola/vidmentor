<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>VidMentor - Registro</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/styles_header.css">
    <style>
        .swal-display-contents-center {
            justify-content: center!important;
        }

        .google-button {
            background-color: #ffffff;
            color: #4285F4;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #4285F4;
            padding: 0.75rem;
            font-size: 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .google-button:hover {
            background-color: #f1f1f1;
            transform: scale(1.05);
        }

        .google-logo {
            height: 1.5rem;
            margin-right: 0.5rem;
        }

        @media (max-width: 768px) {
            .max-w-md {
                width: 95%;
            }

            .text-2xl {
                font-size: 1.75rem;
            }
        }

        .register-container {
            animation: fadeIn 1s ease-in-out;
            margin: 2rem auto;
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

        .bg-row-register {
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
            height: 100%;
        }

        .row-register {
            font-weight: 100;
            margin-left: 20px;
        }

        .row-register b {
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

        .btn-register {
            background-color: #FF2525;
            color: white;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-register:hover {
            background-color: #d32f2f;
            transform: scale(1.05);
        }

        .focus\:scale-105:focus {
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .bg-row-register {
                padding: 2rem;
            }

            .img-logo-big {
                width: 150px;
                height: 100px;
            }

            .row-register {
                margin-left: 0;
            }
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

            .row-register {
                font-size: 1.25rem;
                margin-left: 0;
            }
        }
    </style>
</head>

<body class="background bg-gray-vidmentor-secondary text-white">
    <?php require_once("header.php"); ?>
    <div class="container-fluid flex flex-col lg:flex-row">
        <div class="col-lg-9 order-1 lg:order-2 flex items-center justify-center">
            <div class="register-container max-w-md w-full bg-gray-vidmentor-terciary rounded-lg p-8 shadow-lg">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-center mb-4">¡Únete a VidMentor!</h2>
                    <a class="link-log color-red-vidmentor-secondary" href="login.php">Iniciar sesión</a>
                </div>
                <div class="line border-b border-bottom-red-vidmentor-secondary mb-4"></div>
                <form action='procesar_registro.php' method='post' class='mb-3 mt-3'>
                    <!-- <pre><?php //var_dump($_SESSION['errors'] ?? '')?></pre> -->
                    <div class='mb-4'>
                        <label for='nombre' class='block text-sm font-semibold mb-2'>Nombre:</label>
                        <span class='text-red-500 text-xs'><?= $_SESSION['errors']['nombre']??'' ?></span>
                        <input type='text' id='nombre' name='nombre'
                               value="<?= htmlspecialchars($_SESSION['formData']['nombre'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                               class='w-full p-3 rounded bg-gray-vidmentor-secondary border border-bottom-red-vidmentor-secondary text-white focus:border-red-500 focus:outline-none transition-transform duration-300 focus:scale-105'
                               placeholder='Ingrese su nombre'>
                    </div>
                    <div class='mb-4'>
                        <label for='username' class='block text-sm font-semibold mb-2'>Nombre de Usuario:</label>
                        <span class='text-red-500 text-xs'><?= $_SESSION['errors']['username']??'' ?></span>
                        <input type='text' id='username' name='username'
                               value="<?= htmlspecialchars($_SESSION['formData']['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                               class='w-full p-3 rounded bg-gray-vidmentor-secondary border border-bottom-red-vidmentor-secondary text-white focus:border-red-500 focus:outline-none transition-transform duration-300 focus:scale-105'
                               placeholder='Ingrese su nombre de usuario'>
                    </div>
                    <div class='mb-4'>
                        <label for='email' class='block text-sm font-semibold mb-2'>Correo Electrónico:</label>
                        <span class='text-red-500 text-xs'><?= $_SESSION['errors']['email']??'' ?></span>
                        <input type='email' id='email' name='email'
                               value="<?= htmlspecialchars($_SESSION['formData']['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                               class='w-full p-3 rounded bg-gray-vidmentor-secondary border border-bottom-red-vidmentor-secondary text-white focus:border-red-500 focus:outline-none transition-transform duration-300 focus:scale-105'
                               placeholder='Ingrese su correo electrónico'>
                    </div>
                    <div class='mb-4'>
                        <label for='password' class='block text-sm font-semibold mb-2'>Contraseña:</label>
                        <span class='text-red-500 text-xs'><?= $_SESSION['errors']['password']??'' ?></span>
                        <input type='password' id='password' name='password'
                               value="<?= htmlspecialchars($_SESSION['formData']['password'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                               class='w-full p-3 rounded bg-gray-vidmentor-secondary border border-bottom-red-vidmentor-secondary text-white focus:border-red-500 focus:outline-none transition-transform duration-300 focus:scale-105'
                               placeholder='Ingrese su contraseña'>
                    </div>
                    <div class='mb-6'>
                        <label for='confirm_password' class='block text-sm font-semibold mb-2'>Confirmar Contraseña:</label>
                        <span class='text-red-500 text-xs'><?= $_SESSION['errors']['confirm_password'] ?? '' ?></span>
                        <input type='password' id='confirm_password' name='confirm_password'
                               value="<?= htmlspecialchars($_SESSION['formData']['confirm_password'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                               class='w-full p-3 rounded bg-gray-vidmentor-secondary border border-bottom-red-vidmentor-secondary text-white focus:border-red-500 focus:outline-none transition-transform duration-300 focus:scale-105'
                               placeholder='Confirme su contraseña'>
                    </div>
                    <button type='submit' class='btn-register w-full py-3 rounded'>Registrarse</button>
                </form>
                <div class="line border-b border-gray-600 mb-4"></div>
                <a href="oauthGoogle.php" class="w-full">
                    <button class="google-button w-full flex items-center justify-center py-3 mt-3 rounded-lg transition-transform transform hover:scale-105 duration-300">
                        <img src="assets/google logo.png" alt="Google Logo" class="google-logo"> Registrarse con Google
                    </button>
                </a>
            </div>
        </div>
        <div class="col-lg-3 order-2 lg:order-1 flex flex-col items-center text-center bg-row-register text-white">
            <img src="assets/logo 3.png" alt="Logo" class="img-logo-big responsive-img">
            <h2 class="mb-3 row-register">Lidera la <b>creación<br> de contenido</b></h2>
            <h3 class="mb-3 row-register">Conéctate directamente<br>con tu audiencia</h3>
            <img src="assets/diseño 2.png" alt="Imagen" class="mt-auto responsive-img">
        </div>
    </div>
    <?php
        require_once("footer.php");
        require 'insertSwal.php';
        unset($_SESSION['errors']);
        unset($_SESSION['formData']);
    ?>
</body>

</html>