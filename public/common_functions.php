<?php

    use JetBrains\PhpStorm\NoReturn;

    session_start();
    require '../vendor/autoload.php';
    require '../config.php';

    function getDatabaseConnection() {
        $dsn = "mysql:host=localhost;dbname=VIDMENTOR;charset=utf8mb4";
        $username = "PROYECTO";
        $password = DB_PASS;

        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Error al conectarse a la base de datos: " . $e->getMessage();
            exit();
        }
    }

    function executeQuery($query, $params = []): false|PDOStatement
    {
        try {
            $pdo = getDatabaseConnection();
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error en la consulta: " . $e->getMessage();
            echo "<br>";
            echo "Query: " . $query;
            echo "<br>";
            echo "Params: " . print_r($params, true);
            return false;
        }
    }

    function checkExistingUserEmail($nick, $mail): array
    {
        $query = "SELECT ID FROM USUARIO WHERE NICK = :nick OR MAIL = :mail";
        $params = [':nick' => $nick, ':mail' => $mail];
        $stmt = executeQuery($query, $params);

        if ($stmt && $stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return ['exists' => true, 'data' => $data];
        } else {
            return ['exists' => false, 'data' => null];
        }
    }

    function validateFields($requiredFields): array
    {
        $errors = [];
        foreach ($requiredFields as $field => $displayName) {
            if (empty($_POST[$field])) {
                $errors[$field] = "El campo $displayName es obligatorio.<br>";
            }
        }
        return $errors;
    }

    function validateName($name): ?string
    {
        $errors = [];
        if(strlen($name) < 2) {
            $errors[] = 'El nombre debe tener al menos 2 caracteres.<br>';
        }
        if(strlen($name) > 100) {
            $errors[] = 'El nombre no puede tener más de 100 caracteres.<br>';
        }
        return !empty($errors) ? implode(' ', $errors) : null;
    }

    function validateUsername($username): ?string
    {
        $errors = [];
        if(strlen($username) < 2) {
            $errors[] = 'El nombre de usuario debe tener al menos 2 caracteres.<br>';
        }
        if(strlen($username) > 50) {
            $errors[] = 'El nombre de usuario no puede tener más de 50 caracteres.<br>';
        }
        return !empty($errors) ? implode(' ', $errors) : null;
    }

    function validateEmail($email): ?string
    {
        $errors = [];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'El correo electrónico no tiene un formato válido.<br>username@server.dominio';
        }
        return !empty($errors) ? implode(' ', $errors) : null;
    }

    function validatePassword($password, $confirm_password): ?string
    {
        $errors = [];

        if (strlen($password) < 8) {
            $errors[] = 'La contraseña debe tener al menos 8 caracteres.<br>';
        }

        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = 'La contraseña debe tener al menos una letra mayúscula.<br>';
        }

        if (!preg_match('/[a-z]/', $password)) {
            $errors[] = 'La contraseña debe tener al menos una letra minúscula.<br>';
        }

        if (!preg_match('/[0-9]/', $password)) {
            $errors[] = 'La contraseña debe tener al menos un número.<br>';
        }

        if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $password)) {
            $errors[] = 'La contraseña debe tener al menos un caracter especial.<br>';
        }

        if ($password !== $confirm_password) {
            $errors[] = 'Las contraseñas no coinciden.<br>';
        }

        return !empty($errors) ? implode(' ', $errors) : null;
    }

    #[NoReturn]
    function redirect($url, array $options = [], array $formData = []): void
    {
        $_SESSION['formData'] = $formData;

        $defaults = [
            'title' => '',
            'text' => '',
            'toast' => false,
            'position' => 'top-end',
            'showConfirmButton' => false,
            'confirmButtonText' => '',
            'timer' => 0,
            'timerProgressBar' => false
        ];

        $params = array_merge($defaults, $options);

        $_SESSION['swal']['status'] = $params['title'];
        $_SESSION['swal']['message'] = $params['text'];
        $_SESSION['swal']['position'] = $params['position'];
        $_SESSION['swal']['toast'] = $params['toast'];
        $_SESSION['swal']['showConfirmButton'] = $params['showConfirmButton'];
        $_SESSION['swal']['confirmButtonText'] = $params['confirmButtonText'];
        $_SESSION['swal']['timer'] = $params['timer'];
        $_SESSION['swal']['timerProgressBar'] = $params['timerProgressBar'];

        header("Location: $url");
        die();
    }

    function sendActivationEmail($email, $token): bool
    {
        $mail = new PHPMailer\PHPMailer\PHPMailer();

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = EMAIL_ADDR;
            $mail->Password = MAIL_PASSWORD;
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom(EMAIL_ADDR, 'VidMentor');
            $mail->addAddress($email);

            $mail->isHTML();
            $mail->Subject = 'Activa tu cuenta en VidMentor';
            $mail->Body = "Haz clic en el siguiente enlace para activar tu cuenta: <a href='https://vidmentor.dalonsolaz.dev/activate.php?token=$token'>Activar cuenta</a><br>Si no te has registrado en VidMentor, ignora este mensaje.<br>Este enlace expirará en <b>15 minutos</b>.";

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
