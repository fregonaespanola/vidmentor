<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
    require_once('common_functions.php');

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
                echo "La fecha de la idea se ha actualizado correctamente.";
            } else {
                echo "Error al actualizar la fecha de la idea.";
            }
            exit;
        } catch (PDOException $e) {
            echo "Error al actualizar la fecha de la idea: " . $e->getMessage();
            exit;
        }
    }

    try {
        $query = "SELECT ID, NOMBRE FROM DETALLE WHERE ID_USUARIO = :usuario_id";
        $params = [':usuario_id' => $usuario_id];
        $stmt = executeQuery($query, $params);


        echo "<div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4'>";
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
        echo "Error al obtener los títulos de las ideas: " . $e->getMessage();
    }
} else {
    echo "El usuario no está autenticado.";
}
?>
