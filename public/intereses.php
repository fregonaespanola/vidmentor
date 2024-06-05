<?php
session_start();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>VidMentor - Intereses</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .background-image {
            background-size: cover;
            background-position: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
    </style>
</head>

<body class="bg-gray-vidmentor-primary text-white flex flex-col min-h-screen relative">
    <div class="background-image"></div>
    <?php require_once("header-dashboard.php"); ?>

    <div class="flex flex-grow">
        <?php require_once("sidebar-dashboard.php"); ?>

        <!-- Main content section -->
        <main class="flex-grow flex justify-center items-center p-6 main-content">
            <div class="w-full max-w-3xl bg-gray-vidmentor-secondary bg-opacity-90 shadow-lg rounded-lg p-10">
                <h1 class="text-5xl font-bold text-center text-white mb-10">Selecciona tus intereses</h1>
                <div id="questions">
                    <div id="question1" class="text-center">
                        <input id="usuario_id" class="hidden" value="<?php echo $_SESSION['usuario_id']?>">
                        <h2 class="text-3xl mb-8 text-white">¿Qué tipo de contenido tienes pensado subir a tu canal?</h2>
                        <div class="grid grid-cols-2 gap-6 mb-8">
                            <button class="btn px-6 py-4 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 focus:outline-none" onclick="nextQuestion('Videojuegos')">Videojuegos</button>
                            <button class="btn px-6 py-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none" onclick="nextQuestion('Desarrollo')">Desarrollo</button>
                            <button class="btn px-6 py-4 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 focus:outline-none" onclick="nextQuestion('Vlogs')">Vlogs</button>
                            <button class="btn px-6 py-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none" onclick="nextQuestion('Reacciones')">Reacciones</button>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="usuario_id" value="<?php echo $_SESSION['usuario_id']; ?>">
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/form_intereses.js"></script>