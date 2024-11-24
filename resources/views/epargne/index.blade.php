<!-- resources/views/epargne/index.blade.php -->

<x-app-layout>
    <div class="max-w-screen-md pb-20">
        <div class="bg-gray-800 text-white p-6 shadow-lg"> 

            <h1 class="text-2xl font-bold mb-4">Épargnes</h1>
            
            @if (session('success'))
                <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">{{ session('success') }}</div>
            @endif
            
            <!-- Cadre explicatif sur l'épargne -->
            <div class="text-white px-4 py-3 rounded mb-4">
                <h4 class="text-lg font-bold">Qu'est-ce que l'épargne ?</h4>
                <p>
                    L'épargne consiste à mettre de côté une partie de vos revenus pour préparer l'avenir
                    ou faire face à des imprévus. Choisissez la formule qui correspond à vos objectifs financiers.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
            @forelse ($epargnes as $epargne)
                <div class="bg-gradient-to-r from-yellow-300 to-orange-300 rounded-lg shadow-lg p-4 transition-transform transform hover:scale-105 mb-1">
                    <h5 class="text-lg font-bold mb-2">{{ $epargne->nom }}</h5>
                    <p class="text-sm mb-2">Durée : {{ $epargne->duree }} jours</p>
                    <p class="text-sm mb-4">Rendement : {{ number_format($epargne->rendement * 100, 2) }} %</p>
                    <form action="{{ route('epargne.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="montant" value="100"> <!-- Montant d'exemple -->
                        <input type="hidden" name="duree" value="{{ $epargne->duree }}">
                        <div class="mt-4">
                            <button type="submit" class="w-full bg-yellow-500 text-white rounded-lg px-4 py-2 hover:bg-blue-700 transition flex items-center justify-center">
                                <i class="fas fa-money-bill-alt mr-2"></i> Épargner
                            </button>
                        </div>
                    </form>
                    
                    <!-- Bouton Mon Épargne -->
                    <div class="mt-2">
                        <a href="" class="w-full bg-blue-400 text-white rounded-lg px-4 py-2 hover:bg-blue-700 transition flex items-center justify-center">
                            Mon Épargne
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3">
                    <div class="bg-yellow-500 text-white px-4 py-2 rounded text-center">Aucune épargne trouvée.</div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>