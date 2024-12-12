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
        @if (Auth::check() && \Auth::user()->telephone === 696428651) <!-- Vérification si l'utilisateur est admin -->
        {{-- @dd(Auth::user()->telephone) --}}
        <div class="fixed z-40 inline-block pl-8 text-left top-2 ">
            <div class='flex flex-col items-center'>
                <button type="button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-center text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm nextElementSibling hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="menu-button" aria-haspopup="true" aria-expanded="true">
                    Menu Administrateur
                    <svg class="w-5 h-5 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06 0L10 10.84l3.71-3.63a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0l-4.25-4.25a.75.75 0 010-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
   
            <div class="right-0 z-10 w-56 mt-2 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                <div class="py-1 text-center" role="none ">
                    <a href="{{ route('admin.users') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Liste des Utilisateurs</a>
                    {{-- <a href="{{ route('admin.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Paramètres</a>
                    <a href="{{ route('admin.reports') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Rapports</a> --}}
                    <!-- Ajoutez d'autres liens ici -->
                </div>
            </div>
        </div>
    @endif
   
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
     <script>
        document.addEventListener('DOMContentLoaded', function () {
            const button = document.getElementById('menu-button');
            const menu = button.nextElementSibling;
    
            button.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
    
            // Fermer le menu si l'utilisateur clique à l'extérieur
            window.addEventListener('click', (event) => {
                if (!button.contains(event.target) && !menu.contains(event.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>