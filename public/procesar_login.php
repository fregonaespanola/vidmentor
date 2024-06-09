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
                        $cookie_name = "remember-me";
                        $cookie_value = "";
                        $cookie_expire = time() - 3600;
                        setcookie($cookie_name, $cookie_value, $cookie_expire, "/");
                    }

                    if ($checkRemember === 'on') {
                        $generatedToken = bin2hex(openssl_random_pseudo_bytes(32));
                        $expiration = date('Y-m-d H:i:s', strtotime('+30 days'));
                        $tokenType = 'RECORDAR';

                        $queryToken = "INSERT INTO TOKEN (ID_USUARIO, TOKEN, F_EXP, ID_TIPO) VALUES (:user_id, :token_value, :expiration_date, (SELECT ID FROM TIPO WHERE NOMBRE = :token_type))";

                        $paramsToken = [
                            ':user_id' => $user['ID'],
                            ':token_value' => $generatedToken,
                            ':expiration_date' => $expiration,
                            ':token_type' => $tokenType
                        ];

                        executeQuery($queryToken, $paramsToken);

                        $cookie_name = "remember-me";
                        $cookie_value = $generatedToken;
                        $cookie_expire = time() + 60 * 60 * 24 * 7; // 1 semana
                        setcookie($cookie_name, $cookie_value, $cookie_expire, "/");
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