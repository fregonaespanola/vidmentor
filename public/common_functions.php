<?php

    use JetBrains\PhpStorm\NoReturn;

    session_start();
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
                $errors[$field] = "El campo $displayName es obligatorio.";
            }
        }
        return $errors;
    }

   #[NoReturn] function redirect($url, array $options = []): void
   {
       $defaults = [
           'title' => '',
           'text' => '',
           'toast' => false,
           'position' => 'top-end',
           'showConfirmButton' => false,
           'confirmButtonText' => '',
           'timer' => 0,
           'timerProgressBar' => false,
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

    function password_verify_custom($password, $hashedPassword): bool
    {
        return password_verify($password, $hashedPassword);
    }

    function sendActivationEmail($email, $token): void
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
        } catch (Exception $e) {
            redirect('register.php', 'error', 'Hubo un problema al enviar el correo de activación. Por favor, inténtalo de nuevo.');
        }
    }
