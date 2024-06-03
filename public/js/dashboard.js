document.addEventListener('DOMContentLoaded', function () {
    // Simulación de carga de datos
    setTimeout(function () {
        document.getElementById('loading-pending').style.display = 'none';
        document.getElementById('total-pending').style.display = 'block';
        document.getElementById('total-pending').innerText = '5'; // Datos de ejemplo

        document.getElementById('loading-providers').style.display = 'none';
        document.getElementById('total-providers').style.display = 'block';
        document.getElementById('total-providers').innerText = '20'; // Datos de ejemplo

        document.getElementById('loading-pending-providers').style.display = 'none';
        document.getElementById('pending-providers').style.display = 'block';
    }, 2000);
});

document.getElementById('menu-toggle').onclick = function () {
    var mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenu.style.display === 'none' || mobileMenu.style.display === '') {
        mobileMenu.style.display = 'block';
    } else {
        mobileMenu.style.display = 'none';
    }
}
