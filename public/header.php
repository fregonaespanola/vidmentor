<nav class="bg-gray-800 shadow-md">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="index.php" class="flex items-center">
            <img class="h-10" src="assets/logo.png" alt="VidMentor Logo">
        </a>
        <button class="lg:hidden block text-gray-400 focus:outline-none" id="menu-toggle">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
        <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
            <ul class="text-base lg:flex lg:justify-between lg:space-x-6 space-y-2 lg:space-y-0">
                <li><a href="#brands" class="block py-2 lg:px-4 hover:text-gray-100 transition duration-300 hover:bg-gray-700 rounded-md">Marcas</a></li>
                <li><a href="#influencers" class="block py-2 lg:px-4 hover:text-gray-100 transition duration-300 hover:bg-gray-700 rounded-md">Influencers</a></li>
                <li><a href="#about" class="block py-2 lg:px-4 hover:text-gray-100 transition duration-300 hover:bg-gray-700 rounded-md">Nosotros</a></li>
                <li><a href="#contact" class="block py-2 lg:px-4 hover:text-gray-100 transition duration-300 hover:bg-gray-700 rounded-md">Contacto</a></li>
            </ul>
            <div class="flex items-center">
                <a href="login.php" class="ml-4 bg-red-500 text-white py-2 px-4 rounded-full hover:bg-red-600 transition duration-300 transform hover:-translate-y-1">Iniciar sesión</a>
            </div>
        </div>
    </div>
    <div class="lg:hidden bg-gray-800 shadow-md" id="mobile-menu" style="display: none;">
        <ul class="text-base space-y-2 p-4">
            <li><a href="#brands" class="block py-2 hover:text-gray-100 transition duration-300 hover:bg-gray-700 rounded-md">Marcas</a></li>
            <li><a href="#influencers" class="block py-2 hover:text-gray-100 transition duration-300 hover:bg-gray-700 rounded-md">Influencers</a></li>
            <li><a href="#about" class="block py-2 hover:text-gray-100 transition duration-300 hover:bg-gray-700 rounded-md">Nosotros</a></li>
            <li><a href="#contact" class="block py-2 hover:text-gray-100 transition duration-300 hover:bg-gray-700 rounded-md">Contacto</a></li>
            <li>
                <a href="login.php" class="w-full bg-red-500 text-white py-2 px-4 rounded-full hover:bg-red-600 transition duration-300 transform hover:-translate-y-1 text-center">Iniciar sesión</a>
            </li>
        </ul>
    </div>
</nav>

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