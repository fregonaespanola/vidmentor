<?php
session_start();
$_SESSION['usuario_id'] = 2; // Simulación de inicio de sesión de usuario
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>VidMentor - Intereses</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styles_dashboard.css">
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <?php require_once("header-dashboard.php"); ?>

    <div class="flex flex-grow">
        <?php require_once("sidebar-dashboard.php"); ?>

        <!-- Main content section -->
        <main class="flex-grow p-6">
            <div class="container mx-auto mt-6 bg-white shadow-md rounded-lg p-6">
                <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Selecciona tus intereses</h1>
                <div id="questions">
                    <div id="question1" class="text-center">
                        <h2 class="text-xl mb-4">¿A qué se quiere dedicar?</h2>
                        <div class="flex justify-center space-x-4">
                            <button class="btn btn-primary px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" onclick="nextQuestion('Vlogs')">Vlogs</button>
                            <button class="btn btn-primary px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" onclick="nextQuestion('Videojuegos')">Videojuegos</button>
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
</body>

</html>