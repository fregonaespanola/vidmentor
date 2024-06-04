<?php
session_start();
require_once("common_functions.php");

$_SESSION['usuario_id'] = 2;
$userId = $_SESSION['usuario_id'];
$queryUser = "SELECT NICK, MAIL FROM USUARIO WHERE ID = :userId";
$paramsUser = [':userId' => $userId];
$stmtUser = executeQuery($queryUser, $paramsUser);

$userName = '';
$userEmail = '';
if ($stmtUser && $stmtUser->rowCount() > 0) {
    $userData = $stmtUser->fetch(PDO::FETCH_ASSOC);
    $userName = $userData['NICK'];
    $userEmail = $userData['MAIL'];
}

$queryNextVideo = "SELECT NOMBRE, FECHA FROM DETALLE WHERE FECHA > CURDATE() ORDER BY FECHA ASC LIMIT 1";
$stmtNextVideo = executeQuery($queryNextVideo);
$nextVideoTitle = '';
if ($stmtNextVideo && $stmtNextVideo->rowCount() > 0) {
    $nextVideoData = $stmtNextVideo->fetch(PDO::FETCH_ASSOC);
    $nextVideoTitle = $nextVideoData['NOMBRE'];
    $nextVideoDate = $nextVideoData['FECHA'];
}

$queryVideoCount = "SELECT COUNT(*) AS total,
                    SUM(CASE WHEN FECHA < CURDATE() THEN 1 ELSE 0 END) AS subidos,
                    SUM(CASE WHEN FECHA > CURDATE() THEN 1 ELSE 0 END) AS porSubir,
                    SUM(CASE WHEN FECHA IS NULL THEN 1 ELSE 0 END) AS pendientes
                    FROM DETALLE";
