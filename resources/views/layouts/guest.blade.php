<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title> FlashCash</title>
        
        <link rel="shortcut icon" href="/img/logo_flashcash.png" type="image/x-icon">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="/build/assets/app.css">

    </head>
    <body class="font-sans text-gray-900 antialiased overflow-y-scroll max-h-[100vh] -z-50"
     {{-- style="
    background-image : url('/img/FC6.jpg')
    " --}}
    >
        <div class="flex flex-col items-center min-h-screen pt-2 sm:justify-center sm:pt-0 -z-40"
        style="
        background-image : url('/img/FC6.jpg')
        ">
            {{-- <div class="flex justify-center">
                <a href="/" class="flex justify-center h-[60%] w-[60%] md:h[70%] md:w-[50%] lg:w-[25%]">
                    <div class="flex justify-center">

                    </div>
                </a>
            </div> --}}
            
            <div class="w-full px-6 py-4 mt-10 mb-24 shadow-md mb- sm:max-w-md shadow-slate-600"
         
            >
            <header class="bg-gray-900 p-6">
                <h1 class="text-xl font-bold text-white">Découvrez notre plateforme d'investissement avec plus de 50 000 investissements.</h1>
            </header>
        
            <main class="p-6">
                <h2 class="text-sm mt-4 text-white">Rejoignez notre communauté d'investisseurs et profitez de nombreuses options d'investissement adaptées à vos besoins.</h2>
               
            </main>
            <x-application-logo class="w-20 h-20 mb-8 text-gray-500 fill-current" />
                {{ $slot }}
            </div>
        </div>
        <footer class="bg-gray-800 text-white fixed bottom-[.3vh] px-auto  w-[100vw] mx-auto l-[0]">
            <div class="container mx-auto text-center">
                <p>&copy; {{ date('Y') }} Flash Cash. Tous droits réservés.</p>
                <p>
                    <a href="{{ route('politique.utilisation') }}" class="text-gray-400 hover:text-gray-300">Conditions d'utilisation</a> |
                    <a href="{{ route('politique.utilisation') }}" class="text-gray-400 hover:text-gray-300">Politique de confidentialité</a>
                </p>
            </div>
        </footer>
    </body>
</html>
