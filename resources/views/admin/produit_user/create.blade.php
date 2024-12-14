    <x-app-layout>
        <div class="container p-4 mx-auto">
            <h1 class="mb-4 text-2xl font-bold">Ajouter un Produit</h1>

            <form action="{{ route('produit_user.store') }}" method="POST" class="space-y-4">
                @csrf
                               <!-- Affichage des erreurs de validation -->
                               @if ($errors->any())
                               <div class="p-3 mb-4 text-white bg-red-500 rounded">
                                   <ul>
                                       @foreach ($errors->all() as $error)
                                           <li>{{ $error }}</li>
                                       @endforeach
                                   </ul>
                               </div>
                           @endif
                <div>
                    <label class="block text-sm font-medium">User ID:</label>
                    <input type="number" name="user_id" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium">Produit ID:</label>
                    <input type="number" name="produit_id" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium">Gagner:</label>
                    <input type="number" name="gagner" value="0" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium">Duration:</label>
                    <input type="datetime-local" name="duration" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium">Count:</label>
                    <input type="number" name="count" value="1" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium">Last Incremented At:</label>
                    <input type="datetime-local" name="last_incremented_at" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>

                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">Ajouter</button>
            </form>
        </div>
    </x-app-layout>