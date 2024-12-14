    <x-app-layout>
        <div class="container p-4 mx-auto">
            <h1 class="mb-4 text-2xl font-bold">Éditer le Produit</h1>

            <form action="{{ route('produit_user.update', $produitUser) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium">User ID:</label>
                    <input type="number" name="user_id" value="{{ $produitUser->user_id }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium">Produit ID:</label>
                    <input type="number" name="produit_id" value="{{ $produitUser->produit_id }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium">Gagner:</label>
                    <input type="number" name="gagner" value="{{ $produitUser->gagner }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium">Duration:</label>
                    <input type="datetime-local" name="duration" value="{{ $produitUser->duration ? $produitUser->duration->format('Y-m-d\TH:i') : '' }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium">Count:</label>
                    <input type="number" name="count" value="{{ $produitUser->count }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium">Last Incremented At:</label>
                    <input type="datetime-local" name="last_incremented_at" value="{{ $produitUser->last_incremented_at ? $produitUser->last_incremented_at : '' }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>

                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">Mettre à jour</button>
            </form>
        </div>
    </x-app-layout>