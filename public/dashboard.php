<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - VidMentor</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styles_dashboard.css">

    <style>
        body {
            background-color: #212121;
            color: #ffffff;
            font-family: 'Karla', sans-serif;
            padding: 0;
            margin: 0;
        }

        .dashboard-background {
            background-image: url('assets/diseños.png');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            position: relative;
        }

        .shadow-2xl {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
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

        .bg-overlay {
            background: linear-gradient(45deg, rgba(33, 33, 33, 0.7), rgba(33, 33, 33, 0.3));
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        #sidebar.hidden {
            transform: translateX(-100%);
        }

        #sidebar {
            transition: transform 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <?php require_once("header-dashboard.php"); ?>

    <div class="flex flex-grow dashboard-background">
        <div class="bg-overlay"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="bg-gray-800 text-white w-64 min-h-screen p-4 hidden lg:block transform lg:translate-x-0 -translate-x-full">
            <button id="collapse-button" class="text-white p-2 focus:outline-none absolute top-4 right-4">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <ul class="space-y-4">
                <li>
                    <a href="dashboard.php" class="block py-2 px-4 hover:bg-gray-700 rounded flex items-center">
                        <i class="fas fa-lightbulb mr-2"></i>Generar Ideas
                    </a>
                </li>
                <li>
                    <a href="contenido.php" class="block py-2 px-4 hover:bg-gray-700 rounded flex items-center">
                        <i class="fas fa-save mr-2"></i>Contenido
                    </a>
                </li>
                <li>
                    <a href="estadisticas.php" class="block py-2 px-4 hover:bg-gray-700 rounded flex items-center">
                        <i class="fas fa-chart-line mr-2"></i>Estadísticas
                    </a>
                </li>
                <li>
                    <a href="configuracion.php" class="block py-2 px-4 hover:bg-gray-700 rounded flex items-center">
                        <i class="fas fa-cog mr-2"></i>Configuración
                    </a>
                </li>
                <li>
                    <a href="soporte.php" class="block py-2 px-4 hover:bg-gray-700 rounded flex items-center">
                        <i class="fas fa-life-ring mr-2"></i>Soporte
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Sidebar for mobile devices -->
        <div class="lg:hidden">
            <button id="menu-toggle" class="text-gray-600 p-4 focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
            <aside id="mobile-menu" class="bg-gray-800 text-white p-4 hidden">
                <ul class="space-y-4">
                    <li>
                        <a href="dashboard.php" class="block py-2 px-4 hover:bg-gray-700 rounded flex items-center">
                            <i class="fas fa-lightbulb mr-2"></i>Generar Ideas
                        </a>
                    </li>
                    <li>
                        <a href="contenido.php" class="block py-2 px-4 hover:bg-gray-700 rounded flex items-center">
                            <i class="fas fa-save mr-2"></i>Contenido
                        </a>
                    </li>
                    <li>
                        <a href="estadisticas.php" class="block py-2 px-4 hover:bg-gray-700 rounded flex items-center">
                            <i class="fas fa-chart-line mr-2"></i>Estadísticas
                        </a>
                    </li>
                    <li>
                        <a href="configuracion.php" class="block py-2 px-4 hover:bg-gray-700 rounded flex items-center">
                            <i class="fas fa-cog mr-2"></i>Configuración
                        </a>
                    </li>
                    <li>
                        <a href="soporte.php" class="block py-2 px-4 hover:bg-gray-700 rounded flex items-center">
                            <i class="fas fa-life-ring mr-2"></i>Soporte
                        </a>
                    </li>
                </ul>
            </aside>
        </div>

        <!-- Main content section -->
        <main class="flex-grow p-6 relative z-10">
            <div class="container mx-auto mt-6">
                <button id="collapse-sidebar" class="text-white bg-gray-700 p-2 rounded mb-4 lg:hidden">Toggle Sidebar</button>
                <h2 class="text-3xl font-semibold text-center text-gray-200 mb-6 uppercase">Dashboard</h2>
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
                        <a href="generar-ideas.php" class="access-panel flex items-center p-4 bg-gray-100 rounded-lg cursor-pointer hover:bg-gray-200 transition">
                            <i class="fas fa-lightbulb text-4xl text-orange-500"></i>
                            <span class="ml-4 text-lg font-semibold text-orange-700">Generar Ideas</span>
                        </a>
                        <a href="ideas-guardadas.php" class="access-panel flex items-center p-4 bg-gray-100 rounded-lg cursor-pointer hover:bg-gray-200 transition">
                            <i class="fas fa-save text-4xl text-orange-500"></i>
                            <span class="ml-4 text-lg font-semibold text-orange-700">Ideas Guardadas</span>
                        </a>
                        <a href="calendario.php" class="access-panel flex items-center p-4 bg-gray-100 rounded-lg cursor-pointer hover:bg-gray-200 transition">
                            <i class="fas fa-calendar-alt text-4xl text-orange-500"></i>
                            <span class="ml-4 text-lg font-semibold text-orange-700">Calendario</span>
                        </a>
                        <a href="perfil.php" class="access-panel flex items-center p-4 bg-gray-100 rounded-lg cursor-pointer hover:bg-gray-200 transition">
                            <i class="fas fa-user text-4xl text-orange-500"></i>
                            <span class="ml-4 text-lg font-semibold text-orange-700">Perfil</span>
                        </a>
                        <a href="cambiar-intereses.php" class="access-panel flex items-center p-4 bg-gray-100 rounded-lg cursor-pointer hover:bg-gray-200 transition">
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
                                        <p id="loading-pending" class="text-2xl font-semibold text-orange-500">Cargando...</p>
                                        <p id="total-pending" class="text-2xl font-semibold text-orange-500" style="display:none;"></p>
                                        <p class="text-md text-gray-600">En Progreso</p>
                                    </div>
                                    <div class="text-center">
                                        <p id="loading-providers" class="text-2xl font-semibold text-orange-500">Cargando...</p>
                                        <p id="total-providers" class="text-2xl font-semibold text-orange-500" style="display:none;"></p>
                                        <p class="text-md text-gray-600">Publicados</p>
                                    </div>
                                    <div class="text-center">
                                        <p id="loading-pending-providers" class="text-2xl font-semibold text-orange-500">Cargando...</p>
                                        <p id="pending-providers" class="text-2xl font-semibold text-orange-500" style="display:none;"></p>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simulación de carga de datos
            setTimeout(function() {
                document.getElementById('loading-pending').style.display = 'none';
                document.getElementById('total-pending').style.display = 'block';
                document.getElementById('total-pending').innerText = '5'; // Datos de ejemplo

                document.getElementById('loading-providers').style.display = 'none';
                document.getElementById('total-providers').style.display = 'block';
                document.getElementById('total-providers').innerText = '20'; // Datos de ejemplo

                document.getElementById('loading-pending-providers').style.display = 'none';
                document.getElementById('pending-providers').style.display = 'block';
            }, 2000);

            // Simulación de carga de datos para el rendimiento de videos
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

        document.getElementById('menu-toggle').onclick = function() {
            var mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenu.style.display === 'none' || mobileMenu.style.display === '') {
                mobileMenu.style.display = 'block';
            } else {
                mobileMenu.style.display = 'none';
            }
        }

        document.getElementById('collapse-button').onclick = function() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        }

        document.getElementById('collapse-sidebar').onclick = function() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('translate-x-0');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>
</body>

</html>