{{-- resources/views/parrainage/index.blade.php --}}

<x-app-layout>
    <div class="container mx-auto pb-16">

        <div class="bg-gray-800 text-white p-4 md:p-6 shadow-lg pb-20">
            <h1 class="text-2xl md:text-3xl font-bold text-yellow-600">Système d'Équipe</h1>
            <p class="mt-2 text-gray-300 text-sm md:text-base">Suivez vos revenus de commission et l'évolution de votre équipe de parrainage.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
            <div class="bg-white shadow-lg rounded-lg p-4">
                <h2 class="text-lg md:text-xl font-semibold">Investissement total</h2>
                <p class="text-xl md:text-2xl font-bold text-yellow-600">
                    {{ number_format($totalFirstDepositsVip1 + $totalFirstDepositsVip2 + $totalFirstDepositsVip3, 2, ',', ' ') }} XAF
                </p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-4">
                <h2 class="text-lg md:text-xl font-semibold">Gain total de parrainage</h2>
                <p class="text-xl md:text-2xl font-bold text-yellow-600">{{ number_format($totalCommissions, 2, ',', ' ') }} XAF</p>
            </div>
        </div>

        <div class="flex items-center my-6">
            <hr class="flex-1 border-t border-gray-300">
            <h2 class="text-xl md:text-2xl font-bold mx-4">Mon Équipe</h2>
            <hr class="flex-1 border-t border-gray-300">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mt-4">
            <div class="bg-gradient-to-r from-yellow-300 to-orange-300 rounded-lg shadow-lg p-4 flex items-center transition-transform transform hover:scale-105 mb-2 cursor-pointer">
                <h3 class="text-lg md:text-xl font-semibold flex flex-col items-center">
                    <i class="fas fa-crown text-3xl text-yellow-500 mr-2"></i>
                    Niveau 1
                </h3>
                <div class="ml-auto">
                    <p>Investissement: <strong>{{ number_format($totalFirstDepositsVip1, 2, ',', ' ') }} XAF</strong></p>
                    <p>Rendement: <strong>{{ config('parrainage.taux_interet.vip1') }}%</strong></p>
                    <p>Nombre de filleuls: <strong>{{ $vip1->count() }}</strong></p>
                    <p>Gain: <strong>{{ config('parrainage.taux_interet.vip1')  * $totalFirstDepositsVip1 /100}}</strong></p>
                </div>
                <div class="ml-2">
                    <i class="fas fa-chevron-right text-2xl text-gray-600"></i>
                </div>
            </div>
            <div class="bg-gradient-to-r from-yellow-300 to-orange-300 rounded-lg shadow-lg p-4 flex items-center transition-transform transform hover:scale-105 mb-2 cursor-pointer">
                <h3 class="text-lg md:text-xl font-semibold flex flex-col items-center">
                    <i class="fas fa-crown text-3xl text-green-800 mr-2"></i>
                    Niveau 2
                </h3>
                <div class="ml-auto">
                    <p>Investissement: <strong>{{ number_format($totalFirstDepositsVip2, 2, ',', ' ') }} XAF</strong></p>
                    <p>Rendement: <strong>{{ config('parrainage.taux_interet.vip2') }}%</strong></p>
                    <p>Nombre de filleuls: <strong>{{ $vip2->count() }}</strong></p>
                    <p>Gain: <strong>{{ config('parrainage.taux_interet.vip2')  * $totalFirstDepositsVip2 /100}}</strong></p>
                </div>
                <div class="ml-2">
                    <i class="fas fa-chevron-right text-2xl text-gray-600"></i>
                </div>
            </div>
            <div class="bg-gradient-to-r from-yellow-300 to-orange-300  rounded-lg shadow-lg p-4 flex items-center transition-transform transform hover:scale-105 mb-2 cursor-pointer">
                <h3 class="text-lg md:text-xl font-semibold flex flex-col items-center justify-center">
                    <i class="fas fa-crown text-3xl text-blue-800 mr-2"></i>
                    Niveau 3
                </h3>
                <div class="ml-auto">
                    <p>Investissement: <strong>{{ number_format($totalFirstDepositsVip3, 2, ',', ' ') }} XAF</strong></p>
                    <p>Rendement: <strong>{{ config('parrainage.taux_interet.vip3') }}%</strong></p>
                    <p>Nombre de filleuls: <strong>{{ $vip3->count() }}</strong></p>
                    <p>Gain: <strong>{{ config('parrainage.taux_interet.vip3')  * $totalFirstDepositsVip3 /100}}</strong></p>
                </div>
                <div class="ml-2">
                    <i class="fas fa-chevron-right text-2xl text-gray-600"></i>
                </div>
            </div>
            <a href="{{ route('filleuls') }}">iciciiiiiiiiiiiiiiiii</a>
        </div>
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mt-8 shadow-md">
            <h2 class="text-xl md:text-2xl font-bold text-center  mb-4">Informations de Parrainage</h2>
            <div class="grid grid-cols-1 gap-4">
                <div class="flex justify-between items-center">
                    <span class="text-lg  font-semibold">Code de parrainage :</span>
                    <span class="text-lg text-yellow-600 font-semibold">{{ $user->id }}</span>
                    <button class="bg-gray-200 hover:bg-gray-300 rounded px-3 py-1 text-gray-700 ml-4 cursor-pointer" onclick="copyToClipboard('{{ $user->id }}')">Copier</button>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold">Lien de parrainage :   </span>
                    <a href="{{ url('register?code=' . $user->id) }}" class="text-blue-500 underline hover:text-blue-700 flex-1 truncate">{{ url('register?code=' . $user->id) }}</a>
                    <button class="bg-gray-200 hover:bg-gray-300 rounded px-3 py-1 text-gray-700 ml-4 cursor-pointer" onclick="copyToClipboard('{{ url('register?code=' . $user->id) }}')">Copier</button>
                </div>
            </div>
        </div>
        
        <script>
            function copyToClipboard(text) {
                navigator.clipboard.writeText(text);
                alert("Copié dans le presse-papiers !");
            }
        </script>
        
        <div class="bg-gray-800 text-white p-4 md:p-6 shadow-lg mb-6">
            <h2 class="text-xl font-semibold text-white">Astuces pour Maximiser vos Gains</h2>
            <ul class="list-disc list-inside mt-4 space-y-2">
                <li class="text-gray-200">Partagez votre lien de parrainage avec vos amis pour augmenter vos gains.</li>
                <li class="text-gray-200">Suivez régulièrement vos performances et celles de votre équipe.</li>
                <li class="text-gray-200">Encouragez vos filleuls à participer activement.</li>
            </ul>
        </div>
    </div>
</x-app-layout>