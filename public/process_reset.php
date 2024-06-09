<?php
    session_start();
    require '../config.php';
    require 'common_functions.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token = $_POST['token'];
        $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
        $confirm_password = htmlspecialchars($_POST['confirm_password'], ENT_QUOTES, 'UTF-8');

        if ($password !== $confirm_password) {
            redirect('reset_password.php?token=' . $token, [
                'title' => 'error',
                'text' => 'Las contraseñas no coinciden.',
                'position' => 'center',
                'toast' => true,
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK'
            ]);
        }

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $query = 'SELECT ID_USUARIO, F_EXP FROM TOKEN WHERE TOKEN = :token AND ID_TIPO = 1';
        $params = [':token' => $token];
        $stmt = executeQuery($query, $params);

        if ($stmt && $stmt->rowCount() > 0) {
            $tokenData = $stmt->fetch(PDO::FETCH_ASSOC);
            $userId = $tokenData['ID_USUARIO'];
            $expiryDate = $tokenData['F_EXP'];

            try{
                if(new DateTime() > new DateTime($expiryDate)){
                    redirect('recover_password.php', [
                        'title'             => 'error',
                        'text'              => 'El token ha expirado. Por favor, solicita uno nuevo.',
                        'position'          => 'center',
                        'toast'             => TRUE,
                        'showConfirmButton' => TRUE,
                        'confirmButtonText' => 'ENTENDIDO'
                    ]);
                }
            }catch(Exception $e){
                redirect('recover_password.php', [
                    'title'             => 'error',
                    'text'              => 'Hubo un problema al restablecer tu contraseña. Por favor, intenta de nuevo.',
                    'position'          => 'center',
                    'toast'             => TRUE,
                    'showConfirmButton' => TRUE,
                    'confirmButtonText' => 'OK'
                ]);
            }

            $query = 'UPDATE USUARIO SET PWD = :pwd WHERE ID = :id';
            $params = [':pwd' => $hashed_password, ':id' => $userId];
            $stmt = executeQuery($query, $params);

            if ($stmt) {
                $query = 'DELETE FROM TOKEN WHERE TOKEN = :token';
                $params = [':token' => $token];
                executeQuery($query, $params);

                redirect('login.php', [
                    'title' => 'success',
                    'text' => 'Contraseña restablecida exitosamente. Puedes iniciar sesión con tu nueva contraseña.',
                    'position' => 'center',
                    'toast' => true,
                    'timer' => 5000,
                    'timerProgressBar' => true
                ]);
            } else {
                redirect('reset_password.php?token=' . $token, [
                    'title' => 'error',
                    'text' => 'Hubo un problema al restablecer tu contraseña. Por favor, intenta de nuevo.',
                    'position' => 'center',
                    'toast' => true,
                    'showConfirmButton' => true,
                    'confirmButtonText' => 'OK'
                ]);
            }
        } else {
            redirect('recover_password.php', [
                'title' => 'error',
                'text' => 'Token inválido. Por favor, solicita uno nuevo.',
                'position' => 'center',
                'toast' => true,
                'showConfirmButton' => true,
                'confirmButtonText' => 'ENTENDIDO'
            ]);
        }
    } else {
        redirect('recover_password.php', [
            'title' => 'error',
            'text' => 'Acceso no autorizado.',
            'position' => 'center',
            'toast' => true,
            'showConfirmButton' => true,
            'confirmButtonText' => 'OK'
        ]);
    }
