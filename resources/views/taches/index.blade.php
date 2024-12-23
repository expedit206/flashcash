<x-app-layout>
    <div class="container pb-1 mx-auto">
        <div class="p-3 text-white bg-gray-800 shadow-lg ">
            <h1 class="text-xl font-bold text-yellow-500 md:text-3xl">Tâches de Parrainage</h1>
            <p class="px-3 mt-2 text-sm text-gray-300 md:text-base">Gagnez des bonus en fonction du nombre d'utilisateurs parrainés.</p>
            <div class="p-2 px-4 mt-2 bg-gray-700 rounded">
             <div class="flex items-center justify-between text-sm">
                 <span class="font-medium">Solde total :</span>
                 <span class="font-bold text-green-400 text-md">{{ number_format($soldeTotal, 2) }} XAF</span>
             </div>
        </div>

           <!-- Ajout du solde total avec style amélioré -->
        </div>
        <!-- Section Accomplissement des Missions -->
        <h2 class="p-3 px-4 mx-2 mt-2 mb-4 text-xl font-bold text-center text-white bg-gray-500 rounded-lg">
            <i class="mr-2 fas fa-tasks"></i> Accomplissement des missions
        </h2>
        
        <div class="grid grid-cols-1 gap-4 mb-6">
            @foreach ($taches as $tache)
                @if ($tache['type'] === 'standard')
                    <div class="p-4 bg-white rounded-lg shadow">
                        <h3 class="italic font-semibold text-gray-500 text-md">{{ $tache['description'] }}</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm md:grid-cols-2">
                            <div>
                                <p class="text-green-600 text-md">Bonus : <span class="font-bold">{{ number_format($tache['bonus'], 0, ',', ' ') }} XAF</span></p>
                                <p class="text-gray-600">Progrès : <span class="font-bold">{{ $tache['nombre_filleulStandard'] ?? 0 }}/{{ $tache['cible'] }}</span></p>
                            </div>
                            <div class="flex items-center justify-end">
                                @php
                                    // Vérification si la tâche est accomplie
                                    $isAccomplished = ($tache['nombre_filleul'] ?? 0) >= $tache['cible'];
                                @endphp
                    
                    <button class="bg-gray-600 text-white px-4 py-2 rounded {{ $isAccomplished ? '' : 'opacity-50 cursor-not-allowed' }}" 
                    {{ $isAccomplished ? '' : 'disabled' }} 
                    onclick="{{ $isAccomplished ? "event.preventDefault(); document.getElementById('recuperer-form-{$tache['id']}').submit();" : '' }}">
                    Récupérer
                </button>
                <form id="recuperer-form-{{ $tache['id'] }}" action="{{ route('taches.recuperer', $tache['id']) }}" method="POST" style="display: none;">
                    @csrf
                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Section Offres Spéciales -->
        <h2 class="p-3 mx-2 mb-4 text-xl font-bold text-center text-white bg-gray-500 rounded-lg">
            <i class="mr-2 fas fa-gift"></i> Offres Spéciales
        </h2>
        
        <div class="grid grid-cols-1 gap-4 mb-24">
            @foreach ($taches as $tache)
    @if ($tache['type'] === 'special')
        <div class="p-4 rounded-lg shadow ">
            <h3 class="italic font-semibold text-gray-500 text-md">{{ $tache['description'] }}</h3>
            <div class="grid grid-cols-2 gap-4 text-sm md:grid-cols-2">
                <div>
                    <p class="text-green-600 text-md">Bonus : <span class="font-bold">{{ number_format($tache['bonus'], 0, ',', ' ') }} XAF</span></p>
                    <p class="text-gray-600">Progrès : <span class="font-bold">{{ $tache['nombre_filleulSpecial'] ?? 0 }}/{{ $tache['cible'] }}</span></p>
                </div>
                
                <div class="flex items-center justify-end">
                    @php
                        // Vérification si la tâche est accomplie
                        $isAccomplished = ($tache['nombre_filleul'] ?? 0) >= $tache['cible'];
                    @endphp

                    <button class="bg-gray-600 text-white px-4 py-2 rounded {{ $isAccomplished ? '' : 'opacity-50 cursor-not-allowed' }}" 
                        {{ $isAccomplished ? '' : 'disabled' }} 
                        onclick="{{ $isAccomplished ? "event.preventDefault(); document.getElementById('recuperer-form-{$tache['id']}').submit();" : '' }}">
                        Récupérer
                    </button>

                    <form id="recuperer-form-{{ $tache['id'] }}" action="{{ route('taches.recuperer', $tache['id']) }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    @endif
@endforeach
        </div>
    </div>
</x-app-layout>