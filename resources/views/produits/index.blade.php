<x-app-layout>


    {{-- //promotion --}}
    <style>
        .modal-fade-in {
    animation: fadeIn 0.5s forwards;
}

.modal-fade-out {
    animation: fadeOut 0.5s forwards;
}

@keyframes fadeIn {
    from {
        transform: translateX(-100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes fadeOut {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(-100%);
        opacity: 0;
    }
}
    </style>
    
<!-- Modal --><div id="promoModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 modal fade" tabindex="-1" role="dialog" aria-labelledby="promoModalLabel" aria-hidden="true" style="display: none;">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg modal-dialog">
        <div class="modal-content">
            <div class="flex items-center p-4 border-b modal-header">
                <span class="mr-2 text-2xl">🎄</span> <!-- Emoji de sapin de Noël -->
                <h5 class="text-lg font-semibold modal-title">Promotion de Noël</h5>
               
            </div>
            <div class="p-4 text-center modal-body">
                <p class="text-md">Profitez de notre promotion spéciale de Noël avec un rendement élevé sur nos produits !</p>
                <p class="mt-2 font-semibold text-red-600">Fin de la promotion : 2 janvier 2025.</p>
                <div class="mt-4">
                    <span class="text-3xl">✨</span> <!-- Étoile -->
                    <span class="text-3xl">🎁</span> <!-- Emoji de cadeau -->
                    <span class="text-3xl">❄️</span> <!-- Flocon de neige -->
                </div>
            </div>
            <div class="p-4 text-center border-t modal-footer">
                <button type="button" class="px-4 py-2 text-white bg-blue-500 rounded btn btn-primary" id="closeModal">OK</button>
            </div>
        </div>
    </div><div id="promoModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 modal fade" tabindex="-1" role="dialog" aria-labelledby="promoModalLabel" aria-hidden="true" style="display: none;">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg modal-dialog">
            <div class="modal-content">
                <div class="flex items-center p-4 border-b modal-header">
                    <span class="mr-2 text-2xl">🎄</span>
                    <h5 class="text-lg font-semibold modal-title">Promotion de Noël</h5>
                    <button type="button" class="text-gray-500 close hover:text-gray-700" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="p-4 text-center modal-body">
                    <p class="text-md">Profitez de notre promotion spéciale de Noël avec un rendement élevé sur nos produits !</p>
                    <p class="mt-2 font-semibold text-red-600">Cette promotion se termine le 2 janvier 2025.</p>
                    <div class="mt-4">
                        <span class="text-3xl">✨</span>
                        <span class="text-3xl">🎁</span>
                        <span class="text-3xl">❄️</span>
                    </div>
                </div>
                <div class="p-4 text-center border-t modal-footer">
                    <button type="button" class="px-4 py-2 text-white bg-blue-500 rounded btn btn-primary" id="closeModal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Vérifie si la session indique d'afficher le modal
        @if(session('show_promo_modal'))
            var promoModal = document.getElementById('promoModal');
            promoModal.style.display = 'flex'; // Afficher le modal
            promoModal.classList.add('modal-fade-in'); // Ajouter la classe d'animation

            // Supprime la session après l'affichage
            @php
                session()->forget('show_promo_modal');
            @endphp
        @endif

        // Ferme le modal
        document.getElementById('closeModal').addEventListener('click', function() {
            var promoModal = document.getElementById('promoModal');
            promoModal.classList.remove('modal-fade-in'); // Retirer la classe d'animation d'entrée
            promoModal.classList.add('modal-fade-out'); // Ajouter la classe d'animation de sortie

            // Attendre la fin de l'animation avant de cacher le modal
            promoModal.addEventListener('animationend', function() {
                promoModal.style.display = 'none'; // Cacher le modal
                promoModal.classList.remove('modal-fade-out'); // Retirer la classe d'animation de sortie
                promoModal.setAttribute('aria-hidden', 'true'); // Mettre à jour l'attribut aria-hidden
            }, { once: true });
        });
    });
</script>
    {{-- //promotion --}}


    
    <div class="container pb-8 mx-auto mb-10 bg-yellow-200 -z-1">
   
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
    <script>
        //retirer la variable code du local storage
                    localStorage.removeItem('code');

    </script>
</x-app-layout>
