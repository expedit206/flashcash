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
       @if (Auth::check() && Auth::user()->telephone === 696428651) <!-- Vérification si l'utilisateur est admin -->
    <div class="fixed z-40 inline-block pl-8 text-left top-2">
        <div class='flex flex-col items-center bg-blue-500'>
            <!-- Icône hamburger comme bouton -->
            <button type="button" class="inline-flex items-center justify-center w-full p-2 text-gray-700 bg-white bg-blue-500 border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="menu-button" aria-haspopup="true" aria-expanded="false" onclick="toggleDropdown()">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>

        <div id="dropdown-menu" class="right-0 z-10 hidden w-56 mt-2 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1 text-center" role="none">
                <a href="{{ route('admin.users') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Users</a>
                <a href="{{ route('produit_user.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">produit_user</a>
                <a href="{{ route('transactions.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">produit_user</a>
                {{-- <a href="{{ route('admin.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Paramètres</a>
                <a href="{{ route('admin.reports') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Rapports</a> --}}git restore  resources/views/layouts/app.blade.php
                <!-- Ajoutez d'autres liens ici -->
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('hidden');
        }

        // Fermer le dropdown si l'utilisateur clique en dehors
        window.addEventListener('click', function(event) {
            const dropdownMenu = document.getElementById('dropdown-menu');
            const button = document.getElementById('menu-button');

            if (!button.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
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
   
</body>
</html>