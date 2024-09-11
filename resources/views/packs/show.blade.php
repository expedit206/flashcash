<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Détails du Pack') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="bg-gray-700 p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-bold text-gray-100 mb-2">{{ $pack->name }}</h3>
                        <p class="text-gray-300 mb-4">Montant: {{ $pack->montant }} FCFA</p>

                        <form action="{{ route('comptes.subscribe', $pack->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Souscrire à ce Pack
                            </button>
                        </form>

                        <div class="mt-6">
                            <a href="{{ route('packs.index') }}" class="text-blue-400 hover:text-blue-600">
                                ← Retour à la liste des packs
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
