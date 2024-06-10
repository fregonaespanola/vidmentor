<?php
    require('check_session.php');
    if (isset($_POST['title'])) {
        $translatedTitle = $_POST['title'];

        if(isset($_SESSION['user'])) {
            $usuario_id = $_SESSION['user']['ID'];

            try {
                $query = "INSERT INTO DETALLE (NOMBRE, ID_USUARIO) VALUES (:translatedTitle, :usuario_id)";
                $params = [':translatedTitle' => $translatedTitle, ':usuario_id' => $usuario_id];
                $stmt = executeQuery($query, $params);

                if ($stmt) {
                    redirect('ideas.php', [
                        'title' => 'success',
                        'text' => 'Título ' . $translatedTitle . ' añadido correctamente a la base de datos.',
                        'position' => 'top-end',
                        'toast' => true,
                        'showConfirmButton' => false,
                        'timer' => 3000,
                        'timerProgressBar' => true
                    ]);
                } else {
                    redirect('ideas.php', [
                        'title' => 'error',
                        'text' => 'Error al agregar el título.',
                        'position' => 'top-end',
                        'toast' => true,
                        'showConfirmButton' => false,
                        'timer' => 3000,
                        'timerProgressBar' => true
                    ]);
                }
            } catch (PDOException $e) {
                redirect('ideas.php', [
                    'title' => 'error',
                    'text' => 'Error al agregar el título. Contacta con la administración.',
                    'position' => 'top-end',
                    'toast' => true,
                    'showConfirmButton' => false,
                    'timer' => 3000,
                    'timerProgressBar' => true
                ]);
            }
        } else {
            redirect('ideas.php', [
                'title' => 'error',
                'text' => 'No se pudo obtener el ID de usuario.',
                'position' => 'top-end',
                'toast' => true,
                'showConfirmButton' => false,
                'timer' => 3000,
                'timerProgressBar' => true
            ]);
        }
    } else {
        redirect('ideas.php', [
            'title' => 'error',
            'text' => 'No se proporcionó un título para agregar.',
            'position' => 'top-end',
            'toast' => true,
            'showConfirmButton' => false,
            'timer' => 3000,
            'timerProgressBar' => true
        ]);
    }
