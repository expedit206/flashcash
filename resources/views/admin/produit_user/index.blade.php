
    <x-app-layout>
        <div class="container p-4 mx-auto">
            <h1 class="mb-4 text-2xl font-bold">Produits Utilisateur</h1>
            <a href="{{ route('produit_user.create') }}" class="px-4 py-2 text-white bg-blue-500 rounded">Ajouter un Investissement</a>

            @if(session('success'))
                <div class="p-2 mt-4 text-white bg-green-500 rounded">{{ session('success') }}</div>
            @endif

            <table class="min-w-full mt-4 bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-center border-b">ID</th>
                        <th class="px-4 py-2 text-center border-b">User ID</th>
                        <th class="px-4 py-2 text-center border-b">Produit ID</th>
                        <th class="px-4 py-2 text-center border-b">Gagner</th>
                        <th class="px-4 py-2 text-center border-b">increment</th>
                        <th class="px-4 py-2 text-center border-b">creer</th>
                        <th class="px-4 py-2 text-center border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produitUsers as $produitUser)
                        <tr>
                            <td class="px-4 py-2 text-center border-b">{{ $produitUser->id }}</td>
                            <td class="px-4 py-2 text-center border-b">{{ $produitUser->user_id }}</td>
                            <td class="px-4 py-2 text-center border-b">{{ $produitUser->produit_id }}</td>
                            <td class="px-4 py-2 text-center border-b">{{ $produitUser->gagner }}</td>
                            <td class="px-4 py-2 text-center border-b">{{ $produitUser->last_incremented_at }}</td>
                            <td class="px-4 py-2 text-center border-b">{{ $produitUser->created_at }}</td>
                            <td class="px-4 py-2 text-center border-b">
                                <a href="{{ route('produit_user.edit', $produitUser) }}" class="text-blue-500">Éditer</a>
                                <form action="{{ route('produit_user.destroy', $produitUser) }}" method="POST" style="display:inline;">
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