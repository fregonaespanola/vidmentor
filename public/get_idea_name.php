<?php
session_start();

if(isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
}
// Configura la conexión a la base de datos
$dsn = "mysql:host=localhost;dbname=PROYECTO;charset=utf8mb4";
$username = "PROYECTO";
$password = "11223344";

// Recibe la fecha del POST
$date = $_POST['date'];

try {
    // Conecta a la base de datos
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepara y ejecuta la consulta para obtener todos los nombres de las ideas para la fecha especificada
    $stmt = $pdo->prepare("SELECT NOMBRE FROM DETALLE WHERE FECHA = :date AND ID_USUARIO = :usuario_id");
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Devuelve los nombres de las ideas separados por '|'
    echo implode('|', $results);
} catch (PDOException $e) {
    // En caso de error, devuelve un mensaje de error
    echo 'Error al obtener los nombres de las ideas';
}
?>
