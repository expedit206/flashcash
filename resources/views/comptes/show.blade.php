<!-- resources/views/packs/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between font-semibold text-xl text-green-300 leading-tight">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Détails du Pack') }}
            </h2>
            @if ($compte)

            <a href="{{ route('admin.utilisateur.actualiser', ['user' => $compte?->user->id, 'compte' => $compte?->id]) }}"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                Actualiser le solde
            </a>
            @endif
        </div>
    </x-slot>
         <!-- Affichage des messages de session -->

@if ($compte)

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="bg-gray-700 p-6 rounded-lg shadow-md">
                        <h2 class="text-3xl font-bold text-gray-100 mb-4">{{ $pack->name }}</h2>
                        <p class="text-gray-300 mb-2">Montant en jeu: {{ $pack->montant }} FCFA</p>
                        <p class="text-gray-300 mb-4">Gain journalier: {{ $pack->montant * 0.15 }} FCFA/jour</p>
                        <p class="text-white underline mb-4 pb-1">Montant gagné: {{ $compte->solde_actuel }} FCFA</p>
                    </div>
                    <div class="mt-6 mb-3">Effectuer un retrait</div>
                      <!-- Formulaire de retrait -->
                      <form action="{{ route('retrait.store', ['userId' => $compte->user_id, 'compteId' => $compte->id]) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="montant" class="block text-sm font-medium text-gray-400">Montant du retrait en FCFA(Minimum 1000FCFA)</label>
                            <input type="number" id="montant" name="montant" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-black" min="1000" placeholder="50000 " required>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Effectuer le retrait
                        </button>
                    </form>
                    <p class="mt-3" >Veuillez actualiser le solde chaque pour voir votre "montant gagné" s'accroitre</p>
                </div>
            </div>
        </div>
    </div>
    @else
    <p class="bg-red-500 py-3 text-white font-bold text-2xl">Veuillez souscrire a un pack pour voir vos revenu a ce Pack</p>
    @endif
</x-app-layout>
