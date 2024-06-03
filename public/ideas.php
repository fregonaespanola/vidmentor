<?php
session_start();
require_once('common_functions.php');

$_SESSION['usuario_id'] = 2;

$pdo = getDatabaseConnection();

try {
    $usuario_id = $_SESSION['usuario_id'];
    $query = "SELECT INTERES FROM USUARIO WHERE ID = :id";
    $params = [':id' => $usuario_id];
    $stmt = executeQuery($query, $params);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($result['INTERES'])) {
        header("Location: intereses.php");
        exit();
    } else {
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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="bg-gray-vidmentor-primary flex flex-col min-h-screen">
    <?php require_once("header-dashboard.php"); ?>

    <div class="flex flex-grow">
        <?php require_once("sidebar-dashboard.php"); ?>

        <main class="flex-grow p-6">
            <div class="container mx-auto">
                <h1 class="text-4xl font-bold text-white mb-6 text-center mt-4">Generación de ideas</h1>
                <div id="results" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>
            </div>
        </main>
    </div>

    <script>
        var userInterest = "<?php echo htmlspecialchars($interes); ?>";
    </script>

    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/script.js"></script>
</body>

</html>