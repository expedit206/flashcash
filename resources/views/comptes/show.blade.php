<x-app-layout>
    <div class="pb-16">

        <div class="bg-white rounded-lg shadow-md pb-6 ">
            <header class="bg-gray-800 text-white py-2">

                <div class="container mx-auto flex  items-center justify-center">

                    <div class="flex items-start flex-col justify-between w-[35%] h-[35%]">
                        <h1 class="text-mdl font-bold text-center">FlashCash</h1>

                        <x-application-logo class="" />

                    </div>

                    <div class="mt-2 pl-3 text-white">


                        <p class="">Tel : {{ auth()->user()->telephone }}
                            
                        </p>

                        <p class="">Code : {{ auth()->user()->id }}</p>

                    </div>

                </div>

            </header>



            <div class="flex justify-between my-4 px-4">
                <a href="" class="bg-gray-500 text-white rounded-lg px-8 py-2 hover:bg-gray-600 transition flex items-center text-sm">
                    <i class="fas fa-plus-circle mr-2"></i> Dépôt
                </a>
                <a href="" class="bg-gray-500 text-white rounded-lg px-8 py-2 hover:bg-gray-600 transition flex items-center text-sm">
                    <i class="fas fa-minus-circle mr-2"></i> Retrait
                </a>
            </div>
                

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-4">
                <div class="bg-gradient-to-r from-gray-500 to-gray-600 rounded-lg shadow-lg p-4  py-1 transition-transform transform hover:scale-105 flex items-center">
                    <i class="fas fa-wallet text-3xl text-gray-100 mr-2"></i>
                    <div class="text-white">
                        <p class="text-sm font-semibold">Mon Solde </p>
                        <p class="text-sm">{{ number_format($totalBalance, 2, ',', ' ') }} XAF</p>
                    </div>
                </div>
                <div class="bg-gradient-to-r from-gray-500 to-gray-600 rounded-lg shadow-lg p-4 py-1 transition-transform transform hover:scale-105 flex items-center">
                    <i class="fas fa-arrow-up text-3xl text-gray-100 mr-2"></i>
                    <div class="text-white">
                        <p class="text-sm font-semibold">Recharge totale</p>
                        <p class="text-sm">{{ number_format($totalDeposits, 2, ',', ' ') }} XAF</p>
                    </div>
                </div>
                <div class="bg-gradient-to-r from-gray-500 to-gray-600 rounded-lg shadow-lg p-4 py-1 transition-transform transform hover:scale-105 flex items-center">
                    <i class="fas fa-arrow-down text-3xl text-gray-100 mr-2"></i>
                    <div class="text-white">
                        <p class="text-sm font-semibold">Retrait totale</p>
                        <p class="text-sm">{{ number_format($totalWithdrawals, 2, ',', ' ') }} XAF</p>
                    </div>
                </div>
            </div>
        </div>
            
              

               


        <div class="bg-white rounded-lg shadow-md p-6 mt-2">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">

                {{-- <a href="#"
                    class="bg-gray-100 hover:bg-gray-200 rounded-lg shadow-lg p-4 py-2 transition-transform transform hover:scale-105 flex items-center">

                    <i class="fas fa-file-invoice t1xt-3xl text-gray-600 mr-2"></i>

                    <span class="text-md font-semibold">Ma facture</span>

                </a> --}}

                <a href="#"
                    class="bg-gray-100 hover:bg-gray-200 rounded-lg shadow-lg p-4 py-2 transition-transform transform hover:scale-105 flex items-center">

                    <i class="fas fa-wallet text-1xl text-gray-600 mr-2"></i>

                    <span class="text-md font-semibold">Informations portefeuille</span>

                </a>

                <a href="{{ route('profile.edit') }}"
                    class="bg-gray-100 hover:bg-gray-200 rounded-lg shadow-lg p-4 py-2 transition-transform transform hover:scale-105 flex items-center">

                    <i class="fas fa-lock text-1xl text-gray-600 mr-2"></i>

                    <span class="text-md font-semibold">Mot de passe connexion</span>

                </a>
                <a href="{{ route('showPasswordTransaction') }}"
                    class="bg-gray-100 hover:bg-gray-200 rounded-lg shadow-lg p-4 py-2 transition-transform transform hover:scale-105 flex items-center">

                    <i class="fas fa-lock text-1xl text-gray-600 mr-2"></i>

                    <span class="text-md font-semibold">Mot de passe transaction</span>

                </a>

                <a href="#"
                    class="bg-gray-100 hover:bg-gray-200 rounded-lg shadow-lg p-4 py-2 transition-transform transform hover:scale-105 flex items-center">

                    <i class="fas fa-users text-1xl text-gray-600 mr-2"></i>

                    <span class="text-md font-semibold">Qui sommes-nous</span>

                </a>

                <a href="{{ route('taches.index') }}"
                    class="bg-gray-100 hover:bg-gray-200 rounded-lg shadow-lg p-4 py-2 transition-transform transform hover:scale-105 flex items-center">

                    <i class="fas fa-tasks text-1xl text-gray-600 mr-2"></i>

                    <span class="text-md font-semibold">Tâche</span>

                </a>

                <a href="{{ route('logout') }}"
                    class="bg-gray-100 hover:bg-gray-200 rounded-lg shadow-lg p-4 py-2 transition-transform transform hover:scale-105 flex items-center">

                    <i class="fas fa-sign-out-1lt text-3xl text-gray-600 mr-2"></i>

                    <span class="text-md font-semibold">Se déconnecter</span>

                </a>

            </div>

        </div>
    </div>

</x-app-layout>
