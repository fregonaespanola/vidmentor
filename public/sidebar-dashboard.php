<div class="flex">
    <!-- Sidebar -->
    <aside id="sidebar" class="bg-gray-vidmentor-5 text-white w-64 min-h-screen p-4 transition-transform duration-300 ease-in-out transform lg:translate-x-0 -translate-x-full lg:block fixed lg:static inset-y-0 left-0 z-30">
        <button id="collapse-button" class="text-white p-2 focus:outline-none absolute top-4 right-4 lg:hidden">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <ul class="space-y-4 mt-8">
            <li>
                <a href="dashboard.php" class="block py-2 px-4 hover-sidebar-item rounded flex items-center">
                    <i class="fas fa-gauge mr-2"></i>Dashboard
                </a>
            </li>
            <li>
                <a href="ideas.php" class="block py-2 px-4 hover-sidebar-item rounded flex items-center">
                    <i class="fas fa-lightbulb mr-2"></i>Generar Ideas
                </a>
            </li>
            <li>
                <a href="calendar.php" class="block py-2 px-4 hover-sidebar-item rounded flex items-center">
                    <i class="fas fa-save mr-2"></i>Ideas Guardadas
                </a>
            </li>
            <li>
                <a href="calendar.php" class="block py-2 px-4 hover-sidebar-item rounded flex items-center">
                    <i class="fas fa-calendar-alt mr-2"></i>Calendario
                </a>
            </li>
            <li>
                <a href="intereses.php" class="block py-2 px-4 hover-sidebar-item rounded flex items-center">
                    <i class="fas fa-exchange-alt mr-2"></i>Cambiar Intereses
                </a>
            </li>
        </ul>
    </aside>
</div>

<script>
    document.getElementById('toggle-sidebar').onclick = function() {
        var sidebar = document.getElementById('sidebar');
        if (sidebar.classList.contains('translate-x-0')) {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
        } else {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
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