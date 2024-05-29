<?php
session_start();
$_SESSION['usuario_id'] = 2; // Simulación de inicio de sesión de usuario
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vidmentor - Intereses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Selecciona tus intereses</h1>
        <div id="questions">
            <div id="question1">
                <h2>¿A qué se quiere dedicar?</h2>
                <button class="btn btn-primary" onclick="nextQuestion('Vlogs')">Vlogs</button>
                <button class="btn btn-primary" onclick="nextQuestion('Videojuegos')">Videojuegos</button>
            </div>
        </div>
    </div>
    <input type="hidden" id="usuario_id" value="<?php echo $_SESSION['usuario_id']; ?>">
</body>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/form_intereses.js"></script>
