
    <x-app-layout>
            <div class="container p-4 mx-auto">
                <h1 class="mb-4 text-2xl font-bold">Transactions</h1>
                <a href="{{ route('admin.transactions.create') }}" class="px-4 py-2 text-white bg-blue-500 rounded">Ajouter une Transaction</a>
        
                @if(session('success'))
                    <div class="p-2 mt-4 text-white bg-green-500 rounded">{{ session('success') }}</div>
                @endif
        
                <table class="min-w-full mt-4 bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border-b">ID</th>
                            <th class="px-4 py-2 border-b">Utilisateur</th>
                            <th class="px-4 py-2 border-b">Montant</th>
                            <th class="px-4 py-2 border-b">Type</th>
                            <th class="px-4 py-2 border-b">Statut</th>
                            <th class="px-4 py-2 border-b">Méthode de Paiement</th>
                            <th class="px-4 py-2 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td class="px-4 py-2 border-b">{{ $transaction->id }}</td>
                                <td class="px-4 py-2 border-b">{{ $transaction->user->name }}</td>
                                <td class="px-4 py-2 border-b">{{ $transaction->amount }}</td>
                                <td class="px-4 py-2 border-b">{{ $transaction->type }}</td>
                                <td class="px-4 py-2 border-b">{{ $transaction->status }}</td>
                                <td class="px-4 py-2 border-b">{{ $transaction->payment_method }}</td>
                                <td class="px-4 py-2 border-b">
                                    <a href="{{ route('route.transactions.edit', $transaction) }}" class="text-blue-500">Éditer</a>
                                    <form action="{{ route('route.transactions.destroy', $transaction) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ml-2 text-red-500">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </x-app-layout>