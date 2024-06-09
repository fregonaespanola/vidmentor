<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if(!isset($_SESSION['user_id'])){
        $error = 'Necesitas autenticarte para acceder a esta página.';
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ideas Guardadas - Vidmentor</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-vidmentor-primary flex flex-col min-h-screen">

<?php
    if(!isset($error)){
        require_once('header-dashboard.php');
        ?>

        <div class="flex flex-grow">
            <?php require_once('sidebar-dashboard.php'); ?>
            <div class="ideas">
                <div class='container mx-auto px-4'>
                    <h2 class='text-4xl font-bold text-white mb-6 mt-4 text-center'>Ideas Guardadas</h2>
                    <?php require_once('ideas_guardadas.php'); ?>
                    <?php require_once('calendar_raw.php'); ?>
                </div>
            </div>
        </div>

        <?php
    }
    else{
        ?>
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-3xl font-bold text-red-500 mb-4 text-center">Error</h2>
            <p class="text-lg text-white text-center mb-4"><?php echo $error; ?></p>
            <p class="text-lg text-white text-center"><a href="login.php" class="underline">Iniciar sesión</a></p>
        </div>
        <?php
    }
?>

<script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/user_list.js"></script>
<script src="js/calendar.js"></script>
<script src="js/calendar_drag.js"></script>
</body>
</html>
