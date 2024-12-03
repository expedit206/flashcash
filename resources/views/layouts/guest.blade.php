<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="/build/assets/app.css">

    </head>
    <body class="font-sans text-gray-900 antialiased overflow-y-scroll max-h-[100vh] -z-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-800  -z-40">
            <div class="flex justify-center">
                <a href="/" class="flex justify-center h-[60%] w-[60%] md:h[70%] md:w-[50%] lg:w-[25%]">
                    <div class="flex justify-center">

                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-4 px-6 py-4 shadow-md shadow-slate-600 bg-slate-200 overflow-y-scroll ">
                {{ $slot }}
            </div>
        </div>
        <footer class="bg-gray-800 text-white fixed bottom-[.3vh] px-auto  w-[100vw] mx-auto l-[0]">
            <div class="container mx-auto text-center">
                <p>&copy; {{ date('Y') }} Flash Cash. Tous droits réservés.</p>
                <p>
                    <a href="#" class="text-gray-400 hover:text-gray-300">Conditions d'utilisation</a> |
                    <a href="#" class="text-gray-400 hover:text-gray-300">Politique de confidentialité</a>
                </p>
            </div>
        </footer>
    </body>
</html>
