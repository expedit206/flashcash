<x-app-layout>
    <div class="p-6 overflow-scroll">
        <h1 class="mb-4 text-2xl font-bold">Liste des Actionnaires</h1>

        @if (session('success'))
            <div class="p-2 mt-4 text-white bg-green-500 rounded">{{ session('success') }}</div>
        @endif

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">ID</th>
                    <th class="px-4 py-2 border-b">Nom</th>
                    <th class="px-4 py-2 border-b">Téléphone</th>
                    <th class="px-4 py-2 border-b">Solde Total</th>
                    <th class="px-4 py-2 border-b">Dépôt Total</th>
                    <th class="px-4 py-2 border-b">Retrait Total</th>
                    <th class="px-4 py-2 border-b">Parrain</th>
                    <th class="px-4 py-2 border-b">Nombre de Filleuls</th>
                    <th class="px-4 py-2 border-b">Créé le</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($actionnaires as $actionnaire)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 border-b">{{ $actionnaire->id }}</td>
                        <td class="px-4 py-2 border-b">{{ $actionnaire->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $actionnaire->telephone }}</td>
                        <td class="px-4 py-2 border-b">{{ $actionnaire->solde_total }}</td>
                        <td class="px-4 py-2 border-b">{{ $actionnaire->depot_total }}</td>
                        <td class="px-4 py-2 border-b">{{ $actionnaire->retrait_total }}</td>
                        <td class="px-4 py-2 border-b">
                            {{ $actionnaire->parrain_id }} ({{ $actionnaire->parrain->name ?? 'Inconnu' }})
                        </td>
                        <td class="px-4 py-2 border-b">
                            <a href="{{ route('admin.filleuls', $actionnaire->id) }}">
                                {{ $actionnaire->filleuls?->count() }}
                            </a>
                        </td>
                        <td class="px-4 py-2 border-b">{{ $actionnaire->created_at }}</td>
                        <td class="px-4 py-2 border-b">
                            <a href="{{ route('admin.users.edit', $actionnaire) }}" class="text-yellow-500">Modifier</a>
                            <form action="{{ route('admin.users.destroy', $actionnaire) }}" method="POST" style="display:inline;">
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
</x-app-layout>