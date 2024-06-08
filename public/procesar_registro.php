<?php
    session_start();
    require '../config.php';
    require 'common_functions.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
        $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
        $confirm_password = htmlspecialchars($_POST['confirm_password'], ENT_QUOTES, 'UTF-8');

        $requiredFields = [
            'nombre'           => 'Nombre',
            'username'         => 'Nombre de Usuario',
            'email'            => 'Correo Electrónico',
            'password'         => 'Contraseña',
            'confirm_password' => 'Confirmar Contraseña'
        ];
        $errors = validateFields($requiredFields);

        if($password !== $confirm_password){
            $errors['password'] = 'Las contraseñas no coinciden.';
        }

        if(!empty($errors)){
            redirect('register.php', [
                'title' => 'error',
                'text' => 'Por favor, corrige los errores en el formulario.',
                'position' => 'center',
                'toast' => true,
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK']);
        }

        $check = checkExistingUserEmail($username, $email);

        if($check['exists']){
            redirect('register.php', [
                'title' => 'error',
                'text' => 'El nombre de usuario o el correo electrónico ya están en uso.',
                'position' => 'center',
                'toast' => true,
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK']);
        }

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $pdo = getDatabaseConnection();
        $pdo->beginTransaction();

        try {
            $query = 'INSERT INTO USUARIO (NICK, MAIL, PWD, F_REG) VALUES (:nick, :mail, :pwd, CURRENT_DATE)';
            $params = [
                ':nick' => $username,
                ':mail' => $email,
                ':pwd'  => $hashed_password
            ];
            $stmt = executeQuery($query, $params);

            if($stmt) {
                $userId = $pdo->lastInsertId();

                $token = bin2hex(random_bytes(32));
                $expiryDate = (new DateTime('+15 min'))->format('Y-m-d H:i:s');

                $query = 'INSERT INTO TOKEN (TOKEN, F_CRE, F_EXP, ID_TIPO, ID_USUARIO) VALUES (:token, CURRENT_DATE, :expiry, :tipo, :user)';
                $params = [
                    ':token' => $token,
                    ':expiry' => $expiryDate,
                    ':tipo' => 2,
                    ':user' => $userId
                ];
                $stmt = executeQuery($query, $params);

                if($stmt) {
                    $pdo->commit();

                    sendActivationEmail($email, $token);

                    redirect('login.php', [
                        'title' => 'success',
                        'text' => 'Registro exitoso. Por favor, verifica tu correo electrónico para activar tu cuenta.',
                        'position' => 'center',
                        'toast' => true,
                        'timer' => 5000,
                        'timerProgressBar' => true]);
                } else {
                    throw new Exception('Error al generar el token de activación.');
                }
            } else {
                throw new Exception('Error al registrar el usuario.');
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            redirect('register.php', [
                'title' => 'error',
                'text' => 'Hubo un problema al registrar tu cuenta. Por favor, inténtalo de nuevo.',
                'position' => 'center',
                'toast' => true,
                'timer' => 5000,
                'timerProgressBar' => true]);
        }
    } else {
        redirect('register.php', [
            'title' => 'error',
            'text' => 'Acceso no autorizado.',
            'position' => 'center',
            'toast' => true,
            'timer' => 5000,
            'timerProgressBar' => true]);
    }
