<?php
    require('check_session.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>VidMentor - Recuperar Contraseña</title>
    <link rel='icon' type='image/x-icon' href='assets/favicon.ico'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'
          integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'>
    <link href='https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='css/style2.css'>
    <link rel='stylesheet' href='css/styles_header.css'>
</head>
<body class="background bg-gray-vidmentor-secondary text-white">
    <?php require_once('header.php'); ?>
    <div class="container-fluid flex flex-col lg:flex-row">
        <div class="col-lg-9 order-1 lg:order-2 flex items-center justify-center">
            <div class="login-container max-w-md w-full bg-gray-vidmentor-terciary rounded-lg p-8 shadow-lg">
                <h2 class="text-2xl font-semibold text-center mb-4">Recuperar Contraseña</h2>
                <form action="process_recovery.php" method="post" class="mb-3 mt-3">
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-semibold mb-2">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="w-full p-3 rounded bg-gray-vidmentor-secondary border border-bottom-red-vidmentor-secondary text-white focus:border-red-500 focus:outline-none transition-transform duration-300 focus:scale-105" placeholder="Ingrese su correo electrónico">
                    </div>
                    <button type="submit" class="btn-login w-full py-3 rounded">Enviar Enlace de Recuperación</button>
                </form>
            </div>
        </div>
    </div>
    <?php
        require_once('footer.php');
        require('insertSwal.php');
    ?>
</body>
</html>
