<x-app-layout>

    <div class="container pb-8 mx-auto mb-10 -z-1">
        <!-- Image en haut -->
        {{-- <div class="mb-4 h-1/5 bg-blue-950">
            <img src="/img/acceuil.jpg" alt="Flash Cash Finance" class="w-[100vw] h-36">
            {{-- <img src="/img/acceuil.jpg" alt="Flash Cash Finance" class="w-[100vw] h-36"> --}}
            {{-- <img src="/img/acceuil.jpg" alt="Flash Cash Finance" class="w-[100vw] h-36"> --}}
        {{-- </div> --}}

        <!-- Image en haut -->
<div class="mb-4 overflow-hidden h-1/5">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="/img/acceuil.jpg" alt="Flash Cash Finance" class="w-[100vw] h-36 object-cover">
            </div>
            <div class="swiper-slide">
                <img src="/img/acceuil2.jpg" alt="Flash Cash Finance" class="w-[100vw] h-36 object-cover">
            </div>
            <div class="swiper-slide">
                <img src="/img/acceuil4.jpg" alt="Flash Cash Finance" class="w-[100vw] h-36 object-cover">
            </div>
            <!-- Ajoutez d'autres diapositives ici -->
        </div>
        <!-- Ajouter des boutons de navigation si nécessaire -->
        {{-- <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div> --}}
    </div>
</div>

       {{-- <x-header /> --}}
        <!-- Boutons Dépôt et Retrait -->
       <x-button-transaction/>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 font-R" >
            @foreach ($produits as $produit)
                <div class="p-4 mb-4 transition-transform transform rounded-lg shadow-lg bg-gradient-to-r from-yellow-300 to-orange-200 hover:scale-105">
                    <img src="{{ $produit->img }}" alt="{{ $produit->name }}" class="object-cover w-full rounded-md h-28">
                    <div class="flex items-center justify-between mt-2">
                        <h2 class="font-semibold text-gray-900 text-md">{{ $produit->name }} ({{ $produit->nbjour }} jrs)</h2>
                        <p class="text-base font-bold text-gray-900">{{ number_format($produit->montant, 2, ',', ' ') }} XAF</p>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">Stock: {{ $produit->stock }}</p>
                        <p class="text-sm font-bold text-gray-900">Gain Journalier: {{ number_format($produit->montant*$produit->rendement/100, 2, ',', ' ') }} XAF</p>
                        <p class="text-sm font-bold text-gray-900">Rendement: {{ $produit->rendement }}%</p>
                        <p class="text-sm font-bold text-gray-900">Revenu Total: {{ number_format($produit->montant *$produit->nbjour* ($produit->rendement / 100), 2, ',', ' ') }} XAF</p>
                        <p class="text-sm font-bold text-gray-900">
                            Status: 
                            <span class="italic {{ $produit->status === 'disponible' ? 'text-green-400' : 'text-red-400' }}">

                                {{ $produit->status }}
                            </span>
                        </p>
                    </div>
                    <div class="mt-2">
                        <form action="{{ route('produit.user.store') }}" onsubmit="confirm('Confirmer l\'achat de ce produit')" method="POST">
                            @csrf
                            <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                            @if($produit->status === 'disponible')
                            <button type="submit" class="flex items-center justify-center w-full px-4 py-2 text-white transition bg-gray-800 rounded-lg hover:bg-blue-700">
                                <i class="mr-2 fas fa-shopping-cart"></i> Acheter
                            </button>
                        @endif
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
