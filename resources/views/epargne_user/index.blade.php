<x-app-layout>

    
    <!-- Boutons -->


    <div class="p-2 px-6 pb-2 text-white bg-gray-800 shadow-lg">
        <h2 class="mb-4 text-2xl font-bold text-yellow-600">Mes Épargnes</h2>
    
        
        <div class="flex items-center justify-between pl-2 mb-2 text-sm">
            <span>Montant  épargné :</span>
            <span class="font-bold text-green-500">{{ number_format($montantEpargneTotal, 2) }} XAF</span>
        </div>
    
        <div class="flex items-center justify-between pl-2 mb-2 text-sm">
            <span>Nombre d'épargnes :</span>
            <span class="font-bold">{{ $epargnes->count() }}</span>
        </div>
        
        <div class="flex items-center justify-between pl-2 text-sm">
            <span>Montant a retirer :</span>
            <span class="font-bold text-green-500">{{ number_format($revenuTotalEpargne, 2) }} XAF</span>
        </div>

        <div class="flex items-center justify-between pl-2 mt-2 text-sm">
            <span class="mr-2">Mon Solde :</span>
            <span class="font-bold text-green-500">{{ number_format($soldeTotal, 2) }} XAF</span>
        </div>
    </div>

    <div class="flex items-center justify-center gap-2 p-2 space-x-0">
        <a href="{{ route('epargne.index') }}"
            class="{{ request()->routeIs('epargne.index') ? 'bg-yellow-500' : 'bg-gray-600' }} hover:bg-gray-700 rounded-lg text-white font-bold py-2 px-4 w-1/2">
            Épargne disponible
        </a>
    
        <a href="{{ route('epargne.user.index') }}"
            class="{{ request()->routeIs('epargne.user.index') ? 'bg-yellow-500' : 'bg-gray-600' }} hover:bg-gray-700 rounded-lg text-white font-bold py-2 px-4 w-1/2">
            Mes épargnes
        </a>
    </div>  
  



    <div class="container pb-20 mx-auto">

        @if ($epargnes->isEmpty())
            <div class="px-4 py-2 text-center text-white bg-yellow-500 rounded">Aucune épargne trouvée.</div>
        @else
        <div class="grid grid-cols-1 gap-4">
            @foreach ($epargnes as $epargne)
                <div class="p-4 shadow-lg bg-gradient-to-r from-yellow-300 to-orange-300 shadow-black">
                    <h5 class="mb-2 font-bold text-md">{{ $epargne->nom }}</h5>
                    <p class="mb-1 text-sm font-bold">Montant épargné: {{ number_format($epargne->pivot->montant, 2) }} XAF</p>
                    <p class="mb-1 text-sm font-bold">Rendement : {{ number_format($epargne->rendement * 100, 2) }} %</p>
                    <p class="mb-1 text-sm font-bold">Montant à gagner :
                        {{ number_format($epargne->pivot->montant * $epargne->rendement + $epargne->pivot->montant, 2) }} XAF
                    </p>
        
                    {{-- Affichage du temps restant --}}
                    @php
                        $uniqueId = \Carbon\Carbon::parse($epargne->pivot->created_at)->format('YmdHis'); // Formater la date
                    @endphp
                    <p class="mb-1 text-sm font-bold" id="countdown-{{ $uniqueId }}">Temps restant : <span class="font-bold text-green-500" id="time-{{ $uniqueId }}"></span></p>
        {{-- @dd($epargne->pivot_epargne_id) --}}
                    <form action="{{ route('epargne.user.retirer', $epargne->pivot->id) }}" method="POST">
                        @csrf
                        <div class="mt-2">
                            <button type="submit"
                                class="w-full px-4 py-2 text-white transition bg-gray-600 rounded-lg hover:bg-gray-600">
                                Récupérer 
                            </button>
                        </div>
                    </form>
                </div>
        
                <script>
                    function startCountdown(id, createdAt, duration) {
                        const endTime = new Date(createdAt).getTime() + duration * 24 * 60 * 60 * 1000;
        
                        function updateCountdown() {
                            const now = Date.now();
                            
                            
                            const totalSeconds = Math.floor((endTime - now) / 1000);
        
                            if (totalSeconds <= 0) {
                                document.getElementById('time-' + id).innerText = "Temps écoulé";
                                return;
                            }
        
                            const days = Math.floor(totalSeconds / (60 * 60 * 24));
                            const hours = Math.floor((totalSeconds % (60 * 60 * 24)) / (60 * 60));
                            const minutes = Math.floor((totalSeconds % (60 * 60)) / 60);
                            const seconds = totalSeconds % 60;
        
                            document.getElementById('time-' + id).innerText =
                                `${days} jrs: ${hours} h: ${minutes} min: ${seconds} `;
                        }
        
                        setInterval(updateCountdown, 1000);
                    }
        
                    // Initialisation du compte à rebours
                    createdAt = "{{ $epargne->pivot->created_at }}";
                    startCountdown("{{ $uniqueId }}", createdAt, {{ $epargne->duree  }}); // 7 jours
                </script>
            @endforeach
        </div>
        @endif
        <div class="p-2 mt-4 text-white bg-gray-800 shadow-lg">
            <h1 class="mb-2 text-2xl font-bold">
                Interêt des Épargnes
            </h1>
    
           
            <!-- Cadre explicatif sur l'épargne -->
            <div class="px-4 py-1 mb-2 text-white rounded">
                <p>
                    Récupérez vos épargnes et bénéficiez d'un intérêt accumulé à la fin de chaque période de décompte. Profitez de cette opportunité pour optimiser vos investissements et faire fructifier votre capital au fil du temps.
                                            </p>
            </div>
    
        </div>
    </div>
</x-app-layout>
