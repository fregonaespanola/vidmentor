<style>
    .avatar-container .avatar-modal {
        display: none;
    }
    .avatar-container.show-modal .avatar-modal {
        display: block;
    }
</style>

<nav class='bg-gray-vidmentor-secondary shadow-md'>
    <div class='container mx-auto px-4 py-4 flex justify-between items-center'>
        <!-- Logo -->
        <a href='index.php' class='flex items-center hover-gray-vidmentor'>
            <img class='h-10' src='assets/logo.png' alt='VidMentor Logo'>
        </a>

        <!-- Mobile Menu Button -->
        <button class='lg:hidden text-gray-300 focus:outline-none' id='mobile-menu-button'>
            <i class='fas fa-bars'></i>
        </button>

        <!-- Desktop Menu -->
        <div class='hidden lg:flex lg:items-center lg:w-auto w-full' id='menu'>
            <ul class='text-base lg:flex lg:justify-between lg:space-x-6 space-y-2 lg:space-y-0 text-gray-300'>
                <li><a href='index.php#brands' class='block py-2 lg:px-4 hover:text-white transition duration-300 hover-sidebar-item rounded-md'>Marcas</a></li>
                <li><a href='index.php#influencers' class='block py-2 lg:px-4 hover:text-white transition duration-300 hover-sidebar-item rounded-md'>Influencers</a></li>
                <li><a href='index.php#about' class='block py-2 lg:px-4 hover:text-white transition duration-300 hover-sidebar-item rounded-md'>Nosotros</a></li>
                <li><a href='index.php#contact' class='block py-2 lg:px-4 hover:text-white transition duration-300 hover-sidebar-item rounded-md'>Contacto</a></li>
            </ul>
            <div class='flex items-center relative'>
                <?php if(isset($_SESSION['user'])): ?>
                    <div class="relative avatar-container" id="avatar-container-desktop">
                        <a href='dashboard.php' class='w-full flex justify-center'>
                            <img src="<?= htmlspecialchars($_SESSION['user']['AVATAR'] === 'default.png' ? './images/default.png' : $_SESSION['user']['AVATAR'], ENT_QUOTES, 'UTF-8') ?>"
                                 alt='User Avatar' class='h-10 w-10 rounded-full' id="avatar-desktop">
                        </a>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg overflow-hidden z-20 hidden avatar-modal" id="avatar-modal-desktop">
                            <a href="dashboard.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200 hover:text-black-200">Perfil</a>
                            <a href="logout.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200 hover:text-black-200">Logout</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="login.php"
                       class="ml-4 bg-red-vidmentor-secondary text-white py-2 px-4 rounded-full transition duration-300 transform hover:-translate-y-1">Iniciar sesión</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="hidden lg:hidden bg-gray-vidmentor-secondary shadow-md" id="mobile-menu">
        <ul class="text-base space-y-2 p-4 text-gray-300">
            <li><a href="index.php#about" class="block py-2 hover:text-white transition duration-300 hover-sidebar-item rounded-md">Nosotros</a></li>
            <li><a href="index.php#brands" class="block py-2 hover:text-white transition duration-300 hover-sidebar-item rounded-md">Marcas</a></li>
            <li><a href="index.php#influencers" class="block py-2 hover:text-white transition duration-300 hover-sidebar-item rounded-md">Influencers</a></li>
            <li><a href="index.php#contact" class="block py-2 hover:text-white transition duration-300 hover-sidebar-item rounded-md">Contacto</a></li>
            <li>
                <?php if(isset($_SESSION['user'])): ?>
                    <div class="relative avatar-container" id="avatar-container-mobile">
                        <a href="dashboard.php" class="w-full flex justify-center">
                            <img src="<?= htmlspecialchars($_SESSION['user']['AVATAR'] === 'default.png' ? './images/default.png' : $_SESSION['user']['AVATAR'], ENT_QUOTES, 'UTF-8') ?>" alt="User Avatar" class="h-10 w-10 rounded-full" id="avatar-mobile">
                        </a>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg overflow-hidden z-20 avatar-modal hidden" id="avatar-modal-mobile">
                            <a href="dashboard.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200 hover:text-black-200">Perfil</a>
                            <a href="logout.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200 hover:text-black-200">Logout</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="login.php"
                       class="w-full bg-red-vidmentor-secondary text-white py-2 px-4 rounded-full transition duration-300 transform hover:-translate-y-1 text-center">Iniciar sesión</a>
                <?php endif; ?>
            </li>
        </ul>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const avatarDesktop = document.getElementById('avatar-desktop');
        const avatarModalDesktop = document.getElementById('avatar-modal-desktop');
        const avatarContainerDesktop = document.getElementById('avatar-container-desktop');
        const avatarMobile = document.getElementById('avatar-mobile');
        const avatarModalMobile = document.getElementById('avatar-modal-mobile');
        const avatarContainerMobile = document.getElementById('avatar-container-mobile');
        let timer;

        avatarDesktop.addEventListener('mouseenter', function() {
            clearTimeout(timer);
            avatarContainerDesktop.classList.add('show-modal');
        });

        avatarModalDesktop.addEventListener('mouseenter', function() {
            clearTimeout(timer);
            avatarContainerDesktop.classList.add('show-modal');
        });

        avatarDesktop.addEventListener('mouseleave', function() {
            timer = setTimeout(() => {
                avatarContainerDesktop.classList.remove('show-modal');
            }, 300);
        });

        avatarModalDesktop.addEventListener('mouseleave', function() {
            timer = setTimeout(() => {
                avatarContainerDesktop.classList.remove('show-modal');
            }, 300);
        });

        avatarMobile.addEventListener('mouseenter', function() {
            clearTimeout(timer);
            avatarContainerMobile.classList.add('show-modal');
        });

        avatarModalMobile.addEventListener('mouseenter', function() {
            clearTimeout(timer);
            avatarContainerMobile.classList.add('show-modal');
        });

        avatarMobile.addEventListener('mouseleave', function() {
            timer = setTimeout(() => {
                avatarContainerMobile.classList.remove('show-modal');
            }, 300);
        });

        avatarModalMobile.addEventListener('mouseleave', function() {
            timer = setTimeout(() => {
                avatarContainerMobile.classList.remove('show-modal');
            }, 300);
        });

        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    });
</script>