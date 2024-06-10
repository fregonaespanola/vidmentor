<?php
    require('check_session.php');

    $pdo = getDatabaseConnection();

    try {
        $usuario_id = $_SESSION['user']['ID'];
        $query = "SELECT INTERES FROM USUARIO WHERE ID = :id";
        $params = [':id' => $usuario_id];
        $stmt = executeQuery($query, $params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($result['INTERES'])) {
            redirect("intereses.php", [
                'title' => "error",
                'text' => "Debes seleccionar tus intereses antes de generar ideas.",
                'position' => 'top-end',
                'toast' => true,
                'showConfirmButton' => false,
                'timer' => 3000,
                'timerProgressBar' => true
            ]);
        } else {
            $interes = $result['INTERES'];
        }
    } catch (PDOException $e) {
        redirect('ideas.php', [
            'title' => 'error',
            'text' => 'Error al obtener los intereses del usuario. Contacta con la administración.',
            'position' => 'top-end',
            'toast' => true,
            'showConfirmButton' => false,
            'timer' => 3000,
            'timerProgressBar' => true
        ]);
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Generar Ideas - Vidmentor</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        let userInterest = "<?php echo htmlspecialchars($interes); ?>";
    </script>

    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/script.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <?php
        require('insertSwal.php');
    ?>
</body>
</html>