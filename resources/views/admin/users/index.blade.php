
    <x-app-layout>
        <div class="p-6 overflow-scroll">
            <h1 class="mb-4 text-2xl font-bold">Liste des Utilisateurs</h1>
            {{-- <a href="{{ route('admin.users.create') }}" class="px-4 py-2 text-white bg-blue-500 rounded">Créer un nouvel Utilisateur</a> --}}
            
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
                        <th class="px-4 py-2 border-b">parrain</th>
                        <th class="px-4 py-2 border-b">filleulCount</th>
                        <th class="px-4 py-2 border-b">Crréé le</th>
                        <th class="px-4 py-2 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border-b">{{ $user->id }}</td>
                            <td class="px-4 py-2 border-b">{{ $user->name }}</td>
                            <td class="px-4 py-2 border-b">{{ $user->telephone }}</td>
                            <td class="px-4 py-2 border-b">{{ $user->solde_total }}</td>
                            <td class="px-4 py-2 border-b">{{ $user->depot_total }}</td>
                            <td class="px-4 py-2 border-b">{{ $user->retrait_total }}</td>
                            <td class="px-4 py-2 border-b">{{ $user->parrain_id  }} ({{ $user->parrainName }})</td>
                            <td class="px-4 py-2 border-b">  <a href="{{ route('admin.filleuls', $user->id) }}">
                                {{ $user->nombreFilleuls }}
                            </a></td>
                            <td class="px-4 py-2 border-b">{{ $user->created_at }}</td>
                            <td class="px-4 py-2 border-b">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-yellow-500">Modifier</a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
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