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
        .yes, .yespromo {
            position: fixed;
            bottom: 15vh; /* Ajuste la position de l'icône */
            right: 20px; /* Ajuste la position de l'icône */
            z-index: 1000; /* S'assure que l'icône est au-dessus des autres éléments */
        }
        .yespromo {
            position: fixed;
            bottom: 23vh; /* Ajuste la position de l'icône */
            right: 20px; /* Ajuste la position de l'icône */
            z-index: 1000; /* S'assure que l'icône est au-dessus des autres éléments */
        }
        .yesAct {
            position: fixed;
            bottom: 23vh; /* Ajuste la position de l'icône */
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
                <a href="{{ route('admin.transactions') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">transaction</a>
                <a href="{{ route('actionnaires.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Actionnaires</a>
                {{-- <a href="{{ route('admin.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Paramètres</a>
                <a href="{{ route('admin.reports') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Rapports</a> --}}
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
   


        {{-- <button class="flex items-center justify-center w-12 h-12 text-white transition duration-300 bg-yellow-400 rounded-full shadow-lg yespromo hover:bg-yellow-500" id="openModalPromo">
            <div class="flex items-center justify-center w-10 h-10 bg-white rounded-full shadow-md">
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 0l3 9h9l-7 5 3 9-7-5-7 5 3-9-7-5h9z"/>
                </svg>
            </div>
            <span class="text-sm font-bold"></span>
        </button> --}}
  
        {{-- lien pour les actionnaire --}}
     
        @if(auth()->user()->filleuls()->count() > 8) <!-- Vérifie si l'utilisateur est un actionnaire ou a plus de 6 filleuls -->
        <a href="{{ route('actionnaires.create') }}" class="flex items-center justify-center p-4 text-white transition duration-300 bg-green-500 rounded-full shadow hover:bg-green-600 yesAct">
            <i class="fas fa-plus-circle"></i> <!-- Icône de plus stylisée -->
        </a>
    @endif
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
   

   

   <div id="messageModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-opacity-50 bg-slate-500">
    <div class="bg-white rounded-lg shadow-lg w-96">
        <div class="px-4 py-2 border-b">
            <h5 class="text-lg font-bold">Message</h5>
          
        </div>
        <div class="p-4 text-black">
            @if (session('message'))
                <p>{{ session('message') }}</p>
            @endif
        </div>
        <div class="px-4 py-2 border-t">
            <div id="closeModalButton" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none">
                Fermer
            </div>
        </div>
    </div>
</div>

<script>
    // Afficher le modal si un message de session est présent
    document.addEventListener('DOMContentLoaded', function() {
        const message = @json(session('message'));
        if (message) {
            
            document.getElementById('messageModal').classList.remove('hidden');
            console.log(message);
            console.log(messageModal);
        }


        document.getElementById('closeModalButton').addEventListener('click', function() {
            document.getElementById('messageModal').classList.add('hidden');
        });
    });
</script>

<!-- Modal -->
<div id="promoModalCode" class="fixed inset-0 items-center justify-center hidden bg-gray-800 bg-opacity-75">
    {{-- @if(auth()->user()->id == 5 ||auth()->user()->id == 7  || auth()->user()->id == 16  || auth()->user()->id == 25 || auth()->user()->id == 21 || auth()->user()->id == 46 || auth()->user()->id == 3 || auth()->user()->id == 81) --}}
   
    <div class="p-6 bg-white rounded-lg w-96 ">
        <h1 class="mb-4 text-lg font-bold">Utiliser un Code Promo</h1>
        <form action="{{ route('codePromo-usage') }}" method="POST">
            @csrf
            <label for="code" class="block mb-2">Code Promo :</label>
            <input type="text" id="code" name="code" required class="w-full p-2 mb-4 border rounded">
            <button type="submit" class="w-full p-2 text-white bg-yellow-400 rounded hover:bg-yellow-500">Valider</button>
        </form>
        <button id="closeModalPromo" class="p-2 mt-4 bg-gray-300 rounded hover:bg-gray-400">Fermer</button>
    </div>
    {{-- @else    
    <div class="p-6 bg-white rounded-lg w-96 ">

        <h1 class="mb-4 text-lg font-bold text-center text-indigo-600">Utiliser un Code Promo</h1>
        <div class="mb-4 text-center text-gray-700">
            <p class="font-semibold">Événement disponible :</p>
            <div class="mt-2 text-lg font-bold text-green-600">Lundi, 16 décembre à 20h00</div>
        </div>
        <div class="flex justify-center">
            <button id="closeModalPromo" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none">
                Fermer
            </button>
        </div>
    </div>
    @endif --}}
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const openModalPromo = document.getElementById('openModalPromo');
        const closeModalPromo = document.getElementById('closeModalPromo');
        const promoModalCode = document.getElementById('promoModalCode');

        openModalPromo.addEventListener('click', function() {
            promoModalCode.classList.remove('hidden');
            promoModalCode.style.display = 'flex';
            console.log(promoModalCode);
            console.log('ghjkl');
            
        });
        
        closeModalPromo.addEventListener('click', function() {
            promoModalCode.style.display = 'none';
            promoModalCode.classList.add('hidden');
        });

        // Fermer le modal en cliquant en dehors de celui-ci
        window.addEventListener('click', function(event) {
            if (event.target === promoModalCode) {
                promoModalCode.classList.add('hidden');
            }
        });
    });
</script>


</body>
</html>