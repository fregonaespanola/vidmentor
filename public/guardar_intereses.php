<?php
session_start();
require_once("common_functions.php");

$usuario_id = $_SESSION['user']['ID'] ?? null;

if (!$usuario_id) {
    die("Usuario no autenticado");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $interest = $_POST['interest'] ?? null;

    if ($interest && $usuario_id) {
        try {
            $existingInterest = executeQuery("SELECT INTERES FROM USUARIO WHERE ID = :id", [':id' => $usuario_id])->fetch(PDO::FETCH_ASSOC);

            if ($existingInterest && !empty($existingInterest['INTERES'])) {
                executeQuery("UPDATE USUARIO SET INTERES = :interes WHERE ID = :id", [':interes' => $interest, ':id' => $usuario_id]);
                echo "Interés actualizado con éxito";
            } else {
                executeQuery("UPDATE USUARIO SET INTERES = :interes WHERE ID = :id", [':interes' => $interest, ':id' => $usuario_id]);
                echo "Interés guardado con éxito";
            }
            exit();
        } catch (PDOException $e) {
            echo "Error al conectarse a la base de datos: " . $e->getMessage();
        }
    } else {
        echo "No se ha proporcionado ningún interés o usuario";
    }
}
?>
