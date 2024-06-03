<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>VidMentor</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .custom-overlay {
            background: linear-gradient(45deg, rgba(33, 33, 33, 0.7), rgba(33, 33, 33, 0.3));
        }

        section#contact {
            background-size: 200% 200%;
            animation: gradientBG 10s ease infinite;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fadeIn {
            animation: fadeIn 1s ease-in-out forwards;
        }

        .delay-1s {
            animation-delay: 1s;
        }

        .delay-2s {
            animation-delay: 2s;
        }

        .delay-3s {
            animation-delay: 3s;
        }

        .delay-4s {
            animation-delay: 4s;
        }

        .slick-slide {
            transition: transform 0.5s ease;
        }

        .slick-slide:hover {
            transform: scale(1.1);
        }
    </style>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <?php require_once("header.php"); ?>

    <!-- Main content section -->
    <main class="flex-grow">
        <div class="relative bg-cover bg-center" style="background-image: url('assets/diseños.png'); min-height: 100vh; background-size: cover; background-position: center;">
            <div class="absolute inset-0 custom-overlay"></div>
            <div class="container mx-auto h-full flex items-center justify-center">
                <div class="text-center relative mt-8">
                    <h1 class="text-white text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight drop-shadow-lg">
                        <span class="block">A un click</span>
                        <span class="block">de cambiar tu</span>
                        <span class="block relative"><b>historia</b>
                            <img src="assets/stroke.png" class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-full" alt="Stroke">
                        </span>
                    </h1>
                    <a href="#about" class="mt-10 inline-block bg-red-500 text-white text-lg px-6 py-3 rounded-full shadow-lg hover:bg-red-600 transition-colors duration-300">
                        Aprende más
                    </a>
                </div>
            </div>
        </div>

        <!-- Improved Brands section -->
        <section id="brands" class="py-20 bg-gradient-to-r from-gray-100 via-white to-gray-100 text-gray-800">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-12 text-blue-600 animate-fadeIn">Marcas</h2>
                <p class="text-lg leading-relaxed mb-12 max-w-2xl mx-auto animate-fadeIn delay-1s">
                    Descubre cómo VidMentor puede ayudar a tu marca a conectar con los creadores de contenido y a mejorar tu presencia en las redes sociales.
                </p>
                <div class="slider">
                    <div class="p-4 bg-white rounded-lg shadow-lg">
                        <img src="assets/logos/opera.png" alt="Brand 1" class="mx-auto h-64">
                        <h3 class="mt-4 text-xl font-bold text-blue-600">Opera</h3>
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow-lg">
                        <img src="assets/logos/Filmora.jpg" alt="Brand 2" class="mx-auto h-64">
                        <h3 class="mt-4 text-xl font-bold text-red-600">Filmora</h3>
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow-lg">
                        <img src="assets/logos/Project.jpeg" alt="Brand 3" class="mx-auto h-64">
                        <h3 class="mt-4 text-xl font-bold text-green-600">Project</h3>
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow-lg">
                        <img src="assets/logos/meet.jpeg" alt="Brand 4" class="mx-auto h-64">
                        <h3 class="mt-4 text-xl font-bold text-purple-600">Meet</h3>
                    </div>
                </div>
            </div>
        </section>

        <!-- Influencers section -->
        <section id="influencers" class="py-20 bg-gradient-to-r from-gray-100 via-white to-gray-100 text-gray-800">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-12 text-red-600 animate-fadeIn">Influencers</h2>
                <p class="text-lg leading-relaxed mb-12 max-w-2xl mx-auto animate-fadeIn delay-1s">
                    Conoce las herramientas que VidMentor ofrece a los influencers para gestionar y optimizar su contenido y aumentar su audiencia.
                </p>
                <div class="flex flex-wrap justify-center">
                    <div class="m-4 p-6 max-w-xs transform transition-transform duration-500 hover:scale-110 animate-slideInLeft delay-2s bg-red-50 rounded-lg shadow-lg text-center">
                        <i class="fas fa-video text-red-500 text-6xl mb-4"></i>
                        <h3 class="text-xl font-bold mb-2">Gestión de Contenido</h3>
                        <p>Organiza y planifica tu contenido de manera eficiente.</p>
                    </div>
                    <div class="m-4 p-6 max-w-xs transform transition-transform duration-500 hover:scale-110 animate-fadeIn delay-3s bg-red-50 rounded-lg shadow-lg text-center">
                        <i class="fas fa-thumbs-up text-red-500 text-6xl mb-4"></i>
                        <h3 class="text-xl font-bold mb-2">Interacción con la Audiencia</h3>
                        <p>Mejora la relación con tus seguidores y aumenta tu impacto.</p>
                    </div>
                    <div class="m-4 p-6 max-w-xs transform transition-transform duration-500 hover:scale-110 animate-slideInRight delay-4s bg-red-50 rounded-lg shadow-lg text-center">
                        <i class="fas fa-dollar-sign text-red-500 text-6xl mb-4"></i>
                        <h3 class="text-xl font-bold mb-2">Monetización</h3>
                        <p>Descubre nuevas formas de monetizar tu contenido y crecer tu negocio.</p>
                    </div>
                </div>
                <div class="mt-12 animate-fadeIn delay-5s">
                    <h3 class="text-2xl font-bold mb-4 text-red-600">Testimonios de Influencers</h3>
                    <div class="flex flex-wrap justify-center">
                        <div class="max-w-sm m-4 p-6 bg-white rounded-lg shadow-xl transform transition-transform duration-500 hover:scale-105">
                            <div class="flex items-center mb-4">
                                <img src="assets/influencer/kikos.jpeg" alt="Influencer 1" class="w-16 h-16 rounded-full mr-4">
                                <div class="text-left">
                                    <h4 class="text-xl font-bold">Juan Pérez</h4>
                                    <p class="text-sm text-gray-600">@juanperez</p>
                                </div>
                            </div>
                            <p>"VidMentor ha transformado la forma en que gestiono mi contenido. ¡Altamente recomendado!"</p>
                        </div>
                        <div class="max-w-sm m-4 p-6 bg-white rounded-lg shadow-xl transform transition-transform duration-500 hover:scale-105">
                            <div class="flex items-center mb-4">
                                <img src="assets/influencer/kikos.jpeg" alt="Influencer 2" class="w-16 h-16 rounded-full mr-4">
                                <div class="text-left">
                                    <h4 class="text-xl font-bold">Ana Gómez</h4>
                                    <p class="text-sm text-gray-600">@anagomez</p>
                                </div>
                            </div>
                            <p>"Las herramientas de VidMentor me han permitido aumentar mi audiencia y monetizar mi contenido de manera efectiva."</p>
                        </div>
                        <div class="max-w-sm m-4 p-6 bg-white rounded-lg shadow-xl transform transition-transform duration-500 hover:scale-105">
                            <div class="flex items-center mb-4">
                                <img src="assets/influencer/kikos.jpeg" alt="Influencer 3" class="w-16 h-16 rounded-full mr-4">
                                <div class="text-left">
                                    <h4 class="text-xl font-bold">Carlos Ruiz</h4>
                                    <p class="text-sm text-gray-600">@carlosruiz</p>
                                </div>
                            </div>
                            <p>"Gracias a VidMentor, he podido organizar mi contenido de una manera que nunca pensé posible. ¡Es una herramienta increíble!"</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About section -->
        <section id="about" class="py-20 bg-gradient-to-r from-blue-100 via-white to-blue-100 text-gray-800">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-8 text-red-500 animate-fadeIn">¿Qué es VidMentor?</h2>
                <p class="text-lg leading-relaxed mb-12 animate-fadeIn delay-1s">
                    VidMentor es una plataforma diseñada para ayudarte a gestionar y optimizar tu contenido de video, ofreciendo herramientas profesionales para que puedas alcanzar tus metas y vivir de la creación de contenido.
                </p>
                <div class="flex flex-wrap justify-center">
                    <div class="bg-gray-100 rounded-lg shadow-lg p-6 m-4 max-w-xs text-center transform transition duration-500 hover:scale-105 animate-slideInLeft">
                        <i class="fas fa-lightbulb text-red-500 text-6xl mb-4"></i>
                        <h3 class="text-xl font-bold mb-2">Inspiración</h3>
                        <p>Encuentra ideas innovadoras y estrategias para tu contenido.</p>
                    </div>
                    <div class="bg-gray-100 rounded-lg shadow-lg p-6 m-4 max-w-xs text-center transform transition duration-500 hover:scale-105 animate-fadeIn delay-2s">
                        <i class="fas fa-cogs text-red-500 text-6xl mb-4"></i>
                        <h3 class="text-xl font-bold mb-2">Herramientas</h3>
                        <p>Utiliza nuestras herramientas para planificar y gestionar tus videos.</p>
                    </div>
                    <div class="bg-gray-100 rounded-lg shadow-lg p-6 m-4 max-w-xs text-center transform transition duration-500 hover:scale-105 animate-slideInRight delay-3s">
                        <i class="fas fa-chart-line text-red-500 text-6xl mb-4"></i>
                        <h3 class="text-xl font-bold mb-2">Crecimiento</h3>
                        <p>Optimiza tu contenido y aumenta tu audiencia.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact section -->
        <section id="contact" class="py-20 bg-gradient-to-r from-blue-500 via-purple-600 to-blue-800 text-white">
            <div class="container mx-auto text-center">
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-12">Contacto</h2>
                <p class="text-lg leading-relaxed mb-12 max-w-2xl mx-auto">
                    ¿Tienes preguntas? Ponte en contacto con nosotros y descubre cómo VidMentor puede ayudarte.
                </p>
                <div class="max-w-2xl mx-auto bg-white p-10 rounded-xl shadow-2xl transform transition-transform duration-300 hover:scale-105">
                    <form>
                        <div class="mb-6">
                            <label for="name" class="block text-gray-700 text-lg font-semibold mb-2 flex items-center">
                                <i class="fas fa-user mr-2 text-blue-500"></i> Nombre:
                            </label>
                            <input type="text" id="name" name="name" class="shadow appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Tu nombre">
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block text-gray-700 text-lg font-semibold mb-2 flex items-center">
                                <i class="fas fa-envelope mr-2 text-blue-500"></i> Correo electrónico:
                            </label>
                            <input type="email" id="email" name="email" class="shadow appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Tu correo electrónico">
                        </div>
                        <div class="mb-6">
                            <label for="message" class="block text-gray-700 text-lg font-semibold mb-2 flex items-center">
                                <i class="fas fa-comment-dots mr-2 text-blue-500"></i> Mensaje:
                            </label>
                            <textarea id="message" name="message" rows="4" class="shadow appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Tu mensaje"></textarea>
                        </div>
                        <div class="flex items-center justify-center">
                            <button type="submit" class="bg-red-500 text-white py-3 px-6 rounded-full hover:bg-red-600 transition-transform transform hover:scale-105 duration-300">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <?php require_once("footer.php"); ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.slider').slick({
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>
</body>

</html>