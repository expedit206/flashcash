<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Comptes de ' . $user->name) }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h1 class="text-2xl mb-4">Comptes</h1>
                    <p>Total des retraits pour cet utilisateur: {{ $totalRetrait }} FCFA</p>

                    <table class="min-w-full divide-y divide-gray-700">
                        <thead>
                            <tr>
                                <th>Pack</th>
                                <th>Solde Actuel</th>
                                <th>Retrait Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->comptes as $compte)
                                <tr>
                                    <td>{{ $compte->pack->nom }}</td>
                                    <td>{{ $compte->solde_actuel }} FCFA</td>
                                    <td>{{ $compte->montant_retrait_total }} FCFA</td>
                                    <td>
                                        <a href="{{ route('admin.compte.edit', $compte->id) }}" class="text-blue-500">Modifier</a>
                                        <form action="{{ route('admin.compte.delete', $compte->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
