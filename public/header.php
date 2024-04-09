<?php
/*
session_start();

$errors = $_SESSION['errors'];

$usuarioAutenticado = isset($_SESSION['user_id']);

if (!$usuarioAutenticado && isset($_COOKIE['remember'])) {

    $query = "SELECT user_id FROM Token WHERE token_value = :token_value";
    $params = [':token_value' => $_COOKIE['remember']];
    $result = executeQuery($query, $params);

    if ($result) {
        $tokenData = $result->fetch(PDO::FETCH_ASSOC);
        if ($tokenData) {
            $_SESSION['user_id'] = $tokenData['user_id'];
            $usuarioAutenticado = true;
        }
    }
}

unset($_SESSION['errors']);*/
?>

<nav class="navbar navbar-expand-sm navbar-dark bg-gray-light">
    <div class="container-fluid">
        <a href="index.php" class="navbar-brand"><img class="logo-min" src="assets/logo.png"/></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav gap-2">
                <li class="nav-item">
                    <a class="nav-link" href="#">Marcas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Influencers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
            </ul>
        </div>
        <div class="d-flex">
            <button class="btn btn-danger btn-color-red rounded-pill">Iniciar sesión</button>
        </div>
    </div>
</nav>