$stmtVideoCount = executeQuery($queryVideoCount);
$totalVideos = 0;
$videosSubidos = 0;
$videosPorSubir = 0;
$videosPendientes = 0;
if ($stmtVideoCount && $stmtVideoCount->rowCount() > 0) {
    $videoCountData = $stmtVideoCount->fetch(PDO::FETCH_ASSOC);
    $totalVideos = $videoCountData['total'];
    $videosSubidos = $videoCountData['subidos'];
    $videosPorSubir = $videoCountData['porSubir'];
    $videosPendientes = $videoCountData['pendientes'];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - VidMentor</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styles_dashboard.css">
    <link rel="stylesheet" href="css/styles_header.css">
    <style>
        body {
            background-color: #1f2937;
            color: #ffffff;
            font-family: 'Karla', sans-serif;
            padding: 0;
            margin: 0;
        }

        .shadow-2xl {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .card{
            backdrop-filter: blur(10px);
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="bg-gray-vidmentor-5  flex flex-col min-h-screen">
    <?php require_once("header-dashboard.php"); ?>

    <div class="flex flex-grow bg-gray-vidmentor-primary">

        <!-- Sidebar -->
        <?php require_once("sidebar-dashboard.php"); ?>

        <!-- Main content section -->
        <main class="flex-grow p-6 relative z-10">
            <div class="container mx-auto mt-6">
                <h2 class="text-4xl font-bold text-white mb-6 text-center mt-4">Dashboard</h2>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Panel de Bienvenida -->
                    <div class="card bg-gray-vidmentor-secondary shadow-2xl rounded-lg p-6 flex flex-col justify-between h-full col-span-1 lg:col-span-2">
                        <div>
                            <div class="relative">
                                <img src="assets/fondo2.webp" alt="Banner" class="w-full h-40 object-cover rounded-t-lg">
                                <div class="absolute top-4 left-4 bg-orange-500 text-white rounded-full p-2">
                                    <i class="fas fa-user-circle text-4xl"></i>
                                </div>
                                <div class="absolute top-16 left-4">
                                    <h3 class="text-2xl font-bold text-white"><?php echo $userName ?></h3>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <h1 class="text-3xl font-semibold mb-4 card bg-gray-vidmentor-secondary-title">Bienvenido a VidMentor</h1>
                                <p class="text-sm text-white"><i class="fas fa-envelope mr-2"></i><?php echo $userEmail ?></p>
                                <p class="mt-4 text-white">Gestiona tu contenido y estrategias de redes sociales con VidMentor.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Panel de Accesos Rápidos -->
                    <div class="card bg-gray-vidmentor-secondary shadow-2xl rounded-lg p-6 grid sm:grid-cols-2 xl:grid-cols-1 2xl:grid-cols-2 gap-6 h-full col-span-1">
                        <a href="generar-ideas.php" class="access-panel flex items-center p-4 bg-gray-vidmentor-5  rounded-lg cursor-pointer hover-sidebar-item transition">
                            <i class="fas fa-lightbulb text-4xl card bg-gray-vidmentor-secondary-icon"></i>
                            <span class="ml-4 text-lg font-semibold card bg-gray-vidmentor-secondary-title">Generar Ideas</span>
                        </a>
                        <a href="ideas-guardadas.php" class="access-panel flex items-center p-4 bg-gray-vidmentor-5  rounded-lg cursor-pointer hover-sidebar-item transition">
                            <i class="fas fa-save text-4xl card bg-gray-vidmentor-secondary-icon"></i>
                            <span class="ml-4 text-lg font-semibold card bg-gray-vidmentor-secondary-title">Ideas Guardadas</span>
                        </a>
                        <a href="calendario.php" class="access-panel flex items-center p-4 bg-gray-vidmentor-5  rounded-lg cursor-pointer hover-sidebar-item transition">
                            <i class="fas fa-calendar-alt text-4xl card bg-gray-vidmentor-secondary-icon"></i>
                            <span class="ml-4 text-lg font-semibold card bg-gray-vidmentor-secondary-title">Calendario</span>
                        </a>
                        <a href="perfil.php" class="access-panel flex items-center p-4 bg-gray-vidmentor-5  rounded-lg cursor-pointer hover-sidebar-item transition">
                            <i class="fas fa-user text-4xl card bg-gray-vidmentor-secondary-icon"></i>
                            <span class="ml-4 text-lg font-semibold card bg-gray-vidmentor-secondary-title">Perfil</span>
                        </a>
                        <a href="cambiar-intereses.php" class="access-panel flex items-center p-4 bg-gray-vidmentor-5  rounded-lg cursor-pointer hover-sidebar-item transition">
                            <i class="fas fa-exchange-alt text-4xl card bg-gray-vidmentor-secondary-icon"></i>
                            <span class="ml-4 text-lg font-semibold card bg-gray-vidmentor-secondary-title">Cambiar Intereses</span>
                        </a>
                    </div>
                </div>

                <!-- Paneles de Información Adicional -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
                    <div class="col-span-1 lg:col-span-2">
                        <!-- Panel de Próximo Video Programado -->
                        <div class="card bg-gray-vidmentor-secondary shadow-2xl rounded-lg p-6 flex items-center justify-center mb-6">
                            <div class="text-center">
                                <i class="fas fa-video color-red-vidmentor-secondary text-5xl card bg-gray-vidmentor-secondary-icon"></i>
                                <p class="text-md text-white mt-2">Próximo Video Programado</p>
                                <p class="text-4xl font-semibold card bg-gray-vidmentor-secondary-title mt-2"><?php echo $nextVideoTitle ?></p>
                                <p class="text-md text-white mt-1">Fecha de Publicación: <?php echo $nextVideoDate ?></p>
                            </div>
                        </div>

                        <!-- Panel de Estado de Videos -->
                        <div class="card bg-gray-vidmentor-secondary shadow-2xl rounded-lg p-6 flex items-center justify-center">
                            <div class="text-center">
                                <i class="fas fa-tasks color-red-vidmentor-secondary text-5xl card bg-gray-vidmentor-secondary-icon"></i>
                                <p class="text-md text-white mt-2">Estado de Videos</p>
                                <div class="flex justify-center space-x-4 mt-4">
                                    <div class="text-center">
                                        <p id="loading-pending" class="text-2xl font-semibold card bg-gray-vidmentor-secondary-title">Cargando...</p>
                                        <p id="total-pending" class="text-2xl font-semibold card bg-gray-vidmentor-secondary-title" style="display:none;"></p>
                                        <p class="text-md text-white">En Progreso</p>
                                    </div>
                                    <div class="text-center">
                                        <p id="loading-providers" class="text-2xl font-semibold card bg-gray-vidmentor-secondary-title">Cargando...</p>
                                        <p id="total-providers" class="text-2xl font-semibold card bg-gray-vidmentor-secondary-title" style="display:none;"></p>
                                        <p class="text-md text-white">Publicados</p>
                                    </div>
                                    <div class="text-center">
                                        <p id="loading-pending-providers" class="text-2xl font-semibold card bg-gray-vidmentor-secondary-title">Cargando...</p>
                                        <p id="pending-providers" class="text-2xl font-semibold card bg-gray-vidmentor-secondary-title" style="display:none;"></p>
                                        <p class="text-md text-white">Pendientes</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Panel de Rendimiento de Videos -->
                    <div class="col-span-1 card bg-gray-vidmentor-secondary shadow-2xl rounded-lg p-8">
                        <h2 class="text-2xl font-semibold mb-4 text-center uppercase card bg-gray-vidmentor-secondary-title">Rendimiento de Videos</h2>
                        <div id="loading-video-performance" class="flex justify-center items-center py-4">
                            <div class="animate-spin h-8 w-8 border-t-2 border-b-2 card bg-gray-vidmentor-secondary-icon rounded-full"></div>
                        </div>
                        <div id="video-performance" style="display:none;">
                            <div class="grid grid-cols-1 gap-4">
                                <!-- Gráfico de Rendimiento de Videos -->
                                <canvas id="videoPerformanceChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.getElementById('loading-pending').style.display = 'none';
                document.getElementById('total-pending').style.display = 'block';
                document.getElementById('total-pending').innerText = <?php echo $videosPorSubir?>;
                document.getElementById('loading-providers').style.display = 'none';
                document.getElementById('total-providers').style.display = 'block';
                document.getElementById('total-providers').innerText = <?php echo $videosSubidos?> ;

                document.getElementById('loading-pending-providers').style.display = 'none';
                document.getElementById('pending-providers').style.display = 'block';
                document.getElementById('pending-providers').innerText = <?php echo $videosPendientes?>;
            }, 1000);

            setTimeout(function() {
                document.getElementById('loading-video-performance').style.display = 'none';
                document.getElementById('video-performance').style.display = 'block';

                var ctx = document.getElementById('videoPerformanceChart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Video 1', 'Video 2', 'Video 3', 'Video 4', 'Video 5'],
                        datasets: [{
                            label: 'Vistas',
                            data: [1000, 1500, 3000, 2000, 2500],
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }, 2000);
        });
    </script>
</body>

</html>