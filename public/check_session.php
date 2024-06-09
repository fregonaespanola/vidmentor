<?php
    session_start();
    require('common_functions.php');

    if (!isset($_SESSION['user'])) {
        validateRememberMeToken();
    }

    if (!isset($_SESSION['user']) && $_SERVER['REQUEST_URI'] !== '/login.php' && $_SERVER['REQUEST_URI'] !== '/register.php' && $_SERVER['REQUEST_URI'] !== '/recover_password.php' && $_SERVER['REQUEST_URI'] !== '/reset_password.php') {
        redirect('login.php', [
            'title' => 'error',
            'text' => 'Por favor, inicia sesión para acceder a esta página.',
            'position' => 'center',
            'toast' => true,
            'showConfirmButton' => true,
            'confirmButtonText' => 'OK'
        ]);
    }