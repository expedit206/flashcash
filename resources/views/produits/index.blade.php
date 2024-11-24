<x-app-layout>

    <div class="container mx-auto mb-10 -z-1 pb-8">
        <!-- Image en haut -->
        <div class="mb-6">
            <img src="/img/image.png" alt="Description de l'image" class="w-full h-48 object-cover ">
        </div>

        <!-- Boutons Dépôt et Retrait -->
        <div class="flex justify-around mb-6">
            <a href="" class="bg-green-500 text-white rounded-lg px-8 py-2 hover:bg-green-600 transition flex items-center">
                <i class="fas fa-plus-circle mr-2"></i> Dépôt
            </a>
            <a href="" class="bg-red-500 text-white rounded-lg px-8 py-2 hover:bg-red-600 transition flex items-center">
                <i class="fas fa-minus-circle mr-2"></i> Retrait
            </a>
        </div>

        <h1 class="text-3xl font-bold mb-6">Liste des Produits</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
            @foreach ($produits as $produit)
                <div class="bg-gradient-to-r from-yellow-300 to-orange-200 rounded-lg shadow-lg p-4 transition-transform transform hover:scale-105 mb-2"> <!-- Ajout de mb-6 pour espacement -->
                    <img src="/img/image.png" alt="{{ $produit->name }}" class="w-full h-32 object-cover rounded-md">
                    <div class="flex justify-between items-center mt-2">
                        <h2 class="text-xl font-semibold text-gray-900">{{ $produit->name }}</h2>
                        <p class="text-lg font-bold text-gray-900">{{ $produit->montant }} XAF</p>
                    </div>
                    <div>
                        <p class="text-gray-800">Durée: {{ $produit->nbjour }} jours</p>
                        <p class="text-gray-800">Stock: {{ $produit->stock }}</p>
                        <p class="text-gray-800">Gain Journalier: {{ $produit->gainJ }} XAF</p>
                        <p class="text-gray-800">Rendement: {{ $produit->rendement }}%</p>
                        <p class="text-gray-800 font-bold">Revenu Total: {{ $produit->montant * ($produit->rendement / 100) }} XAF</p>
                    </div>
                    <div class="mt-4">
                        <a href="" class="w-full bg-yellow-500 text-white rounded-lg px-4 py-2 hover:bg-blue-700 transition flex items-center justify-center"> <!-- Changement de couleur -->
                            <i class="fas fa-shopping-cart mr-2"></i> Acheter
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>