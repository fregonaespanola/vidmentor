<?php
    session_start();
    require('common_functions.php');

    if (!isset($_SESSION['user'])) {
        validateRememberMeToken();
    }

    if (!isset($_SESSION['user'])) {
        redirect('login.php', [
            'title' => 'error',
            'text' => 'Por favor, inicia sesión para acceder a esta página.',
            'position' => 'center',
            'toast' => true,
            'showConfirmButton' => true,
            'confirmButtonText' => 'OK'
        ]);
    }