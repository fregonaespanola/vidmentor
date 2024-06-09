<?php
    session_start();
    require '../config.php';
    require 'common_functions.php';
    require '../vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');

        $query = 'SELECT ID, MAIL FROM USUARIO WHERE MAIL = :email';
        $params = [':email' => $email];
        $stmt = executeQuery($query, $params);

        if ($stmt && $stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $userId = $user['ID'];
            try {
                $token = bin2hex(random_bytes(32));
            } catch (\Exception $e) {
                redirect('recover_password.php', [
                    'title' => 'error',
                    'text' => 'Hubo un problema al generar el enlace de recuperación. Por favor, intenta de nuevo.',
                    'position' => 'center',
                    'toast' => TRUE,
                    'showConfirmButton' => TRUE,
                    'confirmButtonText' => 'OK'
                ]);
            }
            $expiryDate = (new DateTime('+1 hour'))->format('Y-m-d H:i:s');

            $query = 'INSERT INTO TOKEN (TOKEN, F_CRE, F_EXP, ID_TIPO, ID_USUARIO) VALUES (:token, CURRENT_TIMESTAMP, :expiry, 1, :user)';
            $params = [
                ':token' => $token,
                ':expiry' => $expiryDate,
                ':user' => $userId
            ];
            $stmt = executeQuery($query, $params);

            if ($stmt) {
                $resetLink = "https://vidmentor.dalonsolaz.dev/reset_password.php?token=$token";

                $mail = new PHPMailer(TRUE);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = TRUE;
                    $mail->Username = 'vidmentortfg@gmail.com';
                    $mail->Password = MAIL_PASSWORD;
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    $mail->CharSet = 'UTF-8';
                    $mail->setFrom(EMAIL_ADDR, 'VidMentor');
                    $mail->addAddress($email);

                    $mail->isHTML();
                    $mail->Subject = 'Recuperación de contraseña';
                    $mail->Body = "
                <html lang='es'>
                    <head>
                        <meta charset='UTF-8'>
                        <title>Recuperación de contraseña</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                line-height: 1.6;
                                color: #333;
                            }
                            .container {
                                width: 100%;
                                max-width: 600px;
                                margin: 0 auto;
                                padding: 20px;
                                border: 1px solid #ddd;
                                border-radius: 10px;
                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                            }
                            .header {
                                text-align: center;
                                padding-bottom: 20px;
                                border-bottom: 1px solid #ddd;
                            }
                            .header h2 {
                                margin: 0;
                                color: #0066cc;
                            }
                            .content p {
                                margin: 0 0 20px;
                                padding: 10px;
                                background: #f9f9f9;
                                border-radius: 5px;
                                border: 1px solid #eee;
                            }
                            .footer {
                                text-align: center;
                                padding-top: 10px;
                                border-top: 1px solid #ddd;
                                font-size: 0.9em;
                                color: #666;
                            }
                        </style>
                    </head>
                    <body>
                        <div class='container'>
                            <div class='header'>
                                <h2>Recuperación de Contraseña</h2>
                            </div>
                            <div class='content'>
                                <p>Haz clic en el siguiente enlace para restablecer tu contraseña:</p>
                                <p><a href='$resetLink'>$resetLink</a></p>
                            </div>
                            <div class='footer'>
                                Este es un mensaje generado automáticamente, por favor no respondas a este correo.
                            </div>
                        </div>
                    </body>
                </html>";

                    $mail->send();
                    redirect('login.php', [
                        'title' => 'success',
                        'text' => 'Enlace de recuperación enviado. Por favor, revisa tu correo electrónico.',
                        'position' => 'center',
                        'toast' => TRUE,
                        'timer' => 5000,
                        'timerProgressBar' => TRUE
                    ]);
                } catch (Exception $e) {
                    redirect('recover_password.php', [
                        'title' => 'error',
                        'text' => 'El mensaje no se pudo enviar. Mailer Error: ' . $mail->ErrorInfo,
                        'position' => 'center',
                        'toast' => TRUE,
                        'showConfirmButton' => TRUE,
                        'confirmButtonText' => 'OK'
                    ]);
                }
            } else {
                redirect('recover_password.php', [
                    'title' => 'error',
                    'text' => 'Hubo un problema al generar el enlace de recuperación. Por favor, intenta de nuevo.',
                    'position' => 'center',
                    'toast' => TRUE,
                    'showConfirmButton' => TRUE,
                    'confirmButtonText' => 'OK'
                ]);
            }
        } else {
            redirect('recover_password.php', [
                'title' => 'error',
                'text' => 'El correo electrónico no está registrado.',
                'position' => 'center',
                'toast' => TRUE,
                'showConfirmButton' => TRUE,
                'confirmButtonText' => 'OK'
            ]);
        }
    } else {
        redirect('recover_password.php', [
            'title' => 'error',
            'text' => 'Acceso no autorizado.',
            'position' => 'center',
            'toast' => TRUE,
            'showConfirmButton' => TRUE,
            'confirmButtonText' => 'OK'
        ]);
    }
