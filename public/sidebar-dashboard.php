<aside class="bg-gray-800 text-white w-64 min-h-screen p-4 hidden lg:block">
    <ul class="space-y-4">
        <li><a href="dashboard.php" class="block py-2 px-4 hover:bg-gray-700 rounded">Generar Ideas</a></li>
        <li><a href="contenido.php" class="block py-2 px-4 hover:bg-gray-700 rounded">Contenido</a></li>
        <li><a href="estadisticas.php" class="block py-2 px-4 hover:bg-gray-700 rounded">Estadísticas</a></li>
        <li><a href="configuracion.php" class="block py-2 px-4 hover:bg-gray-700 rounded">Configuración</a></li>
        <li><a href="soporte.php" class="block py-2 px-4 hover:bg-gray-700 rounded">Soporte</a></li>
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
            <li><a href="dashboard.php" class="block py-2 px-4 hover:bg-gray-700 rounded">Generar Ideas
                </a></li>
            <li><a href="contenido.php" class="block py-2 px-4 hover:bg-gray-700 rounded">Ideas Guardadas
                </a></li>
            <li><a href="estadisticas.php" class="block py-2 px-4 hover:bg-gray-700 rounded">Calendario</a></li>
            <li><a href="configuracion.php" class="block py-2 px-4 hover:bg-gray-700 rounded">Perfil </a></li>
            <li><a href="soporte.php" class="block py-2 px-4 hover:bg-gray-700 rounded">Cambiar intereses
                </a></li>
        </ul>
    </aside>
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
</script>