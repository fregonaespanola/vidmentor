<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('common_functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['formType'] === 'login') {
    $username = $_POST['usernameLogin'] ?? '';
    $password = $_POST['passwordLogin'] ?? '';

    $errors = validateFields([
        'usernameLogin' => 'Nombre de usuario',
        'passwordLogin' => 'Contraseña'
    ]);

    if (empty($errors)) {
        $query = "SELECT * FROM USUARIO WHERE NICK = :username AND (OAUTH IS NULL)";
        $params = [':username' => $username];
        $stmt = executeQuery($query, $params);

        if ($stmt) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['PWD'])) {
                $_SESSION['user_id'] = $user['ID'];

                // Generar un token único utilizando OpenSSL
                $generatedToken = bin2hex(openssl_random_pseudo_bytes(32));

                // Guardar el token en la base de datos
                $expiration = date('Y-m-d H:i:s', strtotime('+1 week')); // Una semana de expiración
                $tokenType = 'RECUPERAR'; // Tipo de token

                // Insertar el token en la tabla 'Token'
                $queryToken = "INSERT INTO TOKEN (ID_USUARIO, TOKEN, F_EXP, ID_TIPO) VALUES (:user_id, :token_value, :expiration_date, (SELECT ID FROM TIPO WHERE NOMBRE = :token_type))";
                $paramsToken = [
                    ':user_id' => $user['id'],
                    ':token_value' => $generatedToken,
                    ':expiration_date' => $expiration,
                    ':token_type' => $tokenType
                ];
                executeQuery($queryToken, $paramsToken);

                if (isset($_POST['remember'])) {
                    $cookie_name = "remember";
                    $cookie_value = $generatedToken;
                    $cookie_expire = time() + 60 * 60 * 24 * 7;
                    setcookie($cookie_name, $cookie_value, $cookie_expire, "/");
                }
                $previousPage = $_SESSION['previous_page'] ?? 'index.php';
                header("Location: $previousPage?msg=success");
                exit();
            } else {
                $errors['login'] = "El usuario o la contraseña son incorrectos.";
            }
        }
    }

    $_SESSION['errors'] = $errors;
    redirect("login.php", 'errorLogin', 'true');
}