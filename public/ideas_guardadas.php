<?php
    if (isset($_SESSION['user'])) {
        $usuario_id = $_SESSION['user']['ID'];
        require_once 'common_functions.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ideaId']) && isset($_POST['date'])) {
            $ideaId = $_POST['ideaId'];
            $date = $_POST['date'];

            try {
                $query = "UPDATE DETALLE SET FECHA = :date WHERE ID = :ideaId AND ID_USUARIO = :usuario_id";
                $params = [
                    ':date' => $date,
                    ':ideaId' => $ideaId,
                    ':usuario_id' => $usuario_id
                ];
                $stmt = executeQuery($query, $params);

                if ($stmt) {
                    redirect("calendar.php", [
                        'title' => "success",
                        'text' => "La fecha de la idea se ha actualizado correctamente.",
                        'position' => 'top-end',
                        'toast' => true,
                        'showConfirmButton' => false,
                        'timer' => 3000,
                        'timerProgressBar' => true
                    ]);
                } else {
                    redirect("calendar.php", [
                        'title' => "error",
                        'text' => "Error al actualizar la fecha de la idea.",
                        'position' => 'top-end',
                        'toast' => true,
                        'showConfirmButton' => false,
                        'timer' => 3000,
                        'timerProgressBar' => true
                    ]);
                }
            } catch (PDOException $e) {
                redirect("ideas.php", [
                    'title' => "error",
                    'text' => "Error al actualizar la fecha de la idea. Contacta con la administración.",
                    'position' => 'top-end',
                    'toast' => true,
                    'showConfirmButton' => false,
                    'timer' => 3000,
                    'timerProgressBar' => true
                ]);
            }
        }

        try {
            $query = "SELECT ID, NOMBRE FROM DETALLE WHERE ID_USUARIO = :usuario_id";
            $params = [':usuario_id' => $usuario_id];
            $stmt = executeQuery($query, $params);

            echo "<div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4'>";
            if ($stmt->rowCount() == 0) {
                echo "<h2 class='text-white text-center w-full'>No tienes ideas guardadas :(</h2>";
            }
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='bg-gray-vidmentor-secondary rounded-lg shadow-md p-4 flex flex-col justify-between h-full' draggable='true' ondragstart='drag(event)' id='" . $row['ID'] . "'>";
                echo "<h3 class='text-white font-medium mb-4 flex-grow'>" . $row['NOMBRE'] . "</h3>";
                echo "<div class='flex justify-between mt-4'>";
                echo "<button class='btn-delete bg-red-vidmentor-secondary text-white px-4 py-2 rounded-lg' data-id='" . $row['ID'] . "'>Eliminar</button>";
                echo "<a href='forms_container.php?id=" . $row['ID'] . "' class='bg-blue-vidmentor-secondary text-white px-4 py-2 rounded-lg'>Editar</a>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";

        } catch (PDOException $e) {
            redirect('ideas.php', [
                'title' => 'error',
                'text' => 'Error al obtener los títulos de las ideas. Contacta con la administración.',
                'position' => 'top-end',
                'toast' => true,
                'showConfirmButton' => false,
                'timer' => 3000,
                'timerProgressBar' => true
            ]);
        }
    } else {
        redirect('login.php', [
            'title' => 'error',
            'text' => 'Por favor, logueate para ver tus ideas guardadas.',
            'position' => 'top-end',
            'toast' => true,
            'showConfirmButton' => false,
            'timer' => 3000,
            'timerProgressBar' => true
        ]);
    }
