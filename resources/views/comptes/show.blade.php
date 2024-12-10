<x-app-layout>
    <div class="pb-16">

        <div class="pb-6 bg-white rounded-lg shadow-md ">
            <x-header/>

           <x-button-transaction/>

            <div class="grid grid-cols-1 gap-4 px-4 md:grid-cols-3">
                <div class="flex items-center p-4 py-1 transition-transform transform rounded-lg shadow-lg bg-gradient-to-r from-gray-500 to-gray-600 hover:scale-105">
                    <i class="mr-2 text-3xl text-gray-100 fas fa-wallet"></i>
                    <div class="text-white">
                        <p class="text-sm font-semibold">Mon Solde </p>
                        <p class="text-sm">{{ number_format($totalBalance, 2, ',', ' ') }} XAF</p>
                    </div>
                </div>
                <div class="flex items-center p-4 py-1 transition-transform transform rounded-lg shadow-lg bg-gradient-to-r from-gray-500 to-gray-600 hover:scale-105">
                    <i class="mr-2 text-3xl text-gray-100 fas fa-arrow-up"></i>
                    <div class="text-white">
                        <p class="text-sm font-semibold">Recharge totale</p>
                        <p class="text-sm">{{ number_format($totalDeposits, 2, ',', ' ') }} XAF</p>
                    </div>
                </div>
                <div class="flex items-center p-4 py-1 transition-transform transform rounded-lg shadow-lg bg-gradient-to-r from-gray-500 to-gray-600 hover:scale-105">
                    <i class="mr-2 text-3xl text-gray-100 fas fa-arrow-down"></i>
                    <div class="text-white">
                        <p class="text-sm font-semibold">Retrait totale</p>
                        <p class="text-sm">{{ number_format($totalWithdrawals, 2, ',', ' ') }} XAF</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 mt-2 bg-white rounded-lg shadow-md">
            <div class="grid grid-cols-1 gap-2 md:grid-cols-2">
        
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center p-4 py-2 transition-transform transform bg-gray-100 rounded-lg shadow-lg hover:bg-gray-200 hover:scale-105">
                    <i class="mr-2 text-gray-600 fas fa-lock text-1xl"></i>
                    <span class="font-semibold text-md">Mot de passe connexion</span>
                </a>
        
                <a href="{{ route('transactions.index') }}"
                    class="flex items-center p-4 py-2 transition-transform transform bg-gray-100 rounded-lg shadow-lg hover:bg-gray-200 hover:scale-105">
                    <i class="mr-2 text-gray-600 fas fa-history text-1xl"></i>
                    <span class="font-semibold text-md">Historique de transaction</span>
                </a>
        
                <a href="{{ route('showPasswordTransaction') }}"
                    class="flex items-center p-4 py-2 transition-transform transform bg-gray-100 rounded-lg shadow-lg hover:bg-gray-200 hover:scale-105">
                    <i class="mr-2 text-gray-600 fas fa-lock text-1xl"></i>
                    <span class="font-semibold text-md">Mot de passe transaction</span>
                </a>
        
                <a href="#"
                    class="flex items-center p-4 py-2 transition-transform transform bg-gray-100 rounded-lg shadow-lg hover:bg-gray-200 hover:scale-105">
                    <i class="mr-2 text-gray-600 fas fa-users text-1xl"></i>
                    <span class="font-semibold text-md">Qui sommes-nous</span>
                </a>
        
                <a href="{{ route('taches.index') }}"
                    class="flex items-center p-4 py-2 transition-transform transform bg-gray-100 rounded-lg shadow-lg hover:bg-gray-200 hover:scale-105">
                    <i class="mr-2 text-gray-600 fas fa-tasks text-1xl"></i>
                    <span class="font-semibold text-md">Tâche</span>
                </a>
        
                <a href="{{ route('logout') }}"
                    class="flex items-center p-4 py-2 transition-transform transform bg-gray-100 rounded-lg shadow-lg hover:bg-gray-200 hover:scale-105">
                    <i class="mr-2 text-gray-600 fas fa-sign-out text-1xl"></i>
                    <span class="font-semibold text-md">Se déconnecter</span>
                </a>
        
                <!-- Option Contactez-nous -->
                <div class="col-span-1 mt-4 mb-4 md:col-span-2">
                    <h2 class="mb-2 text-lg font-bold text-gray-800">Contactez-nous</h2>
                    <div class="flex flex-col space-y-2">
                        <a href="https://chat.whatsapp.com/CVgNzh6UXzo7i1TM7Caxnb" target="_blank"
                            class="flex items-center p-4 transition-transform transform bg-green-100 rounded-lg shadow-lg hover:bg-green-200 hover:scale-105">
                            <i class="mr-2 text-xl text-green-600 fab fa-whatsapp"></i>
                            <span class="font-semibold text-md">WhatsApp</span>
                        </a>
                        <a href="https://t.me/FastCashGroup237" target="_blank"
                            class="flex items-center p-4 transition-transform transform bg-blue-100 rounded-lg shadow-lg hover:bg-blue-200 hover:scale-105">
                            <i class="mr-2 text-xl text-blue-600 fab fa-telegram"></i>
                            <span class="font-semibold text-md">Telegram</span>
                        </a>
                    </div>
                </div>
        
            </div>
        </div>
    </div>

</x-app-layout>
