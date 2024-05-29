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

    // Prepara y ejecuta la consulta para verificar si existe un registro para la fecha especificada
    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM DETALLE WHERE FECHA = :date AND ID_USUARIO = :usuario_id");
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Devuelve 'true' si hay al menos un registro para la fecha especificada, 'false' de lo contrario
    echo $result['count'] > 0 ? 'true' : 'false';
} catch (PDOException $e) {
    // En caso de error, devuelve 'false'
    echo 'false';
}
?>
