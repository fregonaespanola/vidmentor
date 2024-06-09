<?php
session_start();
require_once('common_functions.php');
$usuario_id = $_SESSION['user']['ID'];

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT ID FROM DETALLE WHERE ID = :id AND ID_USUARIO = :usuario_id";
    $params = [':id' => $id, ':usuario_id' => $usuario_id];
    $stmt = executeQuery($query, $params);
    if ($stmt->rowCount() == 0) {
        header("Location: calendar.php");
        exit();
    }
}else{
    header("Location: calendar.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formularios - Vidmentor</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-gray-vidmentor-primary flex flex-col min-h-screen">
    <?php require_once("header-dashboard.php"); ?>

    <div class="flex flex-grow">
        <?php require_once("sidebar-dashboard.php"); ?>
        <div class="flex flex-col w-full">
            <ul class="flex space-x-4 bg-gray-vidmentor-primary text-white p-4">
                <li class="cursor-pointer py-2 px-4 text-white" id="guion-tab">Guion</li>
                <li class="cursor-pointer py-2 px-4 text-white" id="post-subida-tab">Post-subida</li>
            </ul>

            <div id="formulario-container" class="p-4 w-full">
                <?php include 'formulario.php'; ?>
            </div>

            <div id="formulario-checkboxes-container" class="hidden p-4 w-full">
                <?php include 'formulario_checkboxes.php'; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/form_container.js"></script>
</body>
</html>
