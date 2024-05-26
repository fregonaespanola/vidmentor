<?php
session_start();

// Verifica si el usuario está autenticado
if(isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];

    // Configura los detalles de la conexión a la base de datos
    $dsn = "mysql:host=localhost;dbname=PROYECTO;charset=utf8mb4";
    $username = "PROYECTO";
    $password = "11223344";

    // Manejo de solicitud POST para actualizar la fecha de la idea en la base de datos
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ideaId']) && isset($_POST['date'])) {
        $ideaId = $_POST['ideaId'];
        $date = $_POST['date'];

        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepara la consulta para actualizar la fecha de la idea
            $stmt = $pdo->prepare("UPDATE DETALLE SET FECHA = :date WHERE ID = :ideaId AND ID_USUARIO = :usuario_id");
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':ideaId', $ideaId);
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->execute();

            echo "La fecha de la idea se ha actualizado correctamente.";
            exit; // Salir del script después de imprimir la respuesta
        } catch (PDOException $e) {
            echo "Error al actualizar la fecha de la idea: " . $e->getMessage();
            exit; // Salir del script después de imprimir la respuesta
        }
    }

    // Si no hay una solicitud POST para actualizar la fecha de la idea, mostrar los títulos de las ideas asociadas al usuario
    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepara la consulta para seleccionar los títulos de ideas asociados al usuario
        $stmt = $pdo->prepare("SELECT ID, NOMBRE FROM DETALLE WHERE ID_USUARIO = :usuario_id");
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();

        // Muestra los títulos de ideas asociados al usuario
        echo "<h2 class='color-white'>Títulos de Ideas</h2>";
        echo "<ul class='color-white'>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<li draggable='true' ondragstart='drag(event)' id='" . $row['ID'] . "'>" . $row['NOMBRE'] . " <button class='btn-delete' data-id='" . $row['ID'] . "'>Eliminar</button> <a href='forms_container.php?id=" . $row['ID'] . "' class='btn-edit' data-id='" . $row['ID'] . "'>Editar</a></li>";
        }
        echo "</ul>";
    } catch (PDOException $e) {
        echo "Error al obtener los títulos de las ideas: " . $e->getMessage();
    }
} else {
    echo "El usuario no está autenticado.";
}
?>


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

<div class="calendar">
    <div class="calendar-header">
        <button class="prev-month">&lt;</button>
        <h2 class="month-year">Mayo 2024</h2>
        <button class="next-month">&gt;</button>
    </div>
    <div class="calendar-body" ondrop="drop(event)" ondragover="allowDrop(event)">
        <div class="calendar-row">
            <div class="calendar-day">Lun</div>
            <div class="calendar-day">Mar</div>
            <div class="calendar-day">Mié</div>
            <div class="calendar-day">Jue</div>
            <div class="calendar-day">Vie</div>
            <div class="calendar-day">Sáb</div>
            <div class="calendar-day">Dom</div>
        </div>
        <div class="tooltip-container"></div>

        <!-- Aquí se generarán dinámicamente los días del mes -->
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/user_list.js"></script>
    <script src="js/calendar.js"></script>
    <script src="js/calendar_drag.js"></script>
</body>
</html>
