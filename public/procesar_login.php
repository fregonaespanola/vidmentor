<?php
    session_start();
    require_once('common_functions.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['formType'] === 'login') {
        $mail = $_POST['mailLogin'] ?? '';
        $password = $_POST['passwordLogin'] ?? '';
        $checkRemember = $_POST['remember-me'] ?? '';

        $errors = validateFields([
            'mailLogin' => 'Correo Electrónico',
            'passwordLogin' => 'Contraseña'
        ]);

        if (empty($errors)) {
            $query = "SELECT * FROM USUARIO WHERE MAIL = :mail AND (OAUTH IS NULL)";
            $params = [':mail' => $mail];
            $stmt = executeQuery($query, $params);

            if ($stmt) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user['PWD'])) {
                    $_SESSION['user'] = $user;
                    if (isset($_COOKIE['remember-me']) && empty($_POST['remember-me'])) {
                        unsetLoginCookies();
                    }

                    if ($checkRemember === 'on') {
                        setLoginCookies($user);
                    }

                    $previousPage = $_SESSION['previous_page'] ?? 'index.php';
                    redirect($previousPage, [
                        'title' => 'success',
                        'text' => 'Bienvenido. Inicio de sesión correcto.',
                        'position' => 'center',
                        'toast' => true,
                        'showConfirmButton' => false,
                        'timer' => 1500
                    ]);
                } else {
                    $errors['login'] = "El usuario o la contraseña son incorrectos.";
                }
            }
        }

        $_SESSION['errors'] = $errors;
        redirect("login.php", [
            'title' => 'error',
            'text' => 'Por favor, corrige los errores en el formulario.',
            'position' => 'center',
            'toast' => true,
            'showConfirmButton' => true,
            'confirmButtonText' => 'OK'
        ], $_POST);
    }