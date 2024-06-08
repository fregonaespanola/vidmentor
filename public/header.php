<nav class="bg-gray-vidmentor-secondary shadow-md">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="index.php" class="flex items-center hover-gray-vidmentor">
            <img class="h-10" src="assets/logo.png" alt="VidMentor Logo">
        </a>

        <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
            <ul class="text-base lg:flex lg:justify-between lg:space-x-6 space-y-2 lg:space-y-0 text-gray-300">
                <li><a href="index.php#brands" class="block py-2 lg:px-4 hover:text-white transition duration-300 hover-sidebar-item rounded-md">Marcas</a></li>
                <li><a href="index.php#influencers" class="block py-2 lg:px-4 hover:text-white transition duration-300 hover-sidebar-item rounded-md">Influencers</a></li>
                <li><a href="index.php#about" class="block py-2 lg:px-4 hover:text-white transition duration-300 hover-sidebar-item rounded-md">Nosotros</a></li>
                <li><a href="index.php#contact" class="block py-2 lg:px-4 hover:text-white transition duration-300 hover-sidebar-item rounded-md">Contacto</a></li>
            </ul>
            <div class="flex items-center">
                <a href="login.php" class="ml-4 bg-red-vidmentor-secondary text-white py-2 px-4 rounded-full  transition duration-300 transform hover:-translate-y-1">Iniciar sesión</a>
            </div>
        </div>
    </div>
    <div class="lg:hidden bg-gray-vidmentor-secondary shadow-md" id="mobile-menu" style="display: none;">
        <ul class="text-base space-y-2 p-4 text-gray-300">
            <li><a href="#brands" class="block py-2 hover:text-white transition duration-300 hover-sidebar-item rounded-md">Marcas</a></li>
            <li><a href="#influencers" class="block py-2 hover:text-white transition duration-300 hover-sidebar-item rounded-md">Influencers</a></li>
            <li><a href="#about" class="block py-2 hover:text-white transition duration-300 hover-sidebar-item rounded-md">Nosotros</a></li>
            <li><a href="#contact" class="block py-2 hover:text-white transition duration-300 hover-sidebar-item rounded-md">Contacto</a></li>
            <li>
                <a href="login.php" class="w-full bg-red-vidmentor-secondary text-white py-2 px-4 rounded-full  transition duration-300 transform hover:-translate-y-1 text-center">Iniciar sesión</a>
            </li>
        </ul>
    </div>
</nav>