<?php
require('check_session.php');

if(isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        $pdo = getDatabaseConnection();

        $stmt = executeQuery("DELETE FROM DETALLE WHERE ID = :id", [':id' => $id]);

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el registro: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No se proporcionó un ID para eliminar el registro.']);
}
?>
