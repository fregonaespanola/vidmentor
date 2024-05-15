<?php
// Verifica si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén el contenido de los textareas de CKEditor
    $descripcion = $_POST['descripcion'];
    $gancho = $_POST['gancho'];
    $intro = $_POST['intro'];
    $engage1 = $_POST['engage1'];
    $setup = $_POST['setup'];
    $engage2 = $_POST['engage2'];
    $engage3 = $_POST['engage3'];
    $climax = $_POST['climax'];
    $bajada = $_POST['bajada'];
    $desenlace = $_POST['desenlace'];

    // Verifica si se proporcionó un ID válido en la URL
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // Conexión a la base de datos
        $dsn = "mysql:host=localhost;dbname=PROYECTO;charset=utf8mb4";
        $username = "PROYECTO";
        $password = "11223344";

        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepara la consulta SQL para actualizar los datos en la tabla DETALLE
            $stmt = $pdo->prepare("UPDATE DETALLE SET DESCRIPCION = :descripcion, GANCHO = :gancho, INTRO = :intro, ENGAGE1 = :engage1, SETUP = :setup, ENGAGE2 = :engage2, ENGAGE3 = :engage3, CLIMAX = :climax, BAJADA = :bajada, DESENLACE = :desenlace WHERE ID = :id");

            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':gancho', $gancho);
            $stmt->bindParam(':intro', $intro);
            $stmt->bindParam(':engage1', $engage1);
            $stmt->bindParam(':setup', $setup);
            $stmt->bindParam(':engage2', $engage2);
            $stmt->bindParam(':engage3', $engage3);
            $stmt->bindParam(':climax', $climax);
            $stmt->bindParam(':bajada', $bajada);
            $stmt->bindParam(':desenlace', $desenlace);
            $stmt->bindParam(':id', $id);

            // Ejecuta la consulta
            $stmt->execute();

            // Redirecciona a una página de éxito
            header("Location: ideas_user.php");
            exit();
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al actualizar los datos en la base de datos: " . $e->getMessage();
        }
    } else {
        echo "No se proporcionó un ID válido.";
    }
}
?>
