<?php
session_start();

// Verifica si se proporcionó un título
if (isset($_POST['title'])) {
    $translatedTitle = $_POST['title']; // El título traducido enviado desde el cliente

    // Verifica si el usuario está autenticado
    if(isset($_SESSION['usuario_id'])) {
        $usuario_id = $_SESSION['usuario_id'];

        // Configura los detalles de la conexión a la base de datos
        $dsn = "mysql:host=localhost;dbname=VIDMENTOR;charset=utf8mb4";
        $username = "PROYECTO";
        $password = "11223344";

        // Intenta establecer la conexión a la base de datos utilizando PDO
        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepara la consulta para insertar la idea asociada al usuario
            $stmt = $pdo->prepare("INSERT INTO DETALLE (NOMBRE, ID_USUARIO) VALUES (:translatedTitle, :usuario_id)");
            $stmt->bindParam(':translatedTitle', $translatedTitle);
            $stmt->bindParam(':usuario_id', $usuario_id);

            // Ejecuta la consulta
            $stmt->execute();

            echo "Título '$translatedTitle' añadido correctamente a la base de datos.";
        } catch (PDOException $e) {
            echo "Error al agregar el título: " . $e->getMessage();
        }
    } else {
        echo "No se pudo obtener el ID de usuario.";
    }
} else {
    echo "No se proporcionó un título para agregar.";
}
?>
