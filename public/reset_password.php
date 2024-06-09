<?php
    session_start();
    if(!isset($_GET['token'])){
        redirect('index.php', [
            'title' => 'error',
            'text' => 'No se ha proporcionado un token de restablecimiento de contraseña.',
            'position' => 'center',
            'toast' => true,
            'showConfirmButton' => true,
            'confirmButtonText' => 'OK'
        ]);
    }
    $token = $_GET['token'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>VidMentor - Restablecer Contraseña</title>
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
            <h2 class="text-2xl font-semibold text-center mb-4">Restablecer Contraseña</h2>
            <form action="process_reset.php" method="post" class="mb-3 mt-3">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token, ENT_QUOTES, 'UTF-8'); ?>">
                <div class="mb-4">
                    <label for="password" class="block text-sm font-semibold mb-2">Nueva Contraseña:</label>
                    <input type="password" id="password" name="password"
                           class="w-full p-3 rounded bg-gray-vidmentor-secondary border border-bottom-red-vidmentor-secondary text-white focus:border-red-500 focus:outline-none transition-transform duration-300 focus:scale-105"
                           placeholder="Ingrese su nueva contraseña">
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="block text-sm font-semibold mb-2">Confirmar Contraseña:</label>
                    <input type="password" id="confirm_password" name="confirm_password"
                           class="w-full p-3 rounded bg-gray-vidmentor-secondary border border-bottom-red-vidmentor-secondary text-white focus:border-red-500 focus:outline-none transition-transform duration-300 focus:scale-105"
                           placeholder="Confirme su nueva contraseña">
                </div>
                <button type="submit" class="btn-login w-full py-3 rounded">Restablecer Contraseña</button>
            </form>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>
</body>
</html>
