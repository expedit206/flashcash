<x-app-layout>
    <div class="p-4 text-white bg-gray-800">
        <h1 class="mb-4 text-2xl font-bold text-yellow-500">Mes transactions</h1>

        <!-- Cadre explicatif sur l'épargne -->
        <div class="px-4 py-2 mb-4 text-sm text-white bg-gray-700 rounded">
            <p>
              Toutes les entrées et sorties de votre porte feuille
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($transactions as $transaction)
            <div class="p-2 bg-white rounded-lg shadow-lg">
                <div class="flex items-center justify-between mb-1">
                    <h2 class="font-bold text-gray-600 text-md">Montant: {{ $transaction->amount }}</h2>
                    <p class="text-gray-800">Type: {{ $transaction->type=='withdrawal' ? 'Recharge' : ($transaction->type=='deposit'? 'Retrait' : $transaction->type) }}</p>
                </div>
                <div class="flex items-center justify-between mb-2">
                    <p class="text-gray-600">Statut: {{ $transaction->status }}</p>
                    {{-- <p class="text-sm text-gray-600">Date: {{ $transaction->created_at->format('d/m/Y H:i') }}</p> --}}
                    <p class="text-sm text-gray-600">Date: {{ $transaction->created_at->copy()->addHour()->format('d/m/Y H:i') }}</p>

                </div>
            </div>
            @empty
            <p>Aucune transaction effectuée</p>
        @endforelse
    </div>
</x-app-layout>