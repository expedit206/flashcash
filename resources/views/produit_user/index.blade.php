<x-app-layout>
    <div class="bg-gray-800 text-white p-6  shadow-lg pb-20">
        <h2 class="text-3xl font-bold mb-4">Mes produits</h2>
        
        <div class="flex justify-between items-center mb-4">
            <span class="mr-2">Revenu des produits:</span>
            <span class="text-green-500 font-bold">{{ number_format($totalRevenu, 2) }} XAF</span>
        </div>
    
        <div class="flex justify-between items-center mb-4">
            <span>Le revenu du jour:</span>
            <span class="text-green-500 font-bold">{{ number_format($revenueToday, 2) }} XAF</span>
        </div>
        
        <div class="flex justify-between items-center mb-4">
            <span>Produit consommé(s):</span>
            <span class="font-bold">{{ $produits->count() }}</span>
        </div>
    
        <div class="flex justify-between mt-4">
            <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-gray-800 font-bold py-2 px-4 rounded-lg flex items-center">
                <i class="fas fa-download mr-2"></i>
                Dépôt
            </a>
            <a href="#" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg flex items-center">
                <i class="fas fa-upload mr-2"></i>
                Retirer
            </a>
        </div>
    </div>

    @forelse ($produits as $produit)
        <div class="bg-gradient-to-r from-yellow-300 to-orange-300 rounded-lg shadow-lg p-4 transition-transform transform hover:scale-105 mb-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold">{{ $produit->name }}({{ $produit->pivot_count }})</h3>
                <span class=" font-bold">{{ number_format($produit->montant, 2) }} XAF</span>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-400 mb-1">Temps restant:</p>
                    @php
    // Formatez la date pour qu'elle soit utilisable comme ID
    // @dump($produit);
    // @dump($produit->pivot_created_at);
    // @dump(\Carbon\Carbon::parse($produit->pivot_created_at)->format('Y/m/d/H/i/s'));
    $formattedDate = \Carbon\Carbon::parse($produit->pivot_created_at)->format('YsmdHi');
@endphp
<p id="{{ $produit->id }}{{ $formattedDate }}"></p> <!-- ID basé sur la date de création -->

                    
<script>
    function startCountdown(initialDays, elementId) {
        let totalHours = initialDays * 24; // Convertir les jours en heures
        let startDate;

                            // Récupérer startDate depuis le localStorage ou initialiser si pas présent
                            if (localStorage.getItem(`startDate-${elementId}`)) {
                                startDate = parseInt(localStorage.getItem(`startDate-${elementId}`), 10);
                            } else {
                                startDate = Date.now();
                                localStorage.setItem(`startDate-${elementId}`, startDate); // Enregistrer dans le localStorage
                            }
        function updateCountdown() {
            const currentTime = Date.now();
            const remainingTime = (totalHours * 60 * 60 * 1000) - (currentTime - startDate);

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
        const timerInterval = setInterval(updateCountdown, 1000); // Met à jour chaque seconde
    }

    // Appeler la fonction avec le nombre de jours et l'ID du produit
    startCountdown({{ $produit->nbjour }}, {{$produit->id }}{{ $formattedDate }});
</script>
                 

                    
                </div>
                <div>
                    <p class="text-gray-400 mb-1">Rendement:</p>
                    <span>{{ number_format($produit->rendement, 2) }} %</span>
                </div>
                <div>
                    <p class="text-gray-400 mb-1">Revenu quotidien:</p>
                    <span>{{ number_format($produit->gainJ, 2) }} XAF</span>
                </div>
                <div>
                    <p class="text-gray-400 mb-1">Revenu gagné:</p>
                    <span>{{ number_format($produit->gagner, 2) }} XAF</span>
                </div>
            </div>
        </div>
    @empty
        <p>Aucun produit consommé</p>
    @endforelse
</x-app-layout>
