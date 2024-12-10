<x-app-layout>
    <script>
       function startCountdown(endTime, elementId) {
    function updateCountdown() {
        const currentTime = Date.now();
        const remainingTime = endTime - currentTime;

        if (remainingTime <= 0) {
            clearInterval(timerInterval);
            document.getElementById(elementId).innerText = "Temps écoulé !";
            return;
        }

        const remainingSeconds = Math.floor(remainingTime / 1000);
        const days = Math.floor(remainingSeconds / (3600 * 24));
        const hours = Math.floor((remainingSeconds % (3600 * 24)) / 3600);
        const minutes = Math.floor((remainingSeconds % 3600) / 60);

        document.getElementById(elementId).innerText =
            `${days} Jrs ${hours} h ${minutes} Min`;
    }

    updateCountdown(); // Appeler une fois pour initialiser
    const timerInterval = setInterval(updateCountdown, 2000); // Met à jour chaque seconde
}
    </script>
    <div class="pb-16">

        <div class="p-6 pb-6 text-white bg-gray-800 shadow-lg">
            <h2 class="mb-4 text-2xl font-bold text-yellow-500">Mes produits</h2>
        <div class="flex items-center justify-between pl-2 mb-2 text-sm">
            <span class="mr-2">Revenu total :</span>
            <span class="font-bold text-green-500">{{ number_format($totalRevenu, 2) }} XAF</span>
        </div>  

        <div class="flex items-center justify-between pl-2 mb-2 text-sm">
            <span>revenu d'aujourd'hui :</span>
            <span class="font-bold text-green-500">{{ number_format($revenueToday, 2) }} XAF</span>
        </div>

        <div class="flex items-center justify-between pl-2 mb-2 text-sm">
            <span>Produit(s) consommé(s) :</span>
            <span class="font-bold text-green-500">{{ $produits->count() }}</span>
        </div>
        <div class="flex items-center justify-between pl-2 mb-2 text-sm">
            <span>Mon Solde :</span>
            <span class="font-bold text-green-500">{{ number_format($soldeTotal, 2) }} XAF</span>
        </div>

        <x-button-transaction/>
    </div>

    @forelse ($produits as $produit)
    <div class="p-4 mb-4 transition-transform transform shadow-lg bg-gradient-to-r from-yellow-300 to-orange-300 hover:scale-105">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-lg font-bold">{{ $produit->name }} ({{ $produit->pivot->count }} fois) </h3>
            <span class="font-bold">{{ number_format($produit->montant, 2) }} XAF</span>
        </div>
        <div class="grid grid-cols-2 gap-2 ">
            <div>
                <p class="mb-1 font-bold text-gray-900">Temps restant:</p>
                @php
                    $createdAt = \Carbon\Carbon::parse($produit->pivot->created_at);
                    $duration = $produit->nbjour; // Durée en jours
                    $endDate = $createdAt->copy()->addDays($duration); // Date de fin
                    $formattedDate = $createdAt->format('YmdHis'); // Formatage de la date pour l'utiliser dans l'ID
                @endphp
                <p id="countdown-{{ $produit->id }}-{{ $formattedDate }}"></p> <!-- ID unique pour le compte à rebours -->
                <script>
                    (function() {
                        const endDate = new Date("{{ $endDate }}").getTime();
                        startCountdown(endDate, 'countdown-{{ $produit->id }}-{{ $formattedDate }}');
                    })();
                </script>
            </div>
            <div>
                <p class="mb-1 font-bold text-gray-900">Rendement:</p>
                <span>{{ number_format($produit->rendement, 2) }} %</span>
            </div>
            <div>
                <p class="mb-1 font-bold text-gray-900">Revenu quotidien:</p>
                <span>{{ number_format($produit->montant*$produit->rendement/100, 2) }} XAF</span>
            </div>
            
            <div>
                {{-- @dd($produit) --}}
                <p class="mb-1 font-bold text-gray-900">Revenu gagné:</p>
                <span>{{ number_format($produit->pivot->gagner, 2) }} XAF</span>
            </div>
        </div>
    </div>
@empty
    <p>Aucun produit consommé</p>
@endforelse



</div>
</x-app-layout>
