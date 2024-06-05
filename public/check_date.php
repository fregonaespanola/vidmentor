<?php
session_start();

require_once("common_functions.php");

if(isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
}

$date = $_POST['date'];

try {
    $pdo = getDatabaseConnection();

    $stmt = executeQuery("SELECT COUNT(*) AS count FROM DETALLE WHERE FECHA = :date AND ID_USUARIO = :usuario_id", [':date' => $date, ':usuario_id' => $usuario_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo $result['count'] > 0 ? 'true' : 'false';
} catch (PDOException $e) {
    echo 'false';
}
?>
