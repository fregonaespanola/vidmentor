<?php
    session_start();
    require '../config.php';
    require 'common_functions.php';

    if (isset($_GET['token'])) {
        $token = $_GET['token'];

        $query = 'SELECT ID_USUARIO, F_EXP FROM TOKEN WHERE TOKEN = :token AND ID_TIPO = :tipo';
        $params = [
            ':token' => $token,
            ':tipo' => 2
        ];
        $stmt = executeQuery($query, $params);

        if ($stmt && $stmt->rowCount() > 0) {
            $tokenData = $stmt->fetch(PDO::FETCH_ASSOC);
            $userId = $tokenData['ID_USUARIO'];
            $expiryDate = $tokenData['F_EXP'];

            try{
                if(new DateTime() > new DateTime($expiryDate)){
                    redirect('register.php', 'error', 'El token ha expirado. Por favor, solicita uno nuevo.');
                }
                else{
                    $query = 'UPDATE USUARIO SET ACTIVADA = 1 WHERE ID = :id';
                    $params = [':id' => $userId];
                    $stmt = executeQuery($query, $params);

                    if($stmt){
                        redirect('login.php', 'success', 'Tu cuenta ha sido activada exitosamente.');
                    }
                    else{
                        redirect('register.php', 'error', 'Hubo un problema al activar tu cuenta. Por favor, inténtalo de nuevo.');
                    }
                }
            }catch(Exception $e){
            }
        } else {
            redirect('register.php', 'error', 'Token inválido. Por favor, intenta registrarte de nuevo. Tienes 15 minutos para activar tu cuenta.');
        }
    } else {
        redirect('register.php', 'error', 'No se ha proporcionado un token válido. Por favor, intenta registrarte de nuevo.');
    }
