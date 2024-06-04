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

    // Simulación de carga de datos para el rendimiento de videos
    setTimeout(function () {
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

document.getElementById('menu-toggle').onclick = function () {
    var mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenu.style.display === 'none' || mobileMenu.style.display === '') {
        mobileMenu.style.display = 'block';
    } else {
        mobileMenu.style.display = 'none';
    }
}

document.getElementById('collapse-button').onclick = function () {
    var sidebar = document.querySelector('aside');
    sidebar.classList.toggle('hidden');
}
