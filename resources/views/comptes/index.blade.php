<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Mes Comptes') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    @if(session('success'))
                        <div class="bg-green-500 text-white p-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-500 text-white p-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-700">
                            <tr>
                             
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Gains
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Pack
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Montant
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Date de Souscription
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @forelse($comptes as $compte)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-400">{{ $compte->solde }} FCFA</td>
                                    <td class="px-6 py-4 text-sm text-gray-400">{{ $compte->pack->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-400">{{ $compte->pack->montant }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-400">{{ $compte->created_at?->format('d/m/Y H:i') }}</td>
                                </tr>
                                @empty
                                <p>Aucun Game, veuillez soucrire a un pack!!</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
