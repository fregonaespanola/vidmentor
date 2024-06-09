<?php
    session_start();
    if (isset($_POST['title'])) {
        $translatedTitle = $_POST['title'];

        if(isset($_SESSION['user'])) {
            $usuario_id = $_SESSION['user']['ID'];

            require_once('common_functions.php');

            try {
                $query = "INSERT INTO DETALLE (NOMBRE, ID_USUARIO) VALUES (:translatedTitle, :usuario_id)";
                $params = [':translatedTitle' => $translatedTitle, ':usuario_id' => $usuario_id];
                $stmt = executeQuery($query, $params);

                if ($stmt) {
                    echo "Título '$translatedTitle' añadido correctamente a la base de datos.";
                } else {
                    echo "Error al agregar el título.";
                }
            } catch (PDOException $e) {
                echo "Error al agregar el título: " . $e->getMessage();
            }
        } else {
            echo "No se pudo obtener el ID de usuario.";
        }
    } else {
        echo "No se proporcionó un título para agregar.";
    }
