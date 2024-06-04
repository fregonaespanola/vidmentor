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
        <!-- Sidebar -->
        <aside id="sidebar" class="bg-gray-800 text-white w-64 min-h-screen p-4 transition-transform duration-300 ease-in-out transform lg:translate-x-0 -translate-x-full lg:block">
            <button id="collapse-button" class="text-white p-2 focus:outline-none absolute top-4 right-4 lg:hidden">
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
        <main class="flex-grow p-6">
            <!-- Your main content here -->
        </main>
    </div>

    <script>
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
            if (sidebar.classList.contains('translate-x-0')) {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
            } else {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
            }
        }
    </script>
</body>

</html>