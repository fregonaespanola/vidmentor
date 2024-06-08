<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    session_start();
    require '../vendor/autoload.php';
    require '../config.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

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
            $mail->Body = "<h3>Nombre: </h3><p>$name</p><h3>Correo: </h3><p>$email</p><h3>Mensaje: </h3><p>$message</p>";

            $mail->send();
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'El mensaje se ha enviado correctamente.';
        }catch(Exception $e){
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = 'El mensaje no se pudo enviar. Mailer Error: ' . $mail->ErrorInfo;
        }
        header('Location: index.php');
        die();
    }