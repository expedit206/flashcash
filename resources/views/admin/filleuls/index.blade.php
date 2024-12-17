<x-app-layout>
    <div class="p-6 overflow-scroll">
        <h1 class="mb-4 text-2xl font-bold">Filleuls de {{ $user->name }}</h1>
        
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
                    <th class="px-4 py-2 border-b">filleulCount</th>

                    <th class="px-4 py-2 border-b">Créé le</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($filleuls->isEmpty())
                    <tr>
                        <td colspan="9" class="px-4 py-2 text-center border-b">Aucun filleul trouvé.</td>
                    </tr>
                @else
                    @foreach ($filleuls as $filleul)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border-b">{{ $filleul->id }}</td>
                            <td class="px-4 py-2 border-b">{{ $filleul->name }}</td>
                            <td class="px-4 py-2 border-b">{{ $filleul->telephone }}</td>
                            <td class="px-4 py-2 border-b">{{ $filleul->solde_total }}</td>
                            <td class="px-4 py-2 border-b">{{ $filleul->depot_total }}</td>
                            <td class="px-4 py-2 border-b">{{ $filleul->retrait_total }}</td>
                            <td class="px-4 py-2 border-b">{{ $filleul->parrain_id }} ({{ $filleul->parrainName }})</td>
                            <td class="px-4 py-2 border-b">  <a href="{{ route('admin.filleuls', $user->id) }}">
                                {{ $user->nombreFilleuls }}
                            </a></td>
                            <td class="px-4 py-2 border-b">{{ $filleul->created_at }}</td>
                            <td class="px-4 py-2 border-b">
                                <a href="{{ route('admin.users.edit', $filleul) }}" class="text-yellow-500">Modifier</a>
                                <form action="{{ route('admin.users.destroy', $filleul) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</x-app-layout>