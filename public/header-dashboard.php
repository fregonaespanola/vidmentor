<nav class="bg-white shadow-md p-4 flex justify-between items-center">
    <div class="flex items-center justify-center lg:justify-start lg:w-1/3">
        <button id="toggle-sidebar" class="text-gray-600 focus:outline-none  mr-4">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>

    </div>
    <div class="hidden lg:flex lg:w-1/3 justify-center">
        <a href="dashboard.php" class="flex items-center">
            <img class="h-10" src="assets/logo.png" alt="VidMentor Logo">
            <span class="ml-2 text-xl font-bold text-gray-800">VidMentor</span>
        </a>
    </div>
    <div class="flex items-center justify-end lg:w-1/3">
        <input type="text" placeholder="Buscar..." class="border rounded p-2 mr-4">
        <a href="perfil.php" class="text-gray-600 hover:text-gray-900 flex items-center">
            <i class="fas fa-user-circle mr-2"></i>Perfil
        </a>
    </div>
</nav>