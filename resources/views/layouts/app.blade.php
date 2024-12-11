<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> FlashCash </title>

    <link rel="shortcut icon" href="/img/logo_flashcash.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="/build/assets/app-DB79hNgi.css">
    <script src="/build/assets/app-DLXkxiZ3.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>
<body class="font-sans antialiased">
    <style>
        .way {
            background: rgb(47, 200, 182);
            padding: .5rem;
            border-radius: 50%;
            font-size: 1.5rem;
            color: white;
        }
        .yes {
            position: fixed;
            bottom: 15vh; /* Ajuste la position de l'icône */
            right: 20px; /* Ajuste la position de l'icône */
            z-index: 1000; /* S'assure que l'icône est au-dessus des autres éléments */
        }
    </style>
    <div class="">
        @include('layouts.navigation')

        @isset($header)
            <header class="shadow">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-7">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="">
            {{ $slot }}
        </main>
    </div>

    <!-- Lien vers la route des tâches -->
    <a href="{{ route('taches.index') }}" class="flex items-center justify-center task-icon yes">
        <i class="fas fa-tasks way"></i>
    </a>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swiper = new Swiper('.swiper-container', {
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                loop: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
            });
        });
    </script>
</body>
</html>