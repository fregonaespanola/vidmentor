<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    session_start();
    require '../vendor/autoload.php';
    require 'common_functions.php';
    require '../config.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        if(empty($name) || empty($email) || empty($message)){
            $_SESSION['contactFormData'] = ['name' => $name, 'email' => $email, 'message' => $message];
            redirect('index.php#contact', [
                'title' => 'error',
                'text' => 'Por favor, rellena todos los campos.',
                'position' => 'top-end',
                'toast' => true,
                'timer' => 3000
            ]);
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['contactFormData'] = ['name' => $name, 'email' => $email, 'message' => $message];
            redirect('index.php#contact', [
                'title' => 'error',
                'text' => 'El correo electrónico no tiene un formato válido. Utiliza usuario@servidor.dominio',
                'position' => 'top-end',
                'toast' => true,
                'timer' => 3000
            ]);
        }

        $mail = new PHPMailer(TRUE);

        try{
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = TRUE;
            $mail->Username = 'vidmentortfg@gmail.com';
            $mail->Password = MAIL_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->CharSet = 'UTF-8';
            $mail->setFrom(EMAIL_ADDR, 'VidMentor');
            $mail->addAddress(EMAIL_ADDR, 'VidMentor');

            $mail->isHTML();
            $mail->Subject = "Nuevo mensaje de contacto de $name";
            $mail->Body = "
<html lang='es'>
    <head>
        <title>Formulario de contacto</title>
        <meta charset='UTF-8'>
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
            .content h3 {
                color: #0066cc;
                margin-bottom: 5px;
            }
            .content p {
                background: #f9f9f9;
                padding: 10px;
                border-radius: 5px;
                margin: 0 0 20px;
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
                <h2>Nuevo Mensaje de Contacto</h2>
            </div>
            <div class='content'>
                <h3>Nombre:</h3>
                <p>$name</p>
                <h3>Correo:</h3>
                <p>$email</p>
                <h3>Mensaje:</h3>
                <p>$message</p>
            </div>
            <div class='footer'>
                Este es un mensaje generado automáticamente, por favor no respondas a este correo.
            </div>
        </div>
    </body>
</html>
";

            $mail->send();
            redirect('index.php', [
                'title' => 'success',
                'text' => 'El mensaje se ha enviado correctamente. En breve nos pondremos en contacto contigo.',
                'position' => 'top-end',
                'toast' => true,
                'timer' => 2200
            ]);
        }catch(Exception $e){
            redirect('index.php', [
                'title' => 'error',
                'text' => 'El mensaje no se pudo enviar. Mailer Error: ' . $mail->ErrorInfo,
                'position' => 'top-end',
                'toast' => true,
                'timer' => 2200
            ]);
        }
    }