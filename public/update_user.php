<?php
    require('check_session.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = validateFields([
            'nick' => 'Nombre de usuario',
            'mail' => 'Email',
        ]);

        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        if ($password !== $confirm_password) {
            $errors['password'] = 'Las contraseñas no coinciden.';
            $errors['confirm_password'] = 'Las contraseñas no coinciden.';
        }

        if (empty($errors)) {
            $nick = $_POST['nick'];
            $mail = $_POST['mail'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';

            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $errors['mail'] = 'El correo electrónico no tiene un formato válido.';
            }

            $avatarData = null;
            if (!empty($_FILES['avatar']['tmp_name']) && is_uploaded_file($_FILES['avatar']['tmp_name'])) {
                $uploadDirectory = 'images/';
                $userId = $_SESSION['user']['ID'];
                $fileInfo = pathinfo($_FILES['avatar']['name']);
                $extension = strtolower($fileInfo['extension']);
                $fileName = $userId . '.' . $extension;
                $destination = $uploadDirectory . $fileName;

                if (!is_dir($uploadDirectory)) {
                    mkdir($uploadDirectory, 0755, true);
                }

                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $destination)) {
                    $avatarData = $destination;
                } else {
                    $errors['errors'] = "Error al subir la imagen al servidor: " . $_FILES['avatar']['error'];
                }
            }

            $existingUser = checkExistingUserEmail($nick, $mail);
            if ($existingUser['exists'] && $existingUser['data']['ID'] !== $_SESSION['user']['ID']) {
                $errors['errors'] = "El nombre de usuario o email ya están en uso.";
            }

            if (empty($errors)) {
                
                $query = "UPDATE USUARIO SET NICK = :nick, MAIL = :mail, F_NAC = :fecha_nacimiento";
                $params = [
                    ':nick' => $nick,
                    ':mail' => $mail,
                    ':fecha_nacimiento' => $fecha_nacimiento==''?NULL:$fecha_nacimiento
                ];

                if (!empty($password)) {
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                    $query .= ", PWD = :pwd";
                    $params[':pwd'] = $hashedPassword;
                }

                if ($avatarData !== null) {
                    $query .= ", AVATAR = :avatar";
                    $params[':avatar'] = $avatarData;
                }

                $query .= " WHERE ID = :user_id";
                $params[':user_id'] = $_SESSION['user']['ID'];
                $stmt = executeQuery($query, $params);

                if ($stmt) {
                    $query = "SELECT * FROM USUARIO WHERE ID = :user_id";
                    $params = [':user_id' => $_SESSION['user']['ID']];
                    $stmt = executeQuery($query, $params);
                    $_SESSION['user'] = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    redirect("editProfile.php", [
                        'title' => 'success',
                        'text' => 'Perfil actualizado con éxito.',
                        'position' => 'center',
                        'toast' => true,
                        'showConfirmButton' => false,
                        'timer' => 1500

                    ]);
                } else {
                    $errors['errors'] = "Error actualizando perfil.";
                    redirect("editProfile.php", [
                        'title' => 'error',
                        'text' => 'Error actualizando perfil.',
                        'position' => 'center',
                        'toast' => true,
                        'showConfirmButton' => false,
                        'timer' => 1500
                    ]);
                }
            }
        }

        $_SESSION['errors'] = $errors;
        redirect("editProfile.php", [
            'title' => 'error',
            'text' => 'Error actualizando perfil.',
            'position' => 'center',
            'toast' => true,
            'showConfirmButton' => false,
            'timer' => 1500
        ],$_POST);
    }
