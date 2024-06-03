<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - VidMentor</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styles_dashboard.css">
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <?php require_once("header-dashboard.php"); ?>

    <div class="flex flex-grow">
        <?php require_once("sidebar-dashboard.php"); ?>

        <!-- Main content section -->
        <main class="flex-grow p-6">
            <div class="container mx-auto mt-6">
                <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6 uppercase">Dashboard</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Panel de Bienvenida -->
                    <div class="bg-white shadow-2xl rounded-lg p-6 flex flex-col justify-between h-full">
                        <div>
                            <div class="relative">
                                <img src="assets/fondo2.webp" alt="Banner" class="w-full h-40 object-cover rounded-t-lg">
                                <div class="absolute top-4 left-4 bg-orange-500 text-white rounded-full p-2">
                                    <i class="fas fa-user-circle text-4xl"></i>
                                </div>
                                <div class="absolute top-16 left-4">
                                    <h3 class="text-xl font-bold text-white">Nombre del Usuario</h3>
                                    <p class="text-sm text-white">Posición del Usuario</p>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <h1 class="text-2xl font-semibold mb-2">Bienvenido a VidMentor</h1>
                                <p class="text-sm text-gray-600"><i class="fas fa-envelope mr-2"></i>email@dominio.com</p>
                                <p class="text-sm text-gray-600"><i class="fas fa-user-tag mr-2"></i>Rol del Usuario</p>
                                <p class="mt-4 text-gray-700">Gestiona tu contenido y estrategias de redes sociales con VidMentor.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Panel de Accesos Rápidos -->
                    <div class="bg-white shadow-2xl rounded-lg p-6 grid grid-cols-2 gap-6 h-full">
                        <a href="generar-ideas.php" class="access-panel flex items-center p-4 bg-gray-100 rounded-lg cursor-pointer">
                            <i class="fas fa-lightbulb text-4xl text-orange-500"></i>
                            <span class="ml-4 text-lg font-semibold text-orange-700">Generar Ideas</span>
                        </a>
                        <a href="ideas-guardadas.php" class="access-panel flex items-center p-4 bg-gray-100 rounded-lg cursor-pointer">
                            <i class="fas fa-save text-4xl text-orange-500"></i>
                            <span class="ml-4 text-lg font-semibold text-orange-700">Ideas Guardadas</span>
                        </a>
                        <a href="calendario.php" class="access-panel flex items-center p-4 bg-gray-100 rounded-lg cursor-pointer">
                            <i class="fas fa-calendar-alt text-4xl text-orange-500"></i>
                            <span class="ml-4 text-lg font-semibold text-orange-700">Calendario</span>
                        </a>
                        <a href="perfil.php" class="access-panel flex items-center p-4 bg-gray-100 rounded-lg cursor-pointer">
                            <i class="fas fa-user text-4xl text-orange-500"></i>
                            <span class="ml-4 text-lg font-semibold text-orange-700">Perfil</span>
                        </a>
                        <a href="cambiar-intereses.php" class="access-panel flex items-center p-4 bg-gray-100 rounded-lg cursor-pointer">
                            <i class="fas fa-exchange-alt text-4xl text-orange-500"></i>
                            <span class="ml-4 text-lg font-semibold text-orange-700">Cambiar Intereses</span>
                        </a>
                    </div>
                </div>

                <!-- Paneles de Información Adicional -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 col-span-1">
                        <!-- Panel de Próximo Video Programado -->
                        <div class="bg-white shadow-2xl rounded-lg p-6 flex items-center justify-center">
                            <div class="text-center">
                                <i class="fas fa-video text-5xl text-orange-500"></i>
                                <p class="text-md text-gray-600 mt-2">Próximo Video Programado</p>
                                <p class="text-4xl font-semibold text-orange-500 mt-2">Título del Video</p>
                                <p class="text-md text-gray-600 mt-1">Fecha de Publicación: 12/12/2024</p>
                            </div>
                        </div>

                        <!-- Panel de Estado de Videos -->
                        <div class="bg-white shadow-2xl rounded-lg p-6 flex items-center justify-center">
                            <div class="text-center">
                                <i class="fas fa-tasks text-5xl text-orange-500"></i>
                                <p class="text-md text-gray-600 mt-2">Estado de Videos</p>
                                <div class="flex justify-center space-x-4 mt-4">
                                    <div class="text-center">
                                        <p class="text-2xl font-semibold text-orange-500">5</p>
                                        <p class="text-md text-gray-600">En Progreso</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-2xl font-semibold text-orange-500">10</p>
                                        <p class="text-md text-gray-600">Publicados</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-2xl font-semibold text-orange-500">2</p>
                                        <p class="text-md text-gray-600">Pendientes</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Panel de Rendimiento de Videos -->
                    <div class="col-span-1 bg-white shadow-2xl rounded-lg p-8">
                        <h2 class="text-xl font-semibold mb-4 text-center uppercase">Rendimiento de Videos</h2>
                        <div id="loading-video-performance" class="flex justify-center items-center py-4">
                            <div class="animate-spin h-8 w-8 border-t-2 border-b-2 border-orange-500 rounded-full"></div>
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
    <script src="js/dashboard.js"></script>
    <script>
        // Simulación de carga de datos para el rendimiento de videos
        document.addEventListener('DOMContentLoaded', function() {
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