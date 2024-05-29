<?php
session_start();

$_SESSION['usuario_id'] = 2;

// Conexión a la base de datos
$dsn = "mysql:host=localhost;dbname=PROYECTO;charset=utf8mb4";
$username = "PROYECTO";
$password = "11223344";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $usuario_id = $_SESSION['usuario_id'];

    // Verificar si el usuario tiene un interés guardado
    $stmt = $pdo->prepare("SELECT INTERES FROM USUARIO WHERE ID = :id");
    $stmt->bindParam(':id', $usuario_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($result['INTERES'])) {
        // Redirigir a intereses.php si no hay interés guardado
        header("Location: intereses.php");
        exit();
    } else {
        // Guardar el interés en una variable
        $interes = $result['INTERES'];
    }
} catch (PDOException $e) {
    echo "Error al conectarse a la base de datos: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vidmentor</title>
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="container mt-5">
        <h1 class="color-white">Bienvenido a Vidmentor</h1>
    </div>

    <div id="results"></div>

    <script>
        var userInterest = "<?php echo htmlspecialchars($interes); ?>";
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
