<nav class="bg-gray-vidmentor-secondary shadow-md p-4 flex justify-between items-center">
    <div class="flex items-center justify-center lg:justify-start lg:w-1/3">
        <button id="toggle-sidebar" class="text-white focus:outline-none mr-4">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
    </div>
    <div class="hidden lg:flex lg:w-1/3 justify-center">
    <a href="dashboard.php" class="flex items-center header-navigat">
        <img class="h-10" src="assets/logo.png" alt="VidMentor Logo">
        <span class="ml-2 text-xl font-bold text-white">VidMentor</span>
    </a>
</div>
    <div class="flex items-center justify-end lg:w-1/3 relative">
        <button id="profile-button" class="flex items-center bg-red-vidmentor-secondary text-white px-4 py-2 rounded hover:bg-red-700 focus:outline-none">
            <img src="<?= htmlspecialchars($_SESSION['user']['AVATAR'] != 'default.png' ? $_SESSION['user']['AVATAR'] : './images/default.png', ENT_QUOTES, 'UTF-8') ?>"
                 alt='User Avatar' class='h-10 w-10 rounded-full mr-3'>
            <span>
                Perfil
            </span>
        </button>

        <!-- Modal -->
        <div id="profile-modal" class="hidden absolute top-12 right-0 bg-gray-vidmentor-cuat shadow-md rounded-lg w-64 z-50">
            <div class="p-4">
                <h2 class="text-xl font-semibold mb-4">Perfil</h2>
                <ul>
                    <li class="mb-2 flex items-center">
                        <i class="fas fa-user mr-2 text-blue-500"></i>
                        <a href="editProfile.php" class="text-blue-500 hover:underline">Mi cuenta</a>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-sign-out-alt mr-2 text-blue-500"></i>
                        <a href="logout.php" class="text-blue-500 hover:underline">Cerrar sesión</a>
                    </li>
                </ul>
                <button id="close-modal" class="mt-4 bg-red-vidmentor-secondary w-full text-white px-4 py-2 rounded hover:bg-red-600">Cerrar</button>
            </div>
        </div>
    </div>
</nav>

<script>
    document.getElementById('profile-button').onclick = function(event) {
        document.getElementById('profile-modal').classList.toggle('hidden');
    }

    document.getElementById('close-modal').onclick = function() {
        document.getElementById('profile-modal').classList.add('hidden');
    }

    window.onclick = function(event) {
        let modal = document.getElementById('profile-modal');
        if (event.target !== modal && !modal.contains(event.target) && event.target.id !== 'profile-button' && !document.getElementById('profile-button').contains(event.target)) {
            modal.classList.add('hidden');
        }
    }
</script>