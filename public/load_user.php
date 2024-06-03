<?php
session_start();
require_once('common_functions.php');

if (!isset($_SESSION['usuario_id'])) {
    redirect('index.php', '', '');
}

$user_id = $_SESSION['usuario_id'];
$userData = obtenerDatosUsuario($user_id);

if (!$userData) {
    redirect('index.php', '', '');
}

function obtenerDatosUsuario($user_id) {
    $query = "SELECT NICK, MAIL, FECHA_NACIMIENTO, AVATAR, INTERES FROM USUARIO WHERE ID = :user_id";
    $params = [':user_id' => $user_id];
    $stmt = executeQuery($query, $params);

    if ($stmt) {
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        return $userData;
    } else {
        return false;
    }
}
?>
