<?php
    require('check_session.php');

    if(isset($_SESSION['user'])) {
        $usuario_id = $_SESSION['user']['ID'];
    }

    $date = $_POST['date'];

    try {
        $pdo = getDatabaseConnection();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT NOMBRE FROM DETALLE WHERE FECHA = :date AND ID_USUARIO = :usuario_id");
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_COLUMN);

        echo implode('|', $results);
    } catch (PDOException $e) {
        redirect("calendar.php", [
            'title' => "error",
            'text' => "Error al obtener los nombres de las ideas. Contacta con la administración.",
            'position' => 'top-end',
            'toast' => true,
            'showConfirmButton' => false,
            'timer' => 3000,
            'timerProgressBar' => true
        ]);
    }
