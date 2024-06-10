<?php
    require('check_session.php');

    if(isset($_POST['id'])) {
        $id = $_POST['id'];

        try {
            $pdo = getDatabaseConnection();

            $query = "DELETE FROM DETALLE WHERE ID = :id";
            $params = [':id' => $id];
            $stmt = executeQuery($query, $params);

            redirect("ideas_guardadas.php", [
                'title' => "success",
                'text' => "La idea se ha eliminado correctamente.",
                'position' => 'top-end',
                'toast' => true,
                'showConfirmButton' => false,
                'timer' => 3000,
                'timerProgressBar' => true
            ]);
        } catch (PDOException $e) {
            redirect("ideas_guardadas.php", [
                'title' => "error",
                'text' => "Error al eliminar la idea. Contacta con la administración.",
                'position' => 'top-end',
                'toast' => true,
                'showConfirmButton' => false,
                'timer' => 3000,
                'timerProgressBar' => true
            ]);
        }
    } else {
        redirect("ideas_guardadas.php", [
            'title' => "error",
            'text' => "No se proporcionó un ID válido.",
            'position' => 'top-end',
            'toast' => true,
            'showConfirmButton' => false,
            'timer' => 3000,
            'timerProgressBar' => true
        ]);
    }

