<?php
    session_start();
    require('common_functions.php');
    unsetLoginCookies();
    unset($_SESSION);
    unset($_COOKIE);
    unset($_POST);
    unset($_GET);
    session_destroy();
    redirect('index.php', [
        'title' => 'success',
        'text' => 'Has cerrado sesión correctamente.',
        'position' => 'bottom-end',
        'toast' => true,
        'timer' => 2500,
        'timerProgressBar' => true
    ]);
