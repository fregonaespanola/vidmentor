<?php
session_start();

// Verificar si se recibió el ID del registro a eliminar
if(isset($_POST['id'])) {
    // Obtener el ID del registro a eliminar
    $id = $_POST['id'];

    // Configurar los detalles de la conexión a la base de datos
    $dsn = "mysql:host=localhost;dbname=PROYECTO;charset=utf8mb4";
    $username = "PROYECTO";
    $password = "11223344";

    // Intentar establecer la conexión a la base de datos utilizando PDO
    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar la consulta para eliminar el registro con el ID especificado
        $stmt = $pdo->prepare("DELETE FROM DETALLE WHERE ID = :id");
        $stmt->bindParam(':id', $id);

        // Ejecutar la consulta
        $stmt->execute();

        // Enviar una respuesta de éxito
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        // Enviar una respuesta de error si ocurre algún problema
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el registro: ' . $e->getMessage()]);
    }
} else {
    // Enviar una respuesta de error si no se recibió el ID del registro a eliminar
    echo json_encode(['success' => false, 'message' => 'No se proporcionó un ID para eliminar el registro.']);
}
?>
