<x-app-layout>

    <div class="container mx-auto mb-10 -z-1 pb-8">
        <!-- Image en haut -->
        {{-- <div class="mb-4 h-1/5 bg-blue-950">
            <img src="/img/acceuil.jpg" alt="Flash Cash Finance" class="w-[100vw] h-36">
            {{-- <img src="/img/acceuil.jpg" alt="Flash Cash Finance" class="w-[100vw] h-36"> --}}
            {{-- <img src="/img/acceuil.jpg" alt="Flash Cash Finance" class="w-[100vw] h-36"> --}}
        {{-- </div> --}}
       <x-header />
        <!-- Boutons Dépôt et Retrait -->
       <x-button-transaction/>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($produits as $produit)
                <div class="bg-gradient-to-r from-yellow-300 to-orange-200 rounded-lg shadow-lg p-4 transition-transform transform hover:scale-105 mb-4">
                    <img src="/img/image.png" alt="{{ $produit->name }}" class="w-full h-28 object-cover rounded-md">
                    <div class="flex justify-between items-center mt-2">
                        <h2 class="text-md font-semibold text-gray-900">{{ $produit->name }} ({{ $produit->nbjour }} jrs)</h2>
                        <p class="text-base font-bold text-gray-900">{{ number_format($produit->montant, 2, ',', ' ') }} XAF</p>
                    </div>
                    <div>
                        <p class="text-gray-800 text-sm font-bold">Stock: {{ $produit->stock }}</p>
                        <p class="text-gray-800 text-sm font-bold">Gain Journalier: {{ number_format($produit->gainJ, 2, ',', ' ') }} XAF</p>
                        <p class="text-gray-800 text-sm font-bold">Rendement: {{ $produit->rendement }}%</p>
                        <p class="text-gray-800 text-sm font-bold">Revenu Total: {{ number_format($produit->montant * ($produit->rendement / 100), 2, ',', ' ') }} XAF</p>
                    </div>
                    <div class="mt-2">
                        <form action="{{ route('produit.user.store') }}" onsubmit="confirm('Confirmer l\'achat de ce produit')" method="POST">
                            @csrf
                            <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                            <button type="submit" class="w-full bg-gray-800 text-white rounded-lg px-4 py-2 hover:bg-blue-700 transition flex items-center justify-center">
                                <i class="fas fa-shopping-cart mr-2"></i> Acheter
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
