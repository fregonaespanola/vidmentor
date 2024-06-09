<?php
    require_once('common_functions.php');
    require_once ('check_session.php');

    $user_id = $_SESSION['user']['ID'] ?? null;
    $userData = obtenerDatosUsuario($user_id);

    if (!$userData) {
        redirect('dashboard.php', [
            'title' => 'error',
            'text' => 'No se pudo obtener la información del usuario.',
            'position' => 'center',
            'toast' => true,
            'showConfirmButton' => true,
            'confirmButtonText' => 'OK'
        ]);
    }

    $_SESSION['user'] = array_merge($_SESSION['user'], $userData);

    function obtenerDatosUsuario($user_id) {
        $query = "SELECT NICK, MAIL, F_NAC, AVATAR, INTERES FROM USUARIO WHERE ID = :user_id";
        $params = [':user_id' => $user_id];
        $stmt = executeQuery($query, $params);
        if ($stmt) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
