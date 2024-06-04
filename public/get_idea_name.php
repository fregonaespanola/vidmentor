<?php
session_start();

if(isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
}

require_once('common_functions.php');

$date = $_POST['date'];

try {
    $pdo = getDatabaseConnection();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT NOMBRE FROM DETALLE WHERE FECHA = :date AND ID_USUARIO = :usuario_id");
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo implode('|', $results);
} catch (PDOException $e) {
    echo 'Error al obtener los nombres de las ideas';
}
?>